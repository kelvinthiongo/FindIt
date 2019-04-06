<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use File;
use Image;
use Session;
use Auth;
use Illuminate\Database\QueryException;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('type', 'user')->where('email_verified_at', '!=', null)->get();
        return view('admin.users.index')->with('users', $users)->with('user_type', 'User');
    }

    public function admin_index()
    {
        $admins = User::where('type', '!=', 'user')->get();
        return view('admin.users.index')->with('users', $admins)->with('user_type', 'Admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    public function add_admin()
    {
        //
        if(Auth::user()->type == 'supper'){
            return view('admin.users.add_admin');
        }
        
        return redirect()->back()->with('error', 'You cannot create a new admin since you are not a Supper admin.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $check_email = User::where('email', $request->email)->count();
        if($check_email > 0){
            Session::flash('error', 'The email is already registered with us!');
            return redirect()->back();
        }
        $slug = str_slug(ucwords($request->name));
        $check = User::withTrashed()->where('slug', $slug)->count();
        $user = User::create([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'is_verified' => $request->is_verified,
            'slug' => $slug,
        ]);
        if($check > 0){
            $user->slug = $slug . $user->id;
            $user->save();
        }
        return redirect()->route('users.index')->with('success', 'You successfully added the user.');
         
    }

    public function admin_store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if(Auth::user()->type == 'supper'){

            $check_email = User::where('email', $request->email)->count();
            if($check_email > 0){
                Session::flash('error', 'The email is already registered!');
                return redirect()->back();
            }
            if($request->supper == true){
                $type = 'supper';
            }
            else{
                $type = 'ordinary';
            }
            $slug = str_slug(ucwords($request->name));
            $check = User::withTrashed()->where('slug', $slug)->count();
            $admin = User::create([
                'name' => ucwords($request->name),
                'email'=> $request->email,
                'type'=> $type,
                'slug'=> $slug,
            ]);
            
            if($check > 0){
                $user->slug = $slug . $user->id;
                $user->save();
            }
    
            Session::flash('success', 'You successfully added an admin.');
            return redirect()->route('admin_index');
        }

        Session::flash('error', 'You cannot add an admin since you are not a Supper Admin!');
        return redirect()->back();
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        try{
            $user = User::where('slug', $slug)->first();
        }
        catch(QueryException $e){
            Session::flash('error', 'Couldn\'t find user! Please try again.');
            return redirect()->back();
        }
        if($user == null){
            Session::flash('error', 'Couldn\'t find user! Please try again.');
            return redirect()->back();
        }
        return view('admin.users.show')->with('user', $user);
    }

    public function show_by_id($id)
    {
        //
        try{
            $user = User::withTrashed()->where('id', $id)->first();
        }
        catch(QueryException $e){
            Session::flash('error', 'Couldn\'t find user! Please try again.');
            return redirect()->back();
        }
        if($user == null){
            Session::flash('error', 'Couldn\'t find user! Please try again.');
            return redirect()->back();
        }
        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
        $user = User::where('slug', $slug)->first();
        if(Auth::user()->type == 'supper' || Auth::user()->slug == $slug || (Auth::user()->type == 'ordinary' && $user->type == 'user')){
            return view('admin.users.edit')->with('user', $user);
        }
        if(Auth::user()->type == 'ordinary')
            Session::flash('error', 'You are not allowed to edit other admins\' info unless you are a Supper Admin!');
        if(Auth::user()->type == 'user')
            Session::flash('error', 'You are not allowed to edit other users\' info unless you are an Admin!');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        if(!$request->hasFile('avatar') && $request->has('avatar')){
            return redirect()->back()->with('error','Image not supported');
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = User::where('slug', $slug)->first();
        if(Auth::user()->type == 'supper' || Auth::user()->slug == $slug || (Auth::user()->type == 'ordinary' && $user->type == 'user')){
            if($request->password != ''){
                if($request->password == $request->confirm_password){
                    $user->password = bcrypt($request->password);
                }
                else{
                    Session::flash('error', 'Confirmation password and the password do not match.');
                    return redirect()->back();
                }
            }             
            if($request->has('avatar')){
                $old_avatar = $user->avatar;
                $avatar = $request->avatar;
                if($old_avatar != 'uploads/users/avatar.png'){
                    File::delete($old_avatar);
                }
                $avatar_name = time() . $avatar->getClientOriginalName();
                $avatar_new_name = 'uploads/users/' . $avatar_name;
                $new_avatar = Image::make($avatar->getRealPath())->resize(500, 500);
                $new_avatar->save(public_path($avatar_new_name));
                $avatar = $avatar_new_name;
                $user->avatar = $avatar;
            }

            if($request->phone != ''){
                $user->phone = $request->phone;
            }

            $user->name = ucwords($request->name);
            $user->email = $request->email;
            if($user->type != 'user'){
                if($request->supper == true){
                    $type = 'supper';
                }
                else{
                    $type = 'ordinary';
                }
                if(Auth::user()->type == 'supper'){
    
                    if($request->supper == false && User::where('type', 'supper')->count() == 1 && $user->type == 'supper'){
                        Session::flash('error', 'Sorry, you are the ONLY REMAINING supper admin!');
                        return redirect()->back();
                    }
        
                    $user->type = $type;
                    
                }
                elseif($user->type != $type){
                    Session::flash('error', 'You cannot change your supper-admin status since you are not a supper admin!');
                    return redirect()->back();
                }
            }


            $result = $user->save();

            if($result){
                Session::flash('success', 'You successifully updated the admin profile.');
                return redirect()->route('users.show', ['slug' => $slug]);
            }

            Session::flash('error', 'You could not update the admin profile.');
            return redirect()->route('users.index');
        }

        Session::flash('error', 'You are not allowed to edit other users\' info unless you are a Supper Admin!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        try{
            $user = User::where('slug', $slug)->first();
        }
        catch(QueryException $ex){
            Session::flash('error', 'Admin/User could not be found!');
            return redirect()->back();
        }
        
        if(Auth::user()->type == 'supper' || Auth::user()->slug == $slug || (Auth::user()->type == 'ordinary' && $user->type == 'user')){
            if(User::where('type', 'supper')->count() == 1 && Auth::user()->type == 'supper'){
                Session::flash('error', 'Sorry, you are the ONLY REMAINING supper admin! Make someone else a supper admin then exit.');
                return redirect()->back();
            }
            $avatar = $user->avatar;
            // if($avatar != 'uploads/users/avatar.png'){
            //     File::delete($avatar);
            // }
            $type = $user->type;
            $user->delete();
            Session::flash('success', 'Admin/User removed successfully');
            if($type == 'user')
                return redirect()->route('users.index');
            return redirect()->route('admin_index');
        }
        Session::flash('error', 'Admin/User could not be removed! Task only allowed to Supper Admin!');
        return redirect()->back();
    }

    public function trashed_users(){
        $users = User::onlyTrashed()->where('type', 'user')->get();
        return view('admin.users.trashed')->with('user_type', 'User')->with('users', $users);
    }

    public function trashed_admins(){
        $admins = User::onlyTrashed()->where('type', '!=', 'user')->get();
        return view('admin.users.trashed')->with('user_type', 'Admin')->with('users', $admins);
    }
    
    public function restore($slug){
        $user = User::onlyTrashed()->where('slug', $slug)->first();
        if($user == null){
            Session::flash('error', 'Admin/User could not be found in the trash!');
            return redirect()->back();
        }
        if(Auth::user()->type == 'supper' || Auth::user()->slug == $slug || (Auth::user()->type == 'ordinary' && $user->type == 'user')){
            $user->restore();
            Session::flash('success', $user->name . ' restored successfully');
            if($user->type == 'user')
                return redirect()->route('users.index');
            return redirect()->route('admin_index');
        }
        Session::flash('error', 'Admin could not be restored! Task only allowed to Supper Admin!');
        return redirect()->back();

    }

    public function p_destroy($slug)
    {
        //
        try{
            $user = User::withTrashed()->where('slug', $slug)->first();
        }
        catch(QueryException $ex){
            Session::flash('error', 'Admin/User could not be found!');
            return redirect()->back();
        }
        if(Auth::user()->type == 'supper' || Auth::user()->slug == $slug || (Auth::user()->type == 'ordinary' && $user->type == 'user')){
            if(User::where('type', 'supper')->count() == 1 && Auth::user()->type == 'supper'){
                Session::flash('error', 'Sorry, you are the ONLY REMAINING supper admin! Make someone else a supper admin then exit.');
                return redirect()->back();
            }
            $avatar = $user->avatar;
            if($avatar != 'uploads/users/avatar.png'){
                File::delete($avatar);
            }
            $type = $user->type;
            $user->forceDelete();
            Session::flash('success', 'Admin/User successfully removed permanently!');
            if($type == 'user')
                return redirect()->route('users.index');
            return redirect()->route('admin_index');
        }
        Session::flash('error', 'Admin/User could not be permanently removed! Task only allowed to Supper Admin!');
        return redirect()->back();
    }
}
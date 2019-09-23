<?php

namespace App\Http\Controllers;


use App\User;
use File;
use Image;
use Session;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_index(Request $request)
    {
        $admins = User::where('type', '!=', 'user')->get();
        if ($request->wantsJson()) {
            return response()->json($admins, 200);
        }
        return view('admin.users.index')->with('users', $admins)->with('user_type', 'Admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_admin()
    {
        //
        if (Auth::user()->type == 'super') {
            return view('admin.users.add_admin');
        }

        return redirect()->back()->with('error', 'You cannot create a new admin since you are not a Super admin.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function admin_store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if (Auth::user()->type == 'super') {

            $check_email = User::where('email', $request->email)->count();
            if ($check_email > 0) {
                Session::flash('error', 'The email is already registered!');
                return redirect()->back();
            }
            if ($request->super == true) {
                $type = 'super';
            } else {
                $type = 'ordinary';
            }
            $slug = str_replace('/', '-', str_slug($request->name));
            $check = User::withTrashed()->where('slug', $slug)->count();
            $admin = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'type' => $type,
                'slug' => $slug,
                'is_verified' => true,
            ]);
            if ($check > 0) {
                $admin->slug = str_replace('/', '-', $slug . $admin->id);
                $admin->save();
            }
            if ($request->wantsJson()) {
                return response()->json(['admin_added' => true], 201);
            } else {
                Session::flash('success', 'You successfully added an admin.');
                return redirect()->route('admin_index');
            }
        }

        if ($request->wantsJson()) {
            return response()->json(['admin_added' => false], 401);
        } else {
            Session::flash('error', 'You cannot add an admin since you are not a Super Admin!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_show($slug, Request $request)
    {
        //
        try {
            $user = User::where('slug', $slug)->first();
        } catch (QueryException $e) {
            Session::flash('error', 'Couldn\'t find user! Please try again.');
            return redirect()->back();
        }
        if ($user == null) {
            Session::flash('error', 'Couldn\'t find user! Please try again.');
            return redirect()->back();
        }
        if ($request->wantsJson()) {
            return response()->json($user, 200);
        }

        return view('admin.users.show')->with('user', $user);
    }

    public function show_by_id($id)
    {
        //
        try {
            $user = User::withTrashed()->where('id', $id)->first();
        } catch (QueryException $e) {
            Session::flash('error', 'Couldn\'t find user! Please try again.');
            return redirect()->back();
        }
        if ($user == null) {
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
        if (Auth::user()->type == 'super' || Auth::user()->slug == $slug || (Auth::user()->type == 'ordinary' && $user->type == 'user')) {
            return view('admin.users.edit')->with('user', $user);
        }
        if (Auth::user()->type == 'ordinary')
            Session::flash('error', 'You are not allowed to edit other admins\' info unless you are a Super Admin!');
        if (Auth::user()->type == 'user')
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
        if (!$request->hasFile('avatar') && $request->has('avatar')) {
            return redirect()->back()->with('error', 'Image not supported');
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'old_password' => 'required',
        ]);
        $user = User::where('slug', $slug)->first();
        if (!\Hash::check($request->old_password, Auth::user()->password)) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'error' => 'Your current password is wrong.'
                ]);
            } else {
                return redirect()->back()->with('error', 'Your current password is wrong.');
            }
        }
        if (Auth::user()->type == 'super' || Auth::user()->slug == $slug || (Auth::user()->type == 'ordinary' && $user->type == 'user')) {
            if ($request->password != '') {
                if ($request->password == $request->confirm_password) {
                    $user->password = bcrypt($request->password);
                } else {
                    if ($request->wantsJson()) {
                        return response()->json([
                            'status' => false,
                            'error' => 'Confirmation password and the password do not match.'
                        ]);
                    } else {
                        Session::flash('error', 'Confirmation password and the password do not match.');
                        return redirect()->back();
                    }
                }
            }
            // if ($request->has('avatar')) {
            //     $old_avatar = $user->avatar;
            //     $avatar = $request->avatar;
            //     if ($old_avatar != 'uploads/users/avatar.png') {
            //         File::delete($old_avatar);
            //     }
            //     $avatar_name = time() . $avatar->getClientOriginalName();
            //     $avatar_new_name = 'uploads/users/' . $avatar_name;
            //     $new_avatar = Image::make($avatar->getRealPath())->resize(500, 500);
            //     $new_avatar->save($avatar_new_name);
            //     $avatar = $avatar_new_name;
            //     $user->avatar = $avatar;
            // }

            if ($request->phone != '') {
                $user->phone = $request->phone;
            }

            if (User::where('email', $request->email)->where('email', '!=', $user->email)->count() > 0) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => false,
                        'error' => 'Sorry The record already exists'
                    ]);
                } else {
                    return redirect()->back()->with('error', 'Sorry The record already exists');
                }
            }

            // Require verification of new email and send EmailVerificationNotification.
            if ($user->email != $request->email) {
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
            }
            $user->name = $request->name;
            $user->email = $request->email;
            if ($user->type != 'user') {
                if ($request->super == true) {
                    $type = 'super';
                } else {
                    $type = 'ordinary';
                }
                if (Auth::user()->type == 'super') {

                    if ($request->super == false && User::where('type', 'super')->count() == 1 && $user->type == 'super') {
                        if ($request->wantsJson()) {
                            return response()->json([
                                'status' => false,
                                'error' => 'Sorry, you are the ONLY REMAINING super admin!'
                            ]);
                        } else {
                            Session::flash('error', 'Sorry, you are the ONLY REMAINING super admin!');
                            return redirect()->back();
                        }
                    }

                    $user->type = $type;
                } elseif ($user->type != $type) {
                    if ($request->wantsJson()) {
                        return response()->json([
                            'status' => false,
                            'error' => 'You cannot change your super-admin status since you are not a super admin!'
                        ]);
                    } else {
                        Session::flash('error', 'You cannot change your super-admin status since you are not a super admin!');
                        return redirect()->back();
                    }
                }
            }


            $result = $user->save();

            if ($result) {
                if ($request->wantsJson()) {
                    if(Auth::user()->slug == $slug){
                        return response()->json([
                            'user' => $user,
                            'status' => true,
                            'success' => 'You successfully updated the users profile.'
                        ], 200);
                    }
                    else {
                        return response()->json([
                            'status' => true,
                            'success' => 'You successfully updated the users profile.'
                        ], 200);
                    }

                } else {
                    Session::flash('success', 'You successfully updated the users profile.');
                    return redirect()->route('users.show', ['slug' => $slug]);
                }
            }
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'error' => 'You could not update the users profile.'
                ]);
            } else {
                Session::flash('error', 'You could not update the users profile.');
                return redirect()->route('users.index');
            }
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => false,
                'error' => 'You are not allowed to edit other users\' info unless you are a Super Admin! '
            ]);
        } else {
            Session::flash('error', 'You are not allowed to edit other users\' info unless you are a Super Admin!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.     Temporally removal
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, Request $request)
    {
        try {
            $user = User::where('slug', $slug)->first();
        } catch (QueryException $ex) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'error' => 'Admin could not be found!'
                ]);
            } else {
                Session::flash('error', 'Admin/User could not be found!');
                return redirect()->back();
            }
        }

        if (Auth::user()->type == 'super' || Auth::user()->slug == $slug || (Auth::user()->type == 'ordinary' && $user->type == 'user')) {
            if (User::where('type', 'super')->count() == 1 && Auth::user()->type == 'super') {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => false,
                        'error' => 'Sorry, you are the ONLY REMAINING super admin! Make someone else a super admin then exit.'
                    ]);
                } else {
                    Session::flash('error', 'Sorry, you are the ONLY REMAINING super admin! Make someone else a super admin then exit.');
                    return redirect()->back();
                }
            }
            // $avatar = $user->avatar;
            // if($avatar != 'uploads/users/avatar.png'){
            //     File::delete($avatar);
            // }
            $type = $user->type;
            $user->delete();
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => true,
                    'success' => 'Admin removed successfully'
                ]);
            } else {
                Session::flash('success', 'Admin/User removed successfully');
                if ($type == 'user')
                    return redirect()->route('users.index');

                return redirect()->route('admin_index');
            }
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => false,
                'error' => 'Admin could not be removed! Task only allowed to Super Admin!'
            ]);
        } else {
            Session::flash('error', 'Admin/User could not be removed! Task only allowed to Super Admin!');
            return redirect()->back();
        }
    }

    public function trashed_users()
    {
        $users = User::onlyTrashed()->where('type', 'user')->get();
        return view('admin.users.trashed')->with('user_type', 'User')->with('users', $users);
    }

    public function trashed_admins()
    {
        $admins = User::onlyTrashed()->where('type', '!=', 'user')->get();
        return view('admin.users.trashed')->with('user_type', 'Admin')->with('users', $admins);
    }

    public function restore($slug)
    {
        $user = User::onlyTrashed()->where('slug', $slug)->first();
        if ($user == null) {
            Session::flash('error', 'Admin/User could not be found in the trash!');
            return redirect()->back();
        }
        if (Auth::user()->type == 'super' || Auth::user()->slug == $slug || (Auth::user()->type == 'ordinary' && $user->type == 'user')) {
            $user->restore();
            Session::flash('success', $user->name . ' restored successfully');
            if ($user->type == 'user')
                return redirect()->route('users.index');
            return redirect()->route('admin_index');
        }
        Session::flash('error', 'Admin could not be restored! Task only allowed to Super Admin!');
        return redirect()->back();
    }

    // destroy permanently
    public function p_destroy($slug)
    {
        //
        try {
            $user = User::withTrashed()->where('slug', $slug)->first();
        } catch (QueryException $ex) {
            Session::flash('error', 'Admin/User could not be found!');
            return redirect()->back();
        }
        if (Auth::user()->type == 'super' || Auth::user()->slug == $slug || (Auth::user()->type == 'ordinary' && $user->type == 'user')) {
            if (User::where('type', 'super')->count() == 1 && Auth::user()->type == 'super') {
                Session::flash('error', 'Sorry, you are the ONLY REMAINING super admin! Make someone else a super admin then exit.');
                return redirect()->back();
            }
            $avatar = $user->avatar;
            if ($avatar != 'uploads/users/avatar.png') {
                File::delete($avatar);
            }
            $type = $user->type;
            $user->forceDelete();
            Session::flash('success', 'Admin/User successfully removed permanently!');
            if ($type == 'user')
                return redirect()->route('users.index');
            return redirect()->route('admin_index');
        }
        Session::flash('error', 'Admin/User could not be permanently removed! Task only allowed to Super Admin!');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use Validator;
use Hash;
use Auth;
use App\Item;
use Session;

class PagesController extends Controller
{
    public function index(){
        return view('client.index');
    }
    public function faq(){
        return view('client.faq');
    }
    public function contact(){
        return view('client.query');
    }
    public function profile(){
        return view('client.profile');
    }
    public function my_uploads(){
        $items = Item::where('user_id', Auth::user()->id)->paginate(10);
        return view('client.my_uploads')->with('items', $items);
    }
    public function upload(){
        $categories = Category::all();
        return view('client.upload_item')->with('categories', $categories);
    }
    public function update_profile(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if($request->new_password != '' || $request->current_password != '' || $request->confirm_password != ''){
            $this->validate($request, [
                'new_password' => 'required',
                'confirm_password' => 'required',
                'current_password' => 'required',
            ]);
            if(!Hash::check($request->current_password, Auth::user()->password)){
                return redirect()->back()->with('error', 'The current password is incorrect!');
            }
            if($request->new_password == $request->confirm_password){
                Auth::user()->password = bcrypt($request->new_password);
            }
            else{
                Session::flash('error', 'Confirmation password and the password do not match.');
                return redirect()->back();
            }
        }      

        Auth::user()->phone = $request->phone;
        Auth::user()->name = ucwords($request->name);
        Auth::user()->email = $request->email;
        $result = Auth::user()->save();

        if($result){
            Session::flash('success', 'You successifully updated your profile.');
            return redirect()->back();
        }

        Session::flash('error', 'You could not update your profile.');
        return redirect()->back();

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

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
        return view('client.my_uploads');
    }
    public function upload(){
        $categories = Category::all();
        return view('client.upload_item')->with('categories', $categories);
    }
}

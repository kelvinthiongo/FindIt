<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}

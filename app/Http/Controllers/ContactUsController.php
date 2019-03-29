<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactUsController extends Controller
{
    public function store(Request $request)
   {
       $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'subject'=>'required',
        'message' => 'required'
        ]);

        Mail::send('email',
        array(
           'name' => $request->get('name'),
           'email' => $request->get('email'),
           'subject' => $request->get('subject'),
           'user_message' => $request->get('message'),
           'phone' => $request->get('phone')
        ), function($message)
   {
       $message->from($email);
       $message->to('georgenjoroge977@gmail.com', 'Admin')->subject('24 Seven Developers Contact Form');
   });
 
       Contact::create($request->all());
 
       return back()->with('success', 'Thanks for contacting us!');
   }
}

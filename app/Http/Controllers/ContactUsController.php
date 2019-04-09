<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Mail;

class ContactUsController extends Controller
{
    public function query(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
            ]);
        $data = array( 'name' => $request->get('name'), 'email' => $request->get('email'),'subject' => $request->get('subject'), 'phone' => $request->get('phone'), 'user_message' => $request->get('message'));

        Mail::send( 'email', $data, function( $message ) use ($data)
        {
            $message->to( 'georgenjoroge977@gmail.com' )->from( $data['email'])->subject( 'Findit Contact Form' );
        });

        return redirect()->back()->with('success','Query Sent Successfully');
    }
}

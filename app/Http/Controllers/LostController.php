<?php

namespace App\Http\Controllers;

use App\Lost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LostController extends Controller
{
    public function index(){
        $submissions = Lost::all()->get();
        return view('admin.lost.index')->with('submissions', $submissions);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //validate
        $this->validate($request, [
            'category' => 'required',
            'name' => 'required',
            'number' => 'required',
            'email' => 'required | email'
        ]);
        $check = Lost::where('number',$request->number)->count();
        $existing_email = Lost::where('number',$request->number)->first()->email;
        if($check > 0){
            return redirect()->back()->with('error','Sorry the details had already been submitted. We will notify you via ' . $email . ' when we find your item.');
        }
          
        //add lost item
        $lost = Lost::create($request->all());
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        $result  = array('country'=>'', 'city'=>'');
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }

        $lost->ip = $ip;

        $lost->save();
        
        return redirect()->back()->with('success','Document details submited successfully');
    }

    
    public function destroy(Lost $lost)
    {
        //
    }
}

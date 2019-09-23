<?php

namespace App\Http\Controllers;

use App\Lost;
use Illuminate\Http\Request;

class LostController extends Controller
{
    public function index(){
        $submissions = Lost::all();
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
            'number' => 'required',
            'email' => 'required | email'
        ]);
        $check = Lost::where('number',$request->number)->count();
        if($check > 0){
            $existing_email = Lost::where('number',$request->number)->first()->email;
            if ($existing_email == $request->email) {
                return redirect()->back()->with('info','Sorry the details had already been submitted. We will notify you via ' . $existing_email . ' when we find your item.');
            }

        }

        //add lost item
        $lost = Lost::create($request->all());

        $lost->save();

        return redirect()->back()->with('success','Document details submited successfully');
    }

}

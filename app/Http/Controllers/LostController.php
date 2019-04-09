<?php

namespace App\Http\Controllers;

use App\Lost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LostController extends Controller
{
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

        if($check > 0){
            return redirect()->back()->with('error','Sorry the details had already been submitted. We will notify you via email when we find your item.');
        }
          
        //add lost item
        $lost = Lost::create($request->all());
        $lost->save();
        
        return redirect()->back()->with('success','Document details submited successfully');
    }

    
    public function destroy(Lost $lost)
    {
        //
    }
}

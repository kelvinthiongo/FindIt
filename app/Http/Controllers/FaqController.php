<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Notify;



class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faqs.index')->with('faqs', $faqs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create_faq');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required'
        ]);
          
        //create faq
        $faq = Faq::create($request->all());
        $faq->save();
        
        return redirect('/admin/faqs')->with('success','Faq created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit_faq')->with('faq', $faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        //validate
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required'
        ]);
          
        //update faq
        $faq = Faq::create($request->all());
        $faq->save();
        
        return redirect('/admin/faqs')->with('success','Faq updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

       return redirect('admin/faqs')->with('info','Faq Deleted successfully');
    }
}

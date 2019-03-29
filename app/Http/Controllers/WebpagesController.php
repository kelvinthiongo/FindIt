<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webpage;

class WebpagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Webpage::orderBy('name','desc')->get();
        return view('admin.webpages.index')->with('pages',$pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        {
            return view('admin/webpages/add_page');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        //create page
        $page = new Webpage;
        $page->name = $request->input('name');

        $page->save();

        return redirect('/admin/webpages')->with('success','Web Page Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Webpage::find($id);

        return view('admin.webpages.edit_page')->with('page',$page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        //update page
        $page = Webpage::find($id);
        $page->name = $request->input('name');

        $page->save();

        return redirect('/admin/webpages')->with('success','Page edited Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Webpage::find($id);
        
        $page->delete();

        return redirect('/admin/webpages')->with('success','Page Removed Successfully');
    }
}

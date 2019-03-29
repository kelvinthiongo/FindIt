<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Metatag;
use App\Webpage;

class MetatagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Metatag::orderBy('page','desc')->get();
        return view('admin.metatags.index')->with('tags',$tags);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Webpage::orderBy('created_at','desc')->get();
        return view('admin.metatags.add_metatag')->with('pages', $pages);
        
       
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
            'page' => 'required',
            'name' => 'required',
            'content' => 'required'
        ]);

        //create metatag
        $tag = new Metatag;
        $tag->page = $request->input('page');
        $tag->name = $request->input('name');
        $tag->content = $request->input('content');

        $tag->save();

        return redirect('/admin/metatags')->with('success','Meta Tag Added Successfully');

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
        $tag = Metatag::find($id);
        $pages = Webpage::orderBy('created_at','desc')->get();

        return view('admin.metatags.edit_metatag')->with('tag' , $tag)->with('pages', $pages);
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
            'page' => 'required',
            'name' => 'required',
            'content' => 'required'
        ]);

        //update metatag
        $tag = Metatag::find($id);
        $tag->page = $request->input('page');
        $tag->name = $request->input('name');
        $tag->content = $request->input('content');

        $tag->save();

        return redirect('/admin/metatags')->with('success','Meta Tag Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Metatag::find($id);
        
        $tag->delete();

        return redirect('/admin/metatags')->with('success','Meta Tag Deleted Successfully');
    }
}

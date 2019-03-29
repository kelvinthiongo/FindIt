<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Auth;
use Session;
use Image;
use File;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders = Slider::all();
        return view('admin.sliders.index')->with('sliders', $sliders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->hasFile('image') && $request->has('image')){
            return redirect()->back()->with('error','Image not supported');
        }
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required',
            'image' => 'required',
            'message' => 'required',
            'link_message' => 'required',
        ]);
        $image = $request->image;
        $image_name =  time() . $image->getClientOriginalName();
        $image_new_name = 'uploads/sliders/' . $image_name;
        $new_image = Image::make($image->getRealPath())->resize(1800, 600);
        $new_image->save(public_path($image_new_name));
        $slug = str_slug($request->title);

        $image = $image_new_name; //Storing the public path for the image for record in the database

        $slider = Slider::create([
            'title' => $request->title,
            'message' => $request->message,
            'image' => $image,
            'link_message' => $request->link_message,
            'link' => $request->link,
        ]);
        if(Slider::where('slug', $slug)->count() != 0){
            $slider->slug = str_slug($request->title . $slider->id);
        }
        else{
            $slider->slug = $slug;
        }
        $slider->save();

        Session::flash('success', 'You successifully added a slider.');
        return redirect()->route('sliders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $slider = Slider::where('slug', $slug)->first();
        return view('admin.sliders.show')->with('slider', $slider);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
        $slider = Slider::where('slug', $slug)->first();
        return view('admin.sliders.edit')->with('slider', $slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        if(!$request->hasFile('image') && $request->has('image')){
            return redirect()->back()->with('error','Image not supported');
        }
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required',
            'image' => 'required',
            'message' => 'required',
            'link_message' => 'required',
        ]);
        $slider = Slider::where('slug', $slug)->first();
        $slider->title = $request->title;
        $slider->message = $request->message;
        $slider->link_message = $request->link_message;
        $slider->link = $request->link;
        if($request->hasFile('image')){
            $image = $request->image;
            $image_old = $slider->image;
            $image_name =  time() . $image->getClientOriginalName();
            $image_new_name = 'uploads/sliders/' . $image_name;
            $new_image = Image::make($image->getRealPath())->resize(1920, 630);
            $new_image->save(public_path($image_name));
            $slider->image = $image_new_name;
            File::delete($image_old);
        }
        $slider->save();
        Session::flash('success', 'You successifully edited the slider\'s details.');
        return redirect()->route('sliders.index', ['slug', $slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        try{
            $slider = Slider::where('slug', $slug)->first();
        }
        catch(QueryException $ex){
            Session::flash('error', 'Slider could not be found!');
            return redirect()->back();
        }
        $image = $slider->image;
        File::delete($image);
        $slider->delete();
        Session::flash('success', 'Slider removed successifully');
        return redirect()->route('sliders.index');
    }
}
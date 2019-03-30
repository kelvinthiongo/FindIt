<?php

namespace App\Http\Controllers;

use App\Item;
use Image;

use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //for found items
    {
        $items = Item::where('status', 'found')->get();
        return view('admin.items.index')->with('items', $items)->with('status', 'Found');
    }
     
    public function lost_index() //for lost items
    {
        $items = Item::where('status', 'lost')->get();
        return view('admin.items.index')->with('items', $items)->with('status', 'Lost');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.items.create');
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
            'f_name' => 'required',
            'l_name' => 'required',
            'image' => 'required',
            'number' => 'required',
            'place_to_get' => 'required',
        ]);

        if($request->has('image')){
            $old_image = $item->image;
            $image = $request->image;
            if($old_image != 'uploads/items/image.png'){
                File::delete($old_image);
            }
            $image_name = time() . $image->getClientOriginalName();
            $image_new_name = 'uploads/items/' . $image_name;
            $new_image = Image::make($image->getRealPath())->resize(500, 500);
            $new_image->save(public_path($image_new_name));
            $image = $image_new_name;
            $item->image = $image;
        }

        $item = Item::create([
            'f_name' => $request->f_name,
            's_name' => $request->s_name,
            'l_name'=> $request->l_name,
            'number'=> $request->number,
            'category_id'=> $request->category_id,
            'user_id'=> Auth::user()->id,
            'description'=> $request->description,
            'status'=> $request->status,
            'place_found'=> $request->place_found,
            'place_to_get'=> $request->place_to_get,
            'lf_date'=> $request->lf_date,
        ]);

        $item->slug = $item->id . $item->f_name . $item->s_name . $item->l_name;
        $item->save();

        return redirect()->back()->with('success', 'You successfully uploaded the item'); //to be changed
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
        if(!$request->hasFile('image') && $request->has('image')){
            return redirect()->back()->with('error','Image not supported');
        }

        if(Auth::user()->id != $item->user_id || Auth::user()->type != "user")
        {
            return redirect()->back()->with('error', 'You don\'t have the privileges to edit this item');
        }        

        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'number' => 'required',
            'place_to_get' => 'required',
        ]);

        if($request->has('image')){
            $old_image = $item->image;
            $image = $request->image;
            if($old_image != 'uploads/items/image.png'){
                File::delete($old_image);
            }
            $image_name = time() . $image->getClientOriginalName();
            $image_new_name = 'uploads/items/' . $image_name;
            $new_image = Image::make($image->getRealPath())->resize(500, 500);
            $new_image->save(public_path($image_new_name));
            $image = $image_new_name;
            $item->image = $image; //Tonbe saved down there
        }


        $item = Item::create([
            'f_name' => $request->f_name,
            's_name' => $request->s_name,
            'l_name'=> $request->l_name,
            'number'=> $request->number,
            'category_id'=> $request->category_id,
            'user_id'=> Auth::user()->id,
            'description'=> $request->description,
            'status'=> $request->status,
            'place_found'=> $request->place_found,
            'place_to_get'=> $request->place_to_get,
            'lf_date'=> $request->lf_date,
        ]);

        $item->slug = $item->id . $item->f_name . $item->s_name . $item->l_name;
        $item->save(); //saving any pending changes

        if(Auth::user()->type != "user"){
            $item->approved = Auth::user()->id;
            $item->save();
            return redirect()->back()->with('success', 'You successfully updated and APPROVED the item!'); //to be changed
        }
        return redirect()->back()->with('success', 'You successfully updated the item!'); //to be changed
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}

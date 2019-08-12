<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;


use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function find(){
        return view('client.submit');
    }
    
    public function index(){
        $items = Item::paginate(200);
        return view('admin.items.index')->with('items', $items);
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.items.create')->with('categories', $categories);
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
            'category_id' => 'required',
        ]);
        if($request->name == '' && $request->number == ''){
            return redirect()->back()->with('error', 'Number and name fields cannot be both empty.');
        }
        $category = Category::find($request->category_id)->name;

        Item::create([
            'number'=> $request->number,
            'category'=> $category,
            'category_id'=> $request->category_id,
            'name'=> $request->name,
        ]);

        return redirect()->back()->with('success', 'You successfully uploaded the document.');
    }

    public function edit(Item $item)
    {
        return view('client.items.edit')->with('item', $item)->with('categories', Category::all());
    }

    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'category_id' => 'required',
        ]);
        if($request->name == '' && $request->number == ''){
            return redirect()->back()->with('error', 'Number and name fields cannot be both empty.');
        }
        $category = Category::find($request->category_id)->name;

        $item->number = $request->number;
        $item->category = $category;
        $item->category_id = $request->category_id;
        $item->name = $request->name;

        $item->save();

        return redirect()->back()->with('success', 'You successfully updated the document.');
    }




    public function destroy(Item $item)
    {
        $item->forceDelete();
        return redirect()->back()->with('success', 'Delete successful');
    }

}

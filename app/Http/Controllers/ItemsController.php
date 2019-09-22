<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;


use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function check(Request $request)
    {

        if ($request->has('number')) {
            $this->validate($request, [
                'category' => 'required',
                'number' => 'required'
            ]);
            $item = $request->number;
            $match= Item::where('category_id', $request->category)->where('number', $request->number)->first();
            if($match != null){
                $status = true;
                $category = $match->category;
                $collection_point = $match->collection_point;
                $match_no = Item::where('category_id', $request->category)->where('number', $request->number)->count();
            }
            else{
                $status = false;
                $match_no = 0;
                $category = null;
                $collection_point = null;
            }

        } else if ($request->has('name')) {
            $this->validate($request, [
                'category' => 'required',
                'name' => 'required'
            ]);
            $item = $request->name;
            $match= Item::where('category_id', $request->category)->where('number', $request->number)->first();
            if($match != null){
                $status = true;
                $category = $match->category;
                $collection_point = $match->collection_point;
                $match_no = Item::where('category_id', $request->category)->where('number', $request->number)->count();
            }
            else{
                $status = false;
                $match_no = 0;
                $category = null;
                $collection_point = null;
            }

        }
        $arr = [
            'status' => $status,
            'match' => $match_no,
            'item'  => $item,
            'category' => $category,
            'collection_point' => $collection_point,
        ];

        return response()->json($arr);
    }

    public function find()
    {
        $categories = Category::all();
        return view('client.submit')->with('categories', $categories);
    }
    public function app()
    {
        return view('client.app');
    }

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $items = Item::orderBy('created_at', 'DESC')->get();
            return response()->json($items, 200);
        } else {
            $items = Item::paginate(200);
            return view('admin.items.index')->with('items', $items);
        }
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.items.create')->with('categories', $categories);
    }

    public function collected()
    { }

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
            'collection_point' => 'required',
        ]);
        if ($request->name == '' && $request->number == '') {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'error' => 'Number and name fields cannot be both empty.'
                ]);
            } else {
                return redirect()->back()->with('error', 'Number and name fields cannot be both empty.');
            }
        }
        $category = Category::find($request->category_id)->name;

        Item::create([
            'number' => $request->number,
            'category' => $category,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'collection_point' => $request->collection_point,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'success' => 'You successfully uploaded the document.'
            ]);
        } else {
            return redirect()->back()->with('success', 'You successfully uploaded the document.');
        }
    }

    public function edit(Item $item)
    {
        return view('admin.items.edit')->with('item', $item)->with('categories', Category::all());
    }
    public function show(Item $item, Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json($item, 200);
        } else {
            return view('admin.items.edit')->with('item', $item)->with('categories', Category::all());
        }
    }

    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'collection_point' => 'required',
        ]);
        if ($request->name == '' && $request->number == '') {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'error' => 'Number and name fields cannot be both empty.'
                ]);
            } else {
                return redirect()->back()->with('error', 'Number and name fields cannot be both empty.');
            }
        }
        $category = Category::find($request->category_id)->name;

        $item->number = $request->number;
        $item->collection_point = $request->collection_point;
        $item->category = $category;
        $item->category_id = $request->category_id;
        $item->name = $request->name;

        $item->save();
        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'success' => 'You successfully updated the document.'
            ]);
        } else {
            return redirect()->back()->with('success', 'You successfully updated the document.');
        }
    }




    public function destroy(Item $item)
    {
        $item->forceDelete();
        return redirect()->back()->with('success', 'Delete successful');
    }
}

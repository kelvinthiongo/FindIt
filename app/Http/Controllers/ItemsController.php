<?php

namespace App\Http\Controllers;

use App\Item;
use App\Lost;
use Mail;
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
            $category = Item::where('category_id', $request->category)->where('number', $request->number)->first()->category;
            $collection_point = Item::where('category_id', $request->category)->where('number', $request->number)->first()->collection_point;
            $match = Item::where('category_id', $request->category)->where('number', $request->number)->count();
            $item = $request->number;
        } else if ($request->has('name')) {
            $this->validate($request, [
                'category' => 'required',
                'name' => 'required'
            ]);
            $category = Item::where('category_id', $request->category)->where('name', 'like', $request->name)->first()->category;
            $collection_point = Item::where('category_id', $request->category)->where('name', 'like', $request->name)->first()->collection_point;
            $match = Item::where('category_id', $request->category)->where('name', 'like', $request->name)->count();
            $item = $request->name;
        }
        $arr = [
            'match' => $match,
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

    public function index()
    {
        $items = Item::paginate(200);
        return view('admin.items.index')->with('items', $items);
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
            return redirect()->back()->with('error', 'Number and name fields cannot be both empty.');
        }
        $category = Category::find($request->category_id)->name;

        $item = Item::create([
            'number' => $request->number,
            'category' => $category,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'collection_point' => $request->collection_point,
        ]);

        try {
            $check = Lost::where('number', $item->number)->count();
            if ($check > 0) {
                $losts = Lost::where('number', $item->number)->get();
                foreach ($losts as $lost) {
                    $data = ['name' => $item->name, 'email' => $lost->email, 'number' => $item->number];

                    Mail::send('mailings.item_found', $data, function ($message) use ($data) {
                        $message->to($data['email'])->from('no-reply@24seven.co.ke')->subject('Lost Document Found');
                    });
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect()->back()->with('success', 'You successfully uploaded the document.');
    }

    public function edit(Item $item)
    {
        return view('admin.items.edit')->with('item', $item)->with('categories', Category::all());
    }

    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'collection_point' => 'required',
        ]);
        if ($request->name == '' && $request->number == '') {
            return redirect()->back()->with('error', 'Number and name fields cannot be both empty.');
        }
        $category = Category::find($request->category_id)->name;

        $item->number = $request->number;
        $item->collection_point = $request->collection_point;
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

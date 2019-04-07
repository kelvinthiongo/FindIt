<?php

namespace App\Http\Controllers;

use App\Item;
use Image;
use Session;
use File;
use Auth;
use App\Category;

use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function __construct()
    {
        // Middleware only applied to these methods
        $this->middleware('auth', ['only' => [
            'create', 'store', 'edit', 'destroy', 'update' 
        ]]);

        $this->middleware('admin', ['only' => [
            'lost_index'
        ]]);
    }

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

    public function search_item(Request $request){
        $categories = Category::all();

        $this->validate($request, [
            'content' => 'required | max:50'
        ]);
        $categories = Category::all();
        $query = $request->all();
        $items = Item::search($query['content'], null, true); // $items = Item::search('Nairobi, null, true, true);
        $count = $items->count();
        $items = $items->paginate(10);
        $pagination = $items->appends($query);
        return view('client.items.items')->with('items', $items)
                                        ->with('status', 'Found')
                                        ->with('count', $count)
                                        ->with('categories', $categories)
                                        ->withQuery($query)
                                        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('client.items.upload_item')->with('categories', $categories);
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
        if(Auth::user()->is_verified){
            $this->validate($request, [
                'number' => 'required',
                'category_id' => 'required',
            ]);
            if($request->place_to_get == '')
                $place_to_get = Auth::user()->name;
            else
                $place_to_get = ucwords($request->place_to_get);
        }
        else{
            $this->validate($request, [
                'f_name' => 'required',
                'l_name' => 'required',
                'image' => 'required',
                'number' => 'required',
                'category_id' => 'required',
                'place_to_get' => 'required',
            ]);
            $place_to_get = ucwords($request->place_to_get);
        }

        $item = Item::create([
            'number'=> $request->number,
            'category_id'=> $request->category_id,
            'user_id'=> Auth::user()->id,
            'place_to_get'=> $place_to_get,
        ]);

        if(Auth::user()->type == 'ordinary' || Auth::user()->type == 'supper')
            $item->approved = Auth::user()->id;

        if($request->f_name != '')
            $item->f_name = ucwords($request->f_name);
        if($request->s_name != '')
            $item->s_name = ucwords($request->s_name);
        if($request->l_name != '')
            $item->l_name = ucwords($request->l_name);
        if($request->description != '')
            $item->description = $request->description;
        if($request->status != '')
            $item->status = $request->status;
        if($request->place_found != '')
            $item->place_found = ucwords($request->place_found);
        if($request->lf_date != '')
            $item->lf_date = $request->lf_date;

        if($request->has('image')){
            foreach($request->file('image') as $image){
                $image_name = time() . $image->getClientOriginalName();
                $image_new_name = 'uploads/items/' . $image_name;
                $new_image = Image::make($image->getRealPath())->resize(1837, 1206);
                $new_image->save(public_path($image_new_name));

                $image_data[] = $image_new_name; //Storing the public path for the image for record in the database
            }
            $item->image = json_encode($image_data);
        }
        $item->slug = $item->id . '-' . $item->f_name . '-' . $item->s_name . '-' . $item->l_name . '-' . $item->number;
        $item->save();
        if(Auth::user()->is_verified){
            return redirect()->back()->with('success', 'You successfully uploaded the item.');
        }
        return redirect()->route('landing')->with('success', 'You successfully uploaded the item.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('client.items.show_item')->with('item', $item);
    }
    
    
    public function report(Request $request, Item $item)
    {
        $item->reports = $item->reports + 1;
        $item->save();
        return redirect()->back()->with('success', 'Item reported to the management. We will do something about it. Thanks!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        if(Auth::user()->id != $item->user->id && Auth::user()->type == 'user'){
            return redirect()->back()->with('error', 'Sorry, you lack the privileges to edit this item.');
        }
        return view('client.items.edit')->with('item', $item)->with('categories', Category::all());
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
        if(!$request->hasFile('image') && $request->has('image')){
            return redirect()->back()->with('error','Image not supported');
        }

        if(Auth::user()->id != $item->user->id && Auth::user()->type == 'user')
        {
            return redirect()->back()->with('error', 'You don\'t have the privileges to edit this item');
        }        

        if(Auth::user()->is_verified){
            $this->validate($request, [
                'number' => 'required',
                'category_id' => 'required',
            ]);
            if(!$request->has('place_to_get'))
                $place_to_get = Auth::user()->name;
            else
                $place_to_get = ucwords($request->place_to_get);
        
        }
        else{
            $this->validate($request, [
                'f_name' => 'required',
                'l_name' => 'required',
                'number' => 'required',
                'category_id' => 'required',
                'place_to_get' => 'required',
            ]);

            
            $place_to_get = ucwords($request->place_to_get);
    
        }

        $item->number = $request->number;
        $item->category_id = $request->category_id;
        if(Auth::user()->type == 'ordinary' || Auth::user()->type == 'supper')
            $item->approved = Auth::user()->id;

        if($request->f_name != '')
            $item->f_name = ucwords($request->f_name);
        if($request->s_name != '')
            $item->s_name = ucwords($request->s_name);
        if($request->l_name != '')
            $item->l_name = ucwords($request->l_name);
        if($request->description != '')
            $item->description = $request->description;
        if($request->status != '')
            $item->status = $request->status;
        if($request->place_found != '')
            $item->place_found = ucwords($request->place_found);
        if($request->lf_date != '')
            $item->lf_date = $request->lf_date;
        
        if($request->image != null){
            $image_data = json_decode($item->image);
            if($image_data == [0 => "uploads/items/image.jpg"])
                $image_data = [];
            foreach($request->file('image') as $image){
                $image_name =  time() . $image->getClientOriginalName();
                $image_new_name = 'uploads/items/' . $image_name;
                $new_image = Image::make($image->getRealPath())->resize(1837, 1206);
                $new_image->save($image_new_name);
        
                $image_data[] = $image_new_name; //Storing the public path for the image for record in the database
            }

            $item->image = json_encode($image_data);
        }
        $item->slug = $item->id . '-' . $item->f_name . '-' . $item->s_name . '-' . $item->l_name . '-' . $item->number;
 
        if(Auth::user()->type != "user"){
            $item->approved = Auth::user()->id;
            $item->save();
            return redirect()->route('items.show', ['slug' => $item->slug])->with('success', 'You successfully updated and APPROVED the item!'); //to be changed
        }
        $item->approved = null;
        
        $item->save(); //saving any pending changes

        return redirect()->route('items.show')->with('item' ,$item)->with('success', 'You successfully updated the item!'); //to be changed
    }

    //get all items pending approval
    public function pending(){
        $pendings = Item::where('approved', null)->get();
        dd($pendings);
        return view('admin.items.pending')->with('pendings', $pendings);
        
    }
    //approve a pending item
    public function approve($id){
        
        $item = Item::find($id);
        $item->approved = Auth::user()->id;
        $item->save();
     
        return redirect()->back()->with('success','Item Approved Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $images = json_decode($item->image);
        foreach($images as $image){
            if($image == "uploads/items/image.jpg")
                continue;
            File::delete($image);
        }
        $result = $item->forceDelete();
        if($result){
            Session::flash('success', 'Item deleted successfully');
            return redirect()->route('uploads');
        }
        Session::flash('error', 'Item could not be deleted.');
        return redirect()->back();
    }

}

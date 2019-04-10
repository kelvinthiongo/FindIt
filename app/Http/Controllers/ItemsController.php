<?php

namespace App\Http\Controllers;

use App\Item;
use Image;
use Session;
use File;
use Auth;
use App\User;
use App\Category;
use App\Lost;
use Mail;


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
            'lost_index', 'index', 'pending', 'approved', 'approve', 'trashed'
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
        $items = Item::where('approved', '!=', null)->orderBy('created_at', 'DESC')->search($query['content'], null, true); // $items = Item::search('Nairobi, null, true, true);
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
                'image' => 'mimes:jpeg,jpg,png,git,WebP',
            ]);
            if($request->place_to_get == '')
                $place_to_get = Auth::user()->name;
            else
                $place_to_get = ucwords(strtolower($request->place_to_get));
        }
        else{
            $this->validate($request, [
                'f_name' => 'required',
                'l_name' => 'required',
                'image' => 'required|mimes:jpeg,png,bmp,svg',
                'number' => 'required',
                'category_id' => 'required',
                'place_to_get' => 'required',
            ]);
            $place_to_get = ucwords(strtolower($request->place_to_get));
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
            $item->f_name = ucwords(strtolower($request->f_name));
        if($request->s_name != '')
            $item->s_name = ucwords(strtolower($request->s_name));
        if($request->l_name != '')
            $item->l_name = ucwords(strtolower($request->l_name));
        if($request->description != '')
            $item->description = $request->description;
        if($request->status != '')
            $item->status = $request->status;
        if($request->place_found != '')
            $item->place_found = ucwords(strtolower($request->place_found));
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
        $item->slug = str_slug($item->id . '-' . $item->f_name . '-' . $item->s_name . '-' . $item->l_name . '-' . $item->number);
        $item->save();
        if(Auth::user()->is_verified){
            return redirect()->back()->with('success', 'You successfully uploaded the item.');
        }
        return redirect()->route('uploads')->with('success', 'You successfully uploaded the item.');
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

    public function delete_image(Item $item, $image)
    {   
        if(Auth::user()->id != $item->user->id && Auth::user()->type == 'user'){
            return redirect()->back()->with('error', 'Sorry, you lack the privileges to edit this item.');
        }
        $images = json_decode($item->image);
        if(count($images) == 1)
            return redirect()->back()->with('error', 'You cannot remove the ONLY remaining image! Click edit button to add more images.');
        if($images[$image] != "uploads/items/image.png")
            File::delete($images[$image]);
        $data = [];
        foreach($images as $img){
            if($images[$image] == $img){
                continue;
            }
            $data[] = $img;
        }
        $item->image = json_encode($data);
        $item->save();
        Session::flash('success', 'You successifuly removed the image.');
        return redirect()->back();
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
                'image' => 'mimes:jpeg,jpg,png,git,WebP',
            ]);
            if(!$request->has('place_to_get'))
                $place_to_get = Auth::user()->name;
            else
                $place_to_get = ucwords(strtolower($request->place_to_get));
        
        }
        else{
            $this->validate($request, [
                'f_name' => 'required',
                'l_name' => 'required',
                'number' => 'required',
                'category_id' => 'required',
                'place_to_get' => 'required',
                'image' => 'mimes:jpeg,jpg,png,git,WebP',
            ]);

            
            $place_to_get = ucwords(strtolower($request->place_to_get));
    
        }

        $item->number = $request->number;
        $item->category_id = $request->category_id;
        if(Auth::user()->type == 'ordinary' || Auth::user()->type == 'supper')
            $item->approved = Auth::user()->id;

        if($request->f_name != '')
            $item->f_name = ucwords(strtolower($request->f_name));
        if($request->s_name != '')
            $item->s_name = ucwords(strtolower($request->s_name));
        if($request->l_name != '')
            $item->l_name = ucwords(strtolower($request->l_name));
        if($request->description != '')
            $item->description = $request->description;
        if($request->status != '')
            $item->status = $request->status;
        if($request->place_found != '')
            $item->place_found = ucwords(strtolower($request->place_found));
        if($request->lf_date != '')
            $item->lf_date = $request->lf_date;
        
        if($request->image != null){
            $image_data = json_decode($item->image);
            if($image_data == [0 => "uploads/items/image.png"])
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
        $item->slug = str_slug($item->id . '-' . $item->f_name . '-' . $item->s_name . '-' . $item->l_name . '-' . $item->number);
 
        if(Auth::user()->type != "user"){
            $item->approved = Auth::user()->id;
            $item->save();

            $check = Lost::where('number',$item->number)->count();
            if($check > 0){

            dd($item->email);

            return redirect()->back()->with('success','Item Approved Successfully. Additionally the item has been found on the lost items collection, and an email sent to the uploader.');  
            } 
            return redirect()->route('items.show', ['slug' => $item->slug])->with('success', 'You successfully updated and APPROVED the item!'); //to be changed
        }
        $item->approved = null;
        
        $item->save(); //saving any pending changes

        return redirect()->route('items.show', ['slug' => $item->slug])->with('item' ,$item)->with('success', 'You successfully updated the item!'); //to be changed
    }

    //get all items pending approval
    public function pending(){
        $pendings = Item::where('approved', null)->get();
        return view('admin.items.pending')->with('pendings', $pendings);
        
    }
    //get all items pending_ui approval
    public function pending_ui(){
        $pendings = Item::where('approved', null)->paginate(20);
        return view('admin.items.pending_ui')->with('items', $pendings);
        
    }
    //get all approved items
    public function approved(){
        $admins = User::where('type', 'ordinary')->orWhere('type', 'supper')->select('id', 'name')->get();
        $names = array();
        foreach($admins as $admin){
            $names[$admin->id] = $admin->name;
        }
        $approved_items = Item::where('approved', '!=', null)->get();
        return view('admin.items.approved')->with('names', $names)->with('approved_items', $approved_items);
    }
    //approve a pending item
    public function approve($id){
        
        $item = Item::find($id);
        $item->approved = Auth::user()->id;
        $item->save();

        $check = Lost::where('number',$item->number)->count();
        if($check > 0){
            $lost = Lost::where('number',$item->number)->first();

            $data = ['name' => $item->f_name, 'email' => $lost->email];

            Mail::send( 'mailings.item_found', $data, function( $message ) use ($data)
            {
                $message->to( $data['email'] )->from( 'no-reply@24seven.co.ke')->subject( 'Lost Document Found' );
            });
            

        return redirect()->back()->with('success','Item Approved Successfully. Additionally the item has been found on the lost items collection, and an email sent to the uploader.');  
        } 
     
        return redirect()->back()->with('success','Item Approved Successfully');
    }

    
    //approve a pending item
    public function approve_multiple(Request $request){
        $ids = json_decode($request->ids);
        foreach($ids as $id){
            $item = Item::find($id);
            $item->approved = Auth::user()->id;
            $item->save();

            $check = Lost::where('number',$item->number)->count();
        }
        if($check > 0){
            $lost = Lost::where('number',$item->number)->first();

            $data = ['name' => $item->f_name, 'email' => $lost->email];

            Mail::send( 'mailings.item_found', $data, function( $message ) use ($data)
            {
                $message->to( $data['email'] )->from( 'no-reply@findit.24seven.co.ke')->subject( 'Lost Document Found' );
            });
            
        return redirect()->back()->with('success','Items Approved Successfully. Additionally some items have been found on the lost items collection, and an email sent to the uploaders.');  
        } 
    
        return redirect()->back()->with('success','Items Approved Successfully');
        
    }

    

    public function trashed(){
        $trashed_items = Item::onlyTrashed()->get();
        return view('admin.items.trashed')->with('trashed_items', $trashed_items);
        
    }

    

    public function restore($slug){
        $item = Item::onlyTrashed()->where('slug', $slug)->first();
        $item->restore();
        return redirect()->back()->with('success', 'You succesfully restored the');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if(Auth::user()->id != $item->user->id && Auth::user()->type == 'user'){
            return redirect()->back()->with('error', 'Sorry, you lack the privileges to edit this item.');
        }
        $images = json_decode($item->image);

        if(Auth::user()->id == $item->user->id){
            foreach($images as $image){
                if($image == "uploads/items/image.png")
                    continue;
                File::delete($image);
            }
            $result = $item->forceDelete();
        }
        else
            $result = $item->delete();

        if($result){
            Session::flash('success', 'Item deleted successfully');
            if(Auth::user()->type == 'user')
                return redirect()->route('uploads');
            else
                return redirect()->back();
        }
        Session::flash('error', 'Item could not be deleted.');
        return redirect()->back();
    }

    public function trash(Item $item)
    {
        $images = json_decode($item->image);
        foreach($images as $image){
            if($image == "uploads/items/image.png")
                continue;
            File::delete($image);
        }
        $result = $item->forceDelete();
        if($result){
            Session::flash('success', 'Item deleted successfully');
            if(Auth::user()->type == 'user')
                return redirect()->route('uploads');
            else
                return redirect()->back();
        }
        Session::flash('error', 'Item could not be deleted.');
        return redirect()->back();
    }

}

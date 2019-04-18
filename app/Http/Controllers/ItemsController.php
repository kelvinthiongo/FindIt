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
use App\Report;
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
                'category' => 'required',
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
                // 'image' => 'required|mimes:jpeg,png,bmp,svg',
                'number' => 'required',
                'category' => 'required',
                'place_to_get' => 'required',
            ]);
            $place_to_get = ucwords($request->place_to_get);
        }

        $item = Item::create([
            'number'=> $request->number,
            'category'=> $request->category,
            'user_id'=> Auth::user()->id,
            'place_to_get'=> $place_to_get,
        ]);

        
        //Get the country of the client

        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        $result  = array('country'=>'', 'city'=>'');
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }

        // $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
        // if($ip_data && $ip_data->geoplugin_countryName != null){
        //     $result['country'] = $ip_data->geoplugin_countryName;
        //     $result['country_code'] = $ip_data->geoplugin_countryCode;
        //     $result['city'] = $ip_data->geoplugin_city;
        // }
        
        $item->ip = $ip;

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
            $item->place_found = ucwords(strtolower($request->place_found));
        if($request->lf_date != '')
            $item->lf_date = $request->lf_date;

        if($request->has('image')){
            if(count($request->file('image')) > 4)
                return redirect()->back()->with('error', 'You can only upload a maximum of 4 images');
            foreach($request->file('image') as $image){
                $image_name = time() . $image->getClientOriginalName();
                $image_new_name = 'uploads/items/' . $image_name;
                $new_image = Image::make($image->getRealPath())->resize(500, 328);
                // if(Auth::user()->type == 'ordinary' || Auth::user()->type == 'supper' || Auth::user()->is_verified ) //
                    $new_image->insert('watermark.png', 'center');
                $new_image->save(public_path($image_new_name));

                $image_data[] = $image_new_name; //Storing the public path for the image for record in the database
            }
            $image_data = json_encode($image_data);
            if(strlen($image_data)>500){
                $images = json_decode($image_data);
                foreach ($images as $image) {
                    File::delete($image);
                }
               return redirect()->back()->with('error', 'Sorry some images contain long names! Please rename them to shorter names then upload again');
            }
            $item->image = $image_data;
        }
        else{
            $item->image = json_encode(['/uploads/items/image.png']);
        }
        $item->slug = str_slug($item->id . '-' . $item->f_name . '-' . $item->s_name . '-' . $item->l_name . '-' . $item->number);
        $item->save();
        
        //Mark item as approved if user is either an admin or verified by FindIt. Sending Mail to attached users, then save changes
        if(Auth::user()->type == 'ordinary' || Auth::user()->type == 'supper' || Auth::user()->is_verified ){
            $item->approved = Auth::user()->id;
            $check = Lost::where('number',$item->number)->count();
            if($check > 0){
                $lost = Lost::where('number',$item->number)->first();

                $data = ['name' => $item->f_name, 'email' => $lost->email];

                Mail::send( 'mailings.item_found', $data, function( $message ) use ($data)
                {
                    $message->to( $data['email'] )->from( 'no-reply@24seven.co.ke')->subject( 'Lost Document Found' );
                });
            }
            $item->save();
        }
            

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
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        $result  = array('country'=>'', 'city'=>'');
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }
        if($ip == null)
            return redirect()->back()->with('error', 'Could not get you IP address.');
        $item_report = Report::where('ip', $ip)->where('item_id', $item->id)->first();
        if($item_report != null){
            return redirect()->back()->with('info', 'Already reported this item. The management will take an action soon. Thank you.');
        }
        Report::create([
            'ip' => $ip,
            'item_id' => $item->id
        ]);
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
        $image_data = json_decode($item->image);
        $count = count($image_data);
        if(Auth::user()->id != $item->user->id && Auth::user()->type == 'user'){
            return redirect()->back()->with('error', 'Sorry, you lack the privileges to edit this item.');
        }
        return view('client.items.edit')->with('item', $item)->with('categories', Category::all())->with('count', $count);
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
        if(count($data) == 0)
            return redirect()->back()->with('error', 'The action leads to zero images being left.');
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
                'place_to_get' => 'required',

            ]);

            
            $place_to_get = ucwords(strtolower($request->place_to_get));
    
        }
        $item->number = $request->number;
        if($request->category != null)
            $item->category = $request->category;
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
                $new_image = Image::make($image->getRealPath())->resize(500, 328);
                $new_image->insert('watermark.png', 'center', 10, 10);
                $new_image->save($image_new_name);
        
                $image_data[] = $image_new_name; //Storing the public path for the image for record in the database
            }
            
            if(strlen(json_encode($image_data))>1200){
                foreach ($request->file('image') as $image) {
                    File::delete($image);
                }
               return redirect()->back()->with('error', 'Sorry some images contain long names! Please rename them to shorter names then upload again');
            }
            $item->image = json_encode($image_data);
        }
        // $new_image->insert('watermark.png', 'center');
        $image = File::get('watermark.png');
        $item->slug = str_slug($item->id . '-' . $item->f_name . '-' . $item->s_name . '-' . $item->l_name . '-' . $item->number);
 
        if(Auth::user()->type != "user"){
            if($item->approved == null){
                $check = Lost::where('number',$item->number)->count();
                if($check > 0){
                    $lost = Lost::where('number',$item->number)->first();

                    $data = ['name' => $item->f_name, 'email' => $lost->email];

                    Mail::send( 'mailings.item_found', $data, function( $message ) use ($data)
                    {
                        $message->to( $data['email'] )->from( 'no-reply@24seven.co.ke')->subject( 'Lost Document Found' );
                    });
                }
            }
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
                $item->save();
                return redirect()->back()->with('success','Item Approved Successfully. Additionally the item has been found on the lost items collection, and an email sent to the uploader.');  
            }
            
            return redirect()->route('items.show', ['slug' => $item->slug])->with('success', 'You successfully updated and APPROVED the item!');
        }
        $item->approved = null;
        
        $item->save(); //saving any pending changes

        return redirect()->route('items.show', ['slug' => $item->slug])->with('item' ,$item)->with('success', 'You successfully updated the item!');
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

    
    //approve a multiple pending item
    public function approve_multiple(Request $request){
        $ids = json_decode($request->ids);
        $check_mailable = false;
        foreach($ids as $id){
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
                $check_mailable = true;
            }
        }
        if($check_mailable){
            return redirect()->back()->with('success','Items Approved Successfully. Additionally some items have been found on the lost items collection, and an email sent to each of the uploaders.');
        } 
    
        return redirect()->back()->with('success','Items Approved Successfully');
        
    }
    //disapprove an approved item
    public function disapprove($id){

        $item = Item::find($id);
        $item->approved = null;
        $item->save();
        return redirect()->back()->with('success','Item dispproved! It has been marked as pending');
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
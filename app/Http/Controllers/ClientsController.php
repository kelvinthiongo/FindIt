<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Auth;
use Session;
use Image;
use File;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::all();
        return view('admin.clients.index')->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.clients.create');
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
            'name' => 'required',
            'url' => 'required',
            'image' => 'required'
        ]);
        $image = $request->image;
        $image_name =  time() . $image->getClientOriginalName();
        $image_new_name = 'uploads/clients/' . $image_name;
        $new_image = Image::make($image->getRealPath())->resize(1360, 700);
        $new_image->save(public_path($image_new_name));

        $image = $image_new_name; //Storing the public path for the image for record in the database

        $client = Client::create([
            'name' => $request->name,
            'url' => $request->url,
            'image' => $image,
            'source_code_link' => $request->source_code_link,
            'cpanel_username' => $request->cpanel_username,
            'cpanel_password' => $request->cpanel_password,
            'admin_username' => $request->admin_username,
            'admin_password' => $request->admin_password,
            'phone' => $request->phone,
        ]);
        $client->slug = str_slug($request->name);
        if(Client::where('slug', $client->slug)->count() != 0){
            $client->slug = str_slug($request->name . $client->id);
        }
        $client->save();
        Session::flash('success', 'You successifully added a client.');
        return redirect()->route('clients.index');
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
        $client = Client::where('slug', $slug)->first();
        return view('admin.clients.show')->with('client', $client);
        
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
        $client = Client::where('slug', $slug)->first();
        return view('admin.clients.edit')->with('client', $client);
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
            'name' => 'required',
            'url' => 'required',
        ]);
        $client = Client::where('slug', $slug)->first();
        $client->name = $request->name;
        $client->url = $request->url;
        $client->phone = $request->phone;
        $client->source_code_link = $request->source_code_link;
        $client->cpanel_username = $request->cpanel_username;
        $client->cpanel_password = $request->cpanel_password;
        $client->admin_username = $request->admin_username;
        $client->admin_password = $request->admin_password;
        if($request->hasFile('image')){
            $image = $request->image;
            $image_old = $client->image;
            $image_name =  time() . $image->getClientOriginalName();
            $image_new_name = 'uploads/clients/' . $image_name;
            $new_image = Image::make($image->getRealPath())->resize(1360, 700);
            $new_image->save(public_path($image_new_name));
            $client->image = $image_new_name;
            File::delete($image_old);
        }
        $client->save();
        Session::flash('success', 'You successifully edited the client\'s details.');
        // return redirect()->route('clients.show', ['slug', $slug]);
        return view('admin.clients.show')->with('client', $client);
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
            $client = Client::where('slug', $slug)->first();
        }
        catch(QueryException $ex){
            Session::flash('error', 'Client could not be found!');
            return redirect()->back();
        }
        $image = $client->image;
        File::delete($image);
        $client->delete();
        Session::flash('success', 'Client removed successifully');
        return redirect()->route('clients.index');
    }

}
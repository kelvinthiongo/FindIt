<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use Intervention\Image\ImageManagerStatic as Image; 
use File;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::orderBy('created_at','desc')->get();

        return view('admin.partners.index')->with('partners', $partners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partners.create_partner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->hasFile('logo') && $request->has('logo')){
            return redirect()->back()->with('error','Image not supported');
        }
        $this->validate($request, [
            'url' => 'required',
            'logo' => 'required',
            'name' => 'required'
        ]);

        //CREATE PARTNER
        $partner = new Partner;
        $partner->link = $request->input('url');
        $partner ->name = $request->name;

        if($request->hasFile('logo')){
            $logo = $request->logo;
            $new_logo = Image::make($logo->getRealPath())->resize(200, 100);
            $logo_name = time() . $logo->getClientOriginalName();
            $new_logo->save(public_path('uploads/partners/' .$logo_name));
            $partner->logo = 'uploads/partners/' . $logo_name;
        }

        $partner->save();

        return redirect('/admin/partners')->with('success','Partner Added Successfully');

            
       
        
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
        $partner = Partner::find($id);

        return view('admin.partners.edit_partner')->with('partner' ,$partner);
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
        if(!$request->hasFile('logo') && $request->has('logo')){
            return redirect()->back()->with('error','Image not supported');
        }
       
        $this->validate($request, [
            'url' => 'required',
            
        ]);

       

        //UPDATE PARTNER
        $partner = Partner::find($id);
        $partner->link = $request->input('url');
        $logo_old = $partner->logo;
        
        if($request->hasFile('logo')){
            $logo = $request->logo;
            $new_logo = Image::make($logo->getRealPath())->resize(200, 100);
            $logo_name = time() . $logo->getClientOriginalName();
            $new_logo->save(public_path('uploads/partners/' .$logo_name));
            $partner->logo = 'uploads/partners/' . $logo_name;
        }
       
        $partner->save();

        if($request->hasFile('logo')){

            File::delete($logo_old);
        }

        return redirect('/admin/partners')->with('success','Partner Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);
        $logo = $partner->logo;
        $partner->delete();

        File::delete($logo);

        return redirect('/admin/partners')->with('success','Partner Deleted Successfully');
    }
}

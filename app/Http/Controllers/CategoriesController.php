<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        if($request->wantsJson()){
            return response()->json($categories, 200);
        }
        else {
            return view('admin.categories.index')->with('categories', $categories);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'name' => 'required'
        ]);
        if(Category::where('name', $request->name)->count() > 0){
            if($request->wantsJson()){
                return response()->json([
                    'status' => false,
                    'error' => $request->name . 'already exists.'
                ]);
            }
            else {
                return redirect()->route('categories.index')->with('info', "$request->name already exists.");
            }

        }
        $category = Category::create([
            'name' => $request->name,
        ]);
        $slug = str_slug($request->name);
        if(Category::where('slug', $slug)->count() != 0){
            $slug = str_slug($request->name . $category->id);
        }
        $category->slug = $slug;
        $category->save();
        if($request->wantsJson()){
            return response()->json([
                'status' => true,
                'success' => 'You successfully added a category.'
            ]);
        }
        else {
            return redirect()->route('categories.index')->with('success', 'You successfully added a category.');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->first();
        if($request->wantsJson()){
            return response()->json($category, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category->name = $request->name;
        $slug = str_slug($request->name);
        if($category->slug == $slug){
            $category->slug = $slug;
        }
        elseif(Category::where('slug', $slug)->count() != 0){
            $category->slug = str_slug($request->name . $category->id);
        }
        else{
            $category->slug = $slug;
        }
        $category->save();
        if($request->wantsJson()){
            return response()->json([
                'status' => true,
                'success'=> 'You successfully edited the category.'
            ]);
        }
        else{
            return redirect()->route('categories.index')->with('success', 'You successfully edited the category.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $category->delete();
        if($request->wantsJson()){
            return response()->json([
                'status' => true,
                'success' => 'You successfully deleted the category.'
            ],204);
        }
        else {
            return redirect()->route('categories.index')->with('success', 'You successfully deleted the category.');
        }
    }
}

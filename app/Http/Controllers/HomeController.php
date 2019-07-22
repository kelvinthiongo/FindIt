<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Item;
use Auth;

class HomeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');

        $this->middleware('admin', ['only' => [
            'create', 'store', 'edit', 'update', 'show', 'destroy'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if(Auth::user()->type == 'ordinary' || Auth::user()->type == 'super'){
            $users = User::where('type', 'user')->where('email_verified_at', '!=', null)->count();
            $admins = User::where('type', '!=', 'user')->where('email_verified_at', '!=', null)->count();
            $approved_items = Item::where('approved', '!=', null)->count();
            $pending_items = Item::where('approved', null)->count();
            $reported_items = Item::where('reports', '!=', null)->count();
            $trashed_items = Item::onlyTrashed()->count();
            return view('admin.dashboard')->with('users',$users)
                                            ->with('admins',$admins)
                                            ->with('approved_items',$approved_items)
                                            ->with('pending_items',$pending_items)
                                            ->with('reported_items',$reported_items)
                                            ->with('trashed_items',$trashed_items)
                                            ;
        }
        else
            return redirect()->route('landing');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('admin');
        return view('admin.todo.add_todo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('admin');
        $this->validate($request, [
            'duration' => 'required',
            'measure' => 'required',
            'description' => 'required'
        ]);

        //create todo item
        $todo = new Todo;
        $todo->duration = $request->duration;
        $todo->measure = $request->measure;
        $todo->description = $request->description;
        $todo->user_id = Auth::user()->id;

        $todo->save();

        return redirect('/home')->with('success','Todo Item Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware('admin');
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
        $this->middleware('admin');
        $todo = Todo::find($id);
        return view('/admin/todo/edit_todo')->with('todo', $todo);
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
        $this->middleware('admin');
        $this->validate($request, [
            'duration' => 'required',
            'measure' => 'required',
            'description' => 'required'
        ]);

        //update todo item
        $todo = Todo::find($id);
        $todo->duration = $request->duration;
        $todo->measure = $request->measure;
        $todo->description = $request->description;

        $todo->save();

        return redirect('/home')->with('success','Todo Item Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('admin');
        $todo = Todo::find($id);
        $todo->delete();

        return redirect('/home')->with('success','Item Removed Successfully');
    }

}

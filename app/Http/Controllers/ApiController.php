<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    // public function register(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|min:3',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password)
    //     ]);

    //     $token = $user->createToken('TutsForWeb')->accessToken;

    //     return response()->json(['token' => $token], 200);
    // }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token_obj = auth()->user()->createToken('personal-token');
            $token = $token_obj->accessToken;
            $access = true;
            $auth_user = Auth::user();
            //return response()->json($token_obj->token, 200);
            return response()->json([
                'user' => $auth_user,
                'access' => $access,
                'token' => $token,
            ], 200);
        } else {
            $access = false;
            return response()->json([
                'error' => 'UnAuthorised',
                'access' => $access
            ]);
        }
    }

    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
    public function logout(Request $request)
    {
        $auth_user_id = Auth::user()->id;
        if ($auth_user_id == $request->user_id) {
            $token = Auth::user()->token();
            $token->revoke();
            return response()->json(['logged_out' => true], 200);
        } else {
            return response()->json(['logged_out' => false], 404);
        }
    }
    public function getToken()
    {
        $user = Auth::user();

        //$token = $user->email;

        return response()->json($user, 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (rand(1, 10) < 3) {
            abort(500, 'We could not retrieve the categories');
        }
        return Category::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class AllowAdminsOnly
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if (Auth::user()->type != 'ordinary' && Auth::user()->type != 'supper') {
            Session::flash('error', 'Sorry, task allowed to admins only. Logout first then login as an admin');
            return redirect()->back();
        }
        else if(Auth::user()->type == 'ordinary' || Auth::user()->type == 'supper'){
            return $next($request);
        }
    }
}

<?php

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'ApiController@login');
Route::middleware('auth:api')->group(function () {
    Route::resource('category', 'ApiController');
    Route::post('logout', 'ApiController@logout');
    Route::post('add-admin', 'UsersController@admin_store');
    Route::get('user', 'ApiController@details');
    Route::get('all-admins', 'UsersController@admin_index');
    Route::get('/show-admin/{slug}', 'UsersController@admin_show');
    Route::put('/update-admin/{slug}', 'UsersController@update');
});

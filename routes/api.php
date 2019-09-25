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

Route::post('/login', 'ApiController@login');
Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'ApiController@logout');
    Route::post('/mark-doc/{item}', 'ItemsController@mark_collected');
    Route::get('/search-doc', 'ItemsController@search_item');
    Route::get('/uncollected-docs', 'ItemsController@uncollected_index');
    Route::get('/collected-docs', 'ItemsController@collected_index');
    Route::post('add-admin', 'UsersController@admin_store');
    Route::post('add-category', 'CategoriesController@store');
    Route::post('add-doc', 'ItemsController@store');
    Route::get('user', 'ApiController@details');
    Route::get('all-admins', 'UsersController@admin_index');
    Route::get('all-categories', 'CategoriesController@index');
    Route::get('all-docs', 'ItemsController@index');
    Route::get('total-docs', 'ItemsController@total_items');
    Route::get('/show-admin/{slug}', 'UsersController@admin_show');
    Route::get('/show-category/{slug}', 'CategoriesController@show');
    Route::get('/show-doc/{item}', 'ItemsController@show');
    Route::put('/update-admin/{slug}', 'UsersController@update');
    Route::put('/update-category/{category}', 'CategoriesController@update');
    Route::put('/update-doc/{item}', 'ItemsController@update');
    Route::delete('/delete-admin/{slug}', 'UsersController@destroy');
    Route::delete('/delete-category/{category}', 'CategoriesController@destroy');
    Route::delete('/delete-doc/{item}', 'ItemsController@destroy');
});

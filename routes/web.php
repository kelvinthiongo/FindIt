<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function(){
    return view('mailings.item_found')->with('name', 'Kelvin Thiongo')
                                    ->with('email', 'thiongokelvin5@gmail.com')
                                    ->with('password', str_random(8));
});

Route::get('/', 'ItemsController@find')->name('landing');
Route::get('/app', 'ItemsController@app')->name('app');
Route::post('/check', 'ItemsController@check')->name('check');

Route::resource('losts', 'LostController');

//Auth Routes
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['verified','auth', 'admin']], function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('users', 'UsersController');

    Route::get('/show_by_id/users/{id}', 'UsersController@show_by_id')->name('show_by_id');
    Route::get('/admins', 'UsersController@admin_index')->name('admin_index');
    Route::get('/admin/add_admin/create', 'UsersController@add_admin')->name('add_admin');
    Route::post('/users/add_admin/store', 'UsersController@admin_store')->name('admin.store');
    Route::get('/trash/users', 'UsersController@trashed_users')->name('trashed_users');
    Route::get('/trash/admins', 'UsersController@trashed_admins')->name('trashed_admins');
    Route::post('/trash/users/{slug}/restore', 'UsersController@restore')->name('users.restore');
    Route::delete('/trash/users/{slug}/p_destroy', 'UsersController@p_destroy')->name('users.p_destroy');

    Route::resource('items', 'ItemsController');
    Route::post('/item/delete/{item}', 'ItemsController@destroy');
    Route::post('/item/edit_item/{item}', 'ItemsController@update')->name('item.update');
    Route::post('/item/mark-as-collected/{item}', 'ItemsController@mark_collected')->name('item.mark');
    Route::get('/item/collected-items', 'ItemsController@collected_index')->name('items.collected');
    Route::get('/item/collected-items-not-collected', 'ItemsController@uncollected_index')->name('items.uncollected');
    Route::get('/item/search', 'ItemsController@search_item')->name('items.search');

    Route::resource('categories', 'CategoriesController');

    Route::resource('todo','HomeController');

});

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

Route::get('/welcome', function () {
    return view('welcome');
});
//client page Routes
Route::get('/', 'PagesController@index')->name('landing');
Route::get('/faq', 'PagesController@faq')->name('faq');
Route::get('/terms', 'PagesController@terms')->name('terms');
Route::get('/submit-query','PagesController@contact')->name('contact');
Route::get('/profile','PagesController@profile')->name('profile');
Route::get('/uploaded-items','PagesController@my_uploads')->name('uploads');
Route::get('/upload-item','PagesController@upload')->name('upload_item');

Route::get('/register-page', function () {
    return view('client.register');
});


Route::any('/search/items', 'ItemsController@search_item')->name('search_item');

Route::post('/items/store', 'ItemsController@store')->name('store_item');
Route::get('/items/show/{slug}', 'ItemsController@show')->name('show_item');
Route::get('/items/report/{slug}', 'ItemsController@report')->name('report');

//Auth Routes
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    
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

    Route::resource('categories', 'CategoriesController');
    Route::resource('items', 'ItemsController');
    Route::resource('faqs', 'FaqController');

    Route::resource('todo','HomeController');

});

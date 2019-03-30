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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/reviews', 'PagesController@reviews');
Route::get('/portfolio','PagesController@port');
Route::get('/contact','PagesController@contact');
Route::get('/services','PagesController@services');
Route::get('/web-design','PagesController@web_design');
Route::get('/digital-marketing','PagesController@digital_marketing');
Route::get('/graphics-design','PagesController@graphics_design');

//contact us
Route::post('contact-us', ['as'=>'contactus.store','uses'=>'ContactUsController@store']);

//Post Routes
Route::post('/', 'PagesController@subscriber_store');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('users', 'UsersController');

    Route::get('/admins', 'UsersController@admin_index')->name('admin_index');
    Route::get('/admin/add_admin/create', 'UsersController@add_admin')->name('add_admin');
    Route::post('/users/add_admin/store', 'UsersController@admin_store')->name('admin.store');
    Route::get('/trash/users', 'UsersController@trashed_users')->name('trashed_users');
    Route::get('/trash/admins', 'UsersController@trashed_admins')->name('trashed_admins');
    Route::post('/trash/users/{slug}/restore', 'UsersController@restore')->name('users.restore');
    Route::delete('/trash/users/{slug}/p_destroy', 'UsersController@p_destroy')->name('users.p_destroy');
    // Route::post('/users/edit/{slug}', 'UsersController@update')->name('admin.update');

    Route::resource('categories', 'CategoriesController');


    Route::resource('clients', 'ClientsController');
    Route::resource('sliders', 'SlidersController');
    Route::resource('partners', 'PartnersController');
    Route::resource('metatags', 'MetatagsController');
    Route::resource('webpages', 'WebpagesController');
    Route::resource('subscribers', 'SubscribersController');
    Route::resource('todo','HomeController');

});


// Route::get('/users', [
//     'uses' => 'usersController@index',
//     'as' => 'users.index'
// ]);
// Route::get('/users/create', [
//     'uses' => 'usersController@create',
//     'as' => 'users.create'
// ]);
// Route::post('/users', [
//     'uses' => 'usersController@store',
//     'as' => 'users.store'
// ]);
// Route::get('/users/{slug}', [
//     'uses' => 'usersController@show',
//     'as' => 'users.show'
// ]);
// Route::get('/users/{slug}/edit', [
//     'uses' => 'usersController@edit',
//     'as' => 'users.edit'
// ]);
// Route::post('/users/{slug}', [
//     'uses' => 'usersController@update',
//     'as' => 'users.update'
// ]);
// Route::delete('/users/{slug}', [
//     'uses' => 'usersController@destroy',
//     'as' => 'users.destroy'
// ]);
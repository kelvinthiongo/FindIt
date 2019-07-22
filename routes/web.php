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

Route::get('/', function () {
    return view('welcome');
});
//client page Routes
Route::get('/welcone', 'PagesController@index')->name('landing');
Route::get('/faq', 'PagesController@faq')->name('faq');
Route::get('/terms-and-policy', 'PagesController@terms')->name('terms');
Route::get('/submit-query','PagesController@contact')->name('contact');

Route::post('/send-query', 'ContactUsController@query')->name('query');


Route::post('/send-query', 'ContactUsController@query')->name('query');


Route::get('/register-page', function () {
    return view('client.register');
});

Route::resource('items', 'ItemsController');
Route::resource('lost', 'LostController');

Route::any('/search/items', 'ItemsController@search_item')->name('search_item');


Route::post('/items/report/{item}', 'ItemsController@report')->name('report');

//Auth Routes
Auth::routes(['verify' => true, 'register' => false]);

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

    Route::resource('categories', 'CategoriesController');

    Route::resource('faqs', 'FaqController');

    Route::resource('items', 'ItemsController');

    Route::resource('todo','HomeController');

});



// get clients country
Route::get('/get-client-country', function(){ // getLocationInfoByIp
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
    $result  = array('country'=>'', 'city'=>'');
    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }
    return $ip;
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
    if($ip_data && $ip_data->geoplugin_countryName != null){
        $result['country'] = $ip_data->geoplugin_countryName;
        $result['country_code'] = $ip_data->geoplugin_countryCode;
        $result['city'] = $ip_data->geoplugin_city;
    }
    return $ip;
});

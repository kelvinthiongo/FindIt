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
Route::get('/terms-and-policy', 'PagesController@terms')->name('terms');
Route::get('/submit-query','PagesController@contact')->name('contact');
Route::group(['middleware' => ['verified','auth']], function(){
    Route::get('/profile','PagesController@profile')->name('profile');
    Route::get('/uploaded-items','PagesController@my_uploads')->name('uploads');
    Route::post('/users/update-profile','PagesController@update_profile')->name('update_profile');
    Route::delete('/items/delete-image/{item}/{image}', 'ItemsController@delete_image')->name('delete_image');
});

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
Auth::routes(['verify' => true]);

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

    Route::get('/pending-items', 'ItemsController@pending')->name('pending');
    Route::get('/pending_ui-items', 'ItemsController@pending_ui')->name('pending_ui');
    Route::get('/approved-items', 'ItemsController@approved')->name('approved-items');
    Route::get('/pending-items/{id}/approve', 'ItemsController@approve')->name('approve');
    Route::get('/approved-items/{id}/disapprove', 'ItemsController@disapprove')->name('disapprove');
    Route::post('/pending-items/approve-multiple', 'ItemsController@approve_multiple')->name('approve_multiple');
    Route::get('/trashed-items', 'ItemsController@trashed')->name('trashed-items');
    Route::delete('/trashed-items', 'ItemsController@soft_delete')->name('soft_delete');
    Route::put('/restore-item/{slug}', 'ItemsController@restore')->name('restore_item');

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

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
    if($ip_data && $ip_data->geoplugin_countryName != null){
        $result['country'] = $ip_data->geoplugin_countryCode;
        $result['city'] = $ip_data->geoplugin_city;
    }
    return $ip;
});
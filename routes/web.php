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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//System login routes
Route::get('/login/system', 'SystemLoginController@loginSystem')->name('login.system');
Route::post('/login/system', 'SystemLoginController@loginAuth')->name('login.system');
Route::post('/logout/system', 'SystemLoginController@logout')->name('logout.system');

//Admin routes we want protected
Route::group(['middleware'=>'auth:admin'], function(){
    Route::get('/home/admin', 'AdminController@home');
    Route::get('system/customers-list','AdminController@getAll')->name('customers-list');
    //admin routes
    Route::get('/system/admin-list', 'AdminController@getList')->name('admin.list');
    Route::get('/register/admin', 'AdminController@create')->name('admin.register');
    Route::post('/register/admin', 'AdminController@registerAdmin')->name('register.admin');

});

//Customer routes
Route::get('/register/customer', 'CustomerController@create')->name('customer.register');
Route::post('/register/customer', 'CustomerController@registerCustomer')->name('register.customer');

//Customer routes we want protected
Route::group(['middleware'=>'auth:customer'], function(){
    Route::get('/home/customer', 'CustomerController@home');
    Route::get('file','DocumentsImagesController@create');
    Route::post('file','DocumentsImagesController@store');
    Route::get('image','DocumentsImagesController@image');
    Route::post('image','DocumentsImagesController@storeImage');
    Route::get('list/files','DocumentsImagesController@allDoc');
    Route::get('list/images','DocumentsImagesController@allImages');
    Route::get('image/preview/','DocumentsImagesController@showPreview');
    Route::get('file/delete/{id}','DocumentsImagesController@deleteFile');
});
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

Route::group(['middleware' => ['auth', 'bindings']], function () {
    Route::resource('user', 'UserController');
    Route::resource('search', 'HomeController');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/search', 'HomeController@search')->name('search');
Route::get('/group/{id}', 'GroupController@group')->name('group');
Route::get('/profile')->name('profile');
Route::get('/creategroup', 'GroupController@createGroup');
Route::post('/group/store', 'GroupController@storeGroup');

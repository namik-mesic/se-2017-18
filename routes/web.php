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
    Route::post('/search', 'HomeController@search')->name('search');
    Route::post('/profile/{id}/post', 'PostController@store')->name('post');
});

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
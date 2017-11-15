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

Route::resource('user', 'UserController');

Route::get('/offer', 'OfferController@index');

Route::get('/offer/create', 'OfferController@create');

Route::post('/offer', 'OfferController@store');

Route::get('/offer/edit/{offer}', 'OfferController@edit');

Route::get('/offer/{offer}', 'OfferController@show');

Route::post('/offer/update/{offer}', 'OfferController@update');

Route::delete('/offer/delete/{offer}', 'OfferController@delete');
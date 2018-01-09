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

Route::get('/profile', 'ProfileController@getProfile')->name('profile');
Route::get('/profile/update', 'ProfileController@getProfileUpdate')->name('profile-update');
Route::put('/profile/update/me', 'ProfileController@updateProfile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

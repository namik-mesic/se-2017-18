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

Route::resource('/event', 'EventController');

Route::get('/event/{id}/sendInvitations', 'EventController@sendInvitations')->name('sendInvitations');

Route::get('/event/{id}/invite', 'EventController@invite')->name('invite');

Route::get('/event/{id}/invite/{user_id}', 'EventController@sendInvitation')->name('sendInvitation');

Route::get('/invitations', 'EventInvitationsController@index')->name('invitations');

Route::get('/invitations/{id}&{response}', 'EventInvitationsController@response')->name('response');
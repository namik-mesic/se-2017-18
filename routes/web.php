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

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', 'ProfileController@getProfile')->name('profile');
Route::get('/profile/update', 'ProfileController@getProfileUpdate')->name('profile-update');
Route::get('/profile/delete/me', 'ProfileController@deleteProfile')->name('profile-delete');
Route::put('/profile/update/me', 'ProfileController@updateProfile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users/{id}', 'SearchController@show');
Route::get('/toggle-email-hidden', 'UpdateEmailPrivacyController@toggleEmailHidden');

Route::post('/profile-comment/store', 'ProfileController@store')->name('profile-comment.store');
Route::delete('/profile-comment/destroy/{id}', 'ProfileController@destroy')->name('profile-comment.destroy');
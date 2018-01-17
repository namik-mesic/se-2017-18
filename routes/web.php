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
    // Home route
    Route::get('/home', 'HomeController@index')->name('home');

    // Search route
    Route::post('/search', 'HomeController@search')->name('search');

    // Profile routes
    Route::get('/profile/{id}', 'UserController@show')->name('profile_show');

    Route::get('/profile/{id}/request', 'UserController@request')->name('friend_request');
    Route::get('/profile/{id}/accept', 'UserController@accept')->name('friend_accept');
    Route::get('/profile/{id}/ignore', 'UserController@ignore')->name('friend_ignore');

    Route::post('/profile/{id}/post', 'PostController@create')->name('post_create');

    // Post routes
    Route::post('/post/{id}/edit', 'PostController@edit')->name('post_edit_show');
    Route::post('/post/{id}/delete', 'PostController@delete')->name('post_delete');
    Route::post('/post/{id}/change', 'PostController@change')->name('post_edit_submit');
    Route::post('/post/{id}/upvote', 'PostController@like')->name('post_upvote');
    Route::post('/post/{id}/downvote', 'PostController@unlike')->name('post_downvote');
});

Route::get('/', function () {
    return view('auth.register');
});

Auth::routes();
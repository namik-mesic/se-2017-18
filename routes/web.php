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
    Route::get('/search', 'HomeController@search')->name('search');

    // Profile routes
    Route::post('/profile/{id}', 'UserController@show')->name('profile_show');
    Route::post('/profile/{id}/edit', 'UserController@edit')->name('profile_edit_show');
    Route::post('/profile/{id}/delete', 'UserController@delete')->name('profile_delete');
    Route::post('/profile/{id}/change', 'UserController@change')->name('profile_edit_submit');
    Route::post('/profile/{id}/request', 'UserController@request')->name('post_create');
    Route::post('/profile/{id}/accept', 'UserController@accept')->name('post_create');
    Route::post('/profile/{id}/ignore', 'UserController@ignore')->name('post_create');

    Route::post('/profile/{id}/post', 'PostController@create')->name('post_create');

    // Post routes
    Route::post('/post/{id}/edit', 'PostController@edit')->name('post_edit_show');
    Route::post('/post/{id}/delete', 'PostController@delete')->name('post_delete');
    Route::post('/post/{id}/change', 'PostController@change')->name('post_edit_submit');
    Route::post('/post/{id}/like', 'PostController@like')->name('post_like');
    Route::post('/post/{id}/unlike', 'PostController@unlike')->name('post_unlike');

    Route::post('/post/{id}/comment', 'CommentController@create')->name('comment_create');

    // Comment routes
    Route::post('/comment/{id}/edit', 'CommentController@edit')->name('comment_edit_show');
    Route::post('/comment/{id}/delete', 'CommentController@destroy')->name('comment_delete');
    Route::post('/comment/{id}/change', 'CommentController@change')->name('comment_edit_submit');
    Route::post('/comment/{id}/like', 'CommentController@like')->name('comment_like');
    Route::post('/comment/{id}/unlike', 'CommentController@unlike')->name('comment_unlike');
});

Route::get('/', function () {
    return view('auth.register');
});

Auth::routes();
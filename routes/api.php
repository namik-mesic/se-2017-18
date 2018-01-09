<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'as' => 'api.',
    'namespace' => 'API'
], function () {

    Route::resource('user', 'UserController');
    Route::get('conversation/getAll/{id}', 'ConversationController@index');
    Route::get('user/getAll/{id}', 'UserController@getAllExceptAuth');
});
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

    // User routes
    Route::get('user/getAll/{id}', 'UserController@getAllExceptAuth');

    // Conversation routes
    Route::get('conversation/getAll/{id}', 'ConversationController@index');

    // Message routes
    Route::get('message/getAll/{id}', 'MessageController@getMessagesOfConversation');
    Route::post('message', 'MessageController@store');
    Route::delete('message/delete/{id}', 'MessageController@destroy');
});
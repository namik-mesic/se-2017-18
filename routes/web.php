<?php
use App\advertisements;

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

//Route::group(['middleware' => ['auth', 'bindings']], function () {



    Route::resource('user', 'UserController');

//});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('user', 'UserController');

Route::get('/allads', 'advertiseController@show');



Route::delete('/advertise/delete/{ad}', 'advertiseController@delete');

Route::get('/advertise/edit/{ad}', 'advertiseController@edit');

Route::post('/advertise/', 'advertiseController@store');

Route::post('/advertise/update/{ad}', 'advertiseController@update');

Route::get('/advertise', 'advertiseController@index');

Route::get('advertise/create', function () {
    return view('advertise.create');
});


Route::post('advertise/create',function (){
    $image =\Illuminate\Support\Facades\Input::file('image');
    $move = $image->move('images/Advertisement', $image->getClientOriginalName());
    if($move){
        $create = \App\advertisements::create([
            'titles'=> \Illuminate\Support\Facades\Input::get('titles'),
            'image'=> $image->getClientOriginalName(),
            'description'=> \Illuminate\Support\Facades\Input::get('description'),
            'url'=> \Illuminate\Support\Facades\Input::get('url')
        ]);
        if($create){
            return redirect('/allads');
        }
    } });





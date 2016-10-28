<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/admin', 'AdminController@index');
Route::get('/editperiod/{id}', 'AdminController@index');

Route::post('/photoupload', 'ContestController@addphoto');
Route::post('/createproject', 'AdminController@createproject');

Route::get('/vote/{id}', 'ContestController@vote');
Route::get('/removevote/{id}', 'ContestController@removevote');

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



Route::auth();

Route::get('/', 'HomeController@welcome');
Route::get('/home', 'HomeController@index');
Route::get('/admin', 'AdminController@index');
Route::get('/register', 'HomeController@register');
Route::get('/login', 'HomeController@login');
Route::get('/editperiod/{id}', 'AdminController@edit');
Route::get('/deleteperiod/{id}', 'AdminController@delete');
Route::get('/allpics', 'AdminController@allpics');
Route::get('/deletepic/{id}', 'AdminController@deletepic');
Route::get('/recoverpic/{id}', 'AdminController@recoverpic');

Route::post('/photoupload', 'ContestController@addphoto');
Route::post('/createperiod', 'AdminController@createperiod');
Route::post('/updateperiod/{id}', 'AdminController@updateperiod');

Route::get('/vote/{id}', 'ContestController@vote');
Route::get('/removevote/{id}', 'ContestController@removevote');

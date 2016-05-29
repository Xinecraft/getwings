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

Route::group(['middleware' => 'web'], function () {
	Route::auth();
	Route::any('/google/login', ['as' => 'auth.google', 'uses' => 'Auth\AuthController@loginWithGoogle']);

	Route::get('/home', 'HomeController@index');
	Route::post('/setlocation', 'HomeController@setLocation');
});

Route::group(['prefix' => 'api/v1'], function () {
	Route::get('/me', 'ApiController@whoami');
	Route::get('/mee', 'ApiController@getNeighbours');

});

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

Route::get('home', 'UserController@index');

// User Route
Route::get('/', 'UserController@index');
Route::get('u/{name}', 'UserController@getByUsername');
Route::get('u/{name}/follow', ['middleware' => 'auth', 'uses' => 'UserController@follow']);
Route::get('u/{name}/unfollow', ['middleware' => 'auth', 'uses' => 'UserController@unfollow']);
Route::get('u/{name}/following', 'UserController@following');
Route::get('u/{name}/followers', 'UserController@followers');

// Hashtag Route
Route::get('h', 'HashtagController@index');
Route::get('h/{name}', 'HashtagController@getByHashtag');

// Glitter Route
Route::get('g', 'GlitterController@index');
Route::post('g/new', ['middleware' => 'auth', 'uses' => 'GlitterController@store']);
Route::get('g/{id}/reglitter', 'GlitterController@reglitter');

// Search Route
Route::get('search', 'SearchController@index');
Route::post('search', 'SearchController@submit');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


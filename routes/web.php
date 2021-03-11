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

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/index', function () {
  return view('templates.index');
});

Route::prefix('user')->group(function () {
    Route::get('/', ['as' => 'user.index', 'uses' => 'UserController@index']);
    Route::get('/sign-up', ['as' => 'user.signup', 'uses' => 'UserController@signUpPage']);
});


// API
Route::prefix('api')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/get', ['as' => 'api.user.get', 'uses' => 'UserController@getAll']);
        Route::post('/create', ['as' => 'api.user.store', 'uses' => 'UserController@store']);
    });
});
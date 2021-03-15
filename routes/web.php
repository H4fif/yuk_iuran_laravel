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
});

Route::prefix('auth')->group(function () {
    Route::get('/', ['as' => 'auth.signin', 'uses' => 'Auth\LoginController@signInPage']);
    Route::get('/sign-in  ', ['as' => 'auth.signin', 'uses' => 'Auth\LoginController@signInPage']);
    Route::get('/sign-up', ['as' => 'user.signup', 'uses' => 'Auth\RegisterController@signUpPage']);
});
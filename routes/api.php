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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('user')->group(function () {
    Route::get('/', ['as' => 'api.user.get', 'uses' => 'UserController@apiGetAll']);
    Route::get('/{id}', ['as' => 'api.user.get', 'uses' => 'UserController@apiGetUserById']);
    Route::post('/create', ['as' => 'api.user.store', 'uses' => 'Auth\RegisterController@apiCreate']);
});
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


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'UserController@register');
    Route::post('login', 'AuthController@login');

});

Route::group([

    'middleware' => 'api',

], function ($router) {

    #lista users
    Route::get('users', 'UserController@getUsers');
    #edita user
    Route::put('users/{user}', 'UserController@update');
    Route::patch('users/{user}', 'UserController@update');
    #desabilita user
    Route::delete('users/{user}', 'UserController@delete');

});
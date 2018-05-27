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

    'middleware' => 'api'
    
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', [
        'uses' => 'AuthController@me',
        'middleware' => 'auth.jwt'
    ]);

    Route::get('facebook/login', 'SocialAuthController@login');
    Route::get('facebook/login/callback', 'SocialAuthController@callback');
    Route::get('facebook/logout', 'SocialAuthController@logout');

});
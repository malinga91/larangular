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
    Route::post('facebook/get_token', 'SocialAuthController@getTokenFromCode');

    Route::post('facebook/text', [
        'uses' => 'FacebookRequestsController@textPost',
        'middleware' => 'auth.jwt'
    ]);

    Route::post('facebook/video', [
        'uses' => 'FacebookRequestsController@videoPost',
        'middleware' => 'auth.jwt'
    ]);

    Route::post('webhook', function (){

        //Storage::disk('local')->put('file.txt', 'sss');
        File::put('file.txt', 'contents is written inside file.txt');


    });

    Route::get('test', function (){

        $feed = "https://graph.facebook.com/v3.0/oauth/access_token?client_id=1763872747007373&redirect_uri=http://localhost:4200/login&client_secret=ec97806924ba0ce8cfba00d2b88fce38&code=AQDe9Yt4UqDQt5FbssD-voVZpGohPyFb46OOFk0x1PQvrQZb9bSe3qcW2j3iNn_0fYmjv7Jl9Go0qAE4DysQIPq7-AFi4_Lx9Q6MaOQoOdATafv5l_Ct7hQk0FSga2Ba8Tfe6Oqmnc23kNgdJHrKjW7auJbWZRC297R371q_Gw8CSpZtxnZ3KY6kKsaEwvUIeL76iqUCUo_IPr81m4Of64RMvaTkDIra4mC0wD5K3RJ3yosa2wIiIyWLQaXMgWNyKrNNsPTSIpDvp8_EMIZu3CtBnrAbNw7fumsZc-Xm4ovHZg5xLPIrpyongmnQnlZ6ulrY5W65MTKTd5i7nJYE4WZ9";


        $ch = curl_init($feed);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'H.H\'s PHP CURL script');

        $response_body = curl_exec($ch);
        curl_close($ch);

        /*
         * Unserialize the response body JSON
         */
        dd(json_decode($response_body));


    });

    Route::get('videos', 'VideoController@getVideos');
    Route::get('videos/start', 'VideoController@startVideo');

});
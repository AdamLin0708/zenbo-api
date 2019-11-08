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

Route::post('test', [
    'as' => 'test', 'uses' => 'AuthController@test'
]);

Route::group(['middleware' => ['cors']], function () {

    Route::group(['prefix' => 'api/v1/zapp'], function () {

        /*------ 註冊/登入流程 ------*/

        //判斷帳號是否重複
        Route::post('checkIsValidAccount', [
            'as' => 'zapp.checkIsValidAccount', 'uses' => 'AuthController@checkIsValidAccount'
        ]);

        Route::post('register', [
            'as' => 'zapp.register', 'uses' => 'AuthController@register'
        ]);

        Route::post('login', [
            'as' => 'zapp.login', 'uses' => 'AuthController@login'
        ]);

        Route::post('logout', [
            'as' => 'logout', 'uses' => 'AuthController@logout'
        ]);


        /*------ 影片專區 ------*/
        Route::post('getVideoLists', [
            'as' => 'zapp.getVideoLists', 'uses' => 'VideoController@getVideoLists'
        ]);

        Route::post('getVideoDetail', [
            'as' => 'zapp.getVideoDetail', 'uses' => 'VideoController@getVideoDetail'
        ]);

        Route::post('getQuizLists', [
            'as' => 'zapp.getQuizLists', 'uses' => 'VideoController@getQuizLists'
        ]);

        Route::post('submitVideoQuiz', [
            'as' => 'zapp.submitVideoQuiz', 'uses' => 'VideoController@submitVideoQuiz'
        ]);

    });

});


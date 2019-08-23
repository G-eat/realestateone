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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'auth'], function() {
    Route::post('login' , 'Api\UserController@login');
    Route::post('register' , 'Api\UserController@register');
    Route::post('password/email', 'Api\UserController@sendResetLinkEmail');
    Route::post('password/reset/{token}', 'Api\UserController@reset');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'Api\UserController@logout');
    });
});

Route::group([], function () {
    Route::group(['prefix' => 'article','middleware' => 'auth:api'], function() {
        Route::get('/{sortBy?}', 'Api\ArticleController@index')->where(['sortBy' => 'most-viewed']);
        Route::get('/property/{id}', 'Api\ArticleController@show');
        Route::get('/search', 'Api\ArticleController@search');
    });

    Route::get('/aboutus', 'Api\AboutUsController@index');
    Route::post('/contactus', 'Api\ContactUsController@sendmessage');
});


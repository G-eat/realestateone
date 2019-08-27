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


//authentication
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


//clientside
Route::group([], function () {
    Route::group(['prefix' => 'article'], function() {
        Route::get('/{sortBy?}', 'Api\ArticleController@index');
        Route::get('/property/{id}', 'Api\ArticleController@show');
    });

    Route::get('/search', 'Api\ArticleController@search');

    Route::get('/aboutus', 'Api\AboutUsController@index');
    Route::post('/contactus', 'Api\ContactUsController@sendmessage');
});


//admin dashboard
Route::group([
    'middleware' => ['auth:api'],
], function () {
    Route::get('contact-us', 'Api\ContactUsController@contactus');
    Route::get('about-us', 'Api\AboutUsController@aboutus');
    Route::delete('/contact/delete/{id}', 'Api\ContactUsController@destroy');
    Route::get('/contact/{id}', 'Api\ContactUsController@show');
    Route::put('/update/about-us', 'Api\AboutUsController@update');
});


//dashboard
Route::group(['middleware' => ['auth:api']] , function(){
    Route::get('articles', 'Api\ArticleController@articles');
    Route::post('/create-article', 'Api\ArticleController@store');

    Route::get('/property/{id}', 'Api\ArticleController@showarticlesinfo');
    Route::delete('/article/delete/{id}', 'Api\ArticleController@destroy');
    Route::put('/update-article/{id}', 'Api\ArticleController@update');
});

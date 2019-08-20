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

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::group([] , function() {
    Route::name('article.')->group(function () {
        Route::get('/', 'Client\ArticleController@index');
        Route::get('/card/{sortBy?}', 'Client\ArticleController@index')->where(['sortBy' => 'most-viewed'])->name('all');
        Route::get('/list/{sortBy?}', 'Client\ArticleController@viewList')->where(['sortBy' => 'most-viewed'])->name('all.list');
        Route::get('/property/{id}', 'Client\ArticleController@show')->name('show');
        Route::get('/search', 'Client\ArticleController@search')->name('search');
    });

    Route::get('/aboutus', 'Client\AboutUsController@index')->name('aboutus');
    Route::get('/contactus', 'Client\ContactUsController@index')->name('contactus');
    Route::post('/contactus', 'Client\ContactUsController@sendmessage')->name('send.message');
});


Route::group([
//   'prefix' => 'admin',
], function () {
    Route::group([
       'middleware' => ['auth','preventBackHistory','can:admin'],
    ], function () {
//        Route::get('home', 'Admin\AdminController@index')->name('home');

//        Route::get('articles', 'Admin\AdminController@articles')->name('articles');
        Route::get('contact-us', 'Admin\AdminController@contactus')->name('admin.contactus');
        Route::get('about-us', 'Admin\AdminController@aboutus')->name('admin.aboutus');

//        Route::get('admin/data/articles', 'Admin\ArticleController@articlesdatatable')->name('data.articles');
        Route::get('admin/data/contactsus', 'Admin\ContactUsController@contactusdatatable')->name('data.contactus');

//        Route::delete('/article/delete/{id}', 'Admin\ArticleController@destroy')->name('destroy.article');
        Route::delete('/contact/delete/{id}', 'Admin\ContactUsController@destroy')->name('destroy.contact');

        Route::get('/contact/{id}', 'Admin\ContactUsController@show')->name('contact.show');

//        Route::get('/admin/property/{id}', 'Admin\ArticleController@show')->name('admin.article_show');
//        Route::get('/create-article', 'Admin\ArticleController@create')->name('article.create');
//        Route::post('/create-article', 'Admin\ArticleController@store')->name('article.store');
//        Route::get('/edit/{id}', 'Admin\ArticleController@edit')->name('article.edit');
//        Route::put('/update-article/{id}', 'Admin\ArticleController@update')->name('article.update');

        Route::put('/update/about-us', 'Admin\AboutUsController@update')->name('aboutus.update');
    });
});

Route::group(['middleware' => ['auth']] , function(){
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('articles', 'ArticleController@articles')->name('articles');
    Route::get('/create-article', 'ArticleController@create')->name('article.create');
    Route::post('/create-article', 'ArticleController@store')->name('article.store');

    Route::get('admin/data/articles', 'Admin\ArticleController@articlesdatatable')->name('data.articles');

    Route::get('/admin/property/{id}', 'ArticleController@show')->name('admin.article_show');
    Route::get('/edit/{id}', 'ArticleController@edit')->name('article.edit');
    Route::delete('/article/delete/{id}', 'ArticleController@destroy')->name('destroy.article');
    Route::put('/update-article/{id}', 'ArticleController@update')->name('article.update');
});

Route::group([] , function(){
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});


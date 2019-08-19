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

use Illuminate\Support\Facades\Route;
Route::group([] , function() {
    Route::name('article.')->group(function () {
        Route::get('/', 'Client\ArticleController@index');
        Route::get('/card/{sortBy?}', 'Client\ArticleController@index')->where(['sortBy' => 'most-viewed'])->name('all');
        Route::get('/list/{sortBy?}', 'Client\ArticleController@viewList')->where(['sortBy' => 'most-viewed'])->name('all.list');
        Route::get('/property/{id}', 'Client\ArticleController@show')->name('show');
        Route::get('/search', 'Client\ArticleController@search')->name('search');
    });

    Route::get('/about-us', 'Client\AboutUsController@index')->name('aboutus');
    Route::get('/contact-us', 'Client\ContactUsController@index')->name('contactus');
    Route::post('/contact-us', 'Client\ContactUsController@sendmessage')->name('send.message');
});

Route::group([
   'prefix' => 'admin',
], function () {
    Route::group([
       'middleware' => ['auth','preventBackHistory'],
    ], function () {
        Route::get('home', 'Admin\AdminController@index')->name('home');

        Route::get('articles', 'Admin\AdminController@articles')->name('admin.articles');
        Route::get('contact-us', 'Admin\AdminController@contactus')->name('admin.contactus');
        Route::get('about-us', 'Admin\AdminController@aboutus')->name('admin.aboutus');

        Route::get('/data/articles', 'Admin\ArticleController@articlesdatatable')->name('data.articles');
        Route::get('/data/contactsus', 'Admin\ContactUsController@contactusdatatable')->name('data.contactus');

        Route::delete('/article/delete/{id}', 'Admin\ArticleController@destroy')->name('destroy.article');
        Route::delete('/contact/delete/{id}', 'Admin\ContactUsController@destroy')->name('destroy.contact');

        Route::get('/contact/{id}', 'Admin\ContactUsController@show')->name('contact.show');

        Route::get('/create-article', 'Admin\ArticleController@create')->name('article.create');
        Route::post('/create-article', 'Admin\ArticleController@store')->name('article.store');
        Route::get('/edit/{id}', 'Admin\ArticleController@edit')->name('article.edit');
        Route::put('/update-article/{id}', 'Admin\ArticleController@update')->name('article.update');

        Route::put('/update/about-us', 'Admin\AboutUsController@update')->name('aboutus.update');
    });
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});


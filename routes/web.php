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

Route::name('article.')->group(function () {
    Route::get('/', 'ArticleController@index');
    Route::get('/card/{sortBy?}', 'ArticleController@index')->where(['sortBy' => 'most-viewed'])->name('all');
    Route::get('/list/{sortBy?}', 'ArticleController@viewList')->where(['sortBy' => 'most-viewed'])->name('all.list');
    Route::get('/show/{id}', 'ArticleController@show')->name('show');
    Route::get('/edit/{id}', 'ArticleController@edit')->name('edit');
    Route::get('/search', 'ArticleController@search')->name('search');
});

Route::get('/about-us', 'AboutUsController@index')->name('aboutus');
Route::get('/contact-us', 'ContactUsController@index')->name('contactus');
Route::post('/contact-us', 'ContactUsController@sendmessage')->name('send.message');

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

        Route::get('/data/articles', 'Admin\AdminController@articlesdatatable')->name('data.articles');
        Route::get('/data/contactsus', 'Admin\AdminController@contactusdatatable')->name('data.contactus');

        Route::delete('/article/delete/{id}', 'ArticleController@destroy')->name('destroy.article');
        Route::delete('/contact/delete/{id}', 'ContactUsController@destroy')->name('destroy.contact');

        Route::get('/contact/{id}', 'ContactUsController@show')->name('contact.show');

        Route::get('/create-article', 'ArticleController@create')->name('article.create');
        Route::post('/create-article', 'ArticleController@store')->name('article.store');
        Route::post('/update-article/{id}', 'ArticleController@update')->name('article.update');

        Route::post('/update/about-us', 'AboutUsController@update')->name('aboutus.update');
    });
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});


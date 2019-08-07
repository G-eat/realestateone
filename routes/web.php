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
Route::get('/', 'ArticleController@index');
Route::get('/card/{sortBy?}', 'ArticleController@index')->where(['sortBy' => 'most-viewed'])->name('all_articles');
Route::get('/list/{sortBy?}', 'ArticleController@viewList')->where(['sortBy' => 'most-viewed'])->name('all_articles_view_list');
Route::get('/show/{id}', 'ArticleController@show')->name('article_show');
Route::get('/search', 'ArticleController@search')->name('article_search');

Route::get('/admin', function () {
    return view('admin.welcome');
});

Route::get('/about-us', 'AboutUsController@index')->name('aboutus');
Route::get('/contact-us', 'ContactUsController@index')->name('contactus');
Route::post('/contact-us', 'ContactUsController@sendmessage')->name('send.message');

Route::prefix('admin')->group(function () {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('home', 'HomeController@index')->name('home');
    Route::get('articles', 'AdminController@articles')->name('admin.articles');
    Route::get('contact-us', 'AdminController@contactus')->name('admin.contactus');
    Route::get('about-us', 'AdminController@aboutus')->name('admin.aboutus');
});

Route::post('/update/about-us', 'AboutUsController@update')->name('update.aboutus');

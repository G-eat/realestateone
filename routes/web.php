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

use Illuminate\Contracts\Session\Session;
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
   'middleware' => ['auth','preventBackHistory','can:admin'],
], function () {
    Route::get('contact-us', 'Dashboard\AdminController@contactus')->name('admin.contactus');
    Route::get('about-us', 'Dashboard\AdminController@aboutus')->name('admin.aboutus');

    Route::get('admin/data/contactsus', 'Dashboard\ContactUsController@contactusdatatable')->name('data.contactus');

    Route::delete('/contact/delete/{id}', 'Dashboard\ContactUsController@destroy')->name('destroy.contact');

    Route::get('/contact/{id}', 'Dashboard\ContactUsController@show')->name('contact.show');

    Route::put('/update/about-us', 'Dashboard\AboutUsController@update')->name('aboutus.update');
});


Route::group(['middleware' => ['auth']] , function(){
    Route::get('home', 'Dashboard\HomeController@index')->name('home');
    Route::get('articles', 'Dashboard\ArticleController@articles')->name('articles');
    Route::get('/create-article', 'Dashboard\ArticleController@create')->name('article.create');
    Route::post('/create-article', 'Dashboard\ArticleController@store')->name('article.store');

    Route::get('admin/data/articles', 'Dashboard\ArticleController@articlesdatatable')->name('data.articles');

    Route::get('/admin/property/{id}', 'Dashboard\ArticleController@show')->name('admin.article_show');
    Route::get('/edit/{id}', 'Dashboard\ArticleController@edit')->name('article.edit');
    Route::delete('/article/delete/{id}', 'Dashboard\ArticleController@destroy')->name('destroy.article');
    Route::put('/update-article/{id}', 'Dashboard\ArticleController@update')->name('article.update');
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

Route::get('/language/{locale?}', function ($locale){
    session()->put('locale',$locale);
    return redirect()->back();
})->name('language');


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

Route::get('test/route', function () {
    //return Request::segment(1);
    return Request::segments();
});
Route::pattern('id', '[0-9]+');
Route::get('/', function () {
    return view('welcome');
});
Route::get('news', 'NewsController@news');
Route::get('news/{id}', 'NewsController@show');
Route::post('news/{id}', 'NewsController@Add_comment');

Route::group(['middleware' => 'news'], function () {
    Route::post('insert/news', 'NewsController@insert_news');
    Route::delete('/del/news/{id?}', 'NewsController@delete');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('delete/user/{id}', 'HomeController@deleteUser');
//Auth::routes();

////////////////////// Login As  User  //////////////////////

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
////////////////////// Login As  User  //////////////////////


////////////////////// Login As  Admin  //////////////////////

// Authentication Routes...


// Password Reset Routes...
Route::get('admin/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('admin/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('admin/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('password.reset');
Route::post('admin/password/reset', 'Auth\AdminResetPasswordController@reset');
////////////////////// Login As  Admin  //////////////////////

Route::post('upload/file', 'Upload@upload');

Route::get('event/test', function () {
    return event(new \App\Events\EventTest('Some Text By Event test two'));
});
Route::get('send/message', function () {
    $job = (new \App\Jobs\SendMailJob)
        ->delay(\Carbon\Carbon::now()->addSeconds(5));
    dispatch($job);
    return 'test Send Message';
});
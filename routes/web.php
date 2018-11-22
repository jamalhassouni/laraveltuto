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

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', 'NewsController@test');
//example.com/user/10
Route::get('user/{id?}', function ($id = null) {
    return 'Welcome TO user Page user id  => ' . $id;
})->where('id', '[0-9]+');

Route::resource('users', 'Users');
Route::post('test/1', function (Illuminate\Http\Request $request) {
    return $request->all();
});
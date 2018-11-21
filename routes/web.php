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
Route::get('test',function (){
   return '
    <form method="POST">
     <input type="text" name="foo"/>
    <input type="hidden" name="_token" value="'.csrf_token().'"> 
     <input type="submit" value="send"/>
    </form>
   ';
});
//example.com/user/10
Route::get('user/{id?}',function ($id= null){
   return 'Welcome TO user Page user id  => '.$id;
})->where('id','[0-9]+');
Route::post('test',function (){
   return 'welcome to POST Link '.request('foo');
});
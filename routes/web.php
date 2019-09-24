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
//api重定向路由
Route::get('/apidoc-json/{version?}/{client?}', '\App\Api\ApiDocController@getJson');

Route::get('/', function () {
    return view('welcome');
});
Route::get('test/{id?}','\App\Http\Controllers\TestController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

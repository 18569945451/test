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
use Illuminate\Support\Facades\Route;

Route::get('/apidoc-json/{version?}/{client?}', '\App\Api\ApiDocController@getJson');

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>['auth:web']],function(){

    Route::get('/test','\App\Http\Controllers\TestController@index');

    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();


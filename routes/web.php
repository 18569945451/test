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
Route::group(['middleware'=>['auth']],function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('test','TestController',['names'=>[
        'index' => 'test list', // /test get
        'store' => 'test create',// /test post
        'create' => 'test create list', // /test/create get
        'edit' => 'test edit list', // /test/{id}/edit get
        'update' => 'test update', // /test/{id}  PUT/PATCH
        'show' => 'test show list',// /test/{id} get
        'destroy' => 'test destroy',// /test/{id} DELETE
    ]]);
});

Auth::routes();


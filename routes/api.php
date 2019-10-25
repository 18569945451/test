<?php

use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*Route::group([

    'middleware' => 'api',
    // 'namespace' => 'App\Http\Controllers',// 这一行不需要加，AuthController中已配置namespace，否则运行时会在App\Http\Controllers\App\Http\Controllers\AuthController 下寻找AuthController，从而报找不到控制器的错
    'prefix' => 'auth'

], function ($router) {

    Route::Post('v1/test','\App\Api\V1\Test\Controllers\TestController@create');
    Route::Post('v1/login','\App\Api\V1\Test\Controllers\TestController@login');
    Route::Post('v1/logout','\App\Api\V1\Test\Controllers\TestController@logout');
    Route::Post('v1/refresh','\App\Api\V1\Test\Controllers\TestController@refresh');
    Route::Post('v1/me','\App\Api\V1\Test\Controllers\TestController@me');

});*/

Route::group(['middleware'=>['auth:api']],function(){

    Route::Post('v1/test','\App\Api\V1\Test\Controllers\TestController@create');
    Route::Post('v1/login','\App\Api\V1\Test\Controllers\TestController@login');
    Route::Post('v1/logout','\App\Api\V1\Test\Controllers\TestController@logout');
    Route::Post('v1/refresh','\App\Api\V1\Test\Controllers\TestController@refresh');
    Route::Post('v1/me','\App\Api\V1\Test\Controllers\TestController@me');
});



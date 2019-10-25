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
    return redirect()->route('login');
});

/*Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    $router->get('login', 'LoginController@showLogin')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->post('logout', 'LoginController@logout');

    $router->get('index', 'AdminController@index');
});*/

Route::group(['middleware'=>['auth:web']],function($route){

    //Permission
    $route->resource('permission', 'PermissionController');
    $route->post('permission/add', 'PermissionController@add');//添加处理
    $route->post('permission/edit/{id}', 'PermissionController@edit_dispose');//修改处理
    $route->get('permission/show/{id}', 'PermissionController@show_list');//展示页面

    //role
    $route->resource('role', 'RoleController');
    $route->post('role/add', 'RoleController@add');//添加处理

    //admin
    $route->resource('admin', 'AdminController');
    $route->post('admin/add', 'AdminController@add');//添加处理

    //pay
    $route->get('pay', 'PayController@index'); //订单页面
    $route->post('pay/edit', 'PayController@edit');//创建订单
    $route->get('pay/show', 'PayController@show');//付款页面

    $route->get('success', 'PayController@success');
    $route->post('checkout', 'PayController@checkout');
    //绑定客户
    $route->get('pay/create', 'PayController@create');
    $route->get('pay/show', 'PayController@show');
    $route->get('pay/list', 'PayController@showList');

    //绑定银行卡
    $route->get('card/binding', 'BankCardController@binding');
    $route->get('card/list', 'BankCardController@list');
    $route->get('card/edit', 'BankCardController@binding');




    $route->post('admin/index/index', 'AdminController@woc');


    Route::get('/home', 'PermissionController@index')->name('home');
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


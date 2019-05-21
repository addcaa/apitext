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
//注册
Route::get('token/reg','Token\TokenController@reg');
Route::post('token/regdo','Token\TokenController@regdo');
//调用token
Route::get('token/token','Token\TokenController@token');
//查看状态
Route::get('token/state','Token\TokenController@state');
Route::post('token/statedo','Token\TokenController@statedo');
//个人中心
Route::get('token/index','Token\TokenController@index');
//登录
Route::get('token/appid','Token\TokenController@appid');
Route::post('token/appiddo','Token\TokenController@appiddo');
//调用ip
Route::get('token/ip','Token\TokenController@ip');
//接口
Route::get('access/access_token','Access\AccessTokenController@access_token');
Route::get('access/ip','Access\AccessTokenController@ip')->middleware('token');
Route::post('access/reg','Access\AccessTokenController@reg')->middleware('token');
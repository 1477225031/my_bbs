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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','PagesController@root')->name('root');
Auth::routes(['verify' => true]); //定义了脚手架的所有路由,注册,登录,修改密码等

Route::get('/home', 'HomeController@index')->name('home');

//用户登录相关的路由


Route::get('/home', 'HomeController@index')->name('home');
//用户展示,更新,修改
Route::resource('users','UsersController',['only' => ['show','update','edit']]);
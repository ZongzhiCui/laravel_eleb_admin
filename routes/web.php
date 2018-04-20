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

//商铺分类表
Route::get('/','CategoryController@index');//暂时首页跳到分类列表
Route::resource('category','CategoryController');

//后台添加商户
Route::resource('shop','ShopUserController');
//后台管理员
Route::resource('admin','AdminController');
//审查在shop.edit

//后台登录
Route::get('login','LoginController@create')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::delete('logout','LoginController@destroy')->name('logout');

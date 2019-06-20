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

#  / 根路径 

// 代表  服务器上的绝对地址 : 域名后面 以 / 开头的字符串
// Route::get('/匹配服务器上的绝对地址'，'callbackk');


// // Route 路由
// Route::get('/',function() {
// 	return view('welcome');
// });
//后台-首页
Route::get('admin', 'Admin\IndexController@index');










































































//前台主页
Route::get('/','Home\IndexController@index');

//前台列表页
Route::get('home/list','Home\ListController@index');

//前台详情页
Route::get('home/detail','Home\DetailController@index');

//商品收藏
Route::get('/home/goods/addColl','Home\GoodsController@addColl');

//加入购物车
Route::get('/home/goods/addCar','Home\GoodsController@addCar');



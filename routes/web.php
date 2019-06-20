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


// Route 路由
Route::get('/',function() {
	echo 'asasda';
	return view('welcome');
});
//后台-首页
Route::get('index', 'Admin\IndexController@index');


















































































//商品路由 
Route::get('admin/goods/status/{id}', 'Admin\GoodsController@status');
Route::resource('admin/goods', 'Admin\GoodsController');
//商品详情
Route::get('admin/detail/del/{id}','Admin\DetailController@del');
Route::resource('admin/detail', 'Admin\DetailController');
//商品图集
Route::get('admin/phtoto/del/{id}','Admin\PhtotoController@del');
Route::resource('admin/phtoto', 'Admin\PhtotoController');

//订单路由
Route::resource('admin/orders', 'Admin\OrdersController');

//评价管理路由
Route::get('admin/comment/status','Admin\CommentController@status');
Route::resource('admin/comment', 'Admin\CommentController');

//秒杀商品路由
Route::get('admin/seckills/status/{id}','Admin\SeckillsController@status');
Route::resource('admin/seckills','Admin\SeckillsController');

//活动商品路由
Route::get('admin/activities/status/{id}','Admin\ActivitiesController@status');
Route::resource('admin/activities','Admin\ActivitiesController');


//前台 商品信息模板 路由
Route::get('home/activities/index','Home\ActivitiesController@index');
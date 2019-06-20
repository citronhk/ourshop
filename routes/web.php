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

Route::group(['middleware'=>'home_login'],function(){
        //个人中心 个人信息页面
		Route::get('home/personal','Home\PersonalController@index');
		//个人信息修改
		Route::get('home/personal/edit','Home\PersonalController@edit');
		//个人信息修改执行
		Route::post('home/personal/update','Home\PersonalController@update');
		//购物车主页面
		Route::get('home/car/index','Home\CarController@index');
		//购物车删除
		Route::get('home/car/delete','Home\CarController@delete');
		//购物车 确认结算
		Route::get('home/car/buyorder','Home\CarController@buyorder');
		//确认订单
		Route::get('home/order/index','Home\OrderController@index');

		                                                                             
});	

//后台-首页
Route::get('admin', 'Admin\IndexController@index');
//前台注册
Route::get('home/register','Home\RegisterController@index');
//前台手机注册
Route::get('home/register/sendPhone','Home\RegisterController@sendPhone');
//执行手机注册
Route::post('home/register/store','Home\RegisterController@store');
//执行邮箱注册
Route::post('home/register/insert','Home\RegisterController@insert');
//邮箱激活
Route::get('home/register/changeStatus/{id}/{token}','Home\RegisterController@changeStatus');
//前台登录页面
Route::get('home/login','Home\LoginController@login');
//执行手机登录操作
Route::post('home/dologin','Home\LoginController@dologin');
//执行邮箱登录操作
Route::post('home/sign','Home\LoginController@sign');
//执行邮箱登录操作
Route::get('home/loginout','Home\LoginController@loginout');














//后台分类 路由
Route::resource('admin/cates','Admin\CatesController');
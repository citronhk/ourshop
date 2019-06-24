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













































































































































//前台 商品信息模板 路由
Route::get('home/activities/index','Home\ActivitiesController@index');







//后台-登录页面
Route::get('admin/login', 'Admin\LoginController@login');
Route::post('admin/dologin', 'Admin\LoginController@dologin');
Route::get('admin/outlogin', 'Admin\LoginController@outlogin');

Route::get('admin/rbac',function(){
  return view('admins.rbac');	
});

Route::group(['middleware'=>['login']],function(){
	//后台-首页
	Route::get('admin/index', 'Admin\IndexController@index');

	//后台-个人中心-修改密码
	Route::post('admin/users/changepass', 'Admin\UsersController@changepass');
	//后台-个人中心-修改头像
	Route::post('admin/users/changeimg', 'Admin\UsersController@changeimg');

	//用户激活状态
	Route::get('admin/users/changeStatus/{id}', 'Admin\UsersController@changeStatus');
	//后台-用户管理
	Route::resource('admin/users', 'Admin\UsersController');

	//修改轮播图状态
	Route::get('admin/banners/changeStatus/{id}', 'Admin\BannersController@changeStatus');
	//后台-轮播图管理
	Route::resource('admin/banners', 'Admin\BannersController');

	//后台-管理员管理
	Route::resource('admin/admins', 'Admin\AdminsController');

	//后台-友情链接管理
	Route::resource('admin/links', 'Admin\LinksController');

	//修改广告状态
	Route::get('admin/ads/changeStatus/{id}', 'Admin\AdsController@changeStatus');
	//后台-广告管理
	Route::resource('admin/ads', 'Admin\AdsController');

    //后台-角色管理
	Route::resource('admin/roles', 'Admin\RolesController');
	
    //后台-节点权限管理
	Route::resource('admin/nodes', 'Admin\NodesController');

<<<<<<< HEAD
    //后台-收货地址管理
	Route::resource('admin/addrs', 'Admin\AddrsController');
    
=======

>>>>>>> root/wnuo




//志豪路由
 
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

});








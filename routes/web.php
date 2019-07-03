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
		//确认订单2
		Route::get('home/order/index','Home\OrderController@index');
		//订单生成
		Route::post('home/order/result','Home\OrderController@result');
		//支付
		Route::get('home/order/pay','Home\OrderController@pay');
		//我的订单
		Route::get('home/order/list','Home\OrderController@list');
		//我的订单 确认收货
		Route::get('home/order/confirm','Home\OrderController@confirm');
		//我的订单 待发货
		Route::get('home/order/deliver','Home\OrderController@deliver');
		//前台设置默认地址
		Route::get('/home/addr/changestatus/{id}','Home\AddrController@changestatus');
		//前台用户收货地址
		Route::resource('home/addr','Home\AddrController');	
		//前台评论页面	
		Route::get('/home/comment/evaluate','Home\CommentController@evaluate');
		//前台执行评论
		Route::get('/home/comment/comment','Home\CommentController@comment');
		//前台查看用户所有评论
		Route::get('/home/comment/index','Home\CommentController@index');
		//购物车订单 秒杀订单生成
		Route::get('/home/car/seckills','Home\CarController@seckills');
		//购物车订单 秒杀订单确认
		Route::get('/home/order/seckills','Home\OrderController@seckills');
		//收藏页面
		Route::get('home/colls/index','Home\CollsController@index');
		//足迹页面
		Route::get('home/records/index','Home\RecordsController@index');
                                                                       
});	

//前台主页
Route::get('/','Home\IndexController@index');

//站点新闻
Route::get('/news','News\IndexController@index');

Route::get('/news/list','News\ListController@index');

//获取时间
Route::get('/home/time','Home\IndexController@getTime');


//前台列表页
Route::get('home/list','Home\ListController@index');

//前台详情页
Route::get('/home/detail','Home\DetailController@index');

//前台评论
Route::get('/home/detail/publish','Home\DetailController@publish');

//商品收藏
Route::get('/home/goods/addColl','Home\DetailController@addColl');

//加入购物车
Route::get('/home/goods/addCar','Home\DetailController@addCar');


//商品特买
Route::get('/skill/index','Skill\SkillController@index');

//商品特买
Route::get('/skill/pre','Skill\SkillController@pre');

Route::get('/skill/end','Skill\SkillController@end');

//商品抢购
Route::get('/skill/buy','Skill\BuyController@index');

//提交数据
Route::post('/skill/sub','Skill\BuyController@handle');


//商品路由 



//前台 商品信息模板 路由
Route::get('home/activities/index','Home\ActivitiesController@index');


//后台-首页
Route::get('admin/index', 'Admin\IndexController@index');

//后台-首页
Route::get('admin', 'Admin\IndexController@index');

//后台分类 路由
Route::resource('admin/cates','Admin\CatesController');

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

    //后台-收货地址管理
	Route::resource('admin/addrs', 'Admin\AddrsController');
    



	Route::get('admin/goods/status/{id}', 'Admin\GoodsController@status');
	Route::resource('admin/goods', 'Admin\GoodsController');
	//商品详情
	Route::get('admin/detail/del/{id}','Admin\DetailController@del');
	Route::resource('admin/detail', 'Admin\DetailController');
	//商品图集
	Route::get('admin/photo/del/{id}','Admin\PhotoController@del');
	Route::resource('admin/photo', 'Admin\PhotoController');

	//订单路由
	Route::post('admin/orders/upUser','Admin\OrdersController@upUser');
	Route::get('admin/orders/infoUser','Admin\OrdersController@infoUser');
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
	//活动广告特卖路由
	Route::post('admin/adsact/upUrl','Admin\AdsactController@upUrl');
	Route::get('admin/adsact/url','Admin\AdsactController@url');
	Route::resource('admin/adsact','Admin\AdsactController');


	//前台 商品信息模板 路由
	Route::get('home/activities/index','Home\ActivitiesController@index');

});
<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Car;
use App\Models\Users;
class CarController extends Controller
{	
	/**
	 * [获取登录用户购物车信息]
	 * @param session('home_userinfo')
	 * @return $car
	 */
	public static function cardata(){
		$id = session('home_userinfo')->id;
    	$user = Users::find($id);
    	$car = $user->usercar;
    	return $car;
	}

	/**
	 * [购物车页面]
	 * @param session('home_userinfo')
	 * @param Goods(Models)
	 * @return /home/car/index
	 */
    public function index()
    {	
    	//获取当前登录用户购物车信息
    	$car = self::cardata();
    	
    	return view('home.car.index',['car'=>$car]);
    }

    /**
	 * [购物车页面 删除]
	 * @param id 购物车表中id
	 * @param Goods(Models)
	 * @return /home/car/index
	 */
	public function delete(Request $request){
		$id = $request->input('id');
		$car = Car::find($id);
		$res = $car->delete();
		// dd($res);
		echo '删除成功';
	}

	/**
	 * [购物车页面 确认订单]
	 * @param num 商品数量
	 * @param Goods(Models)
	 * @return /home/car/index
	 */
	public function buyorder(Request $request)
	{
		$num = $request->input('num');

		//获取当前登录用户购物车信息
    	$car = self::cardata();
    	
    	foreach ($car as $key => $value) {
    		$cid = $car[$key]->id ;
    		$buycar = Car::find($cid);
    		$buycar->num = $num[$key];
    		$buycar->save();
    	}
    	
    	return redirect('/home/order/index');

	}
}

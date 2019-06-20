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
	 * [购物车页面]
	 * @param session('home_userinfo')
	 * @param Goods(Models)
	 * @return /home/car/index
	 */
    public function index()
    {	
    	$id = session('home_userinfo')->id;
    	$user = Users::find($id);
    	$car = $user->usercar;
    	
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

	public function buyorder(Request $request)
	{
		$num = $request->input('num');

		$id = session('home_userinfo')->id;
    	$user = Users::find($id);
    	$car = $user->usercar;
    	foreach ($car as $key => $value) {
    		$cid = $car[$key]->id ;
    		$buycar = Car::find($cid);
    		$buycar->num = $num[$key];
    		$buycar->save();
    	}
    	
    	return redirect('/home/personal');

	}
}

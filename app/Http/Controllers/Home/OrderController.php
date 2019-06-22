<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Car;
use App\Models\Users;
use App\Models\orders_infos;
use App\Models\Orders_users;
use DB;
class OrderController extends Controller
{   
    /**
     * 封装方法
     * @param 
     * @return 用户所有订单内商品详情
     */
    public static function orderInfo()
    {
        //获取当前用户id
        $id = session('home_userinfo')->id;

        //获取当前用户全部订单
        $orders_user = Orders_users::where('uid','=',$id)->get();

        //获取订单收货人信息详情
        $order_user = [];
        foreach ($orders_user as $k => $v) {
            $order_user[$k] =  $v->orderUserInfo;
        };

        //获取订单内商品详情
        $order_info = [];
        foreach ($order_user as $k=>$v) {
            foreach ($v as $kk=>$vv) {
                $order_info[] = $vv;
            };
        };
        return $order_info;
    }


    /**
     * 订单生成
     * @param 
     * @return view 
     */
    public function index()
    {
    	//获取当前登录用户购物车信息
    	$car = CarController::cardata();

    	return view('home.order.index',['car'=>$car]);
    }

    /**
     * 确认订单 填写收货人信息
     * @param Request
     * @return view 
     */
    public function result(Request $request)
    {
    	$this->validate($request, [
    		'phone' => 'required',
    		'order_name' => 'required',
    		'order_addr' => 'required',

            
        ],[
        	'phone.required' => '收货人手机号不能为空',
        	'order_name.required' => '收货人姓名不能为空',
        	'order_addr.required' => '收货人地址不能为空',
            
        ]);

    	 //开启事务
       	DB::beginTransaction();

       	
       		//获取当前登录用户购物车信息
    		$car = CarController::cardata();
    		$id = session('home_userinfo')->id;
	    	
	    	$message = $request->input('message','');
	    	
	    	$order_number = date('Ymd').rand(100000000,999999999).rand(1000,9999);

	    	// 捕获异常
       		try{

       			$orders_user = new Orders_users;
		    	$orders_user->uid = $id;
		    	$orders_user->message = $message;
		    	$orders_user->phone = $request->input('phone');
		    	$orders_user->postal = $request->input('postal','');
		    	$orders_user->order_addr = $request->input('order_addr');
		    	$orders_user->order_number = $order_number;
		    	$orders_user->total = $request->input('total');
		    	$res2 = $orders_user->save();

		    	//抛出异常
			    	if($res2 === false){
			    		throw new Exception("Error Processing Request", 1);	
			    	};

			    $oid = $orders_user->id;
		    	foreach ($car as $key => $value) {

		    		$order = new orders_infos;
			    	$order->order_name = $request->input('order_name','');	
			    	$order->order_addr = $request->input('order_addr','');
			    	$order->order_number = $order_number;
			    	$order->oprice = $value->cargood->price;
			    	$order->number = $value->num;
			    	$order->otime = date('Y-m-d H:i:s',time());
		    		$order->gid = $value->gid;
		    		$order->oid = $oid;
			    	$res = $order->save();
			    	//抛出异常
				    	if($res === false){
				    		throw new Exception("Error Processing Request", 1);
				    		
				    	};
	    		
		    	};

		    	
		    	
		    	
		    	//事务提交
		    	DB::commit();
		//捕获异常
       	}catch(\Exception $e){
       		//事务回滚
       		DB::rollBack();
       		return redirect('home/order/index')->with('success','下单异常');
       	}
		return view('home.order.result',['orders_user'=>$orders_user,'car'=>$car]);
    }

    /**
     * 订单支付
     * @param 
     * @return view 
     */
    public function pay()
    {
    	//获取当前登录用户购物车信息
    	$car = CarController::cardata();

    	
    	$temp = []; 
    	foreach($car as $k=>$v){
    		$temp[] = $v->id;
    	}
    	// dd($temp);
		Car::destroy($temp);

    	return view('home.order.pay',['car'=>$car]);
    }

    /**
     * 用户订单列表
     * @param CarController方法，
     * @return view 
     */
    public function list()
    {
    	//获取当前登录用户购物车信息
    	$car = CarController::cardata();
        //获取用户所有订单内商品详情
        $order_info = self::orderInfo();

        $a = 0;
        $b = 0;
        $c = 0; 
        foreach($order_info as $k=>$v){
            if($v->status == 0){
                $a++; 
            } else if($v->status == 1){
                $b++;
            }else {
                $c++;
            }
        }
        
    	return view('home.order.list',[
            'car'=>$car,
            'order_info'=>$order_info,
            'a'=>$a,
            'b'=>$b,
            'c'=>$c,
        ]);

    }

    /**
     * 修改订单状态
     * @param Request
     * @return view 
     */
    public function confirm(Request $request)
    {
        $id = $request->input('id');
        
        $data = orders_infos::find($id);
        $data->status = 2;
        $res = $data->save();

         if($res){
            echo json_encode(['msg'=>'ok','info'=>'修改成功']);
            
        }else{
            echo json_encode(['msg'=>'err','info'=>'修改失败']);
            
        }
    }
    /**
     * 用户订单列表(状态)
     * @param CarController方法，
     * @return view 
     */
    public function deliver(Request $request)
    {
        $status = $request->input('status');
        //获取当前登录用户购物车信息
        $car = CarController::cardata();
        //获取用户所有订单内商品详情
        $order_info_data = self::orderInfo();

        $a = 0;
        $b = 0;
        $c = 0; 
        foreach($order_info_data as $k=>$v){
            if($v->status == 0){
                $a++; 
            } else if($v->status == 1){
                $b++;
            }else {
                $c++;
            }
        }
        
        $order_info = [];
        foreach ($order_info_data as $key => $value) {
            if($value->status == $status){
                $order_info[] = $value;
            }
        }
        return view('home.order.list',[
            'car'=>$car,
            'order_info'=>$order_info,
            'a'=>$a,
            'b'=>$b,
            'c'=>$c,
        ]);

    }
}

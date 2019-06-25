<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Car;
use App\Models\Users;
use App\Models\Addrs;
use App\Models\orders_infos;
use App\Models\Orders_users;
use DB;
use App\Models\Comment;
class OrderController extends Controller
{   
    /**
     * 封装方法
     * @param 
     * @return 用户所有订单内商品指定状态数量
     */
    public static function order_status()
    {
        //获取当前用户id
        $id = session('home_userinfo')->id;

        //获取当前用户全部订单
        $orders_user = Orders_users::where('uid','=',$id)->orderBy('created_at', 'desc')->get();
        
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

        $a = 0;
        $b = 0;
        $c = 0; 
        $d = 0;
        foreach($order_info as $k=>$v){
            if($v->status == 0){
                $a++; 
            } else if($v->status == 1){
                $b++;
            }else if($v->status == 2){
                $c++;
            }else if($v->status == 3){
                $d++;
            }
        };

        $order_count = [];
        $order_count[0] = $a;
        $order_count[1] = $b;
        $order_count[2] = $c;
        $order_count[3] = $d;

        return $order_count;
    }

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
        $orders_user = Orders_users::where('uid','=',$id)->orderBy('created_at', 'desc')->get();
        
        //获取订单收货人信息详情
        $order_user = [];
        foreach ($orders_user as $k => $v) {
            $order_user[$k] =  $v->orderUserInfo;
        };

        

        //获取订单内商品详情
        $order_info = [];
        foreach ($order_user as $k=>$v) {
            foreach ($v as $kk=>$vv) {
                $vv['pic'] = $vv->orders_goods->pic;
                $order_info[] = $vv;

            };
        };

       
        //页码,默认为1
        $page = $_GET['page'] ?? 1;
        //每页显示数量
        $pagesize = 5;

        $order_info = new \Illuminate\Pagination\LengthAwarePaginator($order_info,count($order_info),$pagesize);
        $order_info->withPath('/home/order/list');

        $count = $order_info->total();//总条数
        $start=($page-1)*$pagesize;//偏移量，当前页-1乘以每页显示条数
        $order_info->setCollection(collect(array_slice($order_info->getCollection()->toArray(),$start,$pagesize)));

        return $order_info;
    }

    /**
     * 封装方法
     * @param $status 状态
     * @return 用户所有订单内商品详情+状态
     */
    public static function orderInfoStatus($status,$pagesize,$path)
    {
        //获取当前用户id
        $id = session('home_userinfo')->id;
        //获取当前用户全部订单
        $orders_user = Orders_users::where('uid','=',$id)->orderBy('created_at', 'desc')->get();        
        //获取订单收货人信息详情
        $order_user = [];
        foreach ($orders_user as $k => $v) {
            $order_user[$k] =  $v->orderUserInfo;
        };
        //获取订单内商品详情
        $order_info_data = [];
        foreach ($order_user as $k=>$v) {
            foreach ($v as $kk=>$vv) {
                $vv['price'] = $vv->orders_goods->price;
                $vv['gname'] = $vv->orders_goods->gname;
                $vv['pic'] = $vv->orders_goods->pic;
                $order_info_data[] = $vv;
            };
        };
        //获取该状态下商品
       $order_info = [];
        foreach ($order_info_data as $key => $value) {
            
            if($value['status'] == $status){
                $order_info[] = $value;
            }
        };

        $page = $_GET['page'] ?? 1;
        

        $order_info = new \Illuminate\Pagination\LengthAwarePaginator($order_info,count($order_info),$pagesize);
        $order_info->withPath($path);

        $count = $order_info->total();//总条数
        $start=($page-1)*$pagesize;//偏移量，当前页-1乘以每页显示条数
        $order_info->setCollection(collect(array_slice($order_info->getCollection()->toArray(),$start,$pagesize)));

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
        //获取当前用户id
        $id = session('home_userinfo')->id;
        //获取用户默认地址
        $addr = Addrs::where('uid',$id)->where('status','=','1')->get();
        
        if(!empty($addr[0])){
    	   return view('home.order.index',['car'=>$car,'addr'=>$addr]); 
        }else{
           return view('home.order.index2',['car'=>$car]); 
        }

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
                    $order->status = rand(0,3);
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
        //获取用户订单商品状态
        $order_status = self::order_status();
        
    	return view('home.order.list',[
            'car'=>$car,
            'order_info'=>$order_info,
            'order_status'=>$order_status,
            
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
        $path = '/home/order/deliver?status='.$status;
        //获取用户所有订单内商品详情
        $order_info = self::orderInfoStatus($status,5,$path);

        //获取用户订单商品状态
        $order_status = self::order_status();
        
        

        return view('home.order.list',[
            'car'=>$car,
            'order_info'=>$order_info,
            'order_status'=>$order_status,
        ]);
    }

    /**
     * 秒杀订单生成
     * @param 
     * @return view 
     */
    public function seckills(Request $request)
    {
        //获取当前登录用户购物车信息
        $car = CarController::cardata();
        //获取当前用户id
        $id = session('home_userinfo')->id;
        //获取用户默认地址
        $addr = Addrs::where('uid',$id)->where('status','=','1')->get();

        $id = session('home_userinfo')->id;
        $user = Users::find($id);
        $car2 = $user->usercar;
        
        //获取购物车中秒杀商品
        $seckills = [];
        foreach ($car2 as $key => $value) {
            if ($value->status == 1) {
                $seckills[] = $value;
            }
        }
        $gid = $seckills[0]->gid;
        $aid = $request->input('aid');
        $data = DB::table('act_goods')->where('aid',$aid)->where('gid',$gid)->first();
        // dump($gid);
        // dump($aid);
        // dd($data);
        
        if(!empty($addr[0])){
           return view('home.order.seckills',[
                            'car'=>$car,
                            'addr'=>$addr,
                            'seckills'=>$seckills,
                            'data'=>$data,
                        ]); 
        }else{
           return view('home.order.seckills2',[
                            'car'=>$car,
                            'seckills'=>$seckills,
                            'data'=>$data,
                        ]); 
        }

    }
    
}

<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsController extends Controller
{
    //
	public function addColl(Request $request)
	{
		//获取商品id
		$gid = $request->input('id',0);
		// $gid = 100;
		$uid = 109;
		$data = DB::table('goods_colls')->where('uid',$uid)->get();
		$coll_list = [];

		foreach ($data as $key => $value) {
			$coll_list[] = $value->gid;
		}

		//查询是商品id 否存在数据中
		$status = in_array($gid, $coll_list);
       	if($status){
		   echo json_encode(['msg'=>'alreadly']);
		    exit;
		}

		if(!$status){
			//压入数据
			$res = DB::table('goods_colls')->insert(['uid'=>$uid,'gid'=>$gid]);
			if($res){
				echo json_encode(['msg'=>'success']);
				exit;
			}

		}else{
		     echo json_encode(['msg'=>'error']);
		}
	}


	public function addCar(Request $request)
	{
		//获取商品id
		$gid = $request->input('id',0);
		// //加入购物车数量
		$num = $request->input('num',0);

		//当前用户id
		$uid = 109;

		//获取当前用户的购车数据
        $data =  DB::table('car')->where('uid',$uid)->get();

        //定义数组接收,收藏商品id
        //format id=>gid
        $car_list = [];
       
        //定义数组接收,收藏商品id=>数量
        //format gid=>num
        $car_num = [];


        //遍历数组,获取该用户的购物车中的商品id
        if(isset($data)){
       		foreach ($data as $key => $value) {
      			$car_list[$value->id] = $value->gid;
      			$car_num[$value->gid] = $value->num;
      		}
        }

       //检测当前要加入购物车的商品id,是否存已经存在
       if(in_array($gid, $car_list)){

       		//如果存在,则
       		$num = $car_num[$gid] + $num;
       		
       		//把数据压入
       		$res = DB::table('car')
       			->where('uid',$uid)
       			->where('gid',$gid)
       			->update(['num' => $num]);

       }else{
       		 //如何不存在,
       		 //把数据压入
       		$res = DB::table('car')->insert(['uid'=>$uid,'gid'=>$gid,'num'=>$num]);
       }

       //返回提示结果
       	if($res){
		    echo json_encode(['msg'=>'success']);
		    exit;
		}else{
		     echo json_encode(['msg'=>'error']);
		     exit;
		}
	}


	//记录每点击一个商品
	public function addRecord($uid,$gid)
	{
		$record_list = [];
		$data = $this->getRecordsByUid($uid);

		foreach ($data as $key => $value) {
			$record_list[] = $value->gid;
		}
		$res = DB::table('good_records')->insert([]);
	}

	public function getRecordsByUid($uid)
	{
		//orderby(time,desc)
		return DB::table('goods_records')->where('uid',$uid)->get();
	}

	public function getRecordsByUidTake()
	{
		
	}


}

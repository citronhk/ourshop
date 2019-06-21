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

	/**
	 * 记录浏览记录 
	 *	
	 *	@param $request 请求参数
	 *  @return 返回json数据
	 */
	public function addRecord(Request $request)
	{
		//接收用户id
		$uid = $request->input('uid',0);
		//接收商品id
		$gid = $request->input('id',0);

		//搜索该用户的浏览记录
		$record_list = $this->getRecordsByUid($uid);

		//判断当前用户是否已经浏览过该商品
		if(in_array($gid, $record_list)){
			//if true ,exit;
			exit;
		}

		//如果不存在数组中
		//则向数据库压入数据
		//返回记录数据
		$res = DB::table('goods_records')->insert(['uid'=>$uid,'gid'=>$gid]);
		if($res){
			echo json_encode(['msg'=>'success']);
		}else{
			echo json_encode(['msg'=>'error']]);
		}
	}

	/**
	 *	获取当前用户的浏览商品记录 
	 *	
	 * @param $uid 当前用户id
	 * @return 返回记录数组
	 */
	public function getRecordsByUid($uid)
	{
		//
		$data =  DB::table('goods_records')->where('uid',$uid)->get();

		//定义一个数组,接收商品记录id
		$record_list = [];

		foreach ($data as $key => $value) {
			//压入数据
			$record_list[] = $value->gid;
		}

		return $record_list;
	}

	/**
	 *	记录商品点击量 
	 *	@param $pid商品id
	 *  @return 
	 */


	
	public function addGoodsBrows($pid)
	{

		//通过商品id,获取该商品的浏览量
		$num = DB::table('goods')->select('clickNum')->where('id',$pid)->first();
		$num = $num + 1;

		//浏览量+1
		DB::table('goods')->where('id',$gid)->updata(['clickNum'=>$num]);

	}









}

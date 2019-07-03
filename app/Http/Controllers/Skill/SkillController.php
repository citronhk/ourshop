<?php

namespace App\Http\Controllers\Skill;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\DetailController;
use App\Models\Goods;
use App\Models\Activities;
use App\Models\Act_goods;
use Illuminate\Support\Facades\Redis;


//商品展示层
class SkillController extends Controller
{
 	/**
     * 渲染商品特买会场
     */
    public function index()
    {	
        //获取和设置商品数据缓存
        if(Redis::exists('goods_datas_skill_redis')){
            $goods_datas = json_decode(Redis::get('goods_datas_skill_redis'));
        }else{
            $goods_datas = self::getGoodsDataById();
            Redis::setex('goods_datas_skill_redis',600,json_encode($goods_datas));
        }

        //获取近期每一一个要执行的任务
        $aid = self::getCurrentTask()->id;
        //获取购物车
        $cars = DetailController::getCarCount();

        
        //显示倒计时页面 -> 活动进行 ->结束
    	return view('home.skill.now.index',[
                                            'aid'=>$aid,
                                            'goods_datas'=>$goods_datas,                 
                                             //显示购物车
                                            'cars'=>$cars
                                            ]);
    }

    public function pre()
    {	
        //获取和设置商品数据缓存
        if(Redis::exists('goods_datas_skill_redis')){
            $goods_datas = json_decode(Redis::get('goods_datas_skill_redis'));
        }else{
            $goods_datas = self::getGoodsDataById();
            Redis::setex('goods_datas_skill_redis',600,json_encode($goods_datas));
        }

        //获取近期每一一个要执行的任务
        $aid = self::getCurrentTask()->id;

        //获取购物车
        $cars = DetailController::getCarCount();

    	return view('home.skill.before.index',[
                                            'aid'=>$aid,
                                            'goods_datas'=>$goods_datas,                 
                                             //显示购物车
                                            'cars'=>$cars
                                            ]);
    }

    public function end()
    {	
        //获取和设置商品数据缓存
        if(Redis::exists('goods_datas_skill_redis')){
            $goods_datas = json_decode(Redis::get('goods_datas_skill_redis'));
        }else{
            $goods_datas = self::getGoodsDataById();
            Redis::setex('goods_datas_skill_redis',600,json_encode($goods_datas));
        }

        //获取近期每一一个要执行的任务
        $aid = self::getCurrentTask()->id;

        //获取购物车
        $cars = DetailController::getCarCount();

    	return view('home.skill.after.index',[
                                            'aid'=>$aid,
                                            'goods_datas'=>$goods_datas,                 
                                             //显示购物车
                                            'cars'=>$cars
                                            ]);
    }

    /**
     * 获取最近近一个要执行的任务
     * @param
     * @return
     */
    public static function getCurrentTask()
    {
        return  Activities::where('status',1)->orderBy('startTime','asc')->first();
    }

    /**
     *  活动商品信息
     *  @param $aid 
     *  @return 
     */
    public function getGoodsId()
    {	
    	//获取近期每一一个要执行的任务
    	$aid = self::getCurrentTask()->id;
    	
        //通过任务id 获取参与活动的所有商品
    	$act_goods =  Act_goods::where('aid',$aid)->get();

    	//定义数组接收本场活动商品id
    	$goods_id_list = [];

    	foreach ($act_goods as $k => $v){
    		$goods_id_list[] = $v->gid;
    	}

        //返回一个数据,活动-商品属性,商品id数组
    	return [$act_goods,$goods_id_list];
    }

    /**
     * 查询商品数据
     * @param 
     * @return 返回商品数据
     */
    public function getGoodsDataById()
    {	
        //获取活动开始时间
        $start = self::getCurrentTask()->startTime;

        //获取活动结束时间
        $end = self::getCurrentTask();

        //接收 活动-商品属性,商品id数组
        $arry= self::getGoodsId();
     
     
        //商品活动属性
        $goods_attr = $arry[0];

        $attrs = [];
        foreach ($goods_attr as $k=>$v) {
            //定义一个商品折扣属性 gid => 折扣
             $attrs[$v->gid] = $v->discount;
        }

        // dump($attrs);

        //商品id数组
        $goods_id_list = $arry[1];
    	   
      

        $goods_datas = Goods::whereIn('id',$goods_id_list)->get();

        foreach($goods_datas as $k=>$v){

            //原数据追加一个折扣属性 
            $goods_datas[$k]['discount'] = $attrs[$v->id];

            //原数据追加一个开始时间属性 
            $goods_datas[$k]['start'] =  $start;

            //原数据追加一个结束时间属性 
            $goods_datas[$k]['end'] = $end;

        }


    	return $goods_datas;

    }	



}
<?php

namespace App\Http\Controllers\Skill;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\DetailController;
use DB;
use Illuminate\Support\Facades\Redis;

class BuyController extends Controller
{
    /**
     * 显示首页
     * @param 
     * @return 首页视图,数据
     */
    public function index(Request $request)
    {
        //接收请求id
        $gid = $request->input('id',0);

        //接收请求商品售卖类型 
        //0:普通类型 ,1:限时特买
        $aid = $request->input('aid',0);

        $uid = 8;


        //获取当请求id的商品数据
        $goods_attr = DetailController::getGoodsAttrById($gid);

        //分类id
        $cid = $goods_attr['cid'];

        //
        $like_goods_data = DetailController::getUseLikeByCid($cid);

        //商品评论
        $comment_data = DetailController::getCommentByGid($gid);
        
        //商品图集
        $goods_photo = DetailController::getDescPhotoByid($gid);

        $result = in_array($gid, DetailController::GetGoodsListByUid($uid));

        //点击量+1
        DetailController::addGoodsBrows($gid);

        //记录用户浏览记录
        DetailController:: addRecord($gid,$uid);

    	//返回详情页视图  
    	return view('home.skill.buy',['aid'=>$aid,
                                         'id'=>$gid,  
                                         'goods_attr'=>$goods_attr,
                                         'like_goods_data'=>$like_goods_data,
                                         'goods_photo'=>$goods_photo,
                                         'comment_data'=>$comment_data,
                                         'result' =>$result
                                        ]);
    }

    /**
     * 处理用户提抢购商品数据
     * @param $request-> $aid 活动场次id ,$gid 商品id ,$num 购买数据
     *  
     */
    public function handle(Request $request)
    {

        // $aid = $request->input('aid');
        $aid = 8;
        $gid = $request->input('gid');
        self::makeGoodsUserList($aid,$gid);
        // $res =  self::getData($gid);
        // echo $res;
    }

    /**
     * 构建用户抢购商品队列,压入nosql
     * @param $uid 用户id,$id商品id
     */
    public function makeGoodsUserList($uid,$gid)
    {
        //构建队列名称
        $list_name = 'goods_list_'.$gid;

        //检测用户是否已经登记
        $flag = self::buildGoodsUser($uid,$gid);

        //队列

        if($flag){
            //return true
            return  Redis::lpush($list_name,$uid);
        }else{

            //return false
            return $flag;
        }
    }

    /**
     * 构建用户商品登记集合,压入nosql
     * 用户不能重复登记
     * @param $uid用户id,$gid 商品id
     * @return 
     */
    public function buildGoodsUser($uid,$gid)
    {
        $flag = 0;
        //指定用户商品登记名称
        $name = 'goods_user_'.$gid;

        //检测用户否已经登记过
        $res = Redis::sismember($name,$uid);

        if(!$res){
          $flag = Redis::sadd($name,$uid);
        }

        return $flag;
    }



    /**
     * 抢购数据接入
     * @param
     * @return
     */
    public function getData($gid)
    {
        $list_name = 'goods_list_'.$gid;
        //处理用户抢购商品队列
        return Redis::rpop($list_name); 
    }



    /**
     * 数据处理
     * @param
     */
    public function createOrder($uid,$gid)
    {       
        // $time = date('Y-m-d H:i:s',time());
        // $data = array('uid'=>$uid,'gid'=>$gid,'num'=1,'type'=>1,'created_at'=>$time,'updated_at'=>$time);
        // return DB::table('car')->insert($data);
    }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
    /**
     * 用户登记
     * @param $uid 用户id
    */
    public function userverify($uid)
    {
        //生成一个验证码,允许用一次
        //存入nosql
    }

    /**
     * 查询商品库存,不能超买
     * @param $id 商品id
     * @return 
     */
    public function checkNum($id)
    {

    }
}

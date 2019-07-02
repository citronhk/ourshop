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

         //获取购物车
         $cars = DetailController::getCarCount();


         
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
                                         'result' =>$result,
                                         'cars'=>$cars
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
        $aid = $request->input('aid');
        $gid = $request->input('gid');
        // $uid = rand(1,20); 
        $uid = rand(1,25);

        //实时库存
        $stock = self::stock($gid)->goodsNum;
        if($stock>0){

            //加入抢购登记
            $res = '';
            if(self::buildGoodsUser($uid,$gid)){

                //加入商品抢购队列
               self::makeGoodsUserList($uid,$gid);
               // $res = json_encode(['msg'=>'error','info'=>'请耐心等待!']);
            }

            //处理抢购数据
            //获取抢购用户id
            $lid = self::getData($gid);

            //判断是否需要等待

            //当$lid == null  ,
            if(!$lid){
                //在不需要等待的情况下,直接处理当前用户请求
                $lid = $uid;
            }
            
            //创建订单
            $order = self::createOrder($lid,$gid);

            //判断用户是否还在等待
            if($order && $lid == $uid){
                $res = json_encode(['msg'=>'success','info'=>'抢购成功!']);
            }else{
                $res = json_encode(['msg'=>'error','info'=>'请耐心等待!']);
                //事务回滚
            }

        }else{
            $res = json_encode(['msg'=>'error','info'=>'商品售罄!']);
        }

        echo $res;
    }

     /**
     * 构建用户商品登记集合
     * 已经登记和已经抢购过不,不能再加入
     * 压入nosql
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
     * 检测抢购队列长度
     */

    /**
     * 获取商品当前库存
     */

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

        if(!$flag){
            //return true
            return Redis::lpush($list_name,$uid);
        }else{

            //return false
            return $flag;
        }
    }

   


    /**
     * 抢购数据接入
     * @param
     * @return
     */
    public function getData($gid)
    {
        $list_name = 'goods_list_'.$gid;
        if(Redis::exists($list_name)){

            //处理用户抢购商品队列
           return Redis::rpop('goods_list_'.$gid); 

        }else{
            return null;
        }

    }

    /**
     * 数据处理
     * @param
     */
    public function createOrder($uid,$gid)
    {   
        //开始事件操作
        DB::beginTransaction();

        //设置时间
        $time = date('Y-m-d H:i:s',time());

        //创建一条记录
        $data = array('uid'=>$uid,'gid'=>$gid,'num'=>1,'type'=>1,'created_at'=>$time,'updated_at'=>$time);

        //提交订单
        $res = DB::table('car')->insert($data);

        if($res){

          //库存减少
          $res = self::cutDown($gid,1);

          //提交事务
          DB::commit();

        }else{

          //事务回滚
          DB::rollBack();
        }   
        return $res;
    }

    /**
     * 商品库存减少
     * @param $gid 商品id
     * @return 商品实际库存
     */
    public function cutDown($gid,$num = 1)
    {
        // $num = 1;//设置-1
        $stock = self::stock($gid)->goodsNum-$num;
        return DB::table('goods')->where('id',$gid)->update(['goodsNum'=>$stock]);
    }

    /**
     * 返回商品实时库存
     * @param $gid 商品id
     * @return 库存
     */
    public function stock($gid)
    {
        return DB::table('goods')->select('goodsNum')->where('id',$gid)->first();
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

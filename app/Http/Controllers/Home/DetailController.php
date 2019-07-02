<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\H\C;
use DB;

class DetailController extends Controller
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

        $uid = session('home_userinfo')->id;


        //获取当请求id的商品数据
        $goods_attr = self::getGoodsAttrById($gid);

        //分类id
        $cid = $goods_attr['cid'];

        //
        $like_goods_data = self::getUseLikeByCid($cid);

        //商品评论
        $comment_data = self::getCommentByGid($gid);
        
        //商品图集
        $goods_photo = self::getDescPhotoByid($gid);

        $result = in_array($gid, self::GetGoodsListByUid($uid));

        //点击量+1
        self::addGoodsBrows($gid);

        //记录用户浏览记录
        self:: addRecord($gid,$uid);    

        //获取购物车
        $cars = self::getCarCount();


    	//返回详情页视图  
    	return view('home.detail.index',['aid'=>$aid,
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
     * 获取购物车商品个数
     */
    public static function getCarCount()
    {   
        $count = 0;
        if(session('home_login')){
            $count = DB::table('car')->where('uid',session('home_userinfo')->id)->count();
        }
        return $count;
        
    }

    /**
     * 通过商品id查询获取商品信息 
     * @param $id 商品id 
     * @return 商品详情 
     */
    public static function getGoodsDataById($id)
    {
        return DB::table('goods')->where('id',$id)->first();
    }

    /**
     *  根据id获取当前商品描述图片
     *  @param $id 商品id
     *  @return data 
     */
    public static function getDescPhotoByid($id)
    {
        return DB::table('goods_photo')->select('profile')->where('gid',$id)->get();
    }

    /**
     *  获取和设置商品属性
     *  @param $id 商品id
     *  @return attr_list
     */
    public static function getGoodsAttrById($id)
    {
        //获取商品名称
        $goods = DB::table('goods')->where('id',$id)->first();
        
        //获取商品属性
        $data = DB::table('goods_detail')->where('gid',$id)->first();
            
        

        //定义商品属性列表
        $attr_list = [];

        //填充属性，属性值
        $attr_list['id'] = $id;
        $attr_list['cid'] = $goods->cid;
        $attr_list['gname'] = $goods->gname;
        $attr_list['desc'] = $goods->desc;
        $attr_list['pic'] = $goods->pic;
        $attr_list['price'] = $goods->price;
        $attr_list['brand'] = $data->brand;
        $attr_list['origin'] = $data->origin;
        $attr_list['weight'] = $data->weight;
        $attr_list['created_at'] = $data->created_at;
        
        return $attr_list;
    }

    /**
     * 添加收藏
     * @param $id 商品id
     * @return json
     */
    public static function addColl(Request $request)
    {
        //获取商品id
        $gid = $request->input('id',0);
        // $gid = 100;
        $uid = 10;
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



    /**
     * 加入购物车
     * @param $request 请求数据
     * @return json
     */
    public static function addCar(Request $request)
    {
        //获取商品id
        $gid = $request->input('id',0);
        // //加入购物车数量
        $num = $request->input('num',0);

        //当前用户id
        $uid = 10;

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
     * 添加浏览记录 
     *  
     *  @param $request 请求参数
     *  @return 
     */
    public static function addRecord($gid,$uid)
    {
        //搜索该用户的浏览记录
        $record_list = self::getRecordsByUid($uid);

        //判断当前用户是否已经浏览过该商品
        if(!in_array($gid, $record_list)){

            //如果不存在数组中
            //则向数据库压入数据
            //返回记录数据
            DB::table('goods_records')->insert(['uid'=>$uid,'gid'=>$gid,'created_at'=>date('Y-m-d H:i:s',time())]);
        }
    }

    /**
     *  获取当前用户的浏览商品记录 
     *  
     * @param $uid 当前用户id
     * @return 返回记录数组
     */
    public static function getRecordsByUid($uid)
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
     * 根据用户浏览记录/该类商品的销售量/该类商品点击量推荐到时 商品列表页左侧
     * @param 
     * @return
     */
    public static function getRecords($cid)
    {
        if(session('home_login')){
            $record_data = DB::table('goods_records')
                            ->where('uid',session('home_userinfo')->id)
                            ->orderBy('created_at','desc')
                            ->take(4)
                            ->get();

            $id_list = [];

            foreach ($record_data as $key => $value) {
                $id_list[] = $value->id;
            }

            return  DB::table('goods')->whereIn('id',$id_list)->get();
            
        }else if($cid){
            return self::getUseLikeByCid($cid);
        }else{
            return  DB::table('goods')->orderBy('clickNum','desc')->take(4)->get();
        }
    }

    /**
     *  记录商品点击量 
     *  商品详情页记录
     *  @param $pid商品id
     *  @return 
     */
    public static  function addGoodsBrows($gid)
    {
        //通过商品id,获取该商品的浏览量
        $data = DB::table('goods')->select('clickNum')->where('id',$gid)->first();
        $num = $data->clickNum;

        //+1
        $num = $num + 1;

        //浏览量+1
        DB::table('goods')->where('id',$gid)->update(['clickNum'=>$num]);
    }

    /**
     * 根据当前数商品的栏目id,推荐栏目下销量前5的商品
     * @param $cid 栏目id
     * @return data
     */
    public static function getUseLikeByCid($cid)
    {
        return DB::table('goods')
                    ->where('cid',$cid)
                    ->orderBy('sell','desc')
                    ->take(6)
                    ->get();
    }

    /**
     * 获取当前商品的评论 
     * @param $gid 商品id
     * @return $data
     */
    public static function getCommentByGid($gid)
    {
        return DB::table('comment')
                    ->where('gid',$gid)
                    ->orderBy('created_at','desc')
                    ->paginate(5);
    }

    /**
     * 发表评价
     * @param Request id 商品id ,content评论内容
     * @return 
     */
    public static function publish(Request $request)
    {
        $uid = 14;
        //商品id
        $gid = $request->input('id',0);


        if(self::CheckComment($gid,$uid)){
            echo json_encode(['msg'=>'error','info'=>'已经评论过了']);
            exit;
        }

        //评论内容
        $content = $request->input('content','');
        //创建时间
        $created_at = date('Y-m-d H:i:s',time());
        //修改时间
        $updated_at = $created_at;

        //定义一个评论数组
        $data = array('gid'=>$gid,
                      'uid'=>$uid,
                      'content'=>$content,
                      'created_at'=>$created_at,
                      'updated_at'=>$updated_at,
                    );

        //向数据库压入记录
        $res = DB::table('comment')->insert($data);

        if($res){
            echo json_encode(['msg'=>'success','info'=>'评论成功']);
            exit;
        }else{
            echo json_encode(['msg'=>'error','info'=>'评论失败']);
            exit;
        }
    }

    /**
     * 通过商品id,用户id,检测该用户是否已经评论过该商品
     * @param $gid 商品id, $uid用户id
     * @return true/false
     */
    public static function CheckComment($gid,$uid)
    {
        $res = DB::table('comment')
                ->where('uid',$uid)
                ->where('gid',$gid)
                ->first();
    
        if($res){
            return true;
        }
        return false;
    }

    /**
     *  获取该当前用户是买过的商品 
     *  @param $uid 用户id
     *  @return 返回用户所有购买过的商品id
     */
    public static function GetGoodsListByUid($uid)
    {

        //uid->order_number->gid

        $order_number_list = [];

        //查询该用户所有订单
        $data_order_number =  DB::table('orders_users')
                ->select('order_number')
                ->where('uid',$uid)
                ->get();

        //生成订单数组
        foreach($data_order_number as $k=>$v){
            $order_number_list[] = $v->order_number;
        }

        //通过订单,获取所有购买过的商品
        $user_goods_list = [];

        //订单商品信息
        $goods_data = DB::table('orders_infos')
                        ->select('gid')
                        ->whereIn('order_number',$order_number_list)
                        ->distinct()
                        ->get();
        //遍历所有商品id
        foreach ($goods_data as $k => $v) {
            $user_goods_list[] = $v->gid;
        }

        //返回用户所有购买过的商品id
        return $user_goods_list;
    }

}

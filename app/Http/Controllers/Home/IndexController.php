<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\DetailController;
use DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Skill\SkillController;
use App\Http\Controllers\News\ListController;

class IndexController extends Controller
{

    /**
     * 显示首页
     * @param 
     * @return 首页视图,数据
     */
    public function index()
    {

        // 轮播图数据
        $banners_data = self::getBannersData();     

        //站点新闻
        $news = ListController::support();

        // 热门商品
        $hot_sell_goods_data = self::getHotsell();

        // 活动id
        $aid = SkillController::getCurrentTask()->id;

        // 商品特卖
        $goods_id_list = self::getTMAdGoodsId($aid);                        // 所有广告id
        $tm_Banner_data = self::getTMAdGoodsData($aid,1);                   // 特卖轮播图
        $tm_img_data = self::getTMAdGoodsData($aid,2);                      // 长图广告商品
        $tm_goods_data = self::getTMAdGoodsData($aid,0);                    // 原图广告
        $tm_goods_attr = self::getTMGoodsDataById($aid,$goods_id_list);     // 活动商品相关属性
        

        // 一级栏目数据
        $cate_list = self::getCateData();   
        $cate_list_1 = $cate_list[0];       //一级栏目id数组
        $cate_list_1_name= $cate_list[1];       ////一级栏目id=>name


        // 悠闲零食 数据
        $cate_list_2 = self::getCateData($cate_list_1[0]);          // 第一个二级栏目
        $cate_list_3 = self::getCateData($cate_list_2[0]);          // 第二级栏目的三级栏目
        $f1_cates = self::getThCatesDataByPid($cate_list_2[0]);     // 显示任意三级栏目
        $f1_data = self::getGoodsDataByCid($cate_list_3[0]);        // 楼层显示列表数据
        $f1_ad_left = self::getFloorAds(1,'l');                     // 获取左侧轮播图
        $f1_ad_right = self::getFloorAds(1,'r');                    // 获取左侧广告位图
              

        // 食品饮料
        $cate_list_2 = self::getCateData($cate_list_1[1]);          // 第二个二级栏目
        $cate_list_3 = self::getCateData($cate_list_2[0]);          // 第二级栏目的三级栏目
        $f2_cates = self::getThCatesDataByPid($cate_list_2[0]);     // 显示任意三级栏目
        $f2_data = self::getGoodsDataByCid($cate_list_3[0]);        // 楼层显示列表数据
        $f2_ad_left = self::getFloorAds(2,'l');                     // 获取左侧轮播图
        $f2_ad_right = self::getFloorAds(2,'r');                    // 获取左侧广告位图

        // 个人美装        
        $cate_list_2 = self::getCateData($cate_list_1[2]);          // 第二个二级栏目
        $cate_list_3 = self::getCateData($cate_list_2[0]);          // 第二级栏目的三级栏目
        $f3_cates = self::getThCatesDataByPid($cate_list_2[0]);     // 显示任意三级栏目
        $f3_data = self::getGoodsDataByCid($cate_list_3[0]);        // 楼层显示列表数据
        $f3_ad_left = self::getFloorAds(3,'l');                     // 获取左侧轮播图
        $f3_ad_right = self::getFloorAds(3,'r');                    // 获取左侧广告位图

        // 母婴玩具        
        $cate_list_2 = self::getCateData($cate_list_1[3]);          // 第二个二级栏目
        $cate_list_3 = self::getCateData($cate_list_2[0]);          // 第二级栏目的三级栏目
        $f4_cates = self::getThCatesDataByPid($cate_list_2[0]);     // 显示任意三级栏目
        $f4_data = self::getGoodsDataByCid($cate_list_3[0]);        // 楼层显示列表数据
        $f4_ad_left = self::getFloorAds(4,'l');                     // 获取左侧轮播图
        $f4_ad_right = self::getFloorAds(4,'r');                    // 获取左侧广告位图

        // 家居生活        
        $cate_list_2 = self::getCateData($cate_list_1[4]);          // 第二个二级栏目
        $cate_list_3 = self::getCateData($cate_list_2[0]);          // 第二级栏目的三级栏目
        $f5_cates = self::getThCatesDataByPid($cate_list_2[0]);     // 显示任意三级栏目
        $f5_data = self::getGoodsDataByCid($cate_list_3[0]);        // 楼层显示列表数据
        $f5_ad_left = self::getFloorAds(5,'l');                     // 获取左侧轮播图
        $f5_ad_right = self::getFloorAds(5,'r');                    // 获取左侧广告位图

        // 数码家电        
        $cate_list_2 = self::getCateData($cate_list_1[5]);          // 第二个二级栏目
        $cate_list_3 = self::getCateData($cate_list_2[0]);          // 第二级栏目的三级栏目
        $f6_cates = self::getThCatesDataByPid($cate_list_2[0]);     // 显示任意三级栏目
        $f6_data = self::getGoodsDataByCid($cate_list_3[0]);        // 楼层显示列表数据
        $f6_ad_left = self::getFloorAds(6,'l');                     // 获取左侧轮播图
        $f6_ad_right = self::getFloorAds(6,'r');                    // 获取左侧广告位图       


        //获取购物车
        $cars = DetailController::getCarCount();

    	//渲染首页视图
    	return view('home.index.index',[
                    'banners_data'=>$banners_data,
                    'news'=>$news,
                    'hot_sell_goods_data'=>$hot_sell_goods_data,

                    //商品特买
                    'tm_Banner_data'=> $tm_Banner_data,
                    'tm_img_data'=> $tm_img_data,
                    'tm_goods_data'=> $tm_goods_data,
                    'tm_goods_attr'=>$tm_goods_attr,

                    //悠闲零食
                    'f1_ad_left'=>$f1_ad_left,
                    'f1_cates'=>$f1_cates,
                    'f1_data'=>$f1_data,
                    'f1_ad_right'=>$f1_ad_right,

                    //食品饮料
                    'f2_ad_left'=>$f2_ad_left,
                    'f2_cates'=>$f2_cates,
                    'f2_data'=>$f2_data,
                    'f2_ad_right'=>$f2_ad_right,
                    
                    // 个人美装
                    'f3_ad_left'=>$f3_ad_left,
                    'f3_cates'=>$f3_cates,
                    'f3_data'=>$f3_data,
                    'f3_ad_right'=>$f3_ad_right,   

                    // 母婴玩具
                    'f4_ad_left'=>$f4_ad_left,
                    'f4_cates'=>$f4_cates,
                    'f4_data'=>$f4_data,
                    'f4_ad_right'=>$f4_ad_right, 

                    // 家居生活
                    'f5_ad_left'=>$f5_ad_left,
                    'f5_cates'=>$f5_cates,
                    'f5_data'=>$f5_data,
                    'f5_ad_right'=>$f5_ad_right, 

                    // 数码家电
                    'f6_ad_left'=>$f6_ad_left,
                    'f6_cates'=>$f6_cates,
                    'f6_data'=>$f6_data,
                    'f6_ad_right'=>$f6_ad_right, 

                    //显示购物车
                    'cars'=>$cars
                ]);
    }


    /**
     * 获取一级栏目
     * @param
     * @return 
     */
    public function getCateData($pid = 0,$take = 6)
    {
        $data = DB::table('cates')->where('pid',$pid)->take($take)->get();
        $list1 = [];
        $list2 = [];
        foreach ($data as $k => $v) {

            $list1[] = $v->id;
            $list2[$v->id] = $v->cname;

        }
        return [$list1,$list2];
    }

    //楼层分类

    /**
     * 根据一级分类,获取二级分类信息
     * @param $pid父类id
     * @return 商品二级分类信息
     */
    public function getThCatesDataByPid($pid)
    {
       return DB::table('cates')->select('id','cname')->where('pid',$pid)->get();
    }

    /**
     * 根据分类id,获取前6条数据
     * @param $cid 分类id
     * @return 商品信息
     */
    public function getGoodsDataByCid($cid)
    {
        return DB::table('goods')->where('cid',$cid)->take(6)->get();
    }

    /**
     * 获取左侧广告轮播图
     * @param $cid 商品类型id,$pos 轮播图显示位置
     * @return 轮播图信息
     */
    public function getFloorAds($fid,$pos)
    {
        return DB::table('ads')->where(['fid'=>$fid,'about'=>$pos])->get();
    }




    /**
     *  获取猜你喜欢的数据
     *  @param $uid 用户id
     *  @return 商品推荐商品信息
     */
    public static function getGoodsByRecord()
    {
        $count = 0;
        if(session('home_login')){
            $uid = session('home_userinfo')->id;
            //获取用户浏览数据
            $record_list = DetailController::getRecordsByUid($uid);

            //通过数组当前用户浏览记录
            $count = count($record_list);
        }
        
        //如何浏览数据>5,则根据浏览记录推荐
        if($count>5){
           return DB::table('goods')->whereIn('id',$record_list)->get();
        }else{
            //如何浏览数据<5,自动推荐 
            return  DB::table('goods')->orderBy('clickNum','desc')->take(20)->get();
        }
    }


    /**
     * 获取主页商品特卖信息
     * @param
     * @return 
     */
    public function getSellData()
    {
        
    }


        //栏目分类

    /**
     * 获取分类数据
     * @param $pid 分类id
     * @return 返回分类数据
     */
    public static function getPidCatesData($pid = 0)
    {
        //获取栏目数据
        $cates_data = DB::table('cates')->where('pid',$pid)->get();
       
        //分类归档
        foreach($cates_data as $k=>$v){
            // $v->sub = $sec;
            //递归
            $v->sub = self::getPidCatesData($v->id);
            if($v->pid == 0)
            {
                $v->cname = self::getTopCateByPid($v->id);
            } 
            
        }

        return $cates_data;
    }

    /**
     *  修改栏目显示形式 
     *
     */
    public static function getTopCateByPid($pid)
    {
        $data =  DB::table('cates')
                    ->where('pid',$pid)
                    ->take(3)
                    ->get();
        return $data ;
    }


    //栏目分类




    /**
     * 显示轮播图
     * @param 
     * @return  
     */
    public function getBannersData()
    {
       return DB::table('banners')
                ->select('url')
                ->where('status','1')
                ->get();
    }

    /**
     * 根据商品购买量,推荐商品
     * @param
     * @return 返回商品列表信息
     */
    public function getHotsell()
    {

        return DB::table('goods')->orderBy('sell', 'desc')->take(10)->get();
    }


    //限时特卖商品数据

    /**
     * 根据活动场次,广告位置,获取相对应的广告商品id
     * @param $
     * @return 
     */
    public function getTMAdGoodsData($aid,$type)
    {
        return DB::table('ads_act_goods')->where('aid',$aid)->where('type',$type)->get();
    }

    /**
     * 获取所有活动广告商品id
     */
    public function getTMAdGoodsId($aid)
    {
        $data = DB::table('ads_act_goods')->where('aid',$aid)->get();
        $list = [];
        foreach ($data as $k => $v) {
            $list[] = $v->gid;
        }   
        return $list;
    }


    /**
     * 通过id获取广告商品折扣
     */
    public function getTMGoodsDiscountById($aid,$gid)
    {   
        $data = DB::table('act_goods')->where('aid',$aid)->whereIn('gid',$gid)->get();
        $list = [];
        foreach($data as $k=>$v){
            $list[$v->gid] = $v->discount;
        }

        return $list;
    }

    /**
     * 获取所有广告商品的名称,价格,原url
     */
    public function getTMGoodsDataById($aid,$gid)
    {
        $discount = self::getTMGoodsDiscountById($aid,$gid);

        $data = DB::table('goods')->whereIn('id',$gid)->get();

        $list = [];

        foreach($data as $k=>$v){
            $list[$v->id] = ['gname'=>$v->gname,'price'=>$v->price*$discount[$v->id],'url'=>$v->pic];
        }

        return $list;
    }

    //限时特卖商品数据

    /**
     * 处理ajax请示
     */
    public function getTime()
    {
        //活动开始时间
        echo SkillController::getCurrentTask()->startTime;
    }

}

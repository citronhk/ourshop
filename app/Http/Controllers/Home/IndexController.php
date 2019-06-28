<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\DetailController;
use DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Skill\SkillController;

class IndexController extends Controller
{
    /**
     * 显示首页
     * @param 
     * @return 首页视图,数据
     */
    public function index()
    {
        //轮播图数据
        $banners_data = self::getBannersData();     

        //热门商品
        $hot_sell_goods_data = self::getHotsell();

        //商品特卖
        $tm_1_data = self::getAdBanner();
        $tm_2_data = self::getSimpleDateById();
        $tm_3_data = self::getBigImgAd();

        $floor_1_cates = self::getThCatesDataByPid(1);          //进口生鲜分类
        $floor_goods_datas = self::getGoodsDataByCid(4);        //进口生鲜推荐商品数据
        $floor_ads_datas_l = self::getFloorAds(4,0);          //获取生鲜左侧广告位
        $floor_ads_datas_r = self::getFloorAds(4,1);          //获取生鲜右侧广告位


    	//渲染首页视图
    	return view('home.index.index',[
                    'banners_data'=>$banners_data,
                    'hot_sell_goods_data'=>$hot_sell_goods_data,
                    'tm_1_data'=>$tm_1_data,
                    'tm_2_data'=>$tm_2_data,
                    'tm_3_data'=>$tm_3_data,

                    'floor_1_cates'=>$floor_1_cates,
                    'floor_goods_datas'=>$floor_goods_datas,
                    'floor_ads_datas_l'=>$floor_ads_datas_l,
                    'floor_ads_datas_r'=>$floor_ads_datas_r,
                    
                ]);
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
     * 根据商品购买量获取商品信息
     * @param
     * @return 返回商品列表信息
     */
    public function getHotsell()
    {

        return DB::table('goods')->orderBy('sell', 'desc')->take(10)->get();
    }


    //限时特卖商品数据

    /**
     * 限时特卖左侧轮播图
     * @param 
     * @return 
     */
    public function getAdBanner()
    {
        return DB::table('ads_act_goods')->select('gid','url')->where('aid',1)->where('type',1)->get();
    }

    /**
     * 获取默认广告类型的商品id
     * @param
     * @return 
     */
    public function getSimpleIdList()
    {
        $list_id = [];

        $data = DB::table('ads_act_goods')->select('gid')->where('aid',1)->where('type',0)->get();

        foreach($data as $k=>$v ){

            $list_id[] = $v->gid;
        }

        return $list_id;
    }

    /**
     * 通过商品id ,获取商品图片
     * @param
     * @return
     */
    public function getSimpleDateById()
    {   
         //获取最近一个特卖活动id
        $aid = SkillController::getCurrentTask()->id;

         //获次本次活动显示在首页的商品的id
        $goods_id_list = self::getSimpleIdList();

        $discount = self::getGoodsDiscountById($aid,$goods_id_list);

        $data = DB::table('goods')->select('id','gname','price','pic')->whereIn('id',$goods_id_list)->get();

         $list = [];
        //构建商品属性数组 
        // id pic price discount
        foreach($data as $k=>$v){

            $price = $v->price * $discount[$v->id];
            $list[] = ['gid'=>$v->id,'gname'=>$v->gname,'price'=>$price,'url'=>$v->pic];
        }

        return $list;

     
    }

    /**
     * 通过商品id ,获取特卖商品折扣
     * @param
     * @return
     */
    public function getGoodsDiscountById($aid,$gid)
    {
        $list = [];

        $data = DB::table('act_goods')->select('gid','discount')->where('aid',$aid)->WhereIn('gid',$gid)->get();

        //构建商品id=>discount数组
        foreach($data as $k=>$v ){

            $list[$v->gid] = $v->discount;
        }

        return $list;
    }


    /**
     * 长图广告
     * @param
     * @return 
     */
    public function getBigImgAd()
    {
         $aid = SkillController::getCurrentTask()->id;
        return DB::table('ads_act_goods')->where('aid',$aid)->where('type',2)->get();
    }

    //限时特卖商品数据




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
    public function getFloorAds($cid,$pos)
    {
        return DB::table('ads')->where(['cid'=>$cid,'pos'=>$pos])->get();
    }




    /**
     *  获取猜你喜欢的数据
     *  @param $uid 用户id
     *  @return 商品推荐商品信息
     */
    public static function getGoodsByRecord($uid)
    {
        //获取用户浏览数据
        $record_list = DetailController::getRecordsByUid($uid);

        //通过数组当前用户浏览记录
        $count = count($record_list);

        //如何浏览数据>5,则根据浏览记录推荐
        if($count>5){
            $data = DB::table('goods')->whereIn('id',$record_list)->get();
        }else{
            //如何浏览数据<5,自动推荐 
            $data = DB::table('goods')->orderBy('clickNum', 'desc')->take(20);
        }

        //return 
        return $data;
        
    }


    /**
     * 获取主页商品特卖信息
     * @param
     * @return 
     */
    public function getSellData()
    {
        
    }

}

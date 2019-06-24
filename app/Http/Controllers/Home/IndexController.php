<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\DetailController;
use DB;

class IndexController extends Controller
{
    /**
     * 显示首页
     * @param 
     * @return 首页视图,数据
     */
    public function index()
    {

        $banners_data = self::getBannersData();                 //轮播图
        $floor_1_cates = self::getThCatesDataByPid(1);          //进口生鲜分类
        $floor_goods_datas = self::getGoodsDataByCid(4);        //进口生鲜推荐商品数据
        $floor_ads_datas_l = self::getFloorAds(4,0);          //获取生鲜左侧广告位
        $floor_ads_datas_r = self::getFloorAds(4,1);          //获取生鲜右侧广告位
        $hot_sell_goods_data = self::getHotsell();

  


    	//返回首页视图
        // return view('home.index.index',['cates_data'=>$cates_data]);
    	return view('home.index.index',[
                    'banners_data'=>$banners_data,
                    'floor_1_cates'=>$floor_1_cates,
                    'floor_goods_datas'=>$floor_goods_datas,
                    'floor_ads_datas_l'=>$floor_ads_datas_l,
                    'floor_ads_datas_r'=>$floor_ads_datas_r,
                    'hot_sell_goods_data'=>$hot_sell_goods_data,
                ]);
    }


    /**
     * 获取分类数据
     * @param $pid 分类id
     * @return 返回分类数据
     */
    public static function getPidCatesData($pid = 0)
    {
    	$data =  DB::table('cates')
                    ->where('pid',$pid)
                    ->get();
       
        foreach($data as $k=>$v){

            // $sec = DB::table('cates')->where('pid',$v->id)->get();

            // $v->sub = $sec;
            //递归
            $v->sub = self::getPidCatesData($v->id);
            if($v->pid == 0)
            {
                $v->cname = self::getTopCateByPid($v->id);
            } 
            
        }


        return $data;
    }

    //     /**
    //  * 获取分类数据
    //  * @param $pid 分类id
    //  * @return 返回分类数据
    //  */
    // public static function getPidCatesData($pid = 0)
    // {
    //     $data =  DB::table('cates')
    //                 ->where('pid',$pid)
    //                 ->get();
       
    //     foreach($data as $k=>$v){

    //         // $sec = DB::table('cates')->where('pid',$v->id)->get();

    //         // $v->sub = $sec;
    //         //递归
    //         $v->sub = self::getPidCatesData($v->id);
    //     }

       
    //     return $data;
    // }


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
       // return  DB::tabel('cates')
       //          ->where('pid',$pid)
       //          ->take(3)
       //          ->get();
    }

    // public static function cataData()
    // {
    //     getPidCatesData($pid = 0)
    // }

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
     * 根据类型Id,获取当前类型的,已经加入广告的商品的id,url(左侧广告位)
     * @param $cid 商品分类ID ,$pos 广告图显示位置
     * @return 商品数据
     */
    public function getLefeAdByCateId($cid,$pos)
    {
        return DB::table('')->select('id','url')->where('cid',$cid);
    }

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
     * 根据商品购买量获取商品信息
     * @param
     * @return 返回商品列表信息
     */
    public function getHotsell()
    {
        return DB::table('goods')->orderBy('sell', 'desc')->take(10)->get();
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

<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $id = $request->input('id');
        $goods_data = self::getGoodsDataById($id);
    	//返回详情页视图  
    	return view('home.detail.index',['goods_data'=>$goods_data]);
    }

    /**
     * 通过商品id查询获取商品信息 
     * @param $id 商品id 
     * @return 商品详情 
     */
    public function getGoodsDataById($id)
    {
        return DB::table('goods')->find($id);
    }
}

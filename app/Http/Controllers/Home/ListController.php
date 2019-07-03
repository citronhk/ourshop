<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\DetailController;
use DB;

class ListController extends Controller
{

   	/**
     * 显示列表面
     * @param 
     * @return 显示视图,数据
     */
    public function index(Request $request)
    {
      
    	// dump($request->all());
        $search = null;
        $cid = null ;
        if(!empty($request->input('search'))){
            $search = $request->input('search');
            $goods_datas = DB::table('goods')->where('gname','like','%'.$search.'%')->paginate(24);
            $record_data = DetailController::getRecords(0);
        }

        if(!empty($request->input('cid'))){
            $cid = $request->input('cid');
            $goods_datas = self::getGoodsDataByCid($cid); 
            $record_data = DetailController::getRecords($cid);
        }  
        if(session('home_login')){
            //获取购物车
            $cars = DetailController::getCarCount(); 

        }else{
            $cars = 0;
        }
        
        return view('home.list.index',[ 'cid'=>$cid,
                                        'search'=>$search,
                                        'goods_datas'=>$goods_datas,
                                        'record_data'=>$record_data,
                                        'cars'=>$cars
                                    ]);

    }


    /**
     * 根据分类id获取商品数据
     * @param $cid 分类id
     * @return 返回商品数据
     */
    public function getGoodsDataByCid($cid)
    {
    	return DB::table('goods')->where('cid',$cid)->paginate(20);
    }

    public function dataWord()
    {
        $data = DB::table('goods')->select('gname')->get();
        foreach ($data as $key => $value) {
            $arr = $this->word($value->gname);
        }
        dump($arr);


    }

}

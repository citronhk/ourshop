<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            $goods_datas = DB::table('goods')->where('gname','like','%'.$search.'%')->paginate(20);
        }

        if(!empty($request->input('cid'))){
            $cid = $request->input('cid');
            $goods_datas = self::getGoodsDataByCid($cid);
        }  

        return view('home.list.index',[ 'cid'=>$cid,
                                        'search'=>$search,
                                        'goods_datas'=>$goods_datas
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

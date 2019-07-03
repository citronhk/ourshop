<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\DetailController;
use App\Http\Controllers\News\ListController;
use DB;

class IndexController extends Controller
{
    //
    public function index(Request $request)
    {
    	//获取当前请求id
    	$id = $request->input('id');

    	//读取数据
    	$news = DB::table('news')->where('id',$id)->first();
    	// dd($news);

    	//推荐新闻
    	$sup_data = ListController::support();
    	
    	//获取购物车
        $cars = DetailController::getCarCount();

    	return view('home.news.index',['news'=>$news,'sup_data'=>$sup_data,'cars'=>$cars]);
    }
   
}

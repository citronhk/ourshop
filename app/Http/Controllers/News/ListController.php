<?php

namespace App\Http\Controllers\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\DetailController;
use DB;

class ListController extends Controller
{
    //
    public function index()
    {
    	//推荐文章
    	$sup_data = self::support();

    	$data = self::list();

    	//获取购物车
        $cars = DetailController::getCarCount();
    	return view('home.news.list',['cars'=>$cars,'data'=>$data,'sup_data'=>$sup_data]);
    }

    /**
     * 获取站点所有文章数据
     * @param
     * @return
     */
    public function list()
    {
    	return DB::table('news')->select('id','title','desc','created_at')->orderBy('created_at','desc')->paginate(5);
    }

    /**
     * 获取站点最新5则文章数据
     * @param
     * @return
     */
    public static function support()
    {
    	return DB::table('news')->select('id','title','desc')->orderBy('created_at','desc')->take(5)->get();
    }
}

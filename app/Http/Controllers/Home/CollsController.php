<?php

namespace App\Http\Controllers\Home;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Colls;

class CollsController extends Controller
{
    public function index()
    {
        //获取当前登录用户购物车信息
        $car = CarController::cardata();

        //获取当前登录用户id
        $id = session('home_userinfo')->id;

        //获取用户收藏夹信息
        $colls = Colls::where('uid',$id)->get();
        $temp = [];
        foreach($colls as $k=>$v){
            $temp[] =  $v->colls_good;
        }
        // dump($temp);
        return view('home.colls.index',['car'=>$car,'temp'=>$temp]);
    }
   
}

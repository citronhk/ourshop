<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Records;

class RecordsController extends Controller
{
    public function index()
    {
        //获取当前登录用户购物车信息
        $car = CarController::cardata();

        //获取当前登录用户id
        $id = session('home_userinfo')->id;

        //获取用户足迹信息
        $records = Records::where('uid',$id)->get();
        //获取足迹商品信息
        $temp = [];
        foreach($records as $k=>$v){
            $temp[] =  $v->records_good;
        }
        return view('home.records.index',['car'=>$car,'temp'=>$temp]);
    }
}

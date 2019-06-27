<?php

namespace App\Http\Controllers\Skill;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//用户接入层
class UserController extends Controller
{
    //
    public function index()
    {
    	echo "buy";
    }


    public function show()
    {

    }
    
    /**
     * 商品抢购队列
     * @param
     * @return
     */
    public function test(Request $request)
    {
        // dump($request->all());
        dump(self::makeCode());
    }

    /**
     * 用户登记
     * @param
     * @return
     */
    public function userRegister($uid,$code)
    {

    }

    /**
     * 生成一个登记验证码
     * @param
     * @return
     */
    public function makeCode()
    {
       return rand(1000,9999).'-'.rand(1000,9999).'-'.rand(1000,9999).'-'.rand(1000,9999);
    }
}

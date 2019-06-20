<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Car;
use App\Models\Users;
class OrderController extends Controller
{
    public function index()
    {
    	$id = session('home_userinfo')->id;
    	$user = Users::find($id);
    	$car = $user->usercar;
    	return view('home.order.index',['car'=>$car]);
    }
}

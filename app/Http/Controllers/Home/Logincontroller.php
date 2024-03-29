<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Hash;

class Logincontroller extends Controller
{
	/**
     * 前台 登录页面
     *
     * @return 登录视图
     */
	public function login()
	{

    	return view('home.login.login');
	}

	/**
	 * 执行登录操作
	 *
	 * @return 手机登录用户session
	 */
	public function dologin(Request $request)
	{
		$token = str_random(40);

		$phone = $request->input('phone');
		$upass = $request->input('upass');
		$data = Users::where('phone','=',$phone)->first();
		

		$data->token = $token;
		$data->save();
		
		if(empty($data)){
			return redirect('/home/login')->with('error','手机号或密码错误');
		}
		if (!Hash::check($upass, $data->upass)) {
   		 // 密码对比...
			return redirect('/home/login')->with('error','手机号或密码错误');
			
		}

		//登录
		session(['home_login'=>true]);
		session(['home_userinfo'=>$data]);
		$_SESSION['name'] = 123;

		return redirect('/home/personal')->with('success','登录成功');
	}


	/**
	 * 执行登录操作
	 *
	 * @return 邮箱登录用户session
	 */
	public function sign(Request $request)
	{
		$token = str_random(40);
		$email = $request->input('email');
		$upass = $request->input('upass');

		$data = Users::where('email','=',$email)->first();
		$data->token = $token;
		$data->save();


		if(empty($data)){
			return redirect('/home/login')->with('error','邮箱或密码错误');
		}
		if (!Hash::check($upass, $data->upass)) {
   		 // 密码对比...
			return redirect('/home/login')->with('error','邮箱或密码错误');
		}

		if($data->status != 1){
			return redirect('/home/login')->with('error','账号未激活，请前往邮箱激活');
		}

		//登录
		session(['home_login'=>true]);
		session(['home_userinfo'=>$data]);

		
		// dd(session('home_userinfo'));
		return redirect('/home/personal')->with('success','登录成功');
	}

	/**
	 * 执行退出登录操作
	 *
	 * @return 邮箱登录用户session
	 */
	public function loginout()
	{
		session(['home_login'=>false]);
		session(['home_userinfo'=>false]);

		return back();
	}
}

<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Users;
use App\Models\Usersinfo;
use App\Models\Orders_users;
use Illuminate\Support\Facades\Storage;

class PersonalController extends Controller
{
    /**
     * 前台 个人中心页面
     * 
     * @return home.personal
     * @param user_data
     */
    public function index()
    {   
        $id = session('home_userinfo')->id;
        $user_data = Users::find($id);
        
        //获取当前用户完成订单数
        $Orders_users = Orders_users::where('uid',$id)->get();
        $n = count($Orders_users);

        //获取当前登录用户购物车信息
      $car = CarController::cardata();

    	return view('home.personal.index',['user_data'=>$user_data,'car'=>$car,'n'=>$n]);
    }

    /**
     * 前台个人信息修改
     *
     * @return home.personal.edit
     * @param session('home_userinfo')
     */
    public function edit()
    {   
         $id = session('home_userinfo')->id;
        $user_data = Users::find($id);

        //获取当前登录用户购物车信息
      $car = CarController::cardata();

        return view('home.personal.edit',['user_data'=>$user_data,'car'=>$car]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            
            'uname' => 'required',
            'age' => 'required',
            
        ],[
            'uname.required'=>'用户名必填',
            'age.required'=>'年龄必填',
    
        ]);

       //开启事务
       DB::beginTransaction();


        //文件上传
      if($request->hasFile('profile')){
        //删除旧照片
        Storage::delete($request->input('path_profile'));
        $file_path = $request->file('profile')->store(date('Ymd'));
      }else{
        $file_path = $request->input('path_profile');
      }
        $id = session('home_userinfo')->id;
        $user_data = Users::find($id);
      //获取数据 压入数据库
      $user = Users::find($id);
      $user->uname = $request->input('uname','');
      $user->email = $request->input('email','');
      $user->phone = $request->input('phone','');
      $res1 = $user->save();
      $userinfo = Usersinfo::where('uid',$id)->first();
      $userinfo->profile = $file_path;
      $userinfo->sex = $request->input('sex');
      $userinfo->age = $request->input('age');

      $res2 = $userinfo->save();


       if($res1 && $res2){
         DB::commit();
         return redirect('/home/personal')->with('success','修改成功');
       }else{
         DB::rollBack();
         return back()->with('error','修改失败');
       }
    }
}

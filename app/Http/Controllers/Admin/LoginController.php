<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;
class LoginController extends Controller
{
    public function login()
    {
    	return view('admins.login.login');
    }

    public function dologin(Request $request)
    {

       $uname = $request->input('uname','');
       $upass = $request->input('upass','');

       $admin_user_data = DB::table('admins')->where('uname',$uname)->first();
       if(!$admin_user_data){
       	 echo "<script>alert('用户名或密码错误');location.href='/admin/login';</script>";
       	 exit;
       }
       //验证密码
       if (!Hash::check($upass,$admin_user_data->upass)){
         echo "<script>alert('用户名或密码错误');location.href='/admin/login';</script>";
         exit;
       }

       //执行登录
       session(['admin_login'=>true]);
       session(['admin_user'=>$admin_user_data]);

       // 获取当前用户的权限
        $admin_user_nodes = DB::select('select n.aname,n.cname from nodes as n,roles_nodes as rn,admins_roles as ur where ur.uid = '.$admin_user_data->id.' and ur.rid = rn.rid and rn.nid = n.id');
        
        $temp = [];
        foreach ($admin_user_nodes as $key => $value) {
            $temp[$value->cname][] = $value->aname;
            if($value->aname == 'create'){
                $temp[$value->cname][] = 'store';
            }
            if($value->aname == 'edit'){
                $temp[$value->cname][] = 'update';
            }

            if($value->aname == 'index'){
                $temp[$value->cname][] = 'show';
            }
        }

         //dump($temp);
         //dump($admin_user_nodes);
       
        session(['admin_user_nodes'=>$temp]);
      // 跳转
      return redirect('admin/index');
    }

    public function outlogin()
    {
       session(['admin_login'=>false]);
       session(['admin_user'=>null]);
   
       return redirect('/admin/login');
    }

}

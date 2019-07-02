<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admins;
use App\Models\AdminsRoles;
use Hash;
use DB;
class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //接收搜索的条件
      $search =  $request->input('search','');
      //获取数据
      $admins = Admins::where('uname','like','%'.$search.'%')->paginate(4);
       return view('admins.admins.index',['admins'=>$admins,'search'=>$search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        //获取数据
        $roles_data = DB::table('roles')->get();
        return view('admins.admins.create',['roles_data'=>$roles_data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        	'uname' => 'required|regex:/^[a-z]{1}[\w]{5,17}$/',
            'upass' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:upass',
            'phone' => 'required|regex:/^[\w]{5,17}$/',
        ],[
            'upass.required'=>'密码必填',
            'upass.regex'=>'密码格式不正确',
            'repass.required'=>'确认密码必填',
            'repass.same'=>'两次密码不一致',
            'phone.required'=>'电话必填',
            'phone.regex'=>'电话格式不正常',
            'uname.required'=>'用户名必填',
            'uname.regex'=>'用户名格式不正常',
        ]);
      //文件上传
      if($request->hasFile('profile')){
        $file_path = $request->file('profile')->store(date('Ymd'));
      }else{
        $file_path = '';
      }
       //开启事务
       DB::beginTransaction();
       //接收数据
       $data = $request->all();
       $admins = new Admins;
       $admins->uname=$data['uname'];
       $admins->upass=Hash::make($data['upass']);
       $admins->phone=$data['phone'];
       $admins->profile =  $file_path;
       $res1 = $admins->save();

       if($res1){
        $uid = $admins->id;
       }

       $admins_roles = new AdminsRoles;
       $admins_roles->uid = $uid;
       $admins_roles->rid = $data['rid'];
       $res2 = $admins_roles->save();

       if($res1 && $res2){
         DB::commit();
         return redirect('admin/admins')->with('success','添加成功');
       }else{
         DB::rollBack();
         return back()->with('error','添加失败');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$admin_1 = Admins::find($id); 
        return view('admins.admins.edit',['admin_1'=>$admin_1]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        	'uname' => 'required|regex:/^[a-z]{1}[\w]{5,17}$/',
            'phone' => 'required|regex:/^[\w]{5,17}$/',
        ],[
            'phone.required'=>'电话必填',
            'phone.regex'=>'电话格式不正常',
            'uname.required'=>'用户名必填',
            'uname.regex'=>'用户名格式不正常',
        ]);

       //文件上传
      if($request->hasFile('profile')){
        //删除旧照片
        Storage::delete($request->input('old_profile'));
        $file_path = $request->file('profile')->store(date('Ymd'));
      }else{
        $file_path = $request->input('old_profile');
      }
       //开启事务
       DB::beginTransaction();
       //接收数据
       $admin_1 = Admins::find($id);
       $admin_1->uname = $request->input('uname',''); 
       $admin_1->phone = $request->input('phone','');
       $admin_1->profile = $file_path;
       $res = $admin_1->save(); 
       if($res){
         DB::commit();
         return redirect('admin/admins')->with('success','修改成功');
       }else{
         DB::rollBack();
         return back()->with('error','修改失败');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
       //开启事务
       DB::beginTransaction();
       $res = Admins::where('id',$id)->delete();    
       if($res){
         DB::commit();
         return back()->with('success','删除成功');
       }else{
         DB::rollBack();
         return back()->with('error','删除失败');
       }
   }
}

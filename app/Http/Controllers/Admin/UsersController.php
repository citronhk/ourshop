<?php
  
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsers;
use App\Models\Users;
use App\Models\UsersInfo;
use Hash;
use DB;
class UsersController extends Controller
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
         $users = Users::where('uname','like','%'.$search.'%')->paginate(4);

      
      return view('admins.users.index',['users'=>$users,'search'=>$search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admins.users.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsers $request)
    {           
      $this->validate($request, [
            'upass' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:upass',
        ],[
            'upass.required'=>'密码必填',
            'upass.regex'=>'密码格式不正确',
            'repass.required'=>'确认密码必填',
            'repass.same'=>'两次密码不一致'
        ]);
       //开启事务
       DB::beginTransaction();
       //文件上传
      if($request->hasFile('profile')){
        $file_path = $request->file('profile')->store(date('Ymd'));
      }else{
        $file_path = '';
      }
        $data = $request->all();
         //接收数据
       $user = new Users;
       $user->uname=$data['uname'];
       $user->upass=Hash::make($data['upass']);
       $user->phone=$data['phone'];
       $user->email=$data['email'];
       $user->status = 1;
       $user->token = str_random(30);
       $res1 = $user->save();
       if($res1){
        //获取uid
        $uid = $user->id;
       }

       //压入头像
       $userinfo = new Usersinfo;
       $userinfo->uid = $uid;
       $userinfo->profile = $file_path;
       $res2 = $userinfo->save();
    
       if($res1 && $res2){
         DB::commit();
         return redirect('admin/users')->with('success','添加成功');
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
       //获取用户数据
        $user = Users::find($id);
        return view('admins.users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUsers $request, $id)
    {
       //开启事务
       DB::beginTransaction();

        //文件上传
      if($request->hasFile('profile')){
        //删除旧照片
        Storage::delete($request->input('old_profile'));
        $file_path = $request->file('profile')->store(date('Ymd'));
      }else{
        $file_path = $request->input('old_profile');
      }
      
      //获取数据 压入数据库
      $user = Users::find($id);
      $user->email = $request->input('email','');
      $user->phone = $request->input('phone','');
      $res1 = $user->save();
      $userinfo = Usersinfo::where('uid',$id)->first();
      $userinfo->profile = $file_path;
      $res2 = $userinfo->save();

       if($res1 && $res2){
         DB::commit();
         return redirect('admin/users')->with('success','修改成功');
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
        //删除图片
      
        //     use Illuminate\Support\Facades\Storage;

        // Storage::delete('file.jpg');

        // Storage::delete(['file1.jpg', 'file2.jpg']);
      
       //开启事务
       DB::beginTransaction();
       $res1 = Users::destroy($id);
       $res2 = Usersinfo::where('uid',$id)->delete();
        if($res1 && $res2){
         DB::commit();
         return back()->with('success','删除成功');
       }else{
         DB::rollBack();
         return back()->with('error','删除失败');
       }
    }

        public function changeStatus($id)
    {
       //开启事务
       DB::beginTransaction();
       //获取状态
       $statu = Users::find($id);
    
       if($statu->status == 0){
         $statu->status = 1;
       }else{
         $statu->status = 0;
       }
        $res = $statu->save();
      if($res){
         DB::commit();
         if($statu->status == 0){
             return redirect('admin/users')->with('success','停止成功');
         }else{
             return redirect('admin/users')->with('success','激活成功');
         }
        
       }else{
         DB::rollBack();
         return back()->with('error','修改失败');
       }    
       
    }

    //修改密码
   public function changepass(Request $request)
   {
      //获取表单数据
      $inpass = $request->input('inpass', '');
      $upass = $request->input('upass', '');
      $repass = $request->input('repass', '');

      //当前用户id
      $id = session('admin_user')->id;

      //数据库密码
      $upass_user = session('admin_user')->upass;
      //$data = DB::table('users')->where('id',$id)->first();
   

      //验证修改密码格式
             $this->validate($request, [
          'upass' => 'required|regex:/^[\w]{6,18}$/',
          'repass' => 'required|same:upass',
      ],[    
            'upass.required'=>'密码必填',
            'upass.regex'=>'密码格式不正确',
            'repass.required'=>'确认密码必填',
            'repass.same'=>'两次密码不一致'
      ]);

       //验证当前密码与数据库密码是否一致
      if (!Hash::check($inpass, $upass_user)) {
         return back()->with('error', '用户名或密码错误111'); 
      }
       $data['upass'] = Hash::make($upass);
      // dd($data['upass']);
     

      //压入数据库
     $res = DB::table('admins')->where('id',$id)->update($data);
      if($res){
        return redirect('admin/index')->with('success', '修改成功');
       }else{
        return back()->with('error', '修改失败');
       }
      
   }

   public function changeimg(Request $request)
   {
      //文件上传
      if($request->hasFile('profile')){
        //删除旧照片
        Storage::delete($request->input('profile_path'));
        $path = $request->file('profile')->store(date('Ymd'));
      }else{
        $path = $request->input('profile_path');
      }
   
      //当前用户id
      $id = session('admin_user')->id;

      $data['profile'] = $path;

      //压入数据库
     $res = DB::table('admins')->where('id',$id)->update($data);
      if($res){
        return redirect('admin/index')->with('success', '修改成功');
       }else{
        return back()->with('error', '修改失败');
       }
   }
}

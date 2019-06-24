<?php
 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banners;
use DB;
class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取数据
         $banners = Banners::paginate(50);

        return view ('admins.banners.index',['banners'=>$banners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.banners.create');
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
            'title' => 'required',
            'desc' => 'required',
          
        ],[
            'title.required'=>'标题必填',
            'desc.required'=>'描述必填',
        ]);

       //开启事务
       DB::beginTransaction();
             //文件上传
          if($request->hasFile('url')){
            $url = $request->file('url')->store(date('Ymd'));
          }else{
            return back()->with('error','请选择图片');   
          }

       //接收数据
       $data = $request->all();
       $banner = new Banners;
       $banner->title=$data['title'];
       $banner->desc=$data['desc'];
       $banner->status=$data['status'];
       $banner->url = $url;
    
       $res = $banner->save();
       if($res){
         DB::commit();
         return redirect('admin/banners')->with('success','添加成功');
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
        $banner = Banners::find($id);
        return view('admins.banners.edit',['banner'=>$banner]);
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
            'title' => 'required',
            'desc' => 'required',
          
        ],[
            'title.required'=>'标题必填',
            'desc.required'=>'描述必填',
        ]);

       //开启事务
       DB::beginTransaction();
      //文件上传
      if($request->hasFile('url')){
      //删除旧照片
      Storage::delete($request->input('old_url'));
        $url_path = $request->file('url')->store(date('Ymd'));
      }else{
        $url_path = $request->input('old_url');   
      }
   
      //获取数据
      $banners = Banners::find($id);
      $banners->title = $request->input('title','');
      $banners->desc = $request->input('desc','');
      $banners->url = $url_path;
      $banners->status = $request->input('status','');
   
      $res =  $banners->save();


      if($res){
         DB::commit();
         return redirect('admin/banners')->with('success','修改成功');
       }else{
         DB::rollBack();
         return back()->with('error','修改失败');
       }    


    }
    // public function changeStatus(Request $request)
    // {

      
    //    $id = $request->input('id');
    //   // dd($status,$id);
    
    //    //执行修改
    //    //$res = DB::table('banners')->where('id',$id)->update(['status'=>$status]);
    //     $bid = Banners::find($id);
    //     $bid->status = $request->input('status');
    //     $res = $bid->save();
    //    if($res){
    //     return back()->with('success', '修改成功');
    //    }else{
    //     return back()->with('error', '修改失败');
    //    }
       
    // }
    public function changeStatus($id)
    {
       //开启事务
       DB::beginTransaction();
       //获取状态
       $statu = Banners::find($id);
      
       if($statu->status == 0){
         $statu->status = 1;
       }else{
         $statu->status = 0;
       }
        $res = $statu->save();
      if($res){
         DB::commit();
         if($statu->status == 0){
             return redirect('admin/banners')->with('success','停止成功');
         }else{
             return redirect('admin/banners')->with('success','激活成功');
         }
        
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
       $res = Banners::destroy($id);
        if($res){
         DB::commit();
         return back()->with('success','删除成功');
       }else{
         DB::rollBack();
         return back()->with('error','删除失败');
      }
   }
}

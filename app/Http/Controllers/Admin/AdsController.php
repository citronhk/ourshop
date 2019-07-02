<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use DB;
class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取数据
        $ads = Ads::all();
       return view('admins.ads.index',['ads'=>$ads]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $gid = $request->input('id');
      
      //获取单条商品数据
      $good = DB::table('goods')->where('id',$gid)->get();

      //获取floors表数据
      $floors = DB::table('floors')->get();
   
      return view('admins.ads.create',
        ['floors'=>$floors,
         'gid'=>$gid,
         'good'=>$good,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     //开启事务
       DB::beginTransaction();

        //接收数据
        $data = $request->all();
        $adss = new Ads;
       // $adss->link = $data['link']; 
        $adss->url = $request->input('url','');
        $adss->fid = $data['fid'];
        $adss->about = $data['about'];
        $adss->gid = $request->input('gid','');
        

        $res = $adss->save();
        if($res){
         DB::commit();
         return redirect('admin/ads')->with('success','添加成功');
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

       //获取floors表数据
      $floors = DB::table('floors')->get();  

        //获取单条数据
        $ad = Ads::find($id);
        $fid = $ad->fid;

      $floor = DB::table('floors')->where('id',$fid)->get();
     
        return view('admins.ads.edit',['ad'=>$ad,
                           'floors'=>$floors,
                           'id'=>$id,
                           'floor'=>$floor,
                           'fid'=>$fid,
          ]);
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
  
     //开启事务
       DB::beginTransaction();

 

      //获取数据->压入数据库
      $ads = ads::find($id);
      $ads->url = $request->input('url','');
      $ads->fid = $request->input('fid','');
      $ads->about = $request->input('about','');

     //dd($ads);
      $res =  $ads->save();
       if($res){
         DB::commit();
         return redirect('admin/ads')->with('success','修改成功');
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
       $res = Ads::destroy($id);
        if($res){
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
       $statu = Ads::find($id);
      
       if($statu->status == 0){
         $statu->status = 1;
       }else{
         $statu->status = 0;
       }
        $res = $statu->save();
      if($res){
         DB::commit();
         if($statu->status == 0){
             return redirect('admin/ads')->with('success','隐藏成功');
         }else{
             return redirect('admin/ads')->with('success','显示成功');
         }
        
       }else{
         DB::rollBack();
         return back()->with('error','修改失败');
       }    
       
    }
}

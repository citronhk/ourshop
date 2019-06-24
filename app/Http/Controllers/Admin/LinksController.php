<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Links;
use Hash;
use DB;
class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取数据
        $links = Links::all();
        return view('admins.links.index',['links'=>$links]);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admins.links.create');
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
            'name' => 'required',
            'desc' => 'required',
            'url' => 'required',
        ],[
            'name.required'=>'连接名必填',
            'desc.required'=>'描述必填',
            'url.required'=>'链接地址必填',

        ]);
     //开启事务
       DB::beginTransaction();
       //文件上传
      if($request->hasFile('links_pic')){
        $file_path = $request->file('links_pic')->store(date('Ymd'));
      }else{
        $file_path = '';
      } 

        //接收数据
      $data = $request->all();

      $links = new Links;
      $links->name = $data['name'];
      $links->desc = $data['desc'];
      $links->url = $data['url'];
      $links->links_pic = $file_path;
      $res =  $links->save();
       if($res){
         DB::commit();
         return redirect('admin/links')->with('success','添加成功');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //获取单条数据
       $link_1 =Links::find($id);
       return view('admins.links.edit',['link_1'=>$link_1]);

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
            'name' => 'required',
            'desc' => 'required',
            'url' => 'required',
        ],[
            'name.required'=>'连接名必填',
            'desc.required'=>'描述必填',
            'url.required'=>'链接地址必填',

        ]);

        //开启事务
       DB::beginTransaction();
        //文件上传
      if($request->hasFile('links_pic')){
        //删除旧照片
       Storage::delete($request->input('old_links_pic'));
        $file_path = $request->file('links_pic')->store(date('Ymd'));
      }else{
        $file_path = $request->input('old_links_pic');
      }

      //获取数据 压入数据库
      $link_1 = Links::find($id);
      $link_1->name = $request->input('name','');
      $link_1->desc = $request->input('desc','');
      $link_1->url = $request->input('url','');
      $link_1->links_pic = $file_path;
      $res = $link_1 -> save();
       if($res){
         DB::commit();
         return redirect('admin/links')->with('success','修改成功');
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
      
       $res = Links::where('id',$id)->delete();
        if($res){
         DB::commit();
         return back()->with('success','删除成功');
       }else{
         DB::rollBack();
         return back()->with('error','删除失败');
       }
    }
}

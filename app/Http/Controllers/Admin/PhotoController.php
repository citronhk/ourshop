<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Goods;
use Illuminate\Support\Facades\Storage;


class PhotoController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gid = $request->input('gid','');
        $photo_data = Photo::where('gid',$gid)->get();
        $gdata = Goods::find($gid);
        return view('admins.photo.index',['photo_data'=>$photo_data,'gid'=>$gid,'gdata'=>$gdata]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $goods = Goods::find($request->gid);
        return view('admins.photo.create',['goods_data'=>$goods]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->profile){
            $path = $request->file('profile')->store(date('Ymd'));
        }else{
            $path = '';
        }

        $data = new Photo; 

        $data->gid = $request->gid;
        $data->profile = $path;
        $data->created_at = date('Y-m-d H:i:s');
        $data->updated_at = date('Y-m-d H:i:s');
        $res = $data->save();
        if($res){
            return redirect('/admin/photo?gid='.$data->gid)->with('success','添加成功');
        }else{
            return back('添加失败');
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
        
        return view('admins.photo.edit',['photo_data'=>Photo::find($id)]);
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
        
        if($request->profile){
            Storage::delete($request->pic);
            $path = $request->file('profile')->store(date('Ymd'));
        }else{
            $path = $request->pic;
        }
        
        $datas = Photo::find($id);
        $datas->profile = $path;
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $res = $datas->save();
        if($res){
            return redirect('/admin/photo?gid='.$datas->gid)->with('success','修改成功');
        }else{
            return back('修改失败');
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
        //
        
    }

    public function del($id)
    {
        $data = Photo::find($id);
        $gid = $data->gid;
        if(Photo::destroy($id)){
            Storage::delete($data->profile);
            return redirect('/admin/photo?gid='.$gid)->with('success','删除成功');
        }else{
            return back()->with('error','删除成功');
        }
    }
}
 
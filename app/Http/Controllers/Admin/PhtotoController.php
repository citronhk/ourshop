<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Phtoto;
use App\Models\Goods;
use Illuminate\Support\Facades\Storage;


class PhtotoController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gid = $request->input('gid','');
        if($gid){
            $phtoto_data = Phtoto::where('gid',$gid)->get();
        }else{
            $phtoto_data = Phtoto::get();
        }
        $gdata = Goods::find($gid);
        return view('admins.phtoto.index',['phtoto_data'=>$phtoto_data,'gid'=>$gid,'gdata'=>$gdata]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $goods = Goods::find($request->gid);
        return view('admins.phtoto.create',['goods_data'=>$goods]);
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

        $data = new Phtoto; 

        $data->gid = $request->gid;
        $data->profile = $path;
        $data->created_at = date('Y-m-d H:i:s');
        $data->updated_at = date('Y-m-d H:i:s');
        $res = $data->save();
        if($res){
            return redirect('/admin/phtoto?gid='.$data->gid)->with('success','添加成功');
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
        
        return view('admins.phtoto.edit',['phtoto_data'=>Phtoto::find($id)]);
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
        
        $datas = Phtoto::find($id);
        $datas->profile = $path;
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $res = $datas->save();
        if($res){
            return redirect('/admin/phtoto?id='.$datas->gid)->with('success','修改成功');
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
        $data = Phtoto::find($id);
        $gid = Goods::select('id')->find($data->gid);
        if(Phtoto::destroy($id)){
            Storage::delete($data->profile);
            return redirect('/admin/phtoto?gid='.$gid)->with('success','删除成功');
        }else{
            return back()->with('error','删除成功');
        }
    }
}

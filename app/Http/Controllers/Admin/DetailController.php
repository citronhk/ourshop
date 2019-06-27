<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Goods;

class DetailController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        $detail_datas = Detail::all();
        
        return view('admins.detail.index',['detail_datas'=>$detail_datas]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('id');
        $data = Goods::select('id','gname')->find($id);
        return view('admins.detail.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dump($request->all());
        //实例化对象
        $datas = new Detail;
        //压入数据
        $datas->gid = $request->input('gid');
        $datas->norm = $request->input('norm');
        $datas->brand = $request->input('brand');
        $datas->origin = $request->input('origin');
        $datas->weight = $request->input('weight');
        $datas->num = $request->input('num');
        $datas->created_at = date('Y-m-d H:i:s',time());
        $datas->updated_at = date('Y-m-d H:i:s',time());
        //将数据压入数据库 返回受影响行数
        // dd($datas);
        $res = $datas->save();
        if($res){
            return redirect('/admin/goods')->with('success','添加成功');
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

        return view('admins.detail.edit',['detail_data'=>Detail::find($id)]);
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
        
        //查询一条数据
        $datas = Detail::find($id);

        //修改数据
        $datas->norm = $request->input('norm');
        $datas->brand = $request->input('brand');
        $datas->weight = $request->input('weight');
        $datas->num = $request->input('num');
        $datas->created_at = date('Y-m-d H:i:s',time());

        //将修改后的数据压入数据库
        $res = $datas->save();
        
        if($res){
        
            return redirect('/admin/detail')->with('success','修改成功');
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
    public function destroy($id,Request $request)
    {
       
        
    }


    public function del(Request $request,$id)
    {
         $data = Detail::find($id);

        if(Detail::destroy($id)){
            return redirect('/admin/detail')->with('success','删除成功');
        }else{
            return back()->with('error','删除成功');
        }
    }
}

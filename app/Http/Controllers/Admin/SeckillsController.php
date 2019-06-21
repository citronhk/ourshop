<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Seckills;
use App\Models\Goods;

class SeckillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search','');
        $seckills_datas = Seckills::all();
        return view('admins.seckills.index',['seckills_datas'=>$seckills_datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //获取商品id
        $id = $request->input('id');
        //显示添加页面  并且把商品数据传输过去
        return view('admins.seckills.create',['goods_data'=> Goods::find($id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //验证逻辑错误
         $this->validate($request, [
               'sales' => 'required',
             ],[
               'sales.required'=>'商品销量必填',
             ]
             );
         //通过gname字段获取gid
         $gid = Goods::where('gname',$request->input('gname'))->first()->id; 
         //实例化对象
         $data = new Seckills;
         //压入数据
         $data->gid = $gid;
         $data->sales = $request->input('sales','');
         $data->startTime = date('Y-m-d H:i:s');
         $data->endTime = date('Y-m-d H:i:s',time()+100*100);
         $data->status = 1;
         $data->type = 1;

         //压入数据表 返回受影响行数
         $res = $data->save();

        if($res){
            return redirect('/admin/seckills')->with('success','添加成功');
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
        
        return view('admins.seckills.edit',['seckills_data'=>Seckills::find($id)]);
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

        $datas = Seckills::find($id);

        $datas->sales = $request->input('sales');
        $datas->startTime = date('Y-m-d H:i:s');
        $datas->endTime = date('Y-m-d H:i:s',time()+100*100);
       
        $res = $datas->save();
        
        if($res){
        
            return redirect('/admin/seckills')->with('success','修改成功');
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
        $data = Seckills::find($id);
        if(Seckills::destroy($id)){
            return redirect('/admin/seckills')->with('success','删除成功');
        }else{
            return back()->with('error','删除成功');
        }
    }

    public function status($id)
    {
        
        $seckills_data = Seckills::find($id);
        $seckills_data->status = !$seckills_data->status;
        $res = $seckills_data->save();
        if($res){
            return redirect('/admin/seckills')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
}

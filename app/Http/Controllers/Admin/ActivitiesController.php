<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Goods;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取搜索条件
        $search = $request->input('search','');
        //获取数据表数据
        $activities_datas = Activities::all();
        return view('admins.activities.index',['activities_datas'=>$activities_datas]);
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
        return view('admins.activities.create',['goods_data'=> Goods::find($id)]);
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
         $data = new Activities;
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
            return redirect('/admin/activities')->with('success','添加成功');
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
        //传输数据 显示页面
        return view('admins.activities.edit',['activities_data'=>Activities::find($id)]);
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
        //查找对应要修改的id的数据
        $datas = Activities::find($id);
        
        //更新数据
        $datas->sales = $request->input('sales');
        $datas->startTime = date('Y-m-d H:i:s');
        $datas->endTime = date('Y-m-d H:i:s',time()+100*100);
        
        //压入数据表 返回受影响行数
        $res = $datas->save();
        
        if($res){
        
            return redirect('/admin/activities')->with('success','修改成功');
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
        //获取要删除的数据
        $data = Activities::find($id);

        //执行删除
        if(Activities::destroy($id)){
            return redirect('/admin/activities')->with('success','删除成功');
        }else{
            return back()->with('error','删除成功');
        }
    }

    public function status($id)
    {
        //查找数据
        $Activities_data = Activities::find($id);
        //更改status状态值，变为相反值
        $Activities_data->status = !$Activities_data->status;
        //执行修改
        $res = $Activities_data->save();
        if($res){
            return redirect('/admin/activities')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Goods;
use App\Models\Act_goods;
use DB; 


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
        $act_datas = Act_goods::orderBy('id','desc')->paginate(5);

        return view('admins.activities.index',['act_datas'=>$act_datas]);
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
        $act_data = Activities::select('id')->get();

        //显示添加页面  并且把商品数据传输过去
        return view('admins.activities.create',['goods_data'=> Goods::find($id),'act_data'=>$act_data]);
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
               'count' => 'required',
             ],[
               'count.required'=>'商品销量必填',
             ]
             );
         //通过gname字段获取gid
         $gid = Goods::where('gname',$request->input('gname'))->first()->id; 
         //实例化对象
         $data = new Activities;
         $data_act = new Act_goods;
         //压入数据
         
         $data->status = 1;
         $data->type = 1; 
         //把活动的开始结束日期，时间转化成数组，再转化成时间戳  
         $DateStart = explode('-',$request->startDate);
         $TimeStart = explode(':',$request->startTime);
         $DateEnd = explode('-',$request->endDate);
         $TimeEnd = explode(':',$request->endTime);
         //以数值形式，指定某个时刻的时间戳
         $startTime = mktime($TimeStart[0],$TimeStart[1],00,$DateStart[1],$DateStart[2],$DateStart[0]);
         $endTime = mktime($TimeEnd[0],$TimeEnd[1],00,$DateEnd[1],$DateEnd[2],$DateEnd[0]);
         //压入数据，开始时间和结束时间
         $data->startTime = $startTime;
         $data->endTime = $endTime;
         // dd($data->endTime);

         $data_act->discount = $request->discount;
         $data_act->count = $request->count;
         $data_act->gid = $gid;
         $data_act->aid = $request->aid;
         //压入数据表 返回受影响行数
        if($data->save() && $data_act->save()){
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
        $act_datas = Activities::select('id')->get();
        return view('admins.activities.edit',['act_data'=>Act_goods::find($id),'act_datas'=>$act_datas]);
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
        $data_act = Act_goods::where('id',$id)->first();
        
        //更新Activities表的数据
        
        //更新Act_goods表的数据
        $data_act->aid = $request->aid;
        $data_act->discount = $request->discount;
        $data_act->count = $request->count;

        
        // dd($request->startTime);
        //压入数据表 返回受影响行数
        if($data_act->save()){
        
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
        //执行删除
        if(Act_goods::destroy($id)){
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

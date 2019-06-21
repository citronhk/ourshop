<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orders_users;
use App\Models\Orders_infos;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search','');
        
        
        //查询数据
        $orders_datas = Orders_infos::where('order_number','like','%'.$search.'%')->paginate(5);
        //传输到页面
        return view('admins.orders.index',['orders_datas'=>$orders_datas,'params'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //查询数据 传输到页面
        return view('admins.orders.edit',['orders_infos_data'=>Orders_infos::find($id)]);
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
        //获取订单表数据
        $datas = Orders_infos::find($id);
        //修改数据
        $datas->order_number = $request->input('order_number');
        $datas->gid = $datas->gid;
        $datas->oprice = $request->input('oprice');
        $datas->number = $request->input('number');
        $datas->order_addr = $request->input('order_addr');
        $datas->status = $request->input('status');
        $datas->otime = date('Y-m-d H:i:s');
        
        //执行修改 返回受影响行数
        $res = $datas->save();
        
        if($res){
        
            return redirect('/admin/orders')->with('success','修改成功');
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
        //获取订单表的数据
        $data = Orders_infos::find($id);
        //获取关联用户订单表用户的数据 执行删除 返回受影响行数
        $res = Orders_users::where('oid',$data->id)->delete();
        //执行删除，返回信息
        if(Orders_infos::destroy($id) && $res){
            
            return redirect('/admin/orders')->with('success','删除成功');
        }else{
            return back()->with('error','删除成功');
        }
    }
}

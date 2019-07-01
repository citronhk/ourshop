<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use Illuminate\Support\Facades\Storage;
use App\Models\Cates;
use App\Models\Comment;
use App\Models\Seckills;
use App\Models\Activities;
use App\Models\Orders_users;
use App\Models\Orders_infos;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取搜索条件
        $search1 = $request->input('search1',''); 
        $search2 = $request->input('search2','');

        //判断搜索条件是否为空
        if(!$search1){
            $goods_datas = Goods::where('gname','like','%'.$search2.'%')->paginate(5);
        }else{
            $goods_datas = Goods::where('gname','like','%'.$search2.'%')->where('cid','=',$search1)->paginate(5);
        }
        //查询分类数据
        $cates_data = CatesController::getCatesData();
        //显示页面 传输数据
        return view('admins.goods.index',[
                 'search1'=>$search1,
                 'cates_data'=>$cates_data,
                 'search2'=>$search2,
                 'goods_datas'=>$goods_datas,
                 'params'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //查询商品数据表
        $goods_data = Goods::find($request->input('id',''));
        //显示页面 传输数据
        return view('admins.goods.create',['cates'=>CatesController::getCatesData(),'goods_data'=>$goods_data]);
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
               'gname' => 'required',
               'cid' => 'required',
               'desc' => 'required',
               'price' => 'required',
               'goodsNum' => 'required',
               'pic' => 'required',
             ],[
               'gname.required'=>'商品名称必填',
               'cid.required'=>'商品分类必填',
               'desc.required'=>'商品描述必填',
               'price.required'=>'商品价格必填',
               'goodsNum.required'=>'商品数量必填',
               'pic.required'=>'商品照片必填',
             ]
             );
        //判断上传文件        
        if($request->pic){
            $path = $request->file('pic')->store(date('Ymd'));
        }else{
            $path = '';
        }

        //实例化对象
        $datas = new Goods;
        //压入数据
        $datas->gname = $request->input('gname');
        $datas->cid = $request->input('cid');
        $datas->desc = $request->input('desc');
        $datas->price = $request->input('price');
        $datas->goodsNum = $request->input('goodsNum');
        $datas->status = 1;
        $datas->pic = $path;
        //将数据压入数据库 返回受影响行数
        $res = $datas->save();
        if($res){
             $id = $datas->id;
             $data = Goods::select('id','gname')->find($id);
             return view('admins.detail.create',['data'=>$data]);
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
        return view('admins.goods.edit',['goods_data'=>Goods::find($id),'cates'=>Cates::all()]);
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
        //判断上传文件
        if($request->hasFile('pic')){
            Storage::delete($request->input('repic'));
            $path = $request->file('pic')->store(date('Ymd'));
        }else{
            $path = $request->input('repic');
        }
        //查询一条数据
        $datas = Goods::find($id);
        //修改数据
        $datas->gname = $request->input('gname');
        $datas->cid = $request->input('cid');
        $datas->desc = $request->input('desc');
        $datas->price = $request->input('price');
        $datas->goodsNum = $request->input('goodsNum');
        $datas->status = 1;
        $datas->pic = $path;

        //将修改后的数据压入数据库
        $res = $datas->save();
        
        if($res){
        
            return redirect('/admin/goods')->with('success','修改成功');
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
        //查询数据 一条
        $data = Goods::find($id);
        
        //删除数据 判断是否成功
        if(Goods::destroy($id)){
            //删除goods的数据是 同时删除关联数据表的相应数据
            Storage::delete($data->pic);
            Comment::where('gid',$data->id)->delete();
            Seckills::where('gid',$data->id)->delete();
            Activities::whe('gid',$data->id)->delete();
            Orders_infos::where('gid',$data->id)->delete();

            


            return redirect('/admin/goods')->with('success','删除成功');
        }else{
            return back()->with('error','删除成功');
        }

    }

    public function status($id)
    {
        $goods_status = Goods::find($id);
        $goods_status->status = !$goods_status->status;
        $res = $goods_status->save();
        if($res){
            return redirect('/admin/goods')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }


    
}

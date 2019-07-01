<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ads_act_goods;
use Illuminate\Support\Facades\Storage;

class AdsactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Ads_act_goods::orderBy('id','desc')->paginate(5);

        return view('admins.ads_act_goods.index',['datas'=>$datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $aid = $request->aid;
        $datas = Ads_act_goods::where('aid',$aid)->first();
        return view('admins.ads_act_goods.create',['datas'=>$datas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->url){
            $path = $request->file('url')->store(date('Ymd'));
        }else{
            $path = '';
        }
        
         $data = new Ads_act_goods;
         //压入数据
         $data->url = $path;
         $data->type = $request->type;
         $data->gid = $request->gid;
         $data->aid = $request->aid;
         //压入数据表 返回受影响行数
        if($data->save()){
            return redirect('/admin/adsact')->with('success','添加成功');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Ads_act_goods::find($id);

        if(Ads_act_goods::destroy($id)){
            Storage::delete($data->url);
            return redirect('/admin/adsact')->with('success','删除成功');
        }else{
            return back()->with('error','删除成功');
        }
    }


    public function url(Request $request)
    {
        $data = Ads_act_goods::find($request->id);
        return view('admins.ads_act_goods.edit',['data'=>$data]);
    }

    public function upUrl(Request $request)
    {

        if($request->hasFile('url')){
            $path = $request->file('url')->store(date('Ymd'));
        }else{
            $path = $request->reurl;
        }

        $data = Ads_act_goods::find($request->id);

        $data->url = $path;

        if($data->save()){
            return redirect('/admin/adsact')->with('success','添加成功');
        }else{
            return back('添加失败');
        }

    }
}

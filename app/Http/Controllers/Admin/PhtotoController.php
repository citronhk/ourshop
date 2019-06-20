<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Phtoto;
use App\Models\Goods;


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
        
        return view('admins.phtoto.index',['phtoto_data'=>$phtoto_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('id');

        $data = Phtoto::find($id);
        return view('admins.phtoto.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dump($request->all());
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
            return redirect('/admin/phtoto')->with('success','添加成功');
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
        //
        
    }

    public function del($id)
    {
        $data = Phtoto::find($id);
        if(Phtoto::destroy($id)){
            return redirect('/admin/phtoto')->with('success','删除成功');
        }else{
            return back()->with('error','删除成功');
        }
    }
}

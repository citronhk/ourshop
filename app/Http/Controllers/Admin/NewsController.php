<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\News;

class NewsController extends Controller
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
        $news_datas = DB::table('news')->where('title','like','%'.$search.'%')->paginate(5);
        return view('admins.news.index',['news_datas'=>$news_datas,'search'=>$search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接受上传数据，压入数组
        $data['title'] = $request->title;
        $data['desc'] = $request->title;
        $data['content'] = $request->content;
        $data['status'] = 1;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');
        
        //把数组数据压入数据库，返回受影响行数
        $res = DB::table('news')->insert($data);
        if($res){
            return redirect('/admin/news')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
        $news_data = DB::table('news')->where('id',$id)->first();
        return view('admins.news.edit',['news_data'=>$news_data]);
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
        $data['title'] = $request->title;
        $data['desc'] = $request->desc;
        $data['content'] = $request->content;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');

        //把数组数据压入数据库，返回受影响行数
        $res = DB::table('news')->where('id',$id)->update($data);
        if($res){
            return redirect('/admin/news')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
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
        //删除
        $res = DB::table('news')->where('id',$id)->delete();

        if($res){
            return redirect('/admin/news')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }

    public function status($id)
    {
        $news_status = News::find($id);
        $news_status->status = !$news_status->status;
        $res = $news_status->save();
        if($res){
            return redirect('/admin/news')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
}

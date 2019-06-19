<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;
class CatesController extends Controller
{
    /**
     * 后台 分类名称处理
     *
     * @return 处理后分类名称数据
     */
    public static function getCatesData()
    {
         $cates = Cates::select('*',DB::raw("concat(path,',',id)as paths"))->orderBy('paths','asc')->get();

        foreach ($cates as $key => $value) {
            $n = substr_count($value->path, ',');
            $cates[$key]->cname = str_repeat('|----', $n).$value->cname; 
        }
        return $cates;
    }

    /**
     * 后台 分类列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $search_cname = $request->input('search_cname','');
        //分页显示处理后的数据
        $cates = Cates::select('*',DB::raw("concat(path,',',id)as paths"))->where('cname','like','%'.$search_cname.'%')->orderBy('paths','asc')->paginate(8);

        foreach ($cates as $key => $value) {
            $n = substr_count($value->path, ',');
            $cates[$key]->cname = str_repeat('|----', $n).$value->cname; 
        }
       //显示模板
        return view('admins.cates.index',['cates'=>$cates,'params'=>$search_cname]);
    }

    /**
     * 后台 创建分类 
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $id = $request->input('id','0');
        //跳转创建页面
        return view('admins.cates.create',['id'=>$id,'cates'=>self::getCatesData()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取pid
        $pid = $request->input('pid','0');
            if($pid == 0){
                $path = 0;
            }else{
                //获取父级数据
                $parent_data = Cates::find($pid);
                $path = $parent_data->path.','.$parent_data->id;
            }

        //将数据压入数据库
        $cate = new Cates;
        $cate->cname = $request->input('cname');
        $cate->pid = $pid;
        $cate->path = $path;  
        $res = $cate->save(); 
        if($res){
            return redirect('/admin/cates')->with('success','添加成功');
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
    public function destroy(Request $request,$id)
    {
        
        $cate = Cates::find($id);
        $res = $cate->delete();
         if($res){
            echo json_encode(['msg'=>'ok','info'=>'删除成功']);
            
        }else{
            echo json_encode(['msg'=>'err','info'=>'删除失败']);
            
        }
    }
}

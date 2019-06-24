<?php
 
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nodes;
use DB;
class NodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //接收搜索的条件
      $search =  $request->input('search','');
        //获取数据
        $nodes = Nodes::where('desc','like','%'.$search.'%')->paginate(8);
        return view('admins.nodes.index',['nodes'=>$nodes,'search'=>$search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.nodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //开启事务
       DB::beginTransaction();
       //接收数据
       $nodes = new Nodes;
       $data = $request->all();

       $nodes->desc = $data['desc'];
       $nodes->cname = $data['cname'].'controller'  ;
       $nodes->aname = $data['aname'];
       $res = $nodes->save();
       if($res){
         DB::commit();
         return redirect('admin/nodes')->with('success','添加成功');
       }else{
         DB::rollBack();
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
      //获取单条数据
      $node = Nodes::find($id);
      return view('admins.nodes.edit',['node'=>$node]);
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
       //开启事务
       DB::beginTransaction();

      //文件上传
      if($request->hasFile('profile')){
        //删除旧照片
        Storage::delete($request->input('old_profile'));
        $file_path = $request->file('profile')->store(date('Ymd'));
      }else{
        $file_path = $request->input('old_profile');
      }
      
       //获取数据
       $node = Nodes::find($id);    
       $node->desc = $request->desc;
       $node->cname = $request->cname;

       $node->aname = $request->aname;
       $res = $node->save();
       if($res){
         DB::commit();
         return redirect('admin/nodes')->with('success','修改成功');
       }else{
         DB::rollBack();
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
        //开启事务
       DB::beginTransaction();
      
       $res = Nodes::where('id',$id)->delete();
        if($res){
         DB::commit();
         return back()->with('success','删除成功');
       }else{
         DB::rollBack();
         return back()->with('error','删除失败');
       }
    }


    
}

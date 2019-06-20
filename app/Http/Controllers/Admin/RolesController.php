<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nodes;
use App\Models\Roles;
use App\Models\RolesNodes;
use DB; 
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function conall()
    {
        return [
          'userscontroller'=>'用户管理',
          'bannerscontroller'=>'轮播图管理',
          'adscontroller'=>'广告管理',
          'linkscontroller'=>'友情链接管理',
          'catescontroller'=>'分类管理',
          'indexcontroller'=>'后台首页',
        ];
    }

    public function index()
    {
        //获取数据
        $roles = DB::table('roles')->get();
        return view('admins.roles.index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //获取权限表数据
        $nodes_data = Nodes::all();

        //优化显示数据
        $list = [];
        foreach($nodes_data as $k=>$v){
            $temp['id'] = $v->id;
            $temp['desc'] = $v->desc;
            $temp['aname'] = $v->aname;
            $list[$v->cname][] = $temp;
        } 
        //dump($list);
        return view('admins.roles.create',['nodes_data'=>$nodes_data,
            'list'=>$list,
            'conall'=>self::conall()
            ]);
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

       $rname = $request->input('rname','');
       $nids = $request->input('nids','');

       //添加角色表
       $rid = DB::table('roles')->insertGetId(['rname'=>$rname]);

       //添加角色关系表
       foreach ($nids as $k => $v) {
           $res = DB::table('roles_nodes')->insert(['rid'=>$rid,'nid'=>$v]);
       }

       if($rid && $res){
        DB::commit();
        return redirect('admin/roles')->with('success','添加成功');
       }else{
        DB::rollBack();
        return redirect('admin/roles')->with('error','添加失败');
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

        //获取权限表数据
        $nodes_data = Nodes::all();
        //获取单条角色数据
        $role = Roles::find($id);

        //获取一个角色有多少个权限
        $nodes_roles = $role->rolesnodes;

        //优化显示数据
        $list = [];
        foreach($nodes_data as $k=>$v){
            $temp['id'] = $v->id;
            $temp['desc'] = $v->desc;
            $temp['aname'] = $v->aname;
            $list[$v->cname][] = $temp;
        }
        $id_arr = array_column($nodes_roles->toArray(), 'nid');
        //dd($list,$nodes_roles->toArray(),$id_arr); 
        return view('admins.roles.edit',['nodes_data'=>$nodes_data,
            'list'=>$list,
            'conall'=>self::conall(),
            'role'=>$role,
             'nodes_roles'=>$nodes_roles,
             'id_arr'=>$id_arr
            ]);
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
       $res1 = Roles::destroy($id);
       $res2 = RolesNodes::where('rid',$id)->delete();
        if($res1 && $res2){
         DB::commit();
         return back()->with('success','删除成功');
       }else{
         DB::rollBack();
         return back()->with('error','删除失败');
       }
    }
}

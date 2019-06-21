<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search','');
        $comment_data = Comment::where('content','like','%'.$search.'%')->paginate(5);
        return view('admins.comment.index',['search'=>$search,'comment_data'=>$comment_data,'params'=>$request->all()]);
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
        
        return view('admins.comment.edit');
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
        $data = Comment::find($id);
        if(Comment::destroy($id)){
            return redirect('/admin/comment')->with('success','删除成功');
        }else{
            return back()->with('error','删除成功');
        }
    }


    public function status(Request $request)
    {
        $id = $request->input('id');
        $comment_status = Comment::find($id);
        $comment_status->status = !$comment_status->status;
        $res = $comment_status->save();

        // if($res){
        //     echo json_encode(['msg'=>'ok']);
        // }else{
        //     echo json_encode(['msg'=>'err']);
        // }
        if($res){
            return redirect('/admin/comment')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
}

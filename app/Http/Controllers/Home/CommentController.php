<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Car;
use App\Models\Users;
use App\Models\Addrs;
use App\Models\orders_infos;
use App\Models\Orders_users;
use DB;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * 评论
     * @param CarController方法，
     * @return view 
     */
    public function evaluate()
    {
        $status = 2;
        //获取当前登录用户购物车信息
        $car = CarController::cardata();
        //获取用户所有订单内商品详情
        $path = '/home/order/evaluate?status=2';
        $order_info = OrderController::orderInfoStatus($status,3,$path);

        //获取用户订单商品状态
        $order_status = OrderController::order_status();
        
        // foreach ($order_info as $key => $value) {
        //     dd($value);
        // }
        // dd($order_info);

        return view('home.comment.evaluate',[
            'car'=>$car,
            'order_info'=>$order_info,
            'order_status'=>$order_status,
        ]);
    }


    /**
     * 执行评论操作
     * @param CarController方法，
     * @return view 
     */
    public function comment(Request $request)
    {
        DB::beginTransaction();

        $gid = $request->input('gid');

        $comment = New Comment;
        $comment->uid = session('home_userinfo')->id;
        $comment->gid = $gid;
        $comment->content = $request->input('content');
        $comment->grade = $request->input('grade','1');
        $res = $comment->save();


        $order_info = orders_infos::where('gid',$gid)->where('order_number',$request->input('order_number'))->first();
        $order_info->status = 3;
        $res2 = $order_info->save();

        if($res && $res2){
            DB::commit();
            echo json_encode(['msg'=>'ok','info'=>'评论成功']);
        }else{
            echo json_encode(['msg'=>'err','info'=>'评论失败']);
            DB::rollBack();
        }
    }

     /**
     * 执行评论操作
     * @param CarController方法，
     * @return view 
     */
    public function index()
    {
    	 $status = 3;
        //获取当前登录用户购物车信息
        $car = CarController::cardata();
        //获取用户所有订单内商品详情
        $path = '/home/comment/index?status=2';
        $order_info = OrderController::orderInfoStatus($status,3,$path);

        //获取用户订单商品状态
        $order_status = OrderController::order_status();
        //当前用户id
        $id = session('home_userinfo')->id;
       $comment = Comment::where('uid',$id)->orderBy('created_at', 'desc')->get();
       // dump($comment);
       // dd($order_info);


        return view('home.comment.index',[
            'car'=>$car,
            'order_info'=>$order_info,
            'order_status'=>$order_status,
            'comment'=>$comment,
        ]);
    }
}

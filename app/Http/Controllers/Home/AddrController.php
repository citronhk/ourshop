<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Addrs;
use DB;

class AddrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
         //获取当前登录用户购物车信息
      $car = CarController::cardata();

      //获取当前用户id
      $id = session('home_userinfo')->id;

      $addrs = Addrs::where('uid',$id)->paginate(2);
      // dd($addrs);

      return view('home.addr.index',['car'=>$car,'addrs'=>$addrs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取当前登录用户购物车信息
        $car = CarController::cardata();

        return view('home.addr.create',['car'=>$car]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
         $this->validate($request, [
            
            'order_addr' => 'required',
            'order_name' => 'required',
            'phone' => 'required|regex:/^[\w]{5,17}$/',
            
             
        ],[
            'order_addr.required'=>'收件人地址必填',
            'order_name.required'=>'收货人姓名必填',
            'phone.required' => '手机号必填',
            'phone.regex' => '手机号格式不正确',
    
        ]);

        $order_addr = $request->input('province').$request->input('country').$request->input('town').$request->input('order_addr');
        
        $addr = new Addrs;
        $addr->order_addr = $order_addr;
        $addr->order_name = $request->input('order_name');
        $addr->uid = session('home_userinfo')->id; 
        $addr->phone = $request->input('phone');
        $addr->email = $request->input('email','');
        $addr->postal = $request->input('postal','');
        $addr->addr_name = $request->input('addr_name','');
        $addr->telephone = $request->input('telephone','');
        $res = $addr->save();
        if($res){
            return redirect('/home/addr')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
        // dd($addr);
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
        //获取当前登录用户购物车信息
        $car = CarController::cardata();

        //获取要进行修改收货地址的数据
        $addr = Addrs::find($id);

        return view('home.addr.edit',['car'=>$car,'addr'=>$addr]);
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
         $this->validate($request, [
            
            'order_addr' => 'required',
            'order_name' => 'required',
            'phone' => 'required|regex:/^[\w]{5,17}$/',
            
             
        ],[
            'order_addr.required'=>'收件人地址必填',
            'order_name.required'=>'收货人姓名必填',
            'phone.required' => '手机号必填',
            'phone.regex' => '手机号格式不正确',
    
        ]);

        $order_addr = $request->input('province').$request->input('country').$request->input('town').$request->input('order_addr');
        
        $addr = Addrs::find($id);
        $addr->order_addr = $order_addr;
        $addr->order_name = $request->input('order_name');
        $addr->uid = session('home_userinfo')->id; 
        $addr->phone = $request->input('phone');
        $addr->email = $request->input('email','');
        $addr->postal = $request->input('postal','');
        $addr->addr_name = $request->input('addr_name','');
        $addr->telephone = $request->input('telephone','');
        $res = $addr->save();
        if($res){
            return redirect('/home/addr')->with('success','修改成功');
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
        $addr = Addrs::find($id);
        $res = $addr->delete();
         if($res){
            echo json_encode(['msg'=>'ok','info'=>'删除成功']);
            
        }else{
            echo json_encode(['msg'=>'err','info'=>'删除失败']);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changestatus($id)
    {

         //获取当前登录用户购物车信息
        $car = CarController::cardata();

        //开启事务
        DB::beginTransaction();

        $uid = session('home_userinfo')->id;
        $addrs_data = Addrs::where('uid',$uid)->get();
        
        // 捕获异常
        try{
            //将该用户所有收货地址状态设为0
            foreach ($addrs_data as $key => $value) {
                $value->status = 0;
                $res2 =$value->save();

                //抛出异常
                if($res2 === false){
                    throw new Exception("Error Processing Request", 1); 
                };

            };
            //将用户需要地址设为默认收获地址，状态变为1
            $addr = Addrs::find($id);
            $addr->status = 1;
            $res = $addr->save();

            //抛出异常
            if($res === false){
                throw new Exception("Error Processing Request", 1);
                
            };
        
            //事务提交
            DB::commit();
        //捕获异常
        }catch(\Exception $e){
            //事务回滚
            DB::rollBack();
            return redirect('home/addr/changestatus')->with('success','修改异常');
        }

        //  //获取当前用户id
        //   $id = session('home_userinfo')->id;

        //   $addrs = Addrs::where('uid',$id)->paginate(2);

        // return view('home.addr.index',['car'=>$car]);
        
        return back()->with('success','设置成功');

    }
}

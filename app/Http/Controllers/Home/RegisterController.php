<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Usersinfo;
use DB;
use Hash;
use Mail;

class RegisterController extends Controller
{
    //加载注册页面
    public function index()
    {
    	return view('home.register.index');
    }

    //执行邮箱注册
    public function insert(Request $request)
    {
    	$this->validate($request, [
    		
            'upass' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:upass',
        ],[
            'upass.required'=>'密码必填',
            'upass.regex'=>'密码格式不正确',
            'repass.required'=>'确认密码必填',
            'repass.same'=>'两次密码不一致'
        ]);

    	$token = str_random(30);

    	$email = $request->input('email');
    	$upass = $request->input('upass');

    	$user = new Users;
    	$user->upass = Hash::make($upass);
    	$user->email = $email;
    	$user->token = $token; 
    	$res1 = $user->save();
    	
    	if($res1){
			//发送邮件
        	 Mail::send('home.register.mail', ['id' => $user->id,'token'=>$token], function ($m) use ($email) {
        	 	//to 发送地址  subject 标题
        	    $r = $m->to($email)->subject('[LAMPoto]提醒邮件');

        	    if(!$r){
        	    	return false;
        	    }
	    
        	});
        	    	return redirect('/home/register')->with('success','注册成功,请尽快前往邮箱完成激活');

    	}



    }

    //激活 用户(邮件)
    public function changeStatus($id,$token)
    {
    	// echo '激活------'.$id;
    	$user = Users::find($id);
    	//验证token
    	if($user->token != $token){
    		dd('链接失效');
    	}
     	$user->status = 1;
     	$user->token = str_random(30);
    	if($user->save()){
    		echo '激活成功';
    	}else{
    		echo '激活失败';
    	}
    }

    //执行手机注册
    public function store(Request $request)
    {
    	// dump($request->all());
    	//验证手机验证码
    	$code = $request->input('code');


    	//获取发送到手机的验证码
    	$phone = $request->input('phone');
    	$k = $phone.'_code';
    	$phone_code = session($k);

    	//判断手机是否注册过
    	$res = Users::where('phone','=',$phone)->first();
    	if($res){
    		return redirect('/home/login')->with('error','此手机号已注册过,请直接登录!');
    	}

    	if($phone_code != $code){
    		echo "<script>alert('验证码错误');location.href='/home/register'</script>";
    		exit;
    	}


    	$this->validate($request, [
    		'phone' => 'required',
    		'code' => 'required',
            'upass' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:upass',
        ],[
        	'phone.required' => '手机号必填',
        	'code.required' => '验证码必填',
            'upass.required'=>'密码必填',
            'upass.regex'=>'密码格式不正确',
            'repass.required'=>'确认密码必填',
            'repass.same'=>'两次密码不一致'
        ]);

       //开启事务
       DB::beginTransaction();
    
        $data = $request->all();
         //接收数据
       $user = new Users;
       $user->upass=Hash::make($data['upass']);
       $user->phone=$data['phone'];
       $user->status= 1;
       $res1 = $user->save();
       if($res1){
        //获取uid
        $uid = $user->id;
       }


       //压入
       $userinfo = new Usersinfo;
       $userinfo->uid = $uid;
       $res2 = $userinfo->save();
    
        if($res1 && $res2){
         DB::commit();
         return redirect('/home/register')->with('success','注册成功');
       }else{
         DB::rollBack();
         return back()->with('error','注册失败');
       }
    }

    //发送手机验证码
    public function sendPhone(Request $request)
    {


    	//接收手机号
    	$phone = $request->input('phone');

    	
    	// dd($res);
    	
    	//生成随机验证码
    	$code = rand(123456,654321);

    	//session储存验证码
    	$k = $phone.'_code';
    	session([$k=>$code]);

    	$url = "http://v.juhe.cn/sms/send";
		$params = array(
		    'key'   => '56608e43634623176f1a2e933e9ede5b', //您申请的APPKEY
		    'mobile'    => $phone, //接受短信的用户手机号码
		    'tpl_id'    => '166099', //您申请的短信模板ID，根据实际情况修改
		    'tpl_value' =>'#code#='.$code, //您设置的模板变量，根据实际情况修改
			'dtype' =>'json',
		);

		$paramstring = http_build_query($params);
		$content = self::juheCurl($url, $paramstring);
		// $result = json_decode($content, true); 将json转化为数组
		//返回结果
		// if ($result) {
		//     var_dump($result);
		// }

		echo $content;

    }

    /**
		 * 请求接口返回内容
		 * @param  string $url [请求的URL地址]
		 * @param  string $params [请求的参数]
		 * @param  int $ipost [是否采用POST形式]
		 * @return  string
		 */
		public static function juheCurl($url, $params = false, $ispost = 0)
		{
		    $httpInfo = array();
		    $ch = curl_init();

		    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		    curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
		    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		    if ($ispost) {
		        curl_setopt($ch, CURLOPT_POST, true);
		        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		        curl_setopt($ch, CURLOPT_URL, $url);
		    } else {
		        if ($params) {
		            curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
		        } else {
		            curl_setopt($ch, CURLOPT_URL, $url);
		        }
		    }
		    $response = curl_exec($ch);
		    if ($response === FALSE) {
		        //echo "cURL Error: " . curl_error($ch);
		        return false;
		    }
		    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		    $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
		    curl_close($ch);
		    return $response;
		} 
}

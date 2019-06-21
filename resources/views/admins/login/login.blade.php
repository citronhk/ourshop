 <!doctype html>
<html lang="en" class="fullscreen-bg">

	 <link rel="stylesheet" href="/layui-v2.4.5/layui/css/layui.css">
     <script src="/layui-v2.4.5/layui/layui.js"></script>
<head>
	<title>Login | Klorofil - Free Bootstrap Dashboard Template</title>
	    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="/admins/css/bootstrap.min.css">
	<link rel="stylesheet" href="/admins/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/admins/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="/admins/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="/admins/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="/admins/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/admins/img/favicon.png">

</head>
<script>
//一般直接写在一个js文件中
layui.use(['layer', 'form'], function(){
  var layer = layui.layer
  ,form = layui.form;

});
</script> 
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="/admins/img/logo-dark.png" alt="Klorofil Logo"></div>
								<p class="lead">Love and peace</p>
							</div>
			                <!-- 表单 -->
			 
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">用户名</label>
									<input type="text" class="form-control" id="signin-email" name="uname" value="{{ old('uname') }}" placeholder="用户名">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">密码</label>
									<input type="password" class="form-control" name="upass" id="signin-password" value="" placeholder="密码">
								</div>
								<div class="form-group clearfix">
<!-- 									<label class="fancy-checkbox element-left">
										<input type="checkbox">
										<span>Remember me</span>
									</label> -->
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block" onclick="login()">登陆</button>
								<div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">忘记密码?</a></span>
								</div>
			            
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Free Bootstrap dashboard template</h1>
							<p>by The Develovers</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
<script src="https://cdn.bootcss.com/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });                            
    function login()
    {
        //获取用户输入时的用户名和密码
        let uname = $('input[name=uname]').eq(0).val();
        let upass = $('input[name=upass]').eq(0).val();
        //发送ajax
       $.post('/admin/dologin',{uname,upass},function(res){
        if(res.msg == 'err'){
            //登录失败
         // console_log(res.info);	
           layer.msg(res.info);
        }else{
            //登录成功
          layer.msg(res.info);
           //跳转
           window.location.href='/admin/index';
        }
       },'json'); 
    }
</script>
</html>

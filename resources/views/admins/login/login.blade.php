
<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | Klorofil - Free Bootstrap Dashboard Template</title>
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
							<form class="form-auth-small" action="/admin/dologin" method="post">
							      {{ csrf_field() }}
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="text" class="form-control" id="signin-email" name="uname" value="{{ old('uname') }}" placeholder="用户名">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" name="upass" id="signin-password" value="" placeholder="密码">
								</div>
								<div class="form-group clearfix">
<!-- 									<label class="fancy-checkbox element-left">
										<input type="checkbox">
										<span>Remember me</span>
									</label> -->
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">登陆</button>
								<div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">忘记密码?</a></span>
								</div>
							</form>
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

</html>

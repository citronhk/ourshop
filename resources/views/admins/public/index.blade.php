<!doctype html>
<html lang="en">

<head>
	<title>Dashboard | Klorofil - Free Bootstrap Dashboard Template</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="/admins/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/admins/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/admins/vendor/linearicons/style.css">
	<link rel="stylesheet" href="/admins/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="/admins/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="/admins/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="/admins/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/admins/img/favicon.png">


	<!-- Javascript 开始-->
	<script src="/admins/vendor/jquery/jquery.min.js"></script>
	<script src="/admins/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="/admins/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/admins/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="/admins/vendor/chartist/js/chartist.min.js"></script>
	<script src="/admins/scripts/klorofil-common.js"></script>

	<!-- Javascript 开始-->
</head>

<body>
	<div id="wrapper">
		<!-- 头部栏 开始 -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="/admin/index"><img src="/admins/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form>
				<div class="navbar-btn navbar-btn-right">
					<a class="btn btn-success update-pro" href="/admin/outlogin" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>退出</span></a>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown"></li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img style="border-radius:50%;border:1px solid black;width:50px;" src="">
							 <span></span>
							  <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li> <a href="javascript:;" onclick="changepass()"><i class="fa fa-cog"></i>修改密码</a> </li> 
								<li> <a href="javascript:;" onclick="changeimg()"><i class="fa fa-user"></i>更换头像</a> </li> 

							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- 头部栏 结束 -->

		<!-- 侧边栏 开始 -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">

					<li>
							<a href="#cate" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>分类管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="cate" class="collapse ">
								<ul class="nav">
									<li><a href="/admin/cates" class="">分类列表</a></li>
									<li><a href="/admin/cates/create" class="">分类添加</a></li>
								  </ul>
							</div>
					</li>
					
                    <!-- 商品管理 -->
                        <li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>商品管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="/admin/goods" class="">商品列表</a></li>
									<li><a href="/admin/goods/create" class="">商品添加</a></li>
									<li><a href="/admin/detail" class="">商品详情</a></li>
								  </ul>
							</div>
						</li>

                        <!-- 订单管理 -->
						<li>
							<a href="#orders" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>订单管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="orders" class="collapse ">
								<ul class="nav">
									<li><a href="/admin/orders" class="">订单列表</a></li>
									
								  </ul>
							</div>
						</li>

						<!-- 评价管理 -->
						<li>
							<a href="#comment" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>评价管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="comment" class="collapse ">
								<ul class="nav">
									<li><a href="/admin/comment" class="">评价列表</a></li>
								  </ul>
							</div>
						</li>

						<!-- 秒杀管理 -->
						<li>
							<a href="#seckills" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>秒杀商品管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="seckills" class="collapse ">
								<ul class="nav">
									<li><a href="/admin/seckills" class="">秒杀商品列表</a></li>
								  </ul>
							</div>
						</li>

						<!-- 活动管理 -->
						<li>
							<a href="#activities" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>活动管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="activities" class="collapse ">
								<ul class="nav">
									<li><a href="/admin/activities" class="">活动商品列表</a></li>
								  </ul>
							</div>
						</li>


					</ul>
				</nav>
			</div>

		</div>
		<!-- 侧边栏 结束 -->

		<!-- 内容-接口 开始 -->

		<div class="main">

			@if(session('success'))
			<div class="bs-example" data-example-id="dismissible-alert-css">
			    <div class="alert alert-success alert-dismissible" role="alert">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			      <strong>{{ session('success') }}</strong> 
			    </div>
			  </div>
			@endif


			@if(session('error'))
			<div class="bs-example" data-example-id="dismissible-alert-css">
			    <div class="alert alert alert-danger alert-dismissible" role="alert">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			      <strong>{{ session('error') }}</strong> 
			    </div>
			  </div>
			@endif
			  @section('main')
		 
          @show
		</div>
		<!-- 内容-接口 结束 -->

        <!-- 尾部 开始 -->
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="#" target="_blank">Theme I Need</a>. All Rights Reserved. More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></p>
			</div>
		</footer>
		<!-- 尾部 结束 -->
	</div>
</body>

</html>

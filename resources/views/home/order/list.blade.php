@extends('home.public.share')

@section('main')
		<!-- <link href="/homes/css/personal.css" rel="stylesheet" type="text/css"> -->
		<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
		<link href="/homes/css/systyle.css" rel="stylesheet" type="text/css">
		<div class="center">
			<div class="main-wrap">
				<div class="wrap-list" style="width:100%;">
					<!--订单 -->
					<div class="m-order" style="margin-top: 0px;width:100%;">
						<div class="s-bar" style="margin-top: 20px;">
							<i class="s-icon"></i>&nbsp;&nbsp;&nbsp;&nbsp;我的订单
							<a class="i-load-more-item-shadow" href="order.html">全部订单&nbsp;&nbsp;&nbsp;&nbsp;</a>
						</div>
						<ul>
							<li><a ><i><img src="/homes/image/pay.png"/></i><span>不存在未付款</span></a></li>
							<li><a href="/home/order/deliver?status=0"><i><img src="/homes/image/send.png"/></i><span>待发货<em class="m-num">{{$a}}</em></span></a></li>
							<li><a href="/home/order/deliver?status=1"><i><img src="/homes/image/receive.png"/></i><span>待收货<em class="m-num">{{$b}}</em></span></a></li>
							<li><a href="/home/order/deliver?status=2"><i><img src="/homes/image/comment.png"/></i><span>待评价<em class="m-num">{{$c}}</em></span></a></li>
							<li><a ><i><img src="/homes/image/refund.png"/></i><span>不给退换货</span></a></li>
						</ul>
					</div>
					<!--物流 -->
					<div class="m-logistics">
						<div class="s-bar">
							<i class="s-icon"></i>我的物流
						</div>
						<div class="s-content">
							<ul class="lg-list">
								@foreach($order_info as $k=>$v)
								<li class="lg-item">
									<div class="item-info">
										<a href="#">
											<img src="/uploads/{{ $v->orders_goods->pic }}" alt="抗严寒冬天保暖隔凉羊毛毡底鞋垫超薄0.35厘米厚吸汗排湿气舒适">
										</a>
									</div>
									<div class="lg-info">
										<p>运单号：{{ $v->order_number }}</p>
										<div class="lg-detail-wrap">
											<a class="lg-detail i-tip-trigger" >您的订单开始处理&nbsp;&nbsp;:&nbsp;&nbsp;{{ $v->otime }}</a>
										</div>
									</div>
									@if($v->status == 0)
									<div class="lg-confirm">
										<a class="i-btn-typical">待发货</a>
									</div>
									@elseif($v->status == 1)
									<div class="lg-confirm">
										<a class="i-btn-typical" onclick="confirm({{$v->id}},this);" href="#">确认收货</a>
									</div>
									@else($v->status == 2)
									<div class="lg-confirm">
										<a class="i-btn-typical">待评价</a>
									</div>
									@endif
								</li>
								<div class="clear"></div>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>	
		</div>
	<script type="text/javascript">
		
			function confirm(id,obj){
				$.get('/home/order/confirm',{id:id},function(res){
						console.log(res);
						location.reload()
						
				},'json');
			}
	</script>
@endsection
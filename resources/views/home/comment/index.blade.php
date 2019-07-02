@extends('home.public.share')

@section('main')	
		
		<link rel="stylesheet" type="text/css" href="/registers/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  		<script type="text/javascript" src="/registers/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
		<link href="/homes/css/systyle.css" rel="stylesheet" type="text/css">

		<style type="text/css">
			#header{
				margin-top: 20px;
				margin-left: 35px;
			}
			#header strong{
				font-size: 20px;
			} 
		</style>
		<div class="center">
		
			<!--标题 -->
			<div id="header">
				<div ><strong >发表评论</strong> / <small>Make&nbsp;Comments</small></div>
			</div>
			<hr/>
		</div>
		<div class="s-content">
			<ul class="lg-list">
				@foreach($order_info as $k=>$v)
				
				<li class="lg-item" style="height: 200px">
					<div class="item-info">
						<a href="#">
							<img src="/uploads/{{ $v['pic'] }}" style="width: 100px;height: 100px;border: 1px solid #f6f6f6;float: left;">
						</a>
						@if($comment[$k]->grade == 1)
						<div style="position: absolute; left: 150px;top:30px; ">
							<img src="/homes/images/iconfont-good.png" id="img1{{$k}}" style="width: 20px;height: 20px"><a>好评</a><br><br>
							
						</div>
						@elseif($comment[$k]->grade == 2)
						<div style="position: absolute; left: 150px;top:30px; ">
							
							<img src="/homes/images/iconfont-middle.png" id="img2{{$k}}" style="width: 20px;height: 20px"><a>中评</a><br><br>
							
						</div>
						@elseif($comment[$k]->grade == 3)
						<div style="position: absolute; left: 150px;top:30px; ">
							
							<img src="/homes/images/iconfont-badon.png" id="img3{{$k}}" style="width: 20px;height : 20px"><a>差评</a><br><br>
						</div>
						@endif
						<div class="clear"></div>
						<div style="margin-left: 200px;">
							<textarea id="content{{$k}}" disabled="disabled" name="content" style="width: 650px;height: 120px;margin-left: 50px;border: 1px solid #f6f6f6;margin-top: -5px;padding: 20px;letter-spacing:3px;font-size: 14px;background-color: #f6f6f621" placeholder="{{ $comment[$k]->content }}"></textarea>
						</div>
						<input type="hidden" id="grade{{$k}}" name="grade" value="">
						<input type="hidden" id="order_number{{$k}}" name="order_number" value="{{$v['order_number']}}">
						<input type="hidden" id="gid{{$k}}" name="gid" value="{{$v['gid']}}">
						<div>
							<p><strong>商品名称:&nbsp;</strong>{{$v['gname']}}</p>
							<p><strong>&nbsp;&nbsp;单价:&nbsp;￥</strong>{{$v['price']}}</p>
						</div>
					</div>
					<div class="info-btn" style="position: absolute;right: 85px;margin-top: 130px">
						<!-- <input type="submit"  value="感谢您参与评价......"></input> -->
						<p>感谢您参与评价......</p>
					</div>
					
				</li>
				
				<div class="clear"></div>
				@endforeach
			</ul>

			<div style="text-align: center;">
				{{ $order_info->links() }}	
			</div>
		</div>	
			
@endsection
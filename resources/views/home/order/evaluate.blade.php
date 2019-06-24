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
						<div style="position: absolute; left: 150px">
							<img src="/homes/images/iconfont-evaluate.png" id="img1{{$k}}" style="width: 20px;height: 20px"><a onclick="changeimg(0,{{$k}})">好评</a><br><br>
							<img src="/homes/images/iconfont-evaluate.png" id="img2{{$k}}" style="width: 20px;height: 20px"><a onclick="changeimg(1,{{$k}})">中评</a><br><br>
							<img src="/homes/images/iconfont-bad.png" id="img3{{$k}}" style="width: 20px;height : 20px"><a onclick="changeimg(2,{{$k}})">差评</a><br><br>
						</div>
						<div class="clear"></div>
						<div style="margin-left: 200px;">
							<textarea id="content{{$k}}" name="content" style="width: 650px;height: 120px;margin-left: 50px;border: 1px solid #f6f6f6;margin-top: -5px" placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！"></textarea>
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
						<input type="submit" class="btn btn-danger" value="发表评论" onclick="comment({{$k}},this)"></input>
					</div>
					
				</li>
				
				<div class="clear"></div>
				@endforeach
			</ul>

			<div style="text-align: center;">
				{{ $order_info->links() }}	
			</div>
		</div>	
			<script type="text/javascript">
				function changeimg(n,k){
					if(n == 0){
						$("#img1"+k).attr('src','/homes/images/iconfont-good.png'); 
						$("#img2"+k).attr('src','/homes/images/iconfont-evaluate.png'); 
						$("#img3"+k).attr('src','/homes/images/iconfont-bad.png'); 
						$('#grade'+k).val(1);
					}else if(n == 1){
						$("#img1"+k).attr('src','/homes/images/iconfont-evaluate.png');
						$("#img2"+k).attr('src','/homes/images/iconfont-middle.png');
						$("#img3"+k).attr('src','/homes/images/iconfont-bad.png'); 
						$('#grade'+k).val(2);
						
					}else{
						$("#img1"+k).attr('src','/homes/images/iconfont-evaluate.png');
						$("#img2"+k).attr('src','/homes/images/iconfont-evaluate.png');
						$("#img3"+k).attr('src','/homes/images/iconfont-badon.png');
						$('#grade'+k).val(3);
					}
					// console.log($('#grade').val());
				}
				function comment(n,obj){

					let gid = $('#gid'+n).val();
					let content = $('#content'+n).val();
					let grade = $('#grade'+n).val();
					let order_number = $('#order_number'+n).val();
					$.get('/home/order/comment',{gid:gid,content:content,grade:grade,order_number:order_number},function(res){
						if(res.msg == 'ok'){
							$(obj).parent().parent().remove();
							alert(res.info);
						}else if(res.msg == 'err'){
							alert(res.info);
						}
					},'json');
					
				}
			</script>			
@endsection
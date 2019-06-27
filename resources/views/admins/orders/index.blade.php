@extends('admins.public.index')


@section('main')
@if (count($errors) > 0)
	  <div class="alert alert-danger">
	       <ul>
	           @foreach ($errors->all() as $error)
	               <li>{{ $error }}</li>
	           @endforeach
	       </ul>
	  </div>
@endif

<!-- BASIC TABLE -->
 <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;订单管理</h3>
 <div class="panel" >
    <form class="navbar-form navbar-left" action="/admin/orders" method="get">
		<div class="input-group">
			<input type="textarea" value="" class="form-control" name="search" placeholder="订单号搜索">
			<span class="input-group-btn"><input type="submit" value="搜索" class="btn btn-primary"></span>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>收货人</th>
						<th>订单号</th>
						<th>订单商品</th>
						<th>订单时间</th>
						<th>订单单价</th>
						<th>订单数量</th>
						<th>收货地址</th>
						<th>快递状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				@foreach($orders_datas as $k=>$v)
					<tr>
						<td>{{ $v->id }}</td>
						<td>{{ $v->order_name }}</td>
						<td>{{ $v->order_number }}</td>
						<td>{{ $v->orders_goods->gname }}</td>
						<td>{{ $v->otime }}</td>
						<td>{{ $v->oprice }}</td>
						<td>{{ $v->number }}</td>
						<td>{{ $v->order_addr }}</td>
						<td>
							@if($v->status == 0)
							<b>未发货</b>
							@elseif($v->status == 1)
							<b>已发货</b>
							@else
                            <b>交易成功</b>
							@endif
						</td>
						<td>
							<a href="/admin/orders/{{ $v->id }}/edit" class="btn btn-info">修改</a>
							<form action="/admin/orders/{{ $v->id }}" method="post" style="display:inline-block;">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							     <input type="submit" class="btn btn-danger" value="删除">
							</form>
							<a href="javascript:;" onclick="see({{ $v->oid }})" class="btn btn-info">查看</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<script>
                


                function see(oid){
                	      $.get('/admin/orders/infoUser',{oid},function(res){
                              let arr = res.orders_datas;
                              let uname = res.uname
                             console.log(arr['id'])
 
                             $('input[name=order_number]').attr('value',arr['order_number']);
                             $('input[name=total]').attr('value',arr['total']);
                             $('input[name=order_addr]').attr('value',arr['order_addr']);
                             $('input[name=postal]').attr('value',arr['postal']);
                             $('input[name=message]').attr('value',arr['message']);
                             $('input[name=phone]').attr('value',arr['phone']);
                             $('input[name=uname]').attr('value',uname);
                             $('input[name=id]').attr('value',arr['id']);
                             $('input[name=uid]').attr('value',arr['uid']);
                             $('input[name=oid]').attr('value',arr['oid']);

                	      },'json');
                             $('input[type=text]').attr('disabled',true);
                        
                        	 $('#myModal').modal('show')
                        	
                        }

                 function sub2(){

                  	         $('input[name=submit2]').attr('style','display:none');
                  	         $('input[type=text]').attr('disabled',false);
                             $('input[name=submit1]').attr('style','display:block;width:100%'); 
                              }


			</script>
               <!-- Modal -->
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="                          myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="myModalLabel">订单用户信息</h4>
                                </div>
                                <div class="modal-body">
                                  <form action="/admin/orders/upUser" method="post" name="msg" >
                                  {{ csrf_field() }}
                                  <input type="hidden" name="id" value="">
                                  <input type="hidden" name="uid" value="">
                                  <input type="hidden" name="oid" value="">
                                  	 订单号：<input type="textarea" name="order_number" class="form-control" value="haha" style="width:100%;"  readonly>
                                  	 <br><br>
                                  	 订单用户：<input type="textarea" name="uname" class="form-control" value="" style="width:100%;" readonly> 
                                  	 <br><br>
                                  	 收货人手机号：<input type="text" name="phone" class="form-control" value="" style="width:100%;">
                                  	 <br><br>
                                  	 订单总价：<input type="text" name="total" class="form-control" value="" style="width:100%;">
                                  	 <br><br>
                                  	 收货地址：<input type="text" name="order_addr" class="form-control" value="" style="width:100%;">
                                  	 <br><br>
                                  	 邮政编码：<input type="text" name="postal" class="form-control" value="" style="width:100%;">
                                  	 <br><br>
                                  	 用户留言：<input type="text" name="message" class="form-control" value="" style="width:100%;">
                                  	 <br><br>
                                     <input type="submit" value="提交"   name="submit1" class="btn btn-success" style="width:100%;display:none" >
                                     <input type="button" value="修改" onclick="sub2()"  name="submit2" class="btn btn-success" style="width:100%;">
                                  </form>
                                </div>
                               
                              </div>
                            </div>
                          </div>
					</div>


			<div id="page_page">
			{{ $orders_datas->appends($params)->links() }}
            </div>
		</div>
	</div>
			<!-- END BASIC TABLE -->
@endsection


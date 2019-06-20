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
<!-- BASIC TABLE -->
 <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;订单管理</h3>
 <div class="panel" >
    <form class="navbar-form navbar-left" action="/admin/orders" method="get">
		<div class="input-group">
			<input type="text" value="" class="form-control" name="search" placeholder="订单号搜索">
			<span class="input-group-btn"><input type="submit" value="搜索" class="btn btn-primary"></span>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>所属用户</th>
						<th>订单号</th>
						<th>订单商品</th>
						<th>订单时间</th>
						<th>订单总价</th>
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
						<td>{{ $v->users_infos->orders_users->uname }}</td>
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
							
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<div id="page_page">
			{{ $orders_datas->appends($params)->links() }}
            </div>
		</div>
	</div>
			<!-- END BASIC TABLE -->
@endsection


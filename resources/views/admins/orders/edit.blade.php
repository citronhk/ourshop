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

<h3 class="title1">订单修改</h3>
    <div class="panel">
		<div class="panel-body">
		<form action="/admin/orders/{{ $orders_infos_data->id }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 
			{{ method_field('PUT') }}

		    所属用户：<input type="text" class="form-control" name="uname" value="{{ $orders_infos_data->users_infos->orders_users->uname }}" disabled>
		    <br>
		    订单号：<input type="text" class="form-control" name="order_number" value="{{ $orders_infos_data->order_number }}" >
		    <br>
		    订单商品：<input type="text" class="form-control" name="gname" value="{{ $orders_infos_data->orders_goods->gname }}" disabled>
		    <br>
		    订单数量：<input type="text" class="form-control" name="number" value="{{ $orders_infos_data->number }}">
		    <br>
		    订单总价：<input type="text" class="form-control" name="oprice" value="{{ $orders_infos_data->oprice }}" >
		    <br>
		    收货地址：<input type="text" class="form-control" name="order_addr" value="{{ $orders_infos_data->order_addr }}" >
		    <br>
            订单状态：<input type="radio"  name="status" value="0" {{ $orders_infos_data->status == 0 ? 'checked' : '' }}>未发货
                      <input type="radio"  name="status" value="1" {{ $orders_infos_data->status == 1 ? 'checked' : '' }}>已发货
                      <input type="radio"  name="status" value="2" {{ $orders_infos_data->status == 2 ? 'checked' : '' }}>交易成功
            <br>      
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection
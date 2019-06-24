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
    <div class="panel">
		<div class="panel-body">
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3 class="title1">收货地址添加</h3>

		<form action="/admin/addrs" method="post" enctype="multipart/form-data">
				{{ csrf_field() }} 
		    地址别名：<input type="text" class="form-control" name="addr_name" value="{{ old('addr_name') }}" placeholder="text field">
		    <br>
		    收货人姓名：<input type="text" class="form-control" name="order_name" value="{{ old('order_name') }}">
		    <br>
		    收货地址：<input type="text" class="form-control" name="addrs" value="{{ old('addrs') }}">
		    <br>
		    手机电话：<input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="电话">
		    <br>
		    固定电话：<input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" placeholder="可以为空">
		    邮箱:<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="可以为空"> >
		    <br>

            邮政编码：<input type="text" name="">
            <br>     
            <div class="mws-button-row"> 
            <input type="submit" value="提交" class="btn btn-info">
            </div>      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection


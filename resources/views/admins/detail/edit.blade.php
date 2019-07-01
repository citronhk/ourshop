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
		<form action="/admin/detail/{{ $detail_data->id }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 
			{{ method_field('PUT') }}

		    商品名称：<input type="text" class="form-control" name="gname" value="{{ $detail_data->detail_gid->gname }}" disabled>
		    <br>
		    商品规格：<input type="text" class="form-control" name="norm" value="{{ $detail_data->norm }}" >
		    <br>
		    商品品牌：<input type="text" class="form-control" name="brand" value="{{ $detail_data->brand }}">
		    <br>
		    商品源：<input type="text" class="form-control" name="origin" value="{{ $detail_data->origin }}">
		    <br>
		    商品重量：<input type="text" class="form-control" name="weight" value="{{ $detail_data->weight  }}" >
		    <br>
		    商品编号：<input type="text" class="form-control" name="num" value="{{ $detail_data->num }}" >
		    <br>
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection
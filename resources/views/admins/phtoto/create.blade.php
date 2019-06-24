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

<h3 class="title1">商品添加</h3>
    <div class="panel">
		<div class="panel-body">
		<form action="/admin/phtoto?id={{$data->id}}&gid={{$data->phtoto_goods->id}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 

		    商品名称：<input type="text" class="form-control" name="gname" value="{{$data->phtoto_goods->gname}}" disabled>
		    <br>
            商品图片：<input type="file" name="profile">
            <br>      
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection
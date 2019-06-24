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
		<form action="/admin/phtoto/{{ $phtoto_data->id }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 
			{{ method_field('PUT') }}

		    商品名称：<input type="text" class="form-control" name="gname" value="{{ $phtoto_data->phtoto_goods->gname }}" disabled>
		    <br>
		    <img src="/uploads/{{$phtoto_data->profile}}" width="80px">
		    <br>
		    商品图片：<input type="file" name="profile">
		              <input type="hidden" name="pic" value="{{$phtoto_data->profile}}">
		    <br>
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection
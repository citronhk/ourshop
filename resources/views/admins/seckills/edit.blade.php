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

<h3 class="title1">秒杀商品修改</h3>
    <div class="panel">
		<div class="panel-body">
		<form action="/admin/seckills/{{ $seckills_data->id }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 
			{{ method_field('PUT') }}

		    商品名称：<input type="text" class="form-control" name="gname" value="{{ $seckills_data->seckills_goods->gname }}" placeholder="">
		    <br>
		    商品销量：<input type="text" class="form-control" name="sales" value="{{ $seckills_data->sales }}" placeholder="">
		    <br>
		    开始时间：<input type="date" class="form-control" name="startTime" value="">
		    <br>
		    结束时间：<input type="date" class="form-control" name="endTime" value="" placeholder="">
            <br>      
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection
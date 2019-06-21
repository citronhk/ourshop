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

<h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;活动商品添加</h3>
    <div class="panel">
		<div class="panel-body">
		<form action="/admin/seckills" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 

		    商品名称：<input type="text" class="form-control" name="gname" value="{{ $goods_data->gname }}" readonly placeholder="">
		    <br>  
		    商品销量：<input type="text" class="form-control" name="sales" value="">
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
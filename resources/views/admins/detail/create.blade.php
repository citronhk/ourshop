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

<h3 class="title1">商品详情添加</h3>
    <div class="panel">
		<div class="panel-body">
		<form action="/admin/detail" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 

		    商品名称：<input type="text" class="form-control" name="gname" value="{{$data->gname}}" disabled>
		              <input type="hidden" value="{{$data->id}}" name="gid">
		    <br>
		    商品规格：<input type="text" class="form-control" name="norm" value="">
		    <br>
		    商品品牌：<input type="text" class="form-control" name="brand" value="">
		    <br>
		    商品源：<input type="text" class="form-control" name="origin" value="">
		    <br>
		    商品重量：<input type="text" class="form-control" name="weight" value="" placeholder="">
		    <br>
		    
            商品编号：
            <input type="text" name="num" class="form-control">
            <br>      
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection
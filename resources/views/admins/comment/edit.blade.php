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

<h3 class="title1">商品修改</h3>
    <div class="panel">
		<div class="panel-body">
		<form action="/admin/goods/" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 
			{{ method_field('PUT') }}

		    商品名称：<input type="text" class="form-control" name="gname" value="" placeholder="">
		    <br>
		    所属分类：
		    <br>
		    商品描述：<textarea class="form-control" name="desc" value=""></textarea>
		    <br>
		    商品价格：<input type="text" class="form-control" name="price" value="">
		    <br>
		    商品数量：<input type="text" class="form-control" name="goodsNum" value="" placeholder="">
		    <br>
		    <img src="/uploads"  style="width:50px;">
		    <br>
		    <input type="hidden" name="repic" value="">
            商品图片：<input type="file" name="pic">
            <br>      
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection
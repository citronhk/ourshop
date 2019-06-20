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
		<form action="/admin/goods" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 

		    商品名称：<input type="text" class="form-control" name="gname" value="" placeholder="">
		    <br>  
		    所属分类：
		    <select name="cid" id="cid">

		    @foreach($cates as $k=>$v)
		     @if($goods_data)
		    	<option value="{{$v->id}}" {{ $goods_data->cid == $v->id ? 'selected' : '' }}>{{$v->cname}}</option>
		     @else
                <option value="{{$v->id}}">{{$v->cname}}</option>
		     @endif
		    @endforeach
		    </select>
		    <br>
		    <br>
		    商品描述：<textarea class="form-control" name="desc"></textarea>
		    <br>
		    商品价格：<input type="text" class="form-control" name="price" value="">
		    <br>
		    商品数量：<input type="text" class="form-control" name="goodsNum" value="" placeholder="">
		    <br>
		    
            商品图片：<input type="file" name="pic">
            <br>      
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection
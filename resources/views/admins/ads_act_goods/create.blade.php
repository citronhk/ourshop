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

<h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;活动广告商品添加</h3>
    <div class="panel">
		<div class="panel-body">
		<form action="/admin/adsact?gid={{$datas->gid}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 

		    商品名称：<input type="text" class="form-control" name="gname" value="{{ $datas->adsact_goods->gname }}" readonly placeholder="">
		    <br>  
		    商品场次：<input type="text" class="form-control" name="aid" value="{{$datas->aid}}" readonly>
		    <br> 
		    <br>
		    类型：
		    <select name="type" id="">
		    	<option value="0" class="form-control">0</option>
		    	<option value="1" class="form-control">1</option>
		    	<option value="2" class="form-control">2</option>
		    </select>
		    <br>
		    图片：<input type="file" name="url">
            <br>
            <br>
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection
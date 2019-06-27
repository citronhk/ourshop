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
		<form action="/admin/adsact/upUrl?id={{ $data->id }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 

		    商品名称：<input type="text" class="form-control" name="gname" value="{{ $data->adsact_goods->gname }}" placeholder="">
		    <br>
		    
		    <img src="/uploads/{{ $data->url }}" width="60px"><br><br>
		    图片：<input type="file"  name="url"  >
		    <br>
		    <input type="hidden" value="{{ $data->url }}" name="reurl">
            <input type="submit" value="提交" class="btn btn-info" name="url">      
            <br>  
        </form>               
		</div>
	<script src="/time/jquery-1.12.4.min.js"></script>
    <script src="/time/calendar.js"></script>

    <script>

        // $(function () {
        //     $('#calendar1').calendar()
        // })
    </script>
	</div>
@endsection
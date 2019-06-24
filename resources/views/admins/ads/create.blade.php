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
    <div class="panel">
		<div class="panel-body">
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3 class="title1">广告添加</h3>
		<form action="/admin/ads" method="post" enctype="multipart/form-data">
				{{ csrf_field() }} 
		    链接地址：<input type="text" class="form-control" name="link" value="{{ old('link') }}" placeholder="text field">
		    <br>
            图片：<input type="file" name="url">
            <br>     
            <div class="mws-button-row"> 
            <input type="submit" value="提交" class="btn btn-info">
            </div>      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection


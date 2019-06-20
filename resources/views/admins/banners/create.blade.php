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
		    <h3 class="title1">	轮播图添加</h3>
<br>
		<form action="/admin/banners" method="post" enctype="multipart/form-data">
				{{ csrf_field() }} 
		    标题：<input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="">
             <br>
		    描述：<input type="text" class="form-control" name="desc" value="{{ old('desc') }}" placeholder="">
		    <br>
            选择轮播图：<input type="file" name="url">
            <br>  
            <div class="form-group"> 
            <label for="exampleInputEmail1">轮播图状态</label>
									<br>
                                未开启:<input type="radio" name="status"  value="0">
                                  &nbsp;
                                  &nbsp;
                                  &nbsp;
                                  &nbsp;
                                开启:<input type="radio" name="status" checked value="1">
							  </div>    
            <div class="mws-button-row"> 
            <input type="submit" value="提交" class="btn btn-info">
            </div>      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection


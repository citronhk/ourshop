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
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3 class="title1">权限添加</h3>
    <div class="panel">
		<div class="panel-body">
		  

		<form action="/admin/nodes" method="post" enctype="multipart/form-data">
				{{ csrf_field() }} 
		    权限名称：<input type="text" class="form-control" name="desc" value="{{ old('desc') }}" placeholder="text field">
		    <br>
           	控制器名称：<input type="text" class="form-control" name="cname" value="{{ old('cname') }}" placeholder="text field">
		    <br>
		   	方法名称：<input type="text" class="form-control" name="aname" value="{{ old('aname') }}" placeholder="text field">
		    <br>
			<br>
            <div class="mws-button-row"> 
            <input type="submit" value="提交" class="btn btn-info">
            </div>      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection


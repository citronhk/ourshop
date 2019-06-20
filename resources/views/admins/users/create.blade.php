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
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3 class="title1">用户添加</h3>

		<form action="/admin/users" method="post" enctype="multipart/form-data">
				{{ csrf_field() }} 
		    用户名：<input type="text" class="form-control" name="uname" value="{{ old('uname') }}" placeholder="text field">
		    <br>
		    密码：<input type="password" class="form-control" name="upass" value="">
		    <br>
		    确认密码：<input type="password" class="form-control" name="repass" value="">
		    <br>
		    电话：<input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="电话">
		    <br>
		    邮箱：<input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="邮箱">
		    <br>
            选择头像：<input type="file" name="profile">
            <br>     
            <div class="mws-button-row"> 
            <input type="submit" value="提交" class="btn btn-info">
            </div>      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection


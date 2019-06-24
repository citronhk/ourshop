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
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3 class="title1">用户修改</h3>

		<form action="/admin/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }} 
				{{ method_field('PUT') }}
		    用户名：<input type="text" class="form-control" name="uname" value="{{$user->uname}}" placeholder="text field" readonly>
		    <br>
		 
		    电话：<input type="text" class="form-control" name="phone" value="{{ $user->phone}}" placeholder="电话">
		    <br>
		    邮箱：<input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="邮箱">
		    <br>
            选择头像：<input type="file" name="profile">
            <input type="hidden" name="old_profile" value="{{ $user->userinfo->profile }}">
             <img style="border-radius:5px;border:1px solid #ccc;width:200px;" src="/uploads/{{ $user->userinfo->profile }}">											
            <br>     
            <div class="mws-button-row"> 
            <input type="submit" value="修改" class="btn btn-info">
            </div>      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection


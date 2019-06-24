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
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3 class="title1">管理员添加</h3>

		<form action="/admin/admins/{{ $admin_1->id }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }} 
				{{ method_field('PUT') }}
		    用户名：<input type="text" class="form-control" name="uname" value="{{ $admin_1->uname }}" placeholder="text field">
		    <br>
		    电话：<input type="text" class="form-control" name="phone" value="{{ $admin_1->phone }}" placeholder="电话">
		    <br>
		    选择头像：<input type="file" name="profile">
            <input type="hidden" name="old_profile" value="{{ $admin_1->profile }}">
             <img style="border-radius:5px;border:1px solid #ccc;width:200px;" src="/uploads/{{ $admin_1->profile }}">											
            <br>     
            <div class="mws-button-row"> 
            <input type="submit" value="提交" class="btn btn-info">
            </div>      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection


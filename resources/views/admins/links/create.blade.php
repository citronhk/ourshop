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
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3 class="title1">友情链接添加</h3>

		<form action="/admin/links" method="post" enctype="multipart/form-data">
				{{ csrf_field() }} 
			
		    链接名：<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="text field">
		    <br>
		    链接地址：<input type="text" class="form-control" name="url" value="{{ old('url') }}">
		    <br>
		    描述：<input type="password" class="form-control" name="desc" value="{{ old('desc') }}">
		    <br>
            选择图片：<input type="file" name="links_pic">
            <br>     
            <div class="mws-button-row"> 
            <input type="submit" value="提交" class="btn btn-info">
            </div>      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection


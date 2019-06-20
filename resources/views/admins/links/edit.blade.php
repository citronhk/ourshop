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

		<form action="/admin/links/{{ $link_1->id }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }} 
			    {{ method_field('PUT') }}
		    链接名：<input type="text" class="form-control" name="name" value="{{ $link_1->name }}" placeholder="text field">
		    <br>
		    链接地址：<input type="text" class="form-control" name="url" value="{{ $link_1->url }}">
		    <br>
		    描述：<input type="text" class="form-control" name="desc" value="{{ $link_1->desc }}">
		    <br>
            选择图片：<input type="file" name="links_pic">
            <input type="hidden" name="old_links_pic" value="{{ $link_1->links_pic }}">
              <img style="border-radius:5px;border:1px solid #ccc;width:200px;" src="/uploads/{{ $link_1->links_pic }}">
            <br>     
            <div class="mws-button-row"> 
            <input type="submit" value="提交" class="btn btn-info">
            </div>      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection


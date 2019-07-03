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

<h3 class="title1">新闻修改</h3>
    <div class="panel">
		<div class="panel-body">
		<form action="/admin/news/{{ $news_data->id }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 
            {{ method_field('PUT') }}

		    新闻标题：<input type="text" class="form-control" name="title" value="{{ $news_data->title }}" >
		    <br>
		    新闻描述
		    <input type="text" class="form-control" name="desc" value="{{ $news_data->desc }}">
		    <br>
		    内容：
		    <!-- 加载编辑器的容器 -->
		    <textarea name="content" class="form-control">{{ $news_data->content }}</textarea>
		     
		    <br>
            <br>      
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>
	</div>
@endsection
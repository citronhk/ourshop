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

<h3 class="title1">新闻添加</h3>
    <div class="panel">
		<div class="panel-body">
		<form action="/admin/news" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 

		    新闻标题：<input type="text" class="form-control" name="title" value="" >
		    <br>
		    新闻描述
		    <input type="text" class="form-control" name="desc" value="">
		    <br>
		    内容：
		    <!-- 加载编辑器的容器 -->
		     <script style="height:150px" id="container" name="content" type="text/plain"></script>
		    <br>
            <br>      
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>

		 <!-- 文档编辑器 -->
		 <!-- 配置文件 -->
         <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
         <!-- 编辑器源码文件 -->
         <script type="text/javascript" src="/utf8-php/ueditor.all.js"></script>
         <!-- 实例化编辑器 -->
         <script type="text/javascript">
             var ue = UE.getEditor('container',{toolbars: [
                ['fullscreen', 'source', 'undo', 'redo'],
                ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
                 ]});
         </script>
 
	</div>
@endsection
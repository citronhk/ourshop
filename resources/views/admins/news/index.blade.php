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

<!-- BASIC TABLE -->
 <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;新闻管理</h3>
 <div class="panel" >
    <form class="navbar-form navbar-left" action="/admin/news" method="get">
		<div class="input-group">
			<input type="text" value="{{$search}}" class="form-control" name="search" placeholder="搜索">
		    <span class="input-group-btn">
		    <input type="submit" value="搜索" class="btn btn-primary"></span>
		</div>
		<script>
            function sear(id){
            	        
            			 // location.reload(
            			 	
            			 // 	); 
            			 // var option = document.querySelect('option');
            	   //       option.setAttribute('value',id);
            }
		</script>
	</form>
		<div class="panel-body">
			<table class="table table-hover " >
				<thead>
					<tr>
						<th>ID</th>
						<th>新闻标题</th>
						<th>描述</th>
						<th>内容</th>
						<th>状态</th>
						<th>创建时间</th>
						<th>修改时间</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				@foreach($news_datas as $k=>$v)
					<tr>
						<td>{{ $v->id }}</td>
						<td title="{{ $v->title }}">
						<p  style="display:block;
                          width:100px;
                          word-break:keep-all;
                          white-space:nowrap;
                          overflow:hidden;
                          text-overflow:ellipsis;">
						{{ $v->title }}
						</p>
						</td>
						<td title="{{ $v->desc }}">
						<p  style="display:block;
                          width:100px;
                          word-break:keep-all;
                          white-space:nowrap;
                          overflow:hidden;
                          text-overflow:ellipsis;">
						{{ $v->desc }}</p>
						</td>
						<td title="{{ $v->content }}">
						<p  style="display:block;
                          width:100px;
                          word-break:keep-all;
                          white-space:nowrap;
                          overflow:hidden;
                          text-overflow:ellipsis;">
						{{ $v->content }}
						</p>
						</td>
						<td>{{ $v->status }}</td>
						<td>{{ $v->created_at }}</td>
						<td>{{ $v->updated_at }}</td>
						<td >
							<a href="/admin/news/create?id={{$v->id}}" class="btn btn-success">添加</a>
							<a href="/admin/news/{{ $v->id }}/edit" class="btn btn-info">修改</a>
							<form action="/admin/news/{{ $v->id }}" method="post" style="display:inline-block;">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							     <input type="submit" class="btn btn-danger" value="删除">
							</form>
							@if($v->status == 1)
							<a href="/admin/news/status/{{$v->id}}" class="btn btn-danger">显示</a>
							@else
							<a href="/admin/news/status/{{$v->id}}" class="btn btn-info">屏蔽</a>
							@endif
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<div id="page_page">
			{{ $news_datas->links() }}
            </div>
		</div>
	</div>
			<!-- END BASIC TABLE -->
@endsection


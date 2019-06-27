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
 <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;活动商品管理</h3>
 <div class="panel" >
    <form class="navbar-form navbar-left" action="/admin/adsact" method="get">
		<div class="input-group">
			<input type="text" value="" class="form-control" name="search" placeholder="搜索">
			<span class="input-group-btn"><input type="submit" value="搜索" class="btn btn-primary"></span>
		</div>
	</form>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>商品名称</th>
						<th>商品场次</th>
						<th>商品类型</th>
						<th>图片</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>

                @foreach($datas as $k=>$v)
					<tr>

						<td>{{ $v->id }}</td>
						<td>{{ $v->adsact_goods->gname }}</td>
						<td>{{ $v->aid }}</td>
						<td>{{ $v->type }}</td>
						<td>
							@if($v->url)
							<img src="/uploads/{{$v->url}}" width="80px" alt="">
							@else
							<img src="/uploads/{{ $v->adsact_goods->pic }}" width="80px" alt="">
							@endif
						</td>
						<td>
							<form action="/admin/adsact/{{$v->id}}" method="post" style="display:inline-block;">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							     <input type="submit" class="btn btn-danger" value="删除">
							</form>
							@if($v->type == 1)
							<a href="/admin/adsact/url?id={{$v->id}}"  class="btn btn-success">添加长版图</a>
							@elseif($v->type == 2)
							<a href="/admin/adsact/url?id={{$v->id}}"  class="btn btn-success">添加轮播图</a>
							@endif

							
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<script>
                // function status(id){
                    
                // 	$.get('/admin/comment/status',{id},function(res){
                	 
                // 	 if(res.msg=='ok'){
                // 	 	alert('修改成功')
                // 	 }
                		
                // 	},'json');
                //    return false;
                // }

			</script>
			<div id="page_page">
			 {{$datas -> links()}}
            </div>
		</div>
	</div>
			<!-- END BASIC TABLE -->
@endsection


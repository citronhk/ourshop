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
 <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;商品详情</h3>
 <div class="panel" >
    <form class="navbar-form navbar-left" action="" method="get">
		<div class="input-group">
			<input type="text" value="" class="form-control" name="search" placeholder="搜索">
			<span class="input-group-btn"><input type="submit" value="搜索" class="btn btn-primary"></span>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>商品名称</th>
						<th>图集</th>
						<th>创建时间</th>
						<th>操作&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/admin/photo/create?gid={{ $gid }}" class="">添加图片</a></th>

					</tr>
				</thead>
				<tbody>
				@foreach($photo_data as $k=>$v)
				<tr>
					    <td>{{ $v->id }}</td>
					    <td>{{$v->photo_goods->gname}}</td>
						<td>
							<img src="/uploads/{{$v->profile}}" width="60px">
						</td>
						<td>{{$v->created_at}}</td>
						<td>
						    <a href="/admin/photo/create?gid={{ $gid }}" class="btn btn-info">添加</a>
							<a href="/admin/photo/{{ $v->id }}/edit" class="btn btn-info">修改</a>
							<a href="/admin/photo/del/{{ $v->id }}" class="btn btn-danger">删除</a>
						</td>
					</tr>
					
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
			<!-- END BASIC TABLE -->
@endsection


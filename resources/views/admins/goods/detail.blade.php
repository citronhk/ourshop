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
@if(session('success'))
<div class="bs-example" data-example-id="dismissible-alert-css">
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <strong>{{ session('success') }}</strong> 
    </div>
  </div>
@endif


@if(session('error'))
<div class="bs-example" data-example-id="dismissible-alert-css">
    <div class="alert alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <strong>{{ session('error') }}</strong> 
    </div>
  </div>
@endif
<!-- BASIC TABLE -->
 <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;商品详情</h3>
 <div class="panel" >
    <form class="navbar-form navbar-left" action="/admin/orders" method="get">
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
						<th>商品规格</th>
						<th>商品品牌</th>
						<th>商品重量</th>
						<th>商品编号</th>
						<th>上架时间</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				@foreach($detail_datas as $k=>$v)
					<tr>
						<td>{{ $v->dateil_gid->gname }}</td>
						<td>{{ $v->norm }}</td>
						<td>{{ $v->brand }}</td>
						<td>{{ $v->weight }}</td>
						<td>{{ $v->num }}</td>
						<td>{{ $v->created_at }}</td>
						<td>
							<a href="/admin/goods/detailEdit?{{ $v->id }}" class="btn btn-info">修改</a>
							<form action="/admin/orders" method="post" style="display:inline-block;">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							     <input type="submit" class="btn btn-danger" value="删除">
							</form>
							
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<div id="page_page">
			
            </div>
		</div>
	</div>
			<!-- END BASIC TABLE -->
@endsection


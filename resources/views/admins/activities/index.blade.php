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
 <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;活动商品管理</h3>
 <div class="panel" >
    <form class="navbar-form navbar-left" action="/admin/activities" method="get">
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
						<th>商品销量</th>
						<th>开始时间</th>
						<th>结束时间</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
                @foreach($activities_datas as $k=>$v)
					<tr>
						<td>{{ $v->id }}</td>
						<td>{{ $v->activities_goods->gname }}</td>
						<td>{{ $v->sales }}</td>
						<td>{{ $v->startTime }}</td>
						<td>{{ $v->endTime }}</td>
						<td>
						    <a href="/admin/activities/{{$v->id}}/edit"  class="btn btn-info">修改</a>
							<form action="/admin/activities/{{$v->id}}" method="post" style="display:inline-block;">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							     <input type="submit" class="btn btn-danger" value="删除">
							</form>
							@if($v->status == 1)
							<a href="/admin/activities/status/{{ $v->id }}"  class="btn btn-danger">屏蔽</a>
							@else
							<a href="/admin/activities/status/{{ $v->id }}"  class="btn btn-info">显示</a>
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
			
            </div>
		</div>
	</div>
			<!-- END BASIC TABLE -->
@endsection


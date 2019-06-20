@extends('admins.public.index')


@section('main')
<!-- BASIC TABLE -->
                   <h3 class="text-center">栏目管理</h3>
							<div class="panel" >

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
				<form class="navbar-form navbar-left" method="get" action="/admin/cates">
					<div class="input-group">
						<input type="text" value="{{ $params }}" class="form-control" name="search_cname" placeholder="搜索">
						<!-- <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span> -->
					</div>
						<input type="submit" class="btn btn-primary" value="GO">
				</form>


								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>ID</th>
												<th>分类名称</th>
												<th>父级ID</th>
												<th>路径</th>
												<th>操作</th>
											</tr>
										</thead>
										<tbody>
											@foreach($cates as $k=>$v)
											<tr>
												<td>{{ $v->id }}</td>
												<td>{{ $v->cname }}</td>
												<td>{{ $v->pid }}</td>
												<td>{{ $v->path }}</td>
												<td>
													<a href="javascript:;" onclick="del( {{ $v->id }} ,this)" class="btn btn-danger">删除</a>
													&nbsp;
													@if(substr_count($v->path,',') < 2)
													<a href="/admin/cates/create?id={{ $v->id }}" class="btn btn-primary">添加子栏目</a>
													@endif

												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									<div class="text-center">
										{{ $cates->links() }}
									</div>
								<script type="text/javascript">
										function del(id,obj){
											
											$.post('/admin/cates/'+id,{'_method':'DELETE','_token':'{{ csrf_token() }}'},(res)=>{
												if(res.msg == 'ok'){
													$(obj).parent().parent().remove();
													alert(res.info);
												}
											},'json');
										}
								</script>
								</div>
							</div>
							<!-- END BASIC TABLE -->
@endsection


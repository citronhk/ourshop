@extends('admins.public.index')
 
 
@section('main')

							<!-- BASIC TABLE -->
                   <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;权限管理</h3>
							<div class="panel" >
<br>
<!-- <form action="/admin/nodes" class="navbar-form navbar-left">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	搜索:	<div class="input-group">
						<input type="text" value="" class="form-control" name="search"	placeholder="用户名">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form> -->

<form class="form-inline" action="/admin/nodes"> 
     <div class="form-group"> 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="exampleInputName2">关键字:</label> 
      <input type="text" class="form-control" value="" name="search" id="exampleInputName2" placeholder="权限名" /> 
     </div> 
     <button type="submit" class="btn btn-primary">GO</button> 
    </form> 
<br>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>ID</th>
												<th>权限名称</th>
												<th>控制器名称</th>
												<th>方法名</th>
												<th>操作</th>
											</tr>
										</thead>
										<tbody> 
                                       @foreach($nodes as $k => $v)
											<tr>
												<td>{{ $v->id }}</td>
												<td>{{ $v->desc }}</td>
												<td>{{ $v->cname }}</td>
												<td>{{ $v->aname }}</td>	
												<td>
                                                   <a href="/admin/nodes/{{ $v->id }}/edit" class="btn btn-info">修改</a>
                                                   <form action="/admin/nodes/{{$v->id}}" method="post" style="display: inline-block ;">
                                                   {{ csrf_field() }}
                                                   {{ method_field('DElETE') }}
                                                   <input type="submit" value="删除"class="btn btn-danger">
                                                   </form>
												</td>

 											</tr>
                                       @endforeach
										</tbody>
									</table>
									<div>{{ $nodes->appends(['search'=>$search])->links() }}</div>
								</div>
							</div>
							<!-- END BASIC TABLE -->

@endsection


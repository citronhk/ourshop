@extends('admins.public.index')
 

@section('main')

							<!-- BASIC TABLE -->
                   <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;友情链接管理</h3>
							<div class="panel" >
<br>
<!-- <form action="/admin/links" class="navbar-form navbar-left">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	搜索:	<div class="input-group">
						<input type="text" value="" class="form-control" name="search"	placeholder="用户名">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form> -->


<br>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>	
												<th>ID</th>
												<th>链接名</th>
												<th>链接地址</th>
												<th>描述</th>
												<th>图片</th>
												<th>操作</th>
											</tr>
										</thead>
										<tbody> 
                                       @foreach($links as $k => $v)
											<tr>
												<td>{{ $v->id }}</td>
												<td>{{ $v->name }}</td>
												<td>{{ $v->url }}</td>
												<td>{{ $v->desc }}</td>
												<td>

												  <img style="border-radius:5px;border:1px solid #ccc;width:50px;" src="/uploads/{{ $v->links_pic }}">
												
												</td>
	
												<td>
                                                   <a href="/admin/links/{{ $v->id }}/edit" class="btn btn-info">修改</a>
                                                   <form action="/admin/links/{{$v->id}}" method="post" style="display: inline-block ;">
                                                   {{ csrf_field() }}
                                                   {{ method_field('DElETE') }}
                                                   <input type="submit" value="删除"class="btn btn-danger">
                                                   </form>
												</td>

 											</tr>
                                       @endforeach
										</tbody>
									</table>
								
								</div>
							</div>
							<!-- END BASIC TABLE -->

@endsection


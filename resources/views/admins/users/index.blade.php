@extends('admins.public.index')
 
   
@section('main')

							<!-- BASIC TABLE -->
                   <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;用户管理</h3>
							<div class="panel" >
<br>
<!-- <form action="/admin/users" class="navbar-form navbar-left">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	搜索:	<div class="input-group">
						<input type="text" value="" class="form-control" name="search"	placeholder="用户名">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form> -->

<form class="form-inline" action="/admin/users"> 
     <div class="form-group"> 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="exampleInputName2">关键字:</label> 
      <input type="text" class="form-control" value="" name="search" id="exampleInputName2" placeholder="用户名" /> 
     </div> 
     <button type="submit" class="btn btn-primary">GO</button> 
    </form> 
<br>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>ID</th>
												<th>用户名</th>
												<th>邮箱</th>
												<th>手机号</th>
												<th>头像</th>
												<th>创建时间	</th>
												<th>状态</th>
												<th>操作</th>
											</tr>
										</thead>
										<tbody> 
                                       @foreach($users as $k => $v)
											<tr>
												<td>{{ $v->id }}</td>
												<td>{{ $v->uname }}</td>
												<td>{{ $v->email }}</td>
												<td>{{ $v->phone }}</td>
												<td>

												  <img style="border-radius:5px;border:1px solid #ccc;width:50px;" src="/uploads/{{ $v->userinfo->profile }}">
												
												</td>
												<td>{{ $v->created_at}}</td>
												<td> 
												  	 @if($v->status == 0)
													  	<kbd>未激活</kbd>
													  	@else 
													  	<kbd style="background:gold">激活</kbd>
													  	@endif
													</td>
												<td>
                                                   <a href="/admin/users/{{ $v->id }}/edit" class="btn btn-info">修改</a>
                                                   <form action="/admin/users/{{$v->id}}" method="post" style="display: inline-block ;">
                                                   {{ csrf_field() }}
                                                   {{ method_field('DElETE') }}
                                                   <input type="submit" value="删除"class="btn btn-danger">

                                                   @if($v->status ==0)
					                                    <a href="/admin/users/changeStatus/{{ $v->id }}" class="btn btn-success">激活</a>
												  	    @else
					                                    <a href="/admin/users/changeStatus/{{ $v->id }}" class="btn btn-primary">停止</a>
					                               @endif
                                                   </form>
												</td>

 											</tr>
                                       @endforeach
										</tbody>
									</table>
									<div>{{ $users->appends(['search'=>$search])->links() }}</div>
								</div>
							</div>
							<!-- END BASIC TABLE -->

@endsection


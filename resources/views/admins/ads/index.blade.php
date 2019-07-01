 @extends('admins.public.index')
 

@section('main')

							<!-- BASIC TABLE -->
                   <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;广告管理</h3>
							<div class="panel" >
<br>

<br>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>ID</th>
												
												<th>头像</th>
												<th>状态</th>
												<th>操作</th>
											</tr>
										</thead>
										<tbody> 
                                       @foreach($ads as $k => $v)
											<tr>
												<td>{{ $v->id }}</td>
											
												  	
												<td>

												  <img style="border-radius:5px;border:1px solid #ccc;width:150px;" src="/uploads/{{ $v->url }}">
												
												</td>
												<td> 
												  	 @if($v->status == 0)
													  	<kbd>已隐藏</kbd>
													  	@else 
													  	<kbd style="background:gold">已显示</kbd>
													  	@endif
													</td>
												<td>
                                                   <a href="/admin/ads/{{ $v->id }}/edit" class="btn btn-info">修改</a>
                                                   <form action="/admin/ads/{{$v->id}}" method="post" style="display: inline-block ;">
                                                   {{ csrf_field() }}
                                                   {{ method_field('DElETE') }}
                                                   <input type="submit" value="删除"class="btn btn-danger">
                                             
                                                        @if($v->status ==0)
					                                    <a href="/admin/ads/changeStatus/{{ $v->id }}" class="btn btn-success">显示</a>
												  	    @else
					                                    <a href="/admin/ads/changeStatus/{{ $v->id }}" class="btn btn-primary">隐藏</a>
					                                    @endif
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


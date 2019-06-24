	@extends('admins.public.index')


	@section('main')
	 
								<!-- BASIC TABLE -->
	                   <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;轮播图管理</h3>
								<div class="panel" >
	<br>

	<br>
									<div class="panel-body">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>标题</th>
													<th>描述</th>
													<th>图片</th>
													<th>状态</th>
													<th>操作</th>
												</tr>
											</thead>
											<tbody>
	                                   @foreach ($banners as $k => $v)
												<tr>
													<td>{{ $v->id }}</td>
													<td>{{ $v->title }}</td>
													<td>{{ $v->desc }}</td>

												  	<td>
												    <img src="/uploads/{{$v->url}}" class="img-thumbnail" style="width: 100px">
												  	</td>
												  	<td> 
												  	 @if($v->status == 0)
													  	<kbd>未激活</kbd>
													  	@else 
													  	<kbd style="background:gold">激活</kbd>
													  	@endif
													</td>
											     
													<td>
	                                                   <a href="/admin/banners/{{ $v->id }}/edit" class="btn btn-info">修改</a>
	                                                   <form action="/admin/banners/{{$v->id}}" method="post" style="display: inline-block ;">
	                                                   {{ csrf_field() }}
	                                                   {{ method_field('DElETE') }}
	                                                   <input type="submit" value="删除" class="btn btn-danger">
<!-- 					                                    @if($v->status ==0)
					                                    <a href="javascript:;" class="btn btn-success" onclick="changeStatus({{$v->id}},0)">激活</a>
												  	    @else
					                                    <a href="javascript:;" class="btn btn-primary" onclick="changeStatus({{$v->id}},1)">停止</a>
					                                    @endif
 -->
                                                        @if($v->status ==0)
					                                    <a href="/admin/banners/changeStatus/{{ $v->id }}" class="btn btn-success">激活</a>
												  	    @else
					                                    <a href="/admin/banners/changeStatus/{{ $v->id }}" class="btn btn-primary">停止</a>
					                                    @endif
	                                                   </form>
													</td>

	 											</tr>
	                                   @endforeach
											</tbody>
										</table>
<!-- 	<script type="text/javascript">
		function changeStatus(id,sta)
		{
			
			if(sta==1){
			$('#myModal form input[type=radio]').eq(1).attr('checked',true);
			}else{
			$('#myModal form input[type=radio]').eq(0).attr('checked',true);		
			}
			//赋值
			$('#myModal form input[type=hidden]').eq(0).val(id);
			$('#myModal').modal('show')
		}
	</script> -->

	                   <!-- Modal -->
						<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-h	eader">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">轮播图状态</h4>
						      </div>
						      <div class="modal-body">
						      	<form action="/admin/banners/changeStatus" method="get">
						      		<input type="hidden" name="id" value="">
						        	<div class="form-group"> 
										<br>
	                                未开启:<input type="radio" name="status" value="0">
	                                  &nbsp;
	                                  &nbsp;
	                                  &nbsp;
	                                  &nbsp;
	                                开启:<input type="radio" name="status" value="1">
								  <input type="submit" class="btn btn-success">
								  </div> 
								</form>
						      </div>
						    </div>
						  </div>
						</div> -->
										<div></div>
									</div>
								</div>
								<!-- END BASIC TABLE -->

	@endsection


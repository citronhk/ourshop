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
 <h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;商品管理</h3>
 <div class="panel" >
    <form class="navbar-form navbar-left" action="/admin/goods" method="get">
		<div class="input-group">
			<input type="text" value="{{$search2}}" class="form-control" name="search2" placeholder="搜索">
		    <span class="input-group-btn">
		      <select name="search1" id="" style="width:120px" class="form-control">
                <option value="" selected>所有</option>
               @foreach($cates_data as $k=>$v)
		    	<option  value="{{ $v->id }}"  {{ $v->id == $search1 ? 'selected' : '' }}>{{ $v->cname }}</option>
               @endforeach
		    </select>
		    <input type="submit" value="搜索" class="btn btn-primary"></span>
		</div>
		<script>
            function sear(id){
            	        
            			 // location.reload(
            			 	
            			 // 	); 
            			 // var option = document.querySelect('option');
            	   //       option.setAttribute('value',id);
            }
		</script>
	</form>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>商品名称</th>
						<th>所属分类</th>
						<th>商品价格</th>
						<th>商品数量</th>
						<th>商品图片</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				@foreach($goods_datas as $k=>$v)
				
					<tr>
						<td>{{ $v->id }}</td>
						<td>{{ $v->gname }}</td>
						<td>
						@foreach($cates_data as $kk=>$vv)
						@if($v->cid==$vv->id)
						{{ $vv->cname }}
						@endif
                        @endforeach
						</td>
						<td>{{ $v->price }}</td>
						<td>{{ $v->goodsNum }}</td>
						<td>
							<img src="/uploads/{{ $v->pic }}" style="width:50px;">
						</td>
						<td>
							<a href="/admin/goods/create?id={{$v->id}}" class="btn btn-success">添加</a>
							<a href="/admin/goods/{{ $v->id }}/edit" class="btn btn-info">修改</a>
							<form action="/admin/goods/{{ $v->id }}" method="post" style="display:inline-block;">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							     <input type="submit" class="btn btn-danger" value="删除">
							</form>
							@if($v->status == 1)
							<a href="/admin/goods/status/{{$v->id}}" class="btn btn-danger">下架</a>
							@else
							<a href="/admin/goods/status/{{$v->id}}" class="btn btn-info">上架</a>
							@endif
							<a href="/admin/activities/create?id={{ $v->id }}" class="btn btn-info">添加活动</a>
							<a href="/admin/seckills/create?id={{ $v->id }}" class="btn btn-info">添加秒杀</a>
							<a href="/admin/detail/create?id={{ $v->id }}" class="btn btn-success">添加详情</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<div id="page_page">
			{{ $goods_datas->appends($params)->links() }}
            </div>
		</div>
	</div>
			<!-- END BASIC TABLE -->
@endsection


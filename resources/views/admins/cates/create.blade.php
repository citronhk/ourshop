@extends('admins.public.index')


@section('main')
<!-- BASIC TABLE -->
                 <h3 class="text-center">分类添加</h3>
    <div class="panel" >
		<div class="form-body center-block" style="width: 95%;">
			<form action="/admin/cates" method="post"> 
				{{ csrf_field() }}
				<div class="form-group"> 
					<label for="cname">分类名称</label> 
					<input type="text" class="form-control" value="{{ old('cname') }}" name="cname" id="cname" placeholder="分类名称"> 
				</div> 
				<div class="form-group"> 
			 		<label for="pid">所属分类</label> 
					<select name="pid" id="pid" class="form-control">
					<option value="0">---请选择---</option>
					@foreach($cates as $k=>$v)
					
						<option value="{{ $v->id }}" {{ $v->id == $id ? 'selected' : '' }} {{ substr_count($v->path,',') >= 2 ?'disabled' : '' }}>{{ $v->cname }}</option>
					@endforeach
					</select>
				</div>
				 <input type="submit" name="" style="padding-right: 20px;" class="btn btn-success form-control" value="提交"> 
			</form> 
		</div>
	</div>
							<!-- END BASIC TABLE -->
@endsection

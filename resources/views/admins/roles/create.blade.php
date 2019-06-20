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
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3 class="title1">角色添加</h3>
    <div class="panel">
		<div class="panel-body">
		  

		<form action="/admin/roles" method="post" enctype="multipart/form-data">
				{{ csrf_field() }} 
		    角色名称：<input type="text" class="form-control" name="rname" value="{{ old('rname') }}" placeholder="text field">
		    <br>
           <ul class="mws-form-list inline small">
    						@foreach($list as $k=>$v)
    						<h3>{{ $conall[$k] }}&nbsp;<small>({{ $k }})</small> </h3>
	    						@foreach($v as $kk=>$vv)
	    						<li><input type="checkbox" name="nids[]" value="{{ $vv['id'] }}"> <label>{{ $vv['desc'] }}</label></li>
	    						@endforeach
    						@endforeach
    					</ul>
			<br>
            <div class="mws-button-row"> 
            <input type="submit" value="提交" class="btn btn-info">
            </div>      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection


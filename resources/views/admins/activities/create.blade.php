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

<h3 class="title1">&nbsp;&nbsp;&nbsp;&nbsp;活动商品添加</h3>
    <div class="panel">
		<div class="panel-body">
		<form action="/admin/activities" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 

		    商品名称：<input type="text" class="form-control" name="gname" value="{{ $goods_data->gname }}" readonly placeholder="">
		    <br>  
		    商品优惠：<input type="text" class="form-control" name="discount" >
		    <br> 
		    商品销量：<input type="text" class="form-control" name="count" value="">
		    <br>
		    场次：
		    <select name="aid" id="">
		    @foreach($act_data as $k=>$v)
		    	<option value="{{ $v->id }}" class="form-control">第{{ $v->id }}场</option>
		    @endforeach
		    </select>
		    <br>
		    <br>
		    开始日期：
		    	 <input type="date" class="" style="width:200px;border:1px solid #ccc;" name="startDate">
		    开始时间：	 
                 <input type="time" class="" style="width:200px;border:1px solid #ccc;" name="startTime">
                 <br>
                 <br>
            结束日期：
		    	 <input type="date" class="" style="width:200px;border:1px solid #ccc;" name="endDate">
		    结束时间：		 
                 <input type="time" class="" style="width:200px;border:1px solid #ccc;" name="endTime">
            <br>
            <br>
            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection
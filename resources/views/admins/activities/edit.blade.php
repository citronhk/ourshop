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
<h3 class="title1">秒杀商品修改</h3>
    <div class="panel">
		<div class="panel-body">
		<form action="/admin/activities/{{ $act_data->id }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 
			{{ method_field('PUT') }}

		    商品名称：<input type="text" class="form-control" name="gname" value="{{ $act_data->a_goods->gname }}" placeholder="">
		    <br>
		    商品优惠：<input type="text" class="form-control" name="discount" value="{{ $act_data->discount }}" placeholder="">
		    <br>
		    商品销量：<input type="text" class="form-control" name="sales" value="{{ $act_data->count }}" placeholder="">
		    <br>
		    场次：
		    <select name="aid" id="">
		    @foreach($act_datas as $k=>$v)
		    	<option value="{{ $v->id }}"  {{ $act_data->aid == $v->id ? 'selected' : '' }} class="form-control">第{{ $v->id }}场</option>
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
                 <input type="time" class="" style="width:200px;border:1px solid #ccc;" name="endtTime">
		   
		    <br>
		    

            <br>  

            <input type="submit" value="提交" class="btn btn-info">      
            <br>  
        </form>               
		</div>
	<script src="/time/jquery-1.12.4.min.js"></script>
    <script src="/time/calendar.js"></script>

    <script>

        // $(function () {
        //     $('#calendar1').calendar()
        // })
    </script>
	</div>
@endsection
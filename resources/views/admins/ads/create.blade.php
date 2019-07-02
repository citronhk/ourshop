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
    <div class="panel">
		<div class="panel-body">
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3 class="title1">广告添加</h3>
		<form action="/admin/ads?gid={{ $gid }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }} 
            图片：<input type="hidden" name="url" value="{{ $good[0]->pic }}">
              <img style="border-radius:5px;border:1px solid #ccc;width:150px;margin-bottom: 20px" src="/uploads/{{ $good[0]->pic }}">
            <br>  
            展示楼层：
		    <select name="fid" id="fid">

		    @foreach($floors as $k=>$v)

                <option value="{{$v->id}}">{{$v->fname}}</option>

		    @endforeach
		    </select>
		    <br>
            <br>
		    展示位置:
		    <input type="radio" name="about" value="l">左
		    <input type="radio" name="about" value="r" checked>右

            <div class="mws-button-row"> 
            <input type="submit" value="提交" class="btn btn-info">
            </div>      
            <br>  
        </form>              
		</div>
 
	</div>
@endsection


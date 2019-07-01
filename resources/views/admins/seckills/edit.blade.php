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
		<form action="/admin/seckills/{{ $seckills_data->id }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }} 
			{{ method_field('PUT') }}

		    商品名称：<input type="text" class="form-control" name="gname" value="{{ $seckills_data->seckills_goods->gname }}" placeholder="">
		    <br>
		    商品销量：<input type="text" class="form-control" name="sales" value="{{ $seckills_data->sales }}" placeholder="">
		    <br>
		    <div class="doc-dd">
		    开始时间：<input type="text"  class="form-control" name="sales" value="" placeholder="">
		    <br>
		    结束时间：<input type="text"  class="form-control" name="sales" value="" placeholder=""> 
            <br>     
            <input type="submit" value="提交" class="btn btn-info">     
            <br> 
            </div> 
        </form>   
        <script type="text/javascript">
	      $( "input[name='act_start_time'],input[name='act_stop_time']" ).datetimepicker();
        </script>           
		</div>
 
	</div>
	<script type="text/javascript">
            (function($) {

                $(function() {
                    $.datepicker.regional['zh-CN'] = {
                        changeMonth: true,
                        changeYear: true,
                        clearText: '清除',
                        clearStatus: '清除已选日期',
                        closeText: '关闭',
                        closeStatus: '不改变当前选择',
                        prevText: '<上月',
                        prevStatus: '显示上月',
                        prevBigText: '<<',
                        prevBigStatus: '显示上一年',
                        nextText: '下月>',
                        nextStatus: '显示下月',
                        nextBigText: '>>',
                        nextBigStatus: '显示下一年',
                        currentText: '今天',
                        currentStatus: '显示本月',
                        monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                        monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                        monthStatus: '选择月份',
                        yearStatus: '选择年份',
                        weekHeader: '周',
                        weekStatus: '年内周次',
                        dayNames: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
                        dayNamesShort: ['周日', '周一', '周二', '周三', '周四', '周五', '周六'],
                        dayNamesMin: ['日', '一', '二', '三', '四', '五', '六'],
                        dayStatus: '设置 DD 为一周起始',
                        dateStatus: '选择 m月 d日, DD',
                        dateFormat: 'yy-mm-dd',
                        firstDay: 1,
                        initStatus: '请选择日期',
                        isRTL: false
                    };

                });

                $(function() {

                    $.datepicker.setDefaults($.datepicker.regional['zh-CN']);
                    
                    $("#defult").datetimepicker();
                    
                    $('#date').prop("readonly", true).datetimepicker({
                        timeText: '时间',
                        hourText: '小时',
                        minuteText: '分钟',
                        secondText: '秒',
                        currentText: '现在',
                        closeText: '完成',
                        showSecond: true, //显示秒  
                        timeFormat: 'HH:mm:ss' //格式化时间  
                    });

                    $("#date_yy-mm-dd").prop("readonly", true).datepicker({
                        changeMonth: true,
                        dateFormat: "yy-mm-dd",
                        onClose: function(selectedDate) {

                        }

                    });

                    $("#date_start").prop("readonly", true).datepicker({
                        changeMonth: true,
                        dateFormat: "yy-mm-dd",
                        onClose: function(selectedDate) {
                            $("#date_end").datepicker("option", "minDate", selectedDate);
                        }
                    });

                    $("#date_end").prop("readonly", true).datepicker({
                        changeMonth: true,
                        dateFormat: "yy-mm-dd",
                        onClose: function(selectedDate) {
                            $("#date_start").datepicker("option", "maxDate", selectedDate);
                            $("#date_end").val($(this).val());
                        }
                    });

                    $('#date_hhmmss').prop("readonly", true).timepicker({
                        timeText: '时间',
                        hourText: '小时',
                        minuteText: '分钟',
                        secondText: '秒',
                        currentText: '现在',
                        closeText: '完成',
                        showSecond: true, //显示秒  
                        timeFormat: 'HH:mm:ss' //格式化时间  
                    });

                    $.timepicker.dateRange(
                        $("#date_start_1"),
                        $("#date_end_1"), {
                            minInterval: (1000 * 60 * 60 * 24 * 1), // 区间时间间隔时间
                            maxInterval: (1000 * 60 * 60 * 24 * 1), // 1 days 区间时间间隔时间
                            start: {}, // start picker options
                            end: {} // end picker options});
                        }
                    );
                    
                    
                });
                
                
            }(jQuery));
        </script>

@endsection
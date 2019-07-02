(function($){
		$.fn.downCount=function(options,callback){
			var settings=$.extend({
				date:null,offset:null},options);
			if(!settings.date){
				$.error('Date is not defined.');
			}
			if(!Date.parse(settings.date)){
				$.error('Incorrect date format, it should look like this, 12/24/2012 12:00:00.');
			}
			var container=this;
			var currentDate=function(){
				var date=new Date();
				var utc=date.getTime()+(date.getTimezoneOffset()*60000);
				var new_date=new Date(utc+(3600000*settings.offset))
			return new_date;};function countdown(){
				var target_date=new Date(settings.date),current_date=currentDate();
				var difference=target_date-current_date;
				if(difference<0){
					clearInterval(interval);
					if(callback&&typeof callback==='function')callback();
					return;}
			var _second=1000,_minute=_second*60,_hour=_minute*60,_day=_hour*24;
			var days=Math.floor(difference/_day),
				hours=Math.floor((difference%_day)/_hour),
				minutes=Math.floor((difference%_hour)/_minute),
				seconds=Math.floor((difference%_minute)/_second);
				days=(String(days).length>=2)?days:'0'+days;
				hours=(String(hours).length>=2)?hours:'0'+hours;
				minutes=(String(minutes).length>=2)?minutes:'0'+minutes;
				seconds=(String(seconds).length>=2)?seconds:'0'+seconds;

			var ref_days=(days===1)?'day':'days',ref_hours=(hours===1)?'hour':'hours',
				ref_minutes=(minutes===1)?'minute':'minutes',
				ref_seconds=(seconds===1)?'second':'seconds';
				container.find('.days').text(days);container.find('.hours').text(hours);
				container.find('.minutes').text(minutes);
				container.find('.seconds').text(seconds);
				container.find('.days_ref').text(ref_days);
				container.find('.hours_ref').text(ref_hours);
				container.find('.minutes_ref').text(ref_minutes);
				container.find('.seconds_ref').text(ref_seconds);
};

var interval=setInterval(countdown,1000);};})(jQuery);




/** 
 * 时间戳转化为年 月 日 时 分 秒 
 * number: 传入时间戳 
 * format：返回格式，支持自定义，但参数必须与formateArr里保持一致 
*/  
function formatTime(number,format) {  
  
  var formateArr  = ['Y','M','D','h','m','s'];  
  var returnArr   = [];  
  
  var date = new Date(number * 1000);  
  returnArr.push(date.getFullYear());  
  returnArr.push(formatNumber(date.getMonth() + 1));  
  returnArr.push(formatNumber(date.getDate()));  
  
  returnArr.push(formatNumber(date.getHours()));  
  returnArr.push(formatNumber(date.getMinutes()));  
  returnArr.push(formatNumber(date.getSeconds()));  
  
  for (var i in returnArr)  
  {  
    format = format.replace(formateArr[i], returnArr[i]);  
  }  
  return format;  
} 

//数据转化  
function formatNumber(n) {  
  n = n.toString()  
  return n[1] ? n : '0' + n  
}


/** 
 * 页面加载完成事件,商品特卖进行倒计时
 * 
 * 
*/ 

$(function(){

	$.get('/home/time',function(data){					//data 为时间戳

		let time = formatTime(data,'M/D/Y h:m:s');		//转换为日期：07/01/2019 00:00:00

		//页面倒计时
		$('.countdown').downCount({
            date: time,
            offset: +10
        });
		
	});

});
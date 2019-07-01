@extends('home.public.share')

@section('main')

	<link type="text/css" rel="stylesheet" href="/homes/css/style.css" />
    
    
  <script type="text/javascript" src="/homes/js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="/homes/js/num.js">
  	var jq = jQuery.noConflict();
  </script>     
 @if(count($car) != 0)   
<div class="i_bg">  
    <div class="content mar_20">
    	<img src="/homes/images/img1.jpg" style="width: 970px" />        
    </div>
    
    <!--Begin 第一步：查看购物车 Begin -->
    <div class="content mar_20">
      <form name="demo" action="/home/car/buyorder" method="get">
    	<table border="0" class="car_tab" style="width:970px; margin-left: 0px; margin-bottom:50px;" cellspacing="0" cellpadding="0">
          <tr>
            <td class="car_th" width="230">商品名称</td>
            <td class="car_th" width="200">属性</td>
            <td class="car_th" width="100">单价</td>
            <td class="car_th" width="130">购买数量</td>
            <td class="car_th" width="100">小计</td>
            <td class="car_th" width="110">操作</td>
          </tr>
          @foreach($car as $k=>$v)
          <tr class="goods_tr">
            <td>
            	<div class="c_s_img"><img src="/uploads/{{ $v->cargood->pic }}" width="73" height="73" /></div>
                {{ $v->cargood->gname}}
            </td>
            <td align="center">{{ $v->cargood->desc }}</td>
            <td align="center" style="color:#ff4e00;">￥{{ $v->cargood->price }}</td>
            
            <td align="center">
            	<div class="c_num">
            		<!-- jianUpdate1(jq(this)); -->
                    <input type="button" value="" onclick="jianUpdate({{ $v->cargood->price }},{{$v->id}},{{count($car)}})" class="car_btn_1" />
                	<input type="text" id="num{{$v->id}}" value="{{ $v->num }}" name="num[{{$k}}]" class="car_ipt" />

                    <input type="button" value="" onclick="addUpdate({{ $v->cargood->price }},{{$v->id}},{{count($car)}})" class="car_btn_2" />
                </div>
            </td>
            <td align="center" class="{{$k}}" id="total{{$v->id}}" style="color:#ff4e00;">￥{{ $v->num * $v->cargood->price }}</td>
            <td align="center"><a onclick="deleteCar({{ $v->id }},this,{{count($car)}})">删除</a></td>
          </tr>
          @endforeach
         
         <script type="text/javascript">
        function deleteCar(id,obj,car){
            if(!window.confirm('你确定要删除吗?')){
              return false;
            }
            $.get('/home/car/delete',{id:id},function(res){
                $(obj).parent().parent().remove();
                // car = car - 1;
                // console.log(car);
                let trs = $('.goods_tr').length;
                totalPrice(trs);
                console.log(res);
            },'html');
                
            // window.location.reload()
        }
				function addUpdate(price,id,car){
					let num = parseInt($('#num'+id).val());
					let num2 = num + 1; 
          $('#num'+id).val(num2);
          $('#total'+id).text('￥'+total(price,num2));
          totalPrice(car);
				}
				function jianUpdate(price,id,car){
				  let num = parseInt($('#num'+id).val());
          if(num > 1){ 
            let num2 = num - 1; 
            $('#num'+id).val(num2);
            $('#total'+id).text('￥'+total(price,num2));
            totalPrice(car);
          }

				}
				function total(price,num){
          let total = num*price;
          return total;	
				}
         </script>
         
          <tr height="70">
          	<td colspan="6" style="font-family:'Microsoft YaHei'; border-bottom:0;">
            	
                <span class="fr">商品总价：<b id="abc"  onclick="totalPrice({{count($car)}})" style="font-size:22px; color:#ff4e00;">￥2899</b></span>
            </td>
          </tr>
          <script type="text/javascript">
              function totalPrice(car){
                let n = 0;
                // console.log(car)
                for(let i=0;i<=car-1;i++){
                  n = n + parseInt($('.'+i).text().replace('￥',''));
                }
                $('#abc').text('￥'+n);
              }
              $('#abc').click();
          </script>
          <tr valign="top" height="150">
          	<td colspan="6" align="right">
            	<a href="#"><img src="/homes/images/buy1.gif" /></a>&nbsp; &nbsp; <a href="#"><img src="/homes/images/buy2.gif" onclick="demo.submit()" /></a>
            </td>
          </tr>
        </table>
        </form>
    </div>
	<!--End 第一步：查看购物车 End--> 
    
    

</div>
@else
  <a href="/"><img src="/home/images/carout.png" style="width:100%"></a>
@endif


@endsection
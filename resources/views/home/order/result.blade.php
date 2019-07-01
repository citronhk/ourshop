@extends('home.public.share')
  
@section('main')
	<div class="i_bg">  
    <div class="content mar_20">
    	<img src="/homes/images/img3.jpg"  style="width: 970px"	/>        
    </div>
    
    <!--Begin 第三步：提交订单 Begin -->
    <div class="content mar_20">
    	
        
        <!--Begin 支付宝支付 Begin -->
    	<div class="warning" style="width:950px; margin-left: 10px;">        	
            <table border="0" style="width:950px; text-align:center;" cellspacing="0" cellpadding="0">
              <tr height="35">
                <td style="font-size:18px;">
                	感谢您在本店购物！您的订单已提交成功，请记住您的订单号: <font color="#ff4e00">{{$orders_user->order_number}}</font>
                </td>
              </tr>
              <tr>
                <td style="font-size:14px; font-family:'宋体'; padding:10px 0 20px 0; border-bottom:1px solid #b6b6b6;">
                	您选定的配送方式为: <font color="#ff4e00">申通快递</font>； &nbsp; &nbsp;默认支付方式为: <font color="#ff4e00">支付宝</font>； &nbsp; &nbsp;您的应付款金额为: <font color="#ff4e00">￥{{$orders_user->total}}</font>
                </td>
              </tr>
              <tr>
                <td style="padding:20px 0 30px 0; font-family:'宋体';">
                	
                </td>
              </tr>
              <tr>
                <td>
                	<div class="btn_u" style="margin:0 auto; padding:0 20px; width:120px;"><a href="/home/order/pay">立即使用支付宝支付</a></div>
                	<a href="/">首页</a> &nbsp; &nbsp; <a href="/home/personal">用户中心</a>
                </td>
              </tr>
            </table>        	
        </div>
        <!--Begin 支付宝支付 Begin -->
        
    </div>
	<!--End 第三步：提交订单 End--> 
    

</div>
@endsection
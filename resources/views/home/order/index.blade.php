@extends('home.public.share')

@section('main')
@extends('home.public.share')

@section('main')

  <link type="text/css" rel="stylesheet" href="/homes/css/style.css" />
    
    
  <script type="text/javascript" src="/homes/js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="/homes/js/num.js">
    var jq = jQuery.noConflict();
  </script>     
    

  <div class="i_bg">  
    <div class="content mar_20">
      <img src="/homes/images/img2.jpg" style="width: 970px" />        
    </div>
    
    <!--Begin 第二步：确认订单信息 Begin -->
    <div class="content mar_20" style="width: 970px; margin-left:0px;">
      <div class="two_bg">
          <div class="two_t">
              &nbsp;&nbsp;&nbsp;&nbsp;商品列表
            </div>
            <table border="0" class="car_tab" style="width:830px; margin-left:50px ;margin-bottom:50px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="car_th" width="350">商品名称</td>
                <td class="car_th" width="150">属性</td>
                <td class="car_th" width="100">单价</td>
                <td class="car_th" width="100">购买数量</td>
                <td class="car_th" width="100">小计</td>
               
              </tr>
              @foreach($car as $k=>$v)
              <tr class="goods_tr">
                <td>
                  <div class="c_s_img"><img src="/uploads/{{ $v->cargood->pic }}" width="73" height="73" /></div>
                    {{ $v->cargood->gname}}
                </td>
                <td align="center">{{ $v->cargood->desc }}</td> 
                 <td align="center" style="color:#ff4e00;">￥{{ $v->cargood->price }}</td> 
                <td align="center">{{ $v->num }}</td>
                <td align="center" class="{{$k}}" id="total{{$v->id}}" style="color:#ff4e00;">￥{{ $v->num * $v->cargood->price }}</td>
              
              </tr>
              @endforeach
             
            </table>
            
            <div class="two_t">
              &nbsp;&nbsp;&nbsp;&nbsp;收货人信息
            </div>
            <table border="0" class="peo_tab" style="width:830px; margin-left:50px ;margin-bottom:50px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="p_td" width="160">收件人名称</td>
                <td width="395"><input type="text" name="" style="width:100%; height:100%"></td>
                <td class="p_td" width="160">手机</td>
                <td width="395"><input type="text" name="" style="width:100%; height:100%"></td>
              </tr>
              <tr>
                <td class="p_td">详细地址</td>
                <td width="395"><input type="text" name="" style="width:100%; height:100%"></td>
                <td class="p_td">邮政编码</td>
                <td width="395"><input type="text" name="" style="width:100%; height:100%"></td>
              </tr>
            </table>

         
            <div class="two_t">
              &nbsp;&nbsp;&nbsp;&nbsp;其他信息
            </div>
            <table border="0" class="car_tab" style="width:830px; margin-left:50px ;margin-bottom:50px;" cellspacing="0" cellpadding="0">
             
              <tr valign="top">
                <td align="right" style="padding-right:0;"><b style="font-size:14px;">订单附言：</b>
                </td>   
                <td style="padding-left:0;"><textarea class="add_txt" style="width:670px; height:50px;"></textarea></td>
              </tr>
             
            </table>
            
            <table border="0" style="width:830px; margin-left:50px ;margin-bottom:50px;" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right">
                  
                    商品总价: <font color="#ff4e00" id="abc"  onclick="totalPrice({{count($car)}})">￥1815.00</font>  + 配送费用: <font color="#ff4e00">￥15.00</font>
                </td>
              </tr>
              <tr height="70">
                <td align="right">
                <span class="fr">应付款金额：<b id="def"  onclick="totalPrice({{count($car)}})" style="font-size:22px; color:#ff4e00;">￥2899</b></span>
                </td>
              </tr>
              <tr height="70">
                <td align="right"><a href="#"><img src="/homes/images/btn_sure.gif" /></a></td>
              </tr>
            </table>
            <script type="text/javascript">
              function totalPrice(car){
                let n = 0;
                // console.log(car)
                for(let i=0;i<=car-1;i++){
                  n = n + parseInt($('.'+i).text().replace('￥',''));
                }
                $('#abc').text('￥'+n);
                $('#def').text('￥'+(n+15));
              }
              $('#def').click();
              $('#abc').click();
          </script>
        </div>
    </div>
  
    
       
</div>

@endsection

@endsection
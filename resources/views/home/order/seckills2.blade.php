@extends('home.public.share')

@section('main')


  <link type="text/css" rel="stylesheet" href="/homes/css/style.css" />
    
    
  <script type="text/javascript" src="/homes/js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="/homes/js/num.js">
    var jq = jQuery.noConflict();
  </script>  
  <script type="text/javascript" src="/registers/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/registers/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script type="text/javascript" src="/registers/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

  <div class="i_bg">  
    <div class="content mar_20">
      <img src="/homes/images/img2.jpg" style="width: 970px" />        
    </div>
      
      @if(session('success'))
            <div class="bs-example" data-example-id="dismissible-alert-css">
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <strong>{{ session('success') }}</strong> 
                </div>
              </div>
            @endif


            @if(session('error'))
            <div class="bs-example" data-example-id="dismissible-alert-css">
                <div class="alert alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <strong>{{ session('error') }}</strong> 
                </div>
              </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
              @foreach($seckills as $k=>$v)
              <tr class="goods_tr">
                <td>
                  <div class="c_s_img"><img src="/uploads/{{ $v->cargood->pic }}" width="73" height="73" /></div>
                    {{ $v->cargood->gname}}
                </td>
                <td align="center">{{ $v->cargood->desc }}</td> 
                 <td align="center" style="color:#ff4e00;">￥{{ $v->cargood->price }}</td> 
                <td align="center">{{ $v->num }}</td>
                <td align="center" class="{{$k}}" id="total{{$v->id}}" style="color:#ff4e00;">{{ $v->num }} * {{$v->cargood->price}}  * {{$data->discount}}&nbsp;=&nbsp; ￥{{ $v->num * $v->cargood->price * $data->discount}}</td>
              
              </tr>
              @endforeach
            
            </table>
            <form name="demo2" method="post" action="/home/order/result">
              {{ csrf_field() }}
            <div class="two_t">
              &nbsp;&nbsp;&nbsp;&nbsp;收货人信息
            </div>
           
            <table border="0" class="peo_tab" style="width:830px; margin-left:50px ;margin-bottom:50px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="p_td" width="160">收件人名称</td>
                <td width="395"><input type="text" name="order_name" value="" style="width:100%; height:100%"></td>
                <td class="p_td" width="160">手机</td>
                <td width="395"><input type="text" name="phone" value="" style="width:100%; height:100%"></td>
              </tr>
              <tr>
                <td class="p_td">详细地址</td>
                <td width="395"><input type="text" name="order_addr" value="" style="width:100%; height:100%"></td>
                <td class="p_td">邮政编码</td>
                <td width="395"><input type="text" name="postal" value="" style="width:100%; height:100%"></td>
              </tr>
            </table>
        
            <div class="two_t">
              &nbsp;&nbsp;&nbsp;&nbsp;其他信息
            </div>
            <table border="0" class="car_tab" style="width:830px; margin-left:50px ;margin-bottom:50px;" cellspacing="0" cellpadding="0">
             
              <tr valign="top">
                <td align="right" style="padding-right:0;"><b style="font-size:14px;">订单附言：</b>
                </td>   
                <td style="padding-left:0;"><textarea class="add_txt" name="message" style="width:670px; height:50px;"></textarea></td>
              </tr>
             
            </table>
            
            <table border="0" style="width:830px; margin-left:50px ;margin-bottom:50px;" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right">
                  商品总价: 
                    <font color="#ff4e00" id="abc"  onclick="totalPrice({{count($seckills)}},{{$data->discount}})">
                        ￥1815.00 
                    </font>&nbsp;
                    <font color="#ff4e00" style="font-size: 20px">
                        x&nbsp;{{$data->discount * 10}}&nbsp;折 
                    </font>
                </td>
              </tr>
              <input type="hidden" id="jkl" name="total" value="" onclick="cs();">
              <tr height="70">
                <td align="right">
                <span class="fr">应付款金额：<b id="def" onclick="totalPrice({{count($car)}})" style="font-size:22px; color:#ff4e00;">￥2899</b></span>
                </td>
              </tr>
              <tr height="70">
                <td align="right"><img src="/homes/images/btn_sure.gif" onclick="demo2.submit()" /></td>
              </tr>
            </table>
            </form> 
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
              function cs()
              {
                let n = $('#def').text().replace('￥','');
                $('#jkl').val(n);
              }
              $('#jkl').click();
          </script>
        </div>
    </div>
  
    
       
</div>

@endsection


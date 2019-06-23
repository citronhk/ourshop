@extends('home.public.share')
@section('main')
   
    
    <script type="text/javascript" src="/area.js"></script>
    <script type="text/javascript" src="/registers/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/registers/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script type="text/javascript" src="/registers/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <div style="margin-top: 30px;">
      <form name="demo" action="/home/addr" method="post">
          {{ csrf_field() }}
          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
          @endif

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
     <table border="0" class="add_tab" style="width:930px; height: 300px;text-align:center;"  cellspacing="0" cellpadding="0">
              <tr>
                <td align="right">收货地址名称</td>
                <td style="font-family:'宋体';"><input type="text" name="addr_name" value="" class="add_ipt" /></td>
              </tr>
              <tr>
                <td align="right">收货人姓名</td>
                <td style="font-family:'宋体';"><input type="text" name="order_name" value="" class="add_ipt" />（必填）</td>
                <td align="right">电子邮箱</td>
                <td style="font-family:'宋体';"><input type="text" name="email" value="" class="add_ipt"/></td>
              </tr>
              <tr>
                <td align="right">详细地址</td>
                <td style="font-family:'宋体';"><input type="text" name="order_addr" value="" class="add_ipt" />（必填）</td>
                <td align="right">邮政编码</td>
                <td style="font-family:'宋体';"><input type="text" name="postal" value="" class="add_ipt" /></td>
              </tr>
              <tr>
                <td align="right">手机</td>
                <td style="font-family:'宋体';"><input type="text" name="phone" value="" class="add_ipt" />（必填）</td>
                <td align="right">电话</td>
                <td style="font-family:'宋体';"><input type="text" name="telephone" value="" class="add_ipt" /></td>
              </tr>
             <tr>
                <td width="135" align="right">配送地区</td>
                <td colspan="3" style="font-family:'宋体';">
                    <select id="Province" runat="server" name="province" style="width: 170px;text-align: center;text-align-last: center; background-color: #f6f6f6;height: 25px; border: 1px solid #b1afaf" ></select>
                    <select id="Country" runat="server" name="country" style="width: 170px;text-align: center;text-align-last: center; background-color: #f6f6f6;height: 25px; border: 1px solid #b1afaf"></select>
                    <select id="Town" runat="server" name="town" style="width: 170px;text-align: center;text-align-last: center; background-color: #f6f6f6;height: 25px; border: 1px solid #b1afaf"></select>
                    （必填）
                </td>
              </tr>

            </table>
      </form>
            <p align="right">
              &nbsp; &nbsp; <a onclick="demo.submit()" class="add_b" style="margin:20px 30px auto auto">添加收货地址</a>
            </p> 
    </div>
    <div class="content mar_20">
      <img src="/homes/image/12345.jpg" style="width: 300px;margin-left: 315px; margin-top: 20px"  />        
    </div>
      <script language="javascript">
              setup();
      </script>
@endsection
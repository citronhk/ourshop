@extends('home.public.share')
    

@section('main')

<link rel="stylesheet" type="text/css" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
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
    <div class="m_des">
        <table border="0" style="width:870px; line-height:22px;" cellspacing="0" cellpadding="0">
          <tr valign="top">
            <td width="115"><img src="{{ $user_data->userinfo->profile ? '/uploads/'.$user_data->userinfo->profile :'/homes/images/user.jpg' }}" width="90" height="90" /></td>
          
            <td>
                <div class="m_user">{{$user_data->uname ? $user_data->uname :($user_data->phone ? $user_data->phone : $user_data->email)}}</div>
                <p>
                    等级：注册用户 <br />
                    <font color="#ff4e00">您还差 270 积分达到 分红100</font><br />
                 
                    您还没有通过邮件认证 <a href="#" style="color:#ff4e00;">点此发送认证邮件</a>
                </p>
                <div class="m_notice">
                    用户中心公告！
                </div>
            </td>
          </tr>
        </table>    
    </div>

    <div class="mem_t">账号信息</div>
            <table border="0" class="acc_tab" style="width:870px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="td_l">用户ID： </td>
                <td>{{ $user_data->id }}</td>
              </tr>
              <tr>
                <td class="td_l b_none">身份证号：</td>
                <td>{{ $user_data->token ? $user_data->token :'空' }}</td>
              </tr>
              <tr>
                <td class="td_l b_none">电  话：</td>
                <td>{{ $user_data->phone ? $user_data->phone :'空' }}</td>
              </tr>
              <tr>
                <td class="td_l">邮   箱： </td>
                <td>{{ $user_data->email ? $user_data->email :'空' }}</td>
              </tr>
              <tr>
                <td class="td_l b_none">注册时间：</td>
                <td>{{ $user_data->created_at ? $user_data->created_at :'空' }}</td>
              </tr>
              <tr>
                <td class="td_l b_none">用户性别：</td>
                <td>{{ $user_data->userinfo->sex ? $user_data->userinfo->sex :'空' }}</td>
              </tr>
              <tr>
                <td class="td_l b_none">用户年龄：</td>
                <td>{{ $user_data->userinfo->age ? $user_data->userinfo->age :'空' }}</td>
              </tr>
              <tr>
                <td class="td_l">完成订单：</td>
                <td>{{ $n }}</td>
              </tr>
              
            
            </table>
                <a href="/home/personal/edit"><input type="submit" value="修改个人信息" class="btn_tj" style="margin-left: 400px; margin-top:20px "></a>
@endsection
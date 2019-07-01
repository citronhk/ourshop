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

      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
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
    <form style="width: 80%; margin: auto" action="/home/personal/update" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}    
    <div class="form-group">
      <label for="uname">用户名</label>
      <input type="text" class="form-control" id="uname" name="uname" value="{{ $user_data->uname ? $user_data->uname : '' }}" >
    </div>
      <div class="form-group">
      <label for="email">邮箱</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ $user_data->email ? $user_data->email :'' }}">
    </div>
    <div class="form-group">
      <label for="phone">手机号</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{{ $user_data->phone ? $user_data->phone :'' }}">
    </div>
    <div class="form-group">
      <label for="age">年龄</label>
      <input type="t" class="form-control" id="age" name="age" value="{{ $user_data->userinfo->age ? $user_data->userinfo->age :'' }}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">性别</label>
      <input type="radio" name="sex" value="保密" checked="checked">保密
      <input type="radio" name="sex" value="男">男
      <input type="radio" name="sex" value="女">女
    </div>
    @if(session('home_userinfo')->userinfo->profile)
    <div class="form-group">
      <img src="{{ $user_data->userinfo->profile ? '/uploads/'.$user_data->userinfo->profile :'/homes/images/user.jpg' }}" width="90" height="90" />
    </div>
    @endif
    <input type="hidden" name="path_profile" value="{{ $user_data->userinfo->profile ? $user_data->userinfo->profile :'/homes/images/user.jpg' }}">
    <div class="form-group">
      <label for="profile">头像</label>
      <input type="file" id="profile" name="profile" enctype="multipart/form-data">
    </div>
   
    <button type="submit" class="btn btn-danger">修改</button>
  </form>

               
@endsection
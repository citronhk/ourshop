<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">
    <title>登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="/registers/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
    <link href="/registers/css/dlstyle.css" rel="stylesheet" type="text/css">
    <script src="/registers/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/registers/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>


    <link rel="stylesheet" type="text/css" href="/registers/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script type="text/javascript" src="/registers/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </head>

    <body>

    <div class="login-boxtitle">
      <a href="home/demo.html"><img alt="" src="/registers/images/logo.png" /></a>
    </div>

    <div class="res-banner">
      <div class="res-main">
        <div class="login-banner-bg"><span></span><img src="/registers/images/l_img.png" /></div>
        <div class="login-box" style="height: 350px; margin-top:50px; ">

            <div class="am-tabs" id="doc-my-tabs">
              <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                <li class="am-active"><a href="">邮箱登录</a></li>
                <li><a href="">手机号登录</a></li>
              </ul>
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
              <div class="am-tabs-bd">
                <div class="am-tab-panel am-active">

                  <form method="post" action="/home/sign" >
                    {{csrf_field()}}
                    <div class="user-email">
                      <label for="email">
                        <i class="am-icon-envelope-o"></i>
                      </label>
                      <input type="email" name="email" id="email" placeholder="请输入邮箱账号"></div>
                    <div class="user-pass">
                      <label for="password">
                        <i class="am-icon-lock"></i>
                      </label>
                      <input type="password" name="upass" id="password" placeholder="输入密码"></div>
                   
                      <div class="am-cf">
                      <input type="submit" name="" value="登录" class="am-btn am-btn-primary am-btn-sm am-fl">
                    </div>
                  </form>
                 
                  <span class="fr">还没有商城账号，<a href="/home/register" style="color:#ff4e00;">立即注册</a></span>

                    

                </div>

                <div class="am-tab-panel">

                  <form method="post" action="/home/dologin" onsubmit="return check()">
                    {{ csrf_field()}}
                    <div class="user-phone">
                      <label for="phone">
                        <i class="am-icon-mobile-phone am-icon-md"></i>
                      </label>
                      <input type="tel" name="phone" id="phone" placeholder="请输入手机号"></div>
                    
                    <div class="user-pass">
                      <label for="password">
                        <i class="am-icon-lock"></i>
                      </label>
                      <input type="password" name="upass" id="password" placeholder="输入密码"></div>
                      <div class="am-cf">
                      <input type="submit" name="" value="登录" class="am-btn am-btn-primary am-btn-sm am-fl">
                    </div>
                    
                  </form>
                  <span class="fr">还没有商城账号，<a href="/home/register" style="color:#ff4e00;">立即注册</a></span>
                 
                
                  <hr>
                </div>

                <script>
                  $(function() {
                      $('#doc-my-tabs').tabs();
                    })
                </script>
             
              </div>
            </div>

        </div>
      </div>
      
          <div class="footer ">
            <div class="footer-hd ">
              <p>
                <a href="# ">伟豪大业</a>
                <b>|</b>
                <a href="# ">商城首页</a>
                <b>|</b>
                <a href="# ">支付宝</a>
                <b>|</b>
                <a href="# ">物流</a>
              </p>
            </div>
            <div class="footer-bd ">
              <p>
                <a href="# ">关于伟豪</a>
                <a href="# ">合作伙伴</a>
                <a href="# ">联系我们</a>
                <a href="# ">网站地图</a>
                <em>© 2015-2025 Hengwang.com 版权所有</em>
              </p>
            </div>
          </div>
  </body>


</html>
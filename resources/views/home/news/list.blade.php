<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="/home/news/css/base.css" rel="stylesheet">
<link href="/home/news/css/index.css" rel="stylesheet">
<link href="/home/news/m.css" rel="stylesheet">
<script src="/home/news/js/jquery.min.js" type="text/javascript"></script>
<script src="/home/news/js/jquery.easyfader.min.js"></script>
<script src="/home/news/js/scrollReveal.js"></script>
<script src="/home/news/js/common.js"></script>
 <link type='text/css' rel='stylesheet' href="/home/css/bootstrap.css"  />   
    
<title>尤洪</title>
</head>
<body>  

<!--Begin Header Begin-->
<div class="soubg">
	<div class="sou">
    	<!--Begin 所在收货地区 Begin-->
    	<span class="s_city_b">
        	<span class="fl">送货至：</span>
            <span class="s_city">
            	<span>四川</span>
                <div class="s_city_bg">
                	<div class="s_city_t"></div>
                    <div class="s_city_c">
                    	<h2>请选择所在的收货地区</h2>
                        <table border="0" class="c_tab" style="width:235px; margin-top:10px;" cellspacing="0" cellpadding="0">
                          <tr>
                            <th>A</th>
                            <td class="c_h"><span>安徽</span><span>澳门</span></td>
                          </tr>
                          <tr>
                            <th>B</th>
                            <td class="c_h"><span>北京</span></td>
                          </tr>
                          <tr>
                            <th>C</th>
                            <td class="c_h"><span>重庆</span></td>
                          </tr>
                          <tr>
                            <th>F</th>
                            <td class="c_h"><span>福建</span></td>
                          </tr>
                          <tr>
                            <th>G</th>
                            <td class="c_h"><span>广东</span><span>广西</span><span>贵州</span><span>甘肃</span></td>
                          </tr>
                          <tr>
                            <th>H</th>
                            <td class="c_h"><span>河北</span><span>河南</span><span>黑龙江</span><span>海南</span><span>湖北</span><span>湖南</span></td>
                          </tr>
                          <tr>
                            <th>J</th>
                            <td class="c_h"><span>江苏</span><span>吉林</span><span>江西</span></td>
                          </tr>
                          <tr>
                            <th>L</th>
                            <td class="c_h"><span>辽宁</span></td>
                          </tr>
                          <tr>
                            <th>N</th>
                            <td class="c_h"><span>内蒙古</span><span>宁夏</span></td>
                          </tr>
                          <tr>
                            <th>Q</th>
                            <td class="c_h"><span>青海</span></td>
                          </tr>
                          <tr>
                            <th>S</th>
                            <td class="c_h"><span>上海</span><span>山东</span><span>山西</span><span class="c_check">四川</span><span>陕西</span></td>
                          </tr>
                          <tr>
                            <th>T</th>
                            <td class="c_h"><span>台湾</span><span>天津</span></td>
                          </tr>
                          <tr>
                            <th>X</th>
                            <td class="c_h"><span>西藏</span><span>香港</span><span>新疆</span></td>
                          </tr>
                          <tr>
                            <th>Y</th>
                            <td class="c_h"><span>云南</span></td>
                          </tr>
                          <tr>
                            <th>Z</th>
                            <td class="c_h"><span>浙江</span></td>
                          </tr>
                        </table>
                    </div>
                </div>
            </span>
        </span>
        <!--End 所在收货地区 End-->
        <span class="fr">

        	<span class="fl">
                你好，
                 @if(session('home_login'))
                 <a href="/home/personal">{{session('home_userinfo')->uname ? session('home_userinfo')->uname :(session('home_userinfo')->phone ? session('home_userinfo')->phone : session('home_userinfo')->email)}}</a>&nbsp; 
                 
                @else
                请<a href="/home/login">登录</a>&nbsp; 
                @endif
                <a href="/home/register" style="color:#ff4e00;">免费注册</a>&nbsp;|&nbsp;
                <a href="/home/order/list">我的订单</a>&nbsp;|
            </span>

        	<span class="ss">
            	<div class="ss_list">
                	<a href="#">收藏夹</a>
                </div>
                <div class="ss_list">
                	<a href="#">客户服务</a>
                </div>
                <div class="ss_list">
                	<a href="#">网站导航</a>
                </div>
            </span>
            <span class="fl">|&nbsp;关注我们：</span>
            <span class="s_sh"><a href="#" class="sh1">新浪</a><a href="#" class="sh2">微信</a></span>
            <span class="fr">|&nbsp;<a href="#">手机版&nbsp;<img src="/home/images/s_tel.png" align="absmiddle" /></a></span>

        </span>
    </div>
</div>

<div class="top">
    <div class="logo"><a href="/"><img src="/home/images/logo.png" /></a></div>
    <div class="search">

        <!-- 全局搜索 -->
    	<form action="/home/list" method="get">
        	<input type="text" name="search" value="" class="s_ipt" />
            <input type="submit" value="搜索" class="s_btn" />
        </form>                
        
    </div>
    <div class="i_car">
       @if(session('home_login'))
            <a href="/home/car/index"><div class="car_t">购物车 [<span>{{$cars}}</span>]</div></a>
       @else
        <div class="car_t car_b">购物车 [ <span>0</span> ]</div>
        <div class="car_bg">
       		<!--Begin 购物车未登录 Begin-->
        	<div class="un_login">还未登录！
            <a href="/home/login" style="color:#ff4e00;">马上登录</a>
             查看购物车！</div>
            <!--End 购物车未登录 End-->
        </div>
        @endif
    </div>
</div>

<!--End Header End--> 

<!--Begin Menu Begin-->
<div class="menu_bg"></div>
<!--End Menu End--> 
<div class="i_bg bg_color">
<div class="i_ban_bg">

	<div class="container">
  <h1 class="t_nav"><span></span><a href="/" class="n1"></a><a href="/" class="n2"></a></h1>
  <!--blogsbox begin-->
  <div class="blogsbox">
     
  @foreach($data as $k=>$v)
  <div class="blogs" data-scroll-reveal="enter bottom over 1s" data-scroll-reveal-id="16" style="-webkit-transform: translatey(0);transform: translatey(0);opacity: 1;-webkit-transition: -webkit-transform 1s ease-in-out 0s,  opacity 1s ease-in-out 0s;transition: transform 1s ease-in-out 0s, opacity 1s ease-in-out 0s;-webkit-perspective: 1000;-webkit-backface-visibility: hidden;" data-scroll-reveal-initialized="true">
      <h3 class="blogtitle"><a href="/news?id={{$v->id}}" target="_blank">{{$v->title}}</a></h3>
      <p class="blogtext">{{$v->desc}}</p>
      <div class="bloginfo">
        <ul>
          <li class="timer">{{$v->created_at}}</li>
        </ul>
      </div>
    </div>
    @endforeach
<!-- 分页 -->
     <div style="text-align:center;">{{ $data->links() }}</div>
  </div>
  <!--blogsbox end-->
  <div class="sidebar">

    <div class="tuijian">
      <h2 class="hometitle">推荐文章</h2>
      <ul class="sidenews">
       @foreach($sup_data as $k=>$v)
        <li class=".li">
          <p><a href="/news?id={{$v->id}}">{{$v->title}}</a></p>
        </li>
        @endforeach
          <li style="text-align:right"><a href="/news/list">更多文章...</a></li>
      </ul>
    </div>
  </div>
</div>

</div>
    
<!--Begin Footer Begin -->
<div class="b_btm_bg b_btm_c">
    <div class="b_btm">
        <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
          <tr>
            <td width="72"><img src="/home/images/b1.png" width="62" height="62" /></td>
            <td><h2>正品保障</h2>正品行货  放心购买</td>
          </tr>
        </table>
		<table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
          <tr>
            <td width="72"><img src="/home/images/b2.png" width="62" height="62" /></td>
            <td><h2>满38包邮</h2>满38包邮 免运费</td>
          </tr>
        </table>
        <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
          <tr>
            <td width="72"><img src="/home/images/b3.png" width="62" height="62" /></td>
            <td><h2>天天低价</h2>天天低价 畅选无忧</td>
          </tr>
        </table>
        <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
          <tr>
            <td width="72"><img src="/home/images/b4.png" width="62" height="62" /></td>
            <td><h2>准时送达</h2>收货时间由你做主</td>
          </tr>
        </table>
    </div>
</div>
<div class="b_nav">
	<dl>                                                                                            
    	<dt><a href="#">新手上路</a></dt>
        <dd><a href="#">售后流程</a></dd>
        <dd><a href="#">购物流程</a></dd>
        <dd><a href="#">订购方式</a></dd>
        <dd><a href="#">隐私声明</a></dd>
        <dd><a href="#">推荐分享说明</a></dd>
    </dl>
    <dl>
    	<dt><a href="#">配送与支付</a></dt>
        <dd><a href="#">货到付款区域</a></dd>
        <dd><a href="#">配送支付查询</a></dd>
        <dd><a href="#">支付方式说明</a></dd>
    </dl>
    <dl>
    	<dt><a href="#">会员中心</a></dt>
        <dd><a href="#">资金管理</a></dd>
        <dd><a href="#">我的收藏</a></dd>
        <dd><a href="#">我的订单</a></dd>
    </dl>
    <dl>
    	<dt><a href="#">服务保证</a></dt>
        <dd><a href="#">退换货原则</a></dd>
        <dd><a href="#">售后服务保证</a></dd>
        <dd><a href="#">产品质量保证</a></dd>
    </dl>
    <dl>
    	<dt><a href="#">联系我们</a></dt>
        <dd><a href="#">网站故障报告</a></dd>
        <dd><a href="#">购物咨询</a></dd>
        <dd><a href="#">投诉与建议</a></dd>
    </dl>
    <div class="b_tel_bg">
    	<a href="#" class="b_sh1">新浪微博</a>            
    	<a href="#" class="b_sh2">腾讯微博</a>
        <p>
        服务热线：<br />
        <span>400-123-4567</span>
        </p>
    </div>
    <div class="b_er">
        <div class="b_er_c"><img src="/home/images/er.gif" width="118" height="118" /></div>
        <img src="/home/images/ss.png" />
    </div>
</div>    
<div class="btmbg">
	<div class="btm">
    	备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br />
        <img src="/home/images/b_1.gif" width="98" height="33" /><img src="/home/images/b_2.gif" width="98" height="33" /><img src="/home/images/b_3.gif" width="98" height="33" /><img src="/home/images/b_4.gif" width="98" height="33" /><img src="/home/images/b_5.gif" width="98" height="33" /><img src="/home/images/b_6.gif" width="98" height="33" />
    </div>    	
</div>
<!--End Footer End -->    
</div>
	<link type="text/css" rel="stylesheet" href="/home/css/style.css" />

</body>


<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
</html>

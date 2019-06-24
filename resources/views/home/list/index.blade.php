@extends('home.public.index')

@section('css_script')
    <link type="text/css" rel="stylesheet" href="/home/css/style.css" />
    <!--[if IE 6]>
    <script src="js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->
   <link href="/home/css/bootstrap.css" rel='stylesheet' type='text/css' />
    
    <script type="text/javascript" src="/home/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/home/js/menu.js"></script>    
            
    <script type="text/javascript" src="/home/js/lrscroll_1.js"></script>
    <script type="text/javascript" src="/home/js/n_nav.js"></script>

    
@endsection

<!-- 显示商品分类列表 -->
@section('leftNav')
 <div class="leftNav none">
    <ul>      
            @foreach($cates_data as $k=>$v)
            <li> 
                <div class="fj">
                    <span class="n_img"><span></span></span>
                    <span class="fl">
                        @foreach($v->cname as $a=>$b)
                            <a href="/home/list?cid={{$b->id}}">{{$b->cname}}</a>&nbsp;
                        @endforeach
                    </span>

                </div>  
                   <div class="zj" style="top:{{ -40*$k+1 }}px;">
                    <div class="zj_l">
                        @foreach($v->sub as $kk=>$vv)
                        <div class="zj_l_c">
                            <div class="zj_title">
                                <h2>{{ $vv->cname }}</h2>
                                <span>></span>
                            </div>
                            <div class="zi_l_c_links">
                                @foreach($vv->sub as $kkk=>$vvv)
                                <span>|<a href="/home/list?cid={{$vvv->id}}">{{ $vvv->cname }}</a></span>
                                <span>|<a href="/home/list?cid={{$vvv->id}}">{{ $vvv->cname }}</a></span>
                                <span>|<a href="/home/list?cid={{$vvv->id}}">{{ $vvv->cname }}</a></span>
                                <span>|<a href="/home/list?cid={{$vvv->id}}">{{ $vvv->cname }}</a></span>
                                <span>|<a href="/home/list?cid={{$vvv->id}}">{{ $vvv->cname }}</a></span>
                                <span>|<a href="/home/list?cid={{$vvv->id}}">{{ $vvv->cname }}</a></span>
                                <span>|<a href="/home/list?cid={{$vvv->id}}">{{ $vvv->cname }}</a></span>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="zj_r">
                        <a href="#"><img src="/home/images/n_img1.jpg" width="236" height="200" /></a>
                        <a href="#"><img src="/home/images/n_img2.jpg" width="236" height="200" /></a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>        
    <style>
        .leftNav ul li:hover a{color:#000;}
        .leftNav ul li:hover a:hover{color:#e02d02;text-decoration: underline;}
        .leftNav span h2{color:#dbdbdb;}
        .leftNav .fl a{color: #fff;}
    </style>      
</div>
@endsection

@section('content')

<div class="i_bg">
	<div class="postion">
    	<span class="fl">全部 > 美妆个护 > 香水 > </span>
        <span class="n_ch">
            <span class="fl">品牌：<font>香奈儿</font></span>
            <a href="#"><img src="/home/images/s_close.gif" /></a>
        </span>
    </div>
    <!--Begin 筛选条件 Begin-->
    <div class="content mar_10">
    	<table border="0" class="choice" style="width:100%; font-family:'宋体'; margin:0 auto;" cellspacing="0" cellpadding="0">
          <tr valign="top">
            <td width="70">&nbsp; 品牌：</td>
            <td class="td_a"><a href="#" class="now">香奈儿（Chanel）</a><a href="#">迪奥（Dior）</a><a href="#">范思哲（VERSACE）</a><a href="#">菲拉格慕（Ferragamo）</a><a href="#">兰蔻（LANCOME）</a><a href="#">爱马仕（HERMES）</a><a href="#">卡文克莱（Calvin Klein）</a><a href="#">古驰（GUCCI）</a><a href="#">宝格丽（BVLGARI）</a><a href="#">阿迪达斯（Adidas）</a><a href="#">卡尔文·克莱恩（CK）</a><a href="#">凌仕（LYNX）</a><a href="#">大卫杜夫（Davidoff）</a><a href="#">安娜苏（Anna sui）</a><a href="#">阿玛尼（ARMANI）</a><a href="#">娇兰（Guerlain）</a></td>
          </tr>
          <tr valign="top">
            <td>&nbsp; 价格：</td>                                                                                                       
            <td class="td_a"><a href="#">0-199</a><a href="#" class="now">200-399</a><a href="#">400-599</a><a href="#">600-899</a><a href="#">900-1299</a><a href="#">1300-1399</a><a href="#">1400以上</a></td>
          </tr>                                              
          <tr>
            <td>&nbsp; 类型：</td>
            <td class="td_a"><a href="#">女士香水</a><a href="#">男士香水</a><a href="#">Q版香水</a><a href="#">组合套装</a><a href="#">香体走珠</a><a href="#">其它</a></td>
          </tr>                                          
          <tr>
            <td>&nbsp; 香型：</td>                                       
            <td class="td_a"><a href="#">浓香水</a><a href="#">香精Parfum香水</a><a href="#">淡香精EDP淡香水</a><a href="#">香露EDT</a><a href="#">古龙水</a><a href="#">其它</a></td>
          </tr>                                                             
        </table>                                                                                 
    </div>
    <!--End 筛选条件 End-->
    
    <div class="content mar_20">
    	<div class="l_history">
        	<div class="his_t">
            	<span class="fl">浏览历史</span>
                <span class="fr"><a href="#">清空</a></span>
            </div>
        	<ul>
            	<li>
                    <div class="img"><a href="#"><img src="/home/images/his_1.jpg" width="185" height="162" /></a></div>
                	<div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                    	<font>￥<span>368.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="/home/images/his_2.jpg" width="185" height="162" /></a></div>
                	<div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                    	<font>￥<span>768.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="/home/images/his_3.jpg" width="185" height="162" /></a></div>
                	<div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                    	<font>￥<span>680.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="/home/images/his_4.jpg" width="185" height="162" /></a></div>
                	<div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                    	<font>￥<span>368.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="/home/images/his_5.jpg" width="185" height="162" /></a></div>
                	<div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                    	<font>￥<span>368.00</span></font> &nbsp; 18R
                    </div>
                </li>
        	</ul>
        </div>
        <div class="l_list">
        	<div class="list_t">
            	<span class="fl list_or">
                	<a href="#" class="now">默认</a>
                    <a href="#">
                    	<span class="fl">销量</span>                        
                        <span class="i_up">销量从低到高显示</span>
                        <span class="i_down">销量从高到低显示</span>                                                     
                    </a>
                    <a href="#">
                    	<span class="fl">价格</span>                        
                        <span class="i_up">价格从低到高显示</span>
                        <span class="i_down">价格从高到低显示</span>     
                    </a>
                    <a href="#">新品</a>
                </span>
                <span class="fr">共发现120件</span>
            </div>

            <!-- 商品列表 开始 -->
            <div class="list_c">
                <ul class="cate_list">
                    @foreach($goods_datas as $k=>$v)
                	<li>
                    	<div class="img"><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="210" height="185" /></a></div>
                        <div class="price">
                            <font>￥<span>{{$v->price}}</span></font> &nbsp;
                        </div>
                        <div class="name"><a href="/home/detail?id={{$v->id}}">{{$v->gname}}</a></div>
                        <div class="carbg">
                        	<a href="#" class="ss">收藏</a>
                            <a href="#" class="j_car">加入购物车</a>
                        </div>  
                    </li>
                    @endforeach
                </ul>
                
                <!--
                    <div class="pages">
                    	<a href="#" class="p_pre">上一页</a>
                        <a href="#" class="cur">1</a>
                        <a href="#">2</a><a href="#">3</a>...
                        <a href="#">20</a><a href="#" class="p_pre">下一页</a>
                    </div>  
                -->   

                @if($cid)
                    <div style="text-align:center;">{{ $goods_datas->appends(['cid'=>$cid])->links() }}</div>
                @else
                    <div style="text-align:center;">{{ $goods_datas->appends(['search'=>$search])->links() }}</div>
                @endif
                    

            </div>
            <!-- 商品列表 结束 -->

        </div>
    </div>
@endsection
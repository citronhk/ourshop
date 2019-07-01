@extends('home.public.index')
<!-- load css_script  -->
@section('css_script')
    <link type="text/css" rel="stylesheet" href="/home/css/style.css" />
    <!--[if IE 6]>
    <script src="/home/js//iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->    
    <script type="text/javascript" src="/home/js/jquery-1.11.1.min_044d0927.js"></script>
    <script type="text/javascript" src="/home/js/jquery.bxslider_e88acd1b.js"></script>
    
    <script type="text/javascript" src="/home/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/home/js/menu.js"></script>    
        
    <script type="text/javascript" src="/home/js/select.js"></script>
    
    <script type="text/javascript" src="/home/js/lrscroll.js"></script>
    
    <script type="text/javascript" src="/home/js/iban.js"></script>
    <script type="text/javascript" src="/home/js/fban.js"></script>
    <script type="text/javascript" src="/home/js/f_ban.js"></script>
    <script type="text/javascript" src="/home/js/mban.js"></script>
    <script type="text/javascript" src="/home/js/bban.js"></script>
    <script type="text/javascript" src="/home/js/hban.js"></script>
    <script type="text/javascript" src="/home/js/tban.js"></script>
    
    <script type="text/javascript" src="/home/js/lrscroll_1.js"></script>
@endsection

<!-- 显示商品分类列表 -->
@section('leftNav')

 <div class="leftNav">
    <ul>      
            @foreach($cates_data as $k=>$v)
            <li> 
                <div class="fj">
                    <span class="n_img"><span></span></span>
                    <span class="fl">
                        @foreach($v->cname as $a=>$b)cid
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

<!-- show content -->
@section('content')

<div class="i_bg">
    <div class="i_ban_bg">
        <!--Begin Banner Begin-->
        <div class="banner">        
            <div class="top_slide_wrap">
                <ul class="slide_box bxslider">
                    @foreach($banners_data as $k=>$v)
                        <li><img src="/uploads/{{$v->url}}" width="740" height="401" /></li>
                    @endforeach
                </ul>   
                <div class="op_btns clearfix">
                    <a href="#" class="op_btn op_prev"><span></span></a>
                    <a href="#" class="op_btn op_next"><span></span></a>
                </div>        
            </div>
        </div>
        <script type="text/javascript">
        //var jq = jQuery.noConflict();
        (function(){
            $(".bxslider").bxSlider({
                auto:true,
                prevSelector:jq(".top_slide_wrap .op_prev")[0],nextSelector:jq(".top_slide_wrap .op_next")[0]
            });
        })();
        </script>
        <!--End Banner End-->

        <div class="inews">
            <div class="inews-top"></div>
            <div class="inews-bottom"></div>


        </div>
    </div>

    <!--Begin 热门商品 Begin-->
    <div class="content mar_10">
        <div class="h_l_img">
            <div class="img"><img src="home/images/l_img.jpg" width="188" height="188" /></div>
            <div class="pri_bg">
                <span class="price fl">￥53.00</span>
                <span class="fr">16R</span>
            </div>
        </div>
        <div class="hot_pro">           
            <div id="featureContainer">
                <div id="feature">
                    <div id="block">
                        <div id="botton-scroll">
                            <ul class="featureUL">
                                @foreach($hot_sell_goods_data as $k=>$v)
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="h_icon"><img src="home/images/hot.png" width="50" height="50" /></div>
                                        <div class="imgbg">
                                            <a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="160" height="136" /></a>
                                        </div>                                        
                                        <div class="name">
                                            <a href="/home/detail?id={{$v->id}}">
                                            <h2>{{$v->gname}}</h2>
                                            {{$v->desc}}
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>{{$v->price}}</span></font> &nbsp; 
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <a class="h_prev" href="javascript:void();">Previous</a>
                    <a class="h_next" href="javascript:void();">Next</a>
                </div>
            </div>
        </div>
    </div>

    <!--Begin 限时特卖 Begin-->
    <div class="i_t mar_10">
        <span class="fl">限时特卖</span>
        <span class="i_mores fr"><a href="#">更多</a></span>
    </div>
    <div class="content">
        <div class="i_sell">
            <div id="imgPlay">
                <ul class="imgs" id="actor">
                    <li><a href="#"><img src="home/images/tm_r.jpg" width="211" height="357" /></a></li>
                    <li><a href="#"><img src="home/images/tm_r.jpg" width="211" height="357" /></a></li>
                    <li><a href="#"><img src="home/images/tm_r.jpg" width="211" height="357" /></a></li>
                </ul>
                <div class="previ">上一张</div>
                <div class="nexti">下一张</div>
            </div>        
        </div>
        <div class="sell_right">
        
            <div class="sell_1">
                <div class="s_img"><a href="#"><img src="home/images/tm_1.jpg" width="185" height="155" /></a></div>
                <div class="s_price">￥<span>89</span></div>
                <div class="s_name">
                    <h2><a href="#">沙宣洗发水</a></h2>
                    倒计时：<span>1200</span> 时 <span>30</span> 分 <span>28</span> 秒
                </div>
            </div>
            <div class="sell_2">
                <div class="s_img"><a href="#"><img src="home/images/tm_2.jpg" width="185" height="155" /></a></div>
                <div class="s_price">￥<span>289</span></div>
                <div class="s_name">
                    <h2><a href="#">德芙巧克力</a></h2>
                    倒计时：<span>1200</span> 时 <span>30</span> 分 <span>28</span> 秒
                </div>
            </div>
            <div class="sell_b1">
                <div class="sb_img"><a href="#"><img src="home/images/tm_b1.jpg" width="242" height="356" /></a></div>
                <div class="s_price">￥<span>289</span></div>
                <div class="s_name">
                    <h2><a href="#">东北大米</a></h2>
                    倒计时：<span>1200</span> 时 <span>30</span> 分 <span>28</span> 秒
                </div>
            </div>
            <div class="sell_3">
                <div class="s_img"><a href="#"><img src="home/images/tm_3.jpg" width="185" height="155" /></a></div>
                <div class="s_price">￥<span>289</span></div>
                <div class="s_name">
                    <h2><a href="#">迪奥香水</a></h2>
                    倒计时：<span>1200</span> 时 <span>30</span> 分 <span>28</span> 秒
                </div>
            </div>
            <div class="sell_4">
                <div class="s_img"><a href="#"><img src="home/images/tm_4.jpg" width="185" height="155" /></a></div>
                <div class="s_price">￥<span>289</span></div>
                <div class="s_name">
                    <h2><a href="#">美妆</a></h2>
                    倒计时：<span>1200</span> 时 <span>30</span> 分 <span>28</span> 秒
                </div>
            </div>
            <div class="sell_b2">
                <div class="sb_img"><a href="#"><img src="home/images/tm_b2.jpg" width="242" height="356" /></a></div>
                <div class="s_price">￥<span>289</span></div>
                <div class="s_name">
                    <h2><a href="#">美妆</a></h2>
                    倒计时：<span>1200</span> 时 <span>30</span> 分 <span>28</span> 秒
                </div>
            </div>
        </div>
    </div>

    <!--End 限时特卖 End-->
<!--     <div class="content mar_20">
        <img src="home/images/mban_1.jpg" width="1200" height="110" />
    </div> -->

   

@endsection
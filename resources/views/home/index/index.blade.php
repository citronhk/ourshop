@extends('home.public.index')
<!-- load css_script  -->
@section('css_script')
    <link type="text/css" rel="stylesheet" href="/home/css/style.css" />
    <link type="text/css" rel="stylesheet" href="/home/css/skill.css" />

    <!--[if IE 6]>
    <script src="/home/js//iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->    
    <script type="text/javascript" src="/home/js/jquery.bxslider_e88acd1b.js"></script>
    
    <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
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
@include('home.public.index_leftnav')
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
            <div class="news_t">
                <span class="fr"> <a href="/news/list">更多</a></span>新闻资讯
            </div>

            <ul>
                @foreach($news as $k=>$v)
                <li><span>[ 资讯 ]</span><a href="/news?id={{$v->id}}">{{$v->title}}</a></li>
                @endforeach
            </ul>
            <div class="charge_t">
                话费充值<div class="ch_t_icon"></div>
            </div>
            <form>
            <table border="0" style="width:205px; margin-top:10px;" cellspacing="0" cellpadding="0">
              <tr height="35">
                <td width="33">号码</td>
                <td><input type="text" value="" class="c_ipt" /></td>
              </tr>
              <tr height="35">
                <td>面值</td>
                <td>
                    <select class="jj" name="city">
                      <option value="0" selected="selected">100元</option>
                      <option value="1">50元</option>
                      <option value="2">30元</option>
                      <option value="3">20元</option>
                      <option value="4">10元</option>
                    </select>
                    <span style="color:#ff4e00; font-size:14px;">￥99.5</span>
                </td>
              </tr>
              <tr height="35">
                <td colspan="2"><input type="submit" value="立即充值" class="c_btn" /></td>
              </tr>
            </table>
            </form>
        </div>
    </div>

    <!--Begin 热门商品 Begin-->
    <div class="content mar_10">
        <div class="h_l_img">
            <div class="img"><img src="home/images/l_img.jpg" width="188" height="188" /></div>
            <div class="pri_bg">
                <span class="price fl"></span>
                <span class="fr"></span>
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
                                            <a href="/home/detail?cid={{$v->cid}}&id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="160" height="136" /></a>
                                        </div>                                        
                                        <div class="name">
                                            <a href="/home/detail?cid={{$v->cid}}&id={{$v->id}}">
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
        <span class="i_mores fr"><a href="/skill/index">前往特卖会场</a></span>
    </div>
    <div class="content">
        <div class="i_sell">
            <div id="imgPlay">
                <ul class="imgs" id="actor">
                    <!-- 轮播图 -->
                    @foreach($tm_Banner_data as $k=>$v)
                     <li><a href="/skill/index?gid={{$v->gid}}"><img src="/uploads/{{$v->url}}" width="211" height="357" /></a></li>
                    @endforeach
                </ul>
                <div class="previ">上一张</div>
                <div class="nexti">下一张</div>
            </div>        
        </div>
        <div class="sell_right">
            @foreach($tm_goods_data as $k=>$v)
            <div class="sell_{{$k+1}}">
                <div class="s_img"><a href="/skill/index"><img src="/uploads/{{$tm_goods_attr[$v->gid]['url']}}" width="185" height="155" /></a></div>
                <div class="s_price">￥<span>{{$tm_goods_attr[$v->gid]['price']}}</span></div>
                <div class="s_name">
                    <h2><a href="/skill/index">{{$tm_goods_attr[$v->gid]['gname']}}</a></h2>
                    <ul class="countdown">
                        <li class="seperator">倒计时：</li>
                        <li> <span class="hours">0</span></li>
                        <li class="seperator">时</li>
                        <li> <span class="minutes">0</span></li>
                        <li class="seperator">分</li>
                        <li> <span class="seconds">0</span></li>
                        <li class="seperator">秒</li>
                    </ul>
                </div>
            </div>
            @endforeach
                
            @foreach($tm_img_data as $k=>$v)
            <div class="sell_b{{$k+1}}">
                <div class="sb_img"><a href="/skill/index"><img src="/uploads/{{$v->url}}" width="242" height="356" /></a></div>
                <div class="s_price">￥<span>{{$tm_goods_attr[$v->gid]['price']}}</span></div>
                <div class="s_name">
                    <h2><a href="#">{{$tm_goods_attr[$v->gid]['gname']}}</a></h2>
                    <!-- 倒计时：<span>1200</span> 时 <span>30</span> 分 <span>28</span> 秒 -->
                    <ul class="countdown">
                        <li class="seperator">倒计时：</li>
                        <li> <span class="hours">0</span></li>
                        <li class="seperator">时</li>
                        <li> <span class="minutes">0</span></li>
                        <li class="seperator">分</li>
                        <li> <span class="seconds">0</span></li>
                        <li class="seperator">秒</li>
                    </ul>
                </div>
            </div>
            @endforeach
    </div>
    <div style="clear:both;"></div>
    <!--End 限时特卖 End-->

    <!-- 长图广告 -->
    <div class="content mar_20">
        <img src="home/images/mban_1.jpg" width="1200" height="110" />
    </div>

    <!--Begin 悠闲零食 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">1F</span>
        <span class="fl">悠闲零食</span>                
        <span class="i_mores fr"></span>
    </div>
    <div class="content">
        <div class="fresh_left">
            <div class="fre_ban">
                <div id="imgPlay1">
                    <ul class="imgs" id="actor1">
                    <!-- 左侧轮播图 -->
                    @foreach($f1_ad_left as $k=>$v)
                        <li><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->url}}" width="211" height="286" /></a></li>
                    @endforeach
                    </ul>
                    <div class="prevf">上一张</div>
                    <div class="nextf">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <!-- 显示部分三级栏目 -->
                    @foreach($f1_cates as $k=>$v)
                    <span><a href="/home/list?cid={{$v->id}}">{{ $v->cname }}</a></span>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <!-- 列表数据 -->
                @foreach($f1_data as $k=>$v)
                <li>
                    <div class="name"><a href="/home/detail?id={{$v->id}}">{{ $v->gname }}</a></div>
                    <div class="price">
                        <font>￥<span>{{ $v->price }}</span></font> &nbsp;
                    </div>
                    <div class="img"><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <!-- 右侧广告位 -->
                @foreach($f1_ad_right as $k=>$v)
                <li>
                    <a href="/home/detail?id={{$v->gid}}">
                        <img src="/uploads/{{$v->url}}" width="260" height="220" />
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>    
    <!--End 悠闲零食 End-->


    <!--Begin 食品饮料 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">2F</span>
        <span class="fl">食品饮料</span>                                
        <span class="i_mores fr"></span>
    </div>
    <div class="content">
        <div class="food_left">
            <div class="food_ban">
                <div id="imgPlay2">
                    <ul class="imgs" id="actor2">
                    <!-- 左侧轮播图 -->
                    @foreach($f2_ad_left as $k=>$v)
                    <li><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->url}}" width="211" height="286" /></a></li>
                    @endforeach
                    </ul>
                    <div class="prev_f">上一张</div>
                    <div class="next_f">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <!-- 显示部分三级栏目 -->
                    @foreach($f2_cates as $k=>$v)
                    <span><a href="/home/list?cid={{$v->id}}">{{ $v->cname }}</a></span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <!-- 列表数据 -->
                @foreach($f2_data as $k=>$v)
                <li>
                    <div class="name"><a href="/home/detail?id={{$v->id}}">{{ $v->gname }}</a></div>
                    <div class="price">
                        <font>￥<span>{{ $v->price }}</span></font> &nbsp;
                    </div>
                    <div class="img"><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <!-- 右侧广告位 -->
                @foreach($f2_ad_right as $k=>$v)
                <li>
                    <a href="/home/detail?id={{$v->gid}}">
                        <img src="/uploads/{{$v->url}}" width="260" height="220" />
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>    
    <!--End 食品饮料 End-->


    <!--Begin 个人美妆 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">3F</span>
        <span class="fl">个人美妆</span>                                
        <span class="i_mores fr"></span>                
    </div>
    <div class="content">
        <div class="make_left">
            <div class="make_ban">
                <div id="imgPlay3">
                    <ul class="imgs" id="actor3">
                        <!-- 左侧轮播图 -->
                        @foreach($f3_ad_left as $k=>$v)
                        <li><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->url}}" width="211" height="286" /></a></li>
                        @endforeach
                    </ul>
                    <div class="prev_m">上一张</div>
                    <div class="next_m">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <!-- 显示部分三级栏目 -->
                    @foreach($f3_cates as $k=>$v)
                    <span><a href="/home/list?cid={{$v->id}}">{{ $v->cname }}</a></span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <!-- 列表数据 -->
                @foreach($f3_data as $k=>$v)
                <li>
                    <div class="name"><a href="/home/detail?id={{$v->id}}">{{ $v->gname }}</a></div>
                    <div class="price">
                        <font>￥<span>{{ $v->price }}</span></font> &nbsp;
                    </div>
                    <div class="img"><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <!-- 右侧广告位 -->
                @foreach($f3_ad_right as $k=>$v)
                <li>
                    <a href="/home/detail?id={{$v->gid}}">
                        <img src="/uploads/{{$v->url}}" width="260" height="220" />
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>    
    <!--End 个人美妆 End-->

    <!-- 长广告图  -->
    <div class="content mar_20">
        <img src="home/images/mban_1.jpg" width="1200" height="110" />
    </div>


    <!--Begin 母婴玩具 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">4F</span>
        <span class="fl">母婴玩具</span>                                
        <span class="i_mores fr"></span>                               
    </div>
    <div class="content">
        <div class="baby_left">
            <div class="baby_ban">
                <div id="imgPlay4">
                    <ul class="imgs" id="actor4">
                       <!-- 左侧轮播图 -->
                        @foreach($f4_ad_left as $k=>$v)
                        <li><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->url}}" width="211" height="286" /></a></li>
                        @endforeach
                    </ul>
                    <div class="prev_b">上一张</div>
                    <div class="next_b">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <!-- 显示部分三级栏目 -->
                    @foreach($f4_cates as $k=>$v)
                    <span><a href="/home/list?cid={{$v->id}}">{{ $v->cname }}</a></span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <!-- 列表数据 -->
                @foreach($f4_data as $k=>$v)
                <li>
                    <div class="name"><a href="/home/detail?id={{$v->id}}">{{ $v->gname }}</a></div>
                    <div class="price">
                        <font>￥<span>{{ $v->price }}</span></font> &nbsp;
                    </div>
                    <div class="img"><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <!-- 右侧广告位 -->
                @foreach($f4_ad_right as $k=>$v)
                <li>
                    <a href="/home/detail?id={{$v->gid}}">
                        <img src="/uploads/{{$v->url}}" width="260" height="220" />
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>    
    <!--End 母婴玩具 End-->


    <!--Begin 家居生活 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">5F</span>
        <span class="fl">家居生活</span>                                
        <span class="i_mores fr"></span>                                              
    </div>
    <div class="content">
        <div class="home_left">
            <div class="home_ban">
                <div id="imgPlay5">
                    <ul class="imgs" id="actor5">
                        <!-- 左侧轮播图 -->
                        @foreach($f5_ad_left as $k=>$v)
                        <li><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->url}}" width="211" height="286" /></a></li>
                        @endforeach
                    </ul>
                    <div class="prev_h">上一张</div>
                    <div class="next_h">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <!-- 显示部分三级栏目 -->
                    @foreach($f5_cates as $k=>$v)
                    <span><a href="/home/list?cid={{$v->id}}">{{ $v->cname }}</a></span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <!-- 列表数据 -->
                @foreach($f5_data as $k=>$v)
                <li>
                    <div class="name"><a href="/home/detail?id={{$v->id}}">{{ $v->gname }}</a></div>
                    <div class="price">
                        <font>￥<span>{{ $v->price }}</span></font> &nbsp;
                    </div>
                    <div class="img"><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <!-- 右侧广告位 -->
                @foreach($f5_ad_right as $k=>$v)
                <li>
                    <a href="/home/detail?id={{$v->gid}}">
                        <img src="/uploads/{{$v->url}}" width="260" height="220" />
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>    
    <!--End 家居生活 End-->

    <!--Begin 数码家电 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">6F</span>
        <span class="fl">数码家电</span>                                
        <span class="i_mores fr"></span>                                               
    </div>
    <div class="content">
        <div class="tel_left">
            <div class="tel_ban">
                <div id="imgPlay6">
                    <ul class="imgs" id="actor6">
                        <!-- 左侧轮播图 -->
                        @foreach($f6_ad_left as $k=>$v)
                        <li><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->url}}" width="211" height="286" /></a></li>
                        @endforeach
                    </ul>
                    <div class="prev_t">上一张</div>
                    <div class="next_t">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <!-- 显示部分三级栏目 -->
                    @foreach($f6_cates as $k=>$v)
                    <span><a href="/home/list?cid={{$v->id}}">{{ $v->cname }}</a></span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <!-- 列表数据 -->
                @foreach($f6_data as $k=>$v)
                <li>
                    <div class="name"><a href="/home/detail?id={{$v->id}}">{{ $v->gname }}</a></div>
                    <div class="price">
                        <font>￥<span>{{ $v->price }}</span></font> &nbsp;
                    </div>
                    <div class="img"><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="185" height="155" /></a></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <!-- 右侧广告位 -->
                @foreach($f6_ad_right as $k=>$v)
                <li>
                    <a href="/home/detail?id={{$v->gid}}">
                        <img src="/uploads/{{$v->url}}" width="260" height="220" />
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>  
    <!--End 数码家电 End--> 

    <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/js/countDown.js"></script>
    
    
</div>
@endsection
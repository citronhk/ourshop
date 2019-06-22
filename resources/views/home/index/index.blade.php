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
                   <span class="fl">{{ $v->cname }}</span>
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
            <div class="news_t">
                <span class="fr"><a href="#">更多 ></a></span>新闻资讯
            </div>
            <ul>
                <li><span>[ 特惠 ]</span><a href="#">掬一轮明月 表无尽惦念</a></li>
                <li><span>[ 公告 ]</span><a href="#">好奇金装成长裤新品上市</a></li>
                <li><span>[ 特惠 ]</span><a href="#">大牌闪购 · 抢！</a></li>
                <li><span>[ 公告 ]</span><a href="#">发福利 买车就抢千元油卡</a></li>
                <li><span>[ 公告 ]</span><a href="#">家电低至五折</a></li>
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

    <!--Begin 进口 生鲜 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">1F</span>
        <span class="fl">进口 <b>·</b> 生鲜</span>                
        <span class="i_mores fr">
            <!-- <a href="#">进口咖啡</a>&nbsp; &nbsp; &nbsp;  -->
        </span>
    </div>
    <div class="content">
        <div class="fresh_left">
            <div class="fre_ban">
                <div id="imgPlay1">
                    <ul class="imgs" id="actor1">
                    @foreach($floor_ads_datas_l as $k=>$v)
                        <li><a href="/home/detail?id={{$v->gid}}"><img src="/uploads/{{$v->url}}" width="211" height="286" /></a></li>
                    @endforeach
                    </ul>
                    <div class="prevf">上一张</div>
                    <div class="nextf">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    @foreach($floor_1_cates as $k=>$v)
                    <span><a href="/home/detail?id={{$v->id}}">{{ $v->cname }}</a></span>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($floor_goods_datas as $k=>$v)
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
                @foreach($floor_ads_datas_r as $k=>$v)
                <li>
                    <a href="/home/detail?id={{$v->gid}}">
                        <img src="/uploads/{{$v->url}}" width="260" height="220" />
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>    
    <!--End 进口 生鲜 End-->

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
                        <li><a href="#"><img src="home/images/food_r.jpg" width="211" height="286" /></a></li>
                        <li><a href="#"><img src="home/images/food_r.jpg" width="211" height="286" /></a></li>
                        <li><a href="#"><img src="home/images/food_r.jpg" width="211" height="286" /></a></li>
                    </ul>
                    <div class="prev_f">上一张</div>
                    <div class="next_f">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    @foreach($floor_1_cates as $k=>$v)
                    <span><a href="#">{{ $v->cname }}</a></span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <li>
                    <div class="name"><a href="#">莫斯利安酸奶</a></div>
                    <div class="price">
                        <font>￥<span>96.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/food_1.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">莫斯利安酸奶</a></div>
                    <div class="price">
                        <font>￥<span>96.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/food_2.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">莫斯利安酸奶</a></div>
                    <div class="price">
                        <font>￥<span>96.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/food_3.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">莫斯利安酸奶</a></div>
                    <div class="price">
                        <font>￥<span>96.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/food_4.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">莫斯利安酸奶</a></div>
                    <div class="price">
                        <font>￥<span>96.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/food_5.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">莫斯利安酸奶</a></div>
                    <div class="price">
                        <font>￥<span>96.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/food_6.jpg" width="185" height="155" /></a></div>
                </li>
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="home/images/food_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="#"><img src="home/images/food_b2.jpg" width="260" height="220" /></a></li>
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
                        <li><a href="#"><img src="home/images/make_r.jpg" width="211" height="286" /></a></li>
                        <li><a href="#"><img src="home/images/make_r.jpg" width="211" height="286" /></a></li>
                        <li><a href="#"><img src="home/images/make_r.jpg" width="211" height="286" /></a></li>
                    </ul>
                    <div class="prev_m">上一张</div>
                    <div class="next_m">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    @foreach($floor_1_cates as $k=>$v)
                    <span><a href="#">{{ $v->cname }}</a></span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <li>
                    <div class="name"><a href="#">美宝莲粉饼</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 16R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/make_1.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">美宝莲粉饼</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 16R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/make_2.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">美宝莲粉饼</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 16R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/make_3.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">美宝莲粉饼</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 16R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/make_4.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">美宝莲粉饼</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 16R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/make_5.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">美宝莲粉饼</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 16R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/make_6.jpg" width="185" height="155" /></a></div>
                </li>
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="home/images/make_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="#"><img src="home/images/make_b2.jpg" width="260" height="220" /></a></li>
            </ul>
        </div>
    </div>    
    <!--End 个人美妆 End-->

    <!-- 长广告图  -->
<!--     <div class="content mar_20">
        <img src="home/images/mban_1.jpg" width="1200" height="110" />
    </div> -->


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
                        <li><a href="#"><img src="home/images/baby_r.jpg" width="211" height="286" /></a></li>
                        <li><a href="#"><img src="home/images/baby_r.jpg" width="211" height="286" /></a></li>
                        <li><a href="#"><img src="home/images/baby_r.jpg" width="211" height="286" /></a></li>
                    </ul>
                    <div class="prev_b">上一张</div>
                    <div class="next_b">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    @foreach($floor_1_cates as $k=>$v)
                    <span><a href="#">{{ $v->cname }}</a></span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <li>
                    <div class="name"><a href="#">儿童玩具  变形金刚</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 20R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/baby_1.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">儿童玩具  变形金刚</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 20R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/baby_2.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">儿童玩具  变形金刚</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 20R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/baby_3.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">儿童玩具  变形金刚</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 20R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/baby_4.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">儿童玩具  变形金刚</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 20R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/baby_5.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">儿童玩具  变形金刚</a></div>
                    <div class="price">
                        <font>￥<span>260.00</span></font> &nbsp; 20R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/baby_6.jpg" width="185" height="155" /></a></div>
                </li>
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="home/images/baby_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="#"><img src="home/images/baby_b2.jpg" width="260" height="220" /></a></li>
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
                        <li><a href="#"><img src="home/images/home_r.jpg" width="211" height="286" /></a></li>
                        <li><a href="#"><img src="home/images/home_r.jpg" width="211" height="286" /></a></li>
                        <li><a href="#"><img src="home/images/home_r.jpg" width="211" height="286" /></a></li>
                    </ul>
                    <div class="prev_h">上一张</div>
                    <div class="next_h">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    @foreach($floor_1_cates as $k=>$v)
                    <span><a href="#">{{ $v->cname }}</a></span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <li>
                    <div class="name"><a href="#">品质蓝色沙发</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 50R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/home_1.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">品质蓝色沙发</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 50R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/home_2.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">品质蓝色沙发</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 50R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/home_3.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">品质蓝色沙发</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 50R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/home_4.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">品质蓝色沙发</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 50R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/home_5.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">品质蓝色沙发</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 50R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/home_6.jpg" width="185" height="155" /></a></div>
                </li>
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="home/images/home_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="#"><img src="home/images/home_b2.jpg" width="260" height="220" /></a></li>
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
                        <li><a href="#"><img src="home/images/tel_r.jpg" width="211" height="286" /></a></li>
                        <li><a href="#"><img src="home/images/tel_r.jpg" width="211" height="286" /></a></li>
                        <li><a href="#"><img src="home/images/tel_r.jpg" width="211" height="286" /></a></li>
                    </ul>
                    <div class="prev_t">上一张</div>
                    <div class="next_t">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    @foreach($floor_1_cates as $k=>$v)
                    <span><a href="#">{{ $v->cname }}</a></span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <li>
                    <div class="name"><a href="#">乐视高清电视</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/tel_1.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">乐视高清电视</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/tel_2.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">乐视高清电视</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/tel_3.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">乐视高清电视</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/tel_4.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">乐视高清电视</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/tel_5.jpg" width="185" height="155" /></a></div>
                </li>
                <li>
                    <div class="name"><a href="#">乐视高清电视</a></div>
                    <div class="price">
                        <font>￥<span>2160.00</span></font> &nbsp; 25R
                    </div>
                    <div class="img"><a href="#"><img src="home/images/tel_6.jpg" width="185" height="155" /></a></div>
                </li>
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="home/images/tel_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="#"><img src="home/images/tel_b2.jpg" width="260" height="220" /></a></li>
            </ul>
        </div>
    </div>    
    <!--End 数码家电 End-->

@endsection
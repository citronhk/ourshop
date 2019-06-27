@extends('home.public.index')
<!-- load css_script  -->
@section('css_script')
    <!--[if IE 6]>
    <script src="/home/js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->   
    <script type="text/javascript" src="/home/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/home/js/menu.js"></script>    
            
    <script type="text/javascript" src="/home/js/lrscroll_1.js"></script>   
     
    
    <script type="text/javascript" src="/home/js/n_nav.js"></script>
    
    <link rel="stylesheet" type="text/css" href="/home/css/ShopShow.css" />
    <link rel="stylesheet" type="text/css" href="/home/css/MagicZoom.css" />
    <script type="text/javascript" src="/home/js/MagicZoom.js"></script>
    
    <script type="text/javascript" src="/home/js/num.js">
        var jq = jQuery.noConflict();
    </script>
        
    <script type="text/javascript" src="/home/js/p_tab.js"></script>
    
    <script type="text/javascript" src="/home/js/shade.js"></script>
    <link type="text/css" rel="stylesheet" href="/home/css/style.css" />
    <link type="text/css" rel="stylesheet" href="/home/css/skill.css" />

@endsection

<!-- 显示商品分类列表 -->
@section('leftNav')
@include('home.public.leftnav')
@endsection

<!-- show content -->
@section('content')
<div class="i_bg">
    <!--Begin Banner Begin-->
    <div class="n_ban">     
        <div class="top_slide_wrap">
            <div class="bx-wrapper" style="max-width: 100%;"><div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 290px;"><ul class="slide_box bxslider" style="width: 515%; position: relative; transition-duration: 0s; transform: translate3d(-3166px, 0px, 0px);"><li style="float: left; list-style: none; position: relative; width: 1583px;" class="bx-clone"><a href="javascript:void(0)" style="background:url(/home/images/n_ban.jpg) no-repeat center top;">banner3</a></li>
                <li style="float: left; list-style: none; position: relative; width: 1583px;"><a href="javascript:void(0)" style="background:url(/home/images/n_ban.jpg) no-repeat center top;">banner1</a></li>
                <li style="float: left; list-style: none; position: relative; width: 1583px;"><a href="javascript:void(0)" style="background:url(/home/images/n_ban.jpg) no-repeat center top;">banner2</a></li>
                <li style="float: left; list-style: none; position: relative; width: 1583px;"><a href="javascript:void(0)" style="background:url(/home/images/n_ban.jpg) no-repeat center top;">banner3</a></li>
            <li style="float: left; list-style: none; position: relative; width: 1583px;" class="bx-clone"><a href="javascript:void(0)" style="background:url(/home/images/n_ban.jpg) no-repeat center top;">banner1</a></li></ul></div><div class="bx-controls bx-has-pager"><div class="bx-pager bx-default-pager"><a href="" data-slide-index="0" class="bx-pager-link"></a><a href="" data-slide-index="1" class="bx-pager-link active"></a><a href="" data-slide-index="2" class="bx-pager-link"></a></div></div></div>  
            <div class="op_btns clearfix">
                <a href="javascript:void(0)" class="op_btn op_prev"><span></span></a>
                <a href="javascript:void(0)" class="op_btn op_next"><span></span></a>
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
    
    <div class="content mar_10">
        <!--Begin 特卖 Begin-->
        <div class="s_left">

            <!-- 商品特卖 开始 -->
            <div class="brand_t">商品特卖</div>

            <ul class="p_sell">
            @foreach($goods_datas as $k=>$v)
                <li>
                    <div class="img"><img src="/uploads/{{$v->pic}}" width="160" height="140"></div>
                    <div class="name">{{$v->gname}}</div>
                    <div class="price">
                        <table border="0" style="width:100%; color:#888888;" cellspacing="0" cellpadding="0">
                          <tbody>
                          <tr style="font-family:'宋体';">
                            <td width="33%">市场价 </td>
                            <td width="33%">折扣</td>
                            <td width="33%">为您节省</td>
                          </tr>
                          <tr>
                            <td style="text-decoration:line-through;">￥{{$v->price}}</td>                   
                            <td>{{$v->discount}}</td>
                            <td>￥{{$v->price*(1-$v->discount)}}</td>
                          </tr>
                        </tbody>
                        </table>
                    </div>
                    <div class="ch_bg">
                        <span class="ch_txt">￥<font>{{$v->price*$v->discount }}</font></span>
                        <a href="/skill/buy?aid={{$aid}}&id={{$v->id}}" class="ch_a on">抢购</a>
                    </div>
                    <div class="times on">活动进行中</div>
                </li>
            @endforeach
            </ul>
            <!-- 商品特卖 结束 -->

        </div>        
        <!--End 特卖 End-->
        
        <div class="s_right">
            <div class="sell_ban">
                <div id="imgPlays">
                    <ul class="imgs" id="actors" style="width: 900px; margin-left: 0px;">
                        <li><a href="javascript:void(0)"><img src="/home/images/tm_ban.jpg" width="300" height="352"></a></li>
                        <li><a href="javascript:void(0)"><img src="/home/images/tm_ban.jpg" width="300" height="352"></a></li>
                        <li><a href="javascript:void(0)"><img src="/home/images/tm_ban.jpg" width="300" height="352"></a></li>
                    </ul>
                    <div class="prev_s">上一张</div>
                    <div class="next_s">下一张</div> 
                </div>   
            </div>
            <div class="sell_tel">
                <table border="0" style="width:280px; margin:15px auto;" cellspacing="0" cellpadding="0">
                  <tbody><tr valign="top">
                    <td width="170"><img src="/home/images/tm_1.png"></td>
                    <td>
                        客服在线时间 <br>
                        每天09:00 - 18:00
                    </td>
                  </tr>
                  <tr valign="top">
                    <td colspan="2" style="padding-left:58px; padding-top:10px;">
                        <span style="color:#ff4e00; font-size:20px;">400-123-4567</span><br>
                        客服热线（免费长途）
                    </td>
                  </tr>
                </tbody></table>
            </div>
            <div class="sell_tel">
                <table border="0" style="width:280px; margin:15px auto;" cellspacing="0" cellpadding="0">
                  <tbody><tr valign="top">
                    <td width="170"><img src="/home/images/tm_2.png"></td>
                    <td>
                        享受VIP专属特权 
                    </td>
                  </tr>
                </tbody></table>
            </div>
            <div class="sell_tel">
                <table border="0" style="width:280px; margin:15px auto;" cellspacing="0" cellpadding="0">
                  <tbody><tr valign="top">
                    <td width="170"><img src="/home/images/tm_3.png"></td>
                    <td>
                        客服在线时间<br>
                        每天09:00 - 18:00
                    </td>
                  </tr>
                </tbody></table>
            </div>
        </div>
    </div>    
</div>
@endsection
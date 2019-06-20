@extends('home.public.index')
<!-- 加载css js -->
@section('css_script')
	<link type="text/css" rel="stylesheet" href="/home/css/style.css" />
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


@endsection

<!-- 显示商品分类列表 -->
@section('leftNav')
 <div class="leftNav none">
    <ul>      
        @foreach($cates_data as $k=>$v)
        <li>
            <div class="fj">
                <span class="n_img"><span></span></span>
               <span class="fl">{{ $v->cname }}</span>
            </div>
               <div class="zj" style="top:{{ $k*-40 }}px;">
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

@section('content')
<div class="i_bg">
    <div class="postion">
        <span class="fl">全部 > 美妆个护 > 香水 > 迪奥 > 迪奥真我香水</span>
    </div>    
    <div class="content">
                            
        <div id="tsShopContainer">
            <div id="tsImgS"><a href="/uploads/{{$goods_data->pic}}" title="Images" class="MagicZoom" id="MagicZoom">
                <img src="/uploads/{{$goods_data->pic}}" width="390" height="390" /></a>
            </div>
         <!--    <div id="tsPicContainer">
                <div id="tsImgSArrL" onclick="tsScrollArrLeft()"></div>
                <div id="tsImgSCon">
                    <ul>
                        <li onclick="showPic(0)" rel="MagicZoom" class="tsSelectImg"><img src="/home/images/ps1.jpg" tsImgS="/home/images/ps1.jpg" width="79" height="79" /></li>
                        <li onclick="showPic(1)" rel="MagicZoom"><img src="/home/images/ps2.jpg" tsImgS="/home/images/ps2.jpg" width="79" height="79" /></li>
                        <li onclick="showPic(2)" rel="MagicZoom"><img src="/home/images/ps3.jpg" tsImgS="/home/images/ps3.jpg" width="79" height="79" /></li>
                        <li onclick="showPic(3)" rel="MagicZoom"><img src="/home/images/ps4.jpg" tsImgS="/home/images/ps4.jpg" width="79" height="79" /></li>
                    </ul>
                </div>
                <div id="tsImgSArrR" onclick="tsScrollArrRight()"></div>
            </div> -->
            <img class="MagicZoomLoading" width="16" height="16" src="/home/images/loading.gif" alt="Loading..." />               
        </div>
        
        <div class="pro_des">
            <div class="des_name">
                <p>{{$goods_data->gname}}</p>
                “开业巨惠，北京专柜直供”，不光低价，“真”才靠谱！
            </div>
            <div class="des_price">
                本店价格：<b>￥{{$goods_data->price}}</b><br />
                消费积分：<span>28R</span>
            </div>
            <div class="des_choice">
                <span class="fl">型号选择：</span>
                <ul>
                    <li class="checked">30ml<div class="ch_img"></div></li>
                    <li>50ml<div class="ch_img"></div></li>
                    <li>100ml<div class="ch_img"></div></li>
                </ul>
            </div>
            <div class="des_choice">
                <span class="fl">颜色选择：</span>
                <ul>
                    <li>红色<div class="ch_img"></div></li>
                    <li class="checked">白色<div class="ch_img"></div></li>
                    <li>黑色<div class="ch_img"></div></li>
                </ul>
            </div>
            <div class="des_share">
                <div class="d_sh">
                    分享
                    <div class="d_sh_bg">
                        <a href="#"><img src="/home/images/sh_1.gif" /></a>
                        <a href="#"><img src="/home/images/sh_2.gif" /></a>
                        <a href="#"><img src="/home/images/sh_3.gif" /></a>
                        <a href="#"><img src="/home/images/sh_4.gif" /></a>
                        <a href="#"><img src="/home/images/sh_5.gif" /></a>
                    </div>
                </div>
                <div class="d_care"><a  onclick="addColl({{$goods_data->id}})">关注商品</a></div>
            </div>
            <div class="des_join">
                    <div class="j_nums">
                            
                            <input type="text" value="1" id="num" name="num" class="n_ipt" />
                            <input type="button" value="" onclick="addUpdate(jq(this));" class="n_btn_1" />
                            <input type="button" value="" onclick="jianUpdate(jq(this));" class="n_btn_2" />   
                        </div>
                        <!-- onclick="ShowDiv_1('MyDiv1','fade1') -->
                        <span class="fl">
                            <button onclick="AddCar({{ $goods_data->id}});" style="width:180px; height:45px;padding:0;border:0;"><img src="/home/images/j_car.png" /></button>
                        </span>
                    </div>   

                    <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
                    <script type="text/javascript">
                        function AddCar(id)
                        {
                            // action="/home/goods/addCar"

                            // 获取当前选购商品id
                            // let id = $("#gid").val()
                            //获取当前选购商品数量
                            let num = $("#num").val()

                            $.get('/home/goods/addCar',{id,num},function(msg){
                                if(msg.msg == 'success'){
                                   
                                    ShowDiv_1('MyDiv1','fade1');
                                  }else{
                                    
                                  }
                            },'json');
                        }


                        function addColl(id)
                        {
                            $.get('/home/goods/addColl',{id},function(msg){
                                if(msg.msg == 'success'){
                                    ShowDiv('MyDiv','fade');
                                  }else if(msg.msg == 'alreadly'){
                                     $("#tips").html('已经加入收藏夹');
                                     ShowDiv('MyDiv','fade');
                                  }else{

                                  }
                            },'json');
                        }
                    </script>
        </div>    
        
    
     <!--Begin 弹出层-收藏成功 Begin-->
    <div id="fade" class="black_overlay"></div>
    <div id="MyDiv" class="white_content">             
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyDiv','fade')"><img src="/home/images/close.gif" /></span>
            </div>
            <div class="notice_c">
                
                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="40"><img src="/home/images/suc.png" /></td>
                    <td>
                        <span id="tips" style="color:#3e3e3e; font-size:18px; font-weight:bold;">您已成功收藏该商品</span><br />
                        <a href="#">查看我的关注 >></a>
                    </td>
                  </tr>
                  <tr height="50" valign="bottom">
                    <td>&nbsp;</td>
                    <td><a onclick="CloseDiv('MyDiv','fade')" class="b_sure" >确定</a></td>
                  </tr>
                </table>
                    
            </div>
        </div>
    </div>    
    <!--End 弹出层-收藏成功 End-->
    
    
    <!--Begin 弹出层-加入购物车 Begin-->
    <div id="fade1" class="black_overlay"></div>
    <div id="MyDiv1" class="white_content">             
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv_1('MyDiv1','fade1')"><img src="/home/images/close.gif" /></span>
            </div>
            <div class="notice_c">
                
                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="40"><img src="/home/images/suc.png" /></td>
                    <td>
                        <span style="color:#3e3e3e; font-size:18px; font-weight:bold;">宝贝已成功添加到购物车</span><br />
                        <!-- 购物车共有1种宝贝（3件） &nbsp; &nbsp; 合计：1120元 -->
                    </td>
                  </tr>
                  <tr height="50" valign="bottom">
                    <td>&nbsp;</td>
                    <td><a href="/" class="b_sure">去购物车结算</a><a onclick="CloseDiv_1('MyDiv1','fade1')" class="b_buy">确认</a></td>
                  </tr>
                </table>
                    
            </div>
        </div>
    </div>    
    <!--End 弹出层-加入购物车 End-->
    

        <div class="s_brand">
            <div class="s_brand_img"><img src="/home/images/sbrand.jpg" width="188" height="132" /></div>
            <div class="s_brand_c"><a href="#">进入品牌专区</a></div>
        </div>    
        
        
    </div>
    <div class="content mar_20">
        <div class="l_history">
            <div class="fav_t">用户还喜欢</div>
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
            <div class="des_border">
                <div class="des_tit">
                    <ul>
                        <li class="current"><a href="#p_attribute">商品属性</a></li>
                        <li><a href="#p_details">商品详情</a></li>
                        <li><a href="#p_comment">商品评论</a></li>
                    </ul>
                </div>
                <div class="des_con" id="p_attribute">
                    
                    <table border="0" align="center" style="width:100%; font-family:'宋体'; margin:10px auto;" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>商品名称：迪奥香水</td>
                        <td>商品编号：1546211</td>
                        <td>品牌： 迪奥（Dior）</td>
                        <td>上架时间：2015-09-06 09:19:09 </td>
                      </tr>
                      <tr>
                        <td>商品毛重：160.00g</td>
                        <td>商品产地：法国</td>
                        <td>香调：果香调香型：淡香水/香露EDT</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>容量：1ml-15ml </td>
                        <td>类型：女士香水，Q版香水，组合套装</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>                                               
                                            
                        
                </div>
            </div>  
            
            <div class="des_border" id="p_details">
                <div class="des_t">商品详情</div>
                <div class="des_con">
                    <table border="0" align="center" style="width:745px; font-size:14px; font-family:'宋体';" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="265"><img src="/home/images/de1.jpg" width="206" height="412" /></td>
                        <td>
                            <b>迪奥真我香水(Q版)</b><br />
                            【商品规格】：5ml<br />
                            【商品质地】：液体<br />
                            【商品日期】：与专柜同步更新<br />
                            【商品产地】：法国<br />
                            【商品包装】：无外盒 无塑封<br />
                            【商品香调】：花束花香调<br />
                            【适用人群】：适合女性（都市白领，性感，有女人味的成熟女性）<br />
                        </td>
                      </tr>
                    </table>
                    
                    <p align="center">
                    <img src="/home/images/de2.jpg" width="746" height="425" /><br /><br />
                    <img src="/home/images/de3.jpg" width="750" height="417" /><br /><br />
                    <img src="/home/images/de4.jpg" width="750" height="409" /><br /><br />
                    <img src="/home/images/de5.jpg" width="750" height="409" />
                    </p>
                    
                </div>
            </div>  
            
            <div class="des_border" id="p_comment">
                <div class="des_t">商品评论</div>
                
                <table border="0" class="jud_tab" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="175" class="jud_per">
                        <p>80.0%</p>好评度
                    </td>
                    <td width="300">
                        <table border="0" style="width:100%;" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="90">好评<font color="#999999">（80%）</font></td>
                            <td><img src="/home/images/pl.gif" align="absmiddle" /></td>
                          </tr>
                          <tr>
                            <td>中评<font color="#999999">（20%）</font></td>
                            <td><img src="/home/images/pl.gif" align="absmiddle" /></td>
                          </tr>
                          <tr>
                            <td>差评<font color="#999999">（0%）</font></td>
                            <td><img src="/home/images/pl.gif" align="absmiddle" /></td>
                          </tr>
                        </table>
                    </td>
                    <td width="185" class="jud_bg">
                        购买过雅诗兰黛第六代特润精华露50ml的顾客，在收到商品才可以对该商品发表评论
                    </td>
                    <td class="jud_bg">您可对已购买商品进行评价<br /><a href="#"><img src="/home/images/btn_jud.gif" /></a></td>
                  </tr>
                </table>
                
                
                                
                <table border="0" class="jud_list" style="width:100%; margin-top:30px;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="160"><img src="/home/images/peo1.jpg" width="20" height="20" align="absmiddle" />&nbsp;向死而生</td>
                    <td width="180">
                        颜色分类：<font color="#999999">粉色</font> <br />
                        型号：<font color="#999999">50ml</font>
                    </td>
                    <td>
                        产品很好，香味很喜欢，必须给赞。 <br />
                        <font color="#999999">2015-09-24</font>
                    </td>
                  </tr>
                  <tr valign="top">
                    <td width="160"><img src="/home/images/peo2.jpg" width="20" height="20" align="absmiddle" />&nbsp;就是这么想的</td>
                    <td width="180">
                        颜色分类：<font color="#999999">粉色</font> <br />
                        型号：<font color="#999999">50ml</font>
                    </td>
                    <td>
                        送朋友，她很喜欢，大爱。 <br />
                        <font color="#999999">2015-09-24</font>
                    </td>
                  </tr>
                  <tr valign="top">
                    <td width="160"><img src="/home/images/peo3.jpg" width="20" height="20" align="absmiddle" />&nbsp;墨镜墨镜</td>
                    <td width="180">
                        颜色分类：<font color="#999999">粉色</font> <br />
                        型号：<font color="#999999">50ml</font>
                    </td>
                    <td>
                        大家都说不错<br />
                        <font color="#999999">2015-09-24</font>
                    </td>
                  </tr>
                  <tr valign="top">
                    <td width="160"><img src="/home/images/peo4.jpg" width="20" height="20" align="absmiddle" />&nbsp;那*****洋 <br /><font color="#999999">（匿名用户）</font></td>
                    <td width="180">
                        颜色分类：<font color="#999999">粉色</font> <br />
                        型号：<font color="#999999">50ml</font>
                    </td>
                    <td>
                        下次还会来买，推荐。<br />
                        <font color="#999999">2015-09-24</font>
                    </td>
                  </tr>
                </table>

                    
                    
                <div class="pages">
                    <a href="#" class="p_pre">上一页</a><a href="#" class="cur">1</a><a href="#">2</a><a href="#">3</a>...<a href="#">20</a><a href="#" class="p_pre">下一页</a>
                </div>
                
            </div>
            
            
        </div>
    </div>
    
    
   
    
    
    
   
<script src="/home/js/ShopShow.js"></script>
@endsection
@extends('home.public.index')
<!-- 加载css js -->
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
    
@endsection

<!-- 显示商品分类列表 -->
@section('leftNav')
@include('home.public.leftnav')
@endsection

@section('content')
<div class="i_bg">
    <div class="postion">
        <span class="fl">全部 > 美妆个护 > 香水 > 迪奥 > 迪奥真我香水</span>
    </div>    
    <div class="content">
                            
        <div id="tsShopContainer">
            <div id="tsImgS"><a href="/uploads/{{$goods_attr['pic']}}" title="Images" class="MagicZoom" id="MagicZoom">
                <img src="/uploads/{{$goods_attr['pic']}}" width="390" height="390" /></a>
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
            <!-- <img class="MagicZoomLoading" width="16" height="16" src="/home/images/loading.gif" alt="Loading..." /> -->               
        </div>
        
        <div class="pro_des">
            <div class="des_name">
                <p>{{$goods_attr['gname']}}</p>
                “开业巨惠，北京专柜直供”，不光低价，“真”才靠谱！
            </div>
            <div class="des_price">
                本店价格：<b>￥{{$goods_attr['price']}}</b><br />
                消费积分：<span>28R</span>
            </div>
       <!--      <div class="des_choice">
                <span class="fl">型号选择：</span>
                <ul>
                    <li class="checked">30ml<div class="ch_img"></div></li>
                    <li>50ml<div class="ch_img"></div></li>
                    <li>100ml<div class="ch_img"></div></li>
                </ul>
            </div> -->
           <!--  <div class="des_choice">
                <span class="fl">颜色选择：</span>
                <ul>
                    <li>红色<div class="ch_img"></div></li>
                    <li class="checked">白色<div class="ch_img"></div></li>
                    <li>黑色<div class="ch_img"></div></li>
                </ul>
            </div> -->
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
                <div class="d_care"><a  onclick="addColl({{$goods_attr['id']}})">关注商品</a></div>
            </div>
            <div class="des_join">
                    @if($aid == 0)
                        <div class="j_nums">
                            <input type="hidden" name="aid" value="{{$id}}">
                            <input type="hidden" name="gid" value="{{$id}}">
                            <input type="text" value="1" id="num" name="num" class="n_ipt" />

                            <input type="button" value="" onclick="addUpdate(jq(this));"  class="n_btn_1" />
                            <input type="button" value="" onclick="jianUpdate(jq(this));" class="n_btn_2" />  
                        </div>
                            <!-- onclick="ShowDiv_1('MyDiv1','fade1') -->
                        <span class="fl">
                                <button onclick="AddCar({{ $goods_attr['id']}});" style="width:180px; height:45px;padding:0;border:0;"><img src="/home/images/j_car.png" /></button>
                        </span>
                    @else
                        <form action="home/car/seckills" method="get">
                            <div class="j_nums">
                                    <input type="hidden" name="aid" value="{{$id}}">
                                    <input type="hidden" name="gid" value="{{$id}}">
                                    <input type="text" value="1" id="num" name="num" class="n_ipt" />

                                    <input type="button" value="" onclick="addUpdate(jq(this));"  class="n_btn_1" />
                                    <input type="button" value="" onclick="jianUpdate(jq(this));" class="n_btn_2" />  
                            </div>
                            <!-- onclick="ShowDiv_1('MyDiv1','fade1') -->
                            <span class="fl">
                                    <button type="submit"  style="width:180px; height:45px;padding:0;border:0; background-color:#f54e04; font-size:18px;color:#fff;">立即抢购</button>
                            </span>
                        </form>
                    @endif
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
            @foreach($like_goods_data as $k=>$v)
                <li>
                    <div class="img"><a href="#"><img src="/uploads/{{$v->pic}}" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">{{$v->gname}}</a></div>
                    <div class="price">
                        <font>￥<span>{{$v->price}}</span></font> &nbsp; 18R
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="l_list">            
            <div class="des_border">
                <div class="des_tit">
                    <ul>
                        <li class="current"><a href="#p_attribute">商品属性</a></li>
                        <li><a href="#p_details">商品图片</a></li>
                        <li><a href="#p_comment">商品评论</a></li>
                    </ul>
                </div>
                <div class="des_con" id="p_attribute">
                    
                    <table border="0" align="center" style="width:100%; font-family:'宋体'; margin:10px auto;" cellspacing="0" cellpadding="0">
    
                        <tr>
                            <td >
                                商品名称:{{$goods_attr['gname']}}
                            </td>
                        </tr>
                        <tr>
                            <td >
                                品牌:{{$goods_attr['brand']}}
                            </td>
                        </tr>
                        <tr>
                            <td >
                                产品重量:{{$goods_attr['weight']}}
                            </td>
                        </tr>
                        <tr>
                            <td >
                                产地:{{$goods_attr['origin']}}
                            </td>
                        </tr>
                        <tr>
                            <td >
                                上架时间:{{$goods_attr['created_at']}} 
                            </td>
                        </tr>

                    </table>                                               
                                            
                        
                </div>
            </div>  
            
            <div class="des_border" id="p_details">
                <div class="des_t">商品图片</div>
                <div class="des_con">
                    <table border="0" align="center" style="width:745px; font-size:14px; font-family:'宋体';" cellspacing="0" cellpadding="0">
                  
                    </table>
                    
                    <p align="center">
                        @foreach($goods_photo as $k=>$v)
                            <img src="/uploads/{{$v->profile}}" width="746" height="425" /><br /><br />
                        @endforeach
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
                    <td width="185" class="jud_bg">对已购买商品用户可进行评价</td>
                    <td class="jud_bg"><br />
                        @if($result)
                            <button id="com" class="btn btn_enable" onclick="show()">我要评论</button>
                        @else
                            <button id="com" class="btn">我要评论</button>
                        @endif
                    </td>
                  </tr>
                </table>
                <!-- 评论区开始 -->
                <div id="combox" class="hide">
                    <input id="comment" type="text" value="" placeholder="请输入评论内容.....">
                    <button id="sub" class="btn btn_enable" onclick="publish({{$goods_attr['id']}})">提交</button>

                </div>
                <script type="text/javascript">

                    function show()
                    {
                        $('#combox').addClass('show');
                    }



                    function publish(id)
                    {
                        let content = $('#comment').val();
                        let html = '';

                        if(content == ''){return;}
                        $.get('/home/detail/publish',{id:id,content:content},function(msg){
                            if(msg.msg == 'success'){
                                html = '<tr valign="top">';
                                html += '<td width="160">';
                                html +='<img src="/home/images/peo1.jpg" width="20" height="20" align="absmiddle" />&nbsp;';
                                html += '{{$goods_attr["gname"]}}</td><td width="180"><font >';
                                html += content +'</font>';
                                html += '</td><td><font  color="#999999">';
                                html += getTime()+'</font></td></tr>';
                                $('#com_list').prepend(html);
                                $('#comment').val('');
                            }else{
                                $('#tip_fail').html(msg.info);
                                ShowDiv('Fail','fail');
                                return;
                            }
                           
                        },'json');
                    }


                    //获取当前时间
                    function getTime()
                    {
                        var time = '';
                        var now = new Date();
                        var Y = now.getFullYear();
                        var m = now.getMonth()+1;
                        var d = now.getDate();
                        var H = now.getHours();
                        var i = now.getMinutes();
                        var s = now.getSeconds();
                        time = Y + '-' + m + '-' + d + ' '+ H +':'+ i +':'+ s;
                        return time;
                    }

                    </script>

                    <style>
                        #combox{
                            width: 905px;
                            margin: 10px 20px;
                        }
                        
                        .btn{
                             border: 0;
                            width: 120px;
                            height: 34px;
                            padding: 0;
                            color: #fff;
                            outline: none;

                        }
                        .btn_enable{

                            background-color: #ff3200;
                        }

                 
                        #sub{
                            margin-right: 4px;
                            margin-top: 10px;
                            float: right;

                        }
                        #comment{
                            height: 40px;
                            width: 900px;
                            border: 1px solid #eaeaea;
                            outline: none;
                            
                        }

                        .hide{
                            display: none;
                        }

                        .show{
                            display: block;
                        }
                    </style>
                <!-- 评论区结束 -->
                <!-- 评论列表 -->
                <table id="com_list" border="0" class="jud_list" style="width:100%; margin-top:30px;" cellspacing="0" cellpadding="0">

                @foreach($comment_data as $k=>$v)
                  <tr valign="top">
                    <td width="160"><img src="/home/images/peo1.jpg" width="20" height="20" align="absmiddle" />&nbsp;name</td>
                    <td width="180">
                        <font >{{$v->content}}</font>
                    </td>
                    <td>
                        <font  color="#999999">{{$v->created_at}}</font>
                    </td>
                  </tr>
                @endforeach

                </table>

                    
             <!--        
                <div class="pages">
                    <a href="#" class="p_pre">上一页</a><a href="#" class="cur">1</a><a href="#">2</a><a href="#">3</a>...<a href="#">20</a><a href="#" class="p_pre">下一页</a>
                </div> -->
                <!-- <div id="pag" style="text-align:center;"> $comment_data->links() </div> -->
            </div>
            
            
        </div>
    </div>

 <!--Begin 弹出层-评论失败 Begin-->
    <div id="fail" class="black_overlay"></div>
    <div id="Fail" class="white_content">             
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('Fail','fail')"><img src="/home/images/close.gif" /></span>
            </div>
            <div class="notice_c">
                
                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="40"><img src="/home/images/suc.png" /></td>
                    <td>
                        <span id="tip_fail" style="color:#3e3e3e; font-size:18px; font-weight:bold;"></span><br />
                    </td>
                  </tr>
                  <tr height="50" valign="bottom">
                    <td>&nbsp;</td>
                    <td><a onclick="CloseDiv('Fail','fail')" class="b_sure" >确定</a></td>
                  </tr>
                </table>
                    
            </div>
        </div>
    </div>    
    <!--End 弹出层-收藏成功 End-->
<script src="/home/js/ShopShow.js"></script>
@endsection


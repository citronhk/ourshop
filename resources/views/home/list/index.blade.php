@extends('home.public.index')

@section('css_script')
    <!--[if IE 6]>
    <script src="js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->
    
    <script type="text/javascript" src="/home/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/home/js/menu.js"></script>    
            
    <script type="text/javascript" src="/home/js/lrscroll_1.js"></script>
    <script type="text/javascript" src="/home/js/n_nav.js"></script>
    <link type='text/css' rel='stylesheet' href="/home/css/bootstrap.css"  />
    <link type="text/css" rel="stylesheet" href="/home/css/style.css" />
@endsection

<!-- 显示商品分类列表 -->
@section('leftNav')
@include('home.public.leftnav')
@endsection

@section('content')

<div class="i_bg">
	<div class="postion">
    	<span class="fl"></span>
    </div>
    <div class="content mar_20">
    	<div class="l_history">
        	<div class="his_t">
            	<span class="fl">热卖商品</span>
                <span class="fr"><a href="#"></a></span>
            </div>
        	<ul>
                @foreach($record_data as $k=>$v)
            	<li>
                    <div class="img"><a href="/home/detail?&id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="185" height="162" /></a></div>
                	<div class="name"><a href="/home/detail?&id={{$v->id}}">{{$v->gname}}</a></div>
                    <div class="price">
                    	<font>￥<span>{{$v->price}}</span></font> &nbsp; 
                    </div>
                </li>
                @endforeach
        	</ul>
        </div>
        <div class="l_list">
            <!-- 商品列表 开始 -->
            <div class="list_c">
                <ul class="cate_list">
                    @foreach($goods_datas as $k=>$v)
                	<li>
                    	<div class="img"><a href="/home/detail?tid=0&id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="210" height="185" /></a></div>
                        <div class="price">
                            <font>￥<span>{{$v->price}}</span></font> &nbsp;
                        </div>
                        <div class="name"><a href="/home/detail?tid=0&id={{$v->id}}">{{$v->gname}}</a></div>
                        <div class="carbg">
                        	<a href="#" class="ss">收藏</a>
                            <a href="#" class="j_car">加入购物车</a>
                        </div>  
                    </li>
                    @endforeach
                </ul>
                
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
@extends('home.public.share')
@section('main')

            <p></p>
            <div class="mem_tit">
            	<span class="fr" style="font-size:12px; color:#55555; font-family:'宋体'; margin-top:5px;">共发现{{count($temp)}}件</span>足迹
            </div>
           	<table border="0" class="order_tab" style="width:930px;" cellspacing="0" cellpadding="0">
              <tr>                                                                                                                                       
                <td align="center" width="420">商品名称</td>
                <td align="center" width="180">价格</td>
                <td align="center" width="270">操作</td>
            @foreach($temp as $k=>$v)
              <tr>
                <td style="font-family:'宋体';">
                	<div class="sm_img"><a href="/home/detail?id={{$v->id}}"><img src="/uploads/{{$v->pic}}" width="48" height="48" /></a></div>{{$v->gname}}
                </td>
                <td align="center">￥{{$v->price}}</td>
                <td align="center">&nbsp; &nbsp; <a href="#" style="color:#ff4e00;">加入购物车</a>&nbsp; &nbsp; <a href="#">删除</a></td>
              </tr>
            @endforeach
            </table>
        
@endsection
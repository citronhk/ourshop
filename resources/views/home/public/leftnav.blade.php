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
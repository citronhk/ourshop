@extends('home.public.share')
@section('main')
  <script type="text/javascript" src="/registers/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/registers/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script type="text/javascript" src="/registers/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
            @if(session('success'))
              <div class="bs-example" data-example-id="dismissible-alert-css">
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <strong>{{ session('success') }}</strong> 
                </div>
              </div>
            @endif


            @if(session('error'))
            <div class="bs-example" data-example-id="dismissible-alert-css">
                <div class="alert alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <strong>{{ session('error') }}</strong> 
                </div>
              </div>
            @endif
     <div class="mem_tit">收货地址</div>
     @foreach($addrs as $k=>$v)
			<div class="address">
            
            	<table border="0" class="add_t" align="center" style="width:98%; margin:10px auto;" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2" style="font-size:14px; color:#ff4e00;">{{ $v->addr_name }}</td>
                  </tr>
                  <tr>
                    <td align="right" width="120">收货人姓名：</td>
                    <td>{{ $v->order_name }}</td>
                  </tr>
                 
                  <tr>
                    <td align="right">详细地址：</td>
                    <td>{{ $v->order_addr }}</td>
                  </tr>
                  <tr>
                    <td align="right">手机：</td>
                    <td>{{ $v->phone }}</td>
                  </tr>
                  <tr>
                    <td align="right">电话：</td>
                    <td>0754-{{ $v->telephone }}</td>
                  </tr>
                  <tr>
                    <td align="right">电子邮箱：</td>
                    <td>{{ $v->email }}</td>
                  </tr>
                   <p align="right" style="position: absolute; top: 180px;right: 30px">
                    @if($v->status == 0)
                    <a href="/home/addr/changestatus/{{$v->id}}" style="color:#ff4e00;">设为默认</a>&nbsp; &nbsp; &nbsp; &nbsp;
                    @endif
                    <a href="/home/addr/{{$v->id}}/edit" style="color:#ff4e00;">编辑</a>&nbsp; &nbsp; &nbsp; &nbsp; 
                    <a onclick="del({{ $v->id }} ,this)" style="color:#ff4e00;">删除</a>&nbsp; &nbsp; &nbsp; &nbsp; 
                  </p>
                </table>
				
               
     </div>
     @endforeach
     <div style="text-align: center;">
            {{ $addrs->links() }}
     </div>
     <div class="mem_tit">
    	 <a href="/home/addr/create"><img src="images/add_ad.gif" /></a>
     </div>
     <script type="text/javascript">
                    function del(id,obj){
                      if(!window.confirm('你确定要删除吗?')){
                          return false;
                        }
                      $.post('/home/addr/'+id,{'_method':'DELETE','_token':'{{ csrf_token() }}'},(res)=>{
                        if(res.msg == 'ok'){
                          $(obj).parent().parent().remove();
                          alert(res.info);
                        }
                      },'json');
                    }
                </script>
@endsection
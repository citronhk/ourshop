function addColl(id)
{
    $.get('/home/goods/addColl',{id},function(msg){
        if(msg.msg == 'success'){
            ShowDiv('MyDiv','fade');
          }else if(msg.msg == 'alreadly'){
             $("#tips").html('已经加入收藏夹');
             ShowDiv('MyDiv','fade');
          }else if(msg.msg == 'login'){
             window.location.href="/home/login";
          }else{
            
        }
    },'json');
}


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
          }else if(msg.msg == 'login'){
             window.location.href="/home/login";
          }else{
            
          }
    },'json');
}


//评论区
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





<link rel="stylesheet" href="/www/h-ui/js/skin/layer.css" id="layui_layer_skinlayercss" style="">
<script type="text/javascript" src="/www/js/lib/Validform.min.js"></script>
<script type="text/javascript" src="/www/js/Switch/bootstrapSwitch.js"></script>

<title>管理会员</title>


<body>

<nav class="breadcrumb"> <i class="Hui-iconfont"></i> 首页 <span class="c-gray en">&gt;</span> 管理会员 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont"></i></a></nav>

<div class="page-container">
    <div class="text-c"> 
        <form method="get">

            <input type="hidden" value="admin" name="action">
            <input type="text" class="input-text" style="width:250px" placeholder="输入登录名" name="fenqu" value="">
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont"></i> 搜用户</button>

        </form>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" onclick="admin_add('添加用户','/admin/adminadd','','510')" class="btn btn-primary radius"><i class="Hui-iconfont"></i> 添加用户</a></span> <span class="r">共有数据：<strong id="tiaoshu">1</strong> </span> </div>
    <div class="mt-20">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
            <tr class="text-c">
                
                <th width="40">ID</th>
                <th width="300">登录名</th>
                
                <th>角色</th>
                <th width="130">IP</th>
                <th width="130">时间</th>
                
                <th width="100">是否启用</th>
                <th width="100">操作</th>
            </tr>
        </thead>
        <tbody>


            <tr class="text-c">
                
                <td>1</td>
                <td>admin</td>
                <td>创始人</td>
                <td></td>
                <td>1970-01-01 08:00:00</td>
                <td class="td-status"> 
                
                 

                       <span class="label label-success radius"> 已开启 </span>

                                
                </td>

                <td class="td-manage">
                
                
                <a style="text-decoration:none" onclick="admin_stop(this,'1')" href="javascript:;" title="开启">

                <i class="Hui-iconfont">

                     
                </i>
                
                </a>
                
                <a title="编辑" href="javascript:;" onclick="admin_edit('编辑','?action=admin&amp;mode=edit&amp;id=1','1','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont"></i></a> 
                
                <a title="删除" href="javascript:;" onclick="admin_del(this,1)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont"></i>
                
                </a></td>
            </tr>



        </tbody>
    </table>
    </div>
</div>

<div class="page">

   
</div>

<a href="javascript:void(0)" class="Hui-iconfont toTop" title="返回顶部" alt="返回顶部" style="display:none"></a> 





</body>
<script>

function suijishu(){

    return  Date.parse(new Date()) / 1000+''+Math.floor(Math.random()*10000+1);
}


var updatedurl='/admin.php?action=admin&mode=edit&uplx=image&dir=image';

function zengjia( id , k , caidan ){

          if(typeof i === 'undefined') i= 1;
         
          i = i+1;

          html = '<div id="d'+id+i+'" data="'+id+'" style="margin-top:5px;">';

          fass =  caidan.split(',');
          

            for(var w in fass){


                if(fass[w].indexOf( 'update-') > -1 ){

                    tazhi =w+'a'+(i+100)+'b';

                    html +=fass[w]+':<input type="text" class="input-text" style="width:208px;margin-right:2px;"  value="" id="imgshowac'+tazhi+'"  placeholder="" name="'+k+'['+(i+100)+']['+( fass[w] )+']" > <input type="button" id="filePicker'+tazhi+'"  value="update"  /><script>KindEditor.ready(function(K) {    var uploadbuttonac'+tazhi+' = K.uploadbutton({  button : K("#filePicker'+tazhi+'")[0], fieldName : "all",  url : "/admin.php?action=admin&mode=edit&uplx=all",afterUpload : function(data) { if ( data.error === 0) {var url = K.formatUrl(data.url, "absolute");  K("#imgshowac'+tazhi+'").val(url);}else{  layer.msg(data.message, { time: 2000 });}}, afterError : function( str ) {layer.msg(str, { time: 2000,  }); }});uploadbuttonac'+tazhi+'.fileBox.change(function(e) {uploadbuttonac'+tazhi+'.submit();}); });<\/script>';

                }else{

                    html +=fass[w]+': <input type="text" class="input-text" style="width:208px;margin-right:2px;" name="'+k+'['+(i+100)+']['+( fass[w] )+']" value="">';

                }

           
           }

        html += '<a style="color:Red;" href="javascript:shanchuduo(\''+'d'+id+i+'\')"> <i class="Hui-iconfont"  style="color:red;">&#xe6a1;</i> </a></div>';



        $(".qujicplist"+id). append( html );


}



function shanchuduo( id ){


          
         

          var tname = $("#"+id).attr('data');
           $("#"+id).remove();


          var cd =  $(".qujicplist"+tname+' div').length;
          

          if(cd < 1){
          
            href= $(".qujicplist"+tname+" + a").attr('href') ;
            eval(href);
          
          }


         

          


}

function deltc(id){

            var news  = $("#picddel"+id).find('input').attr('name');


                    $("#picddel"+id).remove();

                    if(  $("#picddel"+id).length < 1){

                         $("#yingxianss").html("<input type='hidden' name='"+news+"'>");

                    }
}

if( typeof  KindEditor !=='undefined' ){

 KindEditor.ready(function(K) { 

                   var editor = K.editor({
                    allowFileManager : false,
                    filePostName : 'all',
                      
                });
});

}

</script>



<script type="text/javascript">
var LX = 0;


$(function(){

 

 $("#form-admin-role-add" ).Validform( { tiptype:2 });



});





var token ='1cd22e49092fe211d43aafc496715a1e';

function admin_add(title ,url ,w ,h){

         layer_show(title ,url ,w ,h);

}

function admin_del(obj,id){

        layer.confirm('删除须谨慎，确认要删除吗？',{title:'操作提示',btn:["YES","NO"]},function(index){
          
              $.getJSON('?action=admin&mode=del&ajson=1&token=' + token + '&id='+id,{},function(data){

                  if(data.token) token = data.token;
              
                  if(data.code == 1){

                       $(obj).parents("tr").remove();

                       shu = $("#tiaoshu").html() *1;

                       $("#tiaoshu").html( shu -1 );

                       layer.msg('已删除! ',{icon:1,time:1000});

                  }else  layer.msg( data.msg ,{ icon: 2 ,time : 1000});

              });

        });
}

function admin_edit(title,url,id,w,h){

         layer_show( title, url, w, h);
}


function admin_stop(obj,id){

         layer.confirm( '确认要关闭吗？',{title:'操作提示',btn:["YES","NO"]}, function( index){

           $.getJSON('?action=admin&mode=edit&ajson=1&token=' + token + '&id='+id,{},function(data){

                 if(data.token) token = data.token;
                
                 if(data.code == 1){

                     $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,'+id+')" href="javascript:;" title="开启" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');

                    $(obj).parents( "tr").find( ".td-status").html( '<span class="label radius">已关闭</span>');

                    $(obj).remove();

                    layer.msg( '已关闭!',{ icon: 5 ,time : 1000});
                
                 }else layer.msg( data.msg ,{ icon: 2 ,time : 1000});

           });

       });
}


function admin_start(obj,id){

    layer.confirm( '确认要开启吗？',{title:'操作提示',btn:["YES","NO"]},function( index){

        $.getJSON('?action=admin&mode=edit&ajson=1&token=' + token + '&id='+id,{},function(data){

             if( data.token ) token = data.token;

             if( data.code == 1){

                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,'+id+')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');

                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已开启</span>');

                    $(obj).remove();

                    layer.msg( '已开启!' , {icon: 6 , time : 1000});


             }else   layer.msg(  data.msg ,{ icon: 2 ,time : 1000});
         
       });
   });
}
</script>


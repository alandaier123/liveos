<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Cache-Control" content="no-siteapp">

<link rel="stylesheet" type="text/css" href="/www/h-ui/css/H-ui.min.css">
<link rel="stylesheet" type="text/css" href="/www/h-ui/css/H-ui.admin.css">
<link rel="stylesheet" type="text/css" href="/www/js/Hui-iconfont/1.0.7/iconfont.css">
<link rel="stylesheet" type="text/css" href="/www/h-ui/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="/www/h-ui/skin/blue/skin.css" id="skin">
<link rel="stylesheet" type="text/css" href="/www/h-ui/css/style.css">


<title>管理会员</title>
</head>
<body>

<link rel="stylesheet" type="text/css" href="/www/h-ui/js/skin/layer.css" id="layui_layer_skinlayercss" style="">
<link rel="stylesheet" type="text/css" href="/www/js/Switch/bootstrapSwitch.css">
<style>
.yddddd{margin-top:3px;display:block;}
</style>

<script type="text/javascript" src="/www/js/jquery.min.js"></script> 
<script type="text/javascript" src="/www/h-ui/js/layer.js"></script> 
<script type="text/javascript" src="/www/h-ui/js/H-ui.js"></script>

<script type="text/javascript" src="/www/h-ui/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/www/js/lib/Validform.min.js"></script>
<script type="text/javascript" src="/www/js/Switch/bootstrapSwitch.js"></script>

<article class="page-container">
    <form method="post" class="form form-horizontal" id="form-admin-role-add">
          <input type="hidden" name="token" value="7c9ddfcd0560bc4da671319cd6cd23d7">


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>登录名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" name="name" datatype="*" nullmsg=" ">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">登录密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="为空不修改" name="pass">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">超级密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="为空不修改" name="epass">
            </div>
        </div>


  <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"> 用户状态：</label>
            <div class="formControls col-xs-8 col-sm-9">

             <div class="switch"  data-on-label=" 已开启  " data-off-label=" 已关闭 " >
                  <input type="checkbox"    name="off"/>
             </div>
  

            </div>
        </div>


  <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">  效验登录IP：</label>
            <div class="formControls col-xs-8 col-sm-9">

             <div class="switch"  data-on-label=" 已开启 " data-off-label=" 已关闭 " >
                  <input type="checkbox"     name="yanzhengip"/>
             </div>
  

            </div>
        </div>





        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户权限：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <select name="type" class="select" size="1"> <option value="0">创始人</option></select>
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"> IP：</label>
            <div class="formControls col-xs-8 col-sm-9">
               <span class="yddddd">127.0.0.1</span>
                
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">时间：</label>
            <div class="formControls col-xs-8 col-sm-9">

               <span class="yddddd"> 2020-06-06 21:19:24</span>
                
            </div>
        </div>



        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" name="submit" type="submit" value="&nbsp;&nbsp;编辑&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</article>
  
                    

<a href="javascript:void(0)" class="Hui-iconfont toTop" title="返回顶部" alt="返回顶部" style="display:none"></a>         
 




<script type="text/javascript">
var LX = 0;


$(function(){

 

 $("#form-admin-role-add" ).Validform( { tiptype:2 });



});





var token ='9f51e9974205fb73870abd2d084eafb8';

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

</body></html>
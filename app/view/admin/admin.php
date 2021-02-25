
<script type="text/javascript" src="/www/js/lib/Validform.min.js"></script>
<script type="text/javascript" src="/www/js/Switch/bootstrapSwitch.js"></script>
<body>

<nav class="breadcrumb"> <i class="Hui-iconfont"></i> 首页 <span class="c-gray en">&gt;</span> <span id="action"></span> <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont"></i></a></nav>

<div class="page-container">
    <div class="text-c"> 
        <form method="get">

            <input type="hidden" value="admin" name="action">
            <input type="text" class="input-text" style="width:250px" placeholder="输入登录名" id=username name="username" value="">
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont"></i> 搜用户</button>

        </form>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" onclick="admin_add('添加用户','/admin/admin/adminadd','','510')" class="btn btn-primary radius"><i class="Hui-iconfont"></i> 添加用户</a></span> <span class="r">共有数据：<strong id="tiaoshu"></strong> </span> </div>
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
      
        </tbody>
    </table>
    </div>
</div>

<div class="page">

   
</div>

<a href="javascript:void(0)" class="Hui-iconfont toTop" title="返回顶部" alt="返回顶部" style="display:none"></a> 

</body>
<script type="text/javascript">
var listinfo = eval('<?php echo json_encode($ad_user_info);?>');
var token  = '<?php echo $token;?>'; 
var action = '<?php echo $action;?>';
var username = '<?php echo $username;?>';
var table_info = '';
var num        = listinfo.length ; 
var url_edit   = '/admin/admin/adminadd';
for (var i = 0; i <= num - 1; i++) {
  var a,b = '';
  a = parseInt(listinfo[i]['off'])== 1?'label-success "> 已开启':' "> 已关闭 ';
  b = parseInt(listinfo[i]['off'])==1? 'admin_stop' :'admin_start';
 table_info +='<tr class="text-c"><td>'+listinfo[i]['id']+'</td> <td>'+listinfo[i]['name']+'</td><td>创始人</td><td>'+listinfo[i]['ip']+'</td> <td>'+getLocalTime(listinfo[i]['atime'])+'</td> <td class="td-status"><span class="label radius '+a+'  </span> </td> <td class="td-manage">  <a title="编辑" href="javascript:;" onclick="admin_edit(\'编辑\','+listinfo[i]['id']+',800,500)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont"></i></a> <a title="删除" href="javascript:;" onclick="admin_del(this,'+parseInt(listinfo[i]['id'])+')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont"></i> </a></td></tr>';
}

$(function(){
  $("tbody").html(table_info);
  $("#action").text(action);
  $("#form-admin-role-add" ).Validform( { tiptype:2 });
  $("#tiaoshu").html(num );
  $("#username").val(username);
});

var token ='<?php echo $token?>';


function admin_add(title ,url ,w ,h){

         layer_show(title ,url ,w ,h);

}

function admin_del(obj,id){

        layer.confirm('删除须谨慎，确认要删除吗？',{title:'操作提示',btn:["YES","NO"]},function(index){
          
              $.getJSON('/admin/admin/dodel?action=del&token=' + token + '&id='+id,{},function(data){
                  
                  
                   token = data.data.token;
                  if(data.errno == 0){

                       $(obj).parents("tr").remove();

                       shu = $("#tiaoshu").html() *1;

                       $("#tiaoshu").html( shu -1 );

                       layer.msg('已删除! ',{icon:1,time:1000});

                  }else  layer.msg( data.msg ,{ icon: 2 ,time : 1000});

              });

        });
}

function admin_edit(title,id,w,h){
         var url = url_edit+'?id='+id;
         layer_show( title, url, w, h);
}



</script>


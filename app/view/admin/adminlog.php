




<script type="text/javascript" src="/www/js/lib/Validform.min.js"></script>
<script type="text/javascript" src="/www/js/My97DatePicker/WdatePicker.js"></script>
<body>


<nav class="breadcrumb"> <i class="Hui-iconfont"></i> 首页 <span class="c-gray en">&gt;</span> 管理日志 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont"></i></a></nav>

<div class="page-container">
  <div class="text-c"> 
    <form method="get">
        <input type="hidden" value="" name="token">
        <input type="hidden" value="adminlog" name="action">
            
            <span class="select-box" style="width:108px">
             <select name="type" class="select"> <option value=""> 全部</option> <option value="0">登录</option><option value="1">新增</option><option value="2">编辑</option><option value="3">删除</option><option value="4">退出</option> </select> 
      </span>

      日期范围：
       <input type="text" name="start" value="" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}',dateFmt:'yyyy-MM-dd HH:mm:ss',lang:'cn'})" id="datemin" class="input-text Wdate" style="width:168px;">
       -
       <input type="text" name="end" value="" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d',dateFmt:'yyyy-MM-dd HH:mm:ss',lang:'cn'})" id="datemax" class="input-text Wdate" style="width:168px;">
       
       <input type="text" class="input-text" style="width:100px" placeholder="搜索管理uid" name="fenqu" value="">

        <input type="text" class="input-text" style="width:100px" placeholder="搜索关键操作" name="guan" value="">



        <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont"></i> 搜索</button>

    </form>
  </div>
  
  <div class="mt-20">
  <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        
        <th width="40">ID</th>
        <th width="300">帐号</th>
        <th>分类</th>
        <th width="130">IP</th>
        <th width="130">时间</th>
       

      </tr>
    </thead>
    <tbody>

    




    </tbody>
  </table>
  </div>
</div>

<div class="page">

<?php echo SubPages_lib::pagec( $lang['PAGE'], 10, $_GET['page'], 5, $PAGE, '?action='.$_GET['action'].'&page=','&guan='.$_GET['guan'].'&start='.$_GET['start'].'&end='.$_GET['end'].'&type='.$_GET['type'].'&fenqu='.$_GET['fenqu'] );?> 
</div>

<script type="text/javascript">
var type = ['登陆','新增','编辑','删除','退出'];
var action = '<?php echo $action;?>';
var token  = '<?php echo $token;?>';
var listinfo = eval('<?php echo json_encode($list);?>');
var where = JSON.parse('<?php echo json_encode($where);?>');
var table_info  = '';
for (var i = 0; i <= listinfo.length - 1; i++) {
  table_info += '    <tr class="text-c"><td>'+listinfo[i].id+'</td><td>'+listinfo[i].name+' <span style="color:Red;">('+listinfo[i].uid+')</span></td><td> <span>'+type[parseInt(listinfo[i].type)]+' </span></td><td>'+listinfo[i].ip+'</td>  <td>'+getLocalTime(listinfo[i]['atime'])+'</td></tr>';
  }

function init(){
  for(let key in where){
    //console.log(key,where[key]);
    $("[name="+key+"]").val(where[key]);
  }
}
$(function(){
init();
  $("tbody").html(table_info);
 $(document).attr("title",action);
 $("input[name='token']").val(token);

});

</script>
</body>

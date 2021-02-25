


<link rel="stylesheet" type="text/css" href="/www/h-ui/skin/blue/skin.css" id="skin">

<link rel="stylesheet" type="text/css" href="/www/js/Switch/bootstrapSwitch.css">

<script type="text/javascript" src="/www/js/lib/Validform.min.js"></script>
<script type="text/javascript" src="/www/js/Switch/bootstrapSwitch.js"></script>


<title></title>

<body>


<style>
.yddddd{margin-top:3px;display:block;}
</style>



<article class="page-container">
    <form method="post" class="form form-horizontal" id="form-admin-role-add">
          <input type="hidden" id="token" value="<?php echo $token;?>">
          <input type="hidden" id="id" value="0">  

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>登录名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="name" datatype="*" nullmsg=" ">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">登录密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="为空不修改" id="pass">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">超级密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="为空不修改" id="epass">
            </div>
        </div>


  <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"> 用户状态：</label>
            <div class="formControls col-xs-8 col-sm-9">

             
                <!--   <select class="select"    id="off">
                  <option value="0">已关闭</option>
                  <option value="1">已开启</option>
                </select> -->

             <div class="switch" id="off"  data-on-label="已开启" data-off-label="已关闭" >
                  <input type="checkbox"    />
             </div>
  

            </div>
        </div>


  <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">  效验登录IP：</label>
            <div class="formControls col-xs-8 col-sm-9">

            <!-- 
                  <select class="select"    id="yanzhengip">
                    <option value="0">已关闭</option>
                    <option value="1">已开启</option>
                  </select> -->
            <div class="switch" id="yanzhengip" data-on-label="已开启" data-off-label="已关闭" >
                  <input type="checkbox"    />
            </div>

            </div>
        </div>





        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户权限：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <select id="type" class="select" size="1"> <option value="0">创始人</option></select>
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"> IP：</label>
            <div class="formControls col-xs-8 col-sm-9">
               <span id ="ip" class="yddddd"></span>
                
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">时间：</label>
            <div class="formControls col-xs-8 col-sm-9">

               <span id="atime" class="yddddd"></span>
                
            </div>
        </div>



        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" name="submit"  onclick="udp()" type="button" value="&nbsp;&nbsp;编辑&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</article>
  
                    

<!-- <a href="javascript:void(0)" class="Hui-iconfont toTop" title="返回顶部" alt="返回顶部" style="display:none"></a>   -->       
 




<script type="text/javascript">
    var action = "<?php echo $action;?>";
    var LX = 0;
    var user = '<?php echo isset($userinfo) && $userinfo['id']>0?json_encode($userinfo):null;?>';
    var userinfo = user==''?'':JSON.parse(user);
    function init(){
        if(userinfo!='' && parseInt(userinfo['id'])>0){
            $('#id').val(userinfo['id']);
            $('#name').val(userinfo['name']);
            $("#ip").text(userinfo['ip']);
            $("#atime").text(getLocalTime(userinfo['atime']));
            if(parseInt(userinfo['off'])==1){
                $("#off .switch-animate").removeClass("switch-off").addClass("switch-on");
            }
            if(parseInt(userinfo['yanzhengip'])==1){
                $("#yanzhengip .switch-animate").removeClass("switch-off").addClass("switch-on");
            }
        }
        
    }
    function udp() {
       
        var fid = ['token','id','name', 'pass', 'epass','type'];
        var data1 = {};
        for (f in fid) {
            data1[fid[f]] = $("#" + fid[f]).val();
        }

        data1['off'] = $("#off").children("div").is(".switch-on")?1:0;
        data1['yanzhengip'] = $("#yanzhengip").children("div").is(".switch-on")?1:0;
      /*  if(data1['name']=='' || data1['pass']==''){
          alert('用户名或密码不能为空！');
          return;
        }
        if(data1['pass'].length<6){
          alert('密码不能少于6位字符！！');
          return;
        }*/
        //console.log(data1);return;
        $.post("/admin/admin/adminadd", data1, function (data) {
            //alert(data);
            if (typeof data == 'string') {
                data = $.parseJSON(data);
            }
            
            
            alert(data.error);
            window.parent.parent.scrollTo(0,0);parent.location.reload();
            

        });
    }

$(function(){

 
 init();
 $("#form-admin-role-add" ).Validform( { tiptype:2 });
 $(document).attr("title",action);


});






</script>

</body></html>
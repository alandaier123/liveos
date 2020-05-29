<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />

<link href="/www/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/www/h-ui/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/www/h-ui/css/style.css" rel="stylesheet" type="text/css" />
<link href="/www/js/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/www/js/jquery.min.js"></script> 
<script type="text/javascript" src="/www/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/www/js/lib/Validform.min.js"></script>

<title>新月企业建站</title>
<style>
.loginBox .input-text {
    width: 250px;
}
</style>
</head>
<body>

<div class="header">

</div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" onsubmit="return false" method="post" id="demoform">
	<input type="hidden" name="token" value="<?php echo '$_SESSION[\'token\']';?>" >
	<input type="hidden" name="action" value="login" />
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-5">
          <input id="" name="name" type="text" placeholder="账号" class="input-text size-L"    datatype="*"  nullmsg="请输入账号！" >
        </div>
		<div class="formControls col-xs-4">
		</div>
		
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-5">
          <input id="" name="pass" type="password" placeholder="密码" class="input-text size-L" datatype="*6-20" nullmsg="请输入密码！">
        </div>
		<div class="formControls col-xs-4">
		</div>

      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input class="input-text size-L" type="text" placeholder="验证码"  maxlength="4" name="code" datatype="n" style="width:113px;">

          <img src="/admin/vcode" onclick="shuaxin();" id="newimg"> 
		  <a id="kanbuq" onclick="shuaxin();" href="javascript:;">点击刷新验证码</a>


		 </div>
		

      </div>
   

      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" onclick="login()" class="btn btn-success radius size-L" value="登录">
          
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright <a href="#" target="_blank"> 新月企业建站 V.1.0</a>
<!-- <script type="text/javascript" src="//ongsoft.com/admin/login.js"></script> -->
</div>



<script  type="text/javascript">


function shuaxin(){ 
	
	$("#newimg").attr({'src':'/admin/vcode?code='+Math.ceil(Math.random()*100000)    });
}
function login() {
            $.ajax({  type: "POST",dataType: "json",
                url: "/admin/login" ,//url
                data: $('#demoform').serialize(),
                success: function (result) {
                    
                    if (result.errno == 0) {
                        location.href = '/admin/index';
                    }else{
                      shuaxin();
                      alert(result.error);
                    }
                    
                },
                error : function() {
                    alert("异常！");
                }
            });
        }
$(function(){

	$("#demoform").Validform({
		tiptype:2
	});
});


</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>登录 </title>

        <meta name="description" content="用户登录" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- basic styles -->

        <link rel="stylesheet" href="/www/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/www/css/font-awesome.min.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <!-- fonts -->

        <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />-->

        <!-- ace styles -->

        <link rel="stylesheet" href="/www/css/ace.min.css" />
        <link rel="stylesheet" href="/www/css/ace-rtl.min.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="/js/html5shiv.js"></script>
        <script src="/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">
                                <h1>
                                    <span class="red">审计平台</span>
                                    <span class="white">1.0</span>
                                </h1>
                                <h4 class="blue"></h4>
                            </div>
                            <div class="space-6"></div>
                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="icon-coffee green"></i>
                                                请输入您的中国大陆手机号
                                            </h4>
                                            <div class="space-6"></div>
                                            <form onsubmit="return false;">
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control" id="form_username" placeholder="手机号" /><button id="getcode">获取验证码</button>
                                                            <i class="icon-user"></i>
                                                        </span>
                                                    </label>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" class="form-control" id="form_password" placeholder="手机验证码" />
                                                            <i class="icon-lock"></i>
                                                        </span>
                                                    </label>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="hidden" class="form-control" id="form_token" value="<?php echo $_GET['token']; ?>" />
                                                            <i class="icon-lock"></i>
                                                        </span>
                                                    </label>


                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right" id="form_help"></span>
                                                    </label>
                                                    <div class="space"></div>
                                                    <div class="clearfix">
                                                        <label class="inline">
                                                            <!--<input type="checkbox" class="ace" />
                                                            <span class="lbl"> 自动登录</span>-->
                                                        </label>
                                                        <button id="login_submit" type="button" class="width-35 pull-right btn btn-sm btn-primary">
                                                            <i class="icon-key"></i>
                                                            登录
                                                        </button>
                                                    </div>
                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>
                                        </div><!-- /widget-main -->
                                        <div class="toolbar clearfix"></div>
                                    </div><!-- /widget-body -->
                                </div><!-- /login-box -->
                            </div><!-- /position-relative -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="/js/jquery-2.0.3.min.js"></script>
        <!-- <![endif]-->

        <!--[if IE]>
        <script src="/js/jquery-1.10.2.min.js"></script>
        <![endif]-->

        <script type="text/javascript">
                                                if ("ontouchend" in document) {
                                                    document.write("<script src='/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
                                                }
        </script>

        <!-- inline scripts related to this page -->

        <script type="text/javascript">
            function show_box(id) {
                jQuery('.widget-box.visible').removeClass('visible');
                jQuery('#' + id).addClass('visible');
            }
        </script>

        <script type="text/javascript">
            $(function () {
                $("#form_username,#form_password").keypress(function (e) {
                    if (13 == e.keyCode) {
                        $("#login_submit").trigger("click");
                    }
                });
                $("#getcode").click(function () {
                    var phone = $("#form_username").val();
                    $.ajax({
                        url: '/index/getphonecode',
                        data: 'phone=' + phone,
                        dataType: "jsonp",
                        jsonp: "callback",
                        async: false,
                        success: function (api_data) {
                            var errno = api_data.errno;
                            alert(api_data.error);
                            if (errno == '999') {
                                $("#getcode").hide();
                            }
                        }
                    });
                });
                $("#login_submit").click(function () {
                    var data = {
                        form_username: $("#form_username").val(),
                        form_password: $("#form_password").val(),
                        form_token: $("#form_token").val(),
                        geetest_challenge: $("input[name='geetest_challenge']").val(),
                        geetest_validate: $("input[name='geetest_validate']").val(),
                        geetest_seccode: $("input[name='geetest_seccode']").val()
                    };
                    //console.dir(data);
                    if ("" == data.form_username || "" == data.form_password) {
                        $("#form_help").removeClass("text-success").addClass("text-danger").html('请输入手机号和手机验证码！');
                        return;
                    }
                    $.post("/index/dologin", data, function (msg) {
                        //alert(msg);
                        if ("0" == msg.errno) {
                            $("#form_help").removeClass("text-danger").addClass("text-success").html('登录成功！');
                            location.href = msg.data.nextUrl;
                            //console.log( msg.data.nextUrl);
                        } else if ("1" == msg.errno) {
                            $("#form_help").removeClass("text-success").addClass("text-danger").html(msg.errno);
                        } else {
                            $("#form_help").removeClass("text-success").addClass("text-danger").html(msg.error);
                        }
                        return;
                    }, 'json');
                });
            });
        </script>
    </body>
</html>

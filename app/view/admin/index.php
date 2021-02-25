

<body class="no-skin">        
        <header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="" target="_blank">企业建站系统</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="http:#">企业建站系统</a> 
        <span class="logo navbar-slogan f-l mr-10 hidden-xs">v7.9</span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;"></a>
            
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li><a href="#" target="_blank">浏览首页</a> </li>
                    <li>创始人</li>
                    <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A">admin <i class="Hui-iconfont"></i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            
                            <li><a href="javascript:void(0)" onclick=loginout();>退出</a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</header>

<aside class="Hui-aside">
    <input runat="server" id="divScrollValue" type="hidden" value="">
    <div class="menu_dropdown bk_2">

         
        <dl id="menu-article">
            <dt class=""><i class="Hui-iconfont "></i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow"></i></dt>
            <dd style="display: none;">
                <ul>
                 <li><a _href="?action=adminfenzu" data-title="管理权限" href="javascript:void(0)">管理权限</a></li><li><a _href="/admin/admin/index" data-title="管理会员" href="javascript:void(0)">管理会员</a></li><li><a _href="/admin/adminlog/index" data-title="管理日志" href="javascript:void(0)">管理日志</a></li>                </ul>
            </dd>
        </dl>

        
        <dl id="menu-article">
            <dt class=""><i class="Hui-iconfont "></i> 系统CMS<i class="Hui-iconfont menu_dropdown-arrow"></i></dt>
            <dd style="display: none;">
                <ul>
                 <li><a _href="?action=type" data-title="分类管理" href="javascript:void(0)">分类管理</a></li><li><a _href="?action=center" data-title="内容管理" href="javascript:void(0)">内容管理</a></li><li><a _href="?action=pinglun" data-title="评论留言" href="javascript:void(0)">评论留言</a></li>                </ul>
            </dd>
        </dl>

        
        <dl id="menu-article">
            <dt class="selected"><i class="Hui-iconfont "></i> 附件管理<i class="Hui-iconfont menu_dropdown-arrow"></i></dt>
            <dd style="display: block;">
                <ul>
                 <li><a _href="?action=fujian" data-title="附件管理" href="javascript:void(0)">附件管理</a></li>                </ul>
            </dd>
        </dl>

        
        <dl id="menu-article">
            <dt><i class="Hui-iconfont "></i> 系统设置<i class="Hui-iconfont menu_dropdown-arrow"></i></dt>
            <dd style="">
                <ul>
                 <li><a _href="?action=logac" data-title="日志菜单" href="javascript:void(0)">日志菜单</a></li>
                 <li><a _href="?action=xtset" data-title="系统设置" href="javascript:void(0)">系统设置</a></li>
                 <li><a _href="?action=youqing" data-title="友情连接" href="javascript:void(0)">友情连接</a></li>
                 <li><a _href="?action=uiset" data-title="前端UI设置" href="javascript:void(0)">前端UI设置</a></li>
                 <li><a _href="?action=mkhtml" data-title="生成新静态" href="javascript:void(0)">生成新静态</a></li>
                 <li><a _href="?action=sqlbak" data-title="数据库备份" href="javascript:void(0)">数据库备份</a></li>
                 <li><a _href="?action=scurl" data-title="生成新的url" href="javascript:void(0)">生成新的url</a></li>
                                 </ul>
            </dd>
        </dl>

        

    
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onclick="displaynavbar(this)"></a></div>



<section class="Hui-article-box">
    <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
        <div class="Hui-tabNav-wp">
            <ul id="min_title_list" class="acrossTab cl">
                <li class="active"><span title="后台首页" data-href="/admin/body">后台首页</span><em></em></li>
            </ul>
        </div>
        <div class="Hui-tabNav-more btn-group">
            <a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a>
            <a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a>
        </div>
    </div>
    <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
            <div style="display:none" class="loading"></div>
            <iframe scrolling="yes" frameborder="0" src="/admin/body"></iframe>
        </div>
    </div>
</section>



<script type="text/javascript">
    var action = "<?php echo $action;?>";
    function article_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    function loginout(){
            $.get('/admin/quite', {},function(res){

                        res = JSON.parse(res);
                    //console.log(res.errno);
                    if (res.errno==0) {
                        
                      location.href = '/admin/tologin';
                    }else{
                        alert(res.error);
                    }
                    
        });

    }
  
$(function(){

 $(document).attr("title",action);


});
</script>
</body>

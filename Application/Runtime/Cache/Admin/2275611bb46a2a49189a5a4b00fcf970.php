<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/lib/html5.js"></script>
    <script type="text/javascript" src="/lib/respond.min.js"></script>
    <script type="text/javascript" src="/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="/Public/css/h-ui/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/h-ui/H-ui.login.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/h-ui/style.css" rel="stylesheet" type="text/css" />
    <link href="/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>虫妈邻里团后台管理系统</title>
</head>
<body>
<!--
<div class="header"></div>
-->
<div class="loginWraper">
    <div id="loginform" class="loginBox">
        <form class="form form-horizontal" action="<?php echo U('Admin/Admin/login');?>" method="post">
                <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input id="admin_name"  name="admin_name" type="text" placeholder="账户" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="pass_word" name="pass_word"  type="password" placeholder="密码" class="input-text size-L">
                </div>
            </div>
            <!--<div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <a href="<?php echo U('Admin/Index/index',array('admin_id'=>123));?>">回首页</a>
                </div>
            </div>-->
            <!--
            <div class="row cl">
              <div class="formControls col-xs-8 col-xs-offset-3">
                <label for="online">
                  <input type="checkbox" id="remember_name" value="">
                  记住账号</label>
              </div>
            </div>
            -->
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input type="submit" onclick="admin_login1();" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <!--
                    <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                    -->
                </div>
            </div>
        </form>
    </div>
</div>
<div class="footer">Copyright &copy;虫妈邻里团 </div>
<script type="text/javascript" src="/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/js/h-ui/H-ui.js"></script>
<script type="text/javascript">
    /*var admin_login = function(){
        var admin_name = $('#admin_name').val();
        var pass_word = $('#pass_word').val();

        $.post('./index.php?c=Admin&a=login',{admin_name:admin_name,pass_word:pass_word},function( res ){
            if(res.status==-1){
                alert(res.msg);
            }else{
                window.location.href = './index.php?c=Index&a=index';
            }
        });
    };*/
</script>
</body>
</html>
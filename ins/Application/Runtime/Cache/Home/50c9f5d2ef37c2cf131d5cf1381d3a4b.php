<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>余杭区邮政保险理财客户管理系统</title>
<link rel="stylesheet" href="/ins/Public/Admin/css/style.default.css" type="text/css" />
<script type="text/javascript" src="/ins/Public/Admin/js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="/ins/Public/Admin/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="/ins/Public/Admin/js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="/ins/Public/Admin/js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="/ins/Public/Admin/js/custom/general.js"></script>
<script type="text/javascript" src="/ins/Public/Admin/js/custom/index.js"></script>
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="js/plugins/css3-mediaqueries.js"></script>
<![endif]-->
</head>
<body class="loginpage">
	<div class="loginbox">
    	<div class="loginboxinner">
            <div class="logo">
            	<h1 class="logo">余杭<span>邮政<h2>保险</h2></span></h1>
            	
				<span class="slogan">保险理财客户管理系统</span>
            </div><!--logo-->
            <br clear="all" /><br />
            <div class="nousername">
				<div class="loginmsg">密码不正确.</div>
            </div><!--nousername-->
            <div class="nopassword">
				<div class="loginmsg">密码不正确.</div>
                <div class="loginf">
                    <div class="thumb"><img alt="" src="/public/images/thumbs/avatar1.png" /></div>
                    <div class="userlogged">
                        <h4></h4>
                        <a href="index.html">Not <span></span>?</a> 
                    </div>
                </div><!--loginf-->
            </div><!--nopassword-->
            <form id="login" action="/ins/index.php/Home/Login/index" method="post">
            	
                <div class="username">
                	<div class="usernameinner">
                    	<input type="text" name="username" id="username" />
                    </div>
                </div>
                <div class="password">
                	<div class="passwordinner">
                    	<input type="password" name="password" id="password" />
                    </div>
                </div>
                <div align="center">
                <input type="submit" value="登录">
                </div>
                <div class="keep"><a href="/ins/index.php/Home/Login/downloads" class="btn btn2 btn_blue btn_link"><span>下载谷歌浏览器</span></a></div>
            </form>
        </div><!--loginboxinner-->
    </div><!--loginbox-->
</body>
</html>
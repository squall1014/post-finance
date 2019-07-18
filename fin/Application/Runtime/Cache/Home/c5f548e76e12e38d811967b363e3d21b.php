<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>丽水市金融积分考核系统</title>
  <link rel="stylesheet" href="/fin/Public/css/layui.css">
</head>
</head>
	<body>
		
        <div id="contentwrapper" class="contentwrapper">
		  	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
				<legend>密码修改</legend>
			</fieldset>
        </div>
        <form class="layui-form layui-form-pane" action="/fin/index.php/home/login/passwordeditsuc" method="POST" style="margin-left: 20px;width: 100%;">
        	<div style="margin-left: 5%;width: 30%;">
				<div class="layui-form-item">
					<label class="layui-form-label" >原密码</label>
				<div class="layui-input-inline">
					<input type="text" name="passwordold" required lay-verify="required" class="layui-input"  />
				</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label" >新密码</label>
				<div class="layui-input-inline">
					<input type="text" name="passwordnew" required lay-verify="required" class="layui-input"  />
				</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label" >确认密码</label>
				<div class="layui-input-inline">
					<input type="text" name="passwordconfirm" required lay-verify="required" class="layui-input"  />
				</div>
				</div>
				<br />
				<div class="layui-form-item" style="margin-left:0px;">
					<div class="layui-input-block">
					<button class="layui-btn" lay-submit lay-filter="formDemo">提交修改</button>
					<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</div>
        </form>
	</body>
</html>
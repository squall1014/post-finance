<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--大标题和JS-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>余杭区邮政存货管理系统</title>
  <link rel="stylesheet" href="/cost/Public/css/layui.css">
</head>
    <!-- 内容主体区域 -->
    <br />
        <form action="<?php echo U('pointcardlosssuc');?>" enctype="multipart/form-data" method="post" class="layui-form" >
        <div class="layui-card" style="width: 90%;">
        	<div class="layui-card-header">
        		<font size="4">积分卡挂失申请</font>
        	</div>
        <div class="layui-card-body">
        <table class="layui-table" lay-size="">
         	<input type="hidden" name="cardid" value="<?php echo ($card[cardid]); ?>">
         	<input type="hidden" name="cardinid" value="<?php echo ($card[cardinid]); ?>">
         	<input type="hidden" name="cardoutid" value="<?php echo ($card[cardoutid]); ?>">
         	
         	<tr>
         	 <th>备注</th>
         	 <td><input type="text" name="beizhu" required placeholder="请说明挂失原因" autocomplete="off" class="layui-input"> </td>
         	</tr>
         	<tr>
         	
         </table>
         </div>
         
         </div>
         <br />
         <div class="layui-form-item" style="margin-left:80px;">
           <div class="layui-input-block">
            <button class="layui-btn" onclick="closes()" lay-submit lay-filter="formDemo">挂失申请</button>
           </div>
         </div>
        </form>
<script src="/cost/Public/layui.all.js"></script>
<script type="text/ecmascript">
	function closes(){
		window.parent.close()
	}
</script>
 </body>
 </html>
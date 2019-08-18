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
        <form action="<?php echo U('pointcardhairs');?>" enctype="multipart/form-data" method="post" class="layui-form" >
        <div class="layui-card" style="width: 90%;">
        	<div class="layui-card-header">
        		<font size="4">发卡信息添加</font>
        	</div>
        <div class="layui-card-body">
        <table class="layui-table" lay-size="">
         	<input type="hidden" name="cardid" value="<?php echo ($card[cardid]); ?>">
         	<input type="hidden" name="cardinid" value="<?php echo ($card[cardinid]); ?>">
         	<input type="hidden" name="card" value="<?php echo ($card[card]); ?>">
         	<tr>
         	 <th>*客户姓名</th>
         	 <td><input type="text" name="client" lay-verify="required" required placeholder="请输入客户姓名" autocomplete="off" class="layui-input"> </td>
         	</tr>
         	<tr>
         	 <th>*身份证</th>
         	 <td><input type="text" name="sfz" lay-verify="number" required placeholder="请输入客户身份证" autocomplete="off" class="layui-input"> </td>
         	</tr>
         	<tr>
         	 <th>*联系电话</th>
         	 <td><input type="text" name="phone" lay-verify="number" required placeholder="请输入客户联系电话" autocomplete="off" class="layui-input"> </td>
         	</tr>
         	<tr>
         	 <th>*存单号码</th>
         	 <td><input type="text" name="cundan" lay-verify="number" required placeholder="请输入客户存单号" autocomplete="off" class="layui-input"> </td>
         	</tr>
         	<tr>
         	 <th>*存款金额</th>
         	 <td><input type="text" name="money" lay-verify="number" required placeholder="举例15000元就填1.5" autocomplete="off" class="layui-input"> </td>
         	</tr>
         	<tr>
         	<tr>
         	 <th>*存款方式</th>
         	 <td>
         	 	<select name="rule" lay-verify="required" lay-search>
         	 		<option value=""></option>
         	 		<?php if(is_array($ccr)): $i = 0; $__LIST__ = $ccr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["rule"]); ?>"><?php echo ($vo["content"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
         	 </td>
         	
         </table>
         </div>
         
         </div>
         <br />
         <div class="layui-form-item" style="margin-left:130px;">
           <div class="layui-input-block">
            <button class="layui-btn" onclick="closes()" lay-submit lay-filter="formDemo">立即发卡</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
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
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
    <div class="layui-card" style="width: 100%;">
		<div class="layui-card-header">
			<font size="4">网点积分卡管理</font>
		</div>
    <br />
	<form class="layui-form" action="selectss" method="get" style="width: 100%;">
		<table class="layui-table" style="text-align: center; width: 95%;">
			<tr>
				<td>卡号</td>
				<td>存单</td>
				<td>客户</td>
				<td>身份证</td>
				<td>联系电话</td>
				<td>出库日期</td>
				<td>存款金额</td>
				<td>积分</td>
				<td>状态</td>
				<td>备注</td>
			</tr>
			<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($vo["card"]); ?></td>
					<td><?php echo ($vo["cundan"]); ?></td>
					<td><?php echo ($vo["client"]); ?></td>
					<td><?php echo ($vo["sfz"]); ?></td>
					<td><?php echo ($vo["phone"]); ?></td>
					<td><?php echo ($vo["date"]); ?></td>
					<td><?php echo ($vo["money"]); ?></td>
					<td><?php echo ($vo["point"]); ?></td>
					<td><?php echo ($vo["status"]); ?></td>
					<td><?php echo ($vo["beizhu"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
	</form>
  </div>
  
<!--底部-->
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © 余杭区邮政存货管理系统
  </div>
</div>
<script src="/cost/Public/layui.all.js"></script>

<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
layui.use('laydate', function(){
  var laydate = layui.laydate;
  
  //执行一个laydate实例
  laydate.render({
    elem: '#date' //指定元素
  });
  laydate.render({
  	elem: '#test6'
  	,range: true
	});
});
</script>
<!--<script>

</script>
<script>
layui.use('laydate', function(){
  var laydate = layui.laydate;
  
  //执行一个laydate实例
  laydate.render({
    elem: '#datea' //指定元素
  });
});
</script>-->
</body>
</html>
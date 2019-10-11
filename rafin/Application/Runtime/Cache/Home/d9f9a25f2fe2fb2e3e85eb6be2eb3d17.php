<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--大标题和JS-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>瑞安市金融积分考核系统</title>
  <link rel="stylesheet" href="/rafin/Public/css/layui.css">
</head>
<!--前左导航-->


    <!-- 内容主体区域 -->
    <h1><div style="padding: 15px;">瑞安市金融积分考核系统</div></h1>
    
    <br />
        <form action="<?php echo U('pointitemaddsuc');?>" enctype="multipart/form-data" method="post" class="layui-form" >
        <div class="layui-card" style="width: 50%;">
        	<div class="layui-card-header">
        		<font size="4">积分项目大类添加</font>
        	</div>
        <div class="layui-card-body">
        <table class="layui-table" lay-size="">
         	<tr>
         	  <th>项目大类名称</th>
         	 <td>
         	 	<input type="text" name="item" lay-verify="required" required placeholder="请输入项目大类名称" autocomplete="off" class="layui-input">
         	 </td>
         	 </tr>
         	 <tr>
         	 <th>备注</th>
         	 <td><input type="text" name="beizhu" placeholder="可选填" autocomplete="off" class="layui-input"> </td>
         	</tr>
         </table>
        </div>
         </div>
         <br />
         <div class="layui-form-item" style="margin-left:360px;">
           <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即添加</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
           </div>
         </div>
        </form>

  
<!--底部-->
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © 瑞安市金融积分考核系统
  </div>
</div>
<script src="/rafin/Public/layui.all.js"></script>
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
    elem: '#date1' //指定元素
  });
    laydate.render({
    elem: '#date3' //指定元素
    ,type: 'month'
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
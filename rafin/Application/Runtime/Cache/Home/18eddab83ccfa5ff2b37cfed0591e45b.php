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
        <form action="<?php echo U('pointcontentaddsuc');?>" enctype="multipart/form-data" method="post" class="layui-form" >
        <div class="layui-card" style="width: 60%;">
        	<div class="layui-card-header">
        		<font size="4">积分项目管理</font>
        	</div>
        <div class="layui-card-body">
        <table class="layui-table" lay-size="">
         	<tr>
         	  <th>项目名称</th>
         	 <td>
         	 	<input type="text" name="content" lay-verify="required" required placeholder="请输入项目名称" autocomplete="off" class="layui-input">
         	 </td>
         	 </tr>
         	 <tr>
         	 <td>项目大类</td>
         	 <td>
         	 	<select name="pointitemid" lay-verify="required" lay-search>
         	 		<option value="">请选择项目大类</option>
         	 		<?php if(is_array($jrpirr)): $i = 0; $__LIST__ = $jrpirr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["pointitemid"]); ?>"><?php echo ($vo["item"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
         	 </td>
         	 </tr>
         	 <tr>
         	 <th>单位</th>
         	 <td>
         	 	<input type="text" name="unit" placeholder="请输入项目单位" lay-verify="required" required autocomplete="off" class="layui-input">
         	 </td>
         	 </tr>
         	 <tr>
         	 <th>分值</th>
         	 <td>
         	 	<input type="text" name="score" placeholder="请输入分值" lay-verify="required" required autocomplete="off" class="layui-input">
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
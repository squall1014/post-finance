<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--大标题和JS-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>余杭区金融积分考核系统</title>
  <link rel="stylesheet" href="/jrhr/Public/css/layui.css">
</head>

<!--前左导航-->
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">余杭区金融积分考核系统</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">管理</a></li>
      <li class="layui-nav-item"><a href="">用户管理</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">云平台</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                      <?php echo ($dwname['user']); ?>--<?php echo ($dwname['dwname']); ?>--<?php echo ($dwname['zhiwu']); ?>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="/jrhr/index.php/Home/Admin/passwordedit">密码修改</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/jrhr/index.php/Home/Admin/logout">退了</a></li>
    </ul>
  </div>
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      	<li class="layui-nav-item"><a href="/jrhr/index.php/Home/Admin/index">首页</a></li>
      	<li class="layui-nav-item">
        	<a class="" href="javascript:;">金融每日积分操作</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Admin/jrpointup">每日积分上报</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jrpointupmodify">每日积分修改</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jrpointupsearch">每日积分查询</a></dd>
            <!--<dd><a href="/jrhr/index.php/Home/Admin/jrpointuptj">每日积分统计查询</a></dd>-->
            <?php if($dwname["zhiwud"] == 75): ?><dd><a href="/jrhr/index.php/Home/Admin/jrpointsupsearch">本网点积分查询</a></dd><?php else: endif; ?>
            <?php if($dwname["zhiwud"] == 75): ?><dd><a href="/jrhr/index.php/Home/Admin/jrpointupsh">每日积分审核</a></dd><?php else: endif; ?>
            
          </dl>
       </li>
       <li class="layui-nav-item">
        	<a class="" href="javascript:;">金融每日行为量上报</a>
          <dl class="layui-nav-child">
          	<dd><a href="/jrhr/index.php/Home/Admin/jractups">每日行为量选报项目</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractup">每日行为量必报项目</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractupmodifys">每日行为量选报项目修改</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractupmodify">每日行为量必报项目修改</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractupsearch">每日行为量查询</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractupsh">每日行为量项目审核</a></dd>
          </dl>
       </li>
       <li class="layui-nav-item">
        	<a class="" href="javascript:;">每日日终行为量上报</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Admin/jractup">每日行为量必报项目</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractupmodify">每日行为量必报项目修改</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractupsearch">每日行为量查询</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractupsh">每日行为量项目审核</a></dd>
          </dl>
       </li>
       <li class="layui-nav-item">
        	<a class="" href="javascript:;">日爆点午巡活动上报</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveup/activecontentid/1">日爆点午巡活动上报</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveupmodify/activecontentid/1">日爆点午巡活动修改</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveupsh/activecontentid/1">日爆点午巡活动审核</a></dd>
          </dl>
       </li>
       <li class="layui-nav-item">
        	<a class="" href="javascript:;">日爆点日终活动上报</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveup/activecontentid/2">日爆点日终活动上报</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveupmodify/activecontentid/2">日爆点日终活动修改</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveupsh/activecontentid/2">日爆点日终活动审核</a></dd>
          </dl>
       </li>
       <li class="layui-nav-item">
        	<a class="" href="javascript:;">厅堂联动及网沙行为量</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveup/activecontentid/3">厅堂联动及网沙上报</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveupmodify/activecontentid/3">厅堂联动及网沙修改</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveupsh/activecontentid/3">厅堂联动及网沙审核</a></dd>
          </dl>
       </li>
       <li class="layui-nav-item">
        	<a class="" href="javascript:;">白名单客户管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Admin/whitecustadd">白名单客户录入</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/whitecustsearch">白名单客户查询</a></dd>
          </dl>
       </li>
       <li class="layui-nav-item">
        <a class="" href="javascript:;">ETC客户管理</a>
        <dl class="layui-nav-child">
          <dd><a href="/jrhr/index.php/Home/Admin/etccustadd">ETC客户录入</a></dd>
          <dd><a href="/jrhr/index.php/Home/Admin/etccustsearch">ETC客户查询</a></dd>
          <dd><a href="/jrhr/index.php/Home/Admin/etccustdelete">ETC客户车辆解约</a></dd>
          <dd><a href="/jrhr/index.php/Home/Admin/etccustrefereeadd">ETC客户引荐客户录入</a></dd>
          <dd><a href="/jrhr/index.php/Home/Admin/etccustrefereesearch">ETC引荐客户查询</a></dd>
        </dl>
     </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 9): ?><a class="" href="javascript:;">导出数据</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Admin/tablepers"></a></dd>
          </dl>
        </li>
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <!-- 内容主体区域 -->
<!-- 内容主体区域 -->
<h1><div style="padding: 15px;">余杭区金融积分考核系统</div></h1>
    <br />
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
			<legend>ETC客户查询</legend>
		</fieldset>
			<div class="layui-card-body">
        <form action="" enctype="multipart/form-data" method="post" class="layui-form" >
         <table class="layui-table" lay-size="" style="width: 100%">
         	<tr>
         		<th style="text-align:center;">签约网点</th>
         		<th style="text-align:center;">车牌号</th>
         		<th style="text-align:center;">车主姓名</th>
         		<th style="text-align:center;">车主电话</th>
         		<th style="text-align:center;">绑定卡号</th>
         		<th style="text-align:center;">持卡人姓名</th>
         		<th style="text-align:center;">持卡人电话</th>
				<th style="text-align:center;">引荐人</th>
				<th style="text-align:center;">引荐单位</th>
				<th style="text-align:center;">操作</th>
         	</tr>
         	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
         		<th style="text-align:center;"><?php echo ($vo["dwname"]); ?></th>
         		<th style="text-align:center;"><?php echo ($vo["carcard"]); ?></th>
         		<th style="text-align:center;"><?php echo ($vo["carcustname"]); ?></th>
         		<th style="text-align:center;"><?php echo ($vo["carphone"]); ?></th>
         		<th style="text-align:center;"><?php echo ($vo["card"]); ?></th>
         		<th style="text-align:center;"><?php echo ($vo["custname"]); ?></th>
         		<th style="text-align:center;"><?php echo ($vo["phone"]); ?></th>
				<th style="text-align:center;"><?php echo ($vo["referee"]); ?></th>
				<th style="text-align:center;"><?php echo ($vo["refereedwnames"]); ?></th>
				<th style="text-align:center;"><?php if($vo["jgh"] == $jgh): ?><a href="/jrhr/index.php/Home/Admin/etccustmodify/etccustid/<?php echo ($vo["etccustid"]); ?>">修改</a><?php else: ?>查看<?php endif; ?></th>
         	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
         </table>
         <br />
         <div class="layui-form-item" style="margin-left:300px;">
           <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">导出</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
           </div>
         </div>
        </form>
       </div>
  </div>
  
<!--底部-->
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © 余杭区金融积分考核系统
  </div>
</div>
<script src="/jrhr/Public/layui.all.js"></script>
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
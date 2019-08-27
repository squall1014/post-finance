<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--大标题和JS-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>丽水市金融积分考核系统</title>
  <link rel="stylesheet" href="/fin/Public/css/layui.css">
</head>

<!--前左导航-->
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">丽水市金融积分考核系统</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">管理</a></li>
      <li class="layui-nav-item"><a href="/fin/index.php/home/admin/passwordreset">用户管理</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">待定</a></dd>
          <dd><a href="">待定</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                      <?php echo ($dwname['user']); ?>--<?php echo ($dwname['district']); ?>--<?php echo ($dwname['dwname']); ?>--<?php echo ($dwname['zhiwu']); ?>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="/fin/index.php/home/admin/passwordedit">密码修改</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/fin/index.php/home/admin/logout">退了</a></li>
    </ul>
  </div>
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      	<li class="layui-nav-item"><a href="/fin/index.php/home/admin/index">首页</a></li>
      	<li class="layui-nav-item">
        	<a class="" href="javascript:;">金融每日积分操作</a>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/admin/jrpointclass">每日积分上报</a></dd>
            <dd><a href="/fin/index.php/home/admin/jrpointupmodify">每日积分修改</a></dd>
            <dd><a href="/fin/index.php/home/admin/jrpointupsearch">每日积分查询</a></dd>
            <!--<dd><a href="/fin/index.php/home/admin/jrpointuptj">每日积分统计查询</a></dd>-->
            <!--<?php if($dwname["zhiwuauth"] == 1): ?><dd><a href="/fin/index.php/home/admin/jrpointsupsearch">本网点积分查询</a></dd><?php else: endif; ?>-->
            <?php if($dwname["zhiwuauth"] == 1): ?><dd><a href="/fin/index.php/home/admin/jrpointupsh">每日积分审核</a></dd><?php else: endif; ?>
          </dl>
       </li>
       <li class="layui-nav-item">
        	<a class="" href="javascript:;">金融积分查询</a>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/admin/jrpointdwsearch">网点积分查询报表</a></dd>
            <dd><a href="/fin/index.php/home/admin/jrpointdwicdate">网点积分按项目查询报表</a></dd>
            <!--<dd><a href="/fin/index.php/home/admin/jrpointuptj">每日积分统计查询</a></dd>-->
          </dl>
       </li>
       <!--<li class="layui-nav-item">
        	<a class="" href="javascript:;">金融每日行为量上报</a>
          <dl class="layui-nav-child">
          	<dd><a href="/fin/index.php/home/admin/jractups">每日行为量选报项目</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractup">每日行为量必报项目</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractupmodifys">每日行为量选报项目修改</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractupmodify">每日行为量必报项目修改</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractupsearch">每日行为量查询</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractupsh">每日行为量项目审核</a></dd>
          </dl>
       </li>-->
       <!--<li class="layui-nav-item">
        	<a class="" href="javascript:;">每日日终行为量上报</a>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/admin/jractup">每日行为量必报项目</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractupmodify">每日行为量必报项目修改</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractupsearch">每日行为量查询</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractupsh">每日行为量项目审核</a></dd>
          </dl>
       </li>-->
       <li class="layui-nav-item">
        	<a class="" href="javascript:;">日爆点午巡活动上报</a>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/admin/jractiveup/activecontentid/1">日爆点午巡活动上报</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractiveupmodify/activecontentid/1">日爆点午巡活动修改</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractiveupsh/activecontentid/1">日爆点午巡活动审核</a></dd>
          </dl>
       </li>
       <!--<li class="layui-nav-item">
        	<a class="" href="javascript:;">日爆点日终活动上报</a>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/admin/jractiveup/activecontentid/2">日爆点日终活动上报</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractiveupmodify/activecontentid/2">日爆点日终活动修改</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractiveupsh/activecontentid/2">日爆点日终活动审核</a></dd>
          </dl>
       </li>
       <li class="layui-nav-item">
        	<a class="" href="javascript:;">厅堂联动及网沙行为量</a>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/admin/jractiveup/activecontentid/3">厅堂联动及网沙上报</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractiveupmodify/activecontentid/3">厅堂联动及网沙修改</a></dd>
            <dd><a href="/fin/index.php/home/admin/jractiveupsh/activecontentid/3">厅堂联动及网沙审核</a></dd>
          </dl>
       </li>-->
        <li class="layui-nav-item">
          <?php if($user["qx"] == 9): ?><a class="" href="javascript:;">导出数据</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/admin/tablepers"></a></dd>
          </dl>
        </li>
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <!-- 内容主体区域 -->
    <h1><div style="padding: 15px;">丽水市金融积分考核系统</div></h1>
    	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
			  <legend>积分审核</legend>
			</fieldset>
			<div class="layui-card-body">
    	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/fin/index.php/home/admin/jrpointupshs/date/<?php echo ($vo["date"]); ?>" class="layui-btn layui-btn-normal"><span><?php echo ($vo["date"]); ?></span></a>&nbsp&nbsp&nbsp<?php endforeach; endif; else: echo "" ;endif; ?>
     </div>
  </div>
  
<!--底部-->
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © 丽水市金融积分考核系统
  </div>
</div>
<script src="/fin/Public/layui.all.js"></script>
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
    elem: '#date3'
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
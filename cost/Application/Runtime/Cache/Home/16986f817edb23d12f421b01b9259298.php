<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--大标题和JS-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>余杭区邮政存货管理系统</title>
  <link rel="stylesheet" href="/cost/Public/css/layui.css">
</head>

<!--前左导航-->
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">余杭区邮政存货管理系统</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">管理</a></li>
      <li class="layui-nav-item"><a href="">用户管理</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="../../../../../HR/index.php/home/login/login">人力资源系统</a></dd>
          <dd><a href="../../../../../jrhr/index.php/home/login/login">金融考核系统</a></dd>
          <!--<dd><a href="../../../../../cost/index.php/home/login/login">费用分摊系统</a></dd>-->
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                      <?php echo ($user["username"]); ?>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/cost/index.php/Home/Admin/logout">退了</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      	<li class="layui-nav-item"><a href="/cost/index.php/Home/Admin/index">首页</a></li>
      	<li class="layui-nav-item">
          <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">积分卡管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Admin/pointcardwd">积分卡按网点入库</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdins">积分卡按网点入库审核</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdshs">积分卡按网点挂失审核</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdedits">积分卡按网点管理</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdmake">积分卡按网点制卡</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">积分卡对账管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdfinance">积分卡按网点对账管理</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">财务报表</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Admin/financedwreportdate">按单位库存财务报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/financewhreportdate">按仓库库存财务报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/inboundreportdate">按日期入库库存财务报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/">库存报表</a></dd>
            <!--<dd><a href="/cost/index.php/Home/Admin/financereportall">按单位礼品报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/financewarehouse">按单位消耗品报表</a></dd>-->
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">导出数据</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Admin/tablepers">导出报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/indextest">导出报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/test">导出报表</a></dd>
          </dl>
        </li>
        <!--<li class="layui-nav-item"><a href="/cost/index.php/Home/Admin/select">测试</a></li>-->
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <!-- 内容主体区域 -->
    <h1><div style="padding: 15px;">余杭区邮政费用分摊系统</div></h1>
    
    <br />
    <form class="layui-form" action="selectss" method="get"  style="width: 100%;">
						<table class="layui-table" style="text-align: center; width: 100%;">
					      <!--<colgroup>
					       <col width="10%">
					       <col width="10%">
					       <col width="7%">
					       <col width="10%">
					       <col width="10%">
					       <col width="10%">
					       <col width="8%">
					       <col width="8%">
					       <col width="15%">
					       <col width="8%">
					       <col width="10%">
					      </colgroup>-->
					    <tr>
								<td>单位名称</td>
								<td>期初库存不含税</td>
								<td>期初库存含税</td>
								<td>本期出库不含税</td>
								<td>本期出库含税</td>
								<td>本期入库不含税</td>
								<td>本期入库含税</td>
								<td>本期调拨出库不含税</td>
								<td>本期调拨出库含税</td>
								<td>期末结余不含税</td>
								<td>期末结余含税</td>
							</tr>
							<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<!--<td><input type="checkbox" name="id[]" value="<?php echo ($vo["pianquname"]); ?>" lay-skin="primary"></td>-->
								<td><?php echo ($vo["dwname"]); ?></td>
								<td><?php echo ($vo["first"]); ?></td>
								<td><?php echo ($vo["vatfirst"]); ?></td>
								<!--<td><?php echo ($vo["current"]); ?></td>
								<td><?php echo ($vo["vatcurrent"]); ?></td>-->
								<td><?php echo ($vo["out"]); ?></td>
								<td><?php echo ($vo["vatout"]); ?></td>
								<td><?php echo ($vo["in"]); ?></td>
								<td><?php echo ($vo["vatin"]); ?></td>
								<td><?php echo ($vo["outoa"]); ?></td>
								<td><?php echo ($vo["vatoutoa"]); ?></td>
								<td><?php echo ($vo["end"]); ?></td>
								<td><?php echo ($vo["vatend"]); ?></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					  </table>
		<!--<div class="layui-form-item">
		    	<div class="layui-input-block">
		      <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
		      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    	</div>
		  	</div>-->
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
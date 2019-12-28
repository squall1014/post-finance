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
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdinvest">积分卡按网点进行充值</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdfinance">积分卡按网点对账管理</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">财务报表</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Admin/financedwreportdate">按单位库存财务报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/financewhreportdate">按仓库库存财务报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/inboundreportdate">按日期入库库存财务报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/warehousedwreport">库存报表</a></dd>
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
    
    	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
			  <legend>按部门/网点财务报表</legend>
			</fieldset>
    	<form class="layui-form layui-form-pane" action="<?php echo U('financedwreport');?>" method="post">
    		
			<div class="layui-form-item" style="margin-left:50px;">
			    <div class="layui-inline">
			      <label class="layui-form-label">日期选择</label>
			      <div class="layui-input-block">
			        <input type="text" name="date_date" id="test6" autocomplete="off" class="layui-input">
			      </div>
			    </div>
			</div>
			<div class="layui-form-item" style="margin-left:50px;">
			    <div class="layui-inline">
			      <label class="layui-form-label">产品类型</label>
			      <div class="layui-input-block">
			        <select name="producttype" lay-verify="" lay-search>
						<option value="">请选择产品类型</option>
						<?php if(is_array($cptrr)): $i = 0; $__LIST__ = $cptrr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["producttypeid"]); ?>"><?php echo ($vo["producttype"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
			      </div>
			    </div>
			</div>
			<div class="layui-form-item" style="margin-left:50px;">
			    <div class="layui-inline">
			      <label class="layui-form-label">产品单位</label>
			      <div class="layui-input-block">
			        <select name="jgh" lay-verify="" lay-search>
						<option value="">请选择产品单位</option>
						<?php if(is_array($jdr)): $i = 0; $__LIST__ = $jdr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["jgh"]); ?>"><?php echo ($vo["dwname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
			      </div>
			    </div>
    		</div>
    		<br />
    		<br />
    		<div class="layui-form-item" style="margin-left:50px;">
           <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即查询</button>
           </div>
         </div>
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
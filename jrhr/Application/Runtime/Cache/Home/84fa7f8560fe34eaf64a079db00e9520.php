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
            	金融业务部
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="/jrhr/index.php/Home/Index/passwordedit">密码修改</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/jrhr/index.php/Home/Index/logout">退了</a></li>
    </ul>
  </div>
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      	<li class="layui-nav-item"><a href="/jrhr/index.php/Home/Index/index">首页</a></li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">积分项目管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/pointitemedit">积分项目大类管理</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/pointcontentedit">积分项目管理</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">机构网点积分报表管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/jrpointdwdate">按机构网点日报表</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jrpointdwdatesh">按机构网点未审核明细</a></dd>
            
            <dd><a href="/jrhr/index.php/Home/Index/jrpointdwdatetb">按机构网点日报表通报</a></dd>
            
            <dd><a href="/jrhr/index.php/Home/Index/jrpointdwdatefw">按机构网点范围报表汇总</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jrpointdwdatefwdt">按机构网点范围报表明细</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jrpointdwdatefwtb">按机构网点范围报表通报</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jrpointperspay">按员工奖金池月报报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">机构网点积分报表分析</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/jrpointdwitemdate">按机构网点按项目报表</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jrpointdwitemsdate">按机构网点按大类报表</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jrpointdwicdate">按机构网点大类项目混合报表</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jrpointdwdatetb">按机构网点日报表通报</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">机构网点行为量管理分析</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/jractdwdate">粽情端午节行为量日报表</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jractdwdatefw">粽情端午节行为量统计</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">每日午巡活动管理分析</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/jractivedwdate/activecontentid/1">每日午巡活动日报表</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jractivedwdatefw/activecontentid/1">每日午巡活动统计报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">每日日终活动管理分析</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/jractivedwdate/activecontentid/2">每日日终活动日报表</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jractivedwdatefw/activecontentid/2">每日日终活动统计报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">厅堂联动及网沙行为量</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/jractivebxdate/activecontentid/3">厅堂联动及网沙上报日报表</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jractivebxdatefw/activecontentid/3">厅堂联动及网沙上报统计报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">万上客户情况统计</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/jrtenthouinfoup">开户信息上传</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jrtenthoupt">万元客户情况统计</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jrtenthouinfoclean">开户信息清空</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">白名单客户统计</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/jrwhitedwdate">白名单录入情况统计</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jraccountinfopt">白名单定期存款情况</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">白名单客户管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/jraccountinfoup">开户信息上传</a></dd>
            <dd><a href="/jrhr/index.php/Home/Index/jraccountinfoclean">开户信息清空</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">ETC客户管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/jretccustpt">ETC客户情况报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">轮岗记录查询</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Index/jrlgtransferdate">轮岗记录查询</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item"><a href="/jrhr/index.php/Home/Index/qingjiacounts">JSON数据测试</a></li>
        <li class="layui-nav-item"><a href="/jrhr/index.php/Home/Index/select">测试</a></li>
        <!--<li class="layui-nav-item"><a href="/jrhr/index.php/Home/Index/select1">测试1</a></li>-->
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <!-- 内容主体区域 -->
    <h1><div style="padding: 15px;">余杭区金融积分考核系统</div></h1>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
			<legend>按机构网点日报表</legend>
		</fieldset>
        <form action="" enctype="multipart/form-data" method="post" class="layui-form" >
         <table class="layui-table" lay-size="" style="width: 60%">
         	<tr>
         		<th style="text-align:center;">网点</th>
         		<th style="text-align:center;">职务</th>
         		<th style="text-align:center;">姓名</th>
         		<th style="text-align:center;">业绩</th>
         		<th style="text-align:center;">总分</th>
         	</tr>
         	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
         		<th style="text-align:center;"><?php echo ($vo["dwname"]); ?></th>
         		<th style="text-align:center;"><?php echo ($vo["zhiwu"]); ?></th>
         		<th style="text-align:center;"><a href="/jrhr/index.php/Home/Index/jrpointdwdatepersinfo/gonghao/<?php echo ($vo["gonghao"]); ?>/date/<?php echo ($vo["date"]); ?>"><font color="#CC0000"><?php echo ($vo["persname"]); ?></font></a></th>
         		<th style="text-align:center;"><?php echo ($vo["points"]); ?></th>
         		<th style="text-align:center;"><?php echo ($vo["sums"]); ?></th>
         	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					<tr>
						<th></th>
						<th></th>
						<th style="text-align:center;">总计</th>
						<th style="text-align:center;"><?php echo ($point); ?></th>
						<th style="text-align:center;"><?php echo ($sum); ?></th>
					</tr>
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
    elem: '#date1' //指定元素
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
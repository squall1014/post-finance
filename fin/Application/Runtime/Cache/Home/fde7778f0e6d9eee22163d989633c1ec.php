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
      <li class="layui-nav-item">
        <a href="javascript:;">管理</a>
        <dl class="layui-nav-child">
          <dd><a href="/fin/index.php/home/index/jrpointshtimedw">审核开放期限</a></dd>
        </dl>
      </li>
      <!--<li class="layui-nav-item"><a href="/fin/index.php/home/index/passwordreset">用户密码管理</a></li>-->
      <li class="layui-nav-item">
        <a href="javascript:;">员工管理</a>
        <dl class="layui-nav-child">
          <dd><a href="/fin/index.php/home/index/passwordreset">员工密码管理</a></dd>
          <dd><a href="/fin/index.php/home/index/persstats">员工待岗管理</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">待开发</a></dd>
          <dd><a href="">待开发</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
            	<?php echo ($user['exp']); ?>--<?php echo ($user['district']); ?>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="/fin/index.php/home/index/passwordedit">密码修改</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/fin/index.php/home/index/logout">退了</a></li>
    </ul>
  </div>
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      	<li class="layui-nav-item"><a href="/fin/index.php/home/index/index">首页</a></li>
      	<li class="layui-nav-item">
          <?php if($user["auth"] == 9): ?><a class="" href="javascript:;">员工权限管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/index/lunganginfo">金融网点人员信息管理</a></dd>
            <dd><a href="/fin/index.php/home/index/lungangauth">金融网点人员权限管理</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<?php if($user["auth"] == 5): ?><a class="" href="javascript:;">积分项目管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/index/pointitemedit">积分项目大类管理</a></dd>
            <dd><a href="/fin/index.php/home/index/pointcontentedit">积分项目管理</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<?php if($user["auth"] == 5): ?><a class="" href="javascript:;">奖金池设置管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/index/bonusadd">网点奖金池设置</a></dd>
            <dd><a href="/fin/index.php/home/index/bonussearch">网点奖金池查询</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">机构网点积分报表管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/index/jrpointdwdatefw">网点积分汇总报表</a></dd>
            <dd><a href="/fin/index.php/home/index/jrpointdwdetailfw">网点积分汇总明细报表</a></dd>
            <dd><a href="/fin/index.php/home/index/jrpointdwdateshfw">网点审核汇总报表</a></dd>
            <dd><a href="/fin/index.php/home/index/jrpointdwdatenosh">网点未审核员工明细表</a></dd>
            <!--<dd><a href="/fin/index.php/home/index/jrpointdwdate">按机构网点日报表</a></dd>-->
            <!--<dd><a href="/fin/index.php/home/index/jrpointdwdatesh">按机构网点未审核明细</a></dd>-->
            
            <!--<dd><a href="/fin/index.php/home/index/jrpointdwdatetb">按机构网点日报表通报</a></dd>-->
            
            <!--<dd><a href="/fin/index.php/home/index/jrpointdwdatefw">按机构网点范围报表汇总</a></dd>-->
            <!--<dd><a href="/fin/index.php/home/index/jrpointdwdatefwdt">按机构网点积分明细（再建）</a></dd>-->
            <!--<dd><a href="/fin/index.php/home/index/jrpointdwdatefwtb">按机构网点积分通报（再建）</a></dd>-->
            <dd><a href="/fin/index.php/home/index/jrpointperspay">按员工奖金池月报报表（再建）</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">机构网点积分报表分析</a>
          <dl class="layui-nav-child">
            <!--<dd><a href="/fin/index.php/home/index/jrpointdwitemdate">按机构网点按项目报表（再建）</a></dd>-->
            <!--<dd><a href="/fin/index.php/home/index/jrpointdwitemsdate">按机构网点按大类报表（再建）</a></dd>-->
            <dd><a href="/fin/index.php/home/index/jrpointdwicdate">网点项目分类报表</a></dd>
            <!--<dd><a href="/fin/index.php/home/index/jrpointdwdatetb">按机构网点日报表通报（再建）</a></dd>-->
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">日爆点午巡活动管理分析</a>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/index/jractivedwdatefw/activecontentid/1">日爆点午巡活动统计报表</a></dd>
          </dl>
        </li>
        <!--<li class="layui-nav-item">
        	<a class="" href="javascript:;">日爆点日终活动管理分析</a>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/index/jractivedwdate/activecontentid/2">日爆点日终活动日报表</a></dd>
            <dd><a href="/fin/index.php/home/index/jractivedwdatefw/activecontentid/2">日爆点日终活动统计报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">厅堂联动及网沙行为量</a>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/index/jractivebxdate/activecontentid/3">厅堂联动及网沙上报日报表</a></dd>
            <dd><a href="/fin/index.php/home/index/jractivebxdatefw/activecontentid/3">厅堂联动及网沙上报统计报表</a></dd>
          </dl>
        </li>-->
        <!--<li class="layui-nav-item">
        	<a class="" href="javascript:;">轮岗记录查询</a>
          <dl class="layui-nav-child">
            <dd><a href="/fin/index.php/home/index/jrlgtransferdate">轮岗记录查询</a></dd>
          </dl>
        </li>-->
        <!--<li class="layui-nav-item"><a href="/fin/index.php/home/index/qingjiacounts">JSON数据测试</a></li>
        <li class="layui-nav-item"><a href="/fin/index.php/home/index/select">测试</a></li>-->
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <!-- 内容主体区域 -->
    <h1><div style="padding: 15px;">丽水市金融积分考核系统</div></h1>
    
    	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
			  <legend>按机构网点项目日报表</legend>
			</fieldset>
    	<form class="layui-form layui-form-pane" action="<?php echo U('jrpointdwicdates');?>" method="post" style="width: 100%;">
    		<div class="layui-form-item" style="margin-left:30px;">
			    <div class="layui-block">
			      <table class="layui-table" style="width: 100%;">
			      	<tr>
			      	<td>科目大类选择</td>
			      	<td>科目选择</td>
			      	</tr>
			      	
			      	<div class="layui-input-block">
			      	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			      	<td>
			        <input type="checkbox" name="item[]" id="" value="<?php echo ($vo["pointitemid"]); ?>" title="<?php echo ($vo["item"]); ?>" autocomplete="off" class="layui-input">
			      	</td>
			      	
			      	
			      	<td>
			      	<?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i; if($vo['pointitemid'] == $vo[$vos['pointcontentid']]['pointitemid']): ?><input type="checkbox" name="content[]" value="<?php echo ($vo[$vos['pointcontentid']]['pointcontentid']); ?>" title="<?php echo ($vo[$vos['pointcontentid']]['content']); ?>" >
			      		<?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
			      	</td>
			      	 </tr><?php endforeach; endif; else: echo "" ;endif; ?>
			      </div>
			     
			      </table>
			    </div>
    		</div>
    		<div class="layui-form-item" style="margin-left:50px;">
			    <div class="layui-inline">
			      <label class="layui-form-label">日期选择</label>
			      <div class="layui-input-block">
			        <input type="text" name="date_date" id="test6" autocomplete="off" class="layui-input">
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
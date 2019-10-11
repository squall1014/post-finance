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
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">瑞安市金融积分考核系统</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">管理</a>
        <dl class="layui-nav-child">
          <dd><a href="/rafin/index.php/Home/Index/jrpointshtime">审核开放期限</a></dd>
        </dl>
      </li>
      <!--<li class="layui-nav-item"><a href="/rafin/index.php/Home/Index/passwordreset">用户密码管理</a></li>-->
      <li class="layui-nav-item">
        <a href="javascript:;">员工管理</a>
        <dl class="layui-nav-child">
          <dd><a href="/rafin/index.php/Home/Index/passwordreset">员工密码管理</a></dd>
          <dd><a href="/rafin/index.php/Home/Index/persstats">员工待岗管理</a></dd>
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
          <dd><a href="/rafin/index.php/Home/Index/passwordedit">密码修改</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/rafin/index.php/Home/Index/logout">退了</a></li>
    </ul>
  </div>
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      	<li class="layui-nav-item"><a href="/rafin/index.php/Home/Index/index">首页</a></li>
      	<li class="layui-nav-item">
          <?php if($user["auth"] == 9): ?><a class="" href="javascript:;">员工权限管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/rafin/index.php/Home/Index/lunganginfo">金融网点人员信息管理</a></dd>
            <dd><a href="/rafin/index.php/Home/Index/lungangauth">金融网点人员权限管理</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<?php if($user["auth"] == 5): ?><a class="" href="javascript:;">积分项目管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/rafin/index.php/Home/Index/pointitemedit">积分项目大类管理</a></dd>
            <dd><a href="/rafin/index.php/Home/Index/pointcontentedit">积分项目管理</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<?php if($user["auth"] == 5): ?><a class="" href="javascript:;">奖金池设置管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/rafin/index.php/Home/Index/bonusadd">网点奖金池设置</a></dd>
            <dd><a href="/rafin/index.php/Home/Index/bonussearch">网点奖金池查询</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">机构网点积分报表管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/rafin/index.php/Home/Index/jrpointdwdatefw">网点积分汇总报表</a></dd>
            <dd><a href="/rafin/index.php/Home/Index/jrpointdwdetailfw">网点积分汇总明细报表</a></dd>
          	<dd><a href="/rafin/index.php/Home/Index/jrpointdwdateshfw">网点审核汇总报表</a></dd>
            <!--<dd><a href="/rafin/index.php/Home/Index/jrpointdwdate">按机构网点日报表</a></dd>-->
            <!--<dd><a href="/rafin/index.php/Home/Index/jrpointdwdatesh">按机构网点未审核明细</a></dd>-->
            
            <!--<dd><a href="/rafin/index.php/Home/Index/jrpointdwdatetb">按机构网点日报表通报</a></dd>-->
            
            <!--<dd><a href="/rafin/index.php/Home/Index/jrpointdwdatefw">按机构网点范围报表汇总</a></dd>-->
            <!--<dd><a href="/rafin/index.php/Home/Index/jrpointdwdatefwdt">按机构网点积分明细（再建）</a></dd>-->
            <!--<dd><a href="/rafin/index.php/Home/Index/jrpointdwdatefwtb">按机构网点积分通报（再建）</a></dd>-->
            <dd><a href="/rafin/index.php/Home/Index/jrpointperspay">按员工奖金池月报报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">机构网点积分报表分析</a>
          <dl class="layui-nav-child">
            <!--<dd><a href="/rafin/index.php/Home/Index/jrpointdwitemdate">按机构网点按项目报表（再建）</a></dd>-->
            <!--<dd><a href="/rafin/index.php/Home/Index/jrpointdwitemsdate">按机构网点按大类报表（再建）</a></dd>-->
            <dd><a href="/rafin/index.php/Home/Index/jrpointdwicdate">网点项目分类报表</a></dd>
            <!--<dd><a href="/rafin/index.php/Home/Index/jrpointdwdatetb">按机构网点日报表通报（再建）</a></dd>-->
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">日爆点午巡活动管理分析</a>
          <dl class="layui-nav-child">
            <dd><a href="/rafin/index.php/Home/Index/jractivedwdatefw/activecontentid/1">日爆点午巡活动统计报表</a></dd>
          </dl>
        </li>
        <!--<li class="layui-nav-item">
        	<a class="" href="javascript:;">日爆点日终活动管理分析</a>
          <dl class="layui-nav-child">
            <dd><a href="/rafin/index.php/Home/Index/jractivedwdate/activecontentid/2">日爆点日终活动日报表</a></dd>
            <dd><a href="/rafin/index.php/Home/Index/jractivedwdatefw/activecontentid/2">日爆点日终活动统计报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<a class="" href="javascript:;">厅堂联动及网沙行为量</a>
          <dl class="layui-nav-child">
            <dd><a href="/rafin/index.php/Home/Index/jractivebxdate/activecontentid/3">厅堂联动及网沙上报日报表</a></dd>
            <dd><a href="/rafin/index.php/Home/Index/jractivebxdatefw/activecontentid/3">厅堂联动及网沙上报统计报表</a></dd>
          </dl>
        </li>-->
        <!--<li class="layui-nav-item">
        	<a class="" href="javascript:;">轮岗记录查询</a>
          <dl class="layui-nav-child">
            <dd><a href="/rafin/index.php/Home/Index/jrlgtransferdate">轮岗记录查询</a></dd>
          </dl>
        </li>-->
        <!--<li class="layui-nav-item"><a href="/rafin/index.php/Home/Index/qingjiacounts">JSON数据测试</a></li>
        <li class="layui-nav-item"><a href="/rafin/index.php/Home/Index/select">测试</a></li>-->
      </ul>
    </div>
  </div>
<style type="text/css">
	.layui-body{overflow-y: scroll;}
</style>
  <div class="layui-body">
    <!-- 内容主体区域 -->
	<h1><div style="padding: 15px;">瑞安市金融积分考核系统</div></h1>
	
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
	<legend>按机构网点积分明细表</legend>
</fieldset>
<form action="" id="form-select" enctype="multipart/form-data" method="post" class="layui-form">
	<div class="layui-card-body">
		<div class="layui-inline">
			<label class="layui-form-label">日期选择</label>
			<div class="layui-input-block">
				<input type="text" value="" name="date" id="test6" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-inline">
			<label class="layui-form-label">网点选择</label>
			<div class="layui-input-block">
				<select name="dwname" id="dwname" lay-search>
					<option value=""></option>
					<?php if(is_array($drr)): $i = 0; $__LIST__ = $drr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["dwnameid"]); ?>"><?php echo ($vo["dwname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</div>
		<div class="layui-inline">
			<label class="layui-form-label">分值类型</label>
			<div class="layui-input-block">
				<select name="point_sum" id="point_sum" lay-verify="required" lay-search>
					<option value="point">业绩</option>
					<option value="sum">总分</option>
				</select>
			</div>
		</div>
		<div class="layui-inline">
			<button class="layui-btn" lay-submit lay-filter="formDemo">立即查询</button>
		</div>
	</div>
	<div class="layui-card-body">
		<div style="overflow:scroll;">
			<table class="layui-table" lay-size="" id="table-show">
				<!-- <tr>
					<th style="text-align:center;">网点</th>
					<?php if(is_array($datefwss)): $i = 0; $__LIST__ = $datefwss;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vodate): $mod = ($i % 2 );++$i;?><th style="text-align:center;"><?php echo ($vodate); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
				</tr>
				<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						<th style="text-align:center;"><a href="/rafin/index.php/Home/Index/jrpointdwdatefwpers/jgh/<?php echo ($vo["jgh"]); ?>"><?php echo ($vo["dwname"]); ?></th>
						<?php if(is_array($datefwss)): $i = 0; $__LIST__ = $datefwss;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vodate): $mod = ($i % 2 );++$i;?><th style="text-align:center;"><?php echo ($vo[$vodate]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?> -->
			</table>
		</div>
	</div>
	<br />
	<!--<div class="layui-form-item" style="margin-left:100px;">
	           <div class="layui-input-block">
	            <button class="layui-btn" lay-submit lay-filter="formDemo">导出</button>
	            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
	           </div>
	         </div>-->
</form>
</div>
<!--底部-->
<div class="layui-footer">
    <!-- 底部固定区域 -->
    © 瑞安市金融积分考核系统
  </div>
</div>
<script src="/rafin/Public/layui.all.js"></script>
<script src="/rafin/Public/jquery-1.12.4.min.js"></script>
<script text/JavaScript>
	$("#form-select").on('submit',function(){
		table_show();
		event.preventDefault();
	})
	function table_show(){
		var dwname = document.getElementById("dwname").value;
		var date = document.getElementById("test6").value;
		var point_sum = document.getElementById("point_sum").value
		$.ajax({
        type:"post",
        url:'<?php echo U("jrpointdwdetailfws");?>',
        data:{
			dwname: dwname,
			date: date,
			point_sum : point_sum,
		},
		
        success:function (data) {
			// var data=data.split("-");
			// data = eval("("+data+")");
			// console.log(data);
			data = JSON.parse(data);
			th = JSON.parse(data[0]);
			datas = JSON.parse(data[1]);

			// console.log(datas);

			var html = "";
			html = html + '<tr>';
			html = html + '<th>';
			html = html + '网点';
			html = html + '</th>';
			html = html + '<th>';
			html = html + '姓名';
			html = html + '</th>';
			html = html + '<th>';
			html = html + '职务';
			html = html + '</th>';
			for(i = 0; i < th.length; i ++){
				html = html + '<th>';
				html = html + th[i]['content'];
				html = html + '</th>';
			}
			html = html + '</tr>';

			for(i = 0; i < datas.length; i ++){

				html = html + '<tr>';

				html = html + '<th>'

				html = html + datas[i]['dwname'];

				html + html + '</th>';

				html = html + '<th>'

				html = html + datas[i]['persname'];
				
				html + html + '</th>';
				
				html = html + '<th>'

				html = html + datas[i]['zhiwu'];

				html + html + '</th>';
				console.log(datas[i]['gonghao']);
					for (y = 0; y < th.length; y++) {
							console.log(th[y]['pointcontentid']);
							html = html + '<th>';
							//三位数组；需要在后台获取所有数值，方可显示；
							html = html + datas[i][datas[i]['gonghao']][th[y]['pointcontentid']]['sums'];

							html + html + '</th>';
						}

				html = html + '</tr>';

			}

			$("#table-show").html(html);
			// console.log(html);

        }
    });
	}
</script>
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
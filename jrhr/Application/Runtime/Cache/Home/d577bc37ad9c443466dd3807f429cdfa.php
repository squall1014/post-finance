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

        <form action="<?php echo U('etccustmodifysuc');?>" id="form" enctype="multipart/form-data" method="post" class="layui-form" >
        <div class="layui-card" style="width: 100%;">
        	<div class="layui-card-header">
        		<font size="4">ETC客户引荐修改</font>
        	</div>
        <div class="layui-card-body">
		<table class="layui-table" lay-size="">
			<input type="hidden" name="etccustid" value="<?php echo ($data[0]['etccustid']); ?>">
			<tr>
				<th>
					<font color="#FF0000">*</font>车主车牌
				</th>
				<td>
					<input type="text" name="carcard" value="<?php echo ($data[0]['carcard']); ?>" id="carcard" required lay-verify=""
						placeholder="请输入行驶证车牌" autocomplete="off" class="layui-input">
				</td>
				<th>
					<font color="#FF0000">*</font>行驶证车主姓名
				</th>
				<td>
					<input type="text" name="carcustname" value="<?php echo ($data[0]['carcustname']); ?>" id="carcustname" required lay-verify=""
						placeholder="请输入行驶证车主姓名" autocomplete="off" class="layui-input">
				</td>
				<th>
					<font color="#FF0000">*</font>行驶证车主身份证
				</th>
				<td>
					<input type="text" name="carsfz" id="carsfz" value="<?php echo ($data[0]['carsfz']); ?>" required lay-verify="identity" placeholder="请输入行驶证车主身份证"
						autocomplete="off" class="layui-input">
				</td>
				<th>
					<font color="#FF0000">*</font>车主联系电话
				</th>
				<td>
					<input type="text" name="carphone" id="carphone" value="<?php echo ($data[0]['carphone']); ?>" required lay-verify="required" placeholder="请输入客户银行卡号" autocomplete="off"
						class="layui-input">
				</td>
		
		
			</tr>
			<tr>
				
				<th>
					<font color="#FF0000">*</font>引荐人
				</th>
				<td>
					<input type="text" name="referee" value="<?php echo ($data[0]['referee']); ?>" id="referee" required lay-verify="required" placeholder="请输入客户引荐人姓名"
						autocomplete="off" class="layui-input">
				</td>
				<th>
					<font color="#FF0000">*</font>引荐人部门
				</th>
				<td>
					<div id="redwname" style="display: block">
						<select name="refereedwname" id="refereedwname" lay-verify="required" lay-search>
							<option value="<?php echo ($data[0]['refereedwname']); ?>"><?php echo ($data[0]['refereedwnames']); ?></option>
							<?php if(is_array($jdrr)): $i = 0; $__LIST__ = $jdrr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["jgh"]); ?>"><?php echo ($vo["dwname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</td>
				
				<th>
					<font color="#FF0000">*</font>签约日期
				</th>
				<td>
					<input type="text" name="signdate" id="date" value="<?php echo ($data[0]['signdate']); ?>" placeholder="请点击选择日期" autocomplete="off" required lay-verify=""
						class="layui-input">
				</td>
			</tr>
			<tr>
				<th>
					<font color="#FF0000">*</font>绑定ETC银行卡号
				</th>
				<td>
					<input type="text" name="card" value="<?php echo ($data[0]['card']); ?>" required lay-verify="required" placeholder="请输入客户银行卡号" autocomplete="off"
						class="layui-input">
				</td>
				<th>
					<font color="#FF0000">*</font>持卡人身份证
				</th>
				<td>
					<input type="text" name="sfz" id="sfz" value="<?php echo ($data[0]['sfz']); ?>" onblur="sfzs()" required lay-verify="identity" placeholder="请输入客户身份证"
						autocomplete="off" class="layui-input">
				</td>
				<th>
					<font color="#FF0000">*</font>持卡人姓名
				</th>
				<td>
					<input type="text" name="custname" value="<?php echo ($data[0]['custname']); ?>" id="custname" required lay-verify="required" placeholder="请输入客户姓名" autocomplete="off"
						class="layui-input">
				</td>
				<th>
					<font color="#FF0000">*</font>持卡人联系电话
				</th>
				<td>
					<input type="text" name="phone" id="phone" value="<?php echo ($data[0]['phone']); ?>" required lay-verify="number" placeholder="请输入客户联系方式" autocomplete="off"
						class="layui-input">
				</td>
		
			</tr>
			<tr>
				<th>备注</th>
				<td colspan="7">
					<textarea placeholder="请输入需要备注的内容" class="layui-textarea" name="beizhu"></textarea>
				</td>
		
			</tr>
		</table>
    	</div>
    </div>
         <br />
         <div class="layui-form-item" style="margin-left:360px;">
           <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
           </div>
         </div>
        </form>
  </div>
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © 余杭区金融积分考核系统
  </div>
<script src="/jrhr/Public/layui.all.js"></script>

<script>

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
	
	// layui.use('form', function(){
	//   var form = layui.form;
	//   //获取types1控件中的数据
	// 	form.on('select(servicebak1)', function(data){
	// 		if(document.getElementById("xszb").style.visibility == "visible"){
				
	// 		}else{
	// 			document.getElementById("xszb").style.visibility = "visible";
	// 			document.getElementById("xszb1").style.visibility = "visible";
	// 			document.getElementById("percentagebak").value = "0.5";
	// 		}
			
			
	// 	});
  
	// });
	
</script>
<!--底部-->
</body>
</html>
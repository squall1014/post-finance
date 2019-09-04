<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--大标题和JS-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>余杭区邮政保险理财客户管理系统</title>
  <link rel="stylesheet" href="/ins/Public/css/layui.css">
</head>

<!--前左导航-->
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">邮政保险理财客户管理系统</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item">
        <a href="javascript:;">控制台</a>
        <dl class="layui-nav-child">
        	<!--管理部门权限设置-->
          <?php if($user["username"] == jrywb): if($user["jrywbqx"] == 1): else: endif; ?>
          <?php else: endif; ?>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/ins/index.php/Home/Index/ceshi">管理</a></li>
      <li class="layui-nav-item"><a href="">用户管理</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="../../../../../jrhr/index.php/home/login/login">金融考核系统</a></dd>
          <!--<dd><a href="../../../../../cost/index.php/home/login/login">费用分摊系统</a></dd>-->
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                      <?php echo ($user["user"]); ?>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="/ins/index.php/Home/Index/passwordedit">密码修改</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/ins/index.php/Home/Index/logout">退了</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      	<li class="layui-nav-item"><a href="/ins/index.php/Home/Index/index">首页</a></li>
        <?php if($user["qx"] >= 8): ?><li class="layui-nav-item"><a href="/ins/index.php/Home/Index/backlog">待办事项</a></li><?php else: endif; ?>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">客户信息管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/ins/index.php/Home/Index/clientinfoadd">客户信息新增</a></dd>
            <dd><a href="/ins/index.php/Home/Index/clientinfosearch">客户信息查询</a></dd>
          </dl>
        </li>
        
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">保险客户管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
          	
            <dd><a href="/ins/index.php/Home/Index/clientinfoadd">保险客户新增</a></dd>
            <dd><a href="/ins/index.php/Home/Index/clientinssearch">保险客户查询</a></dd>
            <dd><a href="/ins/index.php/Home/Index/clientinsreport">保险客户报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">保险客户操作管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
          	
            <dd><a href="/ins/index.php/Home/Index/clientinshesi">保险客户犹豫期退保</a></dd>
            <dd><a href="/ins/index.php/Home/Index/clientinsadv">保险客户中途退保</a></dd>
            <dd><a href="/ins/index.php/Home/Index/clientinsexp">保险客户满期给付</a></dd>
            <dd><a href="/ins/index.php/Home/Index/clientinsdel">保险客户信息删除</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">保险白名单客户</a><?php else: endif; ?>
          <dl class="layui-nav-child">
          	
            <dd><a href="/ins/index.php/Home/Index/clientinswhiteadd">保险白名单客户新增</a></dd>
            <dd><a href="/ins/index.php/Home/Index/clientinswhitesearch">保险白名单客户查询</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">理财客户管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/ins/index.php/Home/Index/clientfinadd">理财客户新增</a></dd>
            <dd><a href="/ins/index.php/Home/Index/clientfinsearch">理财客户查询</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">2019年前帐套</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/ins/index.php/Home/Index/clientoldrecord">老资料-没事儿别点</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<?php if($user["qx"] >= 8): ?><a class="" href="javascript:;">基础信息编辑</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/ins/index.php/Home/Index/refundedit">资金去向信息编辑</a></dd>
            <dd><a href="/ins/index.php/Home/Index/channeledit">渠道信息编辑</a></dd>
            <dd><a href="/ins/index.php/Home/Index/facilitateedit">促成方式信息编辑</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<?php if($user["qx"] >= 8): ?><a class="" href="javascript:;">保险产品信息编辑</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/ins/index.php/Home/Index/insuranceedit">保险产品信息编辑</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<?php if($user["qx"] >= 8): ?><a class="" href="javascript:;">保险产品信息报表</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/ins/index.php/Home/Index/inswdreport">按网点取数报表</a></dd>
            <dd><a href="/ins/index.php/Home/Index/inspersreport">按员工取数报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 8): ?><a class="" href="javascript:;">保险客户信息报表</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/ins/index.php/Home/Index/insclientreport">保险客户报表按投保日</a></dd>
            <dd><a href="/ins/index.php/Home/Index/tablepers">保险客户报表按到期日</a></dd>
          </dl>
        </li>
        <!--<li class="layui-nav-item"><a href="/ins/index.php/Home/Index/qingjiacounts">JSON数据测试</a></li>-->
      </ul>
    </div>
  </div>
  


  <div class="layui-body">
    <!-- 内容主体区域 -->
<!-- 内容主体区域 -->
<h1><div style="padding: 15px;">余杭区邮政保险理财客户管理系统</div></h1>
    <br />

        <form action="<?php echo U('clientsearchsuc');?>" enctype="multipart/form-data" method="post" class="layui-form" >
        <div class="layui-card" style="width: 100%;">
        	<div class="layui-card-header">
        		<font size="4">保险客户查询、维护</font>
        	</div>
		<div class="layui-card-body">
		
			<table class="layui-table" style="text-align: center; width: 100%;">
				<!-- <colgroup>
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
				</colgroup> -->
				<tr>
					<td>网点</td>
					<td>客户姓名</td>
					<td>身份证</td>
					<td>联系方式</td>
					<td>家庭住址</td>
					<td>保险意向</td>
					<td>客户经理</td>
					<td>录入时间</td>
					<td>状态</td>
					<td>操作</td>
				</tr>
				<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($vo["dwnames"]); ?></td>
						<td><?php echo ($vo["whitecust"]); ?></td>
						<td><?php echo ($vo["sfz"]); ?></td>
						<td><?php echo ($vo["phone"]); ?></td>
						<td><?php echo ($vo["address"]); ?></td>
						<td><?php echo ($vo["intentions"]); ?></td>
						<td><?php echo ($vo["service"]); ?></td>
						<td><?php echo ($vo["insdate"]); ?></td>
						<?php if($vo["stats"] == 0): ?><td>有效</td><?php endif; ?>
						<?php if($vo["stats"] == 1): ?><td>
								<font color="#CC0000">无效</font>
							</td><?php endif; ?>
						<td><a href="/ins/index.php/Home/Index/clientinswhitemodify/whitecustid/<?php echo ($vo["whitecustid"]); ?>">
								<font color="#BB0000">维护</font>
							</a></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</table>
         </div>
         </div>
         <br />
        </form>
  </div>
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © 余杭区邮政保险理财客户管理
  </div>
<script src="/ins/Public/layui.all.js"></script>

<script>
	
	layui.use('element', function(){
  var element = layui.element;
  
	});
	
	layui.use('form', function(){
	  var form = layui.form;
	  //获取types1控件中的数据
		form.on('select(types1)', function(data){
			var datas = eval(<?php echo ($insr); ?>);
			for(i = 0 ; i < datas.length ; i++){
				
				if(data.value == datas[i].insuranceid){
					document.getElementById("payment2").value = datas[i].pay + '年';
					
					document.getElementById("duration2").value = datas[i].dur + '年';
					
					//alert(datas[i].dur);
					break;
				}
			}
			
		});
  
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
	
	layui.use('form', function(){
	  var form = layui.form;
	  //获取types1控件中的数据
		form.on('select(servicebak1)', function(data){
			if(document.getElementById("xszb").style.visibility == "visible"){
				
			}else{
				document.getElementById("xszb").style.visibility = "visible";
				document.getElementById("xszb1").style.visibility = "visible";
				document.getElementById("percentagebak").value = "0.5";
			}
			
			
		});
  
	});
	
</script>
<!--底部-->
</body>
</html>
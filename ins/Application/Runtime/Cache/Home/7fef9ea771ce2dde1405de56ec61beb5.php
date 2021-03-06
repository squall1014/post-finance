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
            <dd><a href="/ins/index.php/Home/Index/clientinsexp">保险客户满期给付</a></dd>
            <dd><a href="/ins/index.php/Home/Index/clientinsdel">保险客户信息删除</a></dd>
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

        <form action="<?php echo U('clientinssearchs');?>" enctype="multipart/form-data" method="post" class="layui-form" >
        <div class="layui-card" style="width: 100%;">
        	<div class="layui-card-header">
        		<font size="4">保险客户查询</font>
        	</div>
        <div class="layui-card-body">
        <table class="layui-table" lay-size="">
         	
         	<tr>
         	 <th>客户姓名</th>
         	 <td>
         	 	
         	 	<input type="text" name="client" value="" placeholder="请输入客户姓名" autocomplete="off" class="layui-input">
         	 </td>
         	 <th>客户身份证</th>
         	 <td>
         	 	
         	 	<input type="text" name="sfz" value="" placeholder="请输入客户身份证" autocomplete="off" class="layui-input">
         	 </td>
         	 <th>客户电话</th>
         	 <td>
         	 	<input type="text" name="phone" value="" placeholder="请输入客户电话" autocomplete="off" class="layui-input">
         	 </td>
         	 <th>客户地址</th>
         	 <td>
         	 	<input type="text" name="address" placeholder="请输入客户地址" value="" autocomplete="off" class="layui-input">
         	 </td>
         	</tr>
         	<tr>
         	<div class="layui-form-item">
         	 <th>购买险种</th>
         	 <td>
         	 	<select name="types" lay-filter="types1" lay-search>
         	 		<option value=""></option>
         	 		<?php if(is_array($insrr)): $i = 0; $__LIST__ = $insrr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["insuranceid"]); ?>"><?php echo ($vo["types"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
         	 </td>
         	 <th>保险公司</th>
         	 <td><input type="text" name="insurance" id="insurance2" disabled="disabled" placeholder="请输入保险公司" autocomplete="off" class="layui-input"> </td>
         	</div>
         	 <th>缴费方式</th>
         	 <td>
         	 	<input type="text" id="payment2" disabled="disabled" lay-filter="payment1" placeholder="请输入缴费方式" autocomplete="off" class="layui-input">
         	 	
         	 </td>
         	 
         	 <th>最低退保期限</th>
         	 <td>
         	 	<input type="text" id="duration2" disabled="disabled" lay-filter="duration1" placeholder="请输入最低退保期限" autocomplete="off" class="layui-input">
         	 	
         	 </td>
         	 
         	</tr>
         	<tr>
         	 <th>投保金额(万元)</th>
         	 <td><input type="text" name="money" placeholder="(万元)" autocomplete="off" class="layui-input"> </td>
         	 <th>出单渠道</th>
         	 <td>
         	 	<select name="channel" lay-search>
         	 		<option value=""></option>
         	 		<?php if(is_array($calrr)): $i = 0; $__LIST__ = $calrr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["channelid"]); ?>"><?php echo ($vo["channel"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
         	 </td>
	         	<th>促成方式</th>
         	 <td>
         	 	<select name="facilitate" lay-search>
         	 		<option value=""></option>
         	 		<?php if(is_array($flrr)): $i = 0; $__LIST__ = $flrr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["facilitateid"]); ?>"><?php echo ($vo["facilitate"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
         	 </td>
         	 
         	 <th>投保日期</th>
         	 <td>
         	 	<input type="text" name="insdate" id="date" placeholder="请选择保险日期" autocomplete="off" class="layui-input">
         	 </td>
         	 
         	 </tr>
         	 <tr>
         	 <th>销售人员</th>
         	 <td>
         	 	<select name="service" lay-search>
         	 		<option value=""></option>
         	 		<?php if(is_array($lgrr)): $i = 0; $__LIST__ = $lgrr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["persname"]); ?>"><?php echo ($vo["persname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
         	 </td>
         	 <th>销售人员备</th>
         	 <td>
         	 	<select name="servicebak" lay-filter="servicebak1" id="servicebak" lay-search>
         	 		<option value="">NULL</option>
         	 		<?php if(is_array($lgrr)): $i = 0; $__LIST__ = $lgrr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["persname"]); ?>"><?php echo ($vo["persname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
         	 </td>
         	 <th style="visibility: hidden;" id="xszb">销售占比</th>
         	 <td style="visibility: hidden;" id="xszb1">
         	 	<select name="percentagebak" id="percentagebak" lay-search>
         	 		<option value=""></option>
              <option value="0.1">10%</option>
              <option value="0.2">20%</option>
              <option value="0.3">30%</option>
              <option value="0.4">40%</option>
              <option value="0.5">50%</option>
              <option value="0.6">60%</option>
              <option value="0.7">70%</option>
              <option value="0.8">80%</option>
              <option value="0.9">90%</option>
              <option value="1">100%</option>
            </select>
         	 </td>
         	</tr>
         	
         </table>
         </div>
         
         </div>
         <br />
         <div class="layui-form-item" style="margin-left:360px;">
           <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即查询</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
           </div>
         </div>
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
					
					document.getElementById("insurance2").value = datas[i].insurance;
					
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
			}
			
			
		});
  
	});
	
</script>
<!--底部-->
</body>
</html>
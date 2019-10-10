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
        	<a class="" href="javascript:;">每日午巡活动上报</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveup/activecontentid/1">每日午巡活动上报</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveupmodify/activecontentid/1">每日午巡活动修改</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveupsh/activecontentid/1">每日午巡活动审核</a></dd>
          </dl>
       </li>
       <li class="layui-nav-item">
        	<a class="" href="javascript:;">每日日终活动上报</a>
          <dl class="layui-nav-child">
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveup/activecontentid/2">每日日终活动上报</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveupmodify/activecontentid/2">每日日终活动修改</a></dd>
            <dd><a href="/jrhr/index.php/Home/Admin/jractiveupsh/activecontentid/2">每日日终活动审核</a></dd>
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
            <dd><a href="/jrhr/index.php/Home/Admin/whitecustinfoperspt">白名单有效存款情况</a></dd>
            
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

        <form action="<?php echo U('whitecustmodifysuc');?>" enctype="multipart/form-data" method="post" class="layui-form" >
        <div class="layui-card" style="width: 100%;">
        	<div class="layui-card-header">
        		<font size="4">白名单客户修改</font>
        	</div>
        <div class="layui-card-body">
        <table class="layui-table" lay-size="">
         	
         	<tr>
         	<input type="hidden" value="<?php echo ($jwrr[0]['whitecustid']); ?>" name="whitecustid" />
         	 <th><font color="#FF0000">*</font>身份证</th>
         	 <td>
         	 	<input type="text" name="sfz" id="sfz" value="<?php echo ($jwrr[0]['sfz']); ?>" required lay-verify="identity" placeholder="请输入客户身份证" autocomplete="off" class="layui-input">
         	 </td>
         	 <th><font color="#FF0000">*</font>客户姓名</th>
         	 <td>
         	 	<input type="text" name="custname" value="<?php echo ($jwrr[0]['custname']); ?>" required lay-verify="required" placeholder="请输入客户姓名" autocomplete="off" class="layui-input">
         	 </td>
         	 <th><font color="#FF0000">*</font>联系电话</th>
         	 <td>
         	 	<input type="text" name="phone" value="<?php echo ($jwrr[0]['phone']); ?>" required lay-verify="number" placeholder="请输入客户联系方式" autocomplete="off" class="layui-input">
         	 </td>
         	 <th><font color="#FF0000">*</font>客户地址</th>
         	 <td>
         	 	<input type="text" name="address" value="<?php echo ($jwrr[0]['address']); ?>" required lay-verify="required" placeholder="请输入客户地址" autocomplete="off" class="layui-input">
         	 </td>
         	 </tr>
         	 	
         	 <tr>
         	 <th><font color="#FF0000">*</font>村社名称</th>
         	 <td>
         	 	<select name="village" lay-verify="required" lay-search>
         	 		<option value="<?php echo ($jwrr[0]['village']); ?>"><?php echo ($jwrr[0]['villages']); ?></option>
         	 		<?php if(is_array($jvrr)): $i = 0; $__LIST__ = $jvrr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["villageid"]); ?>"><?php echo ($vo["village"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
         	 </td>
         	 <th><font color="#FF0000">*</font>客户来源</th>
         	 <td>
         	 	<select name="source" lay-verify="required" lay-search>
         	 		<option value="<?php echo ($jwrr[0]['source']); ?>"><?php echo ($jwrr[0]['sources']); ?></option>
         	 		<?php if(is_array($jsrr)): $i = 0; $__LIST__ = $jsrr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["sourceid"]); ?>"><?php echo ($vo["source"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
			  </td>
			</td>
			<th><font color="#FF0000">*</font>资金来源</th>
			<td>
				<select name="fundsource" lay-verify="required" lay-search>
					<option value="<?php echo ($jwrr[0]['fundsource']); ?>"><?php echo ($jwrr[0]['fundsources']); ?></option>
					<?php if(is_array($jfsr)): $i = 0; $__LIST__ = $jfsr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["fundsourceid"]); ?>"><?php echo ($vo["fundsource"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		  </select>
			</td>
         	 <th>维护方式</th>
         	 <td>
         	 	<select name="maintenance" lay-search>
         	 		<option value="<?php echo ($jwrr[0]['maintenance']); ?>"><?php echo ($jwrr[0]['maintenances']); ?></option>
         	 		<?php if(is_array($jmrr)): $i = 0; $__LIST__ = $jmrr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["maintenanceid"]); ?>"><?php echo ($vo["maintenance"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
         	 
         	 
         	 
         	 
         	</tr>
         	
         	 <tr>
				<th>意向产品</th>
				<td colspan="7">
					<?php if(is_array($jprr)): $i = 0; $__LIST__ = $jprr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["status"] == 1): ?><input type="checkbox" name="product[<?php echo ($vo["productid"]); ?>]" title="<?php echo ($vo["product"]); ?>" checked="">
								
							<?php else: ?>
								<input type="checkbox" name="product[<?php echo ($vo["productid"]); ?>]" title="<?php echo ($vo["product"]); ?>"><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						
					</volist>
				</td>
			</tr>
			<tr>

			
         	 <th>备注</th>
         	 <td colspan="7">
					<input type="text" name="beizhu" value="<?php echo ($jwrr[0]['beizhu']); ?>" placeholder="备注" autocomplete="off" class="layui-input">
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
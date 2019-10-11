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

  <div class="layui-body">
    <!-- 内容主体区域 -->
    <h1><div style="padding: 15px;">瑞安市金融积分考核系统</div></h1>
    
    <br />
    <div class="layui-card" style="width: 100%;">
        	<div class="layui-card-header">
        		<font size="4">积分项目大类管理</font>
        	</div>
        <div class="layui-card-body">
        
					<table class="layui-hide" id="test" lay-filter="test"></table>
					
					<script type="text/html" id="switchTpl">
					  <!-- 这里的 checked 的状态只是演示 -->
					  <input type="checkbox" id="{{d.pointitemid}}" name="stats" value="{{d.pointitemid}}" lay-skin="switch" lay-text="启用|停用" lay-filter="sexDemo" {{ d.stats == 0 ? 'checked' : '' }}>
					</script>
					
					<script type="text/html" id="toolbarDemo">
					  <div class="layui-btn-container">
					    <button class="layui-btn layui-btn-sm" lay-event="getCheckData">查看项目</button>
					    <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">添加项目</button>
					    <button class="layui-btn layui-btn-sm" lay-event="getCheckstats">批量停用</button>
					  </div>
					</script>
					
					<script type="text/html" id="barDemo">
					  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
					  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
					</script>
         </div>
        </div>
  </div>
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © 瑞安市金融积分考核系统
  </div>
<script src="/rafin/Public/layui.all.js"></script>
<script src="/rafin/Public/jquery-1.12.4.min.js"></script>

<script>
	layui.use('table', function(){
  var table = layui.table;
  var form = layui.form;
  table.render({
    elem: '#test'
    ,url:'<?php echo U("pointitemedits");?>'
    ,toolbar: '#toolbarDemo'
    ,title: '用户数据表'
    ,cols: [[
      {type: 'checkbox', fixed: 'left'}
      ,{field:'pointitemid', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
      ,{field:'class', title:'大类', width:300, sort: true}
      ,{field:'item', title:'项目大类', width:300, edit: 'text',sort: true}
      ,{field:'beizhu', title:'备注', width:200, edit: 'text', sort: true}
      ,{field:'stats', title:'状态', width:85, templet: '#switchTpl', unresize: true}
      
    ]]
    ,page: true
  });
  
	  //监听单元格编辑
	  table.on('edit(test)', function(obj){
	    var value = obj.value //得到修改后的值
	    ,data = obj.data //得到所在行所有键值
	    ,field = obj.field;//得到字段
	    
	    layer.msg('[ID: '+ data.pointitemid +'] ' + field + ' 字段更改为：'+ value);
	    
	    $.ajax({
	    	type:"post",
	    	data:{
	    		pointitemid : data.pointitemid,
	    		item : data.item,
	    		beizhu:data.beizhu,
	    	},
	    	url:'<?php echo U("pointitemeditsuc");?>',
	    	
	    	success: function(result){
	    		console.log(result);
	    	},
	    });
	    
	  });
	  
	  //头工具栏事件
  	table.on('toolbar(test)', function(obj){
	  	var checkStatus = table.checkStatus(obj.config.id);
	    switch(obj.event){
	      case 'getCheckData':
	        var data = checkStatus.data;
	        layer.alert(JSON.stringify(data));
	      break;
	      case 'getCheckLength':
	        layer.open({
		        type: 2 //此处以iframe举例
		        ,title: '积分项目大类添加'
		        ,area: ['800px', '600px']
		        ,shade: 0
		        ,maxmin: true
		        
		        ,content: 'pointitemadd.html'
		        ,btn: ['全部关闭'] //只是为了演示
		        
		        ,btn2: function(){
		          layer.closeAll();
		        }
		        
		        ,zIndex: layer.zIndex //重点1
		        ,success: function(layero){
		          layer.setTop(layero); //重点2
		        }
		      });
	      break;
	      case 'getCheckstats':
	        var data = table.checkStatus(obj.config.id);
	        location.reload();
	        $.ajax({
	        	type:"post",
	        	url:'<?php echo U("pointitembatchstats");?>',
	        	async:true,
	        	data : {
	        		pointitemid : data.data,
	        	},
	        	success:function(result){
	        		alert("共有" + result + "条已停用");
	        		
	        	},
	        });
	        
	        
	        
	      break;
	      
	      case 'isAll':
	        layer.msg(checkStatus.isAll ? '全选': '未全选');
	      break;
	      
	    };
	  	
	  	
	  });
	  
	  //监听性别操作
	  form.on('switch(sexDemo)', function(obj){
	    layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
	    console.log(obj);
	    $.ajax({
	    	type:"post",
	    	
	    	url:'<?php echo U("pointitemstats");?>',
	    	
	    	async:true,
	    	
	    	data:{
	    		pointitemid : this.value,
	    		stats : obj.elem.checked,
	    	},
	    	
	    	success:function(result){
	    		console.log(result);
	    	},
	    });
	    
	  });
	  
	 	//监听行工具事件
	  table.on('tool(test)', function(obj){
	    var data = obj.data;
	    //console.log(obj)
	    if(obj.event === 'del'){
	      layer.confirm('真的删除行么', function(index){
	        obj.del();
	        layer.close(index);
	      });
	    } else if(obj.event === 'edit'){
	      layer.prompt({
	        formType: 2
	        ,value: data.email
	      }, function(value, index){
	        obj.update({
	          email: value
	        });
	        layer.close(index);
	      });
	    }
	  });
	 
});
</script>
<!--底部-->
</body>
</html>
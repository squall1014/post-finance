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
            <dd><a href="/jrhr/index.php/Home/Admin/whitecustinfoperspts">白名单有效存款情况(测试)</a></dd>
            
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
    <h1><div style="padding: 15px;">余杭区金融积分考核系统</div></h1>
    
    <br />
    <div class="layui-card" style="width: 100%;">
        	<div class="layui-card-header">
        		<font size="4">白名单有效存款情况</font>
        	</div>
        <div class="layui-card-body">
        
					<table class="layui-hide" id="test" lay-filter="test"></table>
					
					<script type="text/html" id="switchTpl">
					  <!-- 这里的 checked 的状态只是演示 -->
					  <input type="checkbox" id="{{d.pointitemid}}" name="stats" value="{{d.pointitemid}}" lay-skin="switch" lay-text="启用|停用" lay-filter="sexDemo" {{ d.stats == 0 ? 'checked' : '' }}>
					</script>
					
					<script type="text/html" id="toolbarDemo">
					  <!-- <div class="layui-btn-container">
					    <button class="layui-btn layui-btn-sm" lay-event="getCheckData">查看项目</button>
					    <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">添加项目</button>
					    <button class="layui-btn layui-btn-sm" lay-event="getCheckstats">批量停用</button>
					  </div> -->
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
    © 余杭区金融积分考核系统
  </div>
<script src="/ins/Public/layui.all.js"></script>
<script src="/ins/Public/jquery-1.12.4.min.js"></script>

<script>
  layui.use('table', function(){
  var table = layui.table;
  var form = layui.form;
  table.render({
    elem: '#test'
	,toolbar: '#toolbarDemo'
    ,cols: [[ //标题栏
      {field: 'id', title: 'ID', width: 80, sort: true}
      ,{field: 'custname', title: '姓名', width: 120}
      ,{field: 'sfz', title: '身份证', minWidth: 120}
      ,{field: 'phone', title: '联系电话', minWidth: 110}
      ,{field: 'address', title: '地址', width: 80}
      ,{field: 'zyue', title: '总余额', width: 110}
      ,{field: 'dingqi', title: '定期', width: 110, sort: true}
	  ,{field: 'huoqi', title: '活期', width: 110, sort: true}
	  ,{field: 'kaihu', title: '开户金额', width: 110, sort: true}
    ]]
    ,data: <?php echo ($data); ?>
    //,skin: 'line' //表格风格
    ,even: true
    ,page: true //是否显示分页
    ,limits: [5, 7, 10]
    //,limit: 5 //每页默认显示的数量
  });
  table.on('row(test)', function(obj){
    var data = obj.data;
    
	console.log(data);

    // layer.alert(JSON.stringify(data), {
    //   title: '当前行数据：'
    // });
    layer.open({
		type: 2 //此处以iframe举例
		,title: '当前数据'
		,area: ['1000px', '600px']
		,shade: 0
		,maxmin: true
		        
		,content: '/jrhr/index.php/Home/Admin/whitecustinfopers?jgh='+data.jgh+'&sfz='+data.sfz
		,btn: ['全部关闭'] //只是为了演示
		        
		,btn2: function(){
		    layer.closeAll();
		}
		        
		,zIndex: layer.zIndex //重点1
		,success: function(layero){
		    layer.setTop(layero); //重点2
		}
	});
    //标注选中样式
    obj.tr.addClass('layui-table-click').siblings().removeClass('layui-table-click');
  });
//   table.render({
//     elem: '#test'
//     ,url:'http://10.138.30.40:8080/wcvalid/getlist?jgh='+<?php echo ($dw); ?>
//     ,toolbar: '#toolbarDemo'
//     ,title: '用户数据表'
//     ,cols: [[
//       {type: 'checkbox', fixed: 'left'}
//       ,{field:'phone', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
//       ,{field:'custname', title:'姓名', width:300, edit: 'text',sort: true}
//       ,{field:'sfz', title:'身份证', width:200, edit: 'text', sort: true}
//       ,{field:'phone', title:'联系方式', width:200, edit: 'text', sort: true}
//       ,{field:'jgh', title:'状态', width:85, templet: '#switchTpl', unresize: true}
      
//     ]]
// 	,limit: 90
//     ,page: true
//   });
  
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
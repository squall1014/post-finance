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
      <li class="layui-nav-item">
        <a href="javascript:;">控制台</a>
        <dl class="layui-nav-child">
          <?php if($user["username"] == jrywb): if($user["jrywbqx"] == 1): ?><dd><a href="/cost/index.php/Home/Index/jrywbqxsuc">0库存申请开放</a></dd>
          		<dd><a href="/cost/index.php/Home/Index/jrywbqxsearch">0库存申请查询</a></dd>
          	<?php else: ?>
          		<dd><a href="/cost/index.php/Home/Index/jrywbqxerr">0库存申请关闭</a></dd>
          		<dd><a href="/cost/index.php/Home/Index/jrywbqxsearch">0库存申请查询</a></dd><?php endif; ?>
          <?php else: endif; ?>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/cost/index.php/Home/Index/index">管理</a></li>
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
                      <?php echo ($user["user"]); ?>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="/cost/index.php/Home/Index/passwordedit">密码修改</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/cost/index.php/Home/Index/logout">退了</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      	<li class="layui-nav-item"><a href="/cost/index.php/Home/Index/index">首页</a></li>
        <?php if($user["qx"] >= 8): ?><li class="layui-nav-item"><a href="/cost/index.php/Home/Index/backlog">待办事项</a></li><?php else: endif; ?>
        
        
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">产品请领管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
          	
            <dd><a href="/cost/index.php/Home/Index/applyproduct">单位产品请领</a></dd>
            <dd><a href="/cost/index.php/Home/Index/applyproductmodify">产品请领数量修改</a></dd>
            <dd><a href="/cost/index.php/Home/Index/applyproductsearch">产品请领查询</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">产品请领管理新版</a><?php else: endif; ?>
          <dl class="layui-nav-child">
          	
            <dd><a href="/cost/index.php/Home/Index/applyproduct_up">单位产品请领</a></dd>
            <dd><a href="/cost/index.php/Home/Index/applyproductmodify_up">产品请领数量编辑</a></dd>
            <!-- <dd><a href="/cost/index.php/Home/Index/applyproductsearch">产品请领查询</a></dd> -->
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">产品出入库管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/dwoutbound">单位产品出库</a></dd>
            <dd><a href="/cost/index.php/Home/Index/dwoutboundmodify">单位产品出库修改</a></dd>
            <dd><a href="/cost/index.php/Home/Index/dwoutboundsearch">单位产品出库查询</a></dd>
            <dd><a href="/cost/index.php/Home/Index/applyproductconfirm">产品入库确认</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">产品出库管理新版</a><?php else: endif; ?>
          <dl class="layui-nav-child">
          	
            <dd><a href="/cost/index.php/Home/Index/dwoutbound_up">单位产品出库</a></dd>
            <dd><a href="/cost/index.php/Home/Index/dwoutboundmodify_up">产品出库数量编辑</a></dd>
            <!-- <dd><a href="/cost/index.php/Home/Index/applyproductsearch">产品请领查询</a></dd> -->
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">产品调拨管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/dwoutallot">单位产品调拨出库</a></dd>
            <dd><a href="/cost/index.php/Home/Index/dwinallot">单位产品调拨入库</a></dd>
            <dd><a href="/cost/index.php/Home/Index/dwallotsearch">产品调拨出入库查询</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">库存管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/warehousereport">库存报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["jrywbqx"] == 0 and $user["qx"] == 5): ?><a class="" href="javascript:;">0库存产品申请</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/applyproductzero">0库存产品申请</a></dd>
            <dd><a href="/cost/index.php/Home/Index/applyproductzeromodify">0库存产品修改</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">积分卡管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/pointcardin">积分卡请领</a></dd>
            <dd><a href="/cost/index.php/Home/Index/pointcardedit">积分卡管理</a></dd>
            <dd><a href="/cost/index.php/Home/Index/pointcardout">积分卡兑换</a></dd>
            <dd><a href="/cost/index.php/Home/Index/pointcardloss">积分卡挂失</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] == 5): ?><a class="" href="javascript:;">本部门设备管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/equipmentup">设备维护更新申请</a></dd>
            <dd><a href="/cost/index.php/Home/Index/equipmentmodify">设备维护更新编辑</a></dd>
            <dd><a href="/cost/index.php/Home/Index/equipmentsearch">设备维护更新查询</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
        	<?php if($user["qx"] >= 8): ?><a class="" href="javascript:;">产品信息编辑</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/productadd">产品信息新增</a></dd>
            <dd><a href="/cost/index.php/Home/Index/productmodify">产品信息编辑</a></dd>
            <dd><a href="/cost/index.php/Home/Index/productsearch">产品信息查询</a></dd>
            <dd><a href="/cost/index.php/Home/Index/productedit">产品信息一体化</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 8): ?><a class="" href="javascript:;">仓库信息编辑</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/warehouseadd">仓库信息新增</a></dd>
            <dd><a href="/cost/index.php/Home/Index/warehousemodify">仓库信息编辑</a></dd>
            <dd><a href="/cost/index.php/Home/Index/warehousemodify">仓库信息查询</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 8): ?><a class="" href="javascript:;">产品入库操作</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/inbound">产品入库新增</a></dd>
            <dd><a href="/cost/index.php/Home/Index/inboundzero">0库存产品入库新增</a></dd>
            <dd><a href="/cost/index.php/Home/Index/inboundzeropt">0库存产品入库(透视表)</a></dd>
            <dd><a href="/cost/index.php/Home/Index/inboundmodify">产品入库修改</a></dd>
            <dd><a href="/cost/index.php/Home/Index/inboundsearch">产品入库查询</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 8): ?><a class="" href="javascript:;">产品确认操作</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/inboundsh">产品确认入库</a></dd>
            <dd><a href="/cost/index.php/Home/Index/applyproductsh">产品申请确认</a></dd>
            <dd><a href="/cost/index.php/Home/Index/outbound">产品确认出库</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 8): ?><a class="" href="javascript:;">产品确认查询</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/inboundshsearch">产品确认入库查询</a></dd>
            <dd><a href="/cost/index.php/Home/Index/applyproductshsearch">产品申请确认查询</a></dd>
            <dd><a href="/cost/index.php/Home/Index/applyproductshsearchpt">产品申请查询（透视表）</a></dd>
            <dd><a href="/cost/index.php/Home/Index/outboundsearch">产品确认出库查询</a></dd>
            <dd><a href="/cost/index.php/Home/Index/outboundsearchpt">产品出库查询（透视表）</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 8): ?><a class="" href="javascript:;">产品发票管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/inboundbill">产品发票补足</a></dd>
            <dd><a href="/cost/index.php/Home/Index/inboundbill">产品发票冲正</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 8): ?><a class="" href="javascript:;">产品库存管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/warehouseall">本部门产品库存报表</a></dd>
            <dd><a href="/cost/index.php/Home/Index/productall">本部门仓库库存报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">财务报表</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/financereport">按单位财务报表</a></dd>
            <dd><a href="/cost/index.php/Home/Index/financereportall">按单位礼品报表</a></dd>
            <dd><a href="/cost/index.php/Home/Index/financewarehouse">按产品库存报表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">导出数据</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/tablepers">导出报表</a></dd>
          </dl>
        </li>
        <!--<li class="layui-nav-item"><a href="/cost/index.php/Home/Index/qingjiacounts">JSON数据测试</a></li>-->
      </ul>
    </div>
  </div>
  


  <div class="layui-body">
    <!-- 内容主体区域 -->
    <h1><div style="padding: 15px;">余杭区邮政存货管理系统</div></h1>
    
    <div class="layui-card" style="width: 100%;">
        	<div class="layui-card-header">
        		<font size="4">产品信息编辑</font>
        	</div>
        <div class="layui-card-body">
        
					<table class="layui-hide" id="test" lay-filter="test"></table>
					
					<script type="text/html" id="switchTpl">
					  <!-- 这里的 checked 的状态只是演示 -->
					  <input type="checkbox" id="{{d.productid}}" name="stats" value="{{d.productid}}" lay-skin="switch" lay-text="启用|停用" lay-filter="sexDemo" {{ d.stats == 0 ? 'checked' : '' }}>
					</script>
					
					<script type="text/html" id="toolbarDemo">
					  <div class="layui-btn-container">
					    <button class="layui-btn layui-btn-sm" lay-event="getCheckData">查看产品</button>
					    <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">添加产品</button>
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
    © 余杭区邮政存货管理系统
  </div>
<script src="/ins/Public/layui.all.js"></script>
<script src="/ins/Public/jquery-1.12.4.min.js"></script>

<script>
	layui.use('table', function(){
  var table = layui.table;
  var form = layui.form;
  table.render({
    elem: '#test'
    ,url:'<?php echo U("productedits");?>'
    ,toolbar: '#toolbarDemo'
    ,title: '用户数据表'
    ,cols: [[
      {type: 'checkbox', fixed: 'left'}
      ,{field:'productid', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
      ,{field:'productdwname', title:'产品单位', width:120, sort: true}
      ,{field:'productname', title:'产品名称', width:400, edit: 'text', sort: true}
      ,{field:'unit', title:'单位',edit: 'text', width:100,sort: true}
      ,{field:'producttypename', title:'产品类型', width:100,sort: true}
      ,{field:'supplier', title:'供应商',edit: 'text', width:100,sort: true}
      ,{field:'stats', title:'状态', width:85, templet: '#switchTpl', unresize: true}
      ,{field:'beizhu', title:'备注',edit: 'text',sort: true}
    ]]
    ,page: true
  });
  
	  //监听单元格编辑
	  table.on('edit(test)', function(obj){
	    var value = obj.value //得到修改后的值
	    ,data = obj.data //得到所在行所有键值
	    ,field = obj.field;//得到字段
	    
	    layer.msg('[ID: '+ data.insuranceid +'] ' + field + ' 字段更改为：'+ value);
	    
	    $.ajax({
	    	type:"post",
	    	data:{
	    		productid : data.productid,
	    		productname : data.productname,
	    		unit : data.unit,
	    		supplier : data.supplier,
	    		beizhu : data.beizhu,
	    		
	    	},
	    	url:'<?php echo U("producteditsuc");?>',
	    	
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
		        ,title: '产品信息添加'
		        ,area: ['1024px', '768px']
		        ,shade: 0
		        ,maxmin: true
		        
		        ,content: 'productadd.html'
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
	        	url:'<?php echo U("productbatchstats");?>',
	        	async:true,
	        	data : {
	        		productid : data.data,
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
	    	
	    	url:'<?php echo U("productstats");?>',
	    	
	    	async:true,
	    	
	    	data:{
	    		productid : this.value,
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
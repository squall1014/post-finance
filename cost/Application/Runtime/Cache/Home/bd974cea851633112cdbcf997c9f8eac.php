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
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">管理</a></li>
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
                      <?php echo ($user["username"]); ?>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/cost/index.php/Home/Admin/logout">退了</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      	<li class="layui-nav-item"><a href="/cost/index.php/Home/Admin/index">首页</a></li>
      	<li class="layui-nav-item">
          <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">积分卡管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Admin/pointcardwd">积分卡按网点入库</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdins">积分卡按网点入库审核</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdshs">积分卡按网点挂失审核</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdedits">积分卡按网点管理</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdmake">积分卡按网点制卡</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">积分卡对账管理</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdinvest">积分卡按网点进行充值</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/pointcardwdfinance">积分卡按网点对账管理</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">财务报表</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Admin/financedwreportdate">按单位库存财务报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/financewhreportdate">按仓库库存财务报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/inboundreportdate">按日期入库库存财务报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/warehousedwreport">库存报表</a></dd>
            <!--<dd><a href="/cost/index.php/Home/Admin/financereportall">按单位礼品报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/financewarehouse">按单位消耗品报表</a></dd>-->
          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">导出数据</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Admin/tablepers">导出报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/indextest">导出报表</a></dd>
            <dd><a href="/cost/index.php/Home/Admin/test">导出报表</a></dd>
          </dl>
        </li>
        <!--<li class="layui-nav-item"><a href="/cost/index.php/Home/Admin/select">测试</a></li>-->
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <!-- 内容主体区域 -->
    <h1><div style="padding: 15px;">余杭区邮政费用分摊系统</div></h1>
    	<div class="layui-card" style="width: 100%;">
        	<div class="layui-card-header">
        		<font size="4">网点积分卡管理</font>
        	</div>
        <div class="layui-card-body">
        <hr class="layui-bg-red">
    
		    <div class="demoTable">
		    	搜索卡号状态：
		    <div class="layui-inline">
		      <form class="layui-form">
		  		<select name="kh" id="khReload" lay-verify="" lay-search>
					<option value="">请选择状态</option>
					<?php if(is_array($ccsr)): $i = 0; $__LIST__ = $ccsr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["statsid"]); ?>"><?php echo ($vo["cardstats"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		  			
		  			
		  		</select>
		  		</form>
		    </div>
		    	搜索网点:
		  	<div class="layui-inline">
		  		<!--<input class="layui-input" name="dwname" id="dwnameReload" autocomplete="off">-->
		  		<form class="layui-form">
		  		<select name="wd" id="wdReload" lay-verify="" lay-search>
		  			<option value="">请选择单位</option>
		  			<?php if(is_array($drr)): $i = 0; $__LIST__ = $drr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["jgh"]); ?>"><?php echo ($vo["dwname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		  		</select>
		  		</form>
		  	</div>
		  		搜索日期：
		    <div class="layui-inline">
		      <form class="layui-form">
			        <input type="text" name="date" id="date" autocomplete="off" class="layui-input">
		  		</form>
		    </div>
		  		<button class="layui-btn" data-type="reload">搜索</button>
				</div>
					<table class="layui-hide" id="test" lay-filter="test"></table>
					
					<script type="text/html" id="switchTpl">
					  <!-- 这里的 checked 的状态只是演示 -->
					  <input type="checkbox" id="{{d.productid}}" name="stats" value="{{d.productid}}" lay-skin="switch" lay-text="启用|停用" lay-filter="sexDemo" {{ d.stats == 0 ? 'checked' : '' }}>
					</script>
					
					<script type="text/html" id="toolbarDemo">
					  <div class="layui-btn-container">
					    <button class="layui-btn layui-btn-sm" lay-event="getCheckstats">批量查看</button>
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
<script src="/cost/Public/layui.all.js"></script>
<script src="/cost/Public/jquery-1.12.4.min.js"></script>

<script>
	layui.use('table', function(){
  var table = layui.table;
  var form = layui.form;
  table.render({
    elem: '#test'
    ,url:'<?php echo U("pointcardwdeditlist");?>'
    ,toolbar: '#toolbarDemo'
    ,title: '用户数据表'
    ,cols: [[
      {type: 'checkbox', fixed: 'left'}
      ,{field:'cardid', title:'ID', width:120, fixed: 'left', unresize: true, sort: true}
      ,{field:'card', title:'卡号', width:240, sort: true}
      ,{field:'dwnames', title:'单位', width:120,sort: true}
      ,{field:'date', title:'入库日期', width:120,sort: true}
      ,{field:'status', title:'状态', width:85,sort: true}
      ,{field:'beizhu', title:'备注', width:400, edit: 'text', sort: true}
    ]]
    ,id: 'testReload'
    ,page: true
    //,limits: [10, 20, 30]
    ,limit: 20 //每页默认显示的数量
  });
  	var $ = layui.$, active = {
       reload: function(){
       var khReload = $('#khReload');
       var wdReload = $('#wdReload');
       var dateReload = $('#date');
        table.reload('testReload', {
              where: {
                 stats: khReload.val(),
                 jgh: wdReload.val(),
                 date: dateReload.val()
                 }
            });
          }
       };
    $('.demoTable .layui-btn').on('click', function(){    
	        var type = $(this).data('type');
          active[type] ? active[type].call(this) : '';
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
		  var datas = new Array();
		  len = data.data.length;
			for(i = 0; i < len; i++){
				console.log(data.data);
				datas[i] = data.data[i]['cardid'];
			}
		  console.log(datas);
		  layer.open({
			  type: 2
			  ,title: '明细查看'
			  ,area: ['1000px' , '400px']
			  ,shade: 0
			  ,maxmin: true
			  ,content: 'pointcarddetail.html?cardid='+datas
			  ,cancel: function(index, layero){ 
				if(confirm('确定要关闭么')){ //只有当点击confirm框的确定时，该层才会关闭
					layer.close(index);
					window.location.reload();
					}
					return false; 
				}
		  })
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
  	elem: '#test6'
  	,range: true
	});
});
</script>
<!--底部-->
</body>
</html>
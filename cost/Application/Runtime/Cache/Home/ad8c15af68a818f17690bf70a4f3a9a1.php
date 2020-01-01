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
            <dd><a href="/cost/index.php/Home/Index/applyproductsearch_up">产品请领状态查询</a></dd>
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
            <dd><a href="/cost/index.php/Home/Index/dwcostreport">按日期查询上缴费用</a></dd>

          </dl>
        </li>
        <li class="layui-nav-item">
          <?php if($user["jrywbqx"] == 0 and $user["qx"] == 5): ?><a class="" href="javascript:;">0库存产品申请</a><?php else: endif; ?>
          <dl class="layui-nav-child">
            <dd><a href="/cost/index.php/Home/Index/applyproductzero/productdwname/28">0库存金融部产品申请</a></dd>
            <!-- <dd><a href="/cost/index.php/Home/Index/applyproductzero/productdwname/58">0库存市场部产品申请</a></dd> -->

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
            <dd><a href="/cost/index.php/Home/Index/applyproductsh_up">产品申请确认(新版)</a></dd>

            <dd><a href="/cost/index.php/Home/Index/outbound">产品确认出库</a></dd>
            <dd><a href="/cost/index.php/Home/Index/outbound_up">产品确认出库(新版)</a></dd>

            <dd><a href="/cost/index.php/Home/Index/outbounddwname_up">产品直接出库</a></dd>
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
    <h1><div style="padding: 15px;">余杭区邮政费用分摊系统</div></h1>
    	<div class="layui-card" style="width: 100%;">
        	<div class="layui-card-header">
        		<font size="4">网点确认出库</font>
        	</div>
        <div class="layui-card-body">
        <hr class="layui-bg-red">
    		
		    <div class="demoTable">
		    	搜索网点：
		    <div class="layui-inline">
		      <form class="layui-form">
		  		<select name="wh" id="whReload" lay-verify="" lay-search>
		  			<option value="">请选择网点</option>
		  			<?php if(is_array($jdr)): $i = 0; $__LIST__ = $jdr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["jgh"]); ?>"><?php echo ($vo["dwname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		  		</select>
		  		</form>
			</div>
				搜索产品:
			<div class="layui-inline">
				<!--<input class="layui-input" name="dwname" id="dwnameReload" autocomplete="off">-->
				<form class="layui-form">
				<input type="text" name="pc" list="productid" id="pcReload" lay-verify="" class="layui-input">
				<datalist id="productid">
					<?php if(is_array($cprr)): $i = 0; $__LIST__ = $cprr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["productname"]); ?>"><?php echo ($vo["productname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</datalist>
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
					  <!--<input type="checkbox" id="{{d.cardid}}" name="stats" value="{{d.cardid}}" lay-skin="switch" lay-text="审核|未审核" lay-filter="sexDemo" {{ d.stats == 5 ? 'checked' : '' }}>-->
					</script>
					
					<script type="text/html" id="toolbarDemo">
					  <div class="layui-btn-container">
					    <button class="layui-btn layui-btn-sm" lay-event="getCheckstats">查看</button>
					  </div>
					</script>
					
					<script type="text/html" id="barDemo">
					  <a class="layui-btn layui-btn-xs" lay-event="edit">出库</a>
					  <!-- <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a> -->
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
    ,url:'<?php echo U("outbound_ups");?>'
    ,toolbar: '#toolbarDemo'
    ,title: '用户数据表'
    ,cols: [[
      {type: 'checkbox', fixed: 'left'}
      ,{field:'id', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
      ,{field:'applydwnames', title:'网点机构号', width:180, unresize: true, sort: true}
      ,{field:'applydwname', title:'网点名称', width:200,sort: true}
	  //金融网点、营业网点、寄递、机关
      ,{field:'warehouse', title:'所在仓库', width:120,sort: true}
      ,{field:'productname', title:'产品名称', width:120,sort: true}
      ,{field:'applyquantity', title:'请领数量', width:120,sort: true}
	  ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width:75}
    //   ,{field:'sumkcquantity', title:'库存', width:400, edit: 'text', sort: true}
    ]]
    ,id: 'testReload'
    ,page: true
    //,limits: [10, 20, 30]
    ,limit: 20 //每页默认显示的数量
  });
  	var $ = layui.$, active = {
       reload: function(){
       var whReload = $('#whReload');
       var pcReload = $('#pcReload');
       var dateReload = $('#date');
        table.reload('testReload', {
              where: {
                 jgh: whReload.val(),
                 product: pcReload.val(),
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
				datas[i] = data.data[i]['productid'];
			}
		  console.log(datas);
		  layer.open({
			  type: 2
			  ,title: '出库情况'
			  ,area: ['1000px' , '400px']
			  ,shade: 0
			  ,maxmin: true
			  ,content: 'applyproducts_up.html?productid='+datas
			  ,cancel: function(index, layero){ 
				if(confirm('确定要关闭么')){ //只有当点击confirm框的确定时，该层才会关闭
					layer.close(index);
					window.location.reload();
					}
					return false; 
				}
		  })
	        // if(data.data.length > 1){
			// 	      //配置一个透明的询问框
			// 	      layer.msg('每次操作只能办理一张积分卡', {
			// 	        time: 10000, //20s后自动关闭
			// 	        btn: ['明白了',]
			// 	      });
	        // }else{
	        // 		datas = data.data[0]['cardid'];
	        // 		datass = data.data[0]['cardinid'];
	        // 		datasss = data.data[0]['card'];
		    //     	layer.open({
			// 	        type: 2 //此处以iframe举例
			// 	        ,title: '发卡'
			// 	        ,area: ['800px', '600px']
			// 	        ,shade: 0
			// 	        ,maxmin: true
				        
			// 	        ,content: 'pointcardhair.html?cardid='+datas+'&cardinid='+datass+'&card='+datasss
				        
			// 	        ,btn2: function(){
			// 	          layer.closeAll();
			// 	        }
			// 	        ,cancel: function(index, layero){ 
			// 					  if(confirm('确定要关闭么')){ //只有当点击confirm框的确定时，该层才会关闭
			// 					    layer.close(index);
			// 					    window.location.reload();
			// 					  }
			// 					  return false; 
			// 					}    
			// 	        ,zIndex: layer.zIndex //重点1
			// 	        ,success: function(layero){
			// 	          layer.setTop(layero); //重点2
			// 	        }
			//       });
	        // }
	        
	        
	        
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
			console.log(data);
	      layer.prompt({
	        formType: 2
			,title: '请输入数量'
			,value: data.applyquantity
	        // ,value: data.sumkcquantity
	      }, function(value, index){
			  if(parseInt(value) > parseInt(data.applyquantity)){
				  alert("出库数量不能大于请领数量")
				  
			  }else{
				$.ajax({
					type:"post",
					
					url:'<?php echo U("outbound_upsuc");?>',
					
					async:true,
					
					data:{
						applyid: data.applyid,
						applyjgh: data.applyjgh,
						pwid: data.pwid,
						productid: data.productid,
						warehouseid: data.warehouseid,
						applyquantity: data.applyquantity,
						
						jgh: data.productjgh,
						sjapplyquantity: value,
					},
					
					success:function(result){
						alert(result)
					},
	    		});
				layer.close(index);
				obj.del();
				// window.location.reload();
			  }
	        
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
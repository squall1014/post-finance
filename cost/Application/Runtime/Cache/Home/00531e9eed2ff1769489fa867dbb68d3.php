<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--大标题和JS-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>余杭区邮政存货管理系统</title>
  <link rel="stylesheet" href="/cost/Public/css/layui.css">
</head>

    	<div class="layui-card" style="width: 100%;">
        	<div class="layui-card-header">
        		<font size="4">网点库存请领</font>
        	</div>
		<div class="layui-card-body">
			<hr class="layui-bg-red">
			<table class="layui-hide" id="test" lay-filter="test"></table>
		
			<script type="text/html" id="switchTpl">
			<!-- 这里的 checked 的状态只是演示 -->
			<!--<input type="checkbox" id="{{d.cardid}}" name="stats" value="{{d.cardid}}" lay-skin="switch" lay-text="审核|未审核" lay-filter="sexDemo" {{ d.stats == 5 ? 'checked' : '' }}>-->
			</script>
		
			<script type="text/html" id="toolbarDemo">
				<div class="layui-btn-container">
					<button class="layui-btn layui-btn-sm" lay-event="getCheckstats">出库</button>
				</div>
			</script>
			<script type="text/html" id="barDemo">
				<a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
				<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
			</script>
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
    ,url:'<?php echo U("applyproducts_ups");?>'
    ,toolbar: '#toolbarDemo'
    ,title: '用户数据表'
    ,cols: [[
      {type: 'checkbox', fixed: 'left'}
      ,{field:'productid', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
      ,{field:'productname', title:'产品名称', width:180, unresize: true, sort: true}
      ,{field:'productdwname', title:'产品所属单位', width:120,sort: true}
      ,{field:'warehouse', title:'产品所在仓库', width:120,sort: true}
	  ,{field:'producttypename', title:'所属类别', width:100, sort: true}
      ,{field:'sumkcquantity', title:'库存', width:120, sort: true}
      ,{field:'applyquantity', title:'请领数量', width:120, edit: 'text', sort: true}
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
                 warehouseid: whReload.val(),
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
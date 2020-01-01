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
    <h1><div style="padding: 15px;">余杭区邮政存货管理系统</div></h1>
    
    <br />
    
						<table class="layui-table" style="text-align: center; width: 100%;">
					      <colgroup>
					       <col width="12%">
					       <col width="8%">
					       <col width="10%">
					       <col width="7%">
					       <col width="5%">
					       <col width="10%">
					       <col width="8%">
					       <col width="15%">
					      </colgroup>
					    <tr>
								<td>单位名称</td>
								<td>产品名称</td>
								<td>仓库名称</td>
								
								<td>含税单价(元)</td>
								<td>入库数量</td>
								<td>实际入库数量</td>
								<td>请领时间</td>
								<td>操作(部分入库-到货部分)</td>
							</tr>
							<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><form class="layui-form" name="formib" id="a<?php echo ($vo["inboundid"]); ?>" method="post" style="width: 100%;">
							<tr>
								<input type="hidden" name="id" value="<?php echo ($vo["inboundid"]); ?>">
								<!--<td><input type="checkbox" name="id[]" value="<?php echo ($vo["pianquname"]); ?>" lay-skin="primary"></td>-->
								<td><?php echo ($vo["dwname"]); ?></td>
								<td><?php echo ($vo["productname"]); ?></td>
								<td><?php echo ($vo["warehouse"]); ?></td>
								<td><?php echo ($vo["unitprice"]); ?></td>
								<td><?php echo ($vo["quantity"]); ?></td>
								<td><input type="text" name="sjquantity" value="<?php echo ($vo["sjquantity"]); ?>" lay-verify="" placeholder="请输入实际入库数量" autocomplete="off" class="layui-input"></td>
								<td><?php echo ($vo["date"]); ?></td>
								<td><input type="button" class="layui-btn" value="部分入库" onclick="a<?php echo ($vo["inboundid"]); ?>()" lay-submit=""><input type="button" class="layui-btn" onclick="b<?php echo ($vo["inboundid"]); ?>()" value="确认入库" lay-submit=""></td>
							</tr>
					  <div class="layui-form-item">
		    <!--<div class="layui-input-block">
		      <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
		      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>-->
		  </div>
		 
  
<script type="text/javascript">
      function a<?php echo ($vo["inboundid"]); ?>(){
      	document.getElementById("a<?php echo ($vo["inboundid"]); ?>").action = 'inboundshs';
        //document.formibs.action = <?php echo U('inboundshs');?>;
        document.getElementById("a<?php echo ($vo["inboundid"]); ?>").submit()
	    }
      function b<?php echo ($vo["inboundid"]); ?>() {
      	document.getElementById("a<?php echo ($vo["inboundid"]); ?>").action = 'inboundshsuc';
        //document.formibs.action = <?php echo U('inboundshs');?>;
        document.getElementById("a<?php echo ($vo["inboundid"]); ?>").submit()
      }
      
</script>
</form><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</div> 
</body>
</html>
<!--  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © 余杭区邮政存货管理系统
  </div>
</div>
<script src="/cost/Public/layui.all.js"></script>

<script>
//JavaScript代码区域
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
<!--<script>

</script>
<script>
layui.use('laydate', function(){
  var laydate = layui.laydate;
  
  //执行一个laydate实例
  laydate.render({
    elem: '#datea' //指定元素
  });
});
</script>-->
</body>
</html>-->
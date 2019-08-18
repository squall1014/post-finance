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
<script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=MZIBZ-5ZT64-WODUK-XAJFD-KIYXO-G7F7J"></script>
<body class="layui-layout-body" onload="init()">
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
              <dd><a href="/cost/index.php/Home/Admin/pointcardwdfinance">积分卡按网点对账管理</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item">
            <?php if($user["qx"] >= 9): ?><a class="" href="javascript:;">财务报表</a><?php else: endif; ?>
            <dl class="layui-nav-child">
              <dd><a href="/cost/index.php/Home/Admin/financedwreportdate">按单位库存财务报表</a></dd>
              <dd><a href="/cost/index.php/Home/Admin/financewhreportdate">按仓库库存财务报表</a></dd>
              <dd><a href="/cost/index.php/Home/Admin/inboundreportdate">按日期入库库存财务报表</a></dd>
              <dd><a href="/cost/index.php/Home/Admin/">库存报表</a></dd>
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
    <h1><div style="padding: 15px;"></div></h1>
    
    <br />
      &nbsp&nbsp&nbsp
      <input id="keyword" type="textbox" value="酒店" class="layui-input">
      <input type="button" value="搜索" onclick="searchKeyword()" class="layui-btn">
      <div style="width:603px;height:300px" id="container"></div>
      <div style='width: 500px; height: 180px' id="infoDiv"></div>
        <script>
          var searchService, markers = [];
             var init = function() {
             var center = new qq.maps.LatLng(39.916527, 116.397128);
             var map = new qq.maps.Map(document.getElementById('container'), {
                 center: center,
                 zoom: 13
             });
       
             var latlngBounds = new qq.maps.LatLngBounds();
             //设置Poi检索服务，用于本地检索、周边检索
             searchService = new qq.maps.SearchService({
                 //设置搜索范围为北京
                 location: "余杭区",
                 //设置搜索页码为1
                 pageIndex: 1,
                 //设置每页的结果数为5
                 pageCapacity: 5,
                 //设置展现查询结构到infoDIV上
                 panel: document.getElementById('infoDiv'),
                 //设置动扩大检索区域。默认值true，会自动检索指定城市以外区域。
                 autoExtend: true,
                 //检索成功的回调函数
                 complete: function(results) {
                     //设置回调函数参数
                     var pois = results.detail.pois;
                     for (var i = 0, l = pois.length; i < l; i++) {
                         var poi = pois[i];
                         //扩展边界范围，用来包含搜索到的Poi点
                         latlngBounds.extend(poi.latLng);
                         var marker = new qq.maps.Marker({
                             map: map,
                             position: poi.latLng
                         });
       
                         marker.setTitle(i + 1);
       
                         markers.push(marker);
       
                     }
                     //调整地图视野
                     map.fitBounds(latlngBounds);
                 },
                 //若服务请求失败，则运行以下函数
                 error: function() {
                     alert("出错了。");
                 }
             });
       
         }

          //清除地图上的marker
             function clearOverlays(overlays) {
                 var overlay;
                 while (overlay = overlays.pop()) {
                     overlay.setMap(null);
                 }
             }
             //设置搜索的范围和关键字等属性
             function searchKeyword() {
                 var keyword = document.getElementById("keyword").value;
                 clearOverlays(markers);
                 //根据输入的城市设置搜索范围
                 // searchService.setLocation("北京");
                 //根据输入的关键字在搜索范围内检索
                 searchService.search(keyword);
       
             
             }
       </script>
      
  </div>
  
<!--底部-->
<div class="layui-footer">
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


</body>
</html>
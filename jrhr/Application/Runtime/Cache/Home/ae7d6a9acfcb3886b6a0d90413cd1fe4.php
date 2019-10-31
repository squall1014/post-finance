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
    <!-- 内容主体区域 -->
        <form action="<?php echo U('pointitemaddsuc');?>" enctype="multipart/form-data" method="post" class="layui-form" >
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
        ,{field: 'sfz', title: '身份证', minWidth: 150}
        ,{field: 'phone', title: '联系电话', minWidth: 120}
        ,{field: 'threeM', title: '3个月', width: 110}
        ,{field: 'sixM', title: '6个月', width: 110}
        ,{field: 'oneY', title: '1年期', width: 110, sort: true}
        ,{field: 'twoY', title: '2年期', width: 110, sort: true}
        ,{field: 'threeY', title: '3年期', width: 110, sort: true}
      ]]
      ,data: <?php echo ($data); ?>
      //,skin: 'line' //表格风格
      ,even: true
      ,page: true //是否显示分页
      ,limits: [5, 7, 10]
      //,limit: 5 //每页默认显示的数量
    });
    });
  </script>
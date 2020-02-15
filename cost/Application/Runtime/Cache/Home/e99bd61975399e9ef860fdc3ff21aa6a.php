<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo ($jdrr[0]['dwname']); ?>--<?php echo ($ieqrr[0]['equipment']); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/cost/public/layuimini/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/cost/public/layuimini/css/public.css" media="all">
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend><?php echo ($jdrr[0]['dwname']); ?>-<?php echo ($ieqrr[0]['equipment']); ?></legend>
        </fieldset>
        <fieldset class="layui-elem-field layuimini-search">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">网点名称</label>
                            <div class="layui-input-inline">
                                <input type="text" name="username" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">设备名称</label>
                            <div class="layui-input-inline">
                                <input type="text" name="sex" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">供应商名称</label>
                            <div class="layui-input-inline">
                                <input type="text" name="city" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">集采类型</label>
                            <div class="layui-input-inline">
                                <input type="text" name="classify" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <a class="layui-btn" lay-submit="" lay-filter="data-search-btn">搜索</a>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>

        <div class="layui-btn-group">
            <button class="layui-btn data-add-btn">添加</button>
            <button class="layui-btn layui-btn-danger data-delete-btn">删除</button>
        </div>
        <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>
        <script type="text/html" id="toolbarDemo">
            <div class="layui-btn-container">
              <button class="layui-btn layui-btn-sm" lay-event="getCheckData">获取选中行数据</button>
              <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
              <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button>
            </div>
          </script>
        <script type="text/html" id="currentTableBar">
            <a class="layui-btn layui-btn-xs data-count-edit" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
        </script>
    </div>
</div>
<script src="/cost/public/layuimini/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
<script>
    layui.use(['form', 'table'], function () {
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table;

        table.render({
            elem: '#currentTableId',
            url: "<?php echo U('Ic/equipment_networks');?>",
            toolbar: '#toolbarDemo',
            cols: [[
                {type: "checkbox", width: 50, fixed: "left",},
                {field: 'deviceid', width: 80, title: 'ID', sort: true, fixed: "left",},
                {field: 'device', width: 150, edit: 'text', title: '设备', sort: true, fixed: "left",},
                {field: 'device_sub', width: 150, edit: 'text', title: '型号', sort: true, fixed: "left",},
                {field: 'hitch', width: 150, edit: 'text', title: '报障编号', unresize: true, sort: true},
                {field: 'layer', width: 150, edit: 'text', title: '交换机地址', sort: true},
                {field: 'threelayer', width: 150, edit: 'text', title: '三层地址', sort: true},
                
                {field: 'postvlan', width: 150, edit: 'text', title: '邮政vlan', sort: true},
                {field: 'postip', width: 150, edit: 'text', title: '邮政IP', sort: true},
                {field: 'postgateway', width: 150, edit: 'text', title: '邮政网关', sort: true},
                {field: 'bankvlan', width: 150, edit: 'text', title: '储蓄vlan', sort: true},
                {field: 'bankip', width: 150, edit: 'text', title: '储蓄IP', sort: true},
                {field: 'bankgateway', width: 150, edit: 'text', title: '储蓄网关', sort: true},
                {field: 'officevlan', width: 150, edit: 'text', title: '办公vlan', sort: true},
                {field: 'officeip', width: 150, edit: 'text', title: '办公IP', sort: true},
                {field: 'officegateway', width: 150, edit: 'text', title: '办公网关', sort: true},
                {field: 'videovlan', width: 150, edit: 'text', title: '监控vlan', sort: true},
                {field: 'videoip', width: 150, edit: 'text', title: '监控IP', sort: true},
                {field: 'videogateway', width: 150, edit: 'text', title: '监控网关', sort: true},
                {field: 'countingvlan', width: 150, edit: 'text', title: '点钞机vlan', sort: true},
                {field: 'countingip', width: 150, edit: 'text', title: '点钞机IP', sort: true},
                {field: 'countinggateway', width: 150, edit: 'text', title: '点钞机网关', sort: true},



                {field: 'supplier', width: 200, title: '品牌', sort: true},
                {field: 'maintenance', width: 200, title: '维保公司', sort: true},
                {field: 'mianphone', width: 200, title: '维保电话', sort: true},
                {field: 'purcha', width: 200, title: '采购', sort: true},
                
            ]],
            limits: [10, 15, 20, 25, 50, 100],
            limit: 15,
            page: true
        });

        // 监听搜索操作
        form.on('submit(data-search-btn)', function (data) {
            var result = JSON.stringify(data.field);
            layer.alert(result, {
                title: '最终的搜索信息'
            });

            //执行搜索重载
            table.reload('currentTableId', {
                page: {
                    curr: 1
                }
                , where: {
                    searchParams: result
                }
            }, 'data');

            return false;
        });

        // 监听添加操作
        $(".data-add-btn").on("click", function () {
            layer.msg('添加数据');
        });

        // 监听删除操作
        $(".data-delete-btn").on("click", function () {
            var checkStatus = table.checkStatus('currentTableId')
                , data = checkStatus.data;
            layer.alert(JSON.stringify(data));
        });

        //监听表格复选框选择
        table.on('checkbox(currentTableFilter)', function (obj) {
            console.log(obj)
        });

        table.on('tool(currentTableFilter)', function (obj) {
            var data = obj.data;
            if (obj.event === 'edit') {
                layer.alert('编辑行：<br>' + JSON.stringify(data))
            } else if (obj.event === 'delete') {
                layer.confirm('真的删除行么', function (index) {
                    obj.del();
                    layer.close(index);
                });
            }
        });

    });
</script>
<script>

</script>

</body>
</html>
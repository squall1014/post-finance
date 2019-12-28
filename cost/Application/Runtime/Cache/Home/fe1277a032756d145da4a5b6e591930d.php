<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/cost/public/layuimini/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/cost/public/layuimini/css/public.css" media="all">
    <!-- <style type="text/css">
        .layui-table-body{overflow-x:auto;}
        .layui-table-body{overflow-y:auto;}
    </style> -->
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">

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
<!-- <script src="/cost/public/layuimini/js/layuimini/layuimini.js" charset="utf-8"></script> -->
<script>
    layui.use(['form', 'table'], function () {
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table;
            element = layui.element;
        table.render({
            elem: '#currentTableId',
            url: "<?php echo U('Ic/welcomes');?>",
            toolbar: '#toolbarDemo',
            cols: [[
                {type: "checkbox", width: 50, fixed: "left"},
                {field: 'dwname', width: 200, title: '机构号', sort: true,fixed: 'left'},
                <?php if(is_array($ieqr)): $i = 0; $__LIST__ = $ieqr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>{field: "<?php echo ($vo["equipmentid"]); ?>", event: <?php echo ($vo["equipmentid"]); ?>,width: 200, title: '<?php echo ($vo["equipment"]); ?>'},<?php endforeach; endif; else: echo "" ;endif; ?>
                
            ]],
            limits: [10, 15, 20, 25, 50, 100],
            limit: 10,
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

        // table.on('tool(currentTableFilter)', function (obj) {
        //     var data = obj.data;
        //     if (obj.event === 'edit') {
        //         layer.alert('编辑行：<br>' + JSON.stringify(data))
        //     } else if (obj.event === 'delete') {
        //         layer.confirm('真的删除行么', function (index) {
        //             obj.del();
        //             layer.close(index);
        //         });
        //     }
        // });
        table.on('tool(currentTableFilter)', function(obj){
            var data = obj.data;
            var eve = obj.event;
            // console.log(data,eve)
            $.ajax({
                type: "GET",
                url: "equipment_tablemat",
                data: {equipmentid : eve},
                async: false,
                success: function(tablemat_classids){
                    var tablemat = JSON.parse(tablemat_classids)
                    tablemat_classid = tablemat['tablemat_classid']
                    tablemat_url = tablemat['tablemat_url']
                    tablemats = tablemat
                    
                }
            })
            // console.log(top.document.getElementById("layuiminiHomeTabIframe"))
            // parent.document.getElementById("layuiminiHomeTabIframe").innerHTML = '<iframe width="100%" height="100%" frameborder="0"  src="table"></iframe>'
            if(tablemat_classid > "0"){
                parent.location.href = tablemat_url + "?jgh=" + data.dwnames + "&equipmentid=" + eve + "&tablemat_classid=" + tablemat_classid
            }else{
                parent.location.href = "equipment_other?jgh=" + data.dwnames + "&equipmentid=" + eve
            }
            
            
            // parent.location.href = "equipment_sub"
            // parent.location.reload()
            // top.location.reload()
            
            // if(data.gather === "1"){
            //     location.href = "equipment_sub?jgh=" + data.dwnames + "&euqipmentid=" + eve
            // }else if(data.gather === "0"){
                

            // }
            
            
        });

        table.on('toolbar(currentTableFilter)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            switch(obj.event){
            case 'getCheckData':
                var data = checkStatus.data;
                layer.alert(JSON.stringify(data));
            break;
            case 'getCheckLength':
                var data = checkStatus.data;
                layer.msg('选中了：'+ data.length + ' 个');
            break;
            case 'isAll':
                layer.msg(checkStatus.isAll ? '全选': '未全选');
            break;
            
            //自定义头工具栏右侧图标 - 提示
            case 'LAYTABLE_TIPS':
                layer.alert('这是工具栏右侧自定义的一个图标按钮');
            break;
            };
        });
    });
</script>
<script>

</script>

</body>
</html>
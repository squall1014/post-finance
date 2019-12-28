<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>客户签字</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="UTF-8">
    <meta name="description" content="overview & stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="/cost/Public/css/layui.css">
    <script src="/cost/Public/layui.all.js"></script>
	<script src="/cost/Public/jquery-1.12.4.min.js"></script>
	<script src="/cost/Public/jSignature.js"></script>
    <script>
        $(function() {
            var $sigdiv = $("#signature");
            $sigdiv.jSignature(); // 初始化jSignature插件-属性用","隔开
            // $sigdiv.jSignature({'decor-color':'red'}); // 初始化jSignature插件-设置横线颜色
            // $sigdiv.jSignature({'lineWidth':"6"});// 初始化jSignature插件-设置横线粗细
            // $sigdiv.jSignature({"decor-color":"transparent"});// 初始化jSignature插件-去掉横线
            // $sigdiv.jSignature({'UndoButton':true});// 初始化jSignature插件-撤销功能
            // $sigdiv.jSignature({'height': 100, 'width': 200}); // 初始化jSignature插件-设置书写范围(大小)
            $("#yes").click(function(){
                //将画布内容转换为图片
                var datapair = $sigdiv.jSignature("getData", "image");
                $("#images").attr('src','data:' + datapair[0] + "," + datapair[1]);
            });
            $("#download").click(function(){
                var src_data = $("#images").attr('src');
                
                if(src_data){
                	sfz = document.getElementById("sfz").value;
                	custtype = document.getElementById("custtype").value;
                    $.ajax({
                        type:'post',
                        url:'<?php echo U("graphsuc");?>',
                        data:{src_data:src_data,
                        	sfz:sfz,
                        	custtype:custtype,
                        	},
                        async:true,
                        success:function(data){
                            // console.log(data);
                               // console.log(data);
                                alert(data);
                            
                            
                        }
                    });
                }else{
                    alert('图片不能为空！');
                    return false;
                }
            });
            $("#reset").click(function(){
                $("#signature").jSignature("reset"); //重置画布，可以进行重新作画
                $("#images").attr('src','');
            });
            $("#back").click(function(){
            	location.href = '<?php echo U("dwoutbound");?>';
            });
        });
    </script>
</head>
<body>
    <div id="signature"></div>
    <p style="text-align: center">
        <b style="color: red">请按着鼠标写字签名。</b>
    </p>
    <form class="layui-form" action="" enctype="multipart/form-data" method="post" style="width: 20%;">
      <div class="layui-form-item">
	    <label class="layui-form-label">身份证</label>
	    <div class="layui-input-block">
	      <input type="text" name="sfz" id="sfz" lay-verify="title" autocomplete="off" placeholder="请输入身份证" class="layui-input">
	    </div>
	    <br />
	    <label class="layui-form-label">客户类型</label>
	    <div class="layui-input-block">
	    <select name="custtype" id="custtype" lay-verify="required" lay-search>
         <option value="1">余额客户</option>
         <option value="2">保险客户</option>
        </select>
	    
	  </div>
    
    <br />
    <p style="margin-left:30px;">
    <input type="button" class="layui-btn layui-btn-sm" value="生成签名" id="yes"/>
    <input type="button" class="layui-btn layui-btn-sm layui-btn-warm" value="保存签名" id="download"/>
    <input type="button" class="layui-btn layui-btn-sm layui-btn-danger" value="重写" id="reset"/>
    <br />
    <br />
    <input type="button" class="layui-btn layui-btn-sm layui-btn-primary" value="返回出库页面" id="back" />
    </p>
    <br />
    <br />
    </form>
    
    <div id="someelement"><img src="" id="images"></div>

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
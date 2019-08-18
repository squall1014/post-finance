<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>普通关键字检索</title>
    <style type="text/css">
        * {
            margin: 0px;
            padding: 0px;
        }
        body,
        button,
        input,
        select,
        textarea {
            font: 12px/16px Verdana, Helvetica, Arial, sans-serif;
        }
        p {
            width: 603px;
            padding-top: 3px;
            margin-top: 10px;
            overflow: hidden;
        }
    </style>
    <script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=MZIBZ-5ZT64-WODUK-XAJFD-KIYXO-G7F7J"></script>

</head>

<body onload="init()">
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
                location: "北京",
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
    <div>
        <input id="keyword" type="textbox" value="酒店">
        <input type="button" value="搜索" onclick="searchKeyword()">
    </div>
    <div style="width:603px;height:300px" id="container"></div>
    <div style='width: 500px; height: 180px' id="infoDiv"></div>
</body>

</html>

<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts-all.js"></script>

<div class="right_content">
	<div class="right_content_title">
		<span class="icon_right_content_tille"></span>
		<span class="font_title">地域分布</span>
	</div>
	
	<div id="mapCountry" style="width: 96%; height: 400px; padding: 10px;margin: auto;"></div>
	
</div>

    <script type="text/javascript">
   function getStatMap() {
    var data;
    var myChart = echarts.init(document.getElementById('mapCountry'));
    var curIndx = 0;
    var mapType = [
        'china',
        // 23个省
        '广东', '青海', '四川', '海南', '陕西',
        '甘肃', '云南', '湖南', '湖北', '黑龙江',
        '贵州', '山东', '江西', '河南', '河北',
        '山西', '安徽', '福建', '浙江', '江苏',
        '吉林', '辽宁', '台湾',
        // 5个自治区
        '新疆', '广西', '宁夏', '内蒙古', '西藏',
        // 4个直辖市
        '北京', '天津', '上海', '重庆',
        // 2个特别行政区
        '香港', '澳门'
    ];
    myChart.on(echarts.config.EVENT.MAP_SELECTED, function (param){
        var len = mapType.length;
        var mt = mapType[curIndx % len];

        if (mt == 'china') {
            // 全国选择时指定到选中的省份
            var selected = param.selected;
            for (var i in selected) {
                if (selected[i]) {
                    mt = i;
                    while (len--) {
                        if (mapType[len] == mt) {
                            curIndx = len;
                        }
                    }
                    break;
                }
            }
        } else {
            curIndx = 0;
            mt = 'china';
            option.tooltip.formatter = '{b}';
        }
        option.series[0].mapType = mt;
//        option.title.subtext = mt + ' （滚轮或点击切换）';
        myChart.setOption(option, true);

    });

    option = {
        title: {
            text : '店铺下单量',
//            subtext : 'china （滚轮或点击切换）'
        },
        tooltip : {
            trigger: 'item'
        },
        dataRange: {
            min: 0,
            max: 200,
            color:['red','yellow'],
            text:['高','低'],           // 文本，默认为数值文本
            calculable : true
        },
        series : [
            {
                name: '店铺下单量',
                type: 'map',
                mapType: 'china',
                selectedMode : 'single',
                itemStyle:{
                    normal:{label:{show:true}},
                    emphasis:{label:{show:true}}
                },
                data:<?php echo  $result;?>
            }
        ]
    };
    myChart.setOption(option);
   }
    getStatMap();
</script>


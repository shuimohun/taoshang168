<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/seller_center.css"/>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
<style>
    #search i.iconfont{
       top: -3px;
    }
</style>
<div class="tabmenu">
    <ul class="">
        <?= $tabmenu_html; ?>
    </ul>
</div>
<div class="search fn-clear">
     <a  style="border:1px #E1E1E1 solid;height: 16px;margin-top:0" class="ui-btn" id="search" ><i class="iconfont icon-btnsearch"></i>查询</a>
    <a  style="border:1px #E1E1E1 solid;height: 16px;width:28px" class="ui-btn" id="search_sx">刷新</a>
    <form id="search_form" method="get">
        <input type="hidden" name="ctl" value="Seller_Analysis_Operation"/>
        <input type="hidden" name="met" value="index"/>
        <input type="hidden" name="kinds" value="<?= $kinds; ?>" class="kinds"/>
        <input id="end_time" name="end_time" value="" class="ui-input ui-datepicker-input" type="text" style="width: 100px;height: 28px;background: #F5F5F5;border:1px #E1E1E1 solid" readonly placeholder="结束时间"/>
        <input id="start_time" name="start_time" value="" class="ui-input ui-datepicker-input" type="text" style="width: 100px;height: 28px;background: #F5F5F5;border:1px #E1E1E1 solid" readonly placeholder="开始时间"/>

    </form>

</div>
<div class="row">
    <div class="right_nav">
        <div class="right_content">

            <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts-all.js"></script>

            <div class="right_content">
                <div id="mapCountry" style="width: 96%; height: 400px; padding: 10px;margin: auto;"></div>
            </div>
            <script type="text/javascript">
                function getStatMap() {

                    var clickCity = '';
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
                            if(clickCity == '' || clickCity != param.target){
                                console.log(param.target);

                                clickCity = param.target;
                            }else{
                                clickCity = '';
                                curIndx = 0;
                                mt = 'china';
                                option.tooltip.formatter = '{b}';
                            }
                        }

                        option.series[0].mapType = mt;
                        myChart.setOption(option, true);

                    });

                    option = {
                        title: {
                            text : '店铺下单会员数',
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
                                name: '店铺下单会员数',
                                type: 'map',
                                mapType: 'china',
                                selectedMode : 'single',
                                itemStyle:{
                                    normal:{label:{show:true}},
                                    emphasis:{label:{show:true}}
                                },
                                data:<?php echo $result;?>
                            }
                        ]
                    };
                    myChart.setOption(option);
                }
                getStatMap();
            </script>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/echarts/echarts.js"></script>

<script>
    //时间
    $('#start_time').datetimepicker({
        controlType: 'select',
        format:"Y-m-d",
        timepicker:false
    });

    $('#end_time').datetimepicker({
        controlType: 'select',
        format:"Y-m-d",
        timepicker:false
    });
    $('#search').click(function() {
        var start_time = $('#start_time').val();
        var end_time = $('#end_time').val();
        var kinds = $(".kinds").val();
        if(kinds==1){
            getAjax('orderpeople',start_time,end_time);
        }else if(kinds==2){
            getAjax('orderprice',start_time,end_time);
        }else if(kinds==3){
            getAjax('ordernum',start_time,end_time);
        }
    });
    $('.search').click(function(){
        $('.ui-btn').css("display","block")
    })
    $('#search_sx').click(function(){
        history.go(0);
    })
    $(".tabmenu li a").click(function () {
        $(".tabmenu li").removeClass("active bbc_seller_bg");
        $(this).parent("li").addClass("active bbc_seller_bg");

        var id = $(this).attr("data-id");
        if(id == 1)
        {
            $('.kinds').val(1);
            getAjax('orderpeople');
        }
        else if(id == 2)
        {
            $('.kinds').val(2);
            getAjax('orderprice');
        }
        else if(id == 3)
        {
            $('.kinds').val(3);
            getAjax('ordernum');
        }
    })

    function getAjax(a,start_time,end_time)
    {
        var s_time='';
        var e_time='';
        if(start_time==''||start_time=='undefined'){
            s_time='';
        }else{
            s_time='&start_time='+start_time;
        }
        if(end_time==''||end_time=='undefined'){
            e_time='';
        }else{
            e_time='&end_time='+end_time;
        }
        $('.right_content').html('<div class="loading"></div>');
        var url = "?ctl=Seller_Analysis_Operation&met=" + a + "&typ=e"+s_time+e_time;
        var pars = {};
        $.post(url,pars,showResponse);
        function showResponse(originalRequest)
        {
            $(".right_content").html(originalRequest);
        }
    }

</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>




<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<!--<link href="--><?//= $this->view->css ?><!--/cs/index.css" rel="stylesheet" type="text/css">-->
<!--<link href="--><?//=$this->view->css?><!--/index.css" rel="stylesheet" type="text/css">-->
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>

<script src="https://img.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
<script src="https://img.hcharts.cn/highmaps/highmaps.js"></script>
<script src="https://img.hcharts.cn/highcharts/modules/exporting.js"></script>
<script src="https://img.hcharts.cn/highcharts/modules/data.js"></script>
<script type="text/javascript">
    var SITE_URL = "<?=YLB_Registry::get('url')?>";
    try
    {
        //document.domain = 'ttt.com';
    } catch (e)
    {
    }
    var SYSTEM = SYSTEM || {};
    SYSTEM.skin = 'green';
    SYSTEM.isAdmin = true;
    SYSTEM.siExpired = false;
</script>
<style>
    .fixed-bar{
        background: none;
        width: auto;
    }
</style>
</head>
<body>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
        <div class="subject">
            <h3>店铺统计</h3>
            <h5>平台针对店铺的各项数据统计</h5>
        </div>
        <ul class="tab-base nc-row">
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=shop"><span>新增店铺</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=best_seller"><span>热卖排行</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=sales_statistics"><span>销售统计</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=Store_level"><span>店铺等级</span></a></li>
            <li><a  class="current" ><span>地区分布</span></a></li>
        </ul>
        </div>
      <div id="stat_tabs" class="  ui-tabs" style="min-height:500px;">
          <div class="mod-search cf" style="margin-top:20px;margin-left: 20px">
              <div class="fl" >
                  <ul class="ul-inline">
                      <li>
                          <input id="start_time" class="ui-input ui-datepicker-input" type="text" readonly placeholder="时间查询"/>
                      </li>
                      <li>
                          至   &nbsp;<input id="end_time" class="ui-input ui-datepicker-input" type="text" readonly placeholder="时间查询"/>
                      </li>
                      <li>
                          <span id="shop_class"></span>
                      </li>
                      <li> <a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                      <li><a class="ui-btn ui-btn-sp" id="btn-refresh">刷新<i class="iconfont icon-btn01"></i></a></li>
                  </ul>
              </div>
          </div>
      </div>
</div>
    <div id="container" style="width:1000px;height: 500px;margin: 0 auto;margin-top: 100px;"></div>
</body>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
<script>
    $(function () {
        function getStatdata(start_time,end_time,shop_class) {
            var data;
            $.ajax({
                url: SITE_URL + '?ctl=Seller_Shop&met=area_map&typ=json&start_time='+start_time+'&end_time='+end_time+'&shop_class='+shop_class,
                data: '',
                success: function (e) {
                    data = e.data;
                    $.getJSON('https://data.jianshukeji.com/jsonp?filename=geochina/china.json&callback=?', function (geojson) {
                        // Initiate the chart
                        $('#container').highcharts('Map', {
                            title: {
                                text: '店铺分布区域分析'
                            },
                            mapNavigation: {
                                enabled: true,
                                buttonOptions: {
                                    verticalAlign: 'bottom'
                                }
                            },
                            colorAxis: {},
                            series: [{
                                data: data,
                                mapData: geojson,
                                joinBy: ['name', 'name'],
                                name: '分布区域',
                                states: {
                                    hover: {
                                        color: '#BADA55'
                                    }
                                },
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name}'
                                }
                            }]
                        });
                    });
                }
            });
        }

        //店铺分类
//        $.get("./index.php?ctl=Shop_Class&met=shopClass&typ=json", function(result){
//            if(result.status==200)
//            {
//                var r = result.data;
//
//                $shop_class = $("#shop_class").combo({
//                    data:r,
//                    value: "id",
//                    text: "name",
//                    width: 110
//                }).getCombo();
//            }
//        });
        getStatdata();
        //时间
//        $('#start_time').datetimepicker({
//            controlType: 'select',
//            format:"Y-m-d",
//            timepicker:false
//        });
//
//        $('#end_time').datetimepicker({
//            controlType: 'select',
//            format:"Y-m-d",
//            timepicker:false
//        });
        $('#search').click(function()
        {
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();
            var shop_class = $shop_class.getValue();
            getStatdata(start_time,end_time,shop_class);
        });
    });

</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

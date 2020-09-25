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
<style>
    .fixed-bar{
        background: none;
        width: auto;
    }
    .currentli {
        color: #186ecc;
        background-color: #55a3fa;
    }

    .currentli a {
        color: #fff;
        background-color: #F53A59;
        border-top-left-radius:1em;
        border-top-right-radius:1em;
    }
    .tab-base a{
        height:27px;
    }
    .tab-base li{
        border-top-left-radius:1em;
        border-top-right-radius:1em;
    }
</style>
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
</head>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
            <div class="subject">
                <h3>会员统计</h3>
                <h5>平台针对会员的各项数据统计</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip"><span>新增会员</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_analysis"><span>会员分析</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_scale"><span>会员规模分析</span></a></li>
                <li><a  class="current"><span>区域分析</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_buy"><span>购买分析</span></a></li>
            </ul>
    </div>
      <div id="stat_tabs" class="  ui-tabs" style="min-height:500px">
          <ul class="tab-base nc-row" style="margin-left:20px;margin-top: 15px">
              <li style="background: #D4D4D4"><a href="javascript:" href="#goodsnum_div" nc_type="showdata" data-param='{"type":"goodsnum"}'>下单量</a></li>
              <li style="background: #D4D4D4"><a href="javascript:" href="#goodscount_div" nc_type="showdata" data-param='{"type":"goodscount"}'>下单商品数</a></li>
              <li style="background: #D4D4D4"><a href="javascript:" href="#orderamount_div" nc_type="showdata" data-param='{"type":"orderamount"}'>下单金额</a></li>
          </ul>
          <ul class="ul-inline" style="margin-left: 20px;margin-top: 10px">
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
<!-- 地图容器 -->
<div id="container" style="width:1000px;height: 500px;margin: 0 auto;margin-top: 100px;"></div>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
<script>
    $(function () {
        $(document).ready(
            function () {
                $(".tab-base li").click(function () {
                    $(this).addClass("currentli").siblings().removeClass("currentli");
                })
            });
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
        var str = '';
            getStatMap('','','membernum');
            $("[nc_type='showdata']").click(function(){
                var data_str = $(this).attr('data-param');
                eval('data_str = '+data_str);
                var start_time = $('#start_time').val();
                var end_time = $('#end_time').val();
                getStatMap(start_time,end_time,data_str.type);
                str = data_str.type;
            });
        $('#search').click(function() {
                if(str==''){
                    str = 'membernum';
                }
                var start_time = $('#start_time').val();
                var end_time = $('#end_time').val();
                getStatMap(start_time,end_time,str);
         });
         function getStatMap(start_time,end_time,type) {
             var type_name;
             if(type=='orderamount'){
                  type_name = '下单金额';
             }else if(type=='goodsnum'){
                 type_name = '下单量';
             }else{
                 type_name = '下单商品数';
             }
             var data;
             $.ajax({
                 url: SITE_URL + '?ctl=Seller_Vip&met=area_map&typ=json&start_time='+start_time+'&end_time='+end_time+'&type='+type,
                 data: '',
                 success: function (e) {
                     data = e.data;
                     $.getJSON('https://data.jianshukeji.com/jsonp?filename=geochina/china.json&callback=?', function (geojson) {
                         // Initiate the chart
                         $('#container').highcharts('Map', {
                             title: {
                                 text: '会员'+type_name+'区域分析'
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
                                 name: type_name,
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
    });

</script>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

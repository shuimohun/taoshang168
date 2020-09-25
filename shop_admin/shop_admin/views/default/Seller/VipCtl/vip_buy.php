<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
// var_dump($this->view->js_com);die;
include $this->view->getTplPath() . '/'  . 'header.php';
?>
    <link href="<?= $this->view->css ?>/cs/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/highcharts.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/flexigrid.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
<style>
    html, body {height: 100%;overflow: scroll;}
</style>
<body>
<div class="wrapper page">
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
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_area"><span>区域分析</span></a></li>
                <li><a class="current"><span>购买分析</span></a></li>
            </ul>
        </div>
    </div>
    <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation" style="height: 185px;width: 400px;position:absolute;background: #fff">
        <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
        </div>
        <ul>
            <li>符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款；2、采用货到付款方式支付并且交易已完成</li>
            <li>点击“设置价格区间”进入设置价格区间页面，客单价分布图将根据您设置的价格区间进行分布统计</li>
            <li>“购买频次分析”列表统计了该时间段内重复并有效购买过该次数的会员数量及占全部下单会员的比例，助于分析会员的粘性</li>
            <li>“购买时段分布”统计图展示时间段内的有效订单在各个时间段的分布情况，为工作时间的合理安排提供依据</li>
    </div>
    <div id="stat_tabs" class="  ui-tabs" style="min-height:30px">
        <ul class="ul-inline" style="margin-left: 20px;margin-top: 10px">
            <li>
                <input id="start_time" class="ui-input ui-datepicker-input" type="text" readonly placeholder="时间查询"/>
            </li>
            <li> <a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
            <li><a class="ui-btn ui-btn-sp" id="btn-refresh">刷新<i class="iconfont icon-btn01"></i></a></li>
        </ul>
    </div>
    <div class="ncap-stat-chart">
        <div class="title">
            <h3>客单价分布图 </h3>
            <h5><a href="index.php?ctl=Seller_Gr&met=manage" class="ncap-btn">设置价格区间</a></h5>
        </div>
        <?php if ($output['pricerange_statjson']){ ?>
            <div id="container_pricerange" style="height:400px"></div>
        <?php } else { ?>
            <div class="no-date"><i class="fa fa-exclamation-triangle"></i>查看客单价分布情况前，请先设置价格区间。<a href="index.php?ctl=Seller_Gr&met=manage" class="ncap-btn ncap-btn-orange">马上设置</a></div>
        <?php }?>
    </div>
    <div class="wrapper">
<!--        <div class="mod-search cf">-->
<!--            <div class="grid-wrap">-->
<!--                <table id="grid"></table>-->
<!--                <div id="page"></div>-->
<!--            </div>-->
<!--        </div>-->
        <div id="container" style="max-height:400px;margin-bottom:20px;"></div>
    </div>

</div>
</body>
<script>
    $(function () {
        //时间
        $('#start_time').datetimepicker({
            controlType: 'select',
            format:"Y-m-d",
            timepicker:false
        });
        function  distribution(start_time) {
            var start = '';
            if(start_time!=''){
                start = '&start_time='+start_time;
            }else{
                start;
            }
            $.ajax({
                url: SITE_URL + '?ctl=Seller_Vip&met=Buy_time_distribution&typ=json'+start,
                data: '',
                success: function(e) {
                    $('#container').highcharts(e.data);
                }
            });
        }
        distribution();
        $('#search').click(function() {
            var start_time = $('#start_time').val();
            distribution(start_time);
        });
    })

</script>
<script src="<?= YLB_Registry::get('base_url') ?>/shop_admin/static/default/js/controllers/seller/vip_buy.js"></script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>




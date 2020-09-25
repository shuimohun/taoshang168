<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/highcharts.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/flexigrid.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
</head>
<body>
<div class="wrapper page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>退款统计</h3>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Service&met=service"><span>退款统计</span></a></li>
                <li><a class="current"><span>店铺动态评分</span></a></li>
            </ul>
        </div>
    </div>
    <!-- 操作说明 -->
    <p class="warn_xiaoma"><span></span><em></em></p>
    <div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span id="explanationZoom" title="收起提示"></span><em class="close_warn">X</em>
        </div>
        <ul>
            <li>统计图展现了时间段内退款金额的走势情况</li>
            <li>统计列表则展现了时间段内退款记录的详细信息，并可以点击列表上方的“导出数据”将列表数据导出为Excel文件</li>
    </div>
         <div class="mod-toolbar-top cf">
               <div id="assisting-category-select" class="ui-tab-select">
                <ul class="ul-inline">
                    <li>
                        <input type="text" id="evaluation_desccredit" class="ui-input ui-input-ph con" placeholder="描述相符评分...">
                    </li>
                     <li>
                        <input type="text" id="evaluation_servicecredit" class="ui-input ui-input-ph con" placeholder="服务态度评分...">
                    </li>
                     <li>
                        <input type="text" id="evaluation_deliverycredit" class="ui-input ui-input-ph con" placeholder="发货速度评分...">
                    </li>
                    <li><a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                </ul>
             </div>
                <div class="fl">
                    <div class="fr">
                        <a class="ui-btn" id="btn-excel">导出<i class="iconfont icon-btn04"></i></a>
                        <a class="ui-btn" id="btn-refresh">刷新<i class="iconfont icon-btn01"></i></a>
                     </div>
                </div>
         </div>
    <div class="wrapper">
        <div class="mod-search cf">
            <div class="grid-wrap">
                <table id="grid"></table>
                <div id="page"></div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="<?= YLB_Registry::get('base_url') ?>/shop_admin/static/default/js/controllers/seller/dynamic.js"></script>
<script>
    $(function(){
        var combo_end_time = '2030-06-11 00:00:00';
        var maxdate =  new Date(Date.parse(combo_end_time.replace(/-/g, "/")));
        $('#start_time').datetimepicker({
            controlType: 'select',
//            minDate:new Date(),
            onShow:function( ct ){
                this.setOptions({
                    maxDate:($('#end_time').val() && (new Date(Date.parse($('#end_time').val().replace(/-/g, "/"))) < maxdate))?(new Date(Date.parse($('#end_time').val().replace(/-/g, "/")))):maxdate
                })
            }
        });

        $('#end_time').datetimepicker({
            controlType: 'select',
            maxDate:maxdate,
            onShow:function( ct ){
                this.setOptions({
                    minDate:($('#start_time').val() && (new Date(Date.parse($('#start_time').val().replace(/-/g, "/")))) > (new Date()))?(new Date(Date.parse($('#start_time').val().replace(/-/g, "/")))):(new Date())
                })
            }
        });
        Public.pageTab();
        THISPAGE.init(); 
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
<style>
    .tdd{
        border: 1px #E2E2E2 solid;
        text-align: center;
        width: 33px
    }
    .tddd{
        text-align: center;
        border: 1px #E2E2E2 solid;
        width: 33px
    }
</style>





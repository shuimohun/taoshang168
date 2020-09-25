<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
// var_dump($this->view->js_com);die;
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?= $this->view->css ?>/cs/index.css" rel="stylesheet" type="text/css">
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
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
        <div class="subject">
            <h3>会员统计</h3>
            <h5>平台针对会员的各项数据统计</h5>
        </div>
        <ul class="tab-base nc-row">
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=shop"><span>新增店铺</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=best_seller"><span>热卖排行</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=sales_statistics"><span>销售统计</span></a></li>
            <li><a class="current"><span>店铺等级</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=regional_distribution"><span>地区分布</span></a></li>
        </ul>
        </div>

      <div id="stat_tabs" class="  ui-tabs" style="min-height:500px">
          <div class="wrapper">
              <div class="mod-search cf">
                  <div id="container" style="max-height:400px;margin-bottom:20px;"></div>
              </div>
          </div>
      </div>
<!--      <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation" style="height: 170px;width: 420px;position:absolute;background: #fff">-->
<!--          <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>-->
<!--              <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>-->
<!--              <span id="explanationZoom" title="收起提示"></span>-->
<!--                            <em class="close_warn">X</em>-->
<!--          </div>-->
<!--          <ul>-->
<!--              <li>统计图展示各店铺分类中店铺等级的分布情况</li>-->
<!--      </div>-->
</div>

</body>
<script>

    $(function () {
        $.ajax({
            url: SHOP_URL + '?ctl=Api_Seller_Shop&met=store_level&typ=json',
            data: '',
            success: function(e) {
                $('#container').highcharts(e.data);
            }
        });

    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

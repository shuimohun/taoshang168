<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
// var_dump($this->view->js_com);die;
include $this->view->getTplPath() . '/'  . 'header.php';
?>
    <link href="<?= $this->view->css ?>/cs/index.css" rel="stylesheet" type="text/css">
<!--    <link rel="stylesheet" href="--><?//=$this->view->css_com?><!--/jquery/plugins/validator/jquery.validator.css">-->

    <style>
        #container {
    min-width: 310px;
    max-width: 100%;
    height: 400px;
    margin: 0 auto
}
    </style>
<div class="page">
 <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>商品分析</h3>
                <h5>平台针对商品的各项数据统计</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a class="current"><span>价格销量</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Goods&met=hotgoods"><span>热卖商品</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Goods&met=goods_sale"><span>商品销售明细</span></a></li>
            </ul>
        </div>
    </div>
    <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation" style="height: 140px;width: 400px;position:absolute;background: #fff">
        <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
        </div>
        <ul>
            <li>符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款；2、采用货到付款方式支付并且交易已完成</li>
            <li>点击“设置价格区间”进入设置价格区间页面，下方统计图将根据您设置的价格区间进行统计</li>
            <li>统计图展示符合搜索条件的有效订单中的商品单价，在所设置的价格区间的分布情况</li>
    </div>
    <div class="ncap-stat-chart">
        <div class="title">
            <h3>价格销量分布图</h3>
            <h5><a href="index.php?ctl=Seller_Gr&met=manage" class="ncap-btn">设置价格区间</a></h5>
        </div>
        <?php if ($output['pricerange_statjson']){ ?>
            <div id="container_pricerange" style="height:400px"></div>
        <?php } else { ?>
            <div class="no-date"><i class="fa fa-exclamation-triangle"></i>查看分布情况前，请先设置价格区间。<a href="index.php?ctl=Seller_Gr&met=manage" class="ncap-btn ncap-btn-orange">马上设置</a></div>
        <?php }?>
    </div>
</div>
      <script src="<?= $this->view->js_com ?>/plugins/cs/jquery.js"></script>
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>




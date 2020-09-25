<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
</head>
<body>
<div class="wrapper page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>手机专享</h3>
                <h5>店铺商品手机专享促销活动设置及管理</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a class="current"><span>活动列表</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Promotion_Price&met=priceQuota"><span>套餐列表</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Config&met=price&config_type%5B%5D=price"><span>设置</span></a></li>
            </ul>
        </div>
    </div>
    <!-- 操作说明 -->
    <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span id="explanationZoom" title="收起提示"></span><em class="close_warn">X</em>
        </div>
        <ul>
            <li>该促销为移动端（Wap、Android，IOS）专门享有</li>
    </div>
    
    <div class="wrapper">
        <div class="mod-search cf">
            <div class="fl">
                <ul class="ul-inline">

                    <li>
                         <input type="text" id="goods_id" class="ui-input ui-input-ph matchCon" name="goods_id" placeholder="商品SKU...">
                    </li>
                    <li><a class="ui-btn mrb" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                </ul>
            </div>
            <div class="fr">
                <a class="ui-btn" id="btn-refresh">刷新<i class="iconfont icon-btn01"></i></a>
            </div>
        </div>

        <div class="grid-wrap">
            <table id="grid"></table>
            <div id="page"></div>
        </div>
    </div>
</div>
<script src="<?= YLB_Registry::get('base_url') ?>/shop_admin/static/default/js/controllers/promotion/price/price.js"></script>
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

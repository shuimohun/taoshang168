<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-stand|ie-comp">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="description" content="<?php if($this->description){?><?=$this->description ?><?php }?>" />
    <meta name="Keywords" content="<?php if($this->keyword){?><?=$this->keyword ?><?php }?>" />
    <title><?php if($this->title){?><?=addslashes($this->title) ?><?php }else{?><?= addslashes(Web_ConfigModel::value('site_name')) ?><?php }?></title>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/headfoot.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/sidebar.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/index.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/nav.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/base.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/swiper.css"/>
    <link href="<?= $this->view->css ?>/iconfont/iconfont.css?ver=<?= VER ?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?= $this->view->js_com ?>/jquery-1.11.3.min.js"></script>
    <!--<script type="text/javascript" src="<?/*= $this->view->js */?>/swiper.min.js"></script>-->
    <script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/supplier_index.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/nav.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/jquery.nicescroll.js"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/base.js"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript">
        var BASE_URL = "<?=YLB_Registry::get('base_url')?>";
        var SITE_URL = "<?=YLB_Registry::get('url')?>";
        var INDEX_PAGE = "<?=YLB_Registry::get('index_page')?>";
        var STATIC_URL = "<?=YLB_Registry::get('static_url')?>";
        var PAYCENTER_URL = "<?=YLB_Registry::get('paycenter_api_url')?>";
        var UCENTER_URL = "<?=YLB_Registry::get('ucenter_api_url')?>";
        var is_open_city = "<?= Web_ConfigModel::value('subsite_is_open');?>";
        var DOMAIN = document.domain;
        var WDURL = "";
        var SCHEME = "default";
    </script>

    <!--添加lazyload Zhenzh-->
    <!--[if lt IE 9]>
    <script src="<?= $this->view->js ?>/html5shiv.js"></script>
    <![endif]-->
    <script src="<?= $this->view->js ?>/jquery.lazyload.min.js?v=1.9.1"></script>

</head>
<body>

<div class="head">
    <div class="wrapper clearfix">
        <div class="head_left">
            <div id="login_top">
                <dl class="header_select_province">
                    <dt><b class="iconfont icon-dingwei2"></b><span id="area"><?php $show_area_name = ''; if(Web_ConfigModel::value('subsite_is_open')){isset($_COOKIE['sub_site_name']) ? $show_area_name = $_COOKIE['sub_site_name'] : $show_area_name = '全部';}else{isset($_COOKIE['area']) ? $show_area_name = $_COOKIE['area'] : $show_area_name = '全部';} ?><?=$show_area_name?></span></dt>
                    <dd>
                    </dd>
                </dl>
            </div>

        </div>
        <div class="head_right">
            <dl>
                <dt><a href="<?= YLB_Registry::get('url') ?>?ctl=Index&met=index" target="_blank">淘尚168首页</a></dt>
            </dl>
            <dl>
                <dt><a href="<?= YLB_Registry::get('url') ?>?ctl=Supplier_Index&met=index" target="_blank">工厂联盟首页</a></dt>
            </dl>
            <dl>
                <dt><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical"><?=_('我的订单')?></a></dt>
            </dl>

            <dl>
                <dt>
                    <a href="<?= YLB_Registry::get('paycenter_api_url') ?>" target="_blank">
                        <span class="iconfont icon-paycenter bbc_color"></span><?=YLB_Registry::get('paycenter_api_name')?>
                    </a>
                </dt>
            </dl>

            <dl>
                <dt>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=favoritesGoods" target="_blank">
                        <span class="iconfont icon-taoxinshi bbc_color"></span><?=_('我的收藏')?>
                    </a>
                </dt>
                <dd class="rel_nav">
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=favoritesShop"><?=_('店铺收藏')?></a>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=favoritesGoods"><?=_('商品收藏')?></a>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=footprint"><?=_('我的足迹')?></a>
                </dd>
            </dl>
            <dl>
                <dt>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Cart&met=cart"><span class="iconfont icon-zaiqigoumai bbc_color"></span><?=_('购物车')?></a>
                </dt>
            </dl>
            <dl>
                <dt><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Custom&met=index" target="_blank"><?=_('客服中心')?></a></dt>
                <dd class="rel_nav">
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Article_Base&met=index&article_id=2"><?=_('帮助中心')?></a>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index"><?=_('售后服务')?></a>
                </dd>
            </dl>
            <dl>
                <p></p>
                <dt><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Index&met=index" target="_blank"><?=_('商家中心')?></a></dt>
                <dd class="rel_nav">
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Supplier_Settled&met=index"><?=_('申请入驻')?></a>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Supplier_Index&met=index"><?=_('工厂联盟')?></a>
                </dd>
            </dl>
            <dl>
                <dt><span class="iconfont icon-shoujibangding bbc_color"></span><a href="#"><?=_('手机版')?></a></dt>
                <dd class="rel_nav  phone-code">
                    <img src="<?=YLB_Registry::get('base_url')?>/shop/api/qrcode.php?data=<?=urlencode(YLB_Registry::get('shop_wap_url'))?>" width="150" height="150"/>
                </dd>
            </dl>
            <!--<dl>
                <dt><a href="#">商家支持</a></dt>
                <dd class="rel_nav"><a href="#">代付款订单</a><a href="#">代付款订单</a><a href="#">代付款订单</a></dd>
            </dl>-->
        </div>
    </div>
</div>



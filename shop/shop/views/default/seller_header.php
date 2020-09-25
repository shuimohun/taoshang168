<?php
    if (!defined('ROOT_PATH')){exit('No Permission');}
    $seller_menu = include_once INI_PATH . '/seller_menu.ini.php';

    //生鲜特产 早晚市 显隐控制
    if($this->shop_base['shop_class_id'] != Shop_BaseModel::SHENGXIAN && $this->shop_base['shop_all_class'] != 1)
    {
        unset($seller_menu[13000]['sub'][130025]);
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-stand|ie-comp" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=0.7, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="<?php if($this->description){?><?=$this->description ?><?php }?>" />
    <meta name="Keywords" content="<?php if($this->keyword){?><?=$this->keyword ?><?php }?>" />
    <title><?php if($this->title){?><?=$this->title ?><?php }else{?><?= Web_ConfigModel::value('site_name') ?><?php }?></title>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link type="text/css" rel="stylesheet" href="<?= $this->view->css ?>/base.css?ver=<?=VER?>">
    <link type="text/css" rel="stylesheet" href="<?= $this->view->css ?>/seller.css?ver=<?= VER ?>">
    <link type="text/css" rel="stylesheet" href="<?= $this->view->css ?>/iconfont/iconfont.css?ver=<?= VER ?>">
    <link type="text/css" rel="stylesheet" href="<?= $this->view->css_com ?>/ztree.css?ver=<?=VER?>">
    <link type="text/css" rel="stylesheet" href="<?= $this->view->css ?>/tips.css?ver=<?=VER?>">
    <link type="text/css" rel="stylesheet" href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css" >

    <script type="text/javascript" charset="utf-8" src="<?= $this->view->js_com ?>/jquery.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?= $this->view->js_com ?>/plugins/jquery.cookie.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?=$this->view->js?>/common.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js"></script>

    <script type="text/javascript">
        var BASE_URL = "<?=YLB_Registry::get('base_url')?>";
        var SITE_URL = "<?=YLB_Registry::get('url')?>";
        var INDEX_PAGE = "<?=YLB_Registry::get('index_page')?>";
        var STATIC_URL = "<?=YLB_Registry::get('static_url')?>";
		var PAYCENTER_URL = "<?=YLB_Registry::get('paycenter_api_url')?>";
		var UCENTER_URL = "<?=YLB_Registry::get('ucenter_api_url')?>";
        var DOMAIN = document.domain;
        var WDURL = "";
        var SCHEME = "default";

        var SYSTEM = SYSTEM || {};
        SYSTEM.skin = 'green';
        SYSTEM.isAdmin = true;
        SYSTEM.siExpired = false;
    </script>
</head>
<body>

<?php if($this->shop_base['shop_status'] == 0){?>
    <div class="shop-closed">
        <i class="iconfont icon-tanhao close"></i>
        <dl>
            <dt>您的店铺已被平台关闭</dt>
            <dd>在此期间，您的店铺以及商品将无法访问；如果您有异议或申诉请及时联系平台管理。</dd>
            <?php if($this->shop_base['shop_close_reason']){ ?>
                <dd>关闭原因：<?=$this->shop_base['shop_close_reason']?></dd>
            <?php } ?>
            <?php if($this->shop_base['shop_expire']){ ?>
                <dd>
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Shop_Info&met=info&typ=e&act=renew">前去续签</a>
                </dd>
            <?php } ?>
        </dl>
    </div>
<?php }else if(isset($this->shop_base['expire_warn_day'])){?>
    <div class="shop-closed">
        <i class="iconfont icon-tanhao"></i>
        <dl>
            <dt>店铺
                <?php if($this->shop_base['expire_warn_day'] == 0){ echo '今天';}else{ echo $this->shop_base['expire_warn_day'].'天后';}?>
                到期，请及时续签
            </dt>
            <br/>
            <dd>
                <a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Shop_Info&met=info&typ=e&act=renew">前去续签</a>
            </dd>
        </dl>
    </div>
<?php }?>


<div class="header">
    <div class="wrapper fn-clear clearfix">
        <div class="logo">
            <a href="index.php?ctl=Seller_Index&met=index&typ=e"><img src="<?php if(!empty($this->web['seller_logo'])){echo $this->web['seller_logo'];}?>"></a>
            <span><?php if(@$this->shopBase['shop_type'] == 2) echo '供应商中心';else echo '商家中心'; ?></span>
        </div>
        <div class="index-search-container">
            <div class="index-sitemap bbc_seller_bg"><a class="js-sitemap" href="javascript:void(0);">导航管理 <i class="icon-angle-down"></i></a>
                <div class="js-menu-arrow sitemap-menu-arrow" style="display:none;"></div>
                <div class="js-menu sitemap-menu" style="display:none;">
                    <div class="title-bar">
                        <h2 class="bbc_seller_color"><i class="icon-sitemap"></i>管理导航<em>小提示：添加您经常使用的功能到首页侧边栏，方便操作。</em></h2>
                        <span id="closeSitemap" class="close">X</span></div>
                    <div id="quicklink_list" class="content ">
                        <?php foreach ($seller_menu as $menu_row) { ?>
                            <?php if ($menu_row['menu_url_ctl'] != 'Seller_Index'){ ?>
                                <dl>
                                    <dt><?= $menu_row['menu_name'] ?></dt>
                                    <?php foreach ($menu_row['sub'] as $menu_level) { ?>
                                        <dd class="selected"><i nctype="btn_add_quicklink" data-quicklink-act="<?= $menu_level['menu_id'] ?>" class="icon-icon_duigou2" title="添加为常用功能菜单"></i>
                                            <a href="<?= sprintf('%s?ctl=%s&met=%s&typ=e&%s', YLB_Registry::get('url'), $menu_level['menu_url_ctl'], $menu_level['menu_url_met'], $menu_level['menu_url_parem']); ?>"> <?= $menu_level['menu_name'] ?> </a>
                                        </dd>
                                    <?php } ?>
                                </dl>
                            <?php } ?>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="search-bar bbc_seller_border">
                <form method="get" target="_blank">
                    <input type="hidden" name="ctl" value="Goods_Goods">
                    <input type="hidden" name="met" value="goodslist">
                    <input type="hidden" name="typ" value="e">
                    <input type="text" nctype="search_text" name="keywords" placeholder="商城商品搜索" class="search-input-text" style="background:#2B251F;border: 0;">
                    <input type="submit" nctype="search_submit" class="search-input-btn pngFix" value="">
                </form>
            </div>
        </div>
        <ul class="nav">
            <li class="<?=Seller_Controller::$current_menu['model'] == 'index'?'cur bbc_seller_bg':'';?>">
                <dt><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Index&met=index&typ=e"><?=_('首页')?></a></dt>
                <dd class="arrow"></dd>
            </li>
            <?php if(!empty(Seller_Controller::$menu) && is_array(Seller_Controller::$menu)){foreach (Seller_Controller::$menu as $key=> $menu_row){?>
                <li class="<?=(Seller_Controller::$current_menu['model'] == $key) ? 'cur bbc_seller_bg' : '' ?>">
                    <a class="dropdown-toggle"
                       href="<?= sprintf('%s?ctl=%s&met=%s&typ=e', YLB_Registry::get('url'), $menu_row['sub'][key($menu_row['sub'])]['ctl'], $menu_row['sub'][key($menu_row['sub'])]['met']); ?>">
                        <?= $menu_row['name'] ?>
			        </a><?php if($menu_row['name']=='客服消息' && $this->user_info['message'] > 0){?><i class="bbuyer_news"><?=$this->user_info['message']?></i><?php }?>
                </li>
            <?php }}?>
			<li><a href="<?=YLB_Registry::get('paycenter_api_url')?>" target="_blank"><?=YLB_Registry::get('paycenter_api_name')?></a></li>
        </ul>
        <div class="ncsc-admin">
            <dl class="ncsc-admin-info">
                <dt class="admin-avatar"><img src="<?=$this->user_info['user_logo']?>" width="32" class="pngFix" alt=""></dt>
                <dd class="admin-permission"><?=_('当前用户')?></dd>
                <dd class="admin-name"><?=$this->user_info['user_name']?></dd>
            </dl>
            <div class="ncsc-admin-function">
                <a href="<?=YLB_Registry::get('url')?><?php if(@$this->shop_base['shop_type'] == 2){?>?ctl=Supplier_Index&met=index<?php }?>" title="前往商城"><i class="iconfont icon-fangzi"></i></a>
                <a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=index&id=<?=Perm::$shopId ?>" title="前往店铺"><i class="iconfont icon-dianpu2"></i></a>
                <a href="<?=YLB_Registry::get('ucenter_api_url')?>?ctl=User&met=getUserInfo" title="基本信息" target="_blank"><i class="iconfont icon-banshou"></i></a>
                <a href="<?=YLB_Registry::get('url')?>?ctl=Login&met=loginout" title="安全退出"><i class="iconfont icon-tuichu"></i></a>
            </div>
        </div>
    </div>
</div>

<?php if ($ctl == 'Seller_Index' && $met == 'index'){?>
    <div class="wrapper main">
        <div>
            <div>
<?php } else { ?>
            <div class="layout wrapper fn-clear">
                <?php if($ctl =="Seller_Shop_Decoration" && $met =="decoration"  && $act =="set"){ ?>

                <?php }else{ ?>
                    <div class="left-layout">
                        <ul>
                            <?php foreach ($seller_menu[$level_row[1]]['sub'] as $menu_row) { ?>
                                <li>
                                    <a class="<?= ($menu_row['menu_id'] == $level_row[2]) ? 'active' : '' ?>" href="<?= sprintf('%s?ctl=%s&met=%s&typ=e&%s', YLB_Registry::get('url'), $menu_row['menu_url_ctl'], $menu_row['menu_url_met'], $menu_row['menu_url_parem']); ?>"><?= $menu_row['menu_name'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
               <?php } ?>

                <div class="<?php if(!($ctl =="Seller_Shop_Decoration" && $met =="decoration"  && $act =="set")){ ?>right-layout<?php }?>"<?php if($ctl =="Seller_Shop_Decoration" && $met =="decoration"  && $act =="set"){ ?> style="float:left;background: #fff;"<?php }?>>
                    <?php if(!($ctl =="Seller_Shop_Decoration" && $met =="decoration"  && $act =="set")){ ?>
                        <div class="path">
                            <i class="iconfont icon-diannao"></i>商家管理中心
                            <i class="iconfont icon-iconjiantouyou"></i><?= $seller_menu[$level_row[1]]['menu_name'] ?>
                            <i class="iconfont icon-iconjiantouyou"></i><?= $seller_menu[$level_row[1]]['sub'][$level_row[2]]['menu_name'] ?>
                        </div>
                    <?php }?>
                    <div class="content">
                        <?php if (isset($seller_menu[$level_row[1]]['sub'][$level_row[2]]['sub'])){ ?>
                            <?php if($ctl =="Seller_Shop_Decoration" && $met =="decoration"  && $act =="set"){ ?>

                            <?php }else{ ?>
                                <div class="tabmenu">
                                    <ul>
                                        <?php foreach ($seller_menu[$level_row[1]]['sub'][$level_row[2]]['sub'] as $menu_row){if ($menu_row['menu_url_met'] == 'combo'){ if ((@$this->self_support_flag || @$this->selfSupportFlag)){continue;}} ?>
                                            <li class="<?= ($menu_row['menu_id'] == $level_row[3]) ? 'active bbc_seller_bg' : '' ?>">
                                                <a href="<?= sprintf('%s?ctl=%s&met=%s&typ=e&%s', YLB_Registry::get('url'), $menu_row['menu_url_ctl'], $menu_row['menu_url_met'], $menu_row['menu_url_parem']); ?>"><?= $menu_row['menu_name'] ?></a>
                                            </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            <?php } ?>
                        <?php } ?>
<?php } ?>


<?php if (!defined('ROOT_PATH')){exit('No Permission');}
	include_once INI_PATH . '/buyer_menu.ini.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-stand|ie-comp">
    <meta name="renderer" content="webkit">
    <meta name="description" content="<?php if($this->description){?><?=$this->description ?><?php }?>" />
	<meta name="Keywords" content="<?php if($this->keyword){?><?=$this->keyword ?><?php }?>" />
	<title><?php if($this->title){?><?=$this->title ?><?php }else{?><?= Web_ConfigModel::value('site_name') ?><?php }?></title>

    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/base.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/headfoot.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/buyer.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/gold.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css" />
	<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/iconfont/iconfont.css?ver=<?= VER ?>">
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css">
	<script type="text/javascript" src="<?= $this->view->js_com ?>/jquery.js"></script>
	<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/angular.js"></script>

	<!--[if lt IE 9]>
	<script src="<?=$this->view->js_com?>/html5shiv.js"></script>
	<script src="<?=$this->view->js_com?>/respond.js"></script>
	<![endif]-->
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
	</script>
</head>
<body>
    <div class="bbuyer_head bbc_bg">
        <div class="wrap clearfix bbc_bg">
            <div class="bbuyer_head_fl">
                <div class="bbuyer_logo">
                    <a href="<?= YLB_Registry::get('url') ?>"><img src="<?=$this->web['web_logo']?>"/></a>
                </div>
                <div class="bbuyer_others">
                    <p class="mine_shopmall"><?=_('我的商城')?></p>
                    <p class="back_mall_index"><a href="<?= YLB_Registry::get('url') ?>"><?=_('返回商城首页')?></a></p>
                </div>
                <div class="bbuyer_head_nav">
                    <ul>
                        <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Index&met=index"><?=_('首页')?></a></li>
                        <li class="set">
                            <a class="user_setup"><?=_('用户设置')?><i class="iconfont icon-iconjiantouxia"></i></a>
                            <div class="sub-menu">
                                <dl>
                                    <dt><a href="<?= YLB_Registry::get('ucenter_api_url') ?>?ctl=User&met=security" style="color: #3AAC8A;"><?=_('安全设置')?></a></dt>
                                    <dd><a href="<?= YLB_Registry::get('ucenter_api_url') ?>?ctl=User&met=security&op=mobile<?php if($this->user['info']['user_mobile'] && $this->user['info']['user_mobile_verify']==1){?>s<?php }?>"><?=_('手机绑定')?></a></dd>
                                    <dd><a href="<?= YLB_Registry::get('ucenter_api_url') ?>?ctl=User&met=security&op=email<?php if($this->user['info']['user_email'] && $this->user['info']['user_email_verify']==1){?>s<?php }?>"><?=_('邮件绑定')?></a></dd>
                                    <dd><a href="<?= YLB_Registry::get('ucenter_api_url') ?>?ctl=User&met=getUserImg"><?=_('修改头像')?></a></dd>
                                    <dd><a href="<?= YLB_Registry::get('ucenter_api_url') ?>?ctl=User&met=passwd"><?=_('修改密码')?></a></dd>
                                </dl>
                                <dl>
                                    <dt><a href="<?= YLB_Registry::get('ucenter_api_url') ?>?ctl=User&met=getUserInfo" style="color: #EA746B"><?=_('个人资料')?></a></dt>
                                    <dd><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_User&met=tag"><?=_('兴趣标签')?></a></dd>
                                    <dd><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Message&met=message&op=manage"><?=_('消息接受设置')?></a></dd>
                                    <dd><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_User&met=getUserGrade"><?=_('会员级别')?></a></dd>

                                </dl>
                                <dl>
                                    <dt><a href="<?= YLB_Registry::get('paycenter_api_url') ?>" style="color: #FF7F00"><?=_('账户财产')?></a></dt>
                                    <dd><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Voucher&met=voucher"><?=_('我的代金券')?></a></dd>
                                    <dd><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Points&met=points"><?=_('我的金蛋')?></a></dd>

                                </dl>
                                <dl>
                                    <dt><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=favoritesGoods"  style="color: #398EE8"><?=_('我的收藏')?></a></dt>
                                    <dd><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=favoritesShop"><?=_('店铺收藏')?></a></dd>
                                    <dd><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=favoritesGoods"><?=_('商品收藏')?></a></dd>
                                </dl>
                            </div>
                        </li>
                        <li><a href="<?=YLB_Registry::get('paycenter_api_url')?>" target="_blank"><?=YLB_Registry::get('paycenter_api_name')?></a></li>
                        <li>
                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Message&met=message">
                                <?=_('消息')?>
                            </a>
                            <?php if($this->countMessage['countMessage'] > 0){?>
                                <i class="bbuyer_news"><?=$this->countMessage['countMessage']?></i>
                            <?php }?>
                        </li>
                        <?php if(Web_ConfigModel::value('Plugin_Directseller')){ ?><li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=index&typ=e">淘金中心</a></li><?php }?>
                    </ul>
                </div>
            </div>

            <!-- 购物车 -->
            <div class="bbuyer_cart">
                <div class="bbc_buyer_icon">
                    <i class="ci_left iconfont icon-zaiqigoumai bbc_color rel_top2"></i>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Cart&met=cart" target="_blank"><?=_('我的购物车')?></a>
                    <i class="ci_right iconfont icon-iconjiantouyou"></i>
                    <i class="ci-count bbc_bg" id="cart_num"><?=$this->cart_count?></i>
                </div>
            </div>
            <form name="form_search" id="form_search" action="">
                <div class="bbuyer_head_fr">
                        <input type="hidden" name="ctl" value="Goods_Goods">
                        <input type="hidden" name="met" value="goodslist">
                        <input type="hidden" name="typ" value="e">
                        <input type="text" class="bbuyer_inp_ser" name="keywords" placeholder="<?=_('请输入商品名字')?>" id="site_keywords">
                        <input type="submit" style="display: none;" >

                    <a class="bbuyer_search"  id="site_search" ><?=_('搜索')?></a>
                </div>
            </form>
        </div>
    </div>

    <div class="Colr">
        <div class="wrapper ">
            <?php if ($this->ctl == 'Buyer_Index'):?>
                <div class="Div_2 clearfix">
                    <div class="left">
                        <div class="_img">
                            <img src="<?php if(!empty($this->user['info']['user_logo'])){?><?=image_thumb($this->user['info']['user_logo'],108,108)?><?php }else{?><?= image_thumb($this->web['user_logo'],108,108)?><?php }?>" width="108" height="108"/>
                        </div>
                        <div class="font">
                            <table>
                                <tbody>
                                    <tr ><td colspan="2" class="name"><?=$this->user['info']['user_name'];?></td></tr>
                                    <tr><td class="fontColor"><?=_('会员级别:')?></td><td><span class="nc-grade-mini bbc_bg  pad" ><?=$this->user['grade']['user_grade_name']?></span></td></tr>
                                    <tr>
                                        <td class="fontColor"><?=_('账号安全:')?></td>
                                        <td class="tiao"><span title="<?php if($this->user['info']['user_level_id']==1){?>5<?php }elseif($this->user['info']['user_level_id']==2){?>50<?php }else{?>100<?php }?>%"><i class="bbc_bg" style="width:<?php if($this->user['info']['user_level_id']==1){?>1<?php }elseif($this->user['info']['user_level_id']==2){?>50<?php }else{?>100<?php }?>%;"></i></span><a><?php if($this->user['info']['user_level_id']==1){?><?=_('低')?><?php }elseif($this->user['info']['user_level_id']==2){?><?=_('中')?><?php }else{?><?=_('高')?><?php }?></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="right">
                        <div class="_left">
                            <ul>
                                <li>
                                    <div class="Divradius">
                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&status=wait_pay"><img src="<?= $this->view->img ?>/ico_dai1.png"></a>
                                    </div>
                                    <p class="_p">
                                        <?=_('待付款')?> <strong><?=$this->count['count1'] ?></strong>
                                    </p>
                                </li>
                                <li>
                                    <div class="Divradius">
                                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&status=wait_confirm_goods"><img src="<?= $this->view->img ?>/ico_dai2.png"></a>
                                    </div>
                                    <p class="_p">
                                        <?=_('待收货')?> <strong><?=$this->count['count2'] ?></strong>
                                    </p>
                                </li>
                                <li>
                                    <div class="Divradius">
                                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&status=finish"><img src="<?= $this->view->img ?>/ico_dai3.png"></a>
                                    </div>
                                    <p class="_p">
                                        <?=_('已完成')?>
                                        <strong><?=$this->count['count3'] ?></strong>
                                    </p>
                                </li>
                                <li>
                                    <div class="Divradius">
                                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&status=cancel"><img src="<?= $this->view->img ?>/ico_dai4.png"></a>
                                    </div>
                                    <p class="_p">
                                        <?=_('已取消')?>
                                        <strong><?=$this->count['count4'] ?></strong>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="b_rol">
                            <div class=" same">
                                <div class="same_1">
                                    <a href="<?= YLB_Registry::get('paycenter_api_url') ?>"><i class="iconfont icon-iconyue ts_1"></i></a>
                                    <a href="<?= YLB_Registry::get('paycenter_api_url') ?>"><?= _('余额') ?>
                                </div>
                                <a href="<?= YLB_Registry::get('paycenter_api_url') ?>">
                                    <div class="same_2" id="mons">
                                        <?php if(isset($user_money) && $user_money['user_money']){?>
                                            <?=format_money($user_money['user_money'])?>
                                            <?php if($user_money['user_money_frozen']){?>
                                                <span><?=format_money($user_money['user_money_frozen'])?></span>
                                            <?php }?>
                                        <?php }else{?>
                                            <?=format_money(0.00)?>
                                        <?php }?>
                                    </div>
                                </a>
                            </div>
                            <div class="same">
                                <div class="same_1">
                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Points&met=points"><i class="iconfont  icon-iconjifen ts_2"></i></a>
                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Points&met=points"><?= _('金蛋') ?></a>
                                </div>
                                <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Points&met=points"><div class="same_2"><?= $this->user['points']['user_points']; ?></div></a>
                            </div>
                            <div class="same">
                                <div class="same_1">
                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Voucher&met=voucher"><i class="iconfont icon-iconquan  ts"></i></a>
                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Voucher&met=voucher"><?= _('代金卷') ?></a>
                                </div>
                                <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Voucher&met=voucher"><div class="same_2"><?= $this->user['voucher']; ?></div></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;?>

            <div class="Div3 clearfix">
                <?php if ('Buyer_Index'==$ctl && 'index'==$met){ ?>
                    <div class="left_1   visible-lg">
                        <?php foreach ($buyer_menu[$level_row[1]]['sub'] as $menu_row){?>
                            <ul class="jiaoyizhognxin">
                                <li><a href="#" class="_font"><?=$menu_row['menu_name']?></a></li>
                                <?php if(!empty($menu_row['sub'])){foreach ($menu_row['sub'] as $menus_row){ ?>
                                    <li>
                                        <a href="<?=sprintf('%s?ctl=%s&met=%s', YLB_Registry::get('url'), $menus_row['menu_url_ctl'], $menus_row['menu_url_met'], $menus_row['menu_url_parem']);?>" class="_Color" style="<?=($menus_row['menu_id'] == $level_row[1]) ? 'color:red;' : ''?>">
                                            <?=$menus_row['menu_name']?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php }} ?>
                    </div>
                <?php }else{ ?>
                    <div class="left_1 visible-lg">
                        <?php foreach ($buyer_menu[$level_row[1]]['sub'] as $menu_row){?>
                            <ul class="jiaoyizhognxin">
                                <li><a href="#" class="_font"><?=$menu_row['menu_name']?></a></li>
                                <?php if(!empty($menu_row['sub'])){ foreach ($menu_row['sub'] as $menus_row) { ?>
                                    <li>
                                        <a <?php $arrnames=array('会员信息','账户安全','密码修改');if(in_array($menus_row['menu_name'], $arrnames)){ ?> target="_blank" <?php } ?>  href="<?=sprintf('%s?ctl=%s&met=%s', YLB_Registry::get('url'), $menus_row['menu_url_ctl'], $menus_row['menu_url_met'], $menus_row['menu_url_parem']);?>" class="_Color"  style="<?=($menus_row['menu_id'] == $level_row[3]) ? 'color:red;' : ''?>">
                                            <?=$menus_row['menu_name']?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php }} ?>
                    </div>
                    <?php if (@isset($buyer_menu[$level_row[1]]['sub'][$level_row[2]]['sub'][$level_row[3]]['sub'])){ ?>
                    <div class="aright">
                        <div class="member_infor_content">
                            <div class="tabmenu">
                                <ul class="tab pngFix">
                                <?php foreach ($buyer_menu[$level_row[1]]['sub'][$level_row[2]]['sub'][$level_row[3]]['sub'] as $menu_row) { ?>
                                    <li class="<?=($menu_row['menu_id'] == $level_row[4]) ? 'active' : 'normal'?>"><a  href="<?=sprintf('%s?ctl=%s&met=%s', YLB_Registry::get('url'), $menu_row['menu_url_ctl'], $menu_row['menu_url_met'], $menu_row['menu_url_parem']);?>"><?=$menu_row['menu_name']?></a></li>
                                <?php } ?>
                                </ul>
                    <?php } ?>
                <?php } ?>


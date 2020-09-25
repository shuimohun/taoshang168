<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>

<style>

    .share_div{
        margin-top:5px;
    }
    .share {
        width: 98px;
        height: 18px;
        border: 1px solid #c51e1e;
        font-size: 12px;
        line-height: 19px;
        color: #c51e1e;
        text-align: center;
    }
    .share_wrap{
        display: inline-block;
        float:left;
        margin-left:25px;
        margin-top: 0px;
        margin-bottom: -3px;
    }
    .share u{
        text-decoration: none;
        background-color: #c51e1e;
        color: #fff;
        float: right;
        width: 48px;
        height: 100%;
        text-align: center;
    }
    .clear{
        clear:both;
    }
</style>

<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/personalstores.css">
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/goods-detail.css"/>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/Group-integral.css"/>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/base.css">
<script type="text/javascript" src="<?=$this->view->js?>/angular.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/goodsListCat.js"></script>
<div ng-app="app" ng-controller="shopGoodsListCtl">
<div class="wrap clearfix template-gray">
    <div class="bbc-store-info">
        <div class="basic">
            <div class="displayed"><a href=""><?=$shop_base['shop_name']?></a>
                <span class="all-rate">
                     <div class="rating"><span style="width: <?=$shop_scores_percentage?>%"></span></div>
                       <em><?=$shop_scores_count?></em><em>分</em></span>
            </div>
            <div class="sub">
                <div class="store-logo"><img src="<?=$shop_base['shop_logo']?>" alt="<?=$shop_base['shop_name']?>" title="<?=$shop_base['shop_name']?>"></div>
                <!--店铺基本信息 S-->
                <div class="bbc-info_reset">
                    <div class="title">
                        <h4><?=$shop_base['shop_name']?></h4>
                    </div>
                    <div class="content_reset">
                        <div class="bbc-detail-rate">
                            <ul>
                                <li>
                                    <h5>描述</h5>
                                    <div class="low" ><?=$shop_detail['shop_desc_scores']?><i></i></div>
                                </li>
                                <li>
                                    <h5>服务</h5>
                                    <div class="low" ><?=$shop_detail['shop_service_scores']?><i></i></div>
                                </li>
                                <li>
                                    <h5>物流</h5>
                                    <div class="low" ><?=$shop_detail['shop_send_scores']?><i></i></div>
                                </li>
                            </ul>
                        </div>
                        <div class="btns"><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>" class="goto">进店逛逛</a><a href="#">收藏店铺</a></div>
                        <?php if(!empty($shop_all_base)){?>
                            <dl class="no-border">
                                <dt>公司名称：</dt>
                                <dd><?=$shop_all_base['shop_company_name']?></dd>
                            </dl>
                            <dl>
                                <dt>电　　话：</dt>
                                <dd><?=$shop_all_base['company_phone']?></dd>
                            </dl>
                            <dl>
                                <dt>所&nbsp;&nbsp;在&nbsp;&nbsp;地：</dt>
                                <dd><?=$shop_all_base['shop_company_address']?></dd>
                            </dl>
                        <?php }?>
                        <dl class="messenger">
                            <dt>联系方式：</dt>
                            <dd><span member_id="9"></span>
                                <a target="_blank" href='http://wpa.qq.com/msgrd?v=3&uin=<?=$shop_base['shop_qq']?>&site=qq&menu=yes'><img border="0" src="http://wpa.qq.com/pa?p=2:<?=$shop_base['shop_qq']?>:52&amp;r=0.22914223582483828" style=" vertical-align: middle;"></a>
                                <a target="_blank" href='http://www.taobao.com/webww/ww.php?ver=3&touid=<?=$shop_base['shop_ww']?>&siteid=cntaobao&status=2&charset=utf-8'><img border="0" src='http://amos.alicdn.com/realonline.aw?v=2&uid=<?=$shop_base['shop_ww']?>&site=cntaobao&s=2&charset=utf-8' alt="<?=_('点击这里给我发消息')?>" style=" vertical-align: middle;"></a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="div_shop_Carouselfigure1" style="width:1200px;height: 150px;overflow: hidden;">
            <?php if(!empty($shop_base['shop_banner'])){ ?>
                <img src="<?=$shop_base['shop_banner']?>" width="1200px" height="150px;"/></a>
            <?php }else{ ?>
                <img src="<?= $this->view->img ?>/shop_img.png" width="1200px" /></a>
            <?php } ?>

        </div>
    </div>
    <div id="nav" class="bbc-nav">
        <ul>
            <li class="active9"><a href="index.php?ctl=Shop&met=index&id=<?=$shop_id?>"><span>店铺首页<i></i></span></a></li>
            <li class="active9"><a href="index.php?ctl=Shop&met=activity&id=<?=$shop_id?>"><span>优惠活动<i></i></span></a></li>
            <?php if($shop_nav['items']){  foreach ($shop_nav['items'] as $key => $value) { ?>
                <li><a href="<?php if(!empty($value['url'])) echo $value['url'];else echo 'index.php?ctl=Shop&met=info&id='.$shop_id.'&nav_id='.$value['id']; ?>" <?php if($value['target']){?>target="_blank" <?php } ?>><span><?=$value['title']?><i></i></span></a></li>
            <?php }} ?>
        </ul>
    </div>
    <div class="clearfix">
        <div class="t_goods_bot clearfix">
            <div class="wrap clearfix">
                <div class="bbc-main-container">
                    <div class="title" style="height:90px;">
                        <h4><?=_('全部商品')?>
                            <!--一级分类-->
                            <ul>
                                <li ng-repeat="item in navCatList" ng-bind="item.shop_goods_cat_name" style="float:left;margin-left:15px;cursor:pointer;" ng-mouseover="getSecondCat(item.shop_goods_cat_id)" ng-click="getCatName(1,item.shop_goods_cat_name,item.shop_goods_cat_id)"></li>
                            </ul>
                            <!--二级分类-->
                            <ul>
                                <li ng-repeat="item in secondCat" ng-bind="item.shop_goods_cat_name" style="float:left;margin-left:15px;cursor:pointer;" ng-click="getCatName(2,item.shop_goods_cat_name,item.shop_goods_cat_id)"></li>
                            </ul>
                        </h4>
                    </div>
                    <div class="bbc-goodslist-bar">
                        <ul class="bbc-array">

                            <li class="<?php if($order == 'common_sell_time'){?> sele <?php }?>"><a class="<?php if($sort == 'desc'){ echo 'down';}else{echo 'up'; }?>"
                                                                                                    href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_sell_time&sort=<?=$new_sort ? $new_sort:'desc';?>"><?=_('新品')?></a></li>
                            <li class="<?php if($order == 'common_price'){?> sele <?php }?>"><a class="<?php if($sort == 'desc'){ echo 'down';}else{echo 'up'; }?>"
                                                                                                href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_price&sort=<?=$new_sort ? $new_sort:'desc';?>"><?=_('价格')?></a></li>
                            <li class="<?php if($order == 'common_salenum'){?> sele <?php }?>"><a class="<?php if($sort == 'desc'){ echo 'down';}else{echo 'up'; }?>"
                                                                                                  href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_salenum&sort=<?=$new_sort ? $new_sort:'desc';?>"><?=_('销量')?></a></li>
                            <li class="<?php if($order == 'common_collect'){?> sele <?php }?>"><a class="<?php if($sort == 'desc'){ echo 'down';}else{echo 'up'; }?>"
                                                                                                  href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_collect&sort=<?=$new_sort ? $new_sort:'desc';?>"><?=_('收藏')?></a></li>
                            <!--<li class=""><a
                                    href="index.php?ctl=Shop&met=goodsList&id=1&order=common_sell_time">人气</a></li>-->
                        </ul>
                        <div class="bbc-search">
                            <form id="" name="searchShop" method="get" action="index.php">
                                <input type="hidden" name="ctl" value="Shop">
                                <input type="hidden" name="met" value="goodsList">
                                <input type="hidden" name="id" value="<?=$shop_id?>">
                                <input type="text" class="buttext" name="search" value="" placeholder="<?=_('搜索店内商品')?>">
                                <a href="javascript:document.searchShop.submit();" class="ncbtn"><?=_('搜索')?></a>
                            </form>
                        </div>
                    </div>
                    <div class="content_s bbc-goods-list_2">
                        <ul>
                            <?php if(!empty($data['items'])): foreach($data['items'] as $key=>$value):?>
                                <li>
                                    <dl>
                                        <dt>
                                            <a href="index.php?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id'] ?>" class="goods-thumb" target="_blank">
                                                <img src="<?=image_thumb($value['common_image'],247,247)?>" alt="<?=$value['common_name'] ?>">
                                            </a>
                                            <ul class="goods-thumb-scroll-show clearfix">
                                                <li class="selectedSS"><a href="javascript:void(0);"><img src="<?=$value['common_image']?>"></a></li>
                                            </ul>
                                        </dt>
                                        <dd class="goods-name">
                                            <a  href="index.php?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id'] ?>" title="<?=$value['common_name'] ?>" target="_blank"><?=$value['common_name'] ?></a>
                                        </dd>
                                        <dd class="goods-info">
                                            <span class="priceSS bbc-color"><i></i>
                                                <?php if($val['common_promotion_type'] > 0 && isset($val['promotion_price'])){?>
                                                    <?=format_money($val['promotion_price'])?>
                                                <?php }else{?>
                                                    <?=format_money($val['common_shared_price'])?>
                                                <?php }?>
                                            </span>
                                            <span class="goods-sold"><?=_('已售：')?><strong><?=$value['common_salenum'] ?></strong> <?=_('件')?></span>
                                        </dd>
                                        <div class="share_div">
                                            <p class="share_wrap">
                                                <span class="share">分享立减
                                                    <u><?=format_money($value['common_share_price'])?></u>
                                                </span>
                                            </p>
                                            <?php if($value['common_is_promotion']){?>
                                                <p class="share_wrap">
                                                    <span class="share">分享立赚
                                                        <u><?=format_money($value['common_promotion_price'])?></u>
                                                    </span>
                                                </p>
                                            <?php }?>
                                            <p class="clear"></p>
                                        </div>
                                    </dl>
                                </li>
                            <?php endforeach; endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page">
            <div colspan="5"><?=($page_nav)?></div>
        </div>
    </div>
</div>

<div class="bbuilder_code">
    <span class="bbc_codeArea"><img src="<?=YLB_Registry::get('base_url')?>/shop/api/qrcode.php?data=<?= urlencode(YLB_Registry::get('url')."?ctl=Shop&met=index&id=".$shop_base['shop_id'])?>"></span>
    <span class="bbc_arrow"></span>
    <div class="bbc_guide_con">
      <span>
          <div class="service-list1 service-list2" store_id="8" store_name="12312312发发">

            <dl>
              <dt><?=_('售前客服：')?></dt>
                <?php if(!empty($service['pre'])){?>
                    <?php foreach($service['pre'] as $key=>$val){ ?>
                        <?php if(!empty($val['number'])){?>
                            <dd><span>
                  <span c_name="<?=$val['name']?>" member_id="9"><?=$val['tool']?></span>
                  </span></dd>
                        <?php }?>
                    <?php }?>
                <?php }?>
            </dl>


            <dl>
              <dt><?=_('售后客服：')?></dt>
                <?php if(!empty($service['after'])){?>
                    <?php foreach($service['after'] as $key=>$val){ ?>
                        <?php if(!empty($val['number'])){?>
                            <dd><span>
                  <span c_name="<?=$val['name']?>" member_id="9"><?=$val['tool']?></span>
                  </span></dd>
                        <?php }?>
                    <?php }?>
                <?php }?>
            </dl>


            <dl class="workingtime">
              <dt><?=_('工作时间：')?></dt>
                <?php if($shop_base['shop_workingtime']){?>
                    <dd>
                    <p><?=($shop_base['shop_workingtime'])?></p>
                    </dd><?php }?>
            </dl>

        </div>
      </span>
    </div>
</div>
</div>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>

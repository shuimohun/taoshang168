<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
if($shop_base['shop_type'] == 2)
{
    include $this->view->getTplPath() . '/' .'supplier_header.php';
}
else
{
    include $this->view->getTplPath() . '/' .'header.php';
}
?>
<style>
	.define_detail{text-align:left;padding:15px;}
    [ng-cloak]{display:none;}
</style>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/personalstores.css">
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/Group-integral.css" />
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/base.css">
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/activity.css">

<link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
<script src="<?=$this->view->js_com?>/plugins/jquery.slideBox.min.js" type="text/javascript"></script>
<script src="<?= $this->view->js ?>/angular.js"></script>

<style>
    .wrap{width: 100% !important; margin: 0 auto;}
    .bbc-nav ul{width: 1200px !important;margin: 0 auto;}
    .head_cont{ width: 1200px !important;margin: 0 auto;}
    .ncsl-nav-banner{overflow: hidden;}
    .store-decoration-block-1{width: 100% !important; overflow: hidden; text-align: center;}
    .t_goods_bot{width: 1200px;margin: 0 auto;}
</style>

<div ng-app="app" ng-controller="shopActivityCtl" ng-cloak>
    <div style="width:1200px;position: relative;margin: 0 auto;">
        <div class="bbc-store-info">
            <div class="basic">
                <div class="displayed">
                    <a href=""><?=$shop_base['shop_name']?></a>
                    <span class="all-rate">
                        <div class="rating">
                            <span style="width: <?=$shop_scores_percentage?>%"></span>
                        </div>
                        <em><?=$shop_scores_count?></em><em>分</em>
                    </span>
                </div>
                <div class="sub">
                    <div class="store-logo">
                        <img src="<?=$shop_base['shop_logo']?>" alt="<?=$shop_base['shop_name']?>" title="<?=$shop_base['shop_name']?>">
                    </div>
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
                                        <div class="low" ><?=$shop_base['shop_desc_scores']?><i></i></div>
                                    </li>
                                    <li>
                                        <h5>服务</h5>
                                        <div class="low" ><?=$shop_base['shop_service_scores']?><i></i></div>
                                    </li>
                                    <li>
                                        <h5>物流</h5>
                                        <div class="low" ><?=$shop_base['shop_send_scores']?><i></i></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="btns">
                                <a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>" class="goto">进店逛逛</a>
                                <a href="javascript:;" onclick="collectShop(<?=$shop_id?>)">收藏店铺</a>
                            </div>
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
                                <dd><span member_id="9"></span><a href="javascript:;" class="chat-enter" style="margin: 0" rel="<?=$shop_base['user_id']?>"><img src="<?=$this->view->img?>/icon-im.gif" alt=""></a>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="wrap clearfix" >
        <div class="clearfix">
            <div class="div_shop_Carouselfigure1" style="overflow: hidden;">
                <?php if(!empty($shop_base['shop_banner'])){ ?>
                <img src="<?=$shop_base['shop_banner']?>" "/></a>
            <?php }else{ ?>
                <img src="<?= $this->view->img ?>/shop_img.png" /></a>
            <?php } ?>
            </div>
        </div>
        <div id="nav" class="bbc-nav">
            <ul>
                <li class="active9"><a href="index.php?ctl=Shop&met=index&id=<?=$shop_id?>"><span>店铺首页<i></i></span></a></li>
                <?php if($shop_nav['items']){ foreach ($shop_nav['items'] as $key => $value) {?>
                    <li><a href="<?php if(!empty($value['url'])) echo $value['url'];else echo 'index.php?ctl=Shop&met=info&id='.$shop_id.'&nav_id='.$value['id']; ?>" <?php if($value['target']){?>target="_blank" <?php } ?>><span><?=$value['title']?><i></i></span></a></li>
                <?php }} ?>
            </ul>
        </div>
        <div class="clearfix">
            <!-- 店铺代金券  start -->
            <div class="shop-vouchers-wrap w-1200 mt-40" ng-show="voucherListShow">
                <div class="activity-thematic-title-wrap">
                    <div class="big-title-wrap">
                        <h2>店铺代金券</h2>
                    </div>
                    <div class="small-title-wrap">
                        <div class="small-title">
                            <span class="small-title-left">海量新品</span>
                            <i class="small-title-middle-icon icon"></i>
                            <span class="small-title-left">抢先体验</span>
                        </div>
                    </div>
                </div>
                <div class="ncp-voucher-list orflow">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                             <div class="swiper-slide" ng-repeat="item in voucherList" on-finish-render-filters >
                                <div class="lf ncp-voucher-item">
                                    <div class="ncp-voucher goStore">
                                        <i class="icon cut"></i>
                                         <div class="pic">
                                            <img ng-src="{{item.voucher_t_customimg}}">
                                        </div>
                                        <div class="info">
                                            <a href="#" class="store" ng-bind="item.shop_name"></a>
                                            <p class="store-classify" ng-bind="item.voucher_t_cat_name"></p>
                                            <dl class="value mt-11">
                                                <dt><em class="bbc_color" ng-bind="item.voucher_t_price | currency:'￥'"></em></dt>
                                                <dd class="full-reduce" ng-bind="item.voucher_t_title"></dd>
                                            </dl>


                                            <div class="point">
                                                <p class="required" style="font-size: 14px;" ng-if="item.voucher_t_access_method==1">
                                                    需 <em ng-bind="item.voucher_t_points"  ></em> 金蛋
                                                </p>
                                                <p class="required" style="font-size: 14px;" ng-if="item.voucher_t_access_method!=1">
                                                    <em>免费领取</em>
                                                </p>
                                                <p>
                                                    <em class="giveout" ng-bind="item.voucher_t_giveout"></em> 人领取
                                                </p>
                                            </div>

<!--                                            <div class="info-middle mt-11">-->
<!--                                                <span class="free-change" >免费兑换</span>-->
<!--                                                <span class="change-num" ng-bind="item.voucher_t_giveout"></span>人兑换-->
<!--                                            </div>-->
                                            <div class="time-wrap mt-11">
                                                <span class="effect-date">有效期</span>
                                                <span class="time" ng-bind="item.voucher_t_end_date_day"></span>
                                            </div>
                                            <div class="btn-right">
                                                <a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=goodsList&id=<?=$shop_id?>" ng-click="receiveVoucher(item.id)"  ng-if="item.is_vouver==1">立即使用</a>
                                                <a href="javascript:void(0);" ng-click="receiveVoucher(item.id)"  ng-if="item.voucher_t_access_method==1&&item.is_vouver!=1">立即兑换</a>
                                                <a href="javascript:void(0);" ng-click="receiveVoucher(item.id)"  ng-if="item.voucher_t_access_method!=1&&item.is_vouver!=1">免费领取</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
            <!-- 店铺代金券  end -->

            <!-- 店内优惠活动  start -->
            <div class="shop-activity-wrap w-1200 mt-40">
                <div class="activity-thematic-title-wrap">
                    <div class="big-title-wrap">
                        <h2>店内优惠活动</h2>
                    </div>
                    <div class="small-title-wrap">
                        <div class="small-title">
                            <span class="small-title-left">海量新品</span>
                            <i class="small-title-middle-icon icon"></i>
                            <span class="small-title-left">抢先体验</span>
                        </div>
                    </div>
                </div>
                <!-- 新人专享 start -->
                <div class="new-pepole-part" ng-show="newbuyerListShow">
                    <div class="part-title-wrap" >
                        新人专享
                 <span class="part-more">
                     <a href="#" ng-click="pageTo('actDetail','newBuyer')">更多>></a>
                 </span>
                    </div>
                    <div class="new-pepole-content" >
                        <ul class="orflow li-5-list" >

                            <li class="lf li-5-item" ng-repeat="item in newBuyerList" >
                                <div class="item-top">
                                    <div class="img-center">

                                      <img ng-src="{{item.goods_image}}" ng-click="goodsInfo(item.common_id,'cid')" style="cursor:pointer" alt="">

                                    </div>
                                </div>
                                <div class="item-bottom">
                                    <div class="goods-detail text2">
                                        <a href="javascript:;" ng-click="goodsInfo(item.common_id,'cid')" ng-bind="item.goods_name"></a>
                                    </div>
                                    <div class="share-wrap clearfix">
                                        <div class="share lf">
                                            <span>分享立减</span>
                                            <span class="save" ng-bind="item.goods_share_price | currency:'￥'"></span>
                                        </div>
                                        <div class="share rt">
                                            <span>立赚</span>
                                            <span class="save" ng-bind="item.goods_promotion_price | currency:'￥'"></span>
                                        </div>
                                    </div>
                                    <div class="price-wrap">
                                        <span class="new-price">￥<em ng-bind="item.shared_price"></em></span>
<!--                                        <span class="old-price">￥119000.00</span>-->
                                    </div>
                                    <div class="say-good-wrap orflow">
                                        <div class="say-good lf">
                                            <i class="icon like1_{{item.goods_id}}" onclick="likes(this)"  data-cflag="{{item.pl_status}}" data-goods_id="{{item.goods_id}}"  ng-if="item.pl_status == 1" style="background-image: url(<?=$this->view->img?>/goods/book_n.png) "></i>
                                            <i class="icon like1_{{item.goods_id}}" onclick="likes(this)"  data-cflag="{{item.pl_status}}" data-goods_id="{{item.goods_id}}"  ng-if="item.pl_status != 1" style="background-image: url(<?=$this->view->img?>/goods/book_s.png) "></i>
                                            {{item.common_collect}}
                                        </div>
                                        <div class="rt monthly-sales-wrap">
                                            销量 <span class="monthly-sales" ng-bind="item.goods_salenum"></span>
                                        </div>
                                    </div>
                                </div>
                            </li>


                        </ul>
                    </div>

                </div>
                <!-- 新人专享 end -->

                <!-- 惠抢购  start -->
                <div class="sale-buy-part" ng-show="scareListShow">
                    <div class="part-title-wrap">
                        惠抢购
                 <span class="part-more">
                     <a href="#" ng-click="pageTo('actDetail','scare')">更多>></a>
                 </span>
                    </div>
                    <div class="sale-buy-content">
                        <ul class="sale-buy-list orflow">

                            <li class="sale-buy-item lf" ng-repeat="item in scareList">
                                <div class="time-wrap">
                                    <div class="time">
                                        <div class="time-title lf">距离结束</div>
                                        <div class="fnTimeCountDown lf  " data-end="{{item.scarebuy_endtime}}" on-finish-render-filters>
                                            <span class="hour">00</span><strong>:</strong>
                                            <span class="mini">00</span><strong>:</strong>
                                            <span class="sec">00</span>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="time-bottom orflow">
                                    <div class="img-center lf">
                                        <a href="javascript:void(0);">
                                            <img ng-src="{{item.goods_image}}" ng-click="goodsInfo(item.goods_id,'gid')" alt="">
                                        </a>
                                    </div>
                                    <div class="img-else lf">
                                        <div class="goods-detail text2">
                                            <a href="javascript:void(0);" ng-bind="item.goods_name" ng-click="goodsInfo(item.goods_id,'gid')"></a>
                                        </div>
                                        <div class="price-wrap">
                                            <span class="new-price">￥<em ng-bind="item.scare_buy"></em></span>
                                            <span class="old-price" ng-bind="item.goods_price | currency:'￥'"></span>
                                        </div>
                                        <div class="share-wrap clearfix">
                                            <div class="share lf down">             <!--down  直降-->
                                                <span class="icon"></span>
                                                <span class="save" >直降 ￥{{item.reduce}}</span>
                                            </div>
                                        </div>
                                        <div class="share-wrap clearfix">
                                            <div class="share lf share-province">             <!--share-province  分享立省-->
                                                <span class="icon"></span>
                                                <span class="save">分享立省{{item.goods_share_price}}</span>
                                            </div>
                                        </div>
                                        <div class="share-wrap clearfix">
                                            <div class="share lf to-earn">             <!--to-earn  再赚-->
                                                <span class="icon"></span>
                                                <span class="save">再赚{{item.goods_promotion_price}}</span>
                                            </div>
                                        </div>
                                        <div class="qiang">
                                            <div class="qiang-left">
                                                <i ng-bind="item.sale_rate"></i>
                                                <i class="yq">已抢{{item.scarebuy_buyer_count}}件</i>
                                                <div class="progress">
                                                    <img src="<?=$this->view->img?>/rectangle@3x.png" alt="" width="{{item.sale_rate}}">
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" ng-click="goodsInfo(item.goods_id,'gid')">
                                                <div class="qiang-right">立即抢购</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>

<!--                        <div class="not-start-pop">-->
<!--                            <div class="tip">-->
<!--                                <div class="when-start">即将开始</div>-->
<!--                                <div class="start-time-quantum">-->
<!--                                    <p class="time-wrap">-->
<!--                                        <span class="start-day">2017-03-26</span>-->
<!--                                <span class="start-time">-->
<!--                                    <!-- <i class="hour">00</i>:<i class="minute">00</i>:<i class="second">00</i> -->
<!--                                    <i>00:00:00</i>-->
<!--                                </span>-->
<!--                                    </p>~<p class="time-wrap">-->
<!--                                        <span class="start-day">2017-06-26</span>-->
<!--                                <span class="start-time">-->
<!--                                    <!-- <i class="hour">23</i>:<i class="minute">59</i>:<i class="second">59</i> -->
<!--                                    <i>23:59:59</i>-->
<!--                                </span>-->
<!--                                    </p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="end-of-time">-->
<!--                            距离活动结束-->
<!--                            <p class="over-time">-->
<!--                                <span class="day">3</span>天<span class="hour">6</span>小时<span class="minute">23</span>分<span class="second">15</span>秒-->
<!--                            </p>-->
<!--                        </div>-->


                    </div>
                </div>
                <!-- 慧抢购  end -->

                <!-- 劲爆折扣  start -->
                <div class="discount-part" ng-show="discountListShow">
                    <div class="part-title-wrap">
                        劲爆折扣
                 <span class="part-more">
                     <a href="#" ng-click="pageTo('actDetail','discount')">更多>></a>
                 </span>
                    </div>
                    <div class="discount-content">
                        <ul class="discount-list orflow">
                            <li class="discount-item lf" ng-repeat="item in discountList">
                                <div class="img-center lf">
                                    <a href="javascript:void(0);">
                                        <img ng-src="{{item.goods_image}}" ng-click="goodsInfo(item.goods_id,'gid')" alt="">
                                    </a>
                                </div>
                                <div class="img-else lf">
                                    <div class="goods-detail text1">
                                        <a href="javascript:void(0);" ng-bind="item.goods_name" ng-click="goodsInfo(item.goods_id,'gid')"></a>
                                    </div>
                                    <div class="share-wrap clearfix">
                                        <div class="share lf">
                                            <span>分享立减</span>
                                            <span class="save" ng-bind="item.goods_share_price"></span>
                                        </div>
                                        <div class="share lf">
                                            <span>立赚</span>
                                            <span class="save" ng-bind="item.goods_promotion_price"></span>
                                        </div>
                                    </div>
<!--                                    <div class="sales-promotion-wrap">-->
<!--                                        促销: <span class="sales-key">0.0折</span>-->
<!--                                    </div>-->
                                    <div class="price-wrap">
                                        原价:<span class="new-price" ng-bind="item.goods_price"></span>
                                        <span class="discount-price">折扣价:<i ng-bind="item.dis_price"></i></span>
                                    </div>
                                    <div class="progress">
                                        <img src="<?=$this->view->img?>/rectangle@3x.png" alt="" width="{{item.sales_persent}}" >
                                    </div>
                                    <div class="sheng">
                                        仅剩<span>{{item.goods_salenum}}/{{item.goods_stock}}</span>件
                                    </div>
                                    <div class="i-like">
                                        <i class="icon lf like1_{{item.goods_id}}" onclick="Discount_likes(this)"  data-cflag="{{item.pl_status}}" data-goods_id="{{item.goods_id}}"  ng-if="item.pl_status == 1" style="background-image: url(<?=$this->view->img?>/book_s.png) "></i>
                                        <i class="icon lf like1_{{item.goods_id}}" onclick="Discount_likes(this)"  data-cflag="{{item.pl_status}}" data-goods_id="{{item.goods_id}}"  ng-if="item.pl_status != 1" style="background-image: url(<?=$this->view->img?>/book_n.png) "></i>
                                        <div class="to-share rt">
                                            <a href="javascript:void(0);" ng-click="goodsInfo(item.goods_id,'gid')">
                                                立即购买
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- 劲爆折扣  end -->

                <!-- 满减送 start -->
                <div class="full-delivery-part" ng-show="mansongListShow">
                    <div class="part-title-wrap">
                        满减送商品
                 <span class="part-more">
                     <a href="#" ng-click="pageTo('actDetail','mansong')">更多>></a>
                 </span>
                    </div>
                    <div class="full-delivery-content">
                        <ul class="orflow li-5-list">

                            <li class="lf li-5-item" ng-repeat="item in mansongList['rule']">
                                <div class="item-top">
                                    <div class="img-center">
                                        <a href="javascript:void(0);" ng-if="item.goods_image!= null">
                                            <img ng-src="{{item.goods_image}}" ng-click="goodsInfo(item.goods_id,'gid')" alt="">
                                        </a>
                                        <a href="javascript:void(0);" ng-if="item.goods_image== null">
                                            <img src="<?=$this->view->img?>/mansong.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="item-bottom">
                                    <div class="goods-detail text2">
                                        <a href="javascript:void(0);" ng-bind="item.goods_name" ng-click="goodsInfo(item.goods_id,'gid')"></a>
                                    </div>

<!--                                    <div class="sales-promotion-wrap">
                                        促销: <span class="sales-key">满</span>
                                    </div>-->
                                    <div class="share-wrap clearfix">
                                        <div class="share lf"  ng-if="item.goods_image!= null">
                                            <span>分享立减</span>
                                            <span class="save" ng-bind="item.goods_share_price | currency:'￥'"></span>
                                        </div>
                                        <div class="share rt"  ng-if="item.goods_image!= null">
                                            <span>立赚</span>
                                            <span class="save" ng-bind="item.goods_promotion_price | currency:'￥'"></span>
                                        </div>
                                    </div>
                                    <div class="price-wrap" ng-if="item.goods_image!= null">
                                        <span class="old-price"  ng-bind="item.goods_market_price | currency:'￥'"></span>
                                        <span class="new-price">￥<em ng-bind="item.goods_price"></em></span>
                                    </div>
                                    <div class="price-wrap" ng-if="item.goods_image== null">
                                        <span class="old-price"></span>
                                        <span class="new-price"> ￥<em ng-bind="item.goods_price"></em></span>
                                    </div>
                                    <div class="say-good-wrap orflow">
                                        <div class="say-good lf">
                                            <i class="icon like1_{{item.goods_id}}" onclick="likes(this)"  data-cflag="{{item.pl_status}}" data-goods_id="{{item.goods_id}}"  ng-if="item.pl_status == 1" style="background-image: url(<?=$this->view->img?>/goods/book_n.png) "></i>
                                            <i class="icon like1_{{item.goods_id}}" onclick="likes(this)"  data-cflag="{{item.pl_status}}" data-goods_id="{{item.goods_id}}"  ng-if="item.pl_status != 1" style="background-image: url(<?=$this->view->img?>/goods/book_s.png) "></i>
                                            {{item.goods_collect}}
                                        </div>
                                        <div class="rt monthly-sales-wrap">
                                            销量<span class="monthly-sales" ng-bind="item.goods_salenum"></span>
                                        </div>
                                    </div>
                                    <div ng-if="item.goods_id!=0">
                                        <p >单笔订单满￥{{item.rule_price}}，立减现金￥{{item.rule_discount}} ，送此礼品</p>
                                    </div>
                                    <div ng-if="item.goods_id==0">
                                        <p >单笔订单满￥{{item.rule_price}}，立减现金￥{{item.rule_discount}} </p>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- 满减送 end -->

                <!-- 优惠套餐  start -->
                <div class="package-part" ng-show="bundlingListShow">
                    <div class="part-title-wrap">
                        优惠套餐
                 <span class="part-more">
                     <a href="#" ng-click="pageTo('actDetail','bundling')">更多>></a>
                 </span>
                    </div>

                    <!-- 循环此处 -->
                    <div class="package-content orflow" ng-repeat="item in bundlingList">
                        <ul class="package-list lf">

                            <li class="package-item lf" ng-repeat="item_a in item.bundling_good">
                                <div class="item-top">
                                    <div class="img-center">
                                        <a href="javascript:void(0);">
                                            <img ng-src="{{item_a.goods_image}}" ng-click="goodsInfo(item_a.goods_id,'gid')" alt="">
                                        </a>
                                        <div class="top-ranking orflow flag1">  <!--通过 flag1  flag2 flag3变换颜色 ， 默认为灰色-->
<!--                                            <span class="stone lf"></span>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="item-bottom">
                                    <div class="goods-detail text2">
                                        <a href="javascript:void(0)" ng-bind="item_a.goods_name" ng-click="goodsInfo(item_a.goods_id,'gid')"></a>
                                    </div>
<!--                                    <div class="favourable-icons-wrap orflow">-->
<!--                                        <i class="icon reduce-icon lf"></i>-->
<!--                                        <i class="icon time-icon lf"></i>-->
<!--                                    </div>-->
                                    <div class="share-wrap clearfix">
                                        <div class="share orflow">
                                            <span>分享立减</span>
                                            <span class="save" ng-bind="item_a.goods_base.goods_share_price | currency:'￥'"></span>
                                        </div>
                                    </div>
                                    <div class="share-wrap clearfix">
                                        <div class="share orflow">
                                            <span>立赚</span>
                                            <span class="save" ng-bind="item_a.goods_base.goods_promotion_price | currency:'￥'"></span>
                                        </div>
                                    </div>
                                    <div class="price-wrap">
                                        <span class="new-price" ng-bind="item_a.bundling_goods_price | currency:'￥'"></span>
                                        <span class="old-price" ng-bind="item_a.goods_base.goods_price | currency:'￥'"></span>
                                    </div>
                                    <div class="option-wrap orflow">
                                        <i class="icon lf like1_{{item_a.goods_id}}" onclick="bundling_like(this)"  data-cflag="{{item_a.pl_status}}" data-goods_id="{{item_a.goods_id}}"  ng-if="item_a.pl_status == 1" style="background-image: url(<?=$this->view->img?>/star-l.png) "></i>
                                        <i class="icon lf like1_{{item_a.goods_id}}" onclick="bundling_like(this)"  data-cflag="{{item_a.pl_status}}" data-goods_id="{{item_a.goods_id}}"  ng-if="item_a.pl_status != 1" style="background-image: url(<?=$this->view->img?>/star-red.png) "></i>
                                        已收藏{{item_a.goods_base.goods_collect}}人
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="package-detail rt">
                            <ul class="package-list">
                                <li class="package-item-r text1">
                                    已选套装：<span class="selected-package" ng-bind="item.bundling_name"></span>
                                </li>
                                <li class="package-item-r">
                                    套装原价：<span class="before-price" ng-bind="item.totalPrice | currency:'￥'"></span>
                                </li>
                                <li class="package-item-r">
                                    立刻节省：<span class="save-money" ng-bind="item.spare | currency:'￥'">73</span>
                                </li>
                                <li class="package-item-r">
                                    优惠价格：<span class="package-price" ng-bind="item.bundling_discount_price | currency:'￥'"></span>
                                </li>
                                <li class="package-item-r">
                                    运费：<span class="transportation">0.00</span>
                                </li>
                            </ul>
                            <div class="to-buy-button">
                                <a href="javascript:;" ng-click="addblcart(item.bundling_id)">购买套装</a>
                            </div>
                            <div class="to-buy-button" style="width:150px">
                                <a href="javascript:;" ng-click="addbundling(item.goods_id)">分享购买￥{{item.bundling_discount_price - item.goods_share_price}}</a>
                            </div>

                        </div>
                    </div>


                </div>
                <!-- 优惠套餐  end -->

                <!-- 加1购  start -->
                <div class="add-1-buy-part" ng-show="increaseListShow">
                    <div class="part-title-wrap">
                        加￥1购
                    <span class="part-more">
                     <a href="#" ng-click="pageTo('actDetail','increase')">更多>></a>
                    </span>
                    </div>
                    <div class="add-1-buy-content">

                        <div class="select-part-wrap">
                            <span ng-class="{true:'select-item curr',false:'select-item'}[increaseInfoId==item.increase_id]" ng-repeat="item in increaseList"  ng-click="getIncreaseInfoList(item.increase_id)" ng-bind="item.increase_name"></span>
                        </div>

                       <div class="selected-content orflow">
                            <ul class="orflow li-5-list">

                                <li class="lf li-5-item" ng-repeat="item in increaseInfoList.goods">
                                    <div class="item-top">
                                        <div class="img-center">
                                            <a href="javascript:;" ng-click="getIncreaseGoods(item.increase_id)">
                                                <img ng-src="{{item.goods_image}}" ng-click="goodsInfo(item.goods_id)" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-bottom">
                                        <div class="goods-detail text2">
                                            <a href="#" ng-bind="item.goods_name"></a>
                                        </div>
<!--                                        <div class="sales-promotion-wrap">-->
<!--                                            促销: <span class="sales-key">满</span>-->
<!--                                        </div>-->
                                        <div class="share-wrap clearfix">
                                            <div class="share lf">
                                                <span>分享立减</span>
                                                <span class="save" ng-bind="item.goods_share_price | currency:'￥'"></span>
                                            </div>
                                             <div class="share rt">
                                                <span>立赚</span>
                                                <span class="save" ng-bind="item.goods_promotion_price | currency:'￥'"></span>
                                            </div>
                                        </div>
                                        <div class="price-wrap">
                                            <span class="new-price">￥<em ng-bind="item.goods_price"></em></span>
                                        </div>
                                        <div class="say-good-wrap orflow">
                                            <div class="say-good lf like-l">
<!--                                             <a href="javascript:;" class="ai">-->
                                                    <i class="icon like1_{{item.goods_id}}" onclick="likes(this)"  data-cflag="{{item.pl_status}}" data-goods_id="{{item.goods_id}}"  ng-if="item.pl_status == 1" style="background-image: url(<?=$this->view->img?>/goods/book_n.png) "></i>
                                                <i class="icon like1_{{item.goods_id}}" onclick="likes(this)"  data-cflag="{{item.pl_status}}" data-goods_id="{{item.goods_id}}"  ng-if="item.pl_status != 1" style="background-image: url(<?=$this->view->img?>/goods/book_s.png) "></i>
<!--                                             </a>-->
                                                {{item.goods_collect}}
                                            </div>
                                            <div class="rt monthly-sales-wrap">
                                                销量
                                                <span class="monthly-sales" ng-bind="item.goods_salenum">45151</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                            <p class="add-1-buy-goods">加一购商品</p><br />
                           <div class="select-part-wrap">
                              <span ng-repeat="item in increaseInfoRule"  ng-click="getIncreaseInfoRuleList(item.increase_id,item.rule_id)"
                                    ng-class="{true:'select-item curr',false:'select-item'}[increaseInfoRuleId==item.rule_id]">需购买满 {{item.rule_price}} 换购以下商品</span>
                           </div>
                                <ul class="orflow li-5-list" >
                                <li class="lf li-5-item" ng-repeat="items in increaseInfoRuleList.redemption_goods">
                                    <div class="item-top">
                                        <div class="img-center">
                                            <a href="javascript:;" ng-click="getIncreaseGoods(items.increase_id)">
                                                <img ng-src="{{items.goods_image}}" ng-click="goodsInfo(items.goods_id)" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-bottom">
                                        <div class="goods-detail text2">
                                            <a href="#" ng-bind="items.goods_name"></a>
                                        </div>
                                        <div class="price-wrap">
                                            原价：<span class="old-price" ng-bind="items.goods_price | currency:'￥'"></span>
                                            <br>
                                            换购价：<span class="new-price">￥<em ng-bind="items.redemp_price"></em></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                       </div>

                    </div>
                </div>
                <!-- 加1购  end -->
            </div>
            <!-- 店内优惠活动  end -->

        </div>
    </div>
    <!-- 登录遮罩层 -->
    <div id="login_content" style="display:none;">
        <div>
            <div class="login-form">
                <div class="login-tab login-tab-r">
                    <a href="javascript:void(0)" class="checked">
                        账户登录
                    </a>
                </div>
                <div class="login-box" style="visibility: visible;">
                    <div class="mt tab-h">
                    </div>
                    <div class="msg-wrap" style="display:none;">
                        <div class="msg-error"></div>
                    </div>
                    <div class="mc">
                        <div class="form">
                            <form id="formlogin" method="post" onsubmit="return false;">

                                <div class="item item-fore1">
                                    <label for="loginname" class="login-label name-label"></label>
                                    <input id="loginname" class="lo_user_account" type="text" class="itxt" name="loginname" tabindex="1" autocomplete="off" placeholder="邮箱/用户名/已验证手机">
                                    <span class="clear-btn"></span>
                                </div>
                                <div id="entry" class="item item-fore2" style="visibility: visible;">
                                    <label class="login-label pwd-label" for="nloginpwd"></label>
                                    <input type="password" class="lo_user_password" id="nloginpwd" name="nloginpwd" class="itxt itxt-error" tabindex="2" autocomplete="off" placeholder="密码">
                                    <span class="clear-btn"></span>
                                    <span class="capslock" style="display: none;"><b></b>大小写锁定已打开</span>
                                </div>
                                <div class="item item-fore5">
                                    <div class="login-btn">
                                        <a href="javascript:;" onclick="loginSubmit()" class="btn-img btn-entry" id="loginSubmit" tabindex="6">登&nbsp;&nbsp;&nbsp;&nbsp;录</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="coagent" style="display: block; visibility: visible;">

                    <ul>
                        <li><a href="<?=YLB_Registry::get('ucenter_api_url')?>?ctl=Login&act=reset">忘记密码</a></li>
                        <li class="extra-r">
                            <div>
                                <div class="regist-link pa"><a href="<?=YLB_Registry::get('url')?>?ctl=Login&met=reg" target="_blank"><b></b>立即注册</a></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <a class="btn-close">×</a>
            </div>
        </div>
        <span class="mask"></span>
    </div>
</div>

<script>

    // 点击  劲爆折扣  我喜欢 高亮
    $(".discount-part .i-like .icon").click(function() {
        $(".discount-part .i-like .icon.curr").removeClass("curr");
        $(this).addClass("curr");
    });

    //  加一购  内容显示 or 隐藏
    $(".selected-content").eq(0).show();

    $(".select-item").click(function() {
        $(this).addClass("curr").siblings(".curr").removeClass("curr");
        var index = $(this).index();
        $(".selected-content").hide();
        $(".selected-content").eq(index).show();
    })

    function likes(my) {
        if ($.cookie('key')) {
            var goods_id = $(my).attr('data-goods_id');
            var cflag = $(my).attr('data-cflag');
            if (goods_id != 0) {
                if (cflag == 1) {
                    $.post(SITE_URL + '?ctl=Goods_Goods&met=canleCollectGoods&typ=json', {
                        goods_id: goods_id
                    }, function(data) {
                        if (data.status == 200) {
                            Public.tips.success('取消收藏成功!');
                            $(".icon.like1_" + goods_id).css('background-image', "url('<?=$this->view->img?>/goods/book_s.png')");
                            $(".icon.like1_" + goods_id).attr('data-cflag', 0);
                        } else {
                            Public.tips.error(data.data.msg);
                        }
                    });
                } else {
                    $.post(SITE_URL + '?ctl=Goods_Goods&met=collectGoods&typ=json', {
                        goods_id: goods_id
                    }, function(data) {
                        if (data.status == 200) {
                            Public.tips.success('收藏成功!');
                            $(".like1_" + goods_id).css('background-image', "url('<?=$this->view->img?>/goods/book_n.png')");
                            //                            $("#coll_"+goods_id).attr('src','<?//=$this->view->img?>///goods/book_n.png');
                            $(".like1_" + goods_id).attr('data-cflag', 1);
                        } else {
                            Public.tips.error(data.data.msg);
                        }
                    });
                }
            }
        } else {
            $("#login_content").show();
        }
    }

    function bundling_like(my) {
        if ($.cookie('key')) {
            var goods_id = $(my).attr('data-goods_id');
            var cflag = $(my).attr('data-cflag');
            if (cflag == 1) {
                $.post(SITE_URL + '?ctl=Goods_Goods&met=canleCollectGoods&typ=json', {
                    goods_id: goods_id
                }, function(data) {
                    if (data.status == 200) {
                        Public.tips.success('取消收藏成功!');
                        $(".icon.like1_" + goods_id).css('background-image', "url('<?=$this->view->img?>/star-red.png')");
                        $(".icon.like1_" + goods_id).attr('data-cflag', 0);
                    } else {
                        Public.tips.error(data.data.msg);
                    }
                });
            } else {
                $.post(SITE_URL + '?ctl=Goods_Goods&met=collectGoods&typ=json', {
                    goods_id: goods_id
                }, function(data) {
                    if (data.status == 200) {
                        Public.tips.success('收藏成功!');
                        $(".like1_" + goods_id).css('background-image', "url('<?=$this->view->img?>/star-l.png')");
                        //                            $("#coll_"+goods_id).attr('src','<?//=$this->view->img?>///goods/book_n.png');
                        $(".like1_" + goods_id).attr('data-cflag', 1);
                    } else {
                        Public.tips.error(data.data.msg);
                    }
                });
            }
        } else {
            $("#login_content").show();
        }
    }

    function Discount_likes(my) {
        if ($.cookie('key')) {
            var goods_id = $(my).attr('data-goods_id');
            var cflag = $(my).attr('data-cflag');
            if (cflag == 1) {
                $.post(SITE_URL + '?ctl=Goods_Goods&met=canleCollectGoods&typ=json', {
                    goods_id: goods_id
                }, function(data) {
                    if (data.status == 200) {
                        Public.tips.success('取消收藏成功!');
                        $(".icon.like1_" + goods_id).css('background-image', "url('<?=$this->view->img?>/book_n.png')");
                        $(".icon.like1_" + goods_id).attr('data-cflag', 0);
                    } else {
                        Public.tips.error(data.data.msg);
                    }
                });
            } else {
                $.post(SITE_URL + '?ctl=Goods_Goods&met=collectGoods&typ=json', {
                    goods_id: goods_id
                }, function(data) {
                    if (data.status == 200) {
                        Public.tips.success('收藏成功!');
                        $(".like1_" + goods_id).css('background-image', "url('<?=$this->view->img?>/book_s.png')");
                        //                            $("#coll_"+goods_id).attr('src','<?//=$this->view->img?>///goods/book_n.png');
                        $(".like1_" + goods_id).attr('data-cflag', 1);
                    } else {
                        Public.tips.error(data.data.msg);
                    }
                });
            }
        } else {
            $("#login_content").show();
        }
    }

</script>

<script>

    var app = angular.module('app',[]);

    /**
     * 为动态添加的DOM元素添加此事件，当加载完成后，即可调用方法 $scope.on()
     * 此方法可以解决 jquery 未来元素 无法绑定方法(如：each()方法)的问题
     */
    app.directive('onFinishRenderFilters', function ($timeout) {
        return {
            restrict: 'A',
            link: function(scope, element, attr) {
                if (scope.$last === true) {
                    $timeout(function() {
                        scope.$emit('ngRepeatFinished');
                    });
                }
            }
        };
    });

    app.controller('shopActivityCtl', ['$scope', '$http', function($scope, $http) {
        var shop_id = Public.getQueryString('id');

        $scope.voucherListShow = 0;
        $scope.scareListShow = 0;
        $scope.increaseListShow = 0;
        $scope.bundlingListShow = 0;
        $scope.mansongListShow = 0;
        $scope.discountListShow = 0;
        $scope.newbuyerListShow = 0;

        getShopPromotion = function() {
            $http({
                method: 'GET',
                url: SITE_URL + "?ctl=Shop&met=getShopPromotion&shop_id=" + shop_id + "&typ=json&type=two"
            }).then(function successCallback(res) {
                if(res.data.data.voucher){
                    $scope.voucherList = res.data.data.voucher; //代金券
                    $scope.voucherListShow = 1;
                }
                if(res.data.data.scare){
                    $scope.scareList = res.data.data.scare; //每日疯抢 惠抢购
                    $scope.scareListShow = 1;
                }
                if(res.data.data.increase){
                    $scope.increaseList = res.data.data.increase; //加价购
                    $scope.increaseListShow = 1;
                }
                if(res.data.data.bundling){
                    $scope.bundlingList = res.data.data.bundling; //套餐
                    $scope.bundlingListShow = 1;
                }
                if(res.data.data.mansong){
                    $scope.mansongList = res.data.data.mansong; //满送
                    $scope.mansongListShow = 1;
                }
                if(res.data.data.discount){
                    $scope.discountList = res.data.data.discount; //劲爆折扣
                    $scope.discountListShow = 1;
                }
                if(res.data.data.newbuyer){
                    $scope.newBuyerList = res.data.data.newbuyer; //新人优惠
                    $scope.newbuyerListShow = 1;
                }
            }, function errorCallback(res) {
            });
        };
        getShopPromotion();

        $scope.receiveVoucher = function(vid) {
            $http({
                method: 'POST',
                url: SITE_URL + "?ctl=Voucher&met=receiveVoucher&typ=json",
                params: {
                    vid: vid
                }
            }).then(function successCallback(res) {
                if (res.data.status == 200) {
                    Public.tips.success(res.data.msg);
                } else {
                    Public.tips.error(res.data.msg);
                }
            }, function errorCallback(msg) {
                Public.tips.error(res.data.msg);
            })
        };

        $scope.pageTo = function(act, type) {
            window.location.href = SITE_URL + "?ctl=Shop&met=" + act + "&id=" + shop_id + "&type=" + type;
        };

        $scope.goodsInfo = function(id, type = 'gid') {
            if (type == 'cid') {
                window.open(SITE_URL + "?ctl=Goods_Goods&met=goods&type=goods&cid=" + id);
            }
            if (type == 'gid') {
                window.open(SITE_URL + "?ctl=Goods_Goods&met=goods&type=goods&gid=" + id);
            }

        };

        /**
         * 分类导航条的滑动，点击等效果
         * 当导航条分类数据加载成功，并且ng-repeat数据渲染完成后，调用
         */
        $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
            new Swiper('.ncp-voucher-list .swiper-container', {
                direction: 'horizontal',
                loop: false,
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                slidesPerView: 3,
                spaceBetween: 10,
                freeMode: false,
                //  若为false  则只滑动一格
            });

            var TimeCountDown = $('.fnTimeCountDown');
            TimeCountDown.fnTimeCountDown();
        });

        //套装加入购物车
        $scope.addblcart = function(bl_id) {
            if ( <?= Perm::checkUserPerm() ? 1 : 0 ?> ) {
                $.ajax({
                    url: SITE_URL + '?ctl=Buyer_Cart&met=addCart&typ=json',
                    data: {
                        bl_id: bl_id,
                        goods_num: 1
                    },
                    dataType: "json",
                    contentType: "application/json;charset=utf-8",
                    async: false,
                    success: function(a) {
                        if (a.status == 250) {
                            Public.tips.error(a.msg);
                        } else {
                            $.dialog({
                                title: "<?=_('加入购物车')?>",
                                height: 100,
                                width: 250,
                                lock: true,
                                drag: false,
                                content: 'url: ' + SITE_URL + '?ctl=Buyer_Cart&met=add&typ=e'
                            });
                        }
                    },
                    failure: function(a) {
                        Public.tips.error('<?=_('操作失败！')?>');
                    }
                });
            } else {
                login_url = UCENTER_URL + '?ctl=Login&met=index&typ=e';
                callback = SITE_URL + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(window.location.href);
                login_url = login_url + '&from=shop&callback=' + encodeURIComponent(callback);
                window.location.href = login_url;
            }
        };

        $scope.addbundling = function(goods_id) {
            window.location.href = SITE_URL + "?ctl=Goods_Goods&met=goods&type=goods&gid=" + goods_id;
        };

        getIncreaseInfoList = $scope.getIncreaseInfoList = function(increase_id = '') {
            $http({
                method: 'GET',
                url: SITE_URL + "?ctl=Shop&met=getShopPromotionAddGood&typ=json&shop_id=" + shop_id + "&increase_id=" + increase_id + "&type=five",
            }).then(function successCallback(res) {
                //                console.log(res.data.data.items);
                $scope.increaseInfoList = res.data.data.items;
                $scope.increaseInfoRule = res.data.data.items.rule;
                $scope.increaseInfoId = res.data.data.items.increase_id;
                $scope.increaseInfoRuleList = res.data.data.rule[0];
                $scope.increaseInfoRuleId = res.data.data.rule[0].rule_id;
            }, function errorCallback(msg) {
                Public.tips.error(msg.data.msg);
            })
        };
        getIncreaseInfoList();

        //加一购
        getIncreaseInfoRuleList = $scope.getIncreaseInfoRuleList = function(increase_id = '', rule_id = '') {
            $http({
                method: 'GET',
                url: SITE_URL + "?ctl=Shop&met=getShopPromotionAddGood&typ=json&shop_id=" + shop_id + "&increase_id=" + increase_id + "&rule_id=" + rule_id + "&type=five",
            }).then(function successCallback(res) {
                console.log(res.data.data.items);
                $scope.increaseInfoRuleList = res.data.data.rule[0];
                $scope.increaseInfoRuleId = res.data.data.rule[0].rule_id;
            }, function errorCallback(msg) {
                Public.tips.error(msg.data.msg);
            })
        };
        getIncreaseInfoRuleList();

    }]);



</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
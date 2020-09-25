<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>

    <link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/iconfont/iconfont.css">
    <link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/goods_top.css">
    <script type="text/javascript" src="<?= $this->view->js ?>/jquery.js"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/angular.js"></script>
    <!-- 内容 -->
    <div ng-app="app" ng-controller="goodsTopIndexCtl">
        <!--导航   start-->
        <div class="nav-wrap-basic">
            <div class="nav-wrap">
                <div class="nav-basic">
                    <div class="nav-main">
                        <ul class="nav-ul lf">
                            <?php for($i=0;$i<count($cat_data);$i++){?>
                                <li class="lf <?php if($i == 0){?>curr<?php }?>">
                                    <a href="javascript:;" data-id="<?=$cat_data[$i]['cat_id']?>" ng-click="getSubCat(<?=$cat_data[$i]['cat_id']?>,'<?=$cat_data[$i]['cat_name']?>')">
                                        <i class="icon">
                                            <img src="<?=$cat_data[$i]['cat_pic']?>!30x30.png" onerror="javascript:this.src='<?=$this->view->img?>/moren.png'"/>
                                        </i>
                                        <span class="icon-text"><?=$cat_data[$i]['cat_name']?></span>
                                    </a>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="all-kinds-wrap">
                        <div class="all-kinds rt">
                            <a href="#">
                                全部种类
                                <i class="icon"></i>
                            </a>
                        </div>
                        <div class="all-kinds-son">
                            <div class="son-header orflow">
                                <ul class="s-header orflow">
                                    <?php if($this->cat){ $i = 0;foreach ($this->cat as $key => $value) {?>
                                        <li class="s-header-li lf <?php if($i == 0){?>curr<?php }?>" >
                                            <a href="javascript:;" data-id="<?=$value['cat_nav']['goods_cat_id']?>" ><?=$value['cat_nav']['goods_cat_nav_name']?></a>
                                        </li>
                                    <?php  $i++;}}?>
                                </ul>
                            </div>
                            <div class="son-body">
                                <ul class="s-body orflow">
                                    <?php if($this->cat){ $i = 0;foreach ($this->cat as $key => $value) {?>
                                        <?php if(!empty($value['cat_nav'])){ foreach ($value['cat_nav']['goods_cat_nav_recommend_display'] as $k => $v) { ?>
                                            <li id="li_<?=$value['cat_nav']['goods_cat_id']?>" class="s-body-li lf <?php if($i!=0){?>hide<?php }?>" data-id="<?=$v['cat_id']?>">
                                                <a class="s-name" data-id="<?=$v['cat_id']?>"><?=$v['cat_name']?></a>
                                                <ul class="s-body-list orflow">
                                                    <?php if(!empty($v['sub'])){  foreach ($v['sub'] as $sub_key => $sub_value) {  ?>
                                                        <li class="s-body-item lf" >
                                                            <a href="javascript:;" data-id="<?=$sub_value['cat_id']?>" ng-click="getDataBySubcat(<?=$sub_value['cat_id']?>,'<?=$v['cat_name']?>')"><?=$sub_value['cat_name']?></a>
                                                        </li>
                                                    <?php } } ?>
                                                </ul>
                                            </li>
                                        <?php }?>
                                    <?php }$i++;}}?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nav-classify-wrap" style="height:36px;overflow: hidden">
                    <div class="nav-classify">
                        <ul class="orflow">
                            <li ng-class="{true:'lf curr',false:'lf'}[sub_cat_id==0]">
                                <a href="#">全部分类</a>
                            </li>
                            <li ng-class="{true:'lf curr',false:'lf'}[sub_cat_id==item.cat_id]" ng-repeat="item in subCatList">
                                <a href="javascript:;" ng-click="getGoodsSaleByIds(item.cat_id,1,10)" ng-bind="item.cat_name"></a>
                            </li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
        <!--导航   end-->

        <div class="bg-container">
            <!--标题  start-->
            <div class="title-index">
                <h1 ng-bind="current_cat_name" ></h1>
                <span class="ranking-secrit">
                    <i class="icon"></i>
                       <a href="#"> 排行榜秘籍</a>
                </span>
                <div class="miji-pop">
                    <h3>排行榜秘笈</h3>
                    <div class="miji-content">
                        <ul class="top-ex orflow">
                            <li class="top-ex-li lf">
                                <i class="icon"></i>
                                <div class="icon-dec">
                                    <span>热卖榜</span>
                                    <p>笑脸冠军引领购物风向标</p>
                                </div>
                            </li>
                            <li class="top-ex-li lf">
                                <i class="icon"></i>
                                <div class="icon-dec">
                                    <span>热卖榜</span>
                                    <p>笑脸冠军引领购物风向标</p>
                                </div>
                            </li>
                            <li class="top-ex-li lf">
                                <i class="icon"></i>
                                <div class="icon-dec">
                                    <span>热卖榜</span>
                                    <p>笑脸冠军引领购物风向标</p>
                                </div>
                            </li>
                            <li class="top-ex-li lf">
                                <i class="icon"></i>
                                <div class="icon-dec">
                                    <span>热卖榜</span>
                                    <p>笑脸冠军引领购物风向标</p>
                                </div>
                            </li>
                        </ul>
                        <ul class="statement">
                            <li>
                                <span>x x x 价：</span>
                                <p>上榜期间，同时间段内该商品的销售价</p>
                            </li>
                            <li>
                                <span>划&nbsp;线&nbsp;价&nbsp;:</span>
                                <p>商品展示的划横线价格为参考价，该价格可能是品牌专柜标价、商品吊牌价或由品牌供应商提供的正品零售价（如厂商指导价、建议零售价等）或该商品在京东平台上曾经展示过的销售价；由于地区、时间的差异性和市场行情波动，品牌专柜标价、商品吊牌价等可能会与您购物时展示的不一致，该价格仅供您参考</p>
                            </li>
                            <li>
                                <span>折&nbsp;扣&nbsp;:</span>
                                <p>如无特殊说明，折扣指销售商在原价、或划线价（如品牌专柜标价、商品吊牌价、厂商指导价、厂商建议零售价）等某一价格基础上计算出的优惠比例或优惠金额；如有疑问，您可在购买前联系销售商进行咨询</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--标题  end-->

            <!--主体   start-->
            <div class="main">
                <div class="hot-sell">
                    <div class="part-title">
                        <h2 class="orflow">
                            <div class="name-wrap lf">
                                <i class="icon"></i>
                                热卖榜
                            </div>
                            <div class="rt clock-calcu-wrap">
                                <i class="icon"></i>
    <!--                            <span class="clock-calcu" style="color:#444">-->
    <!--                               下次更新<span class="timeout" style="color:#444">03</span>小时<span class="timeout" style="color:#444">26</span>分钟-->
    <!--                           </span>-->
                            </div>
                        </h2>
                    </div>
                    <div class="part-tab-wrap">
                        <div class="part-tab-sub">
                            <div class="part-tab lf">
                                <span ng-mouseover="getGoodsSaleByIds(subCatIds,1,10,1)">NO.1-No.10</span>
                                <span ng-mouseover="getGoodsSaleByIds(subCatIds,2,10,11)">NO.11-No.20</span>
                                <span ng-mouseover="getGoodsSaleByIds(subCatIds,3,10,21)">NO.21-No.30</span>
                                <div class="underline"></div>
                            </div>
                            <div class="rt watch-all">
                                <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Top&met=sale&cat_id={{current_cat_id}}&cat_name={{current_cat_name}}" target="_blank">查看完整表单
                                    <i class="icon"></i>
                                </a>
                            </div>
                        </div>

                        <div class="part-tab-content">
                            <ul class="part-tab-list orflow">
                                <li class="no-3-after li-portrait shadow" ng-repeat="item in goodsSaleList">
                                    <a href="#">
                                        <div class="ratings-result">
                                            <div class="flag-left">
                                                <i ng-bind="$index+indexJump"></i>
                                            </div>
                                        </div>
                                        <div class="img-show">
                                            <img ng-src="{{item.common_image}}" ng-click="goodsInfo(item.common_id)" alt="">
                                            <div class="grating-wrap orflow">
                                                <div class="gratingRate lf" style="margin-left:15px">
                                                    好评<span ng-bind="item.common_evaluate"></span>
                                                </div>
                                                <div class="gratingNum rt" style="margin-right:15px">
                                                    收藏 <span ng-bind="item.common_collect"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="img-else">
                                            <div class="text-description">
                                                <p class="text1" ng-bind="item.common_name" ng-click="goodsInfo(item.common_id)"></p>
                                            </div>
                                            <div class="share-wrap orflow">
                                                <div class="share-sub lf">
                                                    <span class="share-text">分享立减</span>
                                                    <span class="price" ng-bind="item.common_share_price | currency:'￥'"></span>
                                                </div>
                                                <div class="share-sub rt">
                                                    <span class="share-text">立赚</span>
                                                    <span class="price" ng-bind="item.common_promotion_price | currency:'￥'"></span>
                                                </div>
                                            </div>
                                            <div class="price-wrap orflow">
                                                <div class="price lf">
                                                    ￥<span  style="color:#c51e1e" ng-bind="item.common_price"></span>
                                                </div>
                                                <div class="rt">销量：<span ng-bind="item.common_salenum"></span></div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="hot-middle orflow">
                    <div class="hot-search">
                        <div class="part-title">
                            <h2 class="orflow">
                                <div class="name-wrap lf">
                                    <i class="icon"></i>
                                    热搜榜
                                </div>
    <!--                            <div class="rt clock-calcu-wrap">
                                    <i class="icon"></i>
                                    <span class="clock-calcu" style="color:#444">
                                       下次更新<span class="timeout" style="color:#444">03</span>小时<span class="timeout" style="color:#444">26</span>分钟
                                   </span>
                                </div>-->
                            </h2>
                        </div>
                        <div class="part-tab-wrap">
                            <div class="part-tab-sub">
                                <div class="part-tab lf">
                                    <span ng-mousemove="changeShow($event)">NO.1-No.5</span>
                                    <span ng-mousemove="changeShow($event)">NO.6-No.10</span>
                                    <div class="underline"></div>
                                </div>
                                <div class="rt watch-all">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Top&met=search" target="_blank">查看完整表单
                                        <i class="icon"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="part-tab-content orflow">

                                <ul class="part-tab-list  orflow">
                                    <li class="shadow" ng-repeat="item in searchWorldList_a">
    <!--                                    <a href="#">-->
                                            <div class="search-type lf search-1">
                                                <div class="ratings-result flag-1">
                                                    <div class="flag-left">
                                                        <i>{{$index+1}}</i>
                                                    </div>
                                                </div>
                                                <div class="search-type-img-robot">
                                                    <p class="search-th text1" ng-bind="item.search_keyword"></p>
                                                </div>
                                                <p class="search-pepole text1">{{item.search_nums}}人在搜</p>
                                            </div>
                                            <ul class="img-show-wrap orflow rt">
                                                <li class="img-show-sub lf" ng-repeat="good in item.goods_list">
                                                    <div class="img-show">
                                                        <a href="javascript:;"><img ng-src="{{good.common_image}}" ng-click="goodsInfo(good.common_id,'cid')" alt=""></a>
                                                    </div>
                                                    <div class="img-else">
                                                        <div class="text-description">
                                                            <a href="javascript:;"><p class="text1" ng-bind="good.common_name" ng-click="goodsInfo(good.common_id,'cid')"></p></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
    <!--                                    </a>-->
                                    </li>
                                </ul>

                                <ul class="part-tab-list  orflow">
                                   <li class="shadow" ng-repeat="item in searchWorldList_b">
    <!--                                    <a href="#">-->
                                            <div class="search-type lf search-1">
                                                <div class="ratings-result flag-1">
                                                    <div class="flag-left">
                                                        <i>{{$index+6}}</i>
                                                    </div>
                                                </div>
                                                <div class="search-type-img-robot">
                                                    <p class="search-th text1" ng-bind="item.search_keyword"></p>
                                                </div>
                                                <p class="search-pepole text1">{{item.search_nums}}人在搜</p>
                                            </div>
                                            <ul class="img-show-wrap orflow rt">
                                                <li class="img-show-sub lf" ng-repeat="good in item.goods_list">
                                                    <div class="img-show">
                                                        <a href="javascript:;"><img ng-src="{{good.common_image}}" ng-click="goodsInfo(good.common_id,'cid')" alt=""></a>
                                                    </div>
                                                    <div class="img-else">
                                                        <div class="text-description">
                                                            <a href="javascript:;"><p class="text1" ng-bind="good.common_name" ng-click="goodsInfo(good.common_id,'cid')"></p></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
    <!--                                    </a>-->
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="hot-shop">
                        <div class="part-title">
                            <h2 class="orflow">
                                <div class="name-wrap lf">
                                    <i class="icon"></i>
                                    店铺榜
                                </div>
                                <div class="rt clock-calcu-wrap">
                                    <i class="icon"></i>
                                    <span class="clock-calcu" style="color:#444">
                                       下次更新<span class="timeout" style="color:#444">03</span>小时<span class="timeout" style="color:#444">26</span>分钟
                                   </span>
                                </div>
                            </h2>
                        </div>
                        <div class="part-tab-wrap">
                            <div class="part-tab-sub">
                                <div class="part-tab lf">
                                    <span ng-mousemove="changeShow($event)">NO.1-No.4</span>
                                    <span ng-mousemove="changeShow($event)">NO.5-No.8</span>
                                    <span ng-mousemove="changeShow($event)">NO.9-No.12</span>
                                    <div class="underline"></div>
                                </div>
                                <div class="rt watch-all">
                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Top&met=shop&cat_id={{current_cat_id}}&cat_name={{current_cat_name}}" target="_blank">查看完整表单
                                        <i class="icon"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="part-tab-content">
                                <ul class="part-tab-list orflow">
                                    <li class="shadow lf" ng-repeat="item in shopSaleGoodsList_a">
                                        <a href="#">
                                            <div class="ratings-result flag-1">
                                                <div class="flag-left">
                                                    <i>{{$index+1}}</i>
                                                </div>
                                                <div class="flag-dec">{{item.salenums}}人在逛</div>
                                            </div>
                                            <div class="top-wrap">
                                                <div class="brand">
                                                    <img ng-src="{{item.shop_logo}}" ng-click="shopPage(item.shop_id)" alt="">
                                                </div>
                                                <div class="brand-shop text1">
                                                    <a href="javascript:;" ng-click="shopPage(item.shop_id)" ng-bind="item.shop_name">
                                                        <i class="icon"></i>
                                                    </a>
                                                </div>
                                                <div class="sign" style="position: absolute;top: 47px;left: 260px;">
                                                    <span class="sign1" ng-show="{{item.shop_self_support}}">自营</span>
                                                    <span class="sign1" ng-hide="{{item.shop_self_support}}">第三方</span>
                                                </div>
                                            </div>

                                            <ul class="bottom-wrap orflow">
                                                <li class="lf li-portrait" ng-repeat="good in item.goods_list">
                                                    <a href="javascript:;" ng-click="goodsInfo(good.common_id,'cid')">
                                                        <div class="img-show">
                                                            <img ng-src="{{good.common_image}}" alt="">
                                                            <p class="price" ng-bind="good.common_price | currency:'￥'"></p>
                                                        </div>
                                                        <div class="img-else">
                                                            <div class="text-description">
                                                                <p class="text1" ng-bind="good.common_name"></p>
                                                            </div>
                                                            <div class="share-wrap orflow">
                                                                <div class="share-sub" style="display: inline-block;">
                                                                    <span class="share-text">分享立减</span>
                                                                    <span class="price" ng-bind="good.common_share_price | currency:'￥'"></span>
                                                                </div>
                                                            </div>
                                                            <div class="share-wrap orflow">
                                                                <div class="share-sub" style="display: inline-block;">
                                                                    <span class="share-text">立赚</span>
                                                                    <span class="price" ng-bind="good.common_promotion_price | currency:'￥'"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="part-tab-list orflow">
                                    <li class="shadow lf" ng-repeat="item in shopSaleGoodsList_b">
                                        <a href="#">
                                            <div class="ratings-result flag-1">
                                                <div class="flag-left">
                                                    <i>{{$index+5}}</i>
                                                </div>
                                                <div class="flag-dec">{{item.salenums}}人再逛</div>
                                            </div>
                                            <div class="top-wrap">
                                                <div class="brand">
                                                    <img ng-src="{{item.shop_logo}}" ng-click="shopPage(item.shop_id)" alt="">
                                                </div>
                                                <div class="brand-shop">
                                                    <a href="javascript:;" ng-click="shopPage(item.shop_id)" ng-bind="item.shop_name">
                                                        <i class="icon"></i>
                                                    </a>
                                                </div>
                                                <div class="sign">
                                                    <span class="sign1" ng-show="{{item.shop_self_support}}">自营</span>
                                                    <span class="sign1" ng-hide="{{item.shop_self_support}}">第三方</span>
                                                </div>
                                            </div>

                                            <ul class="bottom-wrap orflow">
                                                <li class="lf li-portrait" ng-repeat="good in item.goods_list">
                                                    <a href="javascript:;" ng-click="goodsInfo(good.common_id,'cid')">
                                                        <div class="img-show">
                                                            <img ng-src="{{good.common_image}}" alt="">
                                                            <p class="price" ng-bind="good.common_price | currency:'￥'"></p>
                                                        </div>
                                                        <div class="img-else">
                                                            <div class="text-description">
                                                                <p class="text1" ng-bind="good.common_name"></p>
                                                            </div>
                                                            <div class="share-wrap orflow">
                                                                <div class="share-sub lf">
                                                                    <span class="share-text">分享立减</span>
                                                                    <span class="price" ng-bind="good.common_share_price | currency:'￥'"></span>
                                                                </div>
                                                                <div class="share-sub rt">
                                                                    <span class="share-text">立赚</span>
                                                                    <span class="price" ng-bind="good.common_promotion_price | currency:'￥'"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="part-tab-list orflow">
                                    <li class="shadow lf" ng-repeat="item in shopSaleGoodsList_c">
                                        <a href="#">
                                            <div class="ratings-result flag-1">
                                                <div class="flag-left">
                                                    <i>{{$index+9}}</i>
                                                </div>
                                                <div class="flag-dec">{{item.salenums}}人再逛</div>
                                            </div>
                                            <div class="top-wrap">
                                                <div class="brand">
                                                    <img ng-src="{{item.shop_logo}}" ng-click="shopPage(item.shop_id)" alt="">
                                                </div>
                                                <div class="brand-shop">
                                                    <a href="javascript:;" ng-click="shopPage(item.shop_id)" ng-bind="item.shop_name">
                                                        <i class="icon"></i>
                                                    </a>
                                                </div>
                                                <div class="sign">
                                                    <span class="sign1" ng-show="{{item.shop_self_support}}">自营</span>
                                                    <span class="sign1" ng-hide="{{item.shop_self_support}}">第三方</span>
                                                </div>
                                            </div>

                                            <ul class="bottom-wrap orflow">
                                                <li class="lf li-portrait" ng-repeat="good in item.goods_list">
                                                    <a href="javascript:;" ng-click="goodsInfo(good.common_id,'cid')">
                                                        <div class="img-show">
                                                            <img ng-src="{{good.common_image}}" alt="">
                                                            <p class="price" ng-bind="good.common_price | currency:'￥'"></p>
                                                        </div>
                                                        <div class="img-else">
                                                            <div class="text-description">
                                                                <p class="text1" ng-bind="good.common_name"></p>
                                                            </div>
                                                            <div class="share-wrap orflow">
                                                                <div class="share-sub lf">
                                                                    <span class="share-text">分享立减</span>
                                                                    <span class="price" ng-bind="good.common_share_price | currency:'￥'"></span>
                                                                </div>
                                                                <div class="share-sub rt">
                                                                    <span class="share-text">立赚</span>
                                                                    <span class="price" ng-bind="good.common_promotion_price | currency:'￥'"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hot-discount">
                    <div class="part-title">
                        <h2 class="orflow">
                            <div class="name-wrap lf">
                                <i class="icon"></i>
                                折扣榜
                            </div>
                            <div class="rt clock-calcu-wrap">
                                <i class="icon"></i>
                                <span class="clock-calcu" style="color:#444">
                                   下次更新<span class="timeout" style="color:#444">03</span>小时<span class="timeout" style="color:#444">26</span>分钟
                               </span>
                            </div>
                        </h2>
                    </div>
                    <div class="part-tab-wrap">
                        <div class="part-tab-sub">
                            <div class="rt watch-all">
                                <a href="<?= YLB_Registry::get('url') ?>?ctl=DiscountBuy&met=index" target="_blank">查看完整表单
                                    <i class="icon"></i>
                                </a>
                            </div>
                        </div>
                        <div class="part-tab-content">
                            <ul class="part-tab-list orflow">
                                <li class="shadow li-infeed" ng-repeat="item in discountGoodsList">
                                    <a href="javascript:;">
                                        <div class="ratings-result flag-1">
                                            <div class="flag-left">
                                                <i ng-bind="$index+1"></i>
                                            </div>
                                        </div>
                                        <div class="img-show" ng-click="goodsInfo(item.goods_id,'gid')">
                                            <img ng-src="{{item.common_image}}" alt="">
                                        </div>
                                        <div class="img-else">
                                            <div class="text-description">
                                                <p class="text1" ng-bind="item.common_name" ng-click="goodsInfo(item.goods_id,'gid')"></p>
                                            </div>
                                            <div class="share-wrap orflow">
                                                <div class="share-sub lf">
                                                    <span class="share-text">立减</span>
                                                    <span class="price" ng-bind="item.common_share_price | currency:'￥'"></span>
                                                </div>
                                                <div class="share-sub rt">
                                                    <span class="share-text">立赚</span>
                                                    <span class="price" ng-bind="item.common_promotion_price | currency:'￥'"></span>
                                                </div>
                                            </div>
                                            <div class="discount-sale">
                                                促销: <span ng-bind="item.discount_rate"></span>折
                                            </div>
                                            <div class="price-wrap">
                                                <div class="old-price">
                                                    原价:<span ng-bind="item.goods_price | currency:'￥'"></span>
                                                </div>
                                                <div class="discount-price">
                                                    折扣价:<span ng-bind="item.discount_price | currency:'￥'"></span>
                                                </div>
                                            </div>
                                            <div class="sheng">
                                            <span></span>
                                                仅剩 <span>{{item.common_salenum}}/{{item.common_stock}}</span>件
                                            </div>
                                            <div class="to-share" ng-click="goodsInfo(item.goods_id,'gid')">
                                                抢购分享价<span ng-bind="item.common_shared_price | currency:'￥'"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--主体   end-->
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            $(window).scroll(function(){
                if($(window).scrollTop() > $(".head").outerHeight(true) + $(".wrap").outerHeight(true)){
                    $(".nav-wrap").addClass("fixed");
                    $(".nav-wrap").css({"transform":"translateZ("+0+")"});
                }else{
                    $(".nav-wrap").removeClass("fixed");
                    $(".nav-wrap").attr("style","");
                }
            });
            // 点击 导航 第一条目   start
            $(".nav-wrap .nav-basic .nav-ul li").click(function(){
                $(this).addClass("curr");
                $(this).siblings(".curr").removeClass("curr");
            });
            // 点击 导航 第一条目   end

            // 移入全部种类  且显示   移除消失   start
            $(".nav-wrap .nav-basic .all-kinds").mouseenter(function(e){
                // e.stopPropagation();
                $(this).addClass("curr");
                $(".nav-basic .all-kinds-son").addClass("blo");
            })
            $(".all-kinds-wrap").mouseleave(function(){
               $(".nav-wrap .nav-basic .all-kinds").removeClass("curr");
               $(".nav-basic .all-kinds-son").removeClass("blo");
             });
            $(".s-body-list .s-body-item").click(function(){
                $(".nav-wrap .nav-basic .all-kinds").removeClass("curr");
               $(".nav-basic .all-kinds-son").removeClass("blo");
            });
           /* $(".nav-basic .all-kinds-son").mouseenter(function(){
                $(".nav-wrap .nav-basic .all-kinds").addClass("curr");
                $(".nav-basic .all-kinds-son").addClass("blo");

            }).mouseleave(function(){
                $(".nav-wrap .nav-basic .all-kinds").removeClass("curr");
                $(".nav-basic .all-kinds-son").removeClass("blo");
            });*/
            // 移入全部种类  且显示   移除消失  end

            // 点击  全部分类 弹出狂 内的  头部  高亮  start
            $(".s-header a").click(function(){
                $(this).parent("li").addClass("curr");
                $(this).parent("li").siblings(".curr").removeClass("curr");
            });
            // 点击  全部分类 弹出狂 内的  头部  高亮  end

            // 点击  导航第二条目  高亮   start
            $(".nav-wrap .nav-classify-wrap .nav-classify li").click(function(){
                $(this).removeClass("curr-hover");
                $(this).addClass("curr");
                $(this).siblings(".curr").removeClass("curr");
            });
            $(".nav-wrap .nav-classify-wrap .nav-classify li").mouseover(function(){
                if($(this).attr("class") === "lf" ){
                    $(this).addClass("curr-hover");
                }else{
                    return false;
                }
            }).mouseout(function(){
                if($(this).hasClass("curr-hover")){
                    $(this).removeClass("curr-hover");
                }
            });
            // 点击  导航第二条目  高亮   end

            //   点击  秘籍   start
            $(".ranking-secrit").click(function(e){
                e.stopPropagation();
                $(".miji-pop").toggleClass("blo");
            });

            $(".miji-pop").click(function(e){
                e.stopPropagation();
            });
            $(document).on("click",function(e){
                // alert($(e.target));
                if($(e.target) != $(".ranking-secrit") && $(".miji-pop").hasClass("blo")){
                    // alert(2);
                    $(".miji-pop").removeClass("blo");
                }
            });
            //   点击  秘籍   end

            // 滑动 效果
            // $(".part-tab-content").children(".part-tab-list").eq(0).addClass("block");
            $(".part-tab-content").each(function(){
                $(this).children(".part-tab-list").eq(0).addClass("block");
            })
            $(".part-tab-sub .part-tab span").mouseover(function(){
                var w = $(".part-tab-sub .part-tab span").outerWidth();
                var index = $(this).index();
                $(this).siblings(".underline").animate({"left":w * index +"px"},200);
/*                $(this).parent(".part-tab").parent(".part-tab-sub").siblings(".part-tab-content").children(".block").removeClass("block");
                $(this).parent(".part-tab").parent(".part-tab-sub").siblings(".part-tab-content").children(".part-tab-list").eq(index).addClass("block");*/
            });

            // 点击红心  切换
            $(".like").click(function(){
                if(!($(this).hasClass("like-clicked"))){
                    $(this).addClass("like-clicked");
                    $(this).children("img.opt").addClass("no-block");
                }else{
                    $(this).children("img.opt").removeClass("no-block");
                    $(this).removeClass("like-clicked");
                }
            })


            $('.nav-basic .all-kinds-son .s-header li a').click(function () {
                $('.nav-basic .all-kinds-son .son-body li.s-body-li').hide();
                var id = $(this).data('id');
                $('.nav-basic .all-kinds-son .son-body #li_'+id).show();
            })
        })
    </script>

    <script>
        var app = angular.module('app',[]);
        app.controller('goodsTopIndexCtl',function($scope,$http){
            /**
            * 获取子分类
            * @param cat_id
            */

            $scope.getSubCat = function(cat_id,cat_name)
            {
                $scope.current_cat_id = cat_id;
                $scope.current_cat_name = cat_name;
                var url = "<?=YLB_Registry::get('url')?>?ctl=Goods_Top&met=getChildCat&typ=json&cat_parent_id="+$scope.current_cat_id;
                $http({
                    method:'GET',
                    url:url,
                }).then(
                    function successCallback(res){
                        $scope.subCatList = res.data.data.items;
                        $scope.subCatIds = res.data.data.subCatIds;
                        $scope.getGoodsSaleByIds($scope.subCatIds,page=1,pageSize=10);
                        getShopSaleGoods($scope.subCatIds,page = 1,pageSize = 12);
                    },function errorCallback(msg){

                    }
                );

                var w = $(".part-tab-sub .part-tab span").outerWidth();
                $('.part-tab-sub .part-tab span').siblings(".underline").animate({"left":w * 0 +"px"},200);
            };

            $scope.getDataBySubcat = function(cat_id,cat_name)
            {
                $scope.current_cat_name = cat_name;
                $scope.getGoodsSaleByIds(cat_id,page=1,pageSize=10);
                getShopSaleGoods(cat_id,page = 1,pageSize = 12);
            }

            /**
            * 根据大分类查找数据
            * @param page
            * @param pageSize
            */

            $scope.getGoodsSaleByIds = function(cat_ids,page=1,pageSize=10,indexJump = 1)
            {
                var par = new RegExp(',');
                if(par.test(cat_ids)){
                    $scope.sub_cat_id = 0;      //如果有逗号，选择的为全部分类
                }else{
                    $scope.sub_cat_id = cat_ids;    //如果没有逗号，选择的是单个子分类
                }
                $scope.subCatIds = cat_ids;
                $scope.indexJump = indexJump;
                var url = "<?=YLB_Registry::get('url')?>?ctl=Goods_Top&met=goodsSale&typ=json&cat_ids=("+cat_ids+")"+"&page="+page+"&pageSize="+pageSize;
                $http({
                    method:'GET',
                    url:url,
                }).then(
                    function successCallback(res){
                        $scope.goodsSaleList = res.data.data;
                    },
                    function errorCallback(msg){

                    }
                )

                var w = $(".part-tab-sub .part-tab span").outerWidth();
                $('.part-tab-sub .part-tab span').siblings(".underline").animate({"left":w * 0 +"px"},200);
            };

            /**
            * 获取关键词即热销商品
            */
            getSearchWrold = function()
            {
                var url = "<?=YLB_Registry::get('url')?>?ctl=Goods_Top&met=getSearchWord&typ=json";
                $http({
                    method:'GET',
                    url:url,
                }).then(
                    function successCallback(res){
                        $scope.searchWorldList_a = res.data.data.list_a;
                        $scope.searchWorldList_b = res.data.data.list_b;
                    },
                    function errorCallback(msg){

                    }
                )
            };
            getSearchWrold();

            /**
            * 获取热销店铺即商品
            */
            getShopSaleGoods = function(cat_ids,page=1,pageSize=12)
            {
                var url = "<?=YLB_Registry::get('url')?>?ctl=Goods_Top&met=getShopSaleGoods&typ=json&cat_ids=("+cat_ids+")&page="+page+"&pageSize="+pageSize;
                $http({
                    method:'GET',
                    url:url,
                }).then(
                    function successCallback(res){
                        $scope.shopSaleGoodsList_a = res.data.data.list_a;
                        $scope.shopSaleGoodsList_b = res.data.data.list_b;
                        $scope.shopSaleGoodsList_c = res.data.data.list_c;
                    },
                    function errorCallback(msg){

                    }
                )
            };

            getDiscountGoods = function()
            {
                var url = "<?=YLB_Registry::get('url')?>?ctl=Goods_Top&met=getDiscountGoods&typ=json";
                $http({
                    method:'GET',
                    url:url,
                }).then(
                    function successCallback(res){
                        $scope.discountGoodsList = res.data.data;
                        console.log(res.data.data);
                    },
                    function errorCallback(msg){

                    }
                )
            };
            getDiscountGoods();

            $scope.current_cat_name = "<?=$current_cat_name?>";
            $scope.current_cat_id = "<?=$current_cat_id?>";
            $scope.getSubCat($scope.current_cat_id,$scope.current_cat_name);

            $scope.goodsInfo = function(id,type='cid')
            {
                if(type == 'cid'){
                    window.open(SITE_URL + "?ctl=Goods_Goods&met=goods&type=goods&cid="+id);
                }
                if(type == 'gid'){
                    window.open(SITE_URL + "?ctl=Goods_Goods&met=goods&type=goods&gid="+id);
                }
            }

            $scope.shopPage = function(id)
            {
                  window.open(SITE_URL + "?ctl=Shop&met=index&typ=e&id="+id);
            }

            $scope.changeShow = function($event)
            {
                var index = $($event.target).index();
                $($event.target).parent(".part-tab").parent(".part-tab-sub").siblings(".part-tab-content").children(".block").removeClass("block");
                $($event.target).parent(".part-tab").parent(".part-tab-sub").siblings(".part-tab-content").children(".part-tab-list").eq(index).addClass("block");
            }

        })
    </script>

    </body>
    <!-- 尾部 -->
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
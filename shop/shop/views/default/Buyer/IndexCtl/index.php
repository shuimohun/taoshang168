<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>

    <style>
        .buyer_goods_savediv{height:180px}
        .share_div{position:absolute;margin-left:16px;top:165px}
        .share{width:98px;height:18px;border:1px solid #c51e1e;font-size:12px;line-height:19px;color:#c51e1e;text-align:center}
        .share_wrap{margin-top:-10px}
        .share u{text-decoration:none;background-color:#c51e1e;color:#fff}
        .clear{clear:both}

        .wodezuji_div{height:150px}
        .share_div1{position:absolute;margin-left:0;top:135px}
        .share1{width:98px;height:18px;border:1px solid #c51e1e;font-size:12px;line-height:19px;color:#c51e1e;text-align:center}
        .share_wrap1{margin-top:-10px}
        .share1 u{text-decoration:none;background-color:#c51e1e;color:#fff}
        .clear{clear:both}

        .share_div3{position:absolute;margin-left:0;top:135px}
        .share3{width:98px;height:18px;border:1px solid #c51e1e;font-size:12px;line-height:19px;color:#c51e1e;text-align:center}
        .share_wrap3{margin-top:-10px}
        .share3 u{text-decoration:none;background-color:#c51e1e;color:#fff}
        .clear{clear:both}

        .share_g{border:1px solid #c51e1e;font-size:12px;color:#c51e1e}
        .share_wrap_g{float:left;margin-left:15px}
        .share_g u{text-decoration:none;background-color:#c51e1e;color:#fff}
        .clear{clear:both}
    </style>

    <div class="aright">
        <div class="buyer_center_list" style="margin-bottom:30px;">
            <div class="my_orders">
                <p class="my_orders_tit clearfix"><span><?=_('我的订单')?></span><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical" target="_blank"><?=_('查看全部订单')?><i class ="iconfont icon-iconjiantouyou"></i></a></p>
                <?php if(!empty($order['items'])){?>
                    <table >
                        <tbody>
                            <?php foreach($order['items'] as $key=>$val){?>
                                <?php if(!empty($val['goods_list'])){?>
                                <tr>
                                    <td class="my_orders_goods"><a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$val['goods_list'][0]['goods_id']?>" target="_blank"><img src="<?php if($val['goods_list'][0]['goods_image']){?><?=image_thumb($val['goods_list'][0]['goods_image'],50,50)?><?php }else{?><?=image_thumb($this->web['goods_image'],50,50)?><?php }?>" height="50" width="50"/></a></td>
                                    <td class="place_holder"><?=$val['shop_name']?></td>
                                    <td class="orders_goods_pri"><p><?=format_money($val['order_goods_amount'])?></p><p><?=$val['payment_name']?></p></td>
                                    <td class="place_time"><p><?=$val['order_create_time']?></p></td>
                                    <td class="order_pay_status"><p class="wait_pay bbc_color"><?=$val['order_state_con']?></p><p><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&act=details&order_id=<?=($val['order_id'])?>" class="pay_order_det" target="_blank"><?=_('订单详情')?></a></p></td>
                                    <td><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&act=details&order_id=<?=($val['order_id'])?>"><?=_('查看')?></a></td>
                                </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php }else{ ?>
                    <div class="no_content_play vertical_top1" >
                        <i class="iconfont icon-dingdan"></i><span><?=_('您买的东西太少了,这里都空空的,快去挑合适的商品吧！')?></span>
                    </div>
                <?php } ?>
            </div>

            <div class="shop_cart_list">
                <p class="my_orders_tit clearfix"><span><?=_('购物车')?></span></span><a  href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Cart&met=cart" target="_blank"><?=_('查看所有商品')?><i class ="iconfont icon-iconjiantouyou"></i></a></p>
                <?php unset($cart['count']);?>
                <?php if(!empty($cart)){  ?>
                    <div class="shop_cart_list_div" >
                        <ul class="shop_cart_list_ul clearfix">
                            <?php foreach($cart as $key=>$val){?>
                                <?php foreach($val['goods'] as $k=>$v){?>
                                    <?php if($v['bl_id']){ ?>
                                        <?php foreach ($v['goods_list'] as $ke => $va){ ?>
                                            <li>
                                                <div class="clearfix">
                                                    <img src="<?php if(!empty($va['goods_base']['goods_image'])){?><?=image_thumb($va['goods_base']['goods_image'],50,50)?><?php }else{?><?= image_thumb($this->web['goods_image'],50,50)?><?php }?>" height="50" width="50"/>
                                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$va['goods_id']?>" target="_blank" style="width:61%"><?=$va['goods_base']['goods_name']?></a>
                                                    <div class="share_div_g">
                                                        <p class="share_wrap_g">
                                                            <span class="share_g">分享立减
                                                                <u><?=format_money($va['goods_share_price'])?></u>
                                                            </span>
                                                        </p>
                                                        <p class="share_wrap_g">
                                                            <span class="share_g">分享立赚
                                                                <u><?=format_money($va['goods_promotion_price'])?></u>
                                                            </span>
                                                        </p>
                                                        <p class="clear"></p>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        <p class="clearfix" >
                                            <a style="margin-top: -25px;float: right;margin-right: 12px;height: 22px;text-align: center;line-height: 22px;border-radius: 2px;padding: 0px 10px;font-size: 12px;" class ="bbc_btns" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Cart&met=confirm&product_id=<?=$v['cart_id'];?>"><?=_('去支付')?></a>
                                        </p>
                                    <?php }else{ ?>
                                        <li>
                                            <div class="clearfix">
                                                <img src="<?php if(!empty($v['goods_base']['goods_image'])){?><?=image_thumb($v['goods_base']['goods_image'],50,50)?><?php }else{?><?= image_thumb($this->web['goods_image'],50,50)?><?php }?>" height="50" width="50"/>
                                                <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$v['goods_id']?>" target="_blank" style="width:61%"><?=$v['goods_base']['goods_name']?></a>
                                                <div class="share_div_g">
                                                    <p class="share_wrap_g">
                                                        <span class="share_g">分享立减
                                                            <u><?=format_money($v['goods_base']['goods_share_price'])?></u>
                                                        </span>
                                                    </p>
                                                    <p class="share_wrap_g">
                                                        <span class="share_g">分享立赚
                                                            <u><?=format_money($v['goods_base']['goods_promotion_price'])?></u>
                                                        </span>
                                                    </p>
                                                    <p class="clear"></p>
                                                </div>
                                            </div>
                                            <p class="clearfix">
                                                <a style="margin-top:-20px" class ="bbc_btns" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Cart&met=confirm&product_id=<?=$v['cart_id'];?>"><?=_('去支付')?></a>
                                            </p>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                <?php }else{ ?>
                    <div class="no_content_play disblock vertical_top2">
                        <i class="iconfont icon-zaiqigoumai"></i><span><?=_('您的购物车还是空的哦！')?></span>
                    </div>
                <?php }?>
            </div>

            <div class="buyer_goods_save">
                <p class="my_orders_tit clearfix">
                    <span><?=_('商品收藏')?></span>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=favoritesGoods" target="_blank"><?=_('查看更多')?>
                        <i class ="iconfont icon-iconjiantouyou"></i>
                    </a>
                </p>
                <?php if(!empty($favoritesGoods['items'])){?>
                    <div class="buyer_goods_savediv" >
                        <a  class="btn_left btns iconfont icon-btnreturnarrow"data-num="0" data-numb="0"></a>
                        <div class="goods_save_div">
                            <ul class="goodsU buyer_goods_savelist clearfix">
                                <?php foreach($favoritesGoods['items'] as $key=>$val){?>
                                    <?php if(!empty($val['detail'])){?>
                                    <li>
                                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$val['detail']['goods_id']?>" target="_blank">
                                            <img src="<?php if(!empty($val['detail']['goods_image'])){?><?=image_thumb($val['detail']['goods_image'],118,118)?><?php }else{?><?= image_thumb($this->web['goods_image'],118,118)?><?php }?>" style="width:118px;height:118px;"/>
                                            <p>
                                                <?=format_money($val['detail']['goods_price'])?>
                                                <div class="share_div" style="margin-top:-20px;">
                                                    <p class="share_wrap">
                                                        <span class="share">分享立减
                                                            <u><?=format_money($val['goods_share_price'])?></u>
                                                        </span>
                                                    </p>
                                                    <p class="share_wrap">
                                                        <span class="share">分享立赚
                                                            <u><?=format_money($val['goods_promotion_price'])?></u>
                                                        </span>
                                                    </p>
                                                    <p class="clear"></p>
                                                </div>
                                            </p>
                                        </a>
                                    </li>
                                    <?php }?>
                                <?php }?>
                            </ul>
                        </div>
                        <a  class="btn_right btns iconfont icon-btnrightarrow"data-num="0" ></a>
                    </div>
                <?php }else{ ?>
                    <div class="no_content_play vertical_top1">
                        <i class="iconfont icon-shoucangshangping"></i><span><?=_('您还没有收藏任何商品,看到感兴趣的就果断收藏吧！')?></span>
                    </div>
                <?php }?>
            </div>

            <div class="buyer_exc1">
                <div class="buyer_my_track" style="height:200px;margin-bottom:5px;">
                    <p class="my_orders_tit clearfix">
                        <span><?=_('我的足迹')?></span>
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=footprint" target="_blank"><?=_('查看更多')?><i class ="iconfont icon-iconjiantouyou"></i></a>
                    </p>
                    <?php if(!empty($footprint['items'])){?>
                        <div class="buyer_my_track_div" >
                            <a  class="btn_left btns iconfont icon-btnreturnarrow"data-num="0" data-numb="0"></a>
                            <div class="my_track_div wodezuji_div">
                                <ul class="goodsU buyer_goods_savelist buyer_goods_savelistw clearfix">
                                    <?php foreach($footprint['items'] as $key=>$val){?>
                                        <?php if(!empty($val['detail'])){?>
                                        <li>
                                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$val['detail']['goods_id']?>" target="_blank">
                                                <img src="<?php if(!empty($val['detail']['common_image'])){?><?=image_thumb($val['detail']['common_image'],50,50)?><?php }else{?><?= image_thumb($this->web['goods_image'],50,50)?><?php }?>" height="50" width="50"/>
                                                <h5><?=$val['detail']['common_name']?></h5>
                                                <p><?=format_money($val['detail']['common_price'])?>
                                                    <div class="share_div1" style="margin-top:-20px;">
                                                        <p class="share_wrap1">
                                                            <span class="share1">分享立减
                                                                <u><?=format_money($val['goods_share_price'])?></u>
                                                            </span>
                                                        </p>
                                                        <p class="share_wrap1">
                                                            <span class="share1">分享立赚
                                                                <u><?=format_money($val['goods_promotion_price'])?></u>
                                                            </span>
                                                        </p>
                                                        <p class="clear"></p>
                                                    </div>
                                                </p>
                                            </a>
                                        </li>
                                        <?php }?>
                                    <?php }?>
                                </ul>
                            </div>
                            <a  class="btn_right btns iconfont icon-btnrightarrow"data-num="0" ></a>
                        </div>
                    <?php }else{ ?>
                        <div class="no_content_play disblock">
                        <i class="iconfont icon-zuji"></i><span><?=_('您的商品浏览记录为空')?></span>
                        </div>
                    <?php }?>
                </div>
            </div>


            <div class="buyer_exc2">
                <div class="buyer_store_collection">
                    <p class="my_orders_tit clearfix"><span><?=_('店铺收藏')?></span><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=favoritesShop" target="_blank"><?=_('查看更多')?><i class ="iconfont icon-iconjiantouyou"></i></a></p>
                    <?php if(!empty($shop['items'])){?>
                        <div class="buyer_my_track_div">
                            <a  class="btn_left btns iconfont icon-btnreturnarrow"data-num="0" data-numb="0"></a>
                            <div class="store_collection_div">
                                <ul class="goodsU buyer_goods_savelist ulpd clearfix">
                                    <?php foreach($shop['items'] as $key=>$val){?>
                                        <?php if(!empty($val['detail'])){?>
                                            <li>
                                                <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=$val['detail']['shop_id']?>" target="_blank">
                                                    <img src="<?php if(!empty($val['detail']['shop_logo'])){?><?=image_thumb($val['detail']['shop_logo'],50,50)?><?php }else{?><?= $this->web['shop_head_logo']?><?php }?>" height="45" width="45"/>
                                                    <h5><?=$val['detail']['shop_name']?></h5>
                                                </a>
                                            </li>
                                        <?php }?>
                                    <?php }?>
                                </ul>
                            </div>
                            <a  class="btn_right btns iconfont icon-btnrightarrow" data-num="0" ></a>
                        </div>
                    <?php }else{ ?>
                        <div class="no_content_play">
                            <i class="iconfont icon-shangjia"></i><span><?=_('您还没有收藏店铺哦！')?></span>
                        </div>
                    <?php }?>
                </div>
            </div>

            <div class="buyer_exc1" style="width:100%;margin-top:50px;margin-bottom:20px;" ng-app="app">
                <div class="buyer_my_track" ng-controller="likeCtl" style="height:190px;">
                    <p class="my_orders_tit clearfix"><span><?=_('猜你喜欢')?></span>
                        <a class="ui-btn" id="refresh_like" ng-click="loadData()"><?=_('换一组')?>
                            <i class ="iconfont icon-btn01"></i>
                        </a>
                    </p>
                    <span ng-model="likes_list"></span>
                    <div class="buyer_my_track_div" >
                        <a  class="btn_left btns iconfont icon-btnreturnarrow" data-num="0" data-numb="0"></a>
                        <div class="my_track_div" style="height:250px;">
                            <ul class="goodsU buyer_goods_savelist buyer_goods_savelistw clearfix">
                                <li ng-repeat="item in likes_list">
                                    <a href="<?= YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid={{item.common_id}}" target="_blank">
                                        <img ng-src="{{item.common_image}}" height="50" width="50"/>
                                        <h5>{{item.common_name}}</h5>
                                        <p>
                                            {{item.common_price}}
                                            <div class="share_div3" style="margin-top:-20px;">
                                                <p class="share_wrap3">
                                                    <span class="share3">分享立减
                                                        <u>{{item.common_share_price}}</u>
                                                    </span>
                                                </p>
                                                <p class="share_wrap3">
                                                    <span class="share3">分享立赚
                                                        <u>{{item.common_promotion_price}}</u>
                                                    </span>
                                                </p>
                                                <p class="clear"></p>
                                            </div>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a  class="btn_right btns iconfont icon-btnrightarrow"data-num="0" ></a>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
</div>
</div>

    <script>
        //商品滚动
        function doMove1(obj,attr,speed,target,callBack){
            if(obj.timer) return;
            var ww=obj.css(attr);
            var num = parseFloat(ww);
            speed = num > target ? -Math.abs(speed) : Math.abs(speed);
            obj.timer = setInterval(function (){
                num += speed;
                if( speed > 0 && num >= target || speed < 0 && num <= target  ){
                    num = target;
                    clearInterval(obj.timer);
                    obj.timer = null;
                    var mm=num+"px";
                    obj.css(attr,mm);
                    (typeof callBack === "function") && callBack();

                }else{
                    var mm=num+"px";
                     obj.css(attr,mm)
                }
            },30)
        }
        var m=0;

        $(".btn_left").bind("click",function(){
            var W=$(this).parent().find("div").width();
            var goodsUl=$(this).parent().find(".goodsU");
            var ali=goodsUl.find("li");
            var rightA=$(this).parent().find(".btn_right");
            m=$(this).attr("data-numb");
            if(m<=0){
                m=0;
                return;
            }
            m--;
            $(this).attr("data-numb",m);
            rightA.attr("data-num",m);
            doMove1(goodsUl,"left",30, -m*W);

        });

        $(".btn_right").bind("click",function(){
            var W=$(this).parent().find("div").width();
            var goodsUl=$(this).parent().find(".goodsU");
            var ali=goodsUl.find("li");
            var n=goodsUl.find("li").width();
            var l=goodsUl.find("li").css("padding-left");
            l = l.replace("px","");

            goodsUl.css("width",(n+l*2)*ali.length);
            var ulW=goodsUl.width();
            var nums=Math.ceil(ulW/W);
            var leftA=$(this).parent().find(".btn_left");
            m=$(this).attr("data-num");

            if(m>=(nums-1)){
                return;
            }
            m++;
            $(this).attr("data-num",m);
            leftA.attr("data-numb",m);
            doMove1(goodsUl,"left",30,-m*W);
        });

        var app = angular.module('app',[]);
        app.controller('likeCtl',function($scope,$http){
            var loadData = $scope.loadData = function(){
                $http({
                    method: 'GET',
                    url: SITE_URL+'?ctl=Buyer_Index&met=likesList&typ=json'
                }).then(function successCallback(response) {
                    $scope.likes_list = response.data.data;
                }, function errorCallback(response) {
                    // 请求失败执行代码
                });
            }
            loadData();
        })
    </script>

<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>




<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
	<link href="<?= $this->view->css ?>/login.css" rel="stylesheet">
	<link rel="stylesheet"  type="text/css" href="<?=$this->view->css ?>/store.css">
    <div class="wrap">
        <div class="QR-layout">
            <div class="sort-bar">
                <!--店铺列表-->
                <div class="search-store">
                    <ul>
                        <?php if($data){ foreach($data as $key=>$val){?>
                            <li class="store-list">
                                <div class="store-left">
                                    <div class="store-info">
                                        <div class="store-img">
                                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=($val['shop_id'])?>" target="_blank" title=""><img src="<?php if($val['shop_logo']) echo $val['shop_logo'];else echo $this->view->img.'/default_store_image.png';?>"></a>
                                        </div>
                                        <div class="store-info-o">
                                            <p>
                                                <a class="store-name m-r-5" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=($val['shop_id'])?>" target="_blank">
                                                    <?php if($val['shop_self_support'] == 'true'){ ?><span class="goods_self m-r-5">自营</span><?php } ?>
                                                    <?=$val['shop_name']?><?=$val['shop_grade']?>
                                                </a>
                                                <a href="javascript:;" data-nc-im="" data-im-seller-id="6" data-im-common-id="0"><i class="im_common offline"></i></a>
                                            </p>
                                            <?php if($val['shop_self_support'] == 'false'){ ?>
                                            <p>所在地：<span><?=@$val['shop_company_address']?></span></p>
                                            <p>店铺等级：<span class="store-major" title=""><?=$val['shop_grade']?></span></p>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="store-activity"></div>
                                    <div class="store-sever">
                                        <div class="store-volume">
                                            <span>共有<em>&nbsp;<?=@$val['goods_num']?>&nbsp;</em>件商品</span>
                                        </div>
                                        <div class="store-privilege">
                                            <em class="pf"></em>
                                            <div class="popup-shopinfo" style="display: none;">
                                                <div class="popup-shopinfo-arrow"></div>
                                                <div class="popup-wrap">
                                                    <div class="ncs-detail-rate">
                                                        <dl>
                                                          <dt>店铺评分 </dt>
                                                          <dd>商品满意度：<?=@$val['shop_detail']['shop_desc_scores']?>分</dd>
                                                          <dd>服务满意度：<?=@$val['shop_detail']['shop_service_scores']?>分</dd>
                                                          <dd>物流满意度：<?=@$val['shop_detail']['shop_send_scores']?>分</dd>
                                                        </dl>
                                                        <dl>
                                                          <dt>同类对比</dt>
                                                          <dd>
                                                                <div class="<?php if(@$val['shop_detail']['com_desc_scores'] >= 0)echo 'high';else echo 'low';?>"><span><i></i><?php if(@$val['shop_detail']['com_desc_scores'] >= 0): ?><?=_('高于')?><?php else: ?><?=_('低于')?><?php endif; ?></span> <?=number_format(abs(@$val['shop_detail']['com_desc_scores']),2,'.','')?><?=_('%')?></div>
                                                          </dd>
                                                          <dd>
                                                                <div class="<?php if(@$val['shop_detail']['com_service_scores'] >= 0)echo 'high';else echo 'low';?>"><span><i></i><?php if(@$val['shop_detail']['com_service_scores'] >= 0): ?><?=_('高于')?><?php else: ?><?=_('低于')?><?php endif; ?></span> <?=number_format(abs(@$val['shop_detail']['com_service_scores']),2,'.','')?><?=_('%')?></div>
                                                          </dd>
                                                          <dd>
                                                                <div class="<?php if(@$val['shop_detail']['com_send_scores'] >= 0)echo 'high';else echo 'low';?>"><span><i></i><?php if(@$val['shop_detail']['com_send_scores'] >= 0): ?><?=_('高于')?><?php else: ?><?=_('低于')?><?php endif; ?></span> <?=number_format(abs(@$val['shop_detail']['com_send_scores']),2,'.','')?><?=_('%')?></div>
                                                          </dd>
                                                        </dl>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="fav-store">
                                        <a href="javascript:;" nc_type="storeFavoritesBtn" onclick="collectShop(<?=($val['shop_id'])?>)"> <i class="icon fa fa-star-o"></i>收藏店铺<em class="m-l-5 shop_<?=($val['shop_id'])?>" nc_type="storeFavoritesNum"><?=@$val['shop_collect']?></em> </a>
                                    </div>
                                </div>
                                <div class="store-right">
                                    <div class="warp">
                                        <div class="store-goods-container">
                                            <ul>
                                                <?php foreach($val['goods_recommended'] as $k=>$goods){ ?>
                                                    <li class="store-goods">
                                                        <a class="goods" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=@$goods['goods_id'] ?>" title="<?=@$goods['goods_name']?>" target="_blank"><img src="<?=@$goods['goods_image']?>"></a>
                                                        <div class="goods-info">
                                                            <p class="goods-name m-t-5"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=@$goods['goods_id'] ?>" target="_blank" title="<?=@$goods['newbuyer_name']?>"><?=@$goods['newbuyer_name']?></a></p>
                                                            <!--<p class='share'>分享立省<span><?/*=format_money($goods['common_share_price'])*/?></span></p><br>
                                                            <?php /*if($goods['common_is_promotion']){*/?>
                                                                <p  class='share2'>立赚<span><?/*=format_money($goods['common_promotion_price'])*/?></span></p>
                                                            --><?php /*}*/?>
                                                            <p class="goods-price m-t-5">
                                                                <em><?=@format_money($goods['newbuyer_price'])?></em>
                                                                <!--<span>售出<em class="num-color margin2"><?/*=@$goods['common_salenum']*/?></em>件</span>-->
                                                            </p>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php }}else{ ?>
                            <div class="no_account">
                                <img src="<?= $this->view->img ?>/ico_none.png"/>
                                <p><?= _('暂无符合条件的数据记录') ?></p>
                            </div>
                        <?php } ?>
                    </ul>
                    <div class="page page_front">
                        <?=@$page_nav?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
    <script>
        $(function(){
            $(".store-privilege").hover(function(){
                $(this).find(".popup-shopinfo").show();
            },function(){
                $(this).find(".popup-shopinfo").hide();
            });
        });

        //收藏店铺
        window.collectShop = function(e){
            if ($.cookie('key')) {
                $.post(SITE_URL + '?ctl=Shop&met=addCollectShop&typ=json', {
                    shop_id: e
                }, function(data) {
                    if (data.status == 200) {
                        Public.tips.success(data.data.msg);
                        a = $('.shop_' + e).html();
                        $('.shop_' + e).html(a * 1 + 1);
                    } else {
                        Public.tips.error(data.data.msg);
                    }
                });
            } else {
                $("#login_content").show();
            }
        };
    </script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
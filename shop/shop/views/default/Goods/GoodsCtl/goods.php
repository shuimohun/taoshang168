<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/goods-detail.css"/>
<link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
<link href="<?= $this->view->css ?>/login.css" rel="stylesheet">

<style>
    div.zoomDiv{z-index:999;position:absolute;top:0px;left:0px;width:200px;height:200px;background:#ffffff;border:1px solid #CCCCCC;display:none;text-align:center;overflow:hidden;}
    div.zoomMask{position:absolute;background:url("<?=$this->view->img?>/mask.png") repeat scroll 0 0 transparent;cursor:move;z-index:1;}

    .share_cart{border:1px solid #c51e1e;font-size:12px;color:#c51e1e;float:left;margin-left: 10px;margin-top: 3px;}
    .share_car u{text-decoration: none;background-color: #c51e1e;color: #fff;}
    #hot_salle li a.selling_goods_img, #hot_collect li a.selling_goods_img{position:relative;width:100%;height:198px; text-align: center;}
    #hot_salle li a.selling_goods_img>img, #hot_collect li a.selling_goods_img>img{width:198px;height:100%;}
    #hot_salle li a.selling_goods_img>span, #hot_collect li a.selling_goods_img>span{display: none;position: absolute;bottom: 0;left:5px;height:35px;width:198px;background-color: rgba(0, 0, 0, .6);color:#fff;}
    .t_goods_bot_left .goods_ranking ul li{padding:8px 0;}
    .goods_ranking ul li p{width:100%;margin-top: 8px;font-size: 14px;}
    .goods_ranking ul li p span.rt{margin-right:18px;}
    .share_cart.rt{margin-right: 10px;float: right;}
    .fu .fnTimeCountDown span{background-color: #c51e1e;font-size: 14px;  padding: 2px;margin-right: 4px;}
</style>

<div class="bgcolor">
    <div class="wrapper">
        <div class="t_goods_detail">
            <div class="crumbs clearfix">
                <p>
                    <?php if($parent_cat){?>
                        <?php foreach($parent_cat as $catkey => $catval):?>
                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goodslist&cat_id=<?=($catval['cat_id'])?>"><?=($catval['cat_name'])?></a><?php if(!isset($catval['ext'])){ ?><i class="iconfont icon-iconjiantouyou"></i><?php }?>
                        <?php endforeach;?>
                    <?php }?>
                </p>
                <?php if($shop_owner){?>
                    <?php if($goods_status == 0){?>
                        <p style="left:73%;">
                            <a class="_letter-spacing-3" href="javascript:void(0);" onclick="upGoods(<?=($goods_detail['goods_base']['common_id'])?>)">上架</a>
                        </p>
                    <?php }?>
                    <p style="left:78%;">
                        <a class="_letter-spacing-3" href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Goods&met=online&typ=e&common_id=<?=($goods_detail['goods_base']['common_id'])?>&action=edit_goods">编辑</a>
                    </p>
                <?php }?>
            </div>
            <div class="t_goods_ev clearfix">
                <div class="ev_left">
                    <div class="ev_left_img">
                        <?php if(isset($goods_detail['goods_base']['image_row'][0]['images_image'])){
                            $goods_image = $goods_detail['goods_base']['image_row'][0]['images_image'];
                        }else
                        {
                            $goods_image  = $goods_detail['goods_base']['goods_image'];
                        }?>

                        <img  style="width:366px;height:366px;" class="jqzoom" rel="<?= image_thumb($goods_image,900,976) ?>" src="<?= image_thumb($goods_image, 366, 340) ?>"/>
                    </div>
                    <div class="retw">
                        <a><i class="iconfont icon-btnreturnarrow btn_left"></i></a>
                        <div class="gdt_ul">
                            <ul class="clearfix" id="jqzoom">
                                <?php if (isset($goods_detail['goods_base']['image_row']) && $goods_detail['goods_base']['image_row'] ) {
                                    foreach ($goods_detail['goods_base']['image_row'] as $imk => $imv) { ?>
                                        <li <?php if ($imv['images_is_default'] == 1){ ?>class="check"<?php } ?>>
                                            <img style="width:60px;height:60px" src="<?= image_thumb($imv['images_image'],60,60) ?>"/ >
                                            <input type="hidden" value="<?=image_thumb($imv['images_image'],366,340)?>" rel="<?=image_thumb($imv['images_image'],900,976)?>">
                                        </li>
                                <?php } }else{ ?>
                                    <li class="check">
                                        <img style="width:60px;height:60px"  src="<?= image_thumb($goods_image,60,60) ?>"/>
                                        <input type="hidden" value="<?=image_thumb($goods_image,366,340)?>" rel="<?=image_thumb($goods_image,900,976)?>">
                                    </li>
                                <?php }?>
                                <?php if(!empty($goods_detail['recImages'])){ foreach($goods_detail['recImages'] as $k=>$v){ ?>
                                    <li>
                                        <img  style="width:60px;height:60px" src="<?= image_thumb($v,60,60) ?>"/>
                                        <input type="hidden" value="<?=image_thumb($v,366,340)?>" rel="<?=image_thumb($v,900,976)?>">
                                    </li>
                                <?php }}?>
                            </ul>
                        </div>
                        <a><i class="iconfont icon-btnrightarrow btn_right"></i></a>
                    </div>
                    <div class="ev_left_num">
                        <span class="number_imp"><?=_('商品编号：')?>

                            <?php if ($goods_detail['goods_common']['common_code']){ ?>
                                <?= ($goods_detail['goods_common']['common_code']) ?> <?php }else{ ?>
                                <?=_("无")?>
                            <?php }?>
                        </span>
                        <span class="others_imp" >
                            <a class="share" href="javascript:void(0);" data-type="0" data-id="<?=$goods_detail['goods_base']['goods_id'] ?>" data-name="<?=$goods_detail['goods_base']['goods_name'] ?>" data-price="<?=$goods_detail['goods_base']['share_info']['share_total_price']?>" data-pic="<?=$goods_image?>" data-shared='<?= json_encode($goods_detail['goods_base']['share_info']['price']['share_base'])?>' data-sqq="<?php echo $goods_detail['goods_base']['share_info']['sqq']?>" data-qzone="<?php echo $goods_detail['goods_base']['share_info']['qzone']?>" data-weixin="<?php echo $goods_detail['goods_base']['share_info']['weixin']?>" data-weixin_timeline="<?php echo $goods_detail['goods_base']['share_info']['weixin_timeline']?>" data-tsina="<?php echo $goods_detail['goods_base']['share_info']['tsina']?>" data-share-total-price="<?php echo $goods_detail['goods_base']['share_info']['share_total_price']?>" data-is-promotion="<?php echo $goods_detail['goods_base']['share_info']['is_promotion']?>" data-promotion-total-price="<?php echo $goods_detail['goods_base']['share_info']['promotion_total_price']?>">
                                    <b class="iconfont icon-icoshare icon-1 bbc_color"></b><?=_('分享')?>
                            </a>
                        </span>
                        <span onclick="collectGoods(<?=($goods_detail['goods_base']['goods_id'])?>)">
                            <b class="iconfont icon-2 bbc_color <?php if($isFavoritesGoods){ ?> icon-taoxinshi<?php }else{?>  icon-icoheart <?php }?>"></b><?=_('收藏')?>
                        </span>
                        <span class="cprodict ">
                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Report&met=index&act=add&gid=<?=($goods_detail['goods_base']['goods_id'])?>">
                            <b class="iconfont icon-jubao icon-1 bbc_color"></b><?=_('举报')?>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="ev_center">
                    <div class="ev_head">
                        <h3><?= ($goods_detail['goods_base']['goods_name']) ?></h3>
                    </div>
                    <div class="small_title">
                        <?php if($goods_detail['goods_common']['common_is_virtual']):?>
                            <p class="bbc_color"><?=_('虚拟商品')?></p>
                        <?php endif; ?>
                        <p class="bbc_color"><?= ($goods_detail['goods_base']['goods_promotion_tips']) ?></p>
                        <?php if($goods_detail['goods_common']['common_invoices']):?>
                            <p class="bbc_color"><?=_('可开具增值税发票')?></p>
                        <?php endif;?>
                    </div>
                    <?php if($goods_detail['goods_base']['promotion']['promotion_type'] == Goods_CommonModel::HUIQIANGGOU) {?>
                        <div class="scarebuy_time_down">
                            <div class="lf hui-buy">
                                <i class="icon"></i>
                                惠抢购
                            </div>
                            <div class="rt time-end">
                                <span class="time-end-text">距活动结束</span>
                                <strong class="fnTimeCountDown" data-end="<?= ($goods_detail['goods_base']['promotion']['scarebuy_endtime']) ?>">
                                    <span class="hour">00</span><strong>:</strong>
                                    <span class="mini">00</span><strong>:</strong>
                                    <span class="sec">00</span>
                                </strong>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="obvious price">
                        <p class="clearfix">
                            <span class="mar-r _letter-spacing"><?=_('专&nbsp;柜&nbsp;价：')?></span>
                            <span class="mar-b-1"><del><?= format_money($goods_detail['goods_base']['goods_price']) ?></del></span>
                        </p>
                        <p class="clearfix">
                            <span class="mar-r _letter-spacing">
                                <?php if($goods_detail['goods_base']['fu_flag']){?>
                                    <?=_('送福免单价：')?>
                                <?php }else{ ?>
                                    <?=_('全分享价：')?>
                                <?php } ?>
                            </span>
                            <span class="mar-b-2">
                                <?php if(isset($goods_detail['goods_base']['shared_total_price']) && !empty($goods_detail['goods_base']['shared_total_price'])): ?>
                                    <strong class="color-db0a07 bbc_color"><?=format_money($goods_detail['goods_base']['shared_total_price'])?></strong>
                                <?php else: ?>
                                    <strong class="color-db0a07 bbc_color"><?=format_money($goods_detail['goods_base']['goods_price'])?></strong>
                                <?php endif; ?>
                            </span>

                            <?php if($goods_detail['goods_base']['mobile_price']){?>
                                <span class="mar-r" style="width: auto !important; margin-left: 20px;"><?=_('手机价：')?></span>
                                <span class="mar-b-1"><?= format_money($goods_detail['goods_base']['mobile_price']) ?></span>
                            <?php }?>
                        </p>
                    </div>
                    <div class="goods_style_sel promotion">
                        <div>
                            <input type="hidden" id="common_id" value="<?=($goods_detail['goods_base']['common_id'])?>" />
                            <?php if(isset($goods_detail['goods_base']['promotion']) || !empty($goods_detail['goods_base']['increase_info']) || !empty($goods_detail['mansong_info'])){?>
                                <span class="span_w lineh-1 mar_l _letter-spacing"><?=_('促&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;销：')?></span>
                                <div class="activity_reset">
                                    <div>限制：此价格不与套装优惠同时享受</div>
                                    <!--惠抢购 限时折扣 手机专享 新人优惠 S-->
                                    <?php if(isset($goods_detail['goods_base']['promotion'])){ $promotion = $goods_detail['goods_base']['promotion']; ?>
                                        <?php if($promotion['title']){ ?>
                                            <span class="bbc_color"><i class="iconfont icon-huanyipi"></i><?=($promotion['title'])?></span>
                                        <?php } ?>
                                        <i class="group_purchase" class="bbc_color"><?=$promotion['promotion_type_con']?></i>
                                        <?php if($promotion['down_price']){ ?>
                                            <strong><?=_('直降')?></strong>￥<?=($promotion['down_price'])?>
                                        <?php }?>
                                        <?php if($promotion['lower_limit']){ ?>
                                            <?php echo sprintf('最低%s件起售 ',$promotion['lower_limit']);?>
                                            <?php if($promotion['explain']){ ?>
                                                <?php echo $promotion['explain'];?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($promotion['upper_limit']) {?>
                                            <em class="bbc_color"><?php echo sprintf('最多限购%s件',$promotion['upper_limit']);?></em>
                                        <?php } ?>
                                        <?php if ($promotion['remark']) {?>
                                            <span class="bbc_color"><?php echo $promotion['remark'];?></span>
                                        <?php } ?>
                                    <?php } ?>
                                    <!--惠抢购 限时折扣 手机专享 新人优惠 E-->

                                    <!--S 加价购 -->
                                    <?php if($goods_detail['goods_base']['increase_info']) { ?>
                                        <div class="ncs-mansong">
                                            <i class="group_purchase "><?=_('加价购：')?></i>
                                            <span class="sale-rule">
                                            <em><?=($goods_detail['goods_base']['increase_info']['increase_name'])?></em>
                                            <?php if(!empty($goods_detail['goods_base']['increase_info']['rule'])) { ?>
                                                <?=_('购物满')?><em><?=format_money($goods_detail['goods_base']['increase_info']['rule'][0]['rule_price'])?></em><?=_('即可加价换购至多')?><?php if($goods_detail['goods_base']['increase_info']['rule'][0]['rule_goods_limit']):?><?=($goods_detail['goods_base']['increase_info']['rule'][0]['rule_goods_limit'])?><?=_('样')?><?php endif;?><?=_('商品')?>
                                            <?php }?>
                                            <span class="sale-rule-more" nctype="show-rule">
                                                <a href="javascript:void(0);">
                                                    <?=_('详情')?><i class="iconfont icon-iconjiantouxia"></i>
                                                </a>
                                            </span>

                                            <?php if(!empty($goods_detail['goods_base']['increase_info'])) {?>
                                                <div class="sale-rule-content" style="display: none;" nctype="rule-content">
                                                    <div class="title"><span class="sale-name">
                                                        <?=($goods_detail['goods_base']['increase_info']['increase_name'])?></span><?=_('，共')?>
                                                        <strong><?php echo count($goods_detail['goods_base']['increase_info']['rule']);?></strong>
                                                        <?=_('种活动规则')?><a href="javascript:;" nctype="hide-rule"><?=_('关闭')?></a>
                                                    </div>
                                                    <?php foreach($goods_detail['goods_base']['increase_info']['rule'] as $rule) { ?>
                                                        <div class="content clearfix">
                                                            <div class="mjs-tit">
                                                                <?=_('购物满')?><em><?=format_money($rule['rule_price'])?></em><?=_('即可加价换购至多')?><?php if($rule['rule_goods_limit']):?><?=($rule['rule_goods_limit'])?><?=_('样')?><?php endif;?><?=_('商品')?>
                                                            </div>
                                                            <ul class="mjs-info clearfix">
                                                                <?php foreach($rule['redemption_goods'] as $goods) { ?>
                                                                    <li>
                                                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?=($goods['goods_id'])?>" title="<?=($goods['goods_name'])?>" target="_blank" class="gift"> <img class="lazy" data-original="<?=image_thumb($goods['goods_image'],80,80)?>" alt="<?=($goods['goods_name'])?>"> </a>&nbsp;
                                                                  </li>
                                                                <?php }?>
                                                            </ul>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <!--E 加价购 -->

                                    <!--S 满即送 -->
                                    <?php if($goods_detail['mansong_info'] && $goods_detail['mansong_info']['rule'] ) { ?>
                                        <div class="ncs-mansong">
                                            <i class="group_purchase "><?=_('满即送：')?></i>
                                            <span class="sale-rule">
                                      <?php $rule = $goods_detail['mansong_info']['rule'][0]; ?>
                                                <?=_('购物满')?><em><?=format_money($rule['rule_price'])?></em>
                                                <?php if(!empty($rule['rule_discount'])) { ?>
                                                    <?=_('，立减现金')?><em><?=($rule['rule_discount'])?></em><?=_('元')?>
                                                <?php } ?>
                                                <?php if(!empty($rule['goods_id'])) { ?>
                                                    <?=_('，送')?><a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?=($rule['goods_id'])?>" title="<?=($rule['goods_name'])?>" target="_blank"><?=_('赠品')?></a>
                                                <?php } ?>
                                      </span> <span class="sale-rule-more" nctype="show-rule"><a href="javascript:void(0);"><?=_('共')?><strong><?php echo count($goods_detail['mansong_info']['rule']);?></strong><?=_('项，展开')?><i class="iconfont icon-iconjiantouxia"></i></a></span>
                                            <div class="sale-rule-content" style="display: none;" nctype="rule-content">
                                                <div class="title"><span class="sale-name"><?=_('满即送')?></span><?=_('共')?><strong><?php echo count($goods_detail['mansong_info']['rule']);?></strong><?=_('项，促销活动规则')?><a href="javascript:;" nctype="hide-rule"><?=_('关闭')?></a></div>
                                                <div class="content clearfix">
                                                    <div class="mjs-tit"><?=($goods_detail['mansong_info']['mansong_name'])?>
                                                        <time>(<?=($goods_detail['mansong_info']['mansong_start_time'])?> -- <?=($goods_detail['mansong_info']['mansong_end_time'])?> )</time>
                                                    </div>
                                                    <ul class="mjs-info">
                                                        <?php foreach($goods_detail['mansong_info']['rule'] as $rule) { ?>
                                                            <li> <span class="sale-rule"><?=_('购物满')?><em><?=format_money($rule['rule_price'])?></em>
                                                                    <?php if(!empty($rule['rule_discount'])) { ?>
                                                                        <?=_('， 立减现金')?><em><?=(($rule['rule_discount']))?></em><?=_('元')?>
                                                                    <?php } ?>
                                                                    <?php if(!empty($rule['goods_id'])) { ?>
                                                                        <?=_('， 送 ')?><a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?=($rule['goods_id'])?>" title="<?=($rule['goods_name'])?>" target="_blank" class="gift"> <img class="lazy" data-original="<?=image_thumb($rule['goods_image'],60,60)?>" alt="<?=($rule['goods_name'])?>"> </a>&nbsp;。
                                                                    <?php } ?>
                                              </span> </li>
                                                        <?php } ?>
                                                    </ul>
                                                    <div class="mjs-remark"><?=($goods_detail['mansong_info']['mansong_remark'])?></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!--E 满即送 -->
                                </div>
                            <?php }?>
                        </div>
                    </div>

                    <div class="obvious">
                        <p class="clearfix">
                            <span class="mar-r _letter-spacing"><?=_('商品评分：')?></span>
                            <span class="mar-b-3">
                            <?php for ($i = 1; $i <= $goods_detail['goods_base']['goods_evaluation_good_star']; $i++)
                            { ?><em></em><?php } ?>
                            </span>
                        </p>
                        <p class="clearfix"><span class="mar-r _letter-spacing"><?=('商品评价：')?></span>
                            <span class="color-1876d1 mar-b-4 "><a href="#elist" name="elist" class="pl"><i class="num_style"><?=($goods_detail['goods_common']['common_evaluate'])?></i> <?=_('条评论')?></a></span>
                        </p>
                    </div>


                    <div class="goods_style_sel ">

                        <p class="mar-top" style="clear:left;">
                            <span class="span_w mar_l _letter-spacing" id="peisongzhi"><?=_('配&nbsp;送&nbsp;至：')?></span>
                        </p>
                        <div class="span_w_p clearfix">
                            <div id="ncs-freight-selector" class="ncs-freight-select">
                                <div class="text">
                                    <!--<div><?/*=_('请选择地区')*/?></div>-->
                                    <div><?=$transport_area?></div>
                                    <b><i>∨</i></b>
                                </div>
                                <div class="content">
                                    <div id="ncs-stock" class="ncs-stock" data-widget="tabs">
                                        <div class="mt">
                                            <ul class="tab">
                                                <li data-index="0" data-widget="tab-item" class="curr"><a href="#none" class="hover"><em><?=_('请选择')?></em><i>∨</i></a></li>
                                            </ul>
                                        </div>
                                        <div id="stock_province_item" data-widget="tab-content" data-area="0">
                                            <ul class="area-list">
                                            </ul>
                                        </div>
                                        <div id="stock_city_item" data-widget="tab-content" data-area="1" style="display: none;">
                                            <ul class="area-list">
                                            </ul>
                                        </div>
                                        <div id="stock_area_item" data-widget="tab-content" data-area="2" style="display: none;">
                                            <ul class="area-list">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:;" class="close" onclick="$('#ncs-freight-selector').removeClass('hover')">关闭</a>
                            </div>
                            <span class="goods_have linehe bbc_color">
                                <?php if($goods_detail['goods_base']['goods_stock']):?><?=_('有货')?><?php else: ?><?=_('无货')?><?php endif;?>
                            </span>
                            <?php if ($goods_detail['shop_base']['shipping']){ ?>
                                <em class="bbc_color"><?= ($goods_detail['shop_base']['shipping']) ?></em>
                            <?php } ?>
                            <em class="transport"></em>
                        </div>
                        <?php if (isset($goods_detail['goods_common']['common_spec_name']) && isset($goods_detail['goods_common']['common_spec_value']) && $goods_detail['goods_common']['common_spec_value'] )
                        {
                            foreach ($goods_detail['goods_common']['common_spec_name'] as $speck => $specv)
                            {
                                ?>
                                <div class="span_w_p spec_div">
                                    <div class="span_w lineh-3 mar_l _letter-spacing" style="float:left;"><?= ($specv) ?>：</div>
                                    <div class="goods_pl">
                                        <?php foreach ($goods_detail['goods_common']['common_spec_value'][$speck] as $specvk => $specvv)
                                        {
                                            ?>
                                            <a <?php if(isset($goods_detail['goods_base']['goods_spec'][$specvk])){ ?> class="check" <?php }?> value="<?= ($specvk) ?>">
                                                <?=($specvv)?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                        <?php if($goods_detail['chain_stock']){?>
                            <p class="clearfix"><span class="mar-r _letter-spacing-2">门店服务：</span>
                                <span class="color-1876d1 mar-b-4 ">
                                    <a href="#" name="elist" class="num_style mendian" nctype="get_chain">
                                        <i class="iconfont icon-tabhome"></i><?=_('门店自提')?>
                                    </a>
                                    <?_('· 选择有现货的门店下单，可立即提货')?>
                                </span>
                            </p>
                        <?php }?>
                        <?php if($goods_status){?>
                            <p class="need_num clearfix">
                                <span class="span_w lineh-6 mar_l _letter-spacing"><?=_('数量：')?></span>
                                <span class="goods_num">
                                        <a class="no_reduce" ><?=_('-')?></a>
                                        <input id="nums" name="nums" data-id="<?=($goods_detail['goods_base']['goods_id'])?>" data-max="<?=($goods_detail['buy_residue'])?>" data-min="<?=($goods_detail['lower_limit'])?>" value="<?=($goods_detail['lower_limit'])?>">
                                        <a class="<?php if($goods_detail['buy_residue'] == 1 || $goods_detail['goods_base']['goods_stock'] == 1 ): ?>no_<?php endif; ?>add" ><?=_('+')?></a>
                                </span>
                                <?php if($goods_detail['goods_base']['goods_stock']){?>
                                    <span class="limit_purchase "><?=_('库存')?><?=($goods_detail['goods_base']['goods_stock'])?><?=_('件')?></span>
                                <?php }?>
                                <?php if($goods_detail['buy_limit']){?>
                                    <span class="limit_purchase "><?=_('限购')?><?=($goods_detail['buy_limit'])?><?=_('件')?></span>
                                <?php }?>
                            </p>
                            <?php if($goods_detail['goods_base']['goods_stock']):?>
                                <?php if($goods_detail['goods_common']['common_is_virtual']):?>
                                    <p class="buy_box">
                                        <a class="tuan_go buy_now_virtual bbc_btns"><?=_('立即购买')?></a>
                                    </p>
                                <?php else:?>
                                    <p class="buy_box">
                                        <?php if($goods_detail['goods_base']['fu_flag']){?>
                                            <a class="share  bshare tuan_go bbc_btns" data-type="0" data-status="<?=$goods_detail['goods_base']['promotion']['fu_order_flag']?>" data-id="<?=$goods_detail['goods_base']['goods_id'] ?>" data-name="<?=$goods_detail['goods_base']['goods_name'] ?>" data-pic="<?=$goods_image?>" data-shared='<?= json_encode($goods_detail['goods_base']['fu_info']['fu_base'])?>' data-fu-base='<?=json_encode($goods_detail['goods_base']['promotion']['fu_base'])?>' data-complete="<?=$goods_detail['goods_base']['fu_complete']?>" ><?=_('送福免单')?></a>
                                        <?php } else if($goods_detail['goods_base']['share_info']){?>
                                            <?php if($goods_detail['goods_base']['share_info']['time_down']){?>
                                                <a class="share  bshare tuan_go bbc_btns ">
                                                    下一轮购买优惠分享
                                                    <strong class="fnTimeCountDown" data-end="<?= ($goods_detail['goods_base']['share_info']['time_down']) ?>">
                                                        <span class="hour">00</span><strong>:</strong>
                                                        <span class="mini">00</span><strong>:</strong>
                                                        <span class="sec">00</span>
                                                    </strong>
                                                </a>
                                            <?php } else{?>
                                                <a class="share  bshare tuan_go bbc_btns" data-status="<?=$goods_detail['goods_base']['share_info']['order_wait_pay']?>" data-type="0" data-id="<?=$goods_detail['goods_base']['goods_id'] ?>" data-name="<?=$goods_detail['goods_base']['goods_name'] ?>" data-price="<?=$goods_detail['goods_base']['share_info']['share_total_price']?>" data-pic="<?=$goods_image?>" data-shared-price='<?=$goods_detail['goods_base']['shared_total_price']?>' data-shared='<?= json_encode($goods_detail['goods_base']['share_info']['price']['share_base'])?>' data-sqq="<?php echo $goods_detail['goods_base']['share_info']['sqq']?>" data-qzone="<?php echo $goods_detail['goods_base']['share_info']['qzone']?>" data-weixin="<?php echo $goods_detail['goods_base']['share_info']['weixin']?>" data-weixin_timeline="<?php echo $goods_detail['goods_base']['share_info']['weixin_timeline']?>" data-tsina="<?php echo $goods_detail['goods_base']['share_info']['tsina']?>" data-share-total-price="<?php echo $goods_detail['goods_base']['share_info']['share_total_price']?>" data-is-promotion="<?php echo $goods_detail['goods_base']['share_info']['is_promotion']?>" data-promotion-total-price="<?php echo $goods_detail['goods_base']['share_info']['promotion_total_price']?>"><?=_('分享立减￥').$goods_detail['goods_base']['share_info']['share_total_price']?></a>
                                            <?php }?>
                                        <?php }?>
                                    </p>
                                    <p class="buy_box">
                                        <a class="tuan_join_cart tuan_go bbc_color bbc_border"><?=_('加入购物车')?></a>
                                        <a class="tuan_go buy_now  bbc_color bbc_border"><?=_('立即购买')?>
                                            <?php if(isset($goods_detail['goods_base']['now_buy_price']) && !empty($goods_detail['goods_base']['now_buy_price'])){?>
                                                <?=format_money($goods_detail['goods_base']['now_buy_price'])?>
                                            <?php } else{ ?>
                                                <?=format_money($goods_detail['goods_base']['goods_price'])?>
                                            <?php } ?>
                                        </a>
                                    </p>

                                    <p class="buy_box notify_box">
                                        <a class="tuan_go bbc_color btn_nojoin_cart"><?=_('加入购物车')?></a>
                                        <a class="tuan_go bbc_color btn_notify"><?=_('到货通知')?></a>
                                    </p>
                                <?php endif;?>
                            <?php else:?>
                                <p class=" notify_box">
                                    <a class="tuan_go bbc_color btn_nojoin_cart"><?=_('加入购物车')?></a>
                                    <a class="tuan_go bbc_color btn_notify"><?=_('到货通知')?></a>
                                </p>
                            <?php endif;?>
                        <?php }else{?>
                            <div class="good_status"><?=_('该商品已下架')?></div>
                        <?php }?>
                    </div>
                </div>
                <div class="ev_right ">
                    <div class="ev_right_pad ">
                        <div class="divimg ">
                            <?php if(!empty($shop_detail['shop_logo']))
                            {
                                $shop_logo = $shop_detail['shop_logo'];
                            }else{
                                $shop_logo =$this->web['shop_logo']; }
                            ?>

                            <img src="<?=($shop_logo)?>">
                        </div>
                        <div class="txttitle clearfix ">
                            <p>
                                <a class="store-names" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=($shop_detail['shop_id'])?>"><?=($shop_detail['shop_name']).$shop_detail['shop_grade']?></a>
                                <script>
                                    document.cookie="shop_id=<?=($shop_detail['shop_id'])?>"
                                </script>
                                <?php if(Web_ConfigModel::value('im_statu')==1 ){?>
                                    <a href="javascript:;" class="chat-enter" rel="<?=$shop_detail['user_id']?>"><i class="iconfont icon-btncomment"></i></a>
                                <?php }?>
                            </p>
                            <?php if($shop_detail['shop_self_support'] == 'true'){?>
                                <div class="bbc_btns"><?=_('平台自营')?></div>
                            <?php }?>
                        </div>

                        <!-- 品牌-->
                        <?php if($shop_detail['shop_self_support'] == 'false'){?>
                            <div class="brandself ">
                                <ul class="shop_score clearfix ">
                                    <li><?=_('店铺动态评分')?></li>
                                    <li><?=_('同行业相比')?></li>
                                </ul>
                                <ul class="shop_score_content clearfix ">
                                    <li>
                                        <span><?=_('描述相符：')?><?=number_format($shop_detail['shop_desc_scores'],2,'.','')?></span>
                                        <span class="high_than bbc_bg">
                                        <?php if($shop_detail['com_desc_scores'] >= 0): ?><i class="iconfont  icon-gaoyu rel_top1"></i>
                                            <?=_('高于')?><?php else: ?><i class="iconfont  icon-diyu rel_top1"></i><?=_('低于')?><?php endif; ?>
                                    </span>
                                        <em class="bbc_color"><?=number_format(abs($shop_detail['com_desc_scores']),2,'.','')?><?=_('%')?></em>
                                    </li>
                                    <li>
                                        <span><?=_('服务态度：')?><?=number_format($shop_detail['shop_service_scores'],2,'.','')?></span>
                                        <span class="high_than bbc_bg">
                                        <?php if($shop_detail['com_service_scores'] >= 0): ?><i class="iconfont  icon-gaoyu rel_top1"></i><?=_('高于')?><?php else: ?><i class="iconfont  icon-diyu rel_top1"></i><?=_('低于')?><?php endif; ?>
                                    </span>
                                        <em  class="bbc_color"><?=number_format(abs($shop_detail['com_service_scores']),2,'.','')?><?=_('%')?></em>
                                    </li>
                                    <li>
                                        <span><?=_('发货速度：')?><?=number_format($shop_detail['shop_send_scores'],2,'.','')?></span>
                                        <span class="high_than bbc_bg">
                                        <?php if($shop_detail['com_send_scores'] >= 0): ?><i class="iconfont  icon-gaoyu rel_top1"></i><?=_('高于')?><?php else: ?><i class="iconfont  icon-diyu rel_top1"></i><?=_('低于')?><?php endif; ?>
                                    </span>
                                        <em  class="bbc_color"><?=number_format(abs($shop_detail['com_send_scores']),2,'.','')?><?=_('%')?></em>
                                    </li>
                                </ul>
                            </div>

                            <div class="shop_address">
                                <?=_('所 在 地 ：')?><?=($shop_detail['shop_region'])?>
                            </div>

                            <div class="follow_shop ">
                                <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=($shop_detail['shop_id'])?>" target="_blank" class="shop_enter"><?=_('进入店铺')?></a>
                                <a onclick="collectShop(<?=($shop_detail['shop_id'])?>)" class="shop_save"><?=_('收藏店铺')?></a>
                            </div>

                        <?php }?>

                        <?php if(isset($shop_detail['contract']) && $shop_detail['contract'] ):?>
                            <span class="fwzc "><?=_('服务支持：')?></span>
                            <ul class="ev_right_ul clearfix ">
                                <?php foreach($shop_detail['contract'] as $sckey => $scval):?>
                                    <a href="<?=($scval['contract_type_url'])?>"><li><i><img src="<?=image_thumb($scval['contract_type_logo'],22,22)?>"/></i>&nbsp;&nbsp;&nbsp;<?=($scval['contract_type_name'])?></li></a>
                                    <?php
                                endforeach;
                                ?>
                            </ul>
                            <?php
                        endif;
                        ?>
                    </div>
                    <?php if (!empty($data_recommon_goods)){ ?>
                        <div class="look_again "><?=_('看了又看')?></div>
                        <ul class="look_again_goods clearfix ">
                            <?php foreach ($data_recommon_goods as $key_recommon => $value_recommon) { ?>
                                <li>
                                    <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?=($value_recommon['goods_id'])?>">
                                        <img src="<?= $value_recommon['common_image'] ?>"/>
                                        <h5 class="bbc_color"><?= format_money($value_recommon['common_shared_price']) ?></h5>
                                    </a>
                                </li>
                            <?php }?>
                        </ul>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="ewm" style="">
            <img src="<?=YLB_Registry::get('base_url')?>/shop/api/qrcode.php?data=<?=urlencode(YLB_Registry::get('shop_wap_url')."/tmpl/product_detail.html?goods_id=".$goods_detail['goods_base']['goods_id'])?>" width="120" height="120"/>
            <p>扫描二维码</p><p>手机购物更实惠</p>
        </div>

        <!-- S 优惠套装 -->
        <div class="ncs-promotion" id="nc-bundling" style="display:none;"></div>
        <!-- E 优惠套装 -->
    </div>
</div>
<div class="wrap">
    <div class="t_goods_bot clearfix ">
        <div class="t_goods_bot_left ">
<!--            --><?php //if($shop_detail['shop_self_support'] == 'false'){?>
                <div class="goods_classify">
                    <h4><?=($shop_detail['shop_name'])?>
                        <?php if($shop_detail['shop_qq']){?>
                        <a rel="1" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$shop_detail['shop_qq']?>&site=qq&menu=yes" title="QQ: <?=$shop_detail['shop_qq']?>"><img border="0" src="http://wpa.qq.com/pa?p=2:<?=$shop_detail['shop_qq']?>:52&amp;r=0.22914223582483828" style=" vertical-align: middle;"></a><?php }?><?php if($shop_detail['shop_ww']){?>
                        <a rel="2"  target="_blank" href='http://www.taobao.com/webww/ww.php?ver=3&touid=<?=$shop_detail['shop_ww']?>&siteid=cntaobao&status=2&charset=utf-8'><img border="0" src='http://amos.alicdn.com/realonline.aw?v=2&uid=<?=$shop_detail['shop_ww']?>&site=cntaobao&s=2&charset=utf-8' alt="<?=_('点击这里给我发消息')?>" style=" vertical-align: middle;"></a><?php }?></h4>

                    <div class="service-list1" store_id="8" store_name="<?=($shop_detail['shop_name'])?>">
                        <?php if(!empty($service['pre'])){?>
                            <dl>
                                <dt><?=_('售前客服：')?></dt>

                                <?php foreach($service['pre'] as $key=>$val){ ?>
                                    <?php if(!empty($val['number'])){?>
                                        <dd><span><?=$val['name']?></span><span>
									<span c_name="<?=$val['name']?>" member_id="9"><?=$val['tool']?></span>
									</span></dd>
                                    <?php }?>
                                <?php }?>
                            </dl>
                        <?php }?>
                        <?php if(!empty($service['after'])){?>
                            <dl>
                                <dt><?=_('售后客服：')?></dt>
                                <?php foreach($service['after'] as $key=>$val){ ?>
                                    <?php if(!empty($val['number'])){?>
                                        <dd><span><?=$val['name']?></span><span>
									<span c_name="<?=$val['name']?>" member_id="9"><?=$val['tool']?></span>
									</span></dd>
                                    <?php }?>
                                <?php }?>

                            </dl>
                        <?php }?>
                        <?php if($shop_detail['shop_workingtime']){?>
                            <dl class="workingtime">
                                <dt><?=_('工作时间：')?></dt>
                                <dd>
                                    <p><?=($shop_detail['shop_workingtime'])?></p>
                                </dd>
                            </dl>
                        <?php }?>
                    </div>
                </div>
<!--            --><?php //}?>
            <div class="goods_classify ">
                <h4><?=_('商品分类')?></h4>
                <p class="classify_like">
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=goodsList&id=<?=$shop_detail['shop_id'];?>&order=common_sell_time "><?=_('按新品')?></a>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=goodsList&id=<?=$shop_detail['shop_id'];?>&order=common_price "><?=_('按价格')?></a>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=goodsList&id=<?=$shop_detail['shop_id'];?>&order=common_salenum "><?=_('按销量')?></a>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=goodsList&id=<?=$shop_detail['shop_id'];?>&order=common_collect"><?=_('按人气')?></a></p>

                <p class="classify_ser"><input type="text" name="searchGoodsList" placeholder="<?=_('搜索店内商品')?>"><a  id="searchGoodsList"><?=_('搜索')?></a></p>
                <ul class="ser_lists ">

                </ul>
            </div>
            <div class="goods_ranking ">
                <h4><?=_('商品排行')?></h4>
                <p class="selling"><a ><?=_('热销商品排行')?></a><a><?=_('热门收藏排行')?></a></p>
                <ul id="hot_salle">
                    <?php if (!empty($data_salle)){foreach ($data_salle as $key_salle => $value_salle){?>
                        <li class="clearfix">
                            <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?= ($value_salle['goods_id']) ?>" class="selling_goods_img"><img class="lazy" data-original="<?= $value_salle['common_image'] ?>"><span><?= $value_salle['common_name'] ?></span></a>
                            <p>
                                <!-- <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?= ($value_salle['goods_id']) ?>"><?= $value_salle['common_name'] ?></a> -->
                                <span class=" lf bbc_color"><?= format_money($value_salle['common_price']) ?></span>
                                <span class="rt">
                                    <i></i><?=_('出售:')?>
                                    <i class="num_style"><?= $value_salle['common_salenum'] ?></i> <?=_('件')?>
                                </span>
                            </p>
                            <span class="share_cart">
                                立减<u>￥<?= $value_salle['common_share_price'] ?></u>
                             </span>
                            <?php if($value_salle['common_is_promotion']){?>
                                <span class="share_cart">
                                立赚<u>￥<?= $value_salle['common_promotion_price'] ?></u>
                                </span>
                            <?php }?>
                        </li>
                    <?php } } ?>
                </ul>
                <ul style="display: none;" id="hot_collect">
                    <?php if (!empty($data_collect)) {foreach ($data_collect as $key_collect => $value_collect){ ?>
                        <li class="clearfix">
                            <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?= $value_collect['goods_id'] ?>" class="selling_goods_img"><img class="lazy" data-original="<?= $value_collect['common_image'] ?>"><span><?= $value_collect['common_name'] ?></span></a>
                            <p>
                                <!-- <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?= $value_collect['goods_id'] ?>"><?= $value_collect['common_name'] ?></a> -->
                                <span class="lf bbc_color"><?= format_money($value_collect['common_price']) ?></span>
                                <span class="rt">
                                    <i></i><?=_('收藏人气:')?>
                                    <i class="num_style" style="margin-right: 0;"><?= $value_collect['common_salenum'] ?></i>
                                </span>
                            </p>
                            <span class="share_cart">
                                立减<u>￥<?= $value_collect['common_share_price'] ?></u>
                            </span>
                            <?php if($value_collect['common_is_promotion']){?>
                                <span class="share_cart">
                                立赚<u>￥<?= $value_collect['common_promotion_price'] ?></u>
                                </span>
                            <?php }?>
                        </li>
                    <?php }} ?>
                </ul>
                <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=goodsList&id=<?=($shop_detail['shop_id'])?>"><p class="look_other_goods bbc_btns"><?=_('查看本店其他商品')?></p></a>
            </div>
        </div>
        <div class="t_goods_bot_right ">
            <ul class="goods_det_about goods_det clearfix border_top">
                <li><a class="xq checked"><?=_('商品详情')?></a></li>
                <li><a class="pl"><?=_('商品评论')?><span><?=_('(')?><?=($goods_detail['goods_common']['common_evaluate'])?><?=_(')')?></span></a></li>
                <!--<li><a class="xs"><?/*=_('销售记录')*/?><span><?/*=_('(')*/?><?/*= ($goods_detail['goods_base']['salecount']) */?><?/*=_(')')*/?></span></a></li>-->
                <?php if($entity_shop){?>
                <li><a class="wz"><?=_('商家位置')?></a></li>
                <?php }?>
                <li><a class="bz"><?=_('包装清单')?></a></li>
                <li><a class="sh"><?=_('售后保障')?></a></li>
                <li><a class="zl"><?=_('购买咨询')?>(<?=$consult_num?>)</a></li>
            </ul>

            <ul class="goods_det_about_cont">
                <!-- 商家位置 -->
                <li class="wz_1 clearfix" style="display: none;">
                    <?php if($entity_shop){?>
                    <div id="baidu_map" style="height:600px;width: 79%;border:1px solid gray"></div>
                    <div class="entity_shop">
                        <?php foreach ($entity_shop as $key => $value) { ?>
                        <div class="entity_shop_box">
                            <strong class="entity_shop_name"><?=$value['entity_name']?></strong>
                            <?php if(in_array($value['province'],array('北京市','上海市','天津市','重庆市','香港特别行政区','澳门特别行政区'))){?>
                            <span class="entity_shop_address"><?=_("地址：")?><?=$value['city']?><?=$value['entity_xxaddr']?></span>

                            <?php }else{ ?>
                            <span class="entity_shop_address"><?=_("地址：")?><?=$value['province']?><?=$value['city']?><?=$value['entity_xxaddr']?></span>
                            <?php }?>
                            <span class="entity_shop_tel"><?=_("电话：")?><?=$value['entity_tel']?></span>
                        </div>
                        <?php  }?>
                    </div>


                    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
                    <link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css" rel="stylesheet">
                    <?php }?>
                </li>
                <!--商品咨询-->
                <div id="goodsadvisory" style="display:none;" class="ncs-commend-main zl_1"></div>
                <!-- 商品评论 -->
                <div id="goodseval" style="display:none;" class="ncs-commend-main pl_1"></div>
                <!-- 商品查询 -->
                <div id="saleseval" style="display:none;" class="ncs-commend-main xs_1"></div>
                <!-- 详细-->
                <li class="xq_1" style="display:block;position: relative;">

                    <div class="p-parameter">
                        <?php if($goods_detail['goods_common']['brand_name']):?>
                        <ul id="parameter-brand" class="p-parameter-list">
                            <li title="<?=$goods_detail['goods_common']['brand_name']?>">品牌： <a href="" target="_blank"><?=$goods_detail['goods_common']['brand_name']?></a>
                            </li>
                        </ul>
                        <?php endif;?>

                            <?php if($goods_detail['goods_common']['common_property_row']):?>
                        <ul class="parameter2 p-parameter-list">
                            <?php foreach($goods_detail['goods_common']['common_property_row'] as $key => $val){
                            ?>
                            <li title="2504714"><?=$key?>：<?=$val?></li>
                            <?php
                            }?>
                        </ul>
                        <?php endif;?>
                    </div>

                    <?php if(isset($goods_format_top)&&!empty($goods_format_top)): ?>
                           <?=$goods_format_top['content']; ?>
                    <?php endif; ?>

                    <div id="goods_detail">
                        <?/*= ($goods_detail['goods_common']['common_detail']) */?>
                    </div>

                    <?php if(isset($goods_format_bottom)&&!empty($goods_format_bottom)): ?>
                        <?=$goods_format_bottom['content']; ?>
                    <?php endif; ?>

                    <?php if($shop_detail['contract']){ ?>
                        <div style="border-top:1px #E1E1E1 solid;width: 100%;padding-top:20px;">
                            <h2 style="color:#666666">售后保障</h2>
                        </div>
                        <div class="product-details">
                            <div>
                                <?= ($goods_detail['goods_common']['common_service']) ?>
                            </div>
                        </div>
                        <div class="details-content" style="overflow: hidden;">
                            <?php foreach ($shop_detail['contract'] as $sckey => $scval): ?>
                                <div style="float: left; width: 50%;">
                                    <div style="border: 1px solid #f5f5f5;background: none repeat scroll 0 0 #f5f5f5; margin:0px; height: 60px;">
                                        <div style="float: left; width: 60px; height: 60px;">
                                            <img style="width: 60px;" class="lazy" data-original="<?= $scval['contract_type_logo'] ?>">
                                        </div>
                                        <div style="float: left;  width:60%;">
                                            <div style="height: 35px;">
                                                <em style="float:left;padding-left:10px;margin-top:17px;font-size: 16px;font-weight: 700;"><?= $scval['contract_type_name'] ?></em>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 100%;">
                                        <div style="min-height: 60px;padding: 10px; text-align: left; color: #9c9c9c; border: 1px solid #f5f5f5;height: 120px;overflow: hidden;">
                                            <?= $scval['contract_type_desc'] ?>
                                        </div>
                                    </div>
                                </div>
                            <?php  endforeach; ?>
                        </div>
                    <?php  } ?>

                    <div style="border:1px #E1E1E1 solid;width: 98%;margin: 10px auto;">
                        <h2 style="color:#666666">商品评论</h2>
                    </div>
                    <div id="goodsevals" style="display:block;" class="ncs-commend-main"></div>
                </li>
                <!-- 包装清单 -->
                <li class="bz_1 tlf" style="display: none">
                    <div class="product-details">
                        <div>
                            <?=($goods_detail['goods_common']['common_packing_list'])?>
                        </div>
                    </div>
                </li>
                <!-- 售后服务 -->
                <li class="sh_1 tlf" style="display: none">
                    <div class="product-details">
                        <div>
                            <?=($goods_detail['goods_common']['common_service'])?>
                        </div>
                    </div>
                    <?php foreach($shop_detail['contract'] as $sckey => $scval):?>
                    <div style="float: left; width: 50%;">
                        <div style="border: 1px solid #f5f5f5;background: none repeat scroll 0 0 #f5f5f5; margin: 20px 10px 0px 0px; height: 60px; padding: 30px;">
                            <div style="float: left; width: 60px; height: 60px;">
                                <img style="width: 60px;" src="<?= $scval['contract_type_logo'] ?>">
                            </div>
                            <div style="float: left; margin-left: 15px; width:60%;">
                                <div style="height: 35px;">
                                    <em style="float:left;margin-top:17px;font-size: 16px;font-weight: 700;"><?= $scval['contract_type_name'] ?></em>
                                </div>
                            </div>
                        </div>
                        <div style="width: 100%;">
                            <div style="min-height: 60px; margin-right: 10px; padding: 10px; color: #9c9c9c; border: 1px solid #f5f5f5;height: 120px;overflow: hidden;">
                                <?= $scval['contract_type_desc'] ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    endforeach;
                    ?>
                </li>
            </ul>

        </div>
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

<!--分享立减 S-->
<div id="sharecover" style="display:none;">
    <span class="mask"></span>
</div>
<div id="code">
    <div class="close">
        <span>
            <?php if($goods_detail['goods_base']['fu_flag']){ ?>
                分享零元购 送福零元拿
            <?php }else{?>
                分享有礼
            <?php }?>
           </span>
        <a href="javascript:void(0)" id="closebt">
            <img src="<?= $this->view->img ?>/close.png">
        </a>
    </div>
    <div class="sharetxt">
        <?php if($goods_detail['goods_base']['fu_flag']){ ?>
            <div class="share_explain lj">
                <p class="explain_title" >送福免单活动说明</p>
                <p class="explain_e" >
                    1.参加“送福免单”时，在规定时间内，完成点击次数按每次
                    <span class="bbc_color"><?=$goods_detail['goods_base']['promotion']['fu_price']?></span>
                    元减少商品购买价格，即可免费拿到您选择的商品。
                </p>
                <p class="explain_e" >
                    2.参加“送福免单”时，选定商品，在规定时间内，没有完成所要求的点击次数时，按点击次数每次
                    <span class="bbc_color"><?=$goods_detail['goods_base']['promotion']['fu_t_price']?></span>
                    元减少活动商品购买价格,计算出商品的购买价格，您可以选择购买或放弃。
                </p>
            </div>
            <p>我要分享到：
                <?php if($goods_detail['goods_base']['fu_info'] && $goods_detail['goods_base']['fu_info']['fu_end_time']){?>
                <span class="fu" style="float: right;">
                    <strong class="fnTimeCountDown" data-end="<?=$goods_detail['goods_base']['fu_info']['fu_end_time'] ?>">
                        <span class="hour">00</span><strong>:</strong>
                        <span class="mini">00</span><strong>:</strong>
                        <span class="sec">00</span>
                    </strong>
                    <span>后送福免单将失效</span>
                </span>
                <?php }?>
            </p>
        <?php }else{?>
            <div class="share_explain lj">
                <p class="explain_title" >1.分享立減</p>
                <p class="explain_e" >将商品链接分享至相关平台可获得减免额度。每种渠道可分享一次，分享后点击可获得相应减免额度，最终支付金额以所分享平台数量决定。</p>
                <p class="explain_ex" ><span class="lr">例如：</span>&nbsp;您看中了一件100元的商品，弹出窗口提示您每分享一次可立减5元，如果您在QQ好友、QQ空间、微信好友、微信朋友圈、新浪微博5种渠道都分享了该商品，最终您就可以100-5*5=75元的价格购买到该商品。</p>
            </div>
            <div class="share_explain lz">
                <p class="explain_title">2.分享立赚</p>
                <p class="explain_e">将商品链接分享至相关平台可获得点击推广金。每种渠道可分享一次，每点击一次即可获得相应点击推广金，最终所获得点击推广金以所分享链接点击数决定。</p>
                <p class="explain_ex"><span class="lr">例如：</span>&nbsp;您将商品链接分享至QQ好友、QQ空间、微信好友、微信朋友圈、新浪微博等平台，共产生50次点击，每次点击的点击推广金为0.3元，那您最终将会获得0.3*50=15元点击推广金。每人在每个平台只可点击一次，所获得点击推广金由平台和商家所设定的单次点击金额与有效点击次数共同决定（总和不超过该商品的总点击推广金），相应推广详情可在商城“我的账户”中查看。</p>
            </div>

            <p>我要分享到：</p>
        <?php }?>

        <div class="share_c">
            <div class="bdsharebuttonbox" data-tag="share_1">
                <div class="share_d">
                    <a class="bds_share bds_sqq " data-cmd="sqq"></a>
                    <p>QQ好友</p>
                    <p id="sqq"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_qzone" data-cmd="qzone" ></a>
                    <p>QQ空间</p>
                    <p id="qzone"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_weixin" data-cmd="weixin"></a>
                    <p>微信好友</p>
                    <p id="weixin"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_weixin_timeline" data-cmd="weixin"></a>
                    <p>微信朋友圈</p>
                    <p id="weixin_timeline"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_tsina" data-cmd="tsina"></a>
                    <p>新浪微博</p>
                    <p id="tsina"></p>
                </div>
                <div class="share_d more">
                    <a class="bds_more" ></a><p>分享越多</p><p>立赚越多</p>
                </div>
                <div class="share_more">
                    <div class="triangle-css3 transform ie-transform-filter"></div>
                    <div class="more_s">
                        <div class="mss"><a class="bds_douban" data-cmd="douban"></a><p>豆瓣</p></div>
                        <div class="mss"><a class="bds_kaixin001" data-cmd="kaixin001"></a><p>开心网</p></div>
                        <div class="mss"><a class="bds_ty" data-cmd="ty"></a><p>天涯</p></div>
                        <div class="mss"><a class="bds_huaban" data-cmd="huaban"></a><p>花瓣网</p></div>
                        <div class="mss"> <a class="bds_copy" data-cmd="copy"></a><p>复制链接</p></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="share_xx"></div>
        <div class="sharefoot">
            <?php if($goods_detail['goods_base']['fu_flag']){ ?>
                <div class="fx_xq">
                    <span class="sp1">送福免单完成进度：</span>
                    <span class="sp2"><span class="sfmd"></span>
                    <span class="lj_xq" >（活动说明）</span>
                    </span>
                </div>
            <?php }else{?>
                <div class="fx_xq f1">
                    <div class="s_ljz">
                        <span class="sp1">1.分享立减：</span>
                        <span  class="sp2"><span class="fxlj"></span><span class="lj_xq" >（详情）</span></span>
                        <span class="ljl red_line"></span>
                    </div>
                    <div class="s_ljz">
                        <span  class="sp1">2.分享立赚：</span>
                        <span  class="sp2 "><span class="fxlz"></span><span class="lz_xq" >（详情）</span></span>
                        <span class="lzl red_line"></span>
                    </div>
                </div>
                <div class="fx_xq f2">
                    <span class="sp1">分享立减：</span>
                    <span  class="sp2"><span class="fxlj"></span>
                    <span class="lj_xq" >（详情）</span>
                    </span>
                </div>
            <?php }?>
        </div>
    </div>
    <div class="share-layer">
        <p class="share-tip">
            <?php if($goods_detail['goods_base']['fu_flag']){ ?>
                您有包含此商品的订单尚未完成，此时分享不享受送福免单
            <?php }else{?>
                您的待支付订单已经包含此商品，此时分享不享受立减
            <?php }?>
        </p>
        <div class="share-btns">
            <span class="continue-share lf"><a href="javascript:;">继续分享</a></span>
            <?php if($goods_detail['goods_base']['fu_flag']){ ?>
            <span class="to-pay lf"><a href="<?=YLB_Registry::get('url')?>?ctl=Buyer_Order&met=physical">查看订单</a></span>
            <?php }else{?>
            <span class="to-pay lf"><a href="<?=YLB_Registry::get('url')?>?ctl=Buyer_Order&met=physical&status=wait_pay">去支付</a></span>
            <?php }?>
        </div>
    </div>
</div>
<!--分享立减 E-->

<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.slideBox.min.js" ></script>
<script src="<?= $this->view->js_com ?>/sppl.js"></script>
<script src="<?= $this->view->js ?>/goods_detail.js"></script>
<script src="<?= $this->view->js_com ?>/plugins/jquery.imagezoom.min.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
<script type="text/javascript" src="http://bdimg.share.baidu.com/static/api/js/share.js" charset="utf-8"></script>

<script>
    var goods_id = <?= ($goods_detail['goods_base']['goods_id']) ?> ;
    var common_id = <?= ($goods_detail['goods_base']['common_id']) ?> ;
    var shop_id = <?= ($shop_detail['shop_id']) ?> ;

    //关闭登录窗口
    $(".btn-close").click(function() {
        $("#login_content").hide();
        $(".msg-wrap").hide();
        $('.lo_user_account').val("");
        $('.lo_user_password').val("");
    });

    //回车登录
    $("#formlogin").keydown(function(e) {
        var e = e || event,
            keycode = e.which || e.keyCode;

        if (keycode == 13) {
            loginSubmit();
        }
    });

    //登录按钮
    function loginSubmit() {
        var user_account = $('.lo_user_account').val();
        var user_password = $('.lo_user_password').val();
        $("#loginsubmit").html('正在登录...');
        login_url = UCENTER_URL + '?ctl=Api&met=login&user_account=' + user_account + '&user_password=' + user_password + '&typ=json';
        $.post(login_url, function(data) {
            if (data.status == 200) {
                //location.reload();
                $("#login_content").hide();
                $.ajax({
                    type: "get",
                    url: SITE_URL + "?ctl=Login&met=check&typ=json",
                    data:{ks:data.data.k, us:data.data.user_id},
                    dataType: "jsonp",
                    jsonp: "jsonp_callback",
                    success: function(data){
                        if (200 == data.status) {
                            location.reload();
                        }
                    }
                });
            } else {
                if (data.msg) {
                    Public.tips.error(data.msg);
                } else {
                    Public.tips.error('登录失败');
                }
            }
        });
    }

    //上架商品
    function upGoods(chk) {
        var chk_value = [];
        chk_value.push(chk);
        $.dialog.confirm('您确定要上架吗?', function() {
            $.post(SITE_URL + '?ctl=Seller_Goods&met=editGoodsCommon&typ=json&act=up', {
                chk: chk_value
            }, function(data) {
                if (data && 200 == data.status) {
                    Public.tips({
                        content: "上架成功！"
                    });
                    location.reload();
                } else {
                    Public.tips({
                        type: 1,
                        content: "上架失败！"
                    });
                }
            });
        });
    }

    //发起咨询
    $("#add_consult").bind("click", function() {
        if ($.cookie('key')) {
            $.dialog({
                title: "<?=_('发起咨询')?>",
                height: 290,
                width: 380,
                lock: true,
                drag: false,
                content: 'url: ' + SITE_URL + '?ctl=Buyer_Service_Consult&met=add&typ=e&gid=' + goods_id
            });
        } else {
            $("#login_content").show();
        }
    });

    //加入购物车
    $(".tuan_join_cart").bind("click", function() {
        if ( <?= $shop_owner ?> ) {
            Public.tips.warning('<?=_('不能购买自己商店的商品！')?>');
            return false;
        }
        if ( <?= $IsHaveBuy ?> ) {
            Public.tips.warning('<?=_('您已达购买上限！')?>');
            return false;
        }
        goods_num = $("#nums").val();
        if ($.cookie('key')) {
            $.ajax({
                url: SITE_URL + '?ctl=Buyer_Cart&met=addCart&typ=json',
                data: {
                    goods_id: goods_id,
                    goods_num: goods_num
                },
                dataType: "json",
                contentType: "application/json;charset=utf-8",
                async: false,
                success: function(a) {
                    if (a.status == 250) {
                        Public.tips.warning(a.msg);
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
            $("#login_content").show();
        }
    });

    //立即购买虚拟商品
    $(".buy_now_virtual").bind("click", function() {
        if ( <?= $shop_owner ?> ) {
            Public.tips.warning('<?=_('不能购买自己商店的商品！')?>');
            //$.dialog.alert('不能购买自己商店的商品！');

            return false;
        }
        if ( <?= $IsHaveBuy ?> ) {
            //$.dialog.alert('您达到购买上限！');
            Public.tips.warning('<?=_('您已达购买上限！')?>');
            return false;
        }
        if ($.cookie('key')) {

            window.location.href = SITE_URL + '?ctl=Buyer_Cart&met=buyVirtual&goods_id=' + goods_id + '&goods_num=' + $("#nums").val();

        } else {
            $("#login_content").show();
        }

    })

    //立即购买 - 实物商品
    $(".buy_now").bind("click", function() {
        if ( <?= $shop_owner ?> ) {
            Public.tips.warning('<?=_('不能购买自己商店的商品！')?>');

            return false;
        }
        if ( <?= $IsHaveBuy ?> ) {
            Public.tips.warning('<?=_('您已达购买上限！')?>');
            return false;
        }
        if ($.cookie('key')) {
            $.ajax({
                url: SITE_URL + '?ctl=Buyer_Cart&met=addCart&typ=json',
                data: {
                    goods_id: goods_id,
                    goods_num: $("#nums").val()
                },
                dataType: "json",
                contentType: "application/json;charset=utf-8",
                async: false,
                success: function(a) {
                    if (a.status == 250) {
                        //$.dialog.alert(a.msg);
                        Public.tips.warning(a.msg);
                    } else {
                        if (a.data.cart_id) {
                            window.location.href = SITE_URL + '?ctl=Buyer_Cart&met=confirm&product_id=' + a.data.cart_id;
                        }

                    }
                },
                failure: function(a) {
                    Public.tips.error('<?=_('操作失败！')?>');
                    //$.dialog.alert("操作失败！");
                }
            });
        } else {
            $("#login_content").show();
        }

    })

    //门店自提
    $('a[nctype="get_chain"]').click(function() {
        $.dialog({
            title: '查看门店',
            content: "url: <?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=chain&goods_id=" + goods_id + "&shop_id=" + shop_id,
            data: {
                callback: callback
            },
            width: 800,
            lock: true
        })

        function callback(url) {
            //                api.close();
            window.location.href = url;
        }

    });

    //热销商品
    $(".selling").children().eq(0).hover(function() {
        $("#hot_salle").show();
        $("#hot_collect").hide();
    });

    //热搜商品
    $(".selling").children().eq(1).hover(function() {
        $("#hot_salle").hide();
        $("#hot_collect").show();
    });

    //收藏商品
    window.collectGoods = function(e) {
        if ($.cookie('key')) {
            $.post(SITE_URL + '?ctl=Goods_Goods&met=collectGoods&typ=json', {
                goods_id: e
            }, function(data) {
                if (data.status == 200) {
                    Public.tips.success(data.data.msg);
                    $(".icon-icoheart").addClass("icon-taoxinshi").removeClass('icon-icoheart');
                } else {
                    Public.tips.error(data.data.msg);
                }
            });
        } else {
            $("#login_content").show();
        }
    };

    //收藏店铺
    window.collectShop = function(e) {
        if ($.cookie('key')) {
            $.post(SITE_URL + '?ctl=Shop&met=addCollectShop&typ=json', {
                shop_id: e
            }, function(data) {
                if (data.status == 200) {
                    Public.tips.success(data.data.msg);
                    //$.dialog.alert(data.data.msg);
                } else {
                    Public.tips.error(data.data.msg);
                    //$.dialog.alert(data.data.msg);
                }
            });
        } else {
            $("#login_content").show();
        }
    };

    $("input[name='searchGoodsList']").blur(function() {
        var search = $("input[name='searchGoodsList']").val();
        if (search) {
            $("#searchGoodsList").attr('href', SITE_URL + '?ctl=Shop&met=goodsList&search=' + search + '&id=' + shop_id);
        }
    });

    $('.wz').click(function(){
            $(".pl_1").css("display","none");
            $(".pl_1").css("display","none");
            $(".zl_1").css("display","none");
            $(".xs_1").css("display","none");
            $(".wz_1").css("display","block");
            $(".bz_1").css("display","none");
            $(".sh_1").css("display","none");
            $(".xq_1").css("display","none");

            var map = new BMap.Map("baidu_map", {enableMapClick:false});
            var geo = new BMap.Geocoder();
            var city = new BMap.LocalCity();
            var top_left_navigation = new BMap.NavigationControl();
            var overView = new BMap.OverviewMapControl();
            var currentArea = '';//当前地图中心点的区域对象
            var currentCity = '';//当前地图中心点的所在城市
            var idArray = new Array();

            map.addControl(top_left_navigation);
            map.addControl(overView);
            map.enableScrollWheelZoom(true);
            city.get(local_city);

            function local_city(cityResult){
                map.centerAndZoom(cityResult.center, 15);
                currentCity = cityResult.name;
                pointArray = new Array();
                var point = '';
                var marker = '';
                var label = '';
                var k = 0;
                <?php if($entity_shop){

                foreach ($entity_shop as $key => $value) {

                if($value['lng']&&$value['lat']){
                ?>
                point = new BMap.Point(<?=$value['lng']?>, <?=$value['lat']?>);
                pointArray[k++] = point;
                label = new BMap.Label("<?=$value['entity_name']?>",{offset:new BMap.Size(20,-10)});
                marker = new BMap.Marker(point);
                marker.setTitle('地址-'+k);
                marker.setLabel(label);
                marker.enableDragging();
                map.addOverlay(marker);
                idArray['地址-'+k] = <?=$value['entity_id']?>;

                <?php } } }?>

                map.setViewport(pointArray);
            }

            function getPointArea(point,callback){//通过点找到地区
                geo.getLocation(point, function(rs){
                    var addComp = rs.addressComponents;
                    if(addComp.province != '') callback(addComp);
                }, {numPois:1});
            }
        });

    //套装加入购物车
    function addblcart(bl_id){
        if(<?=$shop_owner?>)
        {
            Public.tips.warning('<?=_('不能购买自己商店的商品！')?>');
            return false;
        }
        if(<?=$IsHaveBuy?>)
        {
            Public.tips.warning('<?=_('您已达购买上限！')?>');
            return false;
        }

        if ($.cookie('key'))
        {
            $.ajax({
                url: SITE_URL + '?ctl=Buyer_Cart&met=addCart&typ=json',
                data: {bl_id:bl_id, goods_num: 1},
                dataType: "json",
                contentType: "application/json;charset=utf-8",
                async: false,
                success: function (a)
                {
                    if (a.status == 250)
                    {
                        Public.tips.error(a.msg);
                    }
                    else
                    {
                        $.dialog({
                            title: "<?=_('加入购物车')?>",
                            height: 100,
                            width: 250,
                            lock: true,
                            drag: false,
                            content: 'url: '+SITE_URL + '?ctl=Buyer_Cart&met=add&typ=e'
                        });
                    }
                },
                failure: function (a)
                {
                    Public.tips.error('<?=_('操作失败！')?>');
                }
            });
        }
        else
        {
            login_url   = UCENTER_URL + '?ctl=Login&met=index&typ=e';
            callback = SITE_URL + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(window.location.href);
            login_url = login_url + '&from=shop&callback=' + encodeURIComponent(callback);
            window.location.href = login_url;
        }
    }

    $(document).ready(function(){

        var _TimeCountDown = $(".fnTimeCountDown");
        _TimeCountDown.fnTimeCountDown();

        //获取店铺分类
        url = SITE_URL + '?ctl=Goods_Goods&met=getShopCat&shop_id='+shop_id;
        $(".ser_lists").load(url, function(){
        });

        <?php if(isset($_REQUEST['from'])){ ?>
            from = '<?=$_REQUEST['from']?>';
        <?php }else{ ?>
            from = '';
        <?php } ?>

        if(from == 'consult'){
            window.location.hash = "#elist";
            $(".zl").click();
        }

        //加载套装
        $("#nc-bundling").load(SITE_URL+'?ctl=Goods_Goods&met=getGoodsBundling&gid=<?php echo $goods_detail['goods_base']['goods_id'];?>', function(){
            if($(this).html() != '') {
                $(this).show();
            }
        });

    })

</script>

<!--  地址选择 -->
<script type="text/javascript">
    var $cur_area_list,$cur_tab,next_tab_id = 0,cur_select_area = [],calc_area_id = '',calced_area = [],calced_area_transport = [],cur_select_area_ids =[];

    <?php if($goods_detail['goods_base']['goods_stock']){?>
        $(document).ready(function(){

            if($.cookie('area')) {
                $.post(SITE_URL  + '?ctl=Base_District&met=getDistrictNameList&name=' + $.cookie('area') +  '&typ=json',function(data) {
                    $("#ncs-freight-selector .text div").html(data.data.area);
                    $.post(SITE_URL  + '?ctl=Goods_Goods&met=getTramsport&area_id='+ data.data.city.id +'&common_id='+ <?=($goods_detail['goods_common']['common_id'])?> +'&typ=json',function(data) {
                        if (data.status === 250) {
                            $('.goods_have').html('无货');
                            $('.transport').html('');
                            $('a[nctype="buynow_submit"]').addClass('no-buynow');
                            $('a[nctype="addcart_submit"]').addClass('no-buynow');
                            $('.buy_box').hide();
                            $('.notify_box').show();
                        } else {
                            $('.goods_have').html('有货 ');
                            <?php if ($goods_detail['goods_base']['promotion'] && $goods_detail['goods_base']['promotion']['free_freight']){ ?>
                                $('.transport').html('');
                            <?php }else{?>
                                $('.transport').html(data.data.transport_str);
                            <?php }?>
                            $('a[nctype="buynow_submit"]').removeClass('no-buynow');
                            $('a[nctype="addcart_submit"]').removeClass('no-buynow');
                            $('.buy_box').show();
                            $('.notify_box').hide();
                        }
                    });
                });
            }else{
                var transport_id = <?=$transport_id?>;
                $.post(SITE_URL  + '?ctl=Goods_Goods&met=getTramsport&area_id='+ transport_id +'&common_id='+ <?=($goods_detail['goods_common']['common_id'])?> +'&typ=json',function(data) {
                    if (data.status === 250) {
                        $('.goods_have').html('无货');
                        $('.transport').html('');
                        $('a[nctype="buynow_submit"]').addClass('no-buynow');
                        $('a[nctype="addcart_submit"]').addClass('no-buynow');
                        $('.buy_box').hide();
                        $('.notify_box').show();
                    } else {
                        $('.goods_have').html('有货 ');
                        <?php if ($goods_detail['goods_base']['promotion'] && $goods_detail['goods_base']['promotion']['free_freight']){ ?>
                            $('.transport').html('');
                        <?php }else{?>
                            $('.transport').html(data.data.transport_str);
                        <?php }?>
                        $('a[nctype="buynow_submit"]').removeClass('no-buynow');
                        $('a[nctype="addcart_submit"]').removeClass('no-buynow');
                        $('.buy_box').show();
                        $('.notify_box').hide();
                    }
                });
            }


            $("#ncs-freight-selector").hover(function() {
                //如果店铺没有设置默认显示区域，马上异步请求
                if (typeof nc_a === "undefined") {
                    $.post(SITE_URL  + '?ctl=Base_District&met=getAllDistrict&typ=json',function(data)
                        {
                            nc_a = data.data;
                            $cur_tab = $('#ncs-stock').find('li[data-index="0"]');
                            _loadArea(0);
                        }
                    );
                }

                $(this).addClass("hover");
                $(this).on('mouseleave',function(){
                    $(this).removeClass("hover");
                });
            });

            $('ul[class="area-list"]').on('click','a',function(){
                $('#ncs-freight-selector').unbind('mouseleave');
                var tab_id = parseInt($(this).parents('div[data-widget="tab-content"]:first').attr('data-area'));
                if (tab_id == 0) {cur_select_area = [];cur_select_area_ids = []};
                if (tab_id == 1 && cur_select_area.length > 1) {
                    cur_select_area.pop();
                    cur_select_area_ids.pop();
                    if (cur_select_area.length > 1) {
                        cur_select_area.pop();
                        cur_select_area_ids.pop();
                    }
                }
                next_tab_id = tab_id + 1;
                var area_id = $(this).attr('data-value');
                if(tab_id == 0)
                {
                    $.cookie('areaId',area_id)
                }
                $cur_tab = $('#ncs-stock').find('li[data-index="'+tab_id+'"]');
                $cur_tab.find('em').html($(this).html());
                $cur_tab.find('em').attr('data_value',$(this).attr('data-value'));
                $cur_tab.find('i').html(' ∨');
                if (tab_id < 2) {
                    cur_select_area.push($(this).html());
                    cur_select_area_ids.push(area_id);
                    $cur_tab.find('a').removeClass('hover');
                    $cur_tab.nextAll().remove();
                    if (typeof nc_a === "undefined") {
                        $.post(SITE_URL  + '?ctl=Base_District&met=getAllDistrict&typ=json',function(data)
                        {
                            nc_a = data.data;
                            _loadArea(area_id);
                        })
                    } else {
                        _loadArea(area_id);
                    }
                } else {
                    //点击第三级，不需要显示子分类
                    if (cur_select_area.length == 3) {
                        cur_select_area.pop();
                        cur_select_area_ids.pop();
                    }
                    cur_select_area.push($(this).html());
                    cur_select_area_ids.push(area_id);
                    $('#ncs-freight-selector > div[class="text"] > div').html(cur_select_area.join(''));
                    $('#ncs-freight-selector').removeClass("hover");
                    _calc();
                }
                $('#ncs-stock').find('li[data-widget="tab-item"]').on('click','a',function(){
                    var tab_id = parseInt($(this).parent().attr('data-index'));
                    if (tab_id < 2) {
                        $(this).parent().nextAll().remove();
                        $(this).addClass('hover');
                        $('#ncs-stock').find('div[data-widget="tab-content"]').each(function(){
                            if ($(this).attr("data-area") == tab_id) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    }
                });
            });
            function _loadArea(area_id){
                if (nc_a[area_id] && nc_a[area_id].length > 0) {
                    $('#ncs-stock').find('div[data-widget="tab-content"]').each(function(){
                        if ($(this).attr("data-area") == next_tab_id) {
                            $(this).show();
                            $cur_area_list = $(this).find('ul');
                            $cur_area_list.html('');
                        } else {
                            $(this).hide();
                        }
                    });
                    var areas = [];
                    areas = nc_a[area_id];
                    for (i = 0; i < nc_a[area_id].length; i++) {
                        $cur_area_list.append("<li><a data-value='" + nc_a[area_id][i]['district_id'] + "' >" + nc_a[area_id][i]['district_name'] + "</a></li>");
                    }
                    if (area_id > 0){
                        $cur_tab.after('<li data-index="' + (next_tab_id) + '" data-widget="tab-item"><a class="hover"  ><em>请选择</em><i> ∨</i></a></li>');
                    }
                } else {
                    $cur_tab.find('a').addClass('hover');
                    $('#ncs-freight-selector > div[class="text"] > div').html(cur_select_area);
                    $('#ncs-freight-selector').removeClass("hover");
                    _calc();
                }
            }

            //计算运费，是否配送
            function _calc() {
                <?php if ($goods_detail['goods_common']['transport_type_id']){ ?>
                var _args = '';
                calc_area_id = $('li[data-index="1"]').find("em").attr("data_value");
                if (typeof calced_area[calc_area_id] == 'undefined') {
                    //需要请求配送区域设置
                    $.post(SITE_URL  + '?ctl=Goods_Goods&met=getTramsport&area_id='+ calc_area_id +'&common_id='+ <?=($goods_detail['goods_common']['common_id'])?> +'&typ=json',function(data){
                        console.info(data.data);
                        calced_area[calc_area_id] = data.msg;
                        calced_area_transport[calc_area_id] = data.data.transport_str;
                        if (data.status === 250) {
                            $('.goods_have').html('无货');
                            $('.transport').html('');
                            $('a[nctype="buynow_submit"]').addClass('no-buynow');
                            $('a[nctype="addcart_submit"]').addClass('no-buynow');
                            $('.buy_box').hide();
                            $('.notify_box').show();
                        } else {
                            $('.goods_have').html('有货 ');
                            <?php if ($goods_detail['goods_base']['promotion'] && $goods_detail['goods_base']['promotion']['free_freight']){ ?>
                            $('.transport').html('');
                            <?php }else{?>
                            $('.transport').html(data.data.transport_str);
                            <?php }?>
                            $('a[nctype="buynow_submit"]').removeClass('no-buynow');
                            $('a[nctype="addcart_submit"]').removeClass('no-buynow');
                            $('.buy_box').show();
                            $('.notify_box').hide();
                        }
                    });

                } else {
                    if (calced_area[calc_area_id] === 'failure') {
                        $('.goods_have').html('无货');
                        $('.transport').html('');
                        $('a[nctype="buynow_submit"]').addClass('no-buynow');
                        $('a[nctype="addcart_submit"]').addClass('no-buynow');
                        $('#store-free-time').hide();
                    } else {
                        $('.goods_have').html('有货 ');
                        <?php if ($goods_detail['goods_base']['promotion'] && $goods_detail['goods_base']['promotion']['free_freight']){ ?>
                        $('.transport').html('');
                        <?php }else{?>
                        $('.transport').html(calced_area_transport[calc_area_id]);
                        <?php }?>

                        $('a[nctype="buynow_submit"]').removeClass('no-buynow');
                        $('a[nctype="addcart_submit"]').removeClass('no-buynow');
                        $('#store-free-time').show();
                    }
                }

                <?php }?>
            }
        });
    <?php }?>

    function consult()
    {
        window.location.href = window.location.href + "&from=consult";
    }
</script>

<!--分享-->
<script>
    var url = '';
    var txt = '';
    var pic = '';
    function SetShareUrl(cmd, config) {
        config.bdUrl = url;
        config.bdText = txt;
        config.bdPic = pic;
        return config;
    }
    window._bd_share_config = {
        common : {
            onBeforeClick: SetShareUrl,
            bdDesc : '淘尚168商城',
        },
        share : [{
            "bdSize" : 24,
            "bdCustomStyle":'<?= $this->view->css ?>/bdshare.css'
        }],
    }
    var share_type = 0;
    var share_id = 0;
    function share(t) {
        if(t.data('status')){
            $('.share-layer').show();
        }

        pic = t.data('pic');
        var share_all = new Array('sqq','qzone','weixin','weixin_timeline','tsina');
        var shared = JSON.parse(t.attr('data-shared'));
        var user_id = <?= Perm::$userId ? Perm::$userId : 0?>;

        <?php if($goods_detail['goods_base']['fu_flag']){ ?>
            share_type = 0;
            url = SITE_URL + "?ctl=Goods_Goods&met=goods&gid=" + t.data('id')+'&suid=' + user_id;
            txt = '送福免单--' + t.data('name');

            var fu_base = JSON.parse(t.attr('data-fu-base'));
            $.each(share_all,function (i,e) {
                var ht_content = '';
                var share_e = 0;
                if(shared && shared[e]){
                    share_e = shared[e];
                }
                ht_content = '<span>' + share_e + '/' + fu_base[e] + '</span>';
                $("#"+e).html(ht_content);
            });

            $('.sfmd').html(t.data('complete'));
            $('.fx_xq').show();
        <?php }else{?>
            if(t.data('type') == 0){
                share_type = 0;
                url = SITE_URL + "?ctl=Goods_Goods&met=goods&gid=" + t.data('id')+'&suid=' + user_id;
            }else if(t.data('type') == 1){
                share_type = 1;
                share_id = t.data('id');
                url = SITE_URL + "?ctl=Goods_Goods&met=bundling&bid=" + t.data('id')+'&suid=' + user_id;
            }

            <?php if($goods_detail['goods_base']['promotion'] && $goods_detail['goods_base']['promotion']['promotion_tips']){ ?>
                <?php if($goods_detail['goods_base']['promotion']['promotion_type'] == Goods_CommonModel::XINREN){?>
                    txt = "<?=$goods_detail['goods_base']['promotion']['promotion_tips']?>"+ t.data('shared-price') + '元包邮:' + t.data('name');
                <?php }else{?>
                    txt = "<?=$goods_detail['goods_base']['promotion']['promotion_tips']?>"+ t.data('shared-price') + '元抢到:' + t.data('name');
                <?php }?>
            <?php }else{?>
                txt = '分享最高可减' + t.data('price') + '--' + t.data('name');
            <?php }?>

            $.each(share_all,function (i,e) {
                var ht_content = '';
                if(shared && shared[e]){
                    ht_content = '<span>已减'+t.data(e)+'元</span>';
                }else{
                    ht_content = '立减<span>'+t.data(e)+'</span>元';
                }
                $("#"+e).html(ht_content);
            });

            var share_total_price = t.data('share-total-price');
            var is_promotion = t.data('is-promotion');
            var promotion_total_price = t.data('promotion-total-price');

            if(is_promotion){
                $('.fxlj').html(share_total_price +'元');
                $('.fxlz').html(promotion_total_price +'元');
                $('.fx_xq.f2').hide();
                $('.fx_xq.f1').show();
            }else{
                $('.fxlj').html(share_total_price +'元');
                $('.fx_xq.f1').hide();
                $('.fx_xq.f2').show();
            }
        <?php }?>

        $('#code').center();
        $('#sharecover').show();
        var top = document.body.scrollTop;
        $("#code").css({top:top+300});
        $('#code').fadeIn();
    }
    $(function () {
        var $this = null;
        var d_a = <?php if(!$goods_detail['goods_base']['fu_flag'] || $default_address){echo 'true';}else{echo 'false';}?>;
        $('.share').click(function() {
            if(d_a){
                share($(this));
            }else{
                if ($.cookie('key')) {
                    $this = $(this);
                    $.dialog({
                        title: '新建地址',
                        content: 'url: ' + SITE_URL + "?ctl=Buyer_Cart&met=resetAddress&typ=e&defalut=1",
                        height: 340,
                        width: 580,
                        lock: true,
                        drag: false
                    });
                }else{
                    $("#login_content").show();
                }
            }
        });
        $('#closebt').click(function() {
            $('#code').hide();
            $('#sharecover').hide();
        });
        $('#sharecover').click(function() {
            $('#code').hide();
            $('#sharecover').hide();
        });

        var t;
        $('.more').hover(function () {
            clearTimeout(t);
            $('.share_more').fadeIn();
        });
        $('.share_more').hover(function () {
            clearTimeout(t);
        });
        $('.more').mouseleave(function () {
            t = setTimeout(function() {
                $('.share_more').hide();
            },100);
        });
        $('.share_more').mouseleave(function () {
            t = setTimeout(function() {
                $('.share_more').hide();
            },100);
        });

        $('#code').hover(function () {
            $('.share_more').hide();
        });
        jQuery.fn.center = function(loaded) {
            var obj = this;
            body_width = parseInt($(window).width());
            body_height = parseInt($(window).height());
            block_width = parseInt(obj.width());
            block_height = parseInt(obj.height());

            left_position = parseInt((body_width / 2) - (block_width / 2) + $(window).scrollLeft());
            if (body_width < block_width) {
                left_position = 0 + $(window).scrollLeft();
            };

            top_position = parseInt((body_height / 2) - (block_height / 2) + $(window).scrollTop());
            if (body_height < block_height) {
                top_position = 0 + $(window).scrollTop();
            };

            if (!loaded) {

                obj.css({
                    'position': 'absolute'
                });
                obj.css({
                    'top': ($(window).height() - $('#code').height()) * 0.5,
                    'left': left_position
                });
                $(window).bind('resize', function() {
                    obj.center(!loaded);
                });
                $(window).bind('scroll', function() {
                    obj.center(!loaded);
                });

            } else {
                obj.stop();
                obj.css({
                    'position': 'absolute'
                });
                obj.animate({
                    'top': top_position
                }, 200, 'linear');
            }
        }

        $('.lj_xq').hover(function () {
            $('.lj').fadeIn();
            $('.ljl').css("display","block");
        }).mouseleave(function () {
            $('.lj').fadeOut();
            $('.ljl').fadeOut();
        });
        $('.lz_xq').hover(function () {
            $('.lz').fadeIn();
            $('.lzl').css("display","block");
        }).mouseleave(function () {
            $('.lz').fadeOut();
            $('.lzl').fadeOut();
        });

        var goods_id = Public.getQueryString("goods_id");
        var gid = Public.getQueryString("gid")?Public.getQueryString("gid"):goods_id;
        var cid = Public.getQueryString("cid");

        var suid = Public.getQueryString("suid");
        var from = Public.getQueryString("from");
        var type = Public.getQueryString("type");
        var hash = location.hash;

        var add_url    = '';
        var active_url = '';

        <?php if($goods_detail['goods_base']['fu_flag']){ ?>
        add_url = SITE_URL + "?ctl=Goods_Goods&met=addFu&typ=json";
        active_url = SITE_URL + "?ctl=Goods_Goods&met=activeFu&typ=json";
        <?php }else{?>
        add_url = SITE_URL + "?ctl=Goods_Goods&met=addShare&typ=json";
        active_url = SITE_URL + "?ctl=Goods_Goods&met=actShare&typ=json";
        <?php }?>

        if(suid > 0 && (gid > 0 || cid > 0) && (type=='app'||hash != "")){
            $.ajax({
                url: active_url ,
                type: 'get',
                dataType: 'json',
                data:{'gid':gid,'cid':cid,'suid':suid,'hash':hash,'from':from,'type':type},
                success: function(result) {
                    if (result.data.reg_type > 0){
                        var redirect = SITE_URL + '?ctl=Goods_Goods&met=goods&gid=' + result.data.gid;
                        var callback = SITE_URL + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(redirect);
                        if (result.data.reg_type == 1) {
                            //window.location.href = UCENTER_URL + '?ctl=Connect_Weibo&met=login&fu=1&callback=' + encodeURIComponent(callback);
                        } else if (result.data.reg_type == 2){
                            //window.location.href = UCENTER_URL + '?ctl=Connect_Qq&met=login&fu=1&callback=' + encodeURIComponent(callback);
                        } else if (result.data.reg_type == 3){
                            //window.location.href = UCENTER_URL + '?ctl=Connect_Weixin&met=login&fu=1&callback=' + encodeURIComponent(callback);
                        }
                    }
                }
            });
        }

        $('.bds_share').click(function(){
            var parm = '';
            if(share_type == 0){
                parm = {'gid':gid,'cid':cid};
            }else if(share_type == 1){
                parm = {'bid':share_id};
            }
            var cmd = $(this).data('cmd');
            $.ajax({
                url: add_url + "&type=" + cmd,
                type:'get',
                dataType:'json',
                data:parm,
                success:function (data) {
                    if(data.status == 200){
                    }
                }
            });
        });

        window.addAddress = function(val) {
            if(val.user_address_default == 1){
                default_address = true;
                if($this != null){
                    share($this);
                }
                Public.tips.success('添加成功');
            }
        }
    });

    //继续分享
    $(".share-layer .share-btns span.continue-share").click(function() {
        $(".share-layer").hide();
    });


    $(".goods_ranking ul li").on("mouseover", function() {
        var _this = $(this);
        _this.find(".selling_goods_img>span").show();
    }).on("mouseleave", function() {
        var _this = $(this);
        _this.find(".selling_goods_img>span").hide();
    })

</script>

<script type="text/javascript" charset="utf-8">
    $(function() {
        $("img").lazyload({skip_invisible : false,placeholder : "<?= $this->view->img ?>/grey.gif",threshold: 200,effect: "show",failurelimit : 10});
    });
</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>

    <link href="<?= $this->view->css ?>/goods-list.css" rel="stylesheet" type="text/css"
          xmlns="http://www.w3.org/1999/html">
    <script type="text/javascript" src="<?=$this->view->js?>/decoration/common.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/goods.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/angular.js"></script>
    <link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
    <link href="<?= $this->view->css ?>/login.css" rel="stylesheet">
    <link href="<?= $this->view->css ?>/goods.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/goods-detail.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/Group-integral.css"/>
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
    <style>
        .share_img:hover{cursor:pointer}
        .cl_content_ul li .tit{width:130px;height:36px;float:right;position:relative;border-radius:0;-webkit-transform-origin:10% 80%;-moz-transform-origin:10% 80%;-ms-transform-origin:10% 80%;-o-transform-origin:10% 80%;transform-origin:10% 80%}
        .cl_content_ul li .tit span{display:block;color:#fff}
        .goodslist_img3{overflow:hidden;width:160px;height:160px}
        .cr_xie li{height: auto;}
        .cr_xie li i{margin-top: 5px;}
        .cr_xie li em, .cr_xie li img.share_n, .cr_xie li img.book_s{position: static;}
        .cr_xie li img.share_n, .cr_xie li img.book_s{float: right;margin-right: 10px;}
        .cr_xie li .list_padd a.shopname{height: auto;padding-bottom: 0;}
        .cr_xie li .same-style-wrap{display:none;position: absolute;bottom:-90px;left:-1px;right:-1px;z-index: 1;background: #fff;border: 1px solid rgb(197, 30, 30);border-top:none;}
        .cr_xie li .same-style{float: none;margin-right: 0;width: 220px;margin:0 auto;}
        .cr_xie li .same-style i{margin:0;background-color: orange;color:#fff;}
        .cr_xie li .list_padd .same-style a{display: inline;color: #999;float: right;margin-right: 10px;width:auto;height: auto;padding: 0;}
        .cr_xie li .searched{width:220px;margin:0 auto;padding:5px 0;text-align: center;}
        .cr_xie li .searched .same-style-img img{width:60px;height: 60px;float: left;margin-right: 10px;}
        .cr_xie li .searched .same-style-img>div:after{content: '';display: table;clear: both;}
        .cr_xie li .pop{height: 100%;}
        .cr_xie li .searched .no-data{height: 60px;line-height: 60px;}
        .cr_xie li .list_padd:hover .same-style-wrap{display:block;}
        .list_padd .goods_promotion{clear:both;height:32px;}
    </style>
    <div class="hr">
    </div>

<?php if($cat_id){?>
    <div class="wrap">
        <div class="goods_list_intro clearfix">
            <h3><?=_('热卖推荐')?></h3>
            <ul>
                <?php foreach($hot_sale as $hkey => $hval):?>
                    <li>
                        <a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($hval['goods_id'])?>" class="goods_list_href">
                            <div class="goodslist_img2"><img width="100px"   class="lazy" data-original="<?=image_thumb($hval['common_image'],100,100)?>"/></div>
                        </a>
                        <p class="clearfix">
                            <a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($hval['goods_id'])?>" class="goods_list_name"><?=($hval['common_name'])?></a>
                            <span><?=_('价格：')?><strong><?=format_money($hval['common_price'])?></strong></span>
                            <a class='share_wrap share_wrap1'><span class='share'>分享减<u><?=format_money($hval['common_share_price'])?></u></span></a>
                            <?php if($hval['common_is_promotion']){?>
                                <a class='share_wrap share_wrap1'><span class='share'>分享赚<u><?=format_money($hval['common_promotion_price'])?></u></span></a>
                            <?php }?>
                            <a class="list_hot_intro bbc_btns"  target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($hval['goods_id'])?>" ><?=_('立即抢购')?></a>
                            <?php if($hval['common_promotion_type'] == Goods_CommonModel::HUIQIANGGOU){?>
                                <a class="list_hot_cheaper">惠</a>
                            <?php }?>
                        </p>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
    <div class="chead1 clearfix wrap">
        <span class="allresult">
            <?php if($parent_cat_id){
                if(count($parent_cat_id) == 1){  ?>
                    <a class="a_bold" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&cat_id=<?=($parent_cat_id[0]['cat_id'])?>"><?=($parent_cat_id[0]['cat_name'])?></a> <i class="iconfont icon-iconjiantouyou"></i> <span class="class_drap"><?=_('所有商品')?></span>
                <?php }else{ foreach($parent_cat_id as $key => $val){ ?>
                    <?php if($val['cat_parent_id'] == 0){?>
                        <a class="a_bold" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&cat_id=<?=($val['cat_id'])?>"><?=($val['cat_name'])?></a> <i class="iconfont icon-iconjiantouyou"></i>
                    <?php }else{?>
                        <span class="class_drap">
                            <strong><?=($val['cat_name'])?><i class="iconfont icon-iconjiantouxia"></i></strong>
                            <?php if(isset($val['silbing']) && $val['silbing']){?>
                                <p class="class_drap_more">
                                    <?php foreach($val['silbing'] as $cckey => $ccval){?>
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&cat_id=<?=($ccval['cat_id'])?>"><?=($ccval['cat_name'])?></a>
                                    <?php }?>
                                </p>
                            <?php }?>
                        </span>
                    <?php }?>
                <?php }} ?>
            <?php }?>
        </span>
    </div>
<?php }?>

<?php if($search){?>
    <div class="chead1 clearfix wrap">
            <span class="allresult">
                <a class="a_bold"><?=_('全部结果')?> <i class="iconfont icon-iconjiantouyou"></i> <span>"<?=($search)?>"</span></a>
            </span>
    </div>
<?php }?>

    <!--商品规格属性S-->
    <div class="clearfix wrap" id="div_property">
        <?php if($brand_row){?>
            <div class="cbrand clearfix class">
                <div class="cl_brand "><?=_('品牌:')?></div>
                <div class="cl_brand_name cl_brand_name_reset">
                    <?php foreach($brand_row as $bkey=> $bval){?>
                        <a  onclick="brand(<?=($bkey)?>)" <?php if($brand_id == $bkey){?> style="color:red;"<?php }?> ><?=($bval['brand_name'])?></a>
                    <?php }?>
                </div>
            </div>
        <?php }?>

        <?php if ( !empty($brand_property['search_property']) || !empty($brand_property['search_brand']) ) { ?>
            <input name="spec_flag" type="hidden" />
            <div class="cbrand class clearfix">
                <div class="cl_brand  "><?=_('您已选择')?></div>
                <div class="cl_brand_name">
                    <?php if ( !empty($brand_property['search_brand']) ) { ?>
                        <span class="selected_1" nctype="span_filter_brand"><?=_('品牌:')?><em class="bbc_color"><?= $brand_property['search_brand']['brand_name'] ?></em><i class="iconfont icon-cuowu"></i></span>
                    <?php } ?>

                    <?php if ( !empty( $brand_property['search_property']) ) { ?>
                        <input name="spec_flag" type="hidden" />
                        <?php foreach ( $brand_property['search_property'] as $propery_id => $property_data ) { ?>
                            <span class="selected_1" nctype="span_filter" data-property_id="<?= $propery_id ?>" data-property_value_id="<?= $property_data['property_value_id'] ?>"><?= $property_data['property_name'] ?>: <em class="bbc_color"><?= $property_data['property_value_name'] ?></em><i class="iconfont icon-cuowu"></i></span>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if ( !empty($brand_property['brand_list']) ) { ?>
            <input name="spec_flag" type="hidden" />
            <div class="cbrand clearfix class">
                <div class="cl_brand cl_brand0"><?=_('品牌:')?></div>
                <div class="cl_brand_name">
                    <ul class="clearfix">
                        <?php foreach ($brand_property['brand_list'] as $key => $brand_data) { ?>
                            <li class="clearfix">
                                <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&cat_id=<?= $cat_id ?>&brand_id=<?= $brand_data['brand_id'] ?>&<?= $brand_property['search_string'] ?>">
                                    <img class="lazy" data-original="<?= $brand_data['brand_pic'] ?>" alt="<?= $brand_data['brand_name'] ?>">
                                </a>
                                <span><?= $brand_data['brand_name'] ?></span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>

        <?php if ( !empty($brand_property['child_cat']) ) { ?>
            <div class="cbrand class clearfix">
                <div class="cl_brand"><?=_('下级分类:')?></div>
                <div class="cl_brand_name">
                    <?php foreach ($brand_property['child_cat'] as $key => $child_cat_data) { ?>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&cat_id=<?= $child_cat_data['cat_id'] ?>"><?= $child_cat_data['cat_name']; ?></a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if ( !empty($brand_property['property']) ) { ?>
            <?php foreach ($brand_property['property'] as $key => $property_data) { ?>
                <div class="cbrand class clearfix">
                    <div class="cl_brand"><?= $property_data['property_name']; ?>:</div>
                    <div class="cl_brand_name">
                        <ul class="cl_brand_ul">
                            <?php foreach ($property_data['property_values'] as $k => $property_value_data) { ?>
                                <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&cat_id=<?= $cat_id ?>&property_id=<?= $property_data['property_id'] ?>&property_value_id=<?= $property_value_data['property_value_id'] ?>&<?= $brand_property['search_string'] ?>"><?= $property_value_data['property_value_name']; ?></a>
                            <?php } ?>
                        </ul>
                        <div class="cl_brand_more">
                            <a class="sl_e_more" href="javascript:;">更多<i></i></a>
                        </div>
                    </div>

                </div>
            <?php } ?>
        <?php } ?>
    </div>

<?php if($s_more_display){ ?>
    <div class="s-more">
        <span class="sm-wrap">更多选项<i></i></span>
    </div>
<?php }?>
    <!--商品规格属性E-->

    <!-- 内容部分 -->
    <div class="wrap clearfix lists_all">
        <!--左边  -->
        <div class="cleft clearfix">
            <div class="cleft_top">
                <h4 class="cleft_h4"><?=_('推广商品')?></h4>
                <div class="cl_content">
                    <ul class="cl_content_ul">
                        <?php foreach($recommend_row as $rekey => $reval):?>

                            <li>
                                <a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($reval['goods_id'])?>" target="_blank" class="cr_xie_name" title="<?=($val['common_name'])?>" class="cr_xie_lia1">
                                    <div class="goodslist_img3">
                                        <img style="width:160px;height:160px;" class="lazy" data-original="<?=image_thumb($reval['common_image'],160,160)?>">
                                        <div class="tit">
                                            <span>分享约减</span>
                                            <span><?=format_money($reval['common_share_price'])?></span>
                                        </div>
                                    </div>
                                </a>
                                <a class="cr_xie_span0" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($reval['goods_id'])?>">
                                    <?php if(mb_strwidth($reval['common_name'], 'utf8')>40){
                                        echo $str = mb_strimwidth($reval['common_name'], 0, 40, '...', 'utf8');
                                    }else{echo $reval['common_name'];}?>                               </a>
                                <span class="cr_xie_mon bbc_color"> <span class="cr_xie_mon_name"></span><span style="color:#333;">减免价</span><?=format_money($reval['common_shared_price'])?> </span> <p> <span class="cr_xie_argue ">专柜价:<?=format_money($reval['common_price'])?></span> </p>
                                <?php if($reval['common_is_promotion']){ ?>
                                    <p class="share_wrap">
                                        <span class="share">赚<u><?=format_money($reval['common_promotion_price'])?></u></span>
                                    </p>
                                <?php }?>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>

        </div>
        <!-- 右边 -->
        <div class="cright clearfix">
            <div class="cr_head">
                <div class="crhead1 clearfix">
                    <div class="crhead1_line">
                        <div class="<?php if($act == '' || $act == 'sale'):?>crhead1_line_red bbc_bg<?php else:?>crhead1_line_white<?php endif;?>" >
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&act=sale&cat_id=<?=request_int('cat_id')?>&actorder=<?=$next_order?><?php if($search){?>&keywords=<?=$search?><?php }?><?php if($searchkey){?>&searkeywords=<?=$searchkey?><?php }?>" title="<?php if($actorder === 'desc'){?>点击按销量升序<?php }else{ ?>点击按销量降序<?php }?>"><?=_('销量')?><span id='sale_icon_jiantou' class="iconfont <?php if($actorder === 'asc'  && $act === 'sale'){?>icon-iconjiantoushang<?php }else{?>icon-iconjiantouxia<?php } ?>"></a>
                        </div>
                        <div class="<?php if( $act == 'all'):?>crhead1_line_red bbc_bg<?php else:?>crhead1_line_white<?php endif;?>">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&act=all&cat_id=<?=request_int('cat_id')?>&actorder=<?=$next_order?><?php if($search){?>&keywords=<?=$search?><?php }?><?php if($searchkey){?>&searkeywords=<?=$searchkey?><?php }?>" title="<?php if($actorder === 'desc'){?>点击按上架时间升序<?php }else{ ?>点击按上架时间降序<?php }?>"><?=_('上架时间')?><span id='all_icon_jiantou' class="iconfont <?php if($actorder === 'asc' && $act === 'all'){?>icon-iconjiantoushang<?php }else{?>icon-iconjiantouxia<?php } ?>"></a>
                        </div>
                        <div class="<?php if($act == 'price'):?>crhead1_line_red bbc_bg<?php else:?>crhead1_line_white<?php endif;?>" >
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&act=price&cat_id=<?=request_int('cat_id')?>&actorder=<?=$next_order?><?php if($search){?>&keywords=<?=$search?><?php }?><?php if($searchkey){?>&searkeywords=<?=$searchkey?><?php }?>" title="<?php if($actorder === 'desc'){?>点击按价格升序<?php }else{ ?>点击按价格降序<?php }?>"><?=_('价格')?><span id='price_icon_jiantou' class="iconfont <?php if($actorder === 'asc'  && $act === 'price'){?>icon-iconjiantoushang<?php }else{?>icon-iconjiantouxia<?php } ?>"></a>
                        </div>
                        <div class="<?php if($act == 'evaluate'):?>crhead1_line_red bbc_bg<?php else:?>crhead1_line_white<?php endif;?>" >
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&act=evaluate&cat_id=<?=request_int('cat_id')?>&actorder=<?=$next_order?><?php if($search){?>&keywords=<?=$search?><?php }?><?php if($searchkey){?>&searkeywords=<?=$searchkey?><?php }?>" title="<?php if($actorder === 'desc'){?>点击按评论数升序<?php }else{ ?>点击按评论数降序<?php }?>"><?=_('评论数')?><span id='evaluate_icon_jiantou' class="iconfont <?php if($actorder === 'asc' && $act === 'evaluate'){?>icon-iconjiantoushang<?php }else{?>icon-iconjiantouxia<?php } ?>"></a>
                        </div>
                    </div>
                    <div class="crhead1_search">
                        <input type="text" placeholder="<?=_('搜索词')?>" name="search" id="search" value="<?=($searchkey)?>"/><a onclick="searchgoods()">确定</a>
                    </div>
                </div>
                <div class="crhead2 clearfix">
                    <p class="crhead2_text1">
                        <?=_('配送至')?>
                    </p>
                    <p class="crhead2_caddress">
                    <div id="ncs-freight-selector" class="ncs-freight-select">
                        <div class="text">
                            <div><?=$transport_area?></div>
                            <b>∨</b>
                        </div>
                        <div class="content">
                            <div id="ncs-stock" class="ncs-stock" data-widget="tabs">
                                <div class="mt">
                                    <ul class="tab">
                                        <li data-index="0" data-widget="tab-item" class="curr"><a href="#none" class="hover"><em><?=_('请选择')?></em><i> ∨</i></a></li>
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
                    </p>
                    <p class="crhead2_ways">
                        <input type="checkbox" class="checkbox rel_top-1" <?php if($op1 == 'havestock'){?>checked<?php }?> name="op1" /> <label><?=_('仅显示有货')?></label>
                        <input type="checkbox" class="checkbox rel_top-1" <?php if($op2 == 'active'){?>checked<?php }?> name="op2" /> <label><?=_('仅显示促销商品')?></label>
                        <input type="checkbox" class="checkbox rel_top-1" <?php if($op3 == 'ziying'){?>checked<?php }?> name="op3" /> <label><?=_('平台自营')?></label>
                        <?php if(Web_ConfigModel::value('subsite_is_open')){?>
                            <input type="checkbox" class="checkbox rel_top-1" <?php if($op4 == 'localgoods'){?>checked<?php }?> name="op4" /> <label><?=_('仅显示本站商品')?></label>
                        <?php }?>
                    </p>

                </div>
            </div>
            <!-- 商品信息 start -->
            <ul class="cr_xie clearfix" >
                <?php if($data['items']): foreach($data['items'] as $key => $val):?>
                    <li>
                        <div class="goodslist_img">
                            <img class="lazy_img" data-original="<?=image_thumb($val['common_image'],220,220)?>" width="220" height="220"/>
                        </div>
                        <span class="sub del">
                            <?php if($val['product_distributor_flag'] && $val['goods_recommended_max_price'] > $val['common_price']){?>
                                <?=format_money($val['goods_recommended_max_price'])?>
                            <?php }else{?>
                                <?=format_money($val['common_price'])?>
                            <?php }?>
                        </span>
                        <span class="cr_xie_mon bbc_color">
                            <?php if($val['promotion_price']){?>
                                <?=format_money($val['promotion_price'])?>
                            <?php }else{?>
                                <?=format_money($val['common_shared_price'])?>
                            <?php }?>
                        </span>
                        <span class="cr_xie_amon"></span>
                        <div class="list_padd">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$val['goods_id']?>" target="_blank" class="cr_xie_name" title="<?=($val['common_name'])?>">
                                <?=$val['common_name']?>
                            </a>
                            <p class='share_wrap'><span class='share'>分享立减<u><?=format_money($val['common_share_price'])?></u></span></p>
                            <?php if($val['common_is_promotion']){?>
                                <p class='share_wrap'>
                                    <span class='share'>分享立赚<u><?=format_money($val['common_promotion_price'])?></u></span>
                                </p>
                            <?php }?>
                            <div class="goods_promotion">
                                <?php if($val['shop_self_support']){?><i>自营</i><?php }?>
                                <!--0未参加活动 1惠抢购 2限时折扣 3手机专享 4新人优惠-->
                                <?php if($val['common_promotion_type'] == Goods_CommonModel::HUIQIANGGOU){?><i>惠</i><?php }else{}?>
                                <?php if($val['common_promotion_type'] == Goods_CommonModel::XIANSHI){?><i>限时</i><?php }else{}?>
                                <?php if($val['common_promotion_type'] == Goods_CommonModel::SHOUJI){?><i>手机</i><?php }else{}?>
                                <?php if($val['common_promotion_type'] == Goods_CommonModel::XINREN){?><i>新</i><?php }else{}?>
                                <?php if($val['is_man'] == 1){?><i>满</i><?php }else{}?>
                                <?php if($val['common_is_jia'] == 1){?><i>加</i><?php }else{}?>
                            </div>
                            <em>评分：
                                <?php for($i = 0;$i<$val['goods_evaluation_good_star'];$i++){?>
                                    <img src="<?=$this->view->img?>/goods/star_y.png" alt="">
                                <?php }?>
                            </em>

                            <img src="<?=$this->view->img?>/goods/<?php if($val['is_favorite']){?>book_n.png<?php }else{?>book_s.png<?php }?>" alt="" class="book_s share_img cllectGoods" id="coll_<?=(@$val['goods_id'])?>" data-cflag="<?=$val['is_favorite']?>" data-goods_id="<?=$val['goods_id']?>">

                            <img src="<?=$this->view->img?>/goods/share_n.png" alt="" class="share_n share share_img" prices='<?=json_encode($val["share_info"])?>' gid="<?=$val['goods_id']?>" gimg="<?=$val['common_image']?>" gname="<?=$val['common_name']?>" sum_prices="<?=$val['common_share_price']?>">

                            <a class='shopname' href="<?=YLB_Registry::get('url').'?ctl=Shop&met=index&typ=e&id='.$val['shop_id']?>" style="font-size:15px;margin-top:5px;text-align:center" >
                                <?=$val['shop_name']?>
                            </a>
                            <div class="same-style-wrap">
                                <p class="same-style">
                                    <i class="huo">货</i>
                                    <span><b style="color: #c51e1e;font-weight: normal;">工厂联盟</b>同款/相似款</span>
                                    <a href="">更多&nbsp;></a>
                                </p>
                                <div class="searched">
                                    <div class="same-style-img">
                                        <div style="width: 210px;margin:0 auto;padding:0 5px;">
                                            <img src="https://img.alicdn.com/bao/uploaded/i2/2683428516/TB2iXatXsrHK1JjSspdXXXNFpXa_!!2683428516.jpg">
                                            <img src="https://img.alicdn.com/bao/uploaded/i2/2683428516/TB2iXatXsrHK1JjSspdXXXNFpXa_!!2683428516.jpg">
                                            <img src="https://img.alicdn.com/bao/uploaded/i2/2683428516/TB2iXatXsrHK1JjSspdXXXNFpXa_!!2683428516.jpg">
                                        </div>
                                    </div>
                                    <!-- <div class="no-data">在<span class="shop-name" style="color:orange;">1688</span>没有找到货源</div> -->
                                </div>
                            </div>

                            <div style="clear:both"></div>

                        </div>
                        <div class='pop'>
                            <div class='pop_top' onclick="window.open('<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$val['goods_id']?>')">
                            </div>
                            <div class='pop_bottom gotoGoodsInfo' >
                                <img class="erweima gotoGoodsInfo" src="" data-src="<?=YLB_Registry::get('base_url')?>/shop/api/qrcode.php?data=<?=urlencode(YLB_Registry::get('base_url')."/?ctl=Goods_Goods&met=goods&type=goods&gid=".$val['goods_id'])?>" onclick="window.open('<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$val['goods_id']?>')"/>

                                <img src="<?=$this->view->img?>/goods/share2.png" alt="" class="share share_img" prices='<?=json_encode($val["share_info"])?>' gid="<?=$val['goods_id']?>" gimg="<?=$val['common_image']?>" gname="<?=$val['common_name']?>" sum_prices="<?=$val['share_total_price']?>">

                                <p class='share_wrap gotoGoodsInfo'>
                                    <span class='share gotoGoodsInfo'>分享立减<u><?=format_money($val['common_share_price'])?></u></span>
                                </p>
                                <br>
                                <i class="gotoGoodsInfo">分享获得点击后，购买此商品最高减免
                                    <span style="color:#c51e1e;" class="gotoGoodsInfo">
                                        <?=format_money($val['common_share_price'])?>
                                    </span>
                                </i>
                                <p class='share_wrap gotoGoodsInfo'>
                                    <span class='share gotoGoodsInfo'>分享立赚<u>
                                            <?=format_money($val['common_promotion_price'])?></u>
                                    </span>
                                </p>
                                <br>
                                <i class="gotoGoodsInfo">分享后此商品有成交，最高可得
                                    <span style="color:#c51e1e;" class="gotoGoodsInfo">
                                        <?=format_money($val['common_promotion_price'])?>
                                    </span>点击推广金
                                </i>
                            </div>
                        </div>
                    </li>
                <?php 	endforeach;?>
            </ul>
            <nav class="page page_front">
                <?=$page_nav?>
            </nav>
            <?php else: ?>
                <div class="no_account">
                    <img src="<?= $this->view->img ?>/ico_none.png"/>
                    <p><?= _('暂无符合条件的数据记录') ?></p>
                </div>
            <?php endif; ?>
            <!-- 商品信息 end  -->
        </div>
    </div>
    <div class="wrap">
        <div class="cjd_footer clearfix">
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

    <script>
        function contains(arr, str) {//检测goods_id是否存入
            var i = arr.length;
            while (i--) {
                if (arr[i] == str) {
                    return true;
                }
            }
            return false;
        }
        //加入购物车
        window.addCart = function(e,i)
        {
            if ($.cookie('key'))
            {
                if(i == 1)
                {
                    Public.tips.error('<?=_('不能购买自己的商品')?>');
                }else
                {
                    $.ajax({
                        url: SITE_URL + '?ctl=Buyer_Cart&met=addCart&typ=json',
                        data: {goods_id:e, goods_num: 1},
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

            }
            else
            {
                $("#login_content").show();
            }
        }

        //立即购买虚拟商品
        window.nowBuy = function(e,i)
        {
            if ($.cookie('key'))
            {
                if(i == 1)
                {
                    Public.tips.error('<?=_('不能购买自己的商品！')?>');
                }else
                {
                    window.location.href = SITE_URL + '?ctl=Buyer_Cart&met=buyVirtual&goods_id=' + e+'&goods_num=1';
                }

            }
            else
            {
                $("#login_content").show();

                /*login_url   = UCENTER_URL + '?ctl=Login&met=index&typ=e';


                 callback = SITE_URL + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(window.location.href);


                 login_url = login_url + '&from=shop&callback=' + encodeURIComponent(callback);

                 window.location.href = login_url;*/
            }
        }

        //收藏/取消收藏 商品 @刘贵龙 20170630
        $('.cllectGoods').bind('click',function(){

            if ($.cookie('key'))
            {
                var cflag = $(this).data('cflag');
                var goods_id = $(this).data('goods_id');
                if(cflag == 1){
                    $.post(SITE_URL  + '?ctl=Goods_Goods&met=canleCollectGoods&typ=json',{goods_id:goods_id},function(data)
                    {
                        if(data.status == 200)
                        {
                            Public.tips.error('取消收藏成功!');
                            $("#coll_"+goods_id).attr('src','<?=$this->view->img?>/goods/book_s.png');
                            $("#coll_"+goods_id).data('cflag',0);
                        } else {
                            Public.tips.error(data.data.msg);
                        }
                    });
                }else{
                    $.post(SITE_URL  + '?ctl=Goods_Goods&met=collectGoods&typ=json',{goods_id:goods_id},function(data)
                    {
                        if(data.status == 200)
                        {
                            Public.tips.success('收藏成功!');
                            $("#coll_"+goods_id).attr('src','<?=$this->view->img?>/goods/book_n.png');
                            $("#coll_"+goods_id).data('cflag',1);
                        } else {
                            Public.tips.error(data.data.msg);
                        }
                    });
                }
            } else {
                $("#login_content").show();
            }
        })


        $(".checkbox").bind("click", function (){
            var _self = this;
            if(_self.checked)
            {
                if($(this).attr('name') == 'op1')
                {
                    checkbox('op1','havestock');
                }
                if($(this).attr('name') == 'op2')
                {
                    checkbox('op2','active');
                }
                if($(this).attr('name') == 'op3')
                {
                    checkbox('op3','ziying');
                }
                if($(this).attr('name') == 'op4')
                {
                    checkbox('op4','localgoods');
                }
            }else{
                if($(this).attr('name') == 'op1')
                {
                    checkbox('op1','');
                }
                if($(this).attr('name') == 'op2')
                {
                    checkbox('op2','');
                }
                if($(this).attr('name') == 'op3')
                {
                    checkbox('op3','');
                }
                if($(this).attr('name') == 'op4')
                {
                    checkbox('op4','');
                }
            }
        });

        //仅显示有货，仅显示促销商品
        function checkbox(a,e)
        {
            //地址中的参数
            var params= window.location.search;
            params = changeURLPar(params,a,e);
            window.location.href = SITE_URL + params;
        }
        //搜索商品
        function searchgoods()
        {
            var searchstr = $("#search").val();

            //地址中的参数
            var params= window.location.search;

            params = changeURLPar(params,'searkeywords',searchstr);


            window.location.href = SITE_URL + params;
        }

        //品牌
        function brand(e)
        {
            //地址中的参数
            var params= window.location.search;

            params = changeURLPar(params,'brand_id',e);


            window.location.href = SITE_URL + params;
        }

        //分类
        function cat(e)
        {
            //地址中的参数
            var params= window.location.search;

            params = changeURLPar(params,'cat_id',e);

            window.location.href = SITE_URL + params;
        }

        function changeURLPar(destiny, par, par_value)
        {
            var pattern = par+'=([^&]*)';
            var replaceText = par+'='+par_value;
            if (destiny.match(pattern))
            {
                var tmp = new RegExp(pattern);
                tmp = destiny.replace(tmp, replaceText);
                return (tmp);
            }
            else
            {
                if (destiny.match('[\?]'))
                {
                    return destiny+'&'+ replaceText;
                }
                else
                {
                    return destiny+'?'+replaceText;
                }


            }
            return destiny+'\n'+par+'\n'+par_value;
        }

        //商品筛选
        $(function () {
            $('.cl_brand_name').on('click', '[nctype="span_filter"]', function (){
                var href_string = location.href,
                    property_id = $(this).data('property_id'),
                    property_value_id = $(this).data('property_value_id');

                var exceReg = "href_string.replace(/search_property\\[" + property_id +"\\]=" + property_value_id + "&/, '')";
                href_string = eval(exceReg);

                exceReg = "href_string.replace(/property_id=" + property_id + "&/, '')";
                href_string = eval(exceReg);

                exceReg = "href_string.replace(/property_value_id=" + property_value_id + "&/, '')";
                href_string = eval(exceReg);

                location.href = href_string;
            });

            $('.cl_brand_name').on('click', '[nctype="span_filter_brand"]', function (){
                location.href = location.href.replace(/brand_id=\d+&/, '');
            })
        })
    </script>

    <script>
        $(function () {
            var $rotate = 45;   //旋转45deg
            $(".cl_content_ul li .tit").css({"transform":"rotate(" + $rotate + "deg)"});
            $(".cl_content_ul li .tit").css({"-webkit-transform":"rotate(" + $rotate + "deg)"});
            $(".cl_content_ul li .tit").css({"-moz-transform":"rotate(" + $rotate + "deg)"});
            $(".cl_content_ul li .tit").css({"-ms-transform":"rotate(" + $rotate + "deg)"});
            $(".cl_content_ul li .tit").css({"-o-transform":"rotate(" + $rotate + "deg)"});

            var M11 = Math.cos($rotate * (Math.PI / 180));
            var M12 = -Math.sin($rotate * (Math.PI / 180));
            var M21 = Math.sin($rotate * (Math.PI / 180));
            var M22 = Math.cos($rotate * (Math.PI / 180));

            var rot = $rotate * (Math.PI / 180);
            var Dx=0, Dy=0;
            $(".cl_content_ul li .tit").css({"filter":"progid:DXImageTransform.Microsoft.Matrix(Dx="+Dx+",Dy="+Dy+",M11=" + M11 + ",M12=" + M12 + ",M21=" + M21 + ",M22=" + M22 + ",SizingMethod='auto expand')","top":"-192px","right":"-48px"});
        });
    </script>

    <script>
        var $cur_area_list,$cur_tab,next_tab_id = 0,cur_select_area = [],calc_area_id = '',calced_area = [],calced_area_transport = [],cur_select_area_ids =[];
        $(document).ready(function(){
            var goodslist_area_name = $.cookie('goodslist_area_name');

            $("#ncs-freight-selector").click(function() {
                $.post(SITE_URL  + '?ctl=Base_District&met=getAllDistrict&typ=json',function(data)
                    {
                        nc_a = data.data;
                        $cur_tab = $('#ncs-stock').find('li[data-index="0"]');
                        _loadArea(0);
                    }
                );

                $(this).addClass("hover");
                /*$(this).on('mouseleave',function(){
                 $(this).removeClass("hover");
                 _calc();
                 });*/
            });

            $('ul[class="area-list"]').on('click','a',function(){
                $('#ncs-freight-selector').unbind('click');
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
                    $.cookie('goodslist_area_id',area_id);
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
                            nc_a = data;
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
                    //点击第一二级时，已经到了最后一级
                    $cur_tab.find('a').addClass('hover');
                    $('#ncs-freight-selector > div[class="text"] > div').html(cur_select_area);
                    $('#ncs-freight-selector').removeClass("hover");
                    _calc();
                }
            }

            //根据选择的区域，计算运费模板。
            function _calc() {
                //需要请求配送区域设置
                calc_area_id = $('li[data-index="1"]').find("em").attr("data_value");

                calc_area = $("#ncs-freight-selector").find(".text div").html();
                $.cookie('goodslist_area_name',calc_area);
                var params= window.location.search;

                params = changeURLPar(params,'transport_id',calc_area_id);
                params = changeURLPar(params,'transport_area',calc_area);

                window.location.href = SITE_URL + params;
            }
        });

        $(function(){
            if ( !$('#div_property').html().replace(/(<!--[\s\S]*-->)|\s*/g, '') ) {
                $('#div_property').remove();
            }
        })
    </script>

    <script>
        $(".btn-close").click(function (){
            $("#login_content").hide();

            $(".msg-wrap").hide();
            $('.lo_user_account').val("");
            $('.lo_user_password').val("");
        });

        $("#formlogin").keydown(function(e){
            var e = e || event,
                keycode = e.which || e.keyCode;

            if(keycode == 13)
            {
                loginSubmit();
            }
        });

        //检验验证码是否正确

        //登录按钮
        function loginSubmit()
        {
            var user_account = $('.lo_user_account').val();
            var user_password = $('.lo_user_password').val();

            $("#loginsubmit").html('正在登录...');

            login_url = UCENTER_URL+'?ctl=Api&met=login&user_account='+user_account+'&user_password='+user_password;

            login_url = login_url + '&from=shop&callback=' + encodeURIComponent(window.location.href);

            window.location.href = login_url;
        }
    </script>

    <script>
        /*Zhenzh*/
        $(document).ready(function () {
            $('.s-more').on('click','.sm-wrap',function () {
                $('#div_property').css('max-height','none');
                $(this).addClass('opened');
                $(this).html('收起<i></i>');
            }).on('click','.opened',function () {
                $('#div_property').css('max-height','361px');
                $(this).removeClass('opened');
                $(this).html('更多选项<i></i>');
            });
            $('.cbrand').each(function (i) {
                var pwidth = $(this).find('.cl_brand_name').width();
                var la = $(this).find('.cl_brand_ul').children();
                var width = 0;
                $.each(la,function (index){
                    width +=la[index].offsetWidth;
                });
                if(width > pwidth){
                    $(this).find('.cl_brand_more').show();
                }
            });
            $('.cl_brand_more').on('click','.sl_e_more',function () {
                $(this).parent().parent().css('height','auto');
                $(this).addClass('opened');
                $(this).html('收起<i></i>');
            }).on('click','.opened',function () {
                $(this).parent().parent().css('height','35px');
                $(this).removeClass('opened');
                $(this).html('更多<i></i>');
            });
        });
    </script>

    <!--分享立减 Dom-->
    <div id="sharecover" style="display:none">
        <span class="mask"></span>
    </div>
    <div id="code">
        <div class="close">
            <span>分享有礼</span>
            <a href="javascript:void(0)" id="closebt">
                <img src="<?=$this->view->img?>/close.png" alt="">
            </a>
        </div>
        <div class="sharetxt">
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

            <p>我要分享到:</p>
            <div class="share_c">
                <div class="bdsharebuttonbox" data-tag="share_1">
                    <span style="display:none" id="gid"></span>
                    <span style="display:none" id="gimg"></span>
                    <span style="display:none" id="gname"></span>
                    <span style="display:none" id="sum_prices"></span>
                    <div class="share_d">
                        <a class="bds_share bds_sqq" data-cmd="sqq"></a>
                        <p>QQ好友</p>
                        <p>立减<span id="share_sqq"></span>元</p>
                    </div>
                    <div class="share_d">
                        <a class="bds_share bds_qzone" data-cmd="qzone"></a>
                        <p>QQ空间</p>
                        <p>立减<span id="share_qzone"></span>元</p>
                    </div>
                    <div class="share_d">
                        <a class="bds_share bds_weixin" data-cmd="weixin"></a>
                        <p>微信好友</p>
                        <p>立减<span id="share_weixin"></span>元</p>
                    </div>
                    <div class="share_d">
                        <a class="bds_share bds_weixin_timeline" data-cmd="bds_weixin_timeline"></a>
                        <p>微信朋友圈</p>
                        <p>立减<span id="share_weixin_timeline"></span>元</p>
                    </div>
                    <div class="share_d">
                        <a class="bds_share bds_tsina" data-cmd="tsina"></a>
                        <p>新浪微博</p>
                        <p>立减 <span id="share_tsina"></span>元</p>
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

                <script>
                    function GetQueryString(name)
                    {
                        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                        var r = window.location.search.substr(1).match(reg);
                        if(r!=null) return  unescape(r[2]); return null;
                    }
                    function SetShareUrl(cmd, config) {
                        var gid = $('#gid').html();
                        var img_url = $('#gimg').html();
                        var sum_prices = $('#sum_prices').html();
                        var gname = $('#gname').html();
                        config.bdDesc = '淘尚168商城';
                        config.bdText = '分享最高可减'+sum_prices+'--'+gname;
                        config.bdPic = img_url;
                        config.bdUrl = "http://www.taoshang168.com/taoshangbbc/shop/index.php?ctl=Goods_Goods&met=goods&gid=" + gid + '&suid=' + <?=Perm::$userId?>;
                        return config;
                    }
                    window._bd_share_config = {
                        common : {
                            onBeforeClick: SetShareUrl,
                        },
                        share : [{
                            "bdSize" : 24,
                            "bdCustomStyle":'<?= $this->view->css ?>/bdshare.css'
                        }],
                        slide : [{
                            bdImg : 0,
                            bdPos : "left",
                            bdTop : 100
                        }],
                    }
                    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
                </script>

            </div>
            <div class="share_xx"></div>
            <div class="sharefoot">
                <?php if($goods_detail['goods_base']['share_info']['is_promotion']){?>
                    <div class="s_ljz">
                        <span class="sp1">1.分享立减：</span>
                        <span  class="sp2">将商品链接分享至相关平台可获得相应减免额度<span class="lj_xq" >（详情）</span></span>
                        <span class="ljl red_line"></span>
                    </div>
                    <div class="s_ljz">
                        <span  class="sp1">2.分享立赚：</span>
                        <?/*= $goods_detail['goods_base']['share_info']['promotion_total_price'] */?>
                        <span  class="sp2 ">将商品链接分享至相关平台可获得相应点击推广金<span class="lz_xq" >（详情）</span></span>
                        <span class="lzl red_line"></span>
                    </div>
                <?php }else{ ?>
                    <div>
                        <span class="sp1">分享立减：</span><span  class="sp2">将商品链接分享至相关平台可获得相应减免额度<span class="lj_xq" >（详情）</span></span></div>
                <?php } ?>
            </div>

        </div>
    </div>

    <!--分享立减 Js-->
    <script>
        $(function(){
            $('.share').on('click',function(){
                var prices = JSON.parse($(this).attr('prices'));
                var sum_prices = $(this).attr('sum_prices');
                var gid = $(this).attr('gid');
                var gimg = $(this).attr('gimg');
                var gname = $(this).attr('gname');
                $('#share_sqq').html(prices.sqq);
                $('#share_qzone').html(prices.qzone);
                $('#share_weixin').html(prices.weixin);
                $('#share_weixin_timeline').html(prices.weixin_timeline);
                $('#share_tsina').html(prices.tsina);
                $('#gid').html(gid);
                $('#gimg').html(gimg);
                $('#gname').html(gname);
                $('#sum_prices').html(sum_prices);

                $("#code").center();
                $('#sharecover').show();
                var top = document.body.scrollTop;
                $("#code").css({top:top+300})
                $("#code").fadeIn();
            })

            $('#closebt').on('click',function(){
                $('#code').hide();
                $('#sharecover').hide();
            })
            $('#sharecover').click(function() {
                $('#code').hide();
                $('#sharecover').hide();
            });
            $('.more').hover(function () {
                $('.share_more').fadeIn();
            });
            $('.share_more').mouseleave(function () {
                $('.share_more').hide();
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
        })
    </script>

    <script type="text/javascript" charset="utf-8">
        $(function() {
            $("img.lazy").lazyload({skip_invisible : false,placeholder : "<?= $this->view->img ?>/grey.gif",threshold: 100,effect: "show",failurelimit : 2});
            $("img.lazy_img",".cr_xie").lazyload({skip_invisible : false,placeholder : "<?= $this->view->img ?>/grey.gif",threshold: 100,effect: "show",failurelimit : 2});
        });
    </script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
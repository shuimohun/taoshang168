<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'fresh_header.php';
?>

<style>
    .mjms{
        text-align:center;
        margin:0 auto;
    }
    .share_wrap{
        float:left;
        margin-right:10px;
        margin-top:-10px;
    }
    .share{
        width:100px;
        height:18px;
        border:1px solid #c51e1e;
        font-size:12px;
        color:#c51e1e;
        text-align:center;
    }
    .share u{
        text-decoration:none;
        background-color:#c51e1e;
        color:#fff;
    }
    .list_padd i{
        float: left;
        margin-top: .6rem;
        background-color: #7884a3;
        margin-right: 5px;
        padding: 0 3px 0 3px;
        color: #fff;
        position: absolute;
        bottom: 13.7%;
    }

    /*推广商品*/
    .cl_content_ul li {
        position: relative;
        overflow:hidden;
    }
    .tit{
        transform: rotate(45deg);
        top: -189px;
        right: -45px;
        width: 130px;
        height: 33px;
        float: right;
        position: relative;
        border-radius: 0;
        transform-origin: 10% 80%;
        background-color: #c51e1e;
        color: #fff;
        text-align: center;
        font-size: 12px;
    }
    .tit span {
        display: block;
        color: #fff;
    }
    .share_wrap_tg{
        float:right;
        margin-left:10px;
        margin-top:-20px;
    }
    .share_tg{
        width:100px;
        height:18px;
        border:1px solid #c51e1e;
        font-size:12px;
        color:#c51e1e;
        text-align:center;
    }
    .share_tg u{
        text-decoration:none;
        background-color:#c51e1e;
        color:#fff;
    }
</style>

    <link href="<?= $this->view->css ?>/goods-list.css" rel="stylesheet" type="text/css"
          xmlns="http://www.w3.org/1999/html">
    <script src="<?=$this->view->js_com?>/plugins/jquery.slideBox.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/decoration/common.js"></script>
    <link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
    <link href="<?= $this->view->css ?>/login.css" rel="stylesheet">
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>

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
                            <div class="goodslist_img2"><img width="100px"   src="<?=image_thumb($hval['common_image'],100,100)?>"/></div>
                        </a>
                        <p>
                            <a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($hval['goods_id'])?>" class="goods_list_name"><?=($hval['common_name'])?></a>
                            <span><?=_('价格：')?><strong><?=format_money($hval['common_price'])?></strong></span>
                            <a class="list_hot_intro bbc_btns"  target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($hval['goods_id'])?>" ><?=_('立即抢购')?></a>
                        </p>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>

    <div class="chead1 clearfix wrap">
		<span class="allresult">
			<?php if($parent_cat_id){
                if(count($parent_cat_id) == 1)
                {  ?>
                    <a class="a_bold" href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=($parent_cat_id[0]['cat_id'])?>"><?=($parent_cat_id[0]['cat_name'])?></a> <i class="iconfont icon-iconjiantouyou"></i> <span class="class_drap"><?=_('所有商品')?></span>
                <?php }else{
                    foreach($parent_cat_id as $key => $val){
                        ?>
                        <?php if($val['cat_parent_id'] == 0){?>
                            <a class="a_bold" href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=($val['cat_id'])?>"><?=($val['cat_name'])?></a> <i class="iconfont icon-iconjiantouyou"></i>
                        <?php }else{?>
                            <span class="class_drap">
							<strong><?=($val['cat_name'])?><i class="iconfont icon-iconjiantouxia"></i></strong>
                                <?php if(isset($val['silbing']) && $val['silbing']){?>
                                    <p class="class_drap_more">
							<?php foreach($val['silbing'] as $cckey => $ccval){?>
                                <a href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=($ccval['cat_id'])?>"><?=($ccval['cat_name'])?></a>
                            <?php }?>
							</p>
                                <?php }?>
						</span>
                        <?php }?>
                    <?php }}}?>
            <?php }?>
            <?php if(count($Big_Addr) == 1){?>
            <span class="class_drap">
                <?php foreach($Big_Addr as $key=>$value){ ?>
                <strong><?=$key ?><i class="iconfont icon-iconjiantouxia"></i></strong>
                <p class="class_drap_more">
                    <?php foreach ($value as $k=>$v){?>
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=$cat_id ?>&addr=<?=$addr ?>&addr_son=<?=$v['district_id']?>"><?=$v['district_name'] ?></a>
                    <?php } ?>
                </p>
                <?php } ?>
            </span>
            <?php } ?>
            <?php if($addr_son){?>
            <span class="class_putong">
                <strong><?=$dis_one_cont['district_name'] ?></strong>
            </span>
            <?php }?>
		</span>
    </div>

<?php if($search){?>
    <div class="chead1 clearfix wrap">
		<span class="allresult">
			<a class="a_bold"><?=_('全部结果')?> <i class="iconfont icon-iconjiantouyou"></i> <span>"<?=($search)?>"</span></a>
		</span>
    </div>
<?php }?>



    <!--商品规格属性S-->
    <div class="clearfix wrap" id="div_property">
        <input name="spec_flag" type="hidden" />
        <div class="cbrand clearfix class">
            <div class="cl_brand"><?=_('区域:')?></div>
            <div class="cl_brand_name">
                <a href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=$cat_id ?>&addr=all">精选</a>
                <a href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=$cat_id ?>&addr=huabei">华北</a>
                <a href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=$cat_id ?>&addr=dongbei">东北</a>
                <a href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=$cat_id ?>&addr=huadong">华东</a>
                <a href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=$cat_id ?>&addr=huanan">华南</a>
                <a href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=$cat_id ?>&addr=huazhong">华中</a>
                <a href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=$cat_id ?>&addr=xinan">西南</a>
                <a href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?=$cat_id ?>&addr=xibei">西北</a>
            </div>
        </div>

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

        <!-- search property-->
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
                                    <img src="<?= $brand_data['brand_pic'] ?>" alt="<?= $brand_data['brand_name'] ?>">
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
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Fresh_Goods&met=goodslist&cat_id=<?= $child_cat_data['cat_id'] ?>"><?= $child_cat_data['cat_name']; ?></a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php if ( !empty($brand_property['property']) ) { ?>
            <?php foreach ($brand_property['property'] as $key => $property_data) { ?>
                <div class="cbrand class clearfix">
                    <div class="cl_brand"><?= $property_data['property_name']; ?>:</div>
                    <div class="cl_brand_name">
                        <?php foreach ($property_data['property_values'] as $k => $property_value_data) { ?>
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&cat_id=<?= $cat_id ?>&property_id=<?= $property_data['property_id'] ?>&property_value_id=<?= $property_value_data['property_value_id'] ?>&<?= $brand_property['search_string'] ?>"><?= $property_value_data['property_value_name']; ?></a>
                        <?php } ?>
                    </div>
                    <div class="cl_brand_more">
                        <a class="sl_e_more" href="javascript:;" style="visibility: hidden;">更多<i></i></a>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
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
                                <a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($reval['goods_id'])?>" class="cr_xie_lia1">
                                    <div class="goodslist_img3">
                                        <img style="width:160px;height:160px;"  src="<?=image_thumb($reval['common_image'],160,160)?>"/>
                                        <div class="tit">
                                            <span>分享约减</span>
<!--                                            <span>--><?//=format_money($reval['share_total_price'])?><!--</span>-->
                                            <span><?=format_money($reval['common_share_price'])?></span>
                                        </div>
                                    </div>
                                </a>
                                <br><br>
                                    <a class="cr_xie_span0" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($reval['goods_id'])?>">
                                        <?php if(mb_strwidth($reval['common_name'], 'utf8')>40){
                                            echo $str = mb_strimwidth($reval['common_name'], 0, 40, '...', 'utf8');
                                        }else{echo $reval['common_name'];}?>
                                    </a>
                                    <span class="cr_xie_mon bbc_color">
											<span class="cr_xie_mon_name"></span><?=format_money($reval['common_price'])?>
                                    </span>
                                <p class="share_wrap_tg"><span class="share_tg">赚<u><?=format_money($reval['common_promotion_price'])?></u></span></p>
                                    <p>
                                        <span class="cr_xie_argue "><?=_('已售：')?><a><?=($reval['common_salenum'])?></a> <?=_('件')?></span>
                                    </p>

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
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&act=sale&cat_id=<?=request_int('cat_id')?>&actorder=<?=$next_order?>" title="<?php if($actorder === 'desc'){?>点击按销量升序<?php }else{ ?>点击按销量降序<?php }?>"><?=_('销量')?><span id='sale_icon_jiantou' class="iconfont <?php if($actorder === 'asc'  && $act === 'sale'){?>icon-iconjiantoushang<?php }else{?>icon-iconjiantouxia<?php } ?>"></a>
                        </div>
                        <div class="<?php if( $act == 'all'):?>crhead1_line_red bbc_bg<?php else:?>crhead1_line_white<?php endif;?>">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&act=all&cat_id=<?=request_int('cat_id')?>&actorder=<?=$next_order?>" title="<?php if($actorder === 'desc'){?>点击按上架时间升序<?php }else{ ?>点击按上架时间降序<?php }?>"><?=_('上架时间')?><span id='all_icon_jiantou' class="iconfont <?php if($actorder === 'asc' && $act === 'all'){?>icon-iconjiantoushang<?php }else{?>icon-iconjiantouxia<?php } ?>"></a>
                        </div>
                        <div class="<?php if($act == 'price'):?>crhead1_line_red bbc_bg<?php else:?>crhead1_line_white<?php endif;?>" >
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&act=price&cat_id=<?=request_int('cat_id')?>&actorder=<?=$next_order?>" title="<?php if($actorder === 'desc'){?>点击按价格升序<?php }else{ ?>点击按价格降序<?php }?>"><?=_('价格')?><span id='price_icon_jiantou' class="iconfont <?php if($actorder === 'asc'  && $act === 'price'){?>icon-iconjiantoushang<?php }else{?>icon-iconjiantouxia<?php } ?>"></a>
                        </div>
                        <div class="<?php if($act == 'evaluate'):?>crhead1_line_red bbc_bg<?php else:?>crhead1_line_white<?php endif;?>" >
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&act=evaluate&cat_id=<?=request_int('cat_id')?>&actorder=<?=$next_order?>" title="<?php if($actorder === 'desc'){?>点击按评论数升序<?php }else{ ?>点击按评论数降序<?php }?>"><?=_('评论数')?><span id='evaluate_icon_jiantou' class="iconfont <?php if($actorder === 'asc' && $act === 'evaluate'){?>icon-iconjiantoushang<?php }else{?>icon-iconjiantouxia<?php } ?>"></a>
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
            <ul class="cr_xie clearfix">
                <?php if($data['items']):foreach($data['items'] as $key => $val):?>
                    <li>
                        <?php if(isset($val['good']))
                        {
                            $id = 'gid='. $val['goods_id'];
                        }else{
                            $id = 'gid=0';
                        }?>
                        <a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&<?=$id?>" class="cr_xie_lia1">
                            <div class="goodslist_img1"><img style="width: 200px;height: 220px;" src="<?=image_thumb($val['common_image'],220,220)?>"/></div>
                            <span class="cr_xie_mon bbc_color"><?=format_money($val['common_price'])?></span><span class="cr_xie_amon"></span></a>
                        <div class="list_padd">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&<?=$id?>"  target="_blank" class="cr_xie_name" title="<?=($val['common_name'])?>">
                                <?php if(mb_strwidth($val['common_name'], 'utf8')>60){
                                    echo $str = mb_strimwidth($val['common_name'], 0, 60, '...', 'utf8');
                                }else{echo $val['common_name'];}?>
                            </a>
                            <p>

                            <div class="mjms">
                                <p class='share_wrap'><span class='share'>分享立减<u><?=format_money($val['common_share_price'])?></u></span></p>
                                <p class='share_wrap'><span class='share'>分享立赚<u><?=format_money($val['common_promotion_price'])?></u></span></p>
                            </div>

                        <!--0未参加活动 1惠抢购 2限时折扣 3手机专享 4新人优惠-->
                        <?php if($val['common_is_xian'] == 1){?><i>限时</i><?php }else{}?>

                        <?php if($val['common_promotion_type'] == 4){?><i>新</i><?php }else{}?>
                        <?php if($val['common_promotion_type'] == 3){?><i>手机</i><?php }else{}?>
                        <?php if($val['is_man'] == 1){?><i>满</i><?php }else{}?>

                        <?php if($val['common_is_jia'] == 1){?><i>加</i><?php }else{}?>
                        <?php if($val['common_is_qiang'] == 1){?><i>抢</i><?php }else{}?>

                                <span class="cr_xie_argue"><?=_('已售：')?> <a><?=($val['common_salenum'])?></a> <?=_('件')?></span>
                                <span class="cr_xie_argue"><?=_('评论数：')?> <a><?=($val['common_evaluate'])?></a></span>
                            </p>
                            <span class="shop_name"><?=($val['shop_name'])?><?php if($val['shop_self_support']){?><p class="bbc_btns">平台自营</p><?php }?></span>

                            <a onclick="collectGoods(<?=(@$val['goods_id'])?>)" class="cr_xie_lia2" id="coll_<?=(@$val['goods_id'])?>"><span class="cr_xie_lia2_span1 iconfont <?php if($val['is_favorite']){?> icon-taoxinshi bbc_color <?php }else{?> icon-icoheart <?php }?>"></span><span class="cr_xie_lia2_span2" ><?=_('收藏')?></span></a>
                            <?php if(!$val['common_is_virtual']){?><a  class="cr_xie_lia2" onclick="addCart(<?=(@$val['goods_id'])?>,<?=(@$val['shop_owner'])?>)"><span class="cr_xie_lia2_span1 cr_xie_lia2_span1—3 iconfont icon-wodegouwuche bbc_color"></span><span class="cr_xie_lia2_span2 cr_xie_lia2_span2-1 "><?=_('加入购物车')?></span></a><?php }else{?><a  class="cr_xie_lia2" onclick="nowBuy(<?=(@$val['goods_id'])?>,<?=(@$val['shop_owner'])?>)"><span class="cr_xie_lia2_span1 cr_xie_lia2_span1—3"></span><span class="cr_xie_lia2_span2 cr_xie_lia2_span2-1"><?=_('立即购买')?></span></a><?php }?>
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
                                <!-- 	<div id="entry" class="item item-fore2 clearfix disp  " style="visibility: visible;">
                                        <label class="login-label pwd-label" for="nloginpwd"></label>
                                        <input type="password" id="nloginpwd" name="nloginpwd" class="itxt itxt-error yzm" tabindex="2" autocomplete="off" placeholder="验证码">
                                        <span class="contM"><img src="img/icon.png"> </span>
                                    </div> -->

                                <!-- <div id="o-authcode" class="item item-vcode item-fore4  hide ">
                                    <input id="authcode" type="text" class="itxt itxt02" name="authcode" tabindex="5">
                                    <img id="JD_Verification1" class="verify-code">
                                    <a href="javascript:void(0)" onclick="$('#JD_Verification1').click();">看不清楚换一张</a>
                                </div> -->
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
        };

        //收藏商品
        window.collectGoods = function(e){
            if ($.cookie('key'))
            {
                $.post(SITE_URL  + '?ctl=Goods_Goods&met=collectGoods&typ=json',{goods_id:e},function(data)
                {
                    if(data.status == 200)
                    {
                        Public.tips.success(data.data.msg);
                        $("#coll_"+e).find(".iconfont").removeClass('icon-icoheart');
                        $("#coll_"+e).find(".iconfont").addClass('icon-taoxinshi').addClass('bbc_color');
                        //$.dialog.alert(data.data.msg);
                    }
                    else
                    {
                        Public.tips.error(data.data.msg);
                        //$.dialog.alert(data.data.msg);
                    }
                });
            }
            else
            {
                $("#login_content").show();
            }

        }

        //综合排序，销量，价格，新品
        //		function list(e,sort)
        //		{
        //			//地址中的参数
        //			window.location.href = SITE_URL + '&act=' + e + '&actorder=' + sort;
        //
        //
        //		}

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

        /**
         *
         * 商品筛选
         */

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
        $(".btn-close").click(function ()
        {
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

            /*$.post(UCENTER_URL+"?ctl=Login",{"met":'login',"typ":'json',"user_account":user_account,"user_password":user_password} ,function(data) {
             console.info(data);
             if(data.status == 200)
             {
             $("#login_content").hide();
             window.location.reload();
             }else{
             $(".msg-warn").hide();
             $(".msg-error").html('<b></b>'+data.msg);
             $(".msg-wrap").show();
             $(".msg-error").show();
             $("#loginsubmit").html('登&nbsp;&nbsp;&nbsp;&nbsp;录');
             }
             });*/

        }
    </script>

    <script>
        $(document).ready(function () {
            $('.cbrand').each(function (i) {
                var la = $(this).find('.cl_brand_name').children();
                var width = 0;
                $.each(la,function (index){
                    width +=la[index].offsetWidth;
                });
                if(width > 1000){
                    $(this).find('.sl_e_more').css('visibility','visible');
                }
            });
            $('.cl_brand_more').on('click','.sl_e_more',function () {
                $(this).parent().prev('.cl_brand_name').css('height','auto');
                $(this).addClass('opened');
                $(this).html('收起<i></i>');
            }).on('click','.opened',function () {
                $(this).parent().prev('.cl_brand_name').css('height','35px');
                $(this).removeClass('opened');
                $(this).html('更多<i></i>');
            });
        });
    </script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
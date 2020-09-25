<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'supplier_header.php';
?>

	<link href="<?= $this->view->css ?>/goods-list.css" rel="stylesheet" type="text/css"
	  xmlns="http://www.w3.org/1999/html">
	<script src="<?=$this->view->js_com?>/plugins/jquery.slideBox.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
	<script type="text/javascript" src="<?=$this->view->js?>/decoration/common.js"></script>
	<link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
	<link href="<?= $this->view->css ?>/login.css" rel="stylesheet">
	<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
	<style type="text/css">
        .goods_list_intro h3 {padding:65px 10px 0;}
        .goods_list_intro, .goods_list_intro ul li{height: auto !important;}
        .goods_list_intro ul li{width:188px;padding-bottom: 5px;margin-right: 5px;margin-left: 0 !important;}
        .goods_list_intro ul li a.goods_list_href{width:100%;height:188px;text-align: center;position: relative;float: none;vertical-align: middle;display: table-cell;}
        .goods_list_intro ul li a.goods_list_href img{width:188px;height: 188px;padding-top: 0;}
        .goods_list_intro ul li .img-title{display:none;position: absolute;bottom: 0;left:0;width:188px;height: 34px;line-height: 17px;color: #fff;background-color: rgba(0, 0, 0, .6);}
        .goods_list_intro ul li p{width:100% !important;margin-left: 0 !important;/*height: 22px;*/font-size: 14px;padding:0;}
        .goods_list_intro ul li p span{line-height:22px;font-size: 13px;}
        .goods_list_intro ul li p span.cost-price{margin-left: 5px;}
        .goods_list_intro ul li p span.sales{margin-right: 4px;}
        .goods_list_intro ul li>span.profit-ratio,  .goods_list_intro ul li>span.suggest-price{line-height: 20px;display: inline-block;font-size: 14px;margin-left: 5px;}
        .num_style{margin-right: 0 !important;}
        .bbc_color {color: #e45050 !important;}
        .good-profit-ratio,.good-suggest-price{ line-height:20px!important;; display:inline-block!important;; font-size:12px!important;;}
        .apply_dist,.apply_disted,.add_distributor{padding: 3.5px 50px;background-color: #e45050;color: white;}
        .goods_list_intro .mar_wrap{ width:184px!important; padding:0 2px;}
        .goods_list_intro .mar-r{ display:inline-block;}
        .goods_list_intro .mar-b-1{ display:inline-block;}

        .cr_xie li{ overflow:hidden;}
        .sale_shop_wrap{ width:100%; border-bottom:1px solid #e1e1e1;}
        .sale_shop_num{ width:50%; float:left; font-size:14px; height:35px; line-height:35px;}
        .sale_shop_num span{ width100%; margin:0 auto; font-size:14px; color:#e45050;}

		.brandself ul{}
		.s_goods_popup{ position:relative; width:234px; z-index:10; bottom:-170px; transition:0.2s; }
        .goods_popup_con{position:absolute; width:234px; height:160px;z-index:13; bottom:0; background:#fff;}
		.brandself li{ margin:0; padding:0; border:none;}
		.brandself li:hover{ box-shadow:none; border:none;}
        .shop_score li{float:left;font-size:12px;margin-right:10px}
        .shop_score_content li span{line-height:20px;margin-top:15px;font-size:12px}
        .high_than{width:48px;height:20px;color:#fff!important;text-align:center;display:inline-block;margin-left:4px!important;margin-right:4px!important}
        .shop_score_content li em{font-size:12px}
        .shop_score_content i.iconfont{position:relative;top:3px;left:2px;color:#fff;float:left}
	</style>
    <div class="hr"></div>

    <?php if($cat_id){?>
        <div class="wrap">
            <div class="goods_list_intro clearfix">
                <h3><?=_('热卖推荐')?></h3>
                <ul>
                    <?php foreach($hot_sale as $hkey => $hval):?>
                    <li>
                        <a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Supplier_Goods&met=goods&gid=<?=($hval['goods_id'])?>" class="goods_list_href"><img src="<?=image_thumb($hval['common_image'],100,100)?>"><span class="img-title" style="display: none;"><?=($hval['common_name'])?></span></a>
                        <p class="mar_wrap">
                            <span class="mar-r _letter-spacing"><a><?=_('利润比：')?></a></span>
                            <span class="mar-b-1" style="color:#e45050;font-weight:bold;">
                                <?php echo number_format(($hval['goods_recommended_min_price']-$hval['common_price'])/$hval['goods_recommended_min_price']*100,2,'.',''); ?> % ~ <?php echo number_format(($hval['goods_recommended_max_price']-$hval['common_price'])/$hval['goods_recommended_max_price']*100,2,'.',''); ?> %
                            </span>
                        </p>
                        <p>
                            <span class="bbc_color lf cost-price">成本：<?=format_money($hval['common_price'])?></span>
                            <span class="rt sales">
                                <i></i>人气：<i class="num_style"><?=$hval['common_collect']?></i>
                            </span>
                         </p>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="chead1 clearfix wrap">
            <span class="allresult">
                <?php if($parent_cat_id){?>
                    <?php if(count($parent_cat_id) == 1){ ?>
                        <a class="a_bold" href="<?=YLB_Registry::get('url')?>?ctl=Supplier_Goods&met=goodslist&cat_id=<?=($parent_cat_id[0]['cat_id'])?>"><?=($parent_cat_id[0]['cat_name'])?></a> <i class="iconfont icon-iconjiantouyou"></i> <span class="class_drap"><?=_('所有商品')?></span>
                    <?php }else{?>
                        <?php foreach($parent_cat_id as $key => $val){ ?>
                            <?php if($val['cat_parent_id'] == 0){?>
                                <a class="a_bold" href="<?=YLB_Registry::get('url')?>?ctl=Supplier_Goods&met=goodslist&cat_id=<?=($val['cat_id'])?>"><?=($val['cat_name'])?></a> <i class="iconfont icon-iconjiantouyou"></i>
                            <?php }else{?>
                                <span class="class_drap">
                                    <strong><?=($val['cat_name'])?><i class="iconfont icon-iconjiantouxia"></i></strong>
                                    <?php if(isset($val['silbing']) && $val['silbing']){?>
                                        <p class="class_drap_more">
                                        <?php foreach($val['silbing'] as $cckey => $ccval){?>
                                            <a href="<?=YLB_Registry::get('url')?>?ctl=Supplier_Goods&met=goodslist&cat_id=<?=($ccval['cat_id'])?>"><?=($ccval['cat_name'])?></a>
                                        <?php }?>
                                    </p>
                                    <?php }?>
                                </span>
                            <?php }?>
                        <?php }?>
                    <?php }?>
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

        <?php /*if($cat_row && !$cat_id){*/?><!--
            <div class="cbrand class clearfix">
                <div class="cl_brand  "><?/*=_('分类:')*/?></div>
                <div class="cl_brand_name">
                    <?php /* foreach($cat_row as $ckey=> $cval){*/?>
                        <a onclick="cat(<?/*=($ckey)*/?>)" <?php /*if($cat_id == $ckey){*/?>style="color:red;" <?php /*}*/?>><?/*=($cval['cat_name'])*/?></a>
                    <?php /*} */?>
                </div>
            </div>
        --><?php /*}*/?>

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
							<a href="<?=YLB_Registry::get('url')?>?ctl=Supplier_Goods&met=goodslist&cat_id=<?= $cat_id ?>&brand_id=<?= $brand_data['brand_id'] ?>&<?= $brand_property['search_string'] ?>">
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
			<a href="<?=YLB_Registry::get('url')?>?ctl=Supplier_Goods&met=goodslist&cat_id=<?= $child_cat_data['cat_id'] ?>"><?= $child_cat_data['cat_name']; ?></a>
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
						<a href="<?=YLB_Registry::get('url')?>?ctl=Supplier_Goods&met=goodslist&cat_id=<?= $cat_id ?>&property_id=<?= $property_data['property_id'] ?>&property_value_id=<?= $property_value_data['property_value_id'] ?>&<?= $brand_property['search_string'] ?>"><?= $property_value_data['property_value_name']; ?></a>
					<?php } ?>
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
									<a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Supplier_Goods&met=goods&gid=<?=($reval['goods_id'])?>" class="cr_xie_lia1">
										<div class="goodslist_img3"><img  src="<?=image_thumb($reval['common_image'],160,160)?>"/></div>

											<a class="cr_xie_span0" href="<?=YLB_Registry::get('url')?>?ctl=Supplier_Goods&met=goods&gid=<?=($reval['goods_id'])?>">
												<?php if(mb_strwidth($reval['common_name'], 'utf8')>40){
													echo $str = mb_strimwidth($reval['common_name'], 0, 40, '...', 'utf8');
												}else{echo $reval['common_name'];}?>
											</a>
										<span class="cr_xie_mon bbc_color">
											<span class="cr_xie_mon_name"></span><?=format_money($reval['common_price'])?>
										</span>
									<p>
										<span class="cr_xie_argue "><?=_('已售：')?><a><?=($reval['common_salenum'])?></a> <?=_('件')?></span>
									</p>
									<span class="good-profit-ratio">利润比：<?php echo number_format(($reval['goods_recommended_min_price']-$reval['common_price'])/$reval['goods_recommended_min_price']*100,2,'.',''); ?> % ~ <?php echo number_format(($reval['goods_recommended_max_price']-$reval['common_price'])/$reval['goods_recommended_max_price']*100,2,'.',''); ?> %</span>
									<span class="good-suggest-price">建议价：<?=format_money($reval['goods_recommended_min_price'])?> ~ <?=format_money($reval['goods_recommended_max_price'])?></span>
									</a>
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
							<div class="<?php if($act == '' || $act == 'all'):?>crhead1_line_red bbc_bg<?php else:?>crhead1_line_white<?php endif;?>">
								<a onclick="list('all')"><?=_('上架时间')?><span class="iconfont icon-iconjiantouxia"></a>
							</div>
							<div class="<?php if($act == 'sale'):?>crhead1_line_red bbc_bg<?php else:?>crhead1_line_white<?php endif;?>" >
								<a onclick="list('sale')" ><?=_('销量')?><span class="iconfont icon-iconjiantouxia"></a>
							</div>
							<div class="<?php if($act == 'price'):?>crhead1_line_red bbc_bg<?php else:?>crhead1_line_white<?php endif;?>" >
								<a onclick="list('price')"><?=_('价格')?><span class="iconfont icon-iconjiantoushang"></a>
							</div>
							<div class="<?php if($act == 'evaluate'):?>crhead1_line_red bbc_bg<?php else:?>crhead1_line_white<?php endif;?>" >
								<a onclick="list('evaluate')">评论数<span class="iconfont icon-iconjiantouxia"></a>
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
                                    <div><?php if($transport_area){ echo $transport_area; }else{?><?=_('请选择地区')?><?php }?></div>
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
						</p>

					</div>
				</div>
				<ul class="cr_xie clearfix">
					<?php if($data['items']):
							foreach($data['items'] as $key => $val):?>
					<li>
						<a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Supplier_Goods&met=goods&gid=<?=$val['goods_id']?>" class="cr_xie_lia1">
							<div class="goodslist_img1"><img src="<?=image_thumb($val['common_image'],220,220)?>"/></div>
							<span class="cr_xie_mon bbc_color"><?=format_money($val['common_price'])?></span><span class="cr_xie_amon"></span></a>
						<div class="list_padd clearfix">
							<a href="<?=YLB_Registry::get('url')?>?ctl=Supplier_Goods&met=goods&gid=<?=$val['goods_id']?>"  target="_blank" class="cr_xie_name" title="<?=($val['common_name'])?>">
								<?=$val['common_name']?>
							</a>
							<?php if($val['goods_recommended_min_price']&&$val['goods_recommended_max_price']){ ?>
							<p>
								<span class="mar-r _letter-spacing"><a><?=_('利润比：')?></a></span>
                                <span class="mar-b-1" style="color:#e45050;font-weight:bold;">								
									<?php echo number_format(($val['goods_recommended_min_price']-$val['common_price'])/$val['goods_recommended_min_price']*100,2,'.',''); ?> % ~ <?php echo number_format(($val['goods_recommended_max_price']-$val['common_price'])/$val['goods_recommended_max_price']*100,2,'.',''); ?> %
									  
								</span>
							</p>
							<?php } ?>
							<span class="shop_name">
                                <a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=index&id=<?=$val['shop_id']?>" target="_blank"><?=($val['shop_name'])?></a>
                                <?php if($val['shop_self_support']){?><p class="bbc_btns">平台自营</p><?php }?>
                            </span>

							<!--<a onclick="collectGoods(<?=(@$val['goods_id'])?>)" class="cr_xie_lia2" id="coll_<?=(@$val['goods_id'])?>"><span class="cr_xie_lia2_span1 iconfont <?php if($val['is_favorite']){?> icon-taoxinshi bbc_color <?php }else{?> icon-icoheart <?php }?>"></span><span class="cr_xie_lia2_span2" ><?=_('收藏')?></span></a>-->
							<?php if(!$val['common_is_virtual']){?>
								<a  class="cr_xie_lia2" onclick="addCart(<?=(@$val['goods_id'])?>,<?=(@$val['shop_owner'])?>)">
									<span class="cr_xie_lia2_span1 cr_xie_lia2_span1—3 iconfont icon-wodegouwuche bbc_color"></span>
									<span class="cr_xie_lia2_span2 cr_xie_lia2_span2-1 "><?=_('购物车')?></span>
								</a>
							<?php }else{?>
								<a  class="cr_xie_lia2" onclick="nowBuy(<?=(@$val['goods_id'])?>,<?=(@$val['shop_owner'])?>)">
									<span class="cr_xie_lia2_span1 cr_xie_lia2_span1—3"></span>
									<span class="cr_xie_lia2_span2 cr_xie_lia2_span2-1"><?=_('立即购买')?></span>
								</a>
							<?php }?>
							
							<?php if(isset($suppliers) && !in_array($val['shop_id'],$suppliers)){?>
                            	<a class="apply_dist"  data-id = "<?=$val['shop_id']?>" ><?=_('申请分销商')?></a>
                            <?php }elseif(isset($suppliers) && in_array($val['shop_id'],$suppliers) && $val['product_is_behalf_delivery']!=1){?>	
	                            <a  class="cr_xie_lia2" onclick="addCart(<?=(@$val['goods_id'])?>,<?=(@$val['shop_owner'])?>)">
									<span class="cr_xie_lia2_span1 cr_xie_lia2_span1—3 iconfont icon-wodegouwuche bbc_color"></span>
									<span class="cr_xie_lia2_span2 cr_xie_lia2_span2-1 "><?=_('购物车')?></span>
								</a>
                            <?php }elseif($val['product_is_behalf_delivery'] && isset($suppliers) && in_array($val['shop_id'],$suppliers)){?>
                            	<?php if(isset($common_ids) && in_array($val['common_id'],$common_ids)){?>
                            	    <a class="apply_disted"> <?=_('已分销')?> </a>
                            	<?php }else{?>
                            	    <a class="add_distributor" data-id="<?=$val['common_id']?>" > <?=_('一键上架')?> </a>
                            	<?php }?>	
                            <?php } ?>
						</div>
                        <!--20180614商品增加上滑弹框  start-->
                        <div class="s_goods_popup">
                        	<div class="goods_popup_mask"></div>
                            <div class="goods_popup_con">
                            	<div class="sale_shop_wrap clearfix">
                                    <div class="sale_shop_num">
                                        <span>500</span>家店铺
                                    </div>
                                    <div class="sale_shop_num">
                                        <span>30000</span>件商品
                                    </div>
                                </div>
                            	<div class="brandself ">
                                    <ul class="shop_score_content clearfix ">
                                        <li>
                                            <span>描述相符：5.00</span>
                                            <span class="high_than bbc_bg"><i class="iconfont  icon-gaoyu rel_top1"></i>高于</span>                                       
                                            <em class="bbc_color">47.49%</em>
                                        </li>
                                        <li>
                                            <span>服务态度：5.00</span>
                                            <span class="high_than bbc_bg">
                                            <i class="iconfont  icon-gaoyu rel_top1"></i>高于</span>
                                            <em class="bbc_color">18.20%</em>
                                        </li>
                                        <li>
                                            <span>发货速度：5.00</span>
                                            <span class="high_than bbc_bg">
                                            <i class="iconfont  icon-gaoyu rel_top1"></i>高于</span>
                                            <em class="bbc_color">19.33%</em>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--20180614商品增加上滑弹框  end-->
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

		}
	</script>

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
			if ($.cookie("key"))
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
								//$.dialog.alert(a.msg);
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
							//$.dialog.alert("操作失败！");
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
			if ($.cookie("key"))
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
			}
		}

		//收藏商品
		window.collectGoods = function(e){
			if (<?=Perm::checkUserPerm()?1:0?>)
			{
				$.post(SITE_URL  + '?ctl=Goods_Goods&met=collectGoods&typ=json',{goods_id:e},function(data)
				{
					if(data.status == 200)
					{
						Public.tips.success(data.data.msg);
						$("#coll_"+e).find(".iconfont").removeClass('icon-icoheart');
						$("#coll_"+e).find(".iconfont").addClass('icon-taoxinshi').addClass('bbc_color');
					}
					else
					{
						Public.tips.error(data.data.msg);
					}
				});
			}
		};

		//综合排序，销量，价格，新品
		function list(e)
		{
			//地址中的参数
			var params= window.location.search;

			params = changeURLPar(params,'act',e);

			window.location.href = SITE_URL + params;


		}

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
			}else
			{
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

		   if($.cookie('areaId'))
		   {
			   //获取该地区的名字
			   $.post(SITE_URL  + '?ctl=Base_District&met=getDistrictNameList&id=' + $.cookie('areaId') +  '&typ=json',function(data)
			   {
				   $("#ncs-freight-selector .text div").html(data.data.area);
			   });
		   }


           $("#ncs-freight-selector").click(function() {
                 $.post(SITE_URL  + '?ctl=Base_District&met=getAllDistrict&typ=json',function(data)
                 {
                 	   nc_a = data.data;
                      $cur_tab = $('#ncs-stock').find('li[data-index="0"]');
                      _loadArea(0);
                 }
                 );

                 $(this).addClass("hover");
                 $(this).on('mouseleave',function(){
                 	$(this).removeClass("hover");
                 	_calc();
                 });
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

        var params= window.location.search;

		params = changeURLPar(params,'transport_id',calc_area_id);
		params = changeURLPar(params,'transport_area',calc_area);

		window.location.href = SITE_URL + params;
	}

    	});

		$(function(){
			if ( $('input[name="spec_flag"]').length == 0 ){
				$('#div_property').remove();
			}
		})

		$(".goods_list_intro ul li").on("mouseover", function() {
          var _this = $(this);
          _this.find(".img-title").show();
        })
        $(".goods_list_intro ul li").on("mouseleave", function() {
          var _this = $(this);
          _this.find(".img-title").hide();
        })


        /*20180615  商品弹框   start*/
           $(".goodslist_img1").mouseover(function(){
				$(this).parents("li").find(".s_goods_popup").css({"bottom":"0"});
			})
			 $(".goodslist_img1").mouseout(function(){
				$(this).parents("li").find(".s_goods_popup").css({"bottom":"-170px"});
			})
        /*20180615  商品弹框    end*/
</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'supplier_header.php';
?>

    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/goods-detail.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/Group-integral.css"/>
    <script src="<?=$this->view->js_com?>/plugins/jquery.slideBox.min.js" type="text/javascript"></script>
    <script src="<?= $this->view->js_com ?>/sppl.js"></script>
    <script src="<?= $this->view->js ?>/supplier_detail.js"></script>
    <script src="<?= $this->view->js_com ?>/plugins/jquery.imagezoom.min.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
    <link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
    <link href="<?= $this->view->css ?>/login.css" rel="stylesheet">
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
    <style>
        div.zoomDiv{z-index:999;position:absolute;top:0px;left:0px;width:200px;height:200px;background:#ffffff;border:1px solid #CCCCCC;display:none;text-align:center;overflow:hidden;}
        div.zoomMask{position:absolute;background:url("<?=$this->view->img?>/mask.png") repeat scroll 0 0 transparent;cursor:move;z-index:1;}
        .buy_box{display: block}
        .goods_ranking ul li {
          padding: 0 !important;
          padding-bottom: 6px !important;
          margin-top: 8px;}
        .goods_ranking ul li a.selling_goods_img{display: block;width:100%;height:198px;text-align: center;position: relative;}
        .goods_ranking ul li a.selling_goods_img img{width:198px;height: 100%;}
        .goods_ranking ul li .img-title{display:none;position: absolute;bottom: 0;left:5px;width:198px;height: 34px;line-height: 17px;color: #fff;background-color: rgba(0, 0, 0, .6);}
        .goods_ranking ul li p{width:100% !important;margin-left: 0 !important;/*height: 22px;*/font-size: 14px;}
        .goods_ranking ul li p span{line-height:22px;}
        .goods_ranking ul li p span.cost-price{margin-left: 5px;}
        .goods_ranking ul li p span.sales{margin-right: 4px;}
        .goods_ranking ul li>span.profit-ratio,  .goods_ranking ul li>span.suggest-price{line-height: 20px;display: inline-block;font-size: 14px;margin-left: 5px;}
        .num_style{margin-right: 0 !important;}
        .apply_dist{margin-top:10px;display:inline-block;padding:10px 50px;background-color: #e45050;color: white;}
        .apply_dist:hover{color: white;}
        .add_distributor{margin-top:10px;display:inline-block;padding: 10px 50px; background-color: #e45050; color: white !important;}
        .goods_pl{margin: 0;}
    </style>

    <div class="bgcolor">
        <div class="wrapper">
            <div class="t_goods_detail">
                <div class="crumbs clearfix">
                    <p>
                        <?php if($parent_cat){?>
                        <?php foreach($parent_cat as $catkey => $catval):?>
                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Supplier_Goods&met=goodslist&cat_id=<?=($catval['cat_id'])?>"><?=($catval['cat_name'])?></a><?php if(!isset($catval['ext'])){ ?><i class="iconfont icon-iconjiantouyou"></i><?php }?>
                        <?php endforeach;?>
                        <?php }?>
                    </p>
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

                    	<img class="jqzoom" rel="<?= image_thumb($goods_image,900,976) ?>"
                                                  src="<?= image_thumb($goods_image, 366, 340) ?>"/>
                        </div>
                        <div class="retw">
                            <a><i class="iconfont icon-btnreturnarrow btn_left"></i></a>
                            <div class="gdt_ul">
                                <ul class="clearfix" id="jqzoom">
                                    <?php if (isset($goods_detail['goods_base']['image_row']) && $goods_detail['goods_base']['image_row'] )
                                    {
                                        foreach ($goods_detail['goods_base']['image_row'] as $imk => $imv)
                                        { ?>
                                            <li <?php if ($imv['images_is_default'] == 1){ ?>class="check"<?php } ?>>
                                                <img src="<?= image_thumb($imv['images_image'],60,60) ?>"/>
                                                <input type="hidden" value="<?=image_thumb($imv['images_image'],366,340)?>" rel="<?=image_thumb($imv['images_image'],900,976)?>">
                                            </li>
                                        <?php }
                                    }else{ ?>
                                        <li class="check">
                                                <img src="<?= image_thumb($goods_image,60,60) ?>"/>
                                                <input type="hidden" value="<?=image_thumb($goods_image,366,340)?>" rel="<?=image_thumb($goods_image,900,976)?>">
                                            </li>
                                    <?php }?>
                                </ul>
                            </div>
                            <a><i class="iconfont icon-btnrightarrow btn_right"></i></a>
                        </div>
                        <div class="ev_left_num">                            
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

                        <div class="obvious">
                            <p class="clearfix">
                                <span class="mar-r _letter-spacing"><?=_('利润比：')?></span>
                                <span class="mar-b-1" style="color:#e45050;font-weight:bold;">
									<?php echo number_format(($goods_detail['goods_base']['goods_recommended_min_price']-$goods_detail['goods_base']['goods_price'])/$goods_detail['goods_base']['goods_recommended_min_price']*100,2,'.',''); ?> % ~ <?php echo number_format(($goods_detail['goods_base']['goods_recommended_max_price']-$goods_detail['goods_base']['goods_price'])/$goods_detail['goods_base']['goods_recommended_max_price']*100,2,'.',''); ?> %
								</span>
                            </p>
                            <p class="clearfix">
                                <span class="mar-r _letter-spacing"><?=_('成本价：')?></span>
                                <span class="mar-b-2">
                                    <strong class="color-db0a07 bbc_color"><?=format_money($goods_detail['goods_base']['goods_price'])?></strong>
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="mar-r _letter-spacing"><?=_('建议价：')?></span>
                                <span class="mar-b-1">                                  
                                    <?=format_money($goods_detail['goods_base']['goods_recommended_min_price'])?> ~ <?=format_money($goods_detail['goods_base']['goods_recommended_max_price'])?>
                                </span>
                            </p>
                            <p class="clearfix"><span class="mar-r _letter-spacing-2"><?=('商品评价：')?></span>
                                <span class="color-1876d1 mar-b-4 "><a href="#elist" name="elist" class="pl"><i class="num_style"><?=($goods_detail['goods_common']['common_evaluate'])?></i> <?=_('条评论')?></a></span>
                            </p>
                        </div>
                        <div class="goods_style_sel ">
                            <div>
                                <input type="hidden" id="common_id" value="<?=($goods_detail['goods_base']['common_id'])?>" />
                            </div>

                            <p class="mar-top">
                                <span class="span_w lineh-2 mar_l "><?=_('配送至：')?></span>
                            </p>
                            <div class="span_w_p clearfix">
                                <div id="ncs-freight-selector" class="ncs-freight-select">
                                  <div class="text">
                                    <div><?=_('请选择地区')?></div>
                                    <b>∨</b> </div>
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

                                <span class="goods_have linehe">
                                    <?php if($goods_detail['goods_base']['goods_stock']):?><?=_('有货')?><?php else: ?><?=_('无货')?><?php endif;?>
                                </span>
                                <?php if ($goods_detail['shop_base']['shipping']){ ?>
                                    <em><?= ($goods_detail['shop_base']['shipping']) ?></em>
                                <?php } ?>
                                <em class="transport"></em>
                            </div>

                            <?php if (isset($goods_detail['goods_common']['common_spec_name']) && isset($goods_detail['goods_common']['common_spec_value']) && $goods_detail['goods_common']['common_spec_value'] ) {foreach ($goods_detail['goods_common']['common_spec_name'] as $speck => $specv){ ?>
                                <p class="goods_pl">
                                    <span class="span_w lineh-3 mar_l "><?= ($specv) ?>：</span>
                                    <?php if (isset($goods_detail['goods_common']['common_spec_value']) && $goods_detail['goods_common']['common_spec_value'] ) {foreach ($goods_detail['goods_common']['common_spec_value'][$speck] as $specvk => $specvv){ ?>
                                        <a <?php if(isset($goods_detail['goods_base']['goods_spec'][$specvk])){ ?> class="check" <?php }?> value="<?= ($specvk) ?>">
                                            <?=($specvv)?>
                                        </a>
                                    <?php }}?>
                                </p>
                            <?php }} ?>

                            <?php if($goods_detail['chain_stock']){?>
                                <p class="clearfix"><span class="mar-r _letter-spacing-2">门店服务：</span>
                                    <span class="color-1876d1 mar-b-4 ">
                                        <a href="#" name="elist" class="num_style mendian" nctype="get_chain">
                                            <i class="iconfont icon-tabhome"></i>门店自提
                                        </a>· 选择有现货的门店下单，可立即提货
                                    </span>
                                </p>
                            <?php }?>

                            <?php if($goods_status){?>
                                <?php if($goods_detail['goods_base']['goods_stock']):?>
                                    <p class="need_num clearfix">
                                        <span class="span_w lineh-6 mar_l "><?=_('数量：')?></span>
                                        <span class="goods_num">
                                            <a class="no_reduce" ><?=_('-')?></a>
                                            <input id="nums" name="nums" data-id="<?=($goods_detail['goods_base']['goods_id'])?>" data-max="<?php if($goods_detail['buy_limit']):?><?=($goods_detail['buy_limit'])?><?php else:?><?=($goods_detail['goods_base']['goods_stock'])?><?php endif;?>" value="1">
                                            <a class="<?php if($goods_detail['buy_limit'] == 1 || $goods_detail['goods_base']['goods_stock'] == 1 ): ?>no_<?php endif; ?>add" ><?=_('+')?></a>
                                        </span>
                                        <?php if($goods_detail['buy_limit']){?>
                                        <span class="limit_purchase "><?=_('每人限购')?><?=($goods_detail['buy_limit'])?><?=_('件')?></span>
                                        <?php }?>
                                    </p>
                                    <?php if(isset($suppliers) && !in_array($goods_detail['goods_base']['shop_id'],$suppliers)){ ?>
                                        <a class="apply_dist" data-id=<?=$goods_detail['goods_base']['shop_id']?>><?=_('申请分销商')?></a>
                                    <?php }elseif(isset($suppliers) && in_array($goods_detail['goods_base']['shop_id'],$suppliers) && $goods_detail['goods_common']['product_is_behalf_delivery']!=1){?>
                                        <?php if($goods_detail['goods_common']['common_is_virtual']):?>
                                            <p class="buy_box">
                                                <a class="tuan_go buy_now_virtual bbc_btns"><?=_('立即进货')?></a>
                                            </p>
                                        <?php else:?>
                                            <p class="buy_box">
                                                <a class="tuan_join_cart bbc_btns"><?=_('加入购物车')?></a>
                                                <a class="tuan_go buy_now  bbc_color bbc_border"><?=_('立即进货')?></a>
                                            </p>
                                        <?php endif;?>
                                    <?php }elseif($goods_detail['goods_common']['product_is_behalf_delivery'] && isset($suppliers) && in_array($goods_detail['goods_base']['shop_id'],$suppliers)){?>
                                        <?php if(isset($common_ids) && in_array($goods_detail['goods_base']['common_id'],$common_ids)){?>
                                            <a  style="margin-top:10px;display:inline-block;padding: 10px 50px;background-color: #e45050;color: white;" > <?=_('已分销')?> </a>
                                        <?php }else{?>
                                            <a class="add_distributor" data-id=<?=$goods_detail['goods_base']['common_id']?> > <?=_('一键上架')?> </a>
                                        <?php }?>
                                    <?php }?>
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
                                <a class="store-names" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=($shop_detail['shop_id'])?>"><?=($shop_detail['shop_name'])?></a>
                                <?php if(Web_ConfigModel::value('im_statu')==1 ){?>
                                <a href="javascript:;" class="chat-enter" onclick="return chat('<?=$shop_detail['user_name']?>');"><i class="iconfont icon-btncomment"></i></a>
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
                        <!-- 自营 -->
                        <?php if($shop_detail['shop_self_support'] == 'true'){?>
                        <div class="look_again "><?=_('看了又看')?></div>
                        <ul class="look_again_goods clearfix ">
                            <?php if (!empty($data_recommon_goods))
                            {
                                foreach ($data_recommon_goods as $key_recommon => $value_recommon)
                                {
                                    ?>
                                    <li>
                                        <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Supplier_Goods&met=goods&gid=<?=($value_recommon['goods_id'])?>">
                                            <img src="<?= $value_recommon['common_image'] ?>"/>
                                            <h5 class="bbc_color"><?= format_money($value_recommon['common_price']) ?></h5>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                        <?php }?>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="wrap">
        <div class="t_goods_bot clearfix ">
            <div class="t_goods_bot_left ">

                    <?php if($shop_detail['shop_self_support'] == 'false'){?>

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

				<?php }?>

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
                        <?php if (!empty($data_salle))
                            {
                                foreach ($data_salle as $key_salle => $value_salle)
                                   {?>
                                <li class="clearfix" style="position: relative;">
                                    <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Supplier_Goods&met=goods&gid=<?= ($value_salle['goods_id']) ?>"
                                                       class="selling_goods_img"><img src="<?= $value_salle['common_image'] ?>"><span class="img-title"><?= $value_salle['common_name'] ?></span></a>

                                        <p>
                                             <span class="bbc_color lf cost-price">成本价:<?= format_money($value_salle['common_price']) ?></span>
                                             <span class="rt sales">
                                                  <i></i><?=_('出售:')?><i class="num_style"><?= $value_salle['common_salenum'] ?></i><?=_('件')?>
                                             </span>
                                        </p>
                                        <span class="profit-ratio">利润比：<?php echo number_format(($value_salle['goods_recommended_min_price']-$value_salle['common_price'])/$value_salle['goods_recommended_min_price']*100,2,'.',''); ?> % ~ <?php echo number_format(($value_salle['goods_recommended_max_price']-$value_salle['common_price'])/$value_salle['goods_recommended_max_price']*100,2,'.',''); ?> %</span>
                                        <span class="suggest-price">建议价：<?=format_money($value_salle['goods_recommended_min_price'])?> ~ <?=format_money($value_salle['goods_recommended_max_price'])?></span>
                                 </li>
                        <?php
                                    }
                             } ?>
                    </ul>
                    <ul style="display: none;" id="hot_collect">
                        <?php if (!empty($data_collect))
                        {
                            foreach ($data_collect as $key_collect => $value_collect)
                            {
                            ?>
                               <li class="clearfix" style="position: relative;">
                                  <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Supplier_Goods&met=goods&gid=<?= $value_collect['goods_id'] ?>"
                                     class="selling_goods_img"><img src="<?= $value_collect['common_image'] ?>"><span class="img-title"><?= $value_collect['common_name'] ?></span></a>

                                     <p>
                                        <span class="bbc_color lf cost-price">成本价:<?= format_money($value_collect['common_price']) ?></span>
                                        <span class="rt sales">
                                            <i></i><?=_('收藏人气:')?><i class="num_style"><?= $value_collect['common_salenum'] ?></i>
                                        </span>
                                     </p>
                                     <span class="profit-ratio">利润比：<?php echo number_format(($value_collect['goods_recommended_min_price']-$value_collect['common_price'])/$value_collect['goods_recommended_min_price']*100,2,'.',''); ?> % ~ <?php echo number_format(($value_collect['goods_recommended_max_price']-$value_collect['common_price'])/$value_collect['goods_recommended_max_price']*100,2,'.',''); ?> %</span>
                                    <span class="suggest-price">建议价：<?=format_money($value_collect['goods_recommended_min_price'])?> ~ <?=format_money($value_collect['goods_recommended_max_price'])?></span>
                               </li>
                            <?php
                            }
                         } ?>
                    </ul>
                    <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=goodsList&id=<?=($shop_detail['shop_id'])?>"><p class="look_other_goods bbc_btns"><?=_('查看本店其他商品')?></p></a>
                </div>
            </div>
            <div name="elist" id="elist"></div>
            <div class="t_goods_bot_right ">
                <ul class="goods_det_about goods_det clearfix border_top">
                    <li><a class="xq checked"><?=_('商品详情')?></a></li>
                    <li><a class="pl"><?=_('商品评论')?><span><?=_('(')?><?=($goods_detail['goods_common']['common_evaluate'])?><?=_(')')?></span></a></li>
                    <?php if($entity_shop){?>
                    <li><a class="wz"><?=_('商家位置')?></a></li>
                    <?php }?>
                    <li><a class="bz"><?=_('分销说明')?></a></li>
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
                        <script type="text/javascript">
                 

                        </script>
                        <?php }?>
                   </li>
                   <!--商品咨询-->
                   <div id="goodsadvisory" style="display:none;" class="ncs-commend-main zl_1"></div>
                   <!-- 商品评论 -->
                   <div id="goodseval" style="display:none;" class="ncs-commend-main pl_1"></div>
                   <!-- 详细-->
                   <li class="xq_1" style="display:block;    position: relative;">
                       <?php if(isset($goods_format_top)&&!empty($goods_format_top)): ?>
                           <?=$goods_format_top['content']; ?>
                       <?php endif; ?>
                       <div id="goods_detail">
                       </div>
                       <?php if(isset($goods_format_bottom)&&!empty($goods_format_bottom)): ?>
                            <?=$goods_format_bottom['content']; ?>
                       <?php endif; ?>
                   </li>
                   <!-- 分销说明 -->
                   <li class="bz_1 tlf" style="display: none">
                        <div class="product-details">
                        <div>
                        <?=($goods_detail['goods_common']['common_distributor_description'])?>
                        </div>
                        </div>
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
	<script>
        //申请分销商
        $(".apply_dist").click(function (){
            var self_shop_type = <?=$shop_info['shop_type']?>;
            var shop_id = $(this).attr("data-id");
            if(self_shop_type == 2){
                 Public.tips.error("供货商不能参与分销！");
            }else{
                location.href = SITE_URL+"?ctl=Seller_Supplier_Supplier&met=apply&typ=e&shop_id="+shop_id;
            }
        });

        //一键分销
        $('.add_distributor').click(function() {
            var common_id = $(this).attr('data-id');
            $.ajax({
                url: SITE_URL + '?ctl=Supplier_Goods&met=addto_distributor&typ=json',
                data: {common_id: common_id},
                dataType: "json",
                success: function(a) {
                    if (a.status == 200) {
                        Public.tips.success(a.msg);
                        $('.add_distributor').html('已分销');
                    } else {
                        Public.tips.error(a.msg);
                    }
                },
            });
        });

        $(".btn-close").click(function() {
            $("#login_content").hide();

            $(".msg-wrap").hide();
            $('.lo_user_account').val("");
            $('.lo_user_password').val("");
        });

        $("#formlogin").keydown(function(e) {
            var e = e || event,
                keycode = e.which || e.keyCode;

            if (keycode == 13) {
                loginSubmit();
            }
        });

        function loginSubmit() {
            var user_account = $('.lo_user_account').val();
            var user_password = $('.lo_user_password').val();

            $("#loginsubmit").html('正在登录...');

            login_url = UCENTER_URL + '?ctl=Api&met=login&user_account=' + user_account + '&user_password=' + user_password;

            login_url = login_url + '&from=shop&callback=' + encodeURIComponent(window.location.href);
            window.location.href = login_url;
        }
	</script>

    <script>
        var goods_id = <?=($goods_detail['goods_base']['goods_id'])?>;
        var common_id = <?=($goods_detail['goods_base']['common_id'])?>;
        var shop_id = <?=($shop_detail['shop_id'])?>;

        function contains(arr, str) {
            var i = arr.length;
            while (i--) {
                if (arr[i] == str) {
                    return true
                }
            }
            return false
        }
        $("#add_consult").bind("click", function() {
            if ($.cookie('key')) {
                $.dialog({
                    title: "<?=_('发起咨询')?>",
                    height: 290,
                    width: 380,
                    lock: true,
                    drag: false,
                    content: 'url: ' + SITE_URL + '?ctl=Buyer_Service_Consult&met=add&typ=e&gid=' + goods_id
                })
            } else {
                $("#login_content").show()
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

        $('a[nctype="get_chain"]').click(function() {
            $.dialog({
                title: '查看门店',
                content: "url: <?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=chain&goods_id=" + goods_id + "&shop_id=" + shop_id,
                data: {
                    callback: callback
                },
                width: 800,
                lock: true
            });
            function callback(url) {
                window.location.href = url
            }
        });
        $(".selling").children().eq(0).hover(function() {
            $("#hot_salle").show();
            $("#hot_collect").hide()
        });
        $(".selling").children().eq(1).hover(function() {
            $("#hot_salle").hide();
            $("#hot_collect").show()
        });
        window.collectGoods = function(e) {
            if ($.cookie('key')) {
                $.post(SITE_URL + '?ctl=Goods_Goods&met=collectGoods&typ=json', {
                    goods_id: e
                }, function(data) {
                    if (data.status == 200) {
                        Public.tips.success(data.data.msg);
                        $(".icon-icoheart").addClass("icon-taoxinshi").removeClass('icon-icoheart')
                    } else {
                        Public.tips.error(data.data.msg)
                    }
                })
            } else {
                $("#login_content").show()
            }
        }
        window.collectShop = function(e) {
            if ($.cookie('key')) {
                $.post(SITE_URL + '?ctl=Shop&met=addCollectShop&typ=json', {
                    shop_id: e
                }, function(data) {
                    if (data.status == 200) {
                        Public.tips.success(data.data.msg)
                    } else {
                        Public.tips.error(data.data.msg)
                    }
                })
            } else {
                $("#login_content").show()
            }
        }
        $("input[name='searchGoodsList']").blur(function() {
            var search = $("input[name='searchGoodsList']").val();
            if (search) {
                $("#searchGoodsList").attr('href', SITE_URL + '?ctl=Shop&met=goodsList&search=' + search + '&id=' + shop_id)
            }
        });
    </script>
    <script>
        $(document).ready(function(){
            url = 'index.php?ctl=Goods_Goods&met=getShopCat&shop_id='+shop_id;
                $(".ser_lists").load(url, function(){
            });

            if('<?=$_REQUEST['from']?>' == 'consult')
            {
               window.location.hash = "#elist";
                $(".zl").click();
            }
        });

        $('.wz').click(function(){
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
                <?php if($entity_shop){ foreach ($entity_shop as $key => $value) { if($value['lng']&&$value['lat']){ ?>
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
            function getPointArea(point,callback){
                geo.getLocation(point, function(rs){
                    var addComp = rs.addressComponents;
                    if(addComp.province != '') callback(addComp);
                }, {numPois:1});
            }
        });
    </script>

    <!--  地址选择 -->
    <script>
        var $cur_area_list,$cur_tab,next_tab_id = 0,cur_select_area = [],calc_area_id = '',calced_area = [],calced_area_transport = [],cur_select_area_ids =[];
        <?php if($goods_detail['goods_base']['goods_stock']){?>
            $(document).ready(function(){
                if($.cookie('areaId')){
                    //获取该地区的名字
                    $.post(SITE_URL  + '?ctl=Base_District&met=getDistrictNameList&id=' + $.cookie('areaId') +  '&typ=json',function(data){
                        if(data.status == 200){
                            $("#ncs-freight-selector .text div").html(data.data.area);
                            $.post(SITE_URL  + '?ctl=Goods_Goods&met=getTramsport&area_id='+ data.data.city.id +'&common_id='+ <?=($goods_detail['goods_common']['common_id'])?> +'&typ=json',function(data){
                                <?php if ($goods_detail['goods_common']['transport_type_id']){ ?>
                                if (data.status === 250) {
                                    $('.goods_have').html('无货');
                                    $('.transport').html('');
                                    $('a[nctype="buynow_submit"]').addClass('no-buynow');
                                    $('a[nctype="addcart_submit"]').addClass('no-buynow');
                                    $('.buy_box').hide();
                                } else {
                                    $('.goods_have').html('有货 ');
                                    $('.transport').html(data.data.transport_str);
                                    $('a[nctype="buynow_submit"]').removeClass('no-buynow');
                                    $('a[nctype="addcart_submit"]').removeClass('no-buynow');
                                    $('.buy_box').show();
                                }
                                <?php }?>
                            });
                        }
                    });
                }

                $("#ncs-freight-selector").hover(function() {
                    //如果店铺没有设置默认显示区域，马上异步请求
                    if (typeof nc_a === "undefined") {
                        $.post(SITE_URL  + '?ctl=Base_District&met=getAllDistrict&typ=json',function(data){
                            nc_a = data.data;
                            $cur_tab = $('#ncs-stock').find('li[data-index="0"]');
                            _loadArea(0);
                        });
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
                        //点击第一二级时，已经到了最后一级
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
                                    } else {
                                        $('.goods_have').html('有货 ');
                                        $('.transport').html(data.data.transport_str);
                                        $('a[nctype="buynow_submit"]').removeClass('no-buynow');
                                        $('a[nctype="addcart_submit"]').removeClass('no-buynow');
                                        $('.buy_box').show();
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
                                    $('.transport').html(calced_area_transport[calc_area_id]);
                                    $('a[nctype="buynow_submit"]').removeClass('no-buynow');
                                    $('a[nctype="addcart_submit"]').removeClass('no-buynow');
                                    $('#store-free-time').show();
                                }
                            }
                    <?php }?>
                }
            });
        <?php }?>

        function consult(){
             window.location.href = window.location.href + "&from=consult";
        }

        $(".goods_ranking ul li").on("mouseover", function() {
          var _this = $(this);
          _this.find(".img-title").show();
        })
        $(".goods_ranking ul li").on("mouseleave", function() {
          var _this = $(this);
          _this.find(".img-title").hide();
        })
    </script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
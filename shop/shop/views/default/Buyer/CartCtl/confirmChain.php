<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'site_nav.php';
?>

<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/shop-cart.css" />
<style>
    .cart_goods{margin-bottom: 30px;}
</style>
	<div class="wrap">
		<div class="head_cont clearfix">
			<div class="nav_left">
				<a href="index.php" class="logo"><img src="<?=$this->web['web_logo']?>"/></a>
				<a class="download iconfont"></a>
			</div>
		</div>
	</div>
	<div class="wrap">
		<div class="shop_cart_head clearfix">
			<div class="cart_head_left">
				<h4><?=_('填写核对购物信息')?></h4>
				<p><?=_('请仔细填写手机号，以确保电子兑换码准确发到您的手机。')?></p>
			</div>
			<ul class="cart_process">
				<li class="mycart">
					<i class="iconfont icon-wodegouwuche"></i>
					<div class="line">
						<p></p>
						<span></span>
					</div>
					<h4><?=_('我的购物车')?></h4><h4>
				</h4></li>
				<li class="mycart process_selected1">
					<i class="iconfont icon-iconquerendingdan bbc_color"></i>
					<div class="line">
						<p class="bbc_border"></p>
						<span class="bbc_bg bbc_border"></span>
					</div>
					<h4 class="bbc_color"><?=_('确认订单')?></h4><h4>
				</h4></li>
				<li class="mycart">
					<i class="iconfont icon-icontijiaozhifu"></i>
					<div class="line">
						<p></p>
						<span></span>
					</div>
					<h4><?=_('支付提交')?></h4><h4>
				</h4></li>
				<li class="mycart">
					<i class="iconfont icon-dingdanwancheng"></i>
					<div class="line">
						<p></p>
						<span></span>
					</div>
					<h4><?=_('订单完成')?></h4><h4>
				</h4></li>
			</ul>
		</div>
		<div class="ncc-receipt-info">
            <h4 class="confirm"><?=('支付方式')?></h4>
            <div class="pay_way pay-selected" pay_id="1">
                <i></i><?=_('在线支付')?>
            </div>
            <!--<div class="pay_way" pay_id="3">
                <i></i><?/*=_('门店付款')*/?>
            </div>-->
            <div id="invoice_list" class="store-receipt-info current_box">
                <div class="store-candidate-items">
                    <div class="store-form-default">
                        <dl>
                            <dt><i class="required">*</i>门店：</dt>
                            <dd>
                                <div class="address-text">
                                    <input name="region" type="hidden"  value="<?=$chain_base['chain_name']?>（<?=$chain_base['chain_province']?> <?=$chain_base['chain_city']?> <?=$chain_base['chain_county']?>）">
                                    <span class="_region_value"><?=$chain_base['chain_name']?>（<?=$chain_base['chain_province']?> <?=$chain_base['chain_city']?> <?=$chain_base['chain_county']?>）</span>
                                    <input type="hidden" name="chain_id" id="chain_id"  value="<?=$chain_base['chain_id']?>">
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt><i class="required">*</i>收货人：</dt>
                            <dd>
                                <input type="text" class="text w100" name="true_name" maxlength="20" id="true_name" value="">
                            </dd>
                        </dl>
                        <dl>
                            <dt><i class="required">*</i>手机号码：</dt>
                            <dd>
                                <input type="text" class="text w200" name="mob_phone" id="mob_phone" maxlength="15" value="">
                                <span id="e_consignee_mobile_error"></span>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
		<h4 class="confirm contfirm_1"><?=_('门店自提类商品清单')?></h4>
		<div class="cart_goods">
			<ul class="cart_goods_head clearfix">
				<li class="price_all"><?=_('小计')?>(<?=(Web_ConfigModel::value('monetary_unit'))?>)</li>
				<li class="goods_num goods_num_1"><?=_('数量')?></li>
				<li class="goods_price goods_price_1"><?=_('单价')?>(<?=(Web_ConfigModel::value('monetary_unit'))?>)</li>
				<li class="goods_name goods_name_1"><?=_('商品')?></li>
			</ul>
			<ul class="cart_goods_list clearfix">
				<li>
					<div class="bus_imfor clearfix">
						<p class="bus_name">
							<span><i class="iconfont icon-icoshop"></i><a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&id=<?=($data['goods_base']['shop_id'])?>" class="cus_ser" ><?=($data['goods_base']['shop_name'])?></a></span>
                            <?php if($data['voucher_base']){?>
                                <div class="shop_voucher">
                                    <a class="show_voucher" onclick="showVoucher(this)"> </a>
                                    <?php if($data['voucher_base']){?>
                                        <div class="voucher_detail box_list">
                                            <div class="box_list_title">
                                                <div class="bk"><i class="iconfont icon-cuowu"></i></div>
                                                <span class="bbc_color">选择可用代金券</span>
                                            </div>
                                            <ul class="voucher clearfix">
                                                <?php foreach($data['voucher_base'] as $voukey => $vouval){?>
                                                    <li class="voucher_list">
                                                        <div class="quan_num"><?=(Web_ConfigModel::value('monetary_unit'))?><?=($vouval['voucher_price'])?></div>
                                                        <div class="quan_condition">
                                                            <span><?=($vouval['voucher_title'])?></span>
                                                            <span>
                                                                <?='满'.Web_ConfigModel::value('monetary_unit').number_format($vouval['voucher_limit']).'减'.Web_ConfigModel::value('monetary_unit').$vouval['voucher_price']?>
                                                            </span>
                                                            <span>
                                                                <time><?=date('Y-m-d',strtotime($vouval['voucher_start_date']))?></time>
                                                                <?=_('至')?>
                                                                <time><?=date('Y-m-d',strtotime($vouval['voucher_end_date']))?></time></span>
                                                            <span><?=($vouval['voucher_desc'])?></span>
                                                        </div>
                                                        <div>
                                                            <input type="hidden" name="shop_id" id="shop_id" value="<?=($vouval['voucher_shop_id'])?>">
                                                            <input type="hidden" name="voucher_id" id="voucher_id" value="<?=($vouval['voucher_id'])?>">
                                                            <input type="hidden" name="voucher_price" id="voucher_price" value="<?=($vouval['voucher_price'])?>">
                                                            <input type="hidden" name="voucher_price_rate" id="voucher_price_rate" value="<?=($vouval['voucher_price']*(100-$data['user_rate'])/100)?>">
                                                            <input type="hidden" name="voucher_code" id="voucher_code" value="<?=($vouval['voucher_code'])?>">
                                                            <a onclick="useVoucher(this)" class="quan_get"><?=_('使用')?></a>
                                                        </div>
                                                    </li>
                                                <?php }?>
                                            </ul>
                                        </div>
                                    <?php }?>
                                </div>
                            <?php }?>
						</p>
					</div>
					<table>
						<tbody class="rel_good_infor">

                            <!--结算 店铺头部满减送和加价购 S-->
                            <?php if($data['mansong_info'] || $data['increase_info']){?>
                                <tr class="row_line" >
                                    <td class="row_pro" colspan="8">
                                        <!--满减送 S-->
                                        <?php if($data['mansong_info']){?>
                                            <div class="bus_sale">
                                                <div class="fl">
                                                    <span class="full-icon">满减</span>
                                                    <span>
                                                                <?=_('活动商品已购满')?>
                                                        <em><?=format_money($data['mansong_info']['rule_price'])?></em>
                                                        <?php if(!empty($data['mansong_info']['rule_discount'])) { ?>
                                                            <span class="bbc_color">
                                                                        <?=_('（已减')?><?=(format_money($data['mansong_info']['rule_discount']))?><?=_('）')?>
                                                                    </span>
                                                        <?php } ?>
                                                        <?php if(!empty($data['mansong_info']['goods_id'])) { ?>
                                                            <?=_('，再送商品1件 > ')?>
                                                        <?php } ?>
                                                            </span>
                                                </div>
                                                <?php if(!empty($data['mansong_info']['goods_id'])) { ?>
                                                    <div class="fl get_div">
                                                        <i class="get" data-sid="<?=($key)?>" onclick="showManSong(this)"><?=_('查看赠品')?></i>
                                                        <?php if($data['mansong_info']['goods_id']){?>
                                                            <div class="sale_detail box_list mansong_info<?=($key)?>">
                                                                <div class="box_list_title">
                                                                    <div class="bk"><i class="iconfont icon-cuowu"></i></div>
                                                                    <span class="bbc_color">赠品已加入结算单</span>
                                                                </div>
                                                                <ul class="increase clearfix">
                                                                    <li class="increase_list">
                                                                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$data['mansong_info']['goods_id']?>" target="_blank">
                                                                            <div><img alt="<?=($data['mansong_info']['goods_name'])?>" src="<?=image_thumb($data['mansong_info']['goods_image'],60,60)?>"></div>
                                                                        </a>
                                                                        <div class="quan_condition">
                                                                            <span><a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($data['mansong_info']['goods_id'])?>" target="_blank"><?=($data['mansong_info']['goods_name'])?></a></span>
                                                                            <span><?=$data['mansong_info']['spec_str']?></span>
                                                                            <span><?=_('价格')?> <?=format_money($data['mansong_info']['goods_price'])?></span>
                                                                        </div>
                                                                        <div><a class="quan_get" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['mansong_info']['goods_id']?>" target="_blank"><?=_('查看')?></a></div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        <?php }?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php }?>
                                        <!--满减送 E-->

                                        <!--加价购 S-->
                                        <?php if($data['increase_info']){?>
                                            <?php foreach($data['increase_info'] as $incgkey => $incgval){?>
                                                <div class="bus_sale">
                                                    <div class="fl">
                                                        <span class="full-icon">换购</span>
                                                        <span><?=_('活动商品已购满')?> <?=format_money($incgval['rule_info']['rule_price'])?> </span>
                                                        <?=_('，可加价换购商品')?>
                                                        <?php if($incgval['rule_info']['rule_goods_limit']){echo $incgval['rule_info']['rule_goods_limit'].'件 > '; }?>
                                                    </div>
                                                    <div class="fl get_div">
                                                        <i class="get get_<?=($data['goods_base']['shop_id'])?>_<?=$incgkey?>" data-sid="<?=($data['goods_base']['shop_id'])?>" data-iid="<?=$incgkey?>" onclick="get(this)" ><?=_('换购商品')?></i>
                                                        <?php if($data['increase_info']){?>
                                                            <div class="sale_detail box_list increase_info<?=($incgkey)?>">
                                                                <div class="box_list_title">
                                                                    <div class="bk"><i class="iconfont icon-cuowu"></i></div>
                                                                    <span class="bbc_color">
                                                                                <?php if($incgval['rule_info']['rule_goods_limit']){echo '可换购最多'.$incgval['rule_info']['rule_goods_limit'].'件商品 '; }?>
                                                                            </span>
                                                                </div>
                                                                <ul class="increase clearfix">
                                                                    <input type="hidden" name="increase_id" value="<?=($incgkey)?>">
                                                                    <input type="hidden" name="exc_goods_limit" id="exc_goods_limit" value="<?=($incgval['rule_info']['rule_goods_limit'])?>">
                                                                    <input type="hidden" name="shop_id" id="shop_id" value="<?=($incgval['shop_id'])?>">
                                                                    <?php foreach($incgval['exc_goods'] as $excgkey => $excgval){?>
                                                                        <li class="increase_list">
                                                                            <input type="hidden" name="redemp_goods_id" id="redemp_goods_id" value="<?=($excgval['redemp_goods_id'])?>">
                                                                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($excgval['goods_id'])?>">
                                                                                <div class=""><img alt="<?=($excgval['goods_name'])?>" src="<?=image_thumb($excgval['goods_image'],60,60)?>"></div>
                                                                            </a>
                                                                            <div class="quan_condition">
                                                                                <span><a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($excgval['goods_id'])?>"><?=($excgval['goods_name'])?></a></span>
                                                                                <span><?=($excgval['spec_str'])?></span>
                                                                                <span><?=_('加购价')?> <?=format_money($excgval['redemp_price'])?></span>
                                                                                <input type="hidden" class="redemp_price" value="<?=($excgval['redemp_price'])?>">
                                                                                <input type="hidden" class="redemp_price_rate" value="<?=($excgval['redemp_price']*(100-$data['user_rate'])/100)?>">
                                                                            </div>
                                                                            <div><a onclick="jiabuy(this)" class="quan_get" data-param='{"increase_id":"<?=($incgkey)?>","id":"<?=($excgval['goods_id'])?>","name":"<?=($excgval['goods_name'])?>","price":"<?=($excgval['redemp_price'])?>","image":"<?=$excgval['goods_image']?>","spec":"<?=$excgval['spec_str']?>"}'><?=_('购买')?></a></div>
                                                                        </li>
                                                                    <?php }?>
                                                                </ul>
                                                            </div>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            <?php }?>
                                        <?php }?>
                                        <!--加价购 E-->
                                    </td>
                                </tr>
                            <?php }?>
                            <!--结算 店铺头部满减送和加价购 E-->

							<tr>
								<td class="goods_img"><img src="<?=($data['goods_base']['goods_image'])?>"/></td>
								<td class="goods_name" style="width:536px;"><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($data['goods_base']['goods_id'])?>"><?=($data['goods_base']['goods_name'])?></a>
									<p>
                                        <input type="hidden" id="goods_id" value="<?=($data['goods_base']['goods_id'])?>">
                                        <input type="hidden" id="goods_num" value="<?=($data['goods_num'])?>">
                                        <?=@$data['goods_base']['spec_str']?>
									</p>
								</td>
								<td class="goods_price goods_price_1 ">
									<?php if($data['old_price'] > 0){?><p class="ori_price"><?=($data['old_price'])?></p><?php }?>
									<p class="now_price"><?=($data['now_price'])?></p>
								</td>
								<td class="goods_num goods_num_1">
									<span><?=($data['goods_num'])?></span>
								</td>
								<td class="price_all">
									<span class="subtotal"><?=($data['sumprice'])?></span>
								</td>
							</tr>
						</tbody>
					</table>
				</li>
			</ul>
			<div class="goods_remark clearfix">
				<p class="remarks"><span><?=_('备注：')?></span><input placeholder="<?=_('补充填写其他信息,如有快递不到也请留言备注')?>" type="text" id="goodsremarks"></p>
			</div>
			<div class="frank clearfix">
				<span class="submit" style="text-align: center;">
					<span>
						<?=_('订单金额：')?>
						<strong>
							<?=(Web_ConfigModel::value('monetary_unit'))?><i class="total"><?=($data['sumprice'])?></i>
						</strong>
					</span>

                    <?php if($data['mansong_info'] && $data['mansong_info']['rule_discount']){?>
                        <span>
                            <?=_('店铺满减：')?>
                            <strong>
                                <i class="mansong"><?=_("-")?><?=(format_money($data['mansong_info']['rule_discount']))?></i>
                            </strong>
                        </span>
                    <?php }?>

                    <span class="clearfix shop_voucher<?=($data['goods_base']['shop_id'])?>" style="display: none; float: none;height:auto;">
                        <?=_('代金券：')?>
                        <strong>
                            <i class="voucher<?=($data['goods_base']['shop_id'])?>"></i>
                        </strong>
                    </span>

					<?php if($data['rate_price']){?>
						<span>
							<?=_('会员折扣：')?>
							<strong>
								-<?=(Web_ConfigModel::value('monetary_unit'))?>
                                <i class="rate_total"><?=number_format($data['rate_price'],2)?></i>
							</strong>
						</span>
					<?php }?>

                    <span><?=_('支付金额：')?><strong><?=(Web_ConfigModel::value('monetary_unit'))?><i class="after_total bbc_color"><?=number_format($data['total_price'],2)?></i></strong></span>

					<a id="pay_btn" class="bbc_btns"><?=_('提交订单')?></a>
                </span>
			</div>
		</div>
	</div>

	<!-- 订单提交遮罩 -->
	<div id="mask_box" style="display:none;">
		<div class='loading-mask'></div>
		<div class="loading">
			<div class="loading-indicator">
				<img src="<?= $this->view->img ?>/large-loading.gif" width="32" height="32" style="margin-right:8px;vertical-align:top;"/>
				<br/><span class="loading-msg"><?=_('正在提交订单，请稍后...')?></span>
			</div>
		</div>
	</div>

    <table style="display:none;">
        <tbody id="increase-goods-tpl">
            <tr class="increase_item__id">
                <td class="goods_img"><img data-src="__image"/></td>
                <td class="goods_name" style="width:536px;"><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=__id">__name</a>
                    <p>
                        __spec
                    </p>
                </td>
                <td class="goods_price goods_price_1 ">
                    <p class="now_price">__price</p>
                </td>
                <td class="goods_num goods_num_1">
                    <span>1</span>
                </td>
                <td class="price_all">
                    <span class="subtotal">__price</span>
                </td>
            </tr>
        </tbody>
    </table>


    <script type="text/javascript" src="<?=$this->view->js?>/chain.js"></script>

<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
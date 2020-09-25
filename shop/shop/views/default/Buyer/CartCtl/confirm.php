<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'site_nav.php';
?>

	<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/shop-cart.css" />

	<div class="wrap">
		<div class="head_cont clearfix">
			<div class="nav_left" style="float:none;">
				<a href="index.php" class="logo"><img src="<?=$this->web['web_logo']?>"/></a>
				<a href="#" class="download iconfont"></a>
			</div>
		</div>
	</div>
	<div class="wrap">
		<div class="shop_cart_head clearfix">
			<div class="cart_head_left">
				<h4><?=('确认订单')?></h4>
				<p><?=('请仔细核对收货,发货等信息,以确保物流快递能准确投递')?>.</p>
			</div>
			<ul class="cart_process">
				<li class="mycart">
					<i class="iconfont icon-wodegouwuche"></i>
					<div class="line">
						<p></p>
						<span></span>
					</div>
					<h4><?=('我的购物车')?><h4>
				</li>
				<li class="mycart process_selected1">
					<i class="iconfont icon-iconquerendingdan bbc_color"></i>
					<div class="line">
						<p class="bbc_border"></p>
						<span class="bbc_bg bbc_border"></span>
					</div>
					<h4 class="bbc_color"><?=('确认订单')?><h4>
				</li>
				<li class="mycart">
					<i class="iconfont icon-icontijiaozhifu"></i>
					<div class="line">
						<p></p>
						<span></span>
					</div>
					<h4><?=('支付提交')?><h4>
				</li>
				<li class="mycart">
					<i class="iconfont icon-dingdanwancheng"></i>
					<div class="line">
						<p></p>
						<span></span>
					</div>
					<h4><?=('订单完成')?><h4>
				</li>
			</ul>
		</div>
		<ul class="receipt_address clearfix">
		<div id="address_list">
		<?php if(isset($data['address'])){$total = 0; $total_dian_rate = 0; foreach ($data['address'] as $key => $value) {
		?>
			<li class="<?php if(!$address_id && $value['user_address_default'] == 1){?>add_choose<?php }?><?php if($address_id && $value['user_address_id'] == $address_id){?>add_choose<?php }?> " id="addr<?=($value['user_address_id'])?>">
				<input type ="hidden" id="address_id" value="<?=($value['user_address_id'])?>">
				<input type="hidden" id="user_address_province_id" value="<?=($value['user_address_province_id'])?>">
				<input type="hidden" id="user_address_city_id" value="<?=($value['user_address_city_id'])?>">
				<input type="hidden" id="user_address_area_id" value="<?=($value['user_address_area_id'])?>">
				<div class="editbox">
					<a class="edit_address" data_id="<?=($value['user_address_id'])?>"><?=('编辑')?></a>
					<a class="del_address" data_id="<?=($value['user_address_id'])?>"><?=('删除')?></a>
				</div>
				<h5><?=($value['user_address_contact'])?></h5>
				<p><?=($value['user_address_area'])?> <?=($value['user_address_address'])?></p>
				<div><span class="phone"><i class="iconfont icon-shouji"></i><span><?=($value['user_address_phone'])?></span></span></div>
			</li>
			<?php }}?>
		</div>
			<div class="add_address">
				<a><?=_('+')?></a>
			</div>
		</ul>

		<h4 class="confirm"><?=('支付方式')?></h4>
			<div class="pay_way pay-selected" pay_id="1">
				<i></i><?=_('在线支付')?>
			</div>
			<!--<div class="pay_way" pay_id="2">
				<i></i><?/*=_('货到付款')*/?>
			</div>-->
		<h4 class="confirm"><?=('确认商品信息')?></h4>
		<div class="cart_goods">
			<ul class='cart_goods_head clearfix'>
				<li class="price_all"><?=('小计')?>(<?=(Web_ConfigModel::value('monetary_unit'))?>)</li>
				<li class="goods_num"><?=('数量')?></li>
                <li class="confirm_sale"><?=('分享立减')?></li>
				<li class="confirm_sale"><?=('优惠')?></li>
				<li class="goods_price"><?=('单价')?>(<?=(Web_ConfigModel::value('monetary_unit'))?>)</li>
				<li class="goods_name"><?=('商品')?></li>
				<li class="cart_goods_all"></li>
			</ul>
			<?php foreach($data['glist'] as $key=>$val){?>
                <ul class="cart_goods_list clearfix">
                    <li>
                        <div class="bus_imfor clearfix">
                            <p class="bus_name">
                                <span>
                                    <i class="iconfont icon-icoshop"></i>
                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&id=<?=($key)?>"><?=($val['shop_name'])?></a>
                                    <?php if($val['shop_self_support'] == 'true'){ ?>
                                        <span>自营店铺</span>
                                    <?php } ?>
                                </span>
                            </p>
                            <!--结算 已领 可用代金券 S-->
                            <?php if($val['voucher_base']){?>
                                <div class="shop_voucher">
                                    <a class="show_voucher" onclick="showVoucher(this)"> </a>
                                    <?php if($val['voucher_base']){?>
                                        <div class="voucher_detail box_list">
                                            <div class="box_list_title">
                                                <div class="bk"><i class="iconfont icon-cuowu"></i></div>
                                                <span class="bbc_color">选择可用代金券</span>
                                            </div>
                                            <ul class="voucher clearfix">
                                                <?php foreach($val['voucher_base'] as $voukey => $vouval){?>
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
                                                            <input type="hidden" name="voucher_price_rate" id="voucher_price_rate" value="<?=($vouval['voucher_price']*(100-$val['user_rate'])/100)?>">
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
                            <!--结算 已领 可用代金券 E-->
                        </div>
                        <table>
                            <tbody class="rel_good_infor rel_good_infor2 tbody<?=($key)?>">
                                <!--结算 店铺头部满减送和加价购 S-->
                                <?php if($val['mansong_info'] || $val['increase_info']){?>
                                    <tr class="row_line" >
                                        <td class="row_pro" colspan="8">
                                            <!--满减送 S-->
                                            <?php if($val['mansong_info']){?>
                                                <div class="bus_sale">
                                                    <div class="fl">
                                                        <span class="full-icon">满减</span>
                                                        <span>
                                                            <?=_('活动商品已购满')?>
                                                            <em><?=format_money($val['mansong_info']['rule_price'])?></em>
                                                            <?php if(!empty($val['mansong_info']['rule_discount'])) { ?>
                                                                <span class="bbc_color">
                                                                    <?=_('（已减')?><?=(format_money($val['mansong_info']['rule_discount']))?><?=_('）')?>
                                                                </span>
                                                            <?php } ?>
                                                            <?php if(!empty($val['mansong_info']['goods_id'])) { ?>
                                                                <?=_('，再送商品1件 > ')?>
                                                            <?php } ?>
                                                        </span>
                                                    </div>
                                                    <?php if(!empty($val['mansong_info']['goods_id'])) { ?>
                                                        <div class="fl get_div">
                                                            <i class="get" data-sid="<?=($key)?>" onclick="showManSong(this)"><?=_('查看赠品')?></i>
                                                            <?php if($val['mansong_info']['goods_id']){?>
                                                                <div class="sale_detail box_list mansong_info<?=($key)?>">
                                                                    <div class="box_list_title">
                                                                        <div class="bk"><i class="iconfont icon-cuowu"></i></div>
                                                                        <span class="bbc_color">赠品已加入结算单</span>
                                                                    </div>
                                                                    <ul class="increase clearfix">
                                                                        <li class="increase_list">
                                                                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$val['mansong_info']['goods_id']?>" target="_blank">
                                                                                <div><img alt="<?=($val['mansong_info']['goods_name'])?>" src="<?=image_thumb($val['mansong_info']['goods_image'],60,60)?>"></div>
                                                                            </a>
                                                                            <div class="quan_condition">
                                                                                <span><a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($val['mansong_info']['goods_id'])?>" target="_blank"><?=($val['mansong_info']['goods_name'])?></a></span>
                                                                                <span><?=$val['mansong_info']['spec_str']?></span>
                                                                                <span><?=_('价格')?> <?=format_money($val['mansong_info']['goods_price'])?></span>
                                                                            </div>
                                                                            <div><a class="quan_get" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$val['mansong_info']['goods_id']?>" target="_blank"><?=_('查看')?></a></div>
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
                                            <?php if($val['increase_info']){?>
                                                <?php foreach($val['increase_info'] as $incgkey => $incgval){?>
                                                    <div class="bus_sale">
                                                        <div class="fl">
                                                            <span class="full-icon">换购</span>
                                                            <span><?=_('活动商品已购满')?> <?=format_money($incgval['rule_info']['rule_price'])?> </span>
                                                            <?=_('，可加价换购商品')?>
                                                            <?php if($incgval['rule_info']['rule_goods_limit']){echo $incgval['rule_info']['rule_goods_limit'].'件 > '; }?>
                                                        </div>
                                                        <div class="fl get_div">
                                                            <i class="get get_<?=($key)?>_<?=$incgkey?>" data-sid="<?=($key)?>" data-iid="<?=$incgkey?>" onclick="get(this)" ><?=_('换购商品')?></i>
                                                            <?php if($val['increase_info']){?>
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
                                                                                    <input type="hidden" class="redemp_price_rate" value="<?=($excgval['redemp_price']*(100-$val['user_rate'])/100)?>">
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

                                <!--结算 店铺商品 S-->
                                <?php foreach($val['goods'] as $k=>$v){ ?>
                                    <?php if($v['bl_id']){?>
                                        <tr class="row_line">
                                            <td class="goods_sel cart-checkbox bl">
                                                <p>
                                                    <input type="hidden" name="cart_id" value="<?=($v['cart_id'])?>">
                                                </p>
                                            </td>
                                            <td class="goods_img"><strong><?=_('【优惠套装】')?></strong></td>
                                            <td class="goods_name_reset">
                                                <a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=bundling&bid=<?=$v['bl_id']?>"><?php echo $v['bundling_info']['bundling_name'];?></a>
                                            </td>

                                            <td class="goods_price">
                                                <?php if($v['old_price']){ ?>
                                                    <p class="ori_price"><?=($v['old_price'])?></p>
                                                <?php }?>
                                                    <p class="now_price"><?=number_format($v['now_price'],2)?></p>
                                            </td>
                                            <td class="confirm_sale">
                                                <p class="sal_price">
                                                    <?=('套装优惠')?>
                                                </p>
                                                <p>
                                                    <?=('-').format_money($v['down_price'])?>
                                                </p>
                                            </td>
                                            <td class="confirm_sale">
                                                <?php if(isset($v['share_price'])): ?>
                                                    <input type="hidden" name="share_price_id[]" value="<?=($v['share_price_id'])?>">
                                                    <p class="sal_price">
                                                        <?php if($v['share_price']){?><?=_('分享立减：')?><?=format_money($v['share_price'])?><?php echo '，最多'.$v['share_limit'].'件';} ?>
                                                    </p>
                                                <?php endif; ?>
                                            </td>
                                            <td class="goods_num">
                                                <span><?=($v['goods_num'])?></span>
                                            </td>
                                            <td class="price_all cell<?php echo $v['cart_id'];?>">
                                                <span class="subtotal"><?php echo $v['sumprice'];?></span>
                                            </td>
                                        </tr>
                                        <?php if($v['bundling_info']['goods_list']){?>
                                            <?php foreach ($v['bundling_info']['goods_list'] as $k_goods => $v_goods){?>
                                                <tr class="row_line bundling_list">
                                                    <td class="goods_sel cart-checkbox">

                                                    </td>
                                                    <td class="goods_img"><img src="<?=($v_goods['goods_image'])?>"/></td>
                                                    <td class="goods_name_reset">
                                                        <a  target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?=($v_goods['goods_id'])?>"><?=($v_goods['goods_name'])?></a>
                                                    </td>

                                                    <td class="goods_price">
                                                        <p class="ori_price"><?=$v_goods['goods_price']?></p>
                                                        <p class="now_price"><?=$v_goods['bundling_goods_price']?></p>
                                                    </td>
                                                    <td class="confirm_sale">
                                                        <!--<p class="sal_price">
                                                            <?/*=('套装,优惠：').format_money($v_goods['goods_price'] - $v_goods['bundling_goods_price'])*/?>
                                                        </p>-->
                                                    </td>
                                                    <td class="confirm_sale">

                                                    </td>
                                                    <td class="goods_num">
                                                        <span><?=($v['goods_num'])?></span>
                                                    </td>
                                                    <td class="price_all cell<?=($v_goods['goods_id'])?>">
                                                        <span class="subtotal"><?=number_format($v_goods['bundling_goods_price']*$v['goods_num'],2)?></span>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                        <?php }?>
                                    <?php }else{?>
                                        <tr class="row_line">
                                            <td class="goods_sel">
                                                <p>
                                                    <input type="hidden" name="cart_id" value="<?=($v['cart_id'])?>">
                                                </p>
                                            </td>
                                            <td class="goods_img"><img src="<?=($v['goods_base']['goods_image'])?>"/></td>
                                            <td class="goods_name_reset">
                                                <a  target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($v['goods_base']['goods_id'])?>"><?=($v['goods_base']['goods_name'])?></a>
                                                <p>
                                                    <?=$v['goods_base']['spec_str'];?>
                                                </p>
                                            </td>
                                            <td class="goods_price">
                                                <?php if($v['old_price'] > 0){?><p class="ori_price"><?=($v['old_price'])?></p><?php }?>
                                                <p class="now_price"><?=($v['now_price'])?></p>
                                            </td>
                                            <td class="confirm_sale">
                                                <?php if(isset($v['goods_base']['promotion'])): ?>
                                                    <?php if($v['goods_base']['promotion']){ ?>
                                                        <p class="sal_price">
                                                            <?=_($v['goods_base']['promotion']['promotion_type_con'])?>
                                                        </p>
                                                        <?php if($v['goods_base']['promotion']['promotion_type'] != Goods_CommonModel::FU){ ?>
                                                            <p class="sal_price">
                                                                <?=('-').format_money($v['goods_base']['promotion']['down_price'])?>
                                                            </p>
                                                        <?php } ?>

                                                        <p class="sal_price">
                                                            <?php if($v['goods_base']['promotion']['upper_limit']){ ?>
                                                                <?=_('最多'.$v['goods_base']['promotion']['upper_limit'].'件')?>
                                                            <?php } ?>
                                                            <?php if($v['goods_base']['promotion']['lower_limit']){ ?>
                                                                <?=_('，最低'.$v['goods_base']['promotion']['lower_limit'].'件')?>
                                                            <?php } ?>
                                                        </p>
                                                    <?php } ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="confirm_sale">
                                                <?php if(isset($v['share_price'])): ?>
                                                    <input type="hidden" name="share_price_id[]" value="<?=($v['share_price_id'])?>">
                                                    <p class="sal_price">
                                                        <?php if($v['share_price']){?><?=_('分享立减：')?><?=format_money($v['share_price'])?><?php echo '，最多'.$v['share_limit'].'件';} ?>
                                                    </p>
                                                <?php endif; ?>
                                            </td>

                                            <td class="goods_num">
                                                <span><?=($v['goods_num'])?></span>
                                            </td>
                                            <td class="price_all">
                                                <span class="subtotal"><?=($v['sumprice'])?></span>
                                                <?php if(!$v['buy_able']){?><p class="colred"><?=_('无货')?></p><?php }?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                <?php }?>
                                <!--结算 店铺商品 E-->

                                <!--结算 满送商品 S-->
                                <?php if($val['mansong_info'] && $val['mansong_info']['goods_id']){?>
                                    <tr class="row_line row_mansong_<?=$val['mansong_info']['goods_id']?>">
                                        <td class="goods_sel">

                                        </td>
                                        <td class="goods_img">
                                            <img src="<?=($val['mansong_info']['goods_image'])?>"/>
                                        </td>
                                        <td class="goods_name_reset">
                                            <span class="full-icon">满送</span>
                                            <a  target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($val['mansong_info']['goods_id'])?>"><?=($val['mansong_info']['goods_name'])?></a>
                                            <p>
                                                <?php if(!empty($val['mansong_info']['spec_str'])){ ?>
                                                    <?=($val['mansong_info']['spec_str'])?>
                                                <?php }?>
                                            </p>
                                        </td>
                                        <td class="goods_price">
                                            <p class="now_price"><?=($val['mansong_info']['goods_price'])?></p>
                                        </td>
                                        <td class="confirm_sale">
                                            <p class="sal_price">
                                                满送商品
                                            </p>
                                        </td>
                                        <td class="confirm_sale">

                                        </td>
                                        <td class="goods_num">
                                            <span>1</span>
                                        </td>
                                        <td class="price_all">
                                            <span class="subtotal">0.00</span>
                                        </td>
                                    </tr>
                                <?php }?>
                                <!--结算 满送商品 E-->
                            </tbody>
                        </table>
                    </li>
                </ul>
                <div class="goods_remark clearfix">
                    <p class="remarks"><span><?=_('备注：')?></span><input type="text" class="remarks_content" name="remarks" id="<?=($key)?>" placeholder="<?=_('限45个字（定制类商品，请将购买需求在备注中做详细说明）')?>"><?=_('提示：请勿填写有关支付、收货、发票方面的信息')?></p>
                    <div class="order_total">
                        <p class="clearfix">
                            <span><?=_('商品金额')?></span>
                            <i class="price<?=($key)?>"><?=number_format($val['sprice'],'2','.','')?></i>
                            <i><?=(Web_ConfigModel::value('monetary_unit'))?></i>
                        </p>
                        <?php if($val['mansong_info'] && $val['mansong_info']['rule_discount']){?>
                            <p class="clearfix">
                                <span><?=_('满减')?></span>
                                <i class="mansong<?=($key)?>" data-price="<?=($val['mansong_info']['rule_discount'])?>"><?=_("-")?><?=(format_money($val['mansong_info']['rule_discount']))?></i>
                            </p>
                        <?php }?>
                        <p class="clearfix shop_voucher<?=($key)?>" style="display: none;">
                            <span><?=_('代金券')?></span>
                            <i class="voucher<?=($key)?>"></i>
                        </p>
                        <?php if(isset($val['rate_price']) && $val['rate_price']){?>
                            <p class="clearfix">
                                <span>
                                    <?='会员折扣('?>
                                    <em class="bbc_color"><?=number_format($val['user_rate']/10,2).'折'?></em>
                                    <?=')'?>
                                </span>
                                <em></em>
                                <i>
                                    <?=_("-")?>
                                    <i class="shoprate<?=($key)?>"><?=number_format($val['rate_price'],2,'.','')?></i>
                                    <i><?=(Web_ConfigModel::value('monetary_unit'))?></i>
                                </i>
                            </p>
                        <?php }?>
                        <p class="clearfix trans<?=($key)?>">
                            <span><?=_('物流运费')?></span>
                            <i class="trancost<?=($key)?>">
                                <?php if(isset($val['cost']) && $val['cost'] > 0){?>
                                    <?=format_money($val['cost'])?>
                                <?php }else{ ?>
                                    <?=_('免运费')?>
                                <?php }?>
                            </i>
                        </p>
                        <p class="dian_total clearfix">
                            <span class=""><?=_('本店合计')?></span>
                            <em></em>
                            <i class="sprice<?=($key)?>">
                                <?=number_format($val['total_price'],'2','.','')?>
                            </i>
                            <i><?=(Web_ConfigModel::value('monetary_unit'))?></i>
                        </p>

                        <?php if(isset($val['distributor_rate'])){?>
                            <p class="clearfix">
                            <span><?=_('分销商优惠')?></span>
                            <i><?=number_format($val['distributor_rate'],2,'.','')?></i>
                            </p>
                        <?php }?>

                    </div>
                </div>
			<?php }?>
			<div class="frank clearfix">
				<div class="invoice">
					<h3><?=_('发票信息')?></h3>
					<div class="invoice-cont">
						<input type="hidden" name="invoice_id" value="">
						<span class="mr10"> <?=_('不开发票')?> </span><a class="invoice-edit"><?=_('修改')?></a>
					</div>
				</div>

				<?php if($data['rpt_list']){ ?>
                    <div id="rpt_panel" style="">
                        <div class="ncc-store-account">
                            <dl>
                                <dt style="width:auto;">平台红包：</dt>
                                <dd class="rule">
                                    <select nctype="rpt" id="rpt" name="rpt" class="select" data-last="0">
                                    </select>
                                </dd>
                                <dd class="sum"><em class="subtract">-￥<i id="orderRpt"></i></em></dd>
                            </dl>
                        </div>
                    </div>
				<?php } ?>

				<p class="back_cart"><a id="back_cart"><i class="iconfont icon-iconjiantouzuo rel_top2"></i><?=_('返回我的购物车')?></a></p>

				<p class="submit" style="text-align: center;">
					<span>
						<?=_('订单金额：')?>
                        <strong>
                            <?=(Web_ConfigModel::value('monetary_unit'))?><i class="total"><?=number_format($data['total_price'],'2','.','')?></i>
                        </strong>
					</span>
					<span>
						<?=_('支付金额：')?>
						<strong class="common-color">
							<?=(Web_ConfigModel::value('monetary_unit'))?><i class="after_total bbc_color"><?=number_format($data['total_price'],'2','.','')?></i>
						</strong>
					</span>
					<a id="pay_btn" class="bbc_btns"><?=_('提交订单')?></a>
				</p>

			</div>

            <table style="display:none;">
                <tbody id="increase-goods-tpl">
                    <tr class="row_line increase_item__id">
                        <td class="goods_sel">
                        </td>
                        <td class="goods_img">
                            <img data-src="__image"/>
                        </td>
                        <td class="goods_name_reset">
                            <span class="full-icon">换购</span>
                            <a  target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=__id">__name</a>
                            <p>
                                __spec
                            </p>
                        </td>
                        <td class="goods_price">
                            <p class="now_price">__price</p>
                        </td>
                        <td class="confirm_sale">
                            <p class="sal_price">换购商品</p>
                        </td>
                        <td class="confirm_sale">
                        </td>
                        <td class="goods_num">
                            <span>1</span>
                        </td>
                        <td class="price_all">
                            <span class="subtotal">__price</span>
                        </td>
                    </tr>
                </tbody>
            </table>
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


    <script type="text/javascript" src="<?=$this->view->js?>/cart.js"></script>

    <script>
        var app_id = <?=(YLB_Registry::get('shop_app_id'))?>;
        var buy_able = <?=intval($data['buy_able']) ? intval($data['buy_able']) : 0?>;

        if (<?=($user_rate)?>) {
            rate = <?=($user_rate)?>;
        } else {
            rate = 100;
        }

        var  rpt_list_json = <?=encode_json($data['rpt_list'])?>;
        //初始化平台优惠券
        function iniRpt(order_total) {
            var _tmp, _hide_flag = true;
            $('#rpt').empty();
            $('#rpt').attr("data-last",'0')
            /*var oldvalue = $('#rpt').attr("data-last");
            var items = [];
            if(oldvalue !== '0'){
                items = oldvalue.split('|');
            }*/
            $('#rpt').append('<option  value="|0.00">-选择使用平台优惠券-</option>');
            for (i = 0; i < rpt_list_json.length; i++) {
                _tmp = parseFloat(rpt_list_json[i]['redpacket_t_orderlimit']);
                order_total = parseFloat(order_total);
                if (order_total > 0 && order_total >= _tmp.toFixed(2)) {
                    /*if(items[0] && items[0] == rpt_list_json[i]['redpacket_id']){
                        checked = 'selected';
                    }else{
                        checked = '';
                    }*/
                    $('#rpt').append("<option value='" + rpt_list_json[i]['redpacket_id'] + '|' + rpt_list_json[i]['redpacket_price'] + "'>" + rpt_list_json[i]['redpacket_title'] + "</option>")
                    _hide_flag = false;
                }
            }
            if (_hide_flag) {
                $('#rpt_panel').hide();
            } else {
                $('#rpt_panel').show();
            }

            /*if(items[1]){
                var price = Number(items[1]);
                var allTotal = parseFloat($('.after_total').html());
                var paytotal = allTotal + price*(-1);
                if (paytotal < 0) paytotal = 0;

                $('#orderRpt').html(price.toFixed(2));
                $('.after_total').html(paytotal.toFixed(2));
            }*/
        }

        //选择代金券后 清除平台红包选择
        function clanRpt() {
            var allTotal = parseFloat($('.after_total').html());
            var orderRpr = $('#orderRpt').html();
            if (orderRpr !== undefined) {
                orderRpr = Number($('#orderRpt').html());
                $('#orderRpt').html('0.00');
                var paytotal = allTotal + orderRpr * 1;
                $('.after_total').html(paytotal.toFixed(2));
            }
        }

        $(function() {

            $(".remarks_content").val("");
            $(".remarks_content").keyup(function(){
                var len = $(this).val().length;
                if(len > 45){
                    $(this).val($(this).val().substring(0,45));
                }
            });

            var allTotal = <?=$data['total_price']?>;

            if (rpt_list_json.length == 0) {
                $('#rpt_panel').remove();
            }

            if ($('#orderRpt').length > 0) {
                iniRpt(allTotal.toFixed(2));
                $('#orderRpt').html('0.00');
            }

            $('#rpt').on('change', function() {
                var oldvalue = $(this).attr("data-last");

                var allTotal = parseFloat($('.after_total').html());
                var items = $(this).val().split('|');

                if (oldvalue != '0') {
                    //var items0 = oldvalue.split('|');
                    allTotal += parseFloat(items[1]);
                }

                if (items[0] == '') {
                    var orderRpr = Number($('#orderRpt').html());
                    $('#orderRpt').html('0.00');
                    var paytotal = allTotal + Math.abs(orderRpr);
                    $('.after_total').html(paytotal.toFixed(2));
                    $(this).attr("data-last", '0');
                } else {
                    var price = Number(items[1]);
                    $('#orderRpt').html(price.toFixed(2));
                    var paytotal = allTotal + price*(-1);
                    if (paytotal < 0) paytotal = 0;

                    $('.after_total').html(paytotal.toFixed(2));
                    $(this).attr("data-last", $(this).val());
                }
            });
        });

    </script>
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
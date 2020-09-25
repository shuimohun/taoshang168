<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'site_nav.php';
?>

<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/shop-cart.css" />
<script type="text/javascript" src="<?=$this->view->js?>/points_cart.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/alert.js"></script>
<script  type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.dialog.js"></script>
<link type="text/css" rel="stylesheet" href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css">
<link href="<?=$this->view->css?>/tips.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>


	<div class="wrap">
		<div class="head_cont clearfix">
			<div class="nav_left">
				<a href="<?=YLB_Registry::get('url')?>" class="logo"><img src="<?=$this->web['web_logo']?>"/></a>
				<a href="#" class="download iconfont"></a>
			</div>
		</div>
	</div>
	<div class="wrap">
		<div class="shop_cart_head clearfix">
			<div class="cart_head_left">
				<h4><?=_('确认收货人资料')?></h4>
				<p><?=_('请仔细核对收货,发货等信息,以确保物流快递能准确投递.')?></p>
			</div>
			<ul class="cart_process">
				<li class="mycart">
					<i class="iconfont icon-wodegouwuche"></i>
					<div class="line">
						<p></p>
						<span></span>
					</div>
					<h4><?=_('确认兑换清单')?><h4>
				</li>
				<li class="mycart process_selected1">
					<i class="iconfont icon-iconquerendingdan bbc_color"></i>
					<div class="line">
						<p class="process_selected2 bbc_border"></p>
						<span class="process_selected2 process_selected3  bbc_bg bbc_border"></span>
					</div>
					<h4 class="bbc_color"><?=_('确认收货人资料')?><h4>
				</li>
				<li class="mycart">
					<i class="iconfont icon-dingdanwancheng"></i>
					<div class="line">
						<p></p>
						<span></span>
					</div>
					<h4><?=_('订单完成')?><h4>
				</li>
			</ul>
		</div>
		<ul class="receipt_address clearfix">
		<div id="address_list">
		<?php if(isset($data['address'])){$total = 0; foreach ($data['address'] as $key => $value) {
		?>
			<li class="<?php if($value['user_address_default'] == 1){?>add_choose<?php }?>" id="addr<?=($value['user_address_id'])?>">
				<div class="editbox">
					<a onclick="edit_address(<?=($value['user_address_id'])?>)" href="javascritp:vode(0)"><?=_('编辑')?></a>
					<a onclick="del_address(<?=($value['user_address_id'])?>)" href="javascritp:vode(0)"><?=_('删除')?></a>
				</div>
				<h5><?=($value['user_address_contact'])?></h5>
				<p><?=($value['user_address_area'])?> <?=($value['user_address_address'])?></p>
				<div><span class="phone"><i class="iconfont icon-shouji"></i><span><?=($value['user_address_phone'])?></span></span></div>
			</li>
			<?php }}?>
		</div>
			<div class="add_address">
				<a href="#">+</a>
			</div>
		</ul>
		<div class="cart_goods">
			<ul class='cart_goods_head cart_goods_head_return clearfix'>
				<li class="cart_goods_all" style="width:70px;"></li>
				<li style="width:688px;" colspan="2"><?=_('礼品名称')?></li>
				<li style="width:140px;"><?=_('兑换金蛋')?></li>
				<li style="width:140px;"><?=_('兑换数量')?></li>
				<li style="width:140px;"><?=_('金蛋小计')?></li>
			</ul>

			<ul class="cart_goods_list clearfix">
				<li>
					<table class="table_bord_return">
						<tbody class="rel_good_infor">
						<?php foreach($data['items'] as $key=>$value){ ?>
                            <input type="hidden" name="cart_id" value="<?=$value['points_cart_id']?>">
                            <tr>
								<td class="goods_img"><img src="<?=image_thumb($value['points_goods_image'],82,82)?>"/></td>
								<td class="goods_name_reset" style="width:645px;"><a href="<?=YLB_Registry::get('url')?>?ctl=Points&met=detail&id=<?=($value['points_goods_id'])?>"><?=($value['points_goods_name'])?></a></td>
								<td class=""><?=$value['points_goods_points']?></td>
								<td class=""><span><?=$value['points_goods_choosenum']?></span></td>
								<td class=""><span class="subtotal"><?=$value['total_points']?></span></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</li>
			</ul>
            <div class="goods_remark clearfix">
                <p class="remarks"><span><?=_('备注')?>：</span><input name="remarks" type="text" placeholder="<?=_('补充填写其他信息,如有快递不到也请留言备注')?>"></p>
            </div>
			<div class="frank clearfix">
                <p class="back_cart"><a href="javascript:void(0);"><i class="iconfont icon-iconjiantouzuo rel_top2"></i><?=_('返回我的购物车')?></a></p>
				<p class="submit submit2"><span><?=_('所需总金蛋')?>：<i class="total bbc_color"><?=(number_format($data['total_points']) )?></i> <?=_('金蛋')?></span><a id="pay_btn" class="bbc_bg"><?=_('确认兑换')?></a></p>
			</div>
		</div>
	</div>


<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
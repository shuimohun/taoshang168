<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'site_nav.php';
?>

<link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/points_cart.js"></script>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/shop-cart.css" />

<div class="wrap">
	<div class="head_cont clearfix">
		<div class="nav_left">
			<a href="<?=YLB_Registry::get('url')?>" class="logo"><img src="<?=$this->web['web_logo']?>"/></a>
			<a href="#" class="download iconfont"></a>
		</div>
	</div>
</div>

<div class="wrap wrap_w">
	<div class="shop_cart_head clearfix">
		<div class="shop_cart_head clearfix">
			<div class="cart_head_left">
				<h4><?=_('确认兑换清单')?></h4>
				<p><?=_('请确认金蛋将要兑换的商品以及金蛋数')?></p>
			</div>
			<ul class="cart_process">
				<li class="mycart process_selected1">
					<i class="iconfont icon-wodegouwuche bbc_color"></i>
					<div class="line">
						<p class="process_selected2  bbc_border"></p>
						<span class="process_selected2 process_selected3  bbc_bg bbc_border"></span>
					</div>
					<h4 class="bbc_color"><?=_('确认兑换清单')?><h4>
				</li>
				<li class="mycart">
					<i class="iconfont icon-iconquerendingdan"></i>
					<div class="line">
						<p></p>
						<span></span>
					</div>
					<h4><?=_('确认收货人资料')?><h4>
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
	</div>

	<?php if(!$data){?>
		<div class="cart_empty clearfix">
			<div class="cart_log">
				<img src="<?=$this->view->img?>/empty.png"/>
			</div>
			<div class="empty-warn">
				<p><?=_('您还没有选择兑换礼品')?></p>
				<div>
					<a href="<?=YLB_Registry::get('url')?>?ctl=Points&met=pList"><span class="iconfont icon-mashangqugouwu vermiddle"></span><?=_('马上去兑换')?></a>
					<a href="<?=YLB_Registry::get('url')?>?ctl=Buyer_Points&met=points&op=getPointsOrder"><span class="iconfont icon-chakandingdan vermiddle f18"></span><?=_('查看已兑换信息')?></a>
				</div>
			</div>
		</div>
	<?php }else{?>
	<ul class="cart_goods_type clearfix">
		<li><a href="#" class="goods_selected"><?=_('全部商品')?></a></li>
	</ul>
	<div class="cart_goods">
		<ul class='cart_goods_head clearfix'>
            <li class="done"><?=_('操作')?></li>
            <li class="price_all"><?=_('小计(金蛋)')?></li>
             <li class="goods_num"><?=_('数量')?></li>
            <li class="goods_price"><?=_('单价(金蛋)')?></li>
            <li class="goods_name2"><?=_('商品')?></li>
            <li class="cart_goods_all cart-checkbox "><input class="checkall" type="checkbox" data-type="all"><div class="select_all"><?=_('全选')?></div></li>
		</ul>
		<form id="form" action="<?=YLB_Registry::get('url')?>?ctl=Points&met=confirm&typ=e" method='post'>
		<ul class="cart_goods_list clearfix">
				<li>
					<table id="table_list">
						<tbody class="rel_good_infor">
						<?php foreach($data['items'] as $key=>$value){?>
							<tr class="row_line">
								<td class="goods_sel cart-checkbox">
									<p class="exc_inp">
										<input class="checkitem" type="checkbox" name="points_cart_id[]" value="<?=$value['points_cart_id']?>">
									</p>
								</td>
								<td class="goods_img"><img src="<?=image_thumb($value['points_goods_image'],82,82)?>"/></td>
								<td class="goods_name_reset"><a href="<?=YLB_Registry::get('url')?>?ctl=Points&met=detail&id=<?=$value['points_goods_id']?>"><?=($value['points_goods_name'])?></a></td>
								<td class="goods_message">
								</td>
								<td class="goods_price"></td>
								<td class="goods_num">
									<a class="<?php if($value['points_goods_choosenum'] == 1){?>no_<?php }?>reduce" >-</a><input class="exchange_hight" id="nums" data-id="<?=($value['points_cart_id'])?>" data-max="<?=($value['points_goods_stock'])?>" value="<?=($value['points_goods_choosenum'])?>"><a class="<?php if($value['points_goods_stock'] <= 1){?>no_<?php }?>add" >+</a>
								</td>
								<td class="price_all cell<?=($value['points_cart_id'])?>">
									<span class="subtotal"><?=($value['total_points'])?></span>
								</td>
								<td class="done del"><a data-param="{'ctl':'Points','met':'removePointsCart','id':'<?=($value['points_cart_id'])?>'}">删除</a></td>
							</tr>
						<?php }?>
						</tbody>
					</table>
				</li>
		</ul>
		</form>
	</div>
	<div class="pay_fix">
		<div class="wrap wrap3 cart-checkbox">
			<div class="clearfix cart_pad">
				<input class="checkall" type="checkbox" data-type="all">
				<div class="select_all"><?=_('全选')?></div>
				<div  class="delete"><?=_('删除')?></div>
				<a class="submit-btn-disabled submit-btn bbc_bg"><?=_('确认兑换')?><span class="iconfont icon-btnrightarrow"></span></a>
				<div class="cart-sum">
					<span><?=_('所需总金蛋')?>：</span>
					<strong class="Price common-color"><em class="subtotal subtotal_all bbc_color"><?=$data['total_points']?></em><?=_('金蛋')?></strong>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
</div>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'site_nav.php';
?>

<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/shop-cart.css" />
<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/style3.css" />
<link rel="stylesheet"  type="text/css" href="<?=$this->view->css?>/iconfont/iconfont.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/index.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/cart.js"></script>

<div class="wrap">
	<div class="shop_cart_head clearfix">
		<div class="cart_head_left">
			<h4>订单完成</h4>
			<p>订单详情内容可通过查看<a href="#">我的订单</a>进行核对处理</p>
		</div>
		<ul class="cart_process">
			<li class="mycart">
				<i class="iconfont">&#xe643;</i>
				<div class="line">
					<p></p>
					<span></span>
				</div>
				<h4>确认兑换订单<h4>
			</li>
			<li class="mycart">
				<i class="iconfont">&#xe643;</i>
				<div class="line">
					<p ></p>
					<span></span>
				</div>
				<h4>确认收货人资料<h4>
			</li>
			<li class="mycart process_selected1">
				<i class="iconfont">&#xe643;</i>
				<div class="line">
					<p class="process_selected2"></p>
					<span class="process_selected2 process_selected3"></span>
				</div>
				<h4>订单完成<h4>
			</li>
		</ul>
	</div>
	<p class="bling">订单<a href="#">1234566789</a>已经成功生成,我们会尽快送达！</p>
	<div class="order_present clearfix">
		<div class="pay_success_img">
			<img src="../../default/images/duihuan.png">
		</div>
		<div class="pay_success_mess">
			<p><span>订单金额：￥<i>424.00</i></span><span>支付方式:在线支付</span></p>
			<p>配送单由[上海闵行]仓库发货,送达时间以商家为准.</p>
			<p>配送地址：张三   11111111111   闵行区  沪闵路6088号莘庄龙之梦</p>
		</div>
	</div>
</div>
	

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
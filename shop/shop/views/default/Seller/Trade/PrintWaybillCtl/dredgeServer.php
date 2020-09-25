<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<script src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js" charset="utf-8"></script>
<style>
	.seller-notify {
	    margin-bottom: 15px;
	    padding: 8px 0 10px 90px;
	    font-size: 14px;
	    border: 1px solid #e0e0e0;
	    background-color: #f5f5f5;
	    margin-top: 15px;
	}
	.seller-notify .notify-title {
	    padding-left: 15px;
	    margin-left: -90px;
	}
	.seller-module-box{
		position: relative;
	    border: 1px solid #E0E0E0;
	    margin-bottom: 15px;
	    border-radius: 2px;
	}
	.seller-module-box .module-new-index{
		margin: 15px;
	}
	.seller-module-box .module-new-index h2{
		border-bottom: 1px solid #e0e0e0;
	    text-align: center;
	    font-size: 14px;
	    height: 53px;
	    line-height: 53px;
	}
	.seller-module-box .module-new-index .h3{
		padding: 18px 0;
    	font-size: 14px;
	}
	.seller-module-box .module-new-index .cp-list{
		overflow: hidden;
    	border-bottom: 1px solid #e0e0e0;
	}
	.seller-module-box .module-new-index .cp-list li{
		width: 190px;
	    height: 140px;
	    float: left;
	    border: 1px solid #e0e0e0;
	    margin-bottom: 30px;
	    margin-right: 44px;
	}
	.seller-module-box .module-new-index .cp-list .cp-logo{
		height: 90px;
	    text-align: center;
	    line-height: 90px;
	    font-size: 14px;
	}
	.seller-module-box .module-new-index .cp-list .cp-logo img {
	    vertical-align: middle;
	}
	.seller-module-box .module-new-index .cp-list .cp-apply{
		margin: 0 14px;
	    padding: 12px 0;
	    text-align: center;
	    border-top: 1px solid #e0e0e0;
	    cursor: pointer;
	}
	.seller-module-box .module-new-index .cp-list .cp-apply .apply-button{
		    display: inline-block;
		    width: 56px;
		    height: 25px;
		    border-radius: 3px;
		    color: #fff;
		    text-decoration: none;
		    text-align: center;
		    line-height: 25px;
		    background-color: #e02222;
	}
	.seller-module-box .module-new-index .ft{
		padding: 18px 40px 18px 18px;
	}
	.seller-module-box .module-new-index .ft .video-link{
		color: #e02222;
	}
	.seller-module-box .module-new-index .ft .tips{
		padding-top: 18px;
    	line-height: 18px;
	}
	.seller-module-box .module-new-index .ft .action{
		padding-top: 25px;
    	text-align: center;
	}
	.seller-module-box .module-new-index .ft .action .confirm-button{
		display: inline-block;
	    width: 88px;
	    height: 30px;
	    text-align: center;
	    text-decoration: none;
	    line-height: 30px;
	    color: #fff;
	    background-color: #e02222;
	    cursor: pointer;
	}
	/* 弹窗 */
	.window{
		width: 800px;
    	height: 362px;
    	background: #fff;
	    border: 1px solid #E0E0E0;
	    outline: 0;
	    box-shadow: 0 0 2px 1px #999;
	    position: fixed;
	    left: 30%;
    	top: 30%;
    	display:none;
    	z-index: 101;
	}
	.window .window_nav{
		height: 40px;
	    line-height: 40px;
	    padding-left: 15px;
	    font-size: 14px;
	    background: #F5F5F5;
	    border-bottom: 1px solid #E0E0E0;
	}
	.window .window_nav h2{
		font-size: 100%;
	}
	.window .window_nav .close{
		position: absolute;
	    top: 0;
	    right: 15px;
	    font-size: 20px;
	    height: 40px;
	    line-height: 40px;
	    color: #e02222;
	    text-decoration: none;
	    font-family: sellerCenter;
	}
	.window .window_contain{
		height: 262px;
	}
	.window .window_contain .waybill-form{
		padding-left: 15px;
	    padding-top: 30px;
	    font-size: 14px;
	}
	.window .window_contain .waybill-form .form-row{
		clear: both;
    	height: 30px;
    	padding-bottom: 10px;
	}
	.window .window_contain .waybill-form .form-row label{
		width: 88px;
    	float: left;
	}
	.window .window_contain .waybill-form .form-row .image{
		height: 30px;
    	overflow: hidden;
	}
	.window .window_contain .waybill-form .form-row div.item{
		float: left;
	    font-size: 12px;
	    line-height: 28px;
	}
	.window .window_contain .waybill-form .form-row div.item select{
		overflow: hidden;
	    padding-right: 17px;
	    height: 28px;
	}
	.window .window_contain .waybill-form .form-row div.item .textbox{
		border-radius: 2px;
	    position: relative;
	    float: left;
	    margin-right: 5px;
	    height: 28px;
	    border: 1px solid #d6d6d6;
	    padding-left: 5px;
	    width: 183px;
	    line-height: 28px;
	    color: #666;
	    word-wrap: break-word;
	    word-break: break-all;
	}
	.window .window_contain .waybill-form .form-row div.item .info{
		float: left;
		color: #666;
    	display: inline-block;
	}
	.window .window_option{
		height: 60px;
	    line-height: 60px;
	    padding-left: 443px;
	    border-top: 1px solid #E5E5E5;
	}
	.window .window_option .comfirm{
		float: right;
	    margin-left: 0;
	    margin-right: 10px;
	    background: #e02222;
    	color: #fff;
    	cursor: text;
    	width: 64px;
    	height: 30px;
	    line-height: 30px;
	    text-align: center;
	    margin-top: 10px
	}
	.window .window_option .cancel{
		color: #333;
    	background: #EDEDED;
    	float: right;
	    margin-left: 0;
	    margin-right: 5px;
	   	width: 64px;
	    text-align: center;
	    height: 30px;
	    line-height: 30px;
	    margin-top: 10px
	}
	.bg_window{
		width: 100%;
		height: 100%;
		background-color: black;
		opacity: .3;
		z-index: 100;
		display: none;
		position: fixed;
		top:0;
		left: 0;
	}
	.cur{
		display: block;
	}
	/* 弹窗 */
</style>
<div class="seller-notify">
	<span class="notify-title">请您知晓：</span>
	因为物流商运营模式的不同，加盟型运营商是以网点为单位进行账户核算，所以您需要和每个网点建立合作。而直营型服务商由大客户号来 绑定结算关系，合作关系即服务商本身。
</div>
<div class="seller-module-box">
	<div class="module-new-index">
		<h2 style="font-weight:600">请选择您要开通的运营商</h2>
		<h3 class="h3" style="font-weight:600">加盟运营商</h3>
		<ul class="cp-list">
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
		</ul>
	</div>
	<div class="module-new-index">
		<h3 class="h3" style="font-weight:600">直营运营商</h3>
		<ul class="cp-list">
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
			<li>
				<div class="cp-logo">
					<img src="<?=$this->view->img?>/express.jpg" alt="" width='128' height="46">
				</div>	
				<div class="cp-apply">
					<span class="apply-button">申请</span>
				</div>
			</li>
		</ul>
		<div class="ft">
			<a href="" class="video-link">点此观看使用视屏 >></a>
			<div class="tips">该视频有助于您全方位了解淘尚168电子面单订购流程，根据视频里的提示说明，您还可以进行相应操作和准备。若遇其他疑难问题可咨询 010-57798668（服务时间9:00-18:00）</div>
			<div class="action">
				<a href="" class="confirm-button">立即使用</a>
			</div>
		</div>
	</div>
</div>

<!--弹窗-->
<div class="window">
	<div class="window_nav">
		<h2>开通服务商</h2>
		<a href="" class="close">X</a>
	</div>
	<div class="window_contain">
		<form action="" class="waybill-form">
			<div class="form-row">
				<label for="">服务商：</label>
				<div class="image"><img src="<?=$this->view->img?>/express.jpg" alt="" width='90' height='30'></div>
			</div>
			<div class="form-row">
				<label for="">选择发货地：</label>
				<div class="item"><select name="" id=""><option value="">请选择</option></select></div>
			</div>
			<div class="form-row">
				<label for="">选择网点：</label>
				<div class="item">
					<select name="" id="">
						<option value="">请选择</option>
					</select>
					<select name="" id="">
						<option value="">请选择城市</option>
					</select>
					<select name="" id="">
						<option value="">请选择区/县</option>
					</select>
				</div>
			</div>
			<div class="form-row">
				<label for="">联系人：</label>
				<div class="item"><input type="text" class="textbox" placeholder="请填写联系人"><span class="info">请填写店铺的电子面单负责人</span></div>
			</div>
			<div class="form-row">
				<label for="">联系电话：</label>
				<div class="item"><input type="text" class="textbox" placeholder="手机或固定号码"><span class="info">请务必填写准确，否则可能会导致审核失败</span></div>
			</div>
			<div class="form-row">
				<label for="">&nbsp;</label>
				<div class="item"><input type="checkbox" class="needProtocol"><a href="">菜鸟调用电子面单服务协议</a></div>
			</div>
		</form>
	</div>
	<div class="window_option">
		<a href="cancel" class="cancel">取消</a>
		<a href="" class="comfirm">确认</a>
	</div>
</div>
<div class="bg_window">
</div>
<!--弹窗-->
	<script>
		$(function(){
			$('.apply-button').on('click',function(){
				$('.window').addClass('cur');
				$('.bg_window').addClass('cur');
			});
		})
	</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>


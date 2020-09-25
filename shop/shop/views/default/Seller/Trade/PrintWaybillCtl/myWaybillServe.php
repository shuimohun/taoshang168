<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<script src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js" charset="utf-8"></script>
<style>
	.seller-notify {
	    margin-bottom: 20px;
	    padding: 8px 0 10px 90px;
	    font-size: 14px;
	    font-weight: 600px;
	    border: 1px solid #e0e0e0;
	    background-color: #f5f5f5;
	    margin-top: 15px;
	}
	.seller-notify .notify-title {
	    padding-left: 15px;
	    margin-left: -90px;
	}
	.button{
		cursor: pointer;
	    border-radius: 2px;
	    margin-right: 10px;
	    display: inline-block;
	    color: #666;
	    text-align: center;
	    height: 29px;
	    line-height: 29px;
	    padding: 0 15px;
	    background-color: #e02222;
	    color: #fff;
	    border: 0;
	}
	.mailingSellerBox {
	    margin-top: 20px;
	    width: 100%;
	    border-bottom: 1px solid #eee;
	    background-color: #efefef;
	}
	.mailingSellerBox .mailingTitle{
		padding-left: 15px;
	    line-height: 48px;
	    font-size: 14px;
	    border-right: 1px solid #eee;
	}
	.mailingSellerBox .mailingTitle .icon{
		position: relative;
	    vertical-align: -3px;
	    height: 14px;
	    width: 14px;
	    text-align: center;
	    line-height: 15px;
	    border: 1px solid #ccc;
	    display: inline-block;
	    margin-right: 10px;
    	cursor: pointer;
	}
	.mailingSellerBox .mailingTitle .expressimg{
		width: 100px;
	    height: 40px;
	    vertical-align: middle;
	}
	.mailingSellerBox .mailingTitle .waybillType {
	    margin-left: 5px;
	    padding: 0 3px;
	    color: #e02222;
	    border: 1px solid #e02222;
	    vertical-align: middle;
	}
	.mailingSellerBox .mailingTitle a.addWaybillBtn {
	    float: right;
	    margin-right: 20px;
	    outline: 0;
	    color: #e02222;
	}
	.mailingSellerBox table{
		width: 100%;
	    border-left: 1px solid #eee !important;
	    border-right: 1px solid #eee !important;
	    border-collapse: collapse;
    	border-spacing: 0;
    	display: table;
    	border-color: grey;
    	background-color: #fff;
	}
	.mailingSellerBox table thead {
	    display: table-header-group;
	    vertical-align: middle;
	    border-color: inherit;
	}
	.mailingSellerBox table thead tr {
	    display: table-row;
	    vertical-align: inherit;
	    border-color: inherit;
	}
	.mailingSellerBox table thead tr th {
	    height: 40px;
	    border-bottom: 1px solid #eee;
	    color: #666;
	    border-right: 1px solid #eee;
	    text-indent: 20px;
	    font-weight: 400;
	    text-align: left;
	}
	.mailingSellerBox tbody tr td{
		padding: 8px 10px 8px 20px;
	    border-top: 1px solid #eee !important;
	    text-align: left;
	    vertical-align: top;
	}
	.mailingSellerBox tbody tr td:nth-child(1){
		border-right: 1px solid #eee;
	}
	.mailingSellerBox tbody tr td .waybillEffective{
		color: #669036;
		display: block;
    	margin-top: 10px;
	}
	.mailingSellerBox tbody tr td .plaint{
		vertical-align: middle;
		width: 16px;
		height: 16px;
	}
	.mailingSellerBox tbody tr td .add{
		color:#e02222;
		text-decoration: underline;
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
<!--静态页面这里开始-->
<div class="seller-notify">
	<span class="notify-title">请您知晓：</span>
	因为物流商运营模式的不同，加盟型运营商是以网点为单位进行账户核算，所以您需要和每个网点建立合作。而直营型服务商由大客户号来 绑定结算关系，合作关系即服务商本身。申请直营网点的商家无需再联系快递公司充值单号，快递公司审核通过后即可，如顺丰等。
</div>
<a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Trade_PrintWaybill&met=myWaybillServe&act=dredgeServer&typ=e" class="button">开通新的服务商</a>
<div class="mailingSellerBox">
	<div class="mailingTitle">
		<img src="<?=$this->view->img?>/unfold.png" alt="" class='icon'>
		<img src="<?=$this->view->img?>/express.jpg" alt="" class='expressimg'>
		<span class="waybillType">加盟</span>
		<a href="javascript:void(0)" class="addWaybillBtn">新增网点</a>
	</div>
	<table>
		<thead>
			<tr>
				<th>网点名称(编码)</th>
				<th>发货地址</th>
				<th>状态</th>
				<th>服务开通状态</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<p>北京市丰台南苑(100041)</p>
					<span class="waybillEffective">有效</span>
				</td>
				<td>
					<p>联系人：温庆腾</p>
					<p>电话：18025217958</p>
					<p>地址：北京 北京市 丰台区 南园西路76号</p>
				</td>
				<td>
					<img src="<?=$this->view->img?>/plaint_ok.png" alt="" class='plaint'>
					<span>审核中</span>
				</td>
				<td></td>
				<td>
					<a href="javascript:void(0)" class="add">新增发货地址</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="mailingSellerBox">
	<div class="mailingTitle">
		<img src="<?=$this->view->img?>/unfold.png" alt="" class='icon'>
		<img src="<?=$this->view->img?>/express.jpg" alt="" class='expressimg'>
		<span class="waybillType">加盟</span>
		<a href="" class="addWaybillBtn">新增网点</a>
	</div>
	<table>
		<thead>
			<tr>
				<th>网点名称(编码)</th>
				<th>发货地址</th>
				<th>状态</th>
				<th>服务开通状态</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<p>北京市丰台南苑(100041)</p>
					<span class="waybillEffective">有效</span>
				</td>
				<td>
					<p>联系人：温庆腾</p>
					<p>电话：18025217958</p>
					<p>地址：北京 北京市 丰台区 南园西路76号</p>
				</td>
				<td>
					<img src="<?=$this->view->img?>/plaint_ok.png" alt="" class='plaint'>
					<span>审核中</span>
				</td>
				<td></td>
				<td>
					<a href="" class="add">新增发货地址</a>
				</td>
			</tr>
		</tbody>
	</table>
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
		$('.icon').on('click',function(){
			if($(this).prop('src') == '<?=$this->view->img?>/unfold.png'){
				$(this).prop('src','<?=$this->view->img?>/packup.png');
				$(this).parent().parent().find('table').hide();
			}
			else if($(this).prop('src') == '<?=$this->view->img?>/packup.png'){
				$(this).prop('src','<?=$this->view->img?>/unfold.png');
				$(this).parent().parent().find('table').show();
			}
		})
	})
	$(function(){
			$('.addWaybillBtn').on('click',function(){
				$('.window').addClass('cur');
				$('.bg_window').addClass('cur');
			});
			$('.add').on('click',function(){
				$('.window').addClass('cur');
				$('.bg_window').addClass('cur');
			});
		})
</script>
<!--静态页面这里结束-->
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

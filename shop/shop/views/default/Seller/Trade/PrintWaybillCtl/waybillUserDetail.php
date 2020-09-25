<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<style>
	.button {
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
	    margin-top: 20px;
	}
	.disable {
	    background-color: #ebebeb;
	    color: #666;
	    cursor: text;
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
</style>
<!--静态页面这里开始-->
<span class="button J_allChecked">全选</span>
<div class="button disable">批量设余额度提醒</div>
<div class="mailingSellerBox">
	<div class="mailingTitle">
		<img src="<?=$this->view->img?>/unfold.png" alt="" class='icon'>
		<img src="<?=$this->view->img?>/express.jpg" alt="" class='expressimg'>
	</div>
	<table align="center">
		<thead>
			<tr>
				<th>网点名称</th>
				<th>网点编码</th>
				<th>服务类型</th>
				<th>充值数</th>
				<th>取号数</th>
				<th>回收数</th>
				<th>余额</th>
				<th>余额不足提醒值</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<td>丰台汉龙物流</td>
			<td>1000397</td>
			<td>普通号段</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>－ －</td>
			<td>
				<a href="">充值记录</a>
				<a href="">运单明细</a>
			</td>
		</tbody>
	</table>
</div>
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
</script>
<!--静态页面这里结束-->
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

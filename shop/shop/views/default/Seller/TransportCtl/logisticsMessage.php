<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<style>
	.main{
		margin-top:20px;
	}
	.main input{
		width: 200px;
		height: 25px;
		border:1px solid #ddd;
	}
	.main button{
		width: 70px;
    	height: 25px;
	}
</style>
<div class="main">
	订单编号：
	<input type="text">
	<button type="submit" value="搜索">搜索</button>
</div>


<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
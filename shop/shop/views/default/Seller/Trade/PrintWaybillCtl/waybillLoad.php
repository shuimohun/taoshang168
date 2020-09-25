<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<style>
	.express_sheet{
		padding-top: 20px;
    	border-bottom: 1px solid #e6e6e6;
    	padding-left: 15px;
	}
    .express_sheet .form-row{
    	clear: both;
	    height: 30px;
	    padding-bottom: 15px;
	    padding-left: 20px;
    }
    .express_sheet .form-row select{
    	width: 183px;
		height: 28px;
    }
    .express_sheet .form-row input{
		border:1px solid #e6e6e6;
		padding: 5px;
    }
    .express_sheet .form-row .button_find{
    	float: right;
	    width: 53px;
	    height: 31px;
	    text-align: center;
	    line-height: 31px;
	    border-radius: 2px;
	    background-color: #e02222;
	    color: #fff;
	    cursor: pointer;
    }
    .express_sheet .button{
	    width: 76px;
	    height: 31px;
	    text-align: center;
	    line-height: 31px;
	    border-radius: 2px;
	    background-color: #e02222;
	    color: #fff;
	    cursor: pointer;
	    margin-top: 15px;
	    margin-left: 870px;
	    margin-bottom: 20px;
    }
    .query-table-header {
	    padding: 9px 0 15px;
	    overflow: hidden;
	}
	.query-table-header .tips{
		float: left;
    	color: #666;
	}
	.query-table-header .pageDisable{
	    color: #ccc;
	    cursor: default;
	    background-color: #ebebeb;
	    float: right;
	    margin-right: 5px;
	    height: 28px;
	    width: 28px;
	    border: 1px solid #ccc;
	    line-height: 28px;
	    text-align: center;
	}
	.query-table-body{
		width: 100%;
	    border: 1px solid #e0e0e0;
	    border-collapse: collapse;
	    margin-top: 20px;
	}
	.query-table-body thead,.query-table-body tbody{
		display: table-header-group;
	    vertical-align: middle;
	    border-color: inherit;
	}
	.query-table-body thead tr,.query-table-body tbody tr{
		display: table-row;
	    vertical-align: inherit;
	    border-color: inherit;
	}
	.query-table-body thead tr th{
		line-height: 33px;
	    border: 1px solid #e0e0e0;
	    border-collapse: collapse;
	    padding: 0;
	    background-color: #f5f5f5;
	    text-align: center;
	    font-weight: 400;
	}
	.query-table-body tbody tr th{
		line-height: 33px;
	    border: 1px solid #e0e0e0;
	    border-collapse: collapse;
	    padding: 0;
		background-color: #fff;
		text-align: center;
	    font-weight: 400;
	}
</style>
<!--静态页面这里开始-->

<div class="express_sheet">
	<form action="">
		<div class="form-row">
			<label for="">发货网点：</label>
			<select>
				<option value="">请选择</option>
			</select>
			<select>
				<option value="">请选择</option>
			</select>
		</div>
		<div class="form-row">
			<label for="">号段类型：</label>
			<select>
				<option value="">普通号段</option>
			</select>
		</div>
		<div class="form-row">
			<label for="">选择时间：</label>
			<select>
				<option value="">取号时间</option>
				<option value="">揽收时间</option>
			</select>
			<input type="date" value="" id="myDate" name="myDate"/> 至
			<input type="date" value="" id="myDate" name="myDateAfter" value="" />
		</div>
		<div class="button">生成账单</div>					
	</form>
</div>

<div class="query-table-header" style="height:auto">
	<div class="tips">［温馨提示］新版数据下载功能处于试用期，只能下载<b>2017年1月6日</b>开始的数据。如果您想使用旧版下载<b>过去已经生成好的账单</b>，请<a href="" style="color:blue">返回旧版</a></div>
	<div class="page-prev pageDisable">></div>
	<div class="page-next pageDisable"><</div>
</div>
<table class="query-table-body">
	<thead>
		<tr>
			<th>账单生成时间</th>
			<th>账单时间维度</th>
			<th>账单时间跨度</th>
			<th>快递公司名称</th>
			<th>网点</th>
			<th>号段类型</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</tbody>
</table>
<!--静态页面这里结束-->
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

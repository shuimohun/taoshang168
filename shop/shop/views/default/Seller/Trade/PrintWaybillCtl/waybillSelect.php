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
	.express_sheet .sheet_top{
	    padding-bottom: 10px;
	}
	.express_sheet .sheet_top label{
	    width: 88px;
	}
	.express_sheet .sheet_top input{
		width: 183px;
		height: 28px;
		border:1px solid #e6e6e6;
	}
    .express_sheet .form-split{
    	height: 0;
	    overflow: hidden;
	    border-bottom: 1px dashed #e0e0e0;
	    margin: 10px 0 20px;
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
    .query-table-header {
	    height: 30px;
	    padding: 9px 0 15px;
	    overflow: hidden;
	    height: auto;
	}
	.query-table-header .tips {
	    float: left;
	    color: #666;
	}
	.query-table-header .tips a{
		text-decoration: underline;
		color: blue;
	}
	.pageDisable{
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
	    margin-top: 50px;
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
	.query-table-body thead tr th{

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
		<div class="sheet_top">
			<label for="">电子面单号：</label>
			<input type="text" type="text" name="sheet_top_number">
		</div>
		<div class="form-split"></div>
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
			<label for="">获取时间：</label>
			<input type="date" value="" id="myDate" name="myDate"/> 至
			<input type="date" value="" id="myDate" name="myDateAfter" value="" />
		</div>
		<div class="form-row"> 
			<label for="">单号状态：</label>
			<select>
				<option value="">全部</option>
				<option value="">已取消</option>
				<option value="">有效单号</option>
				<option value="">已回收</option>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;
			<label for="">运输状态：</label>
			<select>
				<option value="">全部</option>
				<option value="">已揽收</option>
				<option value="">已签收</option>
				<option value="">无物流信息</option>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;
			<label for="">订单来源：</label>
			<select>
				<option value="">全部</option>
				<option value="">已取消</option>
				<option value="">有效单号</option>
				<option value="">已回收</option>
			</select>
			<div class="button_find">查询</div>
		</div>						
	</form>
</div>
<div class="query-table-header">
			<div class="tips">
				［温馨提示］单号查询最长时间间隔为60天，查询范围为6个月；如需查询6个月以前的数据，请到“<a href="">数据下载</a>”页面导出到本地查看；点击查看“操作”列的“查看详情“可以查看运单号的详细信息。
			</div>
</div>
<div class="page-prev pageDisable">></div>
<div class="page-next pageDisable"><</div>
<table class="query-table-body">
	<thead>
		<tr>
			<th>服务商名称</th>
			<th>获取时间</th>
			<th>电子面单号</th>
			<th>订单号</th>
			<th>单号状态</th>
			<th>运输状态</th>
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
<script>
	var a = ''
	document.getElementById("myDate").value = a;
</script>
<!--静态页面这里结束-->
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<script src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js" charset="utf-8"></script>
<style>
	.mui-form-bd{
		line-height: inherit;
		padding: 15px 0 0;
		zoom: 1;
	}
	.mui-form-bd .mui-form-row{
		overflow: visible;
		float: left;
	    	margin-right: 15px;
	    	margin-bottom: 10px;
	    	list-style: none;
	}
	.mui-form-bd .mui-form-row .mui-form-label{
		width: 70px;
		text-align: right;
		float: left;
	}
	.mui-form-bd .mui-form-row .mui-form-right{
		display: inline-block;
	}
	.mui-form-select{	
	    width: 150px;
	    height: 25px;
	    border: 1px solid #ABADB3;
	}
	.mui-form-ft button{
		width: 70px;
		height: 25px;
	}
	.search-table {
	    width: 100%;
	    margin-top: 20px;
	}
	.search-table table{
		width: 100%;
	    table-layout: fixed;
	    text-align: left;
	    border-collapse: collapse;
	}
	.search-table table thead tr{
		white-space: nowrap;
	    line-height: 26px;
	    height: 26px;
	    background: #f2f2f2;
	}
	.search-table table thead tr th{
		padding: 0 10px;
	    border-top: 1px solid #bcbcbc;
	    border-bottom: 1px solid #bcbcbc;
	    text-align: inherit;
    	font-weight: 100;
	}
	.search-table table thead tr th .mui-btn-s{
		color: #C5C5C5;
		height: 20px;
    	line-height: 17px;
    	border: 1px solid #ccc;
	    background: #f2f2f2;
	    cursor: default;
	    margin-left: 10px;
	}
	.search-table table thead tr th a{
		color: #e02222;
    	text-decoration: none;
	}
	.search-table table tbody tr td{
		border-right: 1px solid #eee;
		vertical-align: top;
	    padding: 10px;
	    border-bottom: 1px solid #ccc;
	    word-wrap: break-word;
	}
	.search-table table tbody tr td img{
		margin: 0 10px;
	    border: 1px solid #ededed;
	    width: 100px;
	    height: 60px;
	}
	.search-table table tbody tr td.search-table-service{
		padding: 0;
	}
	.search-table table tbody tr td.search-table-service ul li{
		height: 20px;
	    line-height: 20px;
	    border-top: 1px solid #eee;
	    padding: 10px 30px;
	}
	.search-table table tbody tr td.search-table-service ul li em{
		padding-right: 20px;
    	cursor: pointer;
	}
	.search-table table tbody tr td.search-table-service ul li a{
		color: #e02222;
    	text-decoration: none;
	}
	.search-table table tbody tr td.search-table-operate a{
		color: #e02222;
    	text-decoration: none;
	}
</style>

<ul class="mui-form-bd">
	<li class="mui-form-row">
		<label for="mui-form-label">物流服务：</label>
		<div class="mui-form-right">
			<select name="" id="" class="mui-form-select">
				<option value="">全部</option>
				<option value="">货到付款</option>
				<option value="">预约配送</option>
				<option value="">到货承诺</option>
				<option value="">指定快递</option>
			</select>
		</div>
	</li>
	<li class="mui-form-ft">
		<button type="submit">搜索</button>
	</li>
</ul>

<div class="search-table">
	<table>
		<thead>
			<tr>
				<th>物流公司</th>
				<th>开通的服务</th>
				<th>操作</th>
			</tr>
			<tr>
				<th colspan="3">
					<input type="checkbox" onclick="swapCheck()">全选
					<button class="mui-btn-s  mui-btn-disable">批量开通服务商</button>
					<a href="" target="_blank" class="service-open-btn">开通电子面单</a>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="search-table-logo">
					<input type="checkbox">
					<img src="<?=$this->view->img?>/express.jpg" alt="">中国邮政
				</td>
				<td class="search-table-service">
					<ul>
						<li>
							<em>货到付款</em>
							<a href="">开启服务</a>
						</li>
						<li>
							<em>指定快递</em>
							<a href="">开启服务</a>
						</li>
						<li>
							<em>到货承诺</em>
							<a href="">开启服务</a>
						</li>
					</ul>
				</td>
				<td class="search-table-operate">
					已开通的服务商
					<a href="">取消</a>
				</td>
			</tr>
		</tbody>
		<tbody>
			<tr>
				<td class="search-table-logo">
					<input type="checkbox">
					<img src="<?=$this->view->img?>/express.jpg" alt="">中国邮政
				</td>
				<td class="search-table-service">
					<ul>
						<li>
							<em>货到付款</em>
							<a href="">开启服务</a>
						</li>
						<li>
							<em>指定快递</em>
							<a href="">开启服务</a>
						</li>
						<li>
							<em>到货承诺</em>
							<a href="">开启服务</a>
						</li>
					</ul>
				</td>
				<td class="search-table-operate">
					已开通的服务商
					<a href="">取消</a>
				</td>
			</tr>
		</tbody>
		<tbody>
			<tr>
				<td class="search-table-logo">
					<input type="checkbox">
					<img src="<?=$this->view->img?>/express.jpg" alt="">中国邮政
				</td>
				<td class="search-table-service">
					<ul>
						<li>
							<em>货到付款</em>
							<a href="">开启服务</a>
						</li>
						<li>
							<em>指定快递</em>
							<a href="">开启服务</a>
						</li>
						<li>
							<em>到货承诺</em>
							<a href="">开启服务</a>
						</li>
					</ul>
				</td>
				<td class="search-table-operate">
					已开通的服务商
					<a href="">取消</a>
				</td>
			</tr>
		</tbody>
		<tbody>
			<tr>
				<td class="search-table-logo">
					<input type="checkbox">
					<img src="<?=$this->view->img?>/express.jpg" alt="">中国邮政
				</td>
				<td class="search-table-service">
					<ul>
						<li>
							<em>货到付款</em>
							<a href="">开启服务</a>
						</li>
						<li>
							<em>指定快递</em>
							<a href="">开启服务</a>
						</li>
						<li>
							<em>到货承诺</em>
							<a href="">开启服务</a>
						</li>
					</ul>
				</td>
				<td class="search-table-operate">
					已开通的服务商
					<a href="">取消</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<script>
	var isCheckAll = false;  
        function swapCheck() {  
            if (isCheckAll) {  
                $("input[type='checkbox']").each(function() {  
                    this.checked = false;  
                });  
                isCheckAll = false;  
            } else {  
                $("input[type='checkbox']").each(function() {  
                    this.checked = true;  
                });  
                isCheckAll = true;  
            }  
        }  

</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

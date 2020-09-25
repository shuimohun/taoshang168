<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--交易  -- 构成-->
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/sycm_index.css">

<div class="header-wrap">
	<div class="header w-1430">
		<div class="header-left lf">
			<div class="shop-text lf">
				<i class="icon lf"></i>
				<span class="text">生意参谋</span>
			</div>
			<div class="shop-name-wrap lf">
				<a href="javascript:;">
					<div class="shop-name lf">淘尚168商城</div>
					<div class="shop-weight lf">主店</div>
					<i class="icon lf"></i>
				</a>
			</div>
		</div>
		<div class="header-right rt">
			<ul class="right-cell">
				<li class="lf cell">
					<a href="javascript:;">
						<i class="icon"></i>
						消息
					</a>
					<i class="new icon"></i>
				</li>
				<li class="lf cell">
					<a href="javascript:;">
						订购
					</a>
				</li>
				<li class="lf cell">
					<a href="javascript:;">
						个人中心
					</a>
				</li>
				<li class="lf cell">
					<a href="javascript:;">
						退出
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="header-nav w-1430">
		<ul class="nav-list orflow mt-16">
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=index">
					首页
				</a>
			</li>
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=realTime">
					实时
				</a>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
					作战室
				</a>
			</li>
			<li class="sprite lf">
				<span></span>
			</li>
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=flow">
					流量
				</a>
			</li>
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=goods">
					商品
				</a>
			</li>
			<li class="nav-item lf curr">
				<a href="index.php?ctl=Seller_Sycm&met=transaction">
					交易
				</a>
			</li>
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=service">
					服务
				</a>
			</li>
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=logistics">
					物流
				</a>
			</li>
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=marketing">
					营销
				</a>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
					财务
				</a>
			</li>
			<li class="sprite lf">
				<span></span>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
					市场
				</a>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
					竞争
				</a>
			</li>
			<li class="sprite lf">
				<span></span>
			</li>
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=businessZone">
					业务专区
				</a>
			</li>
			<li class="sprite lf">
				<span></span>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
					取数
				</a>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
					学院
				</a>
			</li>
		</ul>
	</div>
</div>
<div class="main-wrap w-1210 mt-10">
	<div class="nav lf w-160">
		<div class="left-nav">
			<div class="topLogo">
				<div class="topLogoContent">
					<i class="icon"></i>
					<p>交易分析</p>
				</div>
			</div>
			<ul class="menu-list-inner">
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">交易概況</span>
					</a>
				</li>
				<li class="menu-item-inner lf curr">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">交易构成</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">交易明细</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- 店铺详情 start -->
	<div class="w-1040  rt shop-detail-container">
		<div class="shop-detail-wrap bakff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22"></h3>
				<ol class="breadcrumb lf"><li><a href="javascript:;">交易分析</a></li><li><a href="javascript:;">交易构成</a></li><li class="active">品牌详情</li></ol>
				<span class="screen-subtitle">以下为蓓尔品牌指标</span>

				<div class="actions-tab rt mt-20">
					<div class="ui-switch">
						<ul class="ui-switch-menu orflow">
							<li class="curr ui-switch-item lf">
								<a href="javascript:;">全部</a>
							</li>
							<li class="ui-switch-item lf" style="border-right:1px solid #ddd;border-left:1px solid #ddd;">
								<a href="javascript:;">PC</a>
							</li>
							<li class="ui-switch-item lf">
								<a href="javascript:;">无线</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="update-option block-date rt" style="margin-right: 15px;">
					<p class="option rt">
						<span>最近1天（2017-09-26~2017-09-26）</span>
						<i class="icon caret"></i>
					</p>
					<div class="date-wrap" style="display: none;">
						<ul>
							<li class="datePicker-item lastest-n">
								<span class="datePicker-rangeText">最近1天</span>
								<span class="datePicker-rangeTime rt">（2017-09-26~2017-09-26）</span>
							</li>
							<li class="datePicker-item lastest-n">
								<span class="datePicker-rangeText">最近7天</span>
								<span class="datePicker-rangeTime rt">（2017-09-20~2017-09-26）</span>
							</li>
							<li class="datePicker-item lastest-n">
								<span class="datePicker-rangeText">最近30天</span>
								<span class="datePicker-rangeTime rt">（2017-08-28~2017-09-26）</span>
							</li>
							<li class="datePicker-item datetimepicker-day">
								<span class="datePicker-rangeText">自然日</span>
								<span class="datePicker-rangeTime"></span>
							</li>
							<li class="datePicker-item datetimepicker-week">
								<span class="datePicker-rangeText">自然周</span>
								<span class="datePicker-rangeTime"></span>
							</li>
							<li class="datePicker-item datetimepicker-month active">
								<span class="datePicker-rangeText ">自然月</span>
								<span class="datePicker-rangeTime"></span>
							</li>
						</ul>
						<div class="laydate-wrap laydate-wrap-day" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
						<div class="laydate-wrap laydate-wrap-week" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
						<div class="laydate-wrap laydate-wrap-month" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
					</div>
				</div>
			</div>
			<!-- 品牌概况 start -->
			<div class="navbar-panel brand-state">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>品牌概况
					</h4>
				</div>
				<div class="page-item content">
					<div class="grid-row clearfix">
						<div class="grid-item">
							<div class="grid-item-row grid-head">支付金额</div>
							<div class="grid-item-row grid-body sans-serif">61.00</div>
							<div class="grid-item-row grid-foot">较上一周期
								<span class="flat grid-trend r-trend up"><i class="icon-trend icon"></i><span class="trend-text">23.00%</span></span>
							</div>
						</div>
						<div class="grid-item">
							<div class="grid-item-row grid-head">支付买家数</div>
							<div class="grid-item-row grid-body sans-serif">1</div>
							<div class="grid-item-row grid-foot">较上一周期
								<span class="flat grid-trend r-trend down"><i class="icon-trend icon"></i><span class="trend-text">-</span></span>
							</div>
						</div>
						<div class="grid-item">
							<div class="grid-item-row grid-head">客单价</div>
							<div class="grid-item-row grid-body sans-serif">61.00</div>
							<div class="grid-item-row grid-foot">较上一周期
								<span class="flat grid-trend"><i class="icon-trend"></i><span class="trend-text">-</span></span>
							</div>
						</div>
						<div class="grid-item">
							<div class="grid-item-row grid-head">支付商品数</div>
							<div class="grid-item-row grid-body sans-serif">1</div>
							<div class="grid-item-row grid-foot">较上一周期
								<span class="flat grid-trend"><i class="icon-trend"></i><span class="trend-text">-</span></span>
							</div>
						</div>
						<div class="grid-item">
							<div class="grid-item-row grid-head">支付转化率</div>
							<div class="grid-item-row grid-body sans-serif">33.34%</div>
							<div class="grid-item-row grid-foot">较上一周期
								<span class="flat grid-trend"><i class="icon-trend"></i><span class="trend-text">-</span></span>
							</div>
						</div>
					</div>
					<div class="grid-row clearfix">
						<div class="grid-item">
							<div class="grid-item-row grid-head">访客数</div>
							<div class="grid-item-row grid-body sans-serif">3</div>
							<div class="grid-item-row grid-foot">较上一周期
								<span class="flat grid-trend"><i class="icon-trend"></i><span class="trend-text">-</span></span>
							</div>
						</div>
						<div class="grid-item">
							<div class="grid-item-row grid-head">收藏人数</div>
							<div class="grid-item-row grid-body sans-serif">0</div>
							<div class="grid-item-row grid-foot">较上一周期
								<span class="flat grid-trend"><i class="icon-trend"></i><span class="trend-text">-</span></span>
							</div>
						</div>
						<div class="grid-item">
							<div class="grid-item-row grid-head">加购人数</div>
							<div class="grid-item-row grid-body sans-serif">1</div>
							<div class="grid-item-row grid-foot">较上一周期
								<span class="flat grid-trend"><i class="icon-trend"></i><span class="trend-text">-</span></span>
							</div>
						</div>
						<div class="grid-item">
							<div class="grid-item-row grid-head">加购商品件数</div>
							<div class="grid-item-row grid-body sans-serif">1</div>
							<div class="grid-item-row grid-foot">较上一周期
								<span class="flat grid-trend"><i class="icon-trend"></i><span class="trend-text">-</span></span>
							</div>
						</div>
						<div class="grid-item">
							<div class="grid-item-row grid-head">支付商品件数</div>
							<div class="grid-item-row grid-body sans-serif">1</div>
							<div class="grid-item-row grid-foot">较上一周期
								<span class="flat grid-trend"><i class="icon-trend"></i>
									<span class="trend-text">-</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 品牌概况 end -->

			<!-- 品牌趋势   start -->
			<div class="navbar-panel brand-trend">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>品牌趋势
					</h4>
					<div class="select-control download rt">
						<a href="javascript:;">
							<i class="icon"></i>
							<span class="val">下载</span>
						</a>
						<div class="ui-download-panel ui-download-right select-control-list">
							<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
							<p class="ui-download-btns clearfix"><a href="javascript:;" class="btn btn-blank btn-sm">取消</a><a href="javascript:;" class="btn btn-primary btn-sm">确定</a></p>
						</div>
					</div>
				</div>
				<div class="page-item content">
					<div class="combopanels-container">
						<div class="dropdown-index-picker orflow">
							<span class="title lf">指标：</span>
							<div class="combo-panel-lite combo-panel-inline lf">
								<span class="checkbox selected"><span class="option"></span><span class="name">支付金额</span></span>
								<span class="checkbox selected"><span class="option"></span><span class="name">支付买家数</span></span>
								<span class="checkbox"><span class="option"></span><span class="name">商品浏览量</span></span>
								<span class="checkbox"><span class="option"></span><span class="name">下单件数</span></span>
								<span class="checkbox"><span class="option"></span><span class="name">支付金额</span></span>
								<span class="checkbox"><span class="option"></span><span class="name">商品访客数</span></span>
								<span class="checkbox"><span class="option"></span><span class="name">商品访客数</span></span>
								<span class="checkbox"><span class="option"></span><span class="name">商品访客数</span></span>
								<span class="checkbox"><span class="option"></span><span class="name">商品访客数</span></span>
								<span class="checkbox"><span class="option"></span><span class="name">商品访客数</span></span>
							</div>
							<div class="more-index rt">
								<div class="dropdown-btn">
									更多<span class="icon caret"></span>
								</div>
							</div>
							<div class="error-message"></div>
						</div>
					</div>
					<div class="operations rt"><a class="btn btn-link" href="#">重置</a></div>
					<div class="selected-indices">已选：<!-- <span class="bordered-tag" style="border-color: rgb(150, 199, 250); color: rgb(30, 116, 231);">支付金额</span><span class="bordered-tag" style="border-color: rgb(187, 225, 133); color: rgb(153, 204, 51);">支付买家数</span> --></div>
					<div class="transaction-trend-chart" id="transaction-trend-chart" style="width:980px;height: 360px;margin: 0 auto;"></div>
				</div>
			</div>
			<!-- 品牌趋势  end -->

			<!-- 类目构成 start -->
			<div class="navbar-panel class-group">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>类目构成
					</h4>
					<div class="select-control download rt">
						<a href="javascript:;">
							<i class="icon"></i>
							<span class="val">下载</span>
						</a>
						<div class="ui-download-panel ui-download-right select-control-list">
							<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
							<p class="ui-download-btns clearfix"><a href="javascript:;" class="btn btn-blank btn-sm">取消</a><a href="javascript:;" class="btn btn-primary btn-sm">确定</a></p>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="ui-switch">
						<ul class="ui-switch-menu">
							<li class="active ui-switch-item lf">
								<a href="javascript:;">
									<p class="tab-content-title">女鞋</p>
									<p class="tab-content-subtitle">占比：100.00%</p>
								</a>
							</li>
						</ul>
					</div>
					<div class="subcategory-list">
						<div class="table-head">
							<span class="col col-0">类目</span>
							<span class="col col-1 orderable">
								支付金额
								<span class="order-flag desc">
									<i class="icon-order icon"></i>
								</span>
							</span>
							<span class="col col-2 orderable">
								支付金额占比
								<span class="order-flag">
									<i class="icon-order icon"></i>
								</span>
							</span>
							<span class="col col-3 orderable">
								支付买家数
								<span class="order-flag">
									<i class="icon-order icon"></i>
								</span>
							</span>
							<span class="col col-4 orderable">
								支付转化率
								<span class="order-flag">
									<i class="icon-order icon"></i>
								</span>
							</span>
							<span class="col col-5">操作</span>
						</div>
						<div class="table-body">
							<div class="table-body-item">
								<span class="col col-0">电压力锅</span>
								<span class="col col-1">899.00</span>
								<span class="col col-2">80.5%</span>
								<span class="col col-3">1</span>
								<span class="col col-4">20.00%</span>
								<span class="col col-5">
									<span class="actions">
										<a href="javascript:;" class="overlook-trend">查看趋势</a>
									</span>
								</span>
							</div>
							<div class="table-body-item">
								<span class="col col-0">电压力锅</span>
								<span class="col col-1">899.00</span>
								<span class="col col-2">80.5%</span>
								<span class="col col-3">1</span>
								<span class="col col-4">20.00%</span>
								<span class="col col-5">
									<span class="actions">
										<a href="javascript:;" class="overlook-trend">查看趋势</a>
									</span>
								</span>
							</div>
							<div class="table-body-item">
								<span class="col col-0">电压力锅</span>
								<span class="col col-1">899.00</span>
								<span class="col col-2">80.5%</span>
								<span class="col col-3">1</span>
								<span class="col col-4">20.00%</span>
								<span class="col col-5">
									<span class="actions">
										<a href="javascript:;" class="overlook-trend">查看趋势</a>
									</span>
								</span>
							</div>
							<div class="table-body-item">
								<span class="col col-0">电压力锅</span>
								<span class="col col-1">899.00</span>
								<span class="col col-2">80.5%</span>
								<span class="col col-3">1</span>
								<span class="col col-4">20.00%</span>
								<span class="col col-5">
									<span class="actions">
										<a href="javascript:;" class="overlook-trend">查看趋势</a>
									</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 类目构成 end -->

			<!-- 品牌热销商品排行榜 start -->
			<div class="navbar-panel mod-brand-hot-item">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i> 品牌热销商品排行榜
					</h4>
				</div>
				<div class="page-item content">
					<div class="table-wrapper">
						<div class="span-table">
							<div class="table-head">
								<span class="table-th first-column">
									<span class="th-title">排名</span>
								</span>
								<span class="table-th second-column">
									<span class="th-title">商品名称</span>
								</span>
								<span class="table-th middle-column">
									<span class="th-title">支付金额</span>
								</span>
								<span class="table-th middle-column">
									<span class="th-title">支付买家数</span>
								</span>
								<span class="table-th middle-column">
									<span class="th-title">支付转化率</span>
								</span>
								<span class="table-th middle-column">
									<span class="th-title">支付商品件数</span>
								</span>
								<span class="table-th last-column">
									<span class="th-title">操作</span>
								</span>
							</div>
							<div class="table-row">
								<span class="table-td first-column">
									<span class="td-value">1</span>
								</span>
								<span class="table-td second-column">
									<div class="ui-item-panel clearfix">
										<div class="img-wrapper-wrapper">
											<div class="img-wrapper vertical-img">
												<a class="box-img" href="javascript" target="_blank">
													<img src="//img.alicdn.com/bao/uploaded/i1/2683428516/TB2xRl.ceIPyuJjSspcXXXiApXa_!!2683428516.jpg_30x30.jpg" alt="">
												</a>
											</div>
										</div>
										<div class="item-info-wrapper">
											<a class="item-title" href="javascript:;" title="" target="_blank">蓓尔韩版亮片女帆布鞋松糕厚底懒人鞋女式休闲鞋白色乐福鞋</a>
										</div>
									</div>
								</span>
								<span class="table-td middle-column">
									<span class="td-value">61.00</span>
								</span>
								<span class="table-td middle-column">
									<span class="td-value">1</span>
								</span>
								<span class="table-td middle-column">
									<span class="td-value">33.34%</span>
								</span>
								<span class="table-td middle-column">
									<span class="td-value">1</span>
								</span>
								<span class="table-td last-column">
									<span class="td-value">
										<a href="index.php?ctl=Seller_Sycm&met=singleProductAnalysis" target="_blank">单品分析</a>
									</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 品牌热销商品排行榜 end -->
		</div>
	</div>
	<!-- 店铺详情 end -->

	<div class="dialog-mask look-trend-dialog">
		<div class="dialog-locator">
			<div class="dialog-container">
				<div class="dialog-header">
					<button type="button" class="dialog-close close">x</button>
					<h4 class="dialog-title">查看趋势-PC端</h4>
				</div>
				<div class="dialog-content">
					<div class="trend-options orflow">
						<div class="combopanel">
							<div class="combopanel-panel combo-panel-lite combo-panel-inline">
								<div class="combopanel-groups">
									<div class="group-wrapper">
										<div class="group clearfix">
											<span class="checkbox selected">
												<span class="option"></span>
												<span class="name">商品数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">引导点击转化率</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">引导支付转化率</span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="commonchart-end" class="commonchart" style="width: 970px; height: 380px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
<script type="text/javascript">
	var transactionTrendChart = echarts.init(document.getElementById('transaction-trend-chart'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#f3d024'];
	        var option = {
	          	tooltip: {
			        trigger: 'axis',
			        backgroundColor: '#fff',
			        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
			        borderColor: '#eee',
			        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
			        padding: 10,
			        textStyle: {
			            color: '#999',
			            fontSize: 12
			        },
			        formatter: function(params) {
			        	var str ='';
			        	var year = new Date().getFullYear();
			        	for(var i = 0; i<params.length;i++) {
			        		str += '<i class="icon" style="width:10px;height:10px;background-color:'+params[i].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[i].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[i].value+'.00</br>'
			        	}
			        	return year+'-'+params[1].name+'</br>'+str;
	        	
			        },
			        axisPointer: {
			        	type: 'line',  // cross时为十字虚线 也可以为shadow
			        	lineStyle: {
			        		color: '#bbb'
			        	},
			        	shadowStyle : {                       // 阴影指示器样式设置
			                width: 'auto',                   // 阴影大小
			                color: 'rgba(150,150,150,0.3)'  // 阴影颜色
			            }
			        }
			    },
	             grid: {
			        bottom: '15%',
			        left: '2%',
			        right: '2%',
			        top: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                 data: ["10-07","10-08","10-09","10-10","10-11","10-12","10-13"],
	                axisLine:{    //坐标轴颜色
	                	show: true,
	                    lineStyle:{
	                        color:'#bbb',
	                        width: 2
	                    }
	                },
	                // axisLine: true,  //  控制 坐标轴显示或隐藏
	                splitLine: {    //删掉参考线
	                	show: false
	                },
	                axisTick: {  // 坐标轴上的小标识
	                	show: false
	                },
	                axisLabel: {  //刻度值
	                	textStyle: {
	                		color: '#bbb'
	                	},
	                	interval: 0  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	            },
	            yAxis: {

	                type: 'value',
	            	// boundaryGap: [0, 0.5],
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: true,
	                	lineStyle: {
			        		color: '#eee'
			        	}
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	                	show: false,
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '同行平均所有终端的支付金额',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
		                showSymbol: false,
		                symbolSize: 8,
		                smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[0],  // 此处绑定图例颜色
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data:  [0, 2, 4, 5, 8, 0, 5]
		            },
		            {
		                name: '我的所有终端的支付金额',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
		                showSymbol: false,
		                symbolSize: 8,
		                smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {
		                			color: colors[1]
		                		}
		                	}
		                },
		                data:  [8, 0, 0, 0, 4, 0, 1]
		            },
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        transactionTrendChart.setOption(option);


  var commonChartEnd = echarts.init(document.getElementById('commonchart-end'));
 		var colors = ['#2062e6','#f3d024'];
        var option = {
          	tooltip: {
		        trigger: 'axis',
		        backgroundColor: '#fff',
		        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
		        borderColor: '#eee',
		        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
		        padding: 10,
		        textStyle: {
		            color: '#999',
		            fontSize: 12
		        },
		        formatter: function(params) {
		        	var str ='';
		        	var year = new Date().getFullYear();
		        	for(var i = 0; i<params.length;i++) {
		        		str += '<i class="icon" style="width:10px;height:10px;background-color:'+params[i].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[i].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[i].value+'.00</br>'
		        	}
		        	return year+'-'+params[1].name+'</br>'+str;
        	
		        },
		        axisPointer: {
		        	type: 'line',  // cross时为十字虚线 也可以为shadow
		        	lineStyle: {
		        		color: '#bbb'
		        	},
		        	shadowStyle : {                       // 阴影指示器样式设置
		                width: 'auto',                   // 阴影大小
		                color: 'rgba(150,150,150,0.3)'  // 阴影颜色
		            }
		        }
		    },
             grid: {
		        bottom: '15%',
		        left: '2%',
		        right: '2%',
		        top: '14%'
		    },
			 axisLabel: {
			   show: false
			 },
            xAxis: {    //  x坐标轴
            	type: 'category',
                 data: ["10-07","10-08","10-09","10-10","10-11","10-12","10-13"],
                axisLine:{    //坐标轴颜色
                	show: true,
                    lineStyle:{
                        color:'#bbb',
                        width: 2
                    }
                },
                // axisLine: true,  //  控制 坐标轴显示或隐藏
                splitLine: {    //删掉参考线
                	show: false
                },
                axisTick: {  // 坐标轴上的小标识
                	show: false
                },
                axisLabel: {  //刻度值
                	textStyle: {
                		color: '#bbb'
                	},
                	interval: 0  // x轴每隔5个显示一次文本
                },
                // axisLabel : {interval: 1},
            },
            yAxis: {

                type: 'value',
            	// boundaryGap: [0, 0.5],
            	axisLine: false,  //  控制 坐标轴显示或隐藏
            	splitLine: {
                	show: true,
                	lineStyle: {
		        		color: '#eee'
		        	}
                },
                axisTick: {
            		show: false
            	},
            	axisLabel: {
                	show: false,
                	textStyle: {
                		align: 'left',
                		color: '#bbb',
                	}
                }
            },
            series: [
	            {
	                name: '所有终端的商品访客数',
	                type: 'line',
	                symbol: 'circle',  // 折点处空心圆
	                showSymbol: false,
	                symbolSize: 8,
	                smooth: true,  // 平滑折线
	                itemStyle: {
	                	normal: {
	                		color: colors[0],  // 此处绑定图例颜色
	                		lineStyle: {    // 线条颜色
	                			color: colors[0]
	                		}
	                	}
	                },
	                data:  [0, 2, 4, 5, 8, 0, 5]
	            },
	            {
	                name: '所有终端的下单件数',
	                type: 'line',
	                symbol: 'circle',  // 折点处空心圆
	                showSymbol: false,
	                symbolSize: 8,
	                smooth: true,  // 平滑折线
	                itemStyle: {
	                	normal: {
	                		color: colors[1],
	                		lineStyle: {
	                			color: colors[1]
	                		}
	                	}
	                },
	                data:  [8, 0, 0, 0, 4, 0, 1]
	            },
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        commonChartEnd.setOption(option);
</script>
<script type="text/javascript">
		// 时间插件
			// 日
			$(".laydate-wrap-day").each(function() {
				laydate.render({
			      elem: this,
			      showBottom: false,
			      position: 'static',
			      change: function(value, date){ //监听日期被切换
	            	var elem = this.elem;
			      	$(".update, .date-wrap").hide();
			      	$(elem).parents(".date-wrap").siblings(".option").find("span").html('自然日&nbsp;(' + value + ' ~ ' + value+')');
			      }
			    });
			})

	   		// 周
	   		$(".laydate-wrap-week").each(function() {
		   		 laydate.render({
		            elem: this,
		            format: 'yyyy-MM-dd',
		            min:'2017-11-26',
		            max:'2017-12-30',
		            value:'2017-12-03 - 2017-12-09',
		            range:'-',
		            week: 1,
		            showBottom: false,
		            position: 'static',
		            change: function(value, date){ //监听日期被切换
		      			var elem = this.elem;
				      	$(".update, .date-wrap").hide();
				      	$(elem).parents(".date-wrap").siblings(".option").find("span").html('自然周&nbsp;(' + value +')');
					}
		        });
	   		})

	    	// 月
	    $(".laydate-wrap-month").each(function() {
	    	laydate.render({
		      elem: this,
		      type: 'month',
		      showBottom: false,
		      position: 'static',
		      change: function(value, date){ //监听日期被切换
		      	var elem = this.elem;
		      	var end = laydate.getEndDate(date.month, date.year);
		      	var year = date.year;
		      	var month = date.month;
		      	month = String(date.month).length === 1 ? '0'+month : month;
		      	$(".update, .date-wrap").hide();
		      	$(elem).parents(".date-wrap").siblings(".option").find("span").html('自然月&nbsp;('+ year+'-'+month+'-01 ~ '+year+'-'+month+'-'+end+')');
		      }
		    });
	    })

	    // 选择 日 周  月
		$(".update-option").mouseover(function() {
			$(this).find(".date-wrap").show();
		}).mouseleave(function() {
			$(this).find(".date-wrap").hide();
		})

		$(".date-wrap .datePicker-item").mouseover(function(){
			var _this = $(this);
			_this.addClass("active").siblings(".active").removeClass("active");
			var str = _this.attr("class").slice(31);
			str = str.slice(0, str.length - 7);
			$(".layui-laydate").css({"display": 'none'});
			if(str.indexOf('day') !== -1 || str.indexOf("week") !== -1 || str.indexOf("month") !== -1) {
				_this.parents("ul").siblings(".laydate-wrap").find(".layui-laydate").show();

				switch (str) {
					case 'day':
						_this.parents("ul").siblings(".laydate-wrap-day").css({"z-index": 1}).find(".layui-laydate").css({"display": "block"}).parents(".laydate-wrap").siblings(".laydate-wrap").css({"z-index": -1}).find(".layui-laydate").css({"display": 'none'});
						break;
					case 'week':
						_this.parents("ul").siblings(".laydate-wrap-week").css({"z-index": 1}).find(".layui-laydate").css({"display": "block"}).parents(".laydate-wrap").siblings(".laydate-wrap").css({"z-index": -1}).find(".layui-laydate").css({"display": 'none'});
						// $(".laydate-wrap").css({"display": "none"});
						break;
					case 'month':
						_this.parents("ul").siblings(".laydate-wrap-month").css({"z-index": 1}).find(".layui-laydate").css({"display": "block"}).parents(".laydate-wrap").siblings(".laydate-wrap").css({"z-index": -1}).find(".layui-laydate").css({"display": 'none'});
						break;
					/*default: 
						$(".laydate-wrap").css({"display": "none"});*/
				}
			} else {
				_this.parents("ul").siblings(".laydate-wrap").css({"z-index": -1});
			}
		})

		$(".date-wrap .realtime").click(function() {
			var _this = $(this);
			_this.parents(".date-wrap").siblings(".update").show().siblings(".option").children("span").text(_this.children(".datePicker-rangeText").text());
			_this.parents(".date-wrap").hide();
		})
		$(".date-wrap .lastest-n").click(function() {
			var _this = $(this);
			if(_this.parents(".date-wrap").siblings(".update").html() !== undefined) {
				console.log('exit')
				_this.parents(".date-wrap").siblings("p.update").hide().siblings(".option").children("span").text(_this.children(".datePicker-rangeText").text()+_this.children(".datePicker-rangeTime").text());
			}
			else {
				_this.parents(".date-wrap").siblings(".option").children("span").text(_this.children(".datePicker-rangeText").text()+_this.children(".datePicker-rangeTime").text());

			}
			_this.parents(".date-wrap").hide();
		})
</script>
<script type="text/javascript">

	// 点击左侧导航nav
	$(".switch-wrap").eq(0).show();
	$(".nav .menu-list-inner .menu-item-inner").click(function(){
		var index = $(this).index();
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
		$(".switch-wrap").hide();
		$(".switch-wrap").eq(index).show();
	})

	// 品牌趋势 start
		$(".shop-detail-wrap .more-index").click(function(){
			$(".combo-panel-inline").toggleClass("changeH");
		})
		function o () {
			var fragment = document.createDocumentFragment();
			var html = '';
			$(".shop-detail-wrap .combopanels-container .checkbox.selected").each(function(i, item) {
				var text = $(this).text();
				var css = '';
				switch (i) {
					case 0: 
						css = 'style = "border-color: rgb(150, 199, 250);color: rgb(30, 116, 231);"';
						break;
					case 1: 
						css = 'style = "border-color: rgb(187, 255, 133);color: rgb(153, 204, 51);"';
						break;
					case 2: 
						css = 'style = "border-color: rgb(254, 200, 92);color: rgb(255, 171, 24);"';
						break;
					case 3: 
						css = 'style = "border-color: rgb(254, 175, 174);color: rgb(253, 116, 97);"';
						break;
				}
				html += '<span class="bordered-tag" '+css+'>'+text+'</span>'

			})
			$(fragment).append(html);
			$(".shop-detail-wrap .selected-indices").append(fragment);
		}
		o();

		$(".page-item .combo-panel-lite .checkbox").click(function(){
			console.log(9)
			var _this = $(this);
			var selectedIndices = _this.parents(".combopanels-container").siblings(".selected-indices");
			var length = selectedIndices.find(".bordered-tag").length;

				if(_this.hasClass("selected")) {
					if(length < 2) {
						_this.parents(".combo-panel-lite").siblings(".error-message").text("至少选择1个指标").show();
					} else {
						_this.parents(".combo-panel-lite").siblings(".error-message").hide();
						_this.removeClass("selected");
						selectedIndices.find(".bordered-tag").remove();
						o();
					}
				} else {
					if(length <= 3) {
						_this.parents(".combo-panel-lite").siblings(".error-message").hide();
						_this.addClass("selected");
						selectedIndices.find(".bordered-tag").remove();
						o();
					} else {
						_this.parents(".combo-panel-lite").siblings(".error-message").text("最多选择4个指标").show();
						return false;
					}
				}
		})
		// 点击重置
		$(".shop-detail-wrap .page-item .operations").click(function() {
			var _this = $(this);
			_this.siblings(".combopanels-container").find(".checkbox.selected").removeClass("selected");
			_this.siblings(".combopanels-container").find(".checkbox").eq(0).addClass("selected");
			_this.siblings(".combopanels-container").find(".checkbox").eq(1).addClass("selected");
			_this.siblings(".selected-indices").find(".bordered-tag").remove();
			o();
		})
	// 品牌趋势 end

	// 查看趋势 start
	$(".shop-detail-wrap .subcategory-list .table-body .actions").click(function() {
		$(".look-trend-dialog").fadeIn(500);
	})
	$(".dialog-mask .dialog-close").click(function() {
		$(".dialog-mask").hide();
	})
	$(".dialog-mask .combo-panel-lite .checkbox").click(function(){
		$(this).toggleClass("selected");
	})

	// 查看趋势 end

			
	// 图标三状态 --- 商品效果
	$(".orderable").click(function(){
		var _this = $(this);
		if(_this.find(".order-flag").hasClass("desc")){
			_this.find(".order-flag").addClass("asc").removeClass("desc");
		}else if(_this.find(".order-flag").hasClass("asc")) {
			_this.find(".order-flag").addClass("desc").removeClass("asc");
		}else{
			_this.siblings(".orderable").find(".desc").removeClass("desc");
			_this.siblings(".orderable").find(".asc").removeClass("asc");
			_this.find(".order-flag").addClass("desc");
		}
	})
	
	// 点击 全部 PC 无线 切换
	$(".actions-tab .ui-switch-item").click(function(){
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
	})

	// 下拉框 .....start
	$(document).click(function(e) {
		$(".select-control .select-control-list").hide();
	});
	$(".select-control-list").click(function(e) {
		e.stopPropagation()
	})
	$(".select-control").click(function(e) {
		e.stopPropagation();
		var _this = $(this);
		if(_this.children(".select-control-list").css("display") === 'block') {
			_this.children(".select-control-list").hide();
		} else {
			$(".select-control").children(".select-control-list").each(function() {
				var inner_this = $(this);
				if(inner_this.css("display") === 'block') {
					$(".select-control-list").hide();
					if($(".ui-selector-children").css("display") === 'block') {
						$(".ui-selector-children").hide();
					}
				}
			})
			_this.children(".select-control-list").show();
		}

		// 判断页面有没有日期插件
		if($(".layui-laydate").length > 0) {
			$(".layui-laydate").hide();
		} else {
			return false;
		}

	});
		//  下拉
	$(".select-control-list .ui-selector-item").click(function(e) {
		var _this = $(this);
		_this.addClass("curr").siblings(".curr").removeClass("curr");
		_this.parents(".ui-selector").find(".ui-selector-value").text(_this.find("span").text());
		_this.parents(".select-control-list").hide();
	})
		// 下载
	$(".ui-download-panel.select-control-list .btn").click(function() {
		$(this).parents(".ui-download-panel").hide();
	})
		// 指标
	$(".ui-combopicker .ui-combopicker-panel .checkbox:not(.disabled)").click(function() {
		var _this = $(this);
		_this.toggleClass("selected");
		var len = parseInt(_this.parents(".ui-combopicker-panel").find(".checkbox.selected").length);
		if(len === 0) {
			_this.parents(".ui-combopicker-groups").siblings(".ui-combopicker-btns").find(".message").addClass("error").text("最少选1项"); 
		}else if (len > 5) {
			_this.parents(".ui-combopicker-groups").siblings(".ui-combopicker-btns").find(".message").addClass("error").text("最多选5项");
		} else {
			_this.parents(".ui-combopicker-groups").siblings(".ui-combopicker-btns").find(".message").text("已选择"+len+"项").removeClass("error");
		}
	})
	$(".ui-combopicker-panel .ui-combopicker-btns .btn").click(function() {
		var _this = $(this);
		if(_this.siblings(".message").hasClass("error")) {
			return false;
		}else {
			_this.parents(".ui-combopicker-panel").hide();
		}
	})
	// 下拉框 .....end
</script>
</html>

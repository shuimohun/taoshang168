<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--物流-->
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
 <link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="<?=$this->view->js_com?>/plugins/dateRange/dateRange.css" />

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
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=transaction">
					交易
				</a>
			</li>
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=service">
					服务
				</a>
			</li>
			<li class="nav-item lf curr">
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
					<p>物流仓储</p>
				</div>
			</div>
			<ul class="menu-list">
				<li class="menu-item lf">
					<p class="nav-name"><i class="icon"></i>物流分析</p>
					<ul class="menu-list-inner">
						<li class="menu-item-inner lf curr">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">物流概况</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">物流分布</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">物流监控</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="menu-item lf">
					<p class="nav-name"><i class="icon"></i>物流管家</p>
					<ul class="menu-list-inner">
						<!-- <li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">智能发货</span>
							</a>
						</li> -->
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">包裹中心</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">异常包裹</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">买家投诉</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">退货包裹</span>
							</a>
						</li>
					</ul>
				</li>
				<!-- <li class="menu-item lf">
					<p class="nav-name"><i class="icon"></i>供应链服务</p>
					<ul class="menu-list-inner">
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">商家服务360</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">网络仿真</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">分仓宝</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">参数设置</span>
							</a>
						</li>
					</ul>
				</li> -->
			</ul>
		</div>
	</div>
	<!-- 物流概况 start -->
	<div class="w-1040  rt switch-wrap logistics-container">
		<div class="logistics-overlook-wrp">
			<div class="screen-header h-50">
				<div class="update-option">
					<!-- <p class="lf update">更新时间：<span>2017-02-26&nbsp;&nbsp;09:45:36</span></p> -->
					<p class="rt option"><span>最近1天(2017-10-11 ~ 2017-10-11)</span><i class="icon caret"></i></p>
					<div class="date-wrap">
						<ul>
							<!-- <li class="datePicker-item active realtime">
								<span class="datePicker-rangeText">实时</span>
								<span class="datePicker-rangeTime rt"></span>
							</li> -->
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
								<span class="datePicker-rangeText" >日</span>
								<span class="datePicker-rangeTime"></span>
							</li>
							<li class="datePicker-item datetimepicker-week">
								<span class="datePicker-rangeText">周</span>
								<span class="datePicker-rangeTime"></span>
							</li>
							<li class="datePicker-item datetimepicker-month">
								<span class="datePicker-rangeText ">月</span>
								<span class="datePicker-rangeTime"></span>
							</li>
						</ul>
						<div class="laydate-wrap laydate-wrap-day" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
						<div class="laydate-wrap laydate-wrap-week" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
						<div class="laydate-wrap laydate-wrap-month" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
					</div>
				</div>
			</div>
			<!-- 物流总览 start -->
			<div class="logistics-overview-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">物流总览</div>
				</div>
				<div class="ebase-card-content">
					<div>
						<div class="indexCell-root lf" style="width: 20%;">
							<div class="index-name">退款时长</div>
							<div class="index-value">0.00</div>
							<div class="index-change orflow">
								<span class="lf">较前日</span>
								<span class="rt">
									<span class="num">55.0%</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>	
							<div class="index-change orflow">
								<span class="lf">同行均值</span>
								<span class="rt">
									<span class="num">2.06%</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="indexCell-root lf" style="width: 20%;">
							<div class="index-name">退款时长</div>
							<div class="index-value">0.00</div>
							<div class="index-change orflow">
								<span class="lf">较前日</span>
								<span class="rt">
									<span class="num">-</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>	
							<div class="index-change orflow">
								<span class="lf">同行均值</span>
								<span class="rt">
									<span class="num">2.06%</span>
									<span class="r-tend">
										<i class="icon"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="indexCell-root lf" style="width: 20%;">
							<div class="index-name">退款时长</div>
							<div class="index-value">0.00</div>
							<div class="index-change orflow">
								<span class="lf">较前日</span>
								<span class="rt">
									<span class="num">-</span>
									<span class="r-tend down">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>	
							<div class="index-change orflow">
								<span class="lf">同行均值</span>
								<span class="rt">
									<span class="num">2.06%</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="indexCell-root lf" style="width: 20%;">
							<div class="index-name">退款时长</div>
							<div class="index-value">0.00</div>
							<div class="index-change orflow">
								<span class="lf">较前日</span>
								<span class="rt">
									<span class="num">-</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>	
							<div class="index-change orflow">
								<span class="lf">同行均值</span>
								<span class="rt">
									<span class="num">2.06%</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="indexCell-root lf" style="width: 20%;">
							<div class="index-name">退款时长</div>
							<div class="index-value">0.00</div>
							<div class="index-change orflow">
								<span class="lf">较前日</span>
								<span class="rt">
									<span class="num">-</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>	
							<div class="index-change orflow">
								<span class="lf">同行均值</span>
								<span class="rt">
									<span class="num">2.06%</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="indexCell-root lf" style="width: 20%;">
							<div class="index-name">平均支付-发货时长</div>
							<div class="index-value">0.00</div>
							<div class="index-change orflow">
								<span class="lf">较前日</span>
								<span class="rt">
									<span class="num">-</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>	
							<div class="index-change orflow">
								<span class="lf">同行均值</span>
								<span class="rt">
									<span class="num">2.06%</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="indexCell-root lf" style="width: 20%;">
							<div class="index-name">平均发货-揽货时长</div>
							<div class="index-value">0.00</div>
							<div class="index-change orflow">
								<span class="lf">较前日</span>
								<span class="rt">
									<span class="num">-</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>	
							<div class="index-change orflow">
								<span class="lf">同行均值</span>
								<span class="rt">
									<span class="num">2.06%</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="indexCell-root lf" style="width: 20%;">
							<div class="index-name">退款时长</div>
							<div class="index-value">0.00</div>
							<div class="index-change orflow">
								<span class="lf">较前日</span>
								<span class="rt">
									<span class="num">-</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>	
							<div class="index-change orflow">
								<span class="lf">同行均值</span>
								<span class="rt">
									<span class="num">2.06%</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="indexCell-root lf" style="width: 20%;">
							<div class="index-name">退款时长</div>
							<div class="index-value">0.00</div>
							<div class="index-change orflow">
								<span class="lf">较前日</span>
								<span class="rt">
									<span class="num">-</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>	
							<div class="index-change orflow">
								<span class="lf">同行均值</span>
								<span class="rt">
									<span class="num">2.06%</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="indexCell-root lf" style="width: 20%;">
							<div class="index-name">退款时长</div>
							<div class="index-value">0.00</div>
							<div class="index-change orflow">
								<span class="lf">较前日</span>
								<span class="rt">
									<span class="num">-</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>	
							<div class="index-change orflow">
								<span class="lf">同行均值</span>
								<span class="rt">
									<span class="num">2.06%</span>
									<span class="r-tend down">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="indexCell-root lf" style="width: 20%;">
							<div class="index-name">退款时长</div>
							<div class="index-value">0.00</div>
							<div class="index-change orflow">
								<span class="lf">较前日</span>
								<span class="rt">
									<span class="num">-</span>
									<span class="r-tend up">
										<i class="icon icon-trend"></i>
									</span>
								</span>
							</div>	
							<div class="index-change orflow">
								<span class="lf">同行均值</span>
								<span class="rt">
									<span class="num">2.06%</span>
									<span class="r-tend">
										<i class="icon"></i>
									</span>
								</span>
							</div>
						</div>
						<!-- <div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>数据为空</span>
								</p>
							</div>
						</div> -->
					</div>
				</div>
			</div>
			<!-- 物流总览 end -->

			<!-- 物流趋势  start -->
			<div class="logistics-trend-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">物流趋势</div>
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table">
						<div>
							<div class="onenessCard">
								<div class="oui-index-picker">
									<div class="oui-index-picker-group">
										<div class="oui-index-picker-label lf">工作量</div>
										<div class="oui-index-picker-content">
											<div class="oui-index-picker-blank"></div>
											<div class="combo-panel-lite combo-panel-inline lf">
												<span class="checkbox selected">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
											</div>
										</div>
									</div>
									<div class="oui-index-picker-group">
										<div class="oui-index-picker-label lf">效率</div>
										<div class="oui-index-picker-content">
											<div class="oui-index-picker-blank"></div>
											<div class="combo-panel-lite combo-panel-inline lf">
												<span class="checkbox selected">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
											</div>
										</div>
									</div>
									<div class="oui-index-picker-group">
										<div class="oui-index-picker-label lf">效果</div>
										<div class="oui-index-picker-content">
											<div class="oui-index-picker-blank"></div>
											<div class="combo-panel-lite combo-panel-inline lf">
												<span class="checkbox selected">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
											</div>
										</div>
									</div>
									<div class="oui-index-picker-action">
										<span class="oui-index-picker-count">选择 4/4</span>
										<a href="javascript:;" class="oui-index-picker-reset">重置</a>
									</div>
								</div>
								<div class="product-trend-chart mt-22" id="logistics-trend-chart" style="width: 980px;height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 物流趋势  end -->
			<!-- 物流服务质量评价  start -->
			<div class="logisticsService-score-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">物流服务质量评价</div>
				</div>
				<div class="ebase-card-content">
					<div class="lf logisticsService-score">
						<!-- <div id="logisticsService-score-chart" class="logisticsService-score-chart" style="width: 650px;height: 320px;"></div> -->
						<div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>评价数太少</span>
								</p>
							</div>
						</div>
					</div>
					<div class="rt ebase-table-root">
						<table class="table mt-45" style="width: 305px;">
							<thead class="thead">
								<tr class="tr">
									<th class="th col-0 col-name" style="text-align: left;">商品评分</th>
									<th class="th col-1 col-quality" style="text-align: right;"></th>
								</tr>
							</thead>
							<tbody ></tbody>
						</table>
						<div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>评价数太少</span>
								</p>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- 物流服务质量评价  end -->

			<!-- 物流异常  start -->
			<div class="logistics-unusual-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">物流异常</div>
					<span class="rt" style="font-size: 12px;margin-top:5px;">
						<a href="javascript:;" style="color: #2062e6;">物流监控></a>
					</span>
				</div>
				<div class="ebase-card-content">
					<div class="lf logistics-unusual">
						<div id="logisticsUnusual-score-chart" class="logisticsService-score-chart" style="width: 650px;height: 320px;"></div>
						<!-- <div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>评价数太少</span>
								</p>
							</div>
						</div> -->
					</div>
					<div class="rt ebase-table-root">
						<table class="table mt-45" style="width: 305px;">
							<thead class="thead">
								<tr class="tr">
									<th class="th col-0 col-name" style="text-align: left;width: 190px;">异常原因</th>
									<th class="th col-1 col-value" style="text-align: right;">异常包裹数</th>
								</tr>
							</thead>
							<tbody class="tbody">
								<tr class="tr">
									<td class="td col-0 col-name text1" style="text-align: left;width: 190px;">
										<i class="icon-circle icon blue"></i>
										<span class="text1" style="width: 190px;">派签超2日签收成功</span>
									</td>
									<td class="td col-1 col-value" style="text-align: right;">-
									</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-name text1" style="text-align: left;width: 190px;">
										<i class="icon-circle icon green"></i>
										<span class="text1" style="width: 190px;">虚假投诉</span>
									</td>
									<td class="td col-1 col-value" style="text-align: right;">-
									</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-name text1" style="text-align: left;width: 190px;">
										<i class="icon-circle icon yellow"></i>
										<span class="text1" style="width: 190px;">揽签超7日签收成功</span>
									</td>
									<td class="td col-1 col-value" style="text-align: right;">-
									</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-name text1" style="text-align: left;width: 190px;">
										<i class="icon-circle icon orange"></i>
										<span class="text1" style="width: 190px;">支付后超72小时揽收</span>
									</td>
									<td class="td col-1 col-value" style="text-align: right;">1
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- 物流异常  end -->

			<!-- TOP收货省份分布  start -->
			<div class="provincesReceiving-distribution-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">TOP收货省份分布</div>
					<span class="rt" style="font-size: 12px;margin-top:5px;">
						<a href="javascript:;" style="color: #2062e6;">物流分布></a>
					</span>
				</div>
				<div class="ebase-card-content">
					<div class="rt ebase-table-root">
						<table class="table">
							<thead class="thead">
								<tr class="tr">
									<th class="th col-0 col-rankId" style="width:10%;text-align: left;">排名</th>
									<th class="th col-1 col-areaName" style="width:20%;text-align: left;">收货省份</th>
									<th class="th col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<span>
											<span>揽收包裹数</span>
											<span class="ebase-ratio">(占比)</span>
										</span>
									</th>
									<th class="th col-3 col-takeOverSignTime" style="width:25%;text-align: right;">平均揽收-签收时长</th>
									<th class="th col-4 col-signSucPkgRate" style="width:25%;text-align: right;">签收成功率</th>
								</tr>
							</thead>
							<tbody class="tbody">
								<tr class="tr">
									<td class="td col-0 col-rankId" style="width:10%;text-align: left;">1</td>
									<td class="td col-1 col-areaName" style="width:20%;text-align: left;">广东省</td>
									<td class="td col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<div class="ebase-DetailIndex-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">2</span>
												<span class="ebase-detail-rate">(33.02%)</span>
											</p>
										</div>
									</td>
									<td class="td col-3 col-takeOverSignTime" style="width:25%;text-align: right;">40.88小时</td>
									<td class="td col-4 col-signSucPkgRate" style="width:25%;text-align: right;">100.00%</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-rankId" style="width:10%;text-align: left;">1</td>
									<td class="td col-1 col-areaName" style="width:20%;text-align: left;">广东省</td>
									<td class="td col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<div class="ebase-DetailIndex-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">2</span>
												<span class="ebase-detail-rate">(33.02%)</span>
											</p>
										</div>
									</td>
									<td class="td col-3 col-takeOverSignTime" style="width:25%;text-align: right;">40.88小时</td>
									<td class="td col-4 col-signSucPkgRate" style="width:25%;text-align: right;">100.00%</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-rankId" style="width:10%;text-align: left;">1</td>
									<td class="td col-1 col-areaName" style="width:20%;text-align: left;">广东省</td>
									<td class="td col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<div class="ebase-DetailIndex-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">2</span>
												<span class="ebase-detail-rate">(33.02%)</span>
											</p>
										</div>
									</td>
									<td class="td col-3 col-takeOverSignTime" style="width:25%;text-align: right;">40.88小时</td>
									<td class="td col-4 col-signSucPkgRate" style="width:25%;text-align: right;">100.00%</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-rankId" style="width:10%;text-align: left;">1</td>
									<td class="td col-1 col-areaName" style="width:20%;text-align: left;">广东省</td>
									<td class="td col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<div class="ebase-DetailIndex-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">2</span>
												<span class="ebase-detail-rate">(33.02%)</span>
											</p>
										</div>
									</td>
									<td class="td col-3 col-takeOverSignTime" style="width:25%;text-align: right;">40.88小时</td>
									<td class="td col-4 col-signSucPkgRate" style="width:25%;text-align: right;">100.00%</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-rankId" style="width:10%;text-align: left;">1</td>
									<td class="td col-1 col-areaName" style="width:20%;text-align: left;">广东省</td>
									<td class="td col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<div class="ebase-DetailIndex-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">2</span>
												<span class="ebase-detail-rate">(33.02%)</span>
											</p>
										</div>
									</td>
									<td class="td col-3 col-takeOverSignTime" style="width:25%;text-align: right;">40.88小时</td>
									<td class="td col-4 col-signSucPkgRate" style="width:25%;text-align: right;">100.00%</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- TOP收货省份分布  end -->

			<!-- TOP收货物流公司分布  start -->
			<div class="logisticsReceiving-distribution-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">TOP收货物流公司分布</div>
					<span class="rt" style="font-size: 12px;margin-top: 5px;">
						<a href="javascript:;" style="color: #2062e6;">物流分布></a>
					</span>
				</div>
				<div class="ebase-card-content">
					<div class="rt ebase-table-root">
						<table class="table">
							<thead class="thead">
								<tr class="tr">
									<th class="th col-0 col-rankId" style="width:10%;text-align: left;">排名</th>
									<th class="th col-1 col-areaName" style="width:20%;text-align: left;">收货省份</th>
									<th class="th col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<span>
											<span>揽收包裹数</span>
											<span class="ebase-ratio">(占比)</span>
										</span>
									</th>
									<th class="th col-3 col-takeOverSignTime" style="width:25%;text-align: right;">平均揽收-签收时长</th>
									<th class="th col-4 col-signSucPkgRate" style="width:25%;text-align: right;">签收成功率</th>
								</tr>
							</thead>
							<tbody class="tbody">
								<tr class="tr">
									<td class="td col-0 col-rankId" style="width:10%;text-align: left;">1</td>
									<td class="td col-1 col-areaName" style="width:20%;text-align: left;">广东省</td>
									<td class="td col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<div class="ebase-DetailIndex-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">2</span>
												<span class="ebase-detail-rate">(33.02%)</span>
											</p>
										</div>
									</td>
									<td class="td col-3 col-takeOverSignTime" style="width:25%;text-align: right;">40.88小时</td>
									<td class="td col-4 col-signSucPkgRate" style="width:25%;text-align: right;">100.00%</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-rankId" style="width:10%;text-align: left;">1</td>
									<td class="td col-1 col-areaName" style="width:20%;text-align: left;">广东省</td>
									<td class="td col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<div class="ebase-DetailIndex-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">2</span>
												<span class="ebase-detail-rate">(33.02%)</span>
											</p>
										</div>
									</td>
									<td class="td col-3 col-takeOverSignTime" style="width:25%;text-align: right;">40.88小时</td>
									<td class="td col-4 col-signSucPkgRate" style="width:25%;text-align: right;">100.00%</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-rankId" style="width:10%;text-align: left;">1</td>
									<td class="td col-1 col-areaName" style="width:20%;text-align: left;">广东省</td>
									<td class="td col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<div class="ebase-DetailIndex-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">2</span>
												<span class="ebase-detail-rate">(33.02%)</span>
											</p>
										</div>
									</td>
									<td class="td col-3 col-takeOverSignTime" style="width:25%;text-align: right;">40.88小时</td>
									<td class="td col-4 col-signSucPkgRate" style="width:25%;text-align: right;">100.00%</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-rankId" style="width:10%;text-align: left;">1</td>
									<td class="td col-1 col-areaName" style="width:20%;text-align: left;">广东省</td>
									<td class="td col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<div class="ebase-DetailIndex-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">2</span>
												<span class="ebase-detail-rate">(33.02%)</span>
											</p>
										</div>
									</td>
									<td class="td col-3 col-takeOverSignTime" style="width:25%;text-align: right;">40.88小时</td>
									<td class="td col-4 col-signSucPkgRate" style="width:25%;text-align: right;">100.00%</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-rankId" style="width:10%;text-align: left;">1</td>
									<td class="td col-1 col-areaName" style="width:20%;text-align: left;">广东省</td>
									<td class="td col-2 col-takeOverPkgCnt" style="width:20%;text-align: right;">
										<div class="ebase-DetailIndex-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">2</span>
												<span class="ebase-detail-rate">(33.02%)</span>
											</p>
										</div>
									</td>
									<td class="td col-3 col-takeOverSignTime" style="width:25%;text-align: right;">40.88小时</td>
									<td class="td col-4 col-signSucPkgRate" style="width:25%;text-align: right;">100.00%</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- TOP收货物流公司分布  end -->
		</div>
	</div>
	<!-- 物流概况 end -->


	<!-- 物流分布 start -->
	<div class="w-1040  rt switch-wrap logistics-container">
		<div class="logistics-distribute-wrap">
			<div class="screen-header h-50">
				<div class="update-option">
					<!-- <p class="lf update">更新时间：<span>2017-02-26&nbsp;&nbsp;09:45:36</span></p> -->
					<p class="rt option"><span>最近1天(2017-10-11 ~ 2017-10-11)</span><i class="icon caret"></i></p>
					<div class="date-wrap">
						<ul>
							<!-- <li class="datePicker-item active realtime">
								<span class="datePicker-rangeText">实时</span>
								<span class="datePicker-rangeTime rt"></span>
							</li> -->
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
								<span class="datePicker-rangeText" >日</span>
								<span class="datePicker-rangeTime"></span>
							</li>
							<li class="datePicker-item datetimepicker-week">
								<span class="datePicker-rangeText">周</span>
								<span class="datePicker-rangeTime"></span>
							</li>
							<li class="datePicker-item datetimepicker-month">
								<span class="datePicker-rangeText ">月</span>
								<span class="datePicker-rangeTime"></span>
							</li>
						</ul>
						<div class="laydate-wrap laydate-wrap-day" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
						<div class="laydate-wrap laydate-wrap-week" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
						<div class="laydate-wrap laydate-wrap-month" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
					</div>
				</div>
				<div class="receive-addr-picker common-picker-wrap" style="display: inline-block;vertical-align: top;margin-right: 10px;color: #999;font-size: 12px;">
					<span class="common-picker-name">收货地</span>
					<div class="select-control common-picker isready">
						<a class="common-picker-header" href="#" title="所有品牌">
							<span class="short-name">全国</span>
							<i class="caret icon"></i>
						</a>
						<div class="common-picker-menu select-control-list" style="height: auto; width: 210px; right: -20px;">
							<div class="tree-search-wrapper">
								<div class="ebase-CommonSearch__root">
									<div class="legacy-oui-typeahead common-typeahead">
										<div class="legacy-oui-typeahead-input-wrapper">
											<input type="text" class="legacy-oui-typeahead-input" value="" placeholder="请输入关键字" autofocus="autofocus">
											<i class="oui-icon oui-icon-search search-icon"></i>
											<span class="search-del">×</span>
										</div>
									</div>
								</div>
							</div>
							<div class="trees-menu" style="max-height:260px;overflow: auto;">
								<ul class="tree-menu common-menu tree-scroll-menu-level-1">
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="send-addr-picker common-picker-wrap" style="display: inline-block;vertical-align: top;margin-right: 10px;color: #999;font-size: 12px;">
					<span class="common-picker-name">发货地</span>
					<div class="select-control common-picker isready">
						<a class="common-picker-header" href="#" title="所有品牌">
							<span class="short-name">全国</span>
							<i class="caret icon"></i>
						</a>
						<div class="common-picker-menu select-control-list" style="height: auto; width: 210px; right: -20px;">
							<div class="tree-search-wrapper">
								<div class="ebase-CommonSearch__root">
									<div class="legacy-oui-typeahead common-typeahead">
										<div class="legacy-oui-typeahead-input-wrapper">
											<input type="text" class="legacy-oui-typeahead-input" value="" placeholder="请输入关键字" autofocus="autofocus">
											<i class="oui-icon oui-icon-search search-icon"></i>
											<span class="search-del">×</span>
										</div>
									</div>
								</div>
							</div>
							<div class="trees-menu" style="max-height: 260px;overflow: auto;">
								<ul class="tree-menu common-menu tree-scroll-menu-level-1"></ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 物流分布  start -->
			<div class="logistics-distribution-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">物流分布</div>
				</div>
				<div class="ebase-card-content">
					<div>
						<div class="onenessCard">
							<div class="oui-index-picker orflow">
								<div class="oui-index-picker-group">
									<div class="oui-index-picker-label lf">工作量</div>
									<div class="oui-index-picker-content">
										<div class="oui-index-picker-blank"></div>
										<div class="combo-panel-lite combo-panel-inline lf">
											<span class="checkbox selected">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
										</div>
									</div>
								</div>
								<div class="oui-index-picker-group">
									<div class="oui-index-picker-label lf">效率</div>
									<div class="oui-index-picker-content">
										<div class="oui-index-picker-blank"></div>
										<div class="combo-panel-lite combo-panel-inline lf">
											<span class="checkbox selected">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
										</div>
									</div>
								</div>
								<div class="oui-index-picker-group">
									<div class="oui-index-picker-label lf">效果</div>
									<div class="oui-index-picker-content">
										<div class="oui-index-picker-blank"></div>
										<div class="combo-panel-lite combo-panel-inline lf">
											<span class="checkbox selected">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
										</div>
									</div>
								</div>
								<div class="oui-index-picker-group">
									<div class="oui-index-picker-label lf">异常</div>
									<div class="oui-index-picker-content">
										<div class="oui-index-picker-blank"></div>
										<div class="combo-panel-lite combo-panel-inline lf">
											<span class="checkbox selected">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
										</div>
									</div>
								</div>
								<div class="oui-index-picker-action">
									<span class="oui-index-picker-count">选择 4/4</span>
									<a href="javascript:;" class="oui-index-picker-reset">重置</a>
								</div>
							</div>
							<div class="line"></div>
							<div class="oui-index-picker orflow">
								<div class="oui-index-picker-group">
									<div class="oui-index-picker-label lf">物流公司</div>
									<div class="oui-index-picker-content">
										<div class="oui-index-picker-blank"></div>
										<ul class="oui-index-picker-list orflow"></ul>
									</div>
								</div>
							</div>
						</div>
						<div class="ebase-table-root">
							<table class="table">
								<thead class="thead">
									<th class="th col-0 col-areaName" style="width: 130px;text-align: left;">收货地</th>
									<th class="th col-1 col-takeOverPkgCnt sortableTh orderable" style="text-align: right;">
										<span>揽收包裹数</span>
										<span class="ebase-ratio">(占比)</span>
										<span class="order-flag desc">
											<i class="icon icon-order"></i>
										</span>
									</th>
									<th class="th col-2 col-signSucPkgRate sortableTh sortableTh orderable" style="text-align: right;">
										<span>签收成功包裹数</span>
										<span class="ebase-ratio">(占比)</span>
										<span class="order-flag">
											<i class="icon icon-order"></i>
										</span>
									</th>
									<th class="th col-3 col-avgTakeOverSignTime sortableTh orderable" style="text-align: right;">
										<span>平均揽收-签收时长（小时）</span>
										<span class="order-flag">
											<i class="icon icon-order"></i>
										</span>
									</th>
									<th class="th col-4 col-signSucPkgRate sortableTh sortableTh orderable" style="text-align: right;">
										<span>签收成功率</span>
										<span class="order-flag">
											<i class="icon icon-order"></i>
										</span>
									</th>
									<th class="th col-5 col-opt" style="text-align: right;">操作</th>
								</thead>
								<tbody></tbody>
							</table>
							<div class="no-data-message">
								<div class="ui-message-empty">
									<p class="ui-message-content">
										<span class="noromal">
											<i class="icon"></i>
										</span>
										<span>评价数太少</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 物流分布  end -->
		</div>
	</div>
	<!-- 物流分布 end -->


	<!-- 物流监控 start -->
	<div class="w-1040  rt switch-wrap logistics-container">
		<div class="logistics-watch-wrap">
			<div class="screen-header h-50">
				<div class="send-addr-picker common-picker-wrap" style="display: inline-block;vertical-align: top;margin-right: 10px;color: #999;font-size: 12px;">
					<span class="common-picker-name">发货地</span>
					<div class="select-control common-picker isready open">
						<a class="common-picker-header" href="#" title="所有品牌">
							<span class="short-name">全部</span>
							<i class="caret icon"></i>
						</a>
						<div class="common-picker-menu select-control-list" style="height:auto;width: 210px; right: -20px;">
							<div class="tree-search-wrapper">
								<div class="ebase-CommonSearch__root">
									<div class="legacy-oui-typeahead common-typeahead">
										<div class="legacy-oui-typeahead-input-wrapper">
											<input type="text" class="legacy-oui-typeahead-input" value="" placeholder="请输入关键字">
											<i class="oui-icon oui-icon-search search-icon"></i>
											<span class="search-del">×</span>
										</div>
									</div>
								</div>
							</div>
							<div class="trees-menu" style="max-height:260px;overflow: auto;">
								<ul class="tree-menu common-menu tree-scroll-menu-level-1">
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="receive-addr-picker common-picker-wrap" style="display: inline-block;vertical-align: top;margin-right: 10px;color: #999;font-size: 12px;">
					<span class="common-picker-name">收货地</span>
					<div class="select-control common-picker isready open">
						<a class="common-picker-header" href="#" title="所有品牌">
							<span class="short-name">全国</span>
							<i class="caret icon"></i>
						</a>
						<div class="common-picker-menu select-control-list" style="height: auto; width: 210px; right: -20px;">
							<div class="tree-search-wrapper">
								<div class="ebase-CommonSearch__root">
									<div class="legacy-oui-typeahead common-typeahead">
										<div class="legacy-oui-typeahead-input-wrapper">
											<input type="text" class="legacy-oui-typeahead-input" value="" placeholder="请输入关键字">
											<i class="oui-icon oui-icon-search search-icon"></i>
											<span class="search-del">×</span>
										</div>
									</div>
								</div>
							</div>
							<div class="trees-menu" style="max-height:260px;overflow: auto;">
								<ul class="tree-menu common-menu tree-scroll-menu-level-1">
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="companies-picker common-picker-wrap" style="display: inline-block;vertical-align: top;margin-right: 10px;color: #999;font-size: 12px;">
					<span class="common-picker-name">物流公司</span>
					<div class="select-control common-picker isready open">
						<a class="common-picker-header" href="#" title="所有品牌">
							<span class="short-name">全部</span>
							<i class="caret icon"></i>
						</a>
						<div class="common-picker-menu select-control-list" style="height: auto; width: 210px; right: -20px;">
							<div class="tree-search-wrapper">
								<div class="ebase-CommonSearch__root">
									<div class="legacy-oui-typeahead common-typeahead">
										<div class="legacy-oui-typeahead-input-wrapper">
											<input type="text" class="legacy-oui-typeahead-input" value="" placeholder="请输入关键字">
											<i class="oui-icon oui-icon-search search-icon"></i>
											<span class="search-del">×</span>
										</div>
									</div>
								</div>
							</div>
							<div class="trees-menu" style="max-height:260px;overflow: auto;">
								<ul class="tree-menu common-menu tree-scroll-menu-level-1">
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="reason-picker common-picker-wrap" style="display: inline-block;vertical-align: top;margin-right: 10px;color: #999;font-size: 12px;">
					<span class="common-picker-name">物流异常原因</span>
					<div class="select-control common-picker isready open">
						<a class="common-picker-header" href="#" title="所有品牌">
							<span class="short-name">物流异常原因</span>
							<i class="caret icon"></i>
						</a>
						<div class="common-picker-menu select-control-list" style="height: auto; width: 210px; right: -20px;">
							<div class="tree-search-wrapper">
								<div class="ebase-CommonSearch__root">
									<div class="legacy-oui-typeahead common-typeahead">
										<div class="legacy-oui-typeahead-input-wrapper">
											<input type="text" class="legacy-oui-typeahead-input" value="" placeholder="请输入关键字">
											<i class="oui-icon oui-icon-search search-icon"></i>
											<span class="search-del">×</span>
										</div>
									</div>
								</div>
							</div>
							<div class="trees-menu" style="max-height:260px;overflow: auto;">
								<ul class="tree-menu common-menu tree-scroll-menu-level-1">
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 物流异常  start -->
			<div class="logistics-unusual-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">物流异常</div>
					<div class="pagesInfo-tips rt">物流监控数据来自菜鸟快递指数，数据每小时更新，最新更新时间为：<p class="date-time-wrap" style="display: inline;"><span class="year">2017</span>-<span class="month">12</span>-<span class="date">02</span></p><p class="time-wrap" style="display: inline;"><span class="hours">12</span>:<span class="minute">20</span><span class="second">00</span></p></div>
				</div>
				<div class="ebase-card-content">
					<div>
						<div class="logisticsWrap-input">
							<input type="text" class="logistics-input" name="" placeholder="请输入完整的订单编号或运单号并敲回车">
						</div>
						<div>
							<div class="ebase-table-root">
								<table class="table">
									<thead class="thead">
										<th class="th col-0 col-moreId" style="text-align: left;">订单编号</th>
										<th class="th col-1 col-cpName" style="text-align: left;">物流公司</th>
										<th class="th col-2 col-mailNo" style="text-align: left;">运单号</th>
										<th class="th col-3 col-abnId" style="text-align: left;">异常原因</th>
										<th class="th col-4 col-moreId sortableTh orderable" style="text-align: right;">
											<span>支付时间</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-5 col-payAfterTime sortableTh orderable" style="text-align: right;">
											<span>支付后已用时</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-6 col-lsAfterTime sortableTh orderable" style="text-align: right;">
											<span>揽收后已用时</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-7 col-mailNo" style="text-align: right;">操作</th>
									</thead>
									<tbody class="tbody"></tbody>
								</table>
								<div class="no-data-message">
									<div class="ui-message-empty">
										<p class="ui-message-content">
											<span class="noromal">
												<i class="icon"></i>
											</span>
											<span>评价数太少</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 物流异常  end -->
		</div>
	</div>
	<!-- 物流监控 end -->

	<!-- 包裹中心 start -->
	<div class="w-1040 rt switch-wrap logistics-container">
		<div class="package-center-wrap">
			<div class="cainiao">
				<!-- <input type="hidden" name=""> -->
				<div class="row row-flex b-body">
					<div class="col-flex b-page active"></div>
					<!-- 搜索区-->
					<form class="form-horizontal row b-search-form b-region">
						<div class="row row-flex">
							<div class="col-flex">
								<div class="row">
									<div class="row cols-fixed">
										<!-- 日历选择框 -->
										<div class="input-group col-lg-6 control-group c-calendar-select-field">
											<label  class="control-label">发货时间</label>
											<div class="c-combox input-group c-calendar-select c-select">
												<input id= "f_h_time" type="text" name="" class="form-control readonly" readonly="readonly" placeholder="请选择发货日期区间">
											</div>
										</div>
										<!-- 单选下拉框 -->
										<div class="input-group col-lg-5 control-group c-calendar-select-field">
											<label class="control-label">包裹状态</label>
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select class="form-control">
														<option value="">全部</option>
														<option value="">北京</option>
														<option value="">河北省</option>
														<option value="">天津</option>
														<option value="">山西社</option>
														<option value="">呢诶蒙古</option>
														<option value="">辽宁省</option>
														<option value="">山西省</option>
													</select>
												</div>
											</div>
										</div>
										<!-- 单选下拉框 -->
										<div class="input-group col-lg-5 control-group c-calendar-select-field">
											<label class="control-label">物流公司</label>
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select class="form-control">
														<option value="">全部</option>
														<option value="">北京</option>
														<option value="">河北省</option>
														<option value="">天津</option>
														<option value="">山西社</option>
														<option value="">呢诶蒙古</option>
														<option value="">辽宁省</option>
														<option value="">山西省</option>
													</select>
												</div>
											</div>
										</div>
										<!-- 输入框 -->
										<div class="input-group col-lg-5 control-group c-calendar-select-field">
											<label class="control-label">单号/旺旺</label>
											<div class="c-combox input-group c-select">
												<input type="text" name="" class="form-control" placeholder="运费号/订单号/买家旺旺">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<button type="button" class="btn btn-minor b-searc-btn">筛选</button>
								<button type="button" class="btn b-searc-btn">清楚筛选</button>
							</div>
						</div>
					</form>
					<!-- 表格展示区 -->
					<div class="row b-region mt-10">
						<!-- 这里是表格组件的主体 -->
						<div class="c-grid-table" style="width:100%;height: auto;">
							<div class="grid-table-header-ct">
								<div class="grid-row grid-header" style="width:1241px;">
									<div class="grid-row-inner">
										<div class="grid-cell column-first grid-cell-ellipsis" style="text-align: center;width:207px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">发货时间</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:103px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">包裹状态</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:103px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">物流公司</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:207px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">运单信息</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:103px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">买家旺旺</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:310px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">订单信息
													<div class="cn-switch control-group c-switch-field">
														<label class="control-label"></label>
														<div class="c-switch c-switch-off">
															<div class="c-switch-btn"></div>
															<span class="c-switch-text">详细</span>
														</div>

													</div>
												</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:103px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">备注</span>
											</div>
										</div>
										<div class="grid-cell column-last grid-cell-ellipsis" style="text-align: center;width:105px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">操作</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="grid-table-rows-ct" style="height: auto;">
								<div class="grid-table-rows-ct-inner" style="min-width: 1241px;">
									<div class="grid-row" style="min-width: 1241px; height: auto;">
										<div class="grid-row-inner">
											<div class="grid-cell column-first" style="width: 207px;text-align: center">
												<div class="grid-cell-inner">2017-11-23 14:17<br>11天</div>
											</div>
											<div class="grid-cell" style="width: 103px;text-align: center">
												<div class="grid-cell-inner">已签收<br>
													<a class="grid-cell-link J-viewLogistics0" herf="#" target="_blank" style="position: relative;">查看详情
														<div class="c-tooltip tooltip bottom tip-" style="display: none;">
															<div class="tooltip-arrow"></div>
															<div class="tooltip-inner">
																<i class="c-icon text- undefined"></i>
																<span>
																	<ul class="c-time-line  c-time-line-small">
																		<li>
																			<div class="c-time-line-icon">
																				<div class="c-time-line-icon-default"></div>
																			</div>
																			<div class="c-time-line-detail" style="width: 400px;">
																				<p>广州市【广州黄埔东区站】，本人, 已签收</p>
																					<div class="c-time-line-time">2017-11-25 15:22:05</div>
																			</div>
																		</li>
																		<li>
																			<div class="c-time-line-icon">
																				<div class="c-time-line-icon-default"></div>
																			</div>
																			<div class="c-time-line-detail" style="width: 400px;">
																				<p>广州市【广州黄埔东区站】，【何卫锋/13172031067】正在派件</p>
																				<div class="c-time-line-time">2017-11-25 10:41:36</div>
																			</div>
																		</li>
																		<li>
																			<div class="c-time-line-icon">
																				<div class="c-time-line-icon-default"></div>
																			</div>
																			<div class="c-time-line-detail" style="width: 400px;">
																				<p>到广州市【广州黄埔东区站】</p>
																				<div class="c-time-line-time">2017-11-25 08:42:54</div>
																			</div>
																		</li>
																		<li>
																			<div class="c-time-line-icon">
																				<div class="c-time-line-icon-default"></div>
																			</div>
																			<div class="c-time-line-detail" style="width: 400px;">
																				<p>广州市【广州黄埔转运中心】，正发往【广州黄埔东区站】</p>
																				<div class="c-time-line-time">2017-11-25 05:07:15</div>
																			</div>
																		</li>
																		<li>
																			<div class="c-time-line-icon">
																				<div class="c-time-line-icon-default"></div>
																			</div>
																			<div class="c-time-line-detail" style="width: 400px;">
																				<p>到广州市【广州黄埔转运中心】</p>
																				<div class="c-time-line-time">2017-11-25 04:33:01</div>
																			</div>
																		</li>
																		<li>
																			<div class="c-time-line-icon">
																				<div class="c-time-line-icon-default"></div>
																			</div>
																			<div class="c-time-line-detail" style="width: 400px;">
																				<p>东莞市【虎门转运中心】，正发往【广州黄埔转运中心】</p>
																				<div class="c-time-line-time">2017-11-25 02:19:17</div>
																			</div>
																		</li>
																		<li>
																			<div class="c-time-line-icon">
																				<div class="c-time-line-icon-default"></div>
																			</div>
																			<div class="c-time-line-detail" style="width: 400px;">
																				<p>到东莞市【虎门转运中心】</p>
																				<div class="c-time-line-time">2017-11-25 01:34:03</div>
																			</div>
																		</li>
																		<li>
																			<div class="c-time-line-icon">
																				<div class="c-time-line-icon-default"></div>
																			</div>
																			<div class="c-time-line-detail" style="width: 400px;">
																				<p>温州市【温州转运中心】，正发往【虎门转运中心】</p>
																				<div class="c-time-line-time">2017-11-24 00:08:23</div>
																			</div>
																		</li>
																		<li>
																			<div class="c-time-line-icon">
																				<div class="c-time-line-icon-default"></div>
																			</div>
																			<div class="c-time-line-detail" style="width: 400px;">
																				<p>到温州市【温州转运中心】</p>
																				<div class="c-time-line-time">2017-11-23 22:39:53</div>
																			</div>
																		</li>
																		<li>
																			<div class="c-time-line-icon">
																				<div class="c-time-line-icon-default"></div>
																			</div>
																			<div class="c-time-line-detail" style="width: 400px;">
																				<p>温州市【平阳二部】，【平阳二部/63162222】已揽收</p>
																				<div class="c-time-line-time">2017-11-23 19:18:59</div>
																			</div>
																		</li>
																		<li>
																			<div class="c-time-line-icon">
																				<div class="c-time-line-icon-default"></div>
																			</div>
																			<div class="c-time-line-detail" style="width: 400px;">
																				<p>卖家发货</p>
																				<div class="c-time-line-time">2017-11-23 14:17:57</div>
																			</div>
																		</li>
																	</ul>
																</span>
															</div>
														</div>
													</a>
												</div>
											</div>
											<div class="grid-cell" style="width: 103px;text-align: center">
												<div class="grid-cell-inner">百世快递</div>
											</div>
											<div class="grid-cell" style="width: 207px;text-align: center">
												<div class="grid-cell-inner">运单号:70117577373900<br>温州市-广州市</div>
											</div>
											<div class="grid-cell" style="width: 103px;text-align: center">
												<div class="grid-cell-inner">
													<a href="javascript:;" target="_blank">奋发图强98818
														<img border="0" src="//amos.im.alisoft.com/online.aw?v=2&amp;uid=奋发图强98818&amp;site=cntaobao&amp;s=2&amp;charset=utf-8">
													</a>
												</div>
											</div>
											<div class="grid-cell" style="width: 310px;text-align: center">
												<div class="grid-cell-inner">
													<p class="order-title">订单号:90836896858316230</p>
													<div class="order-detail hidden">
														<div class="order-detail-img">
															<a href="javascript:;" target="_blank">
																<img src="//gw.alicdn.com/bao/uploaded/i3/2683428516/TB2K.ljcXojyKJjy0FiXXbCrVXa_!!2683428516.jpg">
															</a>
														</div>
														<div class="order-detail-content">
															<p class="title">
																<a href="javascript:; target="_blank">蓓尔韩版亮片女帆布鞋松糕厚底懒人鞋女式休闲鞋白色乐福鞋</a>
															</p>
															<p class="price">55.00</p>
														</div>
													</div>
												</div>
											</div>
											<div class="grid-cell" style="width: 103px;text-align: center">
												<div class="grid-cell-inner">
													<a class="grid-cell-link" href="javascript:;" target="_blank">添加备注</a>
												</div>
											</div>
											<div class="grid-cell column-last" style="width: 105px;text-align: left">
												<div class="grid-cell-inner"></div>
											</div>
										</div>
									</div>
									<!-- <div class="no-data-message">
										<div class="ui-message-empty">
											<p class="ui-message-content">
												<span class="noromal">
													<i class="icon"></i>
												</span>
												<span>暂无数据<span>
											</p>
										</div>
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 包裹中心 end -->

	<!-- 异常包裹 start -->
	<div class="w-1040 rt switch-wrap logistics-container">
		<div class="package-center-wrap">
			<div class="cainiao">
				<!-- <input type="hidden" name=""> -->
				<div class="row row-flex b-body">
					<div class="col-flex b-page active"></div>
					<div class="sub-nav">
						<ul>
							<li class="curr">
								<span class="li-line"></span>
								<a href="javascript:;">派签超时
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</a>
							</li>
							<li>
								<span class="li-line"></span>
								<a href="javascript:;">揽收超时
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</a>
							</li>
							<li>
								<span class="li-line"></span>
								<a href="javascript:;">物流未更新
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</a>
							</li>
						</ul>
					</div>
					<!-- 搜索区-->
					<form class="form-horizontal row b-search-form b-region">
						<div class="row row-flex">
							<div class="col-flex">
								<div class="row">
									<div class="row cols-fixed">
										<!-- 日历选择框 -->
										<div class="input-group col-lg-6 control-group c-calendar-select-field">
											<label  class="control-label">发货时间</label>
											<div class="c-combox input-group c-calendar-select c-select">
												<input id="unusual_fh_time" type="text" name="" class="form-control readonly" readonly="readonly" placeholder="请选择发货日期区间">
											</div>
										</div>
										<!-- 单选下拉框 -->
										<!-- <div class="input-group col-lg-5 control-group c-calendar-select-field">
											<label class="control-label">发货城市</label>
											<div class="c-combox input-group c-select">
												<input type="text" name="" class="form-control readonly" readonly="readonly">
											</div>
										</div> -->
										<div class="input-group col-lg-5 control-group c-calendar-select-field">
											<label class="control-label">发货城市</label>
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select class="form-control">
														<option value="">全部</option>
														<option value="">北京</option>
														<option value="">河北省</option>
														<option value="">天津</option>
														<option value="">山西社</option>
														<option value="">呢诶蒙古</option>
														<option value="">辽宁省</option>
														<option value="">山西省</option>
													</select>
												</div>
											</div>
										</div>
										<!-- 单选下拉框 -->
										<div class="input-group col-lg-5 control-group c-calendar-select-field">
											<label class="control-label">到达省份</label>
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select class="form-control">
														<option value="">全部</option>
														<option value="">北京</option>
														<option value="">河北省</option>
														<option value="">天津</option>
														<option value="">山西社</option>
														<option value="">呢诶蒙古</option>
														<option value="">辽宁省</option>
														<option value="">山西省</option>
													</select>
												</div>
											</div>
										</div>
										<!-- 单选下拉框 -->
										<div class="input-group col-lg-5 control-group c-calendar-select-field">
											<label class="control-label">物流公司</label>
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select class="form-control">
														<option value="">全部</option>
														<option value="">北京</option>
														<option value="">河北省</option>
														<option value="">天津</option>
														<option value="">山西社</option>
														<option value="">呢诶蒙古</option>
														<option value="">辽宁省</option>
														<option value="">山西省</option>
													</select>
												</div>
											</div>
										</div>
										<!-- 输入框 -->
										<div class="input-group col-lg-6 control-group c-calendar-select-field">
											<label class="control-label">单号/旺旺</label>
											<div class="c-combox input-group c-select">
												<input type="text" name="" class="form-control" placeholder="运费号/订单号/买家旺旺">
											</div>
										</div>
										<!-- 单选下拉框 -->
										<div class="input-group col-lg-5 control-group c-calendar-select-field">
											<label class="control-label">处理状态</label>
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select class="form-control">
														<option value="">全部</option>
														<option value="">北京</option>
														<option value="">河北省</option>
														<option value="">天津</option>
														<option value="">山西社</option>
														<option value="">呢诶蒙古</option>
														<option value="">辽宁省</option>
														<option value="">山西省</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<button type="button" class="btn btn-minor b-searc-btn">筛选</button>
								<button type="button" class="btn b-searc-btn">清楚筛选</button>
							</div>
						</div>
					</form>
					<!-- 表格展示区 -->
					<div class="row b-region mt-10">
						<!-- 这里是表格组件的主体 -->
						<div class="c-grid-table" style="width:100%;height: auto;">
							<div class="grid-table-header-ct">
								<div class="grid-row grid-header">
									<div class="grid-row-inner">
										<div class="grid-cell column-first grid-cell-ellipsis" style="text-align: center;width:136px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">发货时间</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:68px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">派件时长</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:68px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">物流公司</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:136px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">运单信息</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:68px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">买家旺旺</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:204px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">订单信息
													<div class="cn-switch control-group c-switch-field">
														<label class="control-label"></label>
														<div class="c-switch c-switch-off">
															<div class="c-switch-btn"></div>
															<span class="c-switch-text">详细</span>
														</div>

													</div>
												</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: left;width:136px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">快递异常原因</span>
											</div>
										</div>
										<div class="grid-cell grid-cell-ellipsis" style="text-align: center;width:68px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">备注</span>
											</div>
										</div>
										<div class="grid-cell column-last grid-cell-ellipsis" style="text-align: left;width:137px;">
											<div class="grid-cell-inner">
												<span class="grid-header-text">操作</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="grid-table-rows-ct" style="height: auto;">
								<div class="grid-table-rows-ct-inner">
									<div class="no-data-message">
										<div class="ui-message-empty">
											<p class="ui-message-content">
												<span class="noromal">
													<i class="icon"></i>
												</span>
												<span>暂无数据<span>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 异常包裹 end -->

	<!-- 买家投诉  start -->
	<div class="w-1040 rt switch-wrap logistics-container">
		<div class="buyer-complaints-wrap last-wrap">
			<div class="cainiao">
				<div class="content">
					<div class="wrap-title backff">
						<span class="lf">买件投诉包裹
							<span class="tips-wrap">
								<i class="icon icon-tips"></i>
								<div class="tips-guide-wrap">
									指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
								</div>
							</span>
						</span>
					</div>
					<form class="wl-smart">
						<div class="content-list">
							<div class="search">
								<div class="row">
									<!-- 联合日历 -->
									<div class="control-group span10">
										<label class="control-label">签收时间</label>
										<div class="controls bui-form-group bui-form-field-container bui-form-tip-container">
											<input type="text" name="" class="calendar  bui-form-field-date bui-form-field qs_start_time">
											<label class="form-zhi">至</label>
											<input type="text" name="" class="calendar bui-form-field-date bui-form-field qs_end_time">
										</div>
									</div>
									<!-- 下拉选择 -->
									<div class="control-group span5">
										<label class="control-label">到货市</label>
										<div class="controls rankSelect">
											<div class="rankSelectBox">
												<select>
													<option value="">全部</option>
													<option value="">北京</option>
													<option value="">河北省</option>
													<option value="">天津</option>
													<option value="">山西社</option>
													<option value="">呢诶蒙古</option>
													<option value="">辽宁省</option>
													<option value="">山西省</option>
												</select>
											</div>
										</div>
									</div>
									<!-- 下拉选择 -->
									<div class="control-group span5">
										<label class="control-label">到货市</label>
										<div class="controls rankSelect">
											<div class="rankSelectBox">
												<select>
													<option value="">全部</option>
													<option value="">北京</option>
													<option value="">河北省</option>
													<option value="">天津</option>
													<option value="">山西社</option>
													<option value="">呢诶蒙古</option>
													<option value="">辽宁省</option>
													<option value="">山西省</option>
												</select>
											</div>
										</div>
									</div>
									<!-- 文本框 -->
									<div class="control-group span5">
										<label class="control-label">订单号/运单号/买家旺旺查询:</label>
										<div class="controls">
											<input type="text" name="" class="input-normal control-text">
										</div>
									</div>
								</div>
								<div class="form-actions span3">
									<button type="" class="button button-primary submit-btn">
										<span class="search-font"></span>
										查询
									</button>
								</div>
								<div class="chart-toggle">
									<span class="icon2016-fenxizhenduan chart-icon">
									</span>
									<span class="chart-tip">图表</span>
								</div>
							</div>
						</div>
						<div class="content-list chart chart-hidden" style="background-color: #fff;">
							<div class="content-head">
								<span class="content-head-text">虚假签收重点关注</span>
								<span class="content-head-sub"></span>
							</div>
							<div class="content-content backage-monitor-wrap clearfix">
								<div class="tab-btns current">
									<a href="javascript:;" class="tab-btn current">
										<div class="backage-monitor-item-box">
											<h4 class="backage-monitor-item-title">
												未完结投诉包裹量
											</h4>
											<div class="backage-monitor-item-num">
												<span>0</span>
											</div>
											<div></div>
										</div>
									</a>
								</div>
								<div class="tab-btns">
									<a href="javascript:;" class="tab-btn current">
										<div class="backage-monitor-item-box">
											<h4 class="backage-monitor-item-title">
												投诉率
											</h4>
											<div class="backage-monitor-item-num">
												<span>0%</span>
											</div>
											<div></div>
										</div>
									</a>
								</div>
								<div class="tab-btns">
									<a href="javascript:;" class="tab-btn current">
										<div class="backage-monitor-item-box">
											<h4 class="backage-monitor-item-title">
												3天投诉完结率
											</h4>
											<div class="backage-monitor-item-num">
												<span>0%</span>
											</div>
											<div></div>
										</div>
									</a>
								</div>
								<div class="tab-btns">
									<a href="javascript:;" class="tab-btn current">
										<div class="backage-monitor-item-box">
											<h4 class="backage-monitor-item-title">
												二次投诉率
											</h4>
											<div class="backage-monitor-item-num">
												<span>0%</span>
											</div>
											<div></div>
										</div>
									</a>
								</div>
							</div>
							<div class="content-contnet">
								<div class="content-in-body">
									<div class="content-title">
										<span>物流公司分布</span>
									</div>
									<div id="content-chart" class="content-chart" style="width: 977px;height: 400px;"></div>
								</div>
							</div>
						</div>
						<div class="content-list">
							<div class="content-head">
								<span class="content-head-text-icon iconfont icon-dangrida">
								</span>
								<span class="content-head-text">虚假签收订单详情</span>
							</div>
							<div class="content-content">
								<table class="table">
									<thead>
										<tr>
											<th style="width: 20px;"></th>
											<th style="width: 30%;">
												<div class="th-div">
													<p>
														<span>订单详情</span>
													</p>
												</div>
											</th>
											<th style="width: 9%;">
												<div class="th-div">
													<p>
														<span>运单号</span>
													</p>
												</div>
											</th>
											<th style="width: 8%;">
												<div class="th-div">
													<p>
														<span>发货城市</span>
													</p>
												</div>
											</th>
											<th style="width: 8%;">
												<div class="th-div">
													<p>
														<span>收货城市</span>
													</p>
												</div>
											</th>
											<th class="sortableTh orderable" style="width: 14%;">
												<div class="th-div">
													<p>
														<span>投诉内容/时间</span>
														<span class="order-flag desc">
															<i class="icon icon-order"></i>
														</span>
													</p>
												</div>
											</th>
											<th class="sortableTh orderable" style="width: 19%;">
												<div class="th-div">
													<p>
														<span>投诉处理状态/时间</span>
														<span class="order-flag">
															<i class="icon icon-order"></i>
														</span>
													</p>
												</div>
											</th>
											<th style="width: 12%;">
												<div class="th-div">
													<p>
														<span>快递异常原因</span>
													</p>
												</div>
											</th>
											<th style="width: 20px;"></th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
								<div class="no-data-message">
									<div class="ui-message-empty">
										<p class="ui-message-content">
											<span class="noromal">
												<i class="icon"></i>
											</span>
											<span>暂无数据<span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- 买家投诉  end -->

	<!-- 退货包裹  start -->
	<div class="w-1040 rt switch-wrap logistics-container">
		<div class="return-parcel-wrap last-wrap">
			<div class="cainiao">
				<div class="content">
					<div class="wrap-title backff">
						<span class="lf">退货包裹</span>
					</div>
					<form class="wl-smart">
						<div class="content-list">
							<div class="row-fluid">
								<div class="span21 search search-span">
									<div class="row-fluid">
										<!-- 下拉选择 -->
										<div class="control-group span5">
											<label class="control-label">发货省</label>
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select>
														<option value="">请选择省市</option>
														<option value="">北京</option>
														<option value="">河北省</option>
														<option value="">天津</option>
														<option value="">山西社</option>
														<option value="">呢诶蒙古</option>
														<option value="">辽宁省</option>
														<option value="">山西省</option>
													</select>
												</div>
											</div>
										</div>
										<!-- 下拉选择 -->
										<div class="control-group span5">
											<label class="control-label">发货市</label>
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select>
														<option value="">请选择城市</option>
														<option value="">北京</option>
														<option value="">河北省</option>
														<option value="">天津</option>
														<option value="">山西社</option>
														<option value="">呢诶蒙古</option>
														<option value="">辽宁省</option>
														<option value="">山西省</option>
													</select>
												</div>
											</div>
										</div>
										<!-- 下拉选择 -->
										<div class="control-group span5">
											<label class="control-label">到货市</label>
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select>
														<option value="">全部</option>
														<option value="">北京</option>
														<option value="">河北省</option>
														<option value="">天津</option>
														<option value="">山西社</option>
														<option value="">呢诶蒙古</option>
														<option value="">辽宁省</option>
														<option value="">山西省</option>
													</select>
												</div>
											</div>
										</div>
										<!-- 文本框 -->
										<div class="control-group span5">
											<label class="control-label">订单号/运单号/买家旺旺查询:</label>
											<div class="controls">
												<input type="text" name="" class="input-normal control-text">
											</div>
										</div>
										<div class="form-actions span3">
											<button type="" class="button button-primary submit-btn">
												<span class="search-font"></span>
												查询
											</button>
										</div>
									</div>
									<div class="row-fluid">
										<!-- 下拉选择 -->
										<div class="control-group span5">
											<label class="control-label">快递公司</label>
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select>
														<option value="">全部</option>
														<option value="">北京</option>
														<option value="">河北省</option>
														<option value="">天津</option>
														<option value="">山西社</option>
														<option value="">呢诶蒙古</option>
														<option value="">辽宁省</option>
														<option value="">山西省</option>
													</select>
												</div>
											</div>
										</div>
										<!-- 下拉选择 -->
										<div class="control-group span5">
											<label class="control-label">包裹状态</label>
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select>
														<option value="">全部</option>
														<option value="">北京</option>
														<option value="">河北省</option>
														<option value="">天津</option>
														<option value="">山西社</option>
														<option value="">呢诶蒙古</option>
														<option value="">辽宁省</option>
														<option value="">山西省</option>
													</select>
												</div>
											</div>
										</div>
										<!-- 联合日历 -->
										<div class="control-group span10">
											<label class="control-label">退货时间</label
											>
											<div class="controls bui-form-group">
												<input type="text" name="" class="calendar returnPassage_start_time">
												<label class="form-zhi">至</label>
												<input type="text" name="" class="calendar returnPassage_end_time">
											</div>
										</div>
									</div>
								</div>
								<div class="chart-toggle">
									<span class="icon2016-fenxizhenduan chart-icon">
									</span>
									<span class="chart-tip">图表</span>
								</div>
							</div>
						</div>
						<div class="content-list chart chart-hidden" style="background-color: #fff;">
							<!-- <div class="content-head">
								<span class="content-head-text">虚假签收重点关注</span>
								<span class="content-head-sub"></span>
							</div> -->
							<div class="content-content backage-monitor-wrap clearfix">
								<div class="tab-btns current">
									<a href="javascript:;" class="tab-btn current">
										<div class="backage-monitor-item-box">
											<h4 class="backage-monitor-item-title">
												退货未处理包裹数
											</h4>
											<div class="backage-monitor-item-num">
												<span>0</span>
											</div>
											<div>
												<span class="backage-monitor-item-desc">占退货未处理包裹比例：</span>
												<span class="backage-monitor-item-percent">0%</span>
											</div>
										</div>
									</a>
								</div>
								<div class="tab-btns">
									<a href="javascript:;" class="tab-btn current">
										<div class="backage-monitor-item-box">
											<h4 class="backage-monitor-item-title">
												退货在途包裹数
											</h4>
											<div class="backage-monitor-item-num">
												<span>0%</span>
											</div>
											<div>
												<span class="backage-monitor-item-desc">占退货未处理包裹比例：</span>
												<span class="backage-monitor-item-percent">0%</span>
											</div>
										</div>
									</a>
								</div>
								<div class="tab-btns">
									<a href="javascript:;" class="tab-btn current">
										<div class="backage-monitor-item-box">
											<h4 class="backage-monitor-item-title">
												退货超7天未妥投包裹数
											</h4>
											<div class="backage-monitor-item-num">
												<span>0%</span>
											</div>
											<div>
												<span class="backage-monitor-item-desc">占退货未处理包裹比例：</span>
												<span class="backage-monitor-item-percent">0%</span>
											</div>
										</div>
									</a>
								</div>
								<div class="tab-btns">
									<a href="javascript:;" class="tab-btn current">
										<div class="backage-monitor-item-box">
											<h4 class="backage-monitor-item-title">
												退货3天无揽收信息包裹数
											</h4>
											<div class="backage-monitor-item-num">
												<span>0%</span>
											</div>
											<div>
												<span class="backage-monitor-item-desc">占退货未处理包裹比例：</span>
												<span class="backage-monitor-item-percent">0%</span>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="content-contnet">
								<div class="content-in-body">
									<div class="content-title">
										<span>物流公司分布</span>
									</div>
									<div id="content2-chart" class="content-chart" style="width: 977px;height: 400px;"></div>
								</div>
							</div>
						</div>
						<div class="content-list">
							<div class="content-content">
								<div style="padding: 10px 40px;">
									<input type="checkbox" name=""><span style="padding: 0 10px;" class="checkbox-text">全选</span>
									<a href="javascript:;" class="button">批量线下通知买家</a>
									<span>
										<div class="bui-select" style="width: 123px;">
											<!-- <div class="input-group col-lg-5 control-group c-calendar-select-field">
											<label class="control-label">发货城市</label> -->
											<div class="controls rankSelect">
												<div class="rankSelectBox">
													<select class="form-control">
														<option value="">未处理</option>
														<option value="">线下通知</option>
													</select>
												</div>
											<!-- </div>
										</div> -->
										</div>
									</span>
								</div>
								<table class="table">
									<thead>
										<tr>
											<th style="width: 20px;"></th>
											<th style="width: 30%;">
												<div class="th-div">
													<p>
														<span>订单详情</span>
													</p>
												</div>
											</th>
											<th style="width: 10%;">
												<div class="th-div">
													<p>
														<span>运单号</span>
													</p>
												</div>
											</th>
											<th style="width: 8%;">
												<div class="th-div">
													<p>
														<span>发货城市</span>
													</p>
												</div>
											</th>
											<th style="width: 8%;">
												<div class="th-div">
													<p>
														<span>收货城市</span>
													</p>
												</div>
											</th>
											<th class="sortableTh orderable" style="width: 11%;">
												<div class="th-div">
													<p>
														<span>运输天数</span>
														<span class="order-flag desc">
															<i class="icon icon-order"></i>
														</span>
													</p>
												</div>
											</th>
											<th class="sortableTh orderable" style="width: 15%;">
												<div class="th-div">
													<p>
														<span>退货已经过时间</span>
														<span class="order-flag">
															<i class="icon icon-order"></i>
														</span>
													</p>
												</div>
											</th>
											<th style="width: 12%;">
												<div class="th-div">
													<p>
														<span>操作</span>
													</p>
												</div>
											</th>
											<th style="width: 20px;"></th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
								<div class="no-data-message">
									<div class="ui-message-empty">
										<p class="ui-message-content">
											<span class="noromal">
												<i class="icon"></i>
											</span>
											<span>暂无数据<span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- 退货包裹  end -->
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/dateRange/dateRange.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts-all.js"></script>
<script type="text/javascript">
   	var logisticsTrendChart = echarts.init(document.getElementById('logistics-trend-chart'));
		// 指定图表的配置项和数据
 		var colors = ['#2062e6','#f3d024','#ff8533','#4cb5ff'];
      var option = {
        	tooltip: {
	        trigger: 'axis',
	        backgroundColor: '#fff',
	        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
	        borderColor: '#ddd',
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
	        		color: '#eee'
	        	},
	        	shadowStyle : {                       // 阴影指示器样式设置
	                width: 'auto',                   // 阴影大小
	                color: 'rgba(150,150,150,0.3)'  // 阴影颜色
	            }
	        }
	    },
	    legend: {     // 图例
          	orent: 'vertical',
          	x: 'left',
              data: [
              	{
              		name: '退款率',
              	},
              	{
              		name: '纠纷退款率'
              	},
              	{
              		name: '投诉率'
              	},
              	{
              		name: '品质退款率'
              	}

              ]
          },
           grid: {
	        y2: '7%',
	        x: '0',
	        y: '15%',
	        x2: '0'
	        // width: '100%',
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
                name: '退款率',
                type: 'line',
                symbol: 'circle',  // 折点处空心圆
                showSymbol: false,
                symbolSize: 5,
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
                name: '纠纷退款率',
                type: 'line',
                symbol: 'circle',  // 折点处空心圆
                showSymbol: false,
                symbolSize: 5,
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
            {
                name: '投诉率',
                type: 'line',
                symbol: 'circle',  // 折点处空心圆
                showSymbol: false,
                symbolSize: 5,
                smooth: true,  // 平滑折线
                itemStyle: {
                	normal: {
                		color: colors[2],
                		lineStyle: {
                			color: colors[2]
                		}
                	}
                },
                data:  [8, 0, 0, 0, 4, 0, 1]
            },
            {
                name: '品质退款率',
                type: 'line',
                symbol: 'circle',  // 折点处空心圆
                showSymbol: false,
                symbolSize: 5,
                smooth: true,  // 平滑折线
                itemStyle: {
                	normal: {
                		color: colors[3],
                		lineStyle: {
                			color: colors[3]
                		}
                	}
                },
                data:  [8, 0, 0, 0, 4, 0, 1]
            },
          ]
      };
      // 使用刚指定的配置项和数据显示图表。
      logisticsTrendChart.setOption(option);

  	var myChart = echarts.init(document.getElementById('content-chart')); 
      var option = {
          tooltip: {
              show: true
          },
          legend: {
              data:['销量']
          },
          xAxis : [
              {
                  type : 'category',
                  data : ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
              }
          ],
          yAxis : [
              {
                  type : 'value'
              }
          ],
          series : [
              {
                  "name":"销量",
                  "type":"bar",
                  "data":[]
              }
          ]
      };

      // 为echarts对象加载数据 
      myChart.setOption(option); 

  	var myChart = echarts.init(document.getElementById('content2-chart')); 
      var option = {
          tooltip: {
              show: true
          },
          legend: {
              data:['销量']
          },
          xAxis : [
              {
                  type : 'category',
                  data : ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
              }
          ],
          yAxis : [
              {
                  type : 'value'
              }
          ],
          series : [
              {
                  "name":"销量",
                  "type":"bar",
                  "data":[]
              }
          ]
      };

      // 为echarts对象加载数据 
      myChart.setOption(option); 

  	var logisticsUnusualScoreChart = echarts.init(document.getElementById('logisticsUnusual-score-chart'));
		// 指定图表的配置项和数据
		var colors = ['blue','green','#fac833','#f78433',];
	    var option = {
	    	tooltip: {
		        trigger: 'axis',
		        backgroundColor: '#fff',
		        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
		        borderColor: '#ddd',
		        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
		        padding: 10,
		        textStyle: {
		            color: '#999',
		            fontSize: 12
		        },
		        formatter: function(params) {
		        	var str = '';
		        	str = '<div style="color: #bbb;margin-bottom:9px;">'+params[0][1]+'</div><span style="width:90px;display:inline-block">'+params[0][0]+'</span><span>'+params[0].data+'</span>'
		        	return str
	      	
		        },
		        axisPointer: {
		        	type: 'line',  // cross时为十字虚线 也可以为shadow
		        	lineStyle: {
		        		color: '#eee'
		        	},
		        	shadowStyle : {                       // 阴影指示器样式设置
		                width: 'auto',                   // 阴影大小
		                color: 'rgba(150,150,150,0.3)'  // 阴影颜色
		            }
		        }
			    },
			    xAxis: {
			    		splitLine:{ show:false},  //改设置不显示坐标区域内的y轴分割线
			    		axisLabel: { show: false },
			    		axisLine: { show: false },
			    		axisTick: { show: false },
			        data: ["派签超2日签收","虚假签收投诉","揽签超7日","支付后超72小时揽收"]  
			    },
			    yAxis: {
			        splitLine:{ 
			        	show:true, 
			        	lineStyle: {
			        		color: '#eee'
			        	}
			        },  //改设置不显示坐标区域内的y轴分割线
			        axisLine: { show: false },
			        axisLabel: { show: false }
			    },
			    series: [{
			            name: '异常包裹数',
			            type: 'bar',
			            data: [0, 0, 4, 1],
			            //设置柱子的宽度
			            barWidth : 30,
			            //配置样式
			            itemStyle: {   
		                normal:{  
		　　　　　　　　　　　　//每个柱子的颜色即为colorList数组里的每一项，如果柱子数目多于colorList的长度，则柱子颜色循环使用该数组
		                    color: function (params){
		                        var colorList = [colors[0],colors[1],colors[2],colors[3]];
		                        return colorList[params.dataIndex];
		                    }
		                },
		                //鼠标悬停时：
		                emphasis: {
		                        shadowBlur: 10,
		                        shadowOffsetX: 0,
		                        shadowColor: 'rgba(0, 0, 0, 0.5)'
		                }
			            },
			      }],
			　　　　　//控制边距　
			        grid: {
			                left: '0%',
			                right:'10%',
			                containLabel: true,
			        },
			    };        
			    // 使用刚指定的配置项和数据显示图表。
			    logisticsUnusualScoreChart.setOption(option);
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
		      	$(elem).parents(".date-wrap").siblings(".option").find("span").html('日&nbsp;(' + value + ' ~ ' + value+')');
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
			      	$(elem).parents(".date-wrap").siblings(".option").find("span").html('周&nbsp;(' + value +')');
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
	      	$(elem).parents(".date-wrap").siblings(".option").find("span").html('月&nbsp;('+ year+'-'+month+'-01 ~ '+year+'-'+month+'-'+end+')');
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
	// 点击 导航左侧
	$(".switch-wrap").eq(0).show();
	$(".nav .menu-list .menu-item-inner").click(function(){
		var _this = $(this);
		var parentIndex = _this.parents(".menu-list-inner").parents(".menu-item").index();
		var lengthLi = 0;
		for(var i=0;i<parentIndex;i++){
			lengthLi += $(".menu-item").eq(i).children(".menu-list-inner").children(".menu-item-inner").length;
		}
		var index = _this.index();
		_this.addClass("curr").siblings(".curr").removeClass("curr");
		_this.parents(".menu-list-inner").parents(".menu-item").siblings(".menu-item").children(".menu-list-inner").children(".menu-item-inner").removeClass("curr");
		$(".switch-wrap").hide();
		$(".switch-wrap").eq(index + lengthLi).show();
	})
	
	// 包裹中心
		// 移入查看详情
		$(".c-grid-table .grid-table-rows-ct .grid-row .grid-row-inner .grid-cell-link.J-viewLogistics0").mouseenter(function() {
			$(this).children(".c-tooltip.tooltip.bottom").show();
		}).mouseleave(function() {
			$(this).children(".c-tooltip.tooltip.bottom").hide();
		})
	
	// 异常包裹  
	$(".sub-nav  li").click(function(){
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
	})
	$(".cn-switch").on("click",function() {
		var _this = $(this);
		if(_this.children("div").hasClass("c-switch-off")){
			_this.children(".c-switch-off").removeClass("c-switch-off").addClass("c-switch-on");
			_this.children(".c-switch").children(".c-switch-text").text("简洁");
		}else{
			_this.children(".c-switch-on").removeClass("c-switch-on").addClass("c-switch-off");
			_this.children(".c-switch").children(".c-switch-text").text("详细");
		}
	})
	// echarts 无数据背景图 上的选项卡
	$(".content-content .tab-btns").click(function(){
		$(this).addClass("current").siblings(".current").removeClass("current");
	})

	// 点击图标 展示气泡背景图
	$(".last-wrap .chart-toggle").click(function(){
		$(this).parents("div").parents(".content-list").siblings(".chart").toggle();
	})


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

	var classStr = '';
	// 下拉框 .....start
	$(document).click(function(e) {
		$(".select-control .select-control-list").hide();
	});
	$(".select-control-list").click(function(e) {
		e.stopPropagation();
	})
	$(".select-control").click(function(e) {
		e.stopPropagation();
		var _this = $(this);
		classStr = _this.parents(".common-picker-wrap").prop("className");
		classStr = classStr.slice(0, -19).split("-").join("");

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
			$(this).children(".select-control-list").show();
			$(".common-picker-wrap").each(function() {
				var commonPickerWrap = _this;
				commonPickerWrap.find(".legacy-oui-typeahead-input").focus();
			})
		}
	});
	// 下拉框 .....end



	/* <li class="tree-item common-item active">全国</li>
		<li class="tree-item common-item">河北</li>
		<li class="tree-item common-item">河南</li>
		<li class="tree-item common-item">山东</li>
		<li class="tree-item common-item">内蒙古</li>
		<li class="tree-item common-item">呼和浩塔尔</li>
		<li class="tree-item common-item">湖南</li>
		<li class="tree-item common-item">南京</li> */

	// 收货地  start  文档碎片
	var receiveaddrpicker = ['全国', '北京', '天津', '河北省', '山东省', '河南省', '内蒙古', '呼和浩特', '湖南', '湖南省', '南京', '温州'];
	var fragment = document.createDocumentFragment();
	for (var i = 0; i < receiveaddrpicker.length; i ++) {
		var html = '';
		html += '<li class="tree-item common-item">'+receiveaddrpicker[i]+'</li>';
		$(fragment).append(html)
	}
	$(".receive-addr-picker ul").append(fragment);
	// 发货地 start  文档碎片
	var sendaddrpicker = ['全部', '温州'];
	var fragment = document.createDocumentFragment();
	for (var i = 0; i < sendaddrpicker.length; i ++) {
		var html = '';
		html += '<li class="tree-item common-item">'+sendaddrpicker[i]+'</li>';
		$(fragment).append(html)
	}
	$(".send-addr-picker ul").append(fragment);
	// 物流公司 start  文档碎片
	var companiespicker = ['全部'];
	var fragment = document.createDocumentFragment();
	for (var i = 0; i < companiespicker.length; i ++) {
		var html = '';
		html += '<li class="tree-item common-item">'+companiespicker[i]+'</li>';
		$(fragment).append(html)
	}
	$(".companies-picker ul").append(fragment);
	// 物流异常原因 start  文档碎片
	var reasonpicker = ['全部', '超72小时揽收', '揽签超7日', '派签超2日', '虚假签收'];
	var fragment = document.createDocumentFragment();
	for (var i = 0; i < reasonpicker.length; i ++) {
		var html = '';
		html += '<li class="tree-item common-item">'+reasonpicker[i]+'</li>';
		$(fragment).append(html)
	}
	$(".reason-picker ul").append(fragment);


	var arrayParent = [receiveaddrpicker, sendaddrpicker, companiespicker, reasonpicker]
	$(".common-picker-wrap").each(function() {
		var commonPickerWrap = $(this);
		commonPickerWrap.find("li").eq(0).addClass("active");
	})
	// 物流--下拉 里面的搜索
	$(".select-control.common-picker .common-picker-menu .tree-search-wrapper .legacy-oui-typeahead-input").keyup(function(event) {
		var event = event || window.event;
		if (event.keyCode !== 38 && event.keyCode !==40) {
			var arrayParentIndex;
			var legacyOuiTypeaheadInput = $(this);
			var input = legacyOuiTypeaheadInput.parents(".tree-search-wrapper");
			var text = legacyOuiTypeaheadInput.val();
			var htmlFormat = '<span style="color:#ff6767">'+text+'</span>';

			switch (classStr) {
				case 'receiveaddrpicker':
				  arrayParentIndex = 0
				  break;
				case 'sendaddrpicker':
				  arrayParentIndex = 1
				  break;
				case 'companiespicker':
				  arrayParentIndex = 2
				  break;
				case 'reasonpicker':
				  arrayParentIndex = 3
				  break;
				default:
				 throw new Error ("找不到classStr!");
			}

			if (input.siblings(".trees-menu").find("li").text().indexOf(text) !== -1) {
				input.siblings(".trees-menu").show();
				if(input.find(".legacy-oui-typeahead-input").val() === '') {
					$(arrayParent[arrayParentIndex]).each(function(i, item) {
						html = '';
						html += '<li class="tree-item common-item">'+arrayParent[arrayParentIndex][i]+'</li>';
						$(fragment).append(html)
					})
					input.siblings(".trees-menu").find(".tree-menu li").remove();
					input.siblings(".trees-menu").find(".tree-menu").append(fragment);
				} else {
					for (var i = 0; i < arrayParent[arrayParentIndex].length; i ++) {
						if(arrayParent[arrayParentIndex][i].indexOf(text) !== -1) {
							var colorText = '';
							colorText = arrayParent[arrayParentIndex][i].replace(text, htmlFormat);
							var html = '';
							html += '<li class="tree-item common-item">'+colorText+'</li>';
							$(fragment).append(html)
						}
					}
					input.siblings(".trees-menu").find(".tree-menu li").remove();
					input.siblings(".trees-menu").find(".tree-menu").append(fragment);
				}
			} else {
				input.siblings(".trees-menu").hide();
			}
		}
	})
	clickLi();
	// 点击 下拉中的每一项
	function clickLi () {
		$(".select-control.common-picker .common-picker-menu .trees-menu").click(function(event) {
			var event = event || window.event;
			var target = event.target || event.srcElement;
			if (target.nodeName.toLowerCase() === 'li') {
				$(target).addClass("blueBK").siblings(".blueBK").removeClass("blueBK");
				$(target).addClass("active").siblings(".active").removeClass("active");
				$(target).parents(".common-picker-menu").siblings(".common-picker-header").find(".short-name").text($(target).text());
				$(target).parents(".common-picker-menu").hide();
			}
		})
	}
	$(".select-control.common-picker .common-picker-menu .trees-menu").on("mouseenter", '.tree-item', function() {
		$(this).addClass("blueBK").siblings(".blueBK").removeClass("blueBK");	
	})
	// 上下键
	var keyCodeEvents = function () {
		$(".common-picker-menu.select-control-list .tree-search-wrapper .legacy-oui-typeahead-input").keydown(function(event) {
			var event = event || window.event;
			var _this = $(this);
			var li = $(this).parents(".tree-search-wrapper").siblings(".trees-menu").find(".tree-item");
			var index = _this.parents(".tree-search-wrapper").siblings(".trees-menu").find(".blueBK").index();
			if(event.keyCode === 38) {  // 上
				if(index > 0) {
					index -= 1;
				}
				li.eq(index).addClass("blueBK").siblings(".blueBK").removeClass("blueBK");
			}
			if(event.keyCode === 40) {  // 下
				if(index < li.length - 1 ) {
					index += 1;
				}
				li.eq(index).addClass("blueBK").siblings(".blueBK").removeClass("blueBK");
			}
			if(event.keyCode === 13) { // 回车
				_this.parents(".common-picker-menu").siblings(".common-picker-header").find(".short-name").text(li.eq(index).text());
				_this.parents(".common-picker-menu").hide();
				_this.parents(".tree-search-wrapper").siblings(".trees-menu").find(".blueBK").addClass("active").siblings(".active").removeClass("active");
			}
		})
	}
	keyCodeEvents();


// 包裹中心 -- 时间范围选择
	var dateRange1 = new pickerDateRange('f_h_time', {
        isTodayValid : true,
        startDate : '2017-10-20',
        endDate : '2017-12-20',
        needCompare : false,
        defaultText : ' 至 ',
        autoSubmit : true,
        // inputTrigger : 'input_trigger1',
        theme : 'ta',
        /*success : function(obj) {
            $('.right_content').html('<div class="loading"></div>');
            var start_time = new Date(obj.startDate+' 00:00:00');
            var end_time = new Date(obj.endDate+' 00:00:00');
            var time_diff = start_time.getTime()-end_time.getTime();
            if(time_diff > 0){
                var startDate = obj.startDate;
                var endDate = obj.startDate;
            }else{
                time_diff = time_diff*(-1);
                var startDate = obj.startDate;
                var endDate = obj.endDate;
            }
            var days = Math.floor(time_diff/(24*3600*1000));
            if(days > 30){
                alert('时间范围不能超过31天');
                window.location.reload();
            }else{
                var url = "<?=YLB_Registry::get('base_url').'/index.php?ctl=Seller_Analysis_General&met=index&typ=e&sdate='?>"+startDate+"&edate="+endDate;
                window.location.href = url;
            }

        }*/
    });
	 // 异常包裹 -- 时间范围选择
	var dateRange1 = new pickerDateRange('unusual_fh_time', {
        isTodayValid : true,
        startDate : '2017-10-20',
        endDate : '2017-12-20',
        needCompare : false,
        defaultText : ' 至 ',
        autoSubmit : true,
        theme : 'ta',
    });
	// 买家投诉 -- 联合日历
	laydate.render({
	  elem: '.qs_start_time',
	  showBottom: false
	});
	laydate.render({
	  elem: '.qs_end_time',
	  showBottom: false
	});
	// 退货包裹 -- 联合日历
	laydate.render({
	  elem: '.returnPassage_start_time',
	  showBottom: false
	});
	laydate.render({
	  elem: '.returnPassage_end_time',
	  showBottom: false
	});
</script>
</html>
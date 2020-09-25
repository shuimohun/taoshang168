<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--服务-->
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
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=transaction">
					交易
				</a>
			</li>
			<li class="nav-item lf curr">
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
<div class="main-wrap w-1310 mt-10">
	<div class="nav lf w-160">
		<div class="left-nav">
			<div class="topLogo">
				<div class="topLogoContent">
					<i class="icon"></i>
					<p>服务质量</p>
				</div>
			</div>
			<ul class="menu-list-inner">
				<li class="menu-item-inner lf curr">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">维权概况</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">维权分析</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">评价概况</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">评价分析</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- 维权概况 start -->
	<div class="w-1140 rt switch-wrap service-container">
		<div class="protection-overview-wrap">
			<div class="screen-header h-50">
				<div class="update-option">
					<a href="javascript: void(0);" class="ebase-DayPicker__btn lf"><i class="oui-icon oui-icon-angle-left"><</i> 前一天</a>
					<span class="ebase-DayPicker__calendar lf"><div class="legacy-oui-calendar-trigger oui-popup-trigger"><i class="oui-icon oui-icon-calendar"></i><input type="text" class="" value="2017-11-15" readonly=""></div></span>
					<a href="javascript: void(0);" class="ebase-DayPicker__btn lf" disabled="">后一天<i class="oui-icon oui-icon-angle-right">></i></a>
				</div>
			</div>
			<!-- 维权总览 start -->
			<div class="product-outlook-wrap mt-10">
				<div class="wrap-title">
					<div class="title-lf lf">维权总览（近30天）</div>
				</div>
				<div class="ebase-card-content">
					<div class="indexCell-root lf" style="width: 25%;">
						<div class="index-name">退款时长</div>
						<div class="index-value">0.00</div>
						<div class="index-change orflow">
							<span class="lf">较前日</span>
							<span class="rt">
								<span class="num">-</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>	
						<div class="index-change orflow">
							<span class="lf">同行均值</span>
							<span class="rt">
								<span class="num">2.06%</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
								<span class="nd down">
									<i class="icon"></i>
								</span>
							</span>
						</div>
					</div>
					<div class="indexCell-root lf" style="width: 25%;">
						<div class="index-name">退款时长</div>
						<div class="index-value">0.00</div>
						<div class="index-change orflow">
							<span class="lf">较前日</span>
							<span class="rt">
								<span class="num">-</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
								<span class="nd down">
									<i class="icon"></i>
								</span>
							</span>
						</div>	
						<div class="index-change orflow">
							<span class="lf">同行均值</span>
							<span class="rt">
								<span class="num">2.06%</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
								<span class="nd down">
									<i class="icon"></i>
								</span>
							</span>
						</div>
					</div>
					<div class="indexCell-root lf" style="width: 25%;">
						<div class="index-name">退款时长</div>
						<div class="index-value">0.00</div>
						<div class="index-change orflow">
							<span class="lf">较前日</span>
							<span class="rt">
								<span class="num">-</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
								<span class="nd down">
									<i class="icon"></i>
								</span>
							</span>
						</div>	
						<div class="index-change orflow">
							<span class="lf">同行均值</span>
							<span class="rt">
								<span class="num">2.06%</span>
								<span class="r-trend">
									<i class="icon"></i>
								</span>
							</span>
						</div>
					</div>
					<div class="indexCell-root lf" style="width: 25%;">
						<div class="index-name">退款时长</div>
						<div class="index-value">0.00</div>
						<div class="index-change orflow">
							<span class="lf">较前日</span>
							<span class="rt">
								<span class="num">-</span>
								<span class="r-trend">
									<i class="icon"></i>
								</span>
							</span>
						</div>	
						<div class="index-change orflow">
							<span class="lf">同行均值</span>
							<span class="rt">
								<span class="num">2.06%</span>
								<span class="r-trend">
									<i class="icon"></i>
								</span>
							</span>
						</div>
					</div>
					<div class="indexCell-root lf" style="width: 25%;">
						<div class="index-name">退款时长</div>
						<div class="index-value">0.00</div>
						<div class="index-change orflow">
							<span class="lf">较前日</span>
							<span class="rt">
								<span class="num">-</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>	
						<div class="index-change orflow">
							<span class="lf">同行均值</span>
							<span class="rt">
								<span class="num">2.06%</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>
					</div>
					<div class="indexCell-root lf" style="width: 25%;">
						<div class="index-name">退款时长</div>
						<div class="index-value">0.00</div>
						<div class="index-change orflow">
							<span class="lf">较前日</span>
							<span class="rt">
								<span class="num">-</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>	
						<div class="index-change orflow">
							<span class="lf">同行均值</span>
							<span class="rt">
								<span class="num">2.06%</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>
					</div>
					<div class="indexCell-root lf" style="width: 25%;">
						<div class="index-name">退款时长</div>
						<div class="index-value">0.00</div>
						<div class="index-change orflow">
							<span class="lf">较前日</span>
							<span class="rt">
								<span class="num">-</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>	
						<div class="index-change orflow">
							<span class="lf">同行均值</span>
							<span class="rt">
								<span class="num">2.06%</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>
					</div>
					<div class="indexCell-root lf" style="width: 25%;">
						<div class="index-name">退款时长</div>
						<div class="index-value">0.00</div>
						<div class="index-change orflow">
							<span class="lf">较前日</span>
							<span class="rt">
								<span class="num">-</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>	
						<div class="index-change orflow">
							<span class="lf">同行均值</span>
							<span class="rt">
								<span class="num">2.06%</span>
								<span class="r-trend down">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- 维权总览 end -->

			<!-- 维权趋势 start -->
			<div class="product-trend-wrap mt-10">
				<div class="wrap-title">
					<div class="title-lf lf">维权趋势</div>
					<div class="chart-switch rt">
						<span class="switch curr">图表</span>
						<span class="sprite">
							<i class="sp"></i>
						</span>
						<span class="switch">表格</span>
					</div>
				</div>
				<div class="ebase-card-content">
					<div class="onenessCard">
						<div class="oui-index-picker">
							<div class="oui-index-picker-group">
								<div class="oui-index-picker-label">30天指标</div>
								<div class="oui-index-picker-content orflow">
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
											<span class="name">商品浏览量</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">下单件数</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">支付金额</span>
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
								<div class="oui-index-picker-label">单天指标</div>
								<div class="oui-index-picker-content orflow">
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
									</div>
								</div>
							</div>
							<div class="oui-index-picker-action">
								<span class="oui-index-picker-count">选择 4/4</span>
								<a href="javascript:;" class="oui-index-picker-reset">重置</a>
							</div>
						</div>
						<div class="switch-wrap1">
							<div class="product-trend-chart mt-22" id="product-trend-chart" style="width: 1080px;height: 300px;"></div>
						</div>
						<div class="switch-wrap1">
							<div class="ebase-table-root">
								<table class="table">
									<thead class="thead">
										<tr>
											<th class="th col-0 col-date" style="text-align: left;">10-25</th>
											<th class="th col-1 col-itemDsr" style="text-align: right;">描述相符评分</th>
											<th class="th col-2 col-serviceDsr" style="text-align: right;">卖家服务评分</th>
											<th class="th col-3 col-logisticsDsr" style="text-align: right;">物流服务评分</th>
										</tr>
									</thead>
									<tbody class="tbody">
										<tr class="tr">
											<td class="td col-0 col-date" style="text-align: left;">10-25</td>
											<td class="td col-0 col-itemDsr" style="text-align: right;">4.8000</td>
											<td class="td col-0 col-serviceDsr" style="text-align: right;">4.8000</td>
											<td class="td col-0 col-logisticsDsr" style="text-align: right;">4.8000</td>
										</tr>
										<tr class="tr">
											<td class="td col-0 col-date" style="text-align: left;">10-25</td>
											<td class="td col-0 col-itemDsr" style="text-align: right;">4.8000</td>
											<td class="td col-0 col-serviceDsr" style="text-align: right;">4.8000</td>
											<td class="td col-0 col-logisticsDsr" style="text-align: right;">4.8000</td>
										</tr>
										<tr class="tr">
											<td class="td col-0 col-date" style="text-align: left;">10-25</td>
											<td class="td col-0 col-itemDsr" style="text-align: right;">4.8000</td>
											<td class="td col-0 col-serviceDsr" style="text-align: right;">4.8000</td>
											<td class="td col-0 col-logisticsDsr" style="text-align: right;">4.8000</td>
										</tr>
										<tr class="tr">
											<td class="td col-0 col-date" style="text-align: left;">10-25</td>
											<td class="td col-0 col-itemDsr" style="text-align: right;">4.8000</td>
											<td class="td col-0 col-serviceDsr" style="text-align: right;">4.8000</td>
											<td class="td col-0 col-logisticsDsr" style="text-align: right;">4.8000</td>
										</tr>
										<tr class="tr">
											<td class="td col-0 col-date" style="text-align: left;">10-25</td>
											<td class="td col-0 col-itemDsr" style="text-align: right;">4.8000</td>
											<td class="td col-0 col-serviceDsr" style="text-align: right;">4.8000</td>
											<td class="td col-0 col-logisticsDsr" style="text-align: right;">4.8000</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 维权趋势 end -->

			<!-- TOP退款商品 start -->
			<div class="refund-goodsTOP-wrap mt-10">
				<div class="wrap-title">
					<div class="title-lf lf">TOP退款商品（近30天）</div>
					<span class="rt lookAll-link">
						<a href="javascript:;">查看全部>></a>
					</span>
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table-root">
						<table class="table">
							<thead class="thead">
								<th class="th col-0 col-item" style="text-align: left;">商品名称</th>
								<th class="th col-1 col-rfdSucCnt" style="text-align: right;">成功退款笔数</th>
								<th class="th col-2 col-rfdSucAmt" style="text-align: right;">成功退款金额</th>
								<th class="th col-3 col-payOrdCnt" style="text-align: right;">支付子订单数</th>
								<th class="th col-4 col-payAmt" style="text-align: right;">支付金额</th>
								<th class="th col-5 col-rfdReason" style="text-align: left;padding-left: 60px;">TOP退款原因</th>
								<th class="th col-6 col-rfdReason" style="text-align: right;">退款笔数占比</th>
							</thead>
							<tbody class="tbody">
								<tr class="tr">
									<td class="td col-0 col-item" style="text-align: left;">
										<span class="text1">号我就分为if将诶我方</span>
									</td>
									<td class="td col-1 col-rfdSucCnt" style="text-align: right;">6</td>
									<td class="td col-2 col-rfdSucAmt" style="text-align: right;">5</td>
									<td class="td col-3 col-payOrdCnt" style="text-align: right;">4</td>
									<td class="td col-4 col-payAmt" style="text-align: right;">220</td>
									<td class="td col-5 col-rfdReason" style="text-align: left;padding-left: 60px;">
										TOP退款原因
									</td>
									<td class="td col-6 col-rfdReason" style="text-align: right;">22.00%</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-item" style="text-align: left;">
										<span class="text1">号我就分为if将诶我方</span>
									</td>
									<td class="td col-1 col-rfdSucCnt" style="text-align: right;">6</td>
									<td class="td col-2 col-rfdSucAmt" style="text-align: right;">5</td>
									<td class="td col-3 col-payOrdCnt" style="text-align: right;">4</td>
									<td class="td col-4 col-payAmt" style="text-align: right;">220</td>
									<td class="td col-5 col-rfdReason" style="text-align: left;padding-left: 60px;">
										TOP退款原因
									</td>
									<td class="td col-6 col-rfdReason" style="text-align: right;">22.00%</td>
								</tr>
								<tr class="tr">
									<td class="td col-0 col-item" style="text-align: left;">
										<span class="text1">号我就分为if将诶我方</span>
									</td>
									<td class="td col-1 col-rfdSucCnt" style="text-align: right;">6</td>
									<td class="td col-2 col-rfdSucAmt" style="text-align: right;">5</td>
									<td class="td col-3 col-payOrdCnt" style="text-align: right;">4</td>
									<td class="td col-4 col-payAmt" style="text-align: right;">220</td>
									<td class="td col-5 col-rfdReason" style="text-align: left;padding-left: 60px;">
										TOP退款原因
									</td>
									<td class="td col-6 col-rfdReason" style="text-align: right;">22.00%</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- TOP退款商品 end -->
		</div>
	</div>
	<!-- 维权概况 end -->

	<!-- 维权分析  start -->
	<div class="w-1140 rt switch-wrap service-container">
		<div class="protection-analysis-wrap">
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
				<div class="classify-select classify-select-classify select-control common-picker isready">
					<a class="common-picker-header" href="#" >
						<span class="short-name"> 美容护肤/...体护理（新）</span><i class="caret icon"></i>
					</a>
					<div class="common-picker-menu select-control-list" style="height: 308px; width: 210px; left: -210px;">
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
						<div class="trees-menu" style="display: block;">
							<ul class="tree-menu common-menu tree-scroll-menu-level-2" style="height: 308px; width: 210px; left: 208px;"></ul>
							<ul class="tree-menu common-menu tree-scroll-menu-level-1" style="height: 272px; width: 208px; left: -2px;"></ul>
						</div>
					</div>
				</div>
			</div>
			<!-- 退款原因分析 start -->
			<div class="refund-anlaysis-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">退款原因分析</div>
					<div class="chart-switch rt">
						<span class="switch curr">列表</span>
						<span class="sprite">
							<i class="sp"></i>
						</span>
						<span class="switch">图表</span>
					</div>
					<div class="operation-actions rt">
						<div class="select-control ui-selector lf">
							<a href="javascript:;">
								<span class="ui-selector-value">退货退款</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list" style="display: none;">
								<li class="ui-selector-item ">
									<span>全部退款类型</span>
								</li>
								<li class="ui-selector-item">
									<span>仅退款</span>
								</li>
								<li class="ui-selector-item curr">
									<span>退货退款</span>
								</li>
							</ul>
						</div>
						<div class="select-control ui-selector lf">
							<a href="javascript:;">
								<span class="ui-selector-value">全部订单状态</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list" style="display: none;">
								<li class="ui-selector-item curr">
									<span>全部订单状态</span>
								</li>
								<li class="ui-selector-item">
									<span>买家已付款</span>
								</li>
								<li class="ui-selector-item">
									<span>卖家已发货</span>
								</li>
								<li class="ui-selector-item">
									<span>交易成功</span>
								</li>
								<li class="ui-selector-item">
									<span>物流相关评价</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table-root">
						<table class="table">
							<thead class="thead">
								<tr>
									<th class="th col-0 col-reasonName" style="text-align: left;">退款原因</th>
									<th class="th col-1 col-rfdSurAmt orderable sortableTh" style="text-align: right">
										<span>成功退款金额（占比）</span>
										<span class="order-flag desc">
											<i class="icon-order icon"></i>
										</span>
									</th>
									<th class="th col-2 col-rfdSucCnt orderable sortableTh" style="text-align: right">
										<span>成功退款笔数（占比）</span>
										<span class="order-flag">
											<i class="icon-order icon"></i>
										</span>
									</th>
									<th class="th col-3 col-rfdEndTime orderable sortableTh" style="text-align: right">
										<span>退款完结时长</span>
										<span class="order-flag">
											<i class="icon-order icon"></i>
										</span>
									</th>
									<th class="th col-4 col-rfdDsptCnt orderable sortableTh" style="text-align: right">
										<span>纠纷退款笔数</span>
										<span class="order-flag">
											<i class="icon-order icon"></i>
										</span>
									</th>
								</tr>
							</thead>
							<tbody class="tbody"></tbody>
						</table>
						<div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>暂无数据</span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 退款原因分析 end -->

			<!-- 退款商品 start -->
			<div class="refund-goods-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">退款商品</div>
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table-root">
						<table class="table">
							<thead class="thead">
								<tr>
									<th class="th col-0 col-item" style="text-align: left;">商品名称</th>
									<th class="th col-1 col-rfdSucCnt orderable" style="text-align: right">
										<span>成功退款笔数</span>
										<span class="order-flag desc">
											<i class="icon-order icon"></i>
										</span>
									</th>
									<th class="th col-2 col-rfdSucAmt orderable" style="text-align: right">
										<span>成功退款金额</span>
										<span class="order-flag">	
											<i class="icon-order icon"></i>
										</span>
									</th>
									<th class="th col-3 col-payOrdCnt orderable" style="text-align: right">
										<span>支付子订单数</span>
										<span class="order-flag">
											<i class="icon-order icon"></i>
										</span>
									</th>
									<th class="th col-4 col-payAmt orderable" style="text-align: right">
										<span>支付金额</span>
										<span class="order-flag">
											<i class="icon-order icon"></i>
										</span>
									</th>
									<th class="th col-5 col-rfdReason" style="text-align: left;">TOP退款原因</th>
									<th class="th col-6 col-rfdRate style="text-align: right;">退款笔数占比</th>
									<th class="th col-7 col-operate" style="text-align: right;">操作</th>
								</tr>
							</thead>
							<tbody class="tbody"></tbody>
						</table>
						<div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>暂无数据</span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 退款商品 end -->
		</div>
	</div>
	<!-- 维权分析  end -->

	<!-- 评价概况 start -->
	<div class="w-1140 rt switch-wrap service-container">
		<div class="evaluate-survey-wrap">
			<div class="screen-header h-50">
				<div class="update-option">
					<a href="javascript: void(0);" class="ebase-DayPicker__btn lf"><i class="oui-icon oui-icon-angle-left">&lt;</i> 前一天</a>
					<span class="ebase-DayPicker__calendar lf"><div class="legacy-oui-calendar-trigger oui-popup-trigger"><i class="oui-icon oui-icon-calendar"></i><input type="text" value="2017-11-15" readonly=""></div></span>
					<a href="javascript: void(0);" class="ebase-DayPicker__btn lf" disabled="">后一天<i class="oui-icon oui-icon-angle-right">&gt;</i></a>
				</div>
			</div>
			<!-- 评价总览 start -->
			<div class="product-outlook-wrap mt-10">
				<div class="wrap-title">
					<div class="title-lf lf">评价总览（近180天）</div>
				</div>
				<div class="ebase-card-content">
					<div class="indexCell-root lf" style="width: 33.333333%;">
						<div class="index-name">退款时长</div>
						<div class="index-value">0.00</div>
						<div class="index-change orflow">
							<span class="lf">较前日</span>
							<span class="rt">
								<span class="num">-</span>
								<span class="r-trend up">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>	
						<div class="index-change orflow">
							<span class="lf">同行均值</span>
							<span class="rt">
								<span class="num">2.06%</span>
								<span class="r-trend up">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>
					</div>
					<div class="indexCell-root lf" style="width: 33.333333%;">
						<div class="index-name">退款时长</div>
						<div class="index-value">0.00</div>
						<div class="index-change orflow">
							<span class="lf">较前日</span>
							<span class="rt">
								<span class="num">-</span>
								<span class="r-trend up">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>	
						<div class="index-change orflow">
							<span class="lf">同行均值</span>
							<span class="rt">
								<span class="num">2.06%</span>
								<span class="r-trend up">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>
					</div>
					<div class="indexCell-root lf" style="width: 33.333333%;">
						<div class="index-name">退款时长</div>
						<div class="index-value">0.00</div>
						<div class="index-change orflow">
							<span class="lf">较前日</span>
							<span class="rt">
								<span class="num">-</span>
								<span class="r-trend up">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>	
						<div class="index-change orflow">
							<span class="lf">同行均值</span>
							<span class="rt">
								<span class="num">2.06%</span>
								<span class="r-trend up">
									<i class="icon icon-trend"></i>
								</span>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- 评价总览 end -->

			<!-- 评价趋势 start -->
			<div class="product-trend-wrap mt-10">
				<div class="wrap-title">
					<div class="title-lf lf">评价趋势</div>
					
					<div class="chart-switch rt">
						<span class="switch curr">图表</span>
						<span class="sprite">
							<i class="sp"></i>
						</span>
						<span class="switch">表格</span>
					</div>
					<div class="download-wrap rt">
						<a href="javascript:;">下载
							<i class="icon"></i>
						</a>
					</div>
				</div>
				<div class="ebase-card-content">
					<div class="onenessCard">
						<div class="oui-index-picker">
							<div class="oui-index-picker-group">
								<div class="oui-index-picker-label">180天指标</div>
								<div class="oui-index-picker-content orflow">
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
											<span class="name">商品浏览量</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">下单件数</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">支付金额</span>
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
								<span class="oui-index-picker-count">已选 3/3</span>
								<a href="javascript:;" class="oui-index-picker-reset">重置</a>
							</div>
						</div>
						<div class="assess-trend-chart mt-22" id="assess-trend-chart" style="width: 1080px;height: 300px;"></div>

					</div>
				</div>
			</div>
			<!-- 评价趋势 end -->

			<!-- TOP负面平价商品 start -->
			<div class="negative-assessTop-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">TOP负面平价商品（近30天）</div>
					<span class="rt lookAll-link">
						<a href="javascript:;">查看全部>></a>
					</span>
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table-root">
						<table class="table">
							<thead class="thead">
								<th class="th col-0 col-item" style="text-align: left;">商品名称</th>
								<th class="th col-1 col-badReviewCnt" style="text-align: right;">负面评价数</th>
								<th class="th col-2 col-clkRatePc" style="text-align: right;">PC围观人数占比</th>
								<th class="th col-3 col-clkRateApp" style="text-align: right;">手淘围观人数占比</th>
								<th class="th col-4 col-reviewKW" style="text-align: right;">TOP负面评价关键词(评价数量)</th>
							</thead>
							<tbody class="tbody">
								<tr class="tr">
									<td class="td col-0 col-item" style="text-align: left;">
										<span class="text1">号我就分为if将诶我方</span>
									</td>
									<td class="td col-1 col-rfdSucCnt" style="text-align: right;">6</td>
									<td class="td col-2 col-rfdSucAmt" style="text-align: right;">5</td>
									<td class="td col-3 col-payOrdCnt" style="text-align: right;">4</td>
									<td class="td col-4 col-payAmt" style="text-align: right;">220</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="pagesInfo-tips">正负面评价是对评价内容进行语义分析与识别后，所做的评价内容基础分类，会存在一定误差比例，仅供商家参考，对商家及商品的信用评分不造成任何影响。</div>
				</div>
			</div>
			<!-- TOP负面平价商品 end -->
		</div>
	</div>
	<!-- 评价概况 end -->

	<!-- 评价分析 start -->
	<div class="w-1140 rt switch-wrap service-container">
		<div class="evaluate-analysis-wrap">
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
				<div class="classify-select classify-select-classify select-control common-picker isready">
					<a class="common-picker-header" href="#" >
						<span class="short-name"> 美容护肤/...体护理（新）</span><i class="caret icon"></i>
					</a>
					<div class="common-picker-menu select-control-list" style="height: 308px; width: 210px; left: -210px;">
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
						<div class="trees-menu" style="display: block;">
							<ul class="tree-menu common-menu tree-scroll-menu-level-2" style="height: 308px; width: 210px; left: 208px;"></ul>
							<ul class="tree-menu common-menu tree-scroll-menu-level-1" style="height: 272px; width: 208px; left: -2px;"></ul>
						</div>
					</div>
				</div>
				<div class="classify-select classify-select-brand select-control common-picker isready open">
					<a class="common-picker-header" href="#" title="所有品牌">
						<span class="short-name">所有品牌</span>
						<i class="caret icon"></i>
					</a>
					<div class="common-picker-menu select-control-list" style="height: 376px; width: 210px; left: 0px;">
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
						<div class="trees-menu" style="display: block;">
							<ul class="tree-menu common-menu tree-scroll-menu-level-1" style="height: 340px; width: 208px; left: -2px;"></ul>
						</div>
					</div>
				</div>
			</div>
			<!-- 评价趋势 start -->
			<div class="product-trend-wrap mt-10">
				<div class="wrap-title">
					<div class="title-lf lf">评价趋势</div>
					<div class="chart-switch rt">
						<span class="switch curr">图表</span>
						<span class="sprite">
							<i class="sp"></i>
						</span>
						<span class="switch">表格</span>
					</div>
				</div>
				<div class="ebase-card-content">
					<div class="onenessCard">
						<div class="oui-index-picker">
							<div class="oui-index-picker-group">
								<div class="oui-index-picker-content orflow">
									<div class="oui-index-picker-blank"></div>
									<div class="combo-panel-lite combo-panel-inline lf">
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
							<div class="oui-index-picker-action">
								<span class="oui-index-picker-count">已选 4/4</span>
								<a href="javascript:;" class="oui-index-picker-reset">重置</a>
							</div>
						</div>
						<div class="assess-trend-chart mt-22" id="assess-trend2-chart" style="width: 1080px;height: 300px;"></div>
					</div>
				</div>
			</div>
			<!-- 评价趋势 end -->

			<!-- 评价内容分析 start -->
			<div class="assessCnt-anlaysis-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">评价内容分析</div>
					<div class="switch-wrap-att orflow">
						<span class="curr lf">
							<a href="javascript:;">负面评价</a>
						</span>
						<span class="lf">
							<a href="javascript:;">正面评价</a>
						</span>
					</div>
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table-root">
						<table class="table">
							<thead class="thead">
								<tr class="tr">
									<th class="col col-0 col-name" style="width: 100px;text-align: left;">评价内容</th>						
									<th class="col col-1 col-value" style="width: 70px;text-align: right;">评价条数</th>	
									<th class="col col-2 col-ratio" style="width: 110px;text-align: right;">
										<span style="padding-right: 20px;">占比</span>
									</th>	
									<th class="col col-3 col-keywords" style="text-align: left;">
										<span style="padding-left: 20px;">评价关键词</span>
									</th>			
								</tr>
							</thead>
							<tbody class="tbody">
								<tr class="tr">
									<td class="td col-0 col-name" style="width: 100px;text-align: left;">性价比相关评价</td>
									<td class="td col-1 col-value" style="width: 70px;text-align: right;">0</td>
									<td class="td col-2 col-ratio" style="width: 110px;text-align: right;">
										<span style="padding-right: 20px;">-</span>
									</td>
									<td class="td col-3 col-keywords" style="text-align: left;">
										<div class="ebase-kwTd-root">
											<ul class="ebase-kwTd-list">
												-
											</ul>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="pagesInfo-tips">正负面评价是对评价内容进行语义分析与识别后，所做的评价内容基础分类，会存在一定误差比例，仅供商家参考，对商家及商品的信用评分不造成任何影响。</div>
				</div>
			</div>
			<!-- 评价内容分析 end -->

			<!-- 商品评价分析 start -->
			<div class="assess-anlaysis-wrap mt-10 backff">
				<div class="wrap-title">
					<div class="title-lf lf">商品评价分析</div>
					<div class="operation-actions rt">
						<div class="select-control ui-selector lf">
							<a href="javascript:;">
								<span class="ui-selector-value">正面评价</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
								<li class="ui-selector-item curr">
									<span>正面评价</span>
								</li>
								<li class="ui-selector-item">
									<span>负面评价</span>
								</li>
							</ul>
						</div>
						<div class="select-control ui-selector lf">
							<a href="javascript:;">
								<span class="ui-selector-value">全部评价内容</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
								<li class="ui-selector-item curr">
									<span>全部评价内容</span>
								</li>
								<li class="ui-selector-item">
									<span>商品相关评价</span>
								</li>
								<li class="ui-selector-item">
									<span>包装相关评价</span>
								</li>
								<li class="ui-selector-item">
									<span>服务相关评价</span>
								</li>
								<li class="ui-selector-item">
									<span>物流相关评价</span>
								</li>
								<li class="ui-selector-item">
									<span>想家笔芯管评价</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table-root">
						<table class="table">
							<thead class="thead">
								<th class="th col-0 col-item" style="text-align: left;">商品名称</th>
								<th class="th col-1 col-badReviewCnt" style="text-align: right;">负面评价数</th>
								<th class="th col-2 col-clkRatePc" style="text-align: right;">PC围观人数占比</th>
								<th class="th col-3 col-clkRateApp" style="text-align: right;">手淘围观人数占比</th>
								<th class="th col-4 col-reviewKW" style="text-align: right;">TOP负面评价关键词(评价数量)</th>
							</thead>
							<tbody class="tbody">
								<tr class="tr">
									<td class="td col-0 col-item" style="text-align: left;">
										<span class="text1">号我就分为if将诶我方</span>
									</td>
									<td class="td col-1 col-rfdSucCnt" style="text-align: right;">6</td>
									<td class="td col-2 col-rfdSucAmt" style="text-align: right;">5</td>
									<td class="td col-3 col-payOrdCnt" style="text-align: right;">4</td>
									<td class="td col-4 col-payAmt" style="text-align: right;">220</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="pagesInfo-tips">正负面评价是对评价内容进行语义分析与识别后，所做的评价内容基础分类，会存在一定误差比例，仅供商家参考，对商家及商品的信用评分不造成任何影响。</div>
				</div>
			</div>
			<!-- 商品评价分析 end -->
		</div>
	</div>
	<!-- 评价分析 end -->
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
<script type="text/javascript">
	var productTrendChart = echarts.init(document.getElementById('product-trend-chart'));
		 // 指定图表的配置项和数据
		 var colors = ['#2062e6','#f3d024','#ff8533','#4cb5ff'];
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
					    	bottom: '8%',
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
			            	name: '退款率',
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
				              	name: '纠纷退款率',
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
				              {
				              	name: '投诉率',
				              	type: 'line',
				                symbol: 'circle',  // 折点处空心圆
				                showSymbol: false,
				                symbolSize: 8,
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
				                symbolSize: 8,
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
	        productTrendChart.setOption(option);

    var assessTrendChart = echarts.init(document.getElementById('assess-trend-chart'));
		 // 指定图表的配置项和数据
		 var colors = ['#2062e6','#f3d024','#ff8533','#4cb5ff'];
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
					    	bottom: '8%',
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
			            	name: '退款率',
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
				              	name: '纠纷退款率',
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
				              {
				              	name: '投诉率',
				              	type: 'line',
				                symbol: 'circle',  // 折点处空心圆
				                showSymbol: false,
				                symbolSize: 8,
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
				                symbolSize: 8,
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
			        assessTrendChart.setOption(option);

    var assessTrend2Chart = echarts.init(document.getElementById('assess-trend2-chart'));
		 // 指定图表的配置项和数据
		 var colors = ['#2062e6','#f3d024','#ff8533','#4cb5ff'];
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
					    	bottom: '8%',
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
			            	name: '退款率',
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
				              	name: '纠纷退款率',
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
				              {
				              	name: '投诉率',
				              	type: 'line',
				                symbol: 'circle',  // 折点处空心圆
				                showSymbol: false,
				                symbolSize: 8,
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
				                symbolSize: 8,
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
		    assessTrend2Chart.setOption(option);
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
	// 点击左侧导航nav
	$(".switch-wrap").eq(0).show();
	$(".nav .menu-list-inner .menu-item-inner").click(function(){
		var index = $(this).index();
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
		$(".switch-wrap").hide();
		$(".switch-wrap").eq(index).show();
	});

	// 维权概况--维权趋势  图标 趋势 切换
	$(".product-trend-wrap .switch-wrap1").eq(0).show();
	$(".product-trend-wrap span.switch").click(function(){
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
		var index = $(this).index();
		if(index ===0 ){
			$(".product-trend-wrap .switch-wrap1").eq(1).hide();
			$(".product-trend-wrap .switch-wrap1").eq(0).show();
		}
		if(index ===2 ){
			$(".product-trend-wrap .switch-wrap1").eq(0).hide();
			$(".product-trend-wrap .switch-wrap1").eq(1).show();
		}
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
	});

	//  下划线 选项卡
	$(".switch-wrap-att span").click(function(){
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
	})


		// 分类 搜索
		/*
			/***   1级
		<li class="tree-item common-item">所有类目</li>
		<li class="tree-item common-item">女装/女士精品<i class="oui-icon oui-icon-angle-right sub-tree-icon sub-common-icon"></i></li>
		<li class="tree-item common-item active">美容护肤/美体/精油<i class="oui-icon oui-icon-angle-right sub-tree-icon sub-common-icon"></i></li>
		<li class="tree-item common-item">床上用品<i class="oui-icon oui-icon-angle-right sub-tree-icon sub-common-icon"></i></li>
		<li class="tree-item common-item">服饰配件/皮带/帽子/围巾<i class="oui-icon oui-icon-angle-right sub-tree-icon sub-common-icon"></i></li>
		<li class="tree-item common-item">厨房电器<i class="oui-icon oui-icon-angle-right sub-tree-icon sub-common-icon"></i></li>
		<li class="tree-item common-item">尿片/洗护/喂哺/推车床<i class="oui-icon oui-icon-angle-right sub-tree-icon sub-common-icon"></i></li>
		<li class="tree-item common-item">厨房/烹饪用具<i class="oui-icon oui-icon-angle-right sub-tree-icon sub-common-icon"></i></li>
		<li class="tree-item common-item">大家电<i class="oui-icon oui-icon-angle-right sub-tree-icon sub-common-icon"></i></li>
		<li class="tree-item common-item">洗护清洁剂/卫生巾/纸/香薰<i class="oui-icon oui-icon-angle-right sub-tree-icon sub-common-icon"></i></li>
			/***   2级
		<li class="tree-item common-item active">身体护理（新）</li>
		*/
		var classifyselect = {
			'所有类目':[],
			'女装/女士精品': ['毛呢外套'],
			'美容护肤/美体/精油': ['身体护理（新）'],
			'女鞋': ['帆布鞋'],
			'床上用品': ['床品套件/四件套/多件套'],
			'服饰配件/皮带/帽子/围巾': ['其他配件'],
			'厨房电器': ['电压力锅'],
			'尿片/洗护/喂哺/推车床':['宝宝洗浴护肤品'],
			'厨房/烹饪用具': ['烹饪厨具'],
			'大家电': ['冰箱'],
			'洗护清洁剂/卫生巾/纸/香薰': ['纸品/湿巾', '卫生巾/护垫/成人尿裤', '衣物清洁剂/护理剂', '头发清洁/护理/造型']
		}

		var classifyselect2 = {
			'所有品牌': [],
			'Johnson’s baby/强生婴儿': []
		}

		var fragment = document.createDocumentFragment();
		allProps();
		allProps2();

		function allProps () {
			for (var props in  classifyselect) {
				var html = '';
				if(classifyselect[props][0] != undefined) {
					html += '<li class="tree-item common-item">'+props+'<i class="child-symbol" style="position:absolute;right:10px;color:#555;">></i></li>'
				} else {
					html += '<li class="tree-item common-item">'+props+'</li>'
				}
				$(fragment).append(html);
			}
			$(".classify-select.common-picker.classify-select-classify .tree-menu.common-menu.tree-scroll-menu-level-1").append(fragment);
			$(".classify-select.common-picker.classify-select-classify .tree-menu.common-menu.tree-scroll-menu-level-1 li").eq(0).addClass("active");

			if($(".classify-select.common-picker.classify-select-classify .tree-menu.common-menu.tree-scroll-menu-level-2").html() === '') {
				$(".classify-select.common-picker.classify-select-classify .tree-menu.common-menu.tree-scroll-menu-level-2").html('<li style="text-align:center;margin-top:120px;">当前类目下暂无子分类</li>')
			}
		}
		function allProps2 () {
			for (var props in  classifyselect2) {
				var html = '';
				if(classifyselect2[props][0] != undefined) {
					html += '<li class="tree-item common-item">'+props+'<i class="child-symbol" style="position:absolute;right:10px;color:#555;">></i></li>'
				} else {
					html += '<li class="tree-item common-item">'+props+'</li>'
				}
				$(fragment).append(html);
			}
			$(".classify-select.common-picker.classify-select-brand .tree-menu.common-menu.tree-scroll-menu-level-1").append(fragment);
			$(".classify-select.common-picker.classify-select-brand .tree-menu.common-menu.tree-scroll-menu-level-1 li").eq(0).addClass("active");

			if($(".classify-select.common-picker.classify-select-brand .tree-menu.common-menu.tree-scroll-menu-level-2").html() === '') {
					$(".classify-select.common-picker.classify-select-brand .tree-menu.common-menu.tree-scroll-menu-level-2").html('<li style="text-align:center;margin-top:120px;">当前类目下暂无子分类</li>')
				}
		}

		$(".classify-select.common-picker .tree-menu.common-menu.tree-scroll-menu-level-1").on("mouseenter", 'li', function() {
			var _this = $(this);
			var html = '';
			var keyW = _this.text();
			keyW = keyW.replace(">", '');
			for (var names in classifyselect) {
				if(names === keyW) {
					for (var i = 0; i < classifyselect[names].length; i ++) {
						html += '<li class="tree-item common-item">'+classifyselect[names][i]+'</li>'
					}
				}
			}
			_this.parents(".tree-menu.common-menu.tree-scroll-menu-level-1").siblings(".tree-menu.common-menu.tree-scroll-menu-level-2").find("li").remove();
			$(fragment).append(html);
			_this.parents(".tree-menu.common-menu.tree-scroll-menu-level-1").siblings(".tree-menu.common-menu.tree-scroll-menu-level-2").append(fragment);
			if(_this.parents(".tree-menu.common-menu.tree-scroll-menu-level-1").siblings(".tree-menu.common-menu.tree-scroll-menu-level-2").html() === '') {
				_this.parents(".tree-menu.common-menu.tree-scroll-menu-level-1").siblings(".tree-menu.common-menu.tree-scroll-menu-level-2").html('<li style="text-align:center;margin-top:120px;">当前类目下暂无子分类</li>')
			}
		})

		$(".classify-select.common-picker .tree-menu.common-menu").on("click",function(event) {
			var event = event || window.event;
			var target = event.target || event.srcElement;
			if(target.nodeName.toLowerCase() === 'li') {
				var text = $(target).text().replace(">", '');
				$(target).parents('.classify-select.common-picker').find(".short-name").text(text);
				$(target).addClass("active").siblings(".active").removeClass("active");
				$(target).parents(".select-control-list").hide();
			}
		})
		$(".classify-select.common-picker .legacy-oui-typeahead-input").keyup(function(event) {
			var event = event || window.event;
			if(event.keyCode !== 38 && event.keyCode !== 40) {
				var sign1 = false;  /*起标识作用*/
				var sign2 = false;  /*起标识作用*/
				var _this = $(this);
				var text = _this.val();
				var htmlFormat = '<span style="color:#ff6767">'+text+'</span>';
				if(_this.val() === '') {
					_this.parents(".common-picker-menu").find(".trees-menu").show();
					if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".no-data").length !== 0 ) {
						_this.parents(".legacy-oui-typeahead.common-typeahead").find(".no-data").remove();
					}
					if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").length !== 0) {
						_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").remove();
					}
				} else {
					var html = '';
					var props, textstr, reg;
					reg = text;
					reg = new RegExp(reg, 'g');
					_this.parents(".common-picker-menu").find(".trees-menu").hide();
					_this.parents(".common-picker").find(".common-picker-menu.select-control-list").animate({"width": "420px"}, 200);
					for (props in classifyselect) {
						if(props.indexOf(text) !== -1) {
							sign1 = true;
							props = props.replace(reg, htmlFormat);
							html += '<div class="legacy-oui-typeahead-item common-item">'+props+'</div>';
						}
					}
					for(props in classifyselect) {
						for (var i = 0; i < classifyselect[props].length; i ++) {
							if(classifyselect[props][i].indexOf(text) !== -1) {
								sign2 = true;
								textstr = props + ' > '+ classifyselect[props][i];
								textstr = textstr.replace(reg, htmlFormat);
								html += '<div class="legacy-oui-typeahead-item common-item">'+textstr+'</div>';
							}
						}
					}
					if (sign2 || sign1) {
						var htmlMenu = '<div class="legacy-oui-typeahead-menu">'+html+'</div>';
						if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".no-data").length !== 0) {
							_this.parents(".legacy-oui-typeahead.common-typeahead").find(".no-data").remove();
						}
						if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").length !== 0) {
							_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").remove();
						}
						_this.parents(".legacy-oui-typeahead.common-typeahead").append(htmlMenu);
						_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu .legacy-oui-typeahead-item.common-item").eq(0).addClass("blueBK");
						// keyCodeEvents.call(this);
					}
					if( (!sign1) && (!sign2) && _this.val() !== '') {
						var html = '<div class="no-data">暂无数据</div>';
						if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".no-data").length === 0) {
							_this.parents(".legacy-oui-typeahead.common-typeahead").append(html);
						}
						if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").length !== 0) {
							_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").remove();
						}
					}
				}
			}
		})

		$(".classify-select.common-picker .common-picker-menu.select-control-list").on("click", '.legacy-oui-typeahead-menu', function(event) {
			var event = event || window.event;
			var target = event.target || event.srcElement;
			if(target.nodeName.toLowerCase() === 'div') {
				$(target).parents(".common-picker-menu.select-control-list").siblings(".common-picker-header").find(".short-name").text($(target).text());
				$(target).addClass("blueBK").siblings(".legacy-oui-typeahead-item.common-item.blueBK").removeClass("blueBK");
				$(target).parents(".common-picker-menu.select-control-list").hide();
			}
		})

		$(".classify-select.common-picker .common-picker-menu.select-control-list").on("mouseenter", '.legacy-oui-typeahead-menu .legacy-oui-typeahead-item.common-item', function(event) {
			var event = event || window.event;
			var target = event.target || event.srcElement;
			if(target.nodeName.toLowerCase() === 'div') {
					$(target).addClass("blueBK").siblings(".legacy-oui-typeahead-item.common-item.blueBK").removeClass("blueBK");
			}
		})

		// 上下键
		var keyCodeEvents = function () {
			var _this = $(".classify-select.common-picker .legacy-oui-typeahead-input");
			_this.keydown(function(event) {
				var event = event || window.event;
				// var _this = $(this);
				var li = _this.parents(".legacy-oui-typeahead-input-wrapper").siblings(".legacy-oui-typeahead-menu").find(".legacy-oui-typeahead-item.common-item");
				var index = _this.parents(".legacy-oui-typeahead-input-wrapper").siblings(".legacy-oui-typeahead-menu").find(".legacy-oui-typeahead-item.common-item.blueBK").index();
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
		});
	//  下拉
	$(".select-control-list .ui-selector-item").click(function(e) {
		var _this = $(this);
		_this.addClass("curr").siblings(".curr").removeClass("curr");
		_this.parents(".ui-selector").find(".ui-selector-value").text($(this).find("span").text());
		_this.parents(".select-control-list").hide();
	})
	// 下拉框 .....end


	// 日期
	//维权概况 input
	laydate.render({
	  elem: '.service-container .protection-overview-wrap .screen-header input',
	  showBottom: false
	});
	//评价概况 input
	laydate.render({
	  elem: '.service-container .evaluate-survey-wrap .screen-header input',
	  showBottom: false
	});
</script>
</html>

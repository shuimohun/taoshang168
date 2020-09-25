<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--实时-->
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/sycm_index.css">
<div class="header-wrap">
	<div class="header w-1210">
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
	<div class="header-nav w-1210">
		<ul class="nav-list orflow mt-16">
			<li class="nav-item lf">
				<a href="index.php?ctl=Seller_Sycm&met=index">
					首页
				</a>
			</li>
			<li class="nav-item lf curr">
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
					<p>实时直播</p>
				</div>
			</div>
			<ul class="menu-list-inner">
				<li class="menu-item-inner lf curr">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">实时概况</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">实时来源</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">实时榜单</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">实时访客</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">实时催付宝</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- 实时概况 start -->
	<div class="w-1040 rt switch-wrap real-time-container">
		<div class="real-overlook-wrap backff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">实时概况</h3>
				<span class="screen-subtitle">
					<span class="live-clock">
						更新时间：<i class="icon"></i><span class="data-value num">2017-09-18 14:19:35</span>
					</span>
				</span>
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
			</div>
			<!-- 实时总览 start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>实时总览
					</h4>
					<div class="sub-title rt mt-12">
						<span class="tip">点击快速更新数据面板</span>
						<button class="refresh">
							<i class="icon"></i>刷新
						</button>
					</div>
				</div>
				<div class="content">
					<ul class="index-grid orflow">
						<li class="lf index-item">
							<div class="name">访客数</div>
							<div class="value">52</div>
							<div class="data2">
								<i class="icon"></i>
								<span class="value">20.36%</span>
							</div>
							<div class="data3">
								昨日<span class="value">85</span>
							</div>
						</li>
						<li class="lf index-item">
							<div class="name">浏览量</div>
							<div class="value">52</div>
							<div class="data2">
								<i class="icon"></i>
								<span class="value">20.36%</span>
							</div>
							<div class="data3">
								昨日<span class="value">85</span>
							</div>
						</li>
						<li class="lf index-item">
							<div class="name">支付金额</div>
							<div class="value">-</div>
							<div class="data2">
								<i class="icon"></i>
								<span class="value">-</span>
							</div>
							<div class="data3">
								昨日<span class="value">-</span>
							</div>
						</li>
						<li class="lf index-item">
							<div class="name">支付子弟订单</div>
							<div class="value">52</div>
							<div class="data2">
								<i class="icon"></i>
								<span class="value">20.36%</span>
							</div>
							<div class="data3">
								昨日<span class="value">85</span>
							</div>
						</li>
						<li class="lf index-item">
							<div class="name">支付买家数</div>
							<div class="value">52</div>
							<div class="data2">
								<i class="icon"></i>
								<span class="value">20.36%</span>
							</div>
							<div class="data3">
								昨日<span class="value">85</span>
							</div>
						</li>
					</ul>
					<div class="data-industry">
						<div class="data-industry-text">
							<!-- <i class="live-icon-badge"></i> -->
							<div class="flag">
								<span class="data-value text1">主营业务：大家电</span>
							</div>
							
							<span class="data-text-extra">以下根据全店数据排名</span>
						</div>
						<div class="column pay-amount-rank">
							<span class="data-icon">
								<i class="icon live-icon-money"></i>
							</span>
							<div class="data-main-rank">
								<span class="data-label sans-serif">支付金额行业排名</span>
								<span class="data-value num">100+</span>
							</div>
							<div class="data-top-10">
								<span class="data-label">行业TOP10平均</span>
								<span class="data-value">
									<span class="num">5412145</span>元
								</span>
							</div>
							<div class="data-top-100">
								<span class="data-label">行业TOP100平均</span>
								<span class="data-value">
									<span class="num">5412145</span>元
								</span>
							</div>
						</div>
						<div class="column uv-amount-rank">
							<span class="data-icon">
								<i class="icon live-icon-user"></i>
							</span>
							<div class="data-main-rank">
								<span class="data-label sans-serif">访客数行业排名</span>
								<span class="data-value num">100+</span>
							</div>
							<div class="data-top-10">
								<span class="data-label">行业TOP10平均</span>
								<span class="data-value">
									<span class="num">5412145</span>元
								</span>
							</div>
							<div class="data-top-100">
								<span class="data-label">行业TOP100平均</span>
								<span class="data-value">
									<span class="num">5412145</span>元
								</span>
							</div>
						</div>
						<div class="column buyer-amount-rank">
							<span class="data-icon">
								<i class="icon live-icon-wallet"></i>
							</span>
							<div class="data-main-rank">
								<span class="data-label sans-serif">支付买家数行业排名</span>
								<span class="data-value num">100+</span>
							</div>
							<div class="data-top-10">
								<span class="data-label">行业TOP10平均</span>
								<span class="data-value">
									<span class="num">5412145</span>元
								</span>
							</div>
							<div class="data-top-100">
								<span class="data-label">行业TOP100平均</span>
								<span class="data-value">
									<span class="num">5412145</span>元
								</span>
							</div>
						</div>
						<div class="row text-detail-invalid"></div>
					</div>
				</div>
			</div>
			<!-- 实时总览 end -->
			<!-- 实时趋势 start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>实时趋势
					</h4>
					<div class="operation-actions rt">
						<div class="ui-selector date-selector compare mt-16">
							<a href="javascript:;">
								<span class="ui-selector-val">2017-10-28</span>
								<span class="caret icon"></span>
							</a>
						</div>
						<div class="select-control ui-selector compare mt-16">
							<a href="javascript:;">
								<span class="ui-selector-val">常规对比</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
								<li class="ui-selector-item curr">
									<span>常规对比</span>
								</li>
								<li class="ui-selector-item">
									<span>大促对比</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="mod-box">
						<div class="group orflow">
							<div class="radio lf selected">
								<span class="option"></span>
								<span class="name">分时段趋势图</span>
								<span class="dian"></span>
							</div>
							<div class="radio lf">
								<span class="option"></span>
								<span class="name">时段累计图</span>
								<span class="dian"></span>
							</div>
						</div>
						<div class="charts-wrap orflow">
							<div id="payMoney-chart" class="lf charts" style="width:470px;height:225px;"></div>
							<div id="visitor-chart" class="lf charts" style="width:470px;height:225px;"></div>
							<div id="payBuyer-chart" class="lf charts" style="width:470px;height:225px;"></div>
							<div id="paySon-chart" class="lf charts" style="width:470px;height:225px;"></div>
						</div>
					</div>

				</div>
			</div>
			<!-- 实时趋势  end -->
			<!-- 行业排行  start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>行业排行
					</h4>
				</div>
				<div class="content">
					<div class="jumbo-intro">
						<span class="icon"></span>
						<p class="order-desc">亲，您还未订购市场行情专业版，暂时无法使用！</p>
						<a href="javascript:;" class="btn">立即订购</a>
						<a href="javascript:;" class="preview-btn">功能预览></a>
					</div>
				</div>
			</div>
			<!-- 行业排行  end -->
		</div>
	</div>
	<!-- 实时概况 end -->

	<!-- 实时来源 start -->
	<div class="w-1040 rt switch-wrap real-time-container">
		<div class="real-resource-wrap backff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">实时来源</h3>
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
			</div>
			<!-- PC端来源分布 start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>PC端来源分布
					</h4>
				</div>
				<div class="content">
					<div class="mod-box">
						<div class="mod-box-row">
							<div class="table openable-table device-table">
								<div class="table-header">
									<span class="col source">来源</span>
									<span class="col percent">访客数占比</span>
									<span class="col pv">访客数</span>
									<span class="col actions">操作</span>
								</div>
								
								<div class="table-body">
									<div class="row active">
										<span class="col source">
											<div class="btn-wrap">
												<i class="open-btn btn-spread">-</i><i class="open-btn">+</i>
											</div>
											淘外流量
										</span>
										<span class="col percent">100%</span>
										<span class="col pv num">2</span>
										<span class="col bar">
											<span class="bar-percent" style="width:100%">
												<i class="bar-calu"></i>
											</span>
										</span>
										<ul class="row-children">
											<li class="row-children-item">
												<span class="col source">百度</span>
												<span class="col percent">50%</span>
												<span class="col pv num">1</span>
												<span class="col bar">
													<span class="bar-percent" style="width:50%">
														<i class="bar-calu"></i>
													</span>
												</span>
												<span class="col actions"></span>
											</li>
											<li class="row-children-item">
												<span class="col source">新浪网</span>
												<span class="col percent">50%</span>
												<span class="col pv num">1</span>
												<span class="col bar">
													<span class="bar-percent" style="width:50%">
														<i class="bar-calu"></i>
													</span>
												</span>
												<span class="col actions"></span>
											</li>
										</ul>
									</div>
									<div class="row">
										<span class="col source">
											<div class="btn-wrap">
												<i class="open-btn btn-spread">-</i><i class="open-btn">+</i>
											</div>
											淘内免费
										</span>
										<span class="col percent">100%</span>
										<span class="col pv num">2</span>
										<span class="col bar">
											<span class="bar-percent" style="width:100%">
												<i class="bar-calu"></i>
											</span>
										</span>
										<ul class="row-children">
											<li class="row-children-item">
												<span class="col source">百度</span>
												<span class="col percent">50%</span>
												<span class="col pv num">1</span>
												<span class="col bar">
													<span class="bar-percent" style="width:50%">
														<i class="bar-calu"></i>
													</span>
												</span>
												<span class="col actions"></span>
											</li>
											<li class="row-children-item">
												<span class="col source">新浪网</span>
												<span class="col percent">50%</span>
												<span class="col pv num">1</span>
												<span class="col bar">
													<span class="bar-percent" style="width:50%">
														<i class="bar-calu"></i>
													</span>
												</span>
												<span class="col actions"></span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="mod-box-update-time">
							<span>
								更新时间：<em class="time">2017-09-20 09:37:02</em>
							</span>
						</div>
						<div class="paid-module-no-permission">
							<p>
								<span class="error">
									<i class="icon"></i>
								</span>亲,您还没有订购流量纵横，暂时无法使用！
							</p>
							<p>
								<a href="javascript:;" class="order-btn">立即订购</a>
							</p>
							<p>
								<a href="javascript:;" class="preview-btn" target="_blank">功能预览></a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- PC端来源分布 end -->
			<!-- 无线端来源分布 start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>无线端来源分布
					</h4>
				</div>
				<div class="content">
					<div class="mod-box">
						<div class="mod-box-row">
							<div class="table openable-table device-table">
								<div class="table-header">
									<span class="col source">来源</span>
									<span class="col percent">访客数占比</span>
									<span class="col pv">访客数</span>
								</div>
								<div class="table-body">
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
							<div class="mod-box-update-time">
								<span>
									更新时间：<em class="time">2017-09-20
									09:37:02
								</em>
							</span>
						</div>
					</div>				
				</div>
			</div>
			<!-- 无线端来源分布  end -->
			<!-- 地域分布  start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>地域分布
					</h4>
				</div>
				<div class="content" style="padding:0">
					<div class="ui-switch">
						<ul class="ui-switch-menu">
							<li class="active ui-switch-item lf">
								<a href="javascript:;">访客数排行TOP10</a>
							</li>
							<li class="ui-switch-item lf">
								<a href="javascript:;">支付买家排行TOP10</a>
							</li>
						</ul>
					</div>
					<div class="mod-box">
						<div class="mod-box-row orflow">
							<div id="chinaMap-chart" class="lf" style="width:480px;height:380px;"></div>
							<dl class="map-rank-list rt">
								<dt>
									<span class="col col-1">地域</span>
									<span class="col col-2"></span>
									<span class="col col-3">访客数</span>
									<span class="col col-4">支付买家数</span>
								</dt>
								<dd>
									<span class="col col-1">江苏</span>
									<span class="col col-2 num">2</span>
									<span class="col col-3">
										<span class="bar-percent" style="width: 100%">
											<i class="bar-calu"></i>
										</span>
									</span>
									<span class="col col-4 num">0</span>
								</dd>
								<dd>
									<span class="col col-1">江苏</span>
									<span class="col col-2 num">2</span>
									<span class="col col-3">
										<span class="bar-percent" style="width: 100%">
											<i class="bar-calu"></i>
										</span>
									</span>
									<span class="col col-4 num">0</span>
								</dd>
								<dd>
									<span class="col col-1">江苏</span>
									<span class="col col-2 num">2</span>
									<span class="col col-3">
										<span class="bar-percent" style="width: 100%">
											<i class="bar-calu"></i>
										</span>
									</span>
									<span class="col col-4 num">0</span>
								</dd>
								<dd>
									<span class="col col-1">江苏</span>
									<span class="col col-2 num">2</span>
									<span class="col col-3">
										<span class="bar-percent" style="width: 100%">
											<i class="bar-calu"></i>
										</span>
									</span>
									<span class="col col-4 num">0</span>
								</dd>
								<dd>
									<span class="col col-1">江苏</span>
									<span class="col col-2 num">2</span>
									<span class="col col-3">
										<span class="bar-percent" style="width: 100%">
											<i class="bar-calu"></i>
										</span>
									</span>
									<span class="col col-4 num">0</span>
								</dd>
							</dl>
						</div>
						<div class="mod-box-update-time">
							<span>
								更新时间：<em class="time">2017-09-20 09:37:02</em>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- 地域分布  end -->
		</div>
	</div>
	<!-- 实时来源 end -->

	<!-- 实时榜单 start -->
	<div class="w-1040 rt switch-wrap real-time-container">
		<div class="real-list-wrap backff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">实时榜单</h3>
				<span class="screen-subtitle">
					<span class="live-clock">
						更新时间：<i class="icon"></i><span class="data-value num">2017-09-18 14:19:35</span>
					</span>
				</span>
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
			</div>
			<!-- 商品榜 start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>商品榜
					</h4>
						<!-- <div class="sub-title rt mt-12">
							<span class="tip">点击快速更新数据面板</span>
							<button class="refresh">
								<i class="icon"></i>刷新
							</button>
						</div> -->
				</div>
				<div class="content" style="padding:0;">
					<div class="ui-switch">
						<ul class="ui-switch-menu">
							<li class="active ui-switch-item lf">
								<a href="javascript:;">访客数TOP50</a>
							</li>
							<li class="ui-switch-item lf">
								<a href="javascript:;">支付金额TOP50</a>
							</li>
						</ul>
					</div>
					<div class="input-search">
						<input type="text" name="" placeholder="请输入商品名称或ID">
						<i class="icon icon-search"></i>
					</div>
					<div class="mod-box">
						<div class="mod-box-row orflow">
							<div class="table orderable-table">
								<div class="table-header orflow">
									<span class="col title lf">商品名称</span>
									<span class="col pv lf">
										<p class="device">所有终端的</p>
										<p class="name">浏览量</p>
									</span>
									<span class="col uv lf">
										<p class="device">所有终端的</p>
										<p class="name">访客数</p>
									</span>
									<span class="col gmv lf">
										<p class="device">所有终端的</p>
										<p class="name">支付金额</p>
									</span>
									<span class="col buyerCnt lf">
										<p class="device">所有终端的</p>
										<p class="name">支付买家数</p>
									</span>
									<span class="col payRate lf">
										<p class="device">所有终端的</p>
										<p class="name">支付转化率</p>
									</span>
									<span class="col actions lf">操作</span>

								</div>
								<div class="table-body">
									<div class="row">
										<span class="col pic">
											<a href="javascript:;" target="_blank">
												<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
											</a>
										</span>
										<span class="col product">
											<p class="title">
												<a href="javascript:;">2017欧美新款冬季中长款连帽茧型贴布绣字母女式宽松休闲棉衣棉服</a>
											</p>
											<p class="datetime">发布时间：2017-07-12 14:20:10</p>
										</span>
										<span class="col pv num">1</span>
										<span class="col uv num">1</span>
										<span class="col gmv num">0.00</span>
										<span class="col buyerCnt num">0</span>
										<span class="col payRate num">0%</span>
										<span class="col actions">
											<a href="javascript:;" class="btn">
												实时趋势
											</a>
										</span>
									</div>
									<div class="row">
										<span class="col pic">
											<a href="javascript:;" target="_blank">
												<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
											</a>
										</span>
										<span class="col product">
											<p class="title">
												<a href="javascript:;">2017欧美新款冬季中长款连帽茧型贴布绣字母女式宽松休闲棉衣棉服</a>
											</p>
											<p class="datetime">发布时间：2017-07-12 14:20:10</p>
										</span>
										<span class="col pv num">1</span>
										<span class="col uv num">1</span>
										<span class="col gmv num">0.00</span>
										<span class="col buyerCnt num">0</span>
										<span class="col payRate num">0%</span>
										<span class="col actions">
											<a href="javascript:;" class="btn">
												实时趋势
											</a>
										</span>
									</div>
									<div class="row">
										<span class="col pic">
											<a href="javascript:;" target="_blank">
												<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
											</a>
										</span>
										<span class="col product">
											<p class="title">
												<a href="javascript:;">2017欧美新款冬季中长款连帽茧型贴布绣字母女式宽松休闲棉衣棉服</a>
											</p>
											<p class="datetime">发布时间：2017-07-12 14:20:10</p>
										</span>
										<span class="col pv num">1</span>
										<span class="col uv num">1</span>
										<span class="col gmv num">0.00</span>
										<span class="col buyerCnt num">0</span>
										<span class="col payRate num">0%</span>
										<span class="col actions">
											<a href="javascript:;" class="btn">
												实时趋势
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 商品榜 end -->
	</div>
	<!-- 实时榜单 end -->


	<!-- 实时访客 start -->
	<div class="w-1040 rt switch-wrap real-time-container">
		<div class="real-visitor-wrap backff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">实时访客</h3>
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
			</div>
			<div class="navbar-form operation-actions">
				<span class="form-key">访客类型：</span>
				<div class="group">
					<span class="radio selected">
						<span class="option"></span>
						<span class="name">仅淘宝会员</span>
						<span class="dian"></span>
					</span>
					<span class="radio">
						<span class="option"></span>
						<span class="name">全部</span>
						<span class="dian"></span>
					</span>
				</div>
				<span class="form-key">流量来源：</span>
				<div class="select-control ui-selector">
					<a href="javascript:;">
						<span class="ui-selector-val">全部</span>
						<span class="caret"></span>
					</a>
					<ul class="ui-selector-list select-control-list">
						<li class="ui-selector-item curr">
							<span>全部</span>
						</li>
						<li class="ui-selector-item">
							<span>手淘搜索</span>
						</li>
						<li class="ui-selector-item">
							<span>猫客搜索</span>
						</li>
						<li class="ui-selector-item">
							<span>直通车</span>
						</li>
						<li class="ui-selector-item">
							<span>支钻</span>
						</li>
						<li class="ui-selector-item">
							<span>淘宝客</span>
						</li>
						<li class="ui-selector-item">
							<span>聚划算</span>
						</li>
					</ul>
				</div>
				<span class="form-key">访问页面：</span>
				<div class="group">
					<span class="radio selected">
						<span class="option"></span>
						<span class="name">不限</span>
						<span class="dian"></span>
					</span>
					<span class="radio">
						<span class="option"></span>
						<span class="name">指定商品</span>
						<span class="dian"></span>
					</span>
					<span class="item-placeholder">
						<i class="live-icon-plus icon"></i>
					</span>
				</div>
			</div>
			<div class="navbar-text">
				<span class="desc">
					最近<span class="total-num num">5条</span>访问记录
					<a href="javascript:;" class="refresh-link">点击刷新</a>
				</span>
				<div class="update-time rt">
					更新时间
					<span class="data-value">2017-02-21 10:00:03</span>
				</div>
			</div>
			<div class="content">
				<div  class="table-container table-container-2">
					<table class="table">
						<thead>
							<tr>
								<th class="col-1">序号</th>
								<th class="col-2">访问时间</th>
								<th class="col-3">入店来源</th>
								<th class="col-4">被访页面</th>
								<th class="col-5">访客位置</th>
								<th class="col-6">访客编号</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-1 num">1</td>
								<td class="col-2">09:56:00</td>
								<td class="col-3">
									<p class="source text-truncate text1">
										<span>手淘扫一扫</span>
									</p>
								</td>
								<td class="col-4">
									<span class="td-vp-gooditem">
										<img class="td-vp-goodimg" src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10116/77/file/20170809/1502281247440688.jpg!60x60.jpg">
										<a href="javascript:;" class="td-vp-goodname text1">海飞丝去屑洗发露止痒呵护型200毫升400ML750ML</a>
									</span>
								</td>
								<td class="col-5">
									<p class="text-truncate city-name text1">四川省成都市</p>
								</td>
								<td class="col-6" style="position: relative;">
									<span class="user-link">访客3</span>
								</td>

							</tr>
						</tbody>
					</table>
				</div>
				<div class="pagination-contaienr rt">
					<span class="text-sum">
						总共5条访问记录
					</span>
				</div>
			</div>
		</div>
	</div>
	<!-- 实时访客 end -->

	<!-- 实时催付宝 start -->
	<div class="w-1040 rt switch-wrap real-time-container">
		<div class="real-hurryBao-wrap backff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">实时催付宝</h3>
				<span class="screen-subtitle">
					<span class="live-clock">
						更新时间：<i class="icon"></i><span class="data-value num">2017-09-18 14:19:35</span>
					</span>
				</span>
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
			</div>
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header">
						<i class="icon"></i>实时催付宝<i class="icon-tips"></i>
						<div class="curryBao-tipPop">
							<p>成为实时"催付买家"的条件：</p>
							<p>1.在本店下单且未支付</p>
							<p>2.未在其他店铺购买同类宝贝</p>
							<p>3.每天最多提供潜力指数TOP50的买家</p>
						</div>
					</h4>
				</div>
				<div class="content">
					<div class="mod-box">
						<div class="mod-box-row">
							<div class="table">
								<div class="table-header">
									<span class="col source">买家信息</span>
									<span class="col potentialIndex">潜力指数</span>
									<span class="col potentialOrder">潜力订单</span>
									<span class="col recentlyTime">最近订单时间</span>
									<span class="col orderState">订单状态</span>
									<span class="col actions">操作</span>
								</div>
								<div class="table-body">
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
	<!-- 实时催付宝 end -->
</div>
<div class="mask-dialog add-goods-dialog">
	<div class="ui-dialog-locator">
		<div class="ui-dialog-container">
			<div class="ui-dialog-header">
				<button type="button" class="ui-dialog-close close">×</button>
				<h4 class="ui-dialog-title">选择指定商品</h4>
			</div>
			<div class="ui-dialog-content">
				<div class="input-search product-input-search">
					<input type="text" class="" placeholder="请输入商品名称或ID" value="">
					<i class="icon-search"></i>
				</div>
				<div class="search-result">
					<div class="ui-message-empty">
						<p class="ui-message-content">
							<span class="noromal">
								<i class="icon"></i>
							</span>
							<span>暂无数据</span>
						</p>
					</div>
				</div>
				<div class="pagination-container"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
<script src="http://echarts.baidu.com/asset/map/js/china.js"></script>
<script type="text/javascript">
	var payMoneyChart = echarts.init(document.getElementById('payMoney-chart'));
	 // 指定图表的配置项和数据
	 var colors = ['#2062e6','#cecece']
	 var option = {
	 	title: {
	 		text: '所有终端-支付',
	 		textStyle: {
	 			fontSize: 16,
	 			color: '#333',
	 			fontWeight: 600
	 		}
	 	},
	 	tooltip: {
	 		trigger: 'axis',
	 		backgroundColor: '#fff',
	        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
	        borderColor: '#eee',
	        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
	        padding: 10,
	        textStyle: {
	        	color: '#333',
	        	fontSize: 12
	        },
	        axisPointer: {
	        	type: 'line',  // cross时为十字虚线 也可以为shadow
	        	lineStyle: {
	        		color: '#f96854'
	        	},
	            shadowStyle: {//默认值，
	                color: 'rgba(0,0,0,0.7)',//默认值，
	                type: 'default',//默认值，
	            }
	        },
	        formatter: function (params) {  // 0--今日  1---对比日
	        	return params[0].dataIndex === params[1].dataIndex ?
	        	params[1].name+" - "+params[0].dataIndex+':59'+'<br/>\
	        	<i class="icon" style="width:10px;height:10px;background-color:'+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[0].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[0].value+'.00'+'<br/>\
	        	<i class="icon" style="width:10px;height:10px;background-color:#fff;border:1px solid '+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[1].value+'.00'
	        	:
	        	params[1].name+" - "+params[1].dataIndex+':59'+'<br/>\
	        	<i class="icon" style="width:10px;height:10px;background-color:#fff;border:1px solid '+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[1].value+'.00'
		        }
		    },
           legend: {     // 图例
	           orent: 'vertical',
	           x: 'right',
	           data: [
		           {name: '今日'},
		           {name: '对比日'}
	           	],
           },
           grid: {
				top: '20%',
				bottom: '14%',
				left: '8%',
				right: '2%'
           },
           axisLabel: {
           		show: false
           },
            xAxis: {    //  x坐标轴
            	type: 'category',
            	data: ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00","24:00"],
                axisLine:{    //坐标轴颜色
                	lineStyle:{
                		color:'#bbb',
                		width: 2
                	}
                },
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
                	interval:  1 // x轴每隔5个显示一次文本
                },
                // axisLabel : {interval: 1},
                boundaryGap: false  // 控制 坐标轴两端 空白
            },
            yAxis: {
            	type: 'value',
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
            		textStyle: {
            			align: 'right',
            			color: '#333'
            		}
            	}
            },
            series: [
	            {
	            	name: '今日',
	            	type: 'line',
		                symbol: 'circle',  // 折点处空心圆
		                symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0],
		                			type: 'solid'
		                		}
		                	}
		                },
		                data: [0, 0, 0, 10, 0, 0, 0, 0, 10, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0]
		            },
		            {
		            	name: '对比日',
		            	type: 'line',
		                // symbol: 'diamond',
		                symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {
		                			color: colors[0],
		                			type: 'dashed'
		                		}
		                	}
		                },
		                data: [0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0]
		            }

	            ]
	        };
        // 使用刚指定的配置项和数据显示图表。
        payMoneyChart.setOption(option);

 	var visitorChart = echarts.init(document.getElementById('visitor-chart'));
	 // 指定图表的配置项和数据
	 var colors = ['#97b932']
	 var option = {
	 	title: {
	 		text: '所有终端-访客数',
	 		textStyle: {
	 			fontSize: 16,
	 			color: '#333',
	 			fontWeight: 600
	 		}
	 	},
	 	tooltip: {
	 		trigger: 'axis',
	 		backgroundColor: '#fff',
	        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
	        borderColor: '#eee',
	        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
	        padding: 10,
	        textStyle: {
	        	color: '#333',
	        	fontSize: 12
	        },
	        axisPointer: {
	        	type: 'line',  // cross时为十字虚线 也可以为shadow
	        	lineStyle: {
	        		color: '#f96854'
	        	},
	            shadowStyle: {//默认值，
                    color: 'rgba(0,0,0,0.7)',//默认值，
                    type: 'default',//默认值，
                }
            },
	        formatter: function (params) {  // 0--今日  1---对比日
	        	return params[0].dataIndex === params[1].dataIndex ?
	        	params[1].name+" - "+params[0].dataIndex+':59'+'<br/>\
	        	<i class="icon" style="width:10px;height:10px;background-color:'+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[0].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[0].value+'.00'+'<br/>\
	        	<i class="icon" style="width:10px;height:10px;background-color:#fff;border:1px solid '+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[1].value+'.00'
	        	:
	        	params[1].name+" - "+params[1].dataIndex+':59'+'<br/>\
	        	<i class="icon" style="width:10px;height:10px;background-color:#fff;border:1px solid '+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[1].value+'.00'
		        }
		    },
           legend: {     // 图例
           	orent: 'vertical',
           	x: 'right',
           	data: [
           	{name: '今日'},
           	{name: '对比日'}
           	],
           },
           grid: {
           	top: '20%',
           	bottom: '14%',
           	left: '8%',
           	right: '2%'
           },
           axisLabel: {
           	show: false
           },
            xAxis: {    //  x坐标轴
            	type: 'category',
            	data: ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00","24:00"],
                axisLine:{    //坐标轴颜色
                	lineStyle:{
                		color:'#bbb',
                		width: 2
                	}
                },
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
                	interval:  1 // x轴每隔5个显示一次文本
                },
                // axisLabel : {interval: 1},
                boundaryGap: false  // 控制 坐标轴两端 空白
            },
            yAxis: {
            	type: 'value',
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
            		textStyle: {
            			align: 'right',
            			color: '#333'
            		}
            	}
            },
            series: [
            {
            	name: '今日',
            	type: 'line',
	                symbol: 'circle',  // 折点处空心圆
	                symbolSize: 8,
	                showSymbol:false,
	                smooth: true,  // 平滑折线
	                itemStyle: {
	                	normal: {
	                		color: colors[0],
	                		lineStyle: {    // 线条颜色
	                			color: colors[0],
	                			type: 'solid'
	                		}
	                	}
	                },
	                data: [0, 0, 0, 10, 0, 0, 0, 0, 10, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0]
	            },
	            {
	            	name: '对比日',
	            	type: 'line',
	                // symbol: 'diamond',
	                symbolSize: 8,
	                showSymbol:false,
	                smooth: true,  // 平滑折线
	                itemStyle: {
	                	normal: {
	                		color: colors[0],
	                		lineStyle: {
	                			color: colors[0],
	                			type: 'dashed'
	                		}
	                	}
	                },
	                data: [0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 200]
	            }

	            ]
	        };
        // 使用刚指定的配置项和数据显示图表。
        visitorChart.setOption(option);

	var payBuyerChart = echarts.init(document.getElementById('payBuyer-chart'));
		 // 指定图表的配置项和数据
		 var colors = ['#ffa60b']
		 var option = {
		 	title: {
		 		text: '所有终端-访客数',
		 		textStyle: {
		 			fontSize: 16,
		 			color: '#333',
		 			fontWeight: 600
		 		}
		 	},
		 	tooltip: {
		 		trigger: 'axis',
		 		backgroundColor: '#fff',
		        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
		        borderColor: '#eee',
		        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
		        padding: 10,
		        textStyle: {
		        	color: '#333',
		        	fontSize: 12
		        },
		        axisPointer: {
		        	type: 'line',  // cross时为十字虚线 也可以为shadow
		        	lineStyle: {
		        		color: '#f96854'
		        	},
		            shadowStyle: {//默认值，
	                    color: 'rgba(0,0,0,0.7)',//默认值，
	                    type: 'default',//默认值，
	                }
	            },
		        formatter: function (params) {  // 0--今日  1---对比日
		        	return params[0].dataIndex === params[1].dataIndex ?
		        	params[1].name+" - "+params[0].dataIndex+':59'+'<br/>\
		        	<i class="icon" style="width:10px;height:10px;background-color:'+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[0].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[0].value+'.00'+'<br/>\
		        	<i class="icon" style="width:10px;height:10px;background-color:#fff;border:1px solid '+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[1].value+'.00'
		        	:
		        	params[1].name+" - "+params[1].dataIndex+':59'+'<br/>\
		        	<i class="icon" style="width:10px;height:10px;background-color:#fff;border:1px solid '+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[1].value+'.00'
		        }
		    },
           legend: {     // 图例
           	orent: 'vertical',
           	x: 'right',
           	data: [
           	{name: '今日'},
           	{name: '对比日'}
           	],
           },
           grid: {
           	top: '20%',
           	bottom: '14%',
           	left: '8%',
           	right: '2%'
           },
           axisLabel: {
           	show: false
           },
            xAxis: {    //  x坐标轴
            	type: 'category',
            	data: ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00","24:00"],
                axisLine:{    //坐标轴颜色
                	lineStyle:{
                		color:'#bbb',
                		width: 2
                	}
                },
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
                	interval:  1 // x轴每隔5个显示一次文本
                },
                // axisLabel : {interval: 1},
                boundaryGap: false  // 控制 坐标轴两端 空白
            },
            yAxis: {
            	type: 'value',
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
            		textStyle: {
            			align: 'right',
            			color: '#333'
            		}
            	}
            },
            series: [
            {
            	name: '今日',
            	type: 'line',
	                symbol: 'circle',  // 折点处空心圆
	                symbolSize: 8,
	                showSymbol:false,
	                smooth: true,  // 平滑折线
	                itemStyle: {
	                	normal: {
	                		color: colors[0],
	                		lineStyle: {    // 线条颜色
	                			color: colors[0],
	                			type: 'solid'
	                		}
	                	}
	                },
	                data: [0, 0, 0, 10, 0, 0, 0, 0, 10, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0]
	            },
	            {
	            	name: '对比日',
	            	type: 'line',
	                // symbol: 'diamond',
	                symbolSize: 8,
	                showSymbol:false,
	                smooth: true,  // 平滑折线
	                itemStyle: {
	                	normal: {
	                		color: colors[0],
	                		lineStyle: {
	                			color: colors[0],
	                			type: 'dashed'
	                		}
	                	}
	                },
	                data: [0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0]
	            }

	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        payBuyerChart.setOption(option);    

	var paySonChart = echarts.init(document.getElementById('paySon-chart'));
	 // 指定图表的配置项和数据
	 var colors = ['#f96854']
	 var option = {
	 	title: {
	 		text: '所有终端-支付子订单数',
	 		textStyle: {
	 			fontSize: 16,
	 			color: '#333',
	 			fontWeight: 600
	 		}
	 	},
	 	tooltip: {
	 		trigger: 'axis',
	 		backgroundColor: '#fff',
	        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
	        borderColor: '#eee',
	        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
	        padding: 10,
	        textStyle: {
	        	color: '#333',
	        	fontSize: 12
	        },
	        axisPointer: {
	        	type: 'line',  // cross时为十字虚线 也可以为shadow
	        	lineStyle: {
	        		color: '#f96854'
	        	},
	            shadowStyle: {//默认值，
                    color: 'rgba(0,0,0,0.7)',//默认值，
                    type: 'default',//默认值，
                }
            },
	        formatter: function (params) {  // 0--今日  1---对比日
	        	return params[0].dataIndex === params[1].dataIndex ?
	        	params[1].name+" - "+params[0].dataIndex+':59'+'<br/>\
	        	<i class="icon" style="width:10px;height:10px;background-color:'+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[0].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[0].value+'.00'+'<br/>\
	        	<i class="icon" style="width:10px;height:10px;background-color:#fff;border:1px solid '+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[1].value+'.00'
	        	:
	        	params[1].name+" - "+params[1].dataIndex+':59'+'<br/>\
	        	<i class="icon" style="width:10px;height:10px;background-color:#fff;border:1px solid '+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[1].value+'.00'
	        }
	    },
           legend: {     // 图例
           	orent: 'vertical',
           	x: 'right',
           	data: [
           	{name: '今日'},
           	{name: '对比日'}
           	],
           },
           grid: {
           	top: '20%',
           	bottom: '14%',
           	left: '8%',
           	right: '2%'
           },
           axisLabel: {
           	show: false
           },
            xAxis: {    //  x坐标轴
            	type: 'category',
            	data: ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00","24:00"],
                axisLine:{    //坐标轴颜色
                	lineStyle:{
                		color:'#bbb',
                		width: 2
                	}
                },
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
                	interval:  1 // x轴每隔5个显示一次文本
                },
                // axisLabel : {interval: 1},
                boundaryGap: false  // 控制 坐标轴两端 空白
            },
            yAxis: {
            	type: 'value',
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
            		textStyle: {
            			align: 'right',
            			color: '#333'
            		}
            	}
            },
            series: [
            {
            	name: '今日',
            	type: 'line',
	                symbol: 'circle',  // 折点处空心圆
	                symbolSize: 8,
	                showSymbol:false,
	                smooth: true,  // 平滑折线
	                itemStyle: {
	                	normal: {
	                		color: colors[0],
	                		lineStyle: {    // 线条颜色
	                			color: colors[0],
	                			type: 'solid'
	                		}
	                	}
	                },
	                data: [0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 4, 0, 0, 0]
	            },
	            {
	            	name: '对比日',
	            	type: 'line',
	                // symbol: 'diamond',
	                symbolSize: 8,
	                showSymbol:false,
	                smooth: true,  // 平滑折线
	                itemStyle: {
	                	normal: {
	                		color: colors[0],
	                		lineStyle: {
	                			color: colors[0],
	                			type: 'dashed'
	                		}
	                	}
	                },
	                data: [0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0]
	            }

	            ]
	        };
        // 使用刚指定的配置项和数据显示图表。
        paySonChart.setOption(option);

	var chinaMapChart = echarts.init(document.getElementById('chinaMap-chart'));
			// 指定图表的配置项和数据
			// var colors = ['#f96854']
			var option = {
			tooltip: {
			//          show: false //不显示提示标签
			    formatter: '{b}', //提示标签格式
			    backgroundColor:"#eee",//提示标签背景颜色
			    textStyle:{color:"#333"} //提示标签字体颜色
			},
			dataRange: {
				min: 0,
				max: 200,
				y: 130,
				itemGap: 5,
				color:['#ffa606','#97ce68','#6bcbca','#a3e4e3'],
			    text:['高','低'],           // 文本，默认为数值文本
			    calculable : true,
			    // splitNumber: 5
			},
			series: [{
				type: 'map',
				mapType: 'china',
				label: {
					normal: {
			            show: false,//显示省份标签
			            // textStyle:{color:"#c71585"}//省份标签字体颜色
			        },    
			        emphasis: {//对应的鼠标悬浮效果
			        	show: false,
			            // textStyle:{color:"#800080"}
			        } 
			    },
			    itemStyle: {
			    	normal: {
			            borderWidth: .5,//区域边框宽度
			            borderColor: '#fff',//区域边框颜色
			            areaColor:"#eee",//区域颜色
			        },
			        emphasis: {
			        	borderWidth: .5,
			        	borderColor: '#ffa508',
			        	areaColor:"#ffa508",
			        }
			    },
			    data:[
			        {name:'福建', value:120},
			        {name:'河北', value:3},
			        {name:'江苏', value:68},
			        {name:'安徽', value:15},
			        {name:'山东', value:3},
			        {name:'辽宁', value:78}
			        ]
			    }],
			};

			chinaMapChart.setOption(option);
        	chinaMapChart.on('mouseover', function (params) {
	        	var dataIndex = params.dataIndex;
	        	console.log(params);

    		});
    		// console.log(chinaMapChart._chartsMap["��-�0_series.map"]);
</script>
<script type="text/javascript">
	// 点击左侧导航nav
	$(".switch-wrap").eq(0).show();
	$(".nav .menu-list-inner .menu-item-inner").click(function(){
		var _this = $(this);
		var index = _this.index();
		_this.addClass("curr").siblings(".curr").removeClass("curr");
		$(".switch-wrap").hide();
		$(".switch-wrap").eq(index).show();
	})
	//  点击 switch-item ex:实时来源中的地域分布下的访客数排行 和 支付买家排行 切换 ui
	$(".navbar-panel .ui-switch .ui-switch-item").click(function(){
		$(this).addClass("active").siblings(".active").removeClass("active");
		/*$(this).parents(".ui-switch-menu").parents(".ui-switch").siblings(".mod-box").children(".mod-box-row").children(".map-rank-list").children("dd").children("col-3").children("bar-percent").children(".bar-calu").*/
	})
	// 点击 全部 PC 无线 切换
	$(".actions-tab .ui-switch-item").click(function(){
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
	})
	// 点击 单选按钮
	$(".group .radio").click(function(){
		$(this).addClass("selected").siblings(".selected").removeClass("selected");
	})
	
	// 点击无线端来源分布 自主访问 
	$(".device-table .table-body .source .open-btn").click(function(){
		var _this = $(this);
		_this.parents(".source").parents(".row").toggleClass("active");
		if(_this.parents(".source").parents(".row").siblings(".row").hasClass("active")){
			_this.parents(".source").parents(".row").siblings(".active").removeClass("active");
		}
	})
	// 移入到 催付宝 ？时
	$(".curryBao-switch .icon-tips").mouseenter(function(){
		$(".curryBao-tipPop").show()
	}).mouseleave(function(){
		$(".curryBao-tipPop").hide();
	})

	// 实时访客
	$(".real-visitor-wrap .navbar-form.operation-actions .group>span").click(function() {
		var _this = $(this);
		if(_this.siblings().hasClass("item-placeholder") || _this.hasClass("item-placeholder")) {
			if(_this.index() ===2 || _this.index() ===1) {
				$(".mask-dialog.add-goods-dialog").fadeIn(500);
			}	
		}
	})
	$(".group .live-icon-plus").click(function() {
		$(".mask-dialog.add-goods-dialog").fadeIn(500);
	})
	$(".mask-dialog.add-goods-dialog .close").click(function() {
		$(this).parents(".mask-dialog.add-goods-dialog").hide();
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
				if(_this.css("display") === 'block') {
					$(".select-control-list").hide();
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


	//  laydate.js
	laydate.render({
	  elem: '.date-selector .ui-selector-val',
	  showBottom: false
	});
</script>
</html>

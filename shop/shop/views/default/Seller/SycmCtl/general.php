<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋-- general-->
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
			<li class="nav-item lf curr">
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
<div class="main-wrap w-1430 mt-10">
	<div class="nav lf w-160">
		<div class="left-nav">
			<div class="topLogo">
				<div class="topLogoContent">
					<i class="icon"></i>
					<p>商品分析</p>
				</div>
			</div>
			<ul class="menu-list-inner">
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">商品概況</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">商品效果</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">异常商品</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">分类分析</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">单品分析</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">商品温度计</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">销量预测</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">单品服务分析</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- start -->
	<div class="w-1260  rt switch-wrap goods-container backff">
		<div class="screen-header h-50">
			<div class="switch-wrap-att orflow">
				<span class="lf curr">
					<a href="javascript:;">流量来源</a>
				</span>
				<span class="lf">
					<a href="javascript:;">店内路径</a>
				</span>
				<span class="lf ">
					<a href="javascript:;">流量去向</a>
				</span>
			</div>
			<ul class="rt device-choose-wrap orflow rt">
				<li class="device-noLine lf active"><a href="javascript:;">无线</a></li>
				<li class="device-PC lf"><a href="javascript:;">PC</a></li>
			</ul>
		</div>
		<!-- switdh 流量来源 start -->
		<div class="wrap-switch">
			<div class="flow-resource mod mt-10">
				<div class="wrap-title">
					<div class="title-lf lf">流量来源</div>
					<div class="select-control download rt">
						<a href="javascript:;">
							<i class="icon"></i>
							<span class="val">下载</span>
						</a>
						<div class="ui-download-panel ui-download-right select-control-list" style="display: none;">
							<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
							<p class="ui-download-btns clearfix"><a href="#" class="btn btn-blank btn-sm">取消</a><a href="#" class="btn btn-primary btn-sm">确定</a></p>
						</div>
					</div>
					<div class="select-control ui-combopicker navbar-combopicker rt">
						<a class="btn btn-combopicker btn-blank" href="javascript:;">指标<span class="caret"></span></a>
						<div class="ui-combopicker-panel ui-combopicker-right select-control-list">
							<div class="ui-combopicker-groups">
								<div class="group-wrapper">
									<span class="group-title">店铺数据：</span>
									<div class="group clearfix">
										<span class="checkbox disabled">
											<span class="option"></span>
											<span class="name">曝光量</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">引导入店浏览量</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">商城点击占比</span>
										</span>
										<span class="checkbox selected">
											<span class="option"></span>
											<span class="name">全网点击率</span>
										</span>
										<span class="checkbox selected">
											<span class="option"></span>
											<span class="name">全网商品数</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">全网下单转化率</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">直通车平均点击单价</span>
										</span>
									</div>
								</div>
								<div class="group-wrapper">
									<span class="group-title">全网数据：</span>
									<div class="group clearfix">
										<span class="checkbox disabled">
											<span class="option"></span>
											<span class="name">曝光量</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">引导入店浏览量</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">商城点击占比</span>
										</span>
										<span class="checkbox selected">
											<span class="option"></span>
											<span class="name">全网点击率</span>
										</span>
										<span class="checkbox selected">
											<span class="option"></span>
											<span class="name">全网商品数</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">全网下单转化率</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">直通车平均点击单价</span>
										</span>
									</div>
								</div>
							</div>
							<div class="ui-combopicker-btns"><span class="message">已选择4项</span><a href="#" class="btn btn-primary btn-sm">确定</a></div>
						</div>
					</div>
					<div class="date-text rt">2017-10-01 ~ 2017-10-08</div>
					<div class="select-control ui-selector rt">
						<a href="javascript:;">
							<span class="ui-selector-value">日期</span>
							<span class="caret icon"></span>
						</a>
						<ul class="ui-selector-list select-control-list" style="display: none;">
							<li class="ui-selector-item last-1 curr">
								<span>最近1天</span>
							</li>
							<li class="ui-selector-item last-7">
								<span>最近7天</span>
							</li>
							<li class="ui-selector-item day">
								<span>日</span>
							</li>
							<!-- <li class="ui-selector-item week">
								<span>周</span>
							</li> -->
							<li class="ui-selector-item month">
								<span>月</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="navbar-panel">
					<div class="content">
						<div class="ui-switch">
							<ul class="ui-switch-menu">
								<li class="ui-switch-item lf">
									<a href="javascript:;">我的</a>
								</li>
								<li class="ui-switch-item lf active">
									<a href="javascript:;">同行</a>
								</li>
							</ul>
						</div>
						<div class="ebase-card-content">
							<div class="ebase-table-root">
								<table class="table">
									<thead class="thead">
										<tr>
											<th class="th col-0 col-pageName" style="width:15%;text-align: left;">流量来源</th>
											<th class="th col-1 col-uv.value" style="width:20%;text-align: right;">访客数</th>
											<th class="th col-2 col-uv.radio" style="width:20%;text-align: right;">下单买家数</th>
											<th class="th col-3 col-uv.radio" style="width:20%;text-align: right;">下单转化率</th>
											<th class="th col-4 col-operate" style="width:25%;text-align: right;">操作</th>
										</tr>
									</thead>
									<tbody>
										<tr class="tr parent-tr parent-tr0 active">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">
												<div class="icon-wrap" style="margin-right: 5px;width:12px;height: 12px;overflow: hidden;display: inline-block;">
													<i class="icon add">+</i><i class="icon increace">-</i>
												</div>自主访问
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="width:20%;padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%
															<span class="r-trend up">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%
															<span class="r-trend down">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:25%;text-align: right">
												<a href="javascript:;">趋势</a>
											</td>
										</tr>
										<!-- 子 -->
										<tr class="tr child-trn child-tr0">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">淘内免费fws
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="width:20%;padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:25%;text-align: right">
												<div>
													<div style="height: 20px;line-height: 20px;">
														<span class="orderName">详情</span>
													</div>
													<div style="height: 20px;line-height: 20px;">
														<a href="javascript:;">趋势</a>
														<span class="orderName goods-effect">商品效果</span>
													</div>
												</div>
												<div class="popup-content-root" style="top: -108px; right: -74px; display: none;">
													<div class="popup-content">
														<div>
															<div class="orderPanelOrderPanel-content">
																<p class="orderInfo">
																	<span>亲shabi，您还未订购流量纵横，暂时无法使用！</span>
																</p>
																<div class="orderButton">
																	<a href="javascript:;" target="_blank" class="btn">立即订购</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr class="tr child-trn child-tr0">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">淘内免费
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="width:20%;padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%
															<span class="r-trend down">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:25%;text-align: right">
												<div>
													<div style="height: 20px;line-height: 20px;">
														<span class="orderName">详情</span>
													</div>
													<div style="height: 20px;line-height: 20px;">
														<a href="javascript:;">趋势</a>
														<span class="orderName goods-effect">商品效果</span>
													</div>
												</div>
											</td>
										</tr>
										<tr class="tr child-trn child-tr0">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">淘内免费
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="width:20%;padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:25%;text-align: right">
												<div>
													<div style="height: 20px;line-height: 20px;">
														<span class="orderName">详情</span>
													</div>
													<div style="height: 20px;line-height: 20px;">
														<a href="javascript:;">趋势</a>
														<span class="orderName goods-effect">商品效果</span>
													</div>
												</div>
											</td>
										</tr>
										<tr class="tr child-trn child-tr0">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">淘内免费
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="width:20%;padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:25%;text-align: right">
												<div>
													<div style="height: 20px;line-height: 20px;">
														<span class="orderName">详情</span>
													</div>
													<div style="height: 20px;line-height: 20px;">
														<a href="javascript:;">趋势</a>
														<span class="orderName goods-effect">商品效果</span>
													</div>
												</div>
												<div class="popup-content-root">
													<div class="popup-content">
														<div>
															<div class="orderPanelOrderPanel-content">
																<p class="orderInfo">
																	<span>亲shabi，您还未订购流量纵横，暂时无法使用！</span>
																</p>
																<div class="orderButton">
																	<a href="javascript:;" target="_blank" class="btn">立即订购</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</td>
										</tr>
										
										<tr class="tr parent-tr parent-tr1">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">
												<div class="icon-wrap" style="margin-right: 5px;width:12px;height: 12px;overflow: hidden;display: inline-block;">
													<i class="icon add">+</i><i class="icon increace">-</i>
												</div>淘内免费
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
												<a href="javascript:;">趋势</a>
											</td>
										</tr>
										<!-- 子 -->
										<tr class="tr child-trn child-tr1">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">淘内免费
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:25%;text-align: right">
												<div>
													<div style="height: 20px;line-height: 20px;">
														<span class="orderName">详情</span>
													</div>
													<div style="height: 20px;line-height: 20px;">
														<a href="javascript:;">趋势</a>
														<span class="orderName goods-effect">商品效果</span>
													</div>
												</div>
												
											</td>
										</tr>
										<tr class="tr child-trn child-tr1">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">淘内免费
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:25%;text-align: right">
												<div>
													<div style="height: 20px;line-height: 20px;">
														<span class="orderName">详情</span>
													</div>
													<div style="height: 20px;line-height: 20px;">
														<a href="javascript:;">趋势</a>
														<span class="orderName goods-effect">商品效果</span>
													</div>
												</div>
											</td>
										</tr>
										<tr class="tr child-trn child-tr1">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">淘内免费
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:25%;text-align: right">
												<div>
													<div style="height: 20px;line-height: 20px;">
														<span class="orderName">详情</span>
													</div>
													<div style="height: 20px;line-height: 20px;">
														<a href="javascript:;">趋势</a>
														<span class="orderName goods-effect">商品效果</span>
													</div>
												</div>
											</td>
										</tr>

										<tr class="tr parent-tr parent-tr2">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">
												<div class="icon-wrap" style="margin-right: 5px; width: 12px; height: 12px; overflow: hidden; display: inline-block; visibility: hidden;">
													<i class="icon add">+</i><i class="icon increace">-</i>
												</div>自主访问
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="width:20%;padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:25%;text-align: right">
												<a href="javascript:;">趋势</a>
											</td>
										</tr>
										<tr class="tr parent-tr parent-tr3">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">
												<div class="icon-wrap" style="margin-right: 5px; width: 12px; height: 12px; overflow: hidden; display: inline-block; visibility: hidden;">
													<i class="icon add">+</i><i class="icon increace">-</i>
												</div>自主访问
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="width:20%;padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:25%;text-align: right">
												<a href="javascript:;">趋势</a>
											</td>
										</tr>
										<tr class="tr parent-tr parent-tr4">
											<td class="td col-0 col-pageName col-level-0" style="width:15%;text-align: left;">
												<div class="icon-wrap" style="margin-right: 5px; width: 12px; height: 12px; overflow: hidden; display: inline-block; visibility: hidden;">
													<i class="icon add">+</i><i class="icon increace">-</i>
												</div>自主访问
											</td>
											<td class="td col-1 col-uv DetailIndexTd col-level-0" style="width:20%;padding-right: 0;text-align: right;">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-2 col-crtByrCnt DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-3 col-crtRate DetailIndexTd col-level-0" style="width:20%;padding-right:0;text-align: right">
												<div class="ebase-DetailIndex-root">
													<span class="ebase-Detail-selfValue">
														<span class="ebase-value">43</span>
													</span>
													<span class="ebase-Detail-changeRate" style="position: absolute;">
														<span class="ebase-value">43%</span>
														<i class="icon"></i>
													</span>
												</div>
											</td>
											<td class="td col-4 col-operate col-level-0" style="width:25%;text-align: right">
												<a href="javascript:;">趋势</a>
											</td>
										</tr>
									</tbody>						
								</table>
								<!-- <div class="no-data-message">
									<div class="ui-message-empty">
										<p class="ui-message-content">
											<span class="noromal">
												<i class="icon"></i>
											</span>
											<span>暂无</span>
										</p>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="shop-accept mod mt-10" style="display: block;">
				<div class="wrap-title">
					<div class="title-lf lf">流量入口</div>
					<div class="select-control download rt">
						<a href="javascript:;">
							<i class="icon"></i>
							<span class="val">下载</span>
						</a>
						<div class="ui-download-panel ui-download-right select-control-list" style="display: none;">
							<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
							<p class="ui-download-btns clearfix"><a href="#" class="btn btn-blank btn-sm">取消</a><a href="#" class="btn btn-primary btn-sm">确定</a></p>
						</div>
					</div>
					<div class="date-text rt">2017-10-01 ~ 2017-10-08</div>
					<div class="select-control ui-selector rt">
						<a href="javascript:;">
							<span class="ui-selector-value">日期</span>
							<span class="caret icon"></span>
						</a>
						<ul class="ui-selector-list select-control-list" style="display: none;">
							<li class="ui-selector-item last-1 curr">
								<span>最近1天</span>
							</li>
							<li class="ui-selector-item last-7">
								<span>最近7天</span>
							</li>
							<li class="ui-selector-item day">
								<span>日</span>
							</li>
							<!-- <li class="ui-selector-item week">
								<span>周</span>
							</li> -->
							<li class="ui-selector-item month">
								<span>月</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="accesible-detail orflow">
					<h4 style="font-size: 12px;margin-left:30px;font-weight: 600;margin-top: 20px;">访客分布</h4>
					<div style="position: relative;">
						<div id="visitor-disribution-chart" class="visitor-disribution-chart" style="width: 320px; height: 320px;"></div>
						<dl class="desc-wrapper sans-serif">
							<dt class="title" style="color: rgb(32, 98, 230);">商品详情页</dt>
							<dd class="percent" style="color: rgb(32, 98, 230);">100.00%</dd>
							<dd class="visitor"><span class="num">1</span>个访客</dd>
						</dl>
					</div>
				</div>
				<div class="shop-index-top">
					<div class="shop-list shop-list-fix">
						<div class="detail-title">
							<h3 class="shop-title" style="background-color: rgb(32,98,230);">
								店铺首页TOP20
							</h3>
						</div>
						<ul class="list">
							<li class="i-title">
								<p class="order lf">排名</p>
								<div class="enter lf">
									<span class="top-enter">TOP引流入口</span>
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</div>
								<p class="pv lf">访客数</p>
								<p class="rate lf">跳出率</p>
							</li>
							<div class="detail-list">
								<li class="item">
									<p class="order lf">					
										1			
									</p>
									<p class="enter lf">
										<a href="javascript:;">http://taoshang168.taobao.com/</a>
									</p>
									<p class="pv num lf">4</p>
									<p class="rate num lf">20.00%</p>
								</li>
							</div>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- switdh 流量来源 end -->

		<!-- switdh 店内路径 start -->
		<div class="wrap-switch" style="display: none;">
			<div class="shop-inner-wrap">
				<div class="shop-inner-content mod mt-10 backff">
					<div class="wrap-title">
						<div class="title-lf lf">店内路径</div>
						<div class="operation-actions rt">
							<div class="rt wrap-app">
								<span class="name-app">淘宝app</span>
								<span class="name-app curr">天猫app</span>
								<span class="name-app">无线wap</span>
							</div>
							<div class="date-text rt">2017-10-01 ~ 2017-10-08</div>
							<div class="select-control ui-selector rt">
								<a href="javascript:;">
									<span class="ui-selector-value">日期</span>
									<span class="caret icon"></span>
								</a>
								<ul class="ui-selector-list select-control-list" style="display: none;">
									<li class="ui-selector-item last-1 curr">
										<span>最近1天</span>
									</li>
									<li class="ui-selector-item last-7">
										<span>最近7天</span>
									</li>
									<li class="ui-selector-item last-30">
										<span>最近30天</span>
									</li>
									<li class="ui-selector-item day">
										<span>日</span>
									</li>
									<!-- <li class="ui-selector-item week">
										<span>周</span>
									</li> -->
									<li class="ui-selector-item month">
										<span>月</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="accesible-detail orflow">
						<div class="nav-blank">
							<ul class="nav-blank-menu orflow">
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf active">
									<a href="javascript:;">
										<p class="name">店铺微淘页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
							</ul>
						</div>
						<ul class="detail-list">
							<div class="one-page orflow">
								<div class="table-responsive lf">
									<table class="table">
										<thead>
											<tr>
												<th class="source">来源</th>
												<th class="uv">访客数</th>
												<th class="rate">访客数占比</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="source">店铺首页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
											</tr>
											<tr>
												<td class="source">店铺首页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
											</tr>
											<tr>
												<td class="source">店铺首页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
											</tr>
											<tr>
												<td class="source">店铺首页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
											</tr>
											<tr>
												<td class="source">店页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
											</tr>
											<tr>
												<td class="source">店铺首页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="gap lf">
									<i class="icon flow-orange"></i>
								</div>
								<ul class="lf midway1">
									<li class="card-no-shadow active">
										<ul class="spacious">
											<li>
												<div class="title">店铺首页</div>
												<div class="visitor">
													访客数：0
												</div>
											</li>
										</ul>
									</li>
									<li class="card-link">
										<a href="javascript:;">查看页面模块分析</a>
									</li>
								</ul>
								<div class="gap lf">
									<i class="icon flow-blue"></i>
								</div>
								<div class="table-responsive lf">
									<table class="table flow-table-green">
										<thead>
											<tr>
												<th class="source">去向</th>
												<th class="uv">访客数</th>
												<th class="rate">访客数占比</th>
												<th class="payAmt">支付金额</th>
												<th class="patAmtRate">支付金额占比</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="source">店铺首页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
												<td class="payAmt">0</td>
												<td class="patAmtRate">-</td>
											</tr>
											<tr>
												<td class="source">店铺首页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
												<td class="payAmt">0</td>
												<td class="patAmtRate">-</td>
											</tr>
											<tr>
												<td class="source">店铺首页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
												<td class="payAmt">0</td>
												<td class="patAmtRate">-</td>
											</tr>
											<tr>
												<td class="source">店铺首页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
												<td class="payAmt">0</td>
												<td class="patAmtRate">-</td>
											</tr>
											<tr>
												<td class="source">店铺首页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
												<td class="payAmt">0</td>
												<td class="patAmtRate">-</td>
											</tr>
											<tr>
												<td class="source">店铺首页</td>
												<td class="uv num">0</td>
												<td class="rate num">0.00%</td>
												<td class="payAmt">0</td>
												<td class="patAmtRate">-</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</ul>
					</div>
				</div>
				<div class="web-visited-rank mod mt-10 backff">
					<div class="wrap-title">
						<div class="title-lf lf">页面访问排行</div>
						<div class="operation-actions rt">
							<div class="select-control download rt">
								<a href="javascript:;">
									<i class="icon"></i>
									<span class="val">下载</span>
								</a>
								<div class="ui-download-panel ui-download-right select-control-list" style="display: none;">
									<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
									<p class="ui-download-btns clearfix"><a href="#" class="btn btn-blank btn-sm">取消</a><a href="#" class="btn btn-primary btn-sm">确定</a></p>
								</div>
							</div>
							<div class="rt wrap-app">
								<span class="name-app">淘宝app</span>
								<span class="name-app curr">天猫app</span>
								<span class="name-app">无线wap</span>
							</div>
							<div class="date-text rt">2017-12-03 ~ 2017-12-09</div>
							<div class="select-control ui-selector rt">
								<a href="javascript:;">
									<span class="ui-selector-value">日期</span>
									<span class="caret icon"></span>
								</a>
								<ul class="ui-selector-list select-control-list" style="display: none;">
									<li class="ui-selector-item last-1 curr">
										<span>最近1天</span>
									</li>
									<li class="ui-selector-item last-7">
										<span>最近7天平均</span>
									</li>
									<li class="ui-selector-item day">
										<span>日</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="accesible-detail orflow">
						<div class="nav-blank">
							<ul class="nav-blank-menu orflow">
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf active">
									<a href="javascript:;">
										<p class="name">店铺微淘页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
							</ul>
						</div>
						<ul class="detail-list list-table">
							<li class="item-title orflow">
								<div class="order lf">排名</div>
								<div class="visitor-page lf">访问页面</div>
								<div class="pv lf">浏览量</div>
								<div class="uv lf">访客数</div>
								<div class="stay-time lf">平均停留时长</div>
							</li>
							<li class="item-content orflow">
								<div class="order lf">
									<span class="square num square-top">1</span>
								</div>
								<div class="visitor-page lf">
									<span class="d-url">店铺首页</span>
								</div>
								<div class="pv lf">1</div>
								<div class="uv lf">1</div>
								<div class="stay-time lf">1.00</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- switdh 店内路径 end -->

		<!-- switdh 流量去向 start -->
		<div class="wrap-switch" style="display: none;">
			<div class="flow-where-wrap mt-10">
				<div class="leave-rank mod backff">
					<div class="wrap-title">
						<div class="title-lf lf">离开页面排行</div>
						<div class="operation-actions rt">
							<div class="select-control download rt">
								<a href="javascript:;">
									<i class="icon"></i>
									<span class="val">下载</span>
								</a>
								<div class="ui-download-panel ui-download-right select-control-list" style="display: none;">
									<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
									<p class="ui-download-btns clearfix"><a href="#" class="btn btn-blank btn-sm">取消</a><a href="#" class="btn btn-primary btn-sm">确定</a></p>
								</div>
							</div>
							<div class="date-text rt">2017-12-03 ~ 2017-12-09</div>
							<div class="select-control ui-selector rt">
								<a href="javascript:;">
									<span class="ui-selector-value">日期</span>
									<span class="caret icon"></span>
								</a>
								<ul class="ui-selector-list select-control-list" style="display: none;">
									<li class="ui-selector-item last-1 curr">
										<span>最近1天</span>
									</li>
									<li class="ui-selector-item last-7">
										<span>最近7天平均</span>
									</li>
									<li class="ui-selector-item day">
										<span>日</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="accesible-detail orflow">
						<div class="nav-blank">
							<ul class="nav-blank-menu orflow">
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf active">
									<a href="javascript:;">
										<p class="name">店铺微淘页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
								<li class="nav-blank-item lf">
									<a href="javascript:;">
										<p class="name">店铺首页</p>
										<p class="value">
											<span>访客数</span>
											<span class="num">0</span>
										</p>
										<p class="rate">
											<span>占比</span>
											<span class="num">0.00%</span>
										</p>

									</a>
								</li>
							</ul>
						</div>
						<ul class="detail-list list-table">
							<li class="item-title orflow">
								<div class="order lf">排名</div>
								<div class="visitor-page lf">访问页面</div>
								<div class="pv lf">离开访客数</div>
								<div class="uv lf">离开浏览量</div>
								<div class="stay-time lf">离开流量占比</div>
							</li>
							<li class="item-content orflow mt-10">
								<div class="order lf">
									<span class="square num square-top">1</span>
								</div>
								<div class="visitor-page lf">
									<a href="javascript:;">http://taoshang168.taobao.com/</a>
								</div>
								<div class="pv lf">1</div>
								<div class="uv lf">1</div>
								<div class="stay-time lf">1.00</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="leave-go-rank mod mt-10 backff">
					<div class="wrap-title">
						<div class="title-lf lf">离开页面去向排行</div>
						<div class="operation-actions rt">
							<div class="select-control download rt">
								<a href="javascript:;">
									<i class="icon"></i>
									<span class="val">下载</span>
								</a>
								<div class="ui-download-panel ui-download-right select-control-list" style="display: none;">
									<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
									<p class="ui-download-btns clearfix"><a href="#" class="btn btn-blank btn-sm">取消</a><a href="#" class="btn btn-primary btn-sm">确定</a></p>
								</div>
							</div>
							<div class="date-text rt">2017-12-03 ~ 2017-12-09</div>
							<div class="select-control ui-selector rt">
								<a href="javascript:;">
									<span class="ui-selector-value">日期</span>
									<span class="caret icon"></span>
								</a>
								<ul class="ui-selector-list select-control-list" style="display: none;">
									<li class="ui-selector-item last-1 curr">
										<span>最近1天</span>
									</li>
									<li class="ui-selector-item last-7">
										<span>最近7天平均</span>
									</li>
									<li class="ui-selector-item day">
										<span>日</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="no-data-message">
						<div class="ui-message-empty">
							<p class="ui-message-content">
								<span class="noromal">
									<i class="icon"></i>
								</span>
								<span>该日期下暂无数据，换个日期吧！</span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- switdh 流量去向 end -->







</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
<script type="text/javascript">
	var visitorDisributionChart = echarts.init(document.getElementById('visitor-disribution-chart'));
	  	var colors = ["#2062e6","#f3d024"];
	  	option = {
		    series: [
	        {
	          // name:'访问来源',	
	          type:'pie',
	          radius: ['80%', '50%'],
	          avoidLabelOverlap: false,
	          label: {
	            normal: {
	              show: false,
	              position: 'center'
	            }
	          },
	          labelLine: {
	            normal: {
	                show: false
	            }
	          },
	          legend: {     // 图例
	           orent: 'vertical',
			           x: 'left',
			           data: [
				           {name: '店铺首页'},
				           {name: '店铺分类页'}
			           	]
		           },
	          data:[
	            {
	            	value:335, 
	            	name:'店铺首页',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 10,
	            			borderColor: 'transparent',
	            			color: colors[0]
	            		}
	            	}
	            },
	            {
	            	value:0, 
	            	name:'店铺分类页',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[1]
	            		}
	            	}
	            }
	          ]
	      	}
	  		]
			};
			visitorDisributionChart.setOption(option);
</script>


<script type="text/javascript">
	lay('.select-control .select-control-list .day').on('click', function(){
		// var _this = this.parentNode.parentNode.previousSibling
		var _this = $(this).parents(".ui-selector").siblings(".date-text").get(0);
	  laydate.render({
	    elem: _this,
	    format: 'yyyy-MM-dd ~ yyyy-MM-dd',
	    show: true,
	    closeStop: '.date-text',
	    trigger: 'dbclick',
	    showBottom: false
	  });
	});
	lay('.select-control .select-control-list .month').on('click', function(){
		var _this = $(this).parents(".ui-selector").siblings(".date-text").get(0);
	  laydate.render({
	    elem: _this,
	    format: 'yyyy-MM-dd ~ yyyy-MM-dd',
	    type: 'month',
	    show: true,
	    closeStop: '.date-text',
	    trigger: 'dbclick',
	    showBottom: false,
	     change: function(value, date){ //监听日期被切换
	      	var elem = this.elem;
	      	var end = laydate.getEndDate(date.month, date.year);
	      	var year = date.year;
	      	var month = date.month;
	      	month = String(date.month).length === 1 ? '0'+month : month;
	      	$(elem).text(year+'-'+month+'-01 ~ '+year+'-'+month+'-'+end);
	      	$(".layui-laydate").hide();
	      }
	  });
	});
	/*lay('.select-control .select-control-list .week').on('click', function(){
		var _this = $(this).parents(".ui-selector").siblings(".date-text").get(0);
	  laydate.render({
	    elem: _this,
	    show: true,
	    closeStop: '.date-text',
	    format: 'yyyy-MM-dd',
        min:'2017-11-26',
        max:'2017-12-30',
        value:'2017-12-03 ~ 2017-12-09',
        showBottom: false,
        range:'~',
        week: 1,
        trigger: 'dbclick',
        change: function(value, date) {
	      	var elem = this.elem;
	      	$(elem).text(value);
	      	$(".layui-laydate").hide();
        }
	  });
	});*/
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
	
	// 点击 流量来源 店内路径 流量去向 tab
	$(".wrap-switch").eq(0).show();
	$(".goods-container .switch-wrap-att span a").click(function(){
		var _this = $(this);
		_this.parents("span").addClass("curr").siblings(".curr").removeClass("curr");
		var index = _this.parents("span").index();
		$(".goods-container .wrap-switch").hide();
		$(".goods-container .wrap-switch").eq(index).show();
	})


	// 流量来源----- 判断有没有加减标
	$(".flow-resource .table .tr.parent-tr").each(function(){
		var _this = $(this);
		if( typeof(_this.next().attr("class")) === 'string' && _this.next().attr("class").indexOf("parent-tr") !==-1 || typeof(_this.next().attr("class")) === 'undefined'){
			_this.children(".td").children(".icon-wrap").css({"visibility":"hidden"});
		}
	})
	// 点击流量来源里面的----同行下面的加号、减号
	$(".table .td.col-0 .icon").click(function(){
		var _this = $(this);
		_this.parents(".icon-wrap").parents(".td").parents("tr").toggleClass("active");
		var classN = _this.parents(".icon-wrap").parents(".td").parents().attr("class");
		var index = classN.slice(-1);
		if(index==='e'){
			index = classN.split(" ")[2].slice(-1);
		}
		if(_this.parents(".icon-wrap").parents(".td").parents("tr").hasClass("active")){
			$(".table .child-tr"+index).show();
		}else{
			$(".table .child-tr"+index).hide();
		}
	})

	$(".nav-blank .nav-blank-menu li").click(function() {
		$(this).addClass("active").siblings(".active").removeClass("active")
	})
	// 无线 or  PC
	$(".device-choose-wrap li").click(function(){
		$(this).addClass("active").siblings(".active").removeClass("active");
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

	

	// 移入技巧图标 
	$(".icon-tips").mouseenter(function(){
		$(this).siblings(".tips-guide-wrap").show();
	}).mouseleave(function(){
		$(this).siblings(".tips-guide-wrap").hide();
	})

	// 点击商品概况--商品排行概览 switch
	$(".navbar-panel .ui-switch .ui-switch-item").click(function(){
		$(this).addClass("active").siblings(".active").removeClass("active");
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

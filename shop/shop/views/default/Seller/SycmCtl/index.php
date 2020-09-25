<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/swiper.css">
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/sycm_index.css">
<div class="basic-div" style="width:100%;min-height: 112px;">
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
					<li class="lf cell message">
						<a href="javascript:;">
							<i class="icon"></i>
							消息
						</a>
						<i class="new icon"></i>
						<div class="oui-popup-content">
							<div>
								<div>
									<div class="switch-container">
										<span class="oui-tabswitch promptMessageTab">
											<span class="oui-tabswitch-item oui-tabswitch-item-active">数据异常</span>
										</span>
									</div>
									<div class="messageContainer abnormalData">
										<div>
											<div class="message-banner">2017-12-11 至 2017-12-17 数据异常</div>
											<div class="item">
												<span class="dynamicType">全店</span>
												<span class="dynamicContent">访客数较上周下跌33.33%</span>
											</div>
											<div class="item">
												<span class="dynamicType">排行</span>
												<span class="dynamicContent">店铺行业排名下跌5679名</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="oui-arrow-container"><i class="oui-arrow oui-arrow-outer"></i><i class="oui-arrow oui-arrow-inner"></i></div>
						</div>
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
				<li class="nav-item lf curr">
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
</div>
<div class="main-wrap w-1430 mt-10 ovflow index-container">
	<!-- 实时概况 -->
	<div class="update-wrap module">
		<div class="update-left lf w-990">
			<div class="title ovflow">
				<span class="title-txt lf">实时概况</span>
				<div class="title-rt orflow">
					<a href="javascript:;" class="rt">实时直播<i class="icon"></i></a>
					<div class="update-time rt">
						更新时间：
						<span class="date">2017-09-07</span>
						<span class="time-point">16:30:00</span>
					</div>
				</div>
			</div>
			<div class="part-left lf w-590">
				<div class="payAmt clearfix">
					<div class="index-cell lf">
						<p class="index-name">
							<i class="icon"></i>
							<span>支付金额(元)</span>
						</p>
						<p class="index-value">0</p>
						<p class="compare-value">
							<span class="compare-name">昨日全天</span>
							<span>0</span>
						</p>
					</div>
					<p class="legend rt">
						<span class="today">
							<span class="square"></span>
							<span class="name">今日</span>
						</span>
						<span class="compare">
							<span class="square"></span>
							<span class="name">昨日</span>
						</span>
					</p>
				</div>
				<div class="chart-wrap">
					<div id="time-state" style="width:515px;height:180px;"></div>
				</div>
			</div>
			<div class="part-right rt w-400">
				<ul class="update-cell">
					<li class="cell lf w-200">
						<p class="cell-name">
							<i class="icon"></i>
							<span>访客数</span>
						</p>
						<p class="cell-value">46</p>
						<p class="yesterday-data">昨日全天<span>655</span></p>
					</li>
					<li class="cell lf w-200">
						<p class="cell-name">
							<i class="icon"></i>
							<span>访客数</span>
						</p>
						<p class="cell-value">46</p>
						<p class="yesterday-data">昨日全天<span>655</span></p>
					</li>
					<li class="cell lf w-200">
						<p class="cell-name">
							<i class="icon"></i>
							<span>访客数</span>
						</p>
						<p class="cell-value">46</p>
						<p class="yesterday-data">昨日全天<span>655</span></p>
					</li>
					<li class="cell lf w-200">
						<p class="cell-name">
							<i class="icon"></i>
							<span>访客数</span>
						</p>
						<p class="cell-value">46</p>
						<p class="yesterday-data">昨日全天<span>655</span></p>
					</li>
				</ul>
			</div>
		</div>
		<div class="update-right rt w-430">
			<div class="area-wrap">
				<div class="swiper-container">
					<div class="swiper-wrapper">
				        <div class="swiper-slide">
				        	<div class="title ovflow">
								<span class="title-txt lf">实时访客榜</span>
								<div class="title-rt orflow">
									<a href="javascript:;" class="rt">实时访单<i class="icon"></i></a>
								</div>
							</div>
							<div class="chart-wrap">
								<table class="table">
									<thead class="table-thead">
										<tr>
											<th class="table-th col-0">排名</th>
											<th class="table-th col-1">商品名称</th>
											<th class="table-th col-2" style="text-align:right">访客数</th>
										</tr>
									</thead>
									<tbody class="table-tbody">
										<tr>
											<td class="table-td col-0">
												1
											</td>
											<td class="table-td col-1">
												<div class="shop-id">
													<a class="shop-id-img" href="javascript:;">
														<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
													</a>
													<div class="shop-info lf">
														<p class="shop-name">
															<a href="javascript:;">苏宁易购旗舰店</a>
														</p>
													</div>
												</div>
											</td>
											<td class="table-td col-2" style="text-align:right;">
												1
											</td>
										</tr>
										<tr>
											<td class="table-td col-0">
												1
											</td>
											<td class="table-td col-1">
												<div class="shop-id">
													<a class="shop-id-img" href="javascript:;">
														<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
													</a>
													<div class="shop-info lf">
														<p class="shop-name">
															<a href="javascript:;">苏宁易购旗舰店</a>
														</p>
													</div>
												</div>
											</td>
											<td class="table-td col-2" style="text-align:right;">
												1
											</td>
										</tr>
										<tr>
											<td class="table-td col-0">
												1
											</td>
											<td class="table-td col-1">
												<div class="shop-id">
													<a class="shop-id-img" href="javascript:;">
														<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
													</a>
													<div class="shop-info lf">
														<p class="shop-name">
															<a href="javascript:;">苏宁易购旗舰店</a>
														</p>
													</div>
												</div>
											</td>
											<td class="table-td col-2" style="text-align:right;">
												1
											</td>
										</tr>
									</tbody>
								</table>
							</div>
				        </div>
				        <div class="swiper-slide">
							<div class="chart-wrap">
								<div class="part-top clearfix">
									<div class="title ovflow">
										<span class="title-txt lf">店铺概况</span>
										<div class="update-time rt">
											统计时间：
											<span class="date">2017-09-07</span>
										</div>
									</div>
									<div class="month-rank main-index">
										<p class="index-title">近30天支付金额排行</p>
										<div class="clearfix">
											<p class="index-detail pull-left">
												<span class="index-value">196345</span><span class="unit">名</span>
											</p>
											<p class="cate-rank pull-left">
												<span class="detail">第一层级</span><i class="icon icon-tips"></i>
											</p>
										</div>
										<p class="index-change-rate">
											<span class="title-sub">较前日</span>
											<span class="changeCnt">
												<i class="icon"></i>
												<span class="title-sub">23名</span>
											</span>
										</p>

									</div>
									<div class="trend-container">
										<div id='right-top-chart' style="width:100%;height:90px;"></div>
										<div class="hy">
											行业:<span>大家电</span>
										</div>
									</div>
								</div>
								<div class="part-bottom">
									<div class="title ovflow">
										<span class="title-txt lf">本月销售目标进度</span>
										<div class="title-rt orflow">
											<a href="javascript:;" class="rt">配置目标<i class="icon"></i></a>
										</div>
									</div>
									<div class="progress-texts clearfix">
										<p class="percentage">0.27%</p>
										<p class="progress-text">
											<span class="value">
												<span class="number">
													1.336
												</span>
											</span>
											<span>&nbsp;/&nbsp;</span>
											<span class="value">
												<span class="number">20
													<span class="unit">万</span>
												</span>
											</span>
										</p>
									</div>
									<div class="progress-bar-wrap">
										<div class="progress-bar-base"></div>
										<div class="progress-bar" style="width:10%"></div>
									</div>
								</div>
							</div>							
				        </div>
				    </div>
				    <!-- 如果需要分页器 -->
				    <div class="swiper-pagination"></div>
				</div>
			</div>
			<div class="rank-pop-wrap">
				<div>
					<div class="level-map-tooltip">
						<div class="oui-popup-content">
							<div>
								<div class="level-map-desc">
									<ul class="level-list clearfix">
										<li class="level-item curr">
											<p class="title-level">第一层级</p>
											<p class="bar"></p>
										</li>
										<li class="level-item">
											<p class="title-level">第二层级</p>
											<p class="bar"></p>
										</li>
										<li class="level-item">
											<p class="title-level">第三层级</p>
											<p class="bar"></p>
										</li>
										<li class="level-item">
											<p class="title-level">第四层级</p>
											<p class="bar"></p>
										</li>
										<li class="level-item">
											<p class="title-level">第五层级</p>
											<p class="bar"></p>
										</li>
										<li class="level-item">
											<p class="title-level">第六层级</p>
											<p class="bar"></p>
										</li>
									</ul>
									<ul class="level-price clearfix">
										<li class="level-item first">0.0元</li>
										<li class="level-item">4800.0元</li>
										<li class="level-item">5.6万元</li>
										<li class="level-item">21.0万元</li>
										<li class="level-item">59.5万元</li>
										<li class="level-item">158.8万元</li>
										<li class="level-item last">∞</li>
									</ul>
									<p class="level-top mt-12">以上层级与排名根据淘尚168商城集市商家最近30天的财付宝成交金额计算</p>
								</div>
							</div>
						</div>
					</div>
					<div class="link"></div>
				</div>
			</div>
		</div>
	</div>
	<!--  运营市场 or 管理视窗 -->
	<div class="two-wrap">
		<div class="two-wrap-title">
			<div class="title-switch lf">
				<span class="business-switch switch curr">
					<a href="javascript:;">
						<i class="icon"></i>
						运营视窗
					</a>
				</span>
				<span class="manage-switch switch">
					<a href="javascript:;">
						<i class="icon"></i>
						管理视窗
					</a>
				</span>
			</div>
			<div class="ac rt">
				<i class="before-icon">&lt;</i>
				<i class="before-icon disable">&gt;</i>
			</div>
			<div class="update-option rt">
				<!-- <p class="lf update">更新时间：<span>2017-02-26&nbsp;&nbsp;09:45:36</span></p> -->
				<p class="rt option"><span>最近1天(2017-10-11 ~ 2017-10-11)</span><i class="icon caret"></i></p>
				<div class="date-wrap">
					<ul>
						<!-- <li class="datePicker-item active realtime">
							<span class="datePicker-rangeText">实时</span>
							<span class="datePicker-rangeTime rt"></span>
						</li> -->
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
		<!-- 运营视窗 -->
		<div class="business-wrap">
			<!-- 整体看板 -->
			<div class="all-board line-1-wrap orflow module">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">整体看板</span>
					</div>
					<div class="chart-switch rt">
						<span class="switch curr">图表</span>
						<span class="sprite">
							<i class="sp"></i>
						</span>
						<span class="switch">表格</span>
					</div>
				</div>
				<div class="switch-chart-wrap switch-wrap orflow">
					<div class="line-1">
						<div class="index-cell">
							<div class="cell-list orflow">
								<div class="swiper-container">
									<div class="swiper-wrapper">
										<div class="swiper-slide">
											<div class="cell-item lf curr">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value down">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value down">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value down">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="cell-item lf">
												<span class="sub-title">跳失率</span>
												<p class="value">80.20%</p>
												<div class="compare mt-16">
													<p class="compare-item">
														<span class="compare-name">较前一日</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
													<p class="compare-item">
														<span class="compare-name">较上周同期</span>
														<span class="compare-value up">2.85%
															<span class="r-trend">
																<i class="icon icon-trend"></i>
															</span>
														</span>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="swiper-button-prev"></div>
    								<div class="swiper-button-next"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="chart-wrap">
						<div id="all-board-chart" style="width:1360px;height:320px;margin:0 auto;"></div>
						<div class="filter-wrap">
							<p class="filter-sign">
								已选 <span class="selected">3</span>/7
							</p>
							<a href="javascript:;">重置</a>
						</div>
					</div>
				</div>
				<div class="switch-table-wrap switch-wrap orflow">
					<div class="table-left-wrap lf">
						<table class="table-left">
							<thead class="table-left-thead">
								<tr class="table-left-thead-tr">
									<th style="border-right: 1px solid #d0e1ff;width:69px;">&nbsp;</th>
									<th style="width:139px;">&nbsp;</th>
								</tr>
							</thead>
							<tbody class="table-left-tbody orflow">
								<tr class="table-left-tbody-tr">
									<td rowspan="6" class="table-left-tbody-td td-name" style="border-top: none;">交易</td>
									<td class="table-left-tbody-td leading" style="border-top:none;">支付金额(元)</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">销售完成进度</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">支付件数</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">客单价</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">支付转化率</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">老客金额占比</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td rowspan="7" class="table-left-tbody-td td-name">流量</td>
									<td class="table-left-tbody-td leading">访客数</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">流量完成进度</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">淘内免费</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">付费流量</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">自主访问</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">淘外流量</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">其他</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td rowspan="4" class="table-left-tbody-td td-name">推广</td>
									<td class="table-left-tbody-td leading">营销推广金额</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">直通车</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">钻石展位</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">淘宝客</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td rowspan="2" class="table-left-tbody-td td-name">退款</td>
									<td class="table-left-tbody-td leading">成功退款金额</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">成功退款率</td>
								</tr>	
							</tbody>
						</table>
					</div>
					<div class="table-right-wrap lf">
						<table class="table-right">
							<thead class="table-right-thead">
								<tr>
									<th class="col-0">
										<span class="col-first-span lf">2017-09-12</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
									<th class="col-1">
										<span class="col-first-span lf">2017-09-11</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
									<th class="col-2">
										<span class="col-first-span lf">2017-09-10</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
									<th class="col-3">
										<span class="col-first-span lf">2017-09-09</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
									<th class="col-4">
										<span class="col-first-span lf">2017-09-08</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
									<th class="col-5">
										<span class="col-first-span lf">2017-09-07</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
								</tr>
							</thead>
							<tbody class="table-right-tbody">
								<tr class="leading" style="border-top:none;">
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">-45.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">-</span>
										<span class="col-second-span lf">-</span>
									</td>
									<td>
										<span class="col-first-span lf">0</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">-</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr class="leading">
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">-445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">0</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">-</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">-</span>
										<span class="col-second-span lf">-</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-5.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr class="leading">
									<td>
										<span class="col-first-span lf">-</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr class="leading">
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">-</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
				</div> 
			</div>
			<!-- 流量看板 -->
			<div class="flow-board line-1-wrap module" style="clear: both;">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">流量看板</span>
					</div>
					<div class="more rt">
						流量分析<i class="icon"></i>
					</div>
					<span class="sub-title rt" style="margin-right:50px;">
						<span class="curr">无线</span>
						<span>PC</span>
					</span>
				</div>
				<div class="line-1 orflow">
					<div class="line-lf lf w-860">
						<p class="title">一级流量走向</p>
						<div class="chart-wrap">
							<div id="business-level-1-flow-chart" style="width:860px;height:220px;"></div>
						</div>
					</div>
					<div class="line-rt rt w-500">
						<p class="title">
							<span class="lf">二级流量来源</span>
							<!-- <span class="sub-title rt">
								<span class="curr">无线</span>
								<span>PC</span>
							</span> -->
						</p>
						<div class="chart-wrap">
							<table class="table">
								<thead class="table-thead">
									<tr>
										<th class="table-th col-0">排名</th>
										<th class="table-th col-1">流量来源</th>
										<th class="table-th col-2" style='text-align: right'>访客数96</th>
										<th class="table-th col-3" style='text-align: right'>下单转化率</th>

									</tr>
								</thead>
								<tbody class="table-tbody">
									<tr>
										<td class="table-td col-0">
											1
										</td>
										<td class="table-td col-1">
											手淘搜索9
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											2
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											3
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
				<div class="line-1 orflow">
					<div class="w-860 lf">
						<div class="line-lf lf w-280 mt-16">
							<!-- <p class="title">成功退款金额(元)</p> -->
							<div class="index-cell">
								<ul class="cell-list orflow">
									<li class="cell-item lf">
										<span class="sub-title">跳失率</span>
										<p class="value">80.20%</p>
										<div class="compare mt-16">
											<p class="compare-item">
												<span class="compare-name">较前一日</span>
												<span class="compare-value">2.85%
													<span class="r-tend up">
														<i class="icon icon-trend"></i>
													</span>
												</span>
											</p>
											<p class="compare-item">
												<span class="compare-name">较上周同期</span>
												<span class="compare-value">2.85%
													<span class="r-tend up">
														<i class="icon icon-trend"></i>
													</span>
												</span>
											</p>
										</div>
									</li>
									<!-- <li class="cell-item lf">
										<span class="sub-title">上周</span>
										<p class="value">0</p>
									</li> -->
								</ul>
							</div>
							<div class="chart-wrap">
								<div id="meet-chart" style="width:280px;height:130px;"></div>
							</div>
						</div>
						<div class="line-lf lf w-280 mt-16">
							<!-- <p class="title">成功退款金额(元)</p> -->
							<div class="index-cell">
								<ul class="cell-list orflow">
									<li class="cell-item lf">
										<span class="sub-title">人均浏览量</span>
										<p class="value">1.20</p>
										<div class="compare mt-16">
											<p class="compare-item">
												<span class="compare-name">较前一日</span>
												<span class="compare-value">2.85%
													<span class="r-tend up">
														<i class="icon icon-trend"></i>
													</span>
												</span>
											</p>
											<p class="compare-item">
												<span class="compare-name">较上周同期</span>
												<span class="compare-value">2.85%
													<span class="r-tend up">
														<i class="icon icon-trend"></i>
													</span>
												</span>
											</p>
										</div>
									</li>
									<!-- <li class="cell-item lf">
										<span class="sub-title">上周</span>
										<p class="value">0</p>
									</li> -->
								</ul>
							</div>
							<div class="chart-wrap">
								<div id="person-watch-chart" style="width:280px;height:130px;"></div>
							</div>
						</div>
						<div class="line-lf rt w-280 mt-16">
							<!-- <p class="title">成功退款率</p> -->
							<div class="index-cell">
								<ul class="cell-list orflow">
									<li class="cell-item lf">
										<span class="sub-title">平均停留时长</span>
										<p class="value">10.36秒</p>
										<div class="compare mt-16">
											<p class="compare-item">
												<span class="compare-name">较前一日</span>
												<span class="compare-value">2.85%
													<span class="r-tend up">
														<i class="icon icon-trend"></i>
													</span>
												</span>
											</p>
											<p class="compare-item">
												<span class="compare-name">较上周同期</span>
												<span class="compare-value">2.85%
													<span class="r-tend up">
														<i class="icon icon-trend"></i>
													</span>
												</span>
											</p>
										</div>
									</li>
									<!-- <li class="cell-item lf">
										<span class="sub-title">上周平均</span>
										<p class="value">3.0%</p>
									</li> -->
								</ul>
							</div>
							<div class="chart-wrap">
								<div id="stop-time-chart" style="width:280px;height:130px;"></div>
							</div>
						</div>
					</div>
					<div class="line-rt rt w-500">
						<p class="title">搜索词排行</p>
						<div class="chart-wrap">
							<table class="table">
								<thead class="table-thead">
									<tr>
										<th class="table-th col-0">排名</th>
										<th class="table-th col-1">流量来源</th>
										<th class="table-th col-2" style='text-align: right'>访客数</th>
										<th class="table-th col-3" style='text-align: right'>下单转化率</th>
									</tr>
								</thead>
								<tbody class="table-tbody">
									<tr>
										<td class="table-td col-0">
											1
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											2
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											3
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											4
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											5
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- 转化看板 -->
			<div class="transform-board line-1-wrap module" style="clear: both;padding-bottom: 30px;">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">转化看板</span>
					</div>
					<div class="more rt">
						商品分析<i class="icon"></i>
					</div>
				</div>
				<div class="line-1 orflow">
					<ul class="transform-list">
						<li class="lf transform-item orflow">
							<div id="loop-1" class="lf" style="width:260px;height: 250px;"></div>	
							<div class="loop-wrap lf">
								<div class="loop-name">
									收藏人数
									<p class="loop-value">0</p>
								</div>						
								<div class="loop-name">
									收藏次数
									<p class="loop-value">0</p>
								</div>	
							</div>
							<div class="compare">
								<span class="compare-name">较前一日</span>
								<span class="compare-value">
									0.4%<i class="icon"></i>
								</span>
							</div>
						</li>
						<li class="lf transform-item orflow">
							<div id="loop-2" class="lf" style="width:300px;height: 250px;"></div>	
							<div class="loop-wrap lf">
								<div class="loop-name">
									加购人数
									<p class="loop-value">0</p>
								</div>						
								<div class="loop-name">
									加购件数
									<p class="loop-value">0</p>
								</div>	
							</div>
							<div class="compare">
								<span class="compare-name">较前一日</span>
								<span class="compare-value">
									0.4%<i class="icon"></i>
								</span>
							</div>
						</li>
						<li class="lf transform-item orflow">
							<div id="loop-3" class="lf" style="width:300px;height: 250px;"></div>	
							<div class="loop-wrap lf">
								<div class="loop-name">
									支付买家数
									<p class="loop-value">0</p>
								</div>						
								<div class="loop-name">
									支付件数
									<p class="loop-value">0</p>
								</div>	
							</div>
							<div class="compare">
								<span class="compare-name">较前一日</span>
								<span class="compare-value">
									0.4%<i class="icon"></i>
								</span>
							</div>
						</li>
					</ul>
				</div>
				<div class="line-1 orflow hy-board">
					<div class="goods-col lf"  style="width:450px;padding:0 40px;">
						<div class="title">收藏榜</div>
						<div class="col-content">
							<div class="root">
								<div class="container">
									<div class="table-container">
										<div class="chart-wrap">
											<table class="table">
												<thead class="thead">
													<tr>
														<!-- <th class="table-th col-0">排名</th> -->
														<th class="table-th col-1">商品</th>
														<th class="table-th col-2" style="text-align: right;">支付子订单</th>
													</tr>
												</thead>
												<tbody class="tbody">
													<tr style="border-top:none;">
														<!-- <td class="table-td col-0">
															1
														</td> -->
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name text2">
																		<a href="javascript:;">苏金额附近的地方纪委几分地无法交付及房价未来经济法IE我经济危机为宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr style="border-top:none;">
														<!-- <td class="table-td col-0">
															1
														</td> -->
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name text2">
																		<a href="javascript:;">苏金额附近的地方纪委几分地无法交付及房价未来经济法IE我经济危机为宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr style="border-top:none;">
														<!-- <td class="table-td col-0">
															1
														</td> -->
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name text2">
																		<a href="javascript:;">苏金额附近的地方纪委几分地无法交付及房价未来经济法IE我经济危机为宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr style="border-top:none;">
														<!-- <td class="table-td col-0">
															1
														</td> -->
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name text2">
																		<a href="javascript:;">苏金额附近的地方纪委几分地无法交付及房价未来经济法IE我经济危机为宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr style="border-top:none;">
														<!-- <td class="table-td col-0">
															1
														</td> -->
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name text2">
																		<a href="javascript:;">苏金额附近的地方纪委几分地无法交付及房价未来经济法IE我经济危机为宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="page-container"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="goods-col lf" style="width:450px;padding:0 40px;">
						<div class="title">加购榜</div>
						<div class="col-content">
							<div class="root">
								<div class="container">
									<div class="table-container">
										<div class="chart-wrap">
											<table class="table">
												<thead class="thead">
													<tr>
														<!-- <th class="table-th col-0">排名</th> -->
														<th class="table-th col-1">商品</th>
														<th class="table-th col-2" style="text-align: right;">架构件数</th>
													</tr>
												</thead>
												<tbody class="tbody">
													<tr style="border-top:none;">
														<!-- <td class="table-td col-0">
															1
														</td> -->
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name text2">
																		<a href="javascript:;">苏金额附近的地方纪委几分地无法交付及房价未来经济法IE我经济危机为宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="page-container"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="goods-col lf"  style="width:450px;padding:0 40px;">
						<div class="title">支付榜</div>
						<div class="col-content">
							<div class="root">
								<div class="container">
									<div class="table-container">
										<div class="chart-wrap">
											<table class="table">
												<thead class="thead">
													<tr>
														<!-- <th class="table-th col-0">排名</th> -->
														<th class="table-th col-1">商品</th>
														<th class="table-th col-2" style="text-align: right;">支付件数</th>
													</tr>
												</thead>
												<tbody class="tbody">
													<tr style="border-top:none;">
														<!-- <td class="table-td col-0">
															1
														</td> -->
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name text2">
																		<a href="javascript:;">苏金额附近的地方纪委几分地无法交付及房价未来经济法IE我经济危机为宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="page-container"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 客单看板 -->
			<div class="kd-board line-1-wrap module" style="clear: both;">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">客单看板</span>
					</div>
				</div>
				<div class="line-1 orflow">
					<div class="goods-col lf"  style="width:680px;padding:0 40px;">
						<div class="title">买家构成-客单分布</div>
						<div class="col-content">
							<div class="root">
								<div class="container">
									<div class="table-container">
										<div class="chart-wrap">
											<!-- <table class="table">
												<thead class="thead">
													<tr>
														<th class="table-th col-1">商品</th>
														<th class="table-th col-2" style="text-align: right;">支付子订单</th>
													</tr>
												</thead>
												<tbody class="tbody"></tbody>
											</table> -->
											<div class="no-data-message">
												<div class="ui-message-empty">
													<p class="ui-message-content">
														<span class="noromal">
															<i class="icon"></i>
														</span>
														<span>数据为空</span>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="page-container"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="goods-col lf" style="width:680px;padding:0 40px;">
						<div class="title">买家构成-支付件数分布</div>
						<div class="col-content">
							<div class="root">
								<div class="container">
									<div class="table-container">
										<div class="chart-wrap">
											<!-- <table class="table">
												<thead class="thead">
													<tr>
														<th class="table-th col-1">商品</th>
														<th class="table-th col-2" style="text-align: right;">架构件数</th>
													</tr>
												</thead>
												<tbody class="tbody"></tbody>
											</table> -->
											<div class="no-data-message">
												<div class="ui-message-empty">
													<p class="ui-message-content">
														<span class="noromal">
															<i class="icon"></i>
														</span>
														<span>数据为空</span>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="page-container"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="w-800 lf">
						<div class="line-lf lf w-400 mt-16">
							<!-- <p class="title">成功退款金额(元)</p> -->
							<div class="index-cell">
								<ul class="cell-list orflow">
									<li class="cell-item lf">
										<span class="sub-title">人均支付件数</span>
										<p class="value">-</p>
										<div class="compare mt-16">
											<p class="compare-item">
												<span class="compare-name">较前一日</span>
												<span class="compare-value">-
													<span class="r-trend up">
														<i class="icon icon-trend"></i>
													</span>
												</span>
											</p>
											<p class="compare-item">
												<span class="compare-name">较上周同期</span>
												<span class="compare-value">-
													<span class="r-trend up">
														<i class="icon icon-trend"></i>
													</span>
												</span>
											</p>
										</div>
									</li>
									<!-- <li class="cell-item lf">
										<span class="sub-title">上周</span>
										<p class="value">0</p>
									</li> -->
								</ul>
							</div>
							<div class="chart-wrap">
								<div id="person-avg-pay-chart" style="width:400px;height:260px;"></div>
							</div>
						</div>
						<div class="line-lf lf w-400 mt-16">
							<!-- <p class="title">成功退款金额(元)</p> -->
							<div class="index-cell">
								<ul class="cell-list orflow">
									<li class="cell-item lf">
										<span class="sub-title">连带率</span>
										<p class="value">-</p>
										<div class="compare mt-16">
											<p class="compare-item">
												<span class="compare-name">较前一日</span>
												<span class="compare-value">2.85%
													<span class="r-trend">
														<i class="icon"></i>
													</span>
												</span>
											</p>
											<p class="compare-item">
												<span class="compare-name">较上周同期</span>
												<span class="compare-value">2.85%
													<span class="r-trend down">
														<i class="icon icon-trend"></i>
													</span>
												</span>
											</p>
										</div>
									</li>
									<!-- <li class="cell-item lf">
										<span class="sub-title">上周</span>
										<p class="value">0</p>
									</li> -->
								</ul>
							</div>
							<div class="chart-wrap">
								<div id="joint-rate-Chart" style="width:400px;height:260px;"></div>
							</div>
						</div>
					</div>
					<div class="line-rt lf w-570 alife-dt-card-sycm-match-goods-table">
						<p class="title">搭配推荐</p>
						<div class="chart-wrap">
							<table class="table">
								<thead class="table-thead">
									<tr>
										<th class="table-th col-0">商品</th>
										<th class="table-th col-1" style="text-align: right;">共同购买人数</th>
										<th class="table-th col-2" style='text-align: right;'>客单价</th>
									</tr>
								</thead>
								<tbody class="table-tbody">
									<tr class="ebase-Table__tbodyTr">
										<td class="ebase-Table__td col-0 col-item i undefined" style="text-align: left;">
											<div class="match-item">
												<a href="javascript:;"" target="_blank" class="match-link">
													<img src="//img.alicdn.com/bao/uploaded/i1/2683428516/TB2Q.KRawL8F1JjSszgXXarfpXa_!!2683428516.jpg_64x64.jpg" class="match-img">
													<span class="item-title">沙宣炫亮彩护洗发露2</span>
												</a>
												<a href="javascript:;" target="_blank" class="match-link">
													<img src="//img.alicdn.com/bao/uploaded/i1/2683428516/TB27DlcXh5GJuJjSZFrXXcDYXXa_!!2683428516.jpg_64x64.jpg" class="match-img">
													<span class="item-title">沙宣清盈顺柔洗发露2</span>
												</a>
											</div>
										</td>
										<td class="ebase-Table__td col-1 col-commBuyCnt  undefined" style="text-align: right;">0</td>
										<td class="ebase-Table__td col-2 col-payPct  undefined" style="text-align: right;">0.00</td>
									</tr>
									<tr class="ebase-Table__tbodyTr">
										<td class="ebase-Table__td col-0 col-item i undefined" style="text-align: left;">
											<div class="match-item">
												<a href="javascript:;"" target="_blank" class="match-link">
													<img src="//img.alicdn.com/bao/uploaded/i1/2683428516/TB2Q.KRawL8F1JjSszgXXarfpXa_!!2683428516.jpg_64x64.jpg" class="match-img">
													<span class="item-title">沙宣炫亮彩护洗发露2</span>
												</a>
												<a href="javascript:;" target="_blank" class="match-link">
													<img src="//img.alicdn.com/bao/uploaded/i1/2683428516/TB27DlcXh5GJuJjSZFrXXcDYXXa_!!2683428516.jpg_64x64.jpg" class="match-img">
													<span class="item-title">沙宣清盈顺柔洗发露2</span>
												</a>
											</div>
										</td>
										<td class="ebase-Table__td col-1 col-commBuyCnt  undefined" style="text-align: right;">0</td>
										<td class="ebase-Table__td col-2 col-payPct  undefined" style="text-align: right;">0.00</td>
									</tr>
									<tr class="ebase-Table__tbodyTr">
										<td class="ebase-Table__td col-0 col-item i undefined" style="text-align: left;">
											<div class="match-item">
												<a href="javascript:;"" target="_blank" class="match-link">
													<img src="//img.alicdn.com/bao/uploaded/i1/2683428516/TB2Q.KRawL8F1JjSszgXXarfpXa_!!2683428516.jpg_64x64.jpg" class="match-img">
													<span class="item-title">沙宣炫亮彩护洗发露2</span>
												</a>
												<a href="javascript:;" target="_blank" class="match-link">
													<img src="//img.alicdn.com/bao/uploaded/i1/2683428516/TB27DlcXh5GJuJjSZFrXXcDYXXa_!!2683428516.jpg_64x64.jpg" class="match-img">
													<span class="item-title">沙宣清盈顺柔洗发露2</span>
												</a>
											</div>
										</td>
										<td class="ebase-Table__td col-1 col-commBuyCnt  undefined" style="text-align: right;">0</td>
										<td class="ebase-Table__td col-2 col-payPct  undefined" style="text-align: right;">0.00</td>
									</tr>
								</tbody>
							</table>
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
			</div>
			<!-- 评价看板 -->
			<div class="comments-board line-1-wrap module" style="clear: both;">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">评价看板</span>
					</div>
					<div class="more rt">
						流量分析<i class="icon"></i>
					</div>
				</div>
				<div class="line-1 orflow">
					<div class="w-860 lf">
						<div class="orflow">
							<div class="line-lf lf w-280 mt-16">
								<div class="index-cell">
									<ul class="cell-list orflow">
										<li class="cell-item lf">
											<span class="sub-title">描述相符评分</span>
											<p class="value">5.00000</p>
											<div class="compare mt-16">
												<p class="compare-item">
													<span class="compare-name">较前一日</span>
													<span class="compare-value">2.85%
														<span class="r-tend up">
															<i class="icon icon-trend"></i>
														</span>
													</span>
												</p>
											</div>
										</li>
										<!-- <li class="cell-item lf">
											<span class="sub-title">上周</span>
											<p class="value">0</p>
										</li> -->
									</ul>
								</div>
							</div>
							<div class="line-lf lf w-280 mt-16">
								<div class="index-cell">
									<ul class="cell-list orflow">
										<li class="cell-item lf">
											<span class="sub-title">卖家服务评分</span>
											<p class="value">5.00000</p>
											<div class="compare mt-16">
												<p class="compare-item">
													<span class="compare-name">较前一日</span>
													<span class="compare-value">2.85%
														<span class="r-tend up">
															<i class="icon icon-trend"></i>
														</span>
													</span>
												</p>
											</div>
										</li>
										<!-- <li class="cell-item lf">
											<span class="sub-title">上周</span>
											<p class="value">0</p>
										</li> -->
									</ul>
								</div>
							</div>
							<div class="line-lf lf w-280 mt-16">
								<div class="index-cell">
									<ul class="cell-list orflow">
										<li class="cell-item lf">
											<span class="sub-title">物流服务评分</span>
											<p class="value">5.00000</p>
											<div class="compare mt-16">
												<p class="compare-item">
													<span class="compare-name">较前一日</span>
													<span class="compare-value">2.85%
														<span class="r-tend up">
															<i class="icon icon-trend"></i>
														</span>
													</span>
												</p>
											</div>
										</li>
										<!-- <li class="cell-item lf">
											<span class="sub-title">上周</span>
											<p class="value">0</p>
										</li> -->
									</ul>
								</div>
							</div>
						</div>
						<div id="comments-charts" style="width:860px;height:360px;"></div>
					</div>
					<div class="line-rt rt w-500">
						<p class="title">负面评价榜</p>
						<div class="chart-wrap">
							<table class="table">
								<thead class="table-thead">
									<tr>
										<th class="table-th col-0">排名</th>
										<th class="table-th col-1">商品</th>
										<th class="table-th col-2" style='text-align: right'>负面评价数</th>
									</tr>
								</thead>
								<tbody class="table-tbody"></tbody>
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
			</div>
			<!-- 行业排行 -->
			<div class="hy-board line-1-wrap module">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">行业排行</span>
					</div>
					<div class="more rt">
						市场行情<i class="icon"></i>
					</div>
				</div>
				<div class="line-1 orflow">
					<div class="shop-col lf">
						<div class="title">店铺</div>
						<div class="col-content">
							<div class="root">
								<div class="container">
									<div class="table-container">
										<div class="chart-wrap">
											<table class="table">
												<thead class="thead">
													<tr>
														<th class="table-th col-0">排名</th>
														<th class="table-th col-1">店铺</th>
														<th class="table-th col-2" style="text-align: right;">交易指数</th>
													</tr>
												</thead>
												<tbody class="tbody">
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="page-container"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="goods-col lf" style="margin:0 85px;">
						<div class="title">商品</div>
						<div class="col-content">
							<div class="root">
								<div class="container">
									<div class="table-container">
										<div class="chart-wrap">
											<table class="table">
												<thead class="thead">
													<tr>
														<th class="table-th col-0">排名</th>
														<th class="table-th col-1">商品</th>
														<th class="table-th col-2" style="text-align: right;">支付子订单</th>
													</tr>
												</thead>
												<tbody class="tbody">
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name text2">
																		<a href="javascript:;">苏金额附近的地方纪委几分地无法交付及房价未来经济法IE我经济危机为宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="page-container"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="shop-col lf">
						<div class="title">搜索词</div>
						<div class="col-content">
							<div class="root">
								<div class="container">
									<div class="table-container">
										<div class="chart-wrap">
											<table class="table">
												<thead class="thead">
													<tr>
														<th class="table-th col-0">排名</th>
														<th class="table-th col-1">搜索词</th>
														<th class="table-th col-2" style="text-align: right;">搜索人气</th>
													</tr>
												</thead>
												<tbody class="tbody">
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="page-container"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 管理视窗 -->
		<div class="manage-wrap">
			<!-- 整体看板 -->
			<div class="all-board line-1-wrap orflow">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">整体看板</span>
					</div>
					<div class="chart-switch rt">
						<span class="switch curr">图表</span>
						<span class="sprite">
							<i class="sp"></i>
						</span>
						<span class="switch">表格</span>
					</div>
				</div>
				<div class="switch-chart-wrap switch-wrap orflow">
					<div class="line-1 orflow">
					<div class="line-lf lf w-860">
						<p class="title">销售目标</p>
							<div class="index-cell">
								<ul class="cell-list orflow">
									<li class="cell-item lf">
										<span class="sub-title">本周已完成</span>
										<p class="value">41515</p>
									</li>
									<li class="cell-item lf">
										<span class="sub-title">本月目标</span>
										<p class="value">
											50.00<i>万</i>
										</p>
									</li>
									<li class="cell-item lf">
										<span class="sub-title">上周</span>
										<p class="value">12010</p>
									</li>
									<li class="cell-item lf">
										<span class="sub-title">本月进度</span>
										<p class="value">0.25%</p>
									</li>
								</ul>
							</div>
							<div class="chart-wrap">
								<!--<div id="echartu" style="width:960px;height:220px;"></div>*/ -->
								<div id="sales-target-chart1" style="width:860px;height:220px;"></div>
							</div>
						</div>
						<div class="line-rt rt w-500">
							<p class="title">支付转化率</p>
								<div class="index-cell">
									<ul class="cell-list orflow">
										<li class="cell-item lf">
											<span class="sub-title">本周平均</span>
											<p class="value">0.23%</p>
										</li>
										<li class="cell-item lf">
											<span class="sub-title">上周平均</span>
											<p class="value">0.3%</p>
										</li>
									</ul>
								</div>
							<div class="chart-wrap">
								<div id="support-transform-rate" style="width:500px;height:220px;"></div>
							</div>
						</div>
					</div>
					<div class="line-1 orflow">
						<div class="line-lf lf w-860">
							<p class="title">访客数</p>
							<div class="index-cell">
								<ul class="cell-list orflow">
									<li class="cell-item lf">
										<span class="sub-title">本周已完成</span>
										<p class="value">41515</p>
									</li>
									<li class="cell-item lf">
										<span class="sub-title">本月目标</span>
										<p class="value">
											50.00<i>万</i>
										</p>
									</li>
									<li class="cell-item lf">
										<span class="sub-title">上周</span>
										<p class="value">12010</p>
									</li>
									<li class="cell-item lf">
										<span class="sub-title">本月进度</span>
										<p class="value">0.25%</p>
									</li>
								</ul>
							</div>
							<div class="chart-wrap">
								<!--<div id="echartu" style="width:960px;height:220px;"></div>*/ -->
								<div id="visitor-num-chart" style="width:860px;height:220px;"></div>
							</div>
						</div>
						<div class="line-rt rt w-500">
							<p class="title">客单价</p>
								<div class="index-cell">
									<ul class="cell-list orflow">
										<li class="cell-item lf">
											<span class="sub-title">本周平均</span>
											<p class="value">0.23%</p>
										</li>
										<li class="cell-item lf">
											<span class="sub-title">上周平均</span>
											<p class="value">0.3%</p>
										</li>
									</ul>
								</div>
							<div class="chart-wrap">
								<div id="ticket-sales-chart" style="width:500px;height:220px;"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="switch-table-wrap switch-wrap orflow">
					<div class="table-left-wrap lf">
						<table class="table-left">
							<thead class="table-left-thead">
								<tr class="table-left-thead-tr">
									<th style="border-right: 1px solid #d0e1ff;width:69px;">&nbsp;</th>
									<th style="width:139px;">&nbsp;</th>
								</tr>
							</thead>
							<tbody class="table-left-tbody orflow">
								<tr class="table-left-tbody-tr">
									<td rowspan="6" class="table-left-tbody-td td-name" style="border-top: none;">交易</td>
									<td class="table-left-tbody-td leading" style="border-top:none;">支付金额(元)</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">销售完成进度</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">支付件数</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">客单价</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">支付转化率</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">老客金额占比</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td rowspan="7" class="table-left-tbody-td td-name">流量</td>
									<td class="table-left-tbody-td leading">访客数</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">流量完成进度</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">淘内免费</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">付费流量</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">自主访问</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">淘外流量</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">其他</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td rowspan="4" class="table-left-tbody-td td-name">推广</td>
									<td class="table-left-tbody-td leading">营销推广金额</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">直通车</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">钻石展位</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">淘宝客</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td rowspan="2" class="table-left-tbody-td td-name">退款</td>
									<td class="table-left-tbody-td leading">成功退款金额</td>
								</tr>
								<tr class="table-left-tbody-tr">
									<td class="table-left-tbody-td">成功退款率</td>
								</tr>	
							</tbody>
						</table>
					</div>
					<div class="table-right-wrap lf">
						<table class="table-right">
							<thead class="table-right-thead">
								<tr>
									<th class="col-0">
										<span class="col-first-span lf">2017-09-12</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
									<th class="col-1">
										<span class="col-first-span lf">2017-09-11</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
									<th class="col-2">
										<span class="col-first-span lf">2017-09-10</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
									<th class="col-3">
										<span class="col-first-span lf">2017-09-09</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
									<th class="col-4">
										<span class="col-first-span lf">2017-09-08</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
									<th class="col-5">
										<span class="col-first-span lf">2017-09-07</span>
										<span class="col-second-span lf">较上周同期</span>
									</th>
								</tr>
							</thead>
							<tbody class="table-right-tbody">
								<tr class="leading" style="border-top:none;">
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">-45.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">-</span>
										<span class="col-second-span lf">-</span>
									</td>
									<td>
										<span class="col-first-span lf">0</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">-</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr class="leading">
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">-445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">0</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">-</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">-</span>
										<span class="col-second-span lf">-</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-5.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr class="leading">
									<td>
										<span class="col-first-span lf">-</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>
								<tr class="leading">
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">-</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">-445.12%</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">82.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
									<td>
										<span class="col-first-span lf">0.80</span>
										<span class="col-second-span lf">+445.12%</span>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- 流量看板 -->
			<div class="flow-board line-1-wrap" style="clear: both;">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">流量看板</span>
					</div>
					<div class="more rt">
						流量分析<i class="icon"></i>
					</div>
				</div>
				<div class="line-1 orflow">
					<div class="line-lf lf w-860">
						<p class="title">一级流量走向</p>
						<div class="chart-wrap">
							<div id="manage-level-1-flow-chart" style="width:860px;height:220px;"></div>
						</div>
					</div>
					<div class="line-rt rt w-500">
						<p class="title">
							<span class="lf">二级流量来源20</span>
							<span class="sub-title rt">
								<span class="curr">无线</span>
								<span>PC</span>
							</span>
						</p>
						<div class="chart-wrap">
							<table class="table">
								<thead class="table-thead">
									<tr>
										<th class="table-th col-0">排名</th>
										<th class="table-th col-1">流量来源</th>
										<th class="table-th col-2" style='text-align: right'>访客数</th>
										<th class="table-th col-3" style='text-align: right'>下单转化率</th>

									</tr>
								</thead>
								<tbody class="table-tbody">
									<tr>
										<td class="table-td col-0">
											1
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											2
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											3
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											4
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											5
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
								</tbody>
								<!-- <tbody class="table-tbody">
									<tr>
										<td class="table-td col-0">
											1
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											2
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											3
										</td>
										<td class="table-td col-1">
											手淘搜索
										</td>
										<td class="table-td col-2" style='text-align: right'>
											55
										</td>
										<td class="table-td col-3" style="text-align: right">
											5.5%
										</td>
									</tr>
								</tbody> -->
								
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- 推广看板 -->
			<div class="tg-board line-1-wrap">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">推广看板</span>
					</div>
				</div>
				<div class="line-1 orflow">
					<div class="line-lf lf w-860">
						<p class="title">推广金额(元)</p>
						<div class="index-cell">
							<ul class="cell-list orflow">
								<li class="cell-item lf">
									<span class="sub-title">本周已消耗</span>
									<p class="value">-</p>
								</li>
								<li class="cell-item lf">
									<span class="sub-title">本月预算</span>
									<p class="value">
										<!-- 50.00<i>万</i> -->
										<a href="javascript:;">设置目标</a>
									</p>
								</li>
								<li class="cell-item lf">
									<span class="sub-title">上周</span>
									<p class="value">-</p>
								</li>
								<li class="cell-item lf">
									<span class="sub-title">本月消耗进度</span>
									<p class="value">-</p>
								</li>
							</ul>
						</div>
						<div class="chart-wrap">
							<div id="promotion-amount-chart" style="width:860px;height:220px;"></div>
						</div>
					</div>
					<div class="line-rt rt w-500">
						<p class="title">
							<span class="lf">推广明细</span>
						</p>
						<div class="chart-wrap">
							<table class="table">
								<thead class="table-thead">
									<tr>
										<th class="table-th col-0">排序</th>
										<th class="table-th col-1">关键词</th>
										<th class="table-th col-2">推广消耗</th>
										<th class="table-th col-3" style='text-align: right'>推广消耗占比</th>

									</tr>
								</thead>
								<tbody class="table-tbody">
									<tr>
										<td class="table-td col-0">
											1
										</td>
										<td class="table-td col-1">
											<span class="keyword-wrapper">
												<i class="icon"></i>
												<div class="keyword-type lf">
													<p class="keyword">直通车</p>
													<p class="sub">较上周同期</p>
												</div>
											</span>
										</td>
										<td class="table-td col-2">
											<p class="balance">-</p>
											<p class="cqc">
												<span>-</span>
												<span class="r-trend up">
													<i class="icon icon-trend"></i>
												</span>
											</p>
										</td>
										<td class="table-td col-3" style="text-align: center;">
											-
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											2
										</td>
										<td class="table-td col-1">
											<span class="keyword-wrapper">
												<i class="icon"></i>
												<div class="keyword-type lf">
													<p class="keyword">直通车</p>
													<p class="sub">较上周同期</p>
												</div>
											</span>
										</td>
										<td class="table-td col-2">
											<p class="balance">-</p>
											<p class="cqc">
												<span>-</span>
												<span class="r-trend up">
													<i class="icon icon-trend"></i>
												</span>
											</p>
										</td>
										<td class="table-td col-3" style="text-align: center;">
											-
										</td>
									</tr>
									<tr>
										<td class="table-td col-0">
											3
										</td>
										<td class="table-td col-1">
											<span class="keyword-wrapper">
												<i class="icon"></i>
												<div class="keyword-type lf">
													<p class="keyword">直通车</p>
													<p class="sub">较上周同期</p>
												</div>
											</span>
										</td>
										<td class="table-td col-2">
											<p class="balance">-</p>
											<p class="cqc">
												<span>-</span>
												<span class="r-trend up">
													<i class="icon icon-trend"></i>
												</span>
											</p>
										</td>
										<td class="table-td col-3" style="text-align: center;">
											-
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- 退款看板 -->
			<div class="tg-board line-1-wrap">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">退款看板</span>
					</div>
					<div class="more rt">
						服务质量<i class="icon"></i>
					</div>
				</div>
				<div class="line-1 orflow">
					<div class="w-860 lf">
						<div class="line-lf lf w-420">
							<p class="title">成功退款金额(元)</p>
							<div class="index-cell">
								<ul class="cell-list orflow">
									<li class="cell-item lf">
										<span class="sub-title">本周</span>
										<p class="value">0</p>
									</li>
									<li class="cell-item lf">
										<span class="sub-title">上周</span>
										<p class="value">0</p>
									</li>
								</ul>
							</div>
							<div class="chart-wrap">
								<div id="refund-successed-chart" style="width:420px;height:220px;"></div>
							</div>
						</div>
						<div class="line-lf rt w-420">
							<p class="title">成功退款率</p>
							<div class="index-cell">
								<ul class="cell-list orflow">
									<li class="cell-item lf">
										<span class="sub-title">本周平均</span>
										<p class="value">0</p>
									</li>
									<li class="cell-item lf">
										<span class="sub-title">上周平均</span>
										<p class="value">3.0%</p>
									</li>
								</ul>
							</div>
							<div class="chart-wrap">
								<div id="refund-successed-rate-chart" style="width:420px;height:220px;"></div>
							</div>
						</div>
					</div>
					<div class="line-rt rt w-500">
						<p class="title">退款原因</p>
						<div class="chart-wrap">
							<table class="table">
								<thead class="table-thead">
									<tr>
										<th class="table-th col-0">排名</th>
										<th class="table-th col-1">退款原因</th>
										<th class="table-th col-2" style='text-align: right'>成功退款金额</th>
										<th class="table-th col-3" style='text-align: right'>占比</th>
									</tr>
								</thead>
								<tbody class="table-tbody"></tbody>
							</table>
							<div class="no-data-message">
								<div class="ui-message-empty">
									<p class="ui-message-content">
										<span class="noromal">
											<i class="icon"></i>
										</span>
										<span>数据为空</span>
									</p>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- 财务看板 -->
			<div class="finance-board line-1-wrap">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">财务看板</span>
					</div>
					<div class="more rt">
						财务分析<i class="icon"></i>
					</div>
				</div>
				<div class="line-1 orflow">
					<div style="height:100px;line-height: 130px;text-align: center;font-size:12px;">
						财务分析功能内测中，想获得内测机会，了解店铺盈亏情况吗？<a href="javascript:;" style="color:#2062e6">点击</a>上传商品成本就有机会开通内测权限，据说上传超过一半商品获得内测机会更大哦~
					</div>
				</div>
			</div>
			<!-- 类目看板 -->
			<div class="finance-board line-1-wrap">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">类目看板</span>
					</div>
					<div class="more rt">
						类目构成<i class="icon"></i>
					</div>
				</div>
				<div class="line-1 orflow">
					<div class="line-rt lf w-430">
						<p class="title">访客数</p>
						<div class="chart-wrap">
							<div class="no-data-message">
								<div class="ui-message-empty">
									<p class="ui-message-content">
										<span class="noromal">
											<i class="icon"></i>
										</span>
										<span>数据为空</span>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="line-rt lf w-430">
						<p class="title">支付金额(元)</p>
						<div class="chart-wrap">
							<div class="no-data-message">
								<div class="ui-message-empty">
									<p class="ui-message-content">
										<span class="noromal">
											<i class="icon"></i>
										</span>
										<span>数据为空</span>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="line-rt lf w-430">
						<p class="title">成功退款金额(元)</p>
						<div class="chart-wrap">
							<div class="no-data-message">
								<div class="ui-message-empty">
									<p class="ui-message-content">
										<span class="noromal">
											<i class="icon"></i>
										</span>
										<span>数据为空</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 行业排行 -->
			<div class="hy-board line-1-wrap">
				<div class="look-board orflow">
					<div class="board lf">
						<i class="icon"></i>
						<span class="board-text">行业排行</span>
					</div>
					<div class="more rt">
						市场行情<i class="icon"></i>
					</div>
				</div>
				<div class="line-1 orflow">
					<div class="shop-col lf">
						<div class="title">店铺</div>
						<div class="col-content">
							<div class="root">
								<div class="container">
									<div class="table-container">
										<div class="chart-wrap">
											<table class="table">
												<thead class="thead">
													<tr>
														<th class="table-th col-0">排名</th>
														<th class="table-th col-1">店铺</th>
														<th class="table-th col-2" style="text-align: right;">交易指数</th>
													</tr>
												</thead>
												<tbody class="tbody">
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name">
																		<a href="javascript:;">苏宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="page-container"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="goods-col lf" style="margin:0 85px;">
						<div class="title">商品</div>
						<div class="col-content">
							<div class="root">
								<div class="container">
									<div class="table-container">
										<div class="chart-wrap">
											<table class="table">
												<thead class="thead">
													<tr>
														<th class="table-th col-0">排名</th>
														<th class="table-th col-1">商品</th>
														<th class="table-th col-2" style="text-align: right;">支付子订单</th>
													</tr>
												</thead>
												<tbody class="tbody">
													<tr>
														<td class="table-td col-0">
															1
														</td>
														<td class="table-td col-1">
															<div class="shop-id">
																<a class="shop-id-img" href="javascript:;">
																	<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499231944253887.png">
																</a>
																<div class="shop-info lf">
																	<p class="shop-name text2">
																		<a href="javascript:;">苏金额附近的地方纪委几分地无法交付及房价未来经济法IE我经济危机为宁易购旗舰店</a>
																	</p>
																</div>
															</div>
														</td>
														<td class="table-td col-2" style="text-align: right">
															1
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="page-container"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="miss-col lf">
						<div class="title">流失竞店发现</div>
						<div class="col-content">
							<div class="root">
								<div class="container">
									<div class="table-container">
										<div class="chart-wrap">
											<table class="table">
												<thead class="thead">
													<tr>
														<th class="table-th col-0">排名</th>
														<th class="table-th col-1">店铺</th>
														<th class="table-th col-2" style="text-align: right;">购买流失竞争度</th>
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
														<span>数据为空</span>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="page-container"></div>
								</div>
								<div class="tip">
									您尚未订购竞争情报，咱不能监控竞争店铺
									<span class="book mt-16">
										<a href="javascript:;">立即订购</a>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ebase-FloorNav__root">
	<ul>
		<li>
			<a href="javascript:;" class="ebase-FloorNav__item ebase-FloorNav__active">实时</a>
		</li>
		<li><a href="javascript:;" class="ebase-FloorNav__item">整体</a></li>
		<li><a href="javascript:;" class="ebase-FloorNav__item">流量</a></li>
		<li><a href="javascript:;" class="ebase-FloorNav__item">转化</a></li>
		<li><a href="javascript:;" class="ebase-FloorNav__item">客单</a></li>
		<li><a href="javascript:;" class="ebase-FloorNav__item">评价</a></li>
		<!-- <li><a href="javascript:;" class="ebase-FloorNav__item">竞争</a></li> -->
		<li><a href="javascript:;" class="ebase-FloorNav__item">行业</a></li>
		<li class="gototop" style=""><a href="javascript:;" class="ebase-FloorNav__item"><i class="lift_btn_arrow" style="font-size: 18px;"></i></a></li>
	</ul>
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/swiper-3.4.1.jquery.min.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
<script type="text/javascript">
	var swiper = new Swiper('.area-wrap .swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        autoplay: 4000,
        noSwiping : true,
        noSwipingClass : 'swiper-slide',
        // loop: true,
        // autoplayDisableOnInteraction: false,
        /*onTransitionStart: function(swiper){
        	if(swiper.activeIndex === 0) {
        		$(".main-wrap .update-wrap .rank-pop-wrap").hide();
        	}
	    }*/
    });
    $(".area-wrap").mouseenter(function(){
    	swiper.stopAutoplay();
    }).mouseleave(function(){
    	swiper.startAutoplay();
    })
  

    var swiper2 = new Swiper('.switch-chart-wrap .swiper-container', {
        direction: 'horizontal',
        loop: false,
        noSwipingClass : 'swiper-slide',
        freeMode:false,
        slidesPerView:7,
        slidesPerGroup : 7,
	    nextButton: '.swiper-button-next',
	    prevButton: '.swiper-button-prev',
	    observer: true, //修改swiper自己或子元素时，自动初始化swiper
        observeParents: true, //修改swiper的父元素时，自动初始化swiper
    });
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
	            value:'2017-12-03 ~ 2017-12-09',
	            range:'~',
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
	// 点击运营视窗 or 管理视窗
	$(".two-wrap .title-switch span").click(function(){
		var _this = $(this);
		_this.addClass("curr").siblings(".curr").removeClass("curr");
		var index = _this.index();
		if (index === 1 ){
			$(".manage-wrap").show();
			$(".business-wrap").hide();
		}else {
			$(".manage-wrap").hide();
			$(".business-wrap").show();
		}
	})

	// 移入店铺概况中第一层级处的图标
	$(".main-wrap .update-wrap .update-right .part-top .month-rank .cate-rank .icon").mouseenter(function(){
		$(".main-wrap .update-wrap .rank-pop-wrap").show();
	}).mouseleave(function(){
		$(".main-wrap .update-wrap .rank-pop-wrap").hide();
	});
	$(".main-wrap .update-wrap .update-right .rank-pop-wrap").mouseenter(function(){
		$(".main-wrap .update-wrap .rank-pop-wrap").show();

	}).mouseleave(function(){
		$(".main-wrap .update-wrap .rank-pop-wrap").hide();

	})
</script>
<script type="text/javascript">

	var timeStateChart = echarts.init(document.getElementById('time-state'));
		// 指定图表的配置项和数据
	 	var colors = ['#2062e6','#cecece'];
	        var option = {
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
			        		color: '#bbb'
			        	},
			            shadowStyle: {//默认值，
		                    color: 'rgba(0,0,0,0.7)',//默认值，
		                    type: 'default',//默认值，
		                }
			        },
			        formatter: function (params) {   // 0-->今日    1--> 昨日
			        	return params[0].dataIndex === params[1].dataIndex ?
			        	'00:00 - '+params[0].dataIndex+':59'+'<br/>\
			        	<i class="icon" style="width:8px;height:8px;background-color:'+params[0].color+';margin-right:5px;"></i>昨日&nbsp;&nbsp;&nbsp;&nbsp;'+(params[1].value).toFixed(2)+'<br/>\
			        	<i class="icon" style="width:8px;height:8px;background-color:'+params[1].color+';margin-right:5px;"></i>今日&nbsp;&nbsp;&nbsp;&nbsp;'+(params[0].value).toFixed(2)
			        	:
			        	'00:00 - '+params[1].dataIndex+':59'+'<br/>\
			        	<i class="icon" style="width:8px;height:8px;background-color:'+params[1].color+';margin-right:5px;"></i>昨日&nbsp;&nbsp;&nbsp;&nbsp;'+(params[1].value).toFixed(2);
		            }
			    },
	             grid: {
			        top: '10%',
			        bottom: '12%',
			        left: '2%',
			        right: '2%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
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
	                	interval: 5  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: false  // 控制 坐标轴两端 空白
	            },
	            yAxis: {
	            	type: 'value',
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb'
	                	}
	                }
	            },
	            series: [
		            {
		                // name: '今日',
		                type: 'line',
		                // symbol: 'none',  // 折点处空心圆
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [0, 0, 0, 10, 0, 0, 0, 0, 10, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0]
		            },
		            {
		                // name: '昨日',
		                type: 'line',
		                // symbol: 'none',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {
		                			color: colors[1]
		                		}
		                	}
		                },
		                data: [0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0]
		            }

	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        timeStateChart.setOption(option);
	
	var meetChart = echarts.init(document.getElementById('meet-chart'));
		// 指定图表的配置项和数据
	 	var colors = ['#2062e6','#cecece'];
	        var option = {
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
			        		color: '#bbb'
			        	},
			            shadowStyle: {//默认值，
		                    color: 'rgba(0,0,0,0.7)',//默认值，
		                    type: 'default',//默认值，
		                }
			        },
			        formatter: function (params) {
			        	return params[0].name+'</br>'
			        	 +'跳失率&nbsp;&nbsp;&nbsp;&nbsp;'+(params[0].value).toFixed(2)+"%";
		            }
			    },
	             grid: {
			        top: '10%',
			        bottom: '18%',
			        left: '6%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
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
	                	interval: 7  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: false  // 控制 坐标轴两端 空白
	            },
	            yAxis: {
	            	type: 'value',
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	            		formatter: function (value, index) {
	            			// console.log(1,value,index)
	            			return value.toFixed(2)+'%'
	            		},
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb'
	                	}
	                }
	            },
	            series: [
		            {
		                // name: '今日',
		                type: 'line',
		                // symbol: 'none',  // 折点处空心圆
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,
		                areaStyle: {normal: {
		                	color: '#eef1f6'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [0, 0, 0, 10, 0, 0, 0, 0, 10, 2, 50, 0, 0, 0, 0, 0, 0, 0, 0]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        meetChart.setOption(option);

	var personWatchChart = echarts.init(document.getElementById('person-watch-chart'));
		// 指定图表的配置项和数据
	 	var colors = ['#2062e6','#cecece'];
	        var option = {
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
			        		color: '#bbb'
			        	},
			            shadowStyle: {//默认值，
		                    color: 'rgba(0,0,0,0.7)',//默认值，
		                    type: 'default',//默认值，
		                }
			        },
			        formatter: function (params) {
			        	return params[0].name+'</br>'
			        	 +'人均浏览量&nbsp;&nbsp;&nbsp;&nbsp;'+(params[0].value).toFixed(2);
		            }
			    },
	             grid: {
			        top: '10%',
			        bottom: '18%',
			        left: '6%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
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
	                	interval: 7  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: false  // 控制 坐标轴两端 空白
	            },
	            yAxis: {
	            	type: 'value',
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	            		formatter: function (value, index) {
	            			// console.log(1,value,index)
	            			return value.toFixed(2);
	            		},
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb'
	                	}
	                }
	            },
	            series: [
		            {
		                // name: '今日',
		                type: 'line',
		                // symbol: 'none',  // 折点处空心圆
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,
		                areaStyle: {normal: {
		                	color: '#eef1f6'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [0, 0, 0, 0.36, 0, 0, 0, 0, 0.10, 2, 0.50, 0, 0, 0, 0, 0, 0, 0, 0]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        personWatchChart.setOption(option);

	var stopTimeChart= echarts.init(document.getElementById('stop-time-chart'));
		// 指定图表的配置项和数据
	 	var colors = ['#2062e6','#cecece'];
	        var option = {
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
			        		color: '#bbb'
			        	},
			            shadowStyle: {//默认值，
		                    color: 'rgba(0,0,0,0.7)',//默认值，
		                    type: 'default',//默认值，
		                }
			        },
			        formatter: function (params) {
			        	return params[0].name+'</br>'
			        	 +'平均停留时长&nbsp;&nbsp;&nbsp;&nbsp;'+(params[0].value).toFixed(2)+"秒";
		            }
			    },
	             grid: {
			        top: '10%',
			        bottom: '18%',
			        left: '6%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
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
	                	interval: 7  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: false  // 控制 坐标轴两端 空白
	            },
	            yAxis: {
	            	type: 'value',
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	            		formatter: function (value, index) {
	            			// console.log(1,value,index)
	            			return (value).toFixed(2)+'秒'
	            		},
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb'
	                	}
	                }
	            },
	            series: [
		            {
		                // name: '今日',
		                type: 'line',
		                // symbol: 'none',  // 折点处空心圆
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,
		                areaStyle: {normal: {
		                	color: '#eef1f6'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [0, 0, 0, 10, 0, 0, 5, 0.3, 10, 2, 50, 0, 22, 0, 0, 0, 0, 0, 0]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        stopTimeChart.setOption(option);

	var rightTopChart = echarts.init(document.getElementById('right-top-chart'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#cecece']
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
			        axisPointer: {
			        	type: 'line',  // cross时为十字虚线 也可以为shadow
			        	lineStyle: {
			        		color: '#bbb'
			        	},
			        	shadowStyle : {                       // 阴影指示器样式设置
			                width: 'auto',                   // 阴影大小
			                color: 'rgba(150,150,150,0.3)'  // 阴影颜色
			            }
			        },
			        formatter: function (params) {
			        	// console.log(params);
			        	return params[0].name+"</br>"+params[0].value;
		            }
			    },
	             grid: {
			        top: '7%',
			        bottom: '26%',
			        left: '10%',
			        right: '2%'
			    },
				 axisLabel: {
				   show: false
				 },

	            xAxis: {    //  x坐标轴
	            	// show: false,
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
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
	                	interval: 5  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: false  // 控制 坐标轴两端 空白
	            },
	            yAxis: {
	            	show: false,
	            	type: 'value',
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	                	textStyle: {
	                		color: '#bbb'
	                	}
	                }
	            },
	            series: [
		            {
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                interval: 7,
		                 areaStyle: {normal: {
		                	color: '#eef1f6'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [16541125, 758, 2786387, 16780, 57, 147520, 630, 23370, 1750, 1000, .350, 45575758, 53880, 786830, 3723380, 7320, 3880, 285763, 69860, 4328, 8528869, 6950, 873, 8780]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        rightTopChart.setOption(option);

	var salesTargetChart1 = echarts.init(document.getElementById('sales-target-chart1'));
		// 指定图表的配置项和数据
	 	var colors = ['#ff8533','#2062e6']
	        var option = {
	          	tooltip: {
			        trigger: 'axis',
			        backgroundColor: '#fff',
			        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
			        borderColor: '#eee',
			        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
			        padding: 14,
			        textStyle: {
			            color: '#999',
			            fontSize: 12
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
			        },
			        formatter: function (params) {   // 0==> 实际支付金额   1==>上周同期增长率
			        	var year = new Date().getFullYear();  //获取年份
			        	var da = year+"-"+params[0].name;
					    var d = new Date(da);  
					    var mon=d.getMonth()+1;  
					    var day=d.getDate();  
					    if(day <= 7){  
				            if(mon>1) {  
				               mon=mon-1;  
				            }  
				           else {  
				             year = year-1;  
				             mon = 12;  
				             }  
				           }  
				          d.setDate(d.getDate()-7);  
				          year = d.getFullYear();  
				          mon=d.getMonth()+1;  
				          day=d.getDate();  
					     s = year+"-"+(mon<10?('0'+mon):mon)+"-"+(day<10?('0'+day):day);  

			        	return params[0].name+'<br/>上周同期('+s+')<br/>'+
			        		'<i class="icon" style="width:8px;height:8px;background-color:'+params[0].color+';margin-right:5px;"></i>'+params[0].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+params[0].value+'<br/>'+
			        		'<i class="icon" style="width:8px;height:8px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;background-color:'+params[1].color+';margin-right:5px;vertical-align:middle;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+(params[1].value).toFixed(2)+"%";
		            }
			    },
	           legend: {     // 图例
	            	x: 'left',
	           		data: [
		           		{
		           			name: '实际支付金额',
		           			icon: 'rect',
		           		},
		           		{
		           			name: '上周同比增长率',
		           			icon: 'pin'
		           		}
	           		],
	            },

	             grid: {
			        bottom: '24%',
			        left: '2%',
			        right: '6%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: false,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: true  // 控制 坐标轴两端 空白
	            },
	            yAxis: [
	            	{
		            	type: 'value',
		            	position: 'left',
		            	axisLine: false,  //  控制 坐标轴显示或隐藏
		            	splitLine: {
		                	show: false
		                },
		                axisTick: {
		            		show: false
		            	},
		            	axisLabel: {
		                	textStyle: {
		                		align: 'left',
		                		color: '#bbb'
		                	}
		                }
		            },
		            {
		            	type: 'value',
		            	// splitNumber: 3,
		            	boundaryGap: [0.5, 0.5],
		            	// boundaryGap: true,
		            	// splitArea: {show: true},
		            	position: 'right',
		            	axisLine: false,  //  控制 坐标轴显示或隐藏
		            	splitLine: {
		                	show: false
		                },
		                axisTick: {
		            		show: false
		            	},
		            	axisLabel: {
		            		formatter: function (value, index) {
		            			// console.log(1,value,index)
		            			return value+'%'
		            		},
		                	textStyle: {
		                		align: 'left',
		                		color: '#bbb'
		                	}
		                }
		            }
	            ],
	            series: [
		            {
		                name: '实际支付金额',
		                type: 'bar',
		                symbol: true,  // 折点处空心圆
		                yAxis: 1,
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {    // 线条颜色
		                			color: colors[1]
		                		}
		                	}
		                },
		                data: [0, 7, 0, 10, 7, 4, 7, 6, 10, 1, 3, 0, 5, 0, 7, 6, 4, 4, 6, 4, 0, 3, 6, 3,0, 3, 10, 0, 0, 7]
		            },
		            {
		                name: '上周同比增长率',
		                type: 'line',
		                yAxisIndex: 1,
		                // smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {
		                			color: colors[0]
		                		}
		                	}
		                },
		                 data:  [0, 11, 42, 10, 17, 4, 100, 40, 10, 32, 22, 14, 6, 7, 52, 7, 2, 51, 5, 4, 20, 25, 20, 64,6, 0, 10, 0, 0, 7]
		            }

	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        salesTargetChart1.setOption(option);
	     
	var visitorNumChart = echarts.init(document.getElementById('visitor-num-chart'));
		// 指定图表的配置项和数据
	 	var colors = ['#ff8533','#2062e6']
	        var option = {
	          	tooltip: {
			        trigger: 'axis',
			        backgroundColor: '#fff',
			        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
			        borderColor: '#eee',
			        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
			        padding: 14,
			        textStyle: {
			            color: '#999',
			            fontSize: 12
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
			        },
			        formatter: function (params) {   // 0==> 实际支付金额   1==>上周同期增长率
			        	var year = new Date().getFullYear();  //获取年份
			        	var da = year+"-"+params[0].name;
					    var d = new Date(da);  
					    var mon=d.getMonth()+1;  
					    var day=d.getDate();  
					    if(day <= 7){  
				            if(mon>1) {  
				               mon=mon-1;  
				            }  
				           else {  
				             year = year-1;  
				             mon = 12;  
				             }  
				           }  
				          d.setDate(d.getDate()-7);  
				          year = d.getFullYear();  
				          mon=d.getMonth()+1;  
				          day=d.getDate();  
					     s = year+"-"+(mon<10?('0'+mon):mon)+"-"+(day<10?('0'+day):day);  

			        	return params[0].name+'<br/>上周同期('+s+')<br/>'+
			        		'<i class="icon" style="width:8px;height:8px;background-color:'+params[0].color+';margin-right:5px;"></i>'+params[0].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+params[0].value+'<br/>'+
			        		'<i class="icon" style="width:8px;height:8px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;background-color:'+params[1].color+';margin-right:5px;vertical-align:middle;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+(params[1].value).toFixed(2)+"%";
		            }
			    },
	           legend: {     // 图例
	            	x: 'left',
	           		data: [
		           		{
		           			name: '实际访客数',
		           			icon: 'rect',
		           		},
		           		{
		           			name: '上周同比增长率',
		           			icon: 'pin'
		           		}
	           		],
	            },

	             grid: {
			        bottom: '24%',
			        left: '2%',
			        right: '6%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: false,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: true  // 控制 坐标轴两端 空白
	            },
	            yAxis: [
	            	{
		            	type: 'value',
		            	position: 'left',
		            	axisLine: false,  //  控制 坐标轴显示或隐藏
		            	splitLine: {
		                	show: false
		                },
		                axisTick: {
		            		show: false
		            	},
		            	axisLabel: {
		                	textStyle: {
		                		align: 'left',
		                		color: '#bbb'
		                	}
		                }
		            },
		            {
		            	type: 'value',
		            	// splitNumber: 3,
		            	boundaryGap: [0.5, 0.5],
		            	// boundaryGap: true,
		            	// splitArea: {show: true},
		            	position: 'right',
		            	axisLine: false,  //  控制 坐标轴显示或隐藏
		            	splitLine: {
		                	show: false
		                },
		                axisTick: {
		            		show: false
		            	},
		            	axisLabel: {
		            		formatter: function (value, index) {
		            			// console.log(1,value,index)
		            			return value+'%'
		            		},
		                	textStyle: {
		                		align: 'left',
		                		color: '#bbb'
		                	}
		                }
		            }
	            ],
	            series: [
		            {
		                name: '实际访客数',
		                type: 'bar',
		                symbol: true,  // 折点处空心圆
		                yAxis: 1,
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {    // 线条颜色
		                			color: colors[1]
		                		}
		                	}
		                },
		                data: [0, 7, 0, 10, 7, 4, 7, 6, 10, 1, 3, 0, 5, 0, 7, 6, 4, 4, 6, 4, 0, 3, 6, 3,0, 3, 10, 0, 0, 7]
		            },
		            {
		                name: '上周同比增长率',
		                type: 'line',
		                yAxisIndex: 1,
		                // smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {
		                			color: colors[0]
		                		}
		                	}
		                },
		                 data:  [0, 11, 42, 10, 17, 4, 100, 40, 10, 32, 22, 14, 6, 7, 52, 7, 2, 51, 5, 4, 20, 25, 20, 64,6, 0, 10, 0, 0, 7]
		            }

	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        visitorNumChart.setOption(option);  
	        // 推广
	var promotionAmountChart = echarts.init(document.getElementById('promotion-amount-chart'));
		// 指定图表的配置项和数据
	 	var colors = ['#ff8533','#2062e6']
	        var option = {
	          	tooltip: {
			        trigger: 'axis',
			        backgroundColor: '#fff',
			        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
			        borderColor: '#eee',
			        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
			        padding: 14,
			        textStyle: {
			            color: '#999',
			            fontSize: 12
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
			        },
			        formatter: function (params) {   // 0==> 实际支付金额   1==>上周同期增长率
			        	var year = new Date().getFullYear();  //获取年份
			        	var da = year+"-"+params[0].name;
					    var d = new Date(da);  
					    var mon=d.getMonth()+1;  
					    var day=d.getDate();  
					    if(day <= 7){  
				            if(mon>1) {  
				               mon=mon-1;  
				            }  
				           else {  
				             year = year-1;  
				             mon = 12;  
				             }  
				           }  
				          d.setDate(d.getDate()-7);  
				          year = d.getFullYear();  
				          mon=d.getMonth()+1;  
				          day=d.getDate();  
					     s = year+"-"+(mon<10?('0'+mon):mon)+"-"+(day<10?('0'+day):day);  

			        	return params[0].name+'<br/>上周同期('+s+')<br/>'+
			        		'<i class="icon" style="width:8px;height:8px;background-color:'+params[0].color+';margin-right:5px;"></i>'+params[0].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+params[0].value+'<br/>'+
			        		'<i class="icon" style="width:8px;height:8px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;background-color:'+params[1].color+';margin-right:5px;vertical-align:middle;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+params[1].value+".00%"
		            }
			    },
	           legend: {     // 图例
	            	x: 'left',
	           		data: [
		           		{
		           			name: '实际推广金额',
		           			icon: 'rect',
		           		},
		           		{
		           			name: '上周同比增长率',
		           			icon: 'pin'
		           		}
	           		],
	            },

	             grid: {
			        bottom: '24%',
			        left: '2%',
			        right: '6%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: false,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: true  // 控制 坐标轴两端 空白
	            },
	            yAxis: [
	            	{
		            	type: 'value',
		            	position: 'left',
		            	axisLine: false,  //  控制 坐标轴显示或隐藏
		            	splitLine: {
		                	show: false
		                },
		                axisTick: {
		            		show: false
		            	},
		            	axisLabel: {
		                	textStyle: {
		                		align: 'left',
		                		color: '#bbb'
		                	}
		                }
		            },
		            {
		            	type: 'value',
		            	// splitNumber: 3,
		            	boundaryGap: [0.5, 0.5],
		            	// boundaryGap: true,
		            	// splitArea: {show: true},
		            	position: 'right',
		            	axisLine: false,  //  控制 坐标轴显示或隐藏
		            	splitLine: {
		                	show: false
		                },
		                axisTick: {
		            		show: false
		            	},
		            	axisLabel: {
		            		formatter: function (value, index) {
		            			// console.log(1,value,index)
		            			return value+'%'
		            		},
		                	textStyle: {
		                		align: 'left',
		                		color: '#bbb'
		                	}
		                }
		            }
	            ],
	            series: [
		            {
		                name: '实际推广金额',
		                type: 'bar',
		                symbol: true,  // 折点处空心圆
		                yAxis: 1,
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {    // 线条颜色
		                			color: colors[1]
		                		}
		                	}
		                },
		                data: [0, 7, 0, 10, 7, 4, 7, 6, 10, 1, 3, 0, 5, 0, 7, 6, 4, 4, 6, 4, 0, 3, 6, 3,0, 3, 10, 0, 0, 7]
		            },
		            {
		                name: '上周同比增长率',
		                type: 'line',
		                yAxisIndex: 1,
		                // smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {
		                			color: colors[0]
		                		}
		                	}
		                },
		                 data:  [0, 11, 42, 10, 17, 4, 100, 40, 10, 32, 22, 14, 6, 7, 52, 7, 2, 51, 5, 4, 20, 25, 20, 64,6, 0, 10, 0, 0, 7]
		            }

	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        promotionAmountChart.setOption(option);  

	var supportTransformRate = echarts.init(document.getElementById('support-transform-rate'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#a7b9dc']
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
			        axisPointer: {
			        	type: 'line',  // cross时为十字虚线 也可以为shadow
			        	lineStyle: {
			        		color: '#bbb'
			        	},
			        	shadowStyle : {                       // 阴影指示器样式设置
			                width: 'auto',                   // 阴影大小
			                color: 'rgba(150,150,150,0.3)'  // 阴影颜色
			            }
			        },
			        formatter: function(params) {  //  0--->日   1---->上周同期
			        	var html = '';
				    	var year = new Date().getFullYear();  //获取年份
			        	var da = year+"-"+params[0].name;
					    var d = new Date(da);  
					    var mon=d.getMonth()+1;  
					    var day=d.getDate();  
					    if(day <= 7){  
				            if(mon>1) {  
				               mon=mon-1;  
				            }  
				           else {  
				             year = year-1;  
				             mon = 12;  
				             }  
				           }  
				          d.setDate(d.getDate()-7);  
				          year = d.getFullYear();  
				          mon=d.getMonth()+1;  
				          day=d.getDate();  
					     s = (mon<10?('0'+mon):mon)+"-"+(day<10?('0'+day):day); 

					     for(var i=0;i<params.length;i++) {
					     	html += '<i class="icon" style="width:8px;height:8px;background-color:'+params[i].color+';margin-right:5px;"></i>'+params[i].name+'&nbsp;&nbsp;&nbsp;&nbsp;'+(params[i].value).toFixed(2)+'%<br/>'
					     }

				    	return html;
				    }
			    },
	           legend: {     // 图例
	            	orent: 'vertical',
	            	x: 'left',
	                data:['日','上周同期'],
	                itemWidth:8,
	                itemHeight:8
	            },

	             grid: {
			        bottom: '24%',
			        left: '2%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: false,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	            },
	            yAxis: {
	                type: 'value',
	            	boundaryGap: [0, 0.5],
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	            		formatter: function (value, index) {
	            			// console.log(1,value,index)
	            			return value.toFixed(2)+'%'
	            		},
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '日',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#eef1f6'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [2, 7.33, 0, 1, 2.7, 4, 1.2, 0.6, 0.1, 1, 3, 0.5, 5, 0, 0.7, 6, 4, 4, 0.6, 0.4, 0, 3, 6, 0.3,0, 3, 0.21, 0, 0, 0.7]
		            },
		            {
		                name: '上周同期',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {
		                			color: colors[1]
		                		}
		                	}
		                },
		                data:  [2, 0.03, 0, 1, 0.7, 0, 1.2, 0, 0.1, 1, 1.3, 0.5, 5, 0, 0.17, 0, 4, 4, 0.6, 0.34, 0, 3, 6, 0.3,0, 3, 0.21, 0, 0, 0.7]
		            }

	            ]
	        };

	        // 使用刚指定的配置项和数据显示图表。
	        supportTransformRate.setOption(option);
	       
	var ticketSalesChart = echarts.init(document.getElementById('ticket-sales-chart'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#a7b9dc']
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
			        axisPointer: {
			        	type: 'line',  // cross时为十字虚线 也可以为shadow
			        	lineStyle: {
			        		color: '#bbb'
			        	},
			        	shadowStyle : {                       // 阴影指示器样式设置
			                width: 'auto',                   // 阴影大小
			                color: 'rgba(150,150,150,0.3)'  // 阴影颜色
			            }
			        },
			        formatter: function(params) {  //  0--->日   1---->上周同期
			        	var html = '';
				    	var year = new Date().getFullYear();  //获取年份
			        	var da = year+"-"+params[0].name;
					    var d = new Date(da);  
					    var mon=d.getMonth()+1;  
					    var day=d.getDate();  
					    if(day <= 7){  
				            if(mon>1) {  
				               mon=mon-1;  
				            }  
				           else {  
				             year = year-1;  
				             mon = 12;  
				             }  
				           }  
				          d.setDate(d.getDate()-7);  
				          year = d.getFullYear();  
				          mon=d.getMonth()+1;  
				          day=d.getDate();  
					     s = (mon<10?('0'+mon):mon)+"-"+(day<10?('0'+day):day); 

					     for(var i = 0;i <params.length;i ++) {
					     	html += '<i class="icon" style="width:8px;height:8px;background-color:'+params[i].color+';margin-right:5px;"></i>'+params[i].name+'&nbsp;&nbsp;&nbsp;&nbsp;'+(params[i].value).toFixed(2)+'<br/>'
					     }

				    	return html;
				    }
			    },
	           legend: {     // 图例
	            	orent: 'vertical',
	            	x: 'left',
	                data:['日','上周同期'],
	                itemWidth:8,
	                itemHeight:8
	            },

	             grid: {
			        bottom: '24%',
			        left: '2%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: false,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	            },
	            yAxis: {
	                type: 'value',
	            	boundaryGap: [0, 0.5],
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '日',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#eef1f6'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [2, 7.33, 0, 1, 2.7, 4, 1.2, 0.6, 0.1, 1, 3, 0.5, 5, 0, 0.7, 6, 4, 4, 0.6, 0.4, 0, 3, 6, 0.3,0, 3, 0.21, 0, 0, 0.7]
		            },
		            {
		                name: '上周同期',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {
		                			color: colors[1]
		                		}
		                	}
		                },
		                data:  [2, 0.03, 0, 1, 0.7, 0, 1.2, 0, 0.1, 1, 1.3, 0.5, 5, 0, 0.17, 0, 4, 4, 0.6, 0.34, 0, 3, 6, 0.3,0, 3, 0.21, 0, 0, 0.7]
		            }

	            ]
	        };

	        // 使用刚指定的配置项和数据显示图表。
	        ticketSalesChart.setOption(option);
	       // 成功退款

	var refundSuccessedChart = echarts.init(document.getElementById('refund-successed-chart'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#a7b9dc']
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
			        axisPointer: {
			        	type: 'line',  // cross时为十字虚线 也可以为shadow
			        	lineStyle: {
			        		color: '#bbb'
			        	},
			        	shadowStyle : {                       // 阴影指示器样式设置
			                width: 'auto',                   // 阴影大小
			                color: 'rgba(150,150,150,0.3)'  // 阴影颜色
			            }
			        },
			        formatter: function(params) {  //  0--->日   1---->上周同期
			        	var html = '';
				    	var year = new Date().getFullYear();  //获取年份
			        	var da = year+"-"+params[0].name;
					    var d = new Date(da);  
					    var mon=d.getMonth()+1;  
					    var day=d.getDate();  
					    if(day <= 7){  
				            if(mon>1) {  
				               mon=mon-1;  
				            }  
				           else {  
				             year = year-1;  
				             mon = 12;  
				             }  
				           }  
				          d.setDate(d.getDate()-7);  
				          year = d.getFullYear();  
				          mon=d.getMonth()+1;  
				          day=d.getDate();  
					     s = (mon<10?('0'+mon):mon)+"-"+(day<10?('0'+day):day); 

					      for(var i = 0; i< params.length; i++) {
					     	html += '<i class="icon" style="width:8px;height:8px;background-color:'+params[i].color+';margin-right:5px;"></i>'+params[i].name+'&nbsp;&nbsp;&nbsp;&nbsp;'+(params[i].value).toFixed(2)+'<br/>'
					     }

				    	return html;
				    }
			    },
	           legend: {     // 图例
	            	orent: 'vertical',
	            	x: 'left',
	                data:['日','上周同期'],
	                itemWidth:8,
	                itemHeight:8
	            },

	             grid: {
			        bottom: '24%',
			        left: '2%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: false,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	            },
	            yAxis: {
	                type: 'value',
	            	boundaryGap: [0, 0.5],
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '日',
		                type: 'line',
		                symbol: 'none',  // 折点处空心圆
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#eef1f6'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [2, 7.33, 0, 1, 2.7, 4, 1.2, 0.6, 0.1, 1, 3, 0.5, 5, 0, 0.7, 6, 4, 4, 0.6, 0.4, 0, 3, 6, 0.3,0, 3, 0.21, 0, 0, 0.7]
		            },
		            {
		                name: '上周同期',
		                type: 'line',
		                symbol: 'none',
		                smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {
		                			color: colors[1]
		                		}
		                	}
		                },
		                data:  [2, 0.03, 0, 1, 0.7, 0, 1.2, 0, 0.1, 1, 1.3, 0.5, 5, 0, 0.17, 0, 4, 4, 0.6, 0.34, 0, 3, 6, 0.3,0, 3, 0.21, 0, 0, 0.7]
		            }

	            ]
	        };

	        // 使用刚指定的配置项和数据显示图表。
	        refundSuccessedChart.setOption(option);

    var refundSuccessedRateChart = echarts.init(document.getElementById('refund-successed-rate-chart'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#a7b9dc']
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
			        axisPointer: {
			        	type: 'line',  // cross时为十字虚线 也可以为shadow
			        	lineStyle: {
			        		color: '#bbb'
			        	},
			        	shadowStyle : {                       // 阴影指示器样式设置
			                width: 'auto',                   // 阴影大小
			                color: 'rgba(150,150,150,0.3)'  // 阴影颜色
			            }
			        },
			        formatter: function(params) {  //  0--->日   1---->上周同期
			        	var html = '';
				    	var year = new Date().getFullYear();  //获取年份
			        	var da = year+"-"+params[0].name;
					    var d = new Date(da);  
					    var mon=d.getMonth()+1;  
					    var day=d.getDate();  
					    if(day <= 7){  
				            if(mon>1) {  
				               mon=mon-1;  
				            }  
				           else {  
				             year = year-1;  
				             mon = 12;  
				             }  
				           }  
				          d.setDate(d.getDate()-7);  
				          year = d.getFullYear();  
				          mon=d.getMonth()+1;  
				          day=d.getDate();  
					     s = (mon<10?('0'+mon):mon)+"-"+(day<10?('0'+day):day); 

					     for(var i = 0; i< params.length; i++) {
					     	html += '<i class="icon" style="width:8px;height:8px;background-color:'+params[i].color+';margin-right:5px;"></i>'+params[i].name+'&nbsp;&nbsp;&nbsp;&nbsp;'+(params[i].value).toFixed(2)+'%<br/>'
					     }

				    	return html;
				    }
			    },
	           legend: {     // 图例
	            	orent: 'vertical',
	            	x: 'left',
	                data:['日','上周同期'],
	                itemWidth:8,
	                itemHeight:8
	            },

	             grid: {
			        bottom: '24%',
			        left: '2%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: false,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	            },
	            yAxis: {
	                type: 'value',
	            	boundaryGap: [0, 0.5],
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	            		formatter: function (value, index) {
	            			// console.log(1,value,index)
	            			return value.toFixed(2)+'%'
	            		},
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '日',
		                type: 'line',
		                symbol: 'none',  // 折点处空心圆
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#eef1f6'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [2, 7.33, 0, 1, 2.7, 4, 1.2, 0.6, 0.1, 1, 3, 0.5, 5, 0, 0.7, 6, 4, 4, 0.6, 0.4, 0, 3, 6, 0.3,0, 3, 0.21, 0, 0, 0.7]
		            },
		            {
		                name: '上周同期',
		                type: 'line',
		                symbol: 'none',
		                smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {
		                			color: colors[1]
		                		}
		                	}
		                },
		                data:  [2, 0.03, 0, 1, 0.7, 0, 18.2, 0, 0.1, 1, 1.3, 0.5, 5, 0, 0.17, 0, 4, 4, 0.6, 0.34, 0, 3, 6, 0.3,0, 3, 0.21, 0, 0, 0.7]
		            }

	            ]
	        };

	        // 使用刚指定的配置项和数据显示图表。
	        refundSuccessedRateChart.setOption(option);

    var personAvgPayChart = echarts.init(document.getElementById('person-avg-pay-chart'));
		// 指定图表的配置项和数据
	 	var colors = ['#2062e6','#cecece'];
	        var option = {
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
			        		color: '#bbb'
			        	},
			            shadowStyle: {//默认值，
		                    color: 'rgba(0,0,0,0.7)',//默认值，
		                    type: 'default',//默认值，
		                }
			        },
			        formatter: function (params) {
			        	return params[0].name+'</br>'
			        	 +'人均支付件数&nbsp;&nbsp;&nbsp;&nbsp;'+(params[0].value).toFixed(2);
		            }
			    },
	             grid: {
			        top: '10%',
			        bottom: '18%',
			        left: '6%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
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
	                	interval: 7  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: false  // 控制 坐标轴两端 空白
	            },
	            yAxis: {
	            	type: 'value',
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	            		formatter: function (value, index) {
	            			// console.log(1,value,index)
	            			return value.toFixed(2);
	            		},
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb'
	                	}
	                }
	            },
	            series: [
		            {
		                // name: '今日',
		                type: 'line',
		                // symbol: 'none',  // 折点处空心圆
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,
		                areaStyle: {normal: {
		                	color: '#eef1f6'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [0, 0, 0, 10, 0, 0, 0, 0, 10, 2, 50, 0, 0, 0, 0, 0, 0, 0, 0]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        personAvgPayChart.setOption(option);
	        // 连带率
	var jointRateChart = echarts.init(document.getElementById('joint-rate-Chart'));
		// 指定图表的配置项和数据
	 	var colors = ['#2062e6','#cecece'];
	        var option = {
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
			        		color: '#bbb'
			        	},
			            shadowStyle: {//默认值，
		                    color: 'rgba(0,0,0,0.7)',//默认值，
		                    type: 'default',//默认值，
		                }
			        },
			        formatter: function (params) {
			        	return params[0].name+'</br>'
			        	 +'连带率&nbsp;&nbsp;&nbsp;&nbsp;'+(params[0].value).toFixed(2);
		            }
			    },
	             grid: {
			        top: '10%',
			        bottom: '18%',
			        left: '6%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
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
	                	interval: 7  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: false  // 控制 坐标轴两端 空白
	            },
	            yAxis: {
	            	type: 'value',
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	            		formatter: function (value, index) {
	            			// console.log(1,value,index)
	            			return value.toFixed(2);
	            		},
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb'
	                	}
	                }
	            },
	            series: [
		            {
		                // name: '今日',
		                type: 'line',
		                // symbol: 'none',  // 折点处空心圆
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,
		                areaStyle: {normal: {
		                	color: '#eef1f6'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [0, 0, 0, 10, 0, 0, 0, 0, 10, 2, 50, 0, 0, 0, 0, 0, 0, 0, 0]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        jointRateChart.setOption(option);

    var manageLevle1FlowChart = echarts.init(document.getElementById('manage-level-1-flow-chart'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#F3D024',"#FF8533","#4CB5FF","#BC64E5"];
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
			        	var sum = 0;
			        	var htmlText= '';
			        	for(var i = 0;i< params.length;i++) {
			        		sum += params[i].value
			        	}
			        	for(var j = 0;j<params.length;j++) {
			        		htmlText +='<i class="icon" style="width:8px;height:8px;background-color:'+params[j].color+';margin-right:5px;vertical-align:1px;"></i>'+params[j].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+params[j].value+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+(params[j].value/sum*100).toFixed(2)+"%"+'<br/>'
			        	}
			        	return params[0].name+'</br>'+htmlText
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
	                		name: '淘内免费',
	                		// icon: 'rect'
	                	},
	                	{
	                		name: '付费流量'
	                	},
	                	{
	                		name: '自主访问'
	                	},
	                	{
	                		name: '淘外流量'
	                	},
	                	{
	                		name: '其他'
	                	}
	                ]
	            },

	             grid: {
			        bottom: '20%',
			        left: '2%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: false,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	            },
	            yAxis: {
	                type: 'value',
	            	boundaryGap: [0, 0.5],
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '淘内免费',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#eef3fd'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],  // 此处绑定图例颜色
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [20, 16, 85, 40, 76, 10, 25, 30, 41, 65, 88, 41, 40, 36, 20, 20, 30, 12, 32, 41, 25, 62, 65, 35,42, 40, 30, 81, 18, 36]
		            },
		            {
		                name: '付费流量',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#f5cd0b'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {
		                			color: colors[1]
		                		}
		                	}
		                },
		                data:  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, ]
		            },
		            {
		                name: '自主访问',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#f5dfcf'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[2],
		                		lineStyle: {
		                			color: colors[2]
		                		}
		                	}
		                },
		                data:  [0, 0, 0, 0, 21, 0, 63, 56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0]
		            },
		            {
		                name: '淘外流量',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#cfe9fb'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[3],
		                		lineStyle: {
		                			color: colors[3]
		                		}
		                	}
		                },
		                data:  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0]
		            },
		            {
		                name: '其他',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#e9d0f5'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[4],
		                		lineStyle: {
		                			color: colors[4]
		                		}
		                	}
		                },
		                data:  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 5, 0, 0, 0, 0]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        manageLevle1FlowChart.setOption(option);

	var businessLevle1FlowChart = echarts.init(document.getElementById('business-level-1-flow-chart'));
	  // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#F3D024',"#FF8533","#4CB5FF","#BC64E5"];
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
			        	var sum = 0;
			        	var htmlText= '';
			        	for(var i = 0;i< params.length;i++) {
			        		sum += params[i].value
			        	}
			        	for(var j = 0;j<params.length;j++) {
			        		htmlText +='<i class="icon" style="width:8px;height:8px;background-color:'+params[j].color+';margin-right:5px;vertical-align:1px;"></i>'+params[j].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+params[j].value+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+(params[j].value/sum*100).toFixed(2)+"%"+'<br/>'
			        	}
			        	return params[0].name+'</br>'+htmlText
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
	                		name: '淘内免费',
	                		// icon: 'rect'
	                	},
	                	{
	                		name: '付费流量'
	                	},
	                	{
	                		name: '自主访问'
	                	},
	                	{
	                		name: '淘外流量'
	                	},
	                	{
	                		name: '其他'
	                	}
	                ]
	            },

	             grid: {
			        bottom: '20%',
			        left: '2%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: false,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	            },
	            yAxis: {
	                type: 'value',
	            	boundaryGap: [0, 0.5],
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: false
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '淘内免费',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#eef3fd'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[0],  // 此处绑定图例颜色
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [20, 16, 85, 40, 76, 10, 25, 30, 41, 65, 88, 41, 40, 36, 20, 20, 30, 12, 32, 41, 25, 62, 65, 35,42, 40, 30, 81, 18, 36]
		            },
		            {
		                name: '付费流量',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#f5cd0b'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {
		                			color: colors[1]
		                		}
		                	}
		                },
		                data:  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, ]
		            },
		            {
		                name: '自主访问',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#f5dfcf'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[2],
		                		lineStyle: {
		                			color: colors[2]
		                		}
		                	}
		                },
		                data:  [0, 0, 0, 0, 21, 0, 63, 56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0]
		            },
		            {
		                name: '淘外流量',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#cfe9fb'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[3],
		                		lineStyle: {
		                			color: colors[3]
		                		}
		                	}
		                },
		                data:  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0]
		            },
		            {
		                name: '其他',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                smooth: true,  // 平滑折线
		                areaStyle: {normal: {
		                	color: '#e9d0f5'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[4],
		                		lineStyle: {
		                			color: colors[4]
		                		}
		                	}
		                },
		                data:  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 5, 0, 0, 0, 0]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        businessLevle1FlowChart.setOption(option);

	var myChartLoop1 = echarts.init(document.getElementById('loop-1'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#F3D024',"#FF8533","#4CB5FF","#BC64E5"];
	      option = {
			    series: [
			        {
			            name: '业务指标',
			            type: 'gauge',
			            aplitNumber: 0, // 分隔段数
			            title: {
			            	textStyle: {
			            		fontSize: 14,
			            		fontWeight: '600',
			            		color: '#333'
			            	}
			            },
			             detail : {
				            backgroundColor: 'rgba(30,144,255,0.8)',
				            borderWidth: 1,
				            borderColor: '#fff',
				            shadowColor : '#fff', //默认透明
				            shadowBlur: 5,
				            offsetCenter: [0, '50%'],       // x, y，单位px
				            textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
				                fontWeight: 'bolder',
				                color: '#fff'
				            }
				        },
			            axisLine: {
			            	lineStyle: {
			            		color:[
			            			[0.04,'#2062e6'],
			            			[1,'#cecece']
			            		],
			            		width:2
			            	}
			            },
			            axisTick: {
			            	splitNumber: 0,
			            	length: 0

			            },
			            axisLabel: {
			            	show: false
			            },
			            splitLine: {
			            	show: false
			            },
			            pointer: {   //  指针
			            	width: 0
			            },
			            detail: {formatter:'{value}%'},
			            data: [{value: 4, name: '访客-加购转化率'}]
			        }
			    ]
				};
	        // 使用刚指定的配置项和数据显示图表。
	        myChartLoop1.setOption(option);

	var myChartLoop2 = echarts.init(document.getElementById('loop-2'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#F3D024',"#FF8533","#4CB5FF","#BC64E5"];
	      option = {
			    series: [
			        {
			            name: '业务指标',
			            type: 'gauge',
			            aplitNumber: 0, // 分隔段数
			            title: {
			            	textStyle: {
			            		fontSize: 14,
			            		fontWeight: '600',
			            		color: '#333'
			            	}
			            },
			             detail : {
				            backgroundColor: 'rgba(30,144,255,0.8)',
				            borderWidth: 1,
				            borderColor: '#fff',
				            shadowColor : '#fff', //默认透明
				            shadowBlur: 5,
				            offsetCenter: [0, '50%'],       // x, y，单位px
				            textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
				                fontWeight: 'bolder',
				                color: '#fff'
				            }
				        },
			            axisLine: {
			            	lineStyle: {
			            		color:[
			            			[0.04,'#2062e6'],
			            			[1,'#cecece']
			            		],
			            		width:2
			            	}
			            },
			            axisTick: {
			            	splitNumber: 0,
			            	length: 0

			            },
			            axisLabel: {
			            	show: false
			            },
			            splitLine: {
			            	show: false
			            },
			            pointer: {   //  指针
			            	width: 0
			            },
			            detail: {formatter:'{value}%'},
			            data: [{value: 4, name: '访客-支持转化率'}]
			        }
			    ]
				};
	        // 使用刚指定的配置项和数据显示图表。
	        myChartLoop2.setOption(option);

    var myChartLoop3 = echarts.init(document.getElementById('loop-3'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#F3D024',"#FF8533","#4CB5FF","#BC64E5"];
	      option = {
			    series: [
			        {
			            name: '业务指标',
			            type: 'gauge',
			            aplitNumber: 0, // 分隔段数
			            title: {
			            	textStyle: {
			            		fontSize: 14,
			            		fontWeight: '600',
			            		color: '#333'
			            	}
			            },
			             detail : {
				            backgroundColor: 'rgba(30,144,255,0.8)',
				            borderWidth: 1,
				            borderColor: '#fff',
				            shadowColor : '#fff', //默认透明
				            shadowBlur: 5,
				            offsetCenter: [0, '50%'],       // x, y，单位px
				            textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
				                fontWeight: 'bolder',
				                color: '#fff'
				            }
				        },
			            axisLine: {
			            	lineStyle: {
			            		color:[
			            			[0.04,'#2062e6'],
			            			[1,'#cecece']
			            		],
			            		width:2
			            	}
			            },
			            axisTick: {
			            	splitNumber: 0,
			            	length: 0

			            },
			            axisLabel: {
			            	show: false
			            },
			            splitLine: {
			            	show: false
			            },
			            pointer: {   //  指针
			            	width: 0
			            },
			            detail: {formatter:'{value}%'},
			            data: [{value: 4, name: '访客-收藏转化率'}]
			        }
			    ]
				};
	        // 使用刚指定的配置项和数据显示图表。
	        myChartLoop3.setOption(option);

	var commentsCharts = echarts.init(document.getElementById('comments-charts'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','yellow',"orange"];
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
	                		name: '描述相符评分',
	                		// icon: 'rect'
	                	},
	                	{
	                		name: '卖家服务评分'
	                	},
	                	{
	                		name: '物流服务评分'
	                	}
	                ]
	            },

	             grid: {
			        bottom: '24%',
			        left: '2%',
			        right: '2%',
			        top: '22%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: true,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
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
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '描述相符评分',
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
		                data:  [0, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5]
		            },
		            {
		                name: '卖家服务评分',
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
		                data:  [0, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5]
		            },
		            {
		                name: '物流服务评分',
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
		                data:  [0, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5]
		            },
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        commentsCharts.setOption(option);

	var allBoardCharts = echarts.init(document.getElementById('all-board-chart'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','yellow',"orange"];
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
	                		name: '我的',
	                		// icon: 'rect'
	                	},
	                	{
	                		name: '同行同层平均'
	                	},
	                	{
	                		name: '同行同层优秀'
	                	}
	                ]
	            },

	             grid: {
			        bottom: '24%',
			        left: '2%',
			        right: '2%',
			        top: '22%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: true,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
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
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '我的',
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
		                data:  [0, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5]
		            },
		            {
		                name: '同行同层平均',
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
		                data:  [0, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5]
		            },
		            {
		                name: '同行同层优秀',
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
		                data:  [0, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5]
		            },
	            ]
	        };

	        // 使用刚指定的配置项和数据显示图表。
	        allBoardCharts.setOption(option);
</script>
<script type="text/javascript">
	// 	 移入 消息
	$(".header-right .cell.message").mouseenter(function() {
		$(this).find(".oui-popup-content").show();
	}).mouseleave(function() {
		$(this).find(".oui-popup-content").hide();
	})

	// 整体看板 中 图表 and 表格 切换
	$(".all-board .switch-chart-wrap").show();
	$(".all-board .chart-switch span").click(function() {
		var _this = $(this);
		_this.addClass("curr").siblings(".curr").removeClass("curr");
		var index = _this.index();
		if (index === 2) {
			$(".all-board .switch-table-wrap").show();
			$(".all-board .switch-chart-wrap").hide();
		}else if (index === 0) {
			$(".all-board .switch-table-wrap").hide();
			$(".all-board .switch-chart-wrap").show();
		}
	})
	// 点击 无线 pc
	$(".index-container .sub-title span").click(function(){
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
	})
	// 整体看板--图表下
	$(".all-board .line-1 .index-cell .cell-item").click(function() {
		$(this).addClass("curr").parents("div").siblings("div").children(".curr").removeClass("curr");
	})

	// 表格里面的数据  颜色
	$(".table-right td span").each(function(){
		var _this = $(this);
		if(_this.text().indexOf("+") != -1){
			_this.addClass("up");
		}
		if(_this.text().indexOf("-") != -1 && _this.text().length !=1){	
			_this.addClass("down");
		}
	})


	// 右侧 导航 start
	$(".ebase-FloorNav__root li").click(function() {
		var _this = $(this);
		var index = _this.index();
		if(index === 0) {
			console.log("first")
			$("body, html").animate({
				scrollTop: 0
			}, 300)
		} else if ( index === _this.parents("ul").children("li").length - 1) {
			console.log("last")
			$("body, html").animate({
				scrollTop: 0
			}, 300)
		} else {
			console.log("middle"+ index, $(".module").eq(index).offset().top)
			$("body, html").animate({
				scrollTop: $(".module").eq(index).offset().top - 59 + 'px'
			}, 300)
		}
	})

	// fixed
	$(window).scroll(function() {
		var scrollTop = $(window).scrollTop();
		// fixed start
		if(scrollTop > $(".header").outerHeight(true) + 16) {
			$(".header-wrap").addClass("fixed");
		} else {
			$(".header-wrap").removeClass("fixed");
		}
		if(scrollTop > 150) {
			$(".gototop").fadeIn(200);
		} else {
			$(".gototop").fadeOut(200);
		}
		/*if($(window).scrollTop() > $(".header-wrap").outerHeight(true) + 10) {
			$(".screen-header").addClass("fixed");
		}*/
		// fixed end

		// floorNav  start
		var distance = [];
		$(".main-wrap .module").each(function(i, item) {
			distance.push($(this).offset().top - (50+10))
		})

		for(var i = 0; i < distance.length; i ++) {
			if(scrollTop > 0 && scrollTop < distance[0]) {
				$(".ebase-FloorNav__root li").children("a").removeClass(".ebase-FloorNav__active").eq(0).children("a").addClass(".ebase-FloorNav__active");
			} else if (scrollTop > distance[i] && scrollTop < distance[i+1]) {
				$(".ebase-FloorNav__root li").children("a").removeClass("ebase-FloorNav__active");
				$(".ebase-FloorNav__root li").eq(i).children("a").addClass("ebase-FloorNav__active");
			} 
			if(scrollTop> distance[distance.length -1]) {
				$(".ebase-FloorNav__root li").children("a").removeClass("ebase-FloorNav__active");
				$(".ebase-FloorNav__root li").eq(distance.length-1).children("a").addClass("ebase-FloorNav__active");
			}
		}
		// floorNav  end

	})
	// 右侧 导航 end
</script>

</html>




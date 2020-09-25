<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--交易-->
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
				<li class="menu-item-inner lf curr">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">交易概況</span>
					</a>
				</li>
				<li class="menu-item-inner lf">
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
	<!-- 交易概況 start -->
	<div class="w-1040  rt switch-wrap transaction-analysis-container">
		<div class="trading-outlook-wrap bakff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">交易概況</h3>
			</div>
			<!-- 交易总览 start -->
			<div class="navbar-panel transaction-outlook">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>交易总览
					</h4>
					<div class="select-control ui-selector rt">
						<a href="javascript:;">
							<span class="ui-selector-value">所有终端</span>
							<span class="caret icon"></span>
						</a>
						<ul class="ui-selector-list select-control-list" style="display: none;">
							<li class="ui-selector-item curr">
								<span>所有终端</span>
							</li>
							<li class="ui-selector-item">
								<span>PC端</span>
							</li>
							<li class="ui-selector-item">
								<span>无线端</span>
							</li>
						</ul>
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
							<li class="ui-selector-item last-30">
								<span>最近30天平均</span>
							</li>
							<li class="ui-selector-item day">
								<span>日</span>
							</li>
							<li class="ui-selector-item week">
								<span>周</span>
							</li>
							<li class="ui-selector-item month">
								<span>月</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="content">
					<div class="left-list-item item-one">
						<div>
							<span class="left-item-title">访客人数</span>
							<span class="up trend-icon">
								<i class="icon icon-trend"></i>
							</span>
							<span class="num item-right-number">
								100.00%
							</span>
							<br>
							<span class="num">2</span>
						</div>
					</div>
					<div class="left-list-item item-two">
						<div>
							<span class="left-item-title">下单买家数</span>
							<span class="up trend-icon">
								<i class="icon icon-trend"></i>
							</span>
							<span class="num item-right-number">
								-
							</span>
							<br>
							<span class="num">0</span>
						</div>
						<div>
							<span class="left-item-title">下单金额</span>
							<span class="up trend-icon">
								<i class="icon icon-trend"></i>
							</span>
							<span class="num item-right-number">
								100.00%
							</span>
							<br>
							<span class="num">2</span>
						</div>
					</div>
					<div class="left-list-item item-three">
						<div>
							<span class="left-item-title">支付买家数</span>
							<span class="up trend-icon">
								<i class="icon icon-trend"></i>
							</span>
							<span class="num item-right-number">
								100.00%
							</span>
							<br>
							<span class="num">2</span>
						</div>
						<div>
							<span class="left-item-title">支付金额</span>
							<span class="down trend-icon">
								<i class="icon icon-trend"></i>
							</span>
							<span class="num item-right-number">
								100.00%
							</span>
							<br>
							<span class="num">2</span>
						</div>
						<div>
							<span class="left-item-title">客单价</span>
							<span class="up trend-icon">
								<i class="icon icon-trend"></i>
							</span>
							<span class="num item-right-number">
								100.00%
							</span>
							<br>
							<span class="num">2</span>
						</div>
					</div>
					<div class="right-drawable">
						<ul class="desc">
							<li>访客</li>
							<li>下单</li>
							<li>支付</li>
						</ul>
						<div class="rating-1 rating">
							<span class="right-item-title">下单转化率</span>
							<br>
							<span class="right-item-menu">1.95%</span>
						</div>
						<div class="rating-2 rating">
							<span class="right-item-title">下单-支付转化率</span>
							<br>
							<span class="right-item-menu">1.95%</span>
						</div>
						<div class="rating-3 rating">
							<span class="right-item-title">支付转化率</span>
							<br>
							<span class="right-item-menu">1.95%</span>
						</div>
					</div>
					<div class="data-desc data-desc-tail">
						<span class="data-desc-brand"></span>
						<div class="data-desc-panel">
							<div class="data-desc-box two-column">
								<div class="data-desc-header">
									<h4 class="title">流量相关解析</h4>
								</div>
								<div class="data-desc-content">
									<p>
										访客数不给力哟！想开拓更多的引流渠道？赶紧到
										<a href="javascript:;" target="_blank">
											流量地图
										</a>看看与同行之间的差距吧。
									</p>
								</div>
							</div>
							<div class="data-desc-box two-column">
								<div class="data-desc-header">
									<h4 class="title">访问质量解析</h4>
								</div>
								<div class="data-desc-content">
									<p>
										商品访客都不给力，想解读转化效果，都无力啊，先引流吧，到
										<a href="javascript:;" target="_blank">
											流量地图
										</a>看看，有什么妙招可以增加引流的，也可以使用
										<a href="javascript:;" target="_blank">选词助手</a>
										，结合
										<a href="javascript:;" target="_blank">方可对比</a>、
										，分析访客潜力需求并迎合它，为店铺引流。
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 交易总览 end -->

			<!-- 交易趋势  start -->
			<div class="navbar-panel transaction-trend">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>交易趋势
					</h4>
					<div class="operation-actions rt">
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
						<div class="date-text rt">2017-12-03 ~ 2017-12-09</div>
						<div class="select-control ui-selector rt">
							<a href="javascript:;">
								<span class="ui-selector-value">日期</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list" style="display: none;">
								<li class="ui-selector-item last-30 curr">
									<span>最近30天平均</span>
								</li>
								<li class="ui-selector-item day">
									<span>日</span>
								</li>
								<li class="ui-selector-item week">
									<span>周</span>
								</li>
								<li class="ui-selector-item month">
									<span>月</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="combopanel group-selecter">
						<div class="combopanel-panel">
							<div class="combopanel-groups">
								<div class="group-wrapper">
									<div class="group orflow">
										<span class="radio selected">
											<span class="option"></span>
											<span class="name">不比较</span>
										</span>
										<span class="radio">
											<span class="option"></span>
											<span class="name">同行对比</span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div style="display: inline-block;">
						<div class="select-control ui-selector content-selector" >
							<a href="javascript:;">
								<span class="ui-selector-value">厨房/电器/电压力锅</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list" style="display: none;">
								<li class="ui-selector-item curr">
									<span>厨房电器>电压力锅平均</span>
								</li>
								<li class="ui-selector-item">
									<span>厨房电器>电压力锅优秀</span>
								</li>
								<li class="ui-selector-item">
									<span>女装/女士精品>毛呢外套平均</span>
								</li>
								<li class="ui-selector-item">
									<span>女装/女士精品>毛呢外套优秀</span>
								</li>
								<li class="ui-selector-item">
									<span>洗护清洁剂/卫生巾/纸/香薰>纸品/湿巾平均</span>
								</li>
							</ul>
						</div>
					</div>
					<div class="transaction-trend-chart" id="transaction-trend-chart" style="width:980px;height: 360px;margin: 0 auto;"></div>
				</div>
			</div>
			<!-- 交易趋势  end -->
		</div>
	</div>
	<!-- 交易概況 end -->


	<!-- 交易构成  start -->
	<div class="w-1040  rt switch-wrap transaction-analysis-container">
		<div class="transaction-composition-wrap backff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">交易构成</h3>
				<div class="update-option block-date rt">
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
			<!-- 终端构成 start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>终端构成
					</h4>
					<div class="select-control download rt">
						<a href="javascript:;">
							<i class="icon"></i>
							<span class="val">下载</span>
						</a>
						<div class="ui-download-panel ui-download-right select-control-list" >
							<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
							<p class="ui-download-btns clearfix"><a href="javascript:;" class="btn btn-blank btn-sm">取消</a><a href="javascript:;" class="btn btn-primary btn-sm">确定</a></p>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="pie-chart">
						<div class="sunrise-chart" id="sunrise-chart" style="width: 199px;height: 230px;"></div>
					</div>
					<div class="list-content">
						<div class="header">
							<span style="text-align: left;">终端</span>
							<span>支付金额</span>
							<span>支付金额占比</span>
							<span>支付商品数</span>
							<span>支付买家数</span>
							<span>支付转化率</span>
							<span style="text-align: center;width: 89px;">操作</span>
						</div>
						<div class="body">
							<span style="text-align: left;">PC端</span>
							<span class="num">11.20</span>
							<span class="num">11.20</span>
							<span class="num">11.20</span>
							<span class="num">11.20</span>
							<span class="num">11.20</span>
							<span class="actions">
								<a href="javascript:;" class="overlook-trend">查看趋势</a>
							</span>
						</div>
						<div class="body">
							<span style="text-align: left;">无线端</span>
							<span class="num">11.20</span>
							<span class="num">11.20</span>
							<span class="num">11.20</span>
							<span class="num">11.20</span>
							<span class="num">11.20</span>
							<span class="actions">
								<a href="javascript:;" class="overlook-trend">查看趋势</a>
							</span>
						</div>
					</div>
					<div class="data-desc data-desc-tail">
						<span class="data-desc-brand"></span>
						<div class="data-desc-panel">
							<div class="data-desc-box">
								<div class="data-desc-header">
									<h4 class="title">终端构成解读</h4>
								</div>
								<div class="data-desc-content">
									<p>
										访客数不给力哟！想开拓更多的引流渠道？赶紧到
										<a href="javascript:;" target="_blank">
											流量地图
										</a>看看与同行之间的差距吧。
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 终端构成 end -->

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
						<div class="ui-download-panel ui-download-right select-control-list" >
							<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
							<p class="ui-download-btns clearfix"><a href="javascript:;" class="btn btn-blank btn-sm">取消</a><a href="javascript:;" class="btn btn-primary btn-sm">确定</a></p>
						</div>
					</div>
					<div class="actions-tab rt mt-20">
						<div class="ui-switch">
							<ul class="ui-switch-menu orflow">
								<li class="ui-switch-item lf">
									<a href="javascript:;">全部</a>
								</li>
								<li class="ui-switch-item lf" style="border-right:1px solid #ddd;border-left:1px solid #ddd;">
									<a href="javascript:;">PC</a>
								</li>
								<li class="ui-switch-item lf curr">
									<a href="javascript:;">无线</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="ui-switch">
						<ul class="ui-switch-menu">
							<li class="active ui-switch-item lf">
								<a href="javascript:;">
									<p class="tab-content-title">厨房电器</p>
									<p class="tab-content-subtitle">占比：80.58%</p>
								</a>
							</li>
							<li class="ui-switch-item lf">
								<a href="javascript:;">
									<p class="tab-content-title">女装/女士精品</p>
									<p class="tab-content-subtitle">占比：80.58%</p>
								</a>
							</li>
							<li class="ui-switch-item lf">
								<a href="javascript:;">
									<p class="tab-content-title text1">洗护清洁剂/洗护清洁剂/卫废物废物</p>
									<p class="tab-content-subtitle">占比：80.58%</p>
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
					<div class="data-desc data-desc-tail">
						<span class="data-desc-brand"></span>
						<div class="data-desc-panel">
							<div class="data-desc-box">
								<div class="data-desc-header">
									<h4 class="title">终端构成解读</h4>
								</div>
								<div class="data-desc-content">
									<p>
										访客数不给力哟！想开拓更多的引流渠道？赶紧到
										<a href="javascript:;" target="_blank">
											流量地图
										</a>看看与同行之间的差距吧。
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 类目构成 end -->

			<!-- 品牌构成 start -->
			<div class="navbar-panel brand-group">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>品牌构成
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
					<div class="actions-tab rt mt-20">
						<div class="ui-switch">
							<ul class="ui-switch-menu orflow">
								<li class="ui-switch-item lf">
									<a href="javascript:;">全部</a>
								</li>
								<li class="ui-switch-item lf" style="border-right:1px solid #ddd;border-left:1px solid #ddd;">
									<a href="javascript:;">PC</a>
								</li>
								<li class="ui-switch-item lf curr">
									<a href="javascript:;">无线</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="ebase-card-content">
						<div class="ebase-table-root">
							<table class="table">
								<thead class="thead">
									<tr>
										<th class="col brand-name text1">品牌名称<i class="icon icon-tips"></i></th>
										<th class="col orderable custom col-1">
											<span class="name">支付金额</span>
										</th>
										<th class="col orderable custom col-2">
											<span class="name">支付金额占比</span>
										</th>
										<th class="col orderable custom col-3">
											<span class="name">支付金额较上期</span>
										</th>
										<th class="col orderable custom col-4">
											<span class="name">支付买家数</span>
										</th>
										<th class="col orderable custom col-5">
											<span class="name">支付件数</span>
										</th>
										<th class="col actions">操作</th>
									</tr>
								</thead>
								<tbody class="tbody">
									<tr class="tr-tr">
										<td class="col brand-name">Midea/美的</td>
										<td class="col num">899.00</td>
										<td class="col num">899.00%</td>
										<td class="col num">
											<span class="flat grid-trend">
												<i class="icon-trend icon"></i>
												<span class="trend-text">-</span>
											</span>
										</td>
										<td class="col num">1</td>
										<td class="col num">1</td>
										<td class="col actions">
											<div class="brand-url">
												<a href="index.php?ctl=Seller_Sycm&met=shopDetail" target="_blank">店铺详情</a>
											</div>
											<div class="brand-url">
												<a href="javascript:;" target="_blank">行业详情</a>
											</div>
										</td>
									</tr>
									<tr class="tr-tr">
										<td class="col brand-name">Midea/美的</td>
										<td class="col num">899.00</td>
										<td class="col num">899.00%</td>
										<td class="col num">
											<span class="flat grid-trend">
												<i class="icon-trend icon"></i>
												<span class="trend-text">-</span>
											</span>
										</td>
										<td class="col num">1</td>
										<td class="col num">1</td>
										<td class="col actions">
											<div class="brand-url">
												<a href="index.php?ctl=Seller_Sycm&met=shopDetail" target="_blank">店铺详情</a>
											</div>
											<div class="brand-url">
												<a href="javascript:;" target="_blank">行业详情</a>
											</div>
										</td>
									</tr>
									<tr class="tr-tr">
										<td class="col brand-name">Midea/美的</td>
										<td class="col num">899.00</td>
										<td class="col num">899.00%</td>
										<td class="col num">
											<span class="down grid-trend">
												<i class="icon-trend icon"></i>
												<span class="trend-text">-</span>
											</span>
										</td>
										<td class="col num">1</td>
										<td class="col num">1</td>
										<td class="col actions">
											<div class="brand-url">
												<a href="index.php?ctl=Seller_Sycm&met=shopDetail" target="_blank">店铺详情</a>
											</div>
											<div class="brand-url">
												<a href="javascript:;" target="_blank">行业详情</a>
											</div>
										</td>
									</tr>
									<tr class="tr-tr">
										<td class="col brand-name">Midea/美的</td>
										<td class="col num">899.00</td>
										<td class="col num">899.00%</td>
										<td class="col num">
											<span class="up grid-trend">
												<i class="icon-trend icon"></i>
												<span class="trend-text">-</span>
											</span>
										</td>
										<td class="col num">1</td>
										<td class="col num">1</td>
										<td class="col actions">
											<div class="brand-url">
												<a href="index.php?ctl=Seller_Sycm&met=shopDetail" target="_blank">店铺详情</a>
											</div>
											<div class="brand-url">
												<a href="javascript:;" target="_blank">行业详情</a>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="data-desc data-desc-tail">
						<span class="data-desc-brand"></span>
						<div class="data-desc-panel">
							<div class="data-desc-box">
								<div class="data-desc-header">
									<h4 class="title">终端构成解读</h4>
								</div>
								<div class="data-desc-content">
									<p>
										访客数不给力哟！想开拓更多的引流渠道？赶紧到
										<a href="javascript:;" target="_blank">
											流量地图
										</a>看看与同行之间的差距吧。
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 品牌构成 end -->

			<!-- 价格带构成 start -->
			<div class="navbar-panel trade-price">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>价格带构成
					</h4>
					<div class="select-control download rt">
						<a href="javascript:;">
							<i class="icon"></i>
							<span class="val">下载</span>
						</a>
						<div class="ui-download-panel ui-download-right select-control-list" >
							<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
							<p class="ui-download-btns clearfix"><a href="javascript:;" class="btn btn-blank btn-sm">取消</a><a href="javascript:;" class="btn btn-primary btn-sm">确定</a></p>
						</div>
					</div>
					<div class="actions-tab rt mt-20">
						<div class="ui-switch">
							<ul class="ui-switch-menu orflow">
								<li class="ui-switch-item lf">
									<a href="javascript:;">全部</a>
								</li>
								<li class="ui-switch-item lf" style="border-right:1px solid #ddd;border-left:1px solid #ddd;">
									<a href="javascript:;">PC</a>
								</li>
								<li class="ui-switch-item lf curr">
									<a href="javascript:;">无线</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="list-content">
						<div class="header">
							<span class="first-child">价格带</span>
							<span class="second-child">支付买家占比</span>
							<span class="third-child">支付买家数</span>
							<span class="forth-child">支付金额</span>
							<span class="fifth-child">支付转化率</span>
							<span class="actions">操作</span>
						</div>
						<div class="body">
							<span class="first-child">0-5元</span>
							<span class="num second-child">
								<span class="payper">0.00%</span>
								<span style="background: rgb(34,181,191);height: 12px;width: 0;visibility: hidden;"></span>
							</span>
							<span class="num third-child">11.20</span>
							<span class="num forth-child">0.20</span>
							<span class="num fifth-child">0.00%</span>
							<span class="actions">
								<a href="javascript:;" class="overlook-trend">查看趋势</a>
							</span>
						</div>
						<div class="body">
							<span class="first-child">0-5元</span>
							<span class="num second-child">
								<span class="payper">0.00%</span>
								<span style="background: rgb(34,181,191);height: 12px;width: 0;visibility: hidden;"></span>
							</span>
							<span class="num third-child">11.20</span>
							<span class="num forth-child">0.20</span>
							<span class="num fifth-child">0.00%</span>
							<span class="actions">
								<a href="javascript:;" class="overlook-trend">查看趋势</a>
							</span>
						</div>
						<div class="body">
							<span class="first-child">0-5元</span>
							<span class="num second-child">
								<span class="payper">0.00%</span>
								<span class="progress" style="background: rgb(34,181,191);height: 12px;width: 0;visibility: hidden;"></span>
							</span>
							<span class="num third-child">11.20</span>
							<span class="num forth-child">0.20</span>
							<span class="num fifth-child">0.00%</span>
							<span class="actions">
								<a href="javascript:;" class="overlook-trend">查看趋势</a>
							</span>
						</div>
						<div class="body">
							<span class="first-child">0-5元</span>
							<span class="num second-child">
								<span class="payper">0.00%</span>
								<span class="progress" style="background: rgb(34,181,191);height: 12px;width: 30px;"></span>
							</span>
							<span class="num third-child">11.20</span>
							<span class="num forth-child">0.20</span>
							<span class="num fifth-child">0.00%</span>
							<span class="actions">
								<a href="javascript:;" class="overlook-trend">查看趋势</a>
							</span>
						</div>
					</div>
					<div class="data-desc data-desc-tail">
						<span class="data-desc-brand"></span>
						<div class="data-desc-panel">
							<div class="data-desc-box">
								<div class="data-desc-header">
									<h4 class="title">终端构成解读</h4>
								</div>
								<div class="data-desc-content">
									<p>
										访客数不给力哟！想开拓更多的引流渠道？赶紧到
										<a href="javascript:;" target="_blank">
											流量地图
										</a>看看与同行之间的差距吧。
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 价格带构成 end -->

			<!-- 资金回流构成 start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>资金回流构成
					</h4>
					<div class="rt" style="font-size: 12px; line-height: 60px;">数据更新日期：2017-11-15</div>
				</div>
				<div class="content">
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
					<div class="data-desc data-desc-tail data-desc-tip">
						<span class="data-desc-brand"></span>
						<div class="data-desc-panel">
							<div class="data-desc-box">
								<div class="data-desc-content">
									<p>
										不错，您的资金疑惑另
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 资金回流构成 end -->
		</div>
	</div>
	<!-- 交易构成  end -->


	<!-- 交易明细  start -->
	<div class="w-1040  rt switch-wrap transaction-analysis-container">
		<div class="transaction-details-wrap backff">
			<div class="wrap-title">
				<div class="title-lf lf">交易明细</div>
				<div class="pagesBillingInfo__header rt pagesBillingInfo__header">
					<div class="pagesBillingInfo__keyword">
						<div class="SharedSearch__searchWrapper">
							<input type="text" placeholder="请输入订单编号" class="SharedSearch__search">
							<i class="oui-icon oui-icon-search SharedSearch__searchIcon"></i>
						</div>
					</div>
					<div class="update-option  rt">
						<p class="option rt">
							<span>自然日（2017-09-26~2017-09-26）</span>
							<i class="icon caret"></i>
						</p>
						<div class="date-wrap" style="display: none;">
							<ul>
								<li class="datePicker-item datetimepicker-day">
									<span class="datePicker-rangeText">自然日</span>
									<span class="datePicker-rangeTime"></span>
								</li>
							</ul>
							<div class="laydate-wrap laydate-wrap-day" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
							<div class="laydate-wrap laydate-wrap-week" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
							<div class="laydate-wrap laydate-wrap-month" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="ebase-card-content">
				<div class="data-desc data-desc-tail">
					<div class="dataInfo-icon">
						明细
						<br>
						诊断
					</div>
					<div class="data-desc-panel">
						<div class="data-desc-box two-column">
							<div class="data-desc-content">
								<p>
									您的交易明细数据完整度诊断如下：
									<br>
									交易订单中的商品都没有成本金额，商品成本缺失将影响订单、店铺利润的准确度，<a href="javascript:;">点击配置商品成本 </a>
									<br>
									您还可以<a href="javascript:;">点击配置运费模板</a>，完善运费计算方式，了解运费成本情况。
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="ebase-table-root">
					<table class="table">
						<thead class="thead">
							<tr>
								<th class="th col-0 col-orderId" style="text-align: left;">订单编号</th>
								<th class="th col-1 col-gmtCreatTime" style="text-align: left;">订单创建时间</th>
								<th class="th col-2 col-payTime" style="text-align: left;">支付时间</th>
								<th class="th col-3 col-payFee" style="text-align: left;">支付金额</th>
								<th class="th col-4 col-confirmFee" style="text-align: left;">确认收获金额</th>
								<th class="th col-5 col-commodityCost" style="text-align: left;">商品成本</th>
								<th class="th col-6 col-freightCost" style="text-align: left;">
									<span class="pagesInfo-freight">
										<span>运费成本</span>
										<span class="tips-wrap">
											<i class="icon icon-tips"></i>
											<div class="tips-guide-wrap">
												指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
											</div>
										</span>
									</span>
								</th>
								<th class="th col-7 col-orderId" style="text-align: left;">操作</th>
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
				<div class="pagesInfo-tips">以上数据所有金额单位名称均为（元）</div>
			</div>
			<!-- <div class="authorize-title">授权书</div>
			<div class="navbar-panel authorize">
				<div class="content">
					<div>
						<ul class="auth-content">
							<li>
								<p>在接受本授权书之前，请您（以下可称为“授权人”）仔细阅读本授权书的全部内容（特别是以<u><b>粗体下划线</b></u>标注的内容）。如果您对本授权书的条款有疑问，或者无法准确理解条款内容的，请不要进行后续操作。</p>
							</li>
							<li>
								<p class="auth-title">授权书</p>
							</li>
							<li>
								<p>生意参谋零售电商版——财务分析（以下可简称“财务分析”）旨在通过对您店铺的营业收入、支出、资产负债、现金流量等财务数据的分析与解读，帮助您了解店铺的财务状况。</p>
							</li>
							<li>
								<p>
									<u><b>为了向您提供财务分析相关服务，并维护、改进前述服务，您同意支付宝（中国）网络技术有限公司（以下简称“支付宝”）、浙江网商银行股份有限公司（以下简称“网商银行”）将您的店铺绑定的支付宝账户对应的收支相关数据（包括但不限于花呗、信用卡、支付宝余额等）、 网商银行及其网站或软件客户端（以下简称“网商银行平台”）交易数据、资产及负债数据、产品及服务信息等（包括但不限于由网商银行自营的余利宝、贷款、理财等产品，以及通过网商银行平台由第三方为您提供的担保、保理等产品信息，如有）分享给淘宝（中国）软件有限公司（以下简称“淘宝”）； 您同意淘宝将您的店铺相关收支数据（包括但不限于成功退款金额等）、您在生意参谋零售电商版中自行上传的相关数据（包括但不限于成本等）分享给支付宝、网商银行；您同意支付宝、网商银行将您的前述授权数据及相关加工、分析结果反馈给淘宝并展示在财务分析各功能模块中。</b></u>
								</p>
							</li>
							<li>
								<p>您保证有合法权利向支付宝、网商银行及淘宝进行相应的数据授权，并保证数据来源合法、不侵犯他人合法权益（包括但不限于个人隐私权等）。</p>
							</li>
							<li>
								<p>
									您理解并同意，淘宝并非财务分析领域的专业人士，仅能以“现状”、“有缺陷”和“当前功能”的状态提供财务分析服务，您通过财务分析模块查询、查看的各项数据仅为通过计算机对淘宝和/或其关联公司、支付宝、 网商银行相关信息以及您自行上传的数据的客观统计数据及其加工、分析结果，淘宝不保证财务分析模块中数据内容的准确性、有效性、及时性、真实性，淘宝不对您基于财务分析模块中的数据内容做出的任何行为的结果承担任何责任。
								</p>
							</li>
							<li>
								<p>
									<u>本授权书一经确认即生效。</u>
								</p>
							</li>
							<li>
								<p>特此授权！</p>
							</li>
						</ul>
					</div>
					<span class="oui-checkbox oui-checkbox">
						<span class="oui-icon-stacked">
							<i class="oui-icon icon oui-icon-checkbox-border"></i>
						</span>
						<span class="oui-form-name">
						已阅读并同意该协议
						</span>
					</span>
					<span class="preview">产品预览</span>
				</div>
			</div> -->
		</div>
	</div>
	<!-- 交易明细  end -->

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
	var sunriseChart = echarts.init(document.getElementById('sunrise-chart'));
    	var colors = ["#6fcbc9","#98cd6d"];
    	option = {
		    /*tooltip : {
		        trigger: 'item',
		        formatter: "{a} <br/>{b} : {c} ({d}%)"
		    },*/
		    legend: {
		        orient: 'vertical',
		        left: 'left',
		        bottom: 'bottom',
		        data: ['PC端','无线端']
		    },
		    series : [
		        {
		            type: 'pie',
		            radius : '85%',
		            center: ['50%', '38%'],
		            label: {    //控制引导线及文字显示隐藏
		            	normal: {
		            		show: false
		            	}
		            	/*emphasis: {
		            		show: false
		            	}*/
		            },
		            /*normal: {
	                    show: false
	                },*/
		            data:[
		                {
		                	value:335, 
		                	name:'PC端',
		                	hoverAnimation: false,
		                	itemStyle: {
		                		normal: {
		                			// borderWidth: 20,
		                			// borderColor: 'transparent',
		                			color: colors[0]
		                		}
		                	}
		                },
		                {
		                	value:310, 
		                	name:'无线端',
		                	hoverAnimation: false,
		                	itemStyle: {
		                		normal: {
		                			// borderWidth: 20,
		                			// borderColor: 'transparent',
		                			color: colors[1]
		                		}
		                	}	
		                }
		            ]
		            /*itemStyle: {
		                emphasis: {
		                    shadowBlur: 10,
		                    shadowOffsetX: 0,
		                    shadowColor: 'rgba(0, 0, 0, 0.5)'
		                }
		            }*/
		        }
		    ]
		};
		sunriseChart.setOption(option);

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
	lay('.select-control .select-control-list .day').on('click', function(){
		// var _this = this.parentNode.parentNode.previousSibling
		var _this = $(this).parents(".ui-selector").siblings(".date-text").get(0);
	  laydate.render({
	    elem: _this,
	    format: 'yyyy-MM-dd ~ yyyy-MM-dd',
	    show: true,
	    closeStop: '.date-text',
	    trigger: 'dbclick',
	    showBottom: false,
	    position: 'absolute',
	    top: '50px'
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
	lay('.select-control .select-control-list .week').on('click', function(){
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
	});
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
	// 单选按钮 click
	$(".group .radio").click(function(){
		var _this = $(this);
		_this.addClass("selected").siblings(".selected").removeClass("selected");
		if(_this.index() === 1) {
			_this.parents(".content").find(".ui-selector").css({"display":"inline-block"});
		}else{
			_this.parents(".content").find(".ui-selector").hide();

		}
	})
	
	// 划入 问好图标
	$(".tips-wrap").mouseenter(function(){
		$(this).children(".tips-guide-wrap").show();
	}).mouseleave(function(){
		$(this).children(".tips-guide-wrap").hide();
	})

	// 类目构成---点击 ui-switch
	// $(".goods-unusual-wrap .content").eq(0).show();
	$(".transaction-analysis-container .ui-switch-item").click(function(){
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

	// 查看详情 弹框
	$("a.overlook-trend").click(function(){
		$(".look-trend-dialog").fadeIn(500);
	})
	$(".dialog-mask .close").click(function() {
		$(".dialog-mask").hide();
	})
	$(".dialog-mask .combo-panel-lite .checkbox").click(function(){
		$(this).toggleClass("selected");
		/*if($(this).parents(".combo-panel-lite").find(".selected").length > 5) {
			$(this).parents(".combo-panel-lite").siblings(".error-message").text("最多选择5个指标");
		}else {
			$(this).parents(".combo-panel-lite").siblings(".error-message").text("曝光量，点击次数，点击率暂只提供PC端数据");
	}*/
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
		e.stopPropagation();
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
		_this.parents(".ui-selector").find(".ui-selector-value").text($(this).find("span").text());
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

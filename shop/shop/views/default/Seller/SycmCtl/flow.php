<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--流量-->
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
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
				<li class="nav-item lf curr">
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
<div class="main-wrap w-1430 mt-10">
	<div class="nav lf w-160">
		<div class="left-nav">
			<div class="topLogo">
				<div class="topLogoContent">
					<i class="icon"></i>
					<p>流量分析</p>
				</div>
			</div>
			<ul class="menu-list">
				<li class="menu-item lf">
					<p class="nav-name"><i class="icon"></i>流量概况</p>
					<ul class="menu-list-inner">
						<li class="menu-item-inner lf curr">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">流量看板</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">计划监控</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">访客分析</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="menu-item lf">
					<p class="nav-name"><i class="icon"></i>来源分析</p>
					<ul class="menu-list-inner">
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">店铺来源</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">商品来源</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">外投监控</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">选词助手</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="menu-item lf">
					<p class="nav-name"><i class="icon"></i>路径分析</p>
					<ul class="menu-list-inner">
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">店内路径</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">流量去向</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="menu-item lf">
					<p class="nav-name"><i class="icon"></i>页面分析</p>
					<ul class="menu-list-inner">
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">页面分析</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">页面配置</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="menu-item lf">
					<p class="nav-name"><i class="icon"></i>计划中心</p>
					<ul class="menu-list-inner">
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">运营计划</span>
							</a>
						</li>
						<!-- <li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">事件配置</span>
							</a>
						</li> -->
					</ul>
				</li>
				
			</ul>
		</div>
	</div>
	<!-- 流量看板 start -->
	<div class="w-1260 rt switch-wrap flow-container">
		<div class="flow-wrap">
			<div class="screen-header h-50">
				<div class="update-option">
					<p class="lf update">更新时间：<span>2017-02-26&nbsp;&nbsp;09:45:36</span></p>
					<p class="rt option"><span>实时</span><i class="icon caret"></i></p>
					<div class="date-wrap">
						<ul>
							<li class="datePicker-item active realtime">
								<span class="datePicker-rangeText">实时</span>
								<span class="datePicker-rangeTime rt"></span>
							</li>
							<li class="datePicker-item lastest-n">
								<span class="datePicker-rangeText">最近1天</span>
								<span class="datePicker-rangeTime rt">（2017-09-26 ~ 2017-09-26）</span>
							</li>
							<li class="datePicker-item lastest-n">
								<span class="datePicker-rangeText">最近7天</span>
								<span class="datePicker-rangeTime rt">（2017-09-20 ~ 2017-09-26）</span>
							</li>
							<li class="datePicker-item lastest-n">
								<span class="datePicker-rangeText">最近30天</span>
								<span class="datePicker-rangeTime rt">（2017-08-28 ~ 2017-09-26）</span>
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
						<div class="laydate-wrap laydate-wrap-day" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;background: #fff;"></div>
						<div class="laydate-wrap laydate-wrap-week" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;background: #fff;"></div>
						<div class="laydate-wrap laydate-wrap-month" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;background: #fff;"></div>
					</div>
				</div>
			</div>
			<!-- 流量总览 start -->
			<div class="flow-overview-wrap module mt-10">
				<div class="wrap-title">
					<div class="title-lf lf">流量总览</div>
					<div class="operation-actions rt">
						<div class="select-control ui-selector lf">
							<a href="javascript:;">
								<span class="ui-selector-value">分时段趋势</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
								<li class="ui-selector-item curr">
									<span>分时段趋势</span>
								</li>
								<li class="ui-selector-item">
									<span>累积趋势</span>
								</li>
							</ul>
						</div>
						<div class="select-control ui-selector lf">
							<a href="javascript:;">
								<span class="ui-selector-value">所有终端</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
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
					</div>
				</div>
				<div class="ebase-card-content">
					<ul class="flow-overview-list list-parent orflow">
						<li class="flow-overview-item lf active">
							<div class="flow-overview-tab">
								<div class="flow-overview-name">访问店铺</div>
								<div class="flow-overview-indexCell-root orflow">
									<div class="flow-overview-indexCell-indexName lf">
										访客数
									</div>
									<div class="flow-overview-indexCell-indexValue num rt">3</div>
									<div class="flow-overview-indexCell-indexChange orflow">
										<span class="pull-left lf">较前日同时段</span>
										<span class="pull-right up rt">
											<span class="num">150</span>
											<span class="r-trend">
												<i class="icon icon-trend"></i>
											</span>
										</span>
									</div>
								</div>
								<div id="shop-visit-chart" style="width: 310px;height:64px;"></div>
							</div>
						</li>
						<li class="flow-overview-item lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-name">访问商品</div>
								<div class="flow-overview-indexCell-root orflow">
									<div class="flow-overview-indexCell-indexName lf">
										商品访客数
									</div>
									<div class="flow-overview-indexCell-indexValue num rt">3</div>
									<div class="flow-overview-indexCell-indexChange orflow">
										<span class="pull-left lf">较前日同时段</span>
										<span class="pull-right down rt">
											<span class="num">-</span>
											<span class="r-trend">
												<i class="icon icon-trend"></i>
											</span>
										</span>
									</div>
								</div>
								<div id="goods-visit-chart" style="width: 310px;height:64px;"></div>
							</div>
						</li>
						<li class="flow-overview-item lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-name">转化</div>
								<div class="flow-overview-indexCell-root orflow">
									<div class="flow-overview-indexCell-indexName lf">
										支付买家数
									</div>
									<div class="flow-overview-indexCell-indexValue num rt">3</div>
									<div class="flow-overview-indexCell-indexChange orflow">
										<span class="pull-left lf">较前日同时段</span>
										<span class="pull-right down rt">
											<span class="num">20</span>
											<span class="r-trend">
												<i class="icon icon-trend"></i>
											</span>
										</span>
									</div>
								</div>
								<div id="transfer-chart" style="width: 310px;height:64px;"></div>
							</div>
						</li>
					</ul>

					<ul class="flow-overview-list list-child orflow">
						<li class="flow-overview-item item-child lf active">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										访客数
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right up">
											<span class="num">-</span>
											<span class="r-trend">
												<i class="icon icon-trend"></i>
											</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										浏览量
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right up">
											<span class="num">65</span>
											<span class="r-trend">
												<i class="icon icon-trend"></i>
											</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										人均浏览量
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right up">
											<span class="num">-</span>
											<span class="r-trend">
												<i class="icon icon-trend"></i>
											</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										老访客数
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right up">
											<span class="num">-</span>
											<span class="r-trend">
												<i class="icon icon-trend"></i>
											</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										新访客数
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right up">
											<span class="num">-</span>
											<span class="r-trend">
												<i class="icon icon-trend"></i>
											</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										关注店铺人数
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right up">
											<span class="num">-</span>
											<span class="r-trend">
												<i class="icon icon-trend"></i>
											</span>
										</span>
									</div>
								</div>
							</div>
						</li>
					</ul>
					<ul class="flow-overview-list list-child orflow">
						<li class="flow-overview-item item-child lf active">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										访客数
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right down">
											<span class="num">-</span>
											<span class="r-trend">
												<i class="icon icon-trend"></i>
											</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										浏览量
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right">
											<span class="num">-</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										人均浏览量
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right">
											<span class="num">-</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										老访客数
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right">
											<span class="num">-</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										关注店铺人数
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right">
											<span class="num">-</span>
										</span>
									</div>
								</div>
							</div>
						</li>
					</ul>
					<ul class="flow-overview-list list-child orflow">
						<li class="flow-overview-item item-child lf active">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										访客数
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right">
											<span class="num">-</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										浏览量
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right">
											<span class="num">-</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										人均浏览量
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right">
											<span class="num">-</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										老访客数
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right">
											<span class="num">-</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										新访客数
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right">
											<span class="num">-</span>
										</span>
									</div>
								</div>
							</div>
						</li>
						<li class="flow-overview-item item-child lf">
							<div class="flow-overview-tab">
								<div class="flow-overview-indexCell-root">
									<div class="flow-overview-indexCell-indexName">
										关注店铺人数
									</div>
									<div class="flow-overview-indexCell-indexValue num">3</div>
									<div class="flow-overview-indexCell-indexChange">
										<span class="pull-left">较前日同时段</span>
										<span class="pull-right">
											<span class="num">-</span>
										</span>
									</div>
								</div>
							</div>
						</li>
					</ul>
					<div class="charts" id="flow-overview-chart" style="width:1200px;height: 330px;"></div>
				</div>
			</div>
			<!-- 流量总览 end -->

			<!-- 我的关注  start -->
			<div class="my-attention-wrap module mt-10">
				<div class="wrap-title">
					<div class="title-lf lf">我的关注</div>
					<div class="switch-wrap-att orflow">
						<span class="curr lf">
							<a href="javascript:;">流量来源</a>
						</span>
						<span class="lf">
							<a href="javascript:;">商品</a>
						</span>
					</div>
					<div class="operation-actions rt">
						<div class="select-control ui-selector lf">
							<a href="javascript:;">
								<span class="ui-selector-value">无线端</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
								<li class="ui-selector-item curr">
									<span>PC端</span>
								</li>
								<li class="ui-selector-item">
									<span>无线端</span>
								</li>
							</ul>
						</div>
					</div>
					<div class="add-attention rt">
						<span class="add">+</span>添加关注
					</div>
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table">
						<div class="ebase-table-root">
							<table class="table">
								<thead class="thead">
									<tr>
										<th class="th col-0" style="text-align: left;">排名</th>
										<th class="th col-1" style="text-align: left;">来源名称</th>
										<th class="th col-2 orderable sortableTh" style="text-align: right;">
											<span>访客数</span>
											<span class="ebase-ratio">(占比)</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-3" style="text-align: right;">操作</th>
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
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table">
						<div class="ebase-table-root">
							<table class="table">
								<thead class="thead">
									<tr>
										<th class="th col-0" style="text-align: left;">排名</th>
										<th class="th col-1" style="text-align: left;">来源名称</th>
										<th class="th col-2" style="text-align: right;">
											<div class="ebase-sortTh-root">
												<div>
													<span>访客数</span>
													<span class="icon"></span>
												</div>
											</div>
										</th>
										<th class="th col-3" style="text-align: right;">操作</th>
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
				</div>
			</div>
			<!-- 我的关注  end -->
			<!-- 流量来源TOP10  start -->
			<div class="flowTop10-resource-wrap module mt-10">
				<div class="wrap-title">
					<div class="title-lf lf">流量来源排行TOP10</div>
					<div class="shop-resource rt">
						<a href="javascript:;">
							店铺来源<i class="icon">></i>
						</a>
					</div>
					<div class="operation-actions rt">
						<div class="select-control ui-selector lf">
							<a href="javascript:;">
								<span class="ui-selector-value">无线端</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
								<li class="ui-selector-item curr">
									<span>PC端</span>
								</li>
								<li class="ui-selector-item">
									<span>无线端</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table">
						<div class="ebase-table-root">
							<table class="table">
								<thead class="thead">
									<tr>
										<th></th>
										<th></th>
										<th colspan="1" class="ebase-column-group" style="padding:15px 0 0 50px;text-align: left;">
											访问
										</th>
										<th></th>
									</tr>
									<tr>
										<th class="col-0" style="text-align: left;width:60px;">排名</th>
										<th class="col-1" style="text-align: left;">来源名称</th>
										<th class="col-2 orderable sortableTh" style="text-align: right;">
											<span>访客数</span>
											<span class="ebase-ratio">(占比4)</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="col-3" style="text-align: right;">操作</th>
									</tr>
								</thead>
								<tbody class="tbody">
									<tr>
										<td class="col-0" style="width:60px;text-align: left;">
											<span>
												<span>1</span>
											</span>
										</td>
										<td class="col-1" style="text-align: left;">
											我的淘宝
										</td>
										<td class="col-2" style="text-align: right;">
											<div class="ebase-detail-index">
												<p class="ebase-detail-index-td">
													<span class="ebase-detail-value">1</span>
													<span class="ebase-detail-rate">(100.00%)</span>
												</p>
											</div>
										</td>
										<td class="col-3" style="text-align: right">
											<div style="padding-right: 10px;">
												<a href="javascript:;">操作</a>
											</div>
										</td>
									</tr>
									<tr>
										<td class="col-0" style="width:60px;text-align: left;">
											<span>
												<span>1</span>
											</span>
										</td>
										<td class="col-1" style="text-align: left;">
											我的淘宝
										</td>
										<td class="col-2" style="text-align: right;">
											<div class="ebase-detail-index">
												<p class="ebase-detail-index-td">
													<span class="ebase-detail-value">1</span>
													<span class="ebase-detail-rate">(100.00%)</span>
												</p>
											</div>
										</td>
										<td class="col-3" style="text-align: right">
											<div style="padding-right: 10px;">
												<a href="javascript:;">操作</a>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- 流量来源TOP10  end -->

			<!-- 商品流量排行TOP10  start -->
			<div class="goods-flow flowTop10-resource-wrap module mt-10 ">
				<div class="wrap-title">
					<div class="title-lf lf">商品流量排行TOP10</div>
					<div class="shop-resource rt">
						<a href="javascript:;">
							商品来源<i class="icon">></i>
						</a>
					</div>
					<div class="operation-actions rt">
						<div class="select-control ui-selector lf">
							<a href="javascript:;">
								<span class="ui-selector-value">无线端</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
								<li class="ui-selector-item curr">
									<span>PC端</span>
								</li>
								<li class="ui-selector-item">
									<span>无线端</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table">
						<div class="ebase-table-root">
							<table class="table">
								<thead class="thead">
									<tr>
										<th></th>
										<th></th>
										<th colspan="1" class="ebase-column-group" style="padding:15px 0 0 50px;text-align: left;">
											访问
										</th>
										<th colspan="2" class="ebase-column-group" style="padding:15px 0 0 50px;text-align: left;">
											转化
										</th>
										<th></th>
										<th></th>
									</tr>
									<tr>
										<th class="col-0" style="text-align: left;width:60px;">排名</th>
										<th class="col-1" style="text-align: left;">商品</th>
										<th class="col-2 orderable sortableTh" style="text-align: right;">
											<span>访客数</span>
											<span class="ebase-ratio">(占比7)</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="col-3" style="text-align: center;">
											<div class="ebase-sortTh-root">
												<div>
													<span>支付买家数</span>
													<span class="icon"></span>
												</div>
											</div>
										</th>
										<th class="col-4" style="text-align: center; border-right: 1px solid #f4f4f4;">
											<div class="ebase-sortTh-root">
												<div>
													<span>支付转化率</span>
													<span class="icon"></span>
												</div>
											</div>
										</th>
										<th class="col-4" style="text-align: right;">操作</th>
									</tr>
								</thead>
								<tbody class="tbody">
									<tr>
										<td class="col-0" style="width:60px;text-align: left;">
											<span>
												<span>1</span>
											</span>
										</td>
										<td class="col-1" style="text-align: left;">
											<a href="javascript:;">
												<div class="img-center lf">
													<img src="http://taos168.com/uploadfile/product/182/2016/11/07/1478481754.jpg">
												</div>
												<p class="img-desc lf">放假额外附加反季节口嚼酒接了我家黑你纪委近日为风机房费附加</p>
											</a>
										</td>
										<td class="col-2" style="text-align: right;">
											<div class="ebase-detail-index">
												<p class="ebase-detail-index-td">
													<span class="ebase-detail-value">1</span>
													<span class="ebase-detail-rate">(100.00%)</span>
												</p>
											</div>
										</td>
										<td class="col-3" style="text-align: center;">
											<div style="padding-right: 10px;">
												1
											</div>
										</td>
										<td class="col-4" style="text-align: center;border-right: 1px solid #f4f4f4;">
											<div style="padding-right: 10px;">
												100.00%
											</div>
										</td>
										<td class="col-5" style="text-align: right">
											<div style="padding-right: 10px;">
												<a href="index.php?ctl=Seller_Sycm&met=singleProductAnalysis"><span style="color:#2062e6">单品分析</span></a>
												<span style="color:#999;">单品来源</span>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- 商品流量排行TOP10  end -->

			<!-- 人群特征  start -->
			<div class="couple-feature-wrap module mt-10">
				<div class="wrap-title">
					<div class="title-lf lf">人群特征</div>
					<div class="switch-wrap-att orflow">
						<span class="curr lf">
							<a href="javascript:;">进店人群</a>
						</span>
						<span class="lf">
							<a href="javascript:;">商品访问人群</a>
						</span>
						<span class="lf">
							<a href="javascript:;">转化人群</a>
						</span>
					</div>
					<div class="operation-actions rt">
						<div class="select-control ui-selector lf">
							<a href="javascript:;">
								<span class="ui-selector-value">无线端</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
								<li class="ui-selector-item curr">
									<span>PC端</span>
								</li>
								<li class="ui-selector-item">
									<span>无线端</span>
								</li>
							</ul>
						</div>
					</div>
					<!-- <div class="add-attention rt">
						<span class="add">+</span>添加关注
					</div> -->
				</div>
				<div class="ebase-card-content">
					<div class="flow-crowds-root">
						<div class="pieChart-wrapper clearfix">
							<div class="title">性别分布</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 250px; position: relative;">
								<div id="sex-contribute-chart" class="recharts-wrapper pieChart" style="width: 220px; height: 250px;position: relative;"></div>
							</div>
							<div class="pieInfo pieInfo_gender">
								<span class="infoTitle">人数</span>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(32, 98, 230);"></span>
										<span class="infoName">女</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">10</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(243, 208, 36);"></span>
										<span class="infoName">男</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">5</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(255, 133, 51);"></span>
										<span class="infoName">未知</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">3</span>
									</div>
								</div>
							</div>
						</div>
						<div class="pieChart-wrapper clearfix">
							<div class="title">年龄分布</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 250px; position: relative;">
								<div id="age-contribute-chart" class="recharts-wrapper pieChart" style="width: 220px; height: 250px;position: relative;"></div>
							</div>
							<div class="pieInfo pieInfo_age">
								<span class="infoTitle">人数</span>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(32, 98, 230);"></span>
										<span class="infoName">18-25岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">4</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(243, 208, 36);"></span>
										<span class="infoName">26-30岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">4</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(255, 133, 51);"></span>
										<span class="infoName">31-35岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">2</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(76, 181, 255);"></span>
										<span class="infoName">36-40岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">2</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(188, 100, 229);"></span>
										<span class="infoName">40-45岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">3</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(4, 201, 168);"></span>
										<span class="infoName">50岁以上</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">1</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(255, 101, 144);"></span>
										<span class="infoName">未知</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">2</span>
									</div>
								</div>
							</div>
						</div>
						<div class="barChart-wrapper clearfix">
							<div class="title">城市分布排行</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 300px; position: relative;">
								<div id="city-contribute-chart" class="recharts-wrapper" style="position: relative; cursor: default; width: 480px; height: 300px;"></div>
							</div>
						</div>
						<div class="barChart-wrapper clearfix">
							<div class="title">淘气值分布</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 300px; position: relative;">
								<div id="buy-contribute-chart" class="recharts-wrapper" style="position: relative; cursor: default; width: 480px; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="ebase-card-content" style="display: none;">
					<div class="flow-crowds-root">
						<div class="pieChart-wrapper clearfix">
							<div class="title">性别分布</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 250px; position: relative;">
								<div id="sex-contribute-chart" class="recharts-wrapper pieChart" style="width: 220px; height: 250px;position: relative;"></div>
							</div>
							<div class="pieInfo pieInfo_gender">
								<span class="infoTitle">人数</span>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(32, 98, 230);"></span>
										<span class="infoName">女</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">10</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(243, 208, 36);"></span>
										<span class="infoName">男</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">5</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(255, 133, 51);"></span>
										<span class="infoName">未知</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">3</span>
									</div>
								</div>
							</div>
						</div>
						<div class="pieChart-wrapper clearfix">
							<div class="title">年龄分布</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 250px; position: relative;">
								<div id="age-contribute-chart" class="recharts-wrapper pieChart" style="width: 220px; height: 250px;position: relative;"></div>
							</div>
							<div class="pieInfo pieInfo_age">
								<span class="infoTitle">人数</span>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(32, 98, 230);"></span>
										<span class="infoName">18-25岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">4</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(243, 208, 36);"></span>
										<span class="infoName">26-30岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">4</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(255, 133, 51);"></span>
										<span class="infoName">31-35岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">2</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(76, 181, 255);"></span>
										<span class="infoName">36-40岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">2</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(188, 100, 229);"></span>
										<span class="infoName">40-45岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">3</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(4, 201, 168);"></span>
										<span class="infoName">50岁以上</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">1</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(255, 101, 144);"></span>
										<span class="infoName">未知</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">2</span>
									</div>
								</div>
							</div>
						</div>
						<div class="barChart-wrapper clearfix">
							<div class="title">城市分布排行</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 300px; position: relative;">
								<div id="city-contribute-chart" class="recharts-wrapper" style="position: relative; cursor: default; width: 480px; height: 300px;"></div>
							</div>
						</div>
						<div class="barChart-wrapper clearfix">
							<div class="title">淘气值分布</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 300px; position: relative;">
								<div id="buy-contribute-chart" class="recharts-wrapper" style="position: relative; cursor: default; width: 480px; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="ebase-card-content" style="display: none;">
					<div class="flow-crowds-root">
						<div class="pieChart-wrapper clearfix">
							<div class="title">性别分布</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 250px; position: relative;">
								<div id="sex-contribute-chart" class="recharts-wrapper pieChart" style="width: 220px; height: 250px;position: relative;"></div>
							</div>
							<div class="pieInfo pieInfo_gender">
								<span class="infoTitle">人数</span>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(32, 98, 230);"></span>
										<span class="infoName">女</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">10</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(243, 208, 36);"></span>
										<span class="infoName">男</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">5</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(255, 133, 51);"></span>
										<span class="infoName">未知</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">3</span>
									</div>
								</div>
							</div>
						</div>
						<div class="pieChart-wrapper clearfix">
							<div class="title">年龄分布</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 250px; position: relative;">
								<div id="age-contribute-chart" class="recharts-wrapper pieChart" style="width: 220px; height: 250px;position: relative;"></div>
							</div>
							<div class="pieInfo pieInfo_age">
								<span class="infoTitle">人数</span>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(32, 98, 230);"></span>
										<span class="infoName">18-25岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">4</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(243, 208, 36);"></span>
										<span class="infoName">26-30岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">4</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(255, 133, 51);"></span>
										<span class="infoName">31-35岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">2</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(76, 181, 255);"></span>
										<span class="infoName">36-40岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">2</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(188, 100, 229);"></span>
										<span class="infoName">40-45岁</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">3</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(4, 201, 168);"></span>
										<span class="infoName">50岁以上</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">1</span>
									</div>
								</div>
								<div>
									<div class="infoLegend">
										<span class="infoColorBlock" style="background-color: rgb(255, 101, 144);"></span>
										<span class="infoName">未知</span>
									</div>
									<div class="infoValue">
										<span class="infoValueData">2</span>
									</div>
								</div>
							</div>
						</div>
						<div class="barChart-wrapper clearfix">
							<div class="title">城市分布排行</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 300px; position: relative;">
								<div id="city-contribute-chart" class="recharts-wrapper" style="position: relative; cursor: default; width: 480px; height: 300px;"></div>
							</div>
						</div>
						<div class="barChart-wrapper clearfix">
							<div class="title">淘气值分布</div>
							<div class="recharts-responsive-container" style="width: 100%; height: 300px; position: relative;">
								<div id="buy-contribute-chart" class="recharts-wrapper" style="position: relative; cursor: default; width: 480px; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 人群特征  end -->
		</div>
	</div>
	<!-- 流量看板 end -->
	<!-- 计划监控 start -->
	<div class="w-1260 rt switch-wrap flow-container">
		<div class="plan-watch-wrap">
			<div class="screen-header h-50">
				<p class="fast-open rt"><a href="index.php?ctl=Seller_Sycm&met=newPlanning">快速创建<i>+</i></a></p>
			</div>
			<!-- 空 start -->
			<div class="plan-wrap mt-10">
				<div class="ebase-error">
					<div class="ebase-error-page"></div>
					<p>
						<span>您还没有制定年度计划，可以<a href="javascript:;">快速创建</a></span>
					</p>
				</div>
			</div>
			<!-- 空 end -->
		</div>
	</div>
	<!-- 计划监控 end -->

	<!-- 访客分析 start -->
	<div class="w-1260 rt switch-wrap visitor-analysis flow-container">
		<div class="visitor-analysis-wrap">
			<div class="wrap-title backff">
				<div class="switch-wrap-att orflow">
					<span class="curr lf">
						<a href="javascript:;">访客分布</a>
					</span>
					<span class="lf">
						<a href="javascript:;">访客对比</a>
					</span>
				</div>
			</div>
			<div class="wrap-switch">
				<div class="time-wrap mod backff">
					<div class="navbar mt-10">
						<h4 class="navbar-header lf">
							<i class="icon"></i>
							<span>时段分布</span>
						</h4>
						
						<div class="select-control download rt">
							<a href="javascript:;">
								<i class="icon"></i>
								<span class="val">下载</span>
							</a>
							<div class="ui-download-panel ui-download-right select-control-list">
								<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
								<p class="ui-download-btns clearfix"><a href="#" class="btn btn-blank btn-sm">取消</a><a href="#" class="btn btn-primary btn-sm">确定</a></p>
							</div>
						</div>
						<div class="select-control combopicker rt">
							<a href="javascript:;">
								终端
								<span class="caret"></span>
							</a>
							<div class="select-control-list combopicker-panel">
								<div class="combopicker-groups">
									<div class="group-wrapper">
										<span class="group-title">
											选择终端
										</span>
										<div class="group orflow">
											<span class="checkbox selected">
												<span class="option"></span>
												<span class="name">所有终端</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">无线端</span>
											</span>
											<span class="checkbox">
												<span class="option"></span>
												<span class="name">PC端</span>
											</span>
										</div>
									</div>
								</div>
								<div class="combopicker-btns">
									<span class="message">已选择1项</span>
									<a href="javascript:;" class="btn rt">确定</a>
								</div>
							</div>
						</div>
						<div class="date-text rt">2017-12-03 ~ 2017-12-09</div>
						<div class="select-control ui-selector rt">
								<a href="javascript:;">
									<span class="ui-selector-value">日期</span>
									<span class="caret icon"></span>
								</a>
								<ul class="ui-selector-list select-control-list">
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
								</ul>
							</div>
					</div>
					<div class="content">
						<div id="time-pulish-chart" style="width:1260px;height:330px;"></div>
						<div class="data-desc orflow">
							<span class="data-desc-brand lf"></span>
							<div class="data-desc-panel lf">
								<div class="data-desc-box lf">
									<div class="data-desc-header">
										<h4 class="title">时段分布解读</h4>
									</div>
									<div class="data-desc-content">
										<p>
											<span>近7天日均访客数最多的时间段为：</span>
											<span>
												<em class="key-main">18:00~18:59</em>(1人)
											</span>
										</p>
										<p>
											找准访客高峰时段，果断上新呀！注意兼顾PC端和无线端访客访问习惯哦。看看
											<a href="javascript:;" target="_blank">
												宝贝上下架时间
											</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="area-wrap mod navbar-panel backff">
					<div class="navbar mt-10">
						<h4 class="navbar-header lf">
							<i class="icon"></i>
							<span>地域分布</span>
						</h4>
						<div class="select-control download rt">
							<a href="javascript:;">
								<i class="icon"></i>
								<span class="val">下载</span>
							</a>
							<div class="ui-download-panel ui-download-right select-control-list">
								<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
								<p class="ui-download-btns clearfix"><a href="#" class="btn btn-blank btn-sm">取消</a><a href="#" class="btn btn-primary btn-sm">确定</a></p>
							</div>
						</div>
						<div class="select-control ui-selector rt">
							<a href="javascript:;">
								<span class="ui-selector-value">所有终端</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
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
							<ul class="ui-selector-list select-control-list">
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
							</ul>
						</div>
					</div>
					<div class="content">
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
							<div class="data-desc orflow">
								<span class="data-desc-brand lf"></span>
								<div class="data-desc-panel lf">
									<div class="data-desc-box lf">
										<div class="data-desc-header">
											<h4 class="title">地域分布解读</h4>
										</div>
										<div class="data-desc-content">
											<p>
												<span>访客集中来自于：
													<span>
														<em class="key-main">广东省</em>(1人)
													</span>
												</span>
												<span>下单买家集中来自于：
													<em class="key-main">广东省</em>(1人)
												</span>
											</p>
											<p>
												重视对这些地区重点推广运营，提升流量和转化哦！
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="feature-wrap mod backff">
					<div class="navbar mt-10">
						<h4 class="navbar-header lf">
							<i class="icon"></i>
							<span>特征分布</span>
						</h4>
						<div class="select-control download rt">
							<a href="javascript:;">
								<i class="icon"></i>
								<span class="val">下载</span>
							</a>
							<div class="ui-download-panel ui-download-right select-control-list">
								<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
								<p class="ui-download-btns clearfix"><a href="#" class="btn btn-blank btn-sm">取消</a><a href="#" class="btn btn-primary btn-sm">确定</a></p>
							</div>
						</div>
						<div class="select-control ui-selector rt">
							<a href="javascript:;">
								<span class="ui-selector-value">所有终端</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
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
							<ul class="ui-selector-list select-control-list">
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
							</ul>
						</div>
					</div>
					<div class="content">
						<div class="first-group orflow">
							<div class="member-block block lf">
								<div class="panel panel-default">
									<div class="panel-header">
										<h3 class="panel-title">
											<span>淘气值分布</span>
											<span class="tips-wrap">
												<i class="icon icon-tips"></i>
												<div class="tips-guide-wrap">
													指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
												</div>
											</span>
										</h3>
									</div>
									<div class="panel-content">
										<div class="obj-list">
											<ul class="list-title">
												<li class="col col-name">淘气值</li>
												<li class="col col-uv">访客数</li>
												<li class="col col-bar"></li>
												<li class="col col-ratio">占比</li>
												<li class="col col-orderRate">下单转化率</li>
											</ul>
											<ul class="list-content orflow">
												<li class="low low-0 orflow">
													<p class="col col-name">
														<span>1000+</span>
													</p>
													<p class="col col-uv">1</p>
													<p class="col col-bar">
														<span class="bar-percent">
															<span class="bar-wrap" style='width:100%;'>
																<!-- <i class="bar-calu"></i> -->
															</span>
														</span>
													</p>
													<p class="col col-ratio">50.00%</p>
													<p class="col col-orderRate">0.00%</p>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="consumer-block block rt">
								<div class="panel panel-default">
									<div class="panel-header">
										<h3 class="panel-title">
											<span>消费层级</span>
										</h3>
									</div>
									<div class="panel-content">
										<div class="obj-list">
											<ul class="list-title">
												<li class="col col-name">
													<span>消费层级(元)
														<span class="tips-wrap">
															<i class="icon icon-tips"></i>
															<div class="tips-guide-wrap">
																指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
															</div>
														</span>
													</span>
												</li>
												<li class="col col-uv">访客数</li>
												<li class="col col-bar"></li>
												<li class="col col-ratio">占比</li>
												<li class="col col-orderRate">下单转化率</li>
											</ul>
											<ul class="list-content orflow">
												<li class="low low-0 orflow">
													<p class="col col-name">
														0-710.0
													</p>
													<p class="col col-uv">1</p>
													<p class="col col-bar">
														<span class="bar-percent">
															<span class="bar-wrap" style='width:100%;'>
																<!-- <i class="bar-calu"></i> -->
															</span>
														</span>
													</p>
													<p class="col col-ratio">100%</p>
													<p class="col col-orderRate">100%</p>
												</li>
												<li class="low low-0 orflow">
													<p class="col col-name">
														0-710.0
													</p>
													<p class="col col-uv">1</p>
													<p class="col col-bar">
														<span class="bar-percent">
															<span class="bar-wrap" style='width:50%;'>
																<!-- <i class="bar-calu"></i> -->
															</span>
														</span>
													</p>
													<p class="col col-ratio">0.00%</p>
													<p class="col col-orderRate">-%</p>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="second-group orflow">
							<div class="block lf">
								<div class="panel panel-default">
									<div class="panel-header">
										<h3 class="panel-title">
											<span>性别</span>
											<span class="tips-wrap">
												<i class="icon icon-tips"></i>
												<div class="tips-guide-wrap">
													指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
												</div>
											</span>
										</h3>
									</div>
									<div class="panel-content">
										<div class="obj-list">
											<ul class="list-title">
												<li class="col col-name">性别</li>
												<li class="col col-uv">访客数</li>
												<li class="col col-bar"></li>
												<li class="col col-ratio">占比</li>
												<li class="col col-orderRate">下单转化率</li>
											</ul>
											<ul class="list-content orflow">
												<li class="low low-0 orflow">
													<p class="col col-name">
														<span>男</span>
													</p>
													<p class="col col-uv">2</p>
													<p class="col col-bar">
														<span class="bar-percent">
															<span class="bar-wrap" style='width:50%;'>
																<!-- <i class="bar-calu"></i> -->
															</span>
														</span>
													</p>
													<p class="col col-ratio">50.00%</p>
													<p class="col col-orderRate">0.00%</p>
												</li>
												<li class="low low-0 orflow">
													<p class="col col-name">
														<span>女</span>
													</p>
													<p class="col col-uv">0</p>
													<p class="col col-bar">
														<span class="bar-percent">
															<span class="bar-wrap" style='width:50%;'>
																<!-- <i class="bar-calu"></i> -->
															</span>
														</span>
													</p>
													<p class="col col-ratio">50.00%</p>
													<p class="col col-orderRate">0.00%</p>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="block visitors-block rt">
								<div class="panel panel-default">
									<div class="panel-header">
										<h3 class="panel-title">
											<span>店铺新老店铺</span>
											<span class="tips-wrap">
												<i class="icon icon-tips"></i>
												<div class="tips-guide-wrap">
													指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
												</div>
											</span>
										</h3>
									</div>
									<div class="panel-content">
										<div id="visitors-chart" class="lf visitors-chart" style="width:180px;height:180px;"></div>
										<div class="obj-list rt">
											<ul class="list-title">
												<li class="col col-name">访客类型</li>
												<li class="col col-uv">访客数</li>
												<li class="col col-ratio">占比</li>
												<li class="col col-orderRate">下单转化率</li>
											</ul>
											<ul class="list-content orflow">
												<li class="low low-0 orflow">
													<p class="col col-name">
														<span>新房客</span>
													</p>
													<p class="col col-uv">1</p>
													<p class="col col-ratio">50.00%</p>
													<p class="col col-orderRate">0.00%</p>
												</li>
												<li class="low low-0 orflow">
													<p class="col col-name">
														<span>老访客</span>
													</p>
													<p class="col col-uv">0</p>
													<p class="col col-ratio">50.00%</p>
													<p class="col col-orderRate">0.00%</p>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="actions-wrap mod backff">
					<div class="navbar mt-10">
						<h4 class="navbar-header lf">
							<i class="icon"></i>
							<span>行为分布</span>
						</h4>
						<div class="select-control download rt">
							<a href="javascript:;">
								<i class="icon"></i>
								<span class="val">下载</span>
							</a>
							<div class="ui-download-panel ui-download-right select-control-list">
								<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
								<p class="ui-download-btns clearfix"><a href="#" class="btn btn-blank btn-sm">取消</a><a href="#" class="btn btn-primary btn-sm">确定</a></p>
							</div>
						</div>
						<div class="select-control ui-selector rt">
							<a href="javascript:;">
								<span class="ui-selector-value">所有终端</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
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
							<ul class="ui-selector-list select-control-list">
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
							</ul>
						</div>
					</div>
					<div class="content clearfix">
						<div class="member-block block lf">
							<div class="panel panel-default">
								<div class="panel-header">
									<h3 class="panel-title">
										<span>来源关键词TOPS</span>
										<span class="tips-wrap">
											<i class="icon icon-tips"></i>
											<div class="tips-guide-wrap">
												指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
											</div>
										</span>
									</h3>
								</div>
								<div class="panel-content">
									<div class="obj-list">
										<ul class="list-title">
											<li class="col col-name">关键词</li>
											<li class="col col-uv">访客数</li>
											<li class="col col-bar"></li>
											<li class="col col-ratio">占比</li>
											<li class="col col-orderRate">下单转化率</li>
										</ul>
										<!-- <div class="no-data-message">
											<div class="ui-message-empty">
												<p class="ui-message-content">
													<span class="noromal">
														<i class="icon"></i>
													</span>
													<span>没有访客搜索相关关键词到达店铺内，建议查看
													<a href="javascript:;">行业关键词</a>,优化标题，加强搜索引流！
													</span>
												</p>
											</div>
										</div> -->
										<ul class="list-content">
											<li class="low clearfix low-0">
												<p class="col col-name">美的电压力...</p>
												<p class="col col-uv">1</p>
												<p class="col col-bar">
													<span class="bar-percent">
														<span class="bar-wrap" style="width:50%;">
															<!-- <i class="bar-calu"></i> -->
														</span>
													</span>
												</p>
												<p class="col col-ratio">20.00%</p>
												<p class="col col-orderRate">0.00%</p>
											</li>
											<li class="low clearfix low-1">
												<p class="col col-name">男高档西装...</p>
												<p class="col col-uv">1</p>
												<p class="col col-bar">
													<span class="bar-percent">
														<span class="bar-wrap" style="width:50%;">
															<!-- <i class="bar-calu"></i> -->
														</span>
													</span>
												</p>
												<p class="col col-ratio">20.00%</p>
												<p class="col col-orderRate">0.00%</p>
											</li>
											<li class="low clearfix low-2">
												<p class="col col-name">200l飘柔洗...</p>
												<p class="col col-uv">1</p>
												<p class="col col-bar">
													<span class="bar-percent">
														<span class="bar-wrap" style="width:50%;">
															<!-- <i class="bar-calu"></i> -->
														</span>
													</span>
												</p>
												<p class="col col-ratio">20.00%</p>
												<p class="col col-orderRate">0.00%</p>
											</li>
											<li class="low clearfix low-3">
												<p class="col col-name">电压力锅 ...</p>
												<p class="col col-uv">1</p>
												<p class="col col-bar">
													<span class="bar-percent">
														<span class="bar-wrap" style="width:50%;">
															<!-- <i class="bar-calu"></i> -->
														</span>
													</span>
												</p>
												<p class="col col-ratio">20.00%</p>
												<p class="col col-orderRate">0.00%</p>
											</li>
											<li class="low clearfix low-4">
												<p class="col col-name">穿线管 软...</p>
												<p class="col col-uv">1</p>
												<p class="col col-bar">
													<span class="bar-percent">
														<span class="bar-wrap" style="width:50%;">
															<!-- <i class="bar-calu"></i> -->
														</span>
													</span>
												</p>
												<p class="col col-ratio">20.00%</p>
												<p class="col col-orderRate">0.00%</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="consumer-block block rt">
							<div class="panel panel-default">
								<div class="panel-header">
									<h3 class="panel-title">
										<span>浏览量分布</span>
										<span class="tips-wrap">
											<i class=	"icon icon-tips"></i>
											<div class="tips-guide-wrap">
												指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
											</div>
										</span>
									</h3>
								</div>
								<div class="panel-content">
									<div class="obj-list">
										<ul class="list-title">
											<li class="col col-name">
												<span>浏览量
												</span>
											</li>
											<li class="col col-uv">访客数</li>
											<li class="col col-bar"></li>
											<li class="col col-ratio">占比</li>
										</ul>
										<ul class="list-content orflow">
											<li class="low low-0 orflow">
												<p class="col col-name">
													0-710.0
												</p>
												<p class="col col-uv">1</p>
												<p class="col col-bar">
													<span class="bar-percent">
														<span class="bar-wrap" style='width:100%;'>
															<!-- <i class="bar-calu"></i> -->
														</span>
													</span>
												</p>
												<p class="col col-ratio">100%</p>
											</li>
											<li class="low low-0 orflow">
												<p class="col col-name">
													0-710.0
												</p>
												<p class="col col-uv">1</p>
												<p class="col col-bar">
													<span class="bar-percent">
														<span class="bar-wrap" style='width:50%;'>
															<!-- <i class="bar-calu"></i> -->
														</span>
													</span>
												</p>
												<p class="col col-ratio">0.00%</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="wrap-switch">
				<div class="visitor-compared mod backff">
					<div class="navbar mt-10">
						<h4 class="navbar-header lf">
							<i class="icon"></i>
							<span>访客对比</span>
						</h4>
						<div class="date-text rt">2017-12-03 ~ 2017-12-09</div>
						<div class="operation-actions rt">
							<div class="select-control ui-selector lf">
								<a href="javascript:;">
									<span class="ui-selector-value">日期</span>
									<span class="caret icon"></span>
								</a>
								<ul class="ui-selector-list select-control-list">
									<li class="ui-selector-item curr">
										<span>最近1天</span>
									</li>
									<li class="ui-selector-item">
										<span>最近7天平均</span>
									</li>
									<li class="ui-selector-item">
										<span>最近30天平均</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="menu-cnt">
							<ul class="menu-list">
								<li class="empty-child lf"></li>
								<li class="lf">
									<span>
										未支付访客<em class="num">(2人)</em>
									</span>
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</li>
								<li class="lf">
									<span>
										支付新买家(<em class="num">(2人)</em>
									</span>
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</li>
								<li class="lf">
									<span>
										支付老买家(<em class="num">(2人)</em>
									</span>
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</li>
								
							</ul>
						</div>
						<div class="compare-detail">
							<div class="compare-table">
								<dl class="compare-block consumer-block orflow">
									<dt class="lf">
										<p class="title">
											<span>消费层级(元)</span>
											<i class="icon"></i>
										</p>
										<div class="compare-desc">
											<p>
												可惜，<span class="highlight">未支付访客</span>无任何影踪。
											</p>
										</div>
									</dt>
									<dd class="noBuyer-unit lf">
										<div class="unit">
											<p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>由于未支付访客未在本店消费，在本店无消费层级！</span>
											</p>
										</div>
									</dd>
									<dd class="newBuyer-unit lf">
										<div class="unit">
											<p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>店铺暂无支付新买家哦！</span>
											</p>
										</div>
									</dd>
									<dd class="oldBuyer-unit lf">
										<div class="unit">
											<p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>店铺暂无支付老买家哦！</span>
											</p>
										</div>
									</dd>
								</dl>
								<dl class="compare-block sex-block orflow">
									<dt class="lf">
										<p class="title">
											<span>性别</span>
											<i class="icon"></i>
										</p>
										<div class="compare-desc">
											<p>
												可惜，<span class="highlight">未支付访客</span>无任何影踪
											</p>
										</div>
									</dt>
									<dd class="noBuyer-unit lf">
										<div class="unit">
											<div class="info-detail info-detail-1">
												<p>
													<span class="male"></span>
												</p>
												<p class="num">100.00%</p>
											</div>
											<div class="bar-list">
												<li class="max-part" style="width: 100%;"></li>
											</div>
										</div>
									</dd>
									<dd class="newBuyer-unit lf">
										<div class="unit">
											<!-- <p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>店铺暂无支付新买家哦！</span>
											</p> -->
											<div class="info-detail info-detail-1" style="left: 10%;">
												<p>
													<span class="male"></span>
												</p>
												<p class="num">20%</p>
											</div>
											<div class="info-detail info-detail-2" style="left: 50%">
												<p>
													<span class="female"></span>
												</p>
												<p class="num">60.00%</p>
											</div>
											<div class="info-detail info-detail-3" style="left: 90%;">
												<p>
													<span class="unknow">未知</span>
												</p>
												<p class="num">20%</p>
											</div>
											<div class="bar-list orflow">
												<li class="lf" style="width:20%"></li>
												<li class="max-part lf" style="width: 60%;"></li>
												<li class="lf" style="width:20%"></li>
											</div>
										</div>
									</dd>
									<dd class="oldBuyer-unit lf">
										<div class="unit">
											<p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>店铺暂无支付老买家哦！</span>
											</p>
										</div>
									</dd>
								</dl>
								<div class="compare-block age-block">
									<dl class="orflow">
										<dt class="lf">
											<p class="title">
												<span>年龄</span>
												<i class="icon"></i>
											</p>
											<div class="compare-desc">
												<p>
													可惜<span class="highlight">未支付访客</span>无任何影踪
												</p>
											</div>
										</dt>
										<dd class="noBuyer-unit lf">
											<div class="pie-cnt" id="pie-cnt-chart" style="width:290px;height:180px;"></div>
											<div class="part-name">18-25岁</div>
											<div class="part-percent">42.86%</div>
										</dd>
										<dd class="newBuyer-unit lf">
											<div class="unit">
												<p class="unit-no-data">
													<span class="tag-no-data"></span>
													<span>店铺暂无支付新买家哦！</span>
												</p>
											</div>
										</dd>
										<dd class="oldBuyer-unit lf">
											<div class="unit">
												<p class="unit-no-data">
													<span class="tag-no-data"></span>
													<span>店铺暂无支付老买家哦！</span>
												</p>
											</div>
										</dd>
									</dl>
									<div class="lengends">
										<span class="square square-01"></span>
										<span class="text">18-25岁</span>
										<span class="square square-02"></span>
										<span class="text">26-30岁</span>
										<span class="square square-03"></span>
										<span class="text">31-35岁</span>
										<span class="square square-04"></span>
										<span class="text">36-40岁</span>
										<span class="square square-05"></span>
										<span class="text">41-50岁</span>
										<span class="square square-06"></span>
										<span class="text">51岁以上</span>
										<span class="square square-07"></span>
										<span class="text">蒙面侠</span>
									</div>
								</div>
								<dl class="compare-block area-block orflow">
									<dt class="lf">
										<p class="title">
											<span>地域TOP</span>
											<i class="icon"></i>
										</p>
										<div class="compare-desc">
											<p>
												可惜<span class="highlight">未支付访客</span>无任何影踪
											</p>
										</div>
									</dt>
									<dd class="noBuyer-unit lf">
										<ul class="area-list">
											<li class="low-0 orflow">
												<p class="col col-name lf">北京</p>
												<p class="col col-rate lf">50.00%</p>
												<p class="col col-bar lf">
													<span class="bar" style="width:100%;"></span>
												</p>
											</li>
											<li class="low-1 orflow">
												<p class="col col-name lf">北京</p>
												<p class="col col-rate lf">50.00%</p>
												<p class="col col-bar lf">
													<span class="bar" style="width:100%;"></span>
												</p>
											</li>
										</ul>
									</dd>
									<dd class="newBuyer-unit lf">
										<div class="unit">
											<p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>店铺暂无支付新买家哦！</span>
											</p>
										</div>
									</dd>
									<dd class="oldBuyer-unit lf">
										<div class="unit">
											<p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>店铺暂无支付老买家哦！</span>
											</p>
										</div>
									</dd>
								</dl>
								<dl class="compare-block channer-block orflow">
									<dt class="lf">
										<p class="title">
											<span>营销偏好</span>
											<i class="icon"></i>
										</p>
										<div class="compare-desc">
											<p>
												建议关注<span class="highlight">支付新买家</span>，其无明显的营销偏好
											</p>
										</div>
									</dt>
									<dd class="noBuyer-unit lf">
										<div class="circle-chart" id="circle-chart" style="width:240px;height: 240px;">
											
										</div>
									</dd>
									<dd class="newBuyer-unit lf">
										<!-- <div class="unit"> -->
											<p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>无营销偏好，建议加强营销推广哦！</span>
											</p>
										<!-- </div> -->
									</dd>
									<dd class="oldBuyer-unit lf">
										<!-- <div class="unit"> -->
											<p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>无营销偏好，建议加强营销推广哦！</span>
											</p>
										<!-- </div> -->
									</dd>
								</dl>
								<dl class="compare-block keywords-block orflow">
									<dt class="lf">
										<p class="title">
											<span>关键词TOP</span>
											<i class="icon"></i>
										</p>
										<div class="compare-desc">
											<p>
												无来源关键词
											</p>
										</div>
									</dt>
									<dd class="noBuyer-unit lf">
										<!-- <div class="unit">
											<p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>无搜索关键词引导到您店铺，优化宝贝吧！</span>
											</p>
										</div> -->
										<ul class="keyword-list">
											<li class="low-0">飘柔此法水</li>
											<li class="low-1">海都浴霸</li>
											<li class="low-2">电烤箱</li>
											<li class="low-3">纸巾小包</li>
											<li class="low-4">处理冬装 羽绒服...</li>
										</ul>
									</dd>
									<dd class="newBuyer-unit lf">
										<div class="unit">
											<p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>无搜索关键词引导到您店铺，优化宝贝吧！</span>
											</p>
										</div>
									</dd>
									<dd class="oldBuyer-unit lf">
										<div class="unit">
											<p class="unit-no-data">
												<span class="tag-no-data"></span>
												<span>无搜索关键词引导到您店铺，优化宝贝吧！</span>
											</p>
										</div>
									</dd>
								</dl>
							</div>
						</div>
					</div>
					<div class="data-desc orflow">
						<span class="data-desc-brand lf"></span>
						<div class="data-desc-panel lf">
							<div class="data-desc-box lf">
								<div class="data-desc-header">
									<h4 class="title">访客波动解读</h4>
								</div>
								<div class="data-desc-content">
									<p>
										糟糕，访客数太少赶紧去流量来源看看与
										<a href="javascript:;" target="_blank">
											同行
										</a>之间的差距,抓紧引流吧。
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 访客分析 end -->
	<!-- 店铺来源 start -->
	<div class="w-1260 rt switch-wrap flow-container">
		<div class="shop-resource-wrap">
			<div class="screen-header h-50">
				<!-- <div class="wrap-title"> -->
					<div class="switch-wrap-att orflow">
						<span class="curr lf">
							<a href="javascript:;">构成</a>
						</span>
						<span class="lf">
							<a href="javascript:;">对比</a>
						</span>
						<span class="lf">
							<a href="javascript:;">同行</a>
						</span>
					</div>
					<div class="update-option rt">
						
						<div class="update-option">
							<p class="lf update">更新时间：<span>2017-02-26&nbsp;&nbsp;09:45:36</span></p>
							<p class="rt option"><span>实时</span><i class="icon caret"></i></p>
							<div class="date-wrap">
								<ul>
									<li class="datePicker-item active realtime">
										<span class="datePicker-rangeText">实时</span>
										<span class="datePicker-rangeTime rt"></span>
									</li>
									<li class="datePicker-item lastest-n">
										<span class="datePicker-rangeText">最近1天</span>
										<span class="datePicker-rangeTime rt">（2017-09-26 ~ 2017-09-26）</span>
									</li>
									<li class="datePicker-item lastest-n">
										<span class="datePicker-rangeText">最近7天</span>
										<span class="datePicker-rangeTime rt">（2017-09-20 ~ 2017-09-26）</span>
									</li>
									<li class="datePicker-item lastest-n">
										<span class="datePicker-rangeText">最近30天</span>
										<span class="datePicker-rangeTime rt">（2017-08-28 ~ 2017-09-26）</span>
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
								<div class="laydate-wrap laydate-wrap-day" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;background: #fff;"></div>
								<div class="laydate-wrap laydate-wrap-week" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;background: #fff;"></div>
								<div class="laydate-wrap laydate-wrap-month" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;background: #fff;"></div>

							</div>
						</div>
						<div class="select-control ui-selector rt">
							<a href="javascript:;">
								<span class="ui-selector-value">无线端</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list">
								<li class="ui-selector-item curr">
									<span>无线端</span>
								</li>
								<li class="ui-selector-item">
									<span>PC端</span>
								</li>
							</ul>
						</div>
					</div>
				<!-- </div> -->
			</div>
			<div class="mt-10 backff">
				<div class="wrap-switch">
					<div class="wrap-title">
						<div class="title-lf lf">流量来源构成</div>
						<div class="operation-actions rt">
							<div class="oui-checkbox oui-checked lf">
								<span class="oui-icon-stacked">
									<i class="icon"></i>
								</span>
								<span class="oui-form-name">
									隐藏空数据
								</span>
							</div>
							<div class="select-control download rt">
								<a href="javascript:;">
									<i class="icon"></i>
									<span class="val">下载</span>
								</a>
								<div class="ui-download-panel ui-download-right select-control-list">
									<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
									<p class="ui-download-btns clearfix"><a href="#" class="btn btn-blank btn-sm">取消</a><a href="#" class="btn btn-primary btn-sm">确定</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="ebase-card-content">
						<div class="onenessCard">
							<div class="oui-index-picker">
								<div class="oui-index-picker-group">
									<div class="oui-index-picker-content">
										<div class="combo-panel-lite combo-panel-inline lf">
											<span class="checkbox selected disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="pagesShopSource">
							<i class="icon"></i>
							<span>亲，您尚未订购流量纵横，无法查看更多指标！</span><a href="javascript:;">立即订购></a>
						</div>
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
									<!-- 子 -->
										<tr class="tr child-trn child-tr2">
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
										<tr class="tr child-trn child-tr2">
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
									<tr class="tr parent-tr parent-tr3">
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
				<div class="wrap-switch">
					<div class="wrap-title">
						<div class="title-lf lf">流量来源对比</div>
					</div>
					<div class="ebase-card-content">
						<div class="selectorShopSourceSelectorCombo-root">
							<div class="selectorShopSourceSelectorCombo-selectors lf">
								<div class="selectorShopSourceSelectorCombo-squareRoot rt base-add">
									<div class="selectorShopSourceSelectorCombo-square">
										<div class="selectorShopSourceSelectorCombo-add">
											+
										</div>
									</div>
								</div>
							</div>
							<div class="ebase-advanceSelector-menu">
								<div class="legacy-oui-typeahead">
									<div class="legacy-oui-typeahead-input-wrapper">
										<input type="text" class="legacy-oui-typeahead-input" placeholder="请输入店铺来源关键字或在下方列表选择">
										<i class="icon "></i>
									</div>
									<div class="oui-scroller" style="height: 180px;">
										<div class="legacy-oui-typeahead-menu oui-sroller-content">
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">1我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">2我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">3我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">4我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">5我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">6我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">7我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">8我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">9我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">10我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">11我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">12我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">13我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">14我的淘宝</span>
											</span>
											<span class="legacy-oui-typeahead-item menu-item">
												<span class="text">15我的淘宝</span>
											</span>
										</div>
									</div>
								</div>
								<div>
									<span class="history-title">
										最近浏览
									</span>
									<div class="legacy-oui-typeahead">
										<div class="legacy-oui-typeahead-menu">
											<span class="legacy-oui-typeahead-item">
												<span class="text">购物车</span>
											</span>
											<span class="legacy-oui-typeahead-item">
												<span class="text">手淘母婴</span>
											</span>
											<span class="legacy-oui-typeahead-item">
												<span class="text">手淘家电</span>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="selectorShopSourceSelectorCombo-selectorCout lf">
								0/5
							</div>
						</div>
						<div>
							<div class="no-data-message">
								<div class="ui-message-empty">
									<p class="ui-message-content">
										<span class="noromal">
											<i class="icon"></i>
										</span>
										<span>亲，请点击上面的加号按钮选择来源进行对比！</span>
									</p>
								</div>
							</div>
							<div class="compare-chart mt-22" id="compare-chart" style="width:1200px;height: 360px;"></div>
						</div>
					</div>
				</div>
				<div class="wrap-switch">
					<div class="wrap-title">
						<div class="title-lf lf">同行流量来源</div>
						<div class="operation-actions rt">
							<div class="select-control ui-selector lf">
								<a href="javascript:;">
									<span class="ui-selector-value">电压力锅同行平均</span>
									<span class="caret icon"></span>
								</a>
								<ul class="ui-selector-list select-control-list">
									<li class="ui-selector-item curr">
										<span>电压力锅同行平均</span>
									</li>
									<li class="ui-selector-item">
										<span>电压力锅同行优秀</span>
									</li>
									<li class="ui-selector-item">
										<span>毛呢外套同行平均</span>
									</li>
									<li class="ui-selector-item">
										<span>毛呢外套同行优秀</span>
									</li>
									<li class="ui-selector-item">
										<span>纸品/湿巾同行平均</span>
									</li>
								</ul>
							</div>
							<div class="oui-checkbox oui-checked lf">
								<span class="oui-icon-stacked">
									<i class="icon"></i>
								</span>
								<span class="oui-form-name">
									隐藏空数据
								</span>
							</div>
							<div class="select-control download rt">
								<a href="javascript:;">
									<i class="icon"></i>
									<span class="val">下载</span>
								</a>
								<div class="ui-download-panel ui-download-right select-control-list">
									<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
									<p class="ui-download-btns clearfix"><a href="#" class="btn btn-blank btn-sm">取消</a><a href="#" class="btn btn-primary btn-sm">确定</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="ebase-card-content">
						<div class="onenessCard">
							<div class="oui-index-picker">
								<div class="oui-index-picker-group">
									<div class="oui-index-picker-content">
										<div class="combo-panel-lite combo-panel-inline lf">
											<span class="checkbox selected disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
											<span class="checkbox disabled">
												<span class="option"></span>
												<span class="name">商品访客数</span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="pagesShopSource">
							<i class="icon"></i>
							<span>亲，您尚未订购流量纵横，无法查看更多指标！</span><a href="javascript:;">立即订购></a>
						</div>
						<div class="ebase-table-root">
							<table class="table">
								<thead class="thead">
									<tr>
										<th class="th col-0 col-pageName" style="width:15%;text-align: left;padding-left:5px;padding-right: 0;">流量来源</th>
										<th class="th col-1 col-uv" style="text-align: right;">
											<p>访客数</p>
										</th>
										<th class="th col-2 col-crtByrCnt" style="text-align: right;padding-right:0;">下单买家数</th>
										<th class="th col-3 col-crtRate" style="text-align: right;padding-right: 0;">下单转化率</th>
										<th class="th col-4 col-operate" style="width:15%;text-align: right;padding-right:5px;padding-left:0;">操作</th>
									</tr>
								</thead>
								<tbody>
									<tr class="tr parent-tr parent-tr0 active" style="border-top:none;">
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right"></td>
									</tr>
									<!-- 子 -->
									<tr class="tr child-trn child-tr0">
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
										</td>
									</tr>
									<tr class="tr child-trn child-tr0">
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
										</td>
									</tr>
									<tr class="tr child-trn child-tr0">
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
										</td>
									</tr>
									<tr class="tr child-trn child-tr0">
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
										</td>
									</tr>
									<tr class="tr child-trn child-tr0">
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
										</td>
									</tr>
									<tr class="tr child-trn child-tr0">
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right"></td>
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
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
										<td class="td col-4 col-operate col-level-0" style="width:15%;text-align: right">
											<a href="javascript:;">趋势</a>
										</td>
									</tr>
								</tbody>						
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 店铺来源 end -->

	<!-- 商品来源 start -->
	<div class="w-1260 rt switch-wrap flow-container">
		<div class="goods-resource-wrap">
			<div class="screen-header h-50">
				<div class="update-option">
					<p class="lf update">更新时间：<span>2017-02-26&nbsp;&nbsp;09:45:36</span></p>
					<p class="rt option"><span>实时</span><i class="icon caret"></i></p>
					<div class="date-wrap">
						<ul>
							<li class="datePicker-item active realtime">
								<span class="datePicker-rangeText">实时</span>
								<span class="datePicker-rangeTime rt"></span>
							</li>
							<li class="datePicker-item lastest-n">
								<span class="datePicker-rangeText">最近1天</span>
								<span class="datePicker-rangeTime rt">（2017-09-26 ~ 2017-09-26）</span>
							</li>
							<li class="datePicker-item lastest-n">
								<span class="datePicker-rangeText">最近7天</span>
								<span class="datePicker-rangeTime rt">（2017-09-20 ~ 2017-09-26）</span>
							</li>
							<li class="datePicker-item lastest-n">
								<span class="datePicker-rangeText">最近30天</span>
								<span class="datePicker-rangeTime rt">（2017-08-28 ~ 2017-09-26）</span>
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
						<div class="laydate-wrap laydate-wrap-day" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;background: #fff;"></div>
						<div class="laydate-wrap laydate-wrap-week" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;background: #fff;"></div>
						<div class="laydate-wrap laydate-wrap-month" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;background: #fff;"></div>
					</div>
				</div>
				<div class="update-option">
					<div class="select-control ui-selector lf">
						<a href="javascript:;">
							<span class="ui-selector-value">无线端</span>
							<span class="caret icon"></span>
						</a>
						<ul class="ui-selector-list select-control-list">
							<li class="ui-selector-item curr">
								<span>无线端</span>
							</li>
							<li class="ui-selector-item">
								<span>PC端</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="backff mt-10">
				<div class="ItemSourceSummary-root">
					<div class="ItemSourceSummary-itemSelector">
						<div class="ItemSourceSummary-addIcon">+</div>
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
					</div>
					<div class="ItemSourceSummary-recommendItems">
						<span>推荐：</span>
						<a href="javascript:;" class="itemSource-items">
							<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
						</a>
						<a href="javascript:;" class="itemSource-items">
							<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
						</a>
						<a href="javascript:;" class="itemSource-items">
							<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
						</a>
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
					</div>
				</div>
				<div class="pagesShopSource">
					<i class="icon"></i>
					<span>亲，您尚未订购流量纵横，无法查看更多指标！</span><a href="javascript:;">立即订购></a>
				</div>
				<div class="wrap-title">
					<div class="title-lf lf">商品排行榜</div>
				</div>
				<div class="ebase-card-content">
					<div class="ebase-table-root">
						<table class="table">
							<thead class="thead">
								<tr>
									<th class="th col-0 col-rank-id" style="width:60px;text-align: left;">排名</th>
									<th class="th col-1 col-item" style="width:300px;text-align: left;">商品名称</th>
									<th class="th col-2 col-uv orderable sortableTh" style="text-align: right;">
										<span>访客数</span>
										<span class="ebase-sort-radio">(占比)</span>
										<span class="order-flag desc">
											<i class="icon icon-order"></i>
										</span>
									</th>
									<th class="th col-3 col-payOrderByrCnt orderable sortableTh" style="text-align: right;">
										<span>支付买家数</span>
										<span class="order-flag">
											<i class="icon icon-order"></i>
										</span>
									</th>
									<th class="th col-4 col-payRate orderable sortableTh" style="text-align: right;">
										<span>支付转化率</span>
										<span class="order-flag">
											<i class="icon icon-order"></i>
										</span>
									</th>
									<th class="th col-5 col-operate" style="text-align: right;">操作</th>
								</tr>
							</thead>
							<tbody>
								<tr class="tr">
									<td class="td col-0 col-rank-id" style="width:60px;text-align: left;padding-left: 5px;">
										<span>1</span>
									</td>
									<td class="td col-1 col-item" style="width:300px;text-align: left;">
										<div class="ebase-goodsTd-root orflow">
											<a href="javascript:;" class="ebase-goodsTd-goodsImg lf" target="_blank">
												<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748317841099.png">
											</a>
											<div class="ebase-goodsTd-info lf">
												<p class="ebase-goodsTd-goodsName">
													<a href="javascript:;">2017冬装新款韩版狐狸毛领中长款羊毛呢子大衣气质斗篷披肩外套女</a>
												</p>
											</div>
										</div>
									</td>
									<td class="td col-2 col-uv DetailIndexTd" style="text-align: right;">
										<div class="ebase-DetailIndexTd-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">65</span>
												<span class="ebase-detail-radio">(100.00%)</span>
											</p>
										</div>
									</td>
									<td class="td col-3 col-payOrderByrCnt DetailIndexTd" style="text-align: right;">
										<div class="ebase-DetailIndexTd-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">65</span>
											</p>
										</div>
									</td>
									<td class="td col-4 col-payRate DetailIndexTd" style="text-align: right;">
										<div class="ebase-DetailIndexTd-root">
											<p class="ebase-Detail-selfValue">
												<span class="ebase-detail-value">100.00%</span>
											</p>
										</div>
									</td>
									<td class="td col-5 col-operate" style="text-align: right;">
										<span class="OrderPanelOrderPanel__orderName">商品来源</span>
										<div class="popup-content-root" style="top: -116px; right: -66px; display: none;">
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
	<!-- 商品来源 end -->

	<!-- 外投监控 start -->
	<div class="w-1260 rt switch-wrap flow-container">
		<div class="foreign-investment-wrap backff">
			<!-- 空 start -->
			<div class="plan-wrap">
				<div class="limit-experience"></div>
				<div class="ebase-error">
					<div class="ebase-error-page"></div>
					<p>
						<span>亲，此功能尚在灰度测试中，敬请期待！
					</p>
				</div>
			</div>
			<!-- 空 end -->
		</div>
	</div>
	<!-- 外投监控 end -->

	<!-- 选词助手 start -->
	<div class="w-1260 rt switch-wrap flow-container">
		<div class="words-choose-wrap">
			<div class="ops-base-card">
				<div class="nav-bar">
					<h4 class="nav-bar-header lf">选词助手</h4>
					<span class="my-fav">关键词分析器，引流、转化、全网热搜趋势，一网打尽。 进入
					<a href="javascript:;">我的收藏>></a>
					</span>
				</div>
				<div class="screen-header">
					<div class="switch-wrap-att orflow">
						<span class="curr lf">
							<a href="javascript:;">引流搜索词</a>
						</span>
						<span class="lf">
							<a href="javascript:;">行业相关搜索词</a>
						</span>
					</div>
					<ul class="rt device-choose-wrap orflow">
						<li class="device-noLine lf active"><a href="javascript:;">无线</a></li>
						<li class="device-PC lf"><a href="javascript:;">PC</a></li>
					</ul>
				</div>
			</div>
			<div class="mt-10 mod backff">
				<div class="wrap-switch">
					<div class="wrap-title">
						<div class="title-lf lf">店外搜索关键词</div>
						<div class="operation-actions rt">
							<div class="select-control download rt">
								<a href="javascript:;">
									<i class="icon"></i>
									<span class="val">下载</span>
								</a>
								<div class="ui-download-panel ui-download-right select-control-list">
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
							<div class="date-text rt">2017-12-03 ~ 2017-12-09</div>
							<div class="select-control ui-selector rt">
								<a href="javascript:;">
									<span class="ui-selector-value">日期</span>
									<span class="caret icon"></span>
								</a>
								<ul class="ui-selector-list select-control-list" style="display: none;">
									<li class="ui-selector-item curr">
										<span>最近1天</span>
									</li>
									<li class="ui-selector-item">
										<span>最近7天平均</span>
									</li>
									<li class="ui-selector-item day">
										<span>日</span>
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
										<th class="th col-0 col-search" style="width:22%;text-align: left;">搜索词</th>
										<th class="th col-1 col-brings orderable sortableTh" style="text-align: right;">
											<span>带来的访客数</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-2 col-rate orderable sortableTh" style="text-align: right;">
											<span>引导下单转化率</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-3 col-hot-search orderable sortableTh" style="text-align: right;">
											<span>全网搜索热度</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-4 col-click orderable sortableTh" style="text-align: right;">
											<span>全网点击率</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-5 col-goods-num orderable sortableTh" style="text-align: right;">
											<span>全网商品数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-6 col-operate" style="text-align: right;padding-right: 30px;">操作</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="th col-search" style="height: 79px;text-align: left;">
											<a href="javascript:;">玫琳凯眼影正品彩妆盘</a>
										</td>
										<td class="th" style="height:79px;">2</td>
										<td class="th" style="height:79px;">0.00%</td>
										<td class="th" style="height:79px;">96</td>
										<td class="th" style="height:79px;">110.24%</td>
										<td class="th" style="height:79px;">55</td>
										<td class="th col-operate" style="text-align: right;">
											<p class="fav-btn unfaved btn btn-hollow">
												<i class="icon-fav"></i>收藏
												<span class="collection-tip">您还能收藏<i>15</i>个关键字至'我的收藏'</span>
											</p>
											<br>
											<a class="detail-link" href="index.php?ctl=Seller_Sycm&met=detailAnalysis" target="_blank">详情分析</a>
										</td>
									</tr>
									<tr>
										<td class="th col-search" style="height: 79px;text-align: left;">
											<a href="javascript:;">玫琳凯眼影正品彩妆盘</a>
										</td>
										<td class="th" style="height:79px;">2</td>
										<td class="th" style="height:79px;">0.00%</td>
										<td class="th" style="height:79px;">96</td>
										<td class="th" style="height:79px;">110.24%</td>
										<td class="th" style="height:79px;">55</td>
										<td class="th col-operate" style="text-align: right;">
											<p class="fav-btn unfaved btn btn-hollow">
												<i class="icon-fav"></i>收藏
												<span class="collection-tip">您还能收藏<i>15</i>个关键字至'我的收藏'</span>
											</p>
											<br>
											<a class="detail-link" href="index.php?ctl=Seller_Sycm&met=detailAnalysis" target="_blank">详情分析</a>
										</td>
									</tr>
									<tr>
										<td class="th col-search" style="height: 79px;text-align: left;">
											<a href="javascript:;">玫琳凯眼影正品彩妆盘</a>
										</td>
										<td class="th" style="height:79px;">2</td>
										<td class="th" style="height:79px;">0.00%</td>
										<td class="th" style="height:79px;">96</td>
										<td class="th" style="height:79px;">110.24%</td>
										<td class="th" style="height:79px;">55</td>
										<td class="th col-operate" style="text-align: right;">
											<p class="fav-btn unfaved btn btn-hollow">
												<i class="icon-fav"></i>收藏
												<span class="collection-tip">您还能收藏<i>15</i>个关键字至'我的收藏'</span>
											</p>
											<br>
											<a class="detail-link" href="index.php?ctl=Seller_Sycm&met=detailAnalysis" target="_blank">详情分析</a>
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
										<span>暂无关键词</span>
									</p>
								</div>
							</div> -->
						</div>
					</div>
				</div>
				<div class="wrap-switch">
					<div class="search-box">
						<i class="icon"></i>
						<div class="input-container">
							<input type="text" class="search-input" name="">
							<a href="javascript:;" class="btn rt">
								<i class="icon icon-btn-search"></i>
								<span>查看</span>
							</a>
						</div>
						<div class="recommend-list"></div>
					</div>
					<div class="wrap-title">
						<div class="title-lf lf">行业相关搜索词</div>
						<div class="operation-actions rt">
							<div class="select-control download rt">
								<a href="javascript:;">
									<i class="icon"></i>
									<span class="val">下载</span>
								</a>
								<div class="ui-download-panel ui-download-right select-control-list">
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
							<div class="date-text rt">2017-12-03 ~ 2017-12-09</div>
							<div class="select-control ui-selector rt">
								<a href="javascript:;">
									<span class="ui-selector-value">日期</span>
									<span class="caret icon"></span>
								</a>
								<ul class="ui-selector-list select-control-list" style="display: none;">
									<li class="ui-selector-item curr">
										<span>最近1天</span>
									</li>
									<li class="ui-selector-item">
										<span>最近7天平均</span>
									</li>
									<li class="ui-selector-item day">
										<span>日</span>
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
										<th class="th col-0 col-search" style="width:22%;text-align: left;">搜索词</th>
										<th class="th col-1 col-brings orderable sortableTh" style="text-align: right;">
											<span>全网搜索热度</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-2 col-rate orderable sortableTh" style="text-align: right;">
											<span>全网搜索热度变化</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-3 col-hot-search orderable sortableTh" style="text-align: right;">
											<span>全网点击率</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-4 col-click orderable sortableTh" style="text-align: right;">
											<span>全网商品数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-5 col-goods-num sortableTh" style="text-align: right;">
											<span>直通车平均点击单价</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-6 col-operate" style="text-align: right;padding-right: 30px;">操作</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="th col-search" style="height: 79px;text-align: left;">
											<a href="javascript:;">玫琳凯眼影正品彩妆盘</a>
										</td>
										<td class="th" style="height:79px;">2</td>
										<td class="th" style="height:79px;">0.00%</td>
										<td class="th" style="height:79px;">96</td>
										<td class="th" style="height:79px;">110.24%</td>
										<td class="th" style="height:79px;">55</td>
										<td class="th col-operate" style="text-align: right;">
											<p class="fav-btn unfaved btn btn-hollow">
												<i class="icon-fav"></i>收藏
											</p>
											<br>
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
										<span>暂无关键词</span>
									</p>
								</div>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 选词助手 end -->

	<!-- 店内路径 start -->
	<div class="w-1260 rt switch-wrap flow-container">
		<div class="store-path-wrap">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">店内路径</h3>
				<ul class="rt device-choose-wrap orflow">
					<li class="device-noLine lf active"><a href="javascript:;">无线</a></li>
					<li class="device-PC lf"><a href="javascript:;">PC</a></li>
				</ul>
			</div>
			<div class="shop-inner-wrap mt-10">
				<div class="mod backff">
					<div class="shop-accept">
						<div class="wrap-title">
							<div class="title-lf lf">无线入店与承接</div>
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
										<span>最近7天平均</span>
									</li>
									<li class="ui-selector-item last-30">
										<span>最近30天平均</span>
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
						<div class="accesible-detail orflow backff">
							<div class="nav-blank">
								<ul class="nav-blank-menu orflow">
									<li class="nav-blank-item lf">
										<a href="javascript:;">
											<ul class="app-details orflow">
												<li class="lf">
													<div>
														<span> 
															<i class="icon"></i>
														</span>
													</div>
													<div class="app-name">淘宝APP</div>
												</li>
												<li class="detail lf">
													<p class="uv">访客数</p>
													<p class="value num">9</p>
													<p class="create-buyer-rate mt-16">下单转化率</p>
													<p class="rate num">100%</p>
												</li>
											</ul>
										</a>
									</li>
								</ul>
							</div>
							<ul class="detail-list">
								<li class="item-title orflow">
									<div class="enter-page lf">入口页面</div>
									<div class="buyer-rate lf">
										<span class="square-buyer lf square"></span>
										<span class="lf">下单买家数</span>
										<span class="square-uv lf square"></span>
										<span class="lf">访客数</span>
									</div>
									<div class="pv lf">
										<span class="show-num">访客数</span>
										<span class="show-rate">占比</span>
									</div>
									<div class="create-buyer-cnt lf">
										<span class="show-num">下单买家数</span>
										<span class="show-rate">占比</span>
									</div>
									<div class="create-buyer-rate lf">
										<span class="show-rate">下单转化率</span>
									</div>
								</li>
								<li class="item-content orflow">
									<div class="enter-page lf">店铺首页</div>
									<div class="buyer-rate lf">
										<ul class="rate lf" style="width:0%">
											<li class="master lf"></li>
										</ul>
									</div>
									<div class="pv lf">
										<span class="show-num num">0</span>
										<span class="show-rate num">0.00%</span>
									</div>
									<div class="create-buyer-cnt lf">
										<span class="show-num num">0.00</span>
										<span class="show-rate num">0.00%</span>
									</div>
									<div class="create-buyer-rate lf">
										<span class="show-rate num">-</span>
									</div>
								</li>
								<li class="item-content orflow">
									<div class="enter-page lf">商品详情页</div>
									<div class="buyer-rate lf">
										<ul class="rate lf" style="width:100%">
											<li class="master lf" style="width:100%"></li>
										</ul>
									</div>
									<div class="pv lf">
										<span class="show-num num">2</span>
										<span class="show-rate num">0.00%</span>
									</div>
									<div class="create-buyer-cnt lf">
										<span class="show-num num">0.00</span>
										<span class="show-rate num">0.00%</span>
									</div>
									<div class="create-buyer-rate lf">
										<span class="show-rate num">100%</span>
									</div>
								</li>
								<li class="item-content orflow">
									<div class="enter-page lf">店铺微淘页</div>
									<div class="buyer-rate lf">
										<ul class="rate lf" style="width:0%">
											<li class="master lf"></li>
										</ul>
									</div>
									<div class="pv lf">
										<span class="show-num num">0</span>
										<span class="show-rate num">0.00%</span>
									</div>
									<div class="create-buyer-cnt lf">
										<span class="show-num num">0.00</span>
										<span class="show-rate num">0.00%</span>
									</div>
									<div class="create-buyer-rate lf">
										<span class="show-rate num">-</span>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="shop-accept">
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
								<div id="visitor-disribution-chart" class="visitor-disribution-chart" style="width: 320px;height: 320px;">
								</div>
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
								<div class="ui-download-panel ui-download-right select-control-list">
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
	</div>
	<!-- 店内路径 end -->

	<!-- 流量去向 start -->
	<div class="w-1260 rt switch-wrap  flow-container">
		<div class="flow-where-wrap">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">流量去向</h3>
			</div>
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
								<div class="ui-download-panel ui-download-right select-control-list">
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
								<div class="ui-download-panel ui-download-right select-control-list">
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
	</div>
	<!-- 流量去向 end -->

	<!-- 页面分析 start -->
	<div class="w-1260 rt switch-wrap  flow-container">
		<div class="page-analysis-wrap">
			<div class="screen-header h-50">
				<div class="lf">页面分析</div>
				<div class="update-option">
					<p class="option rt">
						<span>最近1天（2017-09-26~2017-09-26）</span>
						<i class="icon caret"></i>
					</p>
					<div class="date-wrap" style="display: none;">
						<ul>
							<li class="datePicker-item lastest-n active">
								<span class="datePicker-rangeText">最近1天</span>
								<span class="datePicker-rangeTime rt">（2017-09-26~2017-09-26）</span>
							</li>
							<li class="datePicker-item datetimepicker-day">
								<span class="datePicker-rangeText">日</span>
								<span class="datePicker-rangeTime"></span>
							</li>
						</ul>
						<div class="laydate-wrap laydate-wrap-day" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
						<div class="laydate-wrap laydate-wrap-week" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
						<div class="laydate-wrap laydate-wrap-month" style="position: absolute;right:0;top:0;width:232px;bottom:1px;z-index: -1;"></div>
					</div>
				</div>
				<p class="fast-open rt"><a href="javascript:;">快速创建<i>+</i></a></p>
				<div class="limit-experience"></div>
			</div>
			<div class="web-analysis-wrap">
				<div class="index-web mt-10 backff">
					<div class="wrap-title">
						<div class="title-lf lf">首页&自定义承接页</div>
						<div class="operation-actions rt">
							<div class="rt wrap-app">
								<span class="curr name-app">淘宝App</span>
								<span class="name-app">天猫App</span>
							</div>
						</div>
					</div>
					<div class="ebase-card-content">
						<div class="onenessCard">
							<div class="content-container">
								<div class="oui-index-picker">
									<div class="oui-index-picker-group">
										<div class="oui-index-picker-label">流量相关</div>
										<div class="oui-index-picker-content orflow">
											<div class="oui-index-picker-blank"></div>
											<div class="combo-panel-lite combo-panel-inline lf">
												<span class="checkbox selected">
													<span class="option"></span>
													<span class="name">访客数</span>
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
												<span class="checkbox selected">
													<span class="option"></span>
													<span class="name">点击人数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox selected">
													<span class="option"></span>
													<span class="name">引导下单买家数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox selected">
													<span class="option"></span>
													<span class="name">引导支付金额</span>
												</span>
											</div>
										</div>
									</div>
									<div class="oui-index-picker-group">
										<div class="oui-index-picker-label">引导转化</div>
										<div class="oui-index-picker-content orflow">
											<div class="oui-index-picker-blank"></div>
											<div class="combo-panel-lite combo-panel-inline lf">
												<span class="checkbox selected">
													<span class="option"></span>
													<span class="name">引导支付买家数</span>
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
										<span class="oui-index-picker-count">选择 5/5</span>
										<a href="javascript:;" class="oui-index-picker-reset">重置</a>
									</div>
								</div>
								<div class="table-container">
									<div class="ebase-table-root">
										<table class="table">
											<thead class="thead">
												<tr>
													<th class="th col-0 col-page" style="text-align: left;padding-left: 5px;">页面名称</th>
													<!-- <th class="th col-1 col-uv orderable sortableTh" style="text-align: right;">
														<span>访客数</span>
														<span class="order-flag desc">
															<i class="icon icon-order"></i>
														</span>
														<div class="ebase-col-crc">较前1日</div>
													</th>
													<th class="th col-2 col-clickUv orderable sortableTh" style="text-align: right;">
														<span>点击人数</span>
														<span class="order-flag">
															<i class="icon-order icon"></i>
														</span>
														<div class="ebase-col-crc">较前1日</div>
													</th>
													<th class="th col-3 col-leOrderBuyerCnt orderable sortableTh" style="text-align: right;">
														<span>引导下单买家数</span>
														<span class="order-flag">
															<i class="icon-order icon"></i>
														</span>
														<div class="ebase-col-crc">较前1日</div>
													</th>
													<th class="th col-4 col-lePayAmt orderable sortableTh" style="text-align: right;">
														<span>引导支付金额</span>
														<span class="order-flag">
															<i class="icon-order icon"></i>
														</span>
														<div class="ebase-col-crc">较前1日</div>
													</th>
													<th class="th col-5 col-lePayBuyerCnt orderable sortableTh" style="text-align: right;">
														<span>引导支付买家数</span>
														<span class="order-flag">
															<i class="icon-order icon"></i>
														</span>
														<div class="ebase-col-crc">较前1日</div>
													</th> -->
													<th class="th col-6 col-page" style="text-align: right;">操作</th>
												</tr>
											</thead>
											<tbody class="tbody">
												<tr class="tr">
													<td class="td col-0 col-page" style="text-align: left;padding-left: 5px;">
														<p>手机淘宝店铺首页</p>
													</td>
													<!-- <td class="td col-1 col-uv" style="text-align: right;">
														<div class="ebase-td-root">
															<p class="ebase-td-selfValue">
																<span class="ebase-td-value">0</span>
															</p>
															<p class="ebase-td-changeRate r-trend up">
																<span class="ebase-td-value">0</span>
																<i class="icon icon-trend"></i>
															</p>
														</div>
													</td>
													<td class="td col-2 col-clickUv" style="text-align: right;">
														<div class="ebase-td-root">
															<p class="ebase-td-selfValue">
																<span class="ebase-td-value">0</span>
															</p>
															<p class="ebase-td-changeRate">
																<span class="ebase-td-value">0</span>
																<i class="icon"></i>
															</p>
														</div>
													</td>
													<td class="td col-3 col-leOrderBuyerCnt" style="text-align: right;">
														<div class="ebase-td-root">
															<p class="ebase-td-selfValue">
																<span class="ebase-td-value">0</span>
															</p>
															<p class="ebase-td-changeRate">
																<span class="ebase-td-value">0</span>
																<i class="icon"></i>
															</p>
														</div>
													</td>
													<td class="td col-4 col-lePayAmt" style="text-align: right;">
														<div class="ebase-td-root">
															<p class="ebase-td-selfValue">
																<span class="ebase-td-value">0</span>
															</p>
															<p class="ebase-td-changeRate">
																<span class="ebase-td-value">0</span>
																<i class="icon"></i>
															</p>
														</div>
													</td>

													<td class="td col-5 col-lePayBuyerCnt" style="text-align: right;">
														<div class="ebase-td-root">
															<p class="ebase-td-selfValue">
																<span class="ebase-td-value">0</span>
															</p>
															<p class="ebase-td-changeRate">
																<span class="ebase-td-value">0</span>
																<i class="icon"></i>
															</p>
														</div>
													</td> -->
													<td class="td col-6 col-page" style="text-align: right;">
														<div class="pagedPageOverview-operation">
															<p>
																<a href="javascript:;" class="pagesPageOverview-pageLink clickLink" target="_blank">点击分布</a>
																<a href="javascript:;" class="pagesPageOverview-pageLink trend-link" target="_blank">数据趋势</a>
															</p>
															<p>
																<span class="orderPanelOrderPanel-orderName">
																	引导详情
																</span>
															</p>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="detail-web mt-10 backff">
					<div class="wrap-title">
						<div class="title-lf lf">商品详情页</div>
						<div class="operation-actions rt">
							<div class="rt">淘宝APP  天猫APP</div>
						</div>
					</div>
					<div class="ebase-card-content">
						<div class="onenessCard">
							<div class="content-container">
								<div class="oui-index-picker">
									<div class="oui-index-picker-group">
										<div class="oui-index-picker-label">流量相关</div>
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
									<div class="oui-index-picker-group">
										<div class="oui-index-picker-label">引导转化</div>
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
												<span class="checkbox selected">
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
												<span class="checkbox selected">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox">
													<span class="option"></span>
													<span class="name">商品访客数</span>
												</span>
												<span class="checkbox selected">
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
										<span class="oui-index-picker-count">选择 5/5</span>
										<a href="javascript:;" class="oui-index-picker-reset">重置</a>
									</div>
								</div>
								<div class="table-container">
									<div class="ebase-table-root">
										<table class="table">
											<thead class="thead">
												<tr>
													<th class="th col-0 col-page" style="text-align: left;padding-left: 5px;">商品名称</th>
													<!-- <th class="th col-1 col-uv orderable sortableTh" style="text-align: right;">
														<span>访客数</span>
														<span class="order-flag desc">
															<i class="icon icon-order"></i>
														</span>
														<div class="ebase-col-crc">较前1日</div>
													</th>
													<th class="th col-2 col-clickUv orderable sortableTh" style="text-align: right;">
														<span>点击人数</span>
														<span class="order-flag">
															<i class="icon icon-order"></i>
														</span>
														<div class="ebase-col-crc">较前1日</div>
													</th>
													<th class="th col-3 col-leOrderBuyerCnt orderable sortableTh" style="text-align: right;">
														<span>引导下单买家数</span>
														<span class="order-flag">
															<i class="icon icon-order"></i>
														</span>
														<div class="ebase-col-crc">较前1日</div>
													</th>
													<th class="th col-4 col-lePayAmt orderable sortableTh" style="text-align: right;">
														<span>引导支付金额</span>
														<span class="order-flag">
															<i class="icon icon-order"></i>
														</span>
														<div class="ebase-col-crc">较前1日</div>
													</th>
													<th class="th col-5 col-lePayBuyerCnt orderable sortableTh" style="text-align: right;">
														<span>引导支付买家数</span>
														<span class="order-flag">
															<i class="icon icon-order"></i>
														</span>
														<div class="ebase-col-crc">较前1日</div>
													</th> -->
													<th class="th col-6 col-page" style="text-align: right;">操作</th>
												</tr>
											</thead>
											<tbody class="tbody">
												<tr class="tr">
													<td class="td col-0 col-page" style="text-align: left;padding-left: 5px;">
														<div class="ebase-goodsTd-root orflow">
															<a href="javascript:;" class="ebase-goodsTd-goodsImg lf">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748394131737.png">
															</a>
															<div class="ebase-goodstd-Info lf">
																<div class="ebase-goodsTd-goodsName">
																	<a href="javascript:;">飘柔家庭护理兰花长效洁顺水润洗发露190ML200ML400ML750ML1L</a>
																</div>
															</div>
														</div>
													</td>
													<!-- <td class="td col-1 col-uv" style="text-align: right;">
														<div class="ebase-td-root">
															<p class="ebase-td-selfValue">
																<span class="ebase-td-value">0</span>
															</p>
															<p class="ebase-td-changeRate">
																<span class="ebase-td-value">0</span>
																<i class="icon"></i>
															</p>
														</div>
													</td>
													<td class="td col-2 col-clickUv" style="text-align: right;">
														<div class="ebase-td-root">
															<p class="ebase-td-selfValue">
																<span class="ebase-td-value">0</span>
															</p>
															<p class="ebase-td-changeRate">
																<span class="ebase-td-value">0</span>
																<i class="icon"></i>
															</p>
														</div>
													</td>
													<td class="td col-3 col-leOrderBuyerCnt" style="text-align: right;">
														<div class="ebase-td-root">
															<p class="ebase-td-selfValue">
																<span class="ebase-td-value">0</span>
															</p>
															<p class="ebase-td-changeRate">
																<span class="ebase-td-value">0</span>
																<i class="icon"></i>
															</p>
														</div>
													</td>
													<td class="td col-4 col-lePayAmt" style="text-align: right;">
														<div class="ebase-td-root">
															<p class="ebase-td-selfValue">
																<span class="ebase-td-value">0</span>
															</p>
															<p class="ebase-td-changeRate">
																<span class="ebase-td-value">0</span>
																<i class="icon"></i>
															</p>
														</div>
													</td>

													<td class="td col-5 col-lePayBuyerCnt" style="text-align: right;">
														<div class="ebase-td-root">
															<p class="ebase-td-selfValue">
																<span class="ebase-td-value">0</span>
															</p>
															<p class="ebase-td-changeRate">
																<span class="ebase-td-value">0</span>
																<i class="icon"></i>
															</p>
														</div>
													</td> -->
													<td class="td col-6 col-page" style="text-align: right;">
														<div class="pagedPageOverview-operation">
															<p>
																<a href="javascript:;" class="pagesPageOverview-pageLink clickLink" target="_blank">点击分布</a>
																<a href="javascript:;" class="pagesPageOverview-pageLink trend-link" target="_blank">数据趋势</a>
															</p>
															<p>
																<span class="orderPanelOrderPanel-orderName">
																	引导详情
																</span>
															</p>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 页面分析 end -->

	<!-- 页面配置 start -->
	<div class="w-1260 rt switch-wrap flow-container">
		<div class="page-setup-wrap">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">装修分析</h3>
				<ul class="rt device-choose-wrap orflow">
					<li class="device-noLine lf active"><a href="javascript:;">无线</a></li>
					<li class="device-PC lf"><a href="javascript:;">PC</a></li>
				</ul>
			</div>
			<div class="web-config-wrap">
				<div class="ed-custom-web mod mt-10 backff">
					<div class="wrap-title">
						<div class="title-lf lf">已定制自定义页&承接页</div>
						<div class="operation-actions rt">
							<a class="rt made-btn btn">添加定制</a>
						</div>
					</div>
					<div class="content">
						<ul class="menu orflow">
							<li class="col col-name wireless lf">页面名称</li>
							<li class="col col-date lf">定制时间</li>
							<li class="col col-operation lf">操作</li>
						</ul>
						<ul class="list">
							<li>
								<div class="col col-name wireless lf">
									<p class="name">
										<span class="page-type hompage">默认</span>
										<span>首页</span>
									</p>
								</div>
								<p class="col col-date lf">默认</p>
								<div class="col col-operation lf">
									<span class="action big-button">
										<a href="index.php?ctl=Seller_Sycm&met=decorationAnalysis" class="btn btn-hollow">查看详情</a>
									</span>
									<div class="action small-button">
										<a href="javascript:;">页面数据</a>
									</div>
									<div class="action convertion-action">										
										<span class="text-wrapper">
											<span class="tips-wrap">
												<i class="icon convertion-icon-tips"></i>
												<div class="tips-guide-wrap  convertion-tips">
													<div class="paid-module-no-permission">
														<span class="error">
															<span class="icon-big-info icon"></span>
														</span>
														亲，您还未订购装修分析，暂时无法使用！
														<a href="javascript:;" class="btn order-btn">立即订购</a>
														<a href="javascript:;" class="preview-btn">功能预览</a>
													</div>
													<i class="icon close-icon">x</i>
												<!-- 	<i class="arrow outer-arrow"></i>
													<i class="arrow inner-arrow"></i> -->
												</div>
											</span>
											<a href="javascript:;" class="unactive">引导详情</a>
										</span>
									</div>
								</div>
							</li>
						</ul>
						<div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>除了默认的首页，您尚未定制自定义页&承接页，您可以先至下方添加自定义页&承接页
									</span>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="ed-detail-web mod mt-10 backff">
					<div class="wrap-title">
						<div class="title-lf lf">已定制商品详情页</div>
						<div class="operation-actions rt">
							<a class="rt btn made-btn">添加定制</a>
						</div>
					</div>
					<div class="content">
						<ul class="menu orflow">
							<li class="col col-name lf">页面名称</li>
							<li class="col col-url lf">页面链接</li>
							<li class="col col-date lf">定制时间</li>
							<li class="col col-operation lf">操作</li>
						</ul>
						<div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>除了默认的首页，您尚未定制自定义页&承接页，您可以先至下方添加自定义页&承接页
									</span>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="action-add-web mod mt-10 backff">
					<div class="wrap-title">
						<div class="switch-wrap-att orflow">
							<span class="curr lf">
								<a href="javascript:;">添加自定义页&承接页</a>
							</span>
							<span class="lf">
								<a href="javascript:;">添加商品详情页</a>
							</span>
						</div>
					</div>
					<div class="content">
						<p class="remain-message">
							<span>您还可添加</span><em class="highlight">5个</em>页面
						</p>
						<div class="row row-selector orflow">
							<p class="col col-left">添加页面</p>
							<div class="col col-right">
								<div class="selector-container">
									<div class="select-control ui-selector disabled">
										<a href="javascript;;" class="btn btn-selector">
											<span class="caret">
												<i class="caret icon"></i>
											</span>
											<span class="ui-selector-val is-placeholder">请选择要添加的自定义页&承接页</span>
										</a>
										<!-- <div class="ui-scroller hide"></div> -->
									</div>
									<span class="message-cnt error">
										<i class="icon icon-info"></i>
										您还没有可选的自定义页&承接页，如需添加页面，请到店铺装修后台“
										<a href="javascript:;">自定义页面</a>
										”设置，如图所示位置
									</span>
								</div>
								<div class="schematic-container">
									<p class="arrow-outer"></p>
									<p class="arrow-inner"></p>
									<img src="//img.alicdn.com/tps/TB1PqrvKXXXXXXfXVXXXXXXXXXX-532-145.png">
									<div class="schematic-desc">
										<p>如图所示：</p>
										<p>列表中提供的可选择自定义页为装修后台中的自定义页面类</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row row-name orflow">
							<p class="col col-left">输入定制页面名称</p>
							<p class="col col-right">
								<input type="text" name="" class="text-input">
							</p>
						</div>
						<div class="btn-container">
							<a href="javascript:;" class="btn btn-disabled">添加</a>
						</div>
					</div>
					<div class="content">
						<p class="remain-message">
							<span>您还可添加</span><em class="highlight">5个</em>页面
						</p>
						<div class="row row-selector orflow">
							<p class="col col-left">输入商品ID</p>
							<div class="col col-right">
								<div class="itemID-container">
									<input type="text" class="text-input active-input" name="">
								</div>
								<div class="schematic-container">
									<p class="arrow-outer"></p>
									<p class="arrow-inner"></p>
									<img src="https://img.alicdn.com/tps/i2/TB1M5ZHGVXXXXa4XpXXPhi4VFXX-532-90.png">
									<div class="schematic-desc">
										<p>如图所示：</p>
										<p>商品详情页链接地址中id="数字"就是您的商品ID</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row row-name orflow">
							<p class="col col-left">输入定制页面名称</p>
							<p class="col col-right">
								<input type="text" name="" class="text-input">
							</p>
						</div>
						<div class="btn-container">
							<a href="javascript:;" class="btn btn-disabled">添加</a>
						</div>
					</div>
				</div>
				<div class="ops-base-card mod mt-10 backff">
					<div class="content">
						<p class="desc">1.首页默认为已定制页面，可自定义添加其他页面；如果添加页面数达到上限，可点击删除已定制页面再重新添加新页面；</p>
						<p class="desc">2.页面定制成功后数据从添加成功后的第二天开始提供；</p>
						<p class="desc">3.所有的数据只从V4.8.0版本（即2014年8月29日发布的)才开始计算统计，所以不包含旧版本产生的数据；</p>
						<p class="desc">4.如果遇到数据没有显示出来的情况，可能产生的原因如下：a.中途重新装修过页面； b.页面没有产生点击；</p>
						<p class="desc">5.如果已定制双十一承接页，请在店铺模板变更后重新添加！</p>
						<p class="desc">6.淘宝商家请注意，由于淘宝的双十一承接页技术实现问题，会引起承接页的部分数据无法统计到。</p>
						<p class="desc">7.装修分析功能对浏览器性能高，为了给您带来更好体验，推荐使用：
							<a href="javascript:;">Chrome最新版本浏览器</a>，
							<a href="javascript:;">360极速浏览器</a>，
							<a href="javascript:;">UC浏览器</a>
						</p>
						<div class="obj-title">
							<p class="title">功能</p>
							<p class="title">说明</p>
						</div>
						<p class="arrow outer-arrow"></p>
						<p class="arrow inner-arrow"></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 页面配置 end -->

	<!-- 运营计划 start -->
	<div class="w-1260 rt switch-wrap flow-container">
		<div class="operational-planning-wrap">
			<div class="screen-header h-50">
				<div class="lf">运营计划</div>
				<p class="fast-open rt"><a href="index.php?ctl=Seller_Sycm&met=newPlanning">快速创建<i>+</i></a></p>
			</div>
			<!-- 空 start -->
			<div class="plan-wrap mt-10 backff">
				<div class="ebase-error">
					<div class="ebase-error-page"></div>
					<p>
						<span>您还没有制定年度计划，可以<a href="javascript:;">快速创建</a></span>
					</p>
				</div>
			</div>
			<!-- 空 end -->
		</div>
	</div>
	<!-- 运营计划 end -->
</div>

<div class="ebase-FloorNav__root">
	<ul>
		<li>
			<a href="javascript:;" class="ebase-FloorNav__item ebase-FloorNav__active">整体</a>
		</li>
		<li><a href="javascript:;" class="ebase-FloorNav__item">关注</a></li>
		<li><a href="javascript:;" class="ebase-FloorNav__item">来源</a></li>
		<li><a href="javascript:;" class="ebase-FloorNav__item" >商品</a></li>
		<li class="gototop" style="display: none;"><a href="javascript:;" class="ebase-FloorNav__item"><i class="lift_btn_arrow" style="font-size: 18px;"></i></a></li>
	</ul>
</div>

<div class="mask-dialog add-attention-dialog">
	<div class="add-attention-dialog-inner">
		<div class="attention-dialog-header">
			<i class="oui-icon oui-icon-times oui-dialog-close">x</i>
			<h4 class="oui-dialog-title">添加关注</h4>
		</div>
		<div class="attention-dialog-content" style="overflow: hidden;">
			<div>
				<div class="dialog-concern-title">选择来源：</div>
				<div class="SelectorShopSourceSelector__root ebase-AdvanceSelector__root">
					<div class="SelectorElementSelectorTrigger__root" data-ebase="ElementSelectorTrigger"><div class="SelectorElementSelectorTrigger__addIcon">+</div></div>
					<div class="ebase-advanceSelector-menu">
						<div class="legacy-oui-typeahead oui-open">
							<div class="legacy-oui-typeahead-input-wrapper">
								<input type="text" class="legacy-oui-typeahead-input" value="" placeholder="请输入店铺来源关键字或在下方列表选择">
								<i class="oui-icon oui-icon-search search-icon"></i>
								<!-- <span class="search-del">×</span> -->
							</div>
							<div class="oui-scroller" style="height: 180px;">
								<div class="legacy-oui-typeahead-menu oui-scroller-content" style="height: 180px;">
									<span class="legacy-oui-typeahead-item menu-item false"><span class="text">我的淘宝</span></span>
									<span class="legacy-oui-typeahead-item menu-item false"><span class="text">直接访问</span></span>
									<span class="legacy-oui-typeahead-item menu-item false"><span class="text">购物车</span></span>
									<span class="legacy-oui-typeahead-item menu-item active"><span class="text">淘宝客</span></span>
									<span class="legacy-oui-typeahead-item menu-item false"><span class="text">直通车</span></span>
									<span class="legacy-oui-typeahead-item menu-item false"><span class="text">智钻</span></span>
									<span class="legacy-oui-typeahead-item menu-item false"><span class="text">聚划算</span></span>
									<span class="legacy-oui-typeahead-item menu-item false"><span class="text">麻吉宝</span></span>
								</div>
							</div>
						</div>
						<div>
							<span class="history-title">最近浏览</span>
							<div class="legacy-oui-typeahead oui-open">
								<div class="legacy-oui-typeahead-menu">
									<span class="legacy-oui-typeahead-item menu-item active">
										<span class="text">购物车</span>
									</span>
									<span class="legacy-oui-typeahead-item menu-item false">
										<span class="text">淘宝客</span>
									</span>
									<span class="legacy-oui-typeahead-item menu-item false">
										<span class="text">直接访问</span>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="oui-dialog-actions"><button class="oui-btn oui-btn-md oui-btn-hollow">取消</button><button class="oui-btn oui-btn-md oui-btn-primary">确定</button></div>
	</div>
</div>

<!-- 流量 -- 页面配置 -- 页面数据 dialog start-->
<div class="dialog-mask web-data-dialog">
	<div class="dialog-locator">
	<div class="dialog-container">
		<div class="dialog-header">
			<button type="button" class="dialog-close close">x</button>
			<p class="dialog-title"><span>无线端</span><span style="color: rgb(13, 181, 192);">  首页  </span><span>页面的最近30天点击效果数据</span></p>
		</div>
		<div class="dialog-content">
			<div class="trend-options orflow">
				<div class="operation">
					<div class="ui-switch btn-group-switch app-switch">
						<ul class="ui-switch-menu">
							<li class="active ui-switch-link ui-switch-item">
								<a href="javascript:;" target="_blank">淘宝App</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="combopanel index-combo-panel">
					<div class="combopanel-panel combo-panel-inline combo-panel-lite">
						<div class="ui-combopanel-groups">
							<div class="group-wrapper">
								<span class="group-title">流量相关：</span>
								<div class="group clearfix">
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">浏览量</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">访客数</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">点击次数</span>
									</span>
									<span class="checkbox selected">
										<span class="option"></span>
										<span class="name">点击人数</span>
									</span>
									<span class="checkbox selected">
										<span class="option"></span>
										<span class="name">点击率</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">跳失率</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">平均停留时长</span>
									</span>
								</div>
							</div>
							<div class="group-wrapper">
								<span class="group-title">引导转化：</span>
								<div class="group clearfix">
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">引导下单金额</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">引导下单买家数</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">引导下单转化率</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">引导支付金额</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">引导支付买家数</span>
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
			<div id="commonchart" class="commonchart" style="width: 970px; height: 380px";></div>
		</div>
	</div>
	</div>
</div>
<!-- 流量 -- 页面配置 -- 页面数据 dialog end-->

<!-- 流量 -- 店铺来源 -- 趋势 start -->
<div class="dialog-mask trend-dialog oui-dialog flow-trend-dialog esycm-wrapper">
	<div class="oui-dialog-locator">
		<div class="oui-dialog-container">
			<div class="oui-dialog-header">
				<i class="oui-icon oui-icon-times oui-dialog-close">x</i>
				<div class="titleWrapper oui-dialog-title">
					<span>流量趋势</span>
					<a class="downloadLink oui-n-download" href="javascript:;"><span>下载</span><i class="oui-icon oui-icon-download downloadIcon"></i></a>
				</div>
			</div>
			<div class="oui-dialog-content">
				<div class="mod-trend">
					<div class="trend-index-picker ebase-IndexPicker__root index-picker">
						<div class="ebase-IndexPicker__group">
							<div class="ebase-IndexPicker__label">指标</div>
							<div class="ebase-IndexPicker__content">
								<div class="ebase-IndexPicker__blank"></div>
								<ul class="ebase-IndexPicker__list">
									<li class="ebase-IndexPicker__item">
										<span class="oui-radio oui-checked">
											<span class="oui-icon-stacked">
												<i class="oui-icon oui-icon-radio-border"></i>
												<i class="oui-icon oui-icon-radio-dot"></i>
											</span>
											<span class="oui-form-name">
												<span class="ebase-IndexPicker__text">访客数</span>
											</span>
										</span>
									</li>
									<li class="ebase-IndexPicker__item">
										<span class="oui-radio oui-unchecked">
											<span class="oui-icon-stacked">
												<i class="oui-icon oui-icon-radio-border"></i>
											</span>
											<span class="oui-form-name">
												<span class="ebase-IndexPicker__text">下单买家数</span>
											</span>
										</span>
									</li>
									<li class="ebase-IndexPicker__item">
										<span class="oui-radio oui-unchecked">
											<span class="oui-icon-stacked">
												<i class="oui-icon oui-icon-radio-border"></i>
											</span>
											<span class="oui-form-name">
												<span class="ebase-IndexPicker__text">下单转化率</span>
											</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
						<div class="ebase-IndexPicker__action"></div>
					</div>
					<div class="trend-chart" id="trend-chart" style="width:970px;height: 380px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 流量 -- 店铺来源 -- 趋势 end -->


<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
<script src="http://echarts.baidu.com/asset/map/js/china.js"></script>
<script type="text/javascript">
	var shopVisitechart = echarts.init(document.getElementById('shop-visit-chart'));
	 		// 指定图表的配置项和数据
		 	var colors = ['#2062e6','#cecece']
	        var option = {
	          grid: {
			        top: '15%',
			        bottom: '0%',
			        left: '0%',
			        right: '0%'
			    	},
					 axisLabel: {
					  show: false
					  },
		          xAxis: {    //  x坐标轴
		          	show: false,
		          	type: 'category',
		              data: ["00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"],
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
		                smooth: true,
		                symbol: 'circle',  // 折点处空心圆
		              	symbolSize: 8,
		                showSymbol:false,
		                interval: 7,
		                 areaStyle: {normal: {
		                	color: '#eef1f6'
		                }},
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {    // 线条颜色
		                			color: colors[1]
		                		}
		                	}
		                },
		                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1]
		            },
		            {
		                type: 'line',
		                smooth: true,
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
		                data: [2, 0, 0, 0, 0, 0, 0, 1, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
		            }
		          ]
		      };
	      // 使用刚指定的配置项和数据显示图表。
	      shopVisitechart.setOption(option);

  	var goodsvisitchart = echarts.init(document.getElementById('goods-visit-chart'));
	 		// 指定图表的配置项和数据
	 		var colors = ['#2062e6','#cecece']
	        var option = {
	          grid: {
			        top: '15%',
			        bottom: '0%',
			        left: '0%',
			        right: '0%'
			    	},
					 axisLabel: {
					  show: false
					  },
	          xAxis: {    //  x坐标轴
	          	show: false,
	          	type: 'category',
	              data: ["00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"],
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
	                smooth: true,
	                symbol: 'circle',  // 折点处空心圆
	              	symbolSize: 8,
	                showSymbol:false,
	                interval: 7,
	                 areaStyle: {normal: {
	                	color: '#eef1f6'
	                }},
	                itemStyle: {
	                	normal: {
	                		color: colors[1],
	                		lineStyle: {    // 线条颜色
	                			color: colors[1]
	                		}
	                	}
	                },
	                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1]
	            },
	            {
	                type: 'line',
	                smooth: true,
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
	                data: [2, 0, 0, 0, 0, 0, 0, 1, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
	            }
	          ]
	      };
	      // 使用刚指定的配置项和数据显示图表。
	      goodsvisitchart.setOption(option);

 	var transferChart = echarts.init(document.getElementById('transfer-chart'));
	 		// 指定图表的配置项和数据
	 		var colors = ['#2062e6','#cecece']
	        var option = {
	          grid: {
			        top: '15%',
			        bottom: '0%',
			        left: '0%',
			        right: '0%'
			    	},
					 axisLabel: {
					  show: false
					  },
	          xAxis: {    //  x坐标轴
	          	show: false,
	          	type: 'category',
	              data: ["00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"],
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
	                smooth: true,
	                symbol: 'circle',  // 折点处空心圆
	              	symbolSize: 8,
	                showSymbol:false,
	                interval: 7,
	                 areaStyle: {normal: {
	                	color: '#eef1f6'
	                }},
	                itemStyle: {
	                	normal: {
	                		color: colors[1],
	                		lineStyle: {    // 线条颜色
	                			color: colors[1]
	                		}
	                	}
	                },
	                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1]
	            },
	            {
	                type: 'line',
	                smooth: true,
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
	                data: [2, 0, 0, 0, 0, 0, 0, 1, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
	            }
	          ]
	      };
	      // 使用刚指定的配置项和数据显示图表。
	      transferChart.setOption(option);

  	var pieCntChart = echarts.init(document.getElementById('pie-cnt-chart'));
	  	var colors = ["#97ce68","#a6d57f","#b6dd95","#c6e4ac","#d5ebc3","#e5f3d9"];
	  	option = {
		    series: [
	        {
	          // name:'访问来源',	
	          type:'pie',
	          radius: ['90%', '60%'],
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
	          data:[
	            {
	            	value:335, 
	            	name:'直接访问',
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
	            	value:310, 
	            	name:'邮件营销',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[1]
	            		}
	            	}
	            },
	            {value:234, 
	            	name:'联盟广告',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[2]
	            		}
	            	}
	            },
	            {
	            	value:135, 
	            	name:'视频广告',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[3]
	            		}
	            	}
	            },
	            {
	            	value:1548, 
	            	name:'搜索引擎',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[4]
	            		}
	            	}
	            }
		         ]
		       }
		    	]
				};
			pieCntChart.setOption(option);
	   
  	var visitorsChart = echarts.init(document.getElementById('visitors-chart'));
	  	var colors = ["#2062e6","#f3d024"]
	  	option = {
		    legend: {
	        // orient: 'vertical',
	        left: 'left',
	        data: ['新访客','老访客']
		    },
		    series : [
	        {
	          // name: '访问来源',
	          type: 'pie',
	          radius : '55%',
	          center: ['40%', '50%'],
	          selectedOffset: 0,
	          data:[
	            {
	            	value:335, 
	            	name:'新访客',
	            	hoverAnimation: false,
	          	  itemStyle: {
					        normal: {
					           color: colors[0]
					        }
						    }
	             },
	            {
	            	value:310, 
	            	name:'老访客',
	            	hoverAnimation: false,
	            	itemStyle: {
	                normal: {
	                	color: colors[1]
	                }
	            	}
	             }
	          ],
		        labelLine: {
	            normal: {
	              show: false
	            }
		        },
		        label: {
		            normal: {
		                show: false
		            }
		        }
		      }
		    ]
			};
			visitorsChart.setOption(option);

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

	var chinaMapChart = echarts.init(document.getElementById('chinaMap-chart'));
		// 指定图表的配置项和数据
		var option = {
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
		  }]
		};
		chinaMapChart.setOption(option);
      	chinaMapChart.on('mouseover', function (params) {
      	var dataIndex = params.dataIndex;
      	console.log(params);
		});

    var timePulishChart = echarts.init(document.getElementById('time-pulish-chart'));
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
	        }
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
	    timePulishChart.setOption(option);

 	var flowOverViewChart = echarts.init(document.getElementById('flow-overview-chart'));
 		// 指定图表的配置项和数据
		var colors = ['#2062e6','#f3d024'];
	  var option = {
  	 legend: {
        left: 'left',
        data: ['今日访客数','昨日访客数']
    	},
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
		   	formatter: function (params) {  // 0--今日  1---对比日
        	return params[1].name+" - "+params[0].dataIndex+':59'+'<br/>\
				      	<i class="icon" style="width:10px;height:10px;background-color:'+params[0].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[0].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[0].value+'.00'+'<br/>\
				      	<i class="icon" style="width:10px;height:10px;background-color:#fff;border:1px solid '+params[1].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[1].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[1].value+'.00'
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
	      data: ["00:00","01:00","02:00","03:00","04:00","05:00","06:00", "07:00","08:00","09:00","10:00","11:00","12:00", "13:00","14:00","15:00","16:00","17:00","18:00", "19:00","20:00","21:00","22:00","23:00"],
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
	      }
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
	      	show: false,
	      	textStyle: {
	      		align: 'left',
	      		color: '#bbb',
	      	}
	      }
	    },
	    series: [
	      {
	        name: '今日访客数',
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
	        data:  [0, 2, 4, 5, 8, 0, 5, 0, 2, 4, 5, 8, 0, 5, 0, 2, 4, 5, 8, 0, 5, 0, 2, 4]
	    	},
	      {
	        name: '昨日访客数',
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
	        data:  [4, 0, 1, 8, 0, 0, 0, 4, 0, 1, 8, 0, 0, 0, 4, 0, 1, 8, 0, 0, 0, 4, 0, 1 ]
	      },
	    ]
	  };
	  // 使用刚指定的配置项和数据显示图表。
	  flowOverViewChart.setOption(option);

	var commonChart = echarts.init(document.getElementById('commonchart'));
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
	        commonChart.setOption(option);

	var trendChart = echarts.init(document.getElementById('trend-chart'));
	 	var colors = ['#2062e6','#f3d024', '#ff8533', '#4cb5ff'];
	        var option = {
	        	legend: {     // 图例
	            	x: 'left',
	           		data: [
		           		{
		           			name: '同行同层优秀访客数',
		           			icon: 'pin',
		           		},
		           		{
		           			name: '同行同层平均访客数',
		           			icon: 'pin'
		           		},
		           		{
		           			name: '当前访客数',
		           			icon: 'pin'
		           		},
		           		{
		           			name: '上周期访客数',
		           			icon: 'pin'
		           		}
	           		],
	            },
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
			      /*  formatter: function(params) {
			        	var str ='';
			        	var year = new Date().getFullYear();
			        	for(var i = 0; i<params.length;i++) {
			        		str += '<i class="icon" style="width:10px;height:10px;background-color:'+params[i].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[i].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[i].value+'.00</br>'
			        	}
			        	return year+'-'+params[1].name+'</br>'+str;
	        	
			        },*/
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
	                 data: ["2016-12","2017-01","2017-02","2017-03","2017-04","2017-05","2017-06", "2017-07","2017-08", "2017-09","2017-10", "2017-11"],
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
	            	axisLine: true,  //  控制 坐标轴显示或隐藏
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
	                	show: true,
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '同行同层优秀访客数',
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
		                data:  [5, 2, 4, 5, 8, 0, 5, 2, 4, 5, 8, 0]
		            },
		            {
		                name: '同行同层平均访客数',
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
		                data:  [8, 0, 0, 5, 4, 0, 7, 8, 0, 0, 5, 5]
		            },
		             {
		                name: '当前访客数',
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
		                data:  [8, 0, 0, 0, 4, 0, 1, 0, 0, 0, 4, 1]
		            },
		             {
		                name: '上周期访客数',
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
		                data:  [8, 0, 4, 0, 4, 0, 0, 0, 4, 0, 4, 2]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        trendChart.setOption(option);

	var sexContributeChart = echarts.init(document.getElementById('sex-contribute-chart'));
	  	var colors = ["#2062e6","#f3d024","#ff8533"];
	  	option = {
		    series: [
	        {
	          // name:'访问来源',	
	          type:'pie',
	          radius: ['50%', '65%'],
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
	          data:[
	            {value:10, 
	            	name:'女',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[0]
	            		}
	            	}
	            },
	            {
	            	value:5, 
	            	name:'男',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[1]
	            		}
	            	}
	            },
	            {
	            	value:3, 
	            	name:'未知',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[2]
	            		}
	            	}
	            }
		         ]
		       }
		    	]
				};
			sexContributeChart.setOption(option);
   
    var ageContributeChart = echarts.init(document.getElementById('age-contribute-chart'));
	  	var colors = ["#2062e6","#f3d024","#ff8533", "#4cb5ff", "#bc64e5", "#04c9a8", "#ff6590"];
	  	option = {
		    series: [
	        {
	          // name:'访问来源',	
	          type:'pie',
	          radius: ['50%', '65%'],
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
	          data:[
	            {value:4, 
	            	name:'18-25岁',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[0]
	            		}
	            	}
	            },
	            {
	            	value:4, 
	            	name:'26-30岁',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[1]
	            		}
	            	}
	            },
	            {
	            	value:2, 
	            	name:'31-35岁',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[2]
	            		}
	            	}
	            },
	            {
	            	value:2, 
	            	name:'36-40岁',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[3]
	            		}
	            	}
	            },
	            {
	            	value:2, 
	            	name:'41-50岁',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[4]
	            		}
	            	}
	            },
	            {
	            	value:2, 
	            	name:'50岁以上',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[5]
	            		}
	            	}
	            },
	             {
	            	value:2, 
	            	name:'未知',
	            	hoverAnimation: false,
	            	itemStyle: {
	            		normal: {
	            			borderWidth: 2,
	            			borderColor: '#fff',
	            			color: colors[6]
	            		}
	            	}
	            }
		         ]
		       }
		    	]
				};
		ageContributeChart.setOption(option);
   
    var cityContributeChart =  echarts.init(document.getElementById('city-contribute-chart'))
    	var colors = ['#2062e6'];
    	var option = {
            tooltip: {},
            legend: {
            	left: "left",
                data:['人数']
            },
            xAxis: {
                data: ["东莞市","广州市","漳州市","萍乡市","邢台市","三亚市", "上海市", "临夏回族自治州", "临汾市", "临沂市"]
            },
            yAxis: {},
            series: [
            	{	
            		itemStyle: {
	            		normal: {color: colors[0]}
	            	},
	                name: '人数',
	                 barWidth: 20,//柱图宽度
	                type: 'bar',
	                data: [5, 20, 36, 10, 10, 20, 6, 12, 36, 26]
	            }
	        ]
        };
		cityContributeChart.setOption(option);

	var buyContributeChart =  echarts.init(document.getElementById('buy-contribute-chart'))
		var colors = ['#2062e6'];
		option = {
		    tooltip: {
		        // trigger: 'axis',
		        axisPointer: {
		            type: 'line'
		        }
		    },
		   legend: {
            	left: "left",
                data:['人数']
            },
		    grid: {
		        left: '3%',
		        right: '4%',
		        bottom: '3%',
		        containLabel: true
		    },
		    xAxis: {
		        type: 'value'
		    },
		    yAxis: {
		        type: 'category',
		        data: ["1000以上","801-1000","601-800","501-600","401-500","400及以下"]
		    },
		    series: [
		        {
		        	itemStyle: {
	            		normal: {color: colors[0]}
	            	},
		            name: '人数',
		            type: 'bar',
		            barWidth: 20,
		            data: [5, 20, 36, 10, 10, 20]
		        }
		    ]
		};
		buyContributeChart.setOption(option);

	var compareChart = echarts.init(document.getElementById('compare-chart'));
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
	        }
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
	    compareChart.setOption(option);

    var circleChart = echarts.init(document.getElementById('circle-chart'));
	    	var data = [
			    [[28604,77,650,'搭配套餐',"营销偏好"],[31163,77.4,600,'聚划算',"营销偏好"],[24021,75.4,500,'宝贝优惠券',"营销偏好"],[43296,76.8,400,'包邮',"营销偏好"]]
			];

			option = {
			   /* backgroundColor: new echarts.graphic.RadialGradient(0.3, 0.3, 0.8, [{
			        offset: 0,
			        color: '#f7f8fa'
			    }, {
			        offset: 1,
			        color: '#cdd0d5'
			    }]),*/
			    xAxis: {
			    	show: false,
			        splitLine: {
			        	show: false,
			            lineStyle: {
			                type: 'dashed'
			            }
			        }
			    },
			    yAxis: {
			    	show: false,
			        splitLine: {
			        	show: false,
			            lineStyle: {
			                type: 'dashed'
			            }
			        },
			        scale: true
			    },
			    series: [{
			        name: '营销偏好',
			        data: data[0],
			        type: 'scatter',
			        symbolSize: function (data) {
			            return data[2] / 10;
			        },
			        label: {
			            /*emphasis: {
			               
			            }*/
			            normal: {
			            	 show: true,
			                formatter: function (param) {
			                    return param.data[3];
			                },
			                position: 'inside',
			            }
			        },
			        itemStyle: {
			            normal: {
			                color: '#dc780e',
			                show: true
			            }
			        }
			    }]
			};
			circleChart.setOption(option);
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

		 laydate.render({
            elem: '#test2',
            format: 'yyyy-MM-dd',
            min:'2017-10-22',
            max:'2018-02-24',
            value:'2017-12-03 - 2017-12-09',
            range:'-',
            week:1
        });


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

	
	// 框  -  点击添加关注
	$(".my-attention-wrap .add-attention").click(function() {
		$(".mask-dialog.add-attention-dialog").fadeIn(500);
	})
	$(".mask-dialog.add-attention-dialog .attention-dialog-header .oui-dialog-close").click(function() {
		$(".mask-dialog,add-attention-dialog").hide();
	})
	$(".mask-dialog.add-attention-dialog .SelectorElementSelectorTrigger__root").click(function() {
		var _this = $(this);
		if(_this.siblings(".ebase-advanceSelector-menu").hasClass("menu-open")) {
			_this.siblings(".ebase-advanceSelector-menu").hide().removeClass("menu-open");
		}else {
			_this.siblings(".ebase-advanceSelector-menu").show().addClass("menu-open");
		}
	})
	$(".mask-dialog.add-attention-dialog .legacy-oui-typeahead-item").click(function() {
		var _this = $(this);
		_this.addClass("active").siblings(".active").removeClass("active");
		_this.parents('.ebase-advanceSelector-menu').siblings(".SelectorElementSelectorTrigger__root").text(_this.children("span").text());
		_this.parents(".ebase-advanceSelector-menu").removeClass("menu-open").hide();
	})

	
	// 访客分析 start
		// 地图 切换
	$(".ui-switch-menu .ui-switch-item").click(function(){
		var _this = $(this)
		_this.addClass("active").siblings(".active").removeClass("active");
	})

	// 点击流量总览  内 的 每一项 li
	$(".flow-overview-list.list-child").eq(0).show();
	$(".ebase-card-content .list-parent .flow-overview-item").click(function(){
		var _this = $(this);
		_this.addClass("active").siblings(".active").removeClass("active");
		var index = _this.index();
		$('.flow-overview-list.list-child').hide();
		$(".flow-overview-list.list-child").eq(index).show();
	})
	$(".ebase-card-content .flow-overview-item.item-child").click(function(){
		$(this).addClass("active").siblings(".active").removeClass("active");
	})

	// 店铺来源------划过详情 商品效果 弹框
	$(".main-wrap  .ebase-card-content .col-4 .orderName").mouseenter(function(){
		var _this = $(this);
		_this.parents().parents().siblings(".popup-content-root").css({"top":"-126px","right":"-86px"});
		_this.parents().parents().siblings(".popup-content-root").show();
	}).mouseleave(function(){
		var _this = $(this);
		_this.parents().parents().siblings(".popup-content-root").hide();
	})
	$(".main-wrap .ebase-card-content .col-4 .orderName.goods-effect").mouseenter(function() {
		$(this).parents().parents().siblings(".popup-content-root").css({"top":"-108px","right":"-74px"});
	})
	$(".goods-resource-wrap .ItemSourceSummary-itemSelector").mouseenter(function(){
		var _this = $(this)
		_this.children(".popup-content-root").css({"top":"-129px","left":"48px"});
		_this.children(".popup-content-root").show();
	}).mouseleave(function(){
		var _this = $(this);
		_this.children(".popup-content-root").hide();
	})
	$(".goods-resource-wrap .ItemSourceSummary-recommendItems .itemSource-items").mouseenter(function(){
		var left = 276 + $(this).index() * 48 + "px";
		var _this = $(this);
		_this.siblings(".popup-content-root").css({"left":left,"top":"-104px"});
		_this.siblings(".popup-content-root").show();
	}).mouseleave(function(){
		var _this = $(this);
		_this.siblings(".popup-content-root").hide();
	})
	$(".main-wrap  .popup-content-root").mouseenter(function(){
		var _this = $(this);
		_this.show();
	}).mouseleave(function(){
		var _this = $(this);
		_this.hide();
	})

	// 店铺来源----- 判断有没有加减标
	$(".shop-resource-wrap .table .tr.parent-tr").each(function(){
		var _this = $(this);
		if( typeof(_this.next().attr("class")) === 'string' && _this.next().attr("class").indexOf("parent-tr") !==-1 || typeof(_this.next().attr("class")) === 'undefined'){
			_this.children(".td").children(".icon-wrap").css({"visibility":"hidden"});
		}
	})
	// 点击店铺来源里面的----同行下面的加号、减号
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
	// 店铺来源 -- 趋势 框
	$(".trend-dialog .ebase-IndexPicker__list .ebase-IndexPicker__item").on("click", ".oui-radio", function() {
		var _this = $(this);
		_this.addClass("oui-checked").parents(".ebase-IndexPicker__item").siblings(".ebase-IndexPicker__item").find(".oui-checked").removeClass("oui-checked");
	})
	$(".shop-resource-wrap .table tbody tr .col-4 a").click(function() {
		$(".trend-dialog").fadeIn(500);
	})
	$(".oui-dialog-locator .oui-dialog-close").click(function(){
		$(this).parents(".dialog-mask").hide();
	})

	// 商品来源 start
	$(".goods-resource-wrap .OrderPanelOrderPanel__orderName").mouseenter(function() {
		var _this = $(this);
		_this.siblings(".popup-content-root").show();
	}).mouseleave(function() {
		var _this = $(this);
		_this.siblings(".popup-content-root").hide();
	})
	// 商品来源 end


	//   暂时
	$(".device-choose-wrap li").click(function(){
		$(this).addClass("active").siblings(".active").removeClass("active");
	})
	$(".store-path-wrap .shop-accept").eq(0).show();
	$(".store-path-wrap .device-choose-wrap li").click(function() {
		var _this = $(this);
		_this.addClass("active").siblings(".active").removeClass("active");
		var index = _this.index();
		$(".shop-accept").eq(index).show().siblings(".shop-accept").hide();
	})

	
	// 点击 访客分布  访客对比
	$(".visitor-analysis .wrap-switch").eq(0).show();
	// 点击我的关注--流量来源 商品
	$(".my-attention-wrap .ebase-card-content").eq(0).show();
	// 点击页面配置--添加商品详情  添加自定义页面
	$(".action-add-web .content").eq(0).show();
	// 以下为 以上公用
	$(".main-wrap .switch-wrap-att span a").click(function(){
		var _this = $(this);
		_this.parents("span").addClass("curr").siblings(".curr").removeClass("curr");
		var index = _this.parents("span").index();
		_this.parents("span").parents(".switch-wrap-att").parents(".wrap-title").siblings("").hide();
		_this.parents("span").parents(".switch-wrap-att").parents(".wrap-title").siblings("").eq(index).show();
	})
	
	
	//2 点击店铺来源里面的---构成、对比、同行
	$(".shop-resource-wrap .wrap-switch").eq(0).show();
	$(".shop-resource-wrap .switch-wrap-att span a").click(function(){
		var _this = $(this);
		_this.parents("span").addClass("curr").siblings(".curr").removeClass("curr");
		var index = _this.parents("span").index();
		$(".shop-resource-wrap .wrap-switch").hide();
		$(".shop-resource-wrap .wrap-switch").eq(index).show();
	})

	// 店铺来源----对比
	$("body .shop-resource-wrap").on("click",".selectorShopSourceSelectorCombo-squareRoot",function(){
		var _thisOut = $(this);
		if(_thisOut.hasClass("base-add") && $(".ebase-advanceSelector-menu .menu-item").hasClass("active")) {
			$(".ebase-advanceSelector-menu .menu-item.active").removeClass("active");
		}
		_thisOut.addClass("clicked");
		if(_thisOut.children(".selectorShopSourceSelectorCombo-square").children("div").children("p.rigger-content").text() !== ''){
			var SelectedText = _thisOut.children(".selectorShopSourceSelectorCombo-square").children("div").children("p.rigger-content").text();
			$(".ebase-advanceSelector-menu .menu-item").each(function(i,item){
				var _this = $(this)
				if(_this.hasClass("active")) {
					_this.removeClass("active");
				}
				if(_this.children(".text").text() === SelectedText) {
					_this.addClass("active");
				}
			});
		}
		var index = _thisOut.index();
		$(".ebase-advanceSelector-menu").css({"left": index *186 +"px"});
		_thisOut.parents(".selectorShopSourceSelectorCombo-selectors").siblings(".ebase-advanceSelector-menu").toggleClass("menu-open");
	})
	
	var clickN = -1;

	$(".shop-resource-wrap .ebase-advanceSelector-menu .legacy-oui-typeahead-item").click(function(){
			$(".main-wrap .shop-resource-wrap .no-data-message").hide();
			$(".main-wrap .shop-resource-wrap .compare-chart").show();

			var  text = $(".selectorShopSourceSelectorCombo-squareRoot.clicked .rigger-content .rigger-text").text();
			if($(".selectorShopSourceSelectorCombo-squareRoot").hasClass("clicked") && $(".selectorShopSourceSelectorCombo-squareRoot.clicked .rigger-text").text() !== ''){
				$(".selectorShopSourceSelectorCombo-squareRoot.clicked .rigger-text").text($(this).children("span").text());
			}else{
				clickN ++;

				$(".selectorShopSourceSelectorCombo-squareRoot.rt.base-add").before(
				"<div class='selectorShopSourceSelectorCombo-squareRoot lf'>\
					<div class='selectorShopSourceSelectorCombo-square'>\
						<div>\
							<div class='rigger-label label-"+clickN+"'></div>\
							<p class='rigger-content'><span class='rigger-text'>"+$(this).children("span").text()+"</span></p>\
							<div class='rigger-close icon'>x</div>\
						</div>\
					</div>\
		        </div>"
				);
				$(".selectorShopSourceSelectorCombo-selectorCout").text(clickN+1 + "/5");

				if($(".selectorShopSourceSelectorCombo-selectorCout").text() === "5/5") {
					$(".selectorShopSourceSelectorCombo-squareRoot.rt.base-add").hide();
				}

			}
			$(".ebase-advanceSelector-menu").removeClass("menu-open");
			if($(".selectorShopSourceSelectorCombo-squareRoot").hasClass("clicked")){
				$(".selectorShopSourceSelectorCombo-squareRoot.clicked").removeClass("clicked");
			}
			// compareChart.setOption(option);

	})

	$(".shop-resource-wrap").on("click",".rigger-close",function(e){
		e.stopPropagation();
		if($(".shop-resource .ebase-advanceSelector-menu .legacy-oui-typeahead-item").hasClass("active")){
			$(".shop-resource .ebase-advanceSelector-menu .legacy-oui-typeahead-item.active").removeClass("active");
		}
		clickN --;
		$(this).parents("div").parents(".selectorShopSourceSelectorCombo-square").parents(".selectorShopSourceSelectorCombo-squareRoot").remove();
		$(".selectorShopSourceSelectorCombo-selectorCout").text(clickN+1 + "/5");
		if($(".selectorShopSourceSelectorCombo-selectorCout").text() !== "5/5") {
			$(".selectorShopSourceSelectorCombo-squareRoot.rt.base-add").show();
		}
		return false;
	})
	
	// 点击选词助手里面的---引流搜索词、行业相关搜索词
	$(".words-choose-wrap .wrap-switch").eq(0).show();
	$(".words-choose-wrap .switch-wrap-att span a").click(function(){
		var _this = $(this);
		_this.parents("span").addClass("curr").siblings(".curr").removeClass("curr");
		var index = _this.parents("span").index();
		$(".words-choose-wrap .wrap-switch").hide();
		$(".words-choose-wrap .wrap-switch").eq(index).show();
	})
	
	// 选词助手  收藏
	$(".words-choose-wrap .ebase-card-content .fav-btn.unfaved.btn-hollow").click(function() {
		var _this = $(this);
		_this.html("<a href='index.php?ctl=Seller_Sycm&met=collected' target='_blank'>已收藏</a>")
		if(_this.hasClass("unfaved")) {
			console.log(45135)
			_this.removeClass("unfaved").addClass("faved");
		} 
	})
	$(".words-choose-wrap .ebase-table-root tr td .fav-btn").mouseenter(function() {
		$(this).find(".collection-tip").show();
	}).mouseleave(function() {
		$(this).find(".collection-tip").hide();
	})

	

	// 页面配置-----装修分析 中 移入到引导详情 出现提示框 && click x  隐藏
	$(".convertion-icon-tips").mousemove(function(){
		$(this).siblings(".tips-guide-wrap.convertion-tips").show();
	})
	$(".convertion-tips .close-icon").click(function(){
		$(this).parents(".convertion-tips").hide();
	})

	$(".nav-blank .nav-blank-menu li").click(function() {
		$(this).addClass("active").siblings(".active").removeClass("active")
	})
	// 页面配置  -- 添加配置
	$(".web-config-wrap .operation-actions .made-btn").click(function() {
		$("body,html").animate({
			scrollTop: 880
		},600);
	})

	// 页面配置
		// 移入技巧图标 
	$(".icon-tips").mouseenter(function(){
		var _this = $(this);
		_this.siblings(".tips-guide-wrap").show();
	}).mouseleave(function(){
		var _this = $(this);
		_this.siblings(".tips-guide-wrap").hide();
	})

	// 点击页面配置--页面数据
	$(".page-setup-wrap .web-config-wrap .ed-custom-web .content .list .col.col-operation .action.small-button").click(function() {
		$(".web-data-dialog").fadeIn(500);
	})
	$(".dialog-locator .close").click(function(){
		$(this).parents(".dialog-mask").hide();
	})

	// 页面分析
	$(".page-analysis-wrap .web-analysis-wrap .ebase-card-content .oui-index-picker-group .checkbox").click(function() {
		var _this = $(this);
		var len = parseInt(_this.siblings(".checkbox.selected").length + _this.parents(".oui-index-picker-group").siblings(".oui-index-picker-group").find(".checkbox.selected").length);
		if( len >= 5) {
			alert("最多选5项");
		}else if(len===0) {
			alert("最少选1项");
		}else {
			for(var i=1; i<=5; i++) {
				_this.parents(".ebase-card-content").find(".table-container .table .col-"+i).remove();
			}
			if(_this.hasClass("selected")) {
				_this.parents(".oui-index-picker").find(".oui-index-picker-count").text("选择 "+len+"/5");
			}else {
				len ++;
				_this.parents(".oui-index-picker").find(".oui-index-picker-count").text("选择 "+len+"/5");
			}
			_this.toggleClass("selected");

			// 判断调哪个
			if(_this.parents(".ebase-card-content").parent("div").hasClass("index-web")) {
				eachName("index-web");
			}else {
				eachName("detail-web");
			}
		}
	})
	/*
	 <th class="th col-1 col-uv orderable sortableTh" style="text-align: right;">
		<span>访客数</span>
		<span class="order-flag desc">
			<i class="icon icon-order"></i>
		</span>
		<div class="ebase-col-crc">较前1日</div>
	</th>*/
	/*
		<td class="td col-1 col-uv" style="text-align: right;">
			<div class="ebase-td-root">
				<p class="ebase-td-selfValue">
					<span class="ebase-td-value">0</span>
				</p>
				<p class="ebase-td-changeRate r-trend up">
					<span class="ebase-td-value">0</span>
					<i class="icon icon-trend"></i>
				</p>
			</div>
		</td>
		*/
	eachName("index-web");
	eachName("detail-web");

	function eachName(web) {
		$(".page-analysis-wrap .web-analysis-wrap ."+web+" .oui-index-picker .checkbox.selected .name").each(function(i,item) {
			var _this = $(this);
			i +=1;
			var fragmentThead =  document.createDocumentFragment();
			$(fragmentThead).append('<th class="th orderable sortableTh col-'+i+'" style="text-align:right"><span>'+$(item).text()+'</span><span class="order-flag"><i class="icon icon-order"></i></span><div class="ebase-col-crc">较前1日</div></th>');
			
			var fragmentTbody = document.createDocumentFragment();
			$(fragmentTbody).append('<td class="td col-'+i+'" style="text-align:right"><div class="ebase-td-root"><p class="ebase-td-selfValue"><span class="ebase-td-value">0</span></p><p class="ebase-td-changeRate r-trend up"><span class="ebase-td-value">0</span><i class="icon icon-trend"></i></p></div></td>');
			_this.parents('.content-container').find(".ebase-table-root thead tr .col-6").before(fragmentThead);	
			_this.parents('.content-container').find(".ebase-table-root tbody tr .col-6").before(fragmentTbody);	
			_this.parents(".ebase-card-content").find(".table-container .thead .col-1 .order-flag").addClass("desc");
		})
	}


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

	//  天猫app or  淘宝app
	$(".wrap-app span").click(function(){
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
	})


	// 右侧 导航 start
	$(".ebase-FloorNav__root li").click(function() {
		var _this = $(this);
		var index = _this.index();
		if(index === 0) {
			$("body, html").animate({
				scrollTop: 0
			}, 300)
		} else if ( index === _this.parents("ul").children("li").length - 1) {
			$("body, html").animate({
				scrollTop: 0
			}, 300)
		} else {
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
		$(".flow-wrap .module").each(function(i, item) {
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


	// 下拉框 .....start
	// 点击下载  框 
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

</script>
</html>
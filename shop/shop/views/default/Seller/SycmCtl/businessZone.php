<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--业务专区-->
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
			<li class="nav-item lf curr">
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
					<p>业务专区</p>
				</div>
			</div>
			<ul class="menu-list-inner">
				<li class="menu-item-inner lf curr">
					<div class="selected-mask"></div>
					<a href="javascript:;" class="name-wrapper">
						<span class="name">内容分析</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- 内容分析 start -->
	<div class="w-1260  rt switch-wrap businessZon-container">
		<div class="wrap-title wrap-title-parent">
			<div class="switch-wrap-att orflow">
				<span class="curr lf">
					<a href="javascript:;">数据概况</a>
				</span>
				<span class="lf">
					<a href="javascript:;">单条分析</a>
				</span>
				<span class="lf">
					<a href="javascript:;">商品分析</a>
				</span>
				<span class="lf">
					<a href="javascript:;">渠道分析</a>
				</span>
				<span class="lf">
					<a href="javascript:;">合作达人</a>
				</span>
				<span class="lf">
					<a href="javascript:;">V任务效果</a>
				</span>
			</div>
		</div>
		
		<!-- 数据概况 start -->
		<div class="switch-wrap switch-wrap-parent">
			<div class="date-survy-container mt-10">
				<div class="screen-header h-50 mt-10">
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
				<div class="data-base-wrap mt-10 backff">
					<div class="wrap-title mt-10">
						<div class="title-lf lf">基础数据</div>
					</div>
					<div class="ebase-card-content">
						<div class="orflow">
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">本店相关内容数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend up">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">内容引导本店商品数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend">
											<i class="icon"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">内容浏览次数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend up">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">内容浏览人数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
						</div>
						<div id="basic-data-chart" class="basic-data-chart" style="width:1200px;height: 300px;"></div>
					</div>
				</div>
				<div class="guidance-wrap mt-10 backff">
					<div class="wrap-title">
						<div class="title-lf lf">引导情况</div>
					</div>
					<div class="ebase-card-content">
						<div class="orflow">
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">本店相关内容数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">内容引导本店商品数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend up">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">内容浏览次数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">内容浏览人数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
						</div>
						<div id="guidance-chart" class="guidance-chart" style="width:1200px;height: 300px;"></div>
					</div>
				</div>
				<div class="top-three-wrap mt-10 backff">
					<div class="wrap-title wrap-title-child">
						<div class="switch-wrap-att orflow">
							<span class="curr lf">
								<a href="javascript:;">商品Top排行榜</a>
							</span>
							<span class="lf">
								<a href="javascript:;">渠道Top排行榜</a>
							</span>
							<span class="lf">
								<a href="javascript:;">达人Top排行榜</a>
							</span>
						</div>
					</div>
					<div class="switch-wrap-chlid switch-wrap">
						<div class="ebase-card-content">
							<div class="ebase-table-root">
								<table class="table">
									<thead class="thead">
										<th class="th col-0 col-rank-id" style="width: 60px;text-align: center;">排名</th>
										<th class="th col-1 col-item" style="text-align: left;">商品名称</th>
										<th class="th col-2 col-feedUv SortableTh orderable" style="text-align: right;">
											<span>内容浏览人数</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-3 col-feedPv SortableTh orderable" style="text-align: right;">
											<span>内容浏览次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-4 col-guideItemUv SortableTh orderable" style="text-align: right;">
											<span>引导商品浏览人数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-5 col-guideItemPv SortableTh orderable" style="text-align: right;">
											<span>引导商品浏览次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-6 col-guideCartCnt SortableTh orderable" style="text-align: right;">
											<span>引导加购次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-7 col-guideCltCnt orderable" style="text-align: right;">
											<span>引导收藏次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
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
					<div class="switch-wrap-chlid switch-wrap">
						<div class="ebase-card-content">
							<div class="ebase-table-root">
								<table class="table">
									<thead class="thead">
										<th class="th col-0 col-rank-id" style="width: 60px;text-align: center;">排名</th>
										<th class="th col-1 col-item" style="text-align: left;">渠道名称</th>
										<th class="th col-2 col-feedUv SortableTh orderable" style="text-align: right;">
											<span>内容浏览人数</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-3 col-feedPv SortableTh orderable" style="text-align: right;">
											<span>内容浏览次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-4 col-snsMbrCnt SortableTh orderable" style="text-align: right;">
											<span>内容互动人数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-5 col-snsItctCnt SortableTh orderable" style="text-align: right;">
											<span>内容互动次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-6 col-guideShopUv SortableTh orderable" style="text-align: right;">
											<span>引导进店人数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-7 col-guideShopPv orderable" style="text-align: right;">
											<span>引导进店次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
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
					<div class="switch-wrap-chlid switch-wrap">
						<div class="ebase-card-content">
							<div class="ebase-table-root">
								<table class="table">
									<thead class="thead">
										<th class="th col-0 col-rank-id" style="width: 60px;text-align: center;">排名</th>
										<th class="th col-1 col-item" style="width: 60px;text-align: left;">达人名称</th>
										<th class="th col-2 col-feedUv SortableTh orderable" style="text-align: right;">
											<span>内容浏览人数</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-3 col-feedPv SortableTh orderable" style="text-align: right;">
											<span>内容浏览次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-4 col-darenIndex" style="text-align: right;">达人指数</th>
										<th class="th col-5 col-healthScore" style="text-align: right;">健康分</th>
										<th class="th col-6 col-qualityScore" style="text-align: right;">质量分</th>
										<th class="th col-7 col-operator" style="text-align: right;">查看详情</th>
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
			</div>
		</div>
		<!-- 数据概况 end -->

		<!-- 单条分析 start -->
		<div class="switch-wrap switch-wrap-parent">
			<div class="singleData-analysis-container">
				<div class="wrap-title mt-10" style="border-bottom: none;">
					<div class="rt" style="font-size: 12px;">更新时间：0218-02-02</div>
				</div>
				<div class="backff">
					<div class="ebase-card-content">
						<div class="ebase-table-root">
							<table class="table">
								<thead class="thead">
									<tr>
										<th></th>
										<th></th>
										<th colspan="2" class="columnGroup" style="border-top-color:rgb(42,146,247);color:rgb(42,146,247);">内容基础数据
											<div class="columArrow">
												<div class="columnArrowBo"></div>
											</div>
										</th>
										<th colspan="2" class="columnGroup" style="border-top-color:rgb(89,187,157);color:rgb(89,187,157);">内容阅读情况
											<div class="columArrow">
												<div class="columnArrowBo"></div>
											</div>
										</th>
										<th colspan="3" class="columnGroup" style="border-top-color:rgb(244,170,65);color:rgb(244,170,65);">内容引导情况</th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
									<tr>
										<th class="th col-0 col-rank-id" style="width:60px;text-align: left;">序号</th>
										<th char="th col-1 col-item group-end" style="text-align: left;">文章名</th>
										<th class="th col-2 col-item group-end group-start" style="text-align: left;">
											<div style="padding-left: 10px;">文章发布时间</div>
										</th>
										<th class="th col-3 col-item group-end" style="text-align: left;">
											<div style="padding-left: 10px;">二维码</div>
										</th>
										<th class="th col-4 col-sumReadCnt SortableTh group-start orderable">
											<span>累计阅读次数</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-5 col-sumReadCnt SortableTh group-end orderable">
											<span>累计互动次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-6 col-sumReadCnt SortableTh group-start orderable">
											<span>累计进店次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-7 col-sumReadCnt SortableTh orderable">
											<span>全引导收藏次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-8 col-sumReadCnt SortableTh group-end orderable">
											<span>全引导加购次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-9 col-item" style="text-align: right;">
											<div style="padding-left: 10px">查看详情</div>
										</th>
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
										<span>数据为空</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 单条分析 end -->

		<!-- 商品分析 start -->
		<div class="switch-wrap switch-wrap-parent ">
			<div class="commercial-analysis-container">
				<div class="screen-header h-50 mt-10">
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
				<div class="backff mt-10">
					<div class="ebase-card-content">
						<div class="ebase-table-root">
							<table class="table">
								<thead class="thead">
									<tr>
										<th class="th col-0 col-rank-id" style="width: 60px;text-align: center;">排名</th>
										<th class="th col-1 col-item" style="text-align: left;">商品名称</th>
										<th class="th col-2 col-feeUv SortableTh orderable" style="text-align: right;">
											<span>内容浏览人数</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-3 col-feePv SortableTh orderable" style="text-align: right;">
											<span>内容浏览次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-4 col-guideCartCnt SortableTh orderable" style="text-align: right;">
											<span>引导加购次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-5 col-guideCltCnt SortableTh orderable" style="text-align: right;">
											<span>引导收藏次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-6 col-guideShopUv SortableTh orderable" style="text-align: right;">
											<span>引导进店人数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-7 col-guideShopPv SortableTh orderable" style="text-align: right;">
											<span>引导进店次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-8 col-operator" style="text-align: right;">查看详情</th>
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
										<span>数据为空</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 商品分析 end -->

		<!-- 渠道分析 start -->
		<div class="switch-wrap switch-wrap-parent">
			<div class="channel-analysis-container">
				<div class="screen-header h-50 mt-10">
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
				<div class="container-wrap mt-10 backff">
					<div class="container-panel backff mt-10">
						<div class="outer-container orflow">
							<div class="title lf">导购型渠道</div>
							<div class="item-container lf">
								<div class="item active">遇见好货</div>
								<div class="item">家有儿女</div>
								<div class="item">每日必BUY</div>
								<div class="item">9块9</div>
								<div class="item">生鲜特产</div>
								<div class="item">劲爆折扣</div>
								<div class="item">发现好店</div>
							</div>
						</div>
						<div class="outer-container orflow">
							<div class="title lf">促销渠道	</div>
							<div class="item-container lf">
								<div class="item active">惠抢购</div>
								<div class="item">加价购</div>
								<div class="item">限时抢购</div>
								<div class="item">手机专享</div>
								<div class="item">满即送</div>
								<div class="item">代金券管理</div>
								<div class="item">优惠套装</div>
								<div class="item">新人优惠</div>
							</div>
						</div>
					</div>
				</div>
				<div class="basic-data-wrap mt-10 backff">
					<div class="wrap-title mt-10">
						<div class="title-lf lf">基础数据</div>
					</div>
					<div class="ebase-card-content">
						<div class="orflow">
							<div class="indexCell-root lf" style="width: 33.333333%;">
								<div class="index-name">本店相关内容数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 33.333333%;">
								<div class="index-name">内容引导本店商品数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 33.333333%;">
								<div class="index-name">内容浏览次数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 33.333333%;">
								<div class="index-name">内容浏览人数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 33.333333%;">
								<div class="index-name">内容互动人数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 33.333333%;">
								<div class="index-name">内容互动次数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend">
											<i class="icon"></i>
										</span>
									</span>
								</div>	
							</div>
						</div>
						<div id="basic-data2-chart" class="basic-data-chart" style="width:1200px;height: 300px;"></div>
					</div>
				</div>
				<div class="guidance-wrap mt-10 backff">
					<div class="wrap-title">
						<div class="title-lf lf">引导情况</div>
					</div>
					<div class="ebase-card-content">
						<div class="orflow">
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">引导进店次数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend up">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">引导进店人数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend up">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">引导收藏次数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 25%;">
								<div class="index-name">引导加购次数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
						</div>
						<div id="guidance2-chart" class="guidance-chart" style="width:1200px;height: 300px;"></div>
					</div>
				</div>
				<div class="singleData-analysis-wrap backff">
					<div class="wrap-title mt-10">
						<div class="title-lf lf">内容列表</div>
						<div class="rt">更新时间：0218-02-02</div>
					</div>
					<div>
						<div class="ebase-card-content">
							<div class="ebase-table-root">
								<table class="table">
									<thead class="thead">
										<tr>
											<th></th>
											<th></th>
											<th colspan="2" class="columnGroup" style="border-top-color:rgb(42,146,247);color:rgb(42,146,247);">内容基础数据
												<div class="columArrow">
													<div class="columnArrowBo"></div>
												</div>
											</th>
											<th colspan="2" class="columnGroup" style="border-top-color:rgb(89,187,157);color:rgb(89,187,157);">内容阅读情况
												<div class="columArrow">
													<div class="columnArrowBo"></div>
												</div>
											</th>
											<th colspan="3" class="columnGroup" style="border-top-color:rgb(244,170,65);color:rgb(244,170,65);">内容引导情况</th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
										<tr>
											<th class="th col-0 col-rank-id" style="width:60px;text-align: left;">序号</th>
											<th char="th col-1 col-item group-end" style="text-align: left;">文章名</th>
											<th class="th col-2 col-item group-end group-start" style="text-align: left;">
												<div style="padding-left: 10px;">文章发布时间</div>
											</th>
											<th class="th col-3 col-item group-end" style="text-align: left;">
												<div style="padding-left: 10px;">二维码</div>
											</th>
											<th class="th col-4 col-sumReadCnt SortableTh group-start orderable">
												<span>累计阅读次数</span>
												<span class="order-flag desc">
													<i class="icon icon-order"></i>
												</span>
											</th>
											<th class="th col-5 col-sumReadCnt SortableTh group-end orderable">
												<span>累计互动次数</span>
												<span class="order-flag">
													<i class="icon icon-order"></i>
												</span>
											</th>
											<th class="th col-6 col-sumReadCnt SortableTh group-start orderable">
												<span>累计进店次数</span>
												<span class="order-flag">
													<i class="icon icon-order"></i>
												</span>
											</th>
											<th class="th col-7 col-sumReadCnt SortableTh orderable">
												<span>全引导收藏次数</span>
												<span class="order-flag">
													<i class="icon icon-order"></i>
												</span>
											</th>
											<th class="th col-8 col-sumReadCnt SortableTh group-end orderable">
												<span>全引导加购次数</span>
												<span class="order-flag">
													<i class="icon icon-order"></i>
												</span>
											</th>
											<th class="th col-9 col-item" style="text-align: right;">
												<div style="padding-left: 10px">查看详情</div>
											</th>
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
											<span>数据为空</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 渠道分析 end -->

		<!-- 合作达人 start -->
		<div class="switch-wrap switch-wrap-parent">
			<div class="cooperative-talent-container">
				<div class="screen-header h-50 mt-10">
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
				<div class="backff mt-10">
					<div class="ebase-card-content">
						<div class="ebase-table-root">
							<table class="table">
								<thead class="thead">
									<tr>
										<th class="th col-0 col-rank-id" style="width: 60px;text-align: center;">排名</th>
										<th class="th col-1 col-item" style="text-align: left;">达人名称</th>
										<th class="th col-2 col-feeUv SortableTh orderable" style="text-align: right;">
											<span>内容浏览人数</span>
											<span class="order-flag desc">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-3 col-feePv SortableTh orderable" style="text-align: right;">
											<span>内容浏览次数</span>
											<span class="order-flag">
												<i class="icon icon-order"></i>
											</span>
										</th>
										<th class="th col-4 col-item" style="text-align: right;">达人指数</th>
										<th class="th col-5 col-item" style="text-align: right;">健康分</th>
										<th class="th col-6 col-item" style="text-align: right;">质量分</th>
										<th class="th col-7 col-operator" style="text-align: right;">查看详情</th>
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
										<span>数据为空</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 合作达人 end -->

		<!-- V任务效果 start -->
		<div class="switch-wrap switch-wrap-parent">
			<div class="V-taskEffect-container">
				<div class="screen-header h-50 mt-10">
					<div class="update-option">
						<a href="javascript: void(0);" class="ebase-DayPicker__btn lf"><i class="oui-icon oui-icon-angle-left">&lt;</i> 前一天</a>
						<span class="ebase-DayPicker__calendar lf"><div class="legacy-oui-calendar-trigger oui-popup-trigger"><i class="oui-icon oui-icon-calendar"></i><input type="text" value="2017-11-15" readonly=""></div></span>
						<a href="javascript: void(0);" class="ebase-DayPicker__btn lf" disabled="">后一天<i class="oui-icon oui-icon-angle-right">&gt;</i></a>
					</div>
				</div>
				<div class="V-task-whole-wrap mt-10 backff">
					<div class="wrap-title">
						<div class="title-lf lf">基础数据</div>
					</div>
					<div class="ebase-card-content">
						<div class="orflow">
							<div class="indexCell-root lf" style="width: 33.333333%;">
								<div class="index-name">内容浏览人数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 33.333333%;">
								<div class="index-name">内容浏览次数</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
							<div class="indexCell-root lf" style="width: 33.333333%;">
								<div class="index-name">V任务支出金额</div>
								<div class="index-value">0</div>
								<div class="index-change orflow">
									<span class="lf">较上周同期</span>
									<span class="rt">
										<span class="num">-</span>
										<span class="r-trend down">
											<i class="icon icon-trend"></i>
										</span>
									</span>
								</div>	
							</div>
						</div>
					</div>
				</div>
				<div class="data-trend-wrap mt-10 backff">
					<div class="ebase-card-content">
						<div class="onenessCard">
							<div class="oui-index-picker">
								<div class="oui-index-picker-group">
									<div class="oui-index-picker-label"></div>
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
								<div class="oui-index-picker-action">
									<span class="oui-index-picker-count">选择 4/4</span>
									<a href="javascript:;" class="oui-index-picker-reset">重置</a>
								</div>
							</div>
							<div class="data-trend-chart mt-22" id="data-trend-chart" style="width: 1200px;height: 300px;"></div>
						</div>
					</div>
				</div>
				<div class="V-task-list mt-10 backff">
					<div class="wrap-title mt-10">
						<div class="title-lf lf">V任务列表</div>
					</div>
					<div class="ebase-card-content">
						<div class="ebase-table-root">
							<table class="table">
								<thead class="thead">
									<th class="th col-0 col-missionId" style="text-align: left;">任务ID</th>
									<th class="th col-1 col-subMissionTitle" style="text-align: right;">
										<p>任务标题</p>
									</th>
									<th class="th col-2 col-feedAcccountName" style="text-align: right;">
										<p>服务方</p>
									</th>
									<th class="th col-3 col-missionAmt" style="text-align: right;">
										<p>任务金额</p>
									</th>
									<th class="th col-4 col-payTime" style="text-align: right;">
										<p>拍下时间</p>
									</th>
									<th class="th col-5 col-deliverTime" style="text-align: right;">
										<p>交付时间</p>
									</th>
									<th class="th col-6 col-operate" style="text-align: right;">操作</th>
								</thead>
								<tbody></tbody>
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
		</div>
		<!-- V任务效果 end -->
	</div>
	<!-- 内容分析 end -->
</div>
	<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
	<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
	<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
	<script type="text/javascript">
		var basicDataChart = echarts.init(document.getElementById('basic-data-chart'));
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
		        basicDataChart.setOption(option);

		var guidanceChart = echarts.init(document.getElementById('guidance-chart'));
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
		        guidanceChart.setOption(option);

		var basicData2Chart = echarts.init(document.getElementById('basic-data2-chart'));
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
		        basicData2Chart.setOption(option);

		var guidance2Chart = echarts.init(document.getElementById('guidance2-chart'));
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
		        guidance2Chart.setOption(option);
		

		var dataTrendChart = echarts.init(document.getElementById('data-trend-chart'));
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
	        dataTrendChart.setOption(option);
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

		$(".switch-wrap").eq(0).show();
		
		// 点击 内容分析---选项卡
		$(".businessZon-container .switch-wrap-parent").eq(0).show();
		$(".businessZon-container .top-three-wrap .switch-wrap-chlid").eq(0).show();
		$(".businessZon-container .wrap-title-parent .switch-wrap-att span").click(function(){
			var _this = $(this);
			var index = _this.index();
			_this.addClass("curr").siblings(".curr").removeClass("curr");
			$(".businessZon-container .switch-wrap-parent").eq(index).show().siblings(".switch-wrap").hide();
		})
		$(".businessZon-container .wrap-title-child .switch-wrap-att span").click(function(){
			var _this = $(this);
			var index = _this.index();
			_this.addClass("curr").siblings(".curr").removeClass("curr");
			$(".businessZon-container .switch-wrap-chlid").eq(index).show().siblings(".switch-wrap").hide();
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

		// 内容分析---渠道分析 
		$(".channel-analysis-container .container-wrap .item").click(function(){
			$(this).addClass("active").siblings(".active").removeClass("active");
		})

		// v任务效果
		  // 日期
			laydate.render({
			  elem: '.V-taskEffect-container .screen-header input',
			  showBottom: false
			});
	</script>
</html>

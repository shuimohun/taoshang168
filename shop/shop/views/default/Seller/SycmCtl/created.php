<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--运营计划 / 计划监控 新建完成页面-->
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
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
					<p>实时直播</p>
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
	<!-- 运营计划 start -->
	<div class="w-1260 rt switch-wrap flow-container">
		<div class="operational-planning-wrap">
			<div class="screen-header h-50">
				<!-- <div class="lf">运营计划</div> -->
				<span class="pagesPlanMonitor__endTime">截止时间：2017-12-27</span>
				<span>主题</span>
				<p class="fast-open rt"><a href="index.php?ctl=Seller_Sycm&met=newPlanning">快速创建<i>+</i></a></p>
			</div>
			<div class="pagesPlanMonitor__content">
				<div class="oui-card">
					<div class="oui-card-header-wrapper">
						<h4 class="oui-card-title">计划进度监控</h4>
						<div class="oui-card-header">
							<span class="rt oui-card-switch switch-detailswitch">
								<span>
									<span class="oui-card-switch-switch-name oui-card-switch-active">精简</span>
									<span class="oui-card-switch-separator">|</span>
								</span>
								<span>
									<span class="oui-card-switch-switch-name">详细</span>
								</span>
							</span>
							<span></span>
						</div>
					</div>
					<div class="oui-card-content">
						<div class="ebase-IndexPicker__root index-picker">
							<div class="ebase-IndexPicker__group">
								<div class="ebase-IndexPicker__content">
									<div class="ebase-IndexPicker__blank"></div>
									<ul class="ebase-IndexPicker__list" style="height: 52px;">
										<li class="ebase-IndexPicker__item">
											<span value="all_none_none_uv" class="oui-checkbox oui-checked">
												<span class="option checked"></i></span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">所有终端-访客数</span>
												</span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_22_22.1_payRate" class="oui-checkbox oui-unchecked">
												<span class="option"></i></span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">无线端-淘宝客-支付转化率</span>
												</span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_22_22.2_payAmt" class="oui-checkbox oui-unchecked">
												<span class="option"></i></span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">无线端-直通车-支付金额</span>
												</span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_none_none_avgStayTime" class="oui-checkbox oui-unchecked">
												<span class="option"></i></span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">无线端-平均停留时长</span>
												</span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_23_23.s1150_uv" class="oui-checkbox oui-unchecked">
												<span class="option"></i></span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">无线端-手淘搜索-访客数</span>
												</span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_22_22.1_payAmt" class="oui-checkbox oui-unchecked">
												<span class="option"></i></span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">无线端-淘宝客-支付金额</span>
												</span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item">
											<span value="all_none_none_payPct" class="oui-checkbox oui-unchecked">
												<span class="option"></i></span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">所有终端-客单价</span>
												</span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_22_22.2_payRate" class="oui-checkbox oui-unchecked">
												<span class="option"></i></span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">无线端-直通车-支付转化率</span>
												</span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_22_22.1_uv" class="oui-checkbox oui-unchecked">
												<span class="option"></i></span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">无线端-淘宝客-访客数</span>
												</span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item">
											<span value="all_none_none_uvValue" class="oui-checkbox oui-unchecked">
												<span class="option"></i></span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">所有终端-UV价值</span>
												</span>
											</span>
										</li>
									</ul>
									<div class="ebase-IndexPicker__fold">
										<span>展开 <i class="caret icon"></i></span>
									</div>
								</div>
							</div>
							<div class="ebase-IndexPicker__action">
								<span class="ebase-IndexPicker__count">已选 1/4</span>
								<a href="javascript:void(0)">重置</a>
							</div>
						</div>
						<div class="PlanMonitorBoardBar__root">
							<div class="PlanMonitorBoardBar__indexName">所有终端-访客数</div>
							<div class="PlanMonitorBoardBar__content">
								<div class="PlanMonitorBoardBar__month">
									<div class="PlanMonitorBoardBar__bar">
										<div class="PlanMonitorBoardBar__backgroundBar" style="background: rgb(0, 136, 254); z-index: 2; border-radius: 0px 6px 6px 0px;"></div>
										<div class="PlanMonitorBoardBar__progressBar" style="width: 105%; background: rgb(255, 187, 40); z-index: 1;">
											<div class="PlanMonitorBoardBar__tips">
												<div class="PlanMonitorBoardBar__tipsContent">-</div>
												<div class="PlanMonitorBoardBar__tipsArrow"></div>
											</div>
										</div>
										<span class="PlanMonitorBoardBar__startDate" style="color: rgb(255, 255, 255);">2017-12-01</span>
										<span class="PlanMonitorBoardBar__endDate" style="color: rgb(255, 255, 255);">2017-12-31</span>
									</div>
									<div class="PlanMonitorBoardBar__valueCell PlanMonitorBoardBar__realValue">
										<span class="PlanMonitorBoardBar__name">本月指标值</span>
										<span class="PlanMonitorBoardBar__value">8</span>
									</div>
									<div class="PlanMonitorBoardBar__valueCell PlanMonitorBoardBar__planValue">
										<span class="PlanMonitorBoardBar__name">本月目标值</span>
										<span class="PlanMonitorBoardBar__value">0</span>
									</div>
									<span class="PlanMonitorBoardBar__timeProgress">
										<span class="PlanMonitorBoardBar__name">时间进度</span>
										<span class="PlanMonitorBoardBar__value">27/31</span>
									</span>
								</div>
								<div class="PlanMonitorBoardBar__year">
									<div class="PlanMonitorBoardBar__bar">
										<div class="PlanMonitorBoardBar__backgroundBar" style="background: rgb(240, 240, 240); z-index: 1; border-radius: 0px;"></div>
										<div class="PlanMonitorBoardBar__progressBar" style="width: 93.0553%; background: rgb(0, 136, 254); z-index: 2;">
											<div class="PlanMonitorBoardBar__tips">
												<div class="PlanMonitorBoardBar__tipsContent">93.05%</div>
												<div class="PlanMonitorBoardBar__tipsArrow"></div>
											</div>
										</div>
										<span class="PlanMonitorBoardBar__startDate" style="color: rgb(255, 255, 255);">2017-01-01</span>
										<span class="PlanMonitorBoardBar__endDate" style="color: rgb(51, 51, 51);">2017-12-31</span>
									</div>
									<div class="PlanMonitorBoardBar__valueCell PlanMonitorBoardBar__realValue">
										<span class="PlanMonitorBoardBar__name">年度指标值</span>
										<span class="PlanMonitorBoardBar__value">4,462</span>
									</div>
									<div class="PlanMonitorBoardBar__valueCell PlanMonitorBoardBar__planValue">
										<span class="PlanMonitorBoardBar__name">年度目标值</span>
										<span class="PlanMonitorBoardBar__value">4,795</span>
									</div>
									<span class="PlanMonitorBoardBar__timeProgress">
										<span class="PlanMonitorBoardBar__name">时间进度</span>
										<span class="PlanMonitorBoardBar__value">361/365</span>
									</span>
								</div>
							</div>
						</div>
						<div class="PlanMonitorBoardBar__root" style="display: none;">
							<div class="ebase-Table__root">
								<table class="ebase-Table__table">
									<thead class="ebase-Table__thead">
										<tr>
											<th class="ebase-Table__th col-0 col-month  undefined" style="text-align: left;">时间</th>
											<th class="ebase-Table__th col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">所有终端-访客数</th>
											<th class="ebase-Table__th col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">计划值</th>
											<th class="ebase-Table__th col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">完成度</th>
										</tr>
									</thead>
									<tbody>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">1月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">-</td>
										</tr>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">2月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">-</td>
										</tr>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">3月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">-</td>
										</tr>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">4月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">-</td>
										</tr>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">5月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">-</td>
										</tr>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">6月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">215</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">215</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">100.00%</td>
										</tr>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">7月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">630</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">630</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">100.00%</td>
										</tr>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">8月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" data-spm-anchor-id="a21ag.8198214.0.i7.4e2767caeWrX44" style="text-align: right;">2,017</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">2,017</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">100.00%</td>
										</tr>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">9月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">1,600</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">1,600</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">100.00%</td>
										</tr>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">10月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">44</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">0.00%</td>
										</tr>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">11月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">289</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">0.00%</td>
										</tr>
										<tr class="ebase-Table__tbodyTr">
											<td class="ebase-Table__td col-0 col-month  undefined" style="text-align: left;">12月</td>
											<td class="ebase-Table__td col-1 col-all_none_none_uv$$value  undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-2 col-all_none_none_uv$$planValue PlanMonitorBoard__planValue undefined" style="text-align: right;">0</td>
											<td class="ebase-Table__td col-3 col-all_none_none_uv$$progress PlanMonitorBoard__progress undefined" style="text-align: right;">-</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="oui-card">
					<div class="oui-card-header-wrapper">
						<h4 class="oui-card-title">流量趋势</h4>
						<div class="oui-card-header">
							<div value="month" class="oui-select plan-monitor-trend-select rt">
								<div class="select-control ui-selector rt">
									<a href="javascript:;">
										<span class="ui-selector-value">当月</span>
										<span class="caret icon"></span>
									</a>
									<ul class="ui-selector-list select-control-list" style="display: none;">
										<li class="ui-selector-item curr">
											<span>当月</span>
										</li>
										<li class="ui-selector-item">
											<span>当年</span>
										</li>
									</ul>
								</div>
							</div>
							<div value="hour" class="oui-select plan-monitor-trend-select rt">
								<div class="select-control ui-selector rt">
									<a href="javascript:;">
										<span class="ui-selector-value">分时段趋势</span>
										<span class="caret icon"></span>
									</a>
									<ul class="ui-selector-list select-control-list" style="display: none;">
										<li class="ui-selector-item curr">
											<span>分时段趋势</span>
										</li>
										<li class="ui-selector-item">
											<span>累计趋势</span>
										</li>
									</ul>
								</div>
							</div>
							<span></span>
						</div>
					</div>
					<div class="oui-card-content">
						<div class="ebase-IndexPicker__root index-picker">
							<div class="ebase-IndexPicker__group">
								<div class="ebase-IndexPicker__content">
									<div class="ebase-IndexPicker__blank"></div>
									<ul class="ebase-IndexPicker__list" style="height: 52px;">
										<li class="ebase-IndexPicker__item">
											<span class="oui-radio oui-checked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i><i class="oui-icon oui-icon-radio-dot"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">所有终端-访客数</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_22_22.1_payRate" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-淘宝客-支付转化率</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_22_22.2_payAmt" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-直通车-支付金额</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_none_none_avgStayTime" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-平均停留时长</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_23_23.s1150_uv" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-手淘搜索-访客数</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_22_22.1_payAmt" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-淘宝客-支付金额</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item">
											<span value="all_none_none_payPct" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">所有终端-客单价</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_22_22.2_payRate" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-直通车-支付转化率</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_22_22.1_uv" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-淘宝客-访客数</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item">
											<span value="all_none_none_uvValue" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">所有终端-UV价值</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item">
											<span value="wireless_none_none_payPct" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-客单价</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="all_none_none_payRate" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">所有终端-支付转化率</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item">
											<span value="wireless_none_none_payRate" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-支付转化率</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="all_none_none_avgStayTime" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">所有终端-平均停留时长</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_23_23.s1150_payAmt" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-手淘搜索-支付金额</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_23_23.s1150_payRate" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-手淘搜索-支付转化率</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="wireless_22_22.2_uv" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-直通车-访客数</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item">
											<span value="wireless_none_none_uv" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-访客数</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item">
											<span value="wireless_none_none_uvValue" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">无线端-UV价值</span></span>
											</span>
										</li>
									</ul>
									<div class="ebase-IndexPicker__fold">
										<span>展开<i class="caret icon"></i></span>
									</div>
								</div>
								<div class="ebase-IndexPicker__action"></div>
							</div>
							<div class="ebase-IndexPicker__action"></div>
						</div>
						<div class="event-picker ebase-IndexPicker__root index-picker">
							<div class="ebase-IndexPicker__group">
								<div class="ebase-IndexPicker__label">事件</div>
								<div class="ebase-IndexPicker__content">
									<div class="ebase-IndexPicker__blank"></div>
									<ul class="ebase-IndexPicker__list">
										<li class="ebase-IndexPicker__item">
											<span value="all" class="oui-radio oui-checked">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-border"></i><i class="oui-icon oui-icon-radio-dot"></i></span>
												<span class="oui-form-name"><span class="ebase-IndexPicker__text">所有事件</span></span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item">
											<span value="holiday" class="oui-radio oui-unchecked">
												<span class="oui-icon-stacked">
													<i class="oui-icon oui-icon-radio-border"></i>
												</span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">节日</span>
												</span>
											</span>
										</li>
										<li class="ebase-IndexPicker__item ebase-IndexPicker__longItem">
											<span value="custom" class="oui-radio oui-disabled">
												<span class="oui-icon-stacked"><i class="oui-icon oui-icon-radio-shadow"></i><i class="oui-icon oui-icon-radio-border"></i></span>
												<span class="oui-form-name">
													<span class="ebase-IndexPicker__text">我的事件</span>
													<span class="ebase-IndexPicker__comment">（在选定周期内您尚未设定事件、点击进入<a target="_blank" href="javascript:;">事件中心</a>设定）</span>
												</span>
											</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="ebase-IndexPicker__action"></div>
						</div>
						<div id='flow-trend-chart' style="width:1200px;height: 300px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 运营计划 end -->
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>

<script type="text/javascript">
	var flowTrendChart = echarts.init(document.getElementById('flow-trend-chart'));
		// 指定图表的配置项和数据
		var colors = ['#2062e6','#f3d024', '#8c81d8', '#f6f6fc'];
	  	var option = {
	  	 legend: {
	        left: 'left',
	        data: ['上月所有终端-访客数','本月所有终端-访客数']
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
		      data: ["12-01","12-02","12-03","12-04","12-05","12-06","12-07", "12-08","12-09","12-10","12-11","12-12","12-13", "12-14","12-15","12-16","12-17","12-18","12-19", "12-20","12-21","12-22","12-23","12-24","12-25","12-26","12-27","12-28","12-29","12-30","12-31"],
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
		       interval: 1  // x轴每隔5个显示一次文本
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
		        name: '上月所有终端-访客数',
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
		        data:  [0, 2, 4, 5, 8, 0, 5, 0, 2, 4, 5, 8, 0, 5, 0, 2, 4, 5, 8, 0, 5, 0, 2, 4, 6, 10, 3, 0, 0, 0, 0]
		    	},
		      {
		        name: '本月所有终端-访客数',
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
		        data:  [4, 0, 1, 8, 0, 0, 0, 4, 0, 1, 8, 0, 0, 0, 4, 0, 1, 8, 0, 0, 0, 4, 0, 1, 6, 0, 0, 4, 12, 4, 1]
		      },
		      {
		        name: '',
		        type: 'bar',
		        itemStyle: {
		            normal: {
		                color: colors[3]
		            }
		        },
		        barWidth: 120,
		      /*{
		        name: '',
		        type: 'line',
		       	symbol: 'rect',
		        symbolSize: [26, 3],
		        symbolOffset: [0, '50%'],
		        legendHoverLink: false,
		        connectNulls: true,
		        hoverAnimation: false,
		        itemStyle: {
		        	normal: {
		        		color: colors[2],
		        		lineStyle: {
		        			width: 10,
		        			color: colors[2]
		        		}
		        	}
		        },
		        areaStyle: {
                 	normal: {
	                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
	                        offset: 0,
	                        color: colors[3]
	                    }, {
	                        offset: 1,
	                        color: colors[3]
	                    }])
                	}
                },
		        axisPointer: {
			      	type: 'shadow',  // cross时为十字虚线 也可以为shadow
			      	lineStyle: {
		        		color: '#bbb'
			      	},
			      	shadowStyle : {                       // 阴影指示器样式设置
			          width: 'auto',                   // 阴影大小
			          color: 'rgba(150,150,150,0.3)'  // 阴影颜色
		        	}
		    	},*/
		        data:  [15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 15, '-', '-', '-', '-', '-', '-']
		      }
		    ]
		  };
		  // 使用刚指定的配置项和数据显示图表。
		  flowTrendChart.setOption(option);
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

	$(".ebase-IndexPicker__fold").click(function() {
		var _this = $(this);
		if(_this.hasClass("open")) {
			_this.siblings(".ebase-IndexPicker__list").css({"height": "52px"});
			_this.removeClass("open");
			_this.children("span").html('展开'+'<i class="caret icon"></i>');
		} else {
			_this.siblings(".ebase-IndexPicker__list").css({"height": "auto"});
			_this.addClass("open");
			_this.children("span").html('收起'+'<i class="caret icon"></i>');
		}
	})

	$(".oui-card-switch.switch-detailswitch .oui-card-switch-switch-name").click(function() {
		var _this = $(this);
		var text = _this.text();
		if(_this.hasClass("oui-card-switch-active")) {
			return false;
		} else {
			_this.addClass("oui-card-switch-active").parent("span").siblings("span").find(".oui-card-switch-active").removeClass("oui-card-switch-active");
		}

		switch(text) {
			case '精简': {
				$(".pagesPlanMonitor__content .oui-card .oui-card-content .PlanMonitorBoardBar__root").hide().eq(0).show();
				break;
			}
			case '详细': {
				$(".pagesPlanMonitor__content .oui-card .oui-card-content .PlanMonitorBoardBar__root").hide().eq(1).show();
				break;
			}
		}

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
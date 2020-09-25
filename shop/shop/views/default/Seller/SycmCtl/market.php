<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--市场-->
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
			<li class="nav-item lf curr">
				<a href="javascript:;">
					首页
				</a>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
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
				<a href="javascript:;">
					流量
				</a>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
					商品
				</a>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
					交易
				</a>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
					服务
				</a>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
					物流
				</a>
			</li>
			<li class="nav-item lf">
				<a href="javascript:;">
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
				<a href="javascript:;">
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
	<div class="w-1040 basic-switch rt switch-wrap transaction-time">
		<div class="screen-header">
			<h3 class="screen-title lf mt-22">交易概況</h3>
		</div>
		<!-- 交易总览 start -->
		<div class="navbar-panel transaction-outlook">
			<div class="nav-bar">
				<h4 class="nav-bar-header mt-20 lf">
					<i class="icon"></i>交易总览
				</h4>
				<div class="sub-title rt mt-12">
					<span class="tip">点击快速更新数据面板</span>
					<button class="refresh">
						<i class="icon"></i>刷新
					</button>
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
				<div class="sub-title rt mt-12">
					<span class="tip">点击快速更新数据面板</span>
					<button class="refresh">
						<i class="icon"></i>刷新
					</button>
				</div>
			</div>
			<div class="content">
				<div class="transaction-trend-chart" id="transaction-trend-chart" style="width:980px;height: 360px;margin: 0 auto;"></div>
			</div>
		</div>
		<!-- 交易趋势  end -->
	</div>
	<!-- 交易概況 end -->


	<!-- 交易构成  start -->
	<div class="w-1040 basic-switch rt switch-wrap transaction-time">
		<div class="screen-header">
			<h3 class="screen-title lf mt-22">交易构成</h3>
		</div>
		<!-- 终端构成 start -->
		<div class="navbar-panel">
			<div class="nav-bar">
				<h4 class="nav-bar-header mt-20 lf">
					<i class="icon"></i>终端构成
				</h4>
				<div class="sub-title rt mt-12">
					<span class="tip">点击快速更新数据面板</span>
					<button class="refresh">
						<i class="icon"></i>刷新
					</button>
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
							<a href="javascript:;">查看趋势</a>
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
							<a href="javascript:;">查看趋势</a>
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
				<div class="sub-title rt mt-12">
					<span class="tip">点击快速更新数据面板</span>
					<button class="refresh">
						<i class="icon"></i>刷新
					</button>
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
						<span class="col col-1">
							支付金额
							<span class="desc">
								<i class="icon-order icon"></i>
							</span>
						</span>
						<span class="col col-1">
							支付金额占比
							<span>
								<i class="icon-order icon"></i>
							</span>
						</span>
						<span class="col col-1">
							支付买家数
							<span class="asc">
								<i class="icon-order icon"></i>
							</span>
						</span>
						<span class="col col-1">
							支付转化率
							<span class="desc">
								<i class="icon-order"></i>
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
									<a href="javascript:;">查看趋势</a>
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
									<a href="javascript:;">查看趋势</a>
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
									<a href="javascript:;">查看趋势</a>
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
									<a href="javascript:;">查看趋势</a>
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
				<div class="sub-title rt mt-12">
					<span class="tip">点击快速更新数据面板</span>
					<button class="refresh">
						<i class="icon"></i>刷新
					</button>
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
											<a href="javascript:;" target="_blank">店铺详情</a>
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
											<a href="javascript:;" target="_blank">店铺详情</a>
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
											<a href="javascript:;" target="_blank">店铺详情</a>
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
											<a href="javascript:;" target="_blank">店铺详情</a>
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
				<div class="sub-title rt mt-12">
					<span class="tip">点击快速更新数据面板</span>
					<button class="refresh">
						<i class="icon"></i>刷新
					</button>
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
							<a href="javascript:;">查看趋势</a>
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
							<a href="javascript:;">查看趋势</a>
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
							<a href="javascript:;">查看趋势</a>
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
							<a href="javascript:;">查看趋势</a>
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
				<div class="sub-title rt mt-12">
					<span class="tip">点击快速更新数据面板</span>
					<button class="refresh">
						<i class="icon"></i>刷新
					</button>
				</div>
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
	<!-- 交易构成  end -->


	<!-- 交易明细  start -->
	<div class="w-1040 basic-switch rt switch-wrap transaction-time">
		<div class="authorize-title">授权书</div>
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
		</div>
	</div>
	<!-- 交易明细  end -->


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
			                			borderWidth: 20,
			                			borderColor: 'transparent',
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
			                			borderWidth: 20,
			                			borderColor: 'transparent',
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
	</script>
</html>

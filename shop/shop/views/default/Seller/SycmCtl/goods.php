<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--商品-->
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
<div class="main-wrap w-1210 mt-10">
	<div class="nav lf w-160">
		<div class="left-nav">
			<div class="topLogo">
				<div class="topLogoContent">
					<i class="icon"></i>
					<p>商品分析</p>
				</div>
			</div>
			<ul class="menu-list-inner">
				<li class="menu-item-inner lf curr">
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
	<!-- 商品概况 start -->
	<div class="w-1040  rt switch-wrap goods-analysis-container">
		<div class="goods-time-wrap backff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">商品概况</h3>
			</div>
			<!-- 商品信息总况 start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>商品信息总况
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
							<li class="ui-selector-item curr">
								<span>最近1天</span>
							</li>
							<li class="ui-selector-item">
								<span>最近7天平均</span>
							</li>
							<li class="ui-selector-item">
								<span>最近30天平均</span>
							</li>
							<li class="ui-selector-item day">
								<span>日</span>
							</li>
							<li class="ui-selector-item month">
								<span>月</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="content">
					<div class="items items-flow orflow">
						<h3 class="title">流量相关</h3>
						<ul class="indexs">
							<li class="item lf">
								<div class="name">商品访客数</div>
								<div class="value num">1</div>
								<div class="rate">
									<span>较前日</span>
									<span class="r-trend flat">
										<i class="icon icon-trend"></i>
										<span class="num">0.00%</span>
									</span>
								</div>
							</li>
							<li class="item lf">
								<div class="name">商品浏览量</div>
								<div class="value num">1</div>
								<div class="rate">
									<span>较前日</span>
									<span class="r-trend flat">
										<i class="icon icon-trend"></i>
										<span class="num">0.00%</span>
									</span>
								</div>
							</li>
							<li class="item lf">
								<div class="name">
									被访问商品数
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</div>
								<div class="value num">1</div>
								<div class="rate">
									<span>较前日</span>
									<span class="r-trend flat">
										<i class="icon icon-trend"></i>
										<span class="num">0.00%</span>
									</span>
								</div>
							</li>
						</ul>
					</div>
					<div class="items items-flow orflow">
						<h3 class="title">访问质量</h3>
						<ul class="indexs">
							<li class="item lf">
								<div class="name">平均停留时长</div>
								<div class="value num">9</div>
								<div class="rate">
									<span>较前日</span>
									<span class="r-trend flat">
										<i class="icon icon-trend"></i>
										<span class="num">0.00%</span>
									</span>
								</div>
							</li>
							<li class="item lf">
								<div class="name">详情页跳出率</div>
								<div class="value num">0.00%</div>
								<div class="rate">
									<span>较前日</span>
									<span class="r-trend flat">
										<i class="icon icon-trend"></i>
										<span class="num">0.00%</span>
									</span>
								</div>
							</li>
						</ul>
					</div>
					<div class="items items-flow orflow">
						<h3 class="title">转化效果</h3>
						<ul class="indexs">
							<li class="item lf">
								<div class="name">加购件数</div>
								<div class="value num">9</div>
								<div class="rate">
									<span>较前日</span>
									<span class="r-trend down">
										<i class="icon icon-trend"></i>
										<span class="num">0.00%</span>
									</span>
								</div>
							</li>
							<li class="item lf">
								<div class="name">支付件数</div>
								<div class="value num">0.00%</div>
								<div class="rate">
									<span>较前日</span>
									<span class="r-trend flat">
										<i class="icon icon-trend"></i>
										<span class="num">0.00%</span>
									</span>
								</div>
							</li>
							<li class="item lf">
								<div class="name">异常商品数
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</div>
								<div class="value num">0.00%</div>
								<div class="rate">
									<span>较前日</span>
									<span class="r-trend up">
										<i class="icon icon-trend "></i>
										<span class="num">1.11%</span>
									</span>
								</div>
								
							</li>
							<li class="item lf">
								<div class="name">商品收藏次数</div>
								<div class="value num">0.00%</div>
								<div class="rate">
									<span>较前日</span>
									<span class="r-trend flat">
										<i class="icon icon-trend"></i>
										<span class="num">0.00%</span>
									</span>
								</div>
							</li>
						</ul>
					</div>
					<div class="data-desc data-desc-tail">
						<span class="data-desc-brand"></span>
						<div class="data-desc-panel">
							<div class="data-desc-box three-column">
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
							<div class="data-desc-box three-column">
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
							<div class="data-desc-box three-column">
								<div class="data-desc-header">
									<h4 class="title">转化效果解析</h4>
								</div>
								<div class="data-desc-content">
									<p>
										商品访客不给力，先解决引流问题吧，请到
										<a href="javascript:;" target="_blank">
											流量地图
										</a>深究，扩展引流渠道。
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 商品信息总况 end -->

			<!-- 商品销售趋势  start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>商品销售趋势
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
							<li class="ui-selector-item">
								<span>最近30天平均</span>
							</li>
							<li class="ui-selector-item day">
								<span>日</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="content">
					<div class="tendency-chart" id="tendency-chart" style="width:980px;height: 360px;"></div>
				</div>
			</div>
			<!-- 商品销售趋势  end -->

			<!-- 商品排行概览  start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>商品排行概览
					</h4>
					
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
						<span class="switch-more rt"><a href="javascript:;">更多>></a></span>
					</div>
					<div class="mod-box">
						<div class="mod-box-row orflow">
							<div class="table orderable-table">
								<div class="table-header orflow">
									<span class="col product lf">商品名称</span>
									<span class="col uv lf">
										<p class="device">所有终端的</p>
										<p class="name">访客数</p>
									</span>
									<span class="col pv lf">
										<p class="device">所有终端的</p>
										<p class="name">浏览量</p>
									</span>
									<span class="col avgBounceUvRate lf">
										<p class="device">所有终端的</p>
										<p class="name">详情页跳出率</p>
									</span>
									<span class="col orderRate lf">
										<p class="device">所有终端的</p>
										<p class="name">下单转化率</p>
									</span>
									<span class="col payAmt lf">
										<p class="device">所有终端的</p>
										<p class="name">支付金额</p>
									</span>
									<span class="col payItemQty lf">
										<p class="device">所有终端的</p>
										<p class="name">支付件数</p>
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
										<span class="col uv num">1</span>
										<span class="col pv num">1</span>
										<span class="col avgBounceUvRate num">0.00</span>
										<span class="col orderRate num">0</span>
										<span class="col payAmt num">0%</span>
										<span class="col payItemQty num">0%</span>
										<span class="col actions">
											<a href="index.php?ctl=Seller_Sycm&met=singleProductAnalysis" class="btn">
												单品分析
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 商品排行概览  end -->
		</div>
	</div>
	<!-- 商品概况 end -->

	<!-- 商品效果 start -->
	<div class="w-1040  rt switch-wrap goods-analysis-container">
		<div class="goods-effect-wrap backff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">商品效果</h3>
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
			<!-- 商品效果明细 start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>商品效果明细
					</h4>
					<div class="sub-title rt mt-12">
						<span class="tip">点击快速更新数据面板</span>
						<button class="refresh">
							<i class="icon"></i>刷新
						</button>
					</div>
				</div>
				<div class="content">
					<div class="lost-item rt">
						<span>您的店铺存在</span>
						<span class="lost-item-count">0</span>
						<span>款高流失商品，查看</span>
						<a href="javascript:;" target="_blank">流失商品》</a>
					</div>
					<div class="combopanels-container">
						<div class="dropdown-index-picker orflow">
							<span class="title lf">指标：</span>
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
							<div class="more-index rt">
								<div class="dropdown-btn">
									更多
									<span class="icon caret"></span>
								</div>
							</div>

							<div class="error-message">曝光量，点击次数，点击率暂只提供PC端数据</div>
						</div>
					</div>
					<div class="filters">
						<div class="select-control ui-selector fisrt-select">
							<a href="javascript:;">
								<span class="ui-selector-value">自定义分类</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list" style="display: none;">
								<li class="ui-selector-item curr">
									<span>自定义分类</span>
								</li>
								<li class="ui-selector-item">
									<span>商品类目</span>
								</li>
							</ul>
						</div>
						<div class="select-control ui-selector second-select">
							<a href="javascript:;">
								<span class="ui-selector-value">全部分类</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list" style="">
								<li class="ui-selector-item curr">
									<span>全部分类</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
								<li class="ui-selector-item">
									<span>促销</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
								<li class="ui-selector-item">
									<span>家电/电脑/办公</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
								<li class="ui-selector-item">
									<span>美妆/珠宝/饰品</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
								<li class="ui-selector-item">
									<span>运动/户外/器材</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
								<li class="ui-selector-item">
									<span>OralB/欧乐B</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
								<li class="ui-selector-item">
									<span>汽车用品</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
								<li class="ui-selector-item">
									<span>生鲜/水果/土特产</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
								<li class="ui-selector-item">
									<span>鞋靴/箱包/配件</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
								<li class="ui-selector-item">
									<span>鞋靴/箱包/配件</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
							</ul>
							<ul class="ui-selector-list select-control-list" style="display: none;">
								<li class="ui-selector-item curr">
									<span>全部分类</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
								<li class="ui-selector-item">
									<span>帆布鞋</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
								<li class="ui-selector-item">
									<span>T恤</span>
									<i class="child-symbol" style="left: 108px;">&gt;</i>
								</li>
							</ul>

							<div class="ui-selector-children select-control-list">
								<ul></ul>
								<ul>
									<li style="width: 128px;">1大家电</li>
									<li style="width: 128px;">1笔记本电脑</li>
									<li style="width: 128px;">1生活电器</li>
									<li style="width: 128px;">1厨房电器</li>
									<li style="width: 128px;">1影音电器</li>
									<li style="width: 128px;">1办公设备</li>
									<li style="width: 128px;">1大家电</li>
								</ul>
								<ul>
									<li style="width: 128px;">2大家电</li>
									<li style="width: 128px;">2笔记本电脑</li>
									<li style="width: 128px;">2生活电器</li>
									<li style="width: 128px;">2厨房电器</li>
									<li style="width: 128px;">2影音电器</li>
									<li style="width: 128px;">2办公设备</li>
									<li style="width: 128px;">2大家电</li>
									<li style="width: 128px;">2大家电</li>
									<li style="width: 128px;">2大家电</li>
									<li style="width: 128px;">2大家电</li>
								</ul>
								<ul></ul>
								<ul></ul>
								<ul></ul>
								<ul>
									<li style="width: 128px;">6大家电</li>
									<li style="width: 128px;">6笔记本电脑</li>
									<li style="width: 128px;">6生活电器</li>
									<li style="width: 128px;">3厨房电器</li>
									<li style="width: 128px;">3影音电器</li>
									<li style="width: 128px;">3办公设备</li>
									<li style="width: 128px;">3大家电</li>
									<li style="width: 128px;">3大家电</li>
									<li style="width: 128px;">3大家电</li>
									<li style="width: 128px;">3大家电</li>
								</ul>
								<ul>
									<li style="width: 128px;">7大家电</li>
									<li style="width: 128px;">7笔记本电脑</li>
								</ul>
								<ul></ul>
								<ul></ul>
							</div>
							<!-- <div class="ui-selector-children"></div> -->

						</div>
						
						<div class="input-search mt-8 rt">
							<input type="text" placeholder="请输入商品名称或ID" name="">
							<i class="icon icon-search"></i>
							<span class="search-del">x</span>
						</div>
					</div>
					<div class="table orderable-table">
						<div class="table-header orflow">
							<span class="col product lf">商品名称</span>
							<span class="col items-status lf">当前状态</span>
							<div class="col orderable custom col-0 lf">
								<span class="order-flag desc">
									<i class="icon-order icon"></i>
								</span>
								<p class="device">所有终端的</p>
								<p class="name">商品访客数</p>
							</div>
							<div class="col orderable custom col-1 lf">
								<span class="order-flag">
									<i class="icon-order icon"></i>
								</span>
								<p class="device">所有终端的</p>
								<p class="name">商品浏览量</p>
							</div>
							<div class="col orderable custom col-2 lf">
								<span class="order-flag ">
									<i class="icon-order icon"></i>
								</span>
								<p class="device">所有终端的</p>
								<p class="name">下单件数</p>
							</div>
							<div class="col orderable custom col-3 lf">
								<span class="order-flag">
									<i class="icon-order icon"></i>
								</span>
								<p class="device">所有终端的</p>
								<p class="name">支付金额</p>
							</div>
							<div class="col orderable custom col-4 lf">
								<span class="order-flag">
									<i class="icon-order icon"></i>
								</span>
								<p class="device">所有终端的</p>
								<p class="name">收藏人数</p>
							</div>
							<span class="col actions lf">操作</span>
						</div>
						<div class="table-body">
							<!-- <div class="no-data-message">
								<div class="ui-message-empty">
									<p class="ui-message-content">
										<span class="noromal">
											<i class="icon"></i>
										</span>
										<span>暂无数据</span>
									</p>
								</div>
							</div> -->
							<div class="row">
								<a href="javascript:;" target="_blank" class="support isWirelessPublished">
									<i class="icon-support-wireless icon"></i>
								</a>
								<span class="col pic">
									<a class="box-img" href="javascript:;" target="_blank">
										<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
									</a>
								</span><span class="col product">
									<p class="title">
										<a href="javascript:;">2017欧美新款冬季中长款连帽茧型贴布绣字母女式宽松休闲棉衣棉服</a>
									</p>
									<p class="datetime">发布时间：2017-07-12</p>
								</span>
								<span class="col items-status">当前在线</span>
								<span class="col col-0 custom num">1</span>
								<span class="col col-0 custom num">1</span>
								<span class="col col-0 custom num">0.00</span>
								<span class="col col-0 custom num">0</span>
								<span class="col col-0 custom num">0%</span>
								<span class="col actions">
									<a class="item-link" href="index.php?ctl=Seller_Sycm&met=goodsThermometer" class="btn">
										商品温度计
									</a>
									<br>
									<a class="item-link" href="index.php?ctl=Seller_Sycm&met=singleProductAnalysis" class="btn">
										单品分析
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 商品效果明细 end -->
		</div>
	</div>
	<!-- 商品效果 end -->

	<!-- 异常商品 start -->
	<div class="w-1040  rt switch-wrap goods-analysis-container">
		<div class="goods-unusual-wrap backff">
			<div class="page-header">
				<h3 class="screen-title lf mt-22">异常商品</h3>
				<p class="rt text-desc">为您提供各类异常商品的TOP50，会有一个商品存在多种异常的情况，请关注哦。</p>
			</div>
			<!-- 异常商品 start -->
			<div class="component-abnormal">
				<div class="ui-switch ui-switch-routable nav-tabs">
					<ul class="ui-switch-menu orflow">
						<li class="active ui-switch-item ui-routable-item lf">
							<a href="javascript:;">
								<span>流量下跌</span>
								<span class="num size">(0)</span>
							</a>
						</li>
						<li class="ui-switch-item ui-routable-item lf">
							<a href="javascript:;">
								<span>支付转化率</span>
								<span class="num size">(0)</span>
							</a>
						</li>
						<li class="ui-switch-item ui-routable-item lf">
							<a href="javascript:;">
								<span>高跳出率</span>
								<span class="num size">(0)</span>
							</a>
						</li>
						<li class="ui-switch-item ui-routable-item lf">
							<a href="javascript:;">
								<span>支付下跌</span>
								<span class="num size">(0)</span>
							</a>
						</li>
						<li class="ui-switch-item ui-routable-item lf">
							<a href="javascript:;">
								<span>零支付</span>
								<span class="num size">(10)</span>
							</a>
						</li>
						<li class="ui-switch-item ui-routable-item lf">
							<a href="javascript:;">
								<span>低库存</span>
								<span class="num size">(0)</span>
							</a>
						</li>
					</ul>
				</div>
				<div class="content">
					<div class="desc">
						<p class="normal">
							<i class="icon icon-info"></i>
							流量下跌商品：最近7天(2017.10.09~2017.10.15)浏览量较上一个周期7天(2017.10.02~2017.10.08)下跌50%以上；
						</p>
						<p class="success">
							<i class="icon icon-info"></i>
							建议：优化商品标题和描述，使用“营销推广”功能，或其它营销手段进行引流。
						</p>
					</div>
					<div class="flow table orderable-table">
						<div class="table-header orflow">
							<span class="col product col-1 lf">商品名称</span>
							<span class="col col-2 lf">上个周期7天浏览量</span>
							<span class="col col-3 lf">最近7天浏览量</span>
							<span class="col actions lf">操作</span>
						</div>
						<div class="table-body"></div>
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
				<div class="content">
					<div class="desc">
						<p class="normal">
							<i class="icon icon-info"></i>
							支付转化率低商品：支付转化率（支付买家数/商品访客数）低于同类商品平均水平；
						</p>
						<p class="success">
							<i class="icon icon-info"></i>
							建议：优化商品标题和描述，通过促销优惠提升买家下单转化。
						</p>
					</div>
					<div class="flow table orderable-table">
						<div class="table-header orflow">
							<span class="col product col-1 lf">商品名称</span>
							<span class="col col-2 lf">最近7天访客数</span>
							<span class="col col-3 lf">最近7天日均支付转化率</span>
							<span class="col actions lf">操作</span>
						</div>
						<div class="table-body"></div>
						<div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>暂无数据2</span>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="desc">
						<p class="normal">
							<i class="icon icon-info"></i>
							高跳出率商品：跳出率是指商品的浏览量中，没有进一步访问店铺其他页面的浏览量占比，高跳出率商品是指跳出率高于同类商品平均水平；
						</p>
						<p class="success">
							<i class="icon icon-info"></i>
							建议：优化商品标题和描述，通过一定的营销方式引流，同时利用促销优惠提升买家下单转化。
						</p>
					</div>
					<div class="flow table orderable-table">
						<div class="table-header orflow">
							<span class="col product col-1 lf">商品名称</span>
							<span class="col col-2 lf">最近7天浏览量</span>
							<span class="col col-3 lf">最近7天日均跳出率</span>
							<span class="col actions lf">操作</span>
						</div>
						<div class="table-body"></div>
						<div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>暂无数据3</span>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="desc">
						<p class="normal">
							<i class="icon icon-info"></i>
							支付下跌商品：最近7天(2017.10.09~2017.10.15)支付金额较上一个周期7天(2017.10.02~2017.10.08)下跌30%以上；
						</p>
						<p class="success">
							<i class="icon icon-info"></i>
							建议：优化商品标题和描述，加强引流，同时利用促销优惠提升买家下单转化。
						</p>
					</div>
					<div class="flow table orderable-table">
						<div class="table-header orflow">
							<span class="col product col-1 lf">商品名称</span>
							<span class="col col-2 lf">上个周期7天支付金额</span>
							<span class="col col-3 lf">最近7天支付金额</span>
							<span class="col actions lf">操作</span>
						</div>
						<div class="table-body"></div>
						<div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>暂无数据4</span>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="desc">
						<p class="normal">
							<i class="icon icon-info"></i>
							零支付商品：90天内发布且最近7天内没有产生任何销量的商品（此类商品不会进入搜索索引）；
						</p>
						<p class="success">
							<i class="icon icon-info"></i>
							建议：修改商品标题，属性等重新发布上架，加强关联商品，加强引流。
						</p>
					</div>
					<div class="flow table orderable-table">
						<div class="table-header orflow">
							<span class="col product col-1 lf">商品名称</span>
							<span class="col col-2 lf">上个周期7天访客数</span>
							<span class="col col-3 lf">上个周期7天支付金额</span>
							<span class="col actions lf">操作</span>
						</div>
						<div class="table-body">
							<div class="row">
								<div class="col pic lf">
									<a href="javascript:;" class="box-img" target="_blank">
										<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
									</a>
								</div>
								<div class="col product lf">
									<p class="title">
										<a href="javascript:;">Midea/美的 MY-SS5051P/PSS5051P电压力锅5L智能高压饭煲一锅双胆</a>
									</p>
									<p class="datetime">发布时间：2017-10-08</p>
								</div>	
								<span class="col col-2 num lf">0</span>
								<span class="col col-3 num lf">0.00</span>
								<span class="col actions lf">
									<a href="javascript:;" class="item-link" target="_blank">商品温度计</a>
									<br>
									<a href="javascript:;" class="item-link" target="_blank">单品分析</a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="desc">
						<p class="normal">
							<i class="icon icon-info"></i>
							低库存商品：最近7天(2017.10.09~2017.10.15)，加购件数>昨日库存量x80%的商品；
						</p>
						<p class="success">
							<i class="icon icon-info"></i>
							建议：增加备货量，以便保证商品的正常售卖。
						</p>
					</div>
					<div class="flow table orderable-table">
						<div class="table-header orflow">
							<span class="col product col-1 lf">商品名称</span>
							<span class="col col-2 lf">最近7天加购件数</span>
							<span class="col col-3 lf">最近1天加购件数</span>
							<span class="col actions lf">操作</span>
						</div>
						<div class="table-body"></div>
						<div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
									<span class="noromal">
										<i class="icon"></i>
									</span>
									<span>暂无数据6</span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 异常商品 end -->
		</div>
	</div>
	<!-- 异常商品 end -->

	<!-- 分类分析 start -->
	<div class="w-1040  rt switch-wrap goods-analysis-container">
		<div class="goods-classify-wrap backff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">分类分析</h3>
			</div>
			<!-- 商品分类引导化 start -->
			<div class="navbar-panel">
				<div class="nav-bar">
					<h4 class="nav-bar-header mt-20 lf">
						<i class="icon"></i>商品分类引导化
					</h4>
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
								<a href="javascript:;">自定义分类</a>
							</li>
							<li class="ui-switch-item lf">
								<a href="javascript:;">商品类目</a>
							</li>
						</ul>
					</div>
					<div class="table orderable-table openable-table">
						<div class="table-header">
							<span class="col col-1">自定义类别</span>
							<span class="col col-2">商品数</span>
							<span class="col col-3 orderable">
								<span class="order-flag desc">
									<i class="icon icon-order"></i>
								</span>
								访客数
							</span>
							<span class="col col-4">引导点击转化率</span>
							<span class="col col-5">引导支付转化率</span>
							<span class="col col-6 actions">操作</span>
						</div>
						<div class="table-body">
							<div class="row">
								<span class="col col-1">
									<div class="btn-wrap">
										<i class="open-btn btn-spread">-</i>
										<i class="open-btn">+</i>
									</div>
									<span class="cate-name">促销</span>
								</span>
								<span class="col col-2 num">0</span>
								<span class="col col-3 num">0</span>
								<span class="col col-4 num">0.00%</span>
								<span class="col col-5 num">0.00%</span>
								<span class="col col-6 actions">
									<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
									<br>
									<a href="javascript:;" target="_blank">商品详情</a>
								</span>
								<ul class="row-children">
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
								</ul>
							</div>
							<div class="row">
								<span class="col col-1">
									<div class="btn-wrap">
										<i class="open-btn btn-spread">-</i>
										<i class="open-btn">+</i>
									</div>
									<span class="cate-name">促销2</span>
								</span>
								<span class="col col-2 num">0</span>
								<span class="col col-3 num">0</span>
								<span class="col col-4 num">0.00%</span>
								<span class="col col-5 num">0.00%</span>
								<span class="col col-6 actions">
									<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
									<br>
									<a href="javascript:;" target="_blank">商品详情</a>
								</span>
							</div>
							<div class="row">
								<span class="col col-1">
									<div class="btn-wrap">
										<i class="open-btn btn-spread">-</i>
										<i class="open-btn">+</i>
									</div>
									<span class="cate-name">家电</span>
								</span>
								<span class="col col-2 num">0</span>
								<span class="col col-3 num">0</span>
								<span class="col col-4 num">0.00%</span>
								<span class="col col-5 num">0.00%</span>
								<span class="col col-6 actions">
									<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
									<br>
									<a href="javascript:;" target="_blank">商品详情</a>
								</span>
								<ul class="row-children">
									<li>
										<span class="col col-1">1大家电</span>
										<span class="col col-2 num">10</span>
										<span class="col col-3 num">10.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">2大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
								</ul>
							</div>
							<div class="row">
								<span class="col col-1">
									<div class="btn-wrap">
										<i class="open-btn btn-spread">-</i>
										<i class="open-btn">+</i>
									</div>
									<span class="cate-name">彩妆</span>
								</span>
								<span class="col col-2 num">0</span>
								<span class="col col-3 num">0</span>
								<span class="col col-4 num">0.00%</span>
								<span class="col col-5 num">0.00%</span>
								<span class="col col-6 actions">
									<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
									<br>
									<a href="javascript:;" target="_blank">商品详情</a>
								</span>
								<ul class="row-children">
									<li>
										<span class="col col-1">23大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">43大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
								</ul>
							</div>
							<div class="row">
								<span class="col col-1">
									<div class="btn-wrap">
										<i class="open-btn btn-spread">-</i>
										<i class="open-btn">+</i>
									</div>
									<span class="cate-name">促销</span>
								</span>
								<span class="col col-2 num">0</span>
								<span class="col col-3 num">0</span>
								<span class="col col-4 num">0.00%</span>
								<span class="col col-5 num">0.00%</span>
								<span class="col col-6 actions">
									<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
									<br>
									<a href="javascript:;" target="_blank">商品详情</a>
								</span>
								<ul class="row-children">
									<li>
										<span class="col col-1">服饰</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">服饰</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
								</ul>
							</div>
							<div class="row">
								<span class="col col-1">
									<div class="btn-wrap">
										<i class="open-btn btn-spread">-</i>
										<i class="open-btn">+</i>
									</div>
									<span class="cate-name">电器/电器/电器</span>
								</span>
								<span class="col col-2 num">0</span>
								<span class="col col-3 num">0</span>
								<span class="col col-4 num">0.00%</span>
								<span class="col col-5 num">0.00%</span>
								<span class="col col-6 actions">
									<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
									<br>
									<a href="javascript:;" target="_blank">商品详情</a>
								</span>
								<ul class="row-children">
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">电器</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
									<li>
										<span class="col col-1">大家电</span>
										<span class="col col-2 num">0</span>
										<span class="col col-3 num">0.00%</span>
										<span class="col col-4 num">1.00%</span>
										<span class="col col-5 num">0.22</span>
										<span class="col col-6 actions">
											<a href="javascript:;" class="item-link overlook-trend">查看趋势</a>
											<br>
											<a href="javascript:;" target="_blank">商品详情</a>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 商品分类引导化 end -->
		</div>
	</div>
	<!-- 分类分析 end -->

	<!-- 单品分析 start -->
	<div class="w-1040  rt switch-wrap goods-analysis-container">
		<div class="goods-single-wrap backff">
			<div class="page-header">
				<h3 class="screen-title lf mt-22">单品分析</h3>
			</div>
			<div class="ui-item-sgt-wrapper">
				<div class="sgt-wrapper">
					<div class="ui-suggestion ui-item-sgt">
						<div class="ui-suggestion-input input-search">
							<input type="text" class="ui-suggestion-search" placeholder="请输入您店铺内商品的关键词、商品ID 或粘贴商品URL，并在提示列表中选中目标商品" name="">
							<i class="icon icon-search"></i>
							<span class="search-del icon">x</span>
						</div>
						<ul class="ui-suggestion-menu">
							<li class="ui-suggestion-item">
								<div class="result-wrapper">
									<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg" class="sgt-img">
									<p class="sgt-title">ABC无忧裤S-M码裤型卫生巾6包 共12片   淘尚168商城</p>
									<p class="sgt-info mt-20">
										<span class="publishTime">
											发布时间：
										</span>
										<span>2017-10-6</span>
									</p>
								</div>
							</li>
							<li class="ui-suggestion-item">
								<div class="result-wrapper">
									<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg" class="sgt-img">
									<p class="sgt-title">ABC无忧裤S-M码裤型卫生巾6包 共12片   淘尚168商城</p>
									<p class="sgt-info mt-20">
										<span class="publishTime">
											发布时间：
										</span>
										<span>2017-10-6</span>
									</p>
								</div>
							</li>
							<li class="ui-suggestion-item">
								<div class="result-wrapper">
									<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg" class="sgt-img">
									<p class="sgt-title">ABC无忧裤S-M码裤型卫生巾6包 共12片   淘尚168商城</p>
									<p class="sgt-info mt-20">
										<span class="publishTime">
											发布时间：
										</span>
										<span>2017-10-6</span>
									</p>
								</div>
							</li>
							<li class="ui-suggestion-item">
								<div class="result-wrapper">
									<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg" class="sgt-img">
									<p class="sgt-title">ABC无忧裤S-M码裤型卫生巾6包 共12片   淘尚168商城</p>
									<p class="sgt-info mt-20">
										<span class="publishTime">
											发布时间：
										</span>
										<span>2017-10-6</span>
									</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="search-suggestion">
				<div class="suggestion-wrapper">
					<div>
						<label class="suggestion-label">系统推荐</label>
					</div>
					<div>
						<div class="suggestion-item lf">
							<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
						</div>
						<div class="suggestion-item lf">
							<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
						</div>
					</div>
				</div>
			</div>
			<div class="wdj-intro-wrapper">
				<h1 class="intro-title">关注单品，打造爆款！</h1>
				<p class="intro-message">单品的效果如何？哪个来源引来的访客质量高？哪个关键词转化高？哪个地域流量给力？ 单品分析来帮你，让你把钱花在刀刃上！</p>
				<div class="sub-intro-wrapper">
					<div class="sub-intro">
						<i class="sub-intro-icon direction-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">来源去向</h5>
							<p class="message">分析引流来源的访客质量，关键词的转化效果，来源商品贡献，让你清楚引流的来源效果</p>
						</div>	
					</div>
					<div class="sub-intro">
						<i class="sub-intro-icon trend-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">销售分析</h5>
							<p class="message">分析引流来源的访客质量，关键词的转化效果，来源商品贡献，让你清楚引流的来源效果</p>
						</div>	
					</div>
					<div class="sub-intro">
						<i class="sub-intro-icon feature-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">来源去向</h5>
							<p class="message">分析引流来源的访客质量，关键词的转化效果，来源商品贡献，让你清楚引流的来源效果</p>
						</div>	
					</div>
					<div class="sub-intro">
						<i class="sub-intro-icon sales-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">来源去向</h5>
							<p class="message">分析引流来源的访客质量，关键词的转化效果，来源商品贡献，让你清楚引流的来源效果</p>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 单品分析 end -->


	<!-- 商品温度计 start -->
	<div class="w-1040  rt switch-wrap goods-analysis-container">
		<div class="goods-weatherglass-wrap backff">
			<div class="page-header">
				<h3 class="screen-title lf mt-22">商品温度计</h3>
			</div>
			<div class="ui-item-sgt-wrapper">
				<div class="sgt-wrapper">
					<div class="ui-suggestion ui-item-sgt">
						<div class="ui-suggestion-input input-search">
							<input type="text" class="ui-suggestion-search" placeholder="请输入您店铺内商品的关键词、商品ID 或粘贴商品URL，并在提示列表中选中目标商品" name="">
							<i class="icon icon-search"></i>
							<span class="search-del icon">x</span>
						</div>
						<ul class="ui-suggestion-menu">
							<li class="ui-suggestion-item">
								<div class="result-wrapper">
									<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg" class="sgt-img">
									<p class="sgt-title">ABC无忧裤S-M码裤型卫生巾6包 共12片   淘尚168商城</p>
									<p class="sgt-info mt-20">
										<span class="publishTime">
											发布时间：
										</span>
										<span>2017-10-6</span>
									</p>
								</div>
							</li>
							<li class="ui-suggestion-item">
								<div class="result-wrapper">
									<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg" class="sgt-img">
									<p class="sgt-title">ABC无忧裤S-M码裤型卫生巾6包 共12片   淘尚168商城</p>
									<p class="sgt-info mt-20">
										<span class="publishTime">
											发布时间：
										</span>
										<span>2017-10-6</span>
									</p>
								</div>
							</li>
							<li class="ui-suggestion-item">
								<div class="result-wrapper">
									<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg" class="sgt-img">
									<p class="sgt-title">ABC无忧裤S-M码裤型卫生巾6包 共12片   淘尚168商城</p>
									<p class="sgt-info mt-20">
										<span class="publishTime">
											发布时间：
										</span>
										<span>2017-10-6</span>
									</p>
								</div>
							</li>
							<li class="ui-suggestion-item">
								<div class="result-wrapper">
									<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg" class="sgt-img">
									<p class="sgt-title">ABC无忧裤S-M码裤型卫生巾6包 共12片   淘尚168商城</p>
									<p class="sgt-info mt-20">
										<span class="publishTime">
											发布时间：
										</span>
										<span>2017-10-6</span>
									</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="search-suggestion">
				<div class="suggestion-wrapper">
					<div>
						<label class="suggestion-label">系统推荐</label>
					</div>
					<div>
						<div class="suggestion-item lf">
							<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
						</div>
						<div class="suggestion-item lf">
							<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
						</div>
					</div>
				</div>
			</div>
			<div class="wdj-intro-wrapper">
				<h1 class="intro-title">商品温度计，一键把脉！</h1>
				<p class="intro-message">商品引流能力强但转化低是什么引起的？是页面加载慢？是价格高？还是评价差呢？商品温度计来帮你，帮你诊断优化商品！！！</p>
				<div class="sub-intro-wrapper">
					<div class="sub-intro">
						<i class="sub-intro-icon convert-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">来源去向</h5>
							<p class="message">分析引流来源的访客质量，关键词的转化效果，来源商品贡献，让你清楚引流的来源效果</p>
						</div>	
					</div>
					<div class="sub-intro">
						<i class="sub-intro-icon effect-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">销售分析</h5>
							<p class="message">分析引流来源的访客质量，关键词的转化效果，来源商品贡献，让你清楚引流的来源效果</p>
						</div>	
					</div>
					<div class="sub-intro">
						<i class="sub-intro-icon item-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">来源去向</h5>
							<p class="message">分析引流来源的访客质量，关键词的转化效果，来源商品贡献，让你清楚引流的来源效果</p>
						</div>	
					</div>
					<div class="sub-intro">
						<i class="sub-intro-icon wireless-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">来源去向</h5>
							<p class="message">分析引流来源的访客质量，关键词的转化效果，来源商品贡献，让你清楚引流的来源效果</p>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 商品温度计 end -->

	<!-- 销量预测  start -->
	<div class="w-1040  rt switch-wrap goods-analysis-container">
		<div class="sales-voume-wrap backff">
			<div class="page-header">
				<h3 class="screen-title lf mt-22">销量预测</h3>
			</div>
			<div class="ui-switch ui-switch-routable nav-tabs">
				<ul class="ui-switch-menu orflow">
					<li class="active ui-switch-item ui-routable-item lf">
						<a href="javascript:;">
							<span>销量预测</span>
						</a>
					</li>
					<li class="ui-switch-item ui-routable-item lf">
						<a href="javascript:;">	
							<span>定价参考</span>
						</a>
					</li>
				</ul>
				<p class="update-time">数据更新日期：2017-10-10</p>
			</div>
			<div class="ui-switch-wrap">
				<!-- 参谋长推荐 start -->
				<div class="navbar-panel">
					<div class="nav-bar">
						<h4 class="nav-bar-header mt-20 lf">
							<i class="icon"></i>参谋长推荐
						</h4>
						<div class="operation mt-20 rt">
							<span class="do-change">
								<i class="icon"></i><span>换一批</span>
							</span>
						</div>
					</div>
					<div class="content">
						<div class="chart-header">
							<i class="lf lab-icon-deer icon"></i>
							<div class="lf desc">
								<div class="lf">
									<p>
										<span>参谋长为您预测以下商品，预测效果仅供参考。</span>
									</p>
									<p>
										<span>圆圈越大则系统预测未来销量越好，带</span>
										<span class="error">
											<i class="icon icon-info"></i>
										</span>
										<span>则未来7天库存告急哦！</span>
									</p>
								</div>
							</div>
							<div class="rt operation">
								<div class="select-control ui-selector">
									<a href="javascript:;">
										<span class="ui-selector-value">
											选择库存状态
										</span>
										<span class="caret icon"></span>
									</a>
									<ul class="ui-selector-list select-control-list" style="display: none;">
										<li class="ui-selector-item">
											<span>选择库存状态</span>
										</li>
										<li class="ui-selector-item curr">
											<span>最近1天库存正常</span>
										</li>
										<li class="ui-selector-item">
											<span>最近1天库存告急</span>
										</li>
									</ul>
								</div>
								<input type="text" class="search" placeholder="请输入商品名称或商品ID">
							</div>
						</div>
						<div class="random-content xl-forecast" style="height: 340px;width:100%;position: relative;">
							<!-- <div class="img-circle-wrap">
								<img src="http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170916/1505530624119275.png">
								<div class="circle-pop-wrap">
									<div class="tips-header clearfix">
										<a target="_blank" href="javascript:;">
											<img src="//img.alicdn.com/bao/uploaded/i3/TB1vJVIJVXXXXbNXpXXXXXXXXXX_!!0-item_pic.jpg_50x50.jpg" class="item-pic lf">
										</a>
										<div class="detail lf">
											<p class="item-title">
												<a target="_blank" href="javascript:;">床上用品磨毛四件套 学生三件套不掉色</a>
											</p>
											<div class="item-operate">
												<button title="" class="btn btn-hollow monitor">+监控</button>
												<button class="btn btn-hollow suggest">建议反馈</button>
												<a href="javascript:;" target="_blank" class="procurement">采购进货</a>
											</div>
										</div>
									</div>
									<ul class="feature clearfix">
										<li class="lf common"><p>系统预测未来7天销量</p><p class="num"><span>0</span></p></li>
										<li class="lf custom"><p>自定义预测未来7天销量</p><p class="num"><span>12</span></p></li>
									</ul>
									<ul class="list">
										<li class="clearfix header">
											<div class="lf title"></div>
											<div class="lf desc">加购件数</div>
											<div class="lf desc">收藏人数</div>
										</li>
										<li class="clearfix content">
											<div class="lf title">最近7天新增</div>
											<div class="lf num">0</div>
											<div class="lf num">0</div>
										</li>
										<li class="clearfix content">
											<div class="lf title">最近180天累计</div>
											<div class="lf num">1</div>
											<div class="lf num">0</div>
										</li>
									</ul>
								</div>
							</div> -->
						</div>
					</div>
				</div>
				<!-- 参谋长推荐 end -->

				<!-- 监控中的商品  start -->
				<div class="navbar-panel">
					<div class="nav-bar">
						<h4 class="nav-bar-header mt-20 lf">
							<i class="icon"></i>监控中的商品
						</h4>
						<div class="item-total item-lf lf">
							共<em class="num">0</em>件
						</div>
						<div class="item-enable item-lf lf">
							您还可以监控<em class="num">10</em>件
						</div>
						<div class="operation mt-16 rt">
							<button class="btn btn-hollow">设置自定义预规则</button>
						</div>
					</div>
					<div class="content">
						<div class="no-data-message">
							<div class="ui-message-empty">
								<p class="ui-message-content">
								<span class="pic">
									<img src="https://gtd.alicdn.com/tps/TB1OLDnHVXXXXcnXVXXXXXXXXXX.png">
									</span>
									<span>请从参谋长推荐中选择需要的商品哦！</span>
								</p>
							</div>
						</div>
					</div>
				</div>
				<!-- 监控中的商品  end -->
			</div>
			<div class="ui-switch-wrap" style="display: none;">
				<!-- 参谋长推荐 start -->
				<div class="navbar-panel">
					<div class="nav-bar">
						<h4 class="nav-bar-header mt-20 lf">
							<i class="icon"></i>参谋长推荐
						</h4>
						<div class="operation mt-20 rt">
							<span class="do-change">
								<i class="icon"></i><span>换一批</span>
							</span>
						</div>
					</div>
					<div class="content">
						<div class="chart-header">
							<i class="lf lab-icon-deer icon"></i>
							<div class="lf desc">
								<div class="lf">
									<p>
										<span>参谋长为您预测以下商品，预测效果仅供参考。</span>
									</p>
									<p>
										<span>圆圈越大则系统预测未来销量越好，带</span>
										<span class="error">
											<i class="icon icon-info"></i>
										</span>
										<span>则未来7天库存告急哦！</span>
									</p>
								</div>
							</div>
							<div class="rt operation">
								<input type="text" class="search" placeholder="请输入商品名称或商品ID">
							</div>
						</div>
						<div class="random-content pricing-reference" style="height: 340px;width:100%;position: relative;">
							
						</div>
					</div>
				</div>
				<!-- 参谋长推荐 end -->
			</div>
		</div>
	</div>
	<!-- 销量预测  end -->

	<!-- 单品服务分析 start -->
	<div class="w-1040  rt switch-wrap goods-analysis-container">
		<div class="singleSevice-analysis-wrap backff">
			<div class="page-header">
				<h3 class="screen-title lf mt-22">单品服务分析</h3>
			</div>
			<div class="ui-item-sgt-wrapper">
				<div class="sgt-wrapper">
					<div class="ui-suggestion ui-item-sgt">
						<div class="ui-suggestion-input input-search">
							<input type="text" class="ui-suggestion-search" placeholder="请输入商品关键词或ID" name="">
							<i class="icon icon-search"></i>
							<span class="search-del icon">x</span>
						</div>
						<ul class="ui-suggestion-menu">
							<li class="ui-suggestion-item">
								<span class="lf item-pic-wrap">
									<img class="pic" src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
								</span>
								<span class="item-name lf">Galanz/格兰仕 KWS1530X-H7R 30L家用电烤箱特价包邮/带旋转烤叉</span>
							</li>
							<li class="ui-suggestion-item">
								<span class="lf item-pic-wrap">
									<img class="pic" src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
								</span>
								<span class="item-name lf">Galanz/格兰仕 KWS1530X-H7R 30L家用电烤箱特价包邮/带旋转烤叉</span>
							</li>
							<li class="ui-suggestion-item">
								<span class="lf item-pic-wrap">
									<img class="pic" src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
								</span>
								<span class="item-name lf">Galanz/格兰仕 KWS1530X-H7R 30L家用电烤箱特价包邮/带旋转烤叉</span>
							</li>
							<li class="ui-suggestion-item">
								<span class="lf item-pic-wrap">
									<img class="pic" src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
								</span>
								<span class="item-name lf">Galanz/格兰仕 KWS1530X-H7R 30L家用电烤箱特价包邮/带旋转烤叉</span>
							</li>
							<li class="ui-suggestion-item">
								<span class="lf item-pic-wrap">
									<img class="pic" src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/20007/40/image/20170720/1500541693762351.jpg!60x60.jpg">
								</span>
								<span class="item-name lf">Galanz/格兰仕 KWS1530X-H7R 30L家用电烤箱特价包邮/带旋转烤叉</span>
							</li>
							
						</ul>
					</div>
				</div>
			</div>
			<div class="wdj-intro-wrapper">
				<h1 class="intro-title">单品服务分析，买家心意我知道！</h1>
				<p class="intro-message">哪个单品买家更喜欢？哪个单品买家的满意度最差？买家对这个单品的评价如何？是对哪个颜色或者哪个规格特别不满意？尽在单品服务分析！</p>
				<div class="sub-intro-wrapper">
					<div class="sub-intro">
						<i class="sub-intro-icon service-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">服务诊断</h5>
							<p class="message">商品重点服务指标轻松一览，诊断商品描述是否相符、 品质、纠纷、退款方面服务情况。</p>
						</div>	
					</div>
					<div class="sub-intro">
						<i class="sub-intro-icon refund-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">退款解读</h5>
							<p class="message">商品好不好，看看退款情况就知道。了解商品退款原因，提高商品质量</p>
						</div>	
					</div>
					<div class="sub-intro">
						<i class="sub-intro-icon commend-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">评价分析</h5>
							<p class="message">了解单个商品评价分数，关注负面评价，优化商品，提高服务水平，提升客户满意度</p>
						</div>	
					</div>
					<div class="sub-intro">
						<i class="sub-intro-icon argue-icon"></i>
						<div class="sub-intro-info-wrapper orflow">
							<h5 class="title">纠纷情况</h5>
							<p class="message">商品好不好，品质退款率早知道。服务好不好，纠纷退款率可明了。</p>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 单品服务分析 end -->

	<!-- 弹框 --查看趋势  start -->
	<div class="dialog-mask look-trend-dialog">
		<div class="dialog-locator">
			<div class="dialog-container">
				<div class="dialog-header">
					<button type="button" class="dialog-close close">x</button>
					<h4 class="dialog-title">自定义类目-家电/电脑/办公分类趋势图</h4>
				</div>
				<div class="dialog-content">
					<div class="trend-options orflow">
						<div class="operation" style="position:absolute;top:-44px;right:70px;z-index: 1;">
							<div class="date-text rt" style="margin-top: 5px;">2017-12-03 ~ 2017-12-09</div>
							<div class="select-control ui-selector rt">
								<a href="javascript:;">
									<span class="ui-selector-value">日期</span>
									<span class="caret icon"></span>
								</a>
								<ul class="ui-selector-list select-control-list" style="display: none;">
									<li class="ui-selector-item curr">
										<span>最近7天平均</span>
									</li>
									<li class="ui-selector-item">
										<span>最近30天平均</span>
									</li>
									<li class="ui-selector-item month">
										<span>月</span>
									</li>
								</ul>
							</div>
						</div>
						<div class="combopanel"><div class="combopanel-panel combo-panel-lite combo-panel-inline"><div class="combopanel-groups"><div class="group-wrapper"><div class="group clearfix"><span class="checkbox selected"><span class="option"></span><span class="name">商品数</span></span><span class="checkbox selected"><span class="option"></span><span class="name">访客数</span></span><span class="checkbox"><span class="option"></span><span class="name">引导点击转化率</span></span><span class="checkbox"><span class="option"></span><span class="name">引导支付转化率</span></span></div></div></div></div></div>
						<!-- <div class="combo-panel-lite combo-panel-inline lf">
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
						</div> -->
					</div>
					<div id="commonchart" class="commonchart" style="width: 970px;height: 380px;"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- 弹框 --查看趋势  end -->
	<!-- 弹框 --自定义规则  start -->
	<div class="dialog-mask defined-dialog">
		<div class="dialog-locator">
			<div class="dialog-container">
				<div class="dialog-header">
					<button type="button" class="dialog-close close">×</button>
					<h4 class="dialog-title">设置自定义规则</h4>
				</div>
				<div class="dialog-content">
					<div>
						<ul class="rules">
							<li class="clearfix name1 active">
								<span class="radio lf selected">
									<span class="option"></span>
									<span class="name">暂不使用自定义规则</span>
								</span>
							</li>
							<li class="clearfix name2">
								<span class="radio lf">
									<span class="option"></span>
									<span class="name">方案一</span>
								</span>
								<div class="lf formula">
									<span class="lf text">商品销量预估 =</span>
									<div class="select-control ui-selector lf">
										<a href="javascript:;">
											<span class="ui-selector-value">请选择加购指标</span>
											<span class="caret icon"></span>
										</a>
										<ul class="ui-selector-list select-control-list" style="display: none;">
											<li class="ui-selector-item curr">
												<span>请选择加购指标</span>
											</li>
											<li class="ui-selector-item">
												<span>最近180天累计加购件数</span>
											</li>
											<li class="ui-selector-item">
												<span>最近7天新增加购件数</span>
											</li>
										</ul>
									</div>
									<span class="lf symbol">
										<i class="lab-icon-fork"></i>
									</span>
									<input type="text" value="" class="lf value" placeholder="数值">
									<span class="lf symbol">%</span>
								</div>
								<div class="lf formula">
									<span class="lf text"><i class="lab-icon-ten"></i></span>
									<div class="select-control ui-selector lf">
										<a href="javascript:;">
											<span class="ui-selector-value">请选择收藏人数指标</span>
											<span class="caret icon"></span>
										</a>
										<ul class="ui-selector-list select-control-list" style="display: none;">
											<li class="ui-selector-item curr">
												<span>请选择收藏人数指标</span>
											</li>
											<li class="ui-selector-item">
												<span>最近180天累计收藏人数</span>
											</li>
											<li class="ui-selector-item">
												<span>最近7天收藏人数</span>
											</li>
										</ul>
									</div>
									<span class="lf symbol">
										<i class="lab-icon-fork"></i>
									</span>
									<input type="text" value="" class="lf value" placeholder="数值">
									<span class="lf symbol">%</span>
								</div>
							</li>
							<li class="clearfix name3">
								<span class="radio lf">
									<span class="option"></span>
									<span class="name">方案二</span>
								</span>
								<div class="lf formula">
									<span class="lf text">商品销量预估 =</span>
									<div class="select-control ui-selector lf">
										<a href="javascript:;">
											<span class="ui-selector-value">请选择最近销量指标</span>
											<span class="caret icon"></span>
										</a>
										<ul class="ui-selector-list select-control-list" style="display: none;">
											<li class="ui-selector-item curr">
												<span>请选择最近销量指标</span>
											</li>
											<li class="ui-selector-item">
												<span>最近1周销售件数</span>
											</li>
											<li class="ui-selector-item">
												<span>上上周销售件数</span>
											</li>
										</ul>
									</div>
									<span class="lf symbol">
										<i class="lab-icon-fork"></i>
									</span>
									<input type="text" value="" class="lf value" placeholder="数值">
									<span class="lf symbol">%</span>
								</div>
							</li>
						</ul>
						<div class="content">
							<p class="suggest-title">您的建议</p>
							<textarea class="desc-text" maxlength="512" placeholder="若以上方案都不适合您的店铺，请输入您建议的预估销量规则"></textarea>
							<div class="operate clearfix">
								<span class="lf error-msg"></span>
								<div class="rt">
									<button class="btn btn-blank btn-lg lf sans-serif">取消</button>
									<button class="btn btn-primary btn-lg lf sans-serif">确定</button>
								</div>
							</div>
						</div>
						<dl class="instructions">
							<dt class="title">配置说明</dt>
							<dd class="item"><span>1. 当预估销量≥在线库存时，我们会在页面上给出提示；</span></dd>
							<dd class="item">
								<span>2. 商品预估销量：可以基于加购件数、商品收藏人数来预估商品的销量；</span>
								<ul class="indexs-explan">
									<li>* 选择购物车指标：你可以基于累计加购件数，或新增加购件数来计算；</li>
									<li>* 选择收藏人数指标：你可以基于累计商品收藏人数，或新增商品收藏人数来计算；</li>
									<li>* 输入数值：您可以基于购物车、收藏夹的转化率经验值来设置系数，请输入＞0的数字，小数点后最多2位， 超出会被自动四舍五入成2位！</li>
								</ul>
							</dd>
							<dd class="item">
								<span>3. 商品销量预估估销量：也可以使用上周或上上周商品销售件数，同时基于经验什来填写系数，预测未来的销售件数；</span>
							</dd>
							<dd class="item"><span>例子：若您预计购物车会转化50%，请输入50；若您不需要收藏人数指标，不输入系数即可</span></dd>
						</dl>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 弹框 --自定义规则  end -->
</div>
	<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
	<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
	<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
	<script type="text/javascript">
		var tendencyChart = echarts.init(document.getElementById('tendency-chart'));
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
        tendencyChart.setOption(option);

		var commonChart = echarts.init(document.getElementById('commonchart'));
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
		// 商品效果--商品效果明细  点击 更多控制展开折叠
		$(".goods-effect-wrap .more-index").click(function(){
			$(".combo-panel-inline").toggleClass("changeH");
		})
		$(".combo-panel-lite .checkbox").click(function(){
			var _this = $(this);
			_this.toggleClass("selected");
			if(_this.parents(".combo-panel-lite").find(".selected").length > 5) {
				_this.parents(".combo-panel-lite").siblings(".error-message").text("最多选择5个指标");
			}else {
				_this.parents(".combo-panel-lite").siblings(".error-message").text("曝光量，点击次数，点击率暂只提供PC端数据");
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
		})

		// 异常商品---点击 ui-switch
		$(".goods-unusual-wrap .content").eq(0).show();
		$(".goods-unusual-wrap .ui-switch-item").click(function(){
			var _this = $(this);
			_this.addClass("active").siblings(".active").removeClass("active");
			var index = _this.index();
			$(".goods-unusual-wrap .content").hide();
			$(".goods-unusual-wrap .content").eq(index).show();
		})
		// 分类分析 start
		$(".goods-classify-wrap .table-body .row .open-btn").click(function(){
			var _this = $(this);
			_this.parents(".btn-wrap").parents(".col").parents(".row").toggleClass("active");
			if(_this.parents(".btn-wrap").parents(".row").siblings(".row").hasClass("active")){
				_this.parents(".btn-wrap").parents(".row").siblings(".active").removeClass("active");
			}
		})
			// 查看趋势 弹框
			$("a.overlook-trend").click(function(){
				$(".dialog-mask.look-trend-dialog").fadeIn(300);
			})
			$(".dialog-locator .close").click(function(){
				$(this).parents(".dialog-mask").hide();
			})
			// 商品分类引导化----- 判断有没有加减标
		$(".goods-classify-wrap .table .row").each(function(){
			var _this = $(this);
			if(_this.children(".row-children").length ===0 ){
				_this.children(".col-1").children(".btn-wrap").hide();
			}
		})
		$(".goods-analysis-container .navbar-panel .nav-bar .operation button").click(function(){
			$(".dialog-mask.defined-dialog").show();
		})

		// 单品分析 && 商品温度计 键入文字 弹出相关
		$(".input-search input").keyup(function(){
			$(this).parents(".input-search").siblings(".ui-suggestion-menu").show();
		})
		$(document).click(function(){
			$(".ui-suggestion-menu").hide();
			$(".ui-scroller").hide();
		})
		$(".ui-item-sgt-wrapper .input-search,.ui-suggestion-menu .ui-suggestion-item").click(function(e){
			e.stopPropagation();
		})
		$(".ui-item-sgt-wrapper .input-search .search-del").click(function(){
			var _this = $(this);
			_this.siblings(".ui-suggestion-search").val('');
			_this.parents(".input-search").siblings(".ui-suggestion-menu").hide();
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

		// 销量预测 
		var imgUrl = ['http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170927/1506478884804005.jpg',
						'http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170927/1506478892176559.jpg',
						'http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170927/1506478972115626.jpg',
						'http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170927/1506479108231424.jpg',
						'http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170927/1506479499794797.jpg',
						'http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170927/1506479608401228.jpg',
						'http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170915/1505469348124361.png',
						'http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170916/1505543841103788.png',
						'http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170916/1505530624119275.png',
						'http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170916/1505530869106606.png'
						]

			// 销量  ----   控制图片的大小*/
		var xl =['120', '30', '789', '3445486', '1203', '569650509', '15156656', '785', '562', '7930']
		var dArray = [];

		for(var z = 0; z < xl.length; z ++) {   // 把销量 改成 圆圈直径 放入数组 dArray 中， 80 100 120 按销量的长度
			var temp ;
			if( xl[z].length <= 2 ) {
				temp = 80;
			} else if (xl[z].length >= 5) {
				temp = 120;
			} else {
				temp = 100
			}
			dArray.push(temp)
		}

		var r = [];
		var containerW = 1040;
		var contianerH = 340;
		for(var i = 0; i < imgUrl.length; i ++) {
			var ok, x, y, d, currR;
			for(var j = 0; j < 600; j ++)  {
				ok = true;
				x = Math.floor(Math.random() * containerW);
				y = Math.floor(Math.random() * contianerH);
				d = dArray[i];
				// currR = d / 2;

				if(x >= containerW - d - 20 || x < 20 || y >= contianerH - d -10 || y < 10) continue;
				for(var k = 0; k < r.length; k ++) {
					// r = dArray[k] / 2;
					if( d > Math.pow(Math.pow(r[k][0]-x, 2) + Math.pow(r[k][1]-y, 2), .5)) ok = false;
				}
				if(ok) break;
			}
			// if(!ok) return;    // 不应该写d 而是 任意两个圆的半径和
			r.push([x, y])

			$(".random-content.xl-forecast").append('\
				<div class="img-circle-wrap" style="top:'+y+'px;left:'+x+'px;width:'+d+'px;height:'+d+'px">\
					<img src='+imgUrl[i]+'>\
					<div class="circle-pop-wrap">\
						<div class="tips-header clearfix">\
							<a target="_blank" href="javascript:;">\
								<img src="//img.alicdn.com/bao/uploaded/i3/TB1vJVIJVXXXXbNXpXXXXXXXXXX_!!0-item_pic.jpg_50x50.jpg" class="item-pic lf">\
							</a>\
							<div class="detail lf">\
								<p class="item-title">\
									<a target="_blank" href="javascript:;">床上用品磨毛四件套 学生三件套不掉色</a>\
								</p>\
								<div class="item-operate">\
									<button title="" class="btn btn-hollow monitor">+监控</button>\
									<button class="btn btn-hollow suggest">建议反馈</button>\
									<a href="javascript:;" target="_blank" class="procurement">采购进货</a>\
								</div>\
							</div>\
						</div>\
						<ul class="feature clearfix">\
							<li class="lf common"><p>系统预测未来7天销量</p><p class="num"><span>0</span></p></li>\
							<li class="lf custom"><p>自定义预测未来7天销量</p><p class="num"><span>12</span></p></li>\
						</ul>\
						<ul class="list">\
							<li class="clearfix header">\
								<div class="lf title"></div>\
								<div class="lf desc">加购件数</div>\
								<div class="lf desc">收藏人数</div>\
							</li>\
							<li class="clearfix content">\
								<div class="lf title">最近7天新增</div>\
								<div class="lf num">0</div>\
								<div class="lf num">0</div>\
							</li>\
							<li class="clearfix content">\
								<div class="lf title">最近180天累计</div>\
								<div class="lf num">1</div>\
								<div class="lf num">0</div>\
							</li>\
						</ul>\
					</div>\
				<div>'
			)
			$(".random-content.pricing-reference").append('\
				<div class="img-circle-wrap" style="top:'+y+'px;left:'+x+'px;width:'+d+'px;height:'+d+'px">\
					<img src='+imgUrl[i]+'>\
					<div class="item-overlay">\
						<div class="item-info clearfix">\
							<div class="pic lf">\
								<a class="box-img" target="_blank" title="" href="javascript:;">\
									<img src="//img.alicdn.com/bao/uploaded/i1/2683428516/TB2zolOXtyHJuJjSZFIXXXQTVXa_!!2683428516.jpg_120x120.jpg">\
								</a>\
							</div>\
							<div class="product lf">\
								<div class="title">\
									<a target="_blank" title="" href="javascript:;">正品玫琳凯彩妆盘套装 大彩妆镜盒（含产品和工具）多色眼影</a>\
								</div>\
								<div class="opt">\
									<span class="btn-refer">定价参考</span>\
								</div>\
							</div>\
						</div>\
						<div class="ref-info clearfix">\
							<div class="tag lf">\
								<p class="title">推荐功能标签</p>\
								<p class="value">\
									<span class="text">\
										<span class="left-arrow"></span>沉睡\
									</span>\
								</p>\
							</div>\
							<div class="divider lf"></div>\
							<div class="price lf">\
								<p class="title">推荐价格</p>\
								<p class="value sans-serif">699</p>\
							</div>\
						</div>\
						<div class="down-array-container">\
							<i class="down-array-outer"></i><i class="down-array-inner"></i>\
						</div>\
					</div>\
				<div>'
			)
		}
		
		$(".random-content .img-circle-wrap").mouseenter(function() {
			$(this).children(".circle-pop-wrap").show();
		}).mouseleave(function() {
			$(this).children(".circle-pop-wrap").hide();
		})
		$(".random-content .img-circle-wrap").mouseenter(function() {
			$(this).children(".item-overlay").show();
		}).mouseleave(function() {
			$(this).children(".item-overlay").hide();
		})
		$(".sales-voume-wrap .ui-switch.nav-tabs .ui-switch-item.ui-routable-item").click(function() {
			var _this = $(this);
			_this.addClass("active").siblings(".active").removeClass("active");
			var index = _this.index();
			_this.parents(".ui-switch.nav-tabs").siblings(".ui-switch-wrap").hide().eq(index).show();
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

	// 商品效果  联动 下拉框
		$(".goods-effect-wrap .filters .select-control.second-select").click(function() {
			var _this = $(this);
			var index;
			var text = _this.siblings(".fisrt-select").find(".ui-selector-value").text();
			_this.siblings(".fisrt-select").find(".ui-selector-item").each(function() {
				var inner_this = $(this);
				if (inner_this.find("span").text() === text) {
					index = inner_this.index();
				}
			})
			_this.find(".ui-selector-list").hide().eq(index).show();
		})
		$(".goods-effect-wrap .filters .select-control.fisrt-select .ui-selector-item").click(function() {
			var _this = $(this);
			if(_this.parents(".fisrt-select").siblings(".second-select").find(".ui-selector-val").text() !== '全部分类') {
				_this.parents(".fisrt-select").siblings(".second-select").find(".ui-selector-value").text("全部分类");
			}
		})
		$(".goods-effect-wrap .filters .select-control .ui-selector-children ul").each(function() {
			var _this = $(this);
			if(_this.html() !== '') {
				_this.parents(".select-control.second-select").find(".ui-selector-item").eq(_this.index()).find(".child-symbol").show();
			}
		})
		$(".goods-effect-wrap .filters .select-control.second-select .ui-selector-item").click(function() {
			var _this = $(this);
			if(_this.parents(".ui-selector-list").siblings(".ui-selector-children").css("display") === 'block') {
				_this.parents(".ui-selector-list").siblings(".ui-selector-children").hide();
			}
		})
		$(".goods-effect-wrap .filters .select-control.second-select .ui-selector-item").mouseenter(function() {
			var _this = $(this)
			if(_this.find(".child-symbol").css("display") === 'block') {
				var index = _this.index();
				_this.parents(".second-select").find(".ui-selector-children").show();
				_this.parents(".second-select").find(".ui-selector-children ul").hide().eq(index).show();
			} else {
				_this.parents(".second-select").find(".ui-selector-children").hide();
			}
		})
		$(".goods-effect-wrap .filters .select-control .ui-selector-children li").click(function(e) {
			e.stopPropagation();
			var _this = $(this);
			var text = _this.text();
			_this.parents(".ui-selector-children").hide();
			$(".ui-selector-list").css({"display": "none !important"})
			$(".goods-effect-wrap .filters .select-control.second-select .ui-selector-list ").each(function() {
				var inner_this = $(this);
				inner_this.hide();
			})
			$(".goods-effect-wrap .filters .select-control.second-select .ui-selector-value").text(text);
		})

	</script>
</html>

<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--商品温度计-->
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
				<li class="menu-item-inner lf curr">
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
	<!-- 商品温度计 start -->
	<div class="w-1040  rt goods-thermometer-main">
		<div>
			<h3 class="article-title">商品温度计</h3>
			<div class="mod-top">
				<a href="index.php?ctl=Seller_Sycm&met=singleProductAnalysis" class="btn btn-hollow btn-jump-between" target="_blank">
					<i class="icon-left-right"></i>
					<span>单品分析</span>
				</a>
				<div class="ui-item-sgt-wrapper ui-sgt-wrapper-right">
					<div class="btn-wrapper">
						<a class="btn btn-hollow sgt-btn">
							<i class="ui-sgt-icon-search"></i>
							<span>商品搜索</span>
						</a>
					</div>
					<div class="sgt-wrapper" style="display: none;">
						<div class="ui-suggestion open ui-item-sgt">
							<div class="ui-suggestion-input input-search">
								<input type="text" class="ui-suggestion-search" value="" placeholder="请输入您店铺内商品的关键词、商品ID 或粘贴商品URL，并在提示列表中选中目标商品">
								<i class="icon-search"></i>
								<span class="search-del">×</span>
							</div>
							<ul class="ui-suggestion-menu">
								<li class="ui-suggestion-item">
									<div class="result-wrapper">
										<img class="sgt-img" src="http://img01.taobaocdn.com/bao/uploaded///img.alicdn.com/bao/uploaded/i1/2683428516/TB2xRl.ceIPyuJjSspcXXXiApXa_!!2683428516.jpg_70x70.jpg" width="70" height="70">
										<p class="sgt-title">
											<span>蓓尔韩版亮片</span>
											<span class="dip-highlight">女</span>
											<span>帆布鞋松糕厚底懒人鞋</span>
											<span class="dip-highlight">女</span>
											<span>式休闲鞋白色乐福鞋</span>
										</p>
										<p class="sgt-info">
											<span class="publishTime">发布时间：<span>2017-08-01</span></span>
										</p>
									</div>
								</li>
								<li class="ui-suggestion-item">
									<div class="result-wrapper">
										<img class="sgt-img" src="http://img04.taobaocdn.com/bao/uploaded///img.alicdn.com/bao/uploaded/i4/2683428516/TB2bg_1XBAkyKJjy0FeXXadhpXa_!!2683428516.jpg_70x70.jpg" width="70" height="70">
										<p class="sgt-title">
											<span>2017新款潮时尚修身貉子毛领羽绒服</span>
											<span class="dip-highlight">女</span>
											<span>中长款白鸭绒羽绒衣</span>
										</p>
										<p class="sgt-info">
											<span class="publishTime">发布时间：<span>2017-07-17</span></span>
										</p>
									</div>
								</li>
								<li class="ui-suggestion-item">
									<div class="result-wrapper active">
										<img class="sgt-img" src="http://img01.taobaocdn.com/bao/uploaded///img.alicdn.com/bao/uploaded/i1/2683428516/TB2F3oTXA.OyuJjSszeXXXY.VXa_!!2683428516.jpg_70x70.jpg" width="70" height="70">
										<p class="sgt-title"><span>反季清仓韩版新款时尚白鸭绒衬衫领修身轻薄中长款羽绒服</span><span class="dip-highlight">女</span><span>外套潮</span></p>
										<p class="sgt-info">
											<span class="publishTime">发布时间：<span>2017-07-17</span></span>
										</p>
									</div>
								</li>
								<li class="ui-suggestion-item">
									<div class="result-wrapper">
										<img class="sgt-img" src="http://img02.taobaocdn.com/bao/uploaded///img.alicdn.com/bao/uploaded/i2/2683428516/TB2C4F1c_MlyKJjSZFFXXalVFXa_!!2683428516.jpg_70x70.jpg" width="70" height="70">
										<p class="sgt-title"><span>喜攀登新款乒乓球鞋男</span><span class="dip-highlight">女</span><span>鞋运动鞋比赛训练鞋跑鞋休闲鞋</span></p>
										<p class="sgt-info"><span class="publishTime">发布时间：<span>2017-07-29</span></span></p>
									</div>
								</li>
								<li class="ui-suggestion-item">
									<div class="result-wrapper">
										<img class="sgt-img" src="http://img02.taobaocdn.com/bao/uploaded///img.alicdn.com/bao/uploaded/i2/2683428516/TB2m0pMXJsmyKJjSZFvXXcE.FXa_!!2683428516.jpg_70x70.jpg" width="70" height="70" alt="2017冬季羽绒服女中长款大毛领新款潮加厚白鸭绒情侣女工装外套潮">
										<p class="sgt-title">
											<span>2017冬季羽绒服</span>
											<span class="dip-highlight">女</span>
											<span>中长款大毛领新款潮加厚白鸭绒情侣</span>
											<span class="dip-highlight">女</span>
											<span>工装外套潮</span>
										</p>
										<p class="sgt-info">
											<span class="publishTime">发布时间：<span>2017-07-17</span></span>
										</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="ui-item-panel lf ">
					<a class="item-img" href="javascript:;" title="" target="_blank">
						<img src="//img.alicdn.com/bao/uploaded/i3/2683428516/TB1nACBc.l7MKJjSZFDXXaOEpXa_!!0-item_pic.jpg_70x70.jpg" alt="">
					</a>
					<div class="item-info-wrapper">
						<a class="item-title" href="javascript:;" title="" target="_blank">新款复古金属半框平光镜9787 时尚超轻眼镜框文艺配近视眼镜架</a>
						<span class="time">发布时间：2017-09-05</span>
					</div>
				</div>
			</div>
			<div class="page-header">
				<div class="actions-tab rt mt-20">
					<div class="ui-switch">
						<ul class="ui-switch-menu orflow">
							<li class="curr ui-switch-item lf">
								<a href="javascript:;">无线</a>
							</li>
							<li class="ui-switch-item lf" style="border-right:1px solid #ddd;border-left:1px solid #ddd;">
								<a href="javascript:;">PC</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div>
				<!-- 无线 tab  start -->
				<div class="section">
					<div class="mod-conversion">
						<div class="navbar">
							<h4 class="navbar-header"><i class="icon-title"></i>商品转化</h4>
							<div class="date-text rt">2017-02-02 ~ 2015-02-02</div>
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
										<span>最近7天</span>
									</li>
									<li class="ui-selector-item">
										<span>最近30天</span>
									</li>
									<li class="ui-selector-item day">
										<span>日</span>
									</li>
								</ul>
							</div>
						</div>
						<div class="content">
							<div class="brief-info clearfix">
								<div class="main-box">
									<span class="uv-label">访客数</span>
									<span class="uv-value">
										<span class="value">0</span>
										<span class="uv-value-unit">人</span>
									</span>
									<span class="pv">浏览量：<span class="value">0</span>次</span>
								</div>
								<img class="big-arrow" src="//cbu01.alicdn.com/cms/upload/other/tbsycm/big-arrow.jpg" width="72" height="113">
								<ul class="long-box-list">
									<li class="long-box-item bounceOut clearfix">
										<span class="title-wrapper">
											<span class="title">离开</span>
										</span>
										<div class="sub-area bounce">
											<p class="label">离开店铺</p>
											<p class="detail">
												<span class="value-wrapper">
													<span class="value">0</span>
													<span class="unit">人</span>
												</span>
												<span class="percentage">占比 <span>-</span></span>
											</p>
										</div>
									</li>
									<li class="long-box-item indirect-convert clearfix">
										<span class="title-wrapper"><span class="title">间接转化</span></span>
										<div class="sub-area lead">
											<p class="label">引导至其它商品</p>
											<p class="detail">
												<span class="value-wrapper">
													<span class="value">0</span>
													<span class="unit">人</span>
												</span>
												<span class="percentage">占比 <span>-</span></span>
											</p>
										</div>
										<div class="sub-area marked">
											<p class="label">收藏</p>
											<p class="detail">
												<span class="value-wrapper">
													<span class="value">0</span>
													<span class="unit">人</span>
												</span>
												<span class="percentage">占比 <span>-</span></span>
											</p>
										</div>
									</li>
									<li class="long-box-item direct-convert clearfix">
										<span class="title-wrapper"><span class="title">直接转化</span></span>
										<div class="sub-area cart">
											<p class="label">加入购物车</p>
											<p class="detail">
												<span class="value-wrapper">
													<span class="value">0</span><span class="unit">人</span>
												</span>
												<span class="percentage">占比 <span>-</span></span>
											</p>
										</div>
										<div class="sub-area order">
											<p class="label">下单购买</p>
											<p class="detail">
												<span class="value-wrapper">
													<span class="value">0</span>
													<span class="unit">人</span>
												</span>
												<span class="percentage">占比 <span>-</span></span>
											</p>
										</div>
										<div class="sub-area pay">
											<p class="label">支付购买</p>
											<p class="detail">
												<span class="value-wrapper">
													<span class="value">0</span>
													<span class="unit">人</span>
												</span>
												<span class="percentage">占比 <span>-</span></span>
											</p>
										</div>
									</li>
								</ul>
							</div>
							<div class="data-desc">
								<span class="data-desc-icon7"></span>
								<div class="data-desc-panel">
									<div class="data-desc-box three-column">
										<div class="data-desc-header">
											<h4 class="title">离开店铺占比</h4>
										</div>
										<div class="data-desc-content">
											<p>亲，没有流量的商品连离开店铺也是一种奢侈，加强引流哦！<a href="javascript:;" target="_blank">同行引流&gt;&gt;</a></p>
										</div>
									</div>
									<div class="data-desc-box three-column">
										<div class="data-desc-header">
											<h4 class="title">间接转化</h4>
										</div>
										<div class="data-desc-content">
											<p>没有访客，转化无从谈起，赶紧加强引流！参考<a href="javascript:;" target="_blank">同行引流&gt;&gt;</a></p>
										</div>
									</div>
									<div class="data-desc-box three-column">
										<div class="data-desc-header">
											<h4 class="title">直接转化</h4>
										</div>
										<div class="data-desc-content"><p>没有访客，何来买家？给本商品引流是第一重任哦！参考<a href="javascript:;" target="_blank">同行引流&gt;&gt;</a></p></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="mod-scan">
						<div class="navbar">
							<h4 class="navbar-header"><i class="icon-title"></i>影响商品转化因素检测</h4>
						</div>
						<div class="content">
							<div>
								<div class="top-area clearfix">
									<a class="btn btn-lg btn-primary rt">
										<i class="icon-refresh-sign"></i>
										<span>重新检测</span>
									</a>
									<div class="top-info error">
										<i class="big-error"></i>
										<span class="top-info-text">待处理问题过多，强烈建议马上优化！</span>
									</div>
								</div>
								<div class="scan-tab-wrapper">
									<div class="scan-tab-inner-warpper clearfix">
										<ul class="scan-tab-list">
											<li class="scan-tab-item active">
												<div class="scan-tab">
													<span class="title">
														<span>页面性能</span>
													</span>
													<div class="info">
														<i class="icon"></i><span class="info-text">查看详情</span>
													</div>
												</div>
											</li>
											<li class="scan-tab-item warn">
												<div class="scan-tab">
													<span class="title">
														<span>标题</span>
														<i class="icon-dot"></i>
													</span>
													<div class="info">
														<i class="icon"></i><span class="info-text">2个问题需要处理</span>
													</div>
												</div>
											</li>
											<li class="scan-tab-item warn">
												<div class="scan-tab">
													<span class="title">
														<span>价格</span>
														<i class="icon-dot"></i>
													</span>
													<div class="info">
														<i class="icon"></i><span class="info-text">1个问题需要处理</span>
													</div>
												</div>
											</li>
											<li class="scan-tab-item warn">
												<div class="scan-tab">
													<span class="title">
														<span>属性</span>
														<i class="icon-dot"></i>
													</span>
													<div class="info">
														<i class="icon"></i><span class="info-text">1个问题需要处理</span>
													</div>
												</div>
											</li>
											<li class="scan-tab-item warn">
												<div class="scan-tab">
													<span class="title">
														<span>促销导购</span>
														<i class="icon-dot"></i>
													</span>
													<div class="info">
														<i class="icon"></i><span class="info-text">1个问题需要处理</span>
													</div>
												</div>
											</li>
											<li class="scan-tab-item warn">
												<div class="scan-tab">
													<span class="title">
														<span>描述</span>
														<i class="icon-dot"></i>
													</span>
													<div class="info">
														<i class="icon"></i><span class="info-text">1个问题需要处理</span>
													</div>
												</div>
											</li>
											<li class="scan-tab-item">
												<div class="scan-tab">
													<span class="title"><span>评价</span></span>
													<div class="info">
														<i class="icon"></i><span class="info-text">查看详情</span>
													</div>
												</div>
											</li>
										</ul>
										<div class="tab-content-wrapper">
											<div class="tab-content">
											<!-- 页面性能 tab -->
												<ul class="scan-list scan-page">
													<li class="scan-list-item ok"><p><i class="icon"></i><span>页面加载时长<span class="large">22秒，</span>低于同类商品平均加载时长60秒，请保持关注</span></p></li>
													<li class="scan-list-item ">
														<p>
															<i class="icon"></i>
															<span>建议关注高度或查看详情页结构化点击情况，调整详情页布局</span>
														</p>
														<div class="box">
															<span class="title">最近1天访问屏数分布</span>
															<div class="box-content">
																<div class="range my clearfix">
																	<span class="wdj-label">当前商品</span>
																	<div class="range-span clearfix">
																		<div class="no-data"><i class="icon icon-info"></i><span>暂无数据</span></div>
																	</div>
																</div>
																<div class="range cat clearfix">
																	<span class="wdj-label">同类商品</span>
																	<div class="range-span">
																		<span class="range-span-0" style="width: 100%;">100.00%</span>
																		<span class="range-span-1" style="width: 0%;">0.00%</span>
																		<span class="range-span-2" style="width: 0%;">0.00%</span>
																		<span class="range-span-3" style="width: 0%;">0.00%</span>
																	</div>
																</div>
																<div class="legend clearfix">
																	<div class="legend-item">
																		<span class="range-span-3"></span>10屏以上
																	</div>
																	<div class="legend-item">
																		<span class="range-span-2"></span>5-10屏
																	</div>
																	<div class="legend-item">
																		<span class="range-span-1"></span>3-5屏
																	</div>
																	<div class="legend-item"><span class="range-span-0"></span>1-2屏</div>
																</div>
																<p class="tip-info">说明：以上数据采用抽样计算，为更具参考意义，当前商品仅对访问量大于10的才纳入计算。</p>
															</div>
														</div>
													</li>
													<li class="scan-list-item action"><a class="btn btn-hollow" href="javascript:;" target="_blank">修改描述</a></li>
												</ul>
											<!-- 页面性能 tab end-->

											<!-- 标题 tab start -->
												<ul class="scan-list scan-title" style="display: none;">
													<li class="scan-list-item ok">
														<p><i class="icon"></i><span>标题长度<span class="large">30个字，</span>已填满，建议继续保持并突出商品卖点</span></p>
													</li>
													<li class="scan-list-item warn">
														<p><i class="icon"></i><span><span class="warn-text">标题中含有空格，</span>建议在保持标题的合理性下充分利用标题文字突出商品卖点</span></p>
													</li>
													<li class="scan-list-item warn">
														<p><i class="icon"></i><span><span class="warn-text">最近1天没有访客通过关键词来访当前商品，</span>建议同时参考行业热搜词，加强引流哦！</span></p>
														<div class="box">
															<div class="row">
																<div class="col-1-2">
																	<a class="more" href="javascript:;" target="_blank">更多&gt;&gt;</a>
																	<span class="title">最近1天来访top关键词</span>
																	<div class="no-data"><i class="icon"></i><span class="info-no-data">暂无相关数据！</span></div>
																</div>
																<div class="col-1-2">
																	<a class="more" href="javascript:;" target="_blank">更多&gt;&gt;</a><span class="title">最近1天行业热门词</span>
																	<ul class="top-keyword-list">
																		<li class="top-keyword-item"><span class="order-icon">1</span><span>热水器</span></li>
																		<li class="top-keyword-item"><span class="order-icon">2</span><span>电热水器</span></li>
																		<li class="top-keyword-item"><span class="order-icon">3</span><span>热水器 电 家用</span></li>
																		<li class="top-keyword-item"><span class="order-icon">4</span><span>电热水器 家用</span></li>
																		<li class="top-keyword-item"><span class="order-icon">5</span><span>海尔热水器</span></li>
																	</ul>
																</div>
															</div>
														</div>
													</li>
													<li class="scan-list-item action"><a class="btn btn-hollow" href="javascript:;" target="_blank">标题优化</a></li>
												</ul>
											<!-- 标题 tab end -->

											<!-- 价格 tab start -->
												<ul class="scan-list scan-price" style="display: none;">
													<li class="scan-list-item warn"
														><p><i class="icon"></i><span><span class="warn-text">当前商品的价格低于市场同类商品的主要价格带范围，</span>建议对同类最近7天成交商品价格分布的关注哦</span></p>
														<div class="box clearfix">
															<div class="table-mock clearfix">
																<div class="price-box">
																	<p class="title">当前商品价格</p>
																	<p class="price">
																		<span class="price-value">0</span>
																	</p>
																</div>
																<div class="price-range-box">
																	<div class="legend">
																		<span class="legend-block active"></span><span class="wdj-label">当前商品所在价格带（单位：元）</span>
																	</div>
																	<ul class="price-range">
																		<li class="price-range-block active" style="height: 31px;"><span class="percentage">15.00%</span><span class="wdj-label">0-574</span></li>
																		<li class="price-range-block" style="height: 41px;"><span class="percentage">20.00%</span><span class="wdj-label">574-999</span></li>
																		<li class="price-range-block" style="height: 61px;"><span class="percentage">30.00%</span><span class="wdj-label">999-1699</span></li>
																		<li class="price-range-block" style="height: 41px;"><span class="percentage">20.00%</span><span class="wdj-label">1699-2725</span></li>
																		<li class="price-range-block" style="height: 21px;"><span class="percentage">10.00%</span><span class="wdj-label">2725-4299</span></li>
																		<li class="price-range-block" style="height: 11px;"><span class="percentage">5.00%</span><span class="wdj-label">4299以上</span></li>
																	</ul>
																</div>
															</div>
														</div>
													</li>
													<li class="scan-list-item ok"><p><i class="icon"></i><span>当前商品已经采用折扣价出售，同类商品有81.61%采用折扣价出售，请继续保持</span></p></li>
													<li class="scan-list-item action"><a class="btn btn-hollow" href="http://upload.taobao.com/auction/publish/edit.htm?item_num_id=557937527391&amp;auto=false" target="_blank">调整价格</a></li>
												</ul>
											<!-- 价格 tab end -->

											<!-- 属性 tab start -->
												<ul class="scan-list scan-attribute"  style="display: none;">
													<li class="scan-list-item warn">
														<p><i class="icon"></i><span><span class="warn-text">当前商品的热门属性和市场热门属性不一致，</span>建议关注</span></p>
														<div class="box clearfix">
															<div class="col-1-3">
																<span class="title">热门属性</span>
																<ul class="keyword-list">
																	<li class="keyword-list-item">品牌</li>
																	<li class="keyword-list-item">最大容积</li>
																	<li class="keyword-list-item">款式</li>
																	<li class="keyword-list-item">系列</li>
																	<li class="keyword-list-item">能效等级</li>
																</ul>
															</div>
															<div class="col-2-3">
																<span class="title">我的商品</span>
																<ul class="keyword-list">
																	<li class="keyword-list-item">Midea/美的</li>
																	<li class="keyword-list-item">50L</li>
																	<li class="keyword-list-item">横式</li>
																	<li class="keyword-list-item">21W9S</li>
																	<li class="keyword-list-item">一级</li>
																</ul>
															</div>
															<div class="col-3-3">
																<span class="title">行业top修饰词</span>
																<ul class="keyword-list">
																	<li class="keyword-list-item">Haier/海尔,Midea/美的,Macro/万家乐,ARISTON/阿里斯顿,USATON/阿诗丹顿</li>
																	<li class="keyword-list-item">60L,50L,80L,40L,100L</li>
																	<li class="keyword-list-item">横式,立式</li>
																	<li class="keyword-list-item">X1,21WA1,D系列,Q6,R5</li>
																	<li class="keyword-list-item">一级,二级,三级,无,四级</li>
																</ul>
															</div>
														</div>
													</li>
													<li class="scan-list-item action">
														<a class="btn btn-hollow" href="javascript:;" target="_blank">修改属性</a>
													</li>
												</ul>
											<!-- 属性 tab end -->

											<!-- 促销导购 tab start -->
												<ul class="scan-list scan-sale" style="display: none;">
													<li class="scan-list-item warn">
														<p><i class="icon"></i><span><span class="warn-text">当前商品未作为心选搭配推荐的展示区域，</span>建议查看商品来源去向，结合商品间关联关系，马上使用 <a href="javascript:;" target="_blank">心选</a> ，提升商品间流量转化</span></p>
													</li>
													<li class="scan-list-item ok"><p><i class="icon"></i><span>描述区内没有促销商品，建议结合商品模板中的促销信息，查看商品来源去向，对促销区保持关注</span></p></li>
													<li class="scan-list-item action"><a class="btn btn-hollow" href="javascript:;" target="_blank">调整促销商品</a></li>
												</ul>
											<!-- 促销导购 tab end -->

											<!-- 描述 tab start -->
												<ul class="scan-list scan-description" style="display: none;">
													<li class="scan-list-item ok">
														<p><i class="icon"></i><span>描述区内有图片16张，正常，建议保持对页面性能的关注</span></p>
														<div class="box">
															<span class="title">图片数量</span>
															<div class="image-range clearfix">
																<div class="indicator" style="left: 21.3333%;"><i class="icon"></i><b class="label-my">我的：16张</b></div>
																<span class="label-range range-1">25</span>
																<span class="label-range range-2">60</span>
																<span class="image-range-block green">正常</span>
																<span class="image-range-block orange">偏多</span>
																<span class="image-range-block red">超多</span>
															</div>
														</div>
													</li>
													<li class="scan-list-item warn">
														<p>
															<span><a class="img-btn btn rt btn-success">一键优化</a></span><i class="icon"></i><span>描述区图片尺寸</span>
														</p>
														<div class="box clearfix">
															<div class="col-1-3">
																<div class="image-example-wrapper over-width">
																	<span class="wdj-label">超宽图片</span>
																	<span class="large">0张</span>
																</div>
															</div>
															<div class="col-1-3">
																<div class="image-example-wrapper over-dimension">
																	<span class="wdj-label">超大图片</span>
																	<span class="large warn">3张</span>
																</div>
															</div>
															<div class="col-1-3">
																<div class="image-example-wrapper over-height">
																	<span class="wdj-label">超高图片</span><span class="large">0张</span>
																</div>
															</div>
														</div>
													</li>
													<li class="scan-list-item ">
														<p><i class="icon"></i><span>建议根据同行详情模块点击情况，合理布局商品详情描述</span></p>
														<div class="box clearfix module-box">
															<div class="peer-module">
																<div class="col-1-2">
																	<span class="title">同行点击top5模块名称</span>
																	<ul class="click-list">
																		<li class="click-list-item">西门子售后</li>
																	</ul>
																</div>
																<div class="col-1-2">
																	<span class="title">最近7天点击次数</span>
																	<ul class="click-list">
																		<li class="click-list-item">15</li>
																	</ul>
																</div>
															</div>
														</div>
													</li>
													<li class="scan-list-item action"><a class="btn btn-hollow" href="javascript:;" target="_blank">修改描述</a></li>
												</ul>
											<!-- 描述 tab end -->

											<!-- 描述 tab start -->
												<ul class="scan-list scan-review" style="display: none;">
													<li class="scan-list-item ok">
														<p><i class="icon"></i><span>恭喜，店铺评价三线飘红，继续保持哦！</span></p>
														<div class="box clearfix">
															<div class="col-1-2">
																<span class="title">店铺动态评分</span>
																<ul class="dsr-list">
																	<li class="dsr-list-item">
																		<span class="wdj-label">描述相符：</span>
																		<span class="rate-block">
																			<span class="rate-block-inner" style="width: 96%;"></span>
																		</span>
																		<span class="rate-value">4.8</span>
																	</li>
																	<li class="dsr-list-item">
																		<span class="wdj-label">服务态度：</span>
																		<span class="rate-block">
																			<span class="rate-block-inner" style="width: 96%;"></span>
																		</span>
																		<span class="rate-value">4.8</span>
																	</li>
																	<li class="dsr-list-item">
																		<span class="wdj-label">物流服务：</span>
																		<span class="rate-block">
																			<span class="rate-block-inner" style="width: 96%;"></span>
																		</span>
																		<span class="rate-value">4.8</span>
																	</li>
																</ul>
															</div>
															<div class="col-1-2 peer-compare-list">
																<span class="title">与同行业相比</span>
																<ul class="dsr-list-peer">
																	<li class="dsr-list-peer-item"><span class="label-compare label-higher">高于</span><span class="dsr-value">28.8%</span></li>
																	<li class="dsr-list-peer-item"><span class="label-compare label-higher">高于</span><span class="dsr-value">12.59%</span></li>
																	<li class="dsr-list-peer-item"><span class="label-compare label-higher">高于</span><span class="dsr-value">15.09%</span></li>
																</ul>
															</div>
														</div>
													</li>
													<li class="scan-list-item ok">
														<p><i class="icon"></i><span>好评率100%高于同行平均100%，继续保持哦！</span></p>
														<div class="box review-list-box clearfix">
															<div class="no-data"><i class="icon"></i><span class="info-no-data">评价正在积累中，暂无积极或消极的评价关键词，请继续关注评价</span></div>
														</div>
													</li>
													<li class="scan-list-item action"><a class="btn btn-hollow" href="javascript:;" target="_blank">查看商品评价详情</a></li>
												</ul>
											<!-- 评价 tab end -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 无线 tab  end -->

				<!-- PC tab  start -->
				<div class="section" style="display: none;">
					<div class="wireless">
						<div class="mod-item">
							<div class="clearfix">
								<div class="item-baseinfo lf">
									<div class="base-box">
										<p class="name">最近1天浏览量</p>
										<p class="num value">0</p>
									</div>
									<div class="base-box">
										<p class="name">最近1天访客数</p>
										<p class="num value">0</p>
									</div>
								</div>
								<div class="detection rt clearfix">
									<div class="info lf clearfix">
										<div class="rt">
											<span class="text">
												<span>当前检测: </span>
												<span>无线手机描述版</span>
											</span>
											<span class="tips-wrap">
												<i class="icon icon-tips"></i>
												<div class="tips-guide-wrap" style="display: none;">
													指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
												</div>
											</span>
										</div>
									</div>
									<a href="javascript:;" class="btn btn-primary btn-lg rt" target="_blank">修改商品手机描述</a>
								</div>
							</div>
						</div>
						<div class="mod-main">
							<div class="obj-height">
								<div class="cell-header">
									<h1 class="title">描述区页面高度
										<span class="tips-wrap">
											<i class="icon icon-tips"></i>
											<div class="tips-guide-wrap" style="display: none;">
												指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
											</div>
										</span>
									</h1>
								</div>
								<div class="content clearfix">
									<div class="content-wrapper">
										<span class="icon-intro"></span>
										<ul class="list">
											<li>
												<span class="text">我的页面高度</span>
												<span class="bar" style="width: 133.594px;">
													<span class="bar-inner"></span>
												</span>
												<span class="value">
													<em class="num">18,997</em>像素(约<span>14屏)</span>
												</span>
											</li>
											<li>
												<span class="text">建议高度</span>
												<span class="bar" style="width: 100px;">
													<span class="bar-inner"></span>
												</span>
												<span class="value">
													<em class="num">14,220</em>像素(约<span>10</span>屏)
												</span>
											</li>
										</ul>
									</div>
									<div class="unscramble">
										<em>结论：</em>
										<div>
											<p>页面高度适中</p>
											<p>请继续保持</p>
										</div>
									</div>
								</div>
							</div>
							<div class="obj-image">
								<div class="cell-header">
									<h1 class="title">图片查看</h1>
								</div>
								<div class="content">
									<div class="content-wrapper">
										<span class="icon-intro"></span>
										<ul class="list">
											<li>
												<span class="text">总图片数量</span>
												<span class="bar" style="width: 200px;">
													<span class="bar-inner"></span>
												</span>
												<span class="value"><em class="num">16</em>张(<span>3.14</span>M)</span>
											</li>
											<li>
												<span class="text">最近7天放大查看图片次数</span>
												<span class="bar hide"></span>
												<span class="value"><em class="num">0</em>次</span>
											</li>
										</ul>
									</div>
									<div class="unscramble">
										<em>结论：</em>
										<div>
											<p>情况良好</p>
											<p>建议保持对图片的关注</p>
										</div>
									</div>
								</div>
							</div>
							<div class="obj-time">
								<div class="cell-header">
									<h1 class="title">页面打开时长</h1>
								</div>
								<div class="content clearfix">
									<div class="content-wrapper">
										<span class="icon-intro"></span>
										<ul class="list">
											<li>
												<span class="text">2G环境</span>
												<span class="bar" style="width: 200px;">
													<span class="bar-inner"></span>
												</span>
												<span class="value"><em class="num">85</em>秒</span>
											</li>
											<li>
												<span class="text">3G环境</span>
												<span class="bar" style="width: 105.882px;">
													<span class="bar-inner"></span>
												</span>
												<span class="value"><em class="num">45</em>秒</span>
											</li>
											<li>
												<span class="text">WiFi环境</span>
												<span class="bar" style="width: 54.1176px;">
													<span class="bar-inner"></span>
												</span>
												<span class="value"><em class="num">23</em>秒</span>
											</li>
											<li>
												<span class="text">最近7天访客平均停留时长</span>
												<span class="bar" style="width: 0px;">
													<span class="bar-inner"></span>
												</span>
												<span class="value"><em class="num">0</em>秒</span>
											</li>
										</ul>
									</div>
									<div class="unscramble">
										<em>结论：</em>
										<div>
											<p>流量引入不给力哦！</p>
											<p>建议查看<a href="javascript:;" target="_blank">流量来源</a>盘点并加强店铺流量引入</p>
											<p>或查看<a href="javascript:;" target="_blank">商品效果详情</a>，加强商品之间流量互导</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- PC tab  end -->
			</div>
		</div>
	<!-- 商品温度计 end -->
</div>
	<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
	<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
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

		// 点击 选项卡
		$(".mod-scan .content .scan-tab-wrapper .scan-tab-list").click(function(event) {
			var event = event || window.event;
			var target = event.target || event.srcElement;
			if (target.nodeName.toLowerCase() !== 'ul') {
				if(target.nodeName.toLowerCase() === 'li') {
					var index = $(target).index();
					$(target).parents(".scan-tab-list").siblings(".tab-content-wrapper").find("ul.scan-list").hide().eq(index).show();
				} else {
					var index = $(target).parents(".scan-tab-item").index();
					$(target).parents(".scan-tab-list").siblings(".tab-content-wrapper").find("ul.scan-list").hide().eq(index).show();
					$(target).parents(".scan-tab-item").addClass("active").siblings(".active").removeClass("active");
				}
			}
		})

		// 点击商品搜索
		$(".mod-top .btn-wrapper").click(function() {
			var _this = $(this);
			if(_this.hasClass("btn-wrapper-active")) {
				_this.removeClass("btn-wrapper-active");
				_this.siblings(".sgt-wrapper").hide();
			} else {
				_this.addClass("btn-wrapper-active");
				_this.siblings(".sgt-wrapper").show();
			}
		})
		//  点击x
		$(".mod-top .sgt-wrapper .search-del").click(function(event) {
			var event = event || window.event;
		  event.stopPropagation();
			var _this = $(this);
			if(_this.siblings(".ui-suggestion-search").val() !== '') {
				_this.siblings(".ui-suggestion-search").val('');
			} 
			_this.parents(".ui-suggestion-input.input-search").siblings("ul").hide();
		})

		// 点击 无线 or PC
		$(".page-header .actions-tab .ui-switch-menu").click(function(event) {
			var event = event || window.event;
			var target = event.target || event.srcElement;
			var index = $(target).parents("li.ui-switch-item").index()
			if(target.nodeName.toLowerCase() !== 'ul') {   // target ----> a
				$(target).parents(".ui-switch-item").addClass("curr").siblings(".ui-switch-item").removeClass("curr");
			}
			$(target).parents(".page-header").siblings("div").find(".section").hide().eq(index).show();
		})



		// 移入技巧图标 
		$(".icon-tips").mouseenter(function(){
			$(this).siblings(".tips-guide-wrap").show();
		}).mouseleave(function(){
			$(this).siblings(".tips-guide-wrap").hide();
		})

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
					if(inner_this.css("display") === 'block') {
						$(".select-control-list").hide();
					}
				})
				_this.children(".select-control-list").show();
			}
		});
			//  下拉
		$(".select-control-list .ui-selector-item").click(function(e) {
			var _this = $(this);
			_this.addClass("curr").siblings(".curr").removeClass("curr");
			_this.parents(".ui-selector").find(".ui-selector-value").text(_this.find("span").text());
			_this.parents(".select-control-list").hide();
		})
		// 下拉框 .....end
	</script>
</html>

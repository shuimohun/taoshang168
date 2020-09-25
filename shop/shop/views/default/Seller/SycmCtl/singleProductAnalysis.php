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
				<li class="menu-item-inner lf curr">
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
	<!-- 单品分析 start -->
	<div class="single-analysis-main w-1040 rt">
		<div>
			<h3 class="article-title">单品分析</h3>
			<div class="mod-top">
				<a href="index.php?ctl=Seller_Sycm&met=goodsThermometer" class="btn btn-hollow btn-jump-between" target="_blank">
					<i class="icon-left-right"></i>
					<span>商品温度计</span>
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
				<div class="ui-switch ui-switch-routable  nav-tabs">
					<ul class="ui-switch-menu">
						<li class="active ui-switch-item ui-routable-item">
							<a href="javascript:;">来源去向</a>
						</li>
						<li class="ui-switch-item ui-routable-item">
							<a href="javascript:;">销售分析</a>
						</li>
						<li class="ui-switch-item ui-routable-item">
							<a href="javascript:;">访客分析</a>
						</li>
						<li class="ui-switch-item ui-routable-item">
							<a href="javascript:;">促销分析</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="section">
				<!-- 来源去向 -->
				<div class="section-inner">
					<div>
						<div class="navbar">
							<h4 class="navbar-header"><i class="icon-title"></i>商品流量来源去向</h4>
						</div>
						<div class="content">
							<div class="jumbo-intro">
								<span class="icon"></span>
								<p class="order-desc">亲，您还未订购流量纵横，暂时无法使用！</p>
								<a href="javascript:;" class="btn">立即订购</a>
								<a href="javascript:;" class="preview-btn">功能预览&gt;</a>
							</div>
						</div>
					</div>
					<div class="mod-keyword">
						<div class="navbar">
							<h4 class="navbar-header"><i class="icon-title"></i>关键词效果分析</h4>
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
										<li class="ui-selector-item day">
											<span>日</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="content">
							<div>
								<div class="navbar searchbar">
									<div class="input-search lf" style="display: none;">
										<input type="text" class="" placeholder="请输入产品名称或关键词">
										<i class="icon-search"></i>
									</div>
									<div class="navbar-selector-sm pull-left">
										<div class="select-control ui-selector ">
											<a href="javascript:;">
												<span class="ui-selector-value">淘宝搜索</span>
												<span class="caret icon"></span>
											</a>
											<ul class="ui-selector-list select-control-list" style="display: none;">
												<li class="ui-selector-item curr">
													<span>淘宝搜索</span>
												</li>
												<li class="ui-selector-item">
													<span>天猫搜索</span>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="keyword-wrapper">
									<ul class="keyword-cate-list">
										<li class="search"><span>搜索曝光</span></li>
										<li class="flow"><i class="arrow"></i><span>引流效果</span></li>
										<li class="change"><i class="arrow"></i><span>转化效果</span></li>
									</ul>
									<ul class="keyword-title-list">
										<li class="keyword"><span class="name">关键词</span></li>
										<li class="index has-border orderable">
											<span class="name">搜索排名</span>
											<span class="order-flag asc"><i class="icon-order icon"></i></span>
										</li>
										<li class="index orderable">
											<span class="name">曝光量</span>
											<span class="order-flag"><i class="icon-order icon"></i></span>
										</li>
										<li class="index orderable">
											<span class="name">点击量</span>
											<span class="order-flag"><i class="icon-order icon"></i></span>
										</li>
										<li class="index orderable">
											<span class="name">点击率</span>
											<span class="order-flag"><i class="icon-order icon"></i></span>
										</li>
										<li class="index has-border orderable">
											<span class="name">浏览量</span>
											<span class="order-flag"><i class="icon-order icon"></i></span>
										</li>
										<li class="index orderable">
											<span class="name">访客数</span>
											<span class="order-flag"><i class="icon-order icon"></i></span>
										</li>
										<li class="index orderable">
											<span class="name">人均浏览量</span>
											<span class="order-flag"><i class="icon-order icon"></i></span>
										</li>
										<li class="index orderable">
											<span class="name">跳出率</span>
											<span class="order-flag"><i class="icon-order icon"></i></span>
										</li>
										<li class="index has-border orderable">
											<span class="name">支付买家数</span>
											<span class="order-flag"><i class="icon-order icon"></i></span>
										</li>
										<li class="index orderable">
											<span class="name">支付件数</span>
											<span class="order-flag"><i class="icon-order icon"></i></span>
										</li>
										<li class="index orderable">
											<span class="name">支付金额</span>
											<span class="order-flag"><i class="icon-order icon"></i></span>
										</li>
										<li class="index orderable">
											<span class="name">支付转化率</span>
											<span class="order-flag"><i class="icon-order icon"></i></span>
										</li>
									</ul>
									<div class="no-data-message">
										<div class="ui-message-empty">
											<p class="ui-message-content">
												<span class="noromal">
													<i class="icon"></i>
												</span>
												<span>亲，当前商品暂无由"淘宝搜索/天猫搜索"来源的关键词引进来的流量</span>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="mod-source-top">
						<div class="navbar">
							<h4 class="navbar-header"><i class="icon-title"></i>商品来源去向Top5</h4>
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
										<li class="ui-selector-item week">
											<span>周</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="content">
							<div class="clearfix">
								<div class="from-wrapper">
									<ul class="from-title-list clearfix">
										<li class="info">来源top5商品</li>
										<li class="index">访客数</li>
									</ul>
									<ul class="from-menu">
										<li>
											<div class="media">
												<span class="a-img pull-left">
													<i class="no-pic"></i>
												</span>
												<div class="media-body">
													<span>商品流量互导不给力，找到引流款给当前商品引流哦！</span>
												</div>
											</div>
											<p class="index">
												<a href="javascript:;" title="查看商品效果" target="_blank">查看商品效果</a>
											</p>
										</li>
										<li>
											<div class="media">
												<span class="a-img lf">
													<i class="no-pic"></i>
												</span>
												<div class="media-body">
													<span>商品流量互导不给力，找到引流款给当前商品引流哦！</span>
												</div>
											</div>
											<p class="index">
												<a href="javascript:;" title="查看商品效果" target="_blank">查看商品效果</a>
											</p>
										</li>
										<li>
											<div class="media">
												<span class="a-img lf">
													<i class="no-pic"></i>
												</span>
												<div class="media-body">
													<span>商品流量互导不给力，找到引流款给当前商品引流哦！</span>
												</div>
											</div>
											<p class="index">
												<a href="javascript:;" title="查看商品效果" target="_blank">查看商品效果</a>
											</p>
										</li>
										<li>
											<div class="media">
												<span class="a-img lf">
													<i class="no-pic"></i>
												</span>
												<div class="media-body">
													<span>商品流量互导不给力，找到引流款给当前商品引流哦！</span>
												</div>
											</div>
											<p class="index">
												<a href="javascript:;" title="查看商品效果" target="_blank">查看商品效果</a>
											</p>
										</li>
										<li>
											<div class="media">
												<span class="a-img lf">
													<i class="no-pic"></i>
												</span>
												<div class="media-body">
													<span>商品流量互导不给力，找到引流款给当前商品引流哦！</span>
												</div>
											</div>
											<p class="index">
												<a href="javascript:;" title="查看商品效果" target="_blank">查看商品效果</a>
											</p>
										</li>
									</ul>
								</div>
								<div class="curr-item">
									<p class="desc sans-serif">当前宝贝</p>
									<div class="media">
										<a class="a-img" href="javascript:;" title="" target="_blank">
											<img class="media-object" src="//img.alicdn.com/bao/uploaded/i3/2683428516/TB1nACBc.l7MKJjSZFDXXaOEpXa_!!0-item_pic.jpg_70x70.jpg" alt="">
										</a>
										<div class="media-body">
											<a href="javascript:;" title="" target="_blank">新款复古金属半框平光镜9787 时尚超轻眼镜框文艺配近视眼镜架</a>
										</div>
									</div>
								</div>
								<div class="to-wrapper">
									<ul class="to-title-list clearfix">
										<li class="info">去向top5商品</li>
										<li class="index">访客数</li>
									</ul>
									<ul class="to-menu">
										<li>
											<div class="media">
												<span class="a-img pull-left">
													<i class="no-pic"></i>
												</span>
												<div class="media-body">
													<span>商品流量互导不给力，设置合适的促销商品哦！</span>
												</div>
											</div>
											<p class="index">
												<a href="javascript:; title="立即设置" target="_blank">立即设置</a>
											</p>
										</li>
										<li>
											<div class="media">
												<span class="a-img pull-left">
													<i class="no-pic"></i>
												</span>
												<div class="media-body">
													<span>商品流量互导不给力，设置合适的促销商品哦！</span>
												</div>
											</div>
											<p class="index">
												<a href="javascript:; title="立即设置" target="_blank">立即设置</a>
											</p>
										</li>
										<li>
											<div class="media">
												<span class="a-img pull-left">
													<i class="no-pic"></i>
												</span>
												<div class="media-body">
													<span>商品流量互导不给力，设置合适的促销商品哦！</span>
												</div>
											</div>
											<p class="index">
												<a href="javascript:; title="立即设置" target="_blank">立即设置</a>
											</p>
										</li>
										<li>
											<div class="media">
												<span class="a-img pull-left">
													<i class="no-pic"></i>
												</span>
												<div class="media-body">
													<span>商品流量互导不给力，设置合适的促销商品哦！</span>
												</div>
											</div>
											<p class="index">
												<a href="javascript:; title="立即设置" target="_blank">立即设置</a>
											</p>
										</li>
										<li>
											<div class="media">
												<span class="a-img pull-left">
													<i class="no-pic"></i>
												</span>
												<div class="media-body">
													<span>商品流量互导不给力，设置合适的促销商品哦！</span>
												</div>
											</div>
											<p class="index">
												<a href="javascript:; title="立即设置" target="_blank">立即设置</a>
											</p>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 销售趋势 -->
				<div class="section-inner" style="display: none;">
					<div class="mod mod-sale-trend">
						<div class="navbar">
							<h4 class="navbar-header"><i class="icon-title"></i>销售趋势</h4>
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
								<div class="date-text rt">2017-02-02 ~ 2017-02-02</div>
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
						</div>
						<div class="content">
							<div class="chart-container">
								<div class="period-chart" id="period-chart" style="width: 980px;height: 320px;margin:0 auto;"></div>
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
					<div class="mod mod-sku-list">
						<div class="navbar">
							<h4 class="navbar-header"><i class="icon-title"></i>SKU销售详情</h4>
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
						</div>
						<div class="content clearfix">
							<ul class="menu clearfix">
								<li class="sku-name">SKU信息</li>
								<li class="sku-price index">价格</li>
								<li class="sku-stock index">当前库存</li>
								<li class="index orderable">
									<span class="name">新增加购件数</span>
									<span class="order-flag desc">
										<i class="icon-order icon"></i>
									</span>
								</li>
								<li class="index orderable">
									<span class="name">下单件数</span>
									<span class="order-flag"><i class="icon-order icon"></i></span>
								</li>
								<li class="index orderable">
									<span class="name">下单买家数</span>
									<span class="order-flag"><i class="icon-order icon"></i></span>
								</li>
								<li class="index orderable"><span class="name">支付件数</span><span class="order-flag"><i class="icon-order icon"></i></span></li>
								<li class="index orderable"><span class="name">支付买家数</span><span class="order-flag"><i class="icon-order icon"></i></span></li>
								<li class="handle">操作</li>
							</ul>
							<div class="no-data-message">
								<div class="ui-message-empty">
									<p class="ui-message-content">
										<span class="noromal">
											<i class="icon"></i>
										</span>
										<span>亲，当前商品暂无由"淘宝搜索/天猫搜索"来源的关键词引进来的流量</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 销售趋势 -->
				<div class="section-inner" style="display: none;">
					<div class="mod mod-period">
						<div class="navbar">
							<div class="operation-actions rt">
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
											<span>最近7天平均</span>
										</li>
										<li class="ui-selector-item day">
											<span>日</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="content">
							<div class="item-list time-interval">
								<h4 class="item-title sans-serif">来访24小时趋势图
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</h4>
								<div class="container">
									<div class="sub-container">
										<div class="interview-24" id="interview-24" style="width:420px;height: 180px;margin: 0 auto;"></div>
										<!-- <p class="no-data-info sans-serif">
											<span>这个商品没有访客，建议</span><a href="javascript:;" target="_blank">查看流量地图</a><span>，参考同行引流方式，加强引流哦！</span>
										</p> -->
									</div>
								</div>
							</div>

							<div class="item-list time-interval right">
								<h4 class="item-title sans-serif">地域top5
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</h4>
								<div class="container">
									<div class="sub-container area">
										<div>
											<div class="left-short"></div>
											<div class="right">
												<ul class="list-header">
													<li class="col col-area">地域</li>
													<li class="col col-count">访客数</li>
													<li class="col col-rate">下单转换率</li>
												</ul>
												<ul></ul>
											</div>

											<!-- <p class="no-data-info sans-serif">这个商品大江南北均无来访，建议<a href="javascript:;" target="_blank">查看流量地图</a>，参考同行引流方 式，加强引流哦！</p> -->
										</div>
									</div>
								</div>
							</div>

							<div class="item-list time-interval">
								<h4 class="item-title sans-serif">店铺新老访客
									<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
								</h4>
								<div class="container">
									<div class="sub-container visitor">
										<div class="left short">
											<ul class="obj-header clearfix">
												<li class="item"><span class="square" style="background-color: rgb(107, 203, 202);"></span><span class="word">新客户</span></li>
												<li class="item"><span class="square" style="background-color: rgb(159, 210, 115);"></span><span class="word">老客户</span></li>
											</ul>
											<div class="obj-content" id="visitors-chart" style="width:155px;height: 95px;"></div>
										</div>
										<div class="right">
											<ul class="list-header clearfix">
												<li class="col-name">访客类型</li>
												<li class="col-count">访客数</li>
												<li class="col-rate">下单转化率</li>
											</ul>
											<ul>
												<li class="list clearfix">
													<p class="title">
														<span class="square" style="background-color: rgb(107, 203, 202);"></span>
														<span class="word">新访客</span>
													</p>
													<p class="bar number">1</p>
													<p class="per number">0.00%</p>
												</li>
												<li class="list clearfix">
													<p class="title">
														<span class="square" style="background-color: rgb(159, 210, 115);"></span>
														<span class="word">老访客</span>
													</p>
													<p class="bar number">0</p>
													<p class="per number">0.00%</p>
												</li>
											</ul>
										</div>
										<!-- <p class="no-data-info sans-serif">老访客一去不回，新访客没有到访，加强引流哦!</p> -->
									</div>
								</div>
							</div>

							<div class="item-list time-interval right"><h4 class="item-title sans-serif">性别
								<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
							</h4>
								<div class="container">
									<div class="sub-container gender">
										<ul class="list-header">
											<li class="col-name">性别</li>
											<li class="col-count">访客数</li>
											<li class="col-rate">占比</li>
											<li class="col-rate">下单转化率</li>
										</ul>
										<ul>
											<li class="list clearfix">
												<p class="title">男</p>
												<p class="bar no0">
													<span class="num number">1</span>
													<span class="bar-line">
														<span class="line" style="width: 100%;"></span>
													</span>
												</p>
												<p class="per number">100.00%</p>
												<p class="per number">0.00%</p>
											</li>
											<li class="list clearfix">
												<p class="title">女</p>
												<p class="bar no1">
													<span class="num number">0</span>
													<span class="bar-line">
														<span class="line" style="width: 0%;"></span>
													</span>
												</p>
												<p class="per number">0.00%</p>
												<p class="per number">0.00%</p>
											</li>
											<li class="list clearfix">
												<p class="title">未知</p>
												<p class="bar no2">
													<span class="num number">0</span>
													<span class="bar-line">
														<span class="line" style="width: 0%;"></span>
													</span>
												</p>
												<p class="per number">0.00%</p>
												<p class="per number">0.00%</p>
											</li>
											<!-- <p class="no-data-info sans-serif">
												<span>这个商品没有访客，建议</span>
												<a href="javascript:;" target="_blank">查看流量地图</a><span>，参考同行引流方式，加强引流哦！</span>
											</p> -->
										</ul>
									</div>
								</div>
							</div>

							<div class="item-list time-interval"><h4 class="item-title sans-serif"><span>淘气值分布</span>
								<span class="tips-wrap">
										<i class="icon icon-tips"></i>
										<div class="tips-guide-wrap">
											指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
										</div>
									</span>
							</h4>
								<div class="container">
									<div class="sub-container member">
										<ul class="list-header">
											<li class="col-name">淘气值</li>
											<li class="col-count">访客数</li>
											<li class="col-rate order">占比</li>
											<li class="col-rate">下单转化率</li>
										</ul>
										<ul class="clearfix">
											<li class="list clearfix">
												<p class="title" title="T2">501-600</p>
												<p class="bar">
													<span class="num number">1</span>
													<span class="bar-line">
														<span class="line" style="width: 100%; background: rgb(255, 166, 11);"></span>
													</span>
												</p>
												<p class="per rate number">100.00%</p>
												<p class="per number">0.00%</p>
											</li>
											<!-- <p class="no-data-info sans-serif"><span>这个商品没有访客，建议</span><a href="javascript:;" target="_blank">查看流量地图</a><span>，参考同行引流方式，加强引流哦！</span></p> -->
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 促销分析 -->
				<div class="section-inner" style="display: none;">
					<div class="mod mod-trend">
						<div class="navbar">
							<h4 class="navbar-header"><i class="icon-title"></i>商品流量来源去向</h4>
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
							</div>
						</div>

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

						<div class="mod mod-desc-promotion">
							<div class="navbar"><h4 class="navbar-header"><i class="icon-title"></i><span>描述区促销分析</span></h4></div>
							<div class="mod-desc-sale clearfix">
								<div class="content clearfix mt12">
									<div class="title bs-border-box sans-serif pull-left"><div class="t-layout"><h3>导购商品总数</h3><span>0</span></div></div>
									<div class="detail pull-left bs-border-box">
										<div class="scroll-page-picker pv-guide-item bs-border-box pull-left">
											<div class="offer-title sans-serif pull-left">
												<h4>最近7天</h4>
												<h4>有点击导购商品</h4>
												<span class="num guide-num">0</span>
											</div>
											<div class="top-data-content">
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
											</div>
										</div>
										<div class="scroll-page-picker no-pv-guide-item bs-border-box pull-left">
											<div class="offer-title sans-serif pull-left">
												<h4>最近7天</h4>
												<h4>无点击导购商品</h4>
												<span class="num guide-no-num">0</span>
											</div>
											<div class="top-data-content">
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
											</div>
										</div>
									</div>
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
			</div>
		</div>
	</div>
	<!-- 单品分析 end -->
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
<script type="text/javascript">
	var periodChart = echarts.init(document.getElementById('period-chart'));
	// 指定图表的配置项和数据
 	var colors = ['#34a0e7','#7f9e65'];
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
	                name: '下单件数',
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
	                name: '商品访客数',
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
	            }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        periodChart.setOption(option);

	var interview24 = echarts.init(document.getElementById('interview-24'));
	// 指定图表的配置项和数据
 	var colors = ['#34a0e7','#7f9e65'];
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
             grid: {
		        bottom: '12%',
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
	                name: '访客数',
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
	                name: '下单买家数',
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
	            }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        interview24.setOption(option);

	var visitorsChart = echarts.init(document.getElementById('visitors-chart'));
    	var colors = ["#6fcbc9","#98cd6d"];
    	option = {
		    series : [
		        {
		            type: 'pie',
		            radius : '85%',
		            center: ['40%', '50%'],
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
		                	value:1, 
		                	name:'新访客',
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
		                	value:0, 
		                	name:'老访客',
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
		visitorsChart.setOption(option);
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

	$(".single-analysis-main .page-header .ui-switch-routable li").click(function() {
		var _this = $(this);
		_this.addClass("active").siblings(".active").removeClass("active");
		var index = _this.index();
		_this.parents(".page-header").siblings(".section").children(".section-inner").hide().eq(index).show();
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

	// 点击 无线 or PC
	$(".page-header .actions-tab .ui-switch-menu").click(function(event) {
		var event = event || window.event;
		var target = event.target || event.srcElement;
		var index = $(target).parents("li.ui-switch-item").index()
		if(target.nodeName.toLowerCase() !== 'ul') {   // target ----> a
			$(target).parents(".ui-switch-item").addClass("curr").siblings(".ui-switch-item").removeClass("curr");
		}
		// $(target).parents(".page-header").siblings("div").find(".section").hide().eq(index).show();
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

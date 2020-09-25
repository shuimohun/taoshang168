<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--营销-->
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/swiper.css">
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
				<li class="nav-item lf ">
					<a href="index.php?ctl=Seller_Sycm&met=service">
						服务
					</a>
				</li>
				<li class="nav-item lf">
					<a href="index.php?ctl=Seller_Sycm&met=logistics">
						物流
					</a>
				</li>
				<li class="nav-item lf curr">
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
						<p>营销分析</p>
					</div>
				</div>
				<ul class="menu-list-inner">
					<li class="menu-item-inner lf curr">
						<div class="selected-mask"></div>
						<a href="javascript:;" class="name-wrapper">
							<span class="name">营销工具</span>
						</a>
					</li>
					<li class="menu-item-inner lf">
						<div class="selected-mask"></div>
						<a href="javascript:;" class="name-wrapper">
							<span class="name">营销效果</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- 营销工具 start -->
		<div class="w-1040 basic-switch rt switch-wrap marketing-container">
			<div class="inner-ground">
				<div class="item-header">
					<ul class="tab-menu">
						<li class="lf active">
							<a href="#">创意营销</a>
						</li>
						<li class="lf">
							<a href="#">爱上聚划算</a>
						</li>
					</ul>
				</div>
				<div class="line"></div>
				<div class="switch-wrap-2">
					<div class="sub-header">
						<ul class="ui-tab-wrapper wrapper-cols3">
							<li class="active ui-switchable">
								<a href="#" class="word">单品营销</a>
							</li>
							<li class="ui-switchable">
								<a href="#" class="word">多品套餐</a>
							</li>
							<li class="ui-switchable">
								<a href="#" class="word">全店优惠</a>
							</li>
						</ul>
					</div>
					<div class="ui-switchable-wrap">
						<div class="mod-choose-item mod-choose">
							<div class="cell-header">
								<i class="icon-choose-item icon lf"></i>
								<h3 class="title rt">第一步 选宝贝</h3>
							</div>
							<div class="content">
								<div class="swiper-container">
									<div class="swiper-wrapper">
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel checked">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									  <!-- 如果需要导航按钮 -->
								    <div class="swiper-button-prev"></div>
								    <div class="swiper-button-next"></div>
								</div>
							</div>
							<div class="mod-unscramble">
								<ul class="cell-lists">
									<li class="col-3 glass">
										<div class="list">
											<h2>数据解读</h2>
											<p class="textF">根据浏览、收藏、下单、支付、宝贝本身的特征等数据，为亲掐指一算，这几个宝贝潜力还可以！</p>
											<p class="textS">
												再通过营销推广一把，提高流量，促成转化吧。
											</p>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="mod-choose-people mod-choose">
							<div class="cell-header">
								<i class="icon-choose-item icon lf"></i>
								<h3 class="title rt">第二步 选人群</h3>
								<a href="#" class="rt download">
									<span class="download-sec">
										<i class="icon icon-download"></i>
										<span class="val">下载</span>
									</span>
								</a>
							</div>
							<div class="content">
								<div class="recom-people lf">
									<p class="name">推荐人群</p>
									<p class="value">
										<span class="num">0人</span>
									</p>
								</div>
								<div class="people-distri lf">
									<h4>人群分布</h4>
									<div class="pie-box">
										
									</div>
									<ul class="pie-legend">
										<li class="lf">
											<p class="name">
												<span class="color-old"></span>老访客
											</p>
											<p class="num">0</p>
										</li>
										<li class="lf">
											<p class="name">
												<span class="color-new"></span>新访客
											</p>
											<p class="num">0</p>
										</li>
									</ul>
								</div>
								<div class="people-purchase-power lf">
									<h4>人群购买</h4>
									<ul class="distri-lists"></ul>
								</div>
								<div class="people-feature lf">
									<h4>人群特征</h4>
									<div class="feature-box" style="position: relative;"></div>
								</div>
							</div>
							<div class="mod-unscramble">
								<ul class="cell-lists">
									<li class="col-3 glass">
										<div class="list">
											<h2>数据解读</h2>
											<p >吭哧吭哧的找了一圈，暂时还没有为亲找到合适的人群呢，亲可以先用上述方案开始营销，说不定会引来好的客户呢。</p>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="mod-choose-tool mod-choose">
							<div class="cell-header">
								<i class="icon-choose-item icon lf"></i>
								<h3 class="title rt">第三步 选营销工具</h3>
							</div>
							<div class="content">
								<div class="item-coupon lf">
									<h4>购物车营销</h4>
									<div class="coupon-info single">
										<i class="icon icon-coupon lf"></i>
										<div class="coupon-text lf">
											<p class="text">还能创建的购物车营销</p>
											<p class="value">
												<em class="num">0</em>张
											</p>
										</div>
									</div>
									<div class="recom-text">
										<p class="name lf">推荐理由：</p>
										<p class="text lf">综合宝贝的特征，人群的偏好等数据，没有比购物车营销更合适的营销方式啦，为了营业额攀升一个新的高峰，亲不妨一试。</p>
									</div>
								</div>
								<div class="coupon-condition lf">
									<h4>同行使用宝贝优惠券的情况</h4>
									<div id="pieBox-ticket-chart" class="pie-box lf" style="width: 280px;height: 180px;"></div>
									<ul class="pie-legend lf"></ul>
								</div>
							</div>
						</div>
						<a href="index.php?ctl=Seller_Sycm&met=spm" class="create-btn temp-btn" target="_blank">立即生成营销方案</a>
					</div>
					<div class="ui-switchable-wrap">
						<div class="mod-choose-item mod-choose">
							<div class="cell-header">
								<i class="icon-choose-item icon lf"></i>
								<h3 class="title rt">第一步 选宝贝</h3>
							</div>
							<div class="content">
								<div class="swiper-container">
									<div class="swiper-wrapper">
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel checked">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-slide" style="height: 248px;">
											<div class="single-item ui-switchable-panel">
												<i class="icon icon-checked"></i>
												<div class="display">
													<dl class="cell-product-h orflow">
														<dt class="vertical-img">
															<a href="#" class="box-img">
																<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
															</a>
														</dt>
														<dd class="desc">
															<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
														</dd>
													</dl>
													<div class="price-block">
														<div class="price lf">
															<p class="name">价格</p>
															<p class="value num">
																￥60.<span class="small">00</span>
															</p>
														</div>
														<div class="price-section lf">
															<ul class="price-list">
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 12%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 70%;"></p>
																</li>
																<li class="price-col lf">
																	<p class="col" style="height: 20%;"></p>
																</li>
															</ul>
															<div class="arrow-box">
																<p>
																	<em class="count">15121</em>相似宝贝
																</p>
																<p>
																	价格在<span class="section">89.0-120.0</span>
																</p>
															</div>
														</div>
													</div>
													<p class="recom-index star-1">
														<span class="arrow-box">推荐指数</span>
													</p>
												</div>
												<div class="index">
													<div class="uv lf">
														<p class="name">昨日访客数</p>
														<p class="value num">0</p>
													</div>
													<div class="paycpr lf">
														<p class="name">昨日支付转化率</p>
														<p class="num value">0%</p>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									  <!-- 如果需要导航按钮 -->
								    <div class="swiper-button-prev"></div>
								    <div class="swiper-button-next"></div>
								</div>
							</div>
							<div class="mod-unscramble">
								<ul class="cell-lists">
									<li class="col-3 glass">
										<div class="list">
											<h2>数据解读</h2>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="mod-choose-people mod-choose">
							<div class="cell-header">
								<i class="icon-choose-item icon lf"></i>
								<h3 class="title rt">第二步 选人群</h3>
								<a href="#" class="rt download">
									<span class="download-sec">
										<i class="icon icon-download"></i>
										<span class="val">下载</span>
									</span>
								</a>
							</div>
							<div class="content"></div>
							<div class="mod-unscramble">
								<ul class="cell-lists">
									<li class="col-3 glass">
										<div class="list">
											<h2>数据解读</h2>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="mod-choose-tool mod-choose">
							<div class="cell-header">
								<i class="icon-choose-item icon lf"></i>
								<h3 class="title rt">第三步 选营销工具</h3>
							</div>
							<div class="content"></div>
						</div>
					</div>
					<div class="ui-switchable-wrap">
						<div class="mod-choose-item mod-choose">
							<div class="cell-header">
								<i class="icon-choose-item icon lf"></i>
								<h3 class="title rt">第一步 选宝贝</h3>
							</div>
							<div class="content">
								<div class="item-paypct lf">
									<div class="paypct-info orflow">
										<i class="lf icon-paypct"></i>
										<div class="last-paypct lf">
											<p class="text">最近1天我的客单价</p>
											<p class="value">
												<em class="num">0</em>
												<em class="rate unknown">
													<i class="icon-trend"></i>-
												</em>
											</p>
										</div>
									</div>
									<div class="industry-paypct">
										<div class="index lf">
											<p class="name">
												最近1天同行平均客单价
											</p>
											<p class="num value">$21.00</p>
										</div>
										<div class="index lf">
											<p class="name">
												最近1天同行优秀客单价
											</p>
											<p class="num value">$21.00</p>
										</div>
									</div>
								</div>
								<div class="item-section lf">
									<div id="shop-baobei-chart" class="shop-baobei-chart" style="width: 380px;height: 180px;">
										
									</div>
								</div>
							</div>
							<div class="mod-unscramble">
								<ul class="cell-lists">
									<li class="col-3 glass">
										<div class="list">
											<h2>数据解读</h2>
											<p class="textF">根据浏览、收藏、下单、支付、宝贝本身的特征等数据，为亲掐指一算，这几个宝贝潜力还可以！</p>
											<p class="textS">
												再通过营销推广一把，提高流量，促成转化吧。
											</p>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="mod-choose-people mod-choose">
							<div class="cell-header">
								<i class="icon-choose-item icon lf"></i>
								<h3 class="title rt">第二步 选人群</h3>
								<a href="#" class="rt download">
									<span class="download-sec">
										<i class="icon icon-download"></i>
										<span class="val">下载</span>
									</span>
								</a>
							</div>
							<div class="content">
								<div class="recom-people lf">
									<p class="name">推荐人群</p>
									<p class="value">
										<span class="num">0人</span>
									</p>
								</div>
								<div class="people-distri lf">
									<h4>人群分布</h4>
									<div class="pie-box">
										
									</div>
									<ul class="pie-legend">
										<li class="lf">
											<p class="name">
												<span class="color-old"></span>老访客
											</p>
											<p class="num">0</p>
										</li>
										<li class="lf">
											<p class="name">
												<span class="color-new"></span>新访客
											</p>
											<p class="num">0</p>
										</li>
									</ul>
								</div>
								<div class="people-purchase-power lf">
									<h4>人群购买</h4>
									<ul class="distri-lists"></ul>
								</div>
								<div class="people-feature lf">
									<h4>人群特征</h4>
									<div class="feature-box" style="position: relative;"></div>
								</div>
							</div>
							<div class="mod-unscramble">
								<ul class="cell-lists">
									<li class="col-3 glass">
										<div class="list">
											<h2>数据解读</h2>
											<p >吭哧吭哧的找了一圈，暂时还没有为亲找到合适的人群呢，亲可以先用上述方案开始营销，说不定会引来好的客户呢。</p>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="mod-choose-tool mod-choose">
							<div class="cell-header">
								<i class="icon-choose-item icon lf"></i>
								<h3 class="title rt">第三步 选营销工具</h3>
							</div>
							<div class="content">
								<div class="item-coupon lf">
									<h4>购物车营销</h4>
									<div class="coupon-info single">
										<i class="icon icon-coupon lf"></i>
										<div class="coupon-text lf">
											<p class="text">还能创建的购物车营销</p>
											<p class="value">
												<em class="num">0</em>张
											</p>
										</div>
									</div>
									<div class="recom-text">
										<p class="name lf">推荐理由：</p>
										<p class="text lf">综合宝贝的特征，人群的偏好等数据，没有比购物车营销更合适的营销方式啦，为了营业额攀升一个新的高峰，亲不妨一试。</p>
									</div>
								</div>
								<div class="coupon-condition lf">
									<h4>同行使用宝贝优惠券的情45况</h4>
									<div id="pieBox-ticket2-chart" class="pie-box lf" style="width: 280px;height: 180px;"></div>
									<ul class="pie-legend lf"></ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="switch-wrap-2">
					<div class="match-rules">
						<div class="content">
							<p class="info warn">
								<i class="icon-info icon"></i>店铺以下条件不满足聚划算机审规则：
							</p>
							<div class="menus">
								<ul class="menu lf">
									<li class="name lf">规则</li>
									<li class="status lf">我的状态</li>
								</ul>
								<ul class="menu lf">
									<li class="name lf">规则</li>
									<li class="status lf">我的状态</li>
								</ul>

							</div>
							<div class="rules">
								<div class="rule lf">
									<p class="name lf">
										主营类目为“孕妇装/孕产妇用品/营养，厨房电器，电脑硬件/显示器/电脑周边，电玩/配件/游戏/攻略，个人护理/保健/按摩器材，平板电脑/MID，闪存卡/U盘/存储/移动硬盘，生活电器，数码相机/单反相机/摄像机，品牌台机/品牌一体机/服务器，网络设备/网络相关，节庆用品/礼品，厨房/烹饪用具，餐饮具，保健品/膳食营养补食品，自行车/骑行装备/零配件，咖啡/麦片/冲饮，茶，粮油米面/南北干货/调味品，水产肉类/新鲜蔬果/熟食，住宅家具，床上用品，基础建材，家装主材，全屋定制，汽车/用品/配件/改装，商业/办公家具，个性定制/设计服务/DIY，鲜花速递/花卉仿真/绿植园艺，笔记本电脑，酒类，摩托车/电动车/装备/配件、五金工具、电子/电工、家居饰品” 的店铺报名时，店铺信用等级必须在３钻及以上
									</p>
									<p class="reason lf"> 1.您的店铺星级为1星</p>
								</div>
								<div class="rule lf">
									<p class="name lf">
										1、主营类目为女装/女士精品的店铺近半年动态评分数量必须在1300个及以上
										2、主营类目为女士内衣/男士内衣/家居服，服饰配件/皮带/帽子/围巾，女鞋，流行男鞋，箱包皮具/热销女包/男包，户外/登山/野营/旅行用品，运动鞋new，运动服/休闲服装，玩具/模型/动漫/早教/益智，童装/婴儿装/亲子装，童鞋/婴儿鞋/亲子鞋 ，居家日用，传统滋补营养品，家庭/个人清洁工具，3C数码配件，MP3/MP4/iPod/录音笔，美容护肤/美体/精油，彩妆/香水/美妆工具的店铺，近半年动态评分数量必须在700个及以上
										3、主营类目为珠宝/钻石/翡翠/黄金，手表，饰品/流行首饰/时尚饰品新，近半年动态评分数量必须在400个及以上
										4、淘宝旅行店铺近半年动态评分数量必须在100个及以上
										5、主营类目为平行进口车，新车/二手车【新车定金、新车全款、新车整车销售（新）叶子类目】的店铺，近半年动态评分数量无要求
										6、除以上特殊主营类目店铺及特殊商家外，其他店铺近半年有效评分数量必须在200个及以上									</p>
									<p class="reason lf"> 1.您的店铺星级为1星</p>
								</div>
							</div>
						</div>
					</div>
					<div class="mod-choose-item mod-choose">
						<div class="cell-header">
							<i class="icon-choose-item icon lf"></i>
							<h3 class="title rt">第一步 选宝贝</h3>
						</div>
						<div class="content">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide" style="height: 248px;">
										<div class="single-item ui-switchable-panel checked">
											<i class="icon icon-checked"></i>
											<div class="display">
												<dl class="cell-product-h orflow">
													<dt class="vertical-img">
														<a href="#" class="box-img">
															<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
														</a>
													</dt>
													<dd class="desc">
														<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
													</dd>
												</dl>
												<div class="price-block">
													<div class="price lf">
														<p class="name">价格</p>
														<p class="value num">
															￥60.<span class="small">00</span>
														</p>
													</div>
													<div class="price-section lf">
														<ul class="price-list">
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 12%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 70%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
														</ul>
														<div class="arrow-box">
															<p>
																<em class="count">15121</em>相似宝贝
															</p>
															<p>
																价格在<span class="section">89.0-120.0</span>
															</p>
														</div>
													</div>
												</div>
												<p class="recom-index star-1">
													<span class="arrow-box">推荐指数</span>
												</p>
											</div>
											<div class="index">
												<div class="uv lf">
													<p class="name">昨日访客数</p>
													<p class="value num">0</p>
												</div>
												<div class="paycpr lf">
													<p class="name">昨日支付转化率</p>
													<p class="num value">0%</p>
												</div>
											</div>
										</div>
									</div>
									<div class="swiper-slide" style="height: 248px;">
										<div class="single-item ui-switchable-panel">
											<i class="icon icon-checked"></i>
											<div class="display">
												<dl class="cell-product-h orflow">
													<dt class="vertical-img">
														<a href="#" class="box-img">
															<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
														</a>
													</dt>
													<dd class="desc">
														<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
													</dd>
												</dl>
												<div class="price-block">
													<div class="price lf">
														<p class="name">价格</p>
														<p class="value num">
															￥60.<span class="small">00</span>
														</p>
													</div>
													<div class="price-section lf">
														<ul class="price-list">
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 12%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 70%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
														</ul>
														<div class="arrow-box">
															<p>
																<em class="count">15121</em>相似宝贝
															</p>
															<p>
																价格在<span class="section">89.0-120.0</span>
															</p>
														</div>
													</div>
												</div>
												<p class="recom-index star-1">
													<span class="arrow-box">推荐指数</span>
												</p>
											</div>
											<div class="index">
												<div class="uv lf">
													<p class="name">昨日访客数</p>
													<p class="value num">0</p>
												</div>
												<div class="paycpr lf">
													<p class="name">昨日支付转化率</p>
													<p class="num value">0%</p>
												</div>
											</div>
										</div>
									</div>
									<div class="swiper-slide" style="height: 248px;">
										<div class="single-item ui-switchable-panel">
											<i class="icon icon-checked"></i>
											<div class="display">
												<dl class="cell-product-h orflow">
													<dt class="vertical-img">
														<a href="#" class="box-img">
															<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
														</a>
													</dt>
													<dd class="desc">
														<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
													</dd>
												</dl>
												<div class="price-block">
													<div class="price lf">
														<p class="name">价格</p>
														<p class="value num">
															￥60.<span class="small">00</span>
														</p>
													</div>
													<div class="price-section lf">
														<ul class="price-list">
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 12%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 70%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
														</ul>
														<div class="arrow-box">
															<p>
																<em class="count">15121</em>相似宝贝
															</p>
															<p>
																价格在<span class="section">89.0-120.0</span>
															</p>
														</div>
													</div>
												</div>
												<p class="recom-index star-1">
													<span class="arrow-box">推荐指数</span>
												</p>
											</div>
											<div class="index">
												<div class="uv lf">
													<p class="name">昨日访客数</p>
													<p class="value num">0</p>
												</div>
												<div class="paycpr lf">
													<p class="name">昨日支付转化率</p>
													<p class="num value">0%</p>
												</div>
											</div>
										</div>
									</div>
									<div class="swiper-slide" style="height: 248px;">
										<div class="single-item ui-switchable-panel">
											<i class="icon icon-checked"></i>
											<div class="display">
												<dl class="cell-product-h orflow">
													<dt class="vertical-img">
														<a href="#" class="box-img">
															<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
														</a>
													</dt>
													<dd class="desc">
														<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
													</dd>
												</dl>
												<div class="price-block">
													<div class="price lf">
														<p class="name">价格</p>
														<p class="value num">
															￥60.<span class="small">00</span>
														</p>
													</div>
													<div class="price-section lf">
														<ul class="price-list">
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 12%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 70%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
														</ul>
														<div class="arrow-box">
															<p>
																<em class="count">15121</em>相似宝贝
															</p>
															<p>
																价格在<span class="section">89.0-120.0</span>
															</p>
														</div>
													</div>
												</div>
												<p class="recom-index star-1">
													<span class="arrow-box">推荐指数</span>
												</p>
											</div>
											<div class="index">
												<div class="uv lf">
													<p class="name">昨日访客数</p>
													<p class="value num">0</p>
												</div>
												<div class="paycpr lf">
													<p class="name">昨日支付转化率</p>
													<p class="num value">0%</p>
												</div>
											</div>
										</div>
									</div>
									<div class="swiper-slide" style="height: 248px;">
										<div class="single-item ui-switchable-panel">
											<i class="icon icon-checked"></i>
											<div class="display">
												<dl class="cell-product-h orflow">
													<dt class="vertical-img">
														<a href="#" class="box-img">
															<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
														</a>
													</dt>
													<dd class="desc">
														<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
													</dd>
												</dl>
												<div class="price-block">
													<div class="price lf">
														<p class="name">价格</p>
														<p class="value num">
															￥60.<span class="small">00</span>
														</p>
													</div>
													<div class="price-section lf">
														<ul class="price-list">
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 12%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 70%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
														</ul>
														<div class="arrow-box">
															<p>
																<em class="count">15121</em>相似宝贝
															</p>
															<p>
																价格在<span class="section">89.0-120.0</span>
															</p>
														</div>
													</div>
												</div>
												<p class="recom-index star-1">
													<span class="arrow-box">推荐指数</span>
												</p>
											</div>
											<div class="index">
												<div class="uv lf">
													<p class="name">昨日访客数</p>
													<p class="value num">0</p>
												</div>
												<div class="paycpr lf">
													<p class="name">昨日支付转化率</p>
													<p class="num value">0%</p>
												</div>
											</div>
										</div>
									</div>
									<div class="swiper-slide" style="height: 248px;">
										<div class="single-item ui-switchable-panel">
											<i class="icon icon-checked"></i>
											<div class="display">
												<dl class="cell-product-h orflow">
													<dt class="vertical-img">
														<a href="#" class="box-img">
															<img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10012/8/image/20170803/1501748364701547.png">
														</a>
													</dt>
													<dd class="desc">
														<a href="#" target="_blank">2017新款春夏季韩版旅行沙滩巾超大女士防晒雪纺丝巾</a>
													</dd>
												</dl>
												<div class="price-block">
													<div class="price lf">
														<p class="name">价格</p>
														<p class="value num">
															￥60.<span class="small">00</span>
														</p>
													</div>
													<div class="price-section lf">
														<ul class="price-list">
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 12%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 70%;"></p>
															</li>
															<li class="price-col lf">
																<p class="col" style="height: 20%;"></p>
															</li>
														</ul>
														<div class="arrow-box">
															<p>
																<em class="count">15121</em>相似宝贝
															</p>
															<p>
																价格在<span class="section">89.0-120.0</span>
															</p>
														</div>
													</div>
												</div>
												<p class="recom-index star-1">
													<span class="arrow-box">推荐指数</span>
												</p>
											</div>
											<div class="index">
												<div class="uv lf">
													<p class="name">昨日访客数</p>
													<p class="value num">0</p>
												</div>
												<div class="paycpr lf">
													<p class="name">昨日支付转化率</p>
													<p class="num value">0%</p>
												</div>
											</div>
										</div>
									</div>
									
								</div>
								  <!-- 如果需要导航按钮 -->
							    <div class="swiper-button-prev"></div>
							    <div class="swiper-button-next"></div>
							</div>
						</div>
						<div class="mod-unscramble">
							<ul class="cell-lists">
								<li class="col-3 glass">
									<div class="list">
										<h2>数据解读</h2>
										<p class="textF">根据浏览、收藏、下单、支付、宝贝本身的特征等数据，为亲掐指一算，这几个宝贝潜力还可以！</p>
										<p class="textS">
											再通过营销推广一把，提高流量，促成转化吧。
										</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="mod-choose-pricing mod-choose">
						<div class="cell-header">
							<i class="icon-choose-item icon lf"></i>
							<h3 class="title rt">第二步 定价参考</h3>
							<a href="#" class="rt download">
								<span class="download-sec">
									<i class="icon icon-download"></i>
									<span class="val">下载</span>
								</span>
							</a>
						</div>
						<div class="content"></div>
						<div class="mod-unscramble">
							<ul class="cell-lists">
								<li class="col-3 glass">
									<div class="list">
										<h2>数据解读</h2>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="mod-sales-forecast mod-choose">
						<div class="cell-header">
							<i class="icon-choose-item icon lf"></i>
							<h3 class="title rt">第三步 销量预测</h3>
							<span class="text rt">根据聚划算历史同类宝贝销售预测，结果仅供参考</span>
						</div>
						<div class="content">
							<div class="item-info lf">
								<div class="item-desc"></div>
								<div class="forecast">
									<div class="discount lf">
										<p class="name">
											折扣
											<span class="price">
												(折后价：<em>0</em>)
											</span>
										</p>
										<input class="dis-input" type="text" name="">
										<p class="warn">请输入0-10之间的数字</p>
									</div>
									<div class="supplier lf">
										<p class="name">备货量</p>
										<input class="sup-input" type="text" name="">
										<p class="warn">请输入0-5000000的数字</p>
									</div>
									<a href="javascript:;" class="fore-btn lf">
										<i class="icon icon-fore"></i>
										<span class="text lf">预测一下</span>
									</a>
								</div>
							</div>
							<div class="forecast-result rt">
								<p class="name">
									<span>预测销售额</span>
									<span class="amount">
										销售量：<em>0,000</em>件
									</span>
								</p>
								<p class="payamt num">
									￥<em>000,000</em>
								</p>
								<span class="result-arrow"></span>
							</div>
						</div>
					</div>
					<div class="apply fail">
						<span class="succ-apply">
							<a href="javascript:;" class="apply-btn temp-btn">立即报名</a>
						</span>
						<span class="fail-apply">
							<span class="apply-btn">立即报名</span>
							<span class="warn">
								<i class="icon icon-info"></i>
								不满足聚划算机审规则，
								<a href="javascript:;">查看原因></a>
							</span>
						</span>
					</div>
				</div>
			</div>
		</div>
		<!-- 营销工具 end -->


		<!-- 营销效果  start -->
		<div class="w-1040 basic-switch rt switch-wrap marketing-container">
			<div class="inner-ground">
				<div class="mod-market-effect">
					<div class="cell-header">
						<h1 class="title">营销工具效果</h1>
						<p class="rt update-time">
							统计时间
							<span class="time">2017-02-02</span>
						</p>
					</div>
					<div class="content">
						<div class="obj-left">
							<p class="sub-title">我的排行top3</p>
							<ul class="my-list orflow">
							</ul>
							<div class="no-data-message">
								<div class="ui-message-empty">
									<p class="ui-message-content">
										<span class="noromal">
											<i class="icon"></i>
										</span>
										<span>亲还没有营销效果哦，赶紧去看看 
										<a href="javascript:;">创意营销</a>
										</span>
									</p>
								</div>
							</div>
						</div>
						<div class="obj-right">
							<p class="sub-title">同行使用人数top5</p>
							<ul class="cate-list">
								<li class="tool orflow">
									<p class="tool-name">淘金币抵钱</p>
									<p class="tool-effect low-01">
										<span class="bar" style="width: 100%"></span>
									</p>
								</li>
								<li class="tool orflow">
									<p class="tool-name">搭配套餐</p>
									<p class="tool-effect low-02">
										<span class="bar" style="width: 85%"></span>
									</p>
								</li>
								<li class="tool orflow">
									<p class="tool-name">宝贝优惠券</p>
									<p class="tool-effect low-03">
										<span class="bar" style="width: 60%"></span>
									</p>
								</li>
								<li class="tool orflow">
									<p class="tool-name">淘金币签到</p>
									<p class="tool-effect low-04">
										<span class="bar" style="width: 50%"></span>
									</p>
								</li>
								<li class="tool orflow">
									<p class="tool-name">聚划算</p>
									<p class="tool-effect low-05">
										<span class="bar" style="width: 4%"></span>
									</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="mod-scheme">
					<div class="cell-header">
						<h1 class="title">活动中的营销方案</h1>
						<div class="operation-actions rt">
							选择方案类型：
							<div class="select-control ui-selector">
								<a href="javascript:;">
									<span class="ui-selector-value">所有类型</span>
									<span class="caret icon"></span>
								</a>
								<ul class="ui-selector-list select-control-list" style="display: none;">
									<li class="ui-selector-item curr">
										<span>所有类型</span>
									</li>
									<li class="ui-selector-item">
										<span>店铺试用</span>
									</li>
									<li class="ui-selector-item">
										<span>红包</span>
									</li>
									<li class="ui-selector-item">
										<span>聚划算</span>
									</li>
									<li class="ui-selector-item">
										<span>天天特价</span>
									</li>
									<li class="ui-selector-item">
										<span>淘金币抵钱</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="content">
						<ul class="menu orflow">
							<li class="col-01 lf">方案名称</li>
							<li class="col-02 lf">
								商品<i class="question-mark icon"></i>
								<span class="tip-content" style="display: none;">本营销活动里支付宝成交金额最高的前20个商品清单。</span>
							</li>
							<li class="col-03 order orderable lf">
								<span>累计支付金额</span>
								<span class="order-flag desc">
									<i class="icon icon-order"></i>
								</span>
							</li>
							<li class="col-04 order orderable lf">
								<span>客单价</span>
								<span class="order-flag">
									<i class="icon icon-order"></i>
								</span>
							</li>
							<li class="col-05 order orderable lf">
								<span>累计支付新买家数</span>
								<span class="order-flag">
									<i class="icon icon-order"></i>
								</span>
							</li>
							<li class="col-06 lf">操作</li>
						</ul>
						<ul class="scheme-list">
							<li>
								<div class="no-data-message">
									<div class="ui-message-empty">
										<p class="ui-message-content">
											<span class="noromal">
												<i class="icon"></i>
											</span>
											<span>暂无活动中的营销方案</span>
										</p>
									</div>
								</div>
							</li>
						</ul>

					</div>
				</div>
			</div>
		</div>
		<!-- 营销效果  end -->
	</div>

	<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
	<script src="<?= $this->view->js ?>/swiper.min.js"></script>
	<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
	<script type="text/javascript">
		  function mySwiper()   {
		  	var mySwiper = new Swiper ('.swiper-container', {
			    // direction: 'vertical',
			    loop: false,
			    observer: true,	
			    observerParents: true,
			    slidesPerView:3,
				slidesPerGroup : 3,
			    // 如果需要前进后退按钮
			    nextButton: '.swiper-button-next',
			    prevButton: '.swiper-button-prev',
			    onSlideChangeEnd: function(swiper){ 
			        swiper.update(); //swiper更新
			    } 	    
			  })    
		  }
	</script>
	<script type="text/javascript">
		var pieBoxTicketChart = echarts.init(document.getElementById('pieBox-ticket-chart'));
	    	var colors = ["#6fcbc9","#98cd6d"];
	    	option = {
			    legend: {
			        orient: 'vertical',
			        left: 'right',
			        align: 'left',	
			        bottom: 'bottom',
			        data: ['在用','未用'],
			        formatter: function(name) {
			        	var oa = option.series[0].data;
			        	var num = oa[0].value+oa[1].value;
			        	for(var i=0;i<option.series[0].data.length;i++){
			        		if(name == oa[i].name){
			        			return name+ ' ' +(oa[i].value/num * 100).toFixed(2) + "%";
			        		}
			        	}
			        	// console.log(oa);
			        }

			    },
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
			                	value:335, 
			                	name:'在用',
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
			                	name:'未用',
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
			pieBoxTicketChart.setOption(option);

		var pieBoxTicket2Chart = echarts.init(document.getElementById('pieBox-ticket2-chart'));
	    	var colors = ["#6fcbc9","#98cd6d"];
	    	option = {
			    legend: {
			        orient: 'vertical',
			        left: 'right',
			        align: 'left',	
			        bottom: 'bottom',
			        data: ['在用','未用'],
			        formatter: function(name) {
			        	var oa = option.series[0].data;
			        	var num = oa[0].value+oa[1].value;
			        	for(var i=0;i<option.series[0].data.length;i++){
			        		if(name == oa[i].name){
			        			return name+ ' ' +(oa[i].value/num * 100).toFixed(2) + "%";
			        		}
			        	}
			        	// console.log(oa);
			        }

			    },
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
			                	value:335, 
			                	name:'在用',
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
			                	name:'未用',
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
			pieBoxTicket2Chart.setOption(option);

		var shopsBaobeiChart = echarts.init(document.getElementById('shop-baobei-chart'));
	    	var colors = ["#f76c41","#ffa60b","#97ce68","#40bbba","#6bcbca","#9ee4e3"];
	    	option = {
			    legend: {
			       orient: 'vertical',
			        left: 'right',
			        align: 'left',	
			        bottom: 'bottom',
			        data: ['0.0-9','9-26','26-75','75-159','159-359','359-'],
			        formatter: function(name) {
			        	var oa = option.series[0].data;
			        	var num = oa[0].value+oa[1].value;
			        	for(var i=0;i<option.series[0].data.length;i++){
			        		if(name == oa[i].name){
			        			return name+ '    ' +(oa[i].value/num * 100).toFixed(2) + "%";
			        		}
			        	}
			        	// console.log(oa);
			        }

			    },
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
			                	value:12, 
			                	name:'0.0-9',
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
			                	value:156, 
			                	name:'9-26',
			                	hoverAnimation: false,
			                	itemStyle: {
			                		normal: {
			                			borderWidth: 20,
			                			borderColor: 'transparent',
			                			color: colors[1]
			                		}
			                	}	
			                },
			                {
			                	value:620, 
			                	name:'26-75',
			                	hoverAnimation: false,
			                	itemStyle: {
			                		normal: {
			                			borderWidth: 20,
			                			borderColor: 'transparent',
			                			color: colors[2]
			                		}
			                	}	
			                },
			                {
			                	value:310, 
			                	name:'75-159',
			                	hoverAnimation: false,
			                	itemStyle: {
			                		normal: {
			                			borderWidth: 20,
			                			borderColor: 'transparent',
			                			color: colors[3]
			                		}
			                	}	
			                },
			                {
			                	value:62, 
			                	name:'159-359',
			                	hoverAnimation: false,
			                	itemStyle: {
			                		normal: {
			                			borderWidth: 20,
			                			borderColor: 'transparent',
			                			color: colors[4]
			                		}
			                	}	
			                },
			                {
			                	value:310, 
			                	name:'359-',
			                	hoverAnimation: false,
			                	itemStyle: {
			                		normal: {
			                			borderWidth: 20,
			                			borderColor: 'transparent',
			                			color: colors[5]
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
			shopsBaobeiChart.setOption(option);
	</script>
	<script type="text/javascript">
		// 点击左侧导航nav
		$(".switch-wrap").eq(0).show();
		mySwiper();
		$(".nav .menu-list-inner .menu-item-inner").click(function(){
			var _this = $(this);
			var index = _this.index();
			_this.addClass("curr").siblings(".curr").removeClass("curr");
			$(".switch-wrap").hide();
			$(".switch-wrap").eq(index).show();
		})
		// 点击创意营销 爱上聚划算  切换
		$(".inner-ground .switch-wrap-2").eq(0).show();
		mySwiper();
		$(".item-header .tab-menu li").click(function(){
			var _this = $(this);
			_this.addClass("active").siblings(".active").removeClass("active");
			var index = _this.index();
		$(".inner-ground .switch-wrap-2").hide();
		$(".inner-ground .switch-wrap-2").eq(index).show();
			mySwiper();
		})
		// 点击单品营销 多品套餐 全单优惠 切换
		$(".inner-ground .ui-switchable-wrap").eq(0).show();
		mySwiper();
		$(".ui-tab-wrapper li.ui-switchable").click(function(){
			var _this = $(this);
			_this.addClass("active").siblings(".active").removeClass("active");
			var index = _this.index();
			$(".inner-ground .ui-switchable-wrap").hide();
			$(".inner-ground .ui-switchable-wrap").eq(index).show();
			mySwiper();
		})
		// 点击 选宝贝 选中
		$(".single-item").click(function(){
			$(this).addClass("checked").parents(".swiper-slide").siblings(".swiper-slide").children(".single-item.checked").removeClass("checked");
		})
		// 移入小星星
		$(".recom-index").mouseenter(function(){
			var _this = $(this)
			_this.children(".arrow-box").show();
		}).mouseleave(function(){
			var _this = $(this);
			_this.children(".arrow-box").hide();
		})
		// 移入柱形条
		$(".price-list .price-col").mouseenter(function(){
			var _this = $(this);
			_this.parents(".price-list").siblings(".arrow-box").css({"left":-44+ $(this).index()*24+"px"});
			_this.parents(".price-list").siblings(".arrow-box").show();
		}).mouseleave(function(){
			var _this = $(this);
			_this.parents(".price-list").siblings(".arrow-box").hide();
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
					if(_this.css("display") === 'block') {
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
		// 下拉  end
	</script>
</html>

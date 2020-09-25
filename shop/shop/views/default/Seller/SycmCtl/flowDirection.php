<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--流量纵横-->
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
						<li class="menu-item-inner lf">
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
	<!-- 流量纵横 start -->
	<div class="w-1260 rt flow-direction-container">
		<div class="ebase-ModernFrame__main">
			<div class="ebase-metaDecorator__root">
				<div class="pagesOrderGuide__root">
					<div class="ebase-OrderGuidePage__root ">
						<div class="ebase-OrderGuidePage__overview">
							<div class="ebase-OrderGuidePage__overviewBackground">
								<div class="ebase-OrderGuidePage__title">
									<p class="ebase-OrderGuidePage__name">流量纵横</p>
									<p class="ebase-OrderGuidePage__subName">纵观流量来源去向</p>
								</div>
								<div class="ebase-OrderGuidePage__content clearfix">
									<div class="ebase-OrderGuidePage__point ebase-OrderGuidePage__point0" style="width: 25%;">
										<div class="ebase-OrderGuidePage__overviewPointIcon" style="background-position: 0px 0px;"></div>
										<p class="ebase-OrderGuidePage__pointTitle">无线数据更细更全</p>
										<p class="ebase-OrderGuidePage__pointInfoOne">可实时查看无线关键词</p>
										<p class="ebase-OrderGuidePage__pointInfoTwo">非官方产品很难做到</p>
									</div>
									<div class="ebase-OrderGuidePage__point ebase-OrderGuidePage__point1" style="width: 25%;">
										<div class="ebase-OrderGuidePage__overviewPointIcon" style="background-position: -100px 0px;"></div>
										<p class="ebase-OrderGuidePage__pointTitle">实时数据一览无遗</p>
										<p class="ebase-OrderGuidePage__pointInfoOne">PC无线均可实时监控</p>
										<p class="ebase-OrderGuidePage__pointInfoTwo">一有异常，马上发现</p>
									</div>
									<div class="ebase-OrderGuidePage__point ebase-OrderGuidePage__point2" style="width: 25%;">
										<div class="ebase-OrderGuidePage__overviewPointIcon" style="background-position: -200px 0px;"></div>
										<p class="ebase-OrderGuidePage__pointTitle">三级细分层层追溯</p>
										<p class="ebase-OrderGuidePage__pointInfoOne">不知访客从何而来，不知哪个</p>
										<p class="ebase-OrderGuidePage__pointInfoTwo">来源效果好，在这里一目了然</p>
									</div>
									<div class="ebase-OrderGuidePage__point ebase-OrderGuidePage__point3" style="width: 25%;">
										<div class="ebase-OrderGuidePage__overviewPointIcon" style="background-position: -300px 0px;"></div>
										<p class="ebase-OrderGuidePage__pointTitle">计划监控有章可循</p>
										<p class="ebase-OrderGuidePage__pointInfoOne">支持全年计划设定与监控</p>
										<p class="ebase-OrderGuidePage__pointInfoTwo">有的放矢，更有方向</p>
									</div>
								</div>
								<div class="OrderGuideOrderButton__root">
									<a href="index.php?ctl=Seller_Sycm&met=personalCenter" target="_blank" class="OrderGuideOrderButton__btnMain">
										<div>立即订购</div>
									</a>
								</div>
							</div>
						</div>
						<div class="OrderGuideFuncView__root">
							<div class="OrderGuideFuncView__header">你关心的流量数据 都在这里</div>
							<!-- swiper start -->
							<div class="OrderGuideFuncView__mainContent">
								<div class="OrderGuideFuncView__overviewList">
									<div class="oui-carousel">
										<div class="recharts-responsive-container">
											<div class="swiper-container">
												<div class="swiper-wrapper">
													<div class="swiper-slide">
														<div>
															<div class="OrderGuideFuncView__overviewInfo">
																<div class="OrderGuideFuncView__overviewTitle">流量看板</div>
																<div class="OrderGuideFuncView__overviewContent">
																	从PC到无线，从实时到离线，核心流量数据尽在此处
																</div>
															</div>
															<img class="OrderGuideFuncView__overviewPic" src="https://img.alicdn.com/tps/TB1XPADOpXXXXaPXFXXXXXXXXXX-960-522.jpg_.webp">
														</div>
													</div>
													<div class="swiper-slide">
														<div>
															<div class="OrderGuideFuncView__overviewInfo">
																<div class="OrderGuideFuncView__overviewTitle">流量看板2</div>
																<div class="OrderGuideFuncView__overviewContent">
																	从PC到无线，从实时到离线，核心流量数据尽在此处
																</div>
															</div>
															<img class="OrderGuideFuncView__overviewPic" src="https://img.alicdn.com/tps/TB1XPADOpXXXXaPXFXXXXXXXXXX-960-522.jpg_.webp">
														</div>
													</div>
													<div class="swiper-slide">
														<div>
															<div class="OrderGuideFuncView__overviewInfo">
																<div class="OrderGuideFuncView__overviewTitle">流量看板3</div>
																<div class="OrderGuideFuncView__overviewContent">
																	从PC到无线，从实时到离线，核心流量数据尽在此处
																</div>
															</div>
															<img class="OrderGuideFuncView__overviewPic" src="https://img.alicdn.com/tps/TB1XPADOpXXXXaPXFXXXXXXXXXX-960-522.jpg_.webp">
														</div>
													</div>
													<div class="swiper-slide">
														<div>
															<div class="OrderGuideFuncView__overviewInfo">
																<div class="OrderGuideFuncView__overviewTitle">流量看板4</div>
																<div class="OrderGuideFuncView__overviewContent">
																	从PC到无线，从实时到离线，核心流量数据尽在此处
																</div>
															</div>
															<img class="OrderGuideFuncView__overviewPic" src="https://img.alicdn.com/tps/TB1XPADOpXXXXaPXFXXXXXXXXXX-960-522.jpg_.webp">
														</div>
													</div>
												</div>
												<div class="swiper-button-prev"></div>
												<div class="swiper-button-next"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- swiper end -->
						</div>
						<div class="ebase-OrderGuidePage__users">
							<div class="ebase-OrderGuidePage__userList">
								<div class="ebase-OrderGuidePage__header">他们都在用</div>
								<!-- swiper start -->
								<div class="ebase-OrderGuidePage__mainContent">
									<div class="swiper-container">
										<div class="swiper-wrapper">
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__shopInfoContainer">
														<div class="ebase-OrderGuidePage__shopInfo">
															<img class="ebase-OrderGuidePage__shopPic" src="//img.alicdn.com/imgextra/bb/a0/TB1kXaEX_nI8KJjy0FfSuwdoVXa.jpg_.webp">
															<div class="ebase-OrderGuidePage__shopTitle">聪明妈妈生活馆</div>
														</div>
													</div>
												</a>
											</div>
										</div>
										<div class="swiper-button-prev"></div>
										<div class="swiper-button-next"></div>
									</div>
								</div>
								<!-- swiper end -->
							</div>
							<div class="ebase-OrderGuidePage__userComment">
								<div class="ebase-OrderGuidePage__header">他们都说好</div>
								<div class="ebase-OrderGuidePage__mainContent">
									<div class="ebase-OrderGuidePage__commentContainer">
										<img class="ebase-OrderGuidePage__commentPic" src="http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170927/1506478892176559.jpg">
										<div>
											<a href="" target="_blank">
												<div class="ebase-OrderGuidePage__commentTitle">大促活动必备利器，几步就能缩短同行差距！</div>
											</a>
											<div class="ebase-OrderGuidePage__commentBody">
												<span>在各种平台活动中，为什么别人做得好，我们却不行？这个可以通过流量纵横找到同行差距，学习他们的流量策略，学习并调整，做到比它强。另外，流量纵横的事件中心还能时刻提醒你淘宝天猫各大活动的起始时间，真正成为你的贴身“小蜜”！</span>
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__commentDetail">
														<span>查看详情</span>
														<i class="oui-icon oui-icon-angle-right"></i>
													</div>
												</a>
											</div>
										</div>
									</div>
									<div class="ebase-OrderGuidePage__commentContainer">
										<img class="ebase-OrderGuidePage__commentPic" src="http://taos168.com/shop/image.php/media/plantform/ba58602ff036cd67715a76ceb9e232ff/image/20170927/1506478892176559.jpg">
										<div>
											<a href="" target="_blank">
												<div class="ebase-OrderGuidePage__commentTitle">制定计划，实时监控，让店铺运营更有方向！</div>
											</a>
											<div class="ebase-OrderGuidePage__commentBody">
												<span>凡事预则立，不预则废。有了计划，工作才有明确的目标和具体的步骤。流量纵横可以制定计划、监控流量，可以帮助卖家清晰了解一整年的运营重点，快速制定年度计划，还能帮助卖家实时监控店铺情况，快速找出运营问题，运筹帷幄之中，决胜千里之外！</span>
												<a href="" target="_blank">
													<div class="ebase-OrderGuidePage__commentDetail">
														<span>查看详情</span>
														<i class="oui-icon oui-icon-angle-right"></i>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="OrderGuideOrderButton__root">
									<a href="" target="_blank" class="OrderGuideOrderButton__btnMain">
										<div>立即订购</div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 流量纵横 end -->
	
</div>


<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/swiper-3.4.1.jquery.min.js"></script>

<script type="text/javascript">
	var mySwiper_banner_click = new Swiper ('.ebase-OrderGuidePage__users .swiper-container', {
        direction: 'horizontal',
        loop: false,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView:7,
        freeMode:false,   //  若为false  则只滑动一格
        observer: true, //修改swiper自己或子元素时，自动初始化swiper
        observeParents: true //修改swiper的父元素时，自动初始化swiper
        // 如果需要前进后退按钮
    });
    var mySwiper_banner_click = new Swiper ('.OrderGuideFuncView__root .swiper-container', {
        direction: 'horizontal',
        // loop: false,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        observer: true, //修改swiper自己或子元素时，自动初始化swiper
        observeParents: true //修改swiper的父元素时，自动初始化swiper
        // 如果需要前进后退按钮
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


</script>
</html>

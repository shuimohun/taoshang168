<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--作战室-->

<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/spm.css">
 <link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css?ver=<?=VER?>" rel="stylesheet" type="text/css">


<div class="main-wrapper">
	<div class="main-inner">
		<div class="page-layout">
			<div class="header-container">
				<div class="clearfix header-inner">
					<div class="version-tips">
						<a href="javascript:;" target="_blank">
							<img src="https://img.alicdn.com/tfs/TB1v7EjgMMPMeJjy1XcXXXpppXa-218-56.png">
						</a>
					</div>
					<div class="rt">
						<div class="username lf">
							<span class="logo-container">
								<img class="user-logo" src="https://img.alicdn.com/shop-logo/05/e3/TB1Mf_8RFXXXXXjaXXXSutbFXXX.jpg">
							</span>
							<span class="user-name">财龙外贸服装</span>
						</div>
						<a href="javascript:;" class="login-out lf">退出</a>
						<div class="home-link lf">
							<a href="javascript:;" target="_blank">
								<i class="icon-home jxt-juxingtaipingmianicon jxtportal"></i>官网
							</a>
						</div>
						<div class="home-link lf">
							<a href="javascript:;" target="_blank" class="back-to-old">客户运营学院</a>
						</div>


					</div>
				</div>
			</div>
			<div class="aside-container aside-has-header">
				<div class="aside-side-list">
					<h2 class="logo"></h2>
					<ul class="menu">
						<li class="menu-submenu  J_menuItem menu-submenu-open">
							<div class="menu-submenu-title J_selectTitle menuId1111">
								<a href="javascript:;">
									<!-- <i class="jxtportal"></i> -->
									<img src="https://img.alicdn.com/tfs/TB1eH1Mk3oQMeJjy0FpXXcTxpXa-270-38.png" class="icon-img">
								</a>
								<i></i>
							</div>
						</li>
						<li class="menu-submenu  J_menuItem menu-submenu-open">
							<div class="menu-submenu-title J_selectTitle menuId1 menu-item-selected">
								<a href="javascript:;">
									<i class="jxtportal jxt-shouye"></i>首页
									<span></span>
								</a>
								<i></i>
							</div>
						</li>
						<li class="menu-submenu menu-submenu-inline J_menuItem menu-submenu-open">
							<div class="menu-submenu-title J_toggleTitle menuId3">
								<i class="jxtportal jxt-kehuzhongxin"></i>
								<span>客户管理</span>
								<i class="rotate-arrow">></i>
							</div>
							<ul class="menu menu-sub  menu-sub1">
								<li class="menu-item J_menuItem1">
									<div class="menu-submenu-title J_selectTitle menuId304">
										<a href="javascript:;">客户列表
											<span></span>
										</a>
									</div>
								</li>
								<li class="menu-item J_menuItem1">
									<div class="menu-submenu-title J_selectTitle menuId302">
										<a href="javascript:;">客户分群
											<span></span>
										</a>
									</div>
								</li>
								<li class="menu-item J_menuItem1">
									<div class="menu-submenu-title J_selectTitle menuId305">
										<a href="javascript:;">客户分析
											<span></span>
										</a>
									</div>
								</li>
							</ul>
						</li>
						<li class="menu-submenu menu-submenu-inline J_menuItem menu-submenu-open">
							<div class="menu-submenu-title J_toggleTitle menuId2">
								<i class="jxtportal jxt-celvezhongxin"></i>
								<span>运营计划</span>
								<i class="rotate-arrow">></i>
							</div>
							<ul class="menu menu-sub  menu-sub1">
								<!-- <li class="menu-item J_menuItem1">
									<div class="menu-submenu-title J_selectTitle menuId206">
										<a href="javascript:;">
											智能店铺
											<img class="icon-img" src="https://img.alicdn.com/tps/TB1p0UkOpXXXXbVXXXXXXXXXXXX-100-28.png">
										</a>
									</div>
								</li> -->
								<li class="menu-item J_menuItem1">
									<div class="menu-submenu-title J_selectTitle menuId207">
										<a href="javascript:;">
											智能营销
											<img class="icon-img" src="https://gw.alicdn.com/tfscom/TB1Y9zhmPihSKJjy0FeXXbJtpXa.png">
										</a>
									</div>
								</li>
							</ul>
						</li>
						<li class="menu-submenu  J_menuItem menu-submenu-open">
							<div class="menu-submenu-title J_selectTitle menuId4">
								<a href="javascript:;">
									<i class="jxtportal jxt-quanyizhongxin"></i>忠诚度管理
									<span></span>
								</a>
								<i></i>
							</div>
						</li>
						<li class="menu-submenu  J_menuItem menu-submenu-open">
							<div class="menu-submenu-title J_selectTitle menuId92">
								<a href="javascript:;">
									<i class="jxtportal jxt-shiliangzhinengduixiang4"></i>工具箱
									<img src="https://img.alicdn.com/tfs/TB1vKjHX2xNTKJjy0FjXXX6yVXa-108-26.png" class="icon-img">
								</a>
								<i></i>
							</div>
						</li>
						<li class="menu-submenu menu-submenu-inline J_menuItem menu-submenu-open">
							<div class="menu-submenu-title J_toggleTitle menuId6">
								<i class="jxtportal jxt-yingxiaozhongxin"></i>
								<span>权益管理</span>
								<i class="rotate-arrow">></i>
							</div>
							<ul class="menu menu-sub  menu-sub1">
								<li class="menu-item J_menuItem1">
									<div class="menu-submenu-title J_selectTitle menuId602">
										<a href="javascript:;">平台权益
											<span></span>
										</a>
									</div>
								</li>
								<li class="menu-item J_menuItem1">
									<div class="menu-submenu-title J_selectTitle menuId605">
										<a href="javascript:;">
											会员权益
											<span></span>
										</a>
									</div>
								</li>
								<!-- <li class="menu-item J_menuItem1">
									<div class="menu-submenu-title J_selectTitle menuId604">
										<a href="javascript:;">奖池管理
											<span></span>
										</a>
									</div>
								</li> -->
							</ul>
						</li>
						<!-- <li class="menu-submenu  J_menuItem menu-submenu-open">
							<div class="menu-submenu-title J_selectTitle menuId10">
								<a href="javascript:;">
									<i class="jxtportal jxt-zhinengtuku"></i>
									素材管理
									<span></span>
								</a>
								<i></i>
							</div>
						</li> -->
						<!-- <li class="menu-submenu  J_menuItem menu-submenu-open">
							<div class="menu-submenu-title J_selectTitle menuId15">
								<a href="javascript:;">
									<i class="jxtportal jxt-xueyuan"></i>
									客户运营学院
								</a>
								<i></i>
							</div>
						</li> -->
					</ul>
				</div>
			</div>
			<div class="main-container">
				<!-- 双11 -->
				<div class="double-11-wrap main-switch-wrap">
					<div class="main">
						<div class="double11-header-container">
							<!-- <div class="top-nav">
								<div class="left">
									<div class="user-logo-container">
										<img src="//img.alicdn.com//05/e3/TB1Mf_8RFXXXXXjaXXXSutbFXXX.jpg" alt="" class="store-log">
									</div>
									<span>淘尚168商城</span>
								</div>
								<div class="right">
									<div class="link-container">
										<a href="javascritp:;" class="account">财龙外贸服装</a>
										<span class="gap">|</span>
										<a href="#" class="logout">退出</a>
										<span class="gap">|</span>
										<a href="#" target="_blank" class="homepage">官网</a>
										<span class="gap">|</span>
										<a href="#" target="_blank" class="ucenter">客户运营学院</a>
									</div>
								</div>
							</div> -->
							<div class="banner-container">
								<div class="logo">
									<img src="//img.alicdn.com/tfs/TB1A8JDiGagSKJjy0FcXXcZeVXa-610-196.png" alt="">
								</div>
								<div class="img-container" style="background-image: url(&quot;//img.alicdn.com/tfs/TB1lRpDiGagSKJjy0FcXXcZeVXa-1748-300.jpg&quot;);"></div>
								<div class="cube left">
									<img src="https://img.alicdn.com/tfs/TB18JTBe3oQMeJjy1XaXXcSsFXa-288-378.png" alt="">
								</div>
								<div class="cube right">
									<img src="https://img.alicdn.com/tfs/TB1TArFe3oQMeJjy0FpXXcTxpXa-312-376.png" alt="">
								</div>
							</div>
							<div class="progress-line-wrapper">
								<div class="step-container-wrapper currdone"></div>
								<div class="step-container-wrapper"></div>
								<div class="step-container-wrapper"></div>
								<div class="step-container-wrapper"></div>
							</div>
							<div class="progress-line">
								<div class="step-container done">
									<div class="step-title">
										<div class="text">预热前期</div>
										<div class="desc">（10.12-10.31）</div>
									</div>
									<div class="step-progress done">
										<div class="left-line first"></div>
										<div class="point"></div>
										<div class="right-line"></div>
									</div>
									<div class="step-desc">
										<div>已完成/任务总数</div>
										<div>0/6</div>
									</div>
									<button class="step-btn">去设置</button>
								</div>
								<div class="step-container">
									<div class="step-title">
										<div class="text">预热高潮</div>
										<div class="desc">（11.1-11.10）</div>
									</div>
									<div class="step-progress">
										<div class="left-line"></div>
										<div class="point"></div>
										<div class="right-line"></div>
									</div>
									<div class="step-desc">
										<div>已完成/任务总数</div>
										<div>0/9</div>
									</div>
									<button class="step-btn">去设置</button>
								</div>
								<div class="step-container">
									<div class="step-title">
										<div class="text">购物狂欢</div>
										<div class="desc">（11.11）</div>
									</div>
									<div class="step-progress">
										<div class="left-line"></div>
										<div class="point"></div>
										<div class="right-line"></div>
									</div>
									<div class="step-desc">
										<div>已完成/任务总数</div>
										<div>0/4</div>
									</div>
									<button class="step-btn">去设置</button>
								</div>
								<div class="step-container">
									<div class="step-title">
										<div class="text">大促复盘</div>
										<div class="desc">（11.12）</div>
									</div>
									<div class="step-progress">
										<div class="left-line"></div>
										<div class="point"></div>
										<div class="right-line"></div>
									</div>
									<div class="step-desc">
										<div>已完成/任务总数</div>
										<div>0/2</div>
									</div>
									<button class="step-btn">去设置</button>
								</div>

							</div>
						</div>
						<div class="block-container">
							<div class="head">
								<span class="title">数据看板</span>
								<span class="tips-wrap">
									<i class="icon icon-tips"></i>
									<div class="tips-guide-wrap">
										<ul class="notice-tips-container">
											<li class="tip"><label>预热指数</label><span class="tip-content">：根据大促预热期间的店铺访客人数、访客跳失率、加购数据、领券数据、收藏数据等数据综合计算。预热指数可反馈商家大促蓄水情况。</span></li>
											<li class="tip"><label>访客人数</label><span class="tip-content">：全店访客人数</span></li>
											<li class="tip"><label>访客跳失率</label><span class="tip-content">：一天内，店铺浏览量为1的访客数/店铺总访客数</span></li>
											<li class="tip"><label>加购人数</label><span class="tip-content">：将店铺商品加入购物车的客户数</span></li>
											<li class="tip"><label>收藏人数</label><span class="tip-content">：收藏店铺的客户数</span></li>
											<li class="tip"><label>领券人数</label><span class="tip-content">：领取店铺优惠券的客户数</span></li>
										</ul>
									</div>
								</span>
							</div>
							<div class="content-wrapper">
								<div class="pre-heat-panel">
									<div class="pre-head">
										<div class="title">预热指数</div>
										<div class="info-content">
											<div class="text-span">
												<div class="title">昨日得分</div>
												<div class="text">1,000</div>
											</div>
										</div>
										<div class="tool-bar">
											<div class="tab-item active"><i></i></div>
											<div class="tab-item"><i></i></div>
										</div>
									</div>
									<div class="pre-heat-content">
										<div class="preheat-radar-double11-wrap" style="position: relative;width: 580px;height: 400px;margin:0 auto;">
											<div class="preheat-chart-legend">
												<div class="legend-body">
													<b class="legend-1-color"></b>
													<h6 class="legend-1-name">本店</h6>
													<b class="legend-2-color"></b>
													<h6 class="legend-2-name">同行同层平均</h6>
												</div>
											</div>
											<div class="radar-label-t radar-label">
												<div class="radar-title-data">
													<span class="radar-title-data-self">1039</span>/
													<span class="radar-title-data-average">1,045</span>
												</div>
											</div>
											<div class="radar-label-lt radar-label">
												<div class="radar-title-data">
													<span class="radar-title-data-self">1,100</span>/
													<span class="radar-title-data-average">1,009</span>
												</div>
											</div>
											<div class="radar-label-lb radar-label">
												<div class="radar-title-data">
													<span class="radar-title-data-self">1,000</span>/
													<span class="radar-title-data-average">56</span>
												</div>
											</div>
											<div class="radar-label-b radar-label">
												<div class="radar-title-data">
													<span class="radar-title-data-self">0</span>/
													<span class="radar-title-data-average">1,013</span>
												</div>
											</div>
											<div class="radar-label-rt radar-label">
												<div class="radar-title-data">
													<span class="radar-title-data-self">1039</span>/
													<span class="radar-title-data-average">1,003</span>
												</div>
											</div>
											<div class="radar-label-rb radar-label">
												<div class="radar-title-data">
													<span class="radar-title-data-self">1009</span>/
													<span class="radar-title-data-average">-</span>
												</div>
											</div>
											<div id="preheat-radar-double11" class="preheat-radar-double11" style="width: 580px;height: 400px;"></div>
										</div>
										<div class="preheat-radar-double11-wrap" style="position: relative;width: 580;height: 400px;margin:0 auto;">
											<div class="preheat-chart-legend">
												<div class="legend-body">
													<b class="legend-1-color"></b>
													<h6 class="legend-1-name">本店</h6>
													<b class="legend-2-color"></b>
													<h6 class="legend-2-name">同行同层平均</h6>
												</div>
											</div>
											<!-- 下拉框 -->
											<div style=" position: absolute; z-index: 20;right:200px;">
												<span class="next-select medium">
													<input type="hidden">
													<span class="next-select-inner">加购件数</span>
													<i class="caret icon-arrow icon"></i>
												</span>
												<div class="next-menu ver next-overlay-inner animated expandInDown next-select-menu " style="position: absolute; left: 0; top: 27px; width: 98px;">
													<ul class="next-menu-content">
														<li class="next-menu-item">预热指数</li>
														<li class="next-menu-item">访客数</li>
														<li class="next-menu-item">加购人数</li>
														<li class="next-menu-item selected">加购件数</i></li>
														<li class="next-menu-item">收藏人数</li>
														<li class="next-menu-item">跳失率</li>
														<li class="next-menu-item">领券人数</li>
													</ul>
												</div>
											</div>
											<div id="hot-point-chart" class="hot-point-chart" style="width: 100%;height: 400px;margin: 0 auto;"></div>
										</div>
									</div>
								</div>
								<div class="pre-heat-panel">
									<div class="pre-head">
										<div class="title">指数排名</div>
										<div class="info-content">
											<div class="text-span">
												<div class="title">行业排名</div>
												<div class="text">95,817</div>
											</div>
											<div class="text-span">
												<div class="title">对比昨日</div>
												<div class="text decrease">-3,971</div>
											</div>
										</div>
										<div class="tool-bar">
											<div class="tab-item active"><i></i></div>
											<div class="tab-item"><i></i></div>
										</div>
									</div>
									<div class="pre-heat-content rank-table-wrapper">
										<div class="rank-table-wrapper">
											<div class="rank-table">
												<ul>
													<li class="rank-table-c-rank top3">01</li>
													<li style="width: 60%;">
														<span class="rank-table-c-clustars">
															<i class="clustars-2"></i>
														</span>
														<span class="rank-table-c-name">聪明妈妈家居生活馆</span>
													</li>
													<li class="rank-table-c-score" style="width: 15%;">3578</li>
													<li class="up" style="text-align: left; width: 15%;">
														<i class="icon-trend"></i>
														<span>36</span>
													</li>
												</ul>
												<ul>
													<li class="rank-table-c-rank top3">02</li>
													<li style="width: 60%;">
														<span class="rank-table-c-clustars">
															<i class="clustars-2"></i>
														</span>
														<span class="rank-table-c-name">聪明妈妈家居生活馆</span>
													</li>
													<li class="rank-table-c-score" style="width: 15%;">3578</li>
													<li class="up" style="text-align: left; width: 15%;">
														<i class="icon-trend"></i>
														<span>36</span>
													</li>
												</ul>
												<ul>
													<li class="rank-table-c-rank top3">03</li>
													<li style="width: 60%;">
														<span class="rank-table-c-clustars">
															<i class="clustars-2"></i>
														</span>
														<span class="rank-table-c-name">聪明妈妈家居生活馆</span>
													</li>
													<li class="rank-table-c-score" style="width: 15%;">3578</li>
													<li class="down" style="text-align: left; width: 15%;">
														<i class="icon-trend"></i>
														<span>36</span>
													</li>
												</ul>
												<ul>
													<li class="rank-table-c-rank">03</li>
													<li style="width: 60%;">
														<span class="rank-table-c-clustars">
															<i class="clustars-2"></i>
														</span>
														<span class="rank-table-c-name">聪明妈妈家居生活馆</span>
													</li>
													<li class="rank-table-c-score" style="width: 15%;">3578</li>
													<li class="down" style="text-align: left; width: 15%;">
														<i class="icon-trend"></i>
														<span>36</span>
													</li>
												</ul>
												<ul>
													<li class="rank-table-c-rank">03</li>
													<li style="width: 60%;">
														<span class="rank-table-c-clustars">
															<i class="clustars-2"></i>
														</span>
														<span class="rank-table-c-name">聪明妈妈家居生活馆</span>
													</li>
													<li class="rank-table-c-score" style="width: 15%;">3578</li>
													<li class="down" style="text-align: left; width: 15%;">
														<i class="icon-trend"></i>
														<span>36</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="block-container">
							<div class="head">
								<span class="title">双11运营攻略</span>
								<span class="desc"></span>
							</div>
							<div class="content-wrapper">
								<div class="strategy-container">
									<div class="next-tabs next-tabs-top next-tabs next-tabs-capsule next-tabs-medium">
										<div class="next-tabs-bar">
											<div class="next-tabs-nav-container ">
												<div class="next-tabs-nav-wrap">
													<div class="next-tabs-nav-scroll">
														<div class="next-tabs-nav">
															<div class="next-tabs-tab next-tabs-tab-active custom-tabs-tab">
																<div class="next-tabs-tab-inner" style="height: 112px;">
																	<div class="pane-container">
																		<div class="title">预热前期</div>
																		<div class="des">（10.12-10.31）</div>
																		<div class="task">已完成/任务总数
																			<span>0/6</span>
																		</div>
																		<div class="progress">
																			<div class="next-progress-line next-progress-line-medium next-progress-line-normal" style="width: 100%;">
																				<div class="next-progress-line-container">
																					<div class="next-progress-line-underlay">
																						<div class="next-progress-line-overlay next-progress-line-overlay-normal" style="width: 0%;"></div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>	
															<div class="next-tabs-tab custom-tabs-tab">
																<div class="next-tabs-tab-inner" style="height: 112px;">
																	<div class="pane-container">
																		<div class="title">预热高潮</div>
																		<div class="des">（11.1-10.10）</div>
																		<div class="task">已完成/任务总数
																			<span>0/9</span>
																		</div>
																		<div class="progress">
																			<div class="next-progress-line next-progress-line-medium next-progress-line-normal" style="width: 100%;">
																				<div class="next-progress-line-container">
																					<div class="next-progress-line-underlay">
																						<div class="next-progress-line-overlay next-progress-line-overlay-normal" style="width: 0%;"></div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="next-tabs-tab custom-tabs-tab">
																<div class="next-tabs-tab-inner" style="height: 112px;">
																	<div class="pane-container">
																		<div class="title">购物狂欢</div>
																		<div class="des">（11.11）</div>
																		<div class="task">已完成/任务总数
																			<span>0/4</span>
																		</div>
																		<div class="progress">
																			<div class="next-progress-line next-progress-line-medium next-progress-line-normal" style="width: 100%;">
																				<div class="next-progress-line-container">
																					<div class="next-progress-line-underlay">
																						<div class="next-progress-line-overlay next-progress-line-overlay-normal" style="width: 0%;"></div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="next-tabs-tab custom-tabs-tab">
																<div class="next-tabs-tab-inner" style="height: 112px;">
																	<div class="pane-container">
																		<div class="title">大促复盘</div>
																		<div class="des">（11.12）</div>
																		<div class="task">已完成/任务总数
																			<span>0/2</span>
																		</div>
																		<div class="progress">
																			<div class="next-progress-line next-progress-line-medium next-progress-line-normal" style="width: 100%;">
																				<div class="next-progress-line-container">
																					<div class="next-progress-line-underlay">
																						<div class="next-progress-line-overlay next-progress-line-overlay-normal" style="width: 0%;"></div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="next-tabs-content" style="padding: 0px;">
											<div class="next-tabs-tabpane next-tabs-tabpane-hidden custom-content">  <!-- tab -->
												<div>
													<div class="solutions-container">
														<div class="solutions-left">
															<img src="https://img.alicdn.com/tfs/TB1SU5vg3oQMeJjy1XaXXcSsFXa-40-40.png" class="solutions-logo">
															<div class="solutions-wrap">
																<div class="solutions-title">老客唤醒
																	<span class="tip">短信88折</span>
																</div>
																<div class="solutions-content">唤起流失老客记忆，引导回店加购收藏。
																	<a class="helper" href="#" target="_blank">查看使用指南</a>
																</div>
															</div>
														</div>
														<div class="solutions-right">
															<div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">流失老客召回
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">对流失客户进行定向营销，激活非活跃老客，高效提升店铺流量和老客占比。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="index.php?ctl=Seller_Sycm&met=messageMarkting">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB1KQSug3oQMeJjy0FpXXcTxpXa-34-34.png">预售商品预热
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">系统会自动根据您店铺的双11预售商品，来计算对其感兴趣客户。对该客户群来进行营销通知，快速提升双11预售商品销量。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="index.php?ctl=Seller_Sycm&met=messageMarkting">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB1ZZ5Kg3oQMeJjy0FoXXcShVXa-34-34.png">优惠券关怀
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">大促期间定向人群推送优惠券，直接放入客户卡券包中，提升客户转化率和客单价。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="index.php?ctl=Seller_Sycm&met=couponCare">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="solutions-container">
														<div class="solutions-left">
															<img src="https://img.alicdn.com/tfs/TB1SU5vg3oQMeJjy1XaXXcSsFXa-40-40.png" class="solutions-logo">
															<div class="solutions-wrap">
																<div class="solutions-title">会员招募
																</div>
																<div class="solutions-content">设置会员积分体系与会员活动，引导成交客户入会。
																	<a class="helper" href="#" target="_blank">查看使用指南</a>
																</div>
															</div>
														</div>
														<div class="solutions-right">
															<div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB1TOyqg3oQMeJjy1XaXXcSsFXa-34-34.png">新会员入会礼
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">针对新会员设定入会权益，快速提升会员招募效率，沉淀店铺高价值客户。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="#">去设置</a>    <!--会员权益  页面-->
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB1Eiyqg3oQMeJjy1XaXXcSsFXa-34-34.png">会员满赠满减
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">可针对不同等级会员客户单独设置满赠满减活动，提升会员客户客单价和下单量。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="#">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="solutions-container">
														<div class="solutions-left">
															<img src="https://img.alicdn.com/tfs/TB1SU5vg3oQMeJjy1XaXXcSsFXa-40-40.png" class="solutions-logo">
															<div class="solutions-wrap">
																<div class="solutions-title">访客千人千面
																</div>
																<div class="solutions-content">对店铺访客进行分群，定向展示不同页面，提升访客加购收藏。
																	<a class="helper" href="#" target="_blank">查看使用指南</a>
																</div>
															</div>
														</div>
														<div class="solutions-right">
															<div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB1_s5Kg3oQMeJjy0FoXXcShVXa-34-34.png">定向海报
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">针对不同人群在店铺首页展示不同的banner图，快速高效实现千人千面。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="#">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="next-tabs-tabpane next-tabs-tabpane-hidden custom-content">  <!-- tab -->
												<div>
													<div class="solutions-container">
														<div class="solutions-left">
															<img src="https://img.alicdn.com/tfs/TB1SU5vg3oQMeJjy1XaXXcSsFXa-40-40.png" class="solutions-logo">
															<div class="solutions-wrap">
																<div class="solutions-title">加购客户及老客召回
																	<span class="tip">短信88折</span>
																</div>
																<div class="solutions-content">召回店铺活跃及忠诚客户，引导加购，并对加购人群定向营销，在双11当天转化。
																	<a class="helper" href="#" target="_blank">查看使用指南</a>
																</div>
															</div>
														</div>
														<div class="solutions-right">
															<div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB1rK__QVXXXXXZXVXXXXXXXXXX-72-80.png">兴趣客户转化
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">针对蓄水的加购收藏客户进行转化，提升双11客户转化率及销售额。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="index.php?ctl=Seller_Sycm&met=bizplan">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">活跃老客召回
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">对活跃老客进行定向营销，可实现更高的召回率和转化率，降低营销成本，提升营销效果。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="index.php?ctl=Seller_Sycm&met=messageMarkting">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">忠诚老客召回
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">对忠诚老客设置特殊权益和内容，进行定向营销，提升老客粘性和满意度。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="index.php?ctl=Seller_Sycm&met=messageMarkting">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">去年双11老客营销
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">大促专用，针对去年双11老客定向营销、召回，可有效提升大促期间销量和老客占比。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="index.php?ctl=Seller_Sycm&met=messageMarkting">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">其他老客召回
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">自主选择人群，进行优惠券、短信和定向海报的营销组合投放，快速找回老客。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="index.php?ctl=Seller_Sycm&met=messageMarkting">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="solutions-container">
														<div class="solutions-left">
															<img src="https://img.alicdn.com/tfs/TB1SU5vg3oQMeJjy1XaXXcSsFXa-40-40.png" class="solutions-logo">
															<div class="solutions-wrap">
																<div class="solutions-title">会员预热
																</div>
																<div class="solutions-content">引导会员领取大促优惠券，并进行大促活动通知。
																	<a class="helper" href="#" target="_blank">查看使用指南</a>
																</div>
															</div>
														</div>
														<div class="solutions-right">
															<div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">大促会员专享券
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">引导会员领取大促优惠券，提升会员成交额和客单价。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="#">去设置</a>    <!--进入会员权益 页面-->
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">会员满赠满减
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">可针对不同等级会员客户单独设置满赠满减活动，提升会员客户客单价和下单量。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="#">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="solutions-container">
														<div class="solutions-left">
															<img src="https://img.alicdn.com/tfs/TB1SU5vg3oQMeJjy1XaXXcSsFXa-40-40.png" class="solutions-logo">
															<div class="solutions-wrap">
																<div class="solutions-title">访客千人千面
																</div>
																<div class="solutions-content">对店铺访客进行分群，定向展示不同页面，提升访客加购收藏。
																	<a class="helper" href="#" target="_blank">查看使用指南</a>
																</div>
															</div>
														</div>
														<div class="solutions-right">
															<div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">定向海报
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">针对不同人群在店铺首页展示不同的banner图，快速高效实现千人千面。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="#">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">智能卖家推荐
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">在宝贝详情页，定向设置宝贝推荐，提升大促客户转化率和客单价。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="#">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="next-tabs-tabpane next-tabs-tabpane-hidden custom-content">  <!-- tab -->
												<div>
													<div class="solutions-container">
														<div class="solutions-left">
															<img src="https://img.alicdn.com/tfs/TB1SU5vg3oQMeJjy1XaXXcSsFXa-40-40.png" class="solutions-logo">
															<div class="solutions-wrap">
																<div class="solutions-title">老客成交冲刺
																	<span class="tip">短信88折</span>
																</div>
																<div class="solutions-content">对双11最具成交潜力的老客进行营销，提升双11战绩。
																	<a class="helper" href="#" target="_blank">查看使用指南</a>
																</div>
															</div>
														</div>
														<div class="solutions-right">
															<div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">双11高潜老客营销
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">系统算法智能计算店铺老客中双11当天高概率购买的老客，并自动过滤双11已下单客户。对该人群冲刺营销，提升大促销量。(双11当天开启)</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl disabled" href="#">敬请期待</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">其他老客召回
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">自主选择人群，进行优惠券、短信和定向海报的营销组合投放，快速找回老客。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="index.php?ctl=Seller_Sycm&met=messageMarkting">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="solutions-container">
														<div class="solutions-left">
															<img src="https://img.alicdn.com/tfs/TB1SU5vg3oQMeJjy1XaXXcSsFXa-40-40.png" class="solutions-logo">
															<div class="solutions-wrap">
																<div class="solutions-title">会员客单价提升
																</div>
																<div class="solutions-content">为会员提供双11当天成交多倍积分活动，提升会员客单价。
																	<a class="helper" href="#" target="_blank">查看使用指南</a>
																</div>
															</div>
														</div>
														<div class="solutions-right">
															<div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">大促会员专享券
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">引导会员领取大促优惠券，提升会员成交额和客单价。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="#">去设置</a>  <!--进入会员权益 页面-->
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="solutions-container">
														<div class="solutions-left">
															<img src="https://img.alicdn.com/tfs/TB1SU5vg3oQMeJjy1XaXXcSsFXa-40-40.png" class="solutions-logo">
															<div class="solutions-wrap">
																<div class="solutions-title">访客转化
																</div>
																<div class="solutions-content">针对新老客或者加购人群定向展示个性化页面，提升访客转化。
																	<a class="helper" href="#" target="_blank">查看使用指南</a>
																</div>
															</div>
														</div>
														<div class="solutions-right">
															<div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">定向海报
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">针对不同人群在店铺首页展示不同的banner图，快速高效实现千人千面。</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl" href="#">去设置</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="next-tabs-tabpane next-tabs-tabpane-hidden custom-content">  <!-- tab -->
												<div>
													<div class="solutions-container">
														<div class="solutions-left">
															<img src="https://img.alicdn.com/tfs/TB1SU5vg3oQMeJjy1XaXXcSsFXa-40-40.png" class="solutions-logo">
															<div class="solutions-wrap">
																<div class="solutions-title">客户培养
																	<span class="tip">短信88折</span>
																</div>
																<div class="solutions-content">针对大促期间成交的客户进行感谢和关怀，提升客户品牌好感度，促进再次转化。
																	<a class="helper" href="#" target="_blank">查看使用指南</a>
																</div>
															</div>
														</div>
														<div class="solutions-right">
															<div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">大促后新客关怀
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">对双11当天成交的新客进行定向关怀，提升新客对店铺的好感度，沉淀大促引入新客户。(11月12日开启)</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl  disabled" href="#">敬请期待</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
																<div class="solutions-task-list">
																	<div class="task-list-left">
																		<div class="title">
																			<img src="https://img.alicdn.com/tfs/TB19Zavg3oQMeJjy0FnXXb8gFXa-34-34.png">大促后老客关怀
																			<span class="goSet">未设置</span>
																		</div>
																		<div class="des">对双11当天成交的老客进行定向关怀、营销，提升店铺老客粘性和复购率。(11月12日开启)</div>
																	</div>
																	<div class="task-list-right">
																		<div>
																			<a class="seturl disabled" href="#">敬请期待</a>
																			<span style="width: 24px; display: inline-block;"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 首页 -->
				<div class="index-wrap main-switch-wrap">
					<div>
						<div>
							<div class="pic-section"></div>
							<div class="text-section"></div>
							<div class="module-section">
								<div class="section-block" style="height: 458px;">
									<div class="block-inner">
										<div class="jxt-title-container">
											<h2 class="jxt-title">
												运营状况
												<span class="rt description" style="position: relative;">名词解释
													<div class="tips-guide-wrap" style="display: none;">
														<ul class="notice-tips-container">
															<li class="tip"><label>访客跳失率：</label><span class="tip-content">：一天内，店铺浏览量为1的访客数/店铺总访客数，即访客数中，只有一个浏览量的访客数占比；</span></li>
															<li class="tip"><label>访客支付转化率：</label><span class="tip-content">：当天支付买家数/当天访客数，即来访客户转化为支付买家的比例；</span></li>
															<li class="tip"><label>老客活跃率：</label><span class="tip-content">：30天内有过收藏店铺、收藏商品、加购、下单、询单且365天内有成交的客户数量/365天内有成交的客户数量；</span></li>
															<li class="tip"><label>同行较差：</label><span class="tip-content">：在同一级主营类目商家中排名60%以下；</span></li>
															<li class="tip"><label>同行良好：</label><span class="tip-content">：在同一级主营类目商家中排名60%-90%；</span></li>
															<li class="tip"><label>同行极好：</label><span class="tip-content">：在同一级主营类目商家中排名90%以上；</span></li>
														</ul>
													</div>
												</span>
											</h2>
										</div>
										<div class="chart-container">
											<div>
												<div class="gauge">
													<p class="gauge-title"><i class="jxtportal  jxt-comiisfangke"></i>访客跳失率</p>
													<div class="gauge-parent">
														<div class="gauge-label-parent" style="width: 210px;margin-left: -105px;">
															<span class="gauge-label" style="left: 218px; top: 158px;">差</span>
															<span class="gauge-label" style="left: 15px; top: 20px;">良</span>
															<span class="gauge-label" style="left: -24px; top: 158px;">优</span>
														</div>
														<div id="gauge-chart-fk" class="gauge-chart-fk" style="width: 400px;height: 250px;margin: 0 auto;"></div>
													</div>
													<p class="gauge-detail"><span class="weekDel"><i class="jxtportal jxt-7tian dataIcon grey"></i><span class="grey">－－</span></span><span><i class="jxtportal jxt-zuotian dataIcon grey"></i><span class="grey">－－</span></span></p>
													<button type="button" class="next-btn next-btn-secondary next-btn-large">开启首页千人千面</button>
												</div>
												<div class="gauge">
													<p class="gauge-title"><i class="jxtportal  jxt-comiisfangke"></i>访客跳失率</p>
													<div class="gauge-parent">
														<div class="gauge-label-parent" style="width: 210px;margin-left: -105px;">
															<span class="gauge-label" style="left: 218px; top: 158px;">差</span>
															<span class="gauge-label" style="left: 15px; top: 20px;">良</span>
															<span class="gauge-label" style="left: -24px; top: 158px;">优</span>
														</div>
														<div id="gauge-chart-fkSupport" class="gauge-chart-fk" style="width: 400px;height: 250px;margin: 0 auto;"></div>
													</div>
													<p class="gauge-detail"><span class="weekDel"><i class="jxtportal jxt-7tian dataIcon grey"></i><span class="grey">－－</span></span><span><i class="jxtportal jxt-zuotian dataIcon grey"></i><span class="grey">－－</span></span></p>
													<button type="button" class="next-btn next-btn-secondary next-btn-large">开启首页千人千面</button>
												</div>
												<div class="gauge">
													<p class="gauge-title"><i class="jxtportal  jxt-comiisfangke"></i>访客跳失率</p>
													<div class="gauge-parent">
														<div class="gauge-label-parent" style="width: 210px;margin-left: -105px;">
															<span class="gauge-label" style="left: 218px; top: 158px;">差</span>
															<span class="gauge-label" style="left: 15px; top: 20px;">良</span>
															<span class="gauge-label" style="left: -24px; top: 158px;">优</span>
														</div>
														<div id="gauge-chart-fkOld" class="gauge-chart-fk" style="width: 400px;height: 250px;margin: 0 auto;"></div>
													</div>
													<p class="gauge-detail"><span class="weekDel"><i class="jxtportal jxt-7tian dataIcon grey"></i><span class="grey">－－</span></span><span><i class="jxtportal jxt-zuotian dataIcon grey"></i><span class="grey">－－</span></span></p>
													<button type="button" class="next-btn next-btn-secondary next-btn-large disabled">敬请期待</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="section-block" style="height: 545px;">
									<div class="block-inner">
										<div class="index-trend-page">
											<div class="next-tabs next-tabs-top next-tabs next-tabs-capsule next-tabs-medium next-tabs-xsmall">
												<div class="next-tabs-bar">
													<div class="next-tabs-nav-container ">
														<div class="next-tabs-nav-wrap">
															<div class="next-tabs-nav-scroll">
																<div class="next-tabs-nav">
																	<div class="next-tabs-tab-active next-tabs-tab">
																		<div class="next-tabs-tab-inner">
																			商品详情
																		</div>
																	</div>
																	<div class="next-tabs-tab">
																		<div class="next-tabs-tab-inner">
																			店铺首页
																		</div>
																	</div>
																	<div class="next-tabs-tab">
																		<div class="next-tabs-tab-inner">
																			店铺整体
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="next-tabs-content">
													<div class="next-tabs-tabpane">
														<div>
															<h3>运营效果
																<div class="jxt-date-picker">
																	<div class="triger-container ">
																		<span class="green">2017-11-02</span>
																		<span class="vs">vs</span>
																		<span class="blue">2017-11-03</span>
																		<i class="next-icon next-icon-arrow-down next-icon-medium down-tip"></i>
																	</div>
																	<div class="next-overlay-inner dropContainer" style="position: absolute; right: 0; top: 30px;z-index:2000;">
																		<div class="title">选择日期
																			<!-- <div class="switch hide">对比
																				<div class="next-switch next-switch-on next-switch-small">
																					<div class="next-switch-trigger"></div>
																					<div class="next-switch-children"></div>
																				</div>
																			</div> -->
																		</div>
																		<div class="datePickerContainer">
																			<div class="next-date-picker next-date-picker-medium">
																				<span class="next-input next-input-single next-input-medium">
																					<input class="vs1" type="text" value="2017-11-07" placeholder="请选择日期" height="100%">
																				</span>
																				<i class="next-icon next-icon-delete-filling next-icon-small">x</i>
																			</div>
																			<span class="vs">VS</span>
																			<div value="2015-10-26" class="next-date-picker next-date-picker-medium">
																				<span class="next-input next-input-single next-input-medium">
																					<input class="vs2" type="text" value="2015-10-26" placeholder="请选择日期" height="100%">
																				</span>
																				<i class="next-icon next-icon-delete-filling next-icon-small">x</i>
																			</div>
																			<div class="btn-group">
																				<button type="button" class="next-btn next-btn-primary next-btn-medium">确定</button>
																				<button type="button" class="next-btn next-btn-normal next-btn-medium">取消</button>
																			</div>
																		</div>
																	</div>
																</div>
															</h3>
															<div class="tab-content">
																<ul class="tab-content-ul" style="width: 14.2857%;">
																	<li class="li-name ">商品访客数</li>
																	<li class="li-cnt jxt-green jxt-font">--</li>
																	<li class="li-cnt jxt-blue jxt-font">--</li>
																</ul>
																<ul class="tab-content-ul" style="width: 14.2857%;">
																	<li class="li-name ">商品浏览量</li>
																	<li class="li-cnt jxt-green jxt-font">--</li>
																	<li class="li-cnt jxt-blue jxt-font">--</li>
																</ul>
																<ul class="tab-content-ul" style="width: 14.2857%;">
																	<li class="li-name ">平均停留时长</li>
																	<li class="li-cnt jxt-green jxt-font">--</li>
																	<li class="li-cnt jxt-blue jxt-font">--</li>
																</ul>
																<ul class="tab-content-ul" style="width: 14.2857%;">
																	<li class="li-name ">详情页跳失率</li>
																	<li class="li-cnt jxt-green jxt-font">--</li>
																	<li class="li-cnt jxt-blue jxt-font">--</li>
																</ul>
																<ul class="tab-content-ul" style="width: 14.2857%;">
																	<li class="li-name ">架构人数</li>
																	<li class="li-cnt jxt-green jxt-font">--</li>
																	<li class="li-cnt jxt-blue jxt-font">--</li>
																</ul>
																<ul class="tab-content-ul" style="width: 14.2857%;">
																	<li class="li-name ">收藏人数</li>
																	<li class="li-cnt jxt-green jxt-font">--</li>
																	<li class="li-cnt jxt-blue jxt-font">--</li>
																</ul>
																<ul class="tab-content-ul" style="width: 14.2857%;">
																	<li class="li-name ">支付人数</li>
																	<li class="li-cnt jxt-green jxt-font">--</li>
																	<li class="li-cnt jxt-blue jxt-font">--</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
											<a href="#" class="grey-link staff-link">由生意参谋提供 &gt;</a>
											<div class="tip-text">
												<h3 class="chart-title ">趋势分析
													<span class="next-select medium selectOpt">
														<span class="next-select-inner">详情页跳失率</span>
														<i class="icon-arrow icon caret"></i>

														<div class="next-menu ver next-overlay-inner animated expandInDown next-select-menu" style="position: absolute;z-index: 10000002; left: 0; top: 26px; width: 168px;">
															<ul class="next-menu-content">
																<li class="next-menu-item">商品访客数</li>
																<li class="next-menu-item">详情页跳失率</li>
																<li class="next-menu-item">加购人数</li>
																<li class="next-menu-item selected">支付人数</i></li>
															</ul>
														</div>
													</span>
												</h3>
												<div class="chart-container">
													<div id="trend-analysis-chart" class="trend-analysis-chart" style="width: 1600px;height: 300px;margin: 0 auto;"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- 客户列表 -->
				<div class="customer-list-wrap main-switch-wrap">
					<div class="jxt-top-tips">
    					<div class="title">“VIP设置”、“会员卡管理”功能入口迁移到“忠诚度管理”菜单啦。|| 客户列表查询客户数时，15万以内会显示具体数量，大于15万则只显示概数。|| 共能暂不对航旅、虚拟类目卖家提供服务。
    						<a target="_blank" class="invisible">查看详情</a>
    					</div>
					</div>
					<div class="main-block customer_manage container-fluid">
						<div class="title row"><h3>客户列表</h3></div>
						<div class="nav row">
							<ul class="nav nav-tabs tab-wraped clearfix">
								<li class="col-md-4 col-sm-4 active">
									<a href="#dealedCustomers">
        								<h4>成交客户</h4>
    								</a>
								</li>
								<li class="col-md-4 col-sm-4">
									<a href="#dealedCustomers">
        								<h4>未成交客户</h4>
    								</a>
								</li>
								<li class="col-md-4 col-sm-4">
									<a href="#dealedCustomers">
        								<h4>询单客户</h4>
    								</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane">  <!--tab-->
									<form class="form-horizontal">
										<div class="form-group">
											<div class="col-md-4 col-sm-4 tag-container gap">
												<label>分组名称</label>
												<input type="text" class="select-tag form-control" placeholder="不限" value="">
											</div>
											<div class="col-md-4 col-sm-4 tag-container gap">
												<label>客户昵称</label>
												<input type="text" class="select-tag form-control" placeholder="不限" value="">
											</div>
											<!-- 更多手气内容 start-->
											<div class="col-md-4 col-sm-4 toggle toggle hidden">
												<label>会员级别</label>
												<span class="separator"></span>
												<label class="select">
													<select class="form-control input-xl">
														<option value="-1">不限</option>
														<option value="1">普通会员</option>
														<option value="2">高级会员</option>
														<option value="3">VIP会员</option>
														<option value="4">至尊VIP会员</option>
													</select>
													<i class="wsif wsif-down"></i>
												</label>
											</div>
											<div class="col-md-4 col-sm-4 toggle gap hidden">
												<label>交易额(元)</label>
												<div class="trade-container clearfix">
													<input type="text" class="trade-num form-control lf" value="0">-
													<input type="text" class="trade-num form-control" placeholder="不限" value="">
												</div>
											</div>
											<div class="col-md-4 col-sm-4 toggle gap hidden">
												<label>交易笔数</label>
												<div class="trade-container clearfix">
													<input type="text" class="trade-num form-control lf" value="1">-
													<input type="text" class="trade-num form-control" placeholder="不限">
												</div>
											</div>
											<div class="col-md-4  col-sm-4 toggle form-inline hidden">
												<label>上次交易时间</label>
												<div class="input-daterange">
													<input type="text" class="trade1 form-control input-date lf" placeholder="不限" value="">-<input type="text" class="trade2 form-control input-date" placeholder="不限" value="">
												</div>
											</div>
											<div class="col-md-4 col-sm-4 toggle gap area-container hidden">
												<label>地区</label>
												<label class="select">
													<select class="form-control input-xl">
														<option value="0">请选择</option>
														<option value="110000">北京</option>
														<option value="120000">安徽</option>
														<option value="120000">浙江</option>
														<option value="120000">山西</option>
														<option value="120000">天津</option>
														<option value="130000">河北</option>
													</select>
													<i class="wsif wsif-down"></i>
												</label>
											</div>
											<div class="col-md-4 col-sm-4 toggle gap hidden">
												<label>性别</label>
												<label class="select sex">
													<select class="form-control input-xl">
														<option value="0">不限</option>
														<option value="1">男</option>
														<option value="2">女</option>
													</select>
													<i class="wsif wsif-down"></i>
												</label>
											</div>
											<div class="col-md-4 col-sm-4 toggle form-inline hidden">
												<label>生日</label>
												<div class="input-daterange">
													<label class="select">
														<select class="form-control input-lg input-date lf">
									                        <option value="">不限</option>
									                        <option value="1">01月</option>
									                        <option value="2">02月</option>
									                        <option value="3">03月</option>
									                        <option value="4">04月</option>
									                        <option value="5">05月</option>
									                        <option value="6">06月</option>
									                        <option value="7">07月</option>
									                        <option value="8">08月</option>
									                        <option value="9">09月</option>
									                        <option value="10">10月</option>
									                        <option value="11">11月</option>
									                        <option value="12">12月</option>
									                    </select>
									                    <i class="wsif wsif-down"></i>
													</label>
													<label class="line-icon">-</label>
													<label class="select">
									                    <select class="form-control input-lg input-date">
									                        <option value="">不限</option>
									                        <option value="1">01月</option>
									                        <option value="2">02月</option>
									                        <option value="3">03月</option>
									                        <option value="4">04月</option>
									                        <option value="5">05月</option>
									                        <option value="6">06月</option>
									                        <option value="7">07月</option>
									                        <option value="8">08月</option>
									                        <option value="9">09月</option>
									                        <option value="10">10月</option>
									                        <option value="11">11月</option>
									                        <option value="12">12月</option>
									                    </select>
									                    <i class="wsif wsif-down"></i>
									                </label>
												</div>
											</div>
											<div class="col-md-4  col-sm-4 toggle gap clear hidden">
												<label>会员折扣</label>
												<label class="select">
									                <select class="form-control input-xl">
									                    <option value="0">不限</option>
									                    <option value="1">享受会员折扣</option>
									                    <option value="-3">不享受会员折扣</option>
									                </select>
									                <i class="wsif wsif-down"></i>
									            </label>
											</div>
											<div class="col-md-4 col-sm-4 toggle gap space hidden"></div>
											<!-- <div class="col-md-4 col-sm-4 query">
												<span class="unfold J_unfold">
													<span>收起</span>
													<i class="wsif wsif-up"></i>
												</span>
												<button class="btn btn-primary">搜索</button>
											</div> -->
											<!-- 更多手气内容 end-->
											<div class="col-md-4 col-sm-4 query">
									            <span class="unfold J_unfold">
									            	<span>更多</span><i class="wsif wsif-down icon icon-arrow caret"></i>
									            </span>
									            <button class="btn btn-primary">搜索</button>
									        </div>
										</div>
									</form>
									<div class="content-container">
										<div class="content-head">
											<div class="benefit-container lf">
												<span class="multi-setting J_multiSetting disabled">批量设置</span>
												<span class="J_SendCouponBtn disabled">送优惠券</span>
												<a href="index.php?ctl=Seller_Sycm&met=groupManage"><span class="groupsManage">分组管理</span></a>
											</div>
										</div>
										<div class="content-table">
											<table class="table table-bordered">
												<thead>
											        <tr>
											            <th class="title-1">
											                <div class="checkbox checkbox-inline">
											                    <input type="checkbox" name="">
											                </div>
											                <span class="title-customer">客户信息</span>
											            </th>
											            <th class="title-4">客户级别</th>
											            <th class="title-4">交易总额(元)</th>
											            <th class="title-4">交易笔数(笔)</th>
											            <th class="title-4">平均交易金额(元)</th>
											            <th class="title-5">上次交易时间</th>
											            <th class="title-6">操作</th>
        											</tr>
											        <tr>
											            <td colspan="8" class="remain-list">
											                <p class="tips">
											                	<i class="wsif wsif-info"></i>已勾选本页<span class="J_selectCurPage" ></span>条，您还可以：<a class="J_selectRemain"></a>
											                </p>
											                <p class="tips1">
											                	<i class="wsif wsif-info"></i>已勾选<span class="J_selectCurPage1"></span>条<a class="J_selectRemain1"></a>
											                </p>
											            </td>
											        </tr>
										        </thead>
										        <tbody>
										        	<tr>
									                    <td>
									                        <div class="customer-td">
									                            <div class="checkbox checkbox-inline">
									                                <label>
									                                    <input type="checkbox"><span></span>
									                                </label>
									                            </div>
									                            <span class="user-head"><i class="iconfont icon-wangwang"></i>xxx168</span>
									                        </div>
									                    </td>
				                    					<td>
				                                            <span class="customer-level">店铺客户</span>
									                    </td>
									                    <td>990.30 </td>
									                    <td>3 </td>
									                    <td>330.10 </td>
									                    <td>2017-09-30</td>
				                                        <td class="table-operation">
	                                                    	<a class="operation jump-detail" style="margin-right: 5px;" target="_blank">详情</a>
				                            				<a class="operation jump-trade" style="margin-right: 5px;" target="_blank">交易记录</a>
				                                        </td>
				               						</tr>
				               						<tr class="label-tr">
									                    <td colspan="8">
									                        <div class="label-container">
									                            <div class="list-label"></div>
									                            <div class="label-operation">
									                                <span class="label-item more" style="display: none;">更多<i class="wsif wsif-down"></i></span>
									                                <div class="list-container">
							                                        	<span class="label-item add"><i class="iconfont icon-jiahao">+</i>添加分组</span>
									                                </div>
                                                            	</div>
									                        </div>
									                    </td>
									                </tr>
									                <tr class="space"></tr>

									                <tr>
									                    <td>
									                        <div class="customer-td">
									                            <div class="checkbox checkbox-inline">
									                                <label>
									                                    <input type="checkbox"><span></span>
									                                </label>
									                            </div>
									                            <span class="user-head"><i class="iconfont icon-wangwang"></i>xxx168</span>
									                        </div>
									                    </td>
				                    					<td>
				                                            <span class="customer-level">店铺客户</span>
									                    </td>
									                    <td>990.30 </td>
									                    <td>3 </td>
									                    <td>330.10 </td>
									                    <td>2017-09-30</td>
				                                        <td class="table-operation">
	                                                    	<a class="operation jump-detail" style="margin-right: 5px;" target="_blank">详情</a>
				                            				<a class="operation jump-trade" style="margin-right: 5px;" target="_blank">交易记录</a>
				                                        </td>
				               						</tr>
				               						<tr class="label-tr">
									                    <td colspan="8">
									                        <div class="label-container">
									                            <div class="list-label"></div>
									                            <div class="label-operation">
									                                <span class="label-item more" style="display: none;">更多<i class="wsif wsif-down"></i></span>
									                                <div class="list-container">
							                                        	<span class="label-item add"><i class="iconfont icon-jiahao">+</i>添加分组</span>
									                                </div>
                                                            	</div>
									                        </div>
									                    </td>
									                </tr>
									                <tr class="space"></tr>

									                <tr>
									                    <td>
									                        <div class="customer-td">
									                            <div class="checkbox checkbox-inline">
									                                <label>
									                                    <input type="checkbox"><span></span>
									                                </label>
									                            </div>
									                            <span class="user-head"><i class="iconfont icon-wangwang"></i>xxx168</span>
									                        </div>
									                    </td>
				                    					<td>
				                                            <span class="customer-level">店铺客户</span>
									                    </td>
									                    <td>990.30 </td>
									                    <td>3 </td>
									                    <td>330.10 </td>
									                    <td>2017-09-30</td>
				                                        <td class="table-operation">
	                                                    	<a class="operation jump-detail" style="margin-right: 5px;" target="_blank">详情</a>
				                            				<a class="operation jump-trade" style="margin-right: 5px;" target="_blank">交易记录</a>
				                                        </td>
				               						</tr>
				               						<tr class="label-tr">
									                    <td colspan="8">
									                        <div class="label-container">
									                            <div class="list-label"></div>
									                            <div class="label-operation">
									                                <span class="label-item more" style="display: none;">更多<i class="wsif wsif-down"></i></span>
									                                <div class="list-container">
							                                        	<span class="label-item add"><i class="iconfont icon-jiahao">+</i>添加分组</span>
									                                </div>
                                                            	</div>
									                        </div>
									                    </td>
									                </tr>
									                <tr class="space"></tr>

									                <tr>
									                    <td>
									                        <div class="customer-td">
									                            <div class="checkbox checkbox-inline">
									                                <label>
									                                    <input type="checkbox"><span></span>
									                                </label>
									                            </div>
									                            <span class="user-head"><i class="iconfont icon-wangwang"></i>xxx168</span>
									                        </div>
									                    </td>
				                    					<td>
				                                            <span class="customer-level">店铺客户</span>
									                    </td>
									                    <td>990.30 </td>
									                    <td>3 </td>
									                    <td>330.10 </td>
									                    <td>2017-09-30</td>
				                                        <td class="table-operation">
	                                                    	<a class="operation jump-detail" style="margin-right: 5px;" target="_blank">详情</a>
				                            				<a class="operation jump-trade" style="margin-right: 5px;" target="_blank">交易记录</a>
				                                        </td>
				               						</tr>
				               						<tr class="label-tr">
									                    <td colspan="8">
									                        <div class="label-container">
									                            <div class="list-label"></div>
									                            <div class="label-operation">
									                                <span class="label-item more" style="display: none;">更多<i class="wsif wsif-down"></i></span>
									                                <div class="list-container">
							                                        	<span class="label-item add"><i class="iconfont icon-jiahao">+</i>添加分组</span>
									                                </div>
                                                            	</div>
									                        </div>
									                    </td>
									                </tr>
									                <tr class="space"></tr>
										        </tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 客户分群 -->
				<div class="customer-clustering-wrap main-switch-wrap">
					<div class="jxt-top-tips">
						<div class="title">
							【非常重要】客户运营平台双11产品公告，请商家务必仔细阅读<a href="javascript:;" target="_blank" class="visible">查看详情</a>
						</div>
						<div class="main">
							<div class="crowd-list">
								<div class="crowd-list-container">
									<div class="main-title">客户分群</div>
									<div>
										<div class="tab-table-list-section-title">
											<div class="blue-crm-title">
												<span class="crm-title">重点运营人群</span>
												<span class="crm-subtitle"></span>
											</div>
										</div>
										<div class="recommend-crowd-wrapper">
											<div class="recommend-crowd-card">
												<div class="crowd-name">
													<img src="https://img.alicdn.com/tfs/TB1DpdDQVXXXXcrXXXXXXXXXXXX-80-80.png" style="width: 40px;height: 40px;">
													<div class="crowd-name-title">兴趣人群</div>
													<div class="crowd-name-desc">近3-10天有加购或收藏行为，且近期没有购买加购或者收藏商品的客户。</div>
												</div>
												<div class="count-data crowd-count">
													<div class="title">人群</div>
													<div class="count">
														<span>--</span>
													</div>
												</div>
												<div class="count-data count-data-minor">
													<div class="title">昨日访客</div>
													<div class="count">
														<span>--</span>
													</div>
												</div>
												<div class="count-data count-data-minor">
													<div class="title">昨日成交</div>
													<div class="count">
														<span>--</span>
													</div>
												</div>
												<div class="foot-links">
													<a href="javascript:;" class="next-btn next-btn-secondary next-btn-small disabled" >人群分析
														<span class="tips-wrap">
															<!-- <i class="icon icon-tips"></i> -->
															<div class="tips-guide-wrap">
																人群覆盖人数过低，无法查看人群分析情况
															</div>
														</span>
													</a>
													<a href="index.php?ctl=Seller_Sycm&met=bizplan" class="next-btn next-btn-primary next-btn-small">定向运营</a>
												</div>
											</div>
											<div class="recommend-crowd-card">
												<div class="crowd-name">
													<img src="https://img.alicdn.com/tfs/TB1DpdDQVXXXXcrXXXXXXXXXXXX-80-80.png" style="width: 40px;height: 40px;">
													<div class="crowd-name-title">新客户人群</div>
													<div class="crowd-name-desc">720天内只成交过一次，且此次成交在最近180天内。</div>
												</div>
												<div class="count-data crowd-count">
													<div class="title">人群</div>
													<div class="count">
														<span>--</span>
													</div>
												</div>
												<div class="count-data count-data-minor">
													<div class="title">昨日访客</div>
													<div class="count">
														<span>--</span>
													</div>
												</div>
												<div class="count-data count-data-minor">
													<div class="title">昨日成交</div>
													<div class="count">
														<span>--</span>
													</div>
												</div>
												<div class="foot-links">
													<a href="javascript:;" class="next-btn next-btn-secondary next-btn-small disabled">人群分析
														<span class="tips-wrap">
															<!-- <i class="icon icon-tips"></i> -->
															<div class="tips-guide-wrap">
																人群覆盖人数过低，无法查看人群分析情况
															</div>
														</span>
													</a>
													<a href="javascript:;" class="next-btn next-btn-primary next-btn-small disabled">定向运营
														<span class="tips-wrap">
															<!-- <i class="icon icon-tips"></i> -->
															<div class="tips-guide-wrap">
																此功能即将上线，敬请期待
															</div>
														</span>
													</a>
												</div>
											</div>
											<div class="recommend-crowd-card">
												<div class="crowd-name">
													<img src="https://img.alicdn.com/tfs/TB1DpdDQVXXXXcrXXXXXXXXXXXX-80-80.png" style="width: 40px;height: 40px;">
													<div class="crowd-name-title">复购人群</div>
													<div class="crowd-name-desc">买过店铺内复购率较高商品，且处于回购周期的客户。</div>
												</div>
												<div class="count-data crowd-count">
													<div class="title">人群</div>
													<div class="count">
														<span>--</span>
													</div>
												</div>
												<div class="count-data count-data-minor">
													<div class="title">昨日访客</div>
													<div class="count">
														<span>--</span>
													</div>
												</div>
												<div class="count-data count-data-minor">
													<div class="title">昨日成交</div>
													<div class="count">
														<span>--</span>
													</div>
												</div>
												<div class="foot-links">
													<a href="javascript:;" class="next-btn next-btn-secondary next-btn-small disabled" >人群分析
														<span class="tips-wrap">
															<!-- <i class="icon icon-tips"></i> -->
															<div class="tips-guide-wrap">
																人群覆盖人数过低，无法查看人群分析情况
															</div>
														</span>
													</a>
													<a href="index.php?ctl=Seller_Sycm&met=intelligentShopReminder" class="next-btn next-btn-primary next-btn-small">定向运营</a>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-table-list-section-title">
										<div class="blue-crm-title">
											<span class="crm-title">我的人群度</span>
											<span class="crm-subtitle"></span>
										</div>
									</div>
									<div class="fr-opt">
										<button type="button" class="next-btn next-btn-primary next-btn-medium create-crowd fr">＋&nbsp;新建人群</button>
										<div class="has-clear-search has-clear-medium">
											<span class="next-input next-input-single next-input-medium fr">
												<input type="text" placeholder="输入人群名称" value="" height="100%">
											</span>
											<button type="button" class="next-btn next-btn-primary next-btn-small">
												<i class="next-icon next-icon-search next-icon-medium next-icon-first next-icon-last"></i>
											</button>
										</div>
									</div>
									<div class="table-span">
										<div class="next-tabs next-tabs-top next-tabs next-tabs-strip next-tabs-medium">
											<div class="next-tabs-bar">
												<div class="next-tabs-nav-container ">
													<div class="next-tabs-nav-wrap">
														<div class="next-tabs-nav-scroll" style="width: 100%;">
															<div class="next-tabs-nav">
																<div class="next-tabs-tab next-tabs-tab-active">
																	<div class="next-tabs-tab-inner">自定义人群</div>
																</div>
																<div class="next-tabs-tab">
																	<div class="next-tabs-tab-inner">系统推荐人群</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="next-tabs-content">
												<div class="next-tabs-tabpane">
													<div class="c-table-wrap">
														<div class="next-table only-bottom-border">
															<div class="next-table-inner">
																<div class="next-table-header">
																	<div class="next-table-header-inner">
																		<table>
																			<colgroup>
																				<col>
																				<col>
																				<col>
																				<col>
																				<col>
																			</colgroup>
																			<tbody>
																				<tr>
																					<th rowspan="1">
																						<div class="next-table-cell-wrapper">人群名称</div>
																					</th>
																					<th rowspan="1">
																						<div class="next-table-cell-wrapper">人群定义</div>
																					</th>

																					<th rowspan="1">
																						<div class="next-table-cell-wrapper">创建时间</div>
																					</th>
																					<th rowspan="1">
																						<div class="next-table-cell-wrapper">人群数量
																							<span class="tips-wrap">
																								<i class="icon icon-tips"></i>
																								<div class="tips-guide-wrap">
																									指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																								</div>
																							</span>
																						</div>
																					</th>
																					<th rowspan="1">
																						<div class="next-table-cell-wrapper">操作</div>
																					</th>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
																<div class="next-table-body">
																	<table>
																		<colgroup>
																			<col>
																			<col>
																			<col>
																			<col>
																			<col>
																		</colgroup>
																		<tbody>
																			<tr>
																				<td colspan="5">
																					<div class="next-table-empty">
																						<div>
																							<img src="https://gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																							<div class="error-msg">暂无数据</div>
																						</div>
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
												<div class="next-tabs-tabpane">
													<div class="c-table-wrap">
														<div class="next-table only-bottom-border">
															<div class="next-table-inner">
																<div class="next-table-header">
																	<div class="next-table-header-inner">
																		<table>
																			<colgroup>
																				<col>
																				<col>
																				<col>
																				<col>
																				<col>
																				<col>
																			</colgroup>
																			<tbody>
																				<tr>
																					<th rowspan="1">
																						<div class="next-table-cell-wrapper">使用热度
																							<span class="tips-wrap">
																								<i class="icon icon-tips"></i>
																								<div class="tips-guide-wrap">
																									指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																								</div>
																							</span>
																						</div>
																					</th>
																					<th rowspan="1">
																						<div class="next-table-cell-wrapper">人群名称</div>
																					</th>

																					<th rowspan="1">
																						<div class="next-table-cell-wrapper">人群定义</div>
																					</th>
																					<th rowspan="1">
																						<div class="next-table-cell-wrapper">推荐理由</div>
																					</th>
																					<th rowspan="1">
																						<div class="next-table-cell-wrapper">人群数量
																							<span class="tips-wrap">
																								<i class="icon icon-tips"></i>
																								<div class="tips-guide-wrap">
																									指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																								</div>
																							</span>
																						</div>
																					</th>
																					<th rowspan="1">
																						<div class="next-table-cell-wrapper">操作</div>
																					</th>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
																<div class="next-table-body">
																	<table>
																		<colgroup>
																			<col>
																			<col>
																			<col>
																			<col>
																			<col>
																			<col>
																		</colgroup>
																		<tbody>
																			<tr class="next-table-row first">
																				<td>
																					<div class="next-table-cell-wrapper">
																						<span>
																							<span class="new-icon">new</span>
																						</span>
																					</div>
																				</td>
																				<td>
																					<div class="next-table-cell-wrapper">店铺会员人群</div>
																				</td>
																				<td>
																					<div class="next-table-cell-wrapper">
																						<div class="crowd-content">
																							<span>店铺会员，达到本店铺 vip1 会员条件以上的客户</span>
																						</div>
																					</div>
																				</td>
																				<td>
																					<div class="next-table-cell-wrapper">店铺会员人群为店铺忠诚度最高的高价值人群，可针对该人群做定向权益、召回等，强化会员粘性</div>
																				</td>
																				<td>
																					<div class="next-table-cell-wrapper">低于300人</div>
																				</td>
																				<td>
																					<div class="next-table-cell-wrapper">
																						<span>
																							<button type="button" class="next-btn next-btn-text next-btn-primary next-btn-medium opt-btn">定向优惠</button>
																						</span>
																					</div>
																				</td>
																				<!-- <td colspan="6">
																					<div class="next-table-empty">
																						<div>
																							<img src="https://gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																							<div class="error-msg">暂无数据</div>
																						</div>
																					</div>
																				</td> -->
																			</tr>
																			<tr class="next-table-row first">
																				<td>
																					<div class="next-table-cell-wrapper">
																						<span>
																							<span class="new-icon">new</span>
																						</span>
																					</div>
																				</td>
																				<td>
																					<div class="next-table-cell-wrapper">店铺会员人群</div>
																				</td>
																				<td>
																					<div class="next-table-cell-wrapper">
																						<div class="crowd-content">
																							<span>店铺会员，达到本店铺 vip1 会员条件以上的客户</span>
																						</div>
																					</div>
																				</td>
																				<td>
																					<div class="next-table-cell-wrapper">店铺会员人群为店铺忠诚度最高的高价值人群，可针对该人群做定向权益、召回等，强化会员粘性</div>
																				</td>
																				<td>
																					<div class="next-table-cell-wrapper">低于300人</div>
																				</td>
																				<td>
																					<div class="next-table-cell-wrapper">
																						<span>
																							<button type="button" class="next-btn next-btn-text next-btn-primary next-btn-medium opt-btn">定向优惠</button>
																							<button type="button" class="next-btn next-btn-text next-btn-primary next-btn-medium opt-btn">个性化首页</button>
																						</span>
																					</div>
																				</td>
																				<!-- <td colspan="6">
																					<div class="next-table-empty">
																						<div>
																							<img src="https://gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																							<div class="error-msg">暂无数据</div>
																						</div>
																					</div>
																				</td> -->
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
							</div>
						</div>
					</div>
				</div>
				<!-- 客户分析 -->
				<div class="customer-analysis-wrap main-switch-wrap">
					<div class="jxt-top-tips">
						<div class="title">
							【非常重要】客户运营平台双11产品公告，请商家务必仔细阅读！<a href="javascript:;" target="_blank" class="visible">查看详情</a>
						</div>
					</div>
					<div class="main">
						<div>
							<div class="outer-container">
								<div class="inner-container-up">
									<div class="header-panel up-header">
										<i class="iconfont rectangle">|</i>
										<span class="title">客户运营指数</span>
										<sapn class="sub-title">
											<span class="information">阿里巴巴商家事业部&amp;CBNData联合推出</span>
											<a href="javascript:void(0)" class="detail-link">详解<span>&gt;&gt;</span></a>
										</sapn>
										<span class="flex-1"></span>
										<div style="padding-right: 10px;" class="rt">
											<div class="next-date-picker next-date-picker-medium">
												<span class="next-input next-input-single next-input-medium">
													<input type="text" value="2017-11-02" placeholder="请选择日期" height="100%">
												</span>
												<i class="next-icon next-icon-delete-filling next-icon-small">x</i>
											</div>
										</div>
									</div>
									<div class="preheat-wrapper clearfix">
										<div class="preheat-info">
											<div class="preheat-info-title-wrapper clearFix">
												<div>
													<h5 class="operation-index-title">
														<span>运营指数</span>
													</h5>
													<div class="preheat-info-change">
														<i class="chart-icon-active"></i>
														<i></i>
													</div>
												</div>
												<div class="chart-wrapper">
													<div style="height: 470px;">
														<div class="score-wrapper clearfix">
															<p class="score">
																<span class="score-title">昨日得分</span>
																<span class="score-info">3071</span>
															</p>
															<div class="preheat-chart-legend">
																<div class="legend-body">
																	<b class="legend-1-color"></b>
																	<h6 class="legend-1-name">本店</h6>
																	<b class="legend-2-color"></b>
																	<h6 class="legend-2-name">同行同层平均</h6>
																</div>
															</div>
														</div>
														<div class="preheat-radar-wrap" style="position: relative;width: 380px;height: 400px;margin:0 auto;">
															<div class="radar-label-t radar-label">
																<div class="radar-title-data">
																	<span class="radar-title-data-self">1,039</span>/
																	<span class="radar-title-data-average">1,045</span>
																</div>
															</div>
															<div class="radar-label-l radar-label">
																<div class="radar-title-data">
																	<span class="radar-title-data-self">1,039</span>/
																	<span class="radar-title-data-average">1,009</span>
																</div>
															</div>
															<div class="radar-label-r radar-label">
																<div class="radar-title-data">
																	<span class="radar-title-data-self">1,039</span>/
																	<span class="radar-title-data-average">1,007</span>
																</div>
															</div>
															<div class="radar-label-b radar-label">
																<div class="radar-title-data">
																	<span class="radar-title-data-self">-</span>/
																	<span class="radar-title-data-average">1,013</span>
																</div>
															</div>
															<div id="preheat-radar" class="preheat-radar" style="width: 380px;height: 400px;"></div>
														</div>
													</div>
												</div>
												<div class="chart-wrapper">
													<div style="height: 470px;">
														<div class="score-wrapper clearfix">
															<p class="score">
																<span class="score-title">昨日得分</span>
																<span class="score-info">3071</span>
															</p>
															<div class="preheat-chart-legend">
																<div class="legend-body">
																	<b class="legend-1-color"></b>
																	<h6 class="legend-1-name">本店</h6>
																	<b class="legend-2-color"></b>
																	<h6 class="legend-2-name">同行同层平均</h6>
																</div>
															</div>
														</div>
														<div class="preheat-radar-wrap" style="position: relative;width: 100%;height: 400px;margin:0 auto;">
															<!-- 下拉框 -->
															<div style=" position: absolute; z-index: 20;right:200px;top:-25px;">
																<span class="next-select medium">
																	<input type="hidden">
																	<span class="next-select-inner">加购件数</span>
																	<i class="caret icon-arrow icon"></i>
																</span>
																<div class="next-menu ver next-overlay-inner animated expandInDown next-select-menu " style="position: absolute; left: 0; top: 27px; width: 98px;">
																	<ul class="next-menu-content">
																		<li class="next-menu-item">预热指数</li>
																		<li class="next-menu-item">访客数</li>
																		<li class="next-menu-item">加购人数</li>
																		<li class="next-menu-item selected">加购件数</i></li>
																		<li class="next-menu-item">收藏人数</li>
																		<li class="next-menu-item">跳失率</li>
																		<li class="next-menu-item">领券人数</li>
																	</ul>
																</div>
															</div>
															<div id="preheat-radar-line" class="preheat-radar-line" style="width: 100%;height: 400px;"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="preheat-rank">
											<div class="preheat-info-title-wrapper clearfix">
												<div>
													<h5 class="operation-index-title">
														<span>运营指数排名</span>
													</h5>
													<div class="preheat-info-change">
														<i class="chart-icon-active peer-rank icon-font-container"></i>
														<i class="self-rank icon-font-container"></i>
														<i class="soaring-rank"></i>
													</div>
												</div>
											</div>
											<div style="height: 470px;">
												<div class="score-wrapper clearFix">
													<p class="score" style="float: left;">
														<span class="score-title">行业排名</span>
														<span class="score-info">68013</span>
													</p>
													<p class="score " style="float: left; margin-left: 10%;">
														<span class="score-title">昨日对比</span>
														<span class="score-info">5949</span>
														<span class="up" style="position: relative; top: 10px;">
															<i class="icon-trend"></i>
														</span>
													</p>
												</div>
												<div class="rank-table-wrapper">
													<div class="rank-table">
														<ul>
															<li class="rank-table-c-rank">01</li>
															<li style="width: 60%;">
																<span class="rank-table-c-clustars">
																	<i class="clustars-1"></i>
																</span>
																<span class="rank-table-c-name">莱茵国际</span>
															</li>
															<li class="rank-table-c-score" style="width: 15%;">5710</li>
															<li class="up" style="text-align: left; width: 15%;">
																<i class="icon-trend"></i>
																<span>1</span>
															</li>
														</ul>
														<ul>
															<li class="rank-table-c-rank">01</li>
															<li style="width: 60%;">
																<span class="rank-table-c-clustars">
																	<i class="clustars-1"></i>
																</span>
																<span class="rank-table-c-name">莱茵国际</span>
															</li>
															<li class="rank-table-c-score" style="width: 15%;">5710</li>
															<li class="down" style="text-align: left; width: 15%;">
																<i class="icon-trend"></i>
																<span>1</span>
															</li>
														</ul>
														<ul>
															<li class="rank-table-c-rank">01</li>
															<li style="width: 60%;">
																<span class="rank-table-c-clustars">
																	<i class="clustars-1"></i>
																</span>
																<span class="rank-table-c-name">莱茵国际</span>
															</li>
															<li class="rank-table-c-score" style="width: 15%;">5710</li>
															<li class="up" style="text-align: left; width: 15%;">
																<i class="icon-trend"></i>
																<span>1</span>
															</li>
														</ul>
														<ul>
															<li class="rank-table-c-rank">01</li>
															<li style="width: 60%;">
																<span class="rank-table-c-clustars">
																	<i class="clustars-1"></i>
																</span>
																<span class="rank-table-c-name">莱茵国际</span>
															</li>
															<li class="rank-table-c-score" style="width: 15%;">5710</li>
															<li class="up" style="text-align: left; width: 15%;">
																<i class="icon-trend"></i>
																<span>1</span>
															</li>
														</ul>
														<ul>
															<li class="rank-table-c-rank">01</li>
															<li style="width: 60%;">
																<span class="rank-table-c-clustars">
																	<i class="clustars-1"></i>
																</span>
																<span class="rank-table-c-name">莱茵国际</span>
															</li>
															<li class="rank-table-c-score" style="width: 15%;">5710</li>
															<li class="up" style="text-align: left; width: 15%;">
																<i class="icon-trend"></i>
																<span>1</span>
															</li>
														</ul>
														<ul>
															<li class="rank-table-c-rank">01</li>
															<li style="width: 60%;">
																<span class="rank-table-c-clustars">
																	<i class="clustars-1"></i>
																</span>
																<span class="rank-table-c-name">莱茵国际</span>
															</li>
															<li class="rank-table-c-score" style="width: 15%;">5710</li>
															<li class="up" style="text-align: left; width: 15%;">
																<i class="icon-trend"></i>
																<span>1</span>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>
									<div>
										<div class="inner-container-down" style="height: 247px;">
											<div class="header-panel down-header">
												<i class="iconfont rectangle">|</i>
												<span class="title">人群指标分解</span>
												<span class="flex-1"></span>
												<div class="next-tabs next-tabs-top next-tabs next-tabs-capsule next-tabs-medium next-tabs-xsmall tab">
													<div class="next-tabs-bar">
														<div class="next-tabs-nav-container ">
															<div class="next-tabs-nav-wrap">
																<div class="next-tabs-nav-scroll">
																	<div class="next-tabs-nav">
																		<div class="next-tabs-tab-active next-tabs-tab">
																			<div class="next-tabs-tab-inner">访客</div>
																		</div>
																		<div class="next-tabs-tab">
																			<div class="next-tabs-tab-inner">粉丝</div>
																		</div>
																		<div class="next-tabs-tab">
																			<div class="next-tabs-tab-inner">会员</div>
																		</div>
																		<div class="next-tabs-tab">
																			<div class="next-tabs-tab-inner">成交客户</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="next-tabs-content">
														<div class="next-tabs-tabpane">
															<div class="tagblock">
																<div class="header">访客数
																	<span class="tips-wrap">
																		<i class="icon icon-tips"></i>
																		<div class="tips-guide-wrap">
																			指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																		</div>
																	</span>
																	<i class="iconfont question"></i>
																</div>
																<div class="number jxt-font">0</div>
																<div class="chart">
																	<div class="small-chart1" id="small-chart1" style="width: 200px;height: 80px;"></div>
																</div>
															</div>
															<div class="tagblock">
																<div class="header">跳失率
																	<span class="tips-wrap">
																		<i class="icon icon-tips"></i>
																		<div class="tips-guide-wrap">
																			指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																		</div>
																	</span>
																	<i class="iconfont question"></i>
																</div>
																<div class="number jxt-font">0</div>
																<div class="chart">
																	<div class="small-chart1" id="small-chart2" style="width: 200px;height: 80px;"></div>
																</div>
															</div>
															<div class="tagblock">
																<div class="header">支持转化率
																	<span class="tips-wrap">
																		<i class="icon icon-tips"></i>
																		<div class="tips-guide-wrap">
																			指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																		</div>
																	</span>
																	<i class="iconfont question"></i>
																</div>
																<div class="number jxt-font">0</div>
																<div class="chart">
																	<div class="small-chart1" id="small-chart3" style="width: 200px;height: 80px;"></div>
																</div>
															</div>
															<div class="tagblock">
																<div class="header">平均停留时长
																	<span class="tips-wrap">
																		<i class="icon icon-tips"></i>
																		<div class="tips-guide-wrap">
																			指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																		</div>
																	</span>
																	<i class="iconfont question"></i>
																</div>
																<div class="number jxt-font">0</div>
																<div class="chart">
																	<div class="small-chart1" id="small-chart4" style="width: 200px;height: 80px;"></div>
																</div>
															</div>
															<div class="tagblock">
																<div class="header">人均浏览量
																	<span class="tips-wrap">
																		<i class="icon icon-tips"></i>
																		<div class="tips-guide-wrap">
																			指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																		</div>
																	</span>
																	<i class="iconfont question"></i>
																</div>
																<div class="number jxt-font">0</div>
																<div class="chart">
																	<div class="small-chart1" id="small-chart5" style="width: 200px;height: 80px;"></div>
																</div>
															</div>
														</div>
														<div class="next-tabs-tabpane">
															<div class="tagblock">
																<div class="header">粉丝总数
																	<span class="tips-wrap">
																		<i class="icon icon-tips"></i>
																		<div class="tips-guide-wrap">
																			指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																		</div>
																	</span>
																	<i class="iconfont question"></i>
																</div>
																<div class="number jxt-font">0</div>
																<div class="chart">
																	<div class="small-chart1" id="small-chart6" style="width: 200px;height: 80px;"></div>
																</div>
															</div>
															<div class="tagblock">
																<div class="header">新增粉丝
																	<span class="tips-wrap">
																		<i class="icon icon-tips"></i>
																		<div class="tips-guide-wrap">
																			指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																		</div>
																	</span>
																	<i class="iconfont question"></i>
																</div>
																<div class="number jxt-font">0</div>
																<div class="chart">
																	<div class="small-chart1" id="small-chart7" style="width: 200px;height: 80px;"></div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<span class="flex-2"></span>
												<div class="next-date-picker next-date-picker-size-medium timepicker">
													<span class="next-input next-input-single next-input-medium">
														<input type="text" value="2017-11-02" placeholder="请选择日期" height="100%">
													</span>
													<i class="next-icon next-icon-calendar next-icon-medium">x</i>
												</div>
											</div>
										</div>
										<div class="inner-container-down tab-down" style="margin-top: 0px; margin-bottom: 40px; height: auto;">
											<div class="header-panel down-header">
												<i class="iconfont rectangle">|</i>
												<span class="title">人群洞察</span>
												<span style="font-size: 12px; color: rgb(102, 102, 102); margin-left: 5px;">(月更新)</span>
												<span style="font-size: 12px; color: rgb(102, 102, 102); text-align: right; padding-right: 14px; flex: 1 1 0%;">店铺访客10月行为统计</span>
											</div>
											<div class="little_lineChart_error">
												<p class="noData-div" style="font-size: 14px; color: rgb(102, 102, 102);">
													<img class="now-noData" src="//img.alicdn.com/tps/TB14m3pKVXXXXalXpXXXXXXXXXX-48-51.png">当前人数过少，无法展示洞察结果
												</p>
											</div>
										</div>
										<div class="inner-container-down tab-down" style="display:none;margin-top: 0px; margin-bottom: 40px; height: auto;">
											<div class="header-panel down-header">
												<i class="iconfont rectangle">|</i>
												<span class="title">粉丝人群洞察</span>
												<span style="font-size: 12px; color: rgb(102, 102, 102); margin-left: 5px;">(月更新)</span>
												<span style="font-size: 12px; color: rgb(102, 102, 102); text-align: right; padding-right: 14px; flex: 1 1 0%;">店铺访客10月行为统计</span>
											</div>
											<div class="little_lineChart_error">
												<p class="noData-div" style="font-size: 14px; color: rgb(102, 102, 102);">
													<img class="now-noData" src="//img.alicdn.com/tps/TB14m3pKVXXXXalXpXXXXXXXXXX-48-51.png">当前人数过少，无法展示洞察结果
												</p>
											</div>
										</div>
										<div class="inner-container-down tab-down" style="display:none;margin-top: 0px; margin-bottom: 40px; height: auto;">
											<div class="header-panel down-header">
												<i class="iconfont rectangle">|</i>
												<span class="title">会员人群洞察</span>
												<span style="font-size: 12px; color: rgb(102, 102, 102); margin-left: 5px;">(月更新)</span>
												<span style="font-size: 12px; color: rgb(102, 102, 102); text-align: right; padding-right: 14px; flex: 1 1 0%;">店铺访客10月行为统计</span>
											</div>
											<div class="little_lineChart_error">
												<p class="noData-div" style="font-size: 14px; color: rgb(102, 102, 102);">
													<img class="now-noData" src="//img.alicdn.com/tps/TB14m3pKVXXXXalXpXXXXXXXXXX-48-51.png">当前人数过少，无法展示洞察结果
												</p>
											</div>
										</div>
										<div class="inner-container-down tab-down" style="display:none;margin-top: 0px; margin-bottom: 40px; height: auto;">
											<div class="header-panel down-header">
												<i class="iconfont rectangle">|</i>
												<span class="title">成交客户人群洞察</span>
												<span style="font-size: 12px; color: rgb(102, 102, 102); margin-left: 5px;">(月更新)</span>
												<span style="font-size: 12px; color: rgb(102, 102, 102); text-align: right; padding-right: 14px; flex: 1 1 0%;">店铺访客10月行为统计</span>
											</div>
											<div class="charts" style="width: 100%; display: flex; flex-wrap: wrap; padding-top: 5px; padding-bottom: 20px;">
												<div class="chart-container">
													<div class="chart-box-container">
														<div class="chart-box-header">
															<span class="chart-box-title">老客最近一次购买时间</span>
															<span class="tips-wrap">
																<i class="icon icon-tips"></i>
																<div class="tips-guide-wrap">
																	<ul class="notice-tips-container">
																		<li class="tip"><label>预热指数</label><span class="tip-content">：根据大促预热期间的店铺访客人数、访客跳失率、加购数据、领券数据、收藏数据等数据综合计算。预热指数可反馈商家大促蓄水情况。</span></li>
																		<li class="tip"><label>访客人数</label><span class="tip-content">：全店访客人数</span></li>
																		<li class="tip"><label>访客跳失率</label><span class="tip-content">：一天内，店铺浏览量为1的访客数/店铺总访客数</span></li>
																		<li class="tip"><label>加购人数</label><span class="tip-content">：将店铺商品加入购物车的客户数</span></li>
																		<li class="tip"><label>收藏人数</label><span class="tip-content">：收藏店铺的客户数</span></li>
																		<li class="tip"><label>领券人数</label><span class="tip-content">：领取店铺优惠券的客户数</span></li>
																	</ul>
																</div>
															</span>
														</div>
														<div class="chart-box-content">
															<div id="last-buy-chart" class="last-buy-chart" style="width: 578px;height: 330px; margin: 0 auto;" ></div>
														</div>
													</div>
												</div>
												<div class="chart-container">
													<div class="chart-box-container">
														<div class="chart-box-header">
															<span class="chart-box-title">365天内成交次数占比</span>
															<span class="tips-wrap">
																<i class="icon icon-tips"></i>
																<div class="tips-guide-wrap">
																	<ul class="notice-tips-container">
																		<li class="tip"><label>预热指数</label><span class="tip-content">：根据大促预热期间的店铺访客人数、访客跳失率、加购数据、领券数据、收藏数据等数据综合计算。预热指数可反馈商家大促蓄水情况。</span></li>
																		<li class="tip"><label>访客人数</label><span class="tip-content">：全店访客人数</span></li>
																		<li class="tip"><label>访客跳失率</label><span class="tip-content">：一天内，店铺浏览量为1的访客数/店铺总访客数</span></li>
																		<li class="tip"><label>加购人数</label><span class="tip-content">：将店铺商品加入购物车的客户数</span></li>
																		<li class="tip"><label>收藏人数</label><span class="tip-content">：收藏店铺的客户数</span></li>
																		<li class="tip"><label>领券人数</label><span class="tip-content">：领取店铺优惠券的客户数</span></li>
																	</ul>
																</div>
															</span>
														</div>
														<div class="chart-box-content">
															<div id="chart365-chart" class="chart365-chart" style="width: 578px;height: 330px; margin: 0 auto;" ></div>
														</div>
													</div>
												</div>
												<div class="chart-container">
													<div class="chart-box-container">
														<div class="chart-box-header">
															<span class="chart-box-title">每月成交金额</span>
															<span class="tips-wrap">
																<i class="icon icon-tips"></i>
																<div class="tips-guide-wrap">
																	<ul class="notice-tips-container">
																		<li class="tip"><label>预热指数</label><span class="tip-content">：根据大促预热期间的店铺访客人数、访客跳失率、加购数据、领券数据、收藏数据等数据综合计算。预热指数可反馈商家大促蓄水情况。</span></li>
																		<li class="tip"><label>访客人数</label><span class="tip-content">：全店访客人数</span></li>
																		<li class="tip"><label>访客跳失率</label><span class="tip-content">：一天内，店铺浏览量为1的访客数/店铺总访客数</span></li>
																		<li class="tip"><label>加购人数</label><span class="tip-content">：将店铺商品加入购物车的客户数</span></li>
																		<li class="tip"><label>收藏人数</label><span class="tip-content">：收藏店铺的客户数</span></li>
																		<li class="tip"><label>领券人数</label><span class="tip-content">：领取店铺优惠券的客户数</span></li>
																	</ul>
																</div>
															</span>
														</div>
														<div class="chart-box-content">
															<div id="monthly-turnover-chart" class="monthly-turnover-chart " style="width: 578px;height: 330px; margin: 0 auto;" ></div>
														</div>
													</div>
												</div>
											</div>
											<!-- <div class="little_lineChart_error">
												<p class="noData-div" style="font-size: 14px; color: rgb(102, 102, 102);">
													<img class="now-noData" src="//img.alicdn.com/tps/TB14m3pKVXXXXalXpXXXXXXXXXX-48-51.png">当前人数过少，无法展示洞察结果
												</p>
											</div> -->
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 智能店铺 -->
				<!-- <div class="intelligent-store-wrap main-switch-wrap">智能店铺</div> -->
				<!-- 智能营销 -->
				<div class="intelligent-marketing-wrap main-switch-wrap">
					<div class="jxt-top-tips">
						<div class="title">
							【非常重要】客户运营平台双11产品公告，请商家务必仔细阅读！<a href="javascript:;" target="_blank" class="visible">查看详情</a>
						</div>
					</div>
					<div class="main">
						<div class="intelligent-marketing-page">
							<div class="top-panel-section-title">
								<div class="blue-crm-title">
									<span class="crm-title">智能营销</span>
									<span class="crm-subtitle"></span>
								</div>
							</div>
							<div class="no-tab">
								<div class="marketing-section">
									<div class="cell-pan">
										<div class="entry-cell">
											<img src="https://img.alicdn.com/tfs/TB1zFkQXgMPMeJjy1XbXXcwxVXa-36-40.png" class="icon-img">
											<div class="entry-title">
												<h3>上新老客提醒</h3>
											</div>
											<div class="entry-info" style="color: rgb(153,153,153);">
												您可以在店铺上新时对店铺老客通知提醒，快速提升新品销量和好评
											</div>
											<a href="index.php?ctl=Seller_Sycm&met=newAndOldRemind" class="next-btn next-btn-primary next-btn-medium">
												立即创建
											</a>
										</div>
									</div>
									<div class="cell-pan">
										<div class="entry-cell">
											<img src="https://img.alicdn.com/tfs/TB1zFkQXgMPMeJjy1XbXXcwxVXa-36-40.png" class="icon-img">
											<div class="entry-title">
												<h3>短信营销</h3>
											</div>
											<div class="entry-info" style="color: rgb(153,153,153);">
												您可以在店铺上新时对店铺老客通知提醒，快速提升新品销量和好评
											</div>
											<a href="index.php?ctl=Seller_Sycm&met=messageMarkting" class="next-btn next-btn-primary next-btn-medium">
												立即创建
											</a>
										</div>
									</div>
									
									<div class="cell-pan">
										<span class="icon-tip" style="background-color: rgb(29,193,29);">限时免费</span>
										<div class="entry-cell">
											<img src="https://img.alicdn.com/tfs/TB1zFkQXgMPMeJjy1XbXXcwxVXa-36-40.png" class="icon-img">
											<div class="entry-title">
												<h3>兴趣客户转化</h3>
											</div>
											<div class="entry-info" style="color: rgb(153,153,153);">
												您可以在店铺上新时对店铺老客通知提醒，快速提升新品销量和好评
											</div>
											<a href="index.php?ctl=Seller_Sycm&met=bizplan" class="next-btn next-btn-primary next-btn-medium">
												立即创建
											</a>
										</div>
									</div>
									<div class="cell-pan">
										<span class="icon-tip" style="background-color: rgb(29,193,29);">限时免费</span>
										<div class="entry-cell">
											<img src="https://img.alicdn.com/tfs/TB1zFkQXgMPMeJjy1XbXXcwxVXa-36-40.png" class="icon-img">
											<div class="entry-title">
												<h3>智能复购提醒</h3>
											</div>
											<div class="entry-info" style="color: rgb(153,153,153);">
												您可以在店铺上新时对店铺老客通知提醒，快速提升新品销量和好评
											</div>
											<a href="index.php?ctl=Seller_Sycm&met=intelligentShopReminder" class="next-btn next-btn-primary next-btn-medium">
												立即创建
											</a>
										</div>
									</div>
									<div class="cell-pan">
										<span class="icon-tip" style="background-color: rgb(29,193,29);">限时免费</span>
										<div class="entry-cell">
											<img src="https://img.alicdn.com/tfs/TB1zFkQXgMPMeJjy1XbXXcwxVXa-36-40.png" class="icon-img">
											<div class="entry-title">
												<h3>优惠券关怀</h3>
											</div>
											<div class="entry-info" style="color: rgb(153,153,153);">
												您可以在店铺上新时对店铺老客通知提醒，快速提升新品销量和好评
											</div>
											<a href="index.php?ctl=Seller_Sycm&met=couponCare" class="next-btn next-btn-primary next-btn-medium">
												立即创建
											</a>
										</div>
									</div>
									<div class="cell-pan">
										<span class="icon-tip" style="background-color: rgb(29,193,29);">限时免费</span>
										<div class="entry-cell">
											<img src="https://img.alicdn.com/tfs/TB1zFkQXgMPMeJjy1XbXXcwxVXa-36-40.png" class="icon-img">
											<div class="entry-title">
												<h3>专享打折／减现</h3>
											</div>
											<div class="entry-info" style="color: rgb(153,153,153);">
												您可以在店铺上新时对店铺老客通知提醒，快速提升新品销量和好评
											</div>
											<a href="index.php?ctl=Seller_Sycm&met=discount" class="next-btn next-btn-primary next-btn-medium">
												立即创建
											</a>
										</div>
									</div>
									<div class="cell-pan">
										<span class="icon-tip" style="background-color: rgb(29,193,29);">限时免费</span>
										<div class="entry-cell">
											<img src="https://img.alicdn.com/tfs/TB1zFkQXgMPMeJjy1XbXXcwxVXa-36-40.png" class="icon-img">
											<div class="entry-title">
												<h3>专享价</h3>
											</div>
											<div class="entry-info" style="color: rgb(153,153,153);">
												您可以在店铺上新时对店铺老客通知提醒，快速提升新品销量和好评
											</div>
											<a href="index.php?ctl=Seller_Sycm&met=exclusivePrice" class="next-btn next-btn-primary next-btn-medium">
												立即创建
											</a>
										</div>
									</div>
									<div class="cell-pan">
										<span class="icon-tip" style="background-color: rgb(29,193,29);">限时免费</span>
										<div class="entry-cell">
											<img src="https://img.alicdn.com/tfs/TB1zFkQXgMPMeJjy1XbXXcwxVXa-36-40.png" class="icon-img">
											<div class="entry-title">
												<h3>购物车营销</h3>
											</div>
											<div class="entry-info" style="color: rgb(153,153,153);">
												您可以在店铺上新时对店铺老客通知提醒，快速提升新品销量和好评
											</div>
											<a href="javascript:;" class="next-btn next-btn-primary next-btn-medium">
												立即创建
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-table-list-section-title">
								<div class="blue-crm-title">
									<span class="crm-title">运营计划列表</span>
									<span class="crm-subtitle"></span>
								</div>
							</div>
							<div class="table-span">
								<div class="next-tabs next-tabs-top next-tabs next-tabs-strip next-tabs-medium">
									<div class="next-tabs-bar">
										<div class="next-tabs-nav-container ">
											<div class="next-tabs-nav-wrap">
												<div class="next-tabs-nav-scroll" style="width: 100%;">
													<div class="next-tabs-nav">
														<div class="next-tabs-tab next-tabs-tab-active">
															<div class="next-tabs-tab-inner">双11大促</div>
														</div>
														<div class="next-tabs-tab">
															<div class="next-tabs-tab-inner">上新老客提醒</div>
														</div>
														<div class="next-tabs-tab">
															<div class="next-tabs-tab-inner">短信营销</div>
														</div>
														<div class="next-tabs-tab">
															<div class="next-tabs-tab-inner">兴趣客户转化</div>
														</div>
														<div class="next-tabs-tab">
															<div class="next-tabs-tab-inner">智能复购提醒</div>
														</div>
														<div class="next-tabs-tab">
															<div class="next-tabs-tab-inner">优惠券关怀</div>
														</div>
														<div class="next-tabs-tab">
															<div class="next-tabs-tab-inner">专享打折／减现</div>
														</div>
														<div class="next-tabs-tab">
															<div class="next-tabs-tab-inner">专享价</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
									<div class="next-tabs-content">
										<div class="next-tabs-tabpane">
											<div class="c-table-wrap">
												<div class="next-table only-bottom-border">
													<div class="next-table-inner">
														<div class="next-table-header">
															<div class="next-table-header-inner">
																<table>
																	<colgroup>
																		<col>
																		<col>
																		<col>
																		<col>
																	</colgroup>
																	<tbody>
																		<tr>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">策略名称</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">计划时间</div>
																			</th>

																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">状态</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">操作</div>
																			</th>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="next-table-body">
															<table>
																<colgroup>
																	<col>
																	<col>
																	<col>
																	<col>
																</colgroup>
																<tbody>
																	<tr>
																		<td colspan="4">
																			<div class="next-table-empty">
																				<div>
																					<img src="https://gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																					<div class="error-msg">暂无数据</div>
																				</div>
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
										<div class="next-tabs-tabpane">
											<div class="c-table-wrap">
												<div class="next-table only-bottom-border">
													<div class="next-table-inner">
														<div class="next-table-header">
															<div class="next-table-header-inner">
																<table>
																	<colgroup>
																		<col>
																		<col>
																		<col>
																		<col>
																	</colgroup>
																	<tbody>
																		<tr>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">策略名称</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">计划时间</div>
																			</th>

																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">状态</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">操作</div>
																			</th>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="next-table-body">
															<table>
																<colgroup>
																	<col>
																	<col>
																	<col>
																	<col>
																</colgroup>
																<tbody>
																	<tr>
																		<td colspan="4">
																			<div class="next-table-empty">
																				<div>
																					<img src="https://gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																					<div class="error-msg">暂无数据</div>
																				</div>
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
										<div class="next-tabs-tabpane">
											<div class="c-table-wrap">
												<div class="next-table only-bottom-border">
													<div class="next-table-inner">
														<div class="next-table-header">
															<div class="next-table-header-inner">
																<table>
																	<colgroup>
																		<col>
																		<col>
																		<col>
																		<col>
																	</colgroup>
																	<tbody>
																		<tr>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">策略名称</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">计划时间</div>
																			</th>

																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">状态</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">操作</div>
																			</th>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="next-table-body">
															<table>
																<colgroup>
																	<col>
																	<col>
																	<col>
																	<col>
																</colgroup>
																<tbody>
																	<tr>
																		<td colspan="4">
																			<div class="next-table-empty">
																				<div>
																					<img src="https://gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																					<div class="error-msg">暂无数据</div>
																				</div>
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
										<div class="next-tabs-tabpane">
											<div class="c-table-wrap">
												<div class="next-table only-bottom-border">
													<div class="next-table-inner">
														<div class="next-table-header">
															<div class="next-table-header-inner">
																<table>
																	<colgroup>
																		<col>
																		<col>
																		<col>
																		<col>
																	</colgroup>
																	<tbody>
																		<tr>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">策略名称</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">计划时间</div>
																			</th>

																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">状态</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">操作</div>
																			</th>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="next-table-body">
															<table>
																<colgroup>
																	<col>
																	<col>
																	<col>
																	<col>
																</colgroup>
																<tbody>
																	<tr>
																		<td colspan="4">
																			<div class="next-table-empty">
																				<div>
																					<img src="https://gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																					<div class="error-msg">暂无数据</div>
																				</div>
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
										<div class="next-tabs-tabpane">
											<div class="c-table-wrap">
												<div class="next-table only-bottom-border">
													<div class="next-table-inner">
														<div class="next-table-header">
															<div class="next-table-header-inner">
																<table>
																	<colgroup>
																		<col>
																		<col>
																		<col>
																		<col>
																	</colgroup>
																	<tbody>
																		<tr>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">策略名称</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">计划时间</div>
																			</th>

																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">状态</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">操作</div>
																			</th>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="next-table-body">
															<table>
																<colgroup>
																	<col>
																	<col>
																	<col>
																	<col>
																</colgroup>
																<tbody>
																	<tr>
																		<td colspan="4">
																			<div class="next-table-empty">
																				<div>
																					<img src="https://gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																					<div class="error-msg">暂无数据</div>
																				</div>
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
										<div class="next-tabs-tabpane">
											<div class="c-table-wrap">
												<div class="next-table only-bottom-border">
													<div class="next-table-inner">
														<div class="next-table-header">
															<div class="next-table-header-inner">
																<table>
																	<colgroup>
																		<col>
																		<col>
																		<col>
																		<col>
																	</colgroup>
																	<tbody>
																		<tr>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">策略名称</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">计划时间</div>
																			</th>

																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">状态</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">操作</div>
																			</th>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="next-table-body">
															<table>
																<colgroup>
																	<col>
																	<col>
																	<col>
																	<col>
																</colgroup>
																<tbody>
																	<tr>
																		<td colspan="4">
																			<div class="next-table-empty">
																				<div>
																					<img src="https://gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																					<div class="error-msg">暂无数据</div>
																				</div>
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
										<div class="next-tabs-tabpane">
											<div class="discountedListTab">
												<span class="label active">标签/全网用户</span> |
												<span class="label">店铺VIP</span>
											</div>
											<div class="c-table-wrap">
												<div class="next-table only-bottom-border">
													<div class="next-table-inner">
														<div class="next-table-header">
															<div class="next-table-header-inner">
																<table>
																	<colgroup>
																		<col>
																		<col>
																		<col>
																		<col>
																	</colgroup>
																	<tbody>
																		<tr>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">策略名称</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">计划时间</div>
																			</th>

																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">状态</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">操作</div>
																			</th>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="next-table-body">
															<table>
																<colgroup>
																	<col>
																	<col>
																	<col>
																	<col>
																</colgroup>
																<tbody>
																	<tr>
																		<td colspan="4">
																			<div class="next-table-empty">
																				<div>
																					<img src="https://gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																					<div class="error-msg">暂无数据</div>
																				</div>
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
										<div class="next-tabs-tabpane">
											<div class="c-table-wrap">
												<div class="next-table only-bottom-border">
													<div class="next-table-inner">
														<div class="next-table-header">
															<div class="next-table-header-inner">
																<table>
																	<colgroup>
																		<col>
																		<col>
																		<col>
																		<col>
																	</colgroup>
																	<tbody>
																		<tr>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">策略名称</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">计划时间</div>
																			</th>

																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">状态</div>
																			</th>
																			<th rowspan="1">
																				<div class="next-table-cell-wrapper">操作</div>
																			</th>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="next-table-body">
															<table>
																<colgroup>
																	<col>
																	<col>
																	<col>
																	<col>
																</colgroup>
																<tbody>
																	<tr>
																		<td colspan="4">
																			<div class="next-table-empty">
																				<div>
																					<img src="https://gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																					<div class="error-msg">暂无数据</div>
																				</div>
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
					</div>
				</div>
				<!-- 忠诚度管理 -->
				<div class="loyalty-management-wrap main-switch-wrap">
					<div class="jxt-top-tips">
						<div class="title">
							【非常重要】客户运营平台双11产品公告，请商家务必仔细阅读！<a href="javascript:;" target="_blank" class="visible">查看详情</a>
						</div>
					</div>
					<div class="main">
						<div class="crm-loyalty-management-page">
							<div class="tab-table-list-section-title">
								<div class="blue-crm-title">
									<span class="crm-title">忠诚度管理</span>
									<span class="crm-subtitle"></span>
								</div>
							</div>
							<div class="flex-container">
								<div class="card-span member-container">
									<div class="title">
										会员
									</div>	
									<div class="number-span">
										<span>会员总数</span>
										<span class="span-number jxt-font">
											<span class="unit-span">--</span>
										</span>
									</div>
									<div class="number-span">
										<span>昨日新增</span>
										<span class="span-number jxt-font">
											<span class="unit-span">--</span>
										</span>
									</div>
								</div>
								<div class="card-span member-container">
									<div class="title">
										领取会员卡
									</div>	
									<div class="number-span">
										<span>会员总数</span>
										<span class="span-number jxt-font">
											<span class="unit-span">--</span>
										</span>
									</div>
									<div class="number-span">
										<span>昨日新增</span>
										<span class="span-number jxt-font">
											<span class="unit-span">--</span>
										</span>
									</div>
								</div>
							</div>
							<div class="entry-span">
								<div class="setting-span">
									<div class="img-span">
										<img src="https://img.alicdn.com/tps/TB1NYsjKXXXXXaHXFXXXXXXXXXX-58-58.png">
									</div>
									<div class="desc-span">
										<div class="span-title">VIP设置
											<span class="span-fail">内容在未完成设置之前均无法生效</span>
										</div>
										<div class="span-desc">
											设置您的会员规则、会员等级，及各等级会员对应信息。
										</div>
									</div>
									<div class="span-btn">
										<a href="index.php?ctl=Seller_Sycm&met=defineVIPSystem" class="next-btn next-btn-primary next-btn-medium">立即设置</a>
									</div>
								</div>
								<div class="setting-span">
									<div class="img-span">
										<img src="https://img.alicdn.com/tps/TB1NYsjKXXXXXaHXFXXXXXXXXXX-58-58.png">
									</div>
									<div class="desc-span">
										<div class="span-title">无线端会员装修中心
										</div>
										<div class="span-desc">
											装修无线端会员中心的页面内容
										</div>
									</div>
									<div class="span-btn">
										<a href="index.php?ctl=Seller_Sycm&met=wirelessVIPCenterDecoration">设置</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- g工具箱 -->
				<div class="hold-all-wrap main-switch-wrap">
					<div>
						<div class="blue-crm-title">
							<span class="crm-title">短信</span>
							<span class="crm-subtitle"></span>
						</div>
						<a href="javascript:;" target="_blank" class="sub-title rt">
							去智能营销向兴趣人群发送短信 >
						</a>
					</div>
					<div class="message-content">
						<div class="message-title">短信功能申请</div>
						<div class="message-span">
							<div class="phone-demo">
								<div class="message-demo">
									<div class="demo-top"></div>
									<div class="">
										<div class="msg-span">
											【<span>这是您的签名内容</span>】亲，你加购的商品已经等你很久啦，线上一张10元优惠券，快把他带走吧，戳t.cn.ZXH11gl2查看，退订TD
										</div>
									</div>
								</div>
							</div>
							<div class="message-application">
								<div class="form-row">
									<div class="row-title">手机号码</div>
									<div>
										<span class="next-input next-input-single next-input-large">
											<input type="text" name="">
										</span>
										<span class="row-warn">用于接收产品更新、签名审核状态通知等信息</span>
									</div>
									<span class="error-span">请填写手机号</span>
								</div>
								<div class="form-row">
									<div class="row-title">短信签名</div>
									<div>
										<span class="next-input next-input-single next-input-large">
											<input type="text" name="" placeholder="3-12个汉字或汉字/数字/英文组合">
										</span>
										<span class="row-warn">建议使用店铺名称，签名暂不支持修改，请谨慎填写</span>
									</div>
									<span class="error-span">短信签名只能3-12个中文、英文或数字，必须包含中文</span>
								</div>
								<div class="form-row">
									<label class="next-checkbox msg-checkbox ">
										<span class="next-checkbox-inner">
											<i class="next-icon next-icon-select next-icon-xs"></i>	
										</span>
										<input type="checkbox" name="">
									</label>
									<span class="agree-text">同意短信协议</span>
									<span class="agreement-dialog">
										<span class="color-blue agreement-text">查看协议</span>
									</span>
									<div class="error-span">
										请阅读并同意协议
									</div>
								</div>
								<div>
									<button type="button" class="next-btn next-btn-primary next-btn-medium submit-btn">提交申请</button>
									<span class="row-warn">我们会在3个工作日内给你回复</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 平台权益 -->
				<div class="platform-equity-wrap main-switch-wrap">
					<div class="main">
						<div class="main-inner">
							<div class="main-block rights-center container-fluid">
								<div class="row">
									<h3 class="block-title">
										<span>平台权益</span>
										<a href="javascript:;" style="margin-top: 16px;" class="btn btn-primary btn-default rt">会员专享权益</a>
									</h3>
								</div>
								<div class="row">
									<div class="rights-container">
										<table class="table table-primary">
											<thead>
												<tr>
													<th class="title-1">活动类型</th>
													<th class="title-2">到期时间</th>
													<th class="title-3">活动商品</th>
													<th class="title-4">状态</th>
													<th class="title-5">编辑</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="rights-info">
														<img src="https://img.alicdn.com/bao/uploaded/i3/2683428516/TB2nOeJXU3iyKJjy1zeXXbxZFXa_!!2683428516.jpg">
														<div class="rights-text">
															<p class="rights-name">惠抢购</p>
															<p class="rights-desc">1、点击套餐管理或续费套餐可以购买或续费套餐
2、参加了惠抢购的商品将被锁定不可修改
3、相关费用会在店铺的账期结算中扣除</p>
														</div>
													</td>
													<td class="available">2020-07-09 10:58:24</td>
													<td>0个</td>
													<td>
														<span class="sign-flag">已购买</span>
													</td>
													<td>
														<a href="javascript:;">立即签约</a>
													</td>
												</tr>
												<tr>
													<td class="rights-info">
														<img src="https://img.alicdn.com/bao/uploaded/i3/2683428516/TB2nOeJXU3iyKJjy1zeXXbxZFXa_!!2683428516.jpg">
														<div class="rights-text">
															<p class="rights-name">加价购</p>
															<p class="rights-desc">1、点击套餐管理可以购买或续费套餐
2、点击添加活动按钮可以添加加价购活动，点击编辑按钮可以对加价购活动进行编辑
3、点击删除按钮可以删除加价购活动
4、相关费用会在店铺的账期结算中扣除</p>
														</div>
													</td>
													<td class="available">2019-03-20 13:27:49</td>
													<td>0个</td>
													<td>
														<span class="sign-flag">未签约</span>
													</td>
													<td>
														<a href="javascript:;">立即签约</a>
													</td>
												</tr>
												<tr>
													<td class="rights-info">
														<img src="https://img.alicdn.com/bao/uploaded/i3/2683428516/TB2nOeJXU3iyKJjy1zeXXbxZFXa_!!2683428516.jpg">
														<div class="rights-text">
															<p class="rights-name">限时折扣</p>
															<p class="rights-desc">1、点击购买套餐和套餐续费按钮可以购买或续费套餐
2、点击添加活动按钮可以添加限时折扣活动，点击管理按钮可以对限时折扣活动内的商品进行管理
3、点击删除按钮可以删除限时折扣活动
4、相关费用会在店铺的账期结算中扣除。</p>
														</div>
													</td>
													<td class="available">2018-11-29 16:22:39。</td>
													<td>0个</td>
													<td>
														<span class="sign-flag">未签约</span>
													</td>
													<td>
														<a href="javascript:;">立即签约</a>
													</td>
												</tr>
												<tr>
													<td class="rights-info">
														<img src="https://img.alicdn.com/bao/uploaded/i3/2683428516/TB2nOeJXU3iyKJjy1zeXXbxZFXa_!!2683428516.jpg">
														<div class="rights-text">
															<p class="rights-name">彩票</p>
															<p class="rights-desc">国家彩票。提升用户购物体验，500万大奖营销宣传点。2次手淘消息提升用户二次访问店铺。实送实扣，无资金冻结</p>
														</div>
													</td>
													<td class="available">￥10.00</td>
													<td>0个</td>
													<td>
														<span class="sign-flag">未签约</span>
													</td>
													<td>
														<a href="javascript:;">立即签约</a>
													</td>
												</tr>
												<tr>
													<td class="rights-info">
														<img src="https://img.alicdn.com/bao/uploaded/i3/2683428516/TB2nOeJXU3iyKJjy1zeXXbxZFXa_!!2683428516.jpg">
														<div class="rights-text">
															<p class="rights-name">彩票</p>
															<p class="rights-desc">国家彩票。提升用户购物体验，500万大奖营销宣传点。2次手淘消息提升用户二次访问店铺。实送实扣，无资金冻结</p>
														</div>
													</td>
													<td class="available">
														<a href="javascript:;" target="_blank">去管理中心查看</a>
													</td>
													<td>0个</td>
													<td>
														<span class="sign-flag">未签约</span>
													</td>
													<td>
														<a href="javascript:;">流量钱包签约</a>
														<a href="javascript:;">立即签约</a>
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
				<!-- 会员权益 -->
				<div class="member-benefits-wrap main-switch-wrap">
					<div class="J_globleNotice">
						<div class="sui-alert sui-alert-warn clu-globle-notice">
							<i class="sui-alert-icon suicon suicon-warn-t-o"></i>
							<span class="sui-alert-message">
								<span style="font-size: 14px;">
									<span>
										您还未设置会员管理的必选设置项，会员中心的其他内容在未完成必选设置项之前均无法生效，请尽快完成设置！
									</span>
									<a href="javascript:;">去设置</a>
								</span>
							</span>
							<a href="javascript:;" class="sui-alert-close-icon">
								<i class=" suicon suicon-cross">x</i>
							</a>
						</div>
					</div>
					<div class="root">
						<div class="app">
							<div class="row oly-row-container">
								<label class="oly-label-container emd-tool">
									<b class="oly-label-star" style="display: none;"></b>
									<span>专享权益</span>
								</label>
								<div class="emd-tool-span">
									<div class="emd-tool-title">入会即送类</div>
									<div class="emd-tool-container f-cb clearfix">
										<div class="f-fl emd-tool-item">
											<a href="index.php?ctl=Seller_Sycm&met=VIPTicket" class="f-fl emd-tool-img">
												<img src="https://img.alicdn.com/tps/TB1tyltKXXXXXbKXXXXXXXXXXXX-80-80.jpg">
											</a>
											<div class="emd-tool-toolName">
												新会员专享券
											</div>
											<div class="emd-tool-recommendReason">
												店铺为招募的新会员设置的专享优惠券
											</div>
										</div>
									</div>
								</div>
								<div class="emd-tool-span">
									<div class="emd-tool-title">会员专享类</div>
									<div class="emd-tool-container f-cb clearfix">
										<div class="f-fl emd-tool-item">
											<a href="#" class="f-fl emd-tool-img">
												<img src="https://img.alicdn.com/tps/TB1tyltKXXXXXbKXXXXXXXXXXXX-80-80.jpg">
											</a>
											<div class="emd-tool-toolName">
												会员专享券
											</div>
											<div class="emd-tool-recommendReason">
												满足专享券兑换条件的品牌会员可直接进行限量领取，无需使用该品牌积分
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="mask-dialog"></div>
				<!-- 批量修改 popp -->
				<div class="modal-dialog J_sendMultiSetting">
					<div class="modal-content">
						<div class="modal-header">
			                <i class="close wsif wsif-close">x</i>
			                <h4 class="modal-title">批量修改</h4>
			            </div>
			            <div class="modal-body">
			            	<div class="row">
			                    <label class="text-right">优惠：</label>
			                    <label class="radio-inline text-primary">
			                        <input type="radio" name="enjoy"> <span>享受会员折扣</span>
			                    </label>
			                    <label class="radio-inline text-primary">
			                        <input type="radio" name="enjoy"> <span>不享受会员折扣</span>
			                    </label>
			                </div>
			                <div class="row">
			                	<label class="text-right">会员等级：</label>
			                	<label class="select">
		                        	<select class="form-control">
		                                <option value="1">普通会员</option>
		                            	<option value="2">高级会员</option>
		                            	<option value="3">VIP会员</option>
		                            	<option value="4">至尊VIP会员</option>
		                    		</select>
			                        <i class="icon caret icon-arrow"></i>
			                    </label>
			                </div>
			                <div class="row">
			                	<label class="text-right label-text">共同分组：</label>
			                	<div class="label-container">
			                		<!-- <span class="label-item">淘尚168<i class="wsif wsif-close">x</i></span> -->
			                		<!-- <span class="label-item">禁止购买<i class="wsif wsif-close">x</i></span> -->
			                		<div class="add-container">
			                			<span class="label-item-add"><i class="iconfont icon-jiahao"></i>添加标签</span>
										<div class="label-select">
											<div class="search label-head">
										        <input type="text" class="">
										    </div>
										    <div class="label-list label-body">
										        <ul>
										        	<li>淘尚168</li>
										        	<li>禁止购买</li>
										        	<li>短信黑名单</li>
										        </ul>
										    </div>
										    <div class="label-footer hidden">
										        <span class="new-label">新增分组</span>
							                    <span class="add-new-label hidden">
							                        <input type="text" class="">
							                        <button class="btn btn-sm">添加</button>
							                    </span>
										    </div>
										</div>		                			
			                		</div>
			                	</div>
			                </div>
			            </div>
			            <div class="modal-footer text-left">
			                <button type="button" class="btn btn-primary btn-lg">确定</button>
			            </div>
					</div>
				</div>

				<!-- 奖池管理 -->
				<!-- <div class="pool-management-wrap main-switch-wrap">
					<div class="box-content">
						<div class="bc-data">
							<div class="box-header">
								<span class="bh-name">奖池管理</span>
							</div>
							<div class="bc-data-table">
								<div class="next-table only-bottom-border">
									<div class="next-table-inner">
										<div class="next-table-header">
											<div class="next-table-header-inner">
												<table>
													<colgroup>
														<col>
														<col>
														<col>
														<col>
														<col>
														<col>
													</colgroup>
													<tbody>
														<tr>
															<th rowspan="1">
																<div class="next-table-cell-wrapper">
																	奖池名称
																</div>
															</th>
															<th rowspan="1">
																<div class="next-table-cell-wrapper">
																	抽奖时间
																</div>
															</th>
															<th rowspan="1">
																<div class="next-table-cell-wrapper">
																	奖池状态
																</div>
															</th>
															<th rowspan="1">
																<div class="next-table-cell-wrapper">
																	奖池来源
																</div>
															</th>
															<th rowspan="1">
																<div class="next-table-cell-wrapper">
																	关联活动数
																</div>
															</th>
															<th rowspan="1">
																<div class="next-table-cell-wrapper">
																	操作
																</div>
															</th>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="next-table-body">
											<table>
												<tbody>
													<tr>
														<td colspan="6">
															<div class="next-table-empty">没有数据</div>
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
				</div> -->
				<!-- 素材管理 -->
				<!-- <div class="material-management-wrap main-switch-wrap">素材管理</div> -->
				<!-- 客户运营学院 -->
				<!-- <div class="customer-operations-institute-wrap main-switch-wrap">客户运营学院</div> -->
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js"></script>


<script type="text/javascript">
	<!-- 客户分析----人群指标分解  -->
	var smallChart1 = echarts.init(document.getElementById('small-chart1'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#fff'];
	        var option = {
	             grid: {
			        top: '7%',
			        bottom: '26%',
			        left: '10%',
			        right: '2%'
			    },
				 axisLabel: {
				   show: false
				 },

	            xAxis: {    //  x坐标轴
	            	show: false,
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
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
	                	interval: 5  // x轴每隔5个显示一次文本
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
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                interval: 7,
		                 areaStyle: {
		                 	normal: {
			                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
			                        offset: 0,
			                        color: colors[0]
			                    }, {
			                        offset: 1,
			                        color: colors[1]
			                    }])
		                	}
		                },
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [16541125, 758, 2786387, 16780, 57, 147520, 630, 23370, 1750, 1000, .350, 45575758, 53880, 786830, 3723380, 7320, 3880, 285763, 69860, 4328, 8528869, 6950, 873, 8780]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        smallChart1.setOption(option);

	var smallChart2 = echarts.init(document.getElementById('small-chart2'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#fff'];
	        var option = {
	             grid: {
			        top: '7%',
			        bottom: '26%',
			        left: '10%',
			        right: '2%'
			    },
				 axisLabel: {
				   show: false
				 },

	            xAxis: {    //  x坐标轴
	            	show: false,
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
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
	                	interval: 5  // x轴每隔5个显示一次文本
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
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                interval: 7,
		                 areaStyle: {
		                 	normal: {
			                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
			                        offset: 0,
			                        color: colors[0]
			                    }, {
			                        offset: 1,
			                        color: colors[1]
			                    }])
		                	}
		                },
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [16541125, 758, 2786387, 16780, 57, 147520, 630, 23370, 1750, 1000, .350, 45575758, 53880, 786830, 3723380, 7320, 3880, 285763, 69860, 4328, 8528869, 6950, 873, 8780]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        smallChart2.setOption(option);

	var smallChart3 = echarts.init(document.getElementById('small-chart3'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#fff'];
	        var option = {
	             grid: {
			        top: '7%',
			        bottom: '26%',
			        left: '10%',
			        right: '2%'
			    },
				 axisLabel: {
				   show: false
				 },

	            xAxis: {    //  x坐标轴
	            	show: false,
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
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
	                	interval: 5  // x轴每隔5个显示一次文本
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
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                interval: 7,
		                 areaStyle: {
		                 	normal: {
			                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
			                        offset: 0,
			                        color: colors[0]
			                    }, {
			                        offset: 1,
			                        color: colors[1]
			                    }])
		                	}
		                },
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [16541125, 758, 2786387, 16780, 57, 147520, 630, 23370, 1750, 1000, .350, 45575758, 53880, 786830, 3723380, 7320, 3880, 285763, 69860, 4328, 8528869, 6950, 873, 8780]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        smallChart3.setOption(option);

	var smallChart4 = echarts.init(document.getElementById('small-chart4'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#fff'];
	        var option = {
	             grid: {
			        top: '7%',
			        bottom: '26%',
			        left: '10%',
			        right: '2%'
			    },
				 axisLabel: {
				   show: false
				 },

	            xAxis: {    //  x坐标轴
	            	show: false,
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
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
	                	interval: 5  // x轴每隔5个显示一次文本
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
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                interval: 7,
		                 areaStyle: {
		                 	normal: {
			                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
			                        offset: 0,
			                        color: colors[0]
			                    }, {
			                        offset: 1,
			                        color: colors[1]
			                    }])
		                	}
		                },
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [16541125, 758, 2786387, 16780, 57, 147520, 630, 23370, 1750, 1000, .350, 45575758, 53880, 786830, 3723380, 7320, 3880, 285763, 69860, 4328, 8528869, 6950, 873, 8780]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        smallChart4.setOption(option);

	var smallChart5 = echarts.init(document.getElementById('small-chart5'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#fff'];
	        var option = {
	             grid: {
			        top: '7%',
			        bottom: '26%',
			        left: '10%',
			        right: '2%'
			    },
				 axisLabel: {
				   show: false
				 },

	            xAxis: {    //  x坐标轴
	            	show: false,
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
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
	                	interval: 5  // x轴每隔5个显示一次文本
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
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                interval: 7,
		                 areaStyle: {
		                 	normal: {
			                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
			                        offset: 0,
			                        color: colors[0]
			                    }, {
			                        offset: 1,
			                        color: colors[1]
			                    }])
		                	}
		                },
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [16541125, 758, 2786387, 16780, 57, 147520, 630, 23370, 1750, 1000, .350, 45575758, 53880, 786830, 3723380, 7320, 3880, 285763, 69860, 4328, 8528869, 6950, 873, 8780]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        smallChart5.setOption(option);

	var smallChart6 = echarts.init(document.getElementById('small-chart6'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#fff'];
	        var option = {
	             grid: {
			        top: '7%',
			        bottom: '26%',
			        left: '10%',
			        right: '2%'
			    },
				 axisLabel: {
				   show: false
				 },

	            xAxis: {    //  x坐标轴
	            	show: false,
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
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
	                	interval: 5  // x轴每隔5个显示一次文本
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
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                interval: 7,
		                 areaStyle: {
		                 	normal: {
			                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
			                        offset: 0,
			                        color: colors[0]
			                    }, {
			                        offset: 1,
			                        color: colors[1]
			                    }])
		                	}
		                },
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [16541125, 758, 2786387, 16780, 57, 147520, 630, 23370, 1750, 1000, .350, 45575758, 53880, 786830, 3723380, 7320, 3880, 285763, 69860, 4328, 8528869, 6950, 873, 8780]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        smallChart6.setOption(option);

	var smallChart7 = echarts.init(document.getElementById('small-chart7'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#fff'];
	        var option = {
	             grid: {
			        top: '7%',
			        bottom: '26%',
			        left: '10%',
			        right: '2%'
			    },
				 axisLabel: {
				   show: false
				 },

	            xAxis: {    //  x坐标轴
	            	show: false,
	            	type: 'category',
	                data: ["08-24","08-25","08-26","08-27","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10","09-11","09-12","09-13","09-14","09-15","09-16","09-17","09-18","09-19","09-20","09-21","09-22"],
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
	                	interval: 5  // x轴每隔5个显示一次文本
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
		                symbol: 'circle',  // 折点处空心圆
	                	symbolSize: 8,
		                showSymbol:false,
		                interval: 7,
		                 areaStyle: {
		                 	normal: {
			                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
			                        offset: 0,
			                        color: colors[0]
			                    }, {
			                        offset: 1,
			                        color: colors[1]
			                    }])
		                	}
		                },
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },

		                data: [16541125, 758, 2786387, 16780, 57, 147520, 630, 23370, 1750, 1000, .350, 45575758, 53880, 786830, 3723380, 7320, 3880, 285763, 69860, 4328, 8528869, 6950, 873, 8780]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        smallChart7.setOption(option);


	var preheatRadarChart = echarts.init(document.getElementById('preheat-radar'));
	 // 指定图表的配置项和数据
            preheatRadarChart.setOption({
                title: { text:null }, // 隐藏图表标题
                legend: { enabled: false }, // 隐藏图例
                tooltip : {
                    trigger: 'axis'
                },
                calculable : true,
                radar : [   //极坐标
                    {
                    	shape: 'circle',
                        nameGap : 12, // 图中工艺等字距离图的距离
                        center:['50%','50%'], // 图的位置
                        radius: 110,  //雷达  大小
                        name:{
                        	
                            show: true, // 是否显示工艺等文字
                            formatter: null, // 工艺等文字的显示形式
                            textStyle: {
                              color:'#a3a5b6' // 工艺等文字颜色
                            }
                         },
                        indicator : [
                            {text : '成交客户数', max  : 1100},
                            {text : '访客指数', max  : 1100},
                            {text : '粉丝指数', max  : 1100},
                            {text : '会员指数', max  : 1100}
                        ],
                        axisLine: {            // 坐标轴线
                            show: true,       // 默认显示，属性show控制显示与否
                            lineStyle : {
                                width : 1,
                                color : '#524fec' // 图表背景网格线的颜色
                            }
                        },
                        axisLabel: {           // 坐标轴文本标签，详见axis.axisLabel
                            show: false,
                            textStyle: {      
                                color: '#247bd7' // 坐标轴刻度文字的样式
                            }
                        },
                        splitArea : {
                            show : true,   
                            areaStyle : {
                                color: ["#fff"]  // 图表背景网格的颜色
                            }
                        },
                        splitLine : {
                            show : true,
                            lineStyle : {
                                width : 1,
                                color : '#b9d3ea' // 图表背景网格线的颜色
                            }
                        }
                    }
                ],
                series : [
                    {
                        type: 'radar',
                        symbol: "none", // 去掉图表中各个图区域的边框线拐点
                        itemStyle: {
                            normal: {
                                color : "rgba(0,0,0,0)", // 图表中各个图区域的边框线拐点颜色
                                lineStyle: {
                                    color:"white" // 图表中各个图区域的边框线颜色
                                },
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data : [
                            {
                                value : [1039, 1039, 1039, 0],
                                name : '本店',
                                label: {
                                	 normal: {
			                            show: true
			                        }
                                },
                                itemStyle: {
                                    normal: {
                                        areaStyle: {
                                            type: 'default',
                                            opacity: 0, // 图表中各个图区域的透明度
                                            color: "#000" // 图表中各个图区域的颜色
                                        },
                                    }
                                },
                            },
                            {
                                value : [1045, 1009, 1013, 1007],
                                name : '同行同层平均',
                                label: {
                                	 normal: {
			                            show: true
			                        }
                                },
                                itemStyle: {
                                    normal: {
                                        areaStyle: {
                                            type: 'default',
                                            opacity: 0.8, // 图表中各个图区域的透明度
                                            color: "#ce98f8" // 图表中各个图区域的颜色
                                        },
                                    }
                                }
                            }
                        ]
                    }
                ]
            });
	
	var preheatRadarDouble11Chart = echarts.init(document.getElementById('preheat-radar-double11'));
	 // 指定图表的配置项和数据
	 	var colors = ['#29affd','#ce98f8'];
             preheatRadarDouble11Chart.setOption({
                
                /* legend: {
				        data: [
				           {name: '本店'},
				           {name: '同行同层平均'}
			           	],
				        right: 10
				    },*/
                tooltip : {
                    trigger: 'axis'
                },
                calculable : true,
                radar : [   //极坐标
                    {
                    	// shape: 'circle',
                        nameGap : 12, // 图中工艺等字距离图的距离
                        center:['45%','40%'], // 图的位置
                        radius: 110,  //雷达  大小
                        name:{
                        	
                            show: true, // 是否显示工艺等文字
                            formatter: null, // 工艺等文字的显示形式
                            textStyle: {
                              color:'#a3a5b6' // 工艺等文字颜色
                            }
                         },
                        indicator : [
                            {text : '访客人数', max  : 1100},
                            {text : '加购人数', max  : 1100},
                            {text : '加购件数', max  : 1100},
                            {text : '收藏人数', max  : 1100},
                            {text : '领券人数', max  : 1100},
                            {text : '跳失率', max  : 1100}

                        ],
                        axisLine: {            // 坐标轴线
                            show: true,       // 默认显示，属性show控制显示与否
                            lineStyle : {
                                width : 1,
                                color : '#ccc' // 图表背景网格线的颜色
                            }
                        },
                        splitArea : {
                            show : true,   
                            areaStyle : {
                                color: "#fff"  // 图表背景网格的颜色
                            }
                        },
                        splitLine : {
                            show : true,
                            lineStyle : {
                                width : 1,
                                color : '#b9d3ea' // 图表背景网格线的颜色
                            }
                        }
                    }
                ],
                series : [
                    {
                        type: 'radar',
                        symbol: "none", // 去掉图表中各个图区域的边框线拐点
                        itemStyle: {
                            normal: {
                                color : "rgba(0,0,0,0)", // 图表中各个图区域的边框线拐点颜色
                                lineStyle: {
                                    color:"white" // 图表中各个图区域的边框线颜色
                                },
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data : [
                            {
                                value : [1039, 1039, 1039, 1100, 0, 1000],
                                name : '本店',
                                label: {
                                	 normal: {
			                            show: true
			                        }
                                },
                                itemStyle: {
                                    normal: {
                                        areaStyle: {
                                            type: 'default',
                                            opacity: 0.6, // 图表中各个图区域的透明度
                                            color: colors[0] // 图表中各个图区域的颜色
                                        },
                                    }
                                },
                            },
                            {
                                value : [1045, 1009, 1013, 1007, 56, 120,0],
                                name : '同行同层平均',
                                label: {
                                	 normal: {
			                            show: true
			                        }
                                },
                                itemStyle: {
                                    normal: {
                                        areaStyle: {
                                            type: 'default',
                                            opacity: 0.8, // 图表中各个图区域的透明度
                                            color: colors[1] // 图表中各个图区域的颜色
                                        },
                                    }
                                }
                            }
                        ]
                    }
                ]
            });
	
    var trendAnalysisChart = echarts.init(document.getElementById('trend-analysis-chart'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','yellow',"orange"];
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
			        bottom: '24%',
			        left: '2%',
			        right: '2%',
			        top: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: true,  //  控制 坐标轴显示或隐藏
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
	                	interval: 2  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	            },
	            yAxis: {
	            	show: false,
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
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '支付人数',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
		                showSymbol: false,
		                symbolSize: 8,
		                smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {
		                			color: colors[0],
		                			width: 5
		                		}
		                	}
		                },
		                areaStyle: {
		                 	normal: {
			                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
			                        offset: 0,
			                        color: colors[0]
			                    }, {
			                        offset: 1,
			                        color: '#fff'
			                    }])
		                	}
		                },
		                data:  [0, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5]
		            }
	            ]
	        };

	        // 使用刚指定的配置项和数据显示图表。
	        trendAnalysisChart.setOption(option);

	//  仪表盘
	var gaugeChartFk = echarts.init(document.getElementById('gauge-chart-fk'));
		 // 指定图表的配置项和数据
		 	option = {
			    series : [
			        {
			            name: '于同行对比',
			            type: 'gauge',
			            z: 3,
			            min: 0,
			            max: 100,
			            splitNumber: 10,
			            radius: '88%',
			            // startAngle:15,
			            // endAngle:45,
			            axisLine: {            // 坐标轴线
			                lineStyle: {       // 属性lineStyle控制线条样式
			                    width: 12
			                }
			            },
			            axisTick: {            // 坐标轴小标记
			                length: 15,        // 属性length控制线长
			                lineStyle: {       // 属性lineStyle控制线条样式
			                    color: 'auto'
			                }
			            },
			            splitLine: {           // 分隔线
			                length: 20,         // 属性length控制线长
			                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
			                    color: '#fff',
			                    width: 2
			                }
			            },
			           /* axisLabel: {
			                backgroundColor: 'auto',
			                borderRadius: 2,
			                color: '#eee',
			                padding: 3,
			                textShadowBlur: 2,
			                textShadowOffsetX: 1,
			                textShadowOffsetY: 1,
			                textShadowColor: '#222'
			            },*/
			           title : {
			                offsetCenter: ['0', '100%'],       // x, y，单位px
			                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
			                	fontSize: 16,
			                    color: '#3089DC',
			                    shadowColor : '#fff', //默认透明
			                    shadowBlur: 10
			                }
			            },
			            detail : {
			                // 其余属性默认使用全局文本样式，详见TEXTSTYLE
			                formatter: function (value) {
			                	return value+"%"
			                },
			                offsetCenter: ['0', '70%'], 
			                textShadowOffsetX: 0,
			                textShadowOffsetY: 10,
			                width: 50,
			                color: '#3089DC',
			                 textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
			                    fontWeight: 'bolder',
			                    color: '#3089DC'
			                }
			                // rich: {}
			            },
			            data:[{value: 40, name: "与同行对比优"}]
			        }
			    ]
			};
	        // 使用刚指定的配置项和数据显示图表。
	        gaugeChartFk.setOption(option);

	var gaugeChartFkSupport = echarts.init(document.getElementById('gauge-chart-fkSupport'));
		 // 指定图表的配置项和数据
		 	option = {
			    series : [
			        {
			            name: '于同行对比',
			            type: 'gauge',
			            z: 3,
			            min: 0,
			            max: 100,
			            splitNumber: 10,
			            radius: '88%',
			            // startAngle:15,
			            // endAngle:45,
			            axisLine: {            // 坐标轴线
			                lineStyle: {       // 属性lineStyle控制线条样式
			                    width: 12
			                }
			            },
			            axisTick: {            // 坐标轴小标记
			                length: 15,        // 属性length控制线长
			                lineStyle: {       // 属性lineStyle控制线条样式
			                    color: 'auto'
			                }
			            },
			            splitLine: {           // 分隔线
			                length: 20,         // 属性length控制线长
			                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
			                    color: '#fff',
			                    width: 2
			                }
			            },
			           /* axisLabel: {
			                backgroundColor: 'auto',
			                borderRadius: 2,
			                color: '#eee',
			                padding: 3,
			                textShadowBlur: 2,
			                textShadowOffsetX: 1,
			                textShadowOffsetY: 1,
			                textShadowColor: '#222'
			            },*/
			           title : {
			                offsetCenter: ['0', '100%'],       // x, y，单位px
			                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
			                	fontSize: 16,
			                    color: '#3089DC',
			                    shadowColor : '#fff', //默认透明
			                    shadowBlur: 10
			                }
			            },
			            detail : {
			                // 其余属性默认使用全局文本样式，详见TEXTSTYLE
			                formatter: function (value) {
			                	return value+"%"
			                },
			                offsetCenter: ['0', '70%'], 
			                textShadowOffsetX: 0,
			                textShadowOffsetY: 10,
			                width: 50,
			                color: '#3089DC',
			                 textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
			                    fontWeight: 'bolder',
			                    color: '#3089DC'
			                }
			                // rich: {}
			            },
			            data:[{value: 40, name: "与同行对比优"}]
			        }
			    ]
			};
	        // 使用刚指定的配置项和数据显示图表。
	        gaugeChartFkSupport.setOption(option);

	var gaugeChartFkOld = echarts.init(document.getElementById('gauge-chart-fkOld'));
		 // 指定图表的配置项和数据
		 	option = {
			    series : [
			        {
			            name: '于同行对比',
			            type: 'gauge',
			            z: 3,
			            min: 0,
			            max: 100,
			            splitNumber: 10,
			            radius: '88%',
			            center:['50%', '50%'],
			            // startAngle:15,
			            // endAngle:45,
			            axisLine: {            // 坐标轴线
			                lineStyle: {       // 属性lineStyle控制线条样式
			                    width: 12
			                }
			            },
			            axisTick: {            // 坐标轴小标记
			                length: 15,        // 属性length控制线长
			                lineStyle: {       // 属性lineStyle控制线条样式
			                    color: 'auto'
			                }
			            },
			            splitLine: {           // 分隔线
			                length: 20,         // 属性length控制线长
			                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
			                    color: '#fff',
			                    width: 2
			                }
			            },
			           /* axisLabel: {
			                backgroundColor: 'auto',
			                borderRadius: 2,
			                color: '#eee',
			                padding: 3,
			                textShadowBlur: 2,
			                textShadowOffsetX: 1,
			                textShadowOffsetY: 1,
			                textShadowColor: '#222'
			            },*/
			           title : {
			                offsetCenter: ['0', '100%'],       // x, y，单位px
			                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
			                	fontSize: 16,
			                    color: '#3089DC',
			                    shadowColor : '#fff', //默认透明
			                    shadowBlur: 10
			                }
			            },
			            detail : {
			                // 其余属性默认使用全局文本样式，详见TEXTSTYLE
			                formatter: function (value) {
			                	return value+"%"
			                },
			                offsetCenter: ['0', '70%'], 
			                textShadowOffsetX: 0,
			                textShadowOffsetY: 10,
			                width: 50,
			                color: '#3089DC',
			                 textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
			                    fontWeight: 'bolder',
			                    color: '#3089DC'
			                }
			                // rich: {}
			            },
			            data:[{value: 40, name: "与同行对比优"}]
			        }
			    ]
			};
	        // 使用刚指定的配置项和数据显示图表。
	        gaugeChartFkOld.setOption(option);


    var chart365Chart = echarts.init(document.getElementById('chart365-chart'));
	    	var colors = ["#f37853","#a51ecd","#4982f4","#2fa777"];
	    	option = {
    		 	 legend: {
				        x: 'right',
				        data:['支付1次','支付2次','支付3次','支付4次及以上']
				    },
			    series: [
			        {
			            // name:'访问来源',	
			            type:'pie',
			            radius: ['50%', '35%'],
			            avoidLabelOverlap: false,
			             
			            data:[
			                {
			                	value:335, 
			                	name:'支付1次',
			                	itemStyle: {
			                		normal: {
			                			borderWidth: 10,
			                			borderColor: 'transparent',
			                			color: colors[0],
			                			labelLine: {
			                				length: 60
			                			}
			                		}
			                	}
			                },
			                {
			                	value:310, 
			                	name:'支付2次',
			                	itemStyle: {
			                		normal: {
			                			borderWidth: 2,
			                			borderColor: '#fff',
			                			color: colors[1],
			                			labelLine: {
			                				length: 60
			                			}
			                		}
			                	}
			                },
			                {value:234, 
			                	name:'支付3次',
			                	itemStyle: {
			                		normal: {
			                			borderWidth: 2,
			                			borderColor: '#fff',
			                			color: colors[2],
			                			labelLine: {
			                				length: 60
			                			}
			                		}
			                	}
			                },
			                {
			                	value:135, 
			                	name:'支付4次及以上',
			                	itemStyle: {
			                		normal: {
			                			borderWidth: 2,
			                			borderColor: '#fff',
			                			color: colors[3],
			                			labelLine: {
			                				length: 60
			                			}
			                		}
			                	}
			                }
			            ]
			        }
			    ]
			};
			chart365Chart.setOption(option);

	var lastBuyChart = echarts.init(document.getElementById('last-buy-chart'));
		// 指定图表的配置项和数据
	 	var colors = ['#6132ef']
	        var option = {
	          	tooltip: {
			        trigger: 'axis',
			        // backgroundColor: '#fff',
			        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
			        borderColor: '#eee',
			        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
			        padding: 14,
			        textStyle: {
			            color: '#fff',
			            fontSize: 12
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
			        }
			    },
	             grid: {
			        bottom: '24%',
			        left: '2%',
			        right: '6%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["30天内", "31-90天","91-180天", "181-365天"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: false,  //  控制 坐标轴显示或隐藏
	                splitLine: {    //删掉参考线
	                	show: false
	                },
	                axisTick: {  // 坐标轴上的小标识
	                	show: false
	                },
	                axisLabel: {  //刻度值
	                	textStyle: {
	                		color: '#333'
	                	}
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: true  // 控制 坐标轴两端 空白
	            },
	            yAxis: [
	            	{
		            	type: 'value',
		            	position: 'left',
		            	axisLine: false,  //  控制 坐标轴显示或隐藏
		            	splitLine: {
		                	show: true
		                },
		                axisTick: {
		            		show: false
		            	},
		            	splitArea: {
		                    show: true
		                },
		            	axisLabel: {
		                	textStyle: {
		                		align: 'left',
		                		color: '#333'
		                	}
		                }
		            }
	            ],
	            series: [
		            {
		                name: '人数',
		                type: 'bar', 
		                barWidth: '20',
		                symbol: true,  // 折点处空心圆
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [12, 20, 2, 19]
		            }
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        lastBuyChart.setOption(option);
	
	var monthlyTurnoverChart = echarts.init(document.getElementById('monthly-turnover-chart'));
		// 指定图表的配置项和数据
	 	var colors = ['#6132ef','#41b778']
	        var option = {
	          	tooltip: {
			        trigger: 'axis',
			        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
			        borderColor: '#eee',
			        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
			        padding: 14,
			        textStyle: {
			            color: '#fff',
			            fontSize: 12
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
			        }
			    },
	           legend: {     // 图例
	            	x: 'right',
	           		data: [
		           		{
		           			name: '交易总金额',
		           			icon: 'rect',
		           		},
		           		{
		           			name: '客单价',
		           			icon: 'pin'
		           		}
	           		],
	            },

	             grid: {
			        bottom: '24%',
			        left: '2%',
			        right: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                data: ["201706", "201707", "201708", "201709", "201710"],
	                axisLine:{    //坐标轴颜色
	                    lineStyle:{
	                        color:'#bbb'
	                    }
	                },
	                axisLine: false,  //  控制 坐标轴显示或隐藏
	                splitLine: {    //删掉参考线
	                	show: false
	                },
	                axisTick: {  // 坐标轴上的小标识
	                	show: false
	                },
	                axisLabel: {  //刻度值
	                	textStyle: {
	                		color: '#333',
	                	}
	                },
	                // axisLabel : {interval: 1},
	                boundaryGap: true  // 控制 坐标轴两端 空白
	            },
	            yAxis: [
	            	{
	            		name: '交易总金额',
		            	type: 'value',
		            	position: 'left',
		            	axisLine: false,  //  控制 坐标轴显示或隐藏
		            	splitLine: {
		                	show: false
		                },
		                axisTick: {
		            		show: false
		            	},
		            	splitArea: {
		                    show: true
		                },
		            	axisLabel: {
		                	textStyle: {
		                		align: 'left',
		                		color: '#333'
		                	}
		                }
		            },
		            {
		            	name: '客单价',
		            	type: 'value',
		            	position: 'right',
		            	axisLine: false,  //  控制 坐标轴显示或隐藏
		            	splitLine: {
		                	show: false
		                },
		               
		            	axisLabel: {
		                	textStyle: {
		                		align: 'right',
		                		color: '#333'
		                	}
		                }
		            }
	            ],
	            series: [
		            {
		                name: '交易总金额',
		                type: 'bar',
		                barWidth: '20',
		                symbol: true,  // 折点处空心圆
		                yAxis: 1,
		                itemStyle: {
		                	normal: {
		                		color: colors[0],
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data: [1200, 200, 2000, 6,1500]
		            },
		            {
		                name: '客单价',
		                type: 'line',
		                 smooth: true,  // 平滑折线
		                yAxisIndex: 1,
		                 areaStyle: {
		                 	normal: {
			                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
			                        offset: 0,
			                        color: '#ccefdc'
			                    }, {
			                        offset: 1,
			                        color: '#ccefdc'
			                    }])
		                	}
		                },
		                // smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {
		                			color: colors[1]
		                		}
		                	},

		                },
		                data:  [0,1600, 206, 620, 1111]
		            }

	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        monthlyTurnoverChart.setOption(option);
	     
	     //  自适应的echarts   start

	     function adaptationE () {

			var hotPointChart = echarts.init(document.getElementById('hot-point-chart'));
			 // 指定图表的配置项和数据
		 	var colors = ['#29affd','#ce98f8'];
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
				        bottom: '28%',
				        left: '2%',
				        right: '2%',
				        top: '22%'
				    },
					 axisLabel: {
					   show: false
					 },
		            xAxis: {    //  x坐标轴
		            	type: 'category',
		                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
		                axisLine:{    //坐标轴颜色
		                    lineStyle:{
		                        color:'#bbb'
		                    }
		                },
		                axisLine: true,  //  控制 坐标轴显示或隐藏
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
		                	interval: 2  // x轴每隔5个显示一次文本
		                },
		                // axisLabel : {interval: 1},
		            },
		            yAxis: {
		                type: 'value',
		                show: false,
		            	// boundaryGap: [0, 0.5],
		            	axisLine: false,  //  控制 坐标轴显示或隐藏
		            	splitLine: {
		                	show: false,
		                },
		                axisTick: {
		            		show: false
		            	},
		            	axisLabel: {
		                	textStyle: {
		                		align: 'left',
		                		color: '#bbb',
		                	}
		                }
		            },
		            series: [
			            {
			                name: '本店',
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
			                areaStyle: {
			                 	normal: {
				                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
				                        offset: 0,
				                        color: colors[0]
				                    }, {
				                        offset: 1,
				                        color: '#fff'
				                    }])
			                	}
			                },
			                data:  [0, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5]
			            },
			            {
			                name: '同行同层平均',
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
			                areaStyle: {
			                 	normal: {
				                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
				                        offset: 0,
				                        color: colors[1]
				                    }, {
				                        offset: 1,
				                        color: '#fff'
				                    }])
			                	}
			                },
			                data:  [0, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5]
			            },
		            ]
		        };

		        // 使用刚指定的配置项和数据显示图表。
		        hotPointChart.setOption(option);
		    $(window).resize(function() {
		    	hotPointChart.resize();
		    })
	     }

	     function adaptationE1 () {
	     	var preheatRadarLine = echarts.init(document.getElementById('preheat-radar-line'));
				 // 指定图表的配置项和数据
			 var colors = ['#29affd','#ce98f8'];
		        var option = {
		        	/* legend: {
				        right: 10,
				        data: ['本店', '同行同层平均']
				    },*/
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
				        bottom: '28%',
				        left: '2%',
				        right: '2%',
				        top: '22%'
				    },
					 axisLabel: {
					   show: false
					 },
		            xAxis: {    //  x坐标轴
		            	type: 'category',
		                data: ["08-12","08-13","08-14","08-15","08-16","08-17","08-18","08-19","08-20","08-21","08-22","08-23","08-24","08-25","08-26","08-27","08-28","08-29","08-30","08-31","09-01","09-02","09-03","09-04","09-05","09-06","09-07","09-08","09-09","09-10"],
		                axisLine:{    //坐标轴颜色
		                    lineStyle:{
		                        color:'#bbb'
		                    }
		                },
		                axisLine: true,  //  控制 坐标轴显示或隐藏
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
		                	interval: 2  // x轴每隔5个显示一次文本
		                },
		                // axisLabel : {interval: 1},
		            },
		            yAxis: {
		                type: 'value',
		                show: false,
		            	// boundaryGap: [0, 0.5],
		            	axisLine: false,  //  控制 坐标轴显示或隐藏
		            	splitLine: {
		                	show: false,
		                },
		                axisTick: {
		            		show: false
		            	},
		            	axisLabel: {
		                	textStyle: {
		                		align: 'left',
		                		color: '#bbb',
		                	}
		                }
		            },
		            series: [
			            {
			                name: '本店',
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
			                areaStyle: {
			                 	normal: {
				                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
				                        offset: 0,
				                        color: colors[0]
				                    }, {
				                        offset: 1,
				                        color: '#fff'
				                    }])
			                	}
			                },
			                data:  [0, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5]
			            },
			            {
			                name: '同行同层平均',
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
			                areaStyle: {
			                 	normal: {
				                	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
				                        offset: 0,
				                        color: colors[1]
				                    }, {
				                        offset: 1,
				                        color: '#fff'
				                    }])
			                	}
			                },
			                data:  [0, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5]
			            },
		            ]
		        };

		        // 使用刚指定的配置项和数据显示图表。
		        preheatRadarLine.setOption(option);

		        $(window).resize(function() {
		        	preheatRadarLine.resize();
		        })
	     }

</script>
	

<script type="text/javascript">
	leftNavCalc();
	function leftNavCalc() {
		var  height = [];
		$(".menu-submenu").each(function() {
			if($(this).children("ul.menu-sub")) {
				height.push($(this).children("ul.menu-sub").outerHeight(true));
			}
		})
		// height.shift(0);
		$(".menu-submenu-inline").click(function(){
			if($(this).children("ul.menu-sub")){
				if($(this).hasClass("menu-submenu-open")){   // 当前展开状态z
					$(this).children("ul.menu-sub").animate({height: 0},180,function() {
						$(this).parent("li").removeClass("menu-submenu-open");
						$(this).hide();
						// $(this).css({"height":"auto"});
					});
				}else {  //当前关闭状态
					// var index = $(this).index() - 1;
					var index = $(this).index();
					$(this).children("ul.menu-sub").show().animate({height: height[index]}).parent("li").addClass("menu-submenu-open");
				}
			}
		})
		$("ul.menu-sub li").click(function(e) {
			e.stopPropagation();
		})
	}
	// 右侧 大容器 切换
	$(".main-container .main-switch-wrap").eq(0).show();
	$(".aside-side-list .menu-submenu").click(function() {
		if($(this).hasClass("menu-submenu-inline")) return false;
		var index = $(this).index();
		var childLength = 0;  // 存储点击的当前元素以前的所有小项目li length
		var childUlLength = 0;// 存储点击的当前元素以前的所有小项目ul length
		for(var i=0;i<index;i++) {
			if($(this).children("ul.menu-sub")) {
				childLength += $(".aside-side-list .menu-submenu").eq(i).children("ul.menu-sub").children("li").length;
				childUlLength +=$(".aside-side-list .menu-submenu").eq(i).children("ul.menu-sub").length;
			}
		}
		index += childLength - childUlLength;
		$(".main-container .main-switch-wrap").siblings().hide().eq(index).show();
	})
	$(".aside-side-list .menu-item").click(function() {
		$(this).addClass("menu-item-selected").siblings(".menu-item-selected").removeClass("menu-item-selected");

		var selfIndex = $(this).index();
		var index = $(this).parent("ul.menu-sub").parent("li").index();
		var parentLength = 0;
		var selfLength = 0;
		var selfUlLength = 0;
		for(var i=0;i<index;i++) {
			parentLength += $(".aside-side-list .menu-submenu").eq(i).length;
			selfLength += $(".aside-side-list .menu-submenu").eq(i).children("ul.menu-sub").children("li").length;
			selfUlLength += $(".aside-side-list .menu-submenu").eq(i).children("ul.menu-sub").length;
		}
		console.log(selfIndex ,selfLength);
		selfIndex += selfLength + parentLength -selfUlLength;
		console.log(selfIndex)
		$(".main-container .main-switch-wrap").siblings().hide().eq(selfIndex).show();
	})

	// 双 11
		// 点击 去设置
	$(".double-11-wrap .next-tabs-content .next-tabs-tabpane").eq(0).show();
	$(".progress-line .step-btn").click(function() {
		$("body,html").animate({
			scrollTop: 1000
		},600);
		var index = $(this).parents(".step-container").index();
		// $(".progress-line-wrapper .step-container-wrapper").eq(index).addClass("currdone").siblings(".currdone").removeClass("currdone");
		$(".block-container .content-wrapper .next-tabs-bar .next-tabs-tab.custom-tabs-tab").eq(index).addClass("next-tabs-tab-active").siblings(".next-tabs-tab-active").removeClass("next-tabs-tab-active");
		$(".next-tabs-content .next-tabs-tabpane").eq(index).show().siblings().hide();
	})

	$(".block-container .content-wrapper .next-tabs-bar .next-tabs-tab").click(function() {
		$(this).addClass("next-tabs-tab-active").siblings(".next-tabs-tab-active").removeClass("next-tabs-tab-active");
		var index = $(this).index();
		$(this).parents(".next-tabs-bar").siblings(".next-tabs-content").find(".next-tabs-tabpane").hide().eq(index).show();
	})
	

	$(".double-11-wrap .block-container .pre-heat-panel .preheat-radar-double11-wrap").eq(0).show();
	$(".double-11-wrap .pre-heat-panel .tool-bar .tab-item").click(function() {
		$(this).addClass("active").siblings(".tab-item.active").removeClass("active");
		var index = $(this).index();
		$(this).parents(".pre-head").siblings(".pre-heat-content").find(".preheat-radar-double11-wrap").hide().eq(index).show();
		adaptationE();
	})
		// 点击下拉框
	$(document).click(function() {
		if($(".double-11-wrap .block-container .pre-heat-panel .pre-heat-content  .next-menu").css("display") === 'block') {
			console.log(4554)
			$(".double-11-wrap .block-container .pre-heat-panel .pre-heat-content  .next-menu").hide();
		}
	})
	$(".double-11-wrap .block-container .pre-heat-panel .pre-heat-content .next-select.medium").click(function(e) {     // .double-11-wrap .block-container .pre-heat-panel .pre-heat-content .next-select.medium
		console.log(85)
		e.stopPropagation();
		$(this).siblings(".next-menu").toggle();
	})
	$(".double-11-wrap .block-container .pre-heat-panel .pre-heat-content .next-menu .next-menu-item").click(function() {
		$(this).addClass("selected").siblings(".selected").removeClass("selected");
		var text = $(this).text();
		$(this).parents(".next-menu").siblings(".next-select").children(".next-select-inner").text(text);
		$(this).parents(".next-menu").hide();
	})


	// 首页
	$(".index-wrap .index-trend-page .next-tabs-content .next-tabs-tabpane").eq(0).show();
		// 移入  名词解释
	$(".index-wrap .section-block .jxt-title-container .description").mouseenter(function() {
		$(this).children(".tips-guide-wrap").show();
	}).mouseleave(function() {
		$(this).children(".tips-guide-wrap").hide();
	})
			// 点击下拉框
	$(document).click(function() {
		if($(".index-wrap .tip-text .next-menu").css("display") === 'block') {
			$(".index-wrap .tip-text .next-menu").hide();
		}
	})
	$(".index-wrap .next-select.medium").click(function(e) {
		e.stopPropagation();
		$(this).children(".next-menu").toggle();
	})
	$(".index-wrap .next-menu .next-menu-item").click(function(e) {
		e.stopPropagation();
		$(this).addClass("selected").siblings(".selected").removeClass("selected");
		var text = $(this).text();
		$(this).parents(".next-menu").siblings(".next-select-inner").text(text);
		console.log($(this).parents(".next-menu"));
		$(this).parents(".next-menu.next-select-menu").hide();
	})

		// 切换
	$(".index-wrap .block-inner .next-tabs-bar .next-tabs-tab").click(function() {
		$(this).addClass("next-tabs-tab-active").siblings(".next-tabs-tab-active").removeClass("next-tabs-tab-active");
	})
	//  VS  时间插件  datatimepicker
	$(".vs1").datetimepicker({
		format: 'Y-m-d',
		timepicker: false,
		weeks: false,
		allowTimes: false,
	})
	$(".vs2").datetimepicker({
		format: 'Y-m-d',
		timepicker: false,
		weeks: false,
		allowTimes: false,
	})
	$(".vs1").change(function() {
		$(".jxt-date-picker span.green").text($(this).val());
	})
	$(".vs2").change(function() {
		$(".jxt-date-picker span.blue").text($(this).val());
	})
	$(".index-wrap .jxt-date-picker").click(function() {
		$(this).children(".next-overlay-inner.dropContainer").show();
	})
	$(".index-wrap .jxt-date-picker .dropContainer .btn-group .next-btn").click(function(e) {
		e.stopPropagation();
		$(this).parents(".datePickerContainer").parents(".dropContainer").hide();
	})



	//  客户列表
	$(".form-horizontal .unfold.J_unfold").click(function() {
		$(this).parent().siblings(".hidden").removeClass("hidden");
		if($(this).hasClass("clicked")) {
			$(this).parent().siblings(".toggle").addClass("hidden");
			$(this).removeClass("clicked");
		}else {
			$(this).parent().siblings(".hidden").removeClass("hidden");
			$(this).addClass("clicked");
		}
	})
	$(".trade1").datetimepicker({
		format: 'Y-m-d',
		timepicker: false,
		weeks: false,
		allowTimes: false,
		 pickerPosition: "top-right"
	})
	$(".trade2").datetimepicker({
		format: 'Y-m-d',
		timepicker: false,
		weeks: false,
		allowTimes: false,
	})
	

	$(".customer-list-wrap .content-container .content-table thead .title-1 .checkbox.checkbox-inline input").click(function() {
		if($(this).is(":checked")) {
			$(this).parents("thead").siblings("tbody").find(".checkbox.checkbox-inline").find("label").children("input").attr("checked",true);
			$(this).parents(".content-table").siblings(".content-head").find(".disabled").removeClass("disabled");
		}else {
			$(this).parents("thead").siblings("tbody").find(".checkbox.checkbox-inline").find("label").children("input").removeAttr("checked");
			$(this).parents(".content-table").siblings(".content-head").find(".benefit-container>span").addClass("disabled");
		}
	})
	$(".customer-list-wrap .content-container .content-table tbody input").click(function() {
		if($(this).parents("tbody").siblings("thead").find("input").is(":checked")) {
			$(this).parents("tbody").siblings("thead").find("input").removeAttr("checked");
		}
		var length = $(this).parents("tbody").find("tr").length/3;
		var checkedLength = $(this).parents("tbody").find("tr input:checked").length;
		 if(length === checkedLength) {
		 	$(this).parents("tbody").siblings("thead").find("input").attr("checked", true);
		 }
		 if(checkedLength === 0) {
			$(this).parents(".content-table").siblings(".content-head").find(".benefit-container>span").addClass("disabled");
		 }
	})
			// 点击批量设置
	$(".customer-list-wrap .content-head .multi-setting.J_multiSetting").click(function() {
		if($(this).hasClass("disabled")) {
			return false;
		}else {
			$(".mask-dialog").fadeIn(500);
			$(".modal-dialog.J_sendMultiSetting").fadeIn(500);

		}
	})
	$(".modal-dialog.J_sendMultiSetting .close,.modal-dialog.J_sendMultiSetting .modal-footer .btn").click(function(){
		$(".mask-dialog").hide();
		$(".modal-dialog.J_sendMultiSetting").hide();
	})
	$(".modal-dialog.J_sendMultiSetting .modal-body  .label-item-add").click(function() {
		$(this).siblings(".label-select").show();
	})
	//         <span class="label-item">淘尚168<i class="wsif wsif-close">x</i></span>
	$(".modal-dialog.J_sendMultiSetting .modal-body  .add-container .label-list li").click(function() {
		var text = $(this).text();
		var exisitText = $(".modal-dialog.J_sendMultiSetting .modal-body .add-container .label-item").text()
		var fragment = document.createDocumentFragment();
		$(fragment).append('<span class="label-item">'+text+'<i class="wsif wsif-close">x</i></span>');
		if(exisitText.indexOf(text) === -1) {
			$(".modal-dialog.J_sendMultiSetting .modal-body .add-container .label-item-add").before(fragment);
		} else{ 
			alert("不能添加重复标签哦！");
		}
		$(".add-container .label-select").hide();
	})
		// 点击 x
	$(".modal-dialog.J_sendMultiSetting .modal-body .add-container").on("click",".label-item .wsif-close",function(){
		$(this).parents(".label-item").remove();

	})
	
	$(".add-container .label-select").mouseleave(function() {
		$(this).hide();
	})

	// 客户分群 
		// 移入定向运营 人群分析
	$(".customer-clustering-wrap .recommend-crowd-wrapper .recommend-crowd-card .foot-links a.disabled").mouseenter(function() {
		$(this).find(".tips-guide-wrap").show();
	}).mouseleave(function() {
		$(this).find(".tips-guide-wrap").hide();
	})

	// 点击定向优惠跳页面
	$(".crowd-list-container .next-tabs-content .next-table-cell-wrapper .next-btn").click(function() {
		window.location.href='index.php?ctl=Seller_Sycm&met=couponCare';
	})

	// 客户分析
	$(".customer-analysis-wrap .inner-container-down .next-tabs-content .next-tabs-tabpane").eq(0).show();
	// $(".customer-analysis-wrap .inner-container-down .next-tabs-content .inner-container-down").eq(0).show();
	$(".customer-analysis-wrap .inner-container-down .header-panel.down-header .next-tabs-tab").click(function() {
		$(this).addClass("next-tabs-tab-active").siblings(".next-tabs-tab-active").removeClass("next-tabs-tab-active");
		var index = $(this).index();
		$(this).parents(".next-tabs-bar").siblings(".next-tabs-content").children(".next-tabs-tabpane").eq(index).show().siblings(".next-tabs-tabpane").hide();

		$(this).parents(".inner-container-down").siblings(".inner-container-down").eq(index).show().siblings(".tab-down").hide();


	})
	$(".customer-analysis-wrap .next-date-picker input").datetimepicker({
		format: 'Y-m-d',
		timepicker: false,
		weeks: false,
		allowTimes: false
	})
	$(".next-date-picker .next-icon").click(function() {
		$(this).siblings(".next-input").find("input").val("");
	}) 

		//  切换
	$(".customer-analysis-wrap .preheat-wrapper .preheat-info .chart-wrapper").eq(0).show();
	$(".customer-analysis-wrap .inner-container-up .preheat-info .preheat-info-change i").click(function(){
		$(this).addClass("chart-icon-active").siblings(".chart-icon-active").removeClass("chart-icon-active");
		var index = $(this).index();

		$(".customer-analysis-wrap .preheat-wrapper .preheat-info .chart-wrapper").eq(index).show().siblings(".chart-wrapper").hide();
		adaptationE1();
	})
 
	// 智能营销   .intelligent-marketing-wrap
	$(".crowd-list-container .next-tabs-tabpane").eq(0).show();
	$(".intelligent-marketing-wrap .next-tabs-tabpane").eq(0).show();
	$(".intelligent-marketing-wrap .next-tabs-tab").click(function() {
		var index = $(this).index();
		$(".intelligent-marketing-wrap .next-tabs-tabpane").eq(index).show().siblings().hide();
		$(this).addClass("next-tabs-tab-active").siblings(".next-tabs-tab-active").removeClass("next-tabs-tab-active");
	})
	$(".customer-clustering-wrap .next-tabs-tab").click(function() {
		var index = $(this).index();
		console.log(index)
		$(".customer-clustering-wrap .next-tabs-tabpane").eq(index).show().siblings().hide();
		$(this).addClass("next-tabs-tab-active").siblings(".next-tabs-tab-active").removeClass("next-tabs-tab-active");
	})


	$(".discountedListTab .label").click(function () {
		$(this).addClass("active").siblings(".active").removeClass("active");
	})
	// 工具箱
	$(".message-application span.next-input input").keyup(function() {
		var text =  $(this).val();
		$(".message-demo .msg-span span").text(text);
	})
	$(".message-application span.next-input input").blur(function() {
		if($(".message-demo .msg-span span").text() == "") {
			$(".message-demo .msg-span span").text("这是您的签名内容");
		}
	})
		// 跳到  短信功能申请完成页面
	$(".hold-all-wrap .submit-btn").click(function()  {
		window.open("index.php?ctl=Seller_Sycm&met=smsApplication");
	})


		// 各种 问号
	$(".tips-wrap").mouseenter(function() {
		$(this).children(".tips-guide-wrap").show();
	}).mouseleave(function() {
		$(this).children(".tips-guide-wrap").hide();
	})
</script>

</html>

<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!-- 智能营销  兴趣客户转化 点击页面-->


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
				<div class="custom-marketing-create">
					<div class="create-page">
						<div>
							<div class="next-breadcrumb jxt-breadcrumb">
								<div class="next-breadcrumb-item">
									<a href="#" class="next-breadcrumb-text">运营计划</a>
									<div class="next-breadcrumb-separator">/</div>
								</div>
								<div class="next-breadcrumb-item">
									<a href="#" class="next-breadcrumb-text">智能营销</a>
									<div class="next-breadcrumb-separator">/</div>
								</div>
								<div class="next-breadcrumb-item">
									<a href="#" class="next-breadcrumb-text">上新老客提醒</a>
									<div class="next-breadcrumb-separator">/</div>
								</div>
							</div>
						</div>
						<div class="media">
							<div class="media-left">
								<img src="//img.alicdn.com/tfs/TB1rK__QVXXXXXZXVXXXXXXXXXX-72-80.png" class="media-obj" alt="">
							</div>
							<div class="media-body">
								<div class="media-heading">兴趣客户转化</div>
								<div class="media-desc">
									<div>自动化周期性营销场景，针对最近3-10天有加购收藏，但是最近10天没有成交的客户，进行优惠券、短信和定向海报的营销组合投放，提升成交转化率。
										<p class="desc-link">
											<!-- <a class="course course-video">
												<i class="courseIcon icon-shipin2"></i>视频教程 &gt;
											</a> -->
											<a class="course course-text" target="_blank" href="#">
												<i class="courseIcon icon-jiaocheng"></i>文字教程 &gt;
											</a>
										</p>
									</div>
								</div>
							</div>
							<span></span>
						</div>
						<div class="step-span create-span">
							<div class="next-step next-step-circle next-step-vertical">
								<div class="next-step-item next-step-item-process next-step-item-first" style="width: auto;">
									<div class="next-step-item-tail"><i></i></div>
									<div class="next-step-item-container">
										<div class="next-step-item-node-placeholder">
											<div class="next-step-item-node">
												<div class="next-step-item-node-circle">1</div>
											</div>
										</div>
										<div class="next-step-item-body">
											<div class="next-step-item-title"></div>
											<div class="next-step-item-content">
												<div class="new-marketing-crowd-select panel">
													<p class="panel-head">营销人群</p>
													<div class="crowd-select-show ofl">
														<div class="crowd-select-module ofl select-wrapper">
															<span class="fl crowd-pic">
																<img src="//img.alicdn.com/tfs/TB13su3SXXXXXXVXXXXXXXXXXXX-50-50.png">
															</span>
															<div class="crowd-select-content">
																<div class="crowd-name-wrapper">
																	<span class="crowd-name">上新潜力人群</span>
																</div>
																<p class="crowd-remarks">系统算法自动计算对店内上新宝贝感兴趣的老客，包括上新偏好人群、店铺忠诚老客等。</p>
															</div>
														</div>
														<div class="crowd-select-module">
															<p class="title">总人数</p>
															<p class="cnt-wrapper">
																<span class="jxt-font cnt-text">0</span>
															</p>
															<p>可发优惠券、进行海报营销</p>
														</div>
														<div class="crowd-select-module">
															<p class="title">成交客户</p>
															<p class="cnt-wrapper">
																<span class="jxt-font cnt-text">0</span>
															</p>
															<p>只有成交客户才可以发短信</p>
														</div>
													</div>
													<div class="check-slider">
														<div class="title-panel">
															<label class="next-checkbox ">
																<span class="next-checkbox-inner">
																	<i class="next-icon next-icon-select next-icon-xs"></i>
																</span>
																<input type="checkbox" id="check" aria-checked="false" value="on">
															</label>
															<label for="check" class="next-checkbox-label">投放部分人群
																<span class="sub-tips">(优惠券和短信将按照选择投放人数从潜力上新人群中优选客户发送，海报仍会投放给全部人群)
																</span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="next-step-item next-step-item-wait" style="width: auto;">
									<div class="next-step-item-tail"><i></i></div>
									<div class="next-step-item-container">
										<div class="next-step-item-node-placeholder">
											<div class="next-step-item-node">
												<div class="next-step-item-node-circle">2</div>
											</div>
										</div>
										<div class="next-step-item-body">
											<div class="next-step-item-title"></div>
											<div class="next-step-item-content">
												<div class="benefit-select">
													<div class="panel">
														<div class="panel-head">选择权益 <span class="remarks">权益非必选</span></div>
														<div class="panel-body">
															<p class="panel-tips">1.权益非必选，为了更好的营销效果建议选择；2.计划创建后，优惠券不能修改、删除；3.优惠券直接发送到买家卡券包，不需要买家领取。</p>
															<div class="create-card-wrap benefit">
																<div class="create-card">
																	<div class="card-head">
																		<span class="card-title">优惠券</span>
																		<span class="card-icon">
																			<span class="preview-section">
																				<span class="preview-text">预览</span>
																				<i class="iconfont icon-yanjing"></i>
																			</span>
																		</span>
																		<div class="card-remarks">
																			<div class="grey-text">
																				<p>目标人群&nbsp;&nbsp;全部客户(0人)</p>
																				<p>发送时间&nbsp;&nbsp;未选择</p>
																			</div>
																		</div>
																	</div>
																	<div class="card-body">
																		<div class="empty-card">
																			<div class="iconbox">
																				<span class="iconPlus"> + </span>
																			</div>
																			<div class="text">添加优惠券</div>
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
								<div class="next-step-item next-step-item-wait" style="width: auto;">
									<div class="next-step-item-tail"><i></i></div>
									<div class="next-step-item-container">
										<div class="next-step-item-node-placeholder">
											<div class="next-step-item-node">
												<div class="next-step-item-node-circle">3</div>
											</div>
										</div>
										<div class="next-step-item-body">
											<div class="next-step-item-title"></div>
											<div class="next-step-item-content">
												<div class="transform-channel panel">
													<p class="panel-head">选择转化渠道</p>
													<div class="panel-body">
														<div class="channel-container">
															<div class="channel-item">
																<div class="create-card-wrap msg">
																	<div class="create-card">
																		<div class="card-head">
																			<span class="card-title">短信</span>
																			<span class="card-icon">
																				<span class="preview-section">
																					<span class="preview-text">预览</span>
																					<i class="iconfont icon-yanjing"></i>
																				</span>
																			</span>
																			<div class="card-remarks">
																				<div class="grey-text">
																					<p>目标人群&nbsp;&nbsp;成交客户(0人)</p>
																					<p>发送时间&nbsp;&nbsp;未选择</p>
																				</div>
																			</div>
																		</div>
																		<div class="card-body">
																			<div class="msg-content">
																				<div class="show-msg-wrap tao-link">
																					<div class="text">使用短信前请先开<br>通店铺首页淘短链</div>
																					<div>
																						<span class="btn">开通店铺首页淘短链</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="channel-item">
																<div class="create-card-wrap banner">
																	<div class="create-card">
																		<div class="card-head">
																			<span class="card-title">新建海报</span>
																			<span class="card-icon">
																				<span class="preview-section">
																					<span class="preview-text">预览</span>
																					<i class="iconfont icon-yanjing"></i>
																				</span>
																			</span>
																			<div class="card-remarks">
																				<div class="grey-text">
																					<p>目标人群&nbsp;&nbsp;全部客户(0人)</p>
																					<p>发送时间&nbsp;&nbsp;未选择</p>
																				</div>
																			</div>
																		</div>
																		<div class="card-body">
																			<div class="empty-card">
																				<div class="iconbox">
																					<span class="iconPlus"> + </span>
																				</div>
																				<div class="text">添加新建海报</div>
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
								<div class="next-step-item next-step-item-wait next-step-item-last" style="width: auto;">
									<div class="next-step-item-tail"><i></i></div>
									<div class="next-step-item-container">
										<div class="next-step-item-node-placeholder">
											<div class="next-step-item-node">
												<div class="next-step-item-node-circle">4</div>
											</div>
										</div>
										<div class="next-step-item-body">
											<div class="next-step-item-title"></div>
											<div class="next-step-item-content">
												<div class="panel">
													<div class="panel-head">
														<div class="strategy-title">策略名称</div>
													</div>
													<div class="panel-body">
														<div class="strategy-input">
															<span class="next-input next-input-single next-input-large">
																<input type="text" value="上新老客提醒2017-11-07" height="100%">
															</span>
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
</div>

<!-- dialog -->
	<!-- 各种预览 start -->
<div class="mask-dialog dialog-benefit">
	<div class="preview-dialog-content benefit">
		<div class="img-content">
			<div>
				<img src="//img.alicdn.com/tfs/TB11tbRQVXXXXcxaXXXXXXXXXXX-320-181.png" class="benefixImg" alt="">
				<img src="//img.alicdn.com/tfs/TB1M0SvRFXXXXctXXXXXXXXXXXX-381-17.png" class="benefixTips">
			</div>
		</div>
	</div>
</div>

<div class="mask-dialog dialog-msg">
	<div class="preview-dialog-content msg">
		<div class="msg-preview-content">
			<div class="noContent">
				<div>亲爱的${淘宝昵称}$，您前几天挑选加购/收藏的${商品名称}$还满意吗？${*元优惠券}$已经发到你的账户，快进店${店铺首页短链}$来看看，满意就带走吧！退订回复TD</div>
				<div class="arrowBox">
					<img src="//gw.alicdn.com/tfs/TB1yUrjRXXXXXXAXVXXXXXXXXXX-45-17.png" class="arrow">
					<p class="text">此处为短信示意图，最终会根据您<br>选择的短信模板进行发送</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="mask-dialog dialog-banner">
	<div class="preview-dialog-content banner">
		<div class="banner-preview-content">	
			<img src="//img.alicdn.com/tfs/TB1scp.RFXXXXcDXXXXXXXXXXXX-375-130.png" class="posterImg" alt="">
		</div>
	</div>
</div>
	<!-- 各种预览 end -->

	<!-- 添加优惠券  start -->
<div class="mask-dialog dialog-coupon">
	<div class="layer layer-fr" style="height: 610px;">
		<i class="next-icon next-icon-close next-icon-medium layer-btn-close">x</i>
		<div class="layer-bd" style="max-height: 542px;">
			<div class="sls-section">
				<div class="sls-title">选择权益</div>
				<div class="sls-tips">
					<div class="sls-tips-content">创建店铺优惠券时，推广方式请选择“卖家发放”，推广范围请选择"客户关系管理"</div>
					<div class="sls-tips-action">
						<button type="button" class="next-btn next-btn-secondary next-btn-medium">+ 新建优惠券</button>
					</div>
				</div>
				<div class="sls-selector">
					<div class="blue-benefit-selector select-benefit has-notice">
						<div class="c-table-wrap">
							<div class="next-table only-bottom-border">
								<div class="next-table-inner">
									<div class="next-table-header">
										<div class="next-table-header-inner">
											<table>
												<colgroup>
													<col style="width: 48px;">
													<col style="width: 230px;">
													<col>
													<col>
													<col>
													<col>
													<col>
												</colgroup>
												<tbody>
													<tr>
														<th rowspan="1" class="next-table-selection">
															<div class="next-table-cell-wrapper"></div>
														</th>
														<th rowspan="1">
															<div class="next-table-cell-wrapper">权益活动名称</div>
														</th>
														<th rowspan="1">
															<div class="next-table-cell-wrapper">优惠券金额</div>
														</th>
														<th rowspan="1">
															<div class="next-table-cell-wrapper">发行量</div>
														</th>
														<th rowspan="1">
															<div class="next-table-cell-wrapper">已领取</div>
														</th>
														<th rowspan="1">
															<div class="next-table-cell-wrapper">活动时间</div>
														</th>
														<th rowspan="1">
															<div class="next-table-cell-wrapper">使用条件</div>
														</th>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="next-table-body">
										<table>
											<colgroup>
												<col style="width: 48px;">
												<col style="width: 230px;">
												<col>
												<col>
												<col>
												<col>
												<col>
											</colgroup>
											<tbody>
												<tr class="next-table-row last first title-1">
													<td class="next-table-selection">
														<div class="next-table-cell-wrapper">
															<label class="">
																<span class="next-radio ">
																	<span class="next-radio-inner"></span>
																	<input type="radio" aria-checked="false" value="on">
																</span>
															</label>
														</div>
													</td>
													<td colspan="7" rowspan="1">
														<div class="next-table-cell-wrapper">
															<div class="logo-container">
																<div class="title">
																	<div class="notice">
																		<img src="//img.alicdn.com/tps/TB1WwJDPXXXXXcLXXXXXXXXXXXX-28-28.png">
																		<span>根据您选择的人群规模，设置优惠券的数量建议达到0张，优惠券每天发送总量为5万张。</span>
																	</div>
																</div>
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
						<div class="placeholder">
							<div class="exception-container">
								<div class="text-container">您尚未订购优惠券工具，不能使用本功能。<a href="//fuwu.taobao.com/ser/detail.htm?service_code=SERV_DPYHQ" target="_blank">立即订购</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="send-time">
					<span class="send-title">发送时间： </span>
					<div class="next-radio-group">
						<label class="">
							<span class="next-radio ">
								<span class="next-radio-inner"></span>
								<input type="radio" checked  name="toSend">
							</span>
							<span class="next-radio-label">立即发送</span>
						</label>
						<label class="">
							<span class="next-radio ">
								<span class="next-radio-inner"></span>
								<input type="radio" name="toSend">
							</span>
							<span class="next-radio-label" >定时发送</span>
						</label>
					</div>
					<div value="2017-11-11" class="next-date-picker next-date-picker-medium next-date-picker-disabled" style="display: inline-block;">
						<span class="next-input next-input-single next-input-medium disabled">
							<input type="text" value="2017-11-11 09:11" disabled placeholder="请选择日期" height="100%">
						</span>
						<i class="next-icon next-icon-delete-filling next-icon-small">x</i>
					</div>
					<!-- <div class="next-time-picker next-time-picker-size-medium next-time-picker-disabled" style="display: inline-block;">
						<span class="next-input next-input-single next-input-medium disabled">
							<input type="text" disabled placeholder="请选择时间" height="100%">

						</span>
						<i class="next-icon next-icon-clock next-icon-small"></i>
					</div> -->
				</div>
			</div>
		</div>
		<div class="layer-ft">
			<button type="button" class="next-btn next-btn-primary next-btn-medium">确定</button>
			<button type="button" class="next-btn next-btn-normal next-btn-medium layer-btn-cancel">取消</button>
		</div>
	</div>
	<div class="layer new-coupon" style="height: 400px;">
		<i class="next-icon next-icon-close next-icon-medium layer-btn-close">x</i>
		<div class="layer-bd" style="max-height: 400px;">
			<div class="grid-c">
				<div class="service-status">
               	 <div class="msg24">
               	 	<p class="tips">您订购优惠券后就能立即使用本服务；主动营销买家提升回头客。</p>
               	 </div>
				 <p>
				 	<a title="马上订购" target="_blank" href="javascript:;" class="long-btn">马上订购</a>
				 </p>
            </div>
			</div>
		</div>
	</div>
</div>
	<!-- 添加优惠券  end -->



<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js"></script>

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
		$("ul.menu-sub li").click(function() {
			e.stopPropagation();
		})
	}

	
	// 点击预览
	$(".custom-marketing-create .benefit-select .create-card-wrap.benefit .card-icon").click(function() {
		$(".mask-dialog.dialog-benefit").fadeIn(500);
		$(".preview-dialog-content.benefit").fadeIn(500);
	})
	$(".mask-dialog.dialog-benefit").click(function() {
		$(this).hide();
	})
	$(".custom-marketing-create .transform-channel .channel-item .create-card-wrap.msg .card-icon").click(function() {
		$(".mask-dialog.dialog-msg").fadeIn(500);
		$(".preview-dialog-content.msg").fadeIn(500);
	})
	$(".mask-dialog.dialog-msg").click(function() {
		$(this).hide();
	})
	$(".custom-marketing-create .transform-channel .channel-item .create-card-wrap.banner .card-icon").click(function() {
		$(".mask-dialog.dialog-banner").fadeIn(500);
		$(".preview-dialog-content.banner").fadeIn(500);
	})
	$(".mask-dialog.dialog-banner").click(function() {
		$(this).hide();
	})
	
	// 点击添加优惠券
	$(".custom-marketing-create .benefit-select .create-card-wrap.benefit .empty-card").click(function() {
		$(".mask-dialog.dialog-coupon").fadeIn(500);
		$(".layer.layer-fr").addClass("comein");
	})
	$(".layer.layer-fr .layer-btn-close,.layer.layer-fr .layer-ft button").click(function() {
		$(".layer.layer-fr").removeClass("comein");
		$(".mask-dialog").fadeOut(500);
	})
	$(".layer.layer-fr .layer-bd .sls-tips .sls-tips-action").click(function() {
		$(".layer.layer-fr").removeClass("comein");
		$(".layer.new-coupon").addClass("comein");
	})
	$(".layer.new-coupon .layer-btn-close").click(function() {
		$(".layer.layer-fr").addClass("comein");
		$(".layer.new-coupon").removeClass("comein");
	})

	// 点击发送时间
	$(".layer.layer-fr .send-time .next-radio-group label").click(function() {
		if($(this).index() === 1) {
			$(this).parents(".next-radio-group").siblings().find("span.disabled").removeClass("disabled").children("input").removeAttr("disabled").parents(".next-input").siblings(".next-icon").show();
		}else {
			$(this).parents(".next-radio-group").siblings().find(".next-input").addClass("disabled").children("input").attr("disabled",true).parents(".next-input").siblings(".next-icon").hide();
		}
	})
	
	$(".layer.layer-fr .send-time .next-date-picker input").datetimepicker({
		// format: 'Y-m-d',
		timepicker: true,
		weeks: false,
		allowTimes: false,
	})
	$(".next-date-picker .next-icon").click(function() {
		$(this).siblings(".next-input").find("input").val("");
	}) 

</script>


</html>

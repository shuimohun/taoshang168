<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!-- 智能营销  智能复购提醒 点击页面-->


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
				<div class="smart-rebuy-page">
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
								<a href="#" class="next-breadcrumb-text">智能复购提醒</a>
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
					<div>
						<div class="create-page">
							<div class="step-span create-span">
								<div class="next-step next-step-circle next-step-vertical">
									<div class="next-step-item next-step-item-finish next-step-item-first" style="width: auto;">
										<div class="next-step-item-tail"><i></i></div>
										<div class="next-step-item-container">
											<div class="next-step-item-node-placeholder">
												<div class="next-step-item-node"><div class="next-step-item-node-circle"><i class="next-icon next-icon-select next-icon-medium"></i></div></div>
											</div>
											<div class="next-step-item-body">
												<div class="next-step-item-title"></div>
												<div class="next-step-item-content">
													<div class="create-step step-1">
														<div class="goods-select-container">
															<div class="next-notice next-notice-prompt next-notice-standalone next-notice-medium next-notice-title-content fadeInDown">
																<i class="next-icon next-icon-prompt next-icon-medium next-notice-symbol"></i>
																<a href="javascript:;" class="next-notice-close">
																	<i class="next-icon next-icon-close next-icon-medium">x</i>
																</a>
																<div class="next-notice-title">店铺近30天内成交人数&gt;50，且180天内复购率&gt;0.3%的商品才可设置复购提醒。</div>
															</div>
															<div class="goods-select-main">
																<div class="step-head">
																	<div class="title-panel">选择商品</div>
																	<div class="subtitle-panel">共有
																		<span class="color-blue">0</span>个商品符合提醒，已经选择
																		<span class="color-blue">0</span>个商品
																	</div>
																</div>
																<div class="c-table-wrap">
																	<div class="next-table only-bottom-border">
																		<div class="next-table-inner">
																			<div class="next-table-header">
																				<div class="next-table-header-inner">
																					<table>
																						<colgroup>
																							<col style="width: 48px;">
																							<col style="width: 25%;">
																							<col style="width: 10%;">
																							<col style="width: 20%;">
																							<col style="width: 15%;">
																							<col style="width: 30%;">
																						</colgroup>
																						<tbody>
																							<tr>
																								<th rowspan="1" class="next-table-selection">
																									<div class="next-table-cell-wrapper">
																										<label class="next-checkbox ">
																											<span class="next-checkbox-inner">
																												<i class="next-icon next-icon-select next-icon-xs"></i>
																											</span>
																											<input type="checkbox">
																										</label>
																									</div>
																								</th>
																								<th rowspan="1">
																									<div class="next-table-cell-wrapper">宝贝名称</div>
																								</th>
																								<th rowspan="1">
																									<div class="next-table-cell-wrapper">状态</div>
																								</th>
																								<th rowspan="1">
																									<div class="next-table-cell-wrapper">每周可触达人数
																									</div>
																								</th>
																								<th rowspan="1">
																									<div class="next-table-cell-wrapper">
																										<span>复购率&nbsp;&nbsp;
																											<i class="next-icon next-icon-help next-icon-small"></i>
																										</span>
																									</div>
																								</th>
																								<th rowspan="1">
																									<div class="next-table-cell-wrapper">
																										<span>复购周期（商品所在子类目）&nbsp;
																											<i class="next-icon next-icon-help next-icon-small"></i>
																										</span>
																									</div>
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
																						<col>
																						<col>
																						<col>
																						<col>
																						<col>
																					</colgroup>
																					<tbody>
																						<tr>
																							<td colspan="6">
																								<div class="next-table-empty">
																									<div>
																										<img src="//gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																										<div class="err-msg">
																											<div class="goods-nodata">
																												<p>您没有任何商品符合复购提醒门槛</p><p>你可以先看看
																													<a href="#" target="_blank">教学贴</a>
																												</p>
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
																	<div class="table-pagination clearfix"></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="next-step-item next-step-item-finish" style="width: auto;">
										<div class="next-step-item-tail"><i></i></div>
										<div class="next-step-item-container">
											<div class="next-step-item-node-placeholder">
												<div class="next-step-item-node">
													<div class="next-step-item-node-circle">
														<i class="next-icon next-icon-select next-icon-medium"></i>
													</div>
												</div>
											</div>
											<div class="next-step-item-body">
												<div class="next-step-item-title"></div>
												<div class="next-step-item-content">
													<div class="create-step step-2">
														<div class="step-head">
															<div class="title-panel">选择权益<i class="next-icon next-icon-help next-icon-small"></i></div>
														</div>
														<div class="next-tabs next-tabs-top next-tabs next-tabs-strip next-tabs-medium tab-panel">
															<div class="next-tabs-bar">
																<div class="next-tabs-nav-container ">
																	<div class="next-tabs-nav-wrap">
																		<div class="next-tabs-nav-scroll" style="width: 100%;">
																			<div class="next-tabs-nav" style="transform: translate3d(0px, 0px, 0px);">
																				<div class="next-tabs-tab-active next-tabs-tab">
																					<div class="next-tabs-tab-inner">优惠券</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="next-tabs-content">
																<div class="next-tabs-tabpane" style="display: block;">
																	<div class="blue-benefit-selector">
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
																								<col>
																								<col>
																								<col>
																								<col>
																								<col>
																								<col>
																							</colgroup>
																							<tbody>
																								<tr>
																									<td colspan="7">
																										<div class="next-table-empty">
																											<div>
																												<img src="//gw.alicdn.com/tfscom/TB1c9VgKVXXXXXhXXXXWA_BHXXX-48-51.png">
																												<div class="err-msg">暂无数据</div>
																											</div>
																										</div>
																									</td>
																								</tr>
																							</tbody>
																						</table>
																					</div>
																				</div>
																			</div>
																			<div class="table-pagination clearfix"></div>
																		</div>
																		<div class="placeholder">
																			<div class="exception-container">
																				<div class="text-container">您尚未订购优惠券工具，不能使用该功能！
																					<a target="_blank" href="#">立即订购</a>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="coupon-add">
															<button type="button" class="next-btn next-btn-secondary next-btn-medium">
																<i class="jxtportal jxt-tianjia"></i>新建优惠券
															</button>
															<span class="btn-span">创建店铺优惠券时，推广方式请选择“买家领取”，领券形式选择“渠道专享－&gt;客户运营平台专享“。</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="next-step-item next-step-item-finish next-step-item-last" style="width: auto;">
										<div class="next-step-item-tail"><i></i></div>
										<div class="next-step-item-container">
											<div class="next-step-item-node-placeholder"><div class="next-step-item-node"><div class="next-step-item-node-circle"><i class="next-icon next-icon-select next-icon-medium"></i></div></div></div>
											<div class="next-step-item-body">
												<div class="next-step-item-title"></div>
												<div class="next-step-item-content">
													<div class="create-step step-3">
														<div class="form-field">
															<div class="form-field-title">计划名称</div>
															<div class="input-span">
																<span class="next-input next-input-single next-input-large">
																	<input type="text" value="智能复购提醒20171107" height="100%">
																</span>
															</div>
														</div>
														<div class="form-field">
															<div class="form-field-title">计划时间</div>
															<div class="blue-date-picker">
																<div class="next-btn-group">
																	<button type="button" class="next-btn next-btn-normal next-btn-medium">持续7天</button>
																	<button type="button" class="next-btn next-btn-normal next-btn-medium">持续14天</button>
																	<button type="button" class="next-btn next-btn-normal next-btn-medium">持续21天</button>
																</div>
																<div class="next-date-picker next-date-picker-medium next-date-picker-disabled">
																	<span class="next-input next-input-single next-input-medium disabled">
																		<input type="text" disabled="" value="2017-11-12" placeholder="请选择日期" height="100%">
																	</span>
																	<i class="next-icon next-icon-calendar next-icon-small">x</i>
																</div>
																<span class="symbol"> － </span>
																<div value="2017-11-14" class="next-date-picker next-date-picker-medium">
																	<span class="next-input next-input-single next-input-medium">
																		<input type="text" value="2017-11-18" placeholder="请选择日期" height="100%">
																	</span>
																	<i title="清除" class="next-icon next-icon-delete-filling next-icon-small">x</i>
																</div>
															</div>
														</div>
														<div class="form-field pre-remind">
															<div class="form-field-title">到期提醒</div>
															<div class="next-switch next-switch-on next-switch-small" >
																<div class="next-switch-trigger"></div>
																<div class="next-switch-children"></div>
															</div>
															<div class="pre-remind-hint">到期前一天旺旺提醒我，计划时间最后一天前旺旺提醒设置的旺旺ID</div>
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
<div class="mask-dialog"></div>


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
		$("ul.menu-sub li").click(function(e) {
			e.stopPropagation();
		})
	}


	// 点击计划时间
	$(".smart-rebuy-page .create-step.step-3 .blue-date-picker button").click(function() {
		$(this).addClass("next-btn-primary").siblings(".next-btn-primary").removeClass("next-btn-primary");
		var index = $(this).index();
		
	})
	$(".smart-rebuy-page .create-step.step-3 .blue-date-picker .next-date-picker input").datetimepicker({
		format: 'Y-m-d',
		timepicker: false,
		weeks: false,
		allowTimes: false,
	})

	// 绿色按钮
	$(".next-switch").click(function() {
		if($(this).hasClass("next-switch-on")) {
			$(this).removeClass("next-switch-on").addClass("next-switch-off");
		}else {
			$(this).addClass("next-switch-on").removeClass("next-switch-off");
		}
	})
	// 清除
	$(".next-date-picker .next-icon").click(function() {
		$(this).siblings(".next-input").find("input").val("");
	}) 
</script>


</html>

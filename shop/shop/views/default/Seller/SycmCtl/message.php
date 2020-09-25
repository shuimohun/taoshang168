<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--作战室-->

<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/spm.css">

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
				<!-- g工具箱 -->
				<div class="hold-all-wrap main-switch-wrap" style="display: block;">
					<div>
						<div class="blue-crm-title">
							<span class="crm-title">短信</span>
							<span class="crm-subtitle"></span>
						</div>
						<a href="javascript:;" target="_blank" class="sub-title rt">
							去智能营销向兴趣人群发送短信 >
						</a>
					</div>
					<div class="message-record">
						<div class="record-head">
							<div class="head-row">
								<div class="message-left">短信剩余</div>
								<div>
									<span class="jxt-font">0</span>条
								</div>
							</div>
							<div class="head-row half">
								<div class="head-title">短信签名</div>
								<div>淘尚168商城</div>
							</div>
							<div class="head-row half">
								<div class="head-title">余量预警</div>
								<div>即将上线</div>
							</div>
							<div class="head-row large">
								<div class="btn-msg-88">
									<img src="https://img.alicdn.com/tfs/TB1eKYMX2BNTKJjy0FdXXcPpVXa-93-44.png">
								</div>
								<button type="button" class="next-btn next-btn-secondary next-btn-medium btrigger">开发票</button>
							</div>
						</div>
						<div class="record-table">
							<div class="next-tabs next-tabs-top next-tabs next-tabs-strip next-tabs-medium">
								<div class="next-tabs-bar">
									<div class="next-tabs-nav-container ">
										<div class="next-tabs-nav-wrap">
											<div class="next-tabs-nav-scroll" style="width: 100%;">
												<div class="next-tabs-nav">
													<div class="next-tabs-tab next-tabs-tab-active">
														<div class="next-tabs-tab-inner">短信发送日志</div>
													</div>
													<div class="next-tabs-tab">
														<div class="next-tabs-tab-inner">充值记录</div>
													</div>
													<div class="next-tabs-tab">
														<div class="next-tabs-tab-inner">短信模板</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="next-tabs-content">
									<div class="next-tabs-tabpane">
										<div class="search-span">
											<span class="date-title">发送日期</span>
											<div class="next-date-picker next-range-picker next-date-picker-medium next-range-picker-medium">
												<div class="next-range-picker-trigger">
													<span class="next-input next-input-single next-input-medium">
														<input type="text" value="2017-11-01" placeholder="起始时间" height="100%">
													</span>
													<span class="next-range-picker-separator"> - </span>
													<span class="next-input next-input-single next-input-medium">
														<input type="text" value="2017-11-02" placeholder="结束时间" height="100%">
													</span>
												</div>
												<i class="next-icon next-icon-delete-filling next-icon-small">x</i>
											</div>
											<button type="button" class="next-btn next-btn-primary next-btn-medium search-btn">
												搜索
											</button>
											<span class="color-blue">重置</span>
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
																	<col>
																</colgroup>
																<tbody>
																	<tr>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				发送日期
																			</div>
																		</th>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				<span>提交条数</span>
																				<span class="tips-wrap">
																					<i class="icon icon-tips"></i>
																					<div class="tips-guide-wrap">
																						指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																					</div>
																				</span>
																			</div>
																		</th>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				<span>成功条数</span>
																				<span class="tips-wrap">
																					<i class="icon icon-tips"></i>
																					<div class="tips-guide-wrap">
																						指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																					</div>
																				</span>
																			</div>
																		</th>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				<span>计费条数</span>
																				<span class="tips-wrap">
																					<i class="icon icon-tips"></i>
																					<div class="tips-guide-wrap">
																						指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																					</div>
																				</span>
																			</div>
																		</th>
																		<th colspan="1">
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
										<div class="search-span">
											<span class="date-title">发送日期</span>
											<div class="next-date-picker next-range-picker next-date-picker-medium next-range-picker-medium">
												<div class="next-range-picker-trigger">
													<span class="next-input next-input-single next-input-medium">
														<input type="text" value="2017-11-01" placeholder="起始时间" height="100%">
													</span>
													<span class="next-range-picker-separator"> - </span>
													<span class="next-input next-input-single next-input-medium">
														<input type="text" value="2017-11-02" placeholder="结束时间" height="100%">
													</span>
												</div>
												<i class="next-icon next-icon-delete-filling next-icon-small">x</i>
											</div>
											<button type="button" class="next-btn next-btn-primary next-btn-medium search-btn">
												搜索
											</button>
											<span class="color-blue">重置</span>
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
																	<col>
																</colgroup>
																<tbody>
																	<tr>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				发送日期
																			</div>
																		</th>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				<span>提交条数</span>
																				<span class="tips-wrap">
																					<i class="icon icon-tips"></i>
																					<div class="tips-guide-wrap">
																						指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																					</div>
																				</span>
																			</div>
																		</th>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				<span>成功条数</span>
																				<span class="tips-wrap">
																					<i class="icon icon-tips"></i>
																					<div class="tips-guide-wrap">
																						指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																					</div>
																				</span>
																			</div>
																		</th>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				<span>计费条数</span>
																				<span class="tips-wrap">
																					<i class="icon icon-tips"></i>
																					<div class="tips-guide-wrap">
																						指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																					</div>
																				</span>
																			</div>
																		</th>
																		<th colspan="1">
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
										<div class="search-span">
											<span class="date-title">模板名称</span>
											<span class="next-input next-input-single next-input-medium">
												<input type="text" name="">
											</span>
											<button type="button" class="next-btn next-btn-primary next-btn-medium search-btn">
												搜索
											</button>
											<span class="color-blue">重置</span>
											<button type="button" class="next-btn next-btn-primary next-btn-medium short-msg-new rt">
												新建模板
											</button>
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
																	<col>
																</colgroup>
																<tbody>
																	<tr>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				发送日期
																			</div>
																		</th>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				<span>提交条数</span>
																				<span class="tips-wrap">
																					<i class="icon icon-tips"></i>
																					<div class="tips-guide-wrap">
																						指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																					</div>
																				</span>
																			</div>
																		</th>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				<span>成功条数</span>
																				<span class="tips-wrap">
																					<i class="icon icon-tips"></i>
																					<div class="tips-guide-wrap">
																						指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																					</div>
																				</span>
																			</div>
																		</th>
																		<th colspan="1">
																			<div class="next-table-cell-wrapper">
																				<span>计费条数</span>
																				<span class="tips-wrap">
																					<i class="icon icon-tips"></i>
																					<div class="tips-guide-wrap">
																						指店铺中所有商品(包含下架商品)有被访问过的商品去重数，用于提醒亲注意商品详情页流量的合理利用
																					</div>
																				</span>
																			</div>
																		</th>
																		<th colspan="1">
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
<div class="dialog-pop-newModule">
	<div class="next-dialog-header">
		新建短信模板
	</div>
	<div class="next-dialog-body">
		<div class="short-msg-editor-preview">
			<div class="short-msg-editor-preview-content">
				【<span>店铺名称</span>】-回复T退订
			</div>
		</div>
		<form class="next-form next-form-left ver next-form-medium">
			<div class="next-form-item next-row">
				<label class="next-col-3 next-form-item-label">模板名称: </label>
				<div class="next-col-21 next-form-item-control">
					<span class="next-input next-input-single next-input-medium short-msg-editor-name inner-element">
						<input type="text" name="">
					</span>
					<span class="short-msg-editor-limit">0/30</span>
				</div>
			</div>
			<div class="next-form-item next-row">
				<label class="next-col-3 next-form-item-label">短信内容: </label>
				<div class="next-col-21 next-form-item-control">
					<div class="msg-editor-container">
						<textarea class="msg-editor-content"></textarea>	
						<div class="msg-editor-bottom-tips">
							<span class="color-yellow">短信预计15个字符，以实际发送为准。</span>
							<i class="next-icon next-icon-help next-icon-xs"></i>
							<span class="msg-editor-bottom-help">
								<span>查看计费规则</span>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="next-form-item next-row">
				<label class="next-col-3 next-form-item-label">插入变量: </label>
				<div class="next-col-21 next-form-item-control">
					<span class="variable-item">淘宝昵称</span>
					<span class="variable-item">收货人姓名</span>
					<span class="variable-item">优惠券金额</span>
					<span class="variable-item">优惠券失效日期</span>
					<span class="variable-item">店铺会员等级</span>
				</div>
			</div>
			<div class="next-form-item next-row">
				<label class="next-col-3 next-form-item-label">测试短信: </label>
				<div class="next-col-21 next-form-item-control">
					<span class="next-input next-input-single next-input-medium short-msg-editor-msg-testing inner-element">
						<input type="text" placeholder="测试手机号，可输入多个，用英文逗号隔开" value="" >
					</span>
					<span class="short-msg-editor-testing-action">测试发送</span>
				</div>
			</div>
		</form>
	</div>
	<div class="next-dialog-footer">
		<button type="button" class="next-btn next-btn-primary next-btn-medium">提交审核</button>
		<button type="button" class="next-btn next-btn-normal next-btn-medium">取消</button>
	</div>
	<a href="javascript:;" class="next-dialog-close">
		<i class="next-icon next-icon-close next-icon-small">x</i>
	</a>
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<!-- <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script> -->

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

	$(".next-tabs-tabpane").eq(0).show();
	$(".next-tabs-tab").click(function() {
		var index = $(this).index();
		$(".next-tabs-tabpane").hide().eq(index).show();
		$(this).addClass("next-tabs-tab-active").siblings(".next-tabs-tab-active").removeClass("next-tabs-tab-active");
	})
	$(".discountedListTab .label").click(function () {
		$(this).addClass("active").siblings(".active").removeClass("active");
	})

	// 新建模板  弹
	$(".message-record .record-table .next-tabs-content .next-tabs-tabpane .search-span .next-btn.rt").click(function() {
		$(".mask-dialog").fadeIn(500);
		$(".dialog-pop-newModule").fadeIn(550);
	})
	$(".next-dialog-close,.next-dialog-footer .next-btn-normal").click(function() {
		$(".mask-dialog").hide();
		$(".dialog-pop-newModule").hide();
	})
	$(".next-dialog-body .next-input input").keyup(function() {
		// console.log($(this).val().length)
		var inputLength = $(this).val().length;
		var limitNum =$(".short-msg-editor-limit").text().slice(-2);
		if(inputLength > limitNum){
			$(this).val($(this).val().slice(0,limitNum))
		}
		$(".short-msg-editor-limit").text(inputLength+"/30");
		
	})
	$(".next-dialog-body .msg-editor-content").keyup(function() {
		var text = $(this).val();
		$(".short-msg-editor-preview-content span").text(text);
	})
	$(".next-dialog-body .msg-editor-content").blur(function() {
		if($(this).val() === "") {
			$(".short-msg-editor-preview-content span").text("店铺名称");
		}
	})
</script>


</html>

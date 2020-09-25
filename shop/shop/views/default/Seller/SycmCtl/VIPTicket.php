<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--  营销----忠诚度管理 无线端会员装修中心--设置页面    -->

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
				<div class="right-container">
					<div class="root">
						<div class="app">
							<!-- tab 标签可以删除  此标签是用来赢藏显示的父标签 -->
							<div class="tab">
								<div class="row oly-row-container clu-breadcrumb">
									<div class="sui-breadcrumb">
										<span>
											<a class="sui-breadcrumb-link" href="#">
												<span">会员营销</span>
											</a>
											<span class="sui-breadcrumb-separator" >/</span>
										</span>
										<span>
											<span class="sui-breadcrumb-link">
												<span >新会员专享券</span>
											</span>
											<span class="sui-breadcrumb-separator">/</span>
										</span>
									</div>
								</div>
								<div class="row oly-row-container clu-head clearfix">
									<div class="col-20 oly-col-container  f-cb">
										<div class="oly-image-container clu-img lf" style="width:80px;height:80px;" >
											<img src="https://img.alicdn.com/tps/TB1tyltKXXXXXbKXXXXXXXXXXXX-80-80.jpg">
										</div>
										<p class="clu-title">新会员专享券</p>
										<p class="clu-detail" >品牌为招募的新会员设置的专享优惠券</p>
									</div>
									<div class="col-4 oly-col-container  clu-newBtn">
										<button href="#" type="button" class="sui-btn sui-btn-primary">+ 新增新会员专享券</button>
									</div>
								</div>
								<div class="row oly-row-container clearfix">
									<div class="col-24 oly-col-container ">
										<div class="clearfix sui-table-empty">
											<div>
												<div class="sui-table sui-table-large clu-table">
													<div class="sui-table-body">
														<table>
															<colgroup >
																<col>
																<col >
																<col>
																<col>
																<col>
																<col>
																<col>
															</colgroup>
															<thead class="sui-table-thead" >
																<tr>
																	<th>
																		<div>
																			<span>活动名称</span>
																		</div>
																	</th>
																	<th>
																		<div >
																			<span>入会时长</span>
																		</div>
																	</th>
																	<th>
																		<div >
																			<span>活动时间</span>
																		</div>
																	</th>
																	<th>	
																		<div >
																			<span>活动状态</span>
																			<div class="sui-table-column-filter">
																				<i class=" suicon suicon-down" title="筛选"></i>
																			</div>
																		</div>
																		<div class="sui-dropdown  sui-dropdown-placement-bottomLeft">
																			<div class="sui-table-filter-dropdown">
																				<ul class="sui-dropdown-menu sui-dropdown-menu-vertical  sui-dropdown-menu-root">
																					<li class="sui-dropdown-menu-item">
																						<span class="sui-checkbox">
																							<span class="sui-checkbox-inner"></span>
																							<input type="checkbox" class="sui-checkbox-input">
																						</span>
																						<span>已删除</span>
																					</li>
																					<li class="sui-dropdown-menu-item">
																						<span class="sui-checkbox">
																							<span class="sui-checkbox-inner"></span>
																							<input type="checkbox" class="sui-checkbox-input">
																						</span>
																						<span>未开始</span>
																					</li>
																					<li class="sui-dropdown-menu-item">
																						<span class="sui-checkbox">
																							<span class="sui-checkbox-inner"></span>
																							<input type="checkbox" class="sui-checkbox-input">
																						</span>
																						<span>进行中</span>
																					</li>
																					<li class="sui-dropdown-menu-item">
																						<span class="sui-checkbox">
																							<span class="sui-checkbox-inner"></span>
																							<input type="checkbox" class="sui-checkbox-input">
																						</span>
																						<span>已结束</span>
																					</li>
																					<li class="sui-dropdown-menu-item">
																						<span class="sui-checkbox">
																							<span class="sui-checkbox-inner"></span>
																							<input type="checkbox" class="sui-checkbox-input">
																						</span>
																						<span >全部</span>
																					</li>
																				</ul>
																				<div class="sui-table-filter-dropdown-btns">
																					<a class="sui-table-filter-dropdown-link confirm">确定</a>
																					<a class="sui-table-filter-dropdown-link clear">重置</a>
																				</div>
																			</div>
																		</div>
																	</th>
																	<th>
																		<div>
																			<span>参与人数</span>
																		</div>
																	</th>
																	<th>
																		<div>
																			<span> 领取份数</span>
																		</div>
																	</th>
																	<th>
																		<div>
																			<span>操作</span>
																		</div>
																	</th>
																</tr>
															</thead>
															<tbody class="sui-table-tbody"></tbody>
														</table>
													</div>
												</div>
												<div class="sui-table-placeholder">
													<i class=" suicon suicon-frown"></i>
													<span>暂无数据</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab">
								<div class="row oly-row-container clu-breadcrumb">
									<div class="sui-breadcrumb">
										<span>
											<a class="sui-breadcrumb-link" href="#">
												<span">会员营销</span>
											</a>
											<span class="sui-breadcrumb-separator" >/</span>
										</span>
											<a class="sui-breadcrumb-link" href="#">
												<span">新会员专享券</span>
											</a>
											<span class="sui-breadcrumb-separator" >/</span>
										</span>
										<span>
											<span class="sui-breadcrumb-link">
												<span >新增新会员专享券</span>
											</span>
											<span class="sui-breadcrumb-separator">/</span>
										</span>
									</div>
								</div>
								<div class="row oly-row-container add-form">
									<div class="row oly-row-container add-form-item clearfix">
										<div class="col-2 oly-col-container  label-col">
											<label class="oly-label-container" value="活动名称">
												<b class="oly-label-star" style="display:none;" >*</b>
												<span>活动名称</span>
											</label>
										</div>
										<div class="col-10 oly-col-container ">
											<div class="form-name-input">
												<span  >
													<input type="text" placeholder="" value="" class="sui-input">
												</span>
											</div>
										</div>
									</div>
									<div class="row oly-row-container add-form-item clearfix">
										<div class="col-2 oly-col-container  label-col">
											<label class="oly-label-container" value="活动时间">
												<b class="oly-label-star" style="display:none;">*</b>
												<span>活动时间</span>
											</label>
										</div>
										<div class="col-20 oly-col-container ">
											<div class="valid-time">
												<span class="sui-calendar-picker" style="width:298px;" >
													<span class="sui-calendar-range-picker sui-input" >
														<input placeholder="开始日期" class="sui-calendar-range-picker-input">
														<span class="sui-calendar-range-picker-separator"> — </span>
														<input placeholder="结束日期" class="sui-calendar-range-picker-input">
														<span class="sui-calendar-picker-icon"></span>
													</span>
												</span>
											</div>
										</div>
									</div>
									<div class="row oly-row-container add-form-item clearfix">
										<div class="col-2 oly-col-container  label-col">
											<label class="oly-label-container" value="选择礼券">
												<b class="oly-label-star" style="display:none;" >*</b>
												<span>选择礼券</span>
											</label>
										</div>
										<div class="col-22 oly-col-container ">
											<div class="clearfix sui-table-empty">
												<div>
													<div class="sui-table sui-table-large form-table">
														<div class="sui-table-body">
															<table>
																<colgroup>
																	<col>
																	<col>
																	<col >
																	<col>
																	<col >
																	<col>
																	<col >
																	<col >
																</colgroup>
																<thead class="sui-table-thead">
																	<tr>
																		<th class="sui-table-selection-column">
																			<div></div>
																		</th>
																		<th >
																			<div >
																				<span >优惠券名称</span>
																			</div>
																		</th>
																		<th >
																			<div>
																				<span >类型</span>
																			</div>
																		</th>
																		<th >
																			<div >
																				<span >面额(元)</span>
																			</div>
																		</th>
																		<th >
																			<div >
																				<span >限制</span>
																			</div>
																		</th>
																		<th >
																			<div >
																				<span>有效期</span>
																			</div>
																		</th>
																		<th >
																			<div >
																				<span >数量</span>
																			</div>
																		</th>
																		<th >
																			<div >
																				<span>用户限领</span>
																			</div>
																		</th>
																	</tr>
																</thead>
																<tbody class="sui-table-tbody"></tbody>
															</table>
														</div>
													</div>
													<div class="sui-table-placeholder">
														<i class=" suicon suicon-frown" d></i><span >暂无数据</span>
													</div>
												</div>
											</div>
											<div class="row oly-row-container clu-create-row f-cb">
												<button target="_blank" href="#" type="button" class="sui-btn sui-btn-default clu-create-btn f-fl">创建优惠券</button>
												<p class="clu-create-desc">请在“淘宝卡券”里创建店铺优惠券；推广方式选择“买家领取”，推广范围选择“渠道专享--会员通专用券”</p>
											</div>
										</div>
									</div>
									<div class="row oly-row-container add-form-item clearfix">
										<div class="col-2 oly-col-container  label-col">
											<label class="oly-label-container" value="入会时长" >
												<b class="oly-label-star" style="display:none;">*</b>
												<span >入会时长</span>
											</label>
										</div>
										<div class="col-20 oly-col-container " >
											<div class="" >
												<div class="sui-radio-group">
													<label>
														<span class="sui-radio sui-radio-checked" >
															<input type="radio" class="sui-radio-input" checked="">
															<span class="sui-radio-inner"></span>
														</span>
														<span> </span>
														<span >1天</span>
													</label>
													<label >
														<span class="sui-radio" >
															<input type="radio" class="sui-radio-input">
															<span class="sui-radio-inner"></span>
														</span>
														<span> </span>
														<span >3天</span>
													</label>
													<label >
														<span class="sui-radio" >
															<input type="radio" class="sui-radio-input">
															<span class="sui-radio-inner"></span>
														</span>
														<span> </span>
														<span>7天</span>
													</label>
												</div>
											</div>
											<p  class="clu-jointime-desc">此处选择的时间n天，用于限制用户在入会n天内领取对应的权益。</p>
										</div>
									</div>
									<div class="row oly-row-container">
										<div class="col-20 col-offset-2 oly-col-container ">
											<!-- <button type="button" class="sui-btn form-bottom-btn-info hide">编辑</button> -->
											<button type="button" class="sui-btn form-bottom-btn-info">创建</button>
											<button type="button" class="sui-btn form-bottom-btn" >取消</button>
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

	
	// 新增新会员专享券
	$(".right-container .tab").eq(0).show();
	$(".col-4.oly-col-container.clu-newBtn").click(function() {
		$(".right-container .tab").eq(1).show().siblings().hide();
	})
	$(".row.oly-row-container .sui-btn.form-bottom-btn").click(function() {
		$(".right-container .tab").eq(0).show().siblings().hide();
	})
</script>


</html>

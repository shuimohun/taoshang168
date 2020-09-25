<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--  营销----忠诚度管理----VIP设置---立即设置   -->

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
				<div class="main container vip-center-page">
					<div>
						<div class="next-row">
							<div class="next-col next-col-24">
								<div class="next-breadcrumb">
									<div class="next-breadcrumb-item">
										<span class="next-breadcrumb-text">会员管理</span>
										<div class="next-breadcrumb-separator">/</div>
									</div>
									<div class="next-breadcrumb-item">
										<span class="next-breadcrumb-text activated">自定义会员体系</span>
										<div class="next-breadcrumb-separator">/</div>
									</div>
								</div>
							</div>
						</div>
						<div class="next-row">
							<div class="next-col" style="padding-top: 7px;">
								<span>会员卡名称</span>
							</div>
							<div class="next-col next-col-22">
								<span class="next-input next-input-single next-input-medium" style="width: 44%;">
									<input type="text" value="财龙外贸服装" height="100%">
								</span>
							</div>
						</div>
						<div class="next-row">
							<div class="next-col">
								<span class="redStar">*</span>
								<span>会员等级</span>
							</div>
							<div class="next-col next-col-22">
								<div class="level-container right">
									<div class="item">
										<form class="next-form next-form-left next-form-hoz next-form-medium vipForm">
											<p class="level-title text-center">普通会员(VIP1)
												<span class="edit-area">
													<a href="javascript:void(0);" class="none"> 启用 </a>
													<a href="javascript:void(0);" class=""> 设置 </a>
													<span class="none">
														<a href="javascript:void(0);">取消</a>|<a href="javascript:void(0);"> 保存 </a>
													</span>
												</span>
											</p>
											<div class="satisfy-text">
												<span class="black-color"><i class="jxtportal jxt-shengji"></i>升级条件</span>满足以下条件自动升级到普通会员(VIP1)<span class="switch-upgrade"></span>
											</div>
											<div class="satisfy-condition form-group">
												交易额￥
												<div class="next-form-item">
													<div class=" next-form-item-control">
														<span class="next-input next-input-single next-input-medium form-control">
															<input type="text"  readonly="" value="" height="100%">
														</span>
														<div></div>
													</div>
												</div>
												<span class="separator">- 或 -</span>交易次数
												<div class="next-form-item">
													<div class=" next-form-item-control">
														<span class="next-input next-input-single next-input-medium form-control">
															<input type="text"  readonly="" value="" height="100%">
														</span>
														<div class=""></div>
													</div>
												 </div>
												<span class="error-container"></span>
											</div>
											<p class="satisfy-text">
												<span class="black-color">
													<i class="jxtportal jxt-jiangpai"></i>会员权益
												</span>普通会员(VIP1)可享受的店铺权益
											</p>
											<div class="benefit">
												<div class="satisfy-condition form-group">
													<span>折扣 </span>
													<div class="next-form-item">
														<div class=" next-form-item-control">
															<span class="next-input next-input-single next-input-medium form-control editing-first-level">
																<input type="text" min="0" max="10" readonly=""  value="0" height="100%">
															</span>
															<div class=""></div>
														</div>
													</div>
													<span class="error-container"></span>
												</div>
											</div>
											<p class="satisfy-text">
												<span class="black-color"><i class="jxtportal jxt-zhuangxiu"></i>卡面设置</span> 卡面样式默认官方图片，可自行上传替换
											</p>
											<ul class="level-pic">
												<li>
													<p>无线等级会员卡</p>
													<img src="//img.alicdn.com/tps/TB12ePKNFXXXXcVXXXXXXXXXXXX-116-70.png">
												</li>
											</ul>
										</form>
									</div>
									<div class="item">
										<form class="next-form next-form-left next-form-hoz next-form-medium vipForm">
											<p class="level-title text-center">普通会员(VIP1)
												<span class="edit-area">
													<a href="javascript:void(0);" class="none"> 启用 </a>
													<a href="javascript:void(0);" class=""> 设置 </a>
													<span class="none">
														<a href="javascript:void(0);">取消</a>|<a href="javascript:void(0);"> 保存 </a>
													</span>
												</span>
											</p>
											<div class="satisfy-text">
												<span class="black-color"><i class="jxtportal jxt-shengji"></i>升级条件</span>满足以下条件自动升级到普通会员(VIP1)<span class="switch-upgrade"></span>
											</div>
											<div class="satisfy-condition form-group">
												交易额￥
												<div class="next-form-item">
													<div class=" next-form-item-control">
														<span class="next-input next-input-single next-input-medium form-control">
															<input type="text"  readonly="" value="" height="100%">
														</span>
														<div></div>
													</div>
												</div>
												<span class="separator">- 或 -</span>交易次数
												<div class="next-form-item">
													<div class=" next-form-item-control">
														<span class="next-input next-input-single next-input-medium form-control">
															<input type="text"  readonly="" value="" height="100%">
														</span>
														<div class=""></div>
													</div>
												 </div>
												<span class="error-container"></span>
											</div>
											<p class="satisfy-text">
												<span class="black-color">
													<i class="jxtportal jxt-jiangpai"></i>会员权益
												</span>普通会员(VIP1)可享受的店铺权益
											</p>
											<div class="benefit">
												<div class="satisfy-condition form-group">
													<span>折扣 </span>
													<div class="next-form-item">
														<div class=" next-form-item-control">
															<span class="next-input next-input-single next-input-medium form-control editing-first-level">
																<input type="text" min="0" max="10" readonly=""  value="0" height="100%">
															</span>
															<div class=""></div>
														</div>
													</div>
													<span class="error-container"></span>
												</div>
											</div>
											<p class="satisfy-text">
												<span class="black-color"><i class="jxtportal jxt-zhuangxiu"></i>卡面设置</span> 卡面样式默认官方图片，可自行上传替换
											</p>
											<ul class="level-pic">
												<li>
													<p>无线等级会员卡</p>
													<img src="//img.alicdn.com/tps/TB12ePKNFXXXXcVXXXXXXXXXXXX-116-70.png">
												</li>
											</ul>
										</form>
									</div>
									<div class="item">
										<form class="next-form next-form-left next-form-hoz next-form-medium vipForm">
											<p class="level-title text-center">普通会员(VIP1)
												<span class="edit-area">
													<a href="javascript:void(0);" class="none"> 启用 </a>
													<a href="javascript:void(0);" class=""> 设置 </a>
													<span class="none">
														<a href="javascript:void(0);">取消</a>|<a href="javascript:void(0);"> 保存 </a>
													</span>
												</span>
											</p>
											<div class="satisfy-text">
												<span class="black-color"><i class="jxtportal jxt-shengji"></i>升级条件</span>满足以下条件自动升级到普通会员(VIP1)<span class="switch-upgrade"></span>
											</div>
											<div class="satisfy-condition form-group">
												交易额￥
												<div class="next-form-item">
													<div class=" next-form-item-control">
														<span class="next-input next-input-single next-input-medium form-control">
															<input type="text"  readonly="" value="" height="100%">
														</span>
														<div></div>
													</div>
												</div>
												<span class="separator">- 或 -</span>交易次数
												<div class="next-form-item">
													<div class=" next-form-item-control">
														<span class="next-input next-input-single next-input-medium form-control">
															<input type="text"  readonly="" value="" height="100%">
														</span>
														<div class=""></div>
													</div>
												 </div>
												<span class="error-container"></span>
											</div>
											<p class="satisfy-text">
												<span class="black-color">
													<i class="jxtportal jxt-jiangpai"></i>会员权益
												</span>普通会员(VIP1)可享受的店铺权益
											</p>
											<div class="benefit">
												<div class="satisfy-condition form-group">
													<span>折扣 </span>
													<div class="next-form-item">
														<div class=" next-form-item-control">
															<span class="next-input next-input-single next-input-medium form-control editing-first-level">
																<input type="text" min="0" max="10" readonly=""  value="0" height="100%">
															</span>
															<div class=""></div>
														</div>
													</div>
													<span class="error-container"></span>
												</div>
											</div>
											<p class="satisfy-text">
												<span class="black-color"><i class="jxtportal jxt-zhuangxiu"></i>卡面设置</span> 卡面样式默认官方图片，可自行上传替换
											</p>
											<ul class="level-pic">
												<li>
													<p>无线等级会员卡</p>
													<img src="//img.alicdn.com/tps/TB12ePKNFXXXXcVXXXXXXXXXXXX-116-70.png">
												</li>
											</ul>
										</form>
									</div>
									<div class="item">
										<form class="next-form next-form-left next-form-hoz next-form-medium vipForm">
											<p class="level-title text-center">普通会员(VIP1)
												<span class="edit-area">
													<a href="javascript:void(0);" class="none"> 启用 </a>
													<a href="javascript:void(0);" class=""> 设置 </a>
													<span class="none">
														<a href="javascript:void(0);">取消</a>|<a href="javascript:void(0);"> 保存 </a>
													</span>
												</span>
											</p>
											<div class="satisfy-text">
												<span class="black-color"><i class="jxtportal jxt-shengji"></i>升级条件</span>满足以下条件自动升级到普通会员(VIP1)<span class="switch-upgrade"></span>
											</div>
											<div class="satisfy-condition form-group">
												交易额￥
												<div class="next-form-item">
													<div class=" next-form-item-control">
														<span class="next-input next-input-single next-input-medium form-control">
															<input type="text"  readonly="" value="" height="100%">
														</span>
														<div></div>
													</div>
												</div>
												<span class="separator">- 或 -</span>交易次数
												<div class="next-form-item">
													<div class=" next-form-item-control">
														<span class="next-input next-input-single next-input-medium form-control">
															<input type="text"  readonly="" value="" height="100%">
														</span>
														<div class=""></div>
													</div>
												 </div>
												<span class="error-container"></span>
											</div>
											<p class="satisfy-text">
												<span class="black-color">
													<i class="jxtportal jxt-jiangpai"></i>会员权益
												</span>普通会员(VIP1)可享受的店铺权益
											</p>
											<div class="benefit">
												<div class="satisfy-condition form-group">
													<span>折扣 </span>
													<div class="next-form-item">
														<div class=" next-form-item-control">
															<span class="next-input next-input-single next-input-medium form-control editing-first-level">
																<input type="text" min="0" max="10" readonly=""  value="0" height="100%">
															</span>
															<div class=""></div>
														</div>
													</div>
													<span class="error-container"></span>
												</div>
											</div>
											<p class="satisfy-text">
												<span class="black-color"><i class="jxtportal jxt-zhuangxiu"></i>卡面设置</span> 卡面样式默认官方图片，可自行上传替换
											</p>
											<ul class="level-pic">
												<li>
													<p>无线等级会员卡</p>
													<img src="//img.alicdn.com/tps/TB12ePKNFXXXXcVXXXXXXXXXXXX-116-70.png">
												</li>
											</ul>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="next-row">
							<div class="next-col next-col-2"></div>
							<div class="next-col next-col-22">
								<button type="button" class="next-btn next-btn-primary next-btn-medium">保存</button>
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

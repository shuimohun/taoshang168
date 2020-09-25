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
					<div class="wiresetting-router">
						<div class="sui-breadcrumb">
							<span>
								<a class="sui-breadcrumb-link" href="#" target="_top">忠诚度管理</a>
								<span class="sui-breadcrumb-separator">/</span>
							</span>
							<span>
								<span class="sui-breadcrumb-link">无线端会员中心装修</span>
								<span class="sui-breadcrumb-separator">/</span>
							</span>
						</div>
						<div class="row">
							<div class="sui-form-horizontal">
								<div class="beforePage">
									<div class="pageTip">
										<div class="sui-alert sui-alert-warn-action">
											<i class="sui-alert-icon suicon suicon-warn-t-o"></i>
											<span class="sui-alert-message">此页面效果仅作素材的位置示意，上传后可能出现变形，您可以保存后预览实际效果。
											</span>
											<span class="sui-alert-description"></span>
										</div>
									</div>
									<div class="modTitle">无线端会员入会页面</div>
									<div class="row">
										<div class="col-3 leftText">
											页面设置
										</div>
										<div class="col-10">
											<div class="bgContainer">
												<div class="picsContainer">
													<div>
														<div class="titleImage"></div>
														<div class="itemPic beforeBgImagePicShow" style="background-image: url(&quot;//img.alicdn.com/tps/i3/TB1Vz2DHXXXXXX4XXXXFIvU2pXX-750-520.png&quot;);">
															<div class="leftShowTriangle">
																<div class="rightTopNum" >1</div>
															</div>
														</div>
													</div>
													<div>
														<div class="itemPic cardImagePicShow" style="background-image: url(&quot;//img.alicdn.com/tps/TB1JMs4LFXXXXcYXVXXXXXXXXXX-1225-735.png&quot;);">
															<div class="leftShowTriangle">
																<div class="rightTopNum">2</div>
															</div>
														</div>
														<div class="beforeStep"></div>
													</div>
													<div class="itemPic beforeCustomImagePicShow" style="background-image: url(&quot;//img.alicdn.com/tps/TB1ofr8LFXXXXcgaXXXXXXXXXXX-804-300.jpg&quot;);">
														<div class="leftShowTriangle">
															<div class="rightTopNum">3</div>
														</div>
													</div>
													<div class="itemPic imageLink1PicShow" style="background-image: url(&quot;//img.alicdn.com/tps/TB1ofr8LFXXXXcgaXXXXXXXXXXX-804-300.jpg&quot;);">
														<div class="leftShowTriangle">
															<div class="rightTopNum" >4</div>
														</div>
													</div>
													<div class="itemPic imageLink2PicShow" style="background-image: url(&quot;//img.alicdn.com/tps/TB1ofr8LFXXXXcgaXXXXXXXXXXX-804-300.jpg&quot;);">
														<div class="leftShowTriangle">
															<div class="rightTopNum" >5</div>
														</div>
													</div>
													<div class="itemPic imageLink3PicShow" style="background-image: url(&quot;//img.alicdn.com/tps/TB1ofr8LFXXXXcgaXXXXXXXXXXX-804-300.jpg&quot;);" >
														<div class="leftShowTriangle">
															<div class="rightTopNum">6</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-10">
											<div class="rightComponent">
												<div class="verticalBar" style="background-image:url(//img.alicdn.com/tps/TB1s5.5MXXXXXaYaXXXXXXXXXXX-3-1088.png);">
												</div>
												<div class="rightItemContainer">
													<div class="title clearfix" >
														<div class="leftTopNum" >1</div>
														<div class="rightTitle">
															<span >绑定页面背景图</span>
															<button  type="button" class="sui-btn sui-btn-link sui-btn-sm myLinkBtn" disabled="">删除</button>
														</div>
													</div>
													<div class="main">
														<div class="uploadBtnGroup">
															<span class="">
																<div class="sui-upload sui-upload-select">
																	<span role="button" tabindex="0">
																		<input type="file">
																		<button type="button" class="sui-btn sui-btn-primary sui-btn-sm">点击上传</button>
																	</span>
																</div>
															</span>
														</div>
														<div class="tipText">请上传1125*780像素jpg格式的图片,500k以内</div>
													</div>
													<div class="inputLink" style="display:none;">
														<span class="">
															<input type="text" placeholder="taobao或tmall或jaeapp的域名链接" value="" class="sui-input">
														</span>
													</div>
												</div>
												<div class="rightItemContainer cardImageSetting">
													<div class="title clearfix">
														<div class="leftTopNum">2</div>
														<div class="rightTitle">
															<span>绑定页面会员卡图片</span>
															<button type="button" class="sui-btn sui-btn-link sui-btn-sm myLinkBtn"  disabled="">删除</button>
														</div>
													</div>
													<div class="main">
														<div class="uploadBtnGroup">
															<span class="">
																<div class="sui-upload sui-upload-select">
																	<span role="button">
																		<input type="file">
																		<button type="button" class="sui-btn sui-btn-primary sui-btn-sm">点击上传</button>
																	</span>
																</div>
															</span>
														</div>
														<div class="tipText">请上传1050*630像素jpg格式的图片,500k以内</div>
													</div>
													<div class="inputLink" style="display:none;">
														<span class="">
															<input type="text" placeholder="taobao或tmall或jaeapp的域名链接" value="" class="sui-input" >
														</span>
													</div>
												</div>
												<div class="rightItemContainer">
													<div class="title clearfix">
														<div class="leftTopNum">3</div>
														<div class="rightTitle">
															<span>绑定页面自定义图片</span>
															<button type="button" class="sui-btn sui-btn-link sui-btn-sm myLinkBtn" disabled="">删除</button>
														</div>
													</div>
													<div class="main" >
														<div class="uploadBtnGroup">
															<span class="">
																<div class="sui-upload sui-upload-select">
																	<span role="button">
																		<input type="file">
																		<button type="button" class="sui-btn sui-btn-primary sui-btn-sm">点击上传</button>
																	</span>
																</div>
															</span>
														</div>
														<div class="tipText">请上传1125*（0-2300）像素jpg格式的图片,500k以内</div>
													</div>
													<div class="inputLink" style="display:none;">
														<span class="">
															<input type="text" placeholder="taobao或tmall或jaeapp的域名链接" value="" class="sui-input">
														</span>
													</div>
												</div>
												<div class="rightItemContainer">
													<div class="title clearfix">
														<div class="leftTopNum">4</div>
														<div class="rightTitle">
															<span>自定义链接图片1(可选)</span>
															<button type="button" class="sui-btn sui-btn-link sui-btn-sm myLinkBtn" disabled="">删除</button>
														</div>
													</div>
													<div class="main" >
														<div class="uploadBtnGroup">
															<span class="">
																<div class="sui-upload sui-upload-select">
																	<span role="button">
																		<input type="file">
																		<button type="button" class="sui-btn sui-btn-primary sui-btn-sm">点击上传</button>
																	</span>
																</div>
															</span>
														</div>
														<div class="tipText">请上传1125*(0-2300)像素jpg格式的图片,500k以内</div>
													</div>
													<div class="inputLink" style="display:block;">
														<span class="" >
															<input name="imageLinkUrl1" type="text" placeholder="taobao或tmall或jaeapp的域名链接" value="" class="sui-input">
														</span>
													</div>
												</div>
												<div class="rightItemContainer">
													<div class="title clearfix">
														<div class="leftTopNum">5</div>
														<div class="rightTitle">
															<span>自定义链接图片2(可选)</span>
															<button type="button" class="sui-btn sui-btn-link sui-btn-sm myLinkBtn" disabled="">删除</button>
														</div>
													</div>
													<div class="main" >
														<div class="uploadBtnGroup">
															<span class="">
																<div class="sui-upload sui-upload-select">
																	<span role="button">
																		<input type="file">
																		<button type="button" class="sui-btn sui-btn-primary sui-btn-sm">点击上传</button>
																	</span>
																</div>
															</span>
														</div>
														<div class="tipText">请上传1125*(0-2300)像素jpg格式的图片,500k以内</div>
													</div>
													<div class="inputLink" style="display:block;">
														<span class="" >
															<input name="imageLinkUrl1" type="text" placeholder="taobao或tmall或jaeapp的域名链接" value="" class="sui-input">
														</span>
													</div>
												</div>
												<div class="rightItemContainer">
													<div class="title clearfix">
														<div class="leftTopNum">6</div>
														<div class="rightTitle">
															<span>自定义链接图片3(可选)</span>
															<button type="button" class="sui-btn sui-btn-link sui-btn-sm myLinkBtn" disabled="">删除</button>
														</div>
													</div>
													<div class="main" >
														<div class="uploadBtnGroup">
															<span class="">
																<div class="sui-upload sui-upload-select">
																	<span role="button">
																		<input type="file">
																		<button type="button" class="sui-btn sui-btn-primary sui-btn-sm">点击上传</button>
																	</span>
																</div>
															</span>
														</div>
														<div class="tipText">请上传1125*(0-2300)像素jpg格式的图片,500k以内</div>
													</div>
													<div class="inputLink" style="display:block;">
														<span class="" >
															<input name="imageLinkUrl1" type="text" placeholder="taobao或tmall或jaeapp的域名链接" value="" class="sui-input">
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="successPage" style="display:block;">
									<div class="modTitle">入会成功跳转页面</div>
									<div class="sui-form-item">
										<label for="customRegisterSuccessUrl" class="col-3">页面链接</label>
										<div class="col-14">
											<div class="sui-form-item-control ">
												<div class="row">
													<div class="col-23">
														<span class="">
															<input type="text" placeholder="taobao或tmall或jaeapp的域名链接" value="" id="customRegisterSuccessUrl" class="sui-input">
														</span>
													</div>
												</div>
											<div class=""></div>
											</div>
										</div>
									</div>
								</div>
								<hr>
								<div class="afterPage">
									<div class="modTitle">会员卡详情页面</div>
									<div class="row afterSetting">
										<div class="sui-form-item">
											<label for="detailSetting" class="col-3">会员卡详情页面</label>
											<div class="col-14">
												<div class="sui-form-item-control ">
													<div style="display:block;" class="row isSelfRadio">
														<div class="sui-radio-group">
															<label>
																<span class="sui-radio sui-radio-checked" >
																	<input type="radio" class="sui-radio-input" checked="">
																	<span class="sui-radio-inner"></span>
																</span>
																<span>使用官方详情页面</span>
															</label>
														</div>
													</div>
													<div style="display:block;" class="row">
														<div class="col-23">
															<div class="sui-form-item">
																<div class="col-24" >
																	<div class="sui-form-item-control ">
																		<span class="">
																			<input type="text" value="" class="sui-input">
																		</span>
																		<div class=""></div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-1">
															<button type="button" class="sui-btn sui-btn-link sui-btn-sm"> 复制链接</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div style="display: block;" class="row afterShow clearfix">
										<div class="col-3 leftText">页面设置</div>
										<div class="col-10">
											<div class="bgContainer">
												<div class="picsContainer">
													<div>
														<div class="titleImage"></div>
														<div class="itemPic afterBgImagePicShow" style="background-image: url(&quot;//img.alicdn.com/tps/i3/TB1Vz2DHXXXXXX4XXXXFIvU2pXX-750-520.png&quot;);">
															<div class="itemPic levelCardImagePicShow" style="background-image: url(&quot;//gtms04.alicdn.com/tps/i4/TB1I68NHpXXXXbnXXXX1M1ZGpXX-700-420.png&quot;);">
																<div class="leftShowTriangle">
																	<div class="rightTopNum">2</div>
																</div>
															</div>
															<div class="leftShowTriangle" >
																<div class="rightTopNum">1</div>
															</div>
														</div>
														<div class="vipInfoImagePicShow"></div>
													</div>
													<div class="itemPic afterCustomImagePicShow" style="background-image: url(&quot;//img.alicdn.com/tps/TB1ofr8LFXXXXcgaXXXXXXXXXXX-804-300.jpg&quot;);">
														<div class="leftShowTriangle">
															<div class="rightTopNum" >3</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-10">
											<div class="rightComponent">
												<div class="verticalBar" style="top:100px;">
													<div class="point"></div>
													<div class="vertical-line" style="height:212px;"></div>
													<div class="point"></div>
													<div class="vertical-line"></div>
													<div class="point"></div>
													<div class="vertical-line"></div>
												</div>
												<div class="rightItemContainer afterBgImageSetting">
													<div class="title clearfix">
														<div class="leftTopNum">1</div>
														<div class="rightTitle">
															<span>详情页面背景图</span>
															<button disabled="" type="button" class="sui-btn sui-btn-link sui-btn-sm myLinkBtn">删除</button>
														</div>
													</div>
													<div class="main" >
														<div class="uploadBtnGroup">
															<span class="">
																<div class="sui-upload sui-upload-select">
																	<span role="button">
																		<input type="file">
																		<button type="button" class="sui-btn sui-btn-primary sui-btn-sm">点击上传</button>
																	</span>
																</div>
															</span>
														</div>
														<div class="tipText">请上传1125*990像素jpg格式的图片,500k以内</div>
													</div>
													<div class="inputLink" style="display:none;">
														<span class="">
															<input type="text" placeholder="taobao或tmall或jaeapp的域名链接" value="" class="sui-input" >
														</span>
													</div>
												</div>
												<div class="rightItemContainer">
													<div class="title clearfix">
														<div class="leftTopNum">2</div>
														<div class="rightTitle" >选择卡片颜色</div>
														<div class="next-form next-form-left next-form-hoz hoz next-form-medium">
															<div class="color-item">
																<div class="color-ball" style="background:linear-gradient(to bottom, #FF6F3F, #FF4A26);"></div>
															</div>
															<div class="color-item">
																<div class="color-ball" style="background:linear-gradient(to bottom, #FFBE26, #FF9A26);" ></div>
															</div>
															<div class="color-item">
																<div class="color-ball" style="background:linear-gradient(to bottom, #3BE674, #09BFA1);"></div>
															</div>
															<div class="color-item">
																<div class="color-ball" style="background:linear-gradient(to bottom, #33C2FF, #199FFF);"></div>
															</div>
															<div class="color-item">
																<div class="color-ball" style="background:linear-gradient(to bottom, #AA7FFF, #7F66FF);"></div>
															</div>
															<div class="color-item">
																<div class="color-ball" style="background:linear-gradient(to bottom, #FF4CA6, #FF3377);" ></div>
															</div>
															<div class="clearfix" ></div>
														</div>
													</div>
												</div>
												<div class="rightItemContainer">
													<div class="title clearfix">
														<div class="leftTopNum" >3</div>
														<div class="rightTitle">
															<span>详情页面自定义图片</span>
															<button type="button" class="sui-btn sui-btn-link sui-btn-sm myLinkBtn"disabled="">删除</button>
														</div>
													</div>
													<div class="main">
														<div class="uploadBtnGroup" >
															<span class="">
																<div class="sui-upload sui-upload-select">
																	<span role="button"><input type="file">
																		<button type="button" class="sui-btn sui-btn-primary sui-btn-sm" >点击上传</button>
																	</span>
																</div>
															</span>
														</div>
														<div class="tipText" >请上传1125*（0-2300）像素jpg格式的图片,500k以内</div>
													</div>
													<div class="inputLink" style="display:none;">
														<span class="">
															<input type="text" placeholder="taobao或tmall或jaeapp的域名链接" value="" class="sui-input">
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row btnGroup">
									<div class="col-3">&nbsp;</div>
									<div class="col-10" >
										<button type="button" class="sui-btn sui-btn-primary sui-btn-sm">保存</button>
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

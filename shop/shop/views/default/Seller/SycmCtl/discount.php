<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!-- 智能营销  专享打折、减现 点击页面-->


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
				<div class="discount-page">
					<div class="crm-top-nav">
						<div class="top-nav-btn-group">
							<a class="create active" href="#">创建活动</a>
							<a class="list" href="#">活动列表</a>
						</div>
					</div>
					<div class="layout grid-m0">
						<div class="col-main">
							<div class="main-wrap">
								<a href="#" style="color:#f23f45;font-size: 14px;">客户关系管理将在2017.3.31全面升级为客户运营平台，查看升级公告！</a>
								<div class="create-event J_createEvent">
									<!-- 选拔活动类型 start -->
									<div class="page-title-hd">
		                                <h1>新建活动</h1>
		                            </div>
		                            <div class="actobj mt15">
		                            	<div class="actobj-hd">
											<ul class="steps steps-grid3">
		            							<li class="step step-first step-current"><span><b><i>1</i>活动对象</b></span></li>
		            							<li class="step step-next"><span><b><i>2</i>活动内容</b></span></li>
		            							<li class="step step-last"><span><b><i>3</i>活动确认</b></span></li>
		            						</ul>
		                        		</div>
		                        		<div class="actobj-bd">
		                        			<div class="control-group clearfix">
		                        				<label class="control-label">请选择本次活动对象</label>
		                        				<div class="controls">
		                        					<div class="controls-wrap">
		                        						<div class="j_Menu menu">
		                        							<input id="allClient" class="j_RdoActObj rdo" name="client" type="radio" value="1" checked="checked">
		                        							<label for="allClient">全网客户</label>
		                        						</div>
		                        					</div>
		                        					<div class="controls-wrap">
		                        						<div class="j_Menu menu">
		                        							<input id="vipClient" class="j_RdoActObj rdo" name="client" type="radio" value="4" data-attr="isVip">
		                        							<label for="vipClient">店铺VIP客户</label>
		                        							<b class="j_ArrowLeft arrow-left"></b>
		                        							<dl class="j_MenuBd menu-bd">
		                        								<dd class="menu-wrap select-wrap">亲爱的商家，您需要先<a href="//ecrm.taobao.com/gradepromotion/grade_promotion.htm">设置</a>店铺会员等级并生效后才可以对店铺会员创建活动哦</dd>
		                        							</dl>
		                        						</div>
		                        					</div>
		                        					<div class="controls-wrap">
		                        						<div class="j_Menu menu">
		                        							<input class="j_RdoActObj rdo" name="client" type="radio" >
		                        							<label for="loyalClient">标签客户</label>
		                        							<b class="j_ArrowLeft arrow-left"></b>
		                        							<dl class="j_MenuBd menu-bd">
		                        								<dd class="menu-wrap">
		                        									<label title="淘尚168">
                        												<input class="j_ActLabel chk" name="local" type="checkbox" tt-data-id="10144375019">
                        												淘尚168
                        											</label>
		                        								</dd>
		                        							</dl>
		                        						</div>
		                        					</div>
		                        					<div class="controls-wrap next-wrap clearfix" style="margin-top: 0px; padding-top: 118px;">
		                        						<a  class="ui-btn ui-btn-l ui-btn-blue btn-next" href="javascript:void(0)">
		                        							<b class="ui-btn-r">
		                        								<b class="ui-btn-c">下一步</b>
		                        							</b>
		                        						</a>
		                        						<div class="msg" style="display:none;"></div>
		                        					</div>
		                        				</div>
		                        			</div>
		                        		</div>
		                            </div>
									<!-- 选拔活动类型 end -->

									<!-- 活动内容  start -->
									<div class="actcon mt15" style="display: none;">
										<div class="actcon-hd">
											<ul class="steps steps-grid3">
		            							<li class="step step-first step-done"><span><b><i>1</i>活动对象</b></span></li>
		            							<li class="step step-current"><span><b><i>2</i>活动内容</b></span></li>
		            							<li class="step step-next step-last"><span><b><i>3</i>活动确认</b></span></li>
		            						</ul>
		                        		</div>
		                        		<div class="actcon-bd">
		                        			<form class="J_mainForm">
		                        				<div class="control-group mb15 clearfix">
													<label class="control-label">选择活动：</label>
													<div class="controls">
														<ul class="j_ActivityGroup j_LabelControlGroup label-control-group" style="width: 488px;">
															<li class="j_Activity j_LabelControl j_DiscountLabel label-control  label-control-checked " style="display: block;">
																<label for="discount">
																	打折
																	<i class="ico-act ico-act-discount"></i>
																	<i class="ico-clasp"></i>
																</label>
															</li>
															<li class="j_Activity j_LabelControl j_ReduceLabel label-control " style="display: block;">
																<label for="abatement">
																	减现金
																	<i class="ico-act ico-act-reduce"></i>
																	<i class="ico-clasp"></i>
																</label>
															</li>
															<li  class="j_Activity j_LabelControl j_PostageLabel label-control " style="display: none;" data-display="true">
																<label for="J_Postage">
																	包邮
																	<i class="ico-act ico-act-postage"></i>
																	<i class="ico-clasp"></i>
																</label>
															</li>
															<li class="j_ActivityModify label-control" style="padding: 6px 1px; border: none; background: none; text-align: left; display: none;">
																<a target="_blank" href="javascript:void(0)">修改</a>
															</li>
														</ul>
													</div>
												</div>
												<div class="control-group mb25 clearfix">
		                        					<label class="control-label">活动名称：</label>
		                        					<div class="controls">
		                        						<input name="_fm.g._0.a" class="ipt ipt-xlarge" type="text" value="">
		                        					</div>
		                        				</div>
		                        				<div class="control-group mb25 clearfix">
		                        					<label class="control-label">活动时间：</label>
		                        					<div class="controls">
		                        						<div class="controls-wrap mb5">
		                        							<input name="_fm.g._0.s" class="ipt ipt-medium ipt-date" value="" type="text">
		                        							至
		                        							<input name="_fm.g._0.e" class="ipt ipt-medium ipt-date" value="" type="text">
		                        							<div class="tip-msg">
		                        								<div id="J_TipPop" class="tip-pop" style="z-index:9;"></div>
		                        								活动开始后不可修改，请慎重选择！
		                        							</div>
		                        						</div>
		                        					</div>
		                        				</div>
		                        				<div class="control-group mb25 clearfix">
		                        					<label class="control-label">活动宝贝：</label>
		                        					<div class="controls">
		                        						<ul>
		                        							<li class="J_ctrlShow">
		                        								<input id="J_AllBaobei" name="chooseBb"  class="rdo" type="radio" value="1" checked>
		                        								<label for="J_AllBaobei">全部宝贝</label>
		                        								<input id="J_PartBaobei" name="chooseBb" class="J_selectBaobei rdo" type="radio" value="2" >
		                        								<label for="J_PartBaobei">部份宝贝</label>
		                        								<!-- <div class="msg"><span class="error">活动宝贝为必选项</span></div> -->
		                        							</li>
		                        							<li class="table-inform mt10" style="display: none;">
		                        								<div class="item-selectBaobei" style="width:742px;">
		                        									<h3>选择宝贝</h3>
		                        									<div class="form-search J_searchBaobei">
		                        										<select class="J_isAllSelect">
		                        											<option>全部宝贝</option>
		                        											<option>未分类宝贝</option>
		                        											<option style="background:#e5f5ff;">	
		                        												纸品湿巾
		                        												<option>未分类宝贝</option>
		                        											</option>
		                        											<option style="padding-left:10px;">维达（Vinda）</option>
		                        											<option style="padding-left:10px;">心相印</option>
		                        											<option style="padding-left:10px;">Nepia/妮飘</option>
		                        											<option style="padding-left:10px;">清风</option>
		                        										</select>
		                        										<input name="productname" type="text" class="J_searchName" value="宝贝名称">
		                        										<input name="productcode" type="text" class="J_searchCode" value="商家编码">
		                        										<span class="skin-gray">
		                        											<button type="button" class="small-btn J_searchBaobeiBtn">搜索</button>
		                        										</span>
		                        									</div>
		                        									<table class="J_baobeiShow">
		                        										<colgroup>
                        													<col class="col-1">
                        													<col class="col-2">
                        													<col class="col-2">
                        													<col class="col-2">
                        												</colgroup>
                        												<thead>
		                        											<tr style="background:#f4f4f4">
		                        												<th>宝贝名称</th>
		                        												<th>商家编码</th>
		                        												<th>原价</th>
		                        												<th>库存</th>
		                        											</tr>
		                        										</thead>
		                        										<tbody>
		                        											<tr>
		                        												<td style="width: 351px;">
		                        													<input style="float:left;" type="checkbox" class="J_checkOne">
		                        													<div class="pic s80">
		                        														<a href="#" target="_blank">
		                        															<img alt="图片描述" src="//img.alicdn.com/bao/uploaded/i3/2683428516/TB24dOuXgvGK1Jjy0FeXXXYupXa_!!2683428516.jpg_sum.jpg">
		                        														</a>
		                        													</div>
		                        													<span>
		                        														<a href="" target="_blank">护舒宝透气纯棉感轻薄护垫无香40片包</a>
		                        													</span>
		                        												</td>
		                        												<td style="width: 117px; overflow: hidden;" >44698-2017168-5.58</td>
		                        												<td>7.90</td>
		                        												<td>500</td>
		                        											</tr>
		                        											<tr>
		                        												<td style="width: 351px;">
		                        													<input style="float:left;" type="checkbox" class="J_checkOne">
		                        													<div class="pic s80">
		                        														<a href="#" target="_blank">
		                        															<img alt="图片描述" src="//img.alicdn.com/bao/uploaded/i3/2683428516/TB24dOuXgvGK1Jjy0FeXXXYupXa_!!2683428516.jpg_sum.jpg">
		                        														</a>
		                        													</div>
		                        													<span>
		                        														<a href="" target="_blank">护舒宝透气纯棉感轻薄护垫无舒宝透气纯棉感轻薄护垫舒宝透气纯棉感轻薄护垫舒宝透气纯棉感轻薄护垫香40片包</a>
		                        													</span>
		                        												</td>
		                        												<td style="width: 117px; overflow: hidden;" >44698-2017168-5.58-2017168-5</td>
		                        												<td>7.90</td>
		                        												<td>500</td>
		                        											</tr>
		                        											<tr>
		                        												<td style="width: 351px;">
		                        													<input style="float:left;" type="checkbox" class="J_checkOne">
		                        													<div class="pic s80">
		                        														<a href="#" target="_blank">
		                        															<img alt="图片描述" src="//img.alicdn.com/bao/uploaded/i3/2683428516/TB24dOuXgvGK1Jjy0FeXXXYupXa_!!2683428516.jpg_sum.jpg">
		                        														</a>
		                        													</div>
		                        													<span>
		                        														<a href="" target="_blank">护舒宝透气纯棉感轻薄护垫无舒宝透气纯棉感轻薄护垫舒宝透气纯棉感轻薄护垫舒宝透气纯棉感轻薄护垫香40片包</a>
		                        													</span>
		                        												</td>
		                        												<td style="width: 117px; overflow: hidden;" >44698-2017168-5.58-2017168-5</td>
		                        												<td>7.90</td>
		                        												<td>500</td>
		                        											</tr>
		                        										</tbody>
		                        										<tfoot>
		                        											<tr>
		                        												<td colspan="4" class="act-pagination">
		                        													<div class="act"><input type="checkbox" class="J_checkAll"> 全选</div>
		                        													<div class="pagination J_pageNum">
		                        														
		                        													</div>
		                        												</td>
		                        											</tr>
		                        										</tfoot>
		                        									</table>
		                        									<!-- <div class="has-baobei">
		                        										<strong>已添加的宝贝</strong>
		                        										<div class="J_hasBaobei"></div>
		                        									</div> -->
		                        									<div class="btn-select">
		                                                                <b class="ui-btn ui-btn-l ui-btn-blue">
		                                                                    <b class="ui-btn-r">
		                                                                        <b class="ui-btn-c J_submitBaobei">保存</b>
		                                                                    </b>
		                                                                </b>
		                        									</div>
		                        								</div>
		                        							</li>
		                        						</ul>
		                        					</div>
		                        				</div>
		                        				<div class="control-group mb25 clearfix">
		                        					<label class="control-label">促销方式 ：</label>
		                        					<div class="controls">
		                        						<ul>
		                        							<li class="table-inform">
		                        								<div class="item-proTable">
		                        									<div class="combo-batch J_itemSale">
		                        										<strong>批量设置:</strong>
		                        										<span class="set-input">每件商品</span>
		                        										<input name="discounts" value="" type="text" size="5" class="text J_batchDazhe">
		                        										<span class="set-input"> 折(填写9代表9折)</span>
		                        									</div>
		                        									<div class="combo-batch J_itemSale hidden">
		                        										<strong>批量设置:</strong>
		                        										<span class="set-input">每件商品减</span>
		                        										<input name="reduceCashs" value="" type="text" size="5" class="text J_batchJian">
																		<span class="set-input"> 元</span>
		                        									</div>
		                        									<div class="combo-batch J_itemSale hidden">
		                        										<strong>批量设置:</strong>
		                        										<a id="J_PostageExecption" class="j_Mmstat"  href="javascript:">不包邮地区</a>
																		<div style="padding: 2px 0 2px 55px;"></div>
		                        									</div>
																	<div class="J_baobeiTable"></div>
		                        								</div>
		                        							</li>
		                        						</ul>
		                        					</div>
		                        				</div>
		                        				<div class="control-group mb25 clearfix">
		                        					<label class="control-label">促销标签：</label>
		                        					<div class="controls">
		                        						<input type="text" class="ipt ipt-large" name="_fm.g._0.ac" value="">
		                        						<em class="help-inline">最多5个字，在商品详情页展示</em>
		                        					</div>
		                        				</div>
		                        				<div class="control-group mb25 clearfix">
		                        					<div class="controls">
		                        						<div class="shopbonus-panel" style="width: 500px; padding: 10px; border: 1px solid #ffdeaf; background: #fff8ee;line-height: 27px;">
		                        							<input id="J_BonusChk" name="isShopBonus" class="chk" type="checkbox">
		                        							<label for="J_BonusChk">订单完成后送优惠券</label>
		                        							<div class="bonus" style="display: none;">
		                        								<div class="bonus-wrap" name="bonusDiscount">
		                            								<label class="title">优惠金额：</label>
		                            								<ul id="J_BonusLst" class="bonus-lst clearfix">
		                            									<li data-price="3">3元<i class="ico-clasp"></i></li>
		                            									<li data-price="5">5元<i class="ico-clasp"></i></li>
		                            									<li data-price="10">10元<i class="ico-clasp"></i></li>
		                            									<li data-price="20">20元<i class="ico-clasp"></i></li>
		                            									<li data-price="50">50元<i class="ico-clasp"></i></li>
		                            									<li data-price="100">100元<i class="ico-clasp"></i></li>
		                            								</ul>
		                            								<div class="msg mt5" style="display:none;"><span class="error">请选择优惠券面额</span></div>
		                            							</div>
		                            							<div class="bonus-wrap">
																	<label class="title">有效日期：</label>
		                                        					<input id="J_beginDate1" name="bonusStartTime" class="ipt ipt-medium ipt-date" type="text" value="" readonly="true" style="background-color: #fff;">
		                                        					至
		                                        					<input id="J_endDate1" name="bonusEndTime" class="ipt ipt-medium ipt-date" type="text" value="" readonly="true" style="background-color: #fff;">
		                                        					<div class="msg mt5" style="display:none;"><span class="error">有效期不能为空</span></div>
		                            							</div>
		                            							<div class="bonus-wrap">
		                            								<label class="title">使用条件：</label>
		                            								<input class="j_OrderFullChk checkbox" name="hasCondition" value="true" type="checkbox">
		                            								订单满
		                            								<input class="j_OrderFullIpt input input-xs" name="_fm.g._0.st" type="text" value="" disabled="true">
		                            								元可用
		                            								<a class="j_OrderBtn btn-order" style="display: none;" target="_blank" href="#">立即订购</a>
		                            								<span class="j_OrderTip msg">
		                            									<span class="attention">请订购之后请再次重试</span>
		                            								</span>
		                            							</div>
		                        							</div>
		                        						</div>
		                        					</div>
		                        				</div>
		                        			</form>
		                        			<div class="control-group clearfix">
		                        				<div class="controls">
		                        					<div class="controls-wrap btns-wrap clearfix">
		                        						<a  class="ui-btn ui-btn-l ui-btn-gray btn-prev" href="#">
		                        							<b class="ui-btn-r">
		                        								<b class="ui-btn-c">上一步</b>
		                        							</b>
		                        						</a>
														<a  class="J_btnMainForm ui-btn ui-btn-l ui-btn-blue btn-submit" href="javascript:void(0)" >
	                        								<b class="ui-btn-r">
	                        									<b class="ui-btn-c">确定提交</b>
	                        								</b>
	                        							</a>
													</div>
		                        				</div>
		                        			</div>
		                        		</div>
									</div>
									<!-- 活动内容  end -->
								</div>
								<div class="event-manage" style="padding-bottom: 141px; display: none;">
									<form class="mainForm">
										<div class="msg mt10" style="overflow: hidden;">
											<p class="attention">你还可以创建 50 份活动，活动的折扣率不能低于店铺最低折扣。活动时间延长方法见<a class="j_Mmstat" target="_blank">规则帖</a>。</p>
										</div>
										<ul class="list-tab-nav">
											<li class=" tab-selected ">
												<a class="j_Mmstat" href="#">标签/全网客户</a>
											</li>
											<li class="">
												<a class="j_Mmstat" href="#">店铺VIP客户</a>
											</li>
											<li class="">
												<a class="j_Mmstat" href="#">会员专享活动</a>
											</li>
										</ul>
										<div class="searchbar bd-top ">
											<div class="skin-gray">
												<label for="">活动状态：</label>
												<select name="queryType" id="queryType">
													<option value="0" selected="">全部</option>
													<option value="1">已结束</option>
													<option value="2">进行中</option>
													<option value="3">未开始</option>
												</select>
												<label for="">活动时间：</label>
												<input type="text" class="J_beginDate" name="startDate" value="" class="input input-sm input-date">
												至
												<input type="text" class="J_endDate" name="endDate" value="" class="input input-sm input-date">
												<button class="j_Mmstat search-btn-c">搜索</button>
											</div>
										</div>
										<div class="item-table mt10" style="border-top: none;">
											<table class="table table-headed mt10">
												<colgroup>
		    										<col class="col-1">
		    										<col class="col-2">
		    										<col class="col-3">
		    										<col class="col-4">
		    										<col class="">
												</colgroup>
												<thead>
													<tr>
														<th class="">活动名</th>
														<th>活动时间</th>
			                        					<th>状态</th>
														<th>目标客户</th>
			                        					<th>操作</th>
													</tr>
												</thead>
												<tbody>
													<tr class="row-noborder">
														<div class="act-pagination">
															<div class="operations">
																
															</div>
														</div>
													</tr>
												</tbody>
											</table>
										</div>
									</form>
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

	
	// next step
	$(".discount-page .main-wrap .actobj.mt15 .controls-wrap a.ui-btn").click(function() {
		$(this).parents(".actobj").hide().siblings().show();
	})
	// 活动 内容---选择活动
	$(".actcon.mt15 .actcon-bd .control-group .j_ActivityGroup li").click(function() {
		$(this).addClass("label-control-checked ").siblings(".label-control-checked").removeClass("label-control-checked");
		var index = $(this).index();
		$(this).parents(".control-group").siblings(".control-group").find(".combo-batch.J_itemSale").addClass("hidden").eq(index).removeClass("hidden");

	})
	$(".actcon.mt15 .control-group .controls input.ipt-date").datetimepicker({
		format: 'Y-m-d',
		timepicker: false,
		weeks: false,
		allowTimes: false,
	})
	$(".actcon.mt15 .control-group .controls .shopbonus-panel input.chk").click(function() {
		if($(this).is(":checked")) {
			$(this).siblings(".bonus").show();
		}else {
			$(this).siblings(".bonus").hide();
			
		}
	})
	// 点击全选
	$(".table-inform .item-selectBaobei table.J_baobeiShow tfoot .act input[type=checkbox]").click(function() {
		if($(this).is(":checked")) {
			$(this).parents("table.J_baobeiShow").find("tbody td input[type=checkbox]").attr("checked", true);
		} else {
			$(this).parents("table.J_baobeiShow").find("tbody td input[type=checkbox]").removeAttr("checked");
		}
	})
	$(".table-inform .item-selectBaobei table.J_baobeiShow tbody td input[type=checkbox]").click(function() {
		if($(this).parents(".J_baobeiShow").find("tfoot td .act input[type=checkbox]").is(":checked")) {
			$(this).parents(".J_baobeiShow").find("tfoot td .act input[type=checkbox]").removeAttr("checked");
		}
		if( $(this).parents(".J_baobeiShow").find("tbody td input:checked").length === $(this).parents(".J_baobeiShow").find("tbody tr").length ) {
			$(this).parents(".J_baobeiShow").find("tfoot input").attr("checked", true);
		}
	})

	// 全部宝贝 or  部分宝贝
	$(".actcon-bd .control-group .J_ctrlShow input").click(function() {
		var index = $(this).index();
		if(index === 2) {
			$(this).parents(".J_ctrlShow").siblings(".table-inform").show();
		}else {
			$(this).parents(".J_ctrlShow").siblings(".table-inform").hide();
		}
	})

	// 创建活动 or  活动list
	$(".discount-page .top-nav-btn-group a").click(function() {
		var index = $(this).index();
		$(this).addClass("active").siblings("a").removeClass("active");
		if(index === 1) {
			$(".event-manage").show().siblings(".create-event.J_createEvent").hide();
		}else {
			$(".create-event.J_createEvent").show().siblings(".event-manage").hide();
		}
	})
</script>
</html>

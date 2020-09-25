<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!-- 客户列表  分组管理-->


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
				<div class="group-manage-inner">
					<div class="group-manage">
						<div class="main-block label_list container-fluid ">
							<div class="row">
								<h2>分组管理</h2>
							</div>
							<div class="row query clearfix">
								<div class="col-md-6 col-sm-6 lf">
									<input type="text" class="form-control ng-pristine ng-valid" ng-model="keyWord" id="J_searchWord" value="" placeholder="直接输入分组搜索">
								</div>
								<div class="col-md-6 col-sm-6 lf">
						    		<label>最多可设置100个分组，还可增加<span id="J_restTags">99</span>个分组</label>
									<a href="javascript:;" class="btn btn-default btn-primary">新增分组</a>
								</div>
							</div>
							<div class="row tag-container">
								<div class="panel panel-default panel-sm">
									<div class="panel-heading">
										<span class="label-name ng-binding">淘尚168</span>
										<input type="text" class="form-control edit hidden" data-old-value="淘尚168" value="淘尚168">
										<span class="edit hidden">(回车提交)</span>
										<i class="iconfont icon-edit hidden" ng-show="!label.message"></i>
										<i class="wsif wsif-close hidden" ng-show="!label.message"></i>
									</div>
									<div class="panel-body">
										<span>客户数：<span class="consumerNum ng-binding">0</span></span>
									</div>
									<div  class="panel-footer show">
			                            <a href="#">查看客户</a>
									    <a href="#">详情</a>
										<span class="copyto hidden" ng-show="!label.message">
											<a href="javascript:void(0);" class="select-tag wsif wsif-down" data-event-type="event_submit_do_copy" data-from-label-id="10144375019">复制到</a>
										</span>
										<span class="moveto hidden" ng-show="!label.message">
											<a href="javascript:void(0);" class="select-tag wsif wsif-down" data-event-type="event_submit_do_move" data-from-label-id="10144375019">移动到</a>
										</span>
										<span ng-show="!!label.message" class="on-copy ng-binding">删除任务执行中</span>
									</div>
								</div>
							</div>
						</div>

						<!-- er -->

						<div class="main-block add-label container-fluid" style="display: none;">
							<div class="row">
								<h3>
									<ol class="breadcrumb">
										<li><a href="//ecrm.taobao.com/p/customer/labelList.htm">分组管理</a></li>
										<li class="active">新建分组</li>
									</ol>
								</h3>
							</div>
							<form class="form-horizontal">
								<div class="label-container">
									<div class="form-group label-title">
										<label class="col-md-2 col-sm-2"><span class="text-primary">*</span>分组名称：</label>
										<div class="col-md-5 col-sm-5">
											<input type="text" class="form-control" id="J_labelTitle" placeholder="请输入分组名称" name="labelName" maxlength="15" value="">
										</div>
									</div>
									<div class="form-group label-form">
										<label class="col-md-2 col-sm-2"><span class="text-primary">*</span>分组方式：</label>
										<div class="col-md-3 col-sm-3">
											<div class="radio text-primary">
												<label>
													<input type="radio" name="labelType" value="1" class="ng-pristine ng-valid" checked="checked">
													<span>仅创建名称手动打标</span>
												</label>
											</div>
											<div class="radio text-primary">
												<label>
													<input type="radio" name="labelType" value="2" class="ng-pristine ng-valid">
													<span>根据交易数据自动打标</span>
												</label>
											</div>
											<div class="radio text-primary">
												<label>
													<input type="radio" name="labelType" value="3" class="ng-pristine ng-valid">
													<span>根据商品数据自动打标</span>
												</label>
											</div>
										</div>
										<div class="col-md-7 col-sm-7 form-content">
											<div class="trade-form tooltip-only-arrow right" style="display: none;">
												<div class="tooltip-arrow">
								                  <div class="tooltip-arrow cover"></div>
								                </div>
								                <div class="tooltip-inner">
													<div class="condition">
														<label class="radio-inline text-primary">
															<input type="radio" name="_fm.l._0.m" value="matchAny" class="ng-pristine ng-valid" checked="checked">
															<span>满足以下一个条件即可</span>
														</label>
														<label class="radio-inline text-primary">
															<input type="radio" name="_fm.l._0.m" value="matchAll" class="ng-pristine ng-valid"> 
															<span>必须满足全部条件</span>
														</label>
													</div>
													<div class="setting">
														<div class="item">
															<div class="checkbox text-primary">
																<label>
																	<input type="checkbox" name="_fm.l._0.t" ng-model="tradeNumCheck" class="ng-pristine ng-valid">
																	<span>累计交易笔数</span>
																</label>
															</div>
															<input class="form-control left trade" name="_fm.l._0.tr" type="text" value="">-
															<input class="form-control right trade" name="_fm.l._0.tra" type="text" value="">
														</div>
														<div class="item">
															<div class="checkbox text-primary">
																<label>
																	<input type="checkbox" name="_fm.l._0.to" ng-model="tradeBabyCheck" class="ng-pristine ng-valid">
																	<span>累计宝贝数量</span>
																</label>
															</div>
															<input class="form-control left trade" name="_fm.l._0.tot" type="text" value="">-
															<input class="form-control right trade" name="_fm.l._0.tota" type="text" value="">
														</div>
														<div class="item">
															<div class="checkbox text-primary">
																<label>
																	<input type="checkbox" name="_fm.l._0.total" ng-model="tradeAmountCheck" class="ng-pristine ng-valid">
																	<span>累计交易金额</span>
																</label>
															</div>
															<input class="form-control left amount" name="_fm.l._0.totalt" type="text" value="">-
															<input class="form-control right amount" name="_fm.l._0.totaltr" type="text" value="">
														</div>
														<div class="item">
															<div class="checkbox text-primary">
																<label>
																	<input type="checkbox" name="_fm.l._0.me" ng-model="customerLevelCheck" class="ng-pristine ng-valid">
																	<span>店铺会员等级 </span>
																</label>
															</div>
															<label class="select">
																<select class="form-control" name="_fm.l._0.mem">
																	<option value="0" selected="">请选择会员等级</option>
																	<option value="1">普通会员</option>
																	<option value="2">高级会员</option>
																	<option value="3">VIP会员</option>
																	<option value="4">至尊VIP会员</option>
																</select>
																<i class="icon caret icon-arrow"></i>
															</label>
														</div>
														<div class="item">
															<div class="checkbox text-primary">
																<label>
																	<input type="checkbox" name="_fm.l._0.lat" ng-model="tradeTimeCheck" class="ng-pristine ng-valid">
																	<span>最近购买时间</span>
																</label>
															</div>
															<div class="form-group input-daterange" data-toggle="datepicker">
																<input type="text" name="_fm.l._0.late" value="" class="form-control input-date left" placeholder=""> -
																<input type="text" name="_fm.l._0.lates" value="" class="form-control input-date right" placeholder="">
															</div>
														</div>
													</div>
								                </div>
											</div>
											<div class="trade-data tooltip-only-arrow right" style="display: none;">
												<div class="tooltip-arrow">
								                  <div class="tooltip-arrow cover"></div>
								                </div>
								                <div class="tooltip-inner">
													<div class="condition">
														<div class="radio text-primary">
															<label>
																<input name="_fm.l._0.m" value="matchAny" type="radio" ng-checked="true" checked="checked">
																<span>满足以下一个商品即可</span>
															</label>
														</div>
													</div>
													<div class="goods-container">
														<span class="text-primary">选择指定商品</span><span>（不超过10个）</span>
														<ul class="tag">
														</ul>
													</div>
								                </div>
											</div>
										</div>
										<div class="col-md-2 col-sm-2 btn-container">
								            <button class="btn btn-default btn-primary">确定</button>
								          </div>
									</div>
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

<!-- dialog -->
<div class="mask-dialog"></div>
<div class="modal-dialog choose-goods-pop" style="width: 700px;">
	<div class="modal-content">
		<div class="modal-header">
            <i class="close wsif wsif-close" data-dismiss="modal">x</i>
            <h4 class="modal-title J_selGoodsModalLabel"></h4>
        </div>
        <div class="modal-body">
        	<div class="J_searchBaobei container-fluid">
        		<div class="row">
        			<div class="col-md-6 warning-msg">
        				<div class="alert alert-warning alert-small" role="alert">只能在库存数量&gt;=50的商品中选择参与报名</div>
        			</div>
        			<div class="col-md-6 goods-tips">已选择
        				<span class="J_selectedItems">0</span>个，至少选择<b>1</b>个，最多可选<b>10</b>个
        			</div>
        		</div>
        		<div class="row select-container">
        			<select class="J_isAllSelect"><option value="-1">全部宝贝</option></select>
        			<input type="text" class="J_searchName" placeholder="宝贝名称">
        			<input type="text" class="J_searchCode" placeholder="商家编码">
        			<button type="button" class="J_searchBaobeiBtn btn btn-default">搜索</button>
        		</div>
        	</div>
        	<table class="goods-table">
        		<thead>
        			<tr>
        				<td class="col-md-6">
        					<select class="J_showSelectedGoods"><option value="0">宝贝</option><option value="1">已选择宝贝</option></select>
        				</td>
        				<td class="col-md-3">商家编码</td>
        				<td class="col-md-3">价格(元)</td>
        			</tr>
        		</thead>
        		<tbody>
        			<tr>
        				<td colspan="4" class="outer-td">
        					<div class="goods-rows row">
        						<table class="goods-inner-table table">
        							<colgroup><col class="inner-col1"><col class="inner-col2"><col class="inner-col3"></colgroup>
        							<tbody>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        								<tr>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        								<tr>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        								<tr>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        								<tr>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        								<tr>
        									<td class="col-md-6 product-info">
        										<label class="ib J_checkOne">
        											<input type="checkbox" class="checkbox">
        										</label>
        										<a class="ib goodsimg-link" href="#" target="_blank">
        											<img class="goodsimg" src="//img.alicdn.com/bao/uploaded/i4/2683428516/TB2TRvNXUUIL1JjSZFrXXb3xFXa_!!2683428516.jpg_sum.jpg">
        										</a>
        										<a class="goods-title ib" href="#" target="_blank">尼奶锅加厚煮泡面锅汤锅小锅包邮婴儿煮奶锅电磁炉通用</a>
        										<img class="hidden eleven" src="//img.alicdn.com/tps/TB18jEDJFXXXXXJXXXXXXXXXXXX-30-14.png">
        									</td>
        									<td class="col-md-3">&nbsp;</td>
        									<td class="col-md-3 good-price">36.0</td>
        								</tr>
        							</tbody>
        						</table>
        					</div>
        				</td>
        			</tr>
        		</tbody>
        	</table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-lg" >取消</button>
            <button type="button" class="btn btn-primary btn-lg" >确定</button>
          </div>
	</div>
</div>


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

	$(".group-manage-inner .container-fluid .row.query .btn").click(function() {
		$(this).parents(".main-block.container-fluid ").hide().siblings(".main-block.container-fluid").show();
	})

	$(".main-block.container-fluid .form-horizontal .col-md-3.col-sm-3 .radio").click(function() {
		if( $(this).index() === 1 ) {
			$(".col-md-7.col-sm-7.form-content .trade-form").show().siblings("div").hide();
		}
		if( $(this).index() === 2 ) {
			$(".col-md-7.col-sm-7.form-content .trade-data").show().siblings("div").hide();
		}
	})
	$(".tooltip-inner .left.form-control,.tooltip-inner .right.form-control").datetimepicker({
		format: 'Y-m-d',
		timepicker: false,
		weeks: false,
		allowTimes: false,
	})
	$(".group-manage-inner .form-horizontal .form-content .goods-container span.text-primary").click(function() {
		$(".mask-dialog").fadeIn(500);
		$(".modal-dialog.choose-goods-pop").fadeIn(500);
	})
	$(".modal-dialog.choose-goods-pop .close,.modal-dialog.choose-goods-pop .modal-footer button.btn-default").click(function() {
		$(".mask-dialog").hide();
		$(".modal-dialog.choose-goods-pop").hide();
	})
			// 框 最多选10个
	var maxChoose = 10;
	$(".modal-dialog.choose-goods-pop .modal-footer button.btn-primary").click(function() {
		console.log($(".modal-dialog.choose-goods-pop .goods-tips .J_selectedItems").text())
		if($(".modal-dialog.choose-goods-pop .goods-tips .J_selectedItems").text() === "0") {
			alert("至少选一个宝贝");
		}
	})
	$(".modal-dialog.choose-goods-pop .goods-inner-table.table .J_checkOne input[type=checkbox]").click(function(){
		console.log();
		var choosed = $(".modal-dialog.choose-goods-pop .goods-inner-table.table .J_checkOne input[type=checkbox]:checked").size();
		if( maxChoose >= choosed) {
			$(".modal-dialog.choose-goods-pop .goods-tips .J_selectedItems").text(choosed);
		}
		else {
			alert("最多选"+maxChoose+"个宝贝！");
		}
	})


</script>


</html>

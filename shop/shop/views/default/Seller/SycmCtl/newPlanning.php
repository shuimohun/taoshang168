<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--流量  计划监控 运营计划 新建-->
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/sycm_index.css">

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
<div class="main-wrap w-1430 mt-10">
	<div class="nav lf w-160">
		<div class="left-nav">
			<div class="topLogo">
				<div class="topLogoContent">
					<i class="icon"></i>
					<p>实时直播</p>
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
						<li class="menu-item-inner lf curr">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">运营计划</span>
							</a>
						</li>
					</ul>
				</li>
				
			</ul>
		</div>
	</div>
	<div class="w-1260 rt new-planning-container">
		<div class="ebase-ModernFrame__main">
			<div class="ebase-metaDecorator__root">
				<div>
					<!-- step1 -->
					<div class="PlanCenterPlanFilter__root">
						<div class="PlanCenterPlanFilter__planStep">
							<div class="PlanCenterPlanFilter__hexagons">
								<div class="PlanCenterPlanFilter__hexagonOne PlanCenterPlanFilter__firstSteping">
									<span class="PlanCenterPlanFilter__hexagonNum">1</span>
									<p class="PlanCenterPlanFilter__hexagonText">选择计划指标</p>
								</div>
								<div class="PlanCenterPlanFilter__hexagonLinkOne"></div>
								<div class="PlanCenterPlanFilter__hexagonTwo">
									<span class="PlanCenterPlanFilter__hexagonNum">2</span>
									<p class="PlanCenterPlanFilter__hexagonText">选择参照年份</p>
								</div>
								<div class="PlanCenterPlanFilter__hexagonLinkTwo"></div>
								<div class="PlanCenterPlanFilter__hexagonThree">
									<span class="PlanCenterPlanFilter__hexagonNum">3</span>
									<p class="PlanCenterPlanFilter__hexagonText">生成年度计划</p>
								</div>
							</div>
						</div>
						<div class="PlanCenterPlanFilter__planFirstStep oui-card">
							<div class="oui-card-header-wrapper"><h4 class="oui-card-title">第一步：选择计划指标</h4><div class="oui-card-header"><span></span></div></div>
							<div class="oui-card-content">
								<div class="PlanCenterPlanFilter__firstStep">
									<div class="PlanCenterPlanFilter__planItem ">
										<p class="PlanCenterPlanFilter__planTitle">计划名称</p>
										<input type="text" class="PlanCenterPlanFilter__titleInput" placeholder="请在此输入..." maxlength="15">
										<span class="PlanCenterPlanFilter__titleError"><i class="oui-icon oui-icon-error"></i>
											<span class="PlanCenterPlanFilter__errorText">请填写计划名称</span>
										</span>
									</div>
									<div class="PlanCenterPlanFilter__planItem ">
										<p class="PlanCenterPlanFilter__planTitle">选择年份</p>
										<div class="oui-select PlanCenterPlanFilter__yearSelect">
											<div class="select-control ui-selector lf">
												<a href="javascript:;">
													<span class="ui-selector-value">请选择</span>
													<span class="caret icon"></span>
												</a>
												<ul class="ui-selector-list select-control-list" style="display: none;">
													<li class="ui-selector-item curr">
														<span>2017</span>
													</li>
													<li class="ui-selector-item">
														<span>2016</span>
													</li>
												</ul>
											</div>
										</div>
										<span class="PlanCenterPlanFilter__yearError">
											<i class="oui-icon oui-icon-error"></i>
											<span class="PlanCenterPlanFilter__errorText">请选择年份</span>
										</span>
									</div>
									<div class="PlanCenterPlanFilter__planItem ">
										<p class="PlanCenterPlanFilter__planTitle">计划备注</p>
										<input type="text" class="PlanCenterPlanFilter__remarkInput" placeholder="请在此输入..." maxlength="50">
										<span class="PlanCenterPlanFilter__titleError">
											<i class="oui-icon oui-icon-error"></i>
											<span class="PlanCenterPlanFilter__errorText">请填写计划备注</span>
										</span>
									</div>
									<div class="PlanCenterPlanFilter__planItem">
										<p class="PlanCenterPlanFilter__planTitle">选择类别</p>
										<div  class="oui-select PlanCenterPlanFilter__deviceSelect">
											<div class="select-control ui-selector lf" value="0">
												<a href="javascript:;">
													<span class="ui-selector-value">所有终端</span>
													<span class="caret icon"></span>
												</a>
												<ul class="ui-selector-list select-control-list" style="display: none;">
													<li class="ui-selector-item curr">
														<span>所有终端</span>
													</li>
													<li class="ui-selector-item">
														<span>PC端</span>
													</li>
													<li class="ui-selector-item">
														<span>无线端</span>
													</li>
												</ul>
											</div>
											<!--  -->
											<div class="classify-select classify-select-classify select-control common-picker isready" style="display: none;">
												<a class="common-picker-header" href="#" >
													<span class="short-name"> 无来源</span><i class="caret icon"></i>
												</a>
												<div class="common-picker-menu select-control-list" style="height: 308px; width: 210px; left: -210px;display: none;">
													<div class="tree-search-wrapper">
														<div class="ebase-CommonSearch__root">
															<div class="legacy-oui-typeahead common-typeahead">
																<div class="legacy-oui-typeahead-input-wrapper">
																	<input type="text" class="legacy-oui-typeahead-input" value="" placeholder="请输入关键字">
																	<i class="oui-icon oui-icon-search search-icon"></i>
																	<span class="search-del">×</span>
																</div>
															</div>
														</div>
													</div>
													<div class="trees-menu" style="display: block;">
														<ul class="tree-menu common-menu tree-scroll-menu-level-2" style="height: 308px; width: 210px; left: 208px;"></ul>
														<ul class="tree-menu common-menu tree-scroll-menu-level-1" style="height: 272px; width: 208px; left: -2px;"></ul>
													</div>
												</div>
											</div>
											<!--  -->
										</div>
										<div class="PlanCenterPlanFilter__systemBtns">
											<button disabled class="oui-btn oui-btn-md oui-btn-blank PlanCenterPlanFilter__recommandBtn">重置指标</button>
											<button class="oui-btn oui-btn-md oui-btn-primary PlanCenterPlanFilter__recommandBtn">推荐指标</button>
										</div>
									</div>
									<div class="PlanCenterPlanFilter__planIndexItem">
										<p class="PlanCenterPlanFilter__planIndexTitle">选择指标</p>
										<div>
											<div class="PlanCenterPlanFilter__systemIndex">浏览量</div>
											<div class="PlanCenterPlanFilter__systemIndex PlanCenterPlanFilter__selected">访客数</div>
											<div class="PlanCenterPlanFilter__systemIndex">跳失率</div>
											<div class="PlanCenterPlanFilter__systemIndex">人均浏览量</div>
											<div class="PlanCenterPlanFilter__systemIndex">收藏人数</div>
											<div class="PlanCenterPlanFilter__systemIndex">加购人数</div>
											<div class="PlanCenterPlanFilter__systemIndex">新访客</div>
											<div class="PlanCenterPlanFilter__systemIndex">老访客</div>
											<div class="PlanCenterPlanFilter__systemIndex">下单转化率</div>
											<div class="PlanCenterPlanFilter__systemIndex">支付转化率</div>
											<div class="PlanCenterPlanFilter__systemIndex">平均停留时长</div>
											<div class="PlanCenterPlanFilter__systemIndex">客单价</div>
											<div class="PlanCenterPlanFilter__systemIndex">UV价值</div>
										</div>
									</div>
									<div class="PlanCenterPlanFilter__planIndexItem">
										<p class="PlanCenterPlanFilter__planIndexTitle">已选指标</p>
										<div>
											<div class="PlanCenterPlanFilter__selectedIndexNoClose">所有终端-访客数</div>
										</div>
									</div>
									<div class="PlanCenterPlanFilter__planBtns">
										<button class="oui-btn oui-btn-md oui-btn-hollow PlanCenterPlanFilter__quitBtn">退出</button>
										<button disabled="" class="oui-btn oui-btn-md oui-btn-blank PlanCenterPlanFilter__nextBtn">下一步</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- step2 -->
					<div class="PlanCenterPlanFilter__root" style="display: none;">
						<div class="PlanCenterPlanFilter__planStep">
							<div class="PlanCenterPlanFilter__hexagons">
								<div class="PlanCenterPlanFilter__hexagonOne PlanCenterPlanFilter__firstSteped">
									<span class="PlanCenterPlanFilter__hexagonNum">1</span>
									<p class="PlanCenterPlanFilter__hexagonText">选择计划指标</p>
								</div>
								<div class="PlanCenterPlanFilter__hexagonLinkOne"></div>
								<div class="PlanCenterPlanFilter__hexagonTwo PlanCenterPlanFilter__secondSteping">
									<span class="PlanCenterPlanFilter__hexagonNum">2</span>
									<p class="PlanCenterPlanFilter__hexagonText">选择参照年份</p>
								</div>
								<div class="PlanCenterPlanFilter__hexagonLinkTwo"></div>
								<div class="PlanCenterPlanFilter__hexagonThree">
									<span class="PlanCenterPlanFilter__hexagonNum">3</span>
									<p class="PlanCenterPlanFilter__hexagonText">生成年度计划</p>
								</div>
							</div>
						</div>
						<div class="PlanCenterPlanFilter__planSecondStep oui-card">
							<div class="oui-card-header-wrapper"><h4 class="oui-card-title">第二步：是否需要参照数据</h4><div class="oui-card-header"><span></span></div></div>
							<div class="oui-card-content PlanCenterPlanFilter__planSecondStepCardContent">
								<span class="PlanCenterPlanFilter__checkRefer oui-checkbox oui-checked">
								<label><input type="checkbox" name="fw">是否使用参照数据</label>
								</span>
								<div class="PlanCenterPlanFilter__tableWrap">
									<div class="ebase-Table__root">
										<table class="ebase-Table__table" style="width: 740px;">
											<thead class="ebase-Table__thead">
												<tr>
													<th class="ebase-Table__th col-0 col-name  undefined" style="width: 60px; text-align: left;">月份</th>
													<th class="ebase-Table__th col-1 col-0_none_uv  undefined" style="text-align: right;">所有终端-访客数</th>
												</tr>
											</thead>
											<tbody>
												<tr class="ebase-Table__tbodyTr">
													<td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">1月</td>
													<td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">0</td>
												</tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">2月</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">0</td></tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">3月</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">0</td></tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">4月</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">0</td></tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">5月</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">0</td></tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">6月</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">215</td></tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">7月</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">630</td></tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">8月</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">2,017</td></tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">9月</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">1,600</td></tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">10月</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">44</td></tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">11月</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">0</td></tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">12月</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">0</td></tr>
												<tr class="ebase-Table__tbodyTr"><td class="ebase-Table__td col-0 col-name  undefined" style="width: 60px; text-align: left;">全年</td><td class="ebase-Table__td col-1 col-0_none_uv  undefined" style="text-align: right;">4,506</td></tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="PlanCenterPlanFilter__planBtns">
									<button class="oui-btn oui-btn-md oui-btn-hollow PlanCenterPlanFilter__quitBtn">退出</button>
									<button class="oui-btn oui-btn-md oui-btn-primary PlanCenterPlanFilter__preBtn">上一步</button>
									<button class="oui-btn oui-btn-md oui-btn-primary PlanCenterPlanFilter__nextBtn">下一步</button>
								</div>
							</div>
						</div>
					</div>
					<!-- step3 -->
					<div class="PlanCenterPlanFilter__root" style="display: none;">
						<div class="PlanCenterPlanFilter__planStep">
							<div class="PlanCenterPlanFilter__hexagons">
								<div class="PlanCenterPlanFilter__hexagonOne PlanCenterPlanFilter__firstSteped">
									<span class="PlanCenterPlanFilter__hexagonNum">1</span>
									<p class="PlanCenterPlanFilter__hexagonText">选择计划指标</p>
								</div>
								<div class="PlanCenterPlanFilter__hexagonLinkOne "></div>
								<div class="PlanCenterPlanFilter__hexagonTwo PlanCenterPlanFilter__secondSteped">
									<span class="PlanCenterPlanFilter__hexagonNum">2</span>
									<p class="PlanCenterPlanFilter__hexagonText">选择参照年份</p>
								</div>
								<div class="PlanCenterPlanFilter__hexagonLinkTwo"></div>
								<div class="PlanCenterPlanFilter__hexagonThree PlanCenterPlanFilter__thirdSteping">
									<span class="PlanCenterPlanFilter__hexagonNum">3</span>
									<p class="PlanCenterPlanFilter__hexagonText">生成年度计划</p>
								</div>
							</div>
						</div>
						<div class="PlanCenterPlanFilter__planThirdStep oui-card">
							<div class="oui-card-header-wrapper"><h4 class="oui-card-title">第三步：生成年度计划</h4><div class="oui-card-header"><span></span></div></div>
							<div class="oui-card-content PlanCenterPlanFilter__planThirdStepCardContent">
								<div class="PlanCenterPlanFilter__planUp">
									<span class="PlanCenterPlanFilter__planUpTitle">计划增长幅度</span>
									<input type="text" class="PlanCenterPlanFilter__planUpInput"><span>%</span>
									<button class="oui-btn oui-btn-md oui-btn-primary PlanCenterPlanFilter__planUpBtn">生成计划</button>
								</div>
								<div class="PlanCenterPlanFilter__tableWrap">
									<div class="PlanCenterPlanFilter__finalTable edit-table-root" style="overflow-x: scroll;">
										<table class="table" style="width: 740px;">
											<thead class="thead">
												<tr class="tableTheadTr">
													<th class="th col-0 col-name " style="width: 60px; text-align: left;">月份</th>
													<th class="th col-1 col-0_none_uv " style="text-align: right;">所有终端-访客数</th>
													<th class="th col-2 col-plan0_none_uv " style="text-align: right;">计划所有终端-访客数</th>
												</tr>
											</thead>
											<tbody>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">1月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">0</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div>
																<input type="text" class="input-value" value="0">
															</div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">2月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">0</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div>
																<input type="text" class="input-value" value="0">
															</div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">3月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">0</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div>
																<input type="text" class="input-value" value="0">
															</div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">4月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">0</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div>
																<input type="text" class="input-value" value="0">
															</div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">5月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">0</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div>
																<input type="text" class="input-value" value="0">
															</div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">6月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">215</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div>
																<input type="text" class="input-value" value="215">
															</div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">7月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">630</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div>
																<input type="text" class="input-value" value="630">
															</div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">8月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">2,017</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div><input type="text" class="input-value" value="2017"></div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">9月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">1,600</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div><input type="text" class="input-value" value="1600"></div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">10月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">44</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div><input type="text" class="input-value" value="44"></div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">11月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">0</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div><input type="text" class="input-value" value="0"></div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">12月</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">0</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div><input type="text" class="input-value" value="0"></div>
														</div>
													</td>
												</tr>
												<tr class="tbodyTr">
													<td class="td col-0 col-name " style="width: 60px; text-align: left;">全年</td>
													<td class="td col-1 col-0_none_uv " style="text-align: right;">4,506</td>
													<td class="td col-2 col-plan0_none_uv " style="text-align: right;">
														<div style="display: inline;">
															<div><input type="text" class="input-value" value="4506"></div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="PlanCenterPlanFilter__planBtns">
									<button class="oui-btn oui-btn-md oui-btn-hollow PlanCenterPlanFilter__quitBtn">退出</button>
									<button class="oui-btn oui-btn-md oui-btn-primary PlanCenterPlanFilter__preBtn">上一步</button>
									<button class="oui-btn oui-btn-md oui-btn-primary PlanCenterPlanFilter__nextBtn">保存完成</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript">
	$(function() {
		// STEP----1
			var selected = false;
			// input  输入字符 数量
			$(".PlanCenterPlanFilter__planFirstStep.oui-card .oui-card-content .PlanCenterPlanFilter__planItem input").focus(function() {
				var _this = $(this);
				var tipName = _this.siblings('.PlanCenterPlanFilter__titleError').text();
				_this.keyup(function(){
					var maxSize = parseInt(_this.attr("maxlength"));
					var realLength = _this.val().length;
					_this.siblings(".PlanCenterPlanFilter__titleError").text("您还可输入"+(maxSize-realLength)+"个字");
					if( realLength === 0 ) {
						_this.siblings(".PlanCenterPlanFilter__titleError").text(tipName);
						$(".PlanCenterPlanFilter__planBtns .PlanCenterPlanFilter__nextBtn").attr("disabled", "disabled");
					} else {
						if (_this.parents(".PlanCenterPlanFilter__planItem ").siblings(".PlanCenterPlanFilter__planItem ").find("input").val() !== "" && _this.val() !== '' && selected) {
							$(".PlanCenterPlanFilter__planBtns .PlanCenterPlanFilter__nextBtn").removeAttr("disabled");
						}
					}
				})
			});
			$(".PlanCenterPlanFilter__planFirstStep.oui-card .oui-card-content .ui-selector .ui-selector-list .ui-selector-item").click(function() {
				var _this = $(this);
				var index = _this.index();

				if(_this.parents(".oui-select.PlanCenterPlanFilter__yearSelect").siblings(".PlanCenterPlanFilter__yearError").length !== 0) {
					_this.parents(".oui-select.PlanCenterPlanFilter__yearSelect").siblings(".PlanCenterPlanFilter__yearError").hide();
				}

				_this.parents(".ui-selector").attr("value", index);
				if(index !== 0) {
					_this.parents(".ui-selector").siblings(".classify-select").show();
				} else{
					_this.parents(".ui-selector").siblings(".classify-select").hide();
				}
			});
			$(".PlanCenterPlanFilter__planIndexItem .PlanCenterPlanFilter__systemIndex").on("click", function() {
				var _this = $(this);
				var text = _this.text();
				if(_this.hasClass("PlanCenterPlanFilter__selected")) {
					return false;
				} else {
					_this.addClass("PlanCenterPlanFilter__selected");
					var html = '<div class="PlanCenterPlanFilter__selectedIndex">'+ text +'<a style="color:#fff;font-size:16px;margin-left:5px;">x</a></div>'
					_this.parents(".PlanCenterPlanFilter__planIndexItem").next(".PlanCenterPlanFilter__planIndexItem").children("div").append(html);
				}
				$(".PlanCenterPlanFilter__systemBtns .PlanCenterPlanFilter__recommandBtn").removeAttr("disabled");
			})
			$(".PlanCenterPlanFilter__planIndexItem").on("click", ".PlanCenterPlanFilter__selectedIndex a", function() {
				var _this = $(this);
				if(_this.parents(".PlanCenterPlanFilter__selectedIndex").siblings(".PlanCenterPlanFilter__selectedIndex").length === 0 ) {
					_this.parents(".PlanCenterPlanFilter__planFirstStep").find(".PlanCenterPlanFilter__recommandBtn").attr("disabled", "disabled");
				}

				_this.parents(".PlanCenterPlanFilter__selectedIndex").remove();
				var text = _this.parents(".PlanCenterPlanFilter__selectedIndex").text();
				text = text.slice(0, text.length-1);

				$(".PlanCenterPlanFilter__planIndexItem .PlanCenterPlanFilter__systemIndex").each(function() {
					var inner_this = $(this);
					if(text === inner_this.text()) {
						inner_this.removeClass("PlanCenterPlanFilter__selected")
					}
				})
			})	
			// 点击重置
			$(".PlanCenterPlanFilter__systemBtns .PlanCenterPlanFilter__recommandBtn").click(function() {
				var _this = $(this);
				_this.attr("disabled", "disabled");
				_this.parents(".PlanCenterPlanFilter__planFirstStep").find(".PlanCenterPlanFilter__selectedIndex").each(function() {
					var inner_this = $(this);
					var text = inner_this.text();
					text = text.slice(0, text.length - 1);

					_this.parents(".PlanCenterPlanFilter__planFirstStep").find(".PlanCenterPlanFilter__systemIndex").each(function() {
						var inner_this_inner = $(this);
						if(inner_this_inner.text() === text) {
							 inner_this_inner.removeClass("PlanCenterPlanFilter__selected")
						}
					})
				});

				_this.parents(".PlanCenterPlanFilter__planFirstStep").find(".PlanCenterPlanFilter__selectedIndex").remove()
			})

			// 下一步按钮是否可用？
			$(".PlanCenterPlanFilter__firstStep .PlanCenterPlanFilter__yearSelect .select-control .select-control-list").click(function() {
				selected = true;
				var input1 = $(".PlanCenterPlanFilter__firstStep input.PlanCenterPlanFilter__titleInput");
				var input2 = $(".PlanCenterPlanFilter__firstStep input.PlanCenterPlanFilter__remarkInput");
				if ( input1.val() !== '' && input2.val() !== '') {
						$(".PlanCenterPlanFilter__planBtns .PlanCenterPlanFilter__nextBtn").removeAttr("disabled");
				}
			})

			// 点击下一步
			$(".PlanCenterPlanFilter__planFirstStep .PlanCenterPlanFilter__nextBtn").click(function() {
				var _this = $(this);
				_this.parents(".PlanCenterPlanFilter__root").hide().next(".PlanCenterPlanFilter__root").show();
			})
			$(".PlanCenterPlanFilter__planSecondStep .PlanCenterPlanFilter__preBtn").click(function() {
				var _this = $(this);
				_this.parents(".PlanCenterPlanFilter__root").hide().prev(".PlanCenterPlanFilter__root").show();
			})
			$(".PlanCenterPlanFilter__planSecondStep .PlanCenterPlanFilter__nextBtn").click(function() {
				var _this = $(this);
				_this.parents(".PlanCenterPlanFilter__root").hide().next(".PlanCenterPlanFilter__root").show();
			})
			$(".PlanCenterPlanFilter__planThirdStep  .PlanCenterPlanFilter__preBtn").click(function() {
				var _this = $(this);
				_this.parents(".PlanCenterPlanFilter__root").hide().prev(".PlanCenterPlanFilter__root").show();
			})
			$(".PlanCenterPlanFilter__planThirdStep  .PlanCenterPlanFilter__nextBtn").click(function() {
				var _this = $(this);
				window.open('index.php?ctl=Seller_Sycm&met=created');
			})

		// 
		var classifyselect = {
			'无来源':[],
			'自主访问': ['店铺收藏', '宝贝收藏', '我的淘宝首页', '已买到商品', '直接访问', '购物车'],
			'付费流量': ['淘宝客', '直通车', '支钻', '聚划算', '品销宝-搜凑产品'],
			'淘内免费': ['淘宝搜索', '天猫首页', '天猫搜索', '天猫频道', '淘女郎', '淘宝试用', '店铺动态'],
			'床上用品': ['床品套件/四件套/多件套'],
			'服饰配件/皮带/帽子/围巾': ['其他配件'],
			'厨房电器': ['电压力锅'],
			'尿片/洗护/喂哺/推车床':['宝宝洗浴护肤品'],
			'厨房/烹饪用具': ['烹饪厨具'],
			'大家电': ['冰箱'],
			'洗护清洁剂/卫生巾/纸/香薰': ['纸品/湿巾', '卫生巾/护垫/成人尿裤', '衣物清洁剂/护理剂', '头发清洁/护理/造型']
		}

		var fragment = document.createDocumentFragment();
		allProps();

		function allProps () {
			for (var props in  classifyselect) {
				var html = '';
				if(classifyselect[props][0] != undefined) {
					html += '<li class="tree-item common-item">'+props+'<i class="child-symbol" style="position:absolute;right:10px;color:#555;">></i></li>'
				} else {
					html += '<li class="tree-item common-item">'+props+'</li>'
				}
				$(fragment).append(html);
			}
			$(".classify-select.common-picker.classify-select-classify .tree-menu.common-menu.tree-scroll-menu-level-1").append(fragment);
			$(".classify-select.common-picker.classify-select-classify .tree-menu.common-menu.tree-scroll-menu-level-1 li").eq(0).addClass("active");

			if($(".classify-select.common-picker.classify-select-classify .tree-menu.common-menu.tree-scroll-menu-level-2").html() === '') {
				$(".classify-select.common-picker.classify-select-classify .tree-menu.common-menu.tree-scroll-menu-level-2").html('<li style="text-align:center;margin-top:120px;">当前类目下暂无子分类</li>')
			}
		}

		$(".classify-select.common-picker .tree-menu.common-menu.tree-scroll-menu-level-1").on("mouseenter", 'li', function() {
			var _this = $(this);
			var html = '';
			var keyW = _this.text();
			keyW = keyW.replace(">", '');
			for (var names in classifyselect) {
				if(names === keyW) {
					for (var i = 0; i < classifyselect[names].length; i ++) {
						html += '<li class="tree-item common-item">'+classifyselect[names][i]+'</li>'
					}
				}
			}
			_this.parents(".tree-menu.common-menu.tree-scroll-menu-level-1").siblings(".tree-menu.common-menu.tree-scroll-menu-level-2").find("li").remove();
			$(fragment).append(html);
			_this.parents(".tree-menu.common-menu.tree-scroll-menu-level-1").siblings(".tree-menu.common-menu.tree-scroll-menu-level-2").append(fragment);
			if(_this.parents(".tree-menu.common-menu.tree-scroll-menu-level-1").siblings(".tree-menu.common-menu.tree-scroll-menu-level-2").html() === '') {
				_this.parents(".tree-menu.common-menu.tree-scroll-menu-level-1").siblings(".tree-menu.common-menu.tree-scroll-menu-level-2").html('<li style="text-align:center;margin-top:120px;">当前类目下暂无子分类</li>')
			}
		})

		$(".classify-select.common-picker .tree-menu.common-menu").on("click",function(event) {
			var event = event || window.event;
			var target = event.target || event.srcElement;
			if(target.nodeName.toLowerCase() === 'li') {
				var text = $(target).text().replace(">", '');
				$(target).parents('.classify-select.common-picker').find(".short-name").text(text);
				$(target).addClass("active").siblings(".active").removeClass("active");
				$(target).parents(".select-control-list").hide();
			}
		})
		$(".classify-select.common-picker .legacy-oui-typeahead-input").keyup(function(event) {
			var event = event || window.event;
			if(event.keyCode !== 38 && event.keyCode !== 40) {
				var sign1 = false;  /*起标识作用*/
				var sign2 = false;  /*起标识作用*/
				var _this = $(this);
				var text = _this.val();
				var htmlFormat = '<span style="color:#ff6767">'+text+'</span>';
				if(_this.val() === '') {
					_this.parents(".common-picker-menu").find(".trees-menu").show();
					if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".no-data").length !== 0 ) {
						_this.parents(".legacy-oui-typeahead.common-typeahead").find(".no-data").remove();
					}
					if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").length !== 0) {
						_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").remove();
					}
				} else {
					var html = '';
					var props, textstr, reg;
					reg = text;
					reg = new RegExp(reg, 'g');
					_this.parents(".common-picker-menu").find(".trees-menu").hide();
					_this.parents(".common-picker").find(".common-picker-menu.select-control-list").animate({"width": "420px"}, 200);
					for (props in classifyselect) {
						if(props.indexOf(text) !== -1) {
							sign1 = true;
							props = props.replace(reg, htmlFormat);
							html += '<div class="legacy-oui-typeahead-item common-item">'+props+'</div>';
						}
					}
					for(props in classifyselect) {
						for (var i = 0; i < classifyselect[props].length; i ++) {
							if(classifyselect[props][i].indexOf(text) !== -1) {
								sign2 = true;
								textstr = props + ' > '+ classifyselect[props][i];
								textstr = textstr.replace(reg, htmlFormat);
								html += '<div class="legacy-oui-typeahead-item common-item">'+textstr+'</div>';
							}
						}
					}
					if (sign2 || sign1) {
						var htmlMenu = '<div class="legacy-oui-typeahead-menu">'+html+'</div>';
						if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".no-data").length !== 0) {
							_this.parents(".legacy-oui-typeahead.common-typeahead").find(".no-data").remove();
						}
						if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").length !== 0) {
							_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").remove();
						}
						_this.parents(".legacy-oui-typeahead.common-typeahead").append(htmlMenu);
						_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu .legacy-oui-typeahead-item.common-item").eq(0).addClass("blueBK");
						// keyCodeEvents.call(this);
					}
					if( (!sign1) && (!sign2) && _this.val() !== '') {
						var html = '<div class="no-data">暂无数据</div>';
						if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".no-data").length === 0) {
							_this.parents(".legacy-oui-typeahead.common-typeahead").append(html);
						}
						if(_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").length !== 0) {
							_this.parents(".legacy-oui-typeahead.common-typeahead").find(".legacy-oui-typeahead-menu").remove();
						}
					}
				}
			}
		})

		$(".classify-select.common-picker .common-picker-menu.select-control-list").on("click", '.legacy-oui-typeahead-menu', function(event) {
			var event = event || window.event;
			var target = event.target || event.srcElement;
			if(target.nodeName.toLowerCase() === 'div') {
				$(target).parents(".common-picker-menu.select-control-list").siblings(".common-picker-header").find(".short-name").text($(target).text());
				$(target).addClass("blueBK").siblings(".legacy-oui-typeahead-item.common-item.blueBK").removeClass("blueBK");
				$(target).parents(".common-picker-menu.select-control-list").hide();
			}
		})

		$(".classify-select.common-picker .common-picker-menu.select-control-list").on("mouseenter", '.legacy-oui-typeahead-menu .legacy-oui-typeahead-item.common-item', function(event) {
			var event = event || window.event;
			var target = event.target || event.srcElement;
			if(target.nodeName.toLowerCase() === 'div') {
					$(target).addClass("blueBK").siblings(".legacy-oui-typeahead-item.common-item.blueBK").removeClass("blueBK");
			}
		})

		// 上下键
		var keyCodeEvents = function () {
			var _this = $(".classify-select.common-picker .legacy-oui-typeahead-input");
			_this.keydown(function(event) {
				var event = event || window.event;
				// var _this = $(this);
				var li = _this.parents(".legacy-oui-typeahead-input-wrapper").siblings(".legacy-oui-typeahead-menu").find(".legacy-oui-typeahead-item.common-item");
				var index = _this.parents(".legacy-oui-typeahead-input-wrapper").siblings(".legacy-oui-typeahead-menu").find(".legacy-oui-typeahead-item.common-item.blueBK").index();
				if(event.keyCode === 38) {  // 上
					if(index > 0) {
						index -= 1;
					}
					li.eq(index).addClass("blueBK").siblings(".blueBK").removeClass("blueBK");
				}
				if(event.keyCode === 40) {  // 下
					if(index < li.length - 1 ) {
						index += 1;
					}
					li.eq(index).addClass("blueBK").siblings(".blueBK").removeClass("blueBK");
				}
				if(event.keyCode === 13) { // 回车
					_this.parents(".common-picker-menu").siblings(".common-picker-header").find(".short-name").text(li.eq(index).text());
					_this.parents(".common-picker-menu").hide();
					_this.parents(".tree-search-wrapper").siblings(".trees-menu").find(".blueBK").addClass("active").siblings(".active").removeClass("active");
				}
			})
		}
		keyCodeEvents();


			

		// 下拉框 .....start
		// 点击下载  框 
		$(document).click(function(e) {
			$(".select-control .select-control-list").hide();
		});
		$(".select-control-list").click(function(e) {
			e.stopPropagation()
		})
		$(".select-control").click(function(e) {
			e.stopPropagation();
			var _this = $(this);
			if(_this.children(".select-control-list").css("display") === 'block') {
				_this.children(".select-control-list").hide();
			} else {
				$(".select-control").children(".select-control-list").each(function() {
					if(_this.css("display") === 'block') {
						$(".select-control-list").hide();
					}
				})
				_this.children(".select-control-list").show();
			}
		});

	    //  下拉
		$(".select-control-list .ui-selector-item").click(function(e) {
			var _this = $(this);
			_this.addClass("curr").siblings(".curr").removeClass("curr");
			_this.parents(".ui-selector").find(".ui-selector-value").text(_this.find("span").text());
			_this.parents(".select-control-list").hide();
		})
		// 下拉框 .....end		
	})
</script>
</html>
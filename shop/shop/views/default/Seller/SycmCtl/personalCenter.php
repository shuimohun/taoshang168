<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--个人中心-->
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
			<li class="nav-item lf">
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
					<p>个人中心</p>
				</div>
			</div>
			<ul class="menu-list">
				<li class="menu-item lf">
					<ul class="menu-list-inner">
						<li class="menu-item-inner lf curr">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">基础信息</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="menu-item lf">
					<p class="nav-name"><i class="icon"></i>订购信息</p>
					<ul class="menu-list-inner">
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">单店</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="menu-item lf">
					<p class="nav-name"><i class="icon"></i>配置管理</p>
					<ul class="menu-list-inner">
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">目标配置</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">自媒体授权</span>
							</a>
						</li>
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">首页配置</span>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- 基础信息 start -->
	<div class="w-1260 rt switch-wrap ebase-ModernFrame__main">
		<div class="ebase-metaDecorator__root">
			<div class="pagesEnterpriseInfo__root">
				<div class="ebase-Card__root">
					<div class="ebase-Card__headerWrapper">
						<h4 class="ebase-Card__title">基本信息</h4>
						<div class="EnterpriseInfoBaseInfo__header ebase-CardHeader__root orflow">
							<p class="wrap-info wrap-info rt">
								<a class="info-link" target="_blank" href="javascript:;">
									<span>子账号管理</span>
									<i class="oui-icon oui-icon-angleRight angle-right oui-icon-angle-right">></i>
								</a>
							</p>
							<span></span>
						</div>
					</div>
					<div>
						<div class="ebase-CardContent__root EnterpriseInfoBaseInfo__content">
							<ul class="EnterpriseInfoBaseInfo__itemsWrap clearfix">
								<li class="EnterpriseInfoBaseInfo__item EnterpriseInfoBaseInfo__itemTitle ">
									<div class="EnterpriseInfoBaseInfo__item-name">企业名称</div>
									<div class="EnterpriseInfoBaseInfo__value">
										<span class="hide">
											<input type="text" class="EnterpriseInfoBaseInfo__editInput" value="淘尚168商城" placeholder="请输入企业名称">
											<i class="oui-icon oui-icon-checkbox-dot"></i>
											<i class="oui-icon oui-icon-del"></i>
										</span>
										<!-- <span class="" style="position: relative;"><span>淘尚168商城</span>
											<i class="oui-icon oui-icon-edit"></i>
										</span> -->
									</div>
								</li>
								<li class="EnterpriseInfoBaseInfo__item ">
									<div class="EnterpriseInfoBaseInfo__item-name">子账号数</div>
									<div class="EnterpriseInfoBaseInfo__item-value">0</div>
								</li>
								<li class="EnterpriseInfoBaseInfo__item ">
									<div class="EnterpriseInfoBaseInfo__item-name">已绑定店铺数</div>
									<div class="EnterpriseInfoBaseInfo__item-value">0</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="EnterpriseInfoShops__root ebase-Card__root">
					<div class="ebase-Card__headerWrapper">
						<h4 class="ebase-Card__title">主动绑定</h4>
						<div class="clearfix ebase-CardHeader__root">
							<div class="EnterpriseInfoShops__searchShop rt EnterpriseInfoShops__searchShop ">
								<div class="searchWrap" style="display: none;">
									<div class="ebase-ElasticSearch__root clearfix undefined">
										<div class="ebase-ElasticSearch__elasticSearch ebase-ElasticSearch__closeSearch">
											<input type="text" class="oui-search-input" placeholder="输入关键字" value="">
											<i class="oui-icon oui-icon-del search-del empty"></i>
											<i class="oui-icon oui-icon-search click search-icon"></i>
										</div>
									</div>
								</div>
								<a class="EnterpriseInfoShops__managerShop " href="javascript:;" target="_blank" style="position: relative;">
									<span>店铺绑定管理</span>
									<i class="oui-icon oui-icon-angleRight angle-right oui-icon-angle-right">></i>
								</a>
							</div>
							<span></span>
						</div>
					</div>
					<div>
						<div class="ebase-CardContent__root EnterpriseInfoShops__infoContent">
							<div class="no-data-message">
								<div class="ui-message-empty">
									<p class="ui-message-content">
										<span class="noromal">
											<i class="icon"></i>
										</span>
										<span>数据为空</span>
									</p>
								</div>
							</div>
							<div class="clearfix EnterpriseInfoShops__noRollback">
								<p class="rt desc">亲，当天完成的绑定，多店汇总的数据第二天才能看到哦</p>
							</div>
						</div>
					</div>
				</div>
				<div class="ebase-Card__root">
					<div class="ebase-Card__headerWrapper">
						<h4 class="ebase-Card__title">被动绑定</h4>
						<div class="clearfix ebase-CardHeader__root">
							<a class="EnterpriseInfoShops__managerShop rt" href="javascript:;" target="_blank"><span>店铺绑定管理</span>
								<i class="oui-icon oui-icon-angleRight angle-right oui-icon-angle-right"></i>
							</a>
							<span></span>
						</div>
					</div>
					<div>
						<div class="ebase-CardContent__root">
							<div class="ebase-Message__root ebase-Message__whiteMask">
								<div class="no-data-message">
									<div class="ui-message-empty">
										<p class="ui-message-content">
											<span class="noromal">
												<i class="icon"></i>
											</span>
											<span>数据为空</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 基础信息 end -->

	<!-- 单店 start -->
	<div class="w-1260 rt switch-wrap ebase-ModernFrame__main">
		<div class="ebase-metaDecorator__root">
			<div class="pagesProductOrder__root">
				<div class="pagesProductOrder__titleCard ebase-Card__root">
					<div class="ebase-Card__headerWrapper">
						<h4 class="ebase-Card__title"></h4>
						<div class="ebase-CardHeader__root">
							<div class=" ebase-Switch__root op-ebase-switch">
								<span class="ebase-Switch__item ebase-Switch__activeItem">产品订购</span>
								<span class="ebase-Switch__item">我的订购</span>
							</div>
							<a class="pagesProductOrder__linkText pagesProductOrder__linkText rt" href="javascript:;" target="_blank">去开发票</a>
							<a class="pagesProductOrder__linkText pagesProductOrder__linkText rt" href="javascript:;" target="_blank">开票规则</a>
							<span></span>
						</div>
					</div>
						<!-- switch1 -->
					<div class="ProductOrderProductList__cardsContainer">
						<ul>
							<li class="ProductOrderProductList__productItemContainer">
								<div class="ProductOrderProductCard__cardContainer">
									<div>
										<div class="ProductOrderWidget__widget">
											<div class="ProductOrderWidget__widgetTop ProductOrderWidget__topPurchased"></div>
											<div class="ProductOrderWidget__widgetContent ProductOrderWidget__contentPurchased">已订购</div>
											<div class="ProductOrderWidget__widgetRightTop ProductOrderWidget__rightTopPurchased"></div>
											<div class="ProductOrderWidget__widgetRightBottom ProductOrderWidget__rightBottomPurchased"></div>
										</div>
										<div class="ProductOrderProductCard__logoHeader" style="background-color: rgb(0, 136, 254);">
											<i class="oui-icon oui-icon-shop icon ProductOrderProductCard__logoIcon"></i>
										</div>
										<a class="ProductOrderProductCard__title" href="javascript:;" target="_blank">标准包</a>
										<div class="ProductOrderProductCard__content">淘宝店铺经营的必备数据</div>
										<div class="ProductOrderProductCard__priceContainer">
											<span>￥<span class="ProductOrderProductCard__price">0</span>/年起 </span>
										</div>
										<div class="ProductOrderProductCard__actionGroup">
											<div><a class="ProductOrderProductList__useLink" href="javascript:;">立即使用</a>
												<a href="javascript:void(0)" class="oui-btn oui-btn-md oui-btn-primary ProductOrderProductList__purchaseButton">续费</a>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="ProductOrderProductList__productItemContainer">
								<div class="ProductOrderProductCard__cardContainer">
									<div>
										<div class="ProductOrderProductCard__logoHeader" style="background-color: rgb(255, 188, 47);"><i class="oui-icon oui-icon-jzqb icon ProductOrderProductCard__logoIcon"></i>
										</div>
										<a class="ProductOrderProductCard__title" href="javascript:;" target="_blank">竞争情报</a>
										<div class="ProductOrderProductCard__content">精准的竞争情报工具</div>
										<div class="ProductOrderProductCard__priceContainer">
											<span>￥<span class="ProductOrderProductCard__price">3288</span>/年起 </span>
										</div>
										<div class="ProductOrderProductCard__actionGroup">
											<div><a href="javascript:void(0)" class="oui-btn oui-btn-md oui-btn-primary ProductOrderProductList__singlePurchaseButton">订购</a></div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
						<!-- switch2 -->
					<div class="ProductOrderProductList__cardsContainer" style="display: none;">
						<span style="position: absolute;font-size: 12px;top:-44px;right:165px;cursor: pointer;" class="order-record">订单记录</span>
						<ul>
							<li class="ProductOrderProductList__productItemContainer">
								<div class="ProductOrderProductCard__cardContainer">
									<div>
										<!-- <div class="ProductOrderWidget__widget">
											<div class="ProductOrderWidget__widgetTop ProductOrderWidget__topPurchased"></div>
											<div class="ProductOrderWidget__widgetContent ProductOrderWidget__contentPurchased">已订购</div>
											<div class="ProductOrderWidget__widgetRightTop ProductOrderWidget__rightTopPurchased"></div>
											<div class="ProductOrderWidget__widgetRightBottom ProductOrderWidget__rightBottomPurchased"></div>
										</div> -->
										<div class="ProductOrderProductCard__logoHeader" style="background-color: rgb(0, 136, 254);">
											<i class="oui-icon oui-icon-shop icon ProductOrderProductCard__logoIcon"></i>
										</div>
										<a class="ProductOrderProductCard__title" href="javascript:;" target="_blank">标准包</a>
										<div class="ProductOrderProductCard__orderContent"><div>2017-06-20 至 2019-06-20</div></div>
										<div class="ProductOrderProductCard__priceContainer">
											<span>￥<span class="ProductOrderProductCard__price">0</span>/年起 </span>
										</div>
										<div class="ProductOrderProductCard__actionGroup">
											<div><a class="ProductOrderProductList__useLink" href="javascript:;">立即使用</a>
												<a href="javascript:void(0)" class="oui-btn oui-btn-md oui-btn-primary ProductOrderProductList__purchaseButton">续费</a>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 单店 end -->

	<!-- 目标配置 start -->
	<div class="w-1260 rt switch-wrap ebase-ModernFrame__main">
		<div class="ebase-metaDecorator__root">
 			<div class="pagesTargetConfig__root">
				<div class="pagesTargetConfig__head">
					<span class="oui-tabswitch pagesTargetConfig__tab">
						<span class="oui-tabswitch-item oui-tabswitch-item-active">业绩目标配置</span>
						<span class="oui-tabswitch-item">流量目标配置</span>
						<span class="oui-tabswitch-item">推广预算配置</span>
					</span>
					<button class="oui-btn oui-btn-md oui-btn-hollow pagesTargetConfig__add"><i class="oui-icon oui-icon-plus" style="color: #2062e6;font-size: 14px;">+</i>新增目标</button>
				</div>
				<!-- switch1 -->
				<div class="pagesTargetConfig__content">
					<div class="pagesTargetConfig__target">
						<div class="pagesTargetConfig__year">
							<div class="pagesTargetConfig__type">2017年业绩目标</div>
							<div class="pagesTargetConfig__amount">
								<span class="ebase-human-number">227.53<span class="ebase-human-number-unit">万</span></span>
							</div>
						</div>
						<div class="pagesTargetConfig__detail">
							<div class="header">
								<h4>月业绩目标</h4>
								<div class="pagesTargetConfig__actions"><a href="#" class="edit">编辑</a><a href="#" class="del">删除</a></div>
							</div>
							<div class="pagesTargetConfig__content">
								<div class="pagesTargetConfig__cell">
									<span class="pagesTargetConfig__month">1月</span><br><span>12.00</span>
								</div>
								<div class="pagesTargetConfig__cell">
									<span class="pagesTargetConfig__month">2月</span><br><span>51.00</span>
								</div>
								<div class="pagesTargetConfig__cell"><span class="pagesTargetConfig__month">3月</span><br><span>61.00</span></div>
								<div class="pagesTargetConfig__cell"><span class="pagesTargetConfig__month">4月</span><br><span>71.00</span></div>
								<div class="pagesTargetConfig__cell"><span class="pagesTargetConfig__month">5月</span><br><span>81.00</span></div>
								<div class="pagesTargetConfig__cell"><span class="pagesTargetConfig__month">6月</span><br><span>13.00</span></div>
								<div class="pagesTargetConfig__cell"><span class="pagesTargetConfig__month">7月</span><br><span>51.00</span></div>
								<div class="pagesTargetConfig__cell"><span class="pagesTargetConfig__month">8月</span><br><span>5,000.00</span></div>
								<div class="pagesTargetConfig__cell"><span class="pagesTargetConfig__month">9月</span><br><span>500,000.00</span></div>
								<div class="pagesTargetConfig__cell"><span class="pagesTargetConfig__month">10月</span><br><span>700,000.00</span></div>
								<div class="pagesTargetConfig__cell"><span class="pagesTargetConfig__month">11月</span><br><span>1,000,000.00</span></div>
								<div class="pagesTargetConfig__cell"><span class="pagesTargetConfig__month">12月</span><br><span>70,000.00</span></div>
							</div>
						</div>
					</div>
				</div>
				<!-- switch2 -->
				<div class="pagesTargetConfig__content" style="display: none;">
					<div class="no-data-message">
						<div class="ui-message-empty">
							<p class="ui-message-content">
								<span class="noromal">
									<i class="icon"></i>
								</span>
								<span>暂无数据<span>
							</p>
						</div>
					</div>
				</div>
				<!-- switch3 -->
				<div class="pagesTargetConfig__content" style="display: none;">
					<div class="no-data-message">
						<div class="ui-message-empty">
							<p class="ui-message-content">
								<span class="noromal">
									<i class="icon"></i>
								</span>
								<span>暂无数据<span>
							</p>
						</div>
					</div>
				</div>
				<!-- <div></div> -->
			</div>
		</div>
	</div>
	<!-- 目标配置 end -->

	<!-- 自媒体授权 start -->
	<div class="w-1260 rt switch-wrap ebase-ModernFrame__main">
		<div class="ebase-metaDecorator__root">
			<div>
				<div class="ebase-Card__root">
					<div class="ebase-Card__headerWrapper">
						<h4 class="ebase-Card__title">授权</h4>
						<div class="ebase-CardHeader__root">
							<span></span>
						</div>
					</div>
					<div>
						<div class="ebase-CardContent__root">
							<div class="wrapper" style="font-size: 12px;">
								<p class="CpPermissionPermissionInfo__statusWrapper">
									<span class="CpPermissionPermissionInfo__statusGroup">
										<span class="name">产品权限：</span>
										<span class="CpPermissionPermissionInfo__status">有权限</span>
									</span>
									<span class="CpPermissionPermissionInfo__statusGroup">
										<span class="name">签署状态：</span>
										<span class="CpPermissionPermissionInfo__status">已取消，下月生效</span>
									</span>
								</p>
								<div class="permission-report">
									<div class="CpPermissionPermissionInfo__desc">
										<p>
											<span>生意参谋自媒体观测站为了帮助店铺更好地衡量自媒体的内容变现情况，将为</span>
											<span>您提供微博、优酷等平台的自媒体为店铺引流相关数据，同时在获得您的授</span>
											<span>权后为自媒体提供他们为您的店铺引流相关数据。</span>
										</p>
										<p class="CpPermissionPermissionInfo__emphasis">开通范围：您愿意向微博、优酷等平台的自媒体提供他们为您的店铺引流相关数据，请您仔细阅读授权书并同意授权。</p>
										<p class="CpPermissionPermissionInfo__emphasis">授权与取消：您同意授权协议后，授权立即生效；已授权情况下取消授权，取消授权下月生效。您可根据需求重新签署、变更授权。</p>
									</div>
									<div class="CpPermissionPermissionInfo__report">
										<p>在接受本授权书之前，请您（以下可称为“授权人”）仔细阅读本授权书的全部内容（特别是以<em>粗体下划线</em>标注的内容）。如果您对本授权书的条款有疑问，或者无法准确理解条款内容的，请不要进行后续操作。</p>
										<br>
										<p class="CpPermissionPermissionInfo__reportTitle">授权书</p>
										<br>
										<p>
											<span>现授权人（淘宝账户名：【</span>
											<span>财龙外贸服装</span>
											<span>】）同意向来自微博、优酷、UC头条、淘宝头条等平台的自媒体（以下</span>
											<span>简称“被授权人”）提供授权人的店铺通过被授权人发布的内容（内容展现形式包</span>
											<span>括但不限于文字、图片、音视频等）引导交易相关数据（包括但不</span>
											<span>限于引导下单买家数、引导支付买家数、引导下单金额、引导支付金额等数据，以下合</span>
											<span>称“授权数据”），以便被授权人了解为授权人店铺引流的情况、评估自己发布的、与店</span>
											<span>铺和/或商品直接相关的内容的质量水平，授权数据仅限于被授权人自身在其订购的生意</span>
											<span>参谋相关版本中用于了解为授权人店铺引流情况、评估发布内容的质量水平之用。</span>
										</p>
										<br>
										<p>
											<em>因授权人没有能力将授权数据以可用的方式提供给被授权人，授权人在此不可撤销地</em>
											<em>授权淘宝（中国）软件有限公司（以下简称“淘宝”）将授权数据及相关加工、分析</em>
											<em>结果展示在被授权人开通的生意参谋相关版本的功能模块中。</em>
										</p>
										<br>
										<p>
											<span>授权人保证其有合法权利向被授权人进行相应的数据授权，并保证数据来源合法、不侵</span>
											<span>犯他人合法权益（包括但不限于个人隐私权等）。</span>
										</p>
										<br>
										<p>
											<em>授权人同意淘宝按照本授权书进行操作的一切风险及责任由授权人自行承担。淘宝不</em>
											<em>对：任何因授权行为之履行；数据披露；被授权人使用授权数据；以及数据内容的合</em>
											<em>法性、有效性、准确性、可适用性等承担任何承诺、保证、担保、赔偿等法律责任，</em>
											<em>授权人也不会在诉讼、仲裁或其他任何形式的争议解决中向淘宝主张权利，该等争</em>
											<em>议将由授权人与被授权人自行协商或通过司法途径解决。</em>
										</p>
										<br>
										<p>
											<em>本授权书一经确认即生效，自授权人解除或取消授权的次月首日失效！</em>
										</p>
										<br>
										<p>特此授权！</p>
									</div>
								</div>
								<div class="CpPermissionPermissionInfo__actions">
									<div class="CpPermissionPermissionInfo__btns">
										<div>
											<button class="oui-btn oui-btn-md oui-btn-hollow CpPermissionPermissionInfo__cancel">不同意</button>
											<button class="oui-btn oui-btn-md oui-btn-primary CpPermissionPermissionInfo__authoriz">同意</button>
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
	<!-- 自媒体授权 end -->

	<!-- 首页配置 start -->
	<div class="w-1260 rt switch-wrap ebase-ModernFrame__main">
		<div class="ebase-metaDecorator__root">
			<div class="pagesPortalConfig__root">
				<div class="pagesPortalConfig__portalConfig ebase-Card__root">
					<div class="ebase-Card__headerWrapper">
						<h4 class="ebase-Card__title">首页配置</h4>
						<div class="ebase-CardHeader__root">
							<div class="pagesPortalConfig__switch lf ebase-Switch__root op-ebase-switch">
								<span class="ebase-Switch__item ebase-Switch__activeItem">单店版</span>
								<span class="ebase-Switch__item">多店版</span>
							</div>
							<span></span>
						</div>
					</div>
					<div>
						<div class="ebase-CardContent__root">
							<div class="PortalConfigTemplateManager__templateManager">
								<div class="clearfix">
									<div class=" clearfix PortalConfigTemplateManager__template PortalConfigTemplateManager__selected">
										<div class="PortalConfigTemplateManager__header">
											<span class="PortalConfigTemplateManager__name">默认</span>
											<span class="ebase-FontIcon__root" style="color: rgb(255, 255, 255); background: rgb(23, 139, 250); margin-left: 8px;">官</span>
											<span class="ebase-FontIcon__root" data-ebase="FontIcon" style="color: rgb(255, 255, 255); background: rgb(0, 196, 159); margin-left: 8px;">使用中</span>
										</div>
										<div class="PortalConfigTemplateManager__desc"></div>
										<div class="PortalConfigTemplateManager__operators"></div>
									</div>
								</div>
							</div>
							<div class="PortalConfigWidgetManager__widgetManager">
								<div class="dt-dnd clearfix">
									<div class="title">编辑 默认模板</div>
									<div>
										<div class="target-widgets lf">
											<div class="card-num">已添加（<span class="num">14</span>张卡片）</div>
											<div class="target-container">
												<div class="container-header"></div>
												<div class="container-content clearfix">
													<div class="left-column ">
														<div>
															<div class="top">
																<div style="position: relative;">
																	<div class="ewidget ewidget-target" draggable="true">
																		<div class="widget">
																			<div class="name">实时指标</div>
																			<a href="javascript:;" class="remove">移除</a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="ewidget date-widget locked">
																<div class="title">时间控件</div>
																<i class="oui-icon oui-icon-lock"></i>
															</div>
															<div class="bottom" >
																<div style="position: relative;">
																	<div class="ewidget ewidget-target" draggable="true">
																		<div class="widget">
																			<div class="name">核心指标</div>
																			<a href="javascript:;" class="remove">移除</a>
																		</div>
																	</div>
																	<div class="ewidget ewidget-target" draggable="true">
																		<div class="widget">
																			<div class="name">流量分析</div>
																			<a href="javascript:;" class="remove">移除</a>
																		</div>
																	</div>
																	<div class="ewidget ewidget-target" draggable="true">
																		<div class="widget">
																			<div class="name">商品分析</div>
																			<a href="javascript:;" class="remove">移除</a>
																		</div>
																	</div>
																	<div class="ewidget ewidget-target" draggable="true">
																		<div class="widget">
																			<div class="name">售后服务分析</div>
																			<a href="javascript:;" class="remove">移除</a>
																		</div>
																	</div>
																	<div class="ewidget ewidget-target" draggable="true">
																		<div class="widget">
																			<div class="name">物流分析</div>
																			<a href="javascript:;" class="remove">移除</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="right-column lf">
														<div style="position: relative;">
															<div class="ewidget ewidget-target locked" draggable="true">
																<div class="widget">
																	<div class="name">公告</div>
																	<i class="oui-icon oui-icon-lock"></i>
																</div>
															</div>
															<div class="ewidget ewidget-target" draggable="true">
																<div class="widget">
																	<div class="name">行业排行</div>
																	<a href="javascript:;" class="remove">移除</a>
																</div>
															</div>
															<div class="ewidget ewidget-target" draggable="true">
																<div class="widget">
																	<div class="name">商品访客榜TOP10</div>
																	<a href="javascript:;" class="remove">移除</a>
																</div>
															</div>
															<div class="ewidget ewidget-target" draggable="true">
																<div class="widget">
																	<div class="name">入店关键词TOP10</div>
																	<a href="javascript:;" class="remove">移除</a>
																</div>
															</div>
															<div class="ewidget ewidget-target" draggable="true">
																<div class="widget">
																	<div class="name">购买流失</div>
																	<a href="javascript:;" class="remove">移除</a>
																</div>
															</div>
															<div class="ewidget ewidget-target" draggable="true">
																<div class="widget">
																	<div class="name">财务概况</div>
																	<a href="javascript:;" class="remove">移除</a>
																</div>
															</div>
															<div class="ewidget ewidget-target" draggable="true">
																<div class="widget">
																	<div class="name">交易构成</div>
																	<a href="javascript:;" class="remove">移除</a>
																</div>
															</div>
															<div class="ewidget ewidget-target" draggable="true">
																<div class="widget">
																	<div class="name">行业榜单TOP5</div>
																	<a href="javascript:;" class="remove">移除</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="lf source-widgets">
											<div class="card-num">可添加（<span class="num">3</span>张卡片）</div>
											<div class="source-widgets-container">
												<div class="tabs">
													<span class="label active">全部</span>
												</div>
												<div class="widgets clearfix">
													<div class="left-widgets lf">
														<div style="position: relative;">
															<div class="ewidget ewidget-source" draggable="true" style="" id="right-target1">
																<div class="widget">
																	<div class="widget-header clearfix">
																		<div class="name pull-left">核心指标</div>
																	</div>
																	<div class="widget-content">
																		<img src="https://img.alicdn.com/tps/TB1cxvhKFXXXXbuXVXXXXXXXXXX-360-120.png">
																		<div class="widget-mask"></div>
																		<div class="hovered-block">
																			<div class="rt operators">
																				<a href="javascript:;" class="detail">详情</a>
																				<a href="javascript:;" class="add">添加</a>
																			</div>
																			<div class="desc"></div>
																			<div class="user-count">8,220,132人在使用</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="ewidget ewidget-source" draggable="true" style="">
																<div class="widget">
																	<div class="widget-header clearfix">
																		<div class="name pull-left">实时指标</div>
																	</div>
																	<div class="widget-content">
																		<img src="https://img.alicdn.com/tps/TB1IEfXKFXXXXbgXVXXXXXXXXXX-360-120.png">
																		<div class="widget-mask"></div>
																		<div class="hovered-block">
																			<div class="rt operators">
																				<a href="javascript:;" class="detail">详情</a>
																				<a href="javascript:;" class="add">添加</a>
																			</div>
																			<div class="desc"></div>
																			<div class="user-count">8,220,125人在使用</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="ewidget ewidget-source" draggable="true" style="">
																<div class="widget">
																	<div class="widget-header clearfix">
																		<div class="name pull-left">流量分析</div>
																	</div>
																	<div class="widget-content">
																		<img src="https://img.alicdn.com/tps/TB1LELmKFXXXXa4XFXXXXXXXXXX-360-120.png">
																		<div class="widget-mask"></div>
																		<div class="hovered-block">
																			<div class="rt operators">
																				<a href="javascript:;" class="detail">详情</a>
																				<a href="javascript:;" class="add">添加</a>
																			</div>
																			<div class="desc"></div>
																			<div class="user-count">8,220,101人在使用</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="ewidget ewidget-source" draggable="true" style="">
																<div class="widget">
																	<div class="widget-header clearfix">
																		<div class="name pull-left">售后服务分析</div>
																	</div>
																	<div class="widget-content">
																		<img src="https://img.alicdn.com/tps/TB16fPeKFXXXXcHXVXXXXXXXXXX-360-120.png">
																		<div class="widget-mask"></div>
																		<div class="hovered-block">
																			<div class="rt operators">
																				<a href="javascript:;" class="detail">详情</a>
																				<a href="javascript:;" class="add">添加</a>
																			</div>
																			<div class="desc"></div>
																			<div class="user-count">8,219,962人在使用</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="right-widgets lf">
														<div style="position: relative;">
															<div class="ewidget ewidget-source" draggable="true">
																<div class="widget">
																	<div class="widget-header clearfix">
																		<div class="name lf">竞店榜单</div>
																	</div>
																	<div class="widget-content">
																		<img src="https://img.alicdn.com/tps/TB1SRLwKFXXXXb_XpXXXXXXXXXX-180-120.png" alt="竞店榜单">
																		<div class="widget-mask"></div>
																		<div class="hovered-block">
																			<div class="rt operators">
																				<a href="javascript:;" class="detail">详情</a>
																				<a href="javascript:;" class="add">添加</a>
																			</div>
																			<div class="desc">测试</div>
																			<div class="user-count">14,563人在使用</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="ewidget ewidget-source" draggable="true">
																<div class="widget">
																	<div class="widget-header clearfix">
																		<div class="name lf">店铺流量构成</div>
																	</div>
																	<div class="widget-content">
																		<img src="https://img.alicdn.com/tps/TB1OCLlKFXXXXcHXFXXXXXXXXXX-180-120.png" alt="店铺流量构成">
																		<div class="widget-mask"></div>
																		<div class="hovered-block">
																			<div class="rt operators">
																				<a href="javascript:;" class="detail">详情</a>
																				<a href="javascript:;" class="add">添加</a>
																			</div>
																			<div class="desc"></div>
																			<div class="user-count">16,419人在使用</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="ewidget ewidget-source" draggable="true">
																<div class="widget">
																	<div class="widget-header clearfix">
																		<div class="name lf">运营能力分析</div>
																	</div>
																	<div class="widget-content">
																		<img src="https://img.alicdn.com/tps/TB1YV_nPVXXXXaLXVXXXXXXXXXX-180-120.png" alt="运营能力分析">
																		<div class="widget-mask"></div>
																		<div class="hovered-block">
																			<div class="rt operators">
																				<a href="javascript:;" class="detail">详情</a>
																				<a href="javascript:;" class="add">添加</a>
																			</div>
																			<div class="desc">仅天猫国际商家及部分天猫商家可用，其他商家请勿添加</div>
																			<div class="user-count">9,108人在使用</div>
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
									<div class="dt-dnd-operators rt"><a href="javascript:;" class="reset">重置</a><button class="oui-btn oui-btn-md oui-btn-primary save">另存为</button></div>
								</div>
							</div>
							<div class="descs">
								<div class="title">配置说明：</div>
								<div class="desc">1. 左边为已选的卡片在首页的预览，您可以将不需要的卡片删除；右边为可添加的卡片库，点击“添加”即添加到左侧；</div>
								<div class="desc">2. 拖拽左边已添加的卡片，可以调整上下显示顺序；</div>
								<div class="desc">3. 具有选择时间功能的大卡片只能放在时间控件下方。</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 首页配置 end -->
</div>


<!-- 订单记录 pop -->
<div class="mask-dialog order-dialog order-record-dialog">
	<div class="oui-dialog-locator">
		<div class="oui-dialog-container">
			<div class="oui-dialog-header">
				<i class="oui-icon oui-icon-times oui-dialog-close">x</i>
				<p class="oui-dialog-title"><span>订单记录</span><a class="ProductOrderRecordsDialog__linkText" href="javascript:;" target="_blank">去开发票</a></p>
			</div>
			<div class="oui-dialog-content">
				<table class="ProductOrderRecordsDialog__listTable">
					<thead>
						<tr>
							<th class="ProductOrderRecordsDialog__colName">全部功能</th>
							<th class="ProductOrderRecordsDialog__colKind">全部分类</th>
							<th class="ProductOrderRecordsDialog__colOrderKind">订购分类</th>
							<th class="ProductOrderRecordsDialog__colOrderTime">订单产生时间</th>
							<th class="ProductOrderRecordsDialog__colStartDate">服务开始时间</th>
							<th class="ProductOrderRecordsDialog__colEndDate">服务结束时间</th>
							<th class="ProductOrderRecordsDialog__colPeriod">全部周期</th>
							<th class="ProductOrderRecordsDialog__colPrice">费用</th>
							<th class="ProductOrderRecordsDialog__colStatus">全部状态</th>
							<th class="ProductOrderRecordsDialog__colOperation">操作</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="ProductOrderRecordsDialog__colName">标准包</td>
							<td class="ProductOrderRecordsDialog__colKind">标准</td>
							<td class="ProductOrderRecordsDialog__colOrderKind">订购</td>
							<td class="ProductOrderRecordsDialog__colOrderTime">2017-10-19 11:07:50</td>
							<td class="ProductOrderRecordsDialog__colStartDate">2018-06-20</td>
							<td class="ProductOrderRecordsDialog__colEndDate">2019-06-20</td>
							<td class="ProductOrderRecordsDialog__colPeriod">一年</td>
							<td class="ProductOrderRecordsDialog__colPrice">0元</td>
							<td class="ProductOrderRecordsDialog__colStatus">未开始</td>
							<td class="ProductOrderRecordsDialog__colOperation">
								<div><button class="oui-btn oui-btn-md oui-btn-blank">订购</button></div>
							</td>
						</tr>
						<tr>
							<td class="ProductOrderRecordsDialog__colName">标准包</td>
							<td class="ProductOrderRecordsDialog__colKind">标准</td>
							<td class="ProductOrderRecordsDialog__colOrderKind">订购</td>
							<td class="ProductOrderRecordsDialog__colOrderTime">2017-06-20 19:29:53</td>
							<td class="ProductOrderRecordsDialog__colStartDate">2017-06-20</td>
							<td class="ProductOrderRecordsDialog__colEndDate">2018-06-20</td>
							<td class="ProductOrderRecordsDialog__colPeriod">一年</td>
							<td class="ProductOrderRecordsDialog__colPrice">0元</td>
							<td class="ProductOrderRecordsDialog__colStatus">使用中</td>
							<td class="ProductOrderRecordsDialog__colOperation">
								<div><button class="oui-btn oui-btn-md oui-btn-blank">订购</button></div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- 订购详情 pop -->
<div class="mask-dialog order-dialog order-detail-dialog">
	<div class="oui-dialog-locator">
		<div class="oui-dialog-container">
			<div class="oui-dialog-header"><i class="oui-icon oui-icon-times oui-dialog-close">x</i><h4 class="oui-dialog-title">订购详情</h4></div>
			<div class="oui-dialog-content">
				<div class="ProductOrderRenewDialog__containerNoBorder">
					<div class="ProductOrderRenewDialog__leftTitle">价格</div>
					<div class="ProductOrderRenewDialog__rightArea">
						<ul class="ProductOrderRenewDialog__list">
							<li class="ProductOrderRenewDialog__listItem ProductOrderRenewDialog__active">
								<span>￥<span class="ProductOrderRenewDialog__price">0</span> /年</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="ProductOrderRenewDialog__containerNoBorder">
					<div class="ProductOrderRenewDialog__leftTitle">总价</div>
					<div class="ProductOrderRenewDialog__rightArea">
						<div class="ProductOrderRenewDialog__list">￥<span class="ProductOrderRenewDialog__price">0</span></div>
					</div>
				</div>
				<div class="ProductOrderRenewDialog__actionContainer">
					<button class="oui-btn oui-btn-md oui-btn-hollow ProductOrderRenewDialog__cancelButton">取消</button>
					<button class="oui-btn oui-btn-md oui-btn-primary ProductOrderRenewDialog__confirmButton">确定</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 新增业绩目标 pop -->
<div class="mask-dialog order-dialog performance-objectives-dialog">
	<div class="oui-dialog-locator">
		<div class="oui-dialog-container">
			<div class="oui-dialog-header">
				<i class="oui-icon oui-icon-times oui-dialog-close">x</i>
				<div class="oui-card">
					<div class="oui-card-header-wrapper">
						<h4 class="oui-card-title">新增业绩目标</h4>
						<div class="oui-card-header">
							<span></span>
						</div>
					</div>
				</div>
			</div>
			<div class="oui-dialog-content">
				<div>
					<p class="TargetConfigTargetDetail__trend">增长幅度
						<span class="TargetConfigTargetDetail__input">
							<input type="text" value=""> %
						</span>
					</p>
					<div class="TargetConfigTargetDetail__trend">选择年份
						<div class="select-control ui-selector ">
							<a href="javascript:;">
								<span class="ui-selector-value">2017</span>
								<span class="caret icon"></span>
							</a>
							<ul class="ui-selector-list select-control-list" style="display: none;">
								<li class="ui-selector-item curr">
									<span>2017</span>
								</li>
								<li class="ui-selector-item">
									<span>2018</span>
								</li>
							</ul>
						</div>
					</div>

					<div class="ebase-Table__root">
						<table class="ebase-Table__table" style="width: 100%;">
							<thead class="ebase-Table__thead">
								<tr>
									<th class="ebase-Table__th col-0 col-index  undefined" style="width: 150px; text-align: left;">全年</th>
									<th class="ebase-Table__th col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">2016年</th>
									<th class="ebase-Table__th col-2 col-amt  undefined" style="text-align: right;">2017年</th>
								</tr>
							</thead>
							<tbody>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">1 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;"><input type="text" class="TargetConfigTargetDetail__newTarget" value="0"></td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">2 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">3 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">4 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">5 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">6 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">7 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">8 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">9 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">10 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">11 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">12 月</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
								<tr class="ebase-Table__tbodyTr">
									<td class="ebase-Table__td col-0 col-index  undefined" style="width: 150px; text-align: left;">合计</td>
									<td class="ebase-Table__td col-1 col-preYearAmt  undefined" style="width: 160px; text-align: left;">0</td>
									<td class="ebase-Table__td col-2 col-amt  undefined" style="text-align: right;">
										<input type="text" disabled="" class="TargetConfigTargetDetail__newTarget" value="0">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="oui-dialog-actions">
				<div class="TargetConfigTargetDetail__actions">
					<button class="oui-btn oui-btn-md oui-btn-hollow">取消</button><button class="oui-btn oui-btn-md oui-btn-primary">确定</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>

<script type="text/javascript">
	$(function() {
		// 点击 导航左侧
		$(".switch-wrap").eq(0).show();
		$(".nav .menu-list .menu-item-inner").click(function(){
			var _this = $(this);
			var parentIndex = _this.parents(".menu-list-inner").parents(".menu-item").index();
			var lengthLi = 0;
			for(var i=0;i<parentIndex;i++){
				lengthLi += $(".menu-item").eq(i).children(".menu-list-inner").children(".menu-item-inner").length;
			}
			var index = _this.index();
			_this.addClass("curr").siblings(".curr").removeClass("curr");
			_this.parents(".menu-list-inner").parents(".menu-item").siblings(".menu-item").children(".menu-list-inner").children(".menu-item-inner").removeClass("curr");
			$(".switch-wrap").hide();
			$(".switch-wrap").eq(index + lengthLi).show();
		})

		// 单店  start
		$(".pagesProductOrder__titleCard.ebase-Card__root .ebase-Switch__root.op-ebase-switch span.ebase-Switch__item").click(function() {
			var _this = $(this);
			_this.addClass("ebase-Switch__activeItem").siblings(".ebase-Switch__activeItem").removeClass("ebase-Switch__activeItem");
			var index = _this.index();
			_this.parents('.ebase-Card__headerWrapper').siblings(".ProductOrderProductList__cardsContainer").hide().eq(index).show();
		})
		$(".order-record").click(function() {
			$(".mask-dialog.order-record-dialog").fadeIn(500);
		})
		$(".mask-dialog.order-dialog").on("click", ".oui-dialog-close", function() {
			$(this).parents(".mask-dialog.order-dialog").hide();
		})
		$(".mask-dialog.order-record-dialog .ProductOrderRecordsDialog__colOperation, .ProductOrderProductList__cardsContainer li .ProductOrderProductList__purchaseButton, .ProductOrderProductList__cardsContainer li .ProductOrderProductList__singlePurchaseButton").click(function() {
			$(".mask-dialog.order-dialog.order-record-dialog").hide();
			$(".mask-dialog.order-dialog.order-detail-dialog").fadeIn(500);
		})
		// 单店  end

		// 目标配置
		$(".ebase-ModernFrame__main .pagesTargetConfig__head .oui-tabswitch-item").click(function() {
			var _this = $(this);
			_this.addClass("oui-tabswitch-item-active").siblings(".oui-tabswitch-item-active").removeClass("oui-tabswitch-item-active");
			var index = _this.index();
			_this.parents('.pagesTargetConfig__head').siblings(".pagesTargetConfig__content").hide().eq(index).show();

		})
		$(".ebase-ModernFrame__main .pagesTargetConfig__add, .ebase-ModernFrame__main .edit").click(function() {
			$(".mask-dialog.performance-objectives-dialog").fadeIn(500);
		})
		// 首页配置
		$(".pagesPortalConfig__portalConfig").on("mouseenter", ".source-widgets-container .ewidget.ewidget-source", function() {
			$(this).find(".widget-mask, .hovered-block, .operators").show();
		})
		$(".pagesPortalConfig__portalConfig").on("mouseleave", ".source-widgets-container .ewidget.ewidget-source", function() {
			$(this).find(".widget-mask, .hovered-block, .operators").hide();
		})

		/*
		*<div class="ewidget ewidget-target" draggable="true">
		*	<div class="widget">
		*		<div class="name">实时指标</div>
		*		<a href="javascript:;" class="remove">移除</a>
		*	</div>
		*</div>
		*/
		$("body").on('click', '.left-widgets', function(event) {
			moved(event, '.left-column')
		})
		$("body").on('click', '.right-widgets', function(event) {
			moved(event, '.right-column')
		})

		function moved(event, ele) {
			// $("body").on("click", '.left-widgets', function(event) {
				var event = event || widow.event;
				var target = event.target || event.srcElement;
				var _this = $(this);
				var fragment = document.createDocumentFragment();
				if(target.nodeName.toLowerCase() === 'a' && target.className === 'add') {
					var text = $(target).parents(".widget").find(".name").text();
					$(fragment).append(
						'<div class="ewidget ewidget-target" draggable="true">\
							<div class="widget">\
								<div class="name">'+ text +'</div>\
								<a href="javascript:;" class="remove">移除</a>\
							</div>\
						</div>'
					)
					$(".target-container "+ele).append(fragment);
					$(target).parents(".ewidget").remove();
				}
			// })
		}
		


		/*<div class="ewidget ewidget-source" draggable="true" style="">
			<div class="widget">
				<div class="widget-header clearfix">
					<div class="name pull-left">实时指标</div>
				</div>
				<div class="widget-content">
					<img src="https://img.alicdn.com/tps/TB1IEfXKFXXXXbgXVXXXXXXXXXX-360-120.png">
					<div class="widget-mask" style="display: none;"></div>
					<div class="hovered-block" style="display: none;">
						<div class="rt operators" style="display: none;">
							<a href="javascript:;" class="detail">详情</a>
							<a href="javascript:;" class="add">添加</a>
						</div>
						<div class="desc"></div>
						<div class="user-count">8,220,125人在使用</div>
					</div>
				</div>
			</div>
		</div>*/


		$("body").on("click", ".target-container .left-column", function(event) {
			removed(event, '.left-widgets');
		})
		$("body").on("click", ".target-container .right-column", function(event) {
			removed(event, '.right-widgets');
		})
		function removed(event, ele) {
			// $("body").on("click", ".target-container .left-column", function(event) {
				var event = event || widow.event;
				var target = event.target || event.srcElement;
				var _this = $(this);

				var fragment = document.createDocumentFragment();

				if(target.nodeName.toLowerCase() === 'a' && target.className === "remove") {
					var text = $(target).siblings(".name").text();
					$(fragment).append(
						'<div class="ewidget ewidget-source" draggable="true">\
							<div class="widget">\
								<div class="widget-header clearfix">\
									<div class="name lf">'+text+'</div>\
								</div>\
								<div class="widget-content">\
									<img src="https://img.alicdn.com/tps/TB1IEfXKFXXXXbgXVXXXXXXXXXX-360-120.png">\
									<div class="widget-mask" style="display: none;"></div>\
									<div class="hovered-block" style="display: none;">\
										<div class="rt operators" style="display: none;">\
											<a href="javascript:;" class="detail">详情</a>\
											<a href="javascript:;" class="add">添加</a>\
										</div>\
										<div class="desc"></div>\
										<div class="user-count">8,220,125人在使用</div>\
									</div>\
								</div>\
							</div>\
						</div>'
					)
					$(".source-widgets " + ele ).append(fragment);
					// console.log(_this);
					$(target).parents(".ewidget.ewidget-target").remove();
				}	
			// })
		}

		

		/*var resource = $(".source-widgets-container .left-widgets .ewidget.ewidget-source")[0];
			var target = $(".target-container .bottom")[0];
			console.log(target)
			resource.ondragstart = function(event) {
				event.dataTransfer.setData("Text", event.target.id);
			}
			target.ondragover = function(event) {
				console.log(963)
				// console.log(event.pa)
				var arr = [].slice.call(event.path);
				// console.log(arr)

				event.preventDefault();
			}
			target.ondrop = function(event) {
				console.log(123);
				console.log(event.dataTransfer);
				event.preventDefault();
			    var data=event.dataTransfer.getData("Text");
			    event.target.appendChild(document.getElementById(data));
		}*/

		// 下拉框 .....start
		$(document).click(function(e) {
			$(".select-control .select-control-list").hide();
		});
		$(".select-control-list").click(function(e) {
			e.stopPropagation();
		})
		$(".select-control").click(function(e) {
			e.stopPropagation();
			var _this = $(this);
			if(_this.children(".select-control-list").css("display") === 'block') {
				_this.children(".select-control-list").hide();
			} else {
				$(".select-control").children(".select-control-list").each(function() {
					var inner_this = $(this);
					if(inner_this.css("display") === 'block') {
						$(".select-control-list").hide();
					}
				})
				_this.children(".select-control-list").show();
			}

			// 判断页面有没有日期插件
			if($(".layui-laydate").length > 0) {
				$(".layui-laydate").hide();
			} else {
				return false;
			}

		});
			//  下拉
		$(".select-control-list .ui-selector-item").click(function(e) {
			var _this = $(this);
			_this.addClass("curr").siblings(".curr").removeClass("curr");
			_this.parents(".ui-selector").find(".ui-selector-value").text($(this).find("span").text());
			_this.parents(".select-control-list").hide();
		})
		// 下拉框 .....end
	})
</script>
</html>
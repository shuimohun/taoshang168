<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--流量-->
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/sycm_index.css">
 <link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<style>  
    iframe{  
        pointer-events: none;  
    }  
</style>  

<div class="basic-div" style="width:100%;min-height: 112px;">
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
</div>
<div class="main-wrap w-1210 mt-10">
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
						<li class="menu-item-inner lf curr">
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
						<li class="menu-item-inner lf curr">
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
						<li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">运营计划</span>
							</a>
						</li>
						<!-- <li class="menu-item-inner lf">
							<div class="selected-mask"></div>
							<a href="javascript:;" class="name-wrapper">
								<span class="name">事件配置</span>
							</a>
						</li> -->
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!--  start -->
	<div class="w-1040 rt clickeffect-analysis-container">
		<div class="clickeffect-analysis-wrap">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22"></h3>
				<ol class="breadcrumb lf"><li><a href="javascript:;">装修分析（无线）</a></li><li class="active">模块点击效果分析</li></ol>
				<div class="input-date"><input type="text" value="2018-01-02" readonly=""><i class="icon-cal"></i></div>
				<!-- <span class="screen-subtitle">以下为蓓尔品牌指标</span> -->
			</div>
			<div class="ops-base-card mod mod-effect">
				<div class="navbar">
					<h4 class="navbar-header"><i class="icon-title"></i><span><em class="page-name">手机淘宝店铺首页</em>页面模块点击效果分析</span></h4>
					<div class="operation rt">
						<div class="ui-switch btn-group-switch">
							<ul class="ui-switch-menu">
								<li class="active ui-switch-link ui-switch-item"><a href="#" target="_blank">淘宝App</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="shop-page">
						<div class="radiobox">
							<div class="ui-combopanel index-panel">
								<div class="ui-combopanel-panel">
									<div class="ui-combopanel-groups">
										<div class="group-wrapper">
											<span class="group-title lf">指标：</span>
											<div class="group clearfix lf">
												<span class="radio selected"><span class="option"></span><span class="name">点击次数</span></span>
												<span class="radio"><span class="option"></span><span class="name">点击人数</span></span>
												<span class="radio disabled"><span class="option"></span><span class="name">点击率</span></span>
												<span class="radio disabled"><span class="option"></span><span class="name">引导下单买家数</span></span>
												<span class="radio disabled"><span class="option"></span><span class="name">引导下单金额</span></span>
												<span class="radio disabled"><span class="option"></span><span class="name">引导下单转化率</span></span>
												<span class="radio disabled"><span class="option"></span><span class="name">引导支付买家数</span></span>
												<span class="radio disabled"><span class="option"></span><span class="name">引导支付金额</span></span>
												<span class="radio disabled"><span class="option"></span><span class="name">引导支付转化率</span></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="disable-wrapper">
								<div class="index-picker-no-permission">
									<span class="error"><span class="icon-info"></span></span>
									<div class="no-permission-wrapper"><span>亲，您还未订购 装修分析，无法查看更多指标！</span><br>请<a href="javascript:;" target="_blank" >立即订购&gt;</a></div></div>
							</div>
						</div>	
					</div>
					<div class="fixed-data"><a class="global-data-btn">页面整体数据&gt;</a></div>
				</div>
			</div>
			<div class="page-wrapper">
				<div class="bg-phone-top"></div>
				<div class="page-container we-page"></div>
				<iframe id="iframe"  scrolling="no" frameborder="0" style="width:540px;text-align: center;"  src="http://192.168.0.46/taoshang168/shop_wap/tmpl/store.html?shop_id=26"></iframe>
				<div class="bg-phone-bottom"></div>
			</div>
		</div>
	</div>
	<!--  end -->
</div>

<div class="dialog-mask mobile-shopIndex-dialog">
	<div class="dialog-locator">
		<div class="dialog-container">
			<div class="general-trend-table">
				<div class="dialog-header">
					<button type="button" class="dialog-close close">x</button>
					<p class="dialog-title"><span style="color: rgb(13, 181, 192);">  手机淘宝店铺首页 </span><span>数据</span></p>
				</div>
				<div class="dialog-content">
					<div class="trend-options orflow">
						<div class="operation">
							<div class="ui-switch btn-group-switch app-switch">
								<ul class="ui-switch-menu">
									<li class="active ui-switch-link ui-switch-item">
										<a href="javascript:;" target="_blank">淘宝App</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="menu">
						<li class="col col-date">统计时段</li>
						<li class="col col-pv">浏览量</li>
						<li class="col col-uv">访客数</li>
						<li class="col col-clickCnt">点击次数</li>
						<li class="col col-clickUv">点击人数</li>
						<li class="col col-clickRate">点击率</li>
						<li class="col col-bounceRate">跳失率</li>
						<li class="col col-avgStayTime">平均停留时长</li>
					</ul>
					<ul class="list">
						<li class="current-row">
							<p class="col col-date">2018-01-08</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2018-01-07</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2018-01-06</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2018-01-05</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2018-01-04</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2018-01-03</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2018-01-02</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2018-01-01</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2017-12-31</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2017-12-30</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2017-12-29</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2017-12-28</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2017-12-27</p>
							<p class="col col-pv">2</p>
							<p class="col col-uv">1</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">5.01</p>
						</li>
						<li class="">
							<p class="col col-date">2017-12-26</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
						<li class="">
							<p class="col col-date">2017-12-25</p>
							<p class="col col-pv">0</p>
							<p class="col col-uv">0</p>
							<p class="col col-clickCnt">0</p>
							<p class="col col-clickUv">0</p>
							<p class="col col-clickRate">0.00%</p>
							<p class="col col-bounceRate">0.00%</p>
							<p class="col col-avgStayTime">0</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js"></script>

<script type="text/javascript">
	// 时间插件
</script>
<script type="text/javascript">
	// 点击 导航左侧
	$(".switch-wrap").eq(0).show();
	$(".nav .menu-list .menu-item-inner").click(function(){
		var parentIndex = $(this).parents(".menu-list-inner").parents(".menu-item").index();
		var lengthLi = 0;
		for(var i=0;i<parentIndex;i++){
			lengthLi += $(".menu-item").eq(i).children(".menu-list-inner").children(".menu-item-inner").length;
		}
		var index = $(this).index();
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
		$(this).parents(".menu-list-inner").parents(".menu-item").siblings(".menu-item").children(".menu-list-inner").children(".menu-item-inner").removeClass("curr");
		$(".switch-wrap").hide();
		$(".switch-wrap").eq(index + lengthLi).show();
	})


	var ifm = document.getElementById("iframe");
	ifm.onload = function() {
		var subWeb = document.frames ? document.frames["iframe"].document : ifm.contentDocument;
		var heightArray = [];
		var interval = setInterval(function() {

			if (ifm != null && subWeb != null) {
				ifm.height = subWeb.body.scrollHeight + 44;
			}

			heightArray.push(ifm.height);

			if(heightArray.length > 1) {
				if(heightArray[heightArray.length-2] === heightArray[heightArray.length-1]) {
					clearInterval(interval)
				}
			}

		}, 1200)
		
	}

	 $('.input-date input').datetimepicker({
        format:"Y-m-d",
        timepicker:false,
      });


	// 点击页面数据
	$(".clickeffect-analysis-container .fixed-data").click(function() {
		$(".mobile-shopIndex-dialog").fadeIn(500);
	})
	$(".dialog-locator .close").click(function(){
		$(this).parents(".dialog-mask").hide();
	})

	
	// fixed
	$(window).scroll(function() {
		var scrollTop = $(window).scrollTop();
		// fixed start
		if(scrollTop > $(".header").outerHeight(true) + 16) {
			$(".header-wrap").addClass("fixed");
		} else {
			$(".header-wrap").removeClass("fixed");
		}

	})
	// 右侧 导航 end

</script>
</html>
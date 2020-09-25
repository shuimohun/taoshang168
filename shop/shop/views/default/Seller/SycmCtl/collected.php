<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--选词助手  -- 已收藏-->
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
<div class="main-wrap w-1210 mt-10">
	<div class="nav lf w-160 backff">
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
						<li class="menu-item-inner lf curr">
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
	<!-- 我的收藏 start -->
	<div class="w-1040  rt my-collection-container backff">
		<div class="collection-wrap backff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22"></h3>
				<ol class="breadcrumb lf"><li><a href="javascript:;">选词助手</a></li><li class="active">我的收藏</li></ol>
			</div>
			<div class="mod ops-base-card mod-list">
				<div class="nav-bar backff">
					<div class="select-control download rt">
						<a href="javascript:;">
							<i class="icon"></i>
							<span class="val">下载</span>
						</a>
						<div class="ui-download-panel ui-download-right select-control-list">
							<div class="ui-download-desc"><p class="ui-download-title">当前下载的数据：</p><p class="ui-download-tags">2017-11-03、所有指标</p><p class="ui-download-status">如需下载其他时间或比较对象的原始数据，请重新选择！</p></div>
							<p class="ui-download-btns clearfix"><a href="javascript:;" class="btn btn-blank btn-sm">取消</a><a href="javascript:;" class="btn btn-primary btn-sm">确定</a></p>
						</div>
					</div>
					<div class="select-control ui-combopicker navbar-combopicker rt">
						<a class="btn btn-combopicker btn-blank" href="javascript:;">指标<span class="caret"></span></a>
						<div class="ui-combopicker-panel ui-combopicker-right select-control-list">
							<div class="ui-combopicker-groups">
								<div class="group-wrapper">
									<span class="group-title">店铺数据：</span>
									<div class="group clearfix">
										<span class="checkbox disabled">
											<span class="option"></span>
											<span class="name">曝光量</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">引导入店浏览量</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">商城点击占比</span>
										</span>
										<span class="checkbox selected">
											<span class="option"></span>
											<span class="name">全网点击率</span>
										</span>
										<span class="checkbox selected">
											<span class="option"></span>
											<span class="name">全网商品数</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">全网下单转化率</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">直通车平均点击单价</span>
										</span>
									</div>
								</div>
								<div class="group-wrapper">
									<span class="group-title">全网数据：</span>
									<div class="group clearfix">
										<span class="checkbox disabled">
											<span class="option"></span>
											<span class="name">曝光量</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">引导入店浏览量</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">商城点击占比</span>
										</span>
										<span class="checkbox selected">
											<span class="option"></span>
											<span class="name">全网点击率</span>
										</span>
										<span class="checkbox selected">
											<span class="option"></span>
											<span class="name">全网商品数</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">全网下单转化率</span>
										</span>
										<span class="checkbox">
											<span class="option"></span>
											<span class="name">直通车平均点击单价</span>
										</span>
									</div>
								</div>
							</div>
							<div class="ui-combopicker-btns"><span class="message">已选择4项</span><a href="#" class="btn btn-primary btn-sm">确定</a></div>
						</div>
					</div>
					<div class="date-text rt">2017-02-02 ~ 2015-02-02</div>
					<div class="select-control ui-selector rt">
						<a href="javascript:;">
							<span class="ui-selector-value">日期</span>
							<span class="caret icon"></span>
						</a>
						<ul class="ui-selector-list select-control-list" style="display: none;">
							<li class="ui-selector-item curr">
								<span>最近1天</span>
							</li>
							<li class="ui-selector-item">
								<span>最近7天平均</span>
							</li>
							<li class="ui-selector-item day">
								<span>日</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="content">
					<div class="favorite-box">
						<div class="input-container clearfix">
							<input type="text" value="" class="favorite-input" placeholder="请输入搜索词">
							<a class="btn btn-primary btn-favorite-keyword">收藏</a>
							<div class="message hide"><i class="icon-info"></i></div>
							<p class="left-fav">您还可以新增<span class="left">16个</span>关键词</p>
						</div>
						<p class="recommend-list"></p>
					</div>
					<ul class="menu clearfix">
						<li class="keyword">搜索词</li>
						<li class="index orderable sortableTh"><p class="device-name">PC端的</p><p class="index-name"><span class="name">带来的访客数</span><span class="order-flag order desc"><i class="icon icon-order"></i></span></p></li>
						<li class="index orderable sortableTh"><p class="device-name">无线端的</p><p class="index-name"><span class="name">带来的访客数</span><span class="order-flag order"><i class="icon icon-order"></i></span></p></li>
						<li class="index orderable sortableTh"><p class="device-name">PC端的</p><p class="index-name"><span class="name">全网商品数</span><span class="order-flag order"><i class="icon icon-order"></i></span></p></li>
						<li class="index orderable sortableTh"><p class="device-name">无线端的</p><p class="index-name"><span class="name">全网商品数</span><span class="order-flag order"><i class="icon icon-order"></i></span></p></li>
						<li class="handle">操作</li>
					</ul>
					<div class="keyword-cnt">
						<ul class="new-keywords-list">
							<li class="clearfix">
								<p class="keyword">
									<a href="javascript:;" target="_blank">24电磁炉铝锅</a>
								</p>
								<div class="handle">
									<a class="unfav-btn active">取消收藏</a>
								</div>
							</li>
							<li class="clearfix">
								<p class="keyword">
									<a href="javascript:;" target="_blank">拿伯尼欧镀晶蜡</a>
								</p>
								<div class="handle">
									<a class="unfav-btn active">取消收藏</a>
								</div>
							</li>
							<li class="clearfix">
								<p class="keyword">
									<a href="javascript:;" target="_blank" >潘婷强韧养根发膜</a>
								</p>
								<div class="handle">
									<a class="unfav-btn active">取消收藏</a>
								</div>
							</li>
							<li class="suggestion normal"><i class="icon-big-info"></i>亲，新增收藏的搜索词，相关数据第二天会提供，敬请期待哦！</li>
						</ul>
						<ul class="keywords-list">
							<li class="clearfix">
								<p class="keyword">
									<a href="javascript:;" target="_blank">拿伯尼欧镀晶</a>
								</p>
								<p class="index">0</p>
								<p class="index">0</p>
								<p class="index">0</p>
								<p class="index">0</p>
								<div class="handle">
									<a class="unfav-btn active">取消收藏</a>
									<a class="detail-link" href="index.php?ctl=Seller_Sycm&met=detailAnalysis" target="_blank">详情分析</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 我的收藏 end -->

	<div class="dialog-mask cancel-collection-dialog">
		<div class="dialog-locator">
			<div class="dialog-container">
				<div class="dialog-header">
					<button type="button" class="dialog-close close">x</button>
					<h4 class="dialog-title">提醒</h4>
				</div>
				<div class="dialog-content">
					<div>
						<div class="suggestion clearfix normal">
							<i class="icon-big-info"></i>
							<div class="message">
								<p>您确定要取消该收藏吗？</p>
								<p>取消后，再次收藏，相关数据将在第二天显示哦！</p>
							</div>
						</div>
						<div class="ui-dialog-actions">
							<a class="btn btn-primary">确定</a>
							<a class="btn btn-blank">取消</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript">
	lay('.select-control .select-control-list .day').on('click', function(){
		// var _this = this.parentNode.parentNode.previousSibling
		var _this = $(this).parents(".ui-selector").siblings(".date-text").get(0);
	  laydate.render({
	    elem: _this,
	    format: 'yyyy-MM-dd ~ yyyy-MM-dd',
	    show: true,
	    closeStop: '.date-text',
	    trigger: 'dbclick',
	    showBottom: false,
	    position: 'absolute',
	    top: '50px'
	  });
	});
	lay('.select-control .select-control-list .month').on('click', function(){
		var _this = $(this).parents(".ui-selector").siblings(".date-text").get(0);
	  laydate.render({
	    elem: _this,
	    format: 'yyyy-MM-dd ~ yyyy-MM-dd',
	    type: 'month',
	    show: true,
	    closeStop: '.date-text',
	    trigger: 'dbclick',
	    showBottom: false,
	     change: function(value, date){ //监听日期被切换
	      	var elem = this.elem;
	      	var end = laydate.getEndDate(date.month, date.year);
	      	var year = date.year;
	      	var month = date.month;
	      	month = String(date.month).length === 1 ? '0'+month : month;
	      	$(elem).text(year+'-'+month+'-01 ~ '+year+'-'+month+'-'+end);
	      	$(".layui-laydate").hide();
	      }
	  });
	});
	lay('.select-control .select-control-list .week').on('click', function(){
		var _this = $(this).parents(".ui-selector").siblings(".date-text").get(0);
	  laydate.render({
	    elem: _this,
	    show: true,
	    closeStop: '.date-text',
	    format: 'yyyy-MM-dd',
        min:'2017-11-26',
        max:'2017-12-30',
        value:'2017-12-03 ~ 2017-12-09',
        showBottom: false,
        range:'~',
        week:1,
        trigger: 'dbclick',
        change: function(value, date) {
	      	var elem = this.elem;
	      	$(elem).text(value);
	      	$(".layui-laydate").hide();
        }
	  });
	});
</script>
<script type="text/javascript">
	// 点击左侧导航nav
	$(".switch-wrap").eq(0).show();
	$(".nav .menu-list-inner .menu-item-inner").click(function(){
		var _this = $(this);
		var index = _this.index();
		_this.addClass("curr").siblings(".curr").removeClass("curr");
		$(".switch-wrap").hide();
		$(".switch-wrap").eq(index).show();
	})


	// 点击收藏 提示框
		// 闭包 
	var verible =null;
	$(".my-collection-container .keyword-cnt").click(function(event) {
		console.log(8989)
		var event = event || window.event;
		var target = event.srcElement || event.target;
		var ulIndex = $(target).parents("ul").index();
		var liIndex = $(target).parents("li").index();

		function inner() {
			return {
				ulIndex,
				liIndex
			}
		}
		verible = inner;


		if(target.nodeName.toLowerCase() === 'a' && (target.className.indexOf("unfav-btn") !== -1)) {
			$(".cancel-collection-dialog").fadeIn(500);
		}
	})
	// 点击提示框 取消 or close
	$(".cancel-collection-dialog .btn-blank, .cancel-collection-dialog .close").click(function() {
		$(".cancel-collection-dialog").hide();

	})
	$(".cancel-collection-dialog .btn-primary").click(function() {
		var _this =$(this);
		_this.parents(".cancel-collection-dialog").hide();
		$(".my-collection-container .keyword-cnt ul").eq(verible().ulIndex).find("li").eq(verible().liIndex).remove();
	})

			
	// 图标三状态 --- 商品效果
	$(".orderable").click(function(){
		var _this = $(this);
		if(_this.find(".order-flag").hasClass("desc")){
			_this.find(".order-flag").addClass("asc").removeClass("desc");
		}else if(_this.find(".order-flag").hasClass("asc")) {
			_this.find(".order-flag").addClass("desc").removeClass("asc");
		}else{
			_this.siblings(".orderable").find(".desc").removeClass("desc");
			_this.siblings(".orderable").find(".asc").removeClass("asc");
			_this.find(".order-flag").addClass("desc");
		}
	})
	

		// 下拉框 .....start
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
				var inner_this = $(this);
				if(inner_this.css("display") === 'block') {
					$(".select-control-list").hide();
					if($(".ui-selector-children").css("display") === 'block') {
						$(".ui-selector-children").hide();
					}
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
		_this.parents(".ui-selector").find(".ui-selector-value").text(_this.find("span").text());
		_this.parents(".select-control-list").hide();
	})
		// 下载
	$(".ui-download-panel.select-control-list .btn").click(function() {
		$(this).parents(".ui-download-panel").hide();
	})
		// 指标
	$(".ui-combopicker .ui-combopicker-panel .checkbox:not(.disabled)").click(function() {
		var _this = $(this);
		_this.toggleClass("selected");
		var len = parseInt(_this.parents(".ui-combopicker-panel").find(".checkbox.selected").length);
		if(len === 0) {
			_this.parents(".ui-combopicker-groups").siblings(".ui-combopicker-btns").find(".message").addClass("error").text("最少选1项"); 
		}else if (len > 5) {
			_this.parents(".ui-combopicker-groups").siblings(".ui-combopicker-btns").find(".message").addClass("error").text("最多选5项");
		} else {
			_this.parents(".ui-combopicker-groups").siblings(".ui-combopicker-btns").find(".message").text("已选择"+len+"项").removeClass("error");
		}
	})
	$(".ui-combopicker-panel .ui-combopicker-btns .btn").click(function() {
		var _this = $(this);
		if(_this.siblings(".message").hasClass("error")) {
			return false;
		}else {
			_this.parents(".ui-combopicker-panel").hide();
		}
	})
	// 下拉框 .....end
</script>
</html>

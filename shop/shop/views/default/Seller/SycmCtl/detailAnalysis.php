<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--选词助手  -- 详情分析-->
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
	<!-- 详情分析 start -->
	<div class="w-1040  rt detail-analysis-container backff">
		<div class="detail-analysis-wrap backff">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22"></h3>
				<ol class="breadcrumb lf"><li><a href="javascript:;">选词助手</a></li><li class="active">详情分析</li></ol>
				<p class="keyword-desc"><span class="title">关键词：</span><span class="keyword">24电磁炉铝锅</span></p>
				<div class="chart-switch rt">
					<span class="switch curr">无线</span>
					<span class="sprite">
						<i class="sp"></i>
					</span>
					<span class="switch">PC</span>
				</div>
			</div>
			<div class="mod ops-base-card mod-trend mt-20">
				<div class="nav-bar backff">
					<h4 class="nav-bar-header lf">
						数据趋势
					</h4>
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
								<span>最近7天</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="content">
					<div id="data-trend-chart" class="data-trend-chart" style="width: 950px;height: 300px;margin: 0 auto;"></div>
				</div>
			</div>
			<div class="mod ops-base-card mod-items mt-20">
				<div class="nav-bar backff">
					<h4 class="nav-bar-header lf">
						带来效果的宝贝Top10
					</h4>
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
					<ul class="menu clearfix">
						<li class="title">关键词带来访客的宝贝</li>
						<li class="index orderable sortableTh">
							<span class="name">带来的访客数</span>
							<span class="order-flag order desc"><i class="icon-order icon"></i></span>
						</li>
						<li class="index orderable sortableTh">
							<span class="name">带来的浏览量</span>
							<span class="order-flag order"><i class="icon-order icon"></i></span>
						</li>
						<li class="index orderable sortableTh">
							<span class="name">引导下单买家数</span>
							<span class="order-flag order"><i class="icon-order icon"></i></span>
						</li>
						<li class="index orderable sortableTh"><span class="name">所有引导下单转化率</span><span class="order-flag order"><i class="icon-order icon"></i></span></li>
					</ul>
					<div class="no-data-message">
						<div class="ui-message-empty">
							<p class="ui-message-content">
								<span class="noromal">
									<i class="icon"></i>
								</span>
								<span>暂无数据<span>
							</span></span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 详情分析 end -->

	<!-- <div class="dialog-mask cancel-collection-dialog">
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
	</div> -->
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/laydate/laydate.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
<script type="text/javascript">
	var dataTrendChart = echarts.init(document.getElementById('data-trend-chart'));
	 // 指定图表的配置项和数据
	 	var colors = ['#2062e6','#f3d024'];
	        var option = {
	          	tooltip: {
			        trigger: 'axis',
			        backgroundColor: '#fff',
			        borderWidth: 1,//默认值，提示边框线宽，单位px，默认为0（无边框）
			        borderColor: '#eee',
			        borderRadius: 6,//默认值，提示边框圆角，单位px，默认为4
			        padding: 10,
			        textStyle: {
			            color: '#999',
			            fontSize: 12
			        },
			        formatter: function(params) {
			        	var str ='';
			        	var year = new Date().getFullYear();
			        	for(var i = 0; i<params.length;i++) {
			        		str += '<i class="icon" style="width:10px;height:10px;background-color:'+params[i].color+';border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;margin-right:5px;"></i>'+params[i].seriesName+'&nbsp;&nbsp;&nbsp;&nbsp;'+params[i].value+'.00</br>'
			        	}
			        	return year+'-'+params[1].name+'</br>'+str;
	        	
			        },
			        axisPointer: {
			        	type: 'line',  // cross时为十字虚线 也可以为shadow
			        	lineStyle: {
			        		color: '#bbb'
			        	},
			        	shadowStyle : {                       // 阴影指示器样式设置
			                width: 'auto',                   // 阴影大小
			                color: 'rgba(150,150,150,0.3)'  // 阴影颜色
			            }
			        }
			    },
	             grid: {
			        bottom: '15%',
			        left: '2%',
			        right: '2%',
			        top: '5%'
			    },
				 axisLabel: {
				   show: false
				 },
	            xAxis: {    //  x坐标轴
	            	type: 'category',
	                 data: ["10-07","10-08","10-09","10-10","10-11","10-12","10-13"],
	                axisLine:{    //坐标轴颜色
	                	show: true,
	                    lineStyle:{
	                        color:'#bbb',
	                        width: 2
	                    }
	                },
	                // axisLine: true,  //  控制 坐标轴显示或隐藏
	                splitLine: {    //删掉参考线
	                	show: false
	                },
	                axisTick: {  // 坐标轴上的小标识
	                	show: false
	                },
	                axisLabel: {  //刻度值
	                	textStyle: {
	                		color: '#bbb'
	                	},
	                	interval: 0  // x轴每隔5个显示一次文本
	                },
	                // axisLabel : {interval: 1},
	            },
	            yAxis: {

	                type: 'value',
	            	// boundaryGap: [0, 0.5],
	            	axisLine: false,  //  控制 坐标轴显示或隐藏
	            	splitLine: {
	                	show: true,
	                	lineStyle: {
			        		color: '#eee'
			        	}
	                },
	                axisTick: {
	            		show: false
	            	},
	            	axisLabel: {
	                	show: false,
	                	textStyle: {
	                		align: 'left',
	                		color: '#bbb',
	                	}
	                }
	            },
	            series: [
		            {
		                name: '无线端的带来的访客数',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
		                showSymbol: false,
		                symbolSize: 8,
		                smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[0],  // 此处绑定图例颜色
		                		lineStyle: {    // 线条颜色
		                			color: colors[0]
		                		}
		                	}
		                },
		                data:  [0, 2, 4, 5, 8, 0, 5]
		            },
		            {
		                name: '无线端的引导转化率',
		                type: 'line',
		                symbol: 'circle',  // 折点处空心圆
		                showSymbol: false,
		                symbolSize: 8,
		                smooth: true,  // 平滑折线
		                itemStyle: {
		                	normal: {
		                		color: colors[1],
		                		lineStyle: {
		                			color: colors[1]
		                		}
		                	}
		                },
		                data:  [8, 0, 0, 0, 4, 0, 1]
		            },
	            ]
	        };
	        // 使用刚指定的配置项和数据显示图表。
	        dataTrendChart.setOption(option);
</script>
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
        week: 1,
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
		var index = $(this).index();
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
		$(".switch-wrap").hide();
		$(".switch-wrap").eq(index).show();
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
		if($(this).siblings(".message").hasClass("error")) {
			return false;
		}else {
			$(this).parents(".ui-combopicker-panel").hide();
		}
	})
// 下拉框 .....end

</script>
</html>

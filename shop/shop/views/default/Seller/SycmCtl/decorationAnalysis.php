<!DOCTYPE html>
<html lang="en">
<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<!--生意参谋--流量--页面配置 ---装修分析-->
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/base.css">
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/sycm_index.css">


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
	
	<!-- 装修分析 start -->
	<div class="w-1040 rt decoration-analysis-container">
		<div class="decoration-analysis-wrap">
			<div class="screen-header">
				<h3 class="screen-title lf mt-22">装修分析</h3>
				<ul class="rt device-choose-wrap orflow">
					<li class="device-noLine lf active"><a href="javascript:;">无线</a></li>
					<!-- <li class="device-PC lf"><a href="javascript:;">PC</a></li> -->
				</ul>
			</div>
			<!-- 个性化首页列表 start -->
			<div class="individuation-list-wrap">
				<div class="ed-custom-web mod backff">
					<div class="wrap-title">
						<div class="title-lf lf">个性化首页列表</div>
					</div>
					<div class="content">
						<ul class="menu clearfix">
							<li class="col col-name wireless">页面名称</li>
							<li class="col col-date">定制时间</li>
							<li class="col col-operation">操作</li>
						</ul>
						<ul class="list">
							<li class="clearfix">
								<div class="col col-name wireless">
									<p class="name"><span class="page-type tb-app">手淘</span>手机淘宝店铺首页</p>
								</div>
								<p class="col col-date">默认</p>
								<div class="col col-operation">
									<span class="action big-button">
										<a href="index.php?ctl=Seller_Sycm&met=clickDistribution" class="btn btn-hollow" target="_blank">点击分布</a>
									</span>
									<span class="action web-data"><a>页面数据</a></span>
									<div class="action convertion-action">										
										<span class="text-wrapper">
											<span class="tips-wrap">
												<i class="icon convertion-icon-tips"></i>
												<div class="tips-guide-wrap  convertion-tips">
													<div class="paid-module-no-permission">
														<span class="error">
															<span class="icon-big-info icon"></span>
														</span>
														亲，您还未订购装修分析，暂时无法使用！
														<a href="javascript:;" class="btn order-btn">立即订购</a>
														<a href="javascript:;" class="preview-btn">功能预览</a>
													</div>
													<i class="icon close-icon">x</i>
												<!-- 	<i class="arrow outer-arrow"></i>
													<i class="arrow inner-arrow"></i> -->
												</div>
											</span>
											<a href="javascript:;" class="unactive">引导详情</a>
										</span>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- 个性化首页列表 end -->
		</div>
	</div>
	<!-- 装修分析 end -->
</div>



<!-- 流量 -- 页面配置 -- 页面数据 dialog start-->
<div class="dialog-mask web-data-dialog">
	<div class="dialog-locator">
	<div class="dialog-container">
		<div class="dialog-header">
			<button type="button" class="dialog-close close">x</button>
			<p class="dialog-title"><span>无线端</span><span style="color: rgb(13, 181, 192);">  首页  </span><span>页面的最近30天点击效果数据</span></p>
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
				<div class="combopanel index-combo-panel">
					<div class="combopanel-panel combo-panel-inline combo-panel-lite">
						<div class="ui-combopanel-groups">
							<div class="group-wrapper">
								<span class="group-title">流量相关：</span>
								<div class="group clearfix">
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">浏览量</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">访客数</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">点击次数</span>
									</span>
									<span class="checkbox selected">
										<span class="option"></span>
										<span class="name">点击人数</span>
									</span>
									<span class="checkbox selected">
										<span class="option"></span>
										<span class="name">点击率</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">跳失率</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">平均停留时长</span>
									</span>
								</div>
							</div>
							<div class="group-wrapper">
								<span class="group-title">引导转化：</span>
								<div class="group clearfix">
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">引导下单金额</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">引导下单买家数</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">引导下单转化率</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">引导支付金额</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">引导支付买家数</span>
									</span>
									<span class="checkbox">
										<span class="option"></span>
										<span class="name">引导支付转化率</span>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="commonchart-chart" class="commonchart" style="width: 970px; height: 380px";></div>
		</div>
	</div>
	</div>
</div>
<!-- 流量 -- 页面配置 -- 页面数据 dialog end-->


<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
<script type="text/javascript">
	var commonchartChart = echarts.init(document.getElementById('commonchart-chart'));
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
		                name: '同行平均所有终端的支付金额',
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
		                name: '我的所有终端的支付金额',
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
	        commonchartChart.setOption(option);
</script>

<script type="text/javascript">
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
		$(this).addClass("curr").siblings(".curr").removeClass("curr");
		$(this).parents(".menu-list-inner").parents(".menu-item").siblings(".menu-item").children(".menu-list-inner").children(".menu-item-inner").removeClass("curr");
		$(".switch-wrap").hide();
		$(".switch-wrap").eq(index + lengthLi).show();
	})


	// 页面配置-----装修分析 中 移入到引导详情 出现提示框 && click x  隐藏
	$(".convertion-icon-tips").mousemove(function(){
		$(this).siblings(".tips-guide-wrap.convertion-tips").show();
	})
	$(".convertion-tips .close-icon").click(function(){
		$(this).parents(".convertion-tips").hide();
	})

	// 点击页面设置
	$(".decoration-analysis-wrap .col-operation .action.web-data").click(function() {
		$(".web-data-dialog").fadeIn(500);
	})
	$(".close").click(function() {
		$(".dialog-mask").hide();
	})
</script>
</html>
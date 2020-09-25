<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

	<div class="basic-info">
		<dl>
			<dt>
                <p><img width="200" height="60" src="<?php if(!empty($this->shop_base['shop_logo'])){ ?><?=$this->shop_base['shop_logo']?><?php }else{?> <?=$this->web['shop_head_logo']?>!200x60.jpg <?php } ?>" /></p>
			    <a href="index.php?ctl=Seller_Shop_Setshop&met=index&typ=e&"><i class="iconfont icon-shangjiaruzhushenqing rel_top-2"></i>编辑店铺设置</a>
			</dt>
			<dd>
				<h3><?=$this->shop_base['shop_name']?></h3>
				<h5>用户名：<?=$this->shop_base['user_name']?></h5>
			</dd>
			<dd>
				<span>店铺等级：<em><?=$shop_detail['shop_grade']?></em></span>
                <?php if($this->shop_base['shop_self_support'] == 'false'){ ?>
                    <span>有&nbsp;&nbsp;效&nbsp;&nbsp;期：<em><?=$this->shop_base['shop_end_time']?></em></span>
                <?php } ?>
			</dd>
			<dd>
				<span>最后登录：<em><?=date('Y-m-d H:i:s',$last_login_time)?></em></span>
				<span>iP&nbsp;&nbsp;地&nbsp;&nbsp;址：<em><?=$last_login_ip?></em></span>
			</dd>
		</dl>
		<div class="detail-rate">
			<h5><strong><?=_('同行业相比')?></strong><?=_('店铺动态评分')?>：<?= round(($shop_detail['shop_desc_scores']+$shop_detail['shop_service_scores']+$shop_detail['shop_send_scores'])/3,2)?></h5>
			<ul>
				<li><span> <?php if($shop_detail['com_desc_scores'] > 0){ ?><i class="iconfont  icon-jiantouxiangshang bbc_seller_color"></i><?=_('高于')?><?php }elseif($shop_detail['com_desc_scores'] < 0){ ?><i class="iconfont  icon-jiantouxiangxia "></i><?=_('低于')?><?php }else{ ?><i class="iconfont icon-jiantouxiangshang "></i><?=_('等于')?><?php }?></span><?=_('描述相符：')?><em><?=number_format($shop_detail['shop_desc_scores'],2,'.','')?><?=_('分')?></em></li>
                <li><span> <?php if($shop_detail['com_service_scores'] > 0){?><i class="iconfont  icon-jiantouxiangshang bbc_seller_color"></i><?=_('高于')?><?php }elseif($shop_detail['com_service_scores'] < 0){ ?><i class="iconfont  icon-jiantouxiangxia "></i><?=_('低于')?><?php }else{ ?><i class="iconfont icon-jiantouxiangshang "></i><?=_('等于')?><?php }?></span><?=_('服务态度：')?><em><?=number_format($shop_detail['shop_service_scores'],2,'.','')?><?=_('分')?></em></li>
				<li><span><?php if($shop_detail['com_send_scores'] > 0){ ?><i class="iconfont  icon-jiantouxiangshang bbc_seller_color"></i><?=_('高于')?><?php }elseif($shop_detail['com_send_scores'] < 0){ ?><i class="iconfont  icon-jiantouxiangxia "></i><?=_('低于')?><?php }else{ ?><i class="iconfont icon-jiantouxiangshang "></i><?=_('等于')?><?php }?></span><?=_('发货速度：')?><em><?=number_format($shop_detail['shop_send_scores'],2,'.','')?><?=_('分')?></em></li>
			</ul>
		</div>
	</div>
	<div class="container fn-clear container_cj">
		<div class="m white-panel">
            <div class="pannel_div">
                <div class="mt">
                    <h3 class="bbc_seller_border">店铺及商品提示</h3>
                    <h5>您需要关注的店铺信息以及待处理事项</h5>
			    </div>
                <div class="mc">
                    <div class="focus">
                        <span>店铺商品发布情况： <?= $goods_state_normal_num+$goods_state_offline_num+$goods_state_illegal_num ?> / <?= $shop_grade_goods_limit ? $shop_grade_goods_limit : '不限'?></span>
                        <span><a href="?ctl=Seller_Album&met=index">图片空间</a>使用： <?= $shop_album_num ?> / <?= $shop_grade_album_limit ? $shop_grade_album_limit : '不限'?></span></span>
                    </div>
                    <ul class="fn-clear">
                        <li><a class="<?=$goods_state_normal_num?'num bbc_border bbc_color':''?>" href="./index.php?ctl=Seller_Goods&met=online&typ=e">出售中商品<em class="bbc_seller_bg"><?=$goods_state_normal_num?$goods_state_normal_num:''?></em></a></li>
                        <li><a class="<?=$goods_verify_waiting_num?'num num1 bbc_border bbc_color':''?>" href="./index.php?ctl=Seller_Goods&met=offline&met=verify&typ=e&op=3">待审核商品<em class="bbc_seller_bg"> <?=$goods_verify_waiting_num?$goods_verify_waiting_num:''?></em></a></li>
                        <li><a class="<?=$goods_state_offline_num?'num bbc_border bbc_color':''?>" href="./index.php?ctl=Seller_Goods&met=offline&typ=e&op=1" >仓库中商品 <em class="bbc_seller_bg"><?=$goods_state_offline_num ? $goods_state_offline_num : ''?></em></a></li>
                        <li><a class="<?=$goods_state_illegal_num?'num num1  bbc_border bbc_color':''?>" href="./index.php?ctl=Seller_Goods&met=lockup&typ=e&op=2" >违规下架商品 <em class="bbc_seller_bg"><?=$goods_state_illegal_num? $goods_state_illegal_num: ''?></em></a></li>
                    </ul>
                </div>
            </div>
        </div>

		<div class="m white-panel">
            <div class="pannel_div">
                <div class="mt">
                    <h3 class="bbc_seller_border">交易提示</h3>
                    <h5>您需要立即处理的交易订单</h5>
                </div>
                <div class="mc">
                    <div class="focus">
                        <span>近期售出： <a href="./index.php?ctl=Seller_Trade_Order&met=physical&typ=e&">交易中的订单</a></span>
                        <span>维权提示： <a href="./index.php?ctl=Seller_Service_Complain&met=index&typ=e&">收到维权投诉</a></span>
                    </div>
                    <ul id="order_num_list">
                        <li><a href="./index.php?ctl=Seller_Trade_Order&met=getPhysicalNew&typ=e">待付款订单</a></li>
                        <li><a href="./index.php?ctl=Seller_Trade_Deliver&met=deliver&typ=e">待发货订单</a></li>
                        <li><a href="./index.php?ctl=Seller_Service_Return&met=orderReturn&typ=e" class="">退款订单</a></li>
                        <li><a href="./index.php?ctl=Seller_Service_Return&met=goodsReturn&typ=e" class="">退货订单</a></li>
                    </ul>
                </div>
            </div>
		</div>

		<!-- 此处 zxw  新添加 start -->
        <!-- 市场与竞争  start -->
		<div class="m white-panel">
			<div class="pannel_div">
				<div class="mt">
					<h3 class="bbc_seller_border">市场与竞争</h3>
				</div>
				<div class="update-time rt">
					更新时间： <span class="time"><?=date('Y-m-d');?></span>
				</div>
			</div>
			<div class="sc-and-jz">
				<div class="sc-content">
					<div class="sc-situation orflow">
						<div class="lf sc-situation-lf">
							<h4 class="lf">市场行情</h4>
							<div class="main-sale lf">
								主营行业：<span class="sc_class"></span>
							</div>
						</div>
						<a href="javascript:;" class="rt sc-situation-rt">
							更多
							<i class="icon"></i>
						</a>
					</div>
					<div class="shop-filter orflow">
						<div class="shop-rank-wrap lf">
							<p class="shop-rank">商家层级</p>
							<span class="rank-num sjcj"></span>
						</div>
						<div class="ranking-30-wrap rt">
							<span class="rank">本店近30天支付金额排名</span>
							<span class="rank-num zf"></span>
							<p class="result">较前日<i class="iconfont bbc_seller_color zfje"></i><span class="result-num zfje"></span></p>
						</div>
					</div>
					<div class="industry">
						<p class="industry-7">行业近7天热销店铺</p>
						<div class="shop_a"></div>
					</div>
				</div>
				<div class="jz-content">
					<div class="sc-situation orflow">
						<div class="lf sc-situation-lf">
							<h4 class="lf">竞争情报</h4>
						</div>
						<a href="javascript:;" class="rt sc-situation-rt">
							更多
							<i class="icon"></i>
						</a>
					</div>
					<div class="shop-filter orflow">
						<div class="ranking-30-wrap lf">
							<p class="shop-rank">引起流失店铺数</p>
							<span class="rank-num">0</span>
							<p class="result">较前日<span class="short-line">-</span></p>
						</div>
						<div class="ranking-30-wrap rt">
							<span class="rank">流失金额</span>
							<span class="rank-num ls"></span>
							<p class="result">较前日<i class="iconfont bbc_seller_color lsje"></i><span class="result-num lsje"></span></p>
						</div>
					</div>
					<div class="industry">
						<p class="industry-7">竞争店铺</p>
						<div class="shop_a"></div>
					</div>
				</div>
			</div>
		</div>
        <!-- 市场与竞争  end -->

        <!-- 重要提醒  start -->
		<div class="m white-panel">
			<div class="pannel_div">
				<div class="mt">
					<h3 class="bbc_seller_border">重要提醒</h3>
				</div>
			</div>
			<div class="import-wrap">
				<div>
					<div class="group-item">
						<h3 class="group-name">
							违规提醒
							<a href="javascript:;"><i class="icon"></i></a>
						</h3>
						<ul class="item-list">
							<li class="item-li lf">
								<a href="javascript:;">
									待投诉处理：
									<span>0</span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									待投诉诉讼：
									<span>0</span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									优化建议：
									<span>0</span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									待优化商品：
									<span>0</span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									售假违规累计扣分：
									<span>0</span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									一般违规累计扣分：
									<span>0</span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									管控记录：
									<span>0</span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									已售假次数：
									<span>0</span>
								</a>
							</li>
						</ul>
					</div>
					<div class="group-item">
						<h3 class="group-name">
							宝贝管理
						</h3>
						<ul class="item-list">
							<li class="item-li lf">
								<a href="javascript:;">
									出售中的宝贝：
									<span><?=$goods_state_normal_num?$goods_state_normal_num:'0'?></span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									等待上架的宝贝：
									<span><?=$goods_state_offline_num ? $goods_state_offline_num : '0'?></span>
								</a>
							</li>
						</ul>
					</div>
					<div class="group-item">
						<h3 class="group-name">
							订单提醒
							<a href="javascript:;"><i class="icon"></i></a>
						</h3>
						<ul class="item-list">
							<li class="item-li lf">
								<a href="javascript:;">
									待付款订单：
									<span class="dfk_count">0</span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									派件超时订单：
									<span>0</span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									待发货订单：
									<span class="dfh_count">0</span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									待评价订单
									<span class="dpj_count">0</span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									揽收超时订单
									<span>0</span>
								</a>
							</li>
						</ul>
					</div>
					<div class="group-item">
						<h3 class="group-name">
							推荐管理
							<a href="javascript:;"><i class="icon"></i></a>
						</h3>
						<ul class="item-list">
							<li class="item-li lf">
								<a href="javascript:;">
									已使用推荐：
									<span class="tj"></span>
								</a>
							</li>
							<li class="item-li lf">
								<a href="javascript:;">
									已使用猜你喜欢：
									<span class="xh"></span>
								</a>
							</li>
						</ul>
					</div>
					<div class="group-item">
						<h3 class="group-name">
							活动管理
						</h3>
						<ul class="item-list">
							<li class="item-li lf">
								<a href="javascript:;">
									邀请我参加的官方活动：
									<span>0</span>
								</a>
							</li>
						</ul>
					</div>
					<div class="group-item">
						<h3 class="group-name">
							服务订购
						</h3>
						<ul class="item-list">
							<li class="item-li lf">
								<a href="javascript:;">
									即将续费
									<span class="jjxx"></span>
								</a>
							</li>
							<li class="item-li lf line">
								<span>待确认订单：</span>
								<a href="javascript:;">
									<span>工具：</span>
									<span>0</span>
								</a>
								<a href="javascript:;">
									<span>摄影：</span>
									<span>0</span>
								</a>
								<a href="javascript:;">
									<span>服务：</span>
									<span>0</span>
								</a>
							</li>
							<li class="item-li lf line">
								<span>待付款订单：</span>
								<a href="javascript:;">
									<span>工具：</span>
									<span>0</span>
								</a>
								<a href="javascript:;">
									<span>摄影：</span>
									<span>0</span>
								</a>
								<a href="javascript:;">
									<span>服务：</span>
									<span>0</span>
								</a>
							</li>
						</ul>
					</div>
					<div class="group-item">
						<h3 class="group-name">
							安全评分
						</h3>
						<ul class="item-list">
							<li class="item-li lf">
								您的账号新安全评分为50分，请<a href="javascript:;" style="color:#338cea;">登录</a>后进入我的主页提升分数
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
        <!-- 重要提醒  end -->

        <!-- 实时数据  start -->
		<div class="m white-panel update-data">
			<div class="pannel_div">
				<div class="mt">
					<h3 class="bbc_seller_border">实时数据</h3>
				</div>
				<div class="update-time">
					更新时间： <span class="time"><?=date('Y-m-d H:i:s')?></span>
				</div>
				<div class="main-sale">
                    主营行业：<span class="sc_class"></span>
				</div>

				<a href="javascript:;" class="rt direct">实况直播</a>
			</div>
			<div class="update-wrap">
				<ul class="update-list orflow">
					<li class="lf update-item">
						<div class="live-wrapper">
							<i class="icon icon4"></i>
							<div class="index-detail">
								<p class="name">支付金额</p>
								<div class="live-counter">
									<span class="live-counter-inner zfje">0</span>
								</div>
							</div>
						</div>
						<div class="yesterday-data clearfix">
							<p class="name lf">昨日全天</p>
							<p class="yesterday-value num rt zfje">0</p>
						</div>
					</li>
					<li class="lf update-item">
						<div class="live-wrapper">
							<i class="icon icon1"></i>
							<div class="index-detail">
								<p class="name">访客数</p>
								<div class="live-counter">
									<span class="live-counter-inner fks">0</span>
								</div>
							</div>
						</div>
						<div class="yesterday-data clearfix">
							<p class="name lf">昨日全天</p>
							<p class="yesterday-value num rt fks">0</p>
						</div>
					</li>
					<li class="lf update-item">
						<div class="live-wrapper">
							<i class="icon icon5"></i>
							<div class="index-detail">
								<p class="name">支付买家数</p>
								<div class="live-counter">
									<span class="live-counter-inner zfmjs">0</span>
								</div>
							</div>
						</div>
						<div class="yesterday-data clearfix">
							<p class="name lf">昨日全天</p>
							<p class="yesterday-value num rt zfmjs">0</p>
						</div>
					</li>
					<li class="lf update-item">
						<div class="live-wrapper">
							<i class="icon icon3"></i>
							<div class="index-detail">
								<p class="name">浏览量</p>
								<div class="live-counter">
									<span class="live-counter-inner lll">0</span>
								</div>
							</div>
						</div>
						<div class="yesterday-data clearfix">
							<p class="name lf">昨日全天</p>
							<p class="yesterday-value num rt lll">0</p>
						</div>
					</li>
					<li class="lf update-item">
						<div class="live-wrapper">
							<i class="icon icon2"></i>
							<div class="index-detail">
								<p class="name">支付订单数</p>
								<div class="live-counter">
									<span class="live-counter-inner zfdds">0</span>
								</div>
							</div>
						</div>
						<div class="yesterday-data clearfix">
							<p class="name lf">昨日全天</p>
							<p class="yesterday-value num rt zfdds">0</p>
						</div>
					</li>
					<li class="lf update-item more">
						<p class="more-data"><a href="javascript:;">查看更多数据</a></p>
						<p class="give">数据由生意参谋提供</p>
					</li>
				</ul>
			</div>
		</div>
        <!-- 实时数据  end -->

        <!-- 资金管理  start -->
		<div class="m white-panel">
			<div class="pannel_div">
				<div class="mt">
					<h3 class="bbc_seller_border">资金管理</h3>
				</div>
			</div>
			<div class="cont">
				<div class="panel panel-zfb clearfix">
					<h2>财付宝余额</h2>
					<a href="javascript:;" class="a-wrap">
						<span class="money">
							<span class="number">0</span>元
						</span>
<!--						 <span class="txt txt-hide">隐藏余额</span>-->
<!--						 <span class="txt txt-show">显示余额</span>-->
					</a>
					<div class="sub-links clearfix">
						<a href="<?= YLB_Registry::get('paycenter_api_url') ?>?ctl=Info&met=transfer" target="_blank">
							转账
						</a>
						<a href="<?= YLB_Registry::get('paycenter_api_url') ?>?ctl=Info&met=withdraw" target="_blank">
							提现
						</a>
						<a href="<?= YLB_Registry::get('paycenter_api_url') ?>?ctl=Info&met=recordlist" target="_blank">
							交易记录
						</a>
						<a href="<?= YLB_Registry::get('paycenter_api_url') ?>" target="_blank">
							我的财付宝
						</a>
					</div>
				</div>
				<div class="panel panel-yeb clearfix">
					<h2>销售交易</h2>
					<a href="<?= YLB_Registry::get('paycenter_api_url') ?>?ctl=Info&met=recordlist" target="_blank" class="watch">
						查看交易
					</a>
					<div class="blue-card orflow">
						<i class="icon lf"></i>
						<div class="content">
							<a href="javascript:;" class="title">信用卡支付</a>
							<span class="des">免费开通</span>
						</div>
					</div>
					<div class="sub-links clearfix">
						<a href="javascript:;" target="_blank">
							转入
						</a>
						<a href="javascript:;" target="_blank">
							管理
						</a>
					</div>
				</div>
			</div>
		</div>
        <!-- 资金管理  end -->

        <!-- 店铺数据  start -->
		<div class="m white-panel">
			<div class="pannel_div">
				<div class="mt">
					<h3 class="bbc_seller_border">店铺数据</h3>
				</div>
			</div>
			<div class="shop-data-wrap">
				<div class="shop-data-1 shop-data orflow">
					<div class="title orflow">
						<p class="lf">行业排名</p>
						<a href="javascript:;" class="rt">
							<span class="date"><?=date('Y-m-d H:i:s')?></span>
						</a>
					</div>
					<div class="data-content">
						<p class="class_txt"><a href="javascript:;">点击查看行业排名趋势</a>：</p>
						<div class="num-one">
							<i class="icon mark"></i>
							<span class="num-01">

							</span>
							<span class="num-02">
								第<span class="boldlight">0</span>名
							</span>
							<span class="num-03">
								较日前&nbsp;<span class="rank-red">0名</span><i class="icon iconfont icon-jiantouxiangshang bbc_seller_color"></i>
							</span>
						</div>
						<div class="industry-level">
							<ul class="industry-level-list">
								<li class="industry-item first active lf">
									<p class="title">第一层级</p>
									<p class="bar"></p>
								</li>
								<li class="industry-item second lf">
									<p class="title">第二层级</p>
									<p class="bar"></p>
								</li>
								<li class="industry-item third lf">
									<p class="title">第三层级</p>
									<p class="bar"></p>
								</li>
								<li class="industry-item forth lf">
									<p class="title">第四层级</p>
									<p class="bar"></p>
								</li>
								<li class="industry-item fifth lf">
									<p class="title">第五层级</p>
									<p class="bar"></p>
								</li>
								<li class="industry-item sixth lf">
									<p class="title">第六层级</p>
									<p class="bar"></p>
								</li>
							</ul>
							<ul class="industry-level-price orflow">
								<li class="price-item first lf">
									0.0元
								</li>
								<li class="price-item lf">
									200.00元
								</li>
								<li class="price-item lf">
									500.00元
								</li>
								<li class="price-item lf">
									1000.00元
								</li>
								<li class="price-item lf">
									2000.00元
								</li>
								<li class="price-item lf">
									5000.00元
								</li>
								<li class="price-item last lf">
									∞
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="shop-data-2 shop-data orflow">
					<div class="title orflow">
						<p class="lf">交易概况</p>
						<a href="javascript:;" class="rt">
							<span class="date">查看交易分析</span>
						</a>
					</div>
					<div class="content">
						<div class="left-list-item item-one">
							<div>
								<span class="left-item-title">访客人数</span>
								<span class="left-item-num fkrs">0</span>
								<p class="left-item-rate rate-red">
									<span class="left-item-num fkrsbl">0%</span>
									<i class="icon iconfont icon-jiantouxiangshang bbc_seller_color"></i>
								</p>
							</div>
						</div>
						<div class="left-list-item item-two">
							<div>
								<span class="left-item-title">下单买家数</span>
								<span class="left-item-num xdmj">0</span>
								<p class="left-item-rate">
									<span>-</span>
									<!-- <i class="icon iconfont icon-jiantouxiangshang bbc_seller_color"></i> -->
								</p>
							</div>
							<div>
								<span class="left-item-title">下单金额</span>
								<span class="left-item-num xdje">0</span>
								<p class="left-item-rate">
									<span>-</span>
									<!-- <i class="icon iconfont icon-jiantouxiangshang bbc_seller_color"></i> -->
								</p>
							</div>
						</div>
						<div class="left-list-item item-three">
							<div>
								<span class="left-item-title">支付买家数</span>
								<span class="left-item-num zfmj">0</span>
								<p class="left-item-rate">
									<span>-</span>
									<!-- <i class="icon iconfont icon-jiantouxiangshang bbc_seller_color"></i> -->
								</p>
							</div>
							<div>
								<span class="left-item-title">支付金额</span>
								<span class="left-item-num zfje">0</span>
								<p class="left-item-rate">
									<span>-</span>
									<!-- <i class="icon iconfont icon-jiantouxiangshang bbc_seller_color"></i> -->
								</p>
							</div>
							<div>
								<span class="left-item-title">客单价</span>
								<span class="left-item-num kdj">0</span>
								<p class="left-item-rate">
									<span>-</span>
									<!-- <i class="icon iconfont icon-jiantouxiangshang bbc_seller_color"></i> -->
								</p>
							</div>
						</div>
						<div class="right-drawable">
							<div class="rating-1 rating">
								<span class="right-item-title">下单转化率</span>
								<span class="right-item-menu xdzhl">0%</span>
							</div>
							<div class="rating-2 rating">
								<span class="right-item-title">下单-支付转化率</span>
								<span class="right-item-menu xdzfzhl">0%</span>
							</div>
							<div class="rating-3 rating">
								<span class="right-item-title">支付转化率</span>
								<span class="right-item-menu zfzhl">0%</span>
							</div>
						</div>
					</div>
				</div>
				<div class="shop-data-3 shop-data orflow">
					<div class="title orflow">
						<p class="lf">重点诊断</p>
						<a href="javascript:;" class="rt">
							<span class="date">查看更多诊断</span>
						</a>
					</div>
					<div class="content">
						<ul class="zd-list">
							<li class="zd-item">
								<div class="zd-title lf">流量波动：</div>
								<p class="zd-content lf"></p>
							</li>
							<li class="zd-item">
								<div class="zd-title lf">访客特征：</div>
								<p class="zd-content lf">
<!--								近7天访客集中于：20:00-20:59（日均9人）, 广东省（日均17人），新访客（占96.25%），查看访客特征，提升下单转化！-->
                                </p>
							</li>
							<li class="zd-item">
								<div class="zd-title lf">交易转化：</div>
								<p class="zd-content lf"></p>
							</li>
							<li class="zd-item">
								<div class="zd-title lf">异常商品：</div>
								<p class="zd-content lf"></p>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
        <!-- 店铺数据  end -->

        <!-- 纠纷数据  start -->
		<div class="m white-panel">
			<div class="pannel_div">
				<div class="mt">
					<h3 class="bbc_seller_border">纠纷数据</h3>
				</div>
			</div>
			<div class="dispute-wrap">
				<ul class="dispute-list orflow">
					<li class="lf dispute-item">
						<h5>近30天纠纷退款率</h5>
						<p class="focus"><span id="shop_platform_refund_rate"></span></p>
						<p>主营类目均值：<span id="class_platform_refund_rate"></span></p>
						<p>纠纷笔数：<span class="shop_platform_refund"></span></p>
					</li>
					<li class="lf dispute-item">
						<h5>近30天退款速度</h5>
						<p class="focus"><span id="shop_refund_speed"></span></p>
						<p>主营类目均值：<span id="class_refund_speed"></span></p>
					</li>
					<li class="lf dispute-item">
						<h5>近30天退款率</h5>
						<p class="focus"><span id="shop_success_refund_rate"></span></p>
						<p>主营类目均值：<span id="class_refund_rate"></span></p>
						<p>纠纷笔数：<span class="shop_platform_refund"></span></p>
					</li>
					<li class="lf dispute-item">
						<h5>近30天品质退款率</h5>
						<p class="focus"><span id="shop_quality_refund_rate"></span></p>
						<p>主营类目均值：<span id="class_quality_refund_rate"></span></p>
						<p>纠纷笔数：<span class="shop_platform_refund"></span></p>
					</li>
					<li class="lf dispute-item">
						<h5>近30天投诉率</h5>
						<p class="focus"><span id="shop_complain_rate"></span></p>
						<p>纠纷笔数：<span class="shop_platform_refund"></span></p>
					</li>


                    <li class="lf dispute-item">
                        <h5>近30天纠纷退货率</h5>
                        <p class="focus"><span id="shop_platform_return_rate"></span></p>
                        <p>主营类目均值：<span id="class_platform_return_rate"></span></p>
                        <p>纠纷笔数：<span class="shop_platform_return"></span></p>
                    </li>
                    <li class="lf dispute-item">
                        <h5>近30天退货速度</h5>
                        <p class="focus"><span id="shop_return_speed"></span></p>
                        <p>主营类目均值：<span id="class_return_speed"></span></p>
                    </li>
                    <li class="lf dispute-item">
                        <h5>近30天退货率</h5>
                        <p class="focus"><span id="shop_success_return_rate"></span></p>
                        <p>主营类目均值：<span id="class_return_rate"></span></p>
                        <p>纠纷笔数：<span class="shop_platform_return"></span></p>
                    </li>
                    <li class="lf dispute-item">
                        <h5>近30天品质退货率</h5>
                        <p class="focus"><span id="shop_quality_return_rate"></span></p>
                        <p>主营类目均值：<span id="class_quality_return_rate"></span></p>
                        <p>纠纷笔数：<span class="shop_platform_return"></span></p>
                    </li>


					<li class="lf dispute-item more">
						<a href="javascript:;" target="_blank">
							查看指标定义
						</a>
					</li>
				</ul>
			</div>
		</div>
        <!-- 纠纷数据  end -->
		<!-- 此处 zxw  新添加 end -->

		<div class="m white-panel">
                    <div class="pannel_div">
			<div class="mt">
				<h3 class="bbc_seller_border">销售情况统计</h3>
				<h5>按周期统计商家店铺的订单量和订单金额</h5>
			</div>
			<div class="mc">
				<table width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td width="20%"></td>
						<td width="40%">订单量</td>
						<td width="40%">订单金额</td>
					</tr>
					<tr>
						<td>今日销量</td>
						<td><?=@$today['sales_num']?></td>
						<td><?=@format_money($today['order_sales'])?></td>
					</tr>
					<tr>
						<td>周销量</td>
						<td><?=@$week['sales_num']?></td>
						<td><?=@format_money($week['order_sales'])?></td>
					</tr>
					<tr>
						<td>月销量</td>
						<td><?=@$month['sales_num']?></td>
						<td><?=@format_money($month['order_sales'])?></td>
					</tr>
				</table>
			</div>
                    </div>

		</div>

        <!--单品销售排名 start-->
		<div class="m white-panel">
            <div class="pannel_div">
			<div class="mt">
				<h3 class="bbc_seller_border">单品销售排名</h3>
				<h5>掌握30日内最热销的商品及时补充货源</h5>
			</div>
			<div class="mc rank">
				<table width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td width="50">排名</td>
						<td colspan="2" class="tl">商品信息</td>
						<td width="70">销量</td>
					</tr>
					<?php
					foreach($shop_top_rows as $key=>$shop_top_row):
					?>
					<tr>
						<td><?=$key+1?></td>
						<td class="tl" width="40"><a target="_blank" href="<?=YLB_Registry::get('index_page')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$shop_top_row['goods_id']?>"><img width="32" src="<?=image_thumb($shop_top_row['goods_image'], 60, 60)?>" /></a></td>
						<td class="tl"><a target="_blank" href="<?=YLB_Registry::get('index_page')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$shop_top_row['goods_id']?>"><?=$shop_top_row['goods_name']?></a></td>
						<td><?=$shop_top_row['goods_num']?></td>
					</tr>
					<?php
					endforeach;
					?>
				</table>
			</div>
            </div>
		</div>
        <!--单品销售排名 end-->

        <!--店铺运营推广 start-->
        <div class="m white-panel">
         <div class="pannel_div">
        <div class="mt">
            <h3 class="bbc_seller_border"><?=_('店铺运营推广')?></h3>
            <h5><?=_('合理参加促销活动可以有效提升商品销量')?></h5>
        </div>
        <div class="mc">
            <div class="content">
                <?php if($data['promotion_items']['scarebuy_allow_flag']){  ?>
                <dl class="tghd">
                    <dt class="p-name"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_ScareBuy&met=index&typ=e"><?=_('惠抢购')?></a></dt>
                    <dd class="p-ico"></dd>
                    <dd class="p-hint">
                        <i class="icon-ok-sign"></i><?php if($data['promotion_items']['scarebuy_combo_flag']){ ?><?=_('已开通')?><?php }else{ ?><?=_('未开通')?><?php } ?>
                    </dd>
                    <dd class="p-info"><?=_('参与平台发起的团购活动提高商品成交量及店铺浏览量')?></dd>
                </dl>
                <?php } ?>

                <?php if($data['promotion_items']['promotion_allow_flag']){   ?>
                <dl class="zhxs">
                    <dt class="p-name"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Increase&met=index&typ=e&op=list"><?=_('加价购')?></a></dt>
                    <dd class="p-ico"></dd>
                    <dd class="p-hint">
                        <span><i class="icon-ok-sign"></i><?php if($data['promotion_items']['promotion_increase_combo_flag']){ ?><?=_('已开通')?><?php }else{ ?><?=_('未开通')?><?php } ?></span>
                    </dd>
                    <dd class="p-info"><?=_('商品优惠套餐、多重搭配更多实惠、商家必备营销方式')?></dd>
                </dl>
                <dl class="xszk">
                    <dt class="p-name"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Discount&met=index&typ=e"><?=_('限时折扣')?></a></dt>
                    <dd class="p-ico"></dd>
                    <dd class="p-hint"><span>
                                    <i class="icon-ok-sign"></i><?php if($data['promotion_items']['promotion_discount_combo_flag']){ ?><?=_('已开通')?><?php }else{ ?><?=_('未开通')?> <?php } ?>
                                    </span></dd>
                    <dd class="p-info"><?=_('在规定时间段内对店铺中所选商品进行打折促销活动')?></dd>
                </dl>
                <dl class="mjs">
                    <dt class="p-name"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_MeetConditionGift&met=index&typ=e"><?=_('满即送')?></a></dt>
                    <dd class="p-ico"></dd>
                    <dd class="p-hint"><span>
                                    <i class="icon-ok-sign"></i><?php if($data['promotion_items']['promotion_mansong_combo_flag']){ ?><?=_('已开通')?><?php }else{ ?><?=_('未开通')?> <?php } ?>
                                    </span></dd>
                    <dd class="p-info"><?=_('商家自定义满即送标准与规则，促进购买转化率')?></dd>
                </dl>
                <?php  }  ?>

                <?php if($data['promotion_items']['voucher_allow_flag']){ ?>
                <dl class="djq">
                    <dt class="p-name"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Voucher&met=index&typ=e"><?=_('代金券')?></a></dt>
                    <dd class="p-ico"></dd>
                    <dd class="p-hint"><span>
                                    <i class="icon-ok-sign"></i><?php if($data['promotion_items']['voucher_combo_flag']){ ?><?=_('已开通')?><?php }else{ ?><?=_('未开通')?> <?php } ?>
                                    </span>
                    </dd>
                    <dd class="p-info"><?=_('自定义代金券使用规则并由平台统一展示供买家领取')?></dd>
                </dl>
                <?php } ?>

                <?php if(Web_ConfigModel::value('Plugin_Directseller')&&(@$this->shop_base['shop_type'] != 2)){ ?>
                <dl class="djq">
                    <dt class="p-name">
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Distribution_Seller_Setting&met=index&typ=e"><?=_('销售员')?></a>
                    </dt>
                    <dd class="p-ico"></dd>
                    <dd class="p-hint">
                        <span>
                            <i class="icon-ok-sign"></i>
                            <?=_('已开通')?>
                        </span>
                    </dd>
                    <dd class="p-info"><?=_('让客户来推广店铺，获得佣金')?></dd>
                </dl>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
        <!--店铺运营推广 end-->

        <!--资讯信息 start -->
        <div class="m white-panel">
            <div class="pannel_div">
                <div class="mt">
                    <h3 class="bbc_seller_border">资讯信息</h3>
                    <h5>平台资讯信息、活动</h5>
                </div>
                <div class="mc rank">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="50">序号</td>
                            <td colspan="2" class="tl">资讯信息</td>
                            <td width="80">发布时间</td>
                        </tr>
                        <?php
                        foreach($information['items'] as $key=>$val):
                            ?>
                            <tr>
                                <td><?=$key+1?></td>
                                <td class="tl" width="40">
                                    <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=News&met=detail&id=<?= $val['information_id'] ?>">
                                        <img width="32" src="<?=image_thumb($val['information_pic'], 60, 60)?>" />
                                    </a>
                                </td>
                                <td class="tl">
                                    <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=News&met=detail&id=<?= $val['information_id'] ?>">
                                        <?=$val['information_title']?>
                                    </a>
                                </td>
                                <td><?=substr($val['information_add_time'],0,10)?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <!--资讯信息 end-->

		<?php if($phone || $email){?>
            <div class="m white-panel">
                <div class="pannel_div">
                    <div class="mt">
                        <h3 class="bbc_seller_border">平台联系方式</h3>
                        <h5>有相关不懂得地方可以咨询平台</h5>
                    </div>
                    <div class="mc">
                        <ol class="fn-clear">
                            <?php if($phone){?>
                                <?php foreach($phone as $k=>$v){?>
                                    <li>客服电话：<?=$v;?></li>
                                <?php }?>
                            <?php }?>
                            <?php if($email){?>
                                <li>客服邮箱：<?=$email?></li>
                            <?php }?>
                        </ol>
                    </div>
                </div>
            </div>
		<?php }?>
	</div>

	<script src="<?=$this->view->js?>/pinterest_grid.js"></script>
    <script>
        //  重要提醒  点击  展开 收起 start
        $(".import-wrap .group-name a").click(function(){
            if( $(this).parent(".group-name").parent(".group-item").hasClass("spread") ) {
                $(this).parent(".group-name").parent(".group-item").removeClass("spread");
                $(this).parent(".group-name").siblings(".item-list").children(".zero").hide();
            }else {
                $(this).parent(".group-name").parent(".group-item").addClass("spread");
                $(this).parent(".group-name").siblings(".item-list").children(".zero").show();
            }
        })
        // 重要提醒  数字不为0的span高亮  start

        $(".container_cj").pinterest_grid({
            no_columns:2,
            padding_x:10,
            padding_y:10,
            margin_bottom: 50,
            single_column_breakpoint: 700
        });

        $(function() {
            //重要提醒
            $.post(SITE_URL+ '?ctl=Seller_Index&met=get_goods_row&typ=json',{},function (data) {
                var data = data.data;
                if(data.recommend){
                    $('.tj').html(data.recommend);
                }
                if(data.like){
                    $('.xh').html('20/'+data.like);
                }
                if(data.row_count){
                    $('.jjxx').html(data.row_count);
                }

            })

            //实时数据
            $.post(SITE_URL+ '?ctl=Seller_Index&met=get_real_time&typ=json',{},function (data){
                var data = data.data;
                //金额
                $('.live-counter-inner.zfje').html(data.order_status_row.order_payment_amount);
                $('.yesterday-value.num.rt.zfje').html(data.order_status_row_yesterday.order_payment_amount);
                //买家数
                $('.live-counter-inner.zfmjs').html(data.order_status_row.order_user_count);
                $('.yesterday-value.num.rt.zfmjs').html(data.order_status_row_yesterday.order_user_count);
                //订单数
                $('.live-counter-inner.zfdds').html(data.order_status_row.order_list);
                $('.yesterday-value.num.rt.zfdds').html(data.order_status_row_yesterday.order_list);
                $('.live-counter-inner.lll').html(data.user_foot_date);
                $('.yesterday-value.num.rt.lll').html(data.user_foot_yesterday);
                $('.live-counter-inner.fks').html(data.user_visitor_today);
                $('.yesterday-value.num.rt.fks').html(data.user_visitor_yesterday);
                //交易概况-访客人数
                $('.left-item-num.fkrs').html(data.user_visitor_today);
                $('.left-item-num.fkrsbl').html(data.scale+'%');
              if(data.scale_absol == -1){
                  $('.icon.iconfont.icon-jiantouxiangshang.bbc_seller_color').removeClass('icon-jiantouxiangshang').addClass('icon-jiantouxiangxia');
              }
            })

            //市场与竞争
            $.post(SITE_URL+ '?ctl=Seller_Index&met=get_marketplace&typ=json',{},function (data){
                var data = data.data;
                if(data.cat_max_name){
                    $('.sc_class').html(data.cat_max_name);
                    $('.class_txt').html('根据淘尚168商城集市商家最近30天的财付宝成交金额计算，您的店铺在淘尚168商城 '+data.cat_max_name+' 类目排名如下，了解更多请');
                }
                if(data.shop_salenum_max.length > 0){
                    for (var i=0;i<data.shop_salenum_max.length;i++)
                    {
                        $('.shop_a').append(' <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id='+data.shop_salenum_max[i]['shop_id']+'" target="_blank"><div class="shop"> <img src="https://img.alicdn.com/tfs/TB1.dXrRVXXXXbdXVXXXXXXXXXX-22-26.png"><span class="text-1">'+ data.shop_salenum_max[i]['shop_name']+'</span></div></a>')
                    }
                }else{
                    $('.shop_a').append('<p>近七天无店铺热销</p>')
                }
                if(data.shop_order_money){
                    $('.rank-num.ls').html(data.shop_order_money);
                }else{
                    $('.rank-num.ls').html(0);
                }
                if(data.shop_account_month_row){
                    $('.rank-num.zf').html(data.shop_account_month_row);
                }else{
                    $('.rank-num.zf').html(0);
                }
                if(data.order_account_list_status==1){
                    $('.result-num.zfje').html(data.order_account_list_status);
                    $(".iconfont.bbc_seller_color.zfje").addClass("icon-jiantouxiangshang");
                }else{
                    $('.result-num.zfje').html(data.order_account_list_status);
                    $(".iconfont.bbc_seller_color.zfje").addClass("icon-jiantouxiangxia");
                }

                if(data.order_payment_amount_list_status==1){
                    $('.result-num.lsje').html(data.order_payment_amount_list);
                    $(".iconfont.bbc_seller_color.lsje").addClass("icon-jiantouxiangshang");
                }else{
                    $('.result-num.lsje').html(data.order_payment_amount_list);
                    $(".iconfont.bbc_seller_color.lsje").addClass("icon-jiantouxiangxia");
                }

                if(data.shop_tier>0 && data.shop_tier<200){
                    $('.rank-num.sjcj').html('一');
                    $('.num-01').html('第一层级');
                }else if(data.shop_tier>200 && data.shop_tier<500){
                    $('.rank-num.sjcj').html('二');
                    $('.num-01').html('第二层级');
                }else if(data.shop_tier>500 && data.shop_tier<1000){
                    $('.rank-num.sjcj').html('三');
                    $('.num-01').html('第三层级');
                }else if(data.shop_tier>1000 && data.shop_tier<2000){
                    $('.rank-num.sjcj').html('四');
                    $('.num-01').html('第四层级');
                }else if(data.shop_tier>2000 && data.shop_tier<5000){
                    $('.rank-num.sjcj').html('五');
                    $('.num-01').html('第五层级');
                }else if(data.shop_tier>5000){
                    $('.rank-num.sjcj').html('六');
                    $('.num-01').html('第六层级');
                }
            })
            //交易状况
            $.post(SITE_URL + '?ctl=Seller_Index&met=get_condition&typ=json', {}, function (data){
                var data = data.data;
                $('.left-item-num.xdmj').html(data.order_user_count);
                $('.left-item-num.xdje').html(data.order_payment_amount);
                $('.left-item-num.zfmj').html(data.account_user_count);
                $('.left-item-num.zfje').html(data.account_payment_amount);
                $('.left-item-num.kdj').html(data.per_account);
                $('.right-item-menu.xdzhl').html(data.order_conversion+'%');
                $('.right-item-menu.xdzfzhl').html(data.order_pay_conversion+'%');
                $('.right-item-menu.zfzhl').html(data.pay_conversion+'%');
            })

            //交易提示 初始化
            $.post(SITE_URL + '?ctl=Seller_Trade_Order&met=getOrderNum&typ=json', {}, function (data) {
                if ( data.status == 200 )
                {
                    var data = data.data, order_num_list = $('#order_num_list').children();

                    if ( data.wait_pay_num > 0 ) {
                        $(order_num_list[0]).children('a').addClass('num  bbc_border bbc_color').append('<em class="bbc_seller_bg">' + data.wait_pay_num + '</em>');
                        $('.dfk_count').html(data.wait_pay_num);

                    }

                    if ( data.payed_num > 0 ) {
                        $(order_num_list[1]).children('a').addClass('num  bbc_border bbc_color').append('<em class="bbc_seller_bg">' + data.payed_num + '</em>');
                        $('.dfh_count').html(data.payed_num);
                    }

                    if ( data.refund_num > 0 ) {
                        $(order_num_list[2]).children('a').addClass('num  bbc_border bbc_color').append('<em class="bbc_seller_bg">' + data.refund_num + '</em>');
                    }
                    if( data.evaluation_num > 0) {
                        $('.dpj_count').html(data.evaluation_num);
                    }

                    if ( data.return_num > 0 ) {
                        $(order_num_list[3]).children('a').addClass('num  bbc_border bbc_color').append('<em class="bbc_seller_bg">' + data.return_num + '</em>');
                    }
                }
            })
            $.ajax({
                type: "GET",
                url: SITE_URL + "?ctl=Buyer_Index&met=getUserInfoMoney&typ=json",
                data: {},
                dataType: "json",
                success: function(data){
                    var html = '';

                    $.each(data, function(commentIndex, comment){

                    });

                    $('.number').html(data.data[0]);
                }
            });

            $.post(SITE_URL  + '?ctl=Seller_Index&met=getDispute&typ=json',function(data) {
                if (data.data){
                    $('#shop_platform_refund_rate').html(data.data.shop_platform_refund_rate);
                    $('#class_platform_refund_rate').html(data.data.class_platform_refund_rate);
                    $('#shop_refund_speed').html(data.data.shop_refund_speed);
                    $('#class_refund_speed').html(data.data.class_refund_speed);
                    $('#shop_success_refund_rate').html(data.data.shop_success_refund_rate);
                    $('#class_refund_rate').html(data.data.class_refund_rate);
                    $('#shop_quality_refund_rate').html(data.data.shop_quality_refund_rate);
                    $('#class_quality_refund_rate').html(data.data.class_quality_refund_rate);
                    $('#shop_complain_rate').html(data.data.shop_complain_rate);
                    $('.shop_platform_refund').html(data.data.shop_platform_refund_count);

                    $('#shop_platform_return_rate').html(data.data.shop_platform_return_rate);
                    $('#class_platform_return_rate').html(data.data.class_platform_return_rate);
                    $('#shop_return_speed').html(data.data.shop_return_speed);
                    $('#class_return_speed').html(data.data.class_return_speed);
                    $('#shop_success_return_rate').html(data.data.shop_success_return_rate);
                    $('#class_return_rate').html(data.data.class_return_rate);
                    $('#shop_quality_return_rate').html(data.data.shop_quality_return_rate);
                    $('#class_quality_return_rate').html(data.data.class_quality_return_rate);
                    $('.shop_platform_return').html(data.data.shop_platform_return_count);
                }
            })


            //重点诊断
            $.ajax({
                type: "POST",
                url: SITE_URL + "?ctl=Seller_Index&met=get_diagnosis&typ=json",
                dataType: "json",
                success: function(e){
                    var data = e.data;
                    //流量波动
                    if( data.l_Liang )
                    {
                        var liu = '近7天访客'+data.l_Liang.sevenCount+'人，较上7天'+data.l_Liang.tip+data.l_Liang.num+'%，立即查看<a href="javascript:;">流量来源</a>,定位原因！';
                        $(".zd-list li").eq(0).find("p").html( liu )
                    }
                    else
                    {
                        $(".zd-list li").eq(0).find("p").html("暂无数据...");
                    }
                    //访客特征
                    if( data.t_zheng )
                    {}
                    else
                    {
                        $(".zd-list li").eq(1).find("p").html( '暂无数据...' )
                    }
                    //交易转化
                    if( data.z_hua)
                    {
                        var zhuan = data.z_hua.num+'%的访客看了主力宝贝，没有转化就离开，真遗憾！赶紧 <a href="javascript:;">宝贝效果</a>详情，优化宝贝。';
                        $(".zd-list li").eq(2).find("p").html( zhuan )
                    }
                    else
                    {
                        $(".zd-list li").eq(2).find("p").html( '暂无数据...' )
                    }

                    //异常商品
                    if( data.y_goods )
                    {
                        var y_chang = '最近7天，'+data.y_goods.num+'个商品流量下跌50%以上，点击查看 <a href="javascript:;">异常商品</a>，分析异常原因。';
                        $(".zd-list li").eq(3).find("p").html( y_chang )
                    }
                    else
                    {
                        $(".zd-list li").eq(3).find("p").html( '暂无数据...' )
                    }
                }
            })
        })
    </script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>






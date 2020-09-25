<?php if (!defined('ROOT_PATH')){exit('No Permission');}
include $this->view->getTplPath() . '/' . 'site_nav.php';
?>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/openbase.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/opening.css">
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.timeCountDown.js" ></script>
</head>
<body> 
    <div class="container-wrap opening-wrap">
		<div class="IMG-header-container" style="position: relative;">
			<div class="IMG-header">
				<img src="<?=$opening_img?>">
			</div>
		</div>
		<div class="container w-1200 pt-620">
			<div class="IMG-middle">
				<img src="<?=$this->view->img ?>/opening/header_bottom.png">
			</div>

			<div class="opening-voucher-wrap clearfix">
                <!--优惠券 start-->
				<ul class="voucher-list clearfix">
                    <?php foreach($voucher['items'] as $key=>$value){?>
					<li class="lf voucher-item voucherBG<?=($key+1)?>">
						<a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=activity&id='.$value['shop_id'] ?>" target="_Blank">
							<div class="opening-receive lf">
								立即领取
							</div>
							<div class="voucher-desc-wrap">
								<p class="voucher-desc">
									<span class="small-font">￥</span><span class="num price"><?=$value['voucher_t_price']?></span>优惠券
								</p>
                                <!--代金券向下取整-->
								<p class="voucher-desc">满<?=floor($value['voucher_t_limit']) ?>减<?=$value['voucher_t_price']?>元</p>
							</div>
						</a>
					</li>
                    <?php } ?>

				</ul>
                <!--优惠券 end-->
			</div>
            <!--限时秒杀 start-->
			<div class="area-panel limited-spike-panel">
				<div class="panel-titleImg">
					<a href="<?=YLB_Registry::get('url').'?ctl=ScareBuy&met=index'?>" name="<?=$opening_parent_cat[0]['key_name']?>" target="_Blank">
						<span class="title"><?=$opening_parent_cat[0]['opening_name'] ?></span>
						<img src="<?=$this->view->img ?>/opening/title_bg.png">
					</a>
				</div>

				<div class="content">
					<div class="switch-wrap">
						<ul class="switch-list clearfix">
							<li class="lf switch-item clearfix active">
								<p class="time-range lf">09:00-12:00</p>
								<div class="range-desc lf">
									<span class="activity-state"><?php if(strtotime($now.' '.'9:00:00')<time() && strtotime($now.' '.'12:00:00')>time()){?>正在秒杀<?php }else{ ?>即将开始<?php } ?></span>
									<div class="activity-line2">
										<p><?php if(strtotime($now.' '.'9:00:00')<time() && strtotime($now.' '.'12:00:00')>time()){?>秒杀进行中<?php }else{ ?>即将开始<?php } ?></p>
										<p><?php if(strtotime($now.' '.'9:00:00')<time() && strtotime($now.' '.'12:00:00')>time()){?>距离结束<?php }else{ ?>距离开始<?php } ?>
                                        <span class="fnTimeCountDown" data-end="<?php if(time()<strtotime($now.' '.'9:00:00')|| time()>strtotime($now.' '.'12:00:00')){if(strtotime($now.' '.'12:00:00')<time() && strtotime($tomo)>time()){echo $tomo.' '.'9:00:00';}else{echo $now.' '.'9:00:00';} ;}else if(time()>strtotime($now.' '.'9:00:00') && time()<strtotime($now.' '.'12:00:00')){echo $now.' '.'12:00:00';}?>">
                                            <span class="hour">00</span>：
                                            <span class="mini">00</span>：
                                            <span class="sec">00</span>
                                        </span>
										</p>
									</div>
								</div>
							</li>
							<li class="lf switch-item clearfix">
								<p class="time-range lf">14:00-17:00</p>
								<div class="range-desc lf">
                                    <span class="activity-state"><?php if(strtotime($now.' '.'14:00:00')<time() && strtotime($now.' '.'17:00:00')>time()){?>正在秒杀<?php }else{ ?>即将开始<?php } ?></span>
                                    <div class="activity-line2">
                                        <p><?php if(strtotime($now.' '.'14:00:00')<time() && strtotime($now.' '.'17:00:00')>time()){?>秒杀进行中<?php }else{ ?>即将开始<?php } ?></p>
                                        <p><?php if(strtotime($now.' '.'14:00:00')<time() && strtotime($now.' '.'17:00:00')>time()){?>距离结束<?php }else{ ?>距离开始<?php } ?>
                                            <span class="fnTimeCountDown" data-end="<?php if(time()<strtotime($now.' '.'14:00:00')|| time()>strtotime($now.' '.'17:00:00')){if(strtotime($now.' '.'17:00:00')<time() && strtotime($tomo)>time()){echo $tomo.' '.'14:00:00';}else{echo $now.' '.'14:00:00';} ;}else if(time()>strtotime($now.' '.'14:00:00') && time()<strtotime($now.' '.'17:00:00')){echo $now.' '.'17:00:00';}?>">
                                            <span class="hour">00</span>：
                                            <span class="mini">00</span>：
                                            <span class="sec">00</span>
                                            </span>
										</p>
									</div>
								</div>
							</li>
							<li class="lf switch-item clearfix">
								<p class="time-range lf">19:00-22:00</p>
								<div class="range-desc lf">
									<span class="activity-state"><?php if(strtotime($now.' '.'19:00:00')<time() && strtotime($now.' '.'22:00:00')>time()){?>正在秒杀<?php }else{ ?>即将开始<?php } ?></span>
									<div class="activity-line2">
										<p><?php if(strtotime($now.' '.'19:00:00')<time() && strtotime($now.' '.'22:00:00')>time()){?>秒杀进行中<?php }else{ ?>即将开始<?php } ?></p>
										<p><?php if(strtotime($now.' '.'19:00:00')<time() && strtotime($now.' '.'22:00:00')>time()){?>距离结束<?php }else{ ?>距离开始<?php } ?>
                                            <span class="fnTimeCountDown" data-end="<?php if(time()<strtotime($now.' '.'19:00:00')|| time()>strtotime($now.' '.'22:00:00')){if(strtotime($now.' '.'22:00:00')<time() && strtotime($tomo)>time()){echo $tomo.' '.'19:00:00';}else{echo $now.' '.'19:00:00';} ;}else if(time()>strtotime($now.' '.'19:00:00') && time()<strtotime($now.' '.'22:00:00')){echo $now.' '.'22:00:00';}?>">
                                            <span class="hour">00</span>：
                                            <span class="mini">00</span>：
                                            <span class="sec">00</span>
                                            </span>
										</p>
									</div>
								</div>
							</li>
						</ul>
					</div>

					<div class="switch-content">

						<ul class="commodity-list clearfix">
                            <?php foreach($data['xianshi1'] as $key=>$value){ ?>
							<li class="commodity-item lf clearfix">
								<a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&gid='.$value['id_goods']?>" target="_Blank">
									<div class="img-wrap lf">
										<img src="<?=$value['common_image'] ?>">
									</div>
									<div class="commodity-desc rt">
										<p class="commodity-text text2"><?=$value['common_name'] ?>  </p>
										<div class="share-wrap clearfix">
		                                    <div class="share lf">
		                                        <span>分享立减</span>
		                                        <span class="save">￥<?=$value['common_share_price']?></span>
		                                    </div>
		                                </div>
		                                <div class="share-wrap clearfix">
		                                	<div class="share lf">
		                                        <span>立赚</span>
		                                        <span class="save">￥<?=$value['common_promotion_price']?></span>
		                                    </div>
		                                </div>
		                                <div class="moment-price-wrap">
		                                	秒杀价：<span class="moment-price">￥<?php echo $value['scarebuy_price'] ? $value['scarebuy_price']:$value['common_shared_price'] ?></span>
		                                </div>
                                        <?php if(strtotime($now.' '.'9:00:00')<time() && strtotime($now.' '.'12:00:00')>time()){?>
		                                <div class="toBuy-wrap mt-10 clearfix">
		                                	<div class="toBuy-btn lf">立即抢购</div>
		                                	<div class="count-down lf">
                                                <span class="fnTimeCountDown" data-end="<?=$now ?> 12:00:00">
		                                		<span class="hour">00</span>:
                                                <span class="mini">00</span>:
                                                <span class="sec">00</span>
                                                </span>
		                                	</div>
		                                </div>
                                        <?php } ?>
									</div>
								</a>
							</li>
                            <?php } ?>

						</ul>

                        <ul class="commodity-list clearfix">
                            <?php foreach($data['xianshi2'] as $key=>$value){ ?>
                                <li class="commodity-item lf clearfix">
                                    <a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&gid='.$value['id_goods']?>" target="_Blank">
                                        <div class="img-wrap lf">
                                            <img src="<?=$value['common_image'] ?>">
                                        </div>
                                        <div class="commodity-desc rt">
                                            <p class="commodity-text text2"><?=$value['common_name'] ?>  </p>
                                            <div class="share-wrap clearfix">
                                                <div class="share lf">
                                                    <span>分享立减</span>
                                                    <span class="save">￥<?=$value['common_share_price']?></span>
                                                </div>
                                            </div>
                                            <div class="share-wrap clearfix">
                                                <div class="share lf">
                                                    <span>立赚</span>
                                                    <span class="save">￥<?=$value['common_promotion_price']?></span>
                                                </div>
                                            </div>
                                            <div class="moment-price-wrap">
                                                秒杀价：<span class="moment-price">￥<?php echo $value['scarebuy_price'] ? $value['scarebuy_price']:$value['common_shared_price'] ?></span>
                                            </div>
                                            <?php if(strtotime($now.' '.'14:00:00')<time() && strtotime($now.' '.'17:00:00')>time()){?>
                                                <div class="toBuy-wrap mt-10 clearfix">
                                                    <div class="toBuy-btn lf">立即抢购</div>
                                                    <div class="count-down lf">
                                                <span class="fnTimeCountDown" data-end="<?=$now ?> 17:00:00">
		                                		<span class="hour">00</span>:
                                                <span class="mini">00</span>:
                                                <span class="sec">00</span>
                                                </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>

                        </ul>

                        <ul class="commodity-list clearfix">
                            <?php foreach($data['xianshi3'] as $key=>$value){ ?>
                                <li class="commodity-item lf clearfix">
                                    <a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&gid='.$value['id_goods']?>" target="_Blank">
                                        <div class="img-wrap lf">
                                            <img src="<?=$value['common_image'] ?>">
                                        </div>
                                        <div class="commodity-desc rt">
                                            <p class="commodity-text text2"><?=$value['common_name'] ?>  </p>
                                            <div class="share-wrap clearfix">
                                                <div class="share lf">
                                                    <span>分享立减</span>
                                                    <span class="save">￥<?=$value['common_share_price']?></span>
                                                </div>
                                            </div>
                                            <div class="share-wrap clearfix">
                                                <div class="share lf">
                                                    <span>立赚</span>
                                                    <span class="save">￥<?=$value['common_promotion_price']?></span>
                                                </div>
                                            </div>
                                            <div class="moment-price-wrap">
                                                秒杀价：<span class="moment-price">￥<?php echo $value['scarebuy_price'] ? $value['scarebuy_price']:$value['common_shared_price'] ?></span>
                                            </div>
                                            <?php if(strtotime($now.' '.'19:00:00')<time() && strtotime($now.' '.'22:00:00')>time()){?>
                                                <div class="toBuy-wrap mt-10 clearfix">
                                                    <div class="toBuy-btn lf">立即抢购</div>
                                                    <div class="count-down lf">
                                                <span class="fnTimeCountDown" data-end="<?=$now ?> 22:00:00">
		                                		<span class="hour">00</span>:
                                                <span class="mini">00</span>:
                                                <span class="sec">00</span>
                                                </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>

                        </ul>
					</div>
				</div>
			</div>
            <!--限时秒杀 end-->

			<!-- 低至9.9 start -->
			<div class="area-panel line-6-panel">
				<div class="panel-titleImg">
					<a href="<?=YLB_Registry::get('url').'?ctl=Goods_Cheap&met=index'?>" name="<?=$opening_parent_cat[1]['key_name']?>" target="_Blank">
						<span class="title"><?=$opening_parent_cat[1]['opening_name']?></span>
						<img src="<?=$this->view->img ?>/opening/title_bg.png">
					</a>
				</div>

				<div class="content">
					<ul class="commodity-list clearfix">
                        <?php foreach ($data['dizhi'] as $key=>$value){?>
						<li class="commodity-item lf clearfix">
							<a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&gid='.$value['id_goods']?>" target="_Blank">
								<div class="img-wrap">
									<img src="<?=$value['common_image'] ?>">
								</div>
								<div class="commodity-desc">
									<p class="commodity-text text1"><?=$value['common_name'] ?></p>
									<div class="share-wrap clearfix">
	                                    <div class="share lf">
	                                        <span>分享立减</span>
	                                        <span class="save">￥<?=$value['common_share_price']?></span>
	                                    </div>
	                                </div>
	                                <div class="share-wrap clearfix">
	                                	<div class="share lf">
	                                        <span>立赚</span>
	                                        <span class="save">￥<?=$value['common_promotion_price']?></span>
	                                    </div>
	                                </div>
	                                <div class="toBuy-wrap mt-10 clearfix">
	                                	<span class="price lf">￥<?=$value['common_shared_price']?></span>
	                                	<div class="toBuy-btn rt">立即购买</div>
	                                </div>
								</div>
							</a>
						</li>
                        <?php } ?>
					</ul>
				</div>
			</div>
			<!-- 低至9.9 end -->

			<!-- 限时半价 start -->
			<div class="area-panel line-4-panel">
				<div class="panel-titleImg">
					<a href="<?=YLB_Registry::get('url').'?ctl=DiscountBuy&met=index'?>" name="<?=$opening_parent_cat[2]['key_name']?>" target="_Blank">
						<span class="title"><?=$opening_parent_cat[2]['opening_name']?></span>
						<img src="<?=$this->view->img ?>/opening/title_bg.png">
					</a>
				</div>
				<div class="content">
					<ul class="commodity-list clearfix">
                        <?php foreach($data['banjia'] as $key=>$value){ ?>
						<li class="commodity-item lf clearfix">
							<a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&gid='.$value['id_goods']?>" target="_Blank">
								<div class="img-wrap">
									<img src="<?=$value['common_image'] ?>">
								</div>
								<div class="commodity-desc">
									<p class="commodity-text text1"><?=$value['common_name'] ?></p>
									<div class="share-wrap clearfix">
	                                    <div class="share lf">
	                                        <span>分享立减</span>
	                                        <span class="save">￥<?=$value['common_share_price']?></span>
	                                    </div>
	                                    <div class="share rt">
	                                        <span>立赚</span>
	                                        <span class="save">￥<?=$value['common_promotion_price']?></span>
	                                    </div>
	                                </div>
	                                <div class="toBuy-wrap mt-25 clearfix">
	                                	<span class="price lf">￥<?php echo $value['scarebuy_price'] ? $value['scarebuy_price']:$value['common_shared_price'] ?></span>
	                                	<span class="old-price lf">￥<?=$value['common_price']?></span>
	                                	<div class="toBuy-btn rt">立即购买</div>
	                                </div>
								</div>
							</a>
						</li>
                        <?php } ?>
					</ul>
				</div>
			</div>
			<!-- 限时半价 end -->

			<!-- 热卖推荐 start -->
			<div class="area-panel line-6-panel">
				<div class="panel-titleImg">
					<a href="<?=YLB_Registry::get('url')?><?=$opening_parent_cat[3]['temp']['temp_url']?>&base_id=<?=$opening_parent_cat[3]['base_id']?>&adv_key=oldyear_pc" name="<?=$opening_parent_cat[3]['key_name']?>" target="_Blank">
						<span class="title"><?=$opening_parent_cat[3]['opening_name']?></span>
						<img src="<?=$this->view->img ?>/opening/title_bg.png">
					</a>
				</div>
				<div class="content">
					<ul class="commodity-list clearfix">
                        <?php foreach($data['remai'] as $key=>$value){?>
						<li class="commodity-item lf clearfix">
							<a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&gid='.$value['id_goods']?>" target="_Blank">
								<div class="img-wrap">
									<img src="<?=$value['common_image'] ?>">
								</div>
								<div class="commodity-desc">
									<p class="commodity-text text1"><?=$value['common_name'] ?></p>
									<div class="share-wrap clearfix">
	                                    <div class="share lf">
	                                        <span>分享立减</span>
	                                        <span class="save">￥<?=$value['common_share_price']?></span>
	                                    </div>
	                                </div>
	                                <div class="share-wrap clearfix">
	                                	<div class="share lf">
	                                        <span>立赚</span>
	                                        <span class="save">￥<?=$value['common_promotion_price']?></span>
	                                    </div>
	                                </div>
	                                <div class="toBuy-wrap mt-10 clearfix">
	                                	<span class="price lf">￥<?=$value['common_shared_price']?></span>
	                                	<div class="toBuy-btn rt">立即购买</div>
	                                </div>
								</div>
							</a>
						</li>
                        <?php } ?>
					</ul>
				</div>
			</div>
			<!-- 热卖推荐 end -->

			<!-- 满168减30 start -->
			<div class="area-panel line-4-panel">
				<div class="panel-titleImg">
					<a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=manFloor" name="<?=$opening_parent_cat[4]['key_name']?>" target="_Blank">
						<span class="title"><?=$opening_parent_cat[4]['opening_name']?></span>
						<img src="<?=$this->view->img ?>/opening/title_bg.png">
						
					</a>
				</div>
				<div class="content">
					<ul class="commodity-list clearfix">
                        <?php foreach($data['manjian'] as $key=>$value){?>
						<li class="commodity-item lf clearfix">
							<a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&gid='.$value['id_goods']?>" target="_Blank">
								<div class="img-wrap">
									<img src="<?=$value['common_image'] ?>">
                                    <?php if($value['rule_discount']){?>
                                        <div class="condition-wrap text1">满<?=$value['rule_price']?>减<?=$value['rule_discount']?>元</div>
                                    <?php }?>
								</div>
								<div class="commodity-desc">
									<p class="commodity-text text1"><?=$value['common_name'] ?></p>
									<div class="share-wrap clearfix">
	                                    <div class="share lf">
	                                        <span>分享立减</span>
	                                        <span class="save">￥<?=$value['common_share_price']?></span>
	                                    </div>
	                                    <div class="share rt">
	                                        <span>立赚</span>
	                                        <span class="save">￥<?=$value['common_promotion_price']?></span>
	                                    </div>
	                                </div>
	                                <div class="toBuy-wrap mt-25 clearfix">
	                                	<span class="price lf">￥<?=$value['common_shared_price']?></span>
	                                	<span class="old-price lf">￥<?=$value['common_price']?></span>
	                                	<div class="toBuy-btn rt">立即购买</div>
	                                </div>
								</div>
							</a>
						</li>
                        <?php } ?>
					</ul>
				</div>
			</div>
			<!-- 满168减30 end -->

			<!-- 惊喜特卖 start -->
			<div class="area-panel line-4-panel">
				<div class="panel-titleImg">
					<a href="<?=YLB_Registry::get('url')?><?=$opening_parent_cat[5]['temp']['temp_url']?>&base_id=<?=$opening_parent_cat[5]['base_id']?>&adv_key=onefloor_pc" name="<?=$opening_parent_cat[5]['key_name']?>" target="_Blank">
						<span class="title"><?=$opening_parent_cat[5]['opening_name']?></span>
						<img src="<?=$this->view->img ?>/opening/title_bg.png">
                    </a>
				</div>
				<div class="content">
					<ul class="commodity-list clearfix">
                        <?php foreach($data['jinxi'] as $key=>$value){?>
						<li class="commodity-item lf clearfix">
							<a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&gid='.$value['id_goods']?>" target="_Blank">
								<div class="img-wrap">
									<img src="<?=$value['common_image'] ?>">
								</div>
								<div class="commodity-desc">
									<p class="commodity-text text1"><?=$value['common_name'] ?></p>
									<div class="share-wrap clearfix">
	                                    <div class="share lf">
	                                        <span>分享立减</span>
	                                        <span class="save">￥<?=$value['common_share_price']?></span>
	                                    </div>
	                                    <div class="share rt">
	                                        <span>立赚</span>
	                                        <span class="save">￥<?=$value['common_promotion_price']?></span>
	                                    </div>
	                                </div>
	                                <div class="toBuy-wrap mt-25 clearfix">
	                                	<span class="price lf">￥<?=$value['common_shared_price']?></span>
	                                	<span class="old-price lf">￥<?=$value['common_price']?></span>
	                                	<div class="toBuy-btn rt">立即购买</div>
	                                </div>
								</div>
							</a>
						</li>
                        <?php } ?>
					</ul>
				</div>
			</div>
			<!-- 惊喜特卖 end -->

			<!-- 疯狂扫货 start -->
			<div class="area-panel line-6-panel">
				<div class="panel-titleImg">
					<a href="<?=YLB_Registry::get('url')?><?=$opening_parent_cat[6]['temp']['temp_url']?>&base_id=<?=$opening_parent_cat[6]['base_id']?>&adv_key=twofloor_pc" name="<?=$opening_parent_cat[6]['key_name']?>" target="_Blank">
						<span class="title"><?=$opening_parent_cat[6]['opening_name']?></span>
						<img src="<?=$this->view->img ?>/opening/title_bg.png">
					</a>
				</div>
				<div class="content">
					<ul class="commodity-list clearfix">
                        <?php foreach ($data['fengkuang'] as $key=>$value){?>
						<li class="commodity-item lf clearfix">
							<a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&gid='.$value['id_goods']?>" target="_Blank">
								<div class="img-wrap">
									<img src="<?=$value['common_image'] ?>">
								</div>
								<div class="commodity-desc">
									<p class="commodity-text text1"><?=$value['common_name'] ?></p>
									<div class="share-wrap clearfix">
	                                    <div class="share lf">
	                                        <span>分享立减</span>
	                                        <span class="save">￥<?=$value['common_share_price']?></span>
	                                    </div>
	                                </div>
	                                <div class="share-wrap clearfix">
	                                	<div class="share lf">
	                                        <span>立赚</span>
	                                        <span class="save">￥<?=$value['common_promotion_price']?></span>
	                                    </div>
	                                </div>
	                                <div class="toBuy-wrap mt-10 clearfix">
	                                	<span class="price lf">￥<?=$value['common_shared_price']?></span>
	                                	<div class="toBuy-btn rt">立即购买</div>
	                                </div>
								</div>
							</a>
						</li>
                        <?php } ?>
					</ul>
				</div>
			</div>
			<!-- 疯狂扫货 end -->

			<!-- 实用特价 start -->
			<div class="area-panel line-6-panel">
				<div class="panel-titleImg">
					<a href="<?=YLB_Registry::get('url')?><?=$opening_parent_cat[7]['temp']['temp_url']?>&base_id=<?=$opening_parent_cat[7]['base_id']?>&adv_key=threefloor_pc" name="<?=$opening_parent_cat[7]['key_name']?>" target="_Blank">
						<span class="title"><?=$opening_parent_cat[7]['opening_name']?></span>
						<img src="<?=$this->view->img ?>/opening/title_bg.png">
						
					</a>
				</div>
				<div class="content">
					<ul class="commodity-list clearfix">
                        <?php foreach($data['shiyong'] as $key=>$value){?>
						<li class="commodity-item lf clearfix">
							<a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&gid='.$value['id_goods']?>" target="_Blank">
								<div class="img-wrap">
									<img src="<?=$value['common_image'] ?>">
								</div>
								<div class="commodity-desc">
									<p class="commodity-text text1"><?=$value['common_name'] ?></p>
									<div class="share-wrap clearfix">
	                                    <div class="share lf">
	                                        <span>分享立减</span>
	                                        <span class="save">￥<?=$value['common_share_price']?></span>
	                                    </div>
	                                </div>
	                                <div class="share-wrap clearfix">
	                                	<div class="share lf">
	                                        <span>立赚</span>
	                                        <span class="save">￥<?=$value['common_promotion_price']?></span>
	                                    </div>
	                                </div>
	                                <div class="toBuy-wrap mt-10 clearfix">
	                                	<span class="price lf">￥<?=$value['common_shared_price']?></span>
	                                	<div class="toBuy-btn rt">立即购买</div>
	                                </div>
								</div>
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<!-- 实用特价 end -->

			<!-- 新人专享 start -->
			<div class="area-panel New-exclusive-panel">
				<div class="panel-titleImg">
					<a href="<?=YLB_Registry::get('url')?>?ctl=NewBuyer&met=index" name="<?=$opening_parent_cat[8]['key_name']?>" target="_Blank">
						<span class="title"><?=$opening_parent_cat[8]['opening_name']?></span>
						<img src="<?=$this->view->img ?>/opening/title_bg.png">
                    </a>
				</div>
				<div class="content">
					<ul class="commodity-list clearfix">
                        <?php foreach($data['xinren'] as $key=>$value){?>
						<li class="commodity-item lf clearfix">
							<a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&gid='.$value['id_goods']?>" target="_Blank">
								<div class="img-wrap">
									<img src="<?=$value['common_image'] ?>">
								</div>
								<div class="commodity-desc">
									<p class="commodity-text text1"><?=$value['common_name'] ?></p>
									<p class="new-privilege">包邮<?php if($value['newbuyer_price']){echo $value['newbuyer_price']; ?><?php }else{ echo $value['common_shared_price']; ?><?php } ?>元分享新人购买限购商品一件</p>
                                    <div class="share-wrap clearfix">
                                        <div class="share lf">
                                            <span>分享立减</span>
                                            <span class="save">￥<?=$value['common_share_price']?></span>
                                        </div>
                                    </div>
                                    <div class="share-wrap clearfix">
                                        <div class="share lf">
                                            <span>立赚</span>
                                            <span class="save">￥<?=$value['common_promotion_price']?></span>
                                        </div>
                                    </div>
	                                <div class="toBuy-wrap mt-10 clearfix">
                                        <div class="price-wrap">
                                            新人：<span class="price" style="display:inline-block;">
                                                ￥<?php if($value['newbuyer_price']){echo $value['newbuyer_price']; ?><?php }else{ echo $value['common_shared_price']; ?><?php } ?>包邮</span>
                                        </div>
	                                	<div class="toBuy-btn rt">立即购买</div>
	                                </div>
								</div>
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<!-- 新人专享 end -->
		</div>
		<div class="IMG-body"></div>

        <!--导航栏-->
		<div class="right-nav">
			<div class="nav"><img class="right_nav_bgpic" src="<?=$this->view->img ?>/opening/right-float.png"></div>
			<ul class="right-nav-list">
                <?php foreach($opening_parent_cat as $key=>$value){ ?>
				<li class="right-nav-item">
					<a href="#<?=$value['key_name']?>"><?=$value['opening_name'] ?></a>
				</li>
                <?php } ?>

				<li class="right-nav-item backTop">
					<a href="javascript:;">返回顶部</a>
				</li>
			</ul>
			<div class="erweima-wrap">
				<img src="<?=$this->view->img ?>/opening/erweima.png" width='75px' height='75px'>
			</div>
		</div>
        <!--分类-->
		<div class="left-nav">
			<div class="left-nav-header">
				<img src="<?=$this->view->img ?>/opening/left-float-header.png">
			</div>
			<ul class="left-nav-list">
                <?php foreach($cat as $key=>$value){?>
				<li class="left-nav-item">
					<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&debug=1&cat_id=<?=$value['cat_id']?>"><?=$value['cat_nav']['goods_cat_nav_name']?><i class="icon"></i></a>
				</li>
                <?php } ?>
			</ul>
		</div>
    </div>

<script type="text/javascript">
    $(function(){
        var _TimeCountDown = $(".fnTimeCountDown");
        _TimeCountDown.fnTimeCountDown();

        <?php if(strtotime($now.' '.'19:00:00')<time() && strtotime($now.' '.'22:00:00')>time()){?>
        $('.lf.switch-item.clearfix').eq(0).removeClass('active');
        $(".limited-spike-panel .switch-content .commodity-list").eq(2).show();
        $(".limited-spike-panel .switch-content .commodity-list").eq(0).hide();
        $('.lf.switch-item.clearfix').eq(2).addClass('active');
        <?php }else{ ?>
        $(".limited-spike-panel .switch-content .commodity-list").eq(0).show();
        <?php } ?>
        <?php if(strtotime($now.' '.'14:00:00')<time() && strtotime($now.' '.'17:00:00')>time()){?>
        $('.lf.switch-item.clearfix').eq(0).removeClass('active');
        $(".limited-spike-panel .switch-content .commodity-list").eq(1).show();
        $(".limited-spike-panel .switch-content .commodity-list").eq(0).hide();
        $('.lf.switch-item.clearfix').eq(1).addClass('active');
        <?php }else{ ?>
        $(".limited-spike-panel .switch-content .commodity-list").eq(0).show();
        <?php } ?>
    });
	$(window).scroll(function(){
		if($(window).scrollTop() >=300){
			$(".left-nav").fadeIn(400);
		}else{
			$(".left-nav").fadeOut(0);
		}

		if($(window).scrollTop() >=600){
			$(".right-nav").fadeIn(400);
		}else{
			$(".right-nav").fadeOut(0);
		}
	});

	// 点击 限时秒杀  切换
	$(".limited-spike-panel .switch-list .switch-item").click(function(){
		var index = $(this).index();
		$(this).addClass("active").siblings(".active").removeClass("active");
		$(this).parents(".switch-list").parents(".switch-wrap").siblings(".switch-content").children("ul").hide();
		$(this).parents(".switch-list").parents(".switch-wrap").siblings(".switch-content").children("ul").eq(index).show();
	});

	// 点击返回顶部
	$(".right-nav .backTop").click(function(){
		$("body,html").animate({
			scrollTop: 0
		},1000);
	});

	/*var calcu =  function () {
		// var imgW = $(".IMG-header").width();
		var imgH = $(".IMG-header .img-top").height();
		$(".IMG-header-container").css({"height": imgH+"px"})
	}
	$(window).resize(function() {
		calcu();
	})

	calcu();*/

</script>
</body>
</html>
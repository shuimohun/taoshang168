<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/iconfont/iconfont.css">
    <link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/goods_cheap.css">
<script type="text/javascript" src="<?= $this->view->js ?>/jquery.js"></script>
<!-- 内容 -->
	<div class="fix-nav">
		<div class="fix-nav-1200">
			<div class="fix-nav-kinds lf curr">
				<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index<?php if(isset($type)){ ?>&type=<?=$type?><?php }?>" class="w-130">
					<span>≡</span>
					全部类目
				</a>

				<div class="silde-menu">
					<ul class="silde-menu-ul">
						<li><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&type=1<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?><?php if(isset($cat_sid)){?>&cat_sid=<?=$cat_sid?><?php }?>" target="_self">9.9疯抢</a></li>
						<li><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&type=2<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?><?php if(isset($cat_sid)){?>&cat_sid=<?=$cat_sid?><?php }?>" target="_self">20元封顶</a></li>
						<li><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&type=3<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?><?php if(isset($cat_sid)){?>&cat_sid=<?=$cat_sid?><?php }?>" target="_self">50元好货</a></li>
					</ul>
				</div>

			</div>
			<ul class="orflow nav-1200-right">
                <?php if($data['goods_cat']){ ?>
                    <?php foreach ($data['goods_cat'] as $key=>$value){ ?>
                        <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&cat_id=<?=($value['cat_id'])?><?php if(isset($type)){ ?>&type=<?=$type?><?php }?>"><?=($value['nav_name'])?></a></li>
                    <?php }?>
                <?php }?>
			</ul>
		</div>
        <?php if($data['goods_sub_cat']){ ?>
		<div class="fix-nav-bottom">
			<div class="fix-nav-bottom-1200">
				<ul>
                    <li class="lf <?php if(!isset($cat_sid) || $cat_sid <= 0){?>curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&cat_id=<?=($cat_id)?><?php if(isset($type)){ ?>&type=<?=$type?><?php }?>">全部</a></li>
                    <?php foreach ($data['goods_sub_cat'] as $key=>$value){ ?>
                        <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&cat_id=<?=($value['cat_parent_id'])?>&cat_sid=<?=($value['cat_id'])?><?php if(isset($type)){ ?>&type=<?=$type?><?php }?>"><?=($value['cat_name'])?></a></li>
                    <?php }?>
			    </ul>
			</div>
		</div>
        <?php }?>
	</div>

    <div class="banner">
        <div class="cheape-buy-banner">
            <div class="bd">
                <ul>
                        <?php if($adv_list['items']){ foreach ($adv_list['items'] as $key=>$value){?>
                   <li>
                            <div class="swiper-slide" >
                                <a href="<?=($value['url'])?>"><img src="<?=($value['pic_url'])?>"/></a>
                            </div>
                    </li>
                        <?php }}?>
                </ul>
            </div>
            <div class="hd">
                <ul>
                    <?php if($adv_list['items']){ foreach ($adv_list['items'] as $key=>$value){?>
                        <li></li>
                    <?php }}?>
                </ul>
            </div>
        </div>
    </div>
    <script>
        jQuery(".cheape-buy-banner").slide({
            mainCell:".bd ul",
            autoPlay:true
        })
    </script>

	<div class="wrap clearfix">
		<div class="small-nav-wrap">
			<div class="small-nav all-type">
				<div class="kind lf  curr">
					<a href="#">
						<i></i>
						全部类型
					</a>
				</div>
				<ul style="overflow: hidden;">
					<li class="lf <?php if(!isset($type) || $type == 1){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&type=1<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?><?php if(isset($cat_sid)){?>&cat_sid=<?=$cat_sid?><?php }?>" target="_self">9.9疯抢</a></li>
					<li class="lf <?php if(isset($type) && $type == 2){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&type=2<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?><?php if(isset($cat_sid)){?>&cat_sid=<?=$cat_sid?><?php }?>" target="_self">20元封顶</a></li>
					<li class="lf <?php if(isset($type) && $type == 3){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&type=3<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?><?php if(isset($cat_sid)){?>&cat_sid=<?=$cat_sid?><?php }?>" target="_self">50元好货</a></li>
				</ul>
			</div>
			<div class="small-nav all-type has-arrow">
				<div class="kind lf  curr">
					<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index<?php if(isset($type)){ ?>&type=<?=$type?><?php }?>">
						<i></i>
						全部类目
					</a>
				</div>
				<ul style="overflow:hidden;">
                    <?php if($data['goods_cat']){ ?>
                        <?php foreach ($data['goods_cat'] as $key=>$value){ ?>
                            <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&cat_id=<?=($value['cat_id'])?><?php if(isset($type)){ ?>&type=<?=$type?><?php }?>"><?=($value['nav_name'])?></a></li>
                        <?php }?>
                    <?php }?>
				</ul>
			</div>
            <?php if($data['goods_sub_cat']){ ?>
                <div class="small-nav type-detail">
                    <ul>
                        <li class="lf <?php if(!isset($cat_sid) || $cat_sid <= 0){?>curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&cat_id=<?=($cat_id)?><?php if(isset($type)){ ?>&type=<?=$type?><?php }?>">全部</a></li>
                        <?php foreach ($data['goods_sub_cat'] as $key=>$value){ ?>
                            <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&cat_id=<?=($value['cat_parent_id'])?>&cat_sid=<?=($value['cat_id'])?><?php if(isset($type)){ ?>&type=<?=$type?><?php }?>"><?=($value['cat_name'])?></a></li>
                        <?php }?>
                    </ul>
                </div>
            <?php }?>
		</div>
		<div class="cheap-goods-list">
            <?php if($data['data_goods']): ?>
                <ul>
                    <?php foreach ($data['data_goods']['items'] as $key=>$value){ ?>
                        <li>
                            <div class="img-con">
                                <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&goods_id=<?=$value['goods_id']?>" target="_blank"><img src="<?=$value['common_image']?>" alt=""></a>
                            </div>
                            <div class="img-botom">
                                <div class="text-content">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&goods_id=<?=$value['goods_id']?>" target="_blank"><span><?=$value['common_name']?></span></a>
                                </div>
                                <div class="share-wrap clearfix">
                                    <div class="share lf">
                                        <span>分享立减</span>
                                        <span class="save">￥<?=$value['common_share_price']?></span>
                                    </div>
                                    <?php if($value['common_is_promotion']){ ?>
                                        <div class="share rt">
                                            <span>立赚</span>
                                            <span class="save">￥<?=$value['common_promotion_price']?></span>
                                        </div>
                                    <?php }?>
                                </div>
                                <div class="price-content clearfix">
                                    <div class="now-price lf">
                                        <span class="coin-sign">￥</span><span class="coin-much"><?=$value['common_shared_price']?></span>
                                    </div>
                                    <div class="old-price lf">
                                        <span class="coin-sign">￥</span><span><?=$value['common_price']?></span>
                                    </div>
                                    <div class="monthly-sales rt">
                                        <i></i>
                                        月销量<?=$value['common_salenum']?>
                                    </div>
                                </div>
                                <div class="score-content clearfix">
                                    <div class="score lf">
                                        <span class="lf">评分：</span>
                                        <div class="score-star lf">
                                            <?php for($i = 0;$i<$value['good'][0]['goods_evaluation_good_star'];$i++){?>
                                                <img src="<?=$this->view->img?>/goods/star_y.png" alt="">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="like-icon rt">
                                        <img src="<?=$this->view->img?>/goods/share_n.png" alt="" class="share_n share share_img" >
                                        <img src="<?=$this->view->img?>/goods/<?php if($value['is_favorite']){?>book_n.png<?php }else{?>book_s.png<?php }?>" alt="" class="book_s share_img cllectGoods" id="coll_<?=(@$value['goods_id'])?>" data-cflag="<?=$value['is_favorite']?>" data-goods_id="<?=$value['goods_id']?>">
                                    </div>
                                </div>

                            </div>
                        </li>
                    <?php }?>
                </ul>

                <nav class="page page_front">
                    <?=$page_nav?>
                </nav>
            <?php else: ?>
                <div class="no_account">
                    <img src="<?= $this->view->img ?>/ico_none.png"/>
                    <p><?= _('暂无符合条件的数据记录') ?></p>
                </div>
            <?php endif; ?>
		</div>
	</div>

<script type="text/javascript">
	//固定导航栏 start
	$(window).scroll(function(){
			if($(window).scrollTop() > ( $(".small-nav-wrap").outerHeight(true)) + $(".small-nav-wrap").offset().top){
				$(".fix-nav").css({"display":"block"});
			}else{
				$(".fix-nav").css({"display":"none"});
			}
		});
	$(function(){
		// 固定导航栏  start
		$(".fix-nav-kinds").mouseover(function(){
			$(".silde-menu-ul").addClass("block");
		}).mouseout(function(){
			$(".silde-menu-ul").removeClass("block");
		});
		$(".fix-nav-kinds").click(function(){
			$(".fix-nav-bottom").removeClass("block");
			$(".fix-nav-1200 .nav-1200-right li").removeClass("curr");
		});
		$(".fix-nav .fix-nav-1200 li").click(function(){
			$(this).addClass("curr");
			$(this).siblings(".curr").removeClass("curr");
			$(".fix-nav-bottom").addClass("block");
		});
		$(".fix-nav-bottom li").click(function(){
			$(this).addClass("curr");
			$(this).siblings(".curr").removeClass("curr");
		});
			//判断 什么时候有 fix-nav-bottom  start
		if($(".fix-nav .nav-1200-right li").hasClass("curr")){
			$(".fix-nav-bottom").addClass("block");
		}else{
			$(".fix-nav-bottom").removeClass("block");
		};
			//判断 什么时候有 fix-nav-bottom   end

		// 固定导航栏  end


		/*$(".kind").click(function(){
			$(this).addClass("curr");
			$(this).siblings("ul").children(".curr").removeClass("curr");
			$(".type-detail").removeClass("block");
		});
		
		$(".all-type li").click(function(){
			$(this).addClass("curr");
			$(this).siblings(".curr").removeClass("curr");
			$(this).parent("ul").siblings(".curr").removeClass("curr");
			$(".type-detail").addClass("block");
		});

		$(".type-detail li").click(function(){
			$(this).addClass("curr");
			$(this).siblings(".curr").removeClass("curr");
		}); 
			//判断 什么时候有 type-detail   start
		if($(".type-detail li").hasClass("curr")){
			$(".type-detail").addClass("block");
		}else{
			$(".type-detail").removeClass("block");
		};*/
			//判断 什么时候有 type-detail    end
	});
	
</script>

</body>
<!-- 尾部 -->
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
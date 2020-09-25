<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>

<!-- <link rel="stylesheet"  type="text/css" href="<?/*= $this->view->css */?>/goods_cheap.css"> -->
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/goodGoods.css">



<!-- 内容 -->
	<div class="fix-nav">
		<div class="fix-nav-1200">
			<div class="fix-nav-kinds lf curr">
				<a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=goodGoods"  class="w-130">
					<span>≡</span>
					全部类目
				</a>
			</div>
            <ul class="orflow nav-1200-right">
                <?php if($data['goods_cat']){ ?>
                    <?php foreach ($data['goods_cat'] as $key=>$value){ ?>
                        <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=goodGoods&cat_id=<?=($value['cat_id'])?>"><?=($value['nav_name'])?></a></li>
                    <?php }?>
                <?php }?>
            </ul>
		</div>
        <?php if($data['goods_sub_cat']){ ?>
            <div class="fix-nav-bottom">
                <div class="fix-nav-bottom-1200">
                    <ul>
                        <li class="lf <?php if(!isset($cat_sid) || $cat_sid <= 0){?>curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=goodGoods&cat_id=<?=($cat_id)?>">全部</a></li>
                        <?php foreach ($data['goods_sub_cat'] as $key=>$value){ ?>
                            <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=goodGoods&cat_id=<?=($value['cat_parent_id'])?>&cat_sid=<?=($value['cat_id'])?>"><?=($value['cat_name'])?></a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        <?php }?>
    </div>

    <div class="banner">
        <div class="swiper-container swiper-container-horizontal">
            <div class="swiper-wrapper" style="position: absolute !important;">
                <?php if($adv_con['items']){ foreach ($adv_con['items'] as $key=>$value){?>
                    <div class="swiper-slide" >
                        <a href="<?=($value['url'])?>"><img src="<?=($value['pic_url'])?>"/></a>
                    </div>
                <?php }}?>
            </div>
            <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
        </div>
        <script>
            var swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                spaceBetween: 30,
                centeredSlides: true,
                autoplay: 5000,
                autoplayDisableOnInteraction: false,
                loop: true
            });
        </script>

    </div>

	<div class="wrap clearfix">
        <div class="small-nav-wrap">
            <div class="small-nav all-type has-arrow">
                <div class="kind lf  curr">
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=goodGoods">
                        <i></i>
                        全部类目
                    </a>
                </div>
                <ul style="overflow: hidden;">
                    <?php if($data['goods_cat']){ ?>
                        <?php foreach ($data['goods_cat'] as $key=>$value){ ?>
                            <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=goodGoods&cat_id=<?=($value['cat_id'])?>"><?=($value['nav_name'])?></a></li>
                        <?php }?>
                    <?php }?>
                </ul>
            </div>
            <?php if($data['goods_sub_cat']){ ?>
                <div class="small-nav type-detail">
                    <ul>
                        <li class="lf <?php if(!isset($cat_sid) || $cat_sid <= 0){?>curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=goodGoods&cat_id=<?=($cat_id)?>">全部</a></li>
                        <?php foreach ($data['goods_sub_cat'] as $key=>$value){ ?>
                            <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=goodGoods&cat_id=<?=($value['cat_parent_id'])?>&cat_sid=<?=($value['cat_id'])?>"><?=($value['cat_name'])?></a></li>
                        <?php }?>
                    </ul>
                </div>
            <?php }?>
        </div>

		<div class="cheap-goods-list">
			 <ul>
                 <?php if($data['items']){ ?>
                 <?php foreach($data['items'] as $k =>$v){ ?>
                <li>
                	<div class="li-left lf">
                		<div class="img-con">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&goods_id=<?=$v[0]['goods_id']?>" target="_blank" ><img src="<?=$v[0]['goods_image'] ?>" alt=""></a>
                        </div>
                        <div class="img-botom">
                            <div class="text-content">
                                <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&goods_id=<?=$v[0]['goods_id']?>" target="_blank"><span><?=$v[0]['goods_name'] ?></span></a>
                            </div>
                             <div class="price-content clearfix">
                                <div class="now-price lf">
                                    <span class="coin-sign">￥</span><span class="coin-much"><?=$v[0]['goods_price'] ?></span>
                                </div>
                                <div class="activity-wrap">
                         <?php if($v[0]['common_is_tuan']==1 || $v[0]['common_is_qiang']==1 || $v[0]['common_is_jia']==1 || $v[0]['common_promotion_type']==1 || $v[0]['common_promotion_type']==2 || $v[0]['common_promotion_type']==3 || $v[0]['common_promotion_type']==4){ ?>

                             <?php if($v[0]['common_is_tuan']==1){ ?>
                             <u>团</u>
                             <?php } ?>
                             <?php if($v[0]['common_is_qiang']==1){ ?>
                                 <u>抢</u>
                             <?php } ?>
                             <?php if($v[0]['common_is_jia']==1){ ?>
                                 <u>加</u>
                             <?php } ?>
                             <?php if($v[0]['common_promotion_type']==1){ ?>
                                 <u>惠</u>
                             <?php }else if($v[0]['common_promotion_type']==2){ ?>
                                 <u>限</u>
                             <?php }else if($v[0]['common_promotion_type']==3){ ?>
                                 <u>手机</u>
                             <?php }else if($v[0]['common_promotion_type']==4){ ?>
                                 <u>新</u>
                             <?php } ?>
                         <?php } ?>
                                </div>
                            </div>
                            <div class="share-wrap clearfix">
                                <div class="share lf">
                                    <span>分享立减</span>
                                    <span class="save">￥<?=$v[0]['goods_share_price'] ?></span>
                                </div>
                                <div class="share rt">
                                    <span>立赚</span>
                                    <span class="save">￥<?=$v[0]['goods_promotion_price'] ?></span>
                                </div>
                            </div>
                        </div>
                	</div>
                	<div class="li-right lf">
                		<div class="avatar-wrap lf">
                			<div class="avatar">
                				<img src="<?=$v[0]['user_logo'] ?>" alt="">
                			</div>
                			<div class="avatar-name">
                				<span><?=$v[0]['user_name'] ?></span>
                				<i class="icon"></i>
                			</div>
                		</div>
                		<div class="awatar-right rt">
                			<div class="composite-score">
                				<h3 class="lf">综合评分:</h3>
                				<div class="score-star lf">
                					<img src="<?= $this->view->img ?>/star.png" alt="">
                                    <img src="<?= $this->view->img ?>/star.png" alt="">
                                    <img src="<?= $this->view->img ?>/star.png" alt="">
                                    <img src="<?= $this->view->img ?>/star.png" alt="">
                                    <img src="<?= $this->view->img ?>/star.png" alt="">
                				</div>
                			</div>
                			<div class="comment-wrap">
                				<span class="comment">评价：</span>
                				<p><?=$v[0]['content'] ?></p>
                			</div>
                			<div class="img-show">
                                <?php if(count($v[0]['image_row']) == 0){?>
                                    <span>这家伙够懒的</span>
                                <?php }else{ ?>
                                    <?php for( $j = 0;$j < 2; $j++){ ?>
                                        <?php if($v[0]['image_row'][$j]){?>
                                            <img src="<?=$v[0]['image_row'][$j]; ?>" alt="">
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                			</div>
                			<div class="watch-comment">
	                			<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&goods_id=<?=$v[0]['goods_id']?>" target="_blank">
	                				查看评价 &nbsp;>	                				
	                			</a>
                			</div>
                		</div>
                	</div>
                </li>
                 <?php } ?>
                 <?php }else{ ?>
                     <div class="no_account">
                         <img src="<?= $this->view->img ?>/ico_none.png"/>
                         <p><?= _('暂无符合条件的数据记录') ?></p>
                     </div>
                 <?php } ?>

            </ul>
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




		$(".kind").click(function(){
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
		};
			//判断 什么时候有 type-detail    end

	});
	
</script>

</body>
<!-- 尾部 -->
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
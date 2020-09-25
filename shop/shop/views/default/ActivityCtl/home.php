<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>

    <link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/activity-base.css">
    <link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/sonanddaughter.css">
    <link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/swiper.css">
    <script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
    <!--<script type="text/javascript" src="<?/*=$this->view->js*/?><!--/decoration/common.js"></script>-->
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
    <script src="<?=$this->view->js_com?>/plugins/jquery.slideBox.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/scarebuy.css">

    <!-- 内容 -->
    <div class="fix-nav">
        <div class="fix-nav-1200">
            <div class="fix-nav-kinds lf curr">
                <a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=home" class="w-130">
                    <span>≡</span>
                    全部类目
                </a>
            </div>
            <ul class="orflow nav-1200-right">
                <?php if($data['goods_cat']){ ?>
                    <?php foreach ($data['goods_cat'] as $key=>$value){ ?>
                        <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=home&cat_id=<?=($value['cat_id'])?>"><?=($value['nav_name'])?></a></li>
                    <?php }?>
                <?php }?>
            </ul>
        </div>
        <?php if($data['goods_sub_cat']){ ?>
            <div class="fix-nav-bottom">
                <div class="fix-nav-bottom-1200">
                    <ul>
                        <li class="lf <?php if(!isset($cat_sid) || $cat_sid <= 0){?>curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=home&cat_id=<?=($cat_id)?>">全部</a></li>
                        <?php foreach ($data['goods_sub_cat'] as $key=>$value){ ?>
                            <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=home&cat_id=<?=($value['cat_parent_id'])?>&cat_sid=<?=($value['cat_id'])?>"><?=($value['cat_name'])?></a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        <?php }?>
    </div>

    <div class="banner">
        <div class="swiper-container swiper-container-horizontal">
            <div class="swiper-wrapper" style="position: absolute !important;">
                <?php foreach ($sift['adv']['items'] as $key=>$value){?>
                    <div class="swiper-slide" style="width: ;">
                        <a href="<?=($value['web_url'])?>"><img src="<?=($value['pic_url'])?>"/></a>
                    </div>
                <?php }?>

            </div>
            <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
        </div>
        <script>
            var swiper = new Swiper(' .swiper-container', {
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
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=home">
                        <i></i>
                        全部类目
                    </a>
                </div>
                <ul style="overflow:hidden;">
                    <?php if($data['goods_cat']){ ?>
                        <?php foreach ($data['goods_cat'] as $key=>$value){ ?>
                            <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=home&cat_id=<?=($value['cat_id'])?>"><?=($value['nav_name'])?></a></li>
                        <?php }?>
                    <?php }?>
                </ul>
            </div>
            <?php if($data['goods_sub_cat']){ ?>
                <div class="small-nav type-detail">
                    <ul>
                        <li class="lf <?php if(!isset($cat_sid) || $cat_sid <= 0){?>curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=home&cat_id=<?=($cat_id)?>">全部</a></li>
                        <?php foreach ($data['goods_sub_cat'] as $key=>$value){ ?>
                            <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Activity&met=home&cat_id=<?=($value['cat_parent_id'])?>&cat_sid=<?=($value['cat_id'])?>"><?=($value['cat_name'])?></a></li>
                        <?php }?>
                    </ul>
                </div>
            <?php }?>
        </div>
        <div class="sonanddaughter_title">
            <img src="<?= $this->view->img ?>/clock.png" alt="" class='clock'>
            <i>看好就下手</i>
            <span>今日疯抢</span>
            <b>更多</b>
            <img src="<?= $this->view->img ?>/sad_more.png" alt="" class='sad_more'>
        </div>
        <div class="sonanddaughter_swiper">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ($rows['xl_res']['items'] as $key =>$value){ ?>
                        <div class="swiper-slide">
                                <div class="swiper-slide_item">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&cid=<?=$value['common_id']?>" target="_blank"><img src="<?=($value['common_image'])?>" alt=""></a>
                                    <span class='word'>
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&cid=<?=$value['common_id']?>" target="_blank"><?=($value['common_name'])?></a>
                            </span><br>
                                    <u>￥<?=($value['common_shared_price'])?> <del>￥<?=($value['common_price'])?></del></u>
                                </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <img src="<?= $this->view->img ?>/img_08.png" alt="" class='title'>
        <ul class="prefer">
            <?php if($rows['sc_res']['items']): ?>
            <?php foreach ($rows['sc_res']['items'] as $key =>$value){ ?>
                <li>
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&cid=<?=$value['common_id']?>" target="_blank"><img src="<?=($value['common_image'])?>" alt=""></a>
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&cid=<?=$value['common_id']?>" target="_blank"><span class='word'><?=($value['common_name'])?></span></a><br>
                    <?php if($value['common_is_tuan']==1 || $value['common_is_qiang']==1 || $value['common_is_jia']==1 || $value['common_promotion_type']==1 || $value['common_promotion_type']==2 || $value['common_promotion_type']==3 || $value['common_promotion_type']==4){ ?>
                        <i>促销 : <?php if($value['common_is_tuan']==1){ ?>
                                <u>团购</u>
                            <?php } ?>
                            <?php if($value['common_is_qiang']==1){ ?>
                                <u>抢购</u>
                            <?php } ?>
                            <?php if($value['common_is_jia']==1){ ?>
                                <u>加价购</u>
                            <?php } ?>
                            <?php if($value['common_promotion_type']==1){ ?>
                                <u>惠抢购</u>
                            <?php }else if($value['common_promotion_type']==2){ ?>
                                <u>限时折扣</u>
                            <?php }else if($value['common_promotion_type']==3){ ?>
                                <u>手机专享</u>
                            <?php }else if($value['common_promotion_type']==4){ ?>
                                <u>新人优惠</u>
                            <?php } ?>
                        </i>
                    <?php }else{?>
                        <i></i>
                    <?php } ?>
                    <br>
                    <span class="share"><em>分享立减</em><b>￥<?=($value['common_share_price'])?></b></span>
                    <span class="share"><em>立赚</em><b>￥<?=($value['common_promotion_price'])?></b></span><br>
                    <span class="price">￥<?=($value['common_shared_price'])?></span><span class="low_price">￥<?=($value['common_price'])?></span><br>

                        <img  src="<?=$this->view->img?>/goods/<?php if($value['sc_status']==1){?>book_n.png<?php }else{?>book_s.png<?php }?>" alt="" class="book_s share_img cllectGoods tit" id="coll_<?=($value['goods_id'])?>" data-cflag="<?=$value['sc_status']?>" data-goods_id="<?=$value['goods_id']?>">
                    <span class="tit_word"> <?=($value['common_collect'])?>人收藏</span>
                    <span class="tit_word"><?=($value['common_row'])?>人都说好</span>
                    <span class="month-word">销量 <?=($value['common_salenum'])?></span>
                </li>
            <?php } ?>
            <?php else: ?>
                <div class="no_account">
                    <img src="<?= $this->view->img ?>/ico_none.png"/>
                    <p><?= _('暂无符合条件的数据记录') ?></p>
                </div>
            <?php endif; ?>
        </ul>
        <img src="<?= $this->view->img ?>/img_09.png" alt="" class='title'>
        <ul class="goodcollect">
            <?php if($rows['pl_res']['items']): ?>
                <?php foreach ($rows['pl_res']['items'] as $key =>$value){ ?>
                    <li>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&cid=<?=$value['common_id']?>" target="_blank"> <img src="<?=($value['goods_image'])?>" alt=""></a>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&cid=<?=$value['common_id']?>" target="_blank"><span  class='word'><?=($value['goods_name'])?></span></a><br>
                        <?php if($value['common_is_tuan']==1 || $value['common_is_qiang']==1 || $value['common_is_jia']==1 || $value['common_promotion_type']==1 || $value['common_promotion_type']==2 || $value['common_promotion_type']==3 || $value['common_promotion_type']==4){ ?>
                            <i>促销 : <?php if($value['common_is_tuan']==1){ ?>
                                    <u>团购</u>
                                <?php } ?>
                                <?php if($value['common_is_qiang']==1){ ?>
                                    <u>抢购</u>
                                <?php } ?>
                                <?php if($value['common_is_jia']==1){ ?>
                                    <u>加价购</u>
                                <?php } ?>
                                <?php if($value['common_promotion_type']==1){ ?>
                                    <u>惠抢购</u>
                                <?php }else if($value['common_promotion_type']==2){ ?>
                                    <u>限时折扣</u>
                                <?php }else if($value['common_promotion_type']==3){ ?>
                                    <u>手机专享</u>
                                <?php }else if($value['common_promotion_type']==4){ ?>
                                    <u>新人优惠</u>
                                <?php } ?>
                            </i>
                        <?php }else{?>
                            <i></i>
                        <?php } ?>
                        <br>
                        <span class="share"><em>分享立减</em><b>￥<?=($value['common_share_price'])?></b></span>
                        <span class="share"><em>立赚</em><b>￥<?=($value['common_promotion_price'])?></b></span><br>
                        <span class="price">￥<?=($value['common_shared_price'])?></span><span class="low_price">￥<?=($value['common_price'])?></span><br>
                        <img  src="<?=$this->view->img?>/goods/<?php if($value['pl_status']==1){?>book_n.png<?php }else{?>book_s.png<?php }?>" alt="" class="book_s share_img cllectGoods tit" id="coll_<?=($value['goods_id'])?>" data-cflag="<?=$value['pl_status']?>" data-goods_id="<?=$value['goods_id']?>"><span class="tit_word"><?=($value['scores'])?>人都说好</span>
                        <span class="month-word">销量 <?=($value['common_salenum'])?></span>
                    </li>
                <?php } ?>
            <?php else: ?>
                <div class="no_account">
                    <img src="<?= $this->view->img ?>/ico_none.png"/>
                    <p><?= _('暂无符合条件的数据记录') ?></p>
                </div>
            <?php endif; ?>
        </ul>
    </div>

    <script type="text/javascript">

        //收藏/取消收藏
        $('.cllectGoods').bind('click',function(){

            if ($.cookie('key'))
            {
                var cflag = $(this).data('cflag');

                var goods_id = $(this).data('goods_id');
                if(cflag == 1){
                    $.post(SITE_URL  + '?ctl=Goods_Goods&met=canleCollectGoods&typ=json',{goods_id:goods_id},function(data)
                    {
                        if(data.status == 200)
                        {
                            Public.tips.error('取消收藏成功!');
                            $("#coll_"+goods_id).attr('src','<?=$this->view->img?>/goods/book_s.png');
                            $("#coll_"+goods_id).data('cflag',0);
                        } else {
                            Public.tips.error(data.data.msg);
                        }
                    });
                }else{
                    $.post(SITE_URL  + '?ctl=Goods_Goods&met=collectGoods&typ=json',{goods_id:goods_id},function(data)
                    {
                        if(data.status == 200)
                        {
                            Public.tips.success('收藏成功!');
                            $("#coll_"+goods_id).attr('src','<?=$this->view->img?>/goods/book_n.png');
                            $("#coll_"+goods_id).data('cflag',1);
                        } else {
                            Public.tips.error(data.data.msg);
                        }
                    });
                }
            } else {
                $("#login_content").show();
            }
        })

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
    <script src="<?= $this->view->js ?>/swiper.min.js"></script>
    <script>
        var swiper = new Swiper('.sonanddaughter_swiper .swiper-container', {
            pagination: '.sonanddaughter_swiper .swiper-pagination',
            paginationClickable: true,
            nextButton: '.sonanddaughter_swiper .swiper-button-next',
            prevButton: '.sonanddaughter_swiper .swiper-button-prev',
            spaceBetween: 30,
            slidesPerView :  6,
            slidesPerGroup : 6
        });
    </script>

    </body>
    <!-- 尾部 -->
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
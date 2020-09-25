<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'fresh_header.php';
?>

    <link rel="stylesheet"  type="text/css" href="<?=$this->view->css ?>/fresh-index.css">

    <div style="height:500px;" class="slideBox">
        <div class="hd">
            <ul>
                <li></li><li></li> <li></li> <li></li> <li></li>
            </ul>
        </div>
        <div class="banner  bd">
            <ul class="banimg">
                <li>
                    <a href="<?php if (isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){ echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'fresh_index_link1');}else{echo Web_ConfigModel::value('fresh_index_link1');}?>" style="background-image: url(<?php if (isset($_COOKIE['sub_site_id'])  && $_COOKIE['sub_site_id'] > 0){echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'fresh_index_image1');}else{echo Web_ConfigModel::value('fresh_index_image1', Web_ConfigModel::value('index_slider1_image'));}?>);"></a>
                </li>
                <li>
                    <a href="<?php if (isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){ echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'fresh_index_link2');}else{echo Web_ConfigModel::value('fresh_index_link2');}?>" style="background-image: url(<?php if (isset($_COOKIE['sub_site_id'])  && $_COOKIE['sub_site_id'] > 0){echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'fresh_index_image2');}else{echo Web_ConfigModel::value('fresh_index_image2', Web_ConfigModel::value('index_slider2_image'));}?>)"></a>
                </li>
                <li>
                    <a href="<?php if (isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){ echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'fresh_index_link3');}else{echo Web_ConfigModel::value('fresh_index_link3');}?>" style="background-image: url(<?php if (isset($_COOKIE['sub_site_id'])  && $_COOKIE['sub_site_id'] > 0){echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'fresh_index_image3');}else{echo Web_ConfigModel::value('fresh_index_image3', Web_ConfigModel::value('index_slider3_image'));}?>)"></a>
                </li>
                <li>
                    <a href="<?php if (isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){ echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'fresh_index_link4');}else{echo Web_ConfigModel::value('fresh_index_link4');}?>" style="background-image: url(<?php if (isset($_COOKIE['sub_site_id'])  && $_COOKIE['sub_site_id'] > 0){echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'fresh_index_image4');}else{echo Web_ConfigModel::value('fresh_index_image4', Web_ConfigModel::value('index_slider4_image'));}?>)"></a>
                </li>
                <li>
                    <a href="<?php if (isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){ echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'fresh_index_link5');}else{echo Web_ConfigModel::value('fresh_index_link5');}?>" style="background-image: url(<?php if (isset($_COOKIE['sub_site_id'])  && $_COOKIE['sub_site_id'] > 0){echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'fresh_index_image5');}else{echo Web_ConfigModel::value('fresh_index_image5', Web_ConfigModel::value('index_slider5_image'));}?>)"></a>
                </li>
            </ul>
            <script type="text/javascript">
                jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true,delayTime:3000});
            </script>
        </div>
    </div>
    <div class="wrap">
        <div class="nav-base">
            <div class="nav-wrap-con">
                <div class="nav-wrap-1200">
                    <div class="nav-wrap">
                        <ul>
                            <li class="lf nav-li curr" data-type="all">
                                <a href="javascript:void(0);">精选</a>
                            </li>
                            <li class="lf nav-li" data-type="huabei">
                                <a href="javascript:void(0);">华北</a>
                            </li>
                            <li class="lf nav-li" data-type="dongbei">
                                <a href="javascript:void(0);">东北</a>
                            </li>
                            <li class="lf nav-li" data-type="huadong">
                                <a href="javascript:void(0);">华东</a>
                            </li>
                            <li class="lf nav-li" data-type="huanan">
                                <a href="javascript:void(0);">华南</a>
                            </li>
                            <li class="lf nav-li" data-type="huazhong">
                                <a href="javascript:void(0);">华中</a>
                            </li>
                            <li class="lf nav-li" data-type="xinan">
                                <a href="javascript:void(0);">西南</a>
                            </li>
                            <li class="lf nav-li" data-type="xibei">
                                <a href="javascript:void(0);">西北</a>
                            </li>

                        </ul>
                    </div>

                    <div class="nav-controller">
                        <?php if($cat){ ?>
                            <ul class="orflow controller-ul">
                                <?php foreach($cat as $key=>$value){ ?>
                                    <li class="lf controller-li">
                                        <a href="javascript:void(0);" class="cat_nav" data-cat-id="<?=$value['goods_cat_id']?>">
                                            <div class="img-center">
                                                <img src="<?=$value['cat_pic']?>" alt="">
                                            </div>
                                            <span><?=$value['goods_cat_nav_name'] ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- 佳节礼盒 -->
        <?php if($gift){?>
            <div class="gift-package">
                <div class="title-wrap">
                    <div class="title">
                        GIFT SET PRODCTS
                    </div>
                    <span>佳节礼盒</span>
                </div>
                <div class="package-content">
                    <?php foreach($gift as $key=>$value){?>
                        <div class="package-wrap lf">
                            <a href="<?=$value['web_url'] ?>">
                                <img src="<?=$value['pic_url'] ?>">
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php }?>
        <!--  早晚  特卖 -->
        <?php if($is_MonLater){ ?>
            <div class="all-day orflow">

                <div class="all-day-title orflow">

                    <div class="white-day lf half-day <?php if(time()>=$mor && time()<=$nig){ ?> curr <?php }else{ ?> no-curr <?php } ?>">
                        <div class="center-wrap lf">
                            <i class="icon lf"></i>
                            <div class="lf text-wrap">
                                <?php if(time()>=$mor && time()<=$nig){ ?> 早市特卖 <?php }else{ ?> 早市预告 <?php } ?>
                                <span>10:00-17:00</span>
                            </div>
                        </div>
                        <?php if(time()>=$mor && time()<=$nig){?>
                            <div class="time-out-wrap rt" data-end="<?=$nig_date ?>">
                                距离结束还有:
                                <span class="hour">00</span>时
                                <span class="mini">00</span>分
                                <span class="sec">00</span>秒
                            </div>
                        <?php }elseif(time()>$nig && time()<$now_t){ ?>
                            <div class="time-out-wrap rt" data-end="<?=$mor_t_date ?>">
                                距离开始还有:
                                <span class="hour">00</span>时
                                <span class="mini">23</span>分
                                <span class="sec">12</span>秒
                            </div>
                        <?php }else{ ?>
                            <div class="time-out-wrap rt" data-end="<?=$mor_date ?>">
                                距离开始还有:
                                <span class="hour">00</span>时
                                <span class="mini">23</span>分
                                <span class="sec">12</span>秒
                            </div>
                        <?php } ?>
                    </div>

                    <div id='night'  class="black-day lf half-day <?php if(time()<$mor){?>curr<?php }elseif(time()>$nig){?>curr<?php }else{?>no-curr<?php } ?>">
                        <div class="center-wrap lf">
                            <i class="icon lf"></i>
                            <div class="lf text-wrap">
                                <?php if(time()<$mor){?>晚市特卖<?php }elseif(time()>$nig){?>晚市特卖<?php }else{?>晚市预告<?php } ?>
                                <span>17:00-次日10:00</span>
                            </div>
                        </div>
                        <?php if(time()>$nig && time()<$now_t){ ?>
                            <div class="time-out-wrap rt" data-end="<?=$mor_t_date ?>">
                                距离结束还有:
                                <span class="hour">00</span>时
                                <span class="mini">00</span>分
                                <span class="sec">00</span>秒
                            </div>
                        <?php }elseif(time()>=$mor && time()<=$nig){ ?>
                            <div class="time-out-wrap rt" data-end="<?=$nig_date ?>">
                                距离开始还有:
                                <span class="hour">00</span>时
                                <span class="mini">00</span>分
                                <span class="sec">00</span>秒
                            </div>
                        <?php }else{ ?>
                            <div class="time-out-wrap rt" data-end="<?=$mor_date ?>">
                                距离结束还有:
                                <span class="hour">00</span>时
                                <span class="mini">00</span>分
                                <span class="sec">00</span>秒
                            </div>
                        <?php } ?>
                    </div>

                </div>

                <div class="all-day-content">
                    <?php if($mor_goods['items']){?>
                        <div class="all-day-content-item-wrap">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <?php foreach($mor_goods['items'] as $key=>$value){?>
                                        <div class="swiper-slide">
                                            <div class="all-day-content-item">
                                                <div class="img-center">
                                                    <a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&cid='.$value['common_id'] ?>" target="_blank"><img src="<?=$value['common_image'] ?>"></a>
                                                </div>
                                                <div class="img-botom">
                                                    <div class="text-content">
                                                        <a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&cid='.$value['common_id'] ?>" target="_blank"><div class="text-2"><?=$value['common_name'] ?></div></a>
                                                    </div>
                                                    <div class="share-wrap clearfix">
                                                        <div class="share">
                                                            <span>分享立减</span>
                                                            <span class="save">￥<?=$value['common_share_price'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="share-wrap clearfix">
                                                        <div class="share">
                                                            <span>立赚</span>
                                                            <span class="save">￥<?=$value['common_promotion_price'] ?></span>
                                                        </div>
                                                        <div class="activity-wrap">
                                                            <?php if($is_man){ ?>
                                                                <span>满</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="price-content clearfix">
                                                        <div class="now-price">
                                                            <span class="coin-sign">￥</span><span class="coin-much"><?=$value['common_shared_price'] ?></span>
                                                        </div>
                                                        <div class="old-price">
                                                            <span class="coin-sign">￥</span><span><?=$value['common_price'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="buy-once-button">
                                                        <a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&cid='.$value['common_id'] ?>" class="buy-once">
                                                            立即购买
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($nig_goods['items']){ ?>
                        <div class="all-day-content-item-wrap two">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <?php foreach($nig_goods['items'] as $key=>$value){?>
                                        <div class="swiper-slide">
                                            <div class="all-day-content-item">
                                                <div class="img-center">
                                                    <a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&cid='.$value['common_id'] ?>" target="_blank"><img src="<?=$value['common_image'] ?>"></a>
                                                </div>
                                                <div class="img-botom">
                                                    <div class="text-content">
                                                        <a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&cid='.$value['common_id'] ?>" target="_blank"><div class="text-2"><?=$value['common_name'] ?></div></a>
                                                    </div>
                                                    <div class="share-wrap clearfix">
                                                        <div class="share">
                                                            <span>分享立减</span>
                                                            <span class="save">￥<?=$value['common_share_price'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="share-wrap clearfix">
                                                        <div class="share">
                                                            <span>立赚</span>
                                                            <span class="save">￥<?=$value['common_promotion_price'] ?></span>
                                                        </div>
                                                        <div class="activity-wrap">
                                                            <?php if($is_man){ ?>
                                                                <span>满</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="price-content clearfix">
                                                        <div class="now-price">
                                                            <span class="coin-sign">￥</span><span class="coin-much"><?=$value['common_shared_price'] ?></span>
                                                        </div>
                                                        <div class="old-price">
                                                            <span class="coin-sign">￥</span><span><?=$value['common_price'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="buy-once-button">
                                                        <a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&cid='.$value['common_id'] ?>" class="buy-once">
                                                            立即购买
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <div class="wrap floor fn-clear">
            <?php if(!empty($adv_list['items'])){
                foreach ($adv_list['items'] as $key => $value) { ?>
                    <?=$value['page_html']?>
                <?php } }?>
        </div>
    </div>
    <div class="J_f J_lift lift" id="lift" style="left: 42.5px; top: 134px;">
        <ul class="lift_list  aad">
            <li class="J_lift_item_top lift_item lift_item_top">
                <a href="javascript:;" class="lift_btn">
                    <span class="lift_btn_txt">顶部<i class="lift_btn_arrow"></i></span>
                </a>
            </li>
        </ul>
    </div>
    <script>
        $(document).ready(function(){
            var _TimeCountDown = $(".time-out-wrap.rt");
            _TimeCountDown.fnTimeCountDown();
        });
        $('.cat_nav').on('click',function(){
         var addr = $('.lf.nav-li.curr').data('type');
         var cat_id = $(this).data('cat-id');
         location.href = SITE_URL+'?ctl=Fresh_Goods&met=goodslist&cat_id='+cat_id+'&addr='+addr;
        });
    </script>
    <script>
        // 固定
        // if($(window).scrollTop() > ( $(".small-nav-wrap").outerHeight(true)) + $(".small-nav-wrap").offset().top){
        $(window).scroll(function(){
            if($(window).scrollTop() > ( $(".nav-wrap-con").outerHeight(true)) + $(".nav-base").offset().top ){
                $(".nav-wrap-con").addClass("fixed");
            }else{
                $(".nav-wrap-con").removeClass("fixed");
            }
        });

        $(function () {
            var mySwiper_banner_click = new Swiper ('.all-day-content-item-wrap .swiper-container', {
                direction: 'horizontal',
                loop: false,
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                slidesPerView:6,
                freeMode:false,   //  若为false  则只滑动一格
                observer: true, //修改swiper自己或子元素时，自动初始化swiper
                observeParents: true, //修改swiper的父元素时，自动初始化swiper
                // 如果需要前进后退按钮
            });

            // 点击  早市晚市

            if($('#night').attr('class').trim().substr(($('#night').attr('class').trim().length)-4) == 'curr' && $('#night').attr('class').trim().substr(($('#night').attr('class').trim().length)-7) !='no-curr' )
            {
                $(".all-day").children(".all-day-content").children(".all-day-content-item-wrap").removeClass("curr").addClass("no-block");
                $(".all-day").children(".all-day-content").children(".all-day-content-item-wrap.two").removeClass("no-block").addClass("curr");
            }
            else
            {
                $(".all-day").children(".all-day-content").children(".all-day-content-item-wrap").eq(0).addClass("curr");
            }

            $(".half-day").click(function(){

                var index = $(this).index();
                $(this).addClass("curr").removeClass("no-curr").siblings(".half-day").removeClass("curr").addClass("no-curr");

                $(".all-day").children(".all-day-content").children(".curr").removeClass("curr").addClass("no-block");
                $(".all-day").children(".all-day-content").children(".all-day-content-item-wrap").eq(index).removeClass("no-block").addClass("curr");
            });


            // 点击  地区导航
            $(".nav-li").click(function(){
                $(this).addClass("curr").siblings(".curr").removeClass("curr");
            });





            //遍历导航楼层
            var atrf = [];
            var len = $(".floor .m").length;
            for (var mm = 0; mm < len; mm++) {
                var str = $(".floor .m .title").eq(mm).text();
                atrf.push(str);
            }
            var lis = "";
            $(atrf).each(function (i, n) {
                lis += '<li class="J_lift_item lift_item lift_item_first"><a class="lift_btn"><span class="lift_btn_txt">' + n + '</span></a></li>';
            });
            $(".lift_list").prepend(lis);

            $(window).scroll(function () {
                //滚动轴
                var CTop = document.documentElement.scrollTop || document.body.scrollTop;
                //当滚动轴到达1700，左菜单栏显示
                if (CTop >= 1500) {
                    $("#lift").show(500);
                } else {
                    $("#lift").hide(500);
                }
            });
            //.publicss  块
            //.J_lift_item 左导航

            var b;
            $(".lift_list .J_lift_item").click(function () {
                b = $(this).index();
                $(".J_lift_item").removeClass("reds");
                $(this).addClass("reds");
                //离顶部距离
                var offsettop = $(".floor .m").eq(b).offset().top;
                //滚动轴距离
                var scrolltop = document.body.scrollTop | document.documentElement.scrollTop;
                scrolltop(
                    $("html,body").stop().animate({
                        scrollTop: offsettop
                    }, 1000));
            });
            //返回顶部
            $(".lift_item_top").click(function () {
                $('html,body').animate({
                    scrollTop: '0px'
                }, 800);
            });
            //滚动楼层对应切换左侧楼层导航
            var le = $(".floor .m").length;
            var arr = [];
            for (var s = 0; s < le; s++) {
                var nums = $(".floor .m").eq(s).offset().top;
                arr.push(nums);
            }
            $(window).scroll(function () {
                var scrTop = $(window).scrollTop();
                for (var w = 0; w < arr.length; w++) {
                    var cc = arr[w + 1] || 1111111111;
                    if (scrTop >= arr[w] && scrTop <= cc) {
                        if (arr[w + 1] < 0) {
                            w = w + 1;
                        }
                        $(".J_lift_item").removeClass("reds");
                        $(".J_lift_item").eq(w).addClass("reds");
                    }
                }


            });


        })
    </script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
    <link rel="stylesheet" href="<?= $this->view->css ?>/fuGoods.css">
<div class="fu_top">
    <embed id="videoFu" src="<?= $this->view->img ?>/sendFu/fu.swf" type="application/x-shockwave-flash;" quality="high" wmode="transparent" autostart="false" />
</div>
<div class="fu_bg"></div>
<div class="fu_explain"><img src="<?= $this->view->img ?>/sendFu/fu3.jpg" alt=""></div>
<div class="fu_main">
    <div class="main_bg_wrap">
        <div class="goods_bg main_l_bg">
            <!--<img src="<?/*= $this->view->img */?>/sendFu/bg_l_1.png" alt="">
            <img src="<?/*= $this->view->img */?>/sendFu/bg_l_2.png" alt="">-->
            <img src="<?= $this->view->img ?>/sendFu/bg_l.png" alt="">
        </div>
        <div class="goods_bg main_r_bg">
            <!--<img src="<?/*= $this->view->img */?>/sendFu/bg_r_1.png" alt="">
            <img src="<?/*= $this->view->img */?>/sendFu/bg_r_2.png" alt="">-->
            <img src="<?= $this->view->img ?>/sendFu/bg_r.png" alt="">
        </div>
    </div>
    <div class="fu_contant">
        <div class="fu_contant_title"><img src="<?= $this->view->img ?>/sendFu/fu3_pic.png" alt=""></div>
        <div class="fu_list">
            <ul>
                <?php foreach ($data['items'] as $k => $v){ ?>
                    <?php if( $v['fu_state'] == 2 ){?>
                        <li>
                            <div class="goods_wrap">
                                <div class="pic_wrap"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?= $v['goods_id']?>"><img src="<?= $v['goods_image'] ?>" alt=""></a></div>
                                <div class="text_wrap">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?= $v['goods_id']?>">
                                        <p class="fu_goods_title"><?= $v['goods_name']?></p>
                                    </a>
                                    <?php if( $v['fu_name'] ){ ?>
                                        <p class="cx_title"><?=$v['fu_name']?></p>
                                    <?php }?>
                                    <p class="fu_goods_price">价格 <span>￥0.00</span></p>
                                    <p class="fu_goods_num">免单<span><?= $v['sale_countFu']?></span>件</p>
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?= $v['goods_id']?>" class="fu_btn"><p>已抢光</p></a>
                                    <?php if(  $v['is_register'] ==1 ){ ?>
                                        <p class="send_fu_style">需<?=$v['fu_total_times']?>新人注册福</p>
                                    <?php } else {?>
                                        <p class="send_fu_style">需<?=$v['fu_total_times']?>福</p>
                                    <?php }?>
                                </div>
                            </div>
                        </li>
                    <?php }else{ ?>
                        <li>
                            <div class="goods_wrap">
                                <div class="pic_wrap"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?= $v['goods_id']?>"><img src="<?= $v['goods_image'] ?>" alt=""></a></div>
                                <div class="text_wrap">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?= $v['goods_id']?>">
                                        <p class="fu_goods_title"><?= $v['goods_name']?></p>
                                    </a>
                                    <?php if( $v['fu_name'] ){ ?>
                                        <p class="cx_title"><?=$v['fu_name']?></p>
                                    <?php }?>
                                    <p class="fu_goods_price">价格 <span>￥0.00</span></p>
                                    <p class="fu_goods_num">免单<span><?= $v['sale_countFu']?></span>件</p>

                                    <?php if( $v['fu_status'] == 0  ){ ?>

                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?= $v['goods_id']?>" class="fu_btn"><p>送福免单</p></a>

                                    <?php }else if( $v['fu_status'] == 1 ){ ?>

                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?= $v['goods_id']?>" class="fu_btn"><p>送福进行中</p></a>

                                    <?php }else if( $v['fu_status'] == 2 ){ ?>

                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?= $v['goods_id']?>" class="fu_btn"><p>已完成</p></a>

                                    <?php }else if( $v['fu_status'] == 3 ){ ?>

                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?= $v['goods_id']?>" class="fu_btn"><p>已购买</p></a>

                                    <?php }else if( $v['fu_status'] == 4 ){ ?>

                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?= $v['goods_id']?>" class="fu_btn"><p>已免单</p></a>

                                    <?php }else if( $v['fu_status'] == 5 ){ ?>

                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?= $v['goods_id']?>" class="fu_btn"><p>送福失败</p></a>

                                    <?php }?>

                                    <?php if(  $v['is_register'] ==1 ){ ?>
                                        <p class="send_fu_style">需<?=$v['fu_total_times']?>新人注册福</p>
                                    <?php } else {?>
                                        <p class="send_fu_style">需<?=$v['fu_total_times']?>福</p>
                                    <?php }?>
                                </div>
                            </div>
                        </li>
                     <?php }?>

                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>

<script>
    //头部flash动画
 $(window).scroll(function(){
     var scroll_H = $(".head").height()+ $(".wrap").height()+$(".fu_top").height();
     var scroll_top = $(this).scrollTop();//鼠标滚动距顶部的距离
     $("#videoFu").css("opacity","0");
     if(scroll_top<scroll_H ){
         $("#videoFu").css("opacity","1")
     }
 })
</script>
<script>
    $(window).scroll(function() {
        var goods_bg_H = $(".goods_bg").outerHeight(true);
        var main_H = $(".fu_contant").outerHeight(true);
        var main_offset_H = $(".fu_contant").offset().top;
        var allHeight = $(".fu_contant").outerHeight(true) + $(".fu_contant").offset().top;
        var scroll_top = $(this).scrollTop();//鼠标滚动距顶部的距离
        var li_length = $(".fu_contant ul li").length;
        if(li_length > 3){
            if (scroll_top < main_offset_H) {
                $(".goods_bg").css({"position": "absolute", "top": "0"});
            } else if (scroll_top > (allHeight - goods_bg_H)) {
                $(".goods_bg").css({"position": "absolute", "top": (main_H - goods_bg_H)});
            } else {
                $(".goods_bg").css({"position": "fixed", "top": "0"});
            }
        }

    })
</script>
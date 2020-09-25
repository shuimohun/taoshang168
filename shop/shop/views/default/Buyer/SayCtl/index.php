<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
<link rel="stylesheet" href="<?= $this->view->css ?>/buyer_say.css">
<style>
    p{display:block;-webkit-margin-before:1em;-webkit-margin-after:1em;-webkit-margin-start:0;-webkit-margin-end:0}
    .share{width:98px;height:18px;border:1px solid #c51e1e;font-size:12px;line-height:19px;color:#c51e1e;text-align:center}
    .share_wrap{display:inline-block;float:left;margin-left:20%;margin-top:3px;margin-bottom:4px}
    .share u{text-decoration:none;background-color:#c51e1e;color:#fff;float:right;width:48px;height:100%;text-align:center}
    .sub{float:right;font-size:12px;margin-top:-2px;color:#999}
    .goods_shared_price{color:red;margin-top:-2px;float:left}
</style>
    <div class="member_infor_content">

        <div class="say_main">
            <div class="say_main_list">
                <div class="say_list_title">
                    <span class="user_tx"><img src="<?= $data['user_image'] ?>" alt=""></span>
                    <span class="user_name"><?= $data['user_name']?></span>
                    <span class="user_gz"><?= $data['friend']?$data['friend']:0?>关注</span>
                    <span class="user_wz"><?= $data['totalsize']?$data['totalsize']:0?>篇文章</span>
                </div>
                <div class="say_content">
                    <?php foreach ($data['items'] as $v):?>
                    <div class="say_item clearfix">
                        <div class="say_item_l">
                            <div class="say_item_border"><div class="say_item_border_blue"><i></i></div></div>
                            <div class="say_item_l_text">
                                <div class="say_item_l_text_wrap">
                                    <p class="say_time"><?= $v['information_add_time']?></p>
                                   <!--<a href="#" class="delete_btn">删除</a>-->
                                   <a href="<?= YLB_Registry::get('url').'?ctl=Buyer_Say&met=post&information_id='.$v['information_id'] ?>" class="bj_btn">
                                       编辑
                                   </a>
                                </div>
                            </div>
                        </div>
                        <div class="say_item_r">
                            <h3 class="say_title"><a href="#"><?= $v['information_title']?></a></h3>
                            <p class="say_text"><?= $v['information_keyword']?></p>
                            <?php if ($v['information_pic']):?>
                            <div class="say_pic_list">
                                <ul class="clearfix">
                                    <li><a href="#"><img src="<?= $v['information_pic'] ?>" alt=""></a></li>
                                    <li><a href="#"><img src="<?= $v['information_desc_img'][0] ?>" alt=""></a></li>
                                    <li><a href="#"><img src="<?= $v['information_desc_img'][1] ?>" alt=""></a></li>
                                </ul>
                            </div>
                            <?php endif;?>
                            <?php if ($v['goods']):?>
                                <h4 class="say_goods_title">我喜欢的商品</h4>
                                <div class="say_goods_list">
                                    <ul class="clearfix">
                                        <?php foreach ($v['goods'] as $goods):?>
                                            <li>
                                                <a href="<?= YLB_Registry::get('url') . '?ctl=Goods_Goods&met=goods&type=goods&gid='?><?=$goods['goods_id']?>">
                                                    <img src="<?=$goods['goods_image']?>" alt="">
                                                    <div class="goods_text">
                                                        <span>￥<?= $goods['information_goods_price']?></span>
                                                        <p><?= $goods['goods_name']?></p>

                                                    </div>
                                                </a>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            <?php endif;?>
                            <div class="say_share clearfix">
                                <span><img src="<?= $this->view->img ?>/eye.png" alt=""><?= $v['information_read_count']?></span>
                                <span><img src="<?= $this->view->img ?>/fansicon2.png" alt=""><?= $v['information_reply_count']?></span>
                                <span><img src="<?= $this->view->img ?>/fansicon1.png" alt=""><?= $v['howlike']?></span>
                                <span>来自:<?= $v['information_group_title']?></span>
                                <span class="look_all"><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id='?><?=$v['information_id']?>">查看全部</a></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <!--分页器start-->
                    <div class="page_wrap">
                        <div class="flip page page_front clearfix" style="text-align: center;">
                           <?= $data['page_nav']?>
                        </div>
                    </div>
                    <!--分页器end-->
                </div>
            </div>
        </div>
    </div>
<script>

</script>

<script>
    $(".say_item_r").each(function(){
        var say_item_r_H = $(this).height();
        $(this).prev(".say_item_l").css("height",say_item_r_H+"px");
    })
    $('.page_front a').click(function () {
        page = $(this).attr('data-page');
        getList();
    });
    function getList() {
        $.post("?ctl=Buyer_Say&met=index&typ=json", {page:page}, function (r){
            //分页
            $('.page_front').html(r.data.page_nav);
            //分页结束  2333


            })
        }
</script>

<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>




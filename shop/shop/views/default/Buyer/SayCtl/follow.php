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
        <div class="say_main follow_main">
            <div class="say_main_list">
                <div class="say_list_title">
                    <span class="user_tx"><img src="<?= $data['user_image'] ?>" alt=""></span>
                    <span class="user_name"><?= $data['user_name']?></span>
                    <span class="user_gz"><?= $data['friend']?$data['friend']:0?>关注</span>
                    <span class="user_wz"><?= $data['information_count']?$data['information_count']:0?>篇文章</span>
                </div>
                <?php if ($data['items']):?>
                <div class="say_content">
                    <?php  foreach ($data['items'] as $v):?>
                    <div class="say_item clearfix">
                        <div class="say_item_l">
                            <div class="say_item_border"><div class="say_item_border_blue"><i></i></div></div>
                            <div class="say_item_l_text">
                                <div class="say_item_l_text_wrap">
                                    <div class="gz_user_tx"><img src="<?= $this->view->img ?>/default_user_portrait.gif" alt=""></div>
                                    <p class="gz_user_name"><?= $v['user_name']?></p>
                                    <p class="gz_user_num"><?= $v['friend']?$v['friend']:0?>关注</p>
<!--                                    <p class="gz_user_gx">已更新<span>99</span></p>-->
                                    <p class="gz_user_time"><?= $v['information_add_time']?></p>
<!--                                    <a class="gz_user_toindex" href="#">进入主页</a>-->
<!--                                    <a class="gz_user_btn" href="">取消关注</a>-->
                                </div>
                            </div>
                        </div>
                        <div class="say_item_r">
                            <h3 class="say_title">
                                <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id='?><?=$v['information_id']?>">
                                    <?= $v['information_title']?>
                                </a>
                            </h3>
                            <p class="say_text"><?= $v['keyword']?></p>
                            <?php if ($v['information_pic']):?>
                                <div class="say_pic_list">
                                    <ul class="clearfix">
                                        <li>
                                            <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id='?><?=$v['information_id']?>">
                                                <img src="<?= $v['information_pic'] ?>" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif;?>
                            <?php if ($v['goods'][0]['goods_id']):?>
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
                                <?php if( $v['is_like'] == 1){ ?>
                                    <span>
                                        <img src="<?= $this->view->img ?>/like.png" onclick="like(this)" id="<?=$v['information_id']?>" alt="">
                                        <i><?= $v['howlike']?></i>
                                    </span>
                                <?php }else if( $v['is_like'] == 0 ){ ?>
                                    <span>
                                        <img src="<?= $this->view->img ?>/fansicon1.png" onclick="like(this)" id="<?=$v['information_id']?>" alt="">
                                        <i><?= $v['howlike']?></i>
                                    </span>
                                <?php }?>
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
                <?php else:?>
                <div>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>


<script>
    //左侧时间轴样式
    $(".say_item_r").each(function(){
        var say_item_r_H = $(this).height();
        $(this).prev(".say_item_l").css("height",say_item_r_H+"px");
    })

    function like(i) {
        var _this           = $(i);
        var information_id  = _this.attr("id");
        var src             = _this.attr("src");
        var likeNum = _this.next().text();
        if(STATIC_URL+'/images/fansicon1.png' == src )
        {
            $.ajax({
                url:'?ctl=Information_Like&met=like&typ=json',
                type:'post',
                async:false,
                data:{information_id:information_id},
                dataType:'json',
                success:function(e)
                {
                    if(e.status == 200 )
                    {
                        likeNum++;
                        _this.next().text(likeNum)
                        _this.attr("src",STATIC_URL+'/images/like.png');
                    }
                }
            });
        };

    }
</script>


<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>




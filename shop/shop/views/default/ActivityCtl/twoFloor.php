<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$data['temp_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?=$this->view->css ?>/sweepgoods.css" />
    <script type="text/javascript" src="<?= $this->view->js_com ?>/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/swiper.min.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/index.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/nav.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/jquery.nicescroll.js"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/base.js"></script>
    <script type="text/javascript">
        var BASE_URL = "<?=YLB_Registry::get('base_url')?>";
        var SITE_URL = "<?=YLB_Registry::get('url')?>";
        var INDEX_PAGE = "<?=YLB_Registry::get('index_page')?>";
        var STATIC_URL = "<?=YLB_Registry::get('static_url')?>";
        var PAYCENTER_URL = "<?=YLB_Registry::get('paycenter_api_url')?>";
        var UCENTER_URL = "<?=YLB_Registry::get('ucenter_api_url')?>";
        var is_open_city = "<?= Web_ConfigModel::value('subsite_is_open');?>";
        <?php if($data['background']){?>
        $('.goods_container').css('background-color',"<?=$data['background']?>");
        <?php } ?>
    </script>
</head>
<body>
<?php if($pc_head_image['items']){?>
    <a href="<?=$pc_head_image['items']['url'] ?>"><img src="<?=$pc_head_image['items']['pic_url'] ?>" alt="" class="img_01"></a>
<?php }else{ ?>
    <img src="<?=$this->view->img?>/twoFloor/bg_01_r1_c1.png" alt="" class="img_01">
<?php } ?>
<div class="title_bg"><?=$data['main_title'][0] ?></div>
<div class="goods_container">
    <?php for($i=0;$i<4;$i++){?>
        <div class="goods_container_item">
            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goodslist'][$i]['id_goods']?>">
                <img src="<?=$data['goodslist'][$i]['common_image']?>" alt="">
                <div class="text">
                    <span class="biaoti"><?=$data['goodslist'][$i]['common_name']?></span><br>
                    <i><?=$data['goodslist'][$i]['common_promotion_tips']?></i><br>
                    <del class='share1'>分享立减：<span>￥<?=$data['goodslist'][$i]['common_share_price']?></span></del>
                    <del>分享立赚：<span>￥<?=$data['goodslist'][$i]['common_promotion_price']?></span></del>
                    <del style='color: #a75329; margin-top: 50px'>活动价：<span style='color: #f10d00;font-style: italic;'>￥<?=$data['goodslist'][$i]['common_shared_price']?></span></del>
                    <span class='qianggoua'>立即抢购</span>
                </div>
            </a>
        </div>
    <?php } ?>
</div>
<div class="title_bg2"><?=$data['main_title'][1] ?></div>
<div class="newgoods_container">
    <div class="newgoods_container_inner">
        <?php for($i=4;$i<count($data['goodslist']);$i++){?>
            <div class="newgoods_container_item">
                <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goodslist'][$i]['id_goods']?>">
                    <img src="<?=$data['goodslist'][$i]['common_image']?>" alt="">
                    <span><?=$data['goodslist'][$i]['common_name']?></span>
                    <span class="act">活动价：<i>￥<?=$data['goodslist'][$i]['common_shared_price']?></i></span>
                    <p class='qiangou'>立即抢购</p>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
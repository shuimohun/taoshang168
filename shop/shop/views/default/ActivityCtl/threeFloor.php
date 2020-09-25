<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$data['temp_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?=$this->view->css ?>/practical.css" />
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
        $('.practical_bg').css('background-color',"<?=$data['background']?>");
        <?php } ?>
    </script>
</head>
<body>
<?php if($pc_head_image['items']){?>
    <a href="<?=$pc_head_image['items']['url'] ?>"><img src="<?=$pc_head_image['items']['pic_url'] ?>" alt="" class="img_01"></a>
<?php }else{ ?>
<img src="<?=$this->view->img?>/threeFloor/shiyong_01.jpg" alt="" class="img_01">
<?php } ?>
<div class="practical_bg">
    <span class="practical_title"><?=$data['main_title'][0]?></span><br>
    <span class="practical_subtitle"><?=$data['assis_title'][0]?></span>
    <div class="newgoods_container_inner">
        <?php for($i=0;$i<4;$i++){?>
        <div class="newgoods_container_item">
        <a style='text-decoration: none' href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goodslist'][$i]['id_goods']?>">
            <img src="<?=$data['goodslist'][$i]['common_image'] ?>" alt="">
            <div class='biaoti'><?=$data['goodslist'][$i]['common_name']?></div>
            <a class='qianggoua' href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goodslist'][$i]['id_goods']?>">￥<?=$data['goodslist'][$i]['common_shared_price']?> <span>立即抢购</span></a>
        </a>
        </div>
        <?php } ?>
    </div>
</div>
<div  class="contain2">
    <div class="contain2-wrap">
        <div class="contain2_border">
            <div class="contain2_top">
                <span><?=$data['main_title'][1]?></span><br>
                <i><?=$data['assis_title'][1]?></i><br>
                <?php for($i=4;$i<6;$i++){?>
                <div class="contain2_item">
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goodslist'][$i]['id_goods']?>">
                    <img src="<?=$data['goodslist'][$i]['common_image']?>" alt="">
                    <div class="text">
                        <span class="biaoti"><?=$data['goodslist'][$i]['common_name']?></span><br>
                        <i><?=$data['goodslist'][$i]['common_promotion_tips']?></i><br>
                        <u><?=$data['goodslist'][$i]['base_spec_name']?></u>
                        <del>分享立减：<span>￥<?=$data['goodslist'][$i]['common_share_price']?></span></del>
                        <del>分享立赚：<span>￥<?=$data['goodslist'][$i]['common_promotion_price']?></span></del>
                        <del style='margin-top: 20px'>活动价：<span>￥<?=$data['goodslist'][$i]['common_shared_price']?></span></del>
                        <a class='qianggoua' href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goodslist'][$i]['id_goods']?>">立即抢购</a>
                    </div>
                    </a>
                </div>
                <?php } ?>
            </div>
            <div class="contain2_list">
                <?php for($i=6;$i<14;$i++){?>
                        <div class="contain2_list_item">
                            <a style='text-decoration: none;' href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goodslist'][$i]['id_goods']?>">
                            <img src="<?=$data['goodslist'][$i]['common_image']?>" alt="">
                            <div class='biaoti'><?=$data['goodslist'][$i]['common_name']?></div>
                            <span>R M B:<i>￥<?=$data['goodslist'][$i]['common_shared_price']?></i></span><br>
                           <del>立即购买 >>></del>
                            </a>
                        </div>
              <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="contain3">
    <span><?=$data['main_title'][2]?></span>
    <p><?=$data['assis_title'][2]?></p>
    <ul>
        <?php for($i=14;$i<count($data['goodslist']);$i++){?>
        <li>
            <a style='text-decoration: none;' href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goodslist'][$i]['id_goods']?>">
            <img src="<?=$data['goodslist'][$i]['common_image']?>" alt="">
            <div class='biaoti'><?=$data['goodslist'][$i]['common_name']?></div>
            <span>R M B:<i>￥<?=$data['goodslist'][$i]['common_shared_price']?></i></span><br>
            <p>立即购买 >>></p>
            </a>
        </li>
      <?php } ?>
    </ul>
</div>
</body>
</html>
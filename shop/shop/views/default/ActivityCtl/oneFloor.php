<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$data['temp_title']?></title>
    <link rel="stylesheet" type="text/css" href="<?=$this->view->css ?>/surprised.css" />
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
    </script>
</head>
<body>
<?php if($pc_head_image['items']){?>
    <a href="<?=$pc_head_image['items']['url'] ?>"><img src="<?=$pc_head_image['items']['pic_url'] ?>" alt="" class="jingxi_banner"></a>
<?php }else{ ?>
    <img src="<?=$this->view->img?>/oneFloor/jingxi_01.jpg" alt="" class="jingxi_banner">
<?php } ?>
<div class="contentblock">
    <span> - <?=$data['main_title'][0]?> - </span><br>
    <i><?=$data['assis_title'][0]?></i>
    <ul class="contentblock_container">
        <?php for($i=0;$i<4;$i++){?>
        
        <li>
            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goodslist'][$i]['id_goods']?>">
            <img src="<?=$data['goodslist'][$i]['common_image'] ?>" alt="">
            <span><?=$data['goodslist'][$i]['common_name']?></span><br>
            <em>活动特价：<br><b>￥<?=$data['goodslist'][$i]['common_shared_price']?></b></em>
            <u><del>原价：￥<?=$data['goodslist'][$i]['common_price']?></del><button>立即抢购</button></u>
            </a>
        </li>
       <?php } ?>
    </ul>
</div>
<div class="contentone">
    <ul class="contentone_item">
        <?php for($i=4;$i<6;$i++){?>  
        <li>
            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goodslist'][$i]['id_goods']?>">
            <img src="<?=$data['goodslist'][$i]['common_image'] ?>" alt="">
            <span><?=$data['goodslist'][$i]['common_name']?></span><br>
            <em>活动特价：<br><b>￥<?=$data['goodslist'][$i]['common_shared_price']?></b></em>
            <u><del>原价：￥<?=$data['goodslist'][$i]['common_price']?></del><button>立即抢购</button></u>
            </a>
        </li>
       <?php } ?>
    </ul>
</div>
<div class="contain_bottom">
    <span> <?=$data['main_title'][1]?> </span><br>
    <i><?=$data['assis_title'][1]?></i>
    <ul class="contain_bottom_all">
        <?php for($i=6;$i<count($data['goodslist']);$i++){?>
        <li>
            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goodslist'][$i]['id_goods']?>">
            <div class="li_inner">
                <img src="<?=$data['goodslist'][$i]['common_image'] ?>" alt="">
                <span class="title"><?=$data['goodslist'][$i]['common_name']?></span><br>
                <em>活动特价：<br><b>￥<?=$data['goodslist'][$i]['common_shared_price']?></b></em>
                <u><del>原价：￥<?=$data['goodslist'][$i]['common_price']?></del><button>立即抢购</button>></u>
            </div>
            </a>
        </li>
      <?php } ?>
    </ul>
</div>
</body>
</html>
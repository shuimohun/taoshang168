<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'self_header.php';
?>
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/goods_top_sale.css">
<style>
    .main .part-tab-content .part-tab-list .li-portrait .img-show{width: 180px;height: 180px;}
    .main .part-tab-content .part-tab-list .li-portrait .img-show .grating-wrap{width: 180px;    margin-left: -90px;}
    .main .titl{margin: 28px 0;}
</style>
<div class="container">
    <div class="main">
        <div class="titl">
        <h1>今日上新</h1>
        </div>

        <div class="part-tab-content">
            <ul class="part-tab-list orflow">
                <?php if($data){ foreach ($data['items'] as $key=>$value){?>
                    <li class="no-3-after li-portrait shadow" >
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank">
                            <div class="img-show">
                                <img alt="" src="<?=$value['common_image']?>">
                                <div class="grating-wrap orflow">
                                    <div class="gratingRate lf" style="margin-left:15px">
                                        好评<span><?=$value['common_evaluate']?></span>
                                    </div>
                                    <div class="gratingNum rt" style="margin-right:15px">
                                        收藏 <span><?=$value['common_collect']?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="img-else">
                                <div class="text-description">
                                    <p class="text1"><?=$value['common_name']?></p>
                                </div>
                                <div class="share-wrap orflow">
                                    <div class="share-sub lf">
                                        <span class="share-text">分享立减</span>
                                        <span class="price"><?=$value['common_share_price']?></span>
                                    </div>
                                    <div class="share-sub rt">
                                        <span class="share-text">立赚</span>
                                        <span class="price"><?=$value['common_promotion_price']?></span>
                                    </div>
                                </div>
                                <div class="price-wrap orflow">
                                    <div class="price lf">
                                        <span  style="color:#c51e1e"><?=$value['common_price']?></span>
                                    </div>
                                    <div class="rt">销量：<span><?=$value['common_salenum']?></span></div>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php }}?>
            </ul>
        </div>
    </div>
</div>

</body>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>



<?php foreach ($data['items'] as $key=>$value){ ?>
    <li class="no-3-after li-portrait shadow">
        <a href="<?php YLB_Registry::get('shop_api_url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>" target="_blank">
            <div class="ratings-result flag-<?=$key+1?>">
                <div class="flag-left">
                    <i><?=$key+1?></i>
                </div>
            </div>
            <div class="img-show">
                <img class="lazy" data-original="<?=image_thumb($value['common_image'],160,160)?>" alt="">
                <div class="grating-wrap orflow">
                    <div class="gratingRate lf">
                        好评率<span><?=$value['good_rate']?>%</span>
                    </div>
                    <div class="gratingNum rt">
                        好评数 <span><?=$value['good_count']?></span>
                    </div>
                </div>
            </div>
            <div class="img-else">
                <div class="text-description">
                    <div class="sign">
                        <?php if($value['shop_self_support']){ ?>
                            <span class="sign1">自营</span>
                        <?php } ?>
                        <!--<span class="sign2">赠</span>-->
                    </div>
                    <p class="text1"><?=$value['common_name']?></p>
                </div>
                <div class="share-wrap orflow">
                    <div class="share-sub lf">
                        <span class="share-text">分享立减</span>
                        <span class="price">￥<?=$value['common_share_price']?></span>
                    </div>
                    <?php if($value['common_is_promotion']){ ?>
                        <div class="share-sub rt">
                            <span class="share-text">立赚</span>
                            <span class="price">￥<?=$value['common_promotion_price']?></span>
                        </div>
                    <?php }?>
                </div>
                <div class="price-wrap">
                    <div class="price">
                        ￥<span  style="color:#c51e1e"><?=$value['common_shared_price']?></span>
                    </div>
                </div>
            </div>
        </a>
    </li>
<?php } ?>
<script type="text/javascript" charset="utf-8">
    $(function() {
        $("img.lazy",'.img-show').lazyload({skip_invisible : false,placeholder : "<?= $this->view->img ?>/grey.gif",threshold: 200,effect: "show",failurelimit : 10});
    });
</script>
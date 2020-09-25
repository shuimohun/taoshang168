<?php if(!empty($shop_list['items'])){?>
    <?php
    foreach($shop_list['items'] as $k=>$v){ ?>
        <div class="item">
            <img class="brand_logo" src="<?=image_thumb($v['shop_logo'],90,45)?>">
            <a class="barnd_shop" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=$v['shop_id']?>">
                <?=_('进入店铺')?>
            </a>

            <!--关注 start-->
            <div class="brand_goodsList">
                <?php if(!empty($v['detail']['items'])){?>
                    <?php foreach($v['detail']['items'] as $kk=>$vv){ ?>
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$vv['goods_id']?>">
                            <img src="<?=image_thumb($vv['common_image'],100,100)?>">
                            <p class="brand_name" title="<?=$vv['common_name']?>"><?=$vv['common_name']?></p>
                            <p class="brand_price" title="<?=format_money($vv['common_price'])?>"><?=format_money($vv['common_price'])?></p>
                        </a>
                    <?php }?>
                <?php }?>
            </div>
        </div>
        <!--关注 end-->
    <?php }?>
<?php }else{?>
    <div class="item_cons_no">
        <?=_('店铺收藏为空')?>
    </div>
<?php }?>
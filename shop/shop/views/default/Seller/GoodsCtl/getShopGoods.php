<?php if($data['items']){ ?>
<ul class="fn-clear">
    <?php
        foreach($data['items'] as $key=>$goods)
        {
            ?>
            <li>
                <div class="goods-image"><img src="<?=image_thumb($goods['common_image'],140,140)?>" /></div>
                <div class="goods-name"><?=$goods['common_name']?></div>
                <div class="goods-price"><?=_('专柜价')?>：<span><?=format_money($goods['common_price'])?></span></div>
                <div class="share-sum-price"><?=_('分享优惠')?>：<span><?=format_money($goods['common_shared_price'])?></span></div>
                <div class="goods-btn">
                    <?php if(isset($goods['is_shop_like']) && $goods['is_shop_like'] == '1'){ ?>
                        <div class="button is_in">已设定</div>
                    <?php }else{?>
                        <div data-type="btn_add_goods" class="button button_green" data-shared-price="<?=$goods['common_shared_price']?>" data-cat-id="<?=$goods['cat_id']?>"  data-cat-name="<?=$goods['cat_name'] ?>" data-common-id="<?=$goods['common_id']?>"  data-common-name="<?=$goods['common_name']?>" data-common-img="<?=$goods['common_image']?>" data-common-price="<?=$goods['common_price']?>"  href="javascript:void(0);" class="ncbtn-mini"><i class="iconfont icon-jia"></i><?=_('选择商品')?></div>
                    <?php }?>
                </div>
            </li>
        <?php 	}	?>
</ul>
<?php }else{ ?>
    <div class="no_account">
        <img src="<?=$this->view->img?>/ico_none.png">
        <p>暂无符合条件的数据记录</p>
    </div>
    <?php
}
?>
<?php if($page_nav){ ?>
    <div class="goods-page fn-clear">
        <div class="mm">
            <div class="page"><?=$page_nav?></div>
        </div>
    </div>
<?php } ?>



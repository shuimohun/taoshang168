<?php if($data){ ?>
    <ul class="fn-clear">
        <?php
        foreach($data as $key=>$goods)
        {
            ?>
            <li>
                <div class="goods-image"><img src="<?=image_thumb($goods['common_image'],140,140)?>" /></div>
                <div class="goods-name"><?=$goods['common_name']?></div>
                <div class="goods-price"><?=_('销售价')?>：<span><?=$goods['common_price']?></span></div>
                <div class="goods-btn"><a data-type="btn_add_goods" data-id="<?=$goods['goods_id']?>" common-id="<?=$goods['common_id']?>" href="javascript:void(0);" class="button"><i class="iconfont icon-jia"></i><?=_('选择为团购商品')?></a></div>
            </li>
        <?php }	?>
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

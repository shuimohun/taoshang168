<?php if($data['items']){ ?>
    <ul class="fn-clear">
        <?php foreach($data['items'] as $key=>$value) { ?>
            <li>
                <div class="goods-image"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>&typ=e" target="_blank"><img src="<?=image_thumb($value['goods_image'],140,140)?>" /></a></div>
                <div class="goods-name"><?=$value['goods_name']?></div>
                <div class="goods-price"><?=_('商品价格')?>：<span><?=format_money($value['goods_price'])?></span></div>
                <div class="share-sum-price"><?=_('分享优惠')?>：<span><?=format_money($value['share_sum_price'])?></span></div>
                <div class="goods-stock"><?=_('库存')?>：<span><?=$value['goods_stock']?></span></div>
                <!--<div class="share-sum-price"><?/*=_('颜色')*/?>：<span><?/*=format_money($value['share_sum_price'])*/?></span></div>
                <div class="share-sum-price"><?/*=_('尺码')*/?>：<span><?/*=format_money($value['share_sum_price'])*/?></span></div>
                <div class="share-sum-price"><?/*=_('套餐')*/?>：<span><?/*=format_money($value['share_sum_price'])*/?></span></div>
                <div class="share-sum-price"><?/*=_('其他')*/?>：<span><?/*=format_money($value['share_sum_price'])*/?></span></div>-->
                <div class="goods-btn">
                    <?php if($value['is_joined']){ ?>
                        <div class="button button_orange">已加入本活动</div>
                    <?php }else{?>
                        <div data-type="btn_add_goods" class="button button_green" data-goods-id="<?=$value['goods_id']?>" data-common-id="<?=$value['common_id']?>" data-goods-price="<?=$value['goods_price']?>" data-share-sum-price="<?=$value['share_sum_price']?>"><i class="iconfont icon-jia"></i><?=_('选择商品')?></div>
                    <?php }?>
                </div>
            </li>
        <?php }	?>
    </ul>
<?php }else{ ?>
    <div class="no_account">
        <img src="<?=$this->view->img?>/ico_none.png">
        <p>暂无符合条件的数据记录</p>
    </div>
<?php } ?>

<?php if($page_nav){ ?>
    <div class="goods-page fn-clear">
        <div class="mm">
            <div class="page"><?=$page_nav?></div>
        </div>
    </div>
<?php } ?>

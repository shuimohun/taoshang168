<style>
    .hidden{display: none !important;}
</style>
<div class="search-goods-list-hd">
    <label><?=_('搜索店内商品')?></label>
    <input type="text" name="goods_name" class="text w200" id="key" value="<?=request_string('goods_name')?>">
    <a class="button btn_search_goods btn-sku-search-goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>
</div>

<div class="search-goods-list-bd fn-clear">
    <?php if($data['items']){ ?>
        <ul class="fn-clear">
            <?php foreach($data['items'] as $key=>$goods){ ?>
                <li>
                    <div class="goods-image"><img src="<?=image_thumb($goods['goods_image'],140,140)?>" /></div>
                    <div class="goods-name"><?=$goods['goods_name']?></div>
                    <div class="goods-price"><?=_('销售价')?>：<span><?=format_money($goods['goods_price'])?></span></div>
                    <div class="share-sum-price"><?=_('分享优惠')?>：<span><?=format_money($goods['share_sum_price'])?></span></div>
                    <div class="goods-stock"><?=_('库存')?>：<span><?=$goods['goods_stock']?></div>
                    <div class="goods-btn">
                        <div class="button button_green" data-type="btn_add_sku_goods"  data-id="<?=$goods['goods_id']?>" btn-sku-enabled="<?=$goods['goods_id']?>" data-level="<?=@$date_level?>" href="javascript:void(0);" ><i class="iconfont icon-jia"></i><?=_('设置为换购商品')?></div>
                        <div class="button button_orange <?=$goods['is_joined']=='true'?'':'hidden'?>" data-id="<?=$goods['goods_id']?>"  btn-sku-disabled="<?=$goods['goods_id']?>"  ><?=_('已加入本活动')?></div>
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
</div>

<script>
    $.extend(window.couLevelSkuInSearch,<?=$rows?>);
</script>
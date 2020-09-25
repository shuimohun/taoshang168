<style>
    .hidden{display: none !important;}
</style>
<div class="search-goods-list-hd">
    <label><?=_('搜索店内商品')?></label>
    <input type="text" name="goods_name" class="text w200" id="key" value="<?=request_string('goods_name')?>">
    <a class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>
</div>

<div class="search-goods-list-bd fn-clear">
    <?php if($data){ ?>
        <ul class="fn-clear">
            <?php foreach($data as $key=>$goods){ ?>
                <li>
                    <div class="goods-image"><img src="<?=image_thumb($goods['goods_image'],140,140)?>" /></div>
                    <div class="goods-name"><?=$goods['goods_name']?></div>
                    <div class="goods-price"><?=_('销售价')?>：<span><?=format_money($goods['goods_price'])?></span></div>
                    <div class="share-sum-price"><?=_('分享优惠')?>：<span><?=format_money($goods['share_sum_price'])?></span></div>
                    <div class="goods-stock"><?=_('规格')?>：<span><?=$goods['goods_spec']?></div>
                    <div class="goods-stock"><?=_('库存')?>：<span><?=$goods['goods_stock']?></div>
                    <div class="goods-btn">
                        <div class="button button_orange <?=$goods['increase_goods_id']?'':'hidden'?>" btn-disabled="<?=$goods['goods_id']?>">已加入活动</div>
                        <div data-type="btn_add_act_goods" class="button button_green <?=$goods['increase_goods_id']?'hidden':'button'?>" btn-enabled="<?=$goods['goods_id']?>" data-id='<?=$goods['goods_id']?>' ><i class="iconfont icon-jia"></i><?=_('选择商品')?></div>
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
    var initGoodsItems = <?=$json_rows ?> ;
    $('.goods-btn').on('click', '[data-type="btn_add_act_goods"]', function() {
        var id = $(this).attr('data-id');
        if ($(".join-act-goods-sku tr[data-goods-id='" + id + "']").length > 0) {
            return false
        }
        var i = initGoodsItems[id];
        var temp = $('#goods-sku-item-tpl').html();
        temp = temp.replace(/__([a-zA-Z]+)/g, function(r, $1) {
            return i[$1]
        });
        var $temp = $(temp);
        $temp.find('img[data-src]').each(function() {
            this.src = $(this).attr('data-src')
        });
        $('.join-act-goods-sku').append($temp);
        $("div[btn-disabled='" + id + "']").removeClass('hidden');
        $("div[btn-enabled='" + id + "']").addClass('hidden')
    });
    $('.btn_search_goods').click(function() {
        var increase_id = $(this).attr('data-increase-id');
        var url = SITE_URL + '?ctl=Seller_Promotion_Increase&met=getShopGoods&typ=e&op=edit';
        var key = $("#key").val();
        $('#cou-sku-options').load(url, {id: increase_id,goods_name:key})
    });
</script>

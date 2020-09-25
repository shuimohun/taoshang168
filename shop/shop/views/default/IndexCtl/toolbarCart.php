

<?php  if(isset($data) && $data['count']) :?>
    <script>
        $('.cart_count').html('<?=$data['count']?>');
    </script>
    <div class="tbar-panel-main tbar-panel-main-sidebar cart_con">
        <?php foreach($data['cart_list'] as $cartk => $cartv): ?>
            <div class="cart_contents">
                <!--店铺信息 start-->
                <div class="cart_contents_head">
                    <div class="cart_shop_icon">
                        <i class="iconfont icon-icoshop"></i>
                    </div>
                    <div class="cart_contents_title">
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=Index&id=<?=($cartv['shop_id'])?>">
                            <span title="<?=($cartv['shop_name'])?>"><?=($cartv['shop_name'])?></span>
                        </a>
                    </div>
                    <div class="cart_contents_cost">
                        <strong>
                            <?=format_money($cartv['sprice'])?>
                        </strong>
                    </div>
                </div>
                <!--店铺信息 end-->

                <!--购物车商品 start-->
                <div class="cart_lists">
                    <?php foreach($cartv['goods'] as $cartgk => $cartgv):?>
                        <?php if($cartgv['bl_id']){?>
                            <div class="cart_bl_title">
                                <span class="ti"><?=('套装')?></span>
                                <span><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=bundling&bid=<?=$cartgv['bl_id']?>" target="_blank"><?=($cartgv['bundling_info']['bundling_name'])?></a></span>
                            </div>
                            <?php foreach ($cartgv['bundling_info']['goods_list'] as $bl_k=>$bl_v){?>
                                <div class="cart_list bl_cart_list">
                                    <div class="cart_list_order clearfix">
                                        <div class="cart_list_orderimg">
                                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($bl_v['goods_id'])?>" target="_blank">
                                                <img src="<?=image_thumb($bl_v['goods_image'],50,50)?>">
                                            </a>
                                        </div>
                                        <div class="cart_list_content" style="">
                                            <div>
                                                <span class="cart_goods_name"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($bl_v['goods_id'])?>" target="_blank"><?=$bl_v['goods_name']?></a></span>
                                            </div>
                                            <div>
                                                <span><?=$bl_v['spec_str']?></span>
                                            </div>
                                            <div>
                                                <span class="bbc_color"><?=format_money($bl_v['bundling_goods_price'])?></span>
                                                <span><?=('x')?></span>
                                                <span><?=($cartgv['goods_num'])?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        <?php }else{?>
                            <div class="cart_list">
                                <div class="cart_list_order clearfix">
                                    <div class="cart_list_orderimg">
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($cartgv['goods_id'])?>" target="_blank">
                                            <img src="<?=image_thumb($cartgv['goods_image'],50,50)?>">
                                        </a>
                                    </div>
                                    <div class="cart_list_content">
                                        <div>
                                            <span class="cart_goods_name"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($cartgv['goods_id'])?>" target="_blank"><?=$cartgv['goods_name']?></a></span>
                                        </div>
                                        <div>
                                            <span><?=$cartgv['spec_str']?></span>
                                        </div>
                                        <div>
                                            <span class="bbc_color"><?=format_money($cartgv['now_price'])?></span>
                                            <span><?=('x')?></span>
                                            <span><?=($cartgv['goods_num'])?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    <?php endforeach;?>
                </div>
                <!--购物车商品 end-->
            </div>
        <?php endforeach; ?>
    </div>
    <div class="cart_pay">
        <div class="padd">
            <div class="cart_foot clearfix">
                <span class="cartall"><?='总计:'?><?=format_money($data['sum'])?></span>
            </div>
            <div class="topay">
                <a class="bbc_bg_col" href="<?=YLB_Registry::get('url')?>?ctl=Buyer_Cart&met=cart" target="_blank">
                    <?=_('去购物车结算')?><b class="yuan iconfont icon-iconjiantouyou"></b>
                </a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="item_cons_no">
        <?=_('购物车为空')?>
    </div>
<?php endif;?>

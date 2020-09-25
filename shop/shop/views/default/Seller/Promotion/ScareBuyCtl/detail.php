<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<div class="content">
    <div class="form-style">
        <dl>
            <dt><i>*</i><?=_('惠抢购标题')?>：</dt>
            <dd><?=_($data['scarebuy_name'])?></dd>
        </dl>
        <dl>
            <dt><?=_('惠抢购副标题')?>：</dt>
            <dd><?=_($data['scarebuy_remark'])?></dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('惠抢购商品')?>：</dt>
            <dd>
                <div class="selected-goods fn-hide">
                    <div class="goods-image"><img src="<?=_($data['goods_image'])?>" /></div>
                    <div class="goods-name"><?=_($data['goods_name'])?></div>
                </div>
            </dd>
        </dl>
        <dl>
            <dt><?=_('店铺价格')?>：</dt>
            <dd><?=format_money($data['goods_price'])?></dd>
        </dl>
        <dl>
            <dt><?=_('分享优惠')?>：</dt>
            <dd><?=format_money($data['share_sum_price'])?></dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('惠抢购价格')?>：</dt>
            <dd><?=format_money($data['scarebuy_price'])?></dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('开始时间')?>：</dt>
            <dd><?=_($data['scarebuy_starttime'])?></dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('结束时间')?>：</dt>
            <dd><?=_($data['scarebuy_endtime'])?></dd>
        </dl>
        <dl>
            <dt><?=_('惠抢购类别')?>：</dt>
            <dd><?=_($data['scarebuy_cat_con'])?></dd>
        </dl>
        <dl>
            <dt><?=_('参加数量')?>：</dt>
            <dd><?=_($data['scarebuy_count'])?></dd>
        </dl>
        <?php if($this->selfSupportFlag){?>
            <dl>
                <dt><?=_('虚拟数量')?>：</dt>
                <dd><?=_($data['scarebuy_virtual_quantity'])?></dd>
            </dl>
        <?php } ?>
        <dl>
            <dt><?=_('限购数量')?>：</dt>
            <dd>
                <?=_($data['scarebuy_virtual_quantity'])?>
                <p class="bbc_color"><?=_('每个买家ID可惠抢购的最大数量，"0"为不限数量 ')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('是否叠加免邮')?>：</dt>
            <dd>
                <?php if($data['is_mian']){ echo '是';}else{echo '否';}?>
                <p class="bbc_color"><?=_('参加活动的商品是否享受免运费额度')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('是否叠加满减')?>：</dt>
            <dd>
                <?php if($data['is_man']){ echo '是';}else{echo '否';}?>
                <p class="bbc_color"><?=_('参加活动的商品是否享受代金券')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('是否叠加代金券')?>：</dt>
            <dd>
                <?php if($data['is_voucher']){ echo '是';}else{echo '否';}?>
                <p class="bbc_color"><?=_('参加活动的商品是否享受满减送')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('是否叠加加价购')?>：</dt>
            <dd>
                <?php if($data['is_jia']){ echo '是';}else{echo '否';}?>
                <p class="bbc_color"><?=_('参加活动的商品是否享受加价购')?></p>
            </dd>
        </dl>
    </div>
</div>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>


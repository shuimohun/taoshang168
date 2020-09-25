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
                <div class="shared-price"><?=_('分享优惠')?>：<span><?=format_money($goods['common_shared_price'])?></span></div>
                <div class="goods-btn">
                    <?php if($goods['is_monlater_state'] == 'true'){ ?>
                        <div class="button is_in">已加入该活动</div>
                    <?php }else{?>
                        <div data-type="btn_add_goods" class="button button_green" data-shared-price="<?=$goods['common_shared_price']?>" data-salenum="<?=@$goods['common_salenum']?>" data-goods-id="<?=$goods['id_goods']?>" data-common-id="<?=$goods['common_id']?>" data-common-name="<?=$goods['common_name']?>" data-common-img="<?=$goods['common_image']?>" data-common-price="<?=$goods['common_price']?>"  href="javascript:void(0);" class="ncbtn-mini"><i class="iconfont icon-jia"></i><?=_('选择商品')?></div>
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



<!--<div id="dialog_add_discount_goods" style="display:none;">-->
<!--    <input id="dialog_goods_id" type="hidden">-->
<!--    <input id="dialog_common_id" type="hidden">-->
<!--    <input id="dialog_input_goods_price" type="hidden">-->
<!--    <input id="dialog_input_goods_price_format" type="hidden">-->
<!--    <input id="dialog_input_shared_price" type="hidden">-->
<!--    <div class="eject_con">-->
<!--        <div id="dialog_add_discount_goods_error" class="alert alert-error">-->
<!--            <label for="dialog_xianshi_price" class="error" >-->
<!--                <i class='iconfont icon-exclamation-sign'></i>--><?//=_('折扣价格不能为空，且必须小于商品价格')?>
<!--            </label>-->
<!--        </div>-->
<!--        <div class="selected-goods-info">-->
<!--            <div class="goods-thumb"><img id="dialog_goods_img" src="" alt=""></div>-->
<!--            <dl class="goods-info">-->
<!--                <dt id="dialog_goods_name"></dt>-->
<!--                <dd>--><?//=_('销售价格')?><!--：--><?//=Web_ConfigModel::value('monetary_unit')?><!--<strong class="red"><font id="dialog_goods_price"></font></strong></dd>-->
<!--                <dd>--><?//=_('分享优惠')?><!--：--><?//=Web_ConfigModel::value('monetary_unit')?><!--<strong class="red"><font id="dialog_shared_price"></font></strong></dd>-->
<!--                <dd>--><?//=_('库存')?><!--：<span id="dialog_goods_storage"></span> --><?//=_('件')?><!--</dd>-->
<!--            </dl>-->
<!--        </div>-->
<!--        <dl>-->
<!--            <dt>--><?//=_('限时折扣价格')?><!--：</dt>-->
<!--            <dd>-->
<!--                <input id="dialog_discount_price" type="text" class="text w70"><em class="add-on"><i class="iconfont icon-iconyouhuiquan"></i></em>-->
<!--                <p class="hint red_font">--><?//=_('限时折扣价应低于正常商品售价，且大于分享优惠价，活动开始时，系统将自动转换销售价为促销价')?><!--。</p>-->
<!--            </dd>-->
<!--        </dl>-->
<!--        <div class="eject_con">-->
<!--            <div class="bottom">-->
<!--                <label class="submit-border error"><a id="btn_submit" class="submit bbc_seller_submit_btns" href="javascript:void(0);">--><?//=_('提交')?><!--</a></label>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<style>
    .form-style dl .share .share_d .share_s{text-align: center;background-position: center;}
</style>

<div class="content">
    <div class="alert">
        <h4>
            <?=_('活动说明：')?>
        </h4>
        <ul>
            <li><?=_('参加此活动的商品将被锁定,不允许修改')?></li>
        </ul>
    </div>
    <div class="form-style">
        <dl>
            <dt><i>*</i><?=_('送福免单标题')?>：</dt>
            <dd><?=_($data['fu_name'])?></dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('送福免单商品')?>：</dt>
            <dd>
                <div class="selected-goods fn-hide">
                    <div class="goods-image">
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goods_id']?>" target="_blank"><img src="<?=_($data['goods_image'])?>" /></a>
                    </div>
                    <div class="goods-name"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$data['goods_id']?>" target="_blank"><?=_($data['goods_name'])?></a></div>
                </div>
            </dd>
        </dl>
        <dl>
            <dt><?=_('商品价格')?>：</dt>
            <dd><?=format_money($data['goods_price'])?></dd>
        </dl>
        <dl class="fu_count">
            <dt><?=_('参加数量')?>：</dt>
            <dd>
                <?=_($data['fu_count'])?>
            </dd>
        </dl>
        <dl>
            <dt><?=_('销量')?>：</dt>
            <dd>
                <?=_($data['fu_count'] - $data['fu_stock'])?>
            </dd>
        </dl>
        <dl style="border: none;">
            <dt><i>*</i>社交类型：</dt>
            <dd>
                <div class="share">
                    <div  class="share_d">
                        <span class="share_s wx_single"></span>
                        <span class="share_s"><?=$data['fu_base']['weixin']?>次</span>
                    </div>
                    <div  class="share_d">
                        <span class="share_s wx_timeline"></span>
                        <span class="share_s"><?=$data['fu_base']['weixin_timeline']?>次</span>
                    </div>
                    <div  class="share_d">
                        <span class="share_s sqq"></span>
                        <span class="share_s"><?=$data['fu_base']['sqq']?>次</span>
                    </div>
                    <div  class="share_d">
                        <span class="share_s qzone"></span>
                        <span class="share_s"><?=$data['fu_base']['qzone']?>次</span>
                    </div>
                    <div  class="share_d">
                        <span class="share_s weibo"></span>
                        <span class="share_s"><?=$data['fu_base']['tsina']?>次</span>
                    </div>
                    <div class="clear"></div>
                </div>
                <p class="hint">消费者将商品分享到各社交平台可获得相应的送福减免额度，最终送福减免额度以消费者所分享平台设定数量决定</p>
            </dd>
        </dl>
        <dl style="border: none;">
            <dt></dt>
            <dd>
                <div>
                    <span>送福成功免单 <span class="bbc_color"><?=$data['fu_total_times']?></span> 次</span>
                    <span>送福邀请好友注册减 <span class="bbc_color"><?=$data['fu_price']?></span> 元</span>
                </div>
            </dd>
        </dl>
        <dl>
            <dt></dt>
            <dd>
                <div>
                    <span>送福邀请好友注册在活动时间内购买送福减 <span class="bbc_color"><?=$data['fu_t_price']?></span> 元</span>
                </div>
            </dd>
        </dl>
        <dl>
            <dt><?=_('是否注册会员点击')?>：</dt>
            <dd>
                <?php if($data['is_register']){ echo '是';}else{echo '否';}?>
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


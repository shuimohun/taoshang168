<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<?php if(!empty($data)){?>
    <link href="<?= $this->view->css?>/goods_bundling.css" rel="stylesheet"/>
<div class="ncs-goods-title-nav" nctype="gbc_nav">
    <ul>
        <?php if (!empty($data)) {?>
            <li class="current"><a href="javascript:void(0);">优惠套装</a></li>
        <?php $current = true;}?>
        <?php if (!empty($goods_detail['gcombo_list'])) {?>
            <li <?php if (!$current) {?>class="current"<?php }?>><a href="javascript:void(0);">推荐组合</a></li>
        <?php }?>
    </ul>
</div>
<div class="ncs-goods-info-content" nctype="gbc_content">
    <?php if (!empty($data)) {?>
        <div class="ncs-bundling-box">
            <!--S 组合销售 -->
            <div class="ncs-bundling-tab">
                <?php $i=0;foreach($data as $val){?>
                    <span <?php if ($i == 0) {?>class="selected"<?php }?> data-id="<?php echo $val['bundling_id'];?>">
                        <a href="javascript:void(0);"><?php echo $val['bundling_name'];?></a>
                    </span>
                <?php $i++;}?>
            </div>
            <div class="ncs-bundling-container">
                <?php $i=0;foreach($data as $val){?>
                    <?php  if(!empty($val['goods_list'])){?>
                        <div <?php if ($i != 0) {?>style="display: none;"<?php }?> data-id="<?php echo $val['bundling_id'];?>">
                            <ul class="ncs-bundling-list">
                                <?php ksort($val['goods_list']); foreach($val['goods_list'] as $v){?>
                                    <li>
                                        <div class="goods-thumb">
                                            <a href="index.php?ctl=Goods_Goods&met=goods&gid=<?php echo $v['goods_id']; ?>" target="_block">
                                                <img src="<?php echo $v['goods_image'];?>" title="<?php echo $v['goods_name'];?>" alt="<?php echo $v['goods_name'];?>"/>
                                            </a>
                                        </div>
                                        <dl>
                                            <dt title="<?php echo $v['goods_name'];?>">
                                                <a href="" target="block"><?php echo $v['goods_name'];?></a>
                                            </dt>
                                            <dd>原&nbsp;&nbsp;&nbsp;&nbsp;价：<em class="o-price"><?php echo $v['goods_price']?></em></dd>
                                            <dd>优惠价：<em class="b-price"><?php echo $v['bundling_goods_price']?></em></dd>
                                        </dl>
                                        <span class="plus"></span>
                                    </li>
                                <?php }?>
                            </ul>
                            <div class="ncs-bundling-price">
                                <ul>
                                    <li>已选套装：<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=bundling&bid=<?php echo $val['bundling_id'];?>" target="_blank"><strong><?php echo $val['bundling_name'];?></strong></a></li>
                                    <li>套装原价：<em><?php echo $val['old_total_price']?></em></li>
                                    <li>优惠价格：<em class="bundling-price"><?php echo $val['bundling_discount_price']?></em></li>
                                    <li>立刻节省：<em class="bundling-save" ><?php echo number_format($val['old_total_price'] - $val['bundling_discount_price'],2)?></em></li>
                                    <li class="">运&emsp;费：<span><?php echo $val['bundling_freight']?></span></li>
                                    <li class="mt10">
                                        <a href="javascript:void(0);"  nctype="addblcart_submit" bl_id="<?php echo $val['id']?>" class="ncbtn ncbtn-grapefruit ">
                                            <i class="iconfont icon-th-large"></i><?=_('购买套装')?>
                                        </a>
                                        <a href="javascript:void(0);" class="ncbtn ncbtn-grapefruit" nctype="share" data-type="1" data-id="<?php echo $val['id']?>" data-name="<?php echo $val['bundling_name'];?>" data-pic="<?=$val[goods_list][0]['goods_image'];?>" data-price="<?php echo $val['share_info']['share_total_price']?>"  bl_id="<?php echo $val['id']?>" data-shared='<?= json_encode($val['share_info']['price']['share_base'])?>' data-sqq="<?php echo $val['share_info']['sqq']?>" data-qzone="<?php echo $val['share_info']['qzone']?>" data-weixin="<?php echo $val['share_info']['weixin']?>" data-weixin_timeline="<?php echo $val['share_info']['weixin_timeline']?>" data-tsina="<?php echo $val['share_info']['tsina']?>" data-share-total-price="<?php echo $val['share_info']['share_total_price']?>" data-is-promotion="<?php echo $val['share_info']['is_promotion']?>" data-promotion-total-price="<?php echo $val['share_info']['promotion_total_price']?>">
                                            <i class="iconfont icon-share"></i><?=_('分享')?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php }?>
                <?php $i++;}?>
            </div>
            <!--E 组合销售 -->

            <script>
                $(function(){
                    $('span[data-id]').click(function(){
                        if(!$(this).hasClass('selected')){
                            $('span[data-id]').removeClass('selected');
                            $(this).addClass('selected');
                            $('div[data-id]').hide('slow');
                            $('div[data-id="' + $(this).attr('data-id') + '"]').show('slow');
                        }
                    });
                    $('a[nctype="addblcart_submit"]').click(function(){
                        addblcart($(this).attr('bl_id'));
                    });
                    $('a[nctype="share"]').click(function() {
                        if($(this).attr('bl_id')){
                            share($(this));
                        }
                    });
                });
            </script>
        </div>
    <?php }?>
</div>
<?php }?>

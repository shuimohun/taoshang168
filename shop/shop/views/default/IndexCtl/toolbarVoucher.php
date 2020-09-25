<?php if(!empty($v_t_row)){ ?>
    <!-- 可领取的券 -->
    <div class="voucher-type">
        <div class="clapboard">
            可领取的券
        </div>
    </div>
    <ul class="voucher-list">
        <?php foreach($v_t_row as $k=>$v){ ?>
            <li class="voucher-item">
                <div class="voucher-price">
                    <span class="money-sign">￥</span><?= $v['voucher_t_price']; ?>
                    <span class="voucher-name">代金券</span>
                </div>
                <div class="voucher-info">  <?= $v['voucher_t_title'];?>
                </div>

                <?php if($v['is_taken']){?>
                    <div class="recevied"></div>
                    <span class="voucher-limit"></span>
                    <a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=index&typ=e&id='.$v['shop_id']?>"class="receive" data-tid="<?=$v['voucher_t_id'] ?>">立即使用</a>
                <?php }else{?>
                    <?php if($v['voucher_t_giveout'] == $v['voucher_t_total']){ ?>
                        <div class="loot_all"></div>
                    <?php } ?>
                    <?php if($v['voucher_t_access_method']==3){ ?>
                        <span class="voucher-limit"></span>
                        <a href="javascript:void(0);"class="receive get" data-tid="<?=$v['voucher_t_id'] ?>">立即领取</a>
                    <?php }else if($v['voucher_t_access_method']==1){ ?>
                        <span class="voucher-limit">兑换需：<?= $v['voucher_t_points'];?> 金蛋</span>
                        <a href="javascript:void(0);" class="receive get" data-tid="<?=$v['voucher_t_id'] ?>">立即兑换</a>
                    <?php }?>
                    <div class="loot_all" style="display: none"></div>
                <?php }?>
                <p class="voucher-time">
                    <?=  date('Y-m-d',strtotime($v['voucher_t_start_date']));?>至<?= date('Y-m-d',strtotime($v['voucher_t_end_date'])) ; ?>
                </p>
            </li>
        <?php } ?>
    </ul>
<?php }else{ ?>
    <div class="voucher-type">
        <div class="clapboard">
            可领取的券
        </div>
    </div>
    <div style="margin: 20px auto;width: 55%"><p>老板小气，不给代金券</p></div>
<?php } ?>
<!-- 已领取的券 -->

<div class="voucher-type">
    <div class="clapboard">
        已领取的券
    </div>
</div>

<ul class="voucher-list">
    <?php if(!empty($v_row)){?>
        <?php foreach($v_row as $k=>$v){ ?>
            <li class="voucher-item">
                <?php if($v['voucher_end_date'] <  date("Y-m-d H:i:s",strtotime("+7 days"))){?>
                    <div class="will-overdue"></div>
                <?php } ?>
                <div class="voucher-price">
                    <span class="money-sign">￥</span><?= $v['voucher_price']; ?>
                    <span class="voucher-name">代金券</span>
                </div>
                <div class="voucher-info"> <?= $v['voucher_title'];?>
                </div>
                <div class="recevied"></div>
                <?php if( $v['voucher_t_points']){ ?>
                    <span class="voucher-limit">兑换需：<?= $v['voucher_t_points'];?> 金蛋</span>
                <?php }else{ ?>
                    <span class="voucher-limit"></span>
                <?php } ?>
                <a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=index&typ=e&id='.$v['voucher_shop_id']?>" class="receive" >立即使用</a>
                <p class="voucher-time">
                    <?=  date('Y-m-d',strtotime($v['voucher_start_date']));?>至<?= date('Y-m-d',strtotime($v['voucher_end_date'])) ; ?>
                </p>
            </li>
        <?php } ?>
    <?php }else{ ?>
        <div class="item_cons_no">
            <?=_('代金券为空')?>
        </div>
    <?php } ?>
</ul>
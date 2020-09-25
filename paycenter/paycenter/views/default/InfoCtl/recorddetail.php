<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<div class="wrap">
	<div class="fn-right">
        <div class="block fn-clear">
            <div class="i-block account_mes">
                <h4>记录详情</h4>
                <dl class="detail">
                    <dt><?php if($re['trade_type_id']==4){?>提现<?php }elseif($re['trade_type_id']==3){?>充值<?php }elseif($re['trade_type_id']==2){?>转账<?php }else{?>购物<?php }?></dt>
                    <?php if($re['trade_type_id']==4){?>
                        <?php foreach($data as $k=>$v){ ?>
                            <dd><span>交易号：</span><em><?=$v['orderid']?></em></dd>
                            <dd><span>交易金额：</span><em><?=format_money(($v['amount']+$v['fee']))?></em></dd>
                            <dd><span>付款时间：</span><em><?=$v['add_time']?></em></dd>
                            <dd><span>描述：</span><em><?=$v['con']?></em></dd>
                            <dd><span>提现银行：</span><em><?=$v['bank']?></em></dd>
                            <dd><span>银行卡号：</span><em><?=$v['cardno']?></em></dd>
                            <dd><span>开户人：</span><em><?=$v['cardname']?></em></dd>
                            <dd><span>提现金额：</span><em><?=format_money($v['amount'])?></em></dd>
                            <dd><span>服务费：</span><em><?=format_money($v['fee'])?></em></dd>
                            <dd><span>到账时间：</span><em><?=$v['time_con']?></em></dd>
                            <dd><span>银行流水号：</span><em><?=$v['bankflow']?></em></dd>
                            <dd><span>操作时间：</span><em><?=$v['check_time']?></em></dd>
                        <?php }?>
                    <?php }?>
                    <?php if($re['trade_type_id']!=4){?>
                        <dd><span>交易号：</span><em><?=$re['order_id']?></em></dd>
                        <dd><span>交易金额：</span><em><?=format_money($re['record_money'])?></em></dd>
                        <dd><span>付款时间：</span><em><?=$re['record_time']?></em></dd>
                        <dd><span>描述：</span><em><?=$re['record_title']?></em></dd>
                        <?php if(isset($snapshot)){?>
                            <dt>交易快照</dt>
                            <?php foreach($snapshot as $key=>$value){?>
                                <dd>
                                    <span class="goods_img">
                                        <a href="<?=YLB_Registry::get('shop_api_url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank">
                                            <img src="<?=image_thumb($value['goods_image'],30,30)?>" />
                                        </a>
                                    </span>
                                    <span class="goods_name">
                                        <a href="<?=YLB_Registry::get('shop_api_url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank">
                                            <?=$value['goods_name']?>
                                        </a>
                                        <p><?=implode(' ',$value['goods_spec'])?></p>
                                    </span>
                                    <span class="goods_price"><?=format_money($value['goods_price'])?></span>
                                </dd>
                            <?php }?>
                        <?php }?>
                    <?php }?>
                </dl>
            </div>
        </div>
    </div>
</div>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
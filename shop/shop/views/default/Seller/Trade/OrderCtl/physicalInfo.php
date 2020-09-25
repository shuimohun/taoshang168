<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<link href="<?= $this->view->css ?>/seller_center.css?ver=<?= VER ?>" rel="stylesheet">
<style>
    .ncsc-order-condition {
        width: 55%;
    }
</style>
</head>
<body>

<div id="mainContent">
    <div class="ncsc-oredr-show">
        <div class="ncsc-order-info">
            <div class="ncsc-order-details">
                <div class="title">订单信息</div>
                <div class="content ncsc-flow-item">
                    <dl>
                        <dt>收&nbsp;&nbsp;货&nbsp;&nbsp;人：</dt>
                        <dd><?= $data['receiver_info']; ?></dd>
                    </dl>
                    <dl>
                        <dt>支付方式：</dt>
                        <dd> <?= $data['payment_name']; ?> </dd>
                    </dl>
                    <dl>
                        <dt>发&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;票：</dt>
                        <dd>
                            <?= $data['order_invoice']; ?>
                            <?php if($data['invoice']){?>
                            <a href="javascript:void(0);">查看详细<i class="iconfont icon-iconjiantouxia"></i>
                                <div class="more"><span class="arrow"></span>
                                    <ul>
                                        <li><span>发票抬头</span><span><?= $data['invoice']['invoice_title']; ?></span></li>
                                        <li><span>纳税人识别号</span><span><?= $data['invoice']['invoice_code']; ?></span></li>
                                        <li><span>收票人姓名</span><span><?= $data['invoice']['invoice_rec_name']; ?></span></li>
                                        <li><span>收票人手机</span><span><?= $data['invoice']['invoice_rec_phone']; ?></span></li>
                                        <li><span>收票人邮箱</span><span><?= $data['invoice']['invoice_rec_email']; ?></span></li>
                                    </ul>
                                </div>
                            </a>
                            <?php }?>
                        </dd>
                    </dl>
                    <dl>
                        <dt>买家留言：</dt>
                        <dd><?= $data['order_message']; ?></dd>
                    </dl>
                    <dl class="line">
                        <dt>订单编号：</dt>
                        <dd>
                            <?= $data['order_id']; ?>
                            <a href="javascript:void(0);">更多<i class="iconfont icon-iconjiantouxia"></i>
                                <div class="more"><span class="arrow"></span>
                                    <ul>
                                        <li><span><?= $data['order_create_time']; ?></span>买家下单</li>
                                        <li><span><?= $data['order_create_time']; ?></span>买家 生成订单</li>
                                    </ul>
                                </div>
                            </a>
                        </dd>
                    </dl>
                </div>
            </div>
            <?php /*if($data['order_refund_status'] >= Order_StateModel::ORDER_REFUND_IN ): */?><!--
                <?php /*if($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_IN): */?>
                    <div class="ncsc-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i>订单状态：</dt>
                            <dd>退款中</dd>
                        </dl>
                        <ul class="order_state">等待商家处理中！</ul>
                    </div>
                <?php /*endif; */?>
                <?php /*if($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_END): */?>
                    <div class="ncsc-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i>订单状态：</dt>
                            <dd>退款完成</dd>
                        </dl>
                        <ul class="order_state">请买家等待查收！</ul>
                    </div>
                <?php /*endif; */?>
            <?php /*elseif($data['a']['goods_refund_status'] >= Order_StateModel::ORDER_GOODS_RETURN_IN): */?>
                <?php /*if($data['a']['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_IN): */?>
                    <div class="ncsc-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i>订单状态：</dt>
                            <dd>退货中</dd>
                        </dl>
                        <ul class="order_state">等待商家处理中！</ul>
                    </div>
                <?php /*endif; */?>
                <?php /*if($data['a']['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_END): */?>
                    <div class="ncsc-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i>订单状态：</dt>
                            <dd>退货完成</dd>
                        </dl>
                        <ul class="order_state">商家已收到退货！</ul>
                    </div>
                <?php /*endif; */?>
            <?php /*else: */?>
                <div class="ncsc-order-condition">
                    <dl>
                        <dt><i class="icon-ok-circle green"></i>订单状态：</dt>
                        <dd><?/*= $data['order_status_text']; */?></dd>
                    </dl>
                    <ul class="order_state"><?/*= $data['order_status_html']; */?></ul>
                </div>
            --><?php /*endif; */?>

            <div class="ncsc-order-condition">
                <dl>
                    <dt><i class="icon-ok-circle green"></i>订单状态：</dt>
                    <dd><?= $data['order_status_text']; ?></dd>
                </dl>
                <ul class="order_state"><?= $data['order_status_html']; ?></ul>
            </div>
        </div>

        <?php if ($data['order_status'] != Order_StateModel::ORDER_CANCEL){ ?>
            <div id="order-step" class="ncsc-order-step" style="text-align: center;">
                <dl class="step-first current">
                    <dt>提交订单</dt>
                    <dd class="bg"></dd>
                    <dd class="date" title="下单时间"><?= $data['order_create_time']; ?></dd>
                </dl>
                <?php if($data['payment_id'] != PaymentChannlModel::PAY_CONFIRM): ?>
                    <dl class="<?= $data['order_payed']; ?>">
                        <dt>支付订单</dt>
                        <dd class="bg"> </dd>
                        <dd class="date" title="付款时间"><?= $data['payment_time']; ?></dd>
                    </dl>
                <?php endif; ?>
                <dl class="<?= $data['order_wait_confirm_goods']; ?>">
                    <dt>商家发货</dt>
                    <dd class="bg"> </dd>
                    <dd class="date" title="发货时间"><?= $data['order_shipping_time']; ?></dd>
                </dl>
                <dl class="<?= $data['order_received']; ?>">
                    <dt>确认收货</dt>
                    <dd class="bg"> </dd>
                    <dd class="date" title="完成时间"><?= $data['order_finished_time']; ?></dd>
                </dl>
                <dl class="<?= $data['order_evaluate']; ?>">
                    <dt>评价</dt>
                    <dd class="bg"></dd>
                    <dd class="date" title="评价时间"><?= $data['order_buyer_evaluation_time']; ?></dd>
                </dl>

                <?php /*if($data['order_refund_status'] >= Order_StateModel::ORDER_REFUND_IN ): */?><!--
                    <dl class="current">
                        <dt><?/*=_('退款申请')*/?></dt>
                        <dd class="bg"> </dd>
                        <dd class="date" title="退款申请时间"><?/*=($data['return_add_time'])*/?></dd>
                    </dl>
                    <?php /*if($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_END ): */?>
                        <dl class="current">
                            <dt><?/*=_('退款完成')*/?></dt>
                            <dd class="bg"> </dd>
                            <dd class="date" title="退款完成时间"><?/*=($data['return_finish_time'])*/?></dd>
                        </dl>
                    <?php /*elseif($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_BACK ):*/?>
                        <dl class="current">
                            <dt><?/*=_('商家不同意')*/?></dt>
                            <dd class="bg"> </dd>
                            <dd class="date" title=""></dd>
                        </dl>
                    <?php /*elseif($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_PLAT ):*/?>
                        <dl class="current">
                            <dt><?/*=_('买家申诉中')*/?></dt>
                            <dd class="bg"> </dd>
                            <dd class="date" title=""></dd>
                        </dl>
                    <?php /*elseif($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_PLAT_UNPASS ):*/?>
                        <dl class="current">
                            <dt><?/*=_('买家申诉被驳回')*/?></dt>
                            <dd class="bg"> </dd>
                            <dd class="date" title=""></dd>
                        </dl>
                    <?php /*elseif($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_PLAT_PASS ):*/?>
                        <dl class="current">
                            <dt><?/*=_('买家申诉通过')*/?></dt>
                            <dd class="bg"> </dd>
                            <dd class="date" title=""></dd>
                        </dl>
                    <?php /*endif;*/?>
                <?php /*endif;*/?>
                <?php /*if($arr['goods_refund_status'] >= Order_StateModel::ORDER_GOODS_RETURN_IN ): */?>
                    <input type="hidden" name="order_id" value="<?php /*echo $data['order_id'];*/?>" id="order">
                    <br />
                    <dl class="step-first current">
                        <dt><?/*=_('退货申请')*/?></dt>
                        <dd class="bg"> </dd>
                    </dl>
                    <dl class="<?php /*if($arr['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_IN || $arr['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_END):*/?>current<?php /*endif; */?>">
                        <dt><?/*=_('退货中')*/?></dt>
                        <dd class="bg"> </dd>
                    </dl>
                    <dl class="<?php /*if($arr['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_END){*/?>current<?php /*} */?>">
                        <dt><?/*=_('退货完成')*/?></dt>
                        <dd class="bg"> </dd>
                    </dl>
                --><?php /*endif;*/?>
            </div>
        <?php } ?>

        <?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS ){ ?>
            <div class="prompt-01 prompt-02" id="showExpress" data-order="<?=($data['order_id'])?>" data-shipping="<?=($data['order_shipping_code'])?>" data-express="<?=($data['order_shipping_express_id'])?>"></div>
        <?php } ?>
        <div class="ncsc-order-contnet">
            <table class="ncsc-default-table order">
                <thead>
                <tr>
                    <th class="w10">&nbsp;</th>
                    <th colspan="2">商品</th>
                    <th class="w120">单价<!--(<?/*=Web_ConfigModel::value('monetary_unit')*/?>)--></th>
                    <th class="w60">数量</th>
                    <th class="w200"><strong>实付 * 佣金比 = 应付佣金(<?=Web_ConfigModel::value('monetary_unit')?>)</strong></th>
                    <th class="w100">优惠活动</th>
                    <th class="w100">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if ( !empty($data['goods_list']) ) { ?>
                    <?php foreach ( $data['goods_list'] as $key => $val ) { ?>
                        <tr class="bd-line">
                            <td>&nbsp;</td>
                            <td class="w50">
                                <div class="pic-thumb">
                                    <a target="_blank" href="<?= $val['goods_link']; ?>">
                                        <img src="<?= $val['goods_image']; ?>">
                                    </a>
                                </div>
                            </td>
                            <td class="tl">
                                <dl class="goods-name">
                                    <dt>
                                        <a target="_blank" href="<?= $val['goods_link']; ?>"><?= $val['goods_name']; ?></a>
                                        <a target="_blank" href="<?= $val['goods_link']; ?>" class="blue ml5">[交易快照]</a>
                                    </dt>
                                    <!--<dd><?/*= $val['spec_name']; */?></dd>-->
                                </dl>
                            </td>
                            <td><?= format_money($val['order_goods_payment_amount'])
                                ; ?><p class="green"></p></td>
                            <td><?= $val['order_goods_num']; ?></td>
                            <td class="commis bdl bdr"><?= $val['order_goods_commission']?></td>
                            <!-- S 合并TD -->
                            <?php if ( $key == 0 ) { ?>
                                <td class="bdl bdr" rowspan="<?= $data['goods_cat_num']; ?>"><?= $data['order_shop_benefit']?></td>
                                <td class="bdl bdr" rowspan="<?= $data['goods_cat_num']; ?>">
                                    <?= $data['order_status_const']; ?>
                                </td>

                            <?php } ?>
                            <!-- E 合并TD -->
                        </tr>
                    <?php } ?>
                <?php } ?>
                <!-- S 赠品列表 -->
                <!-- E 赠品列表 -->

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="20">
                        <dl class="freight">
                            <dd><?= $data['shipping_info']; ?></dd>
                        </dl>
                        <?php if($data['redpacket_code']){ ?>
                            <dl>
                                <dt></dt>
                                <dd><?=_('红包抵扣')?><?= format_money($data['order_rpt_price']); ?><?=_('，红包编码')?><?=$data['redpacket_code']?></dd>
                            </dl>
                        <?php } ?>
                        <dl class="sum">
                            <dt>订单金额：</dt>
                            <dd><em class="bbc_seller_color"><?= format_money($data['order_payment_amount']); ?></em></dd>
                            <?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_PAY){?>
                                <a onclick="edit_cost('<?=($data['order_id'])?>')">修改金额</a>
                            <?php }?>
                        </dl></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->view->js_com ?>/jquery.nicescroll.js"></script>
<script>
    $(function(){
        var order_id=$('#showExpress').data('order');
        var express_id = $('#showExpress').data('express');
        var shipping_code = $('#showExpress').data('shipping');
        $.post(BASE_URL + "/shop/api/logistic.php", {
            "order_id": order_id,
            "express_id": express_id,
            "shipping_code": shipping_code
        }, function(da) {
            if (da) {
                $('#showExpress').html(da);
                $(".prompt-01").niceScroll({
                    cursorcolor: "#666",
                    cursoropacitymax: 1,
                    touchbehavior: false,
                    cursorwidth: "3px",
                    cursorborder: "0",
                    cursorborderradius: "3px",
                    autohidemode: false,
                    nativeparentscrolling: true
                });
            }
        });
    });

    $('.tabmenu > ul').find('li:eq(8)').remove();
    $('.tabmenu > ul').find('li:lt(7)').remove();
    var href = window.location.href; ;
    $('.tabmenu > ul > li > a').attr('href',href);

    window.edit_cost = function (e){
        url = SITE_URL + "?ctl=Seller_Trade_Order&met=cost&typ=e&order_id="+e;
        $.dialog({
            title: '修改订单金额',
            content: 'url: ' + url ,
            height: 340,
            width: 580,
            lock: true,
            drag: false

        })
    };

    window.hide_logistic = function (order_id){
        $("#info_"+order_id).hide();
        $("#info_"+order_id).html("");
    };

</script>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>


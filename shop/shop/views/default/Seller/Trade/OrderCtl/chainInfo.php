<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<link href="<?= $this->view->css ?>/seller_center.css?ver=<?= VER ?>" rel="stylesheet">
<link href="<?= $this->view->css ?>/base.css?ver=<?= VER ?>" rel="stylesheet">
<link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css?ver=<?=VER?>" rel="stylesheet">
<script src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js" charset="utf-8"></script>
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
                <div class="content">
                    <dl>
                        <dt>收&nbsp;&nbsp;货&nbsp;&nbsp;人：</dt>
                        <dd><?= $data['receiver_info']; ?></dd>
                    </dl>
                    <dl>
                        <dt>支付方式：</dt>
                        <dd><?= $data['payment_name']; ?></dd>
                    </dl>
                    <dl>
                        <dt>买家留言：</dt>
                        <dd><?= $data['order_message']; ?></dd>
                    </dl>
                    <dl class="line">
                        <dt>订单编号：</dt>
                        <dd><?= $data['order_id']; ?><a href="javascript:void(0);">更多<i class="iconfont icon-iconjiantouxia"></i>
                                <div class="more"><span class="arrow"></span>
                                    <ul>
                                        <li><span><?= $data['order_create_time']; ?></span>买家下单</li>
                                        <li><span><?= $data['order_create_time']; ?></span>买家 生成订单</li>
                                    </ul>
                                </div>
                            </a></dd>
                    </dl>
                    <dl>
                        <dt></dt>
                        <dd></dd>
                    </dl>
                </div>
            </div>
            <div class="ncsc-order-condition">
                <dl>
                    <dt><i class="icon-ok-circle green"></i>订单状态：</dt>
                    <dd><?= $data['order_status_text']; ?></dd>
                </dl>
                <ul class="order_state"><?= $data['order_status_html']; ?></ul>
            </div>
        </div>
        <?php if ($data['order_status'] != Order_StateModel::ORDER_CANCEL) { ?>
            <div id="order-step" class="ncsc-order-step" style="text-align: center;">
                <dl class="step-first current">
                    <dt>提交订单</dt>
                    <dd class="bg"></dd>
                    <dd class="date" title="下单时间"><?= $data['order_create_time']; ?></dd>
                </dl>
                <dl class="<?= $data['order_received']; ?>">
                    <dt>门店自提</dt>
                    <dd class="bg"> </dd>
                    <dd class="date" title="完成时间"><?= $data['order_finished_time']; ?></dd>
                </dl>
                <dl class="<?= $data['order_evaluate']; ?>">
                    <dt>评价</dt>
                    <dd class="bg"></dd>
                    <dd class="date" title="评价时间"><?= $data['order_buyer_evaluation_time']; ?></dd>
                </dl>
            </div>
        <?php } ?>
        <div class="ncsc-order-contnet">
            <table class="ncsc-default-table order">
                <thead>
                <tr>
                    <th class="w10">&nbsp;</th>
                    <th colspan="2">商品</th>
                    <th class="w120">单价<!--(<?/*=Web_ConfigModel::value('monetary_unit')*/?>)--></th>
                    <th class="w60">数量</th>
                    <th class="w100">优惠活动</th>
                    <th class="w200"><strong>实付 * 佣金比 = 应付佣金(<?=Web_ConfigModel::value('monetary_unit')?>)</strong></th>
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
                            <td><?= format_money($val['goods_price'])
                                ; ?><p class="green"></p></td>
                            <td><?= $val['order_goods_num']; ?></td>
                            <td></td>
                            <td class="commis bdl bdr"></td>

                            <!-- S 合并TD -->
                            <?php if ( $key == 0 ) { ?>
                                <td class="bdl bdr" rowspan="<?= $data['goods_cat_num']; ?>"><?= $data['order_status_const']; ?></td>
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
                        <dl class="sum">
                            <dt>订单金额：</dt>
                            <dd><em class="bbc_seller_color"><?= format_money($data['order_payment_amount']); ?></em></dd>
                        </dl></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script type="text/javascript">

    </script>
</div>


<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

<script>
    $('.tabmenu > ul').find('li:lt(6)').remove();
//    $($('.tabmenu > ul')[0]).find('li:lt(6)').remove();
    var href = window.location.href; ;
    $('.tabmenu > ul > li > a').attr('href',href);
</script>
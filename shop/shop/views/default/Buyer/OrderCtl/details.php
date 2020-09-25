<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>

    </div>

    <div class="order_content">
        <div class="ncm-order-info">
            <div class="ncm-order-details">
                <div class="title"><?=_('订单信息')?></div>
                <div class="content">
                    <dl>
                        <dt><?=_('收货地址：')?></dt>
                        <dd><?=($data['order_receiver_name'])?> <?=($data['order_receiver_address'])?> <?=($data['order_receiver_contact'])?></dd>
                    </dl>
                    <dl class="line">
                        <dt><?=_('发票：')?></dt>
                        <dd><?=($data['order_invoice'])?></dd>
                    </dl>
                    <dl class="line">
                        <dt><?=_('买家留言：')?></dt>
                        <dd><?=($data['order_message'])?></dd>
                    </dl>
                    <dl class="line line2">
                        <dt><?=_('订单编号：')?></dt>
                        <dd><?=($data['order_id'])?><a class="ncbtn">更多<i class="iconfont icon-iconjiantouxia"></i>
                                <div class="more"><span class="arrow"></span>
                                    <ul>
                                        <li><?=_('支付时间：')?><span><?=($data['payment_time'])?></span> </li>
                                        <li><?=_('下单时间：')?><span><?=($data['order_create_time'])?></span></li>
                                    </ul>
                                </div>
                            </a></dd>
                        <dt><?=_('商　　家：')?></dt>
                        <dd><?=($data['shop_name'])?><a class="ncbtn">更多<i class="iconfont icon-iconjiantouxia"></i>
                                <div class="more"><span class="arrow"></span>
                                    <ul>
                                        <li><?=_('所在地区：')?><span><?=($data['order_seller_address'])?></span></li>
                                        <li><?=_('联系电话：')?><span><?=($data['order_seller_contact'])?></span></li>
                                    </ul>
                                </div>
                            </a></dd>

                        <dt><?=_('商家留言：')?></dt>
                        <dd><?=($data['order_seller_message'])?></dd>
                    </dl>
                </div>
            </div>

            <?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_PAY ):?>
                <div class="ncm-order-condition">
                    <dl>
                        <dt><i class="icon-ok-circle green"></i><?=_('订单状态：')?></dt>
                        <dd><?=_('订单已经提交，等待买家付款')?></dd>
                    </dl>
                    <ul>
                        <?php if($data['payment_id'] != PaymentChannlModel::PAY_CONFIRM ): ?>
                            <li><?=_('1. 您尚未对该订单进行支付，请')?><a href="<?= YLB_Registry::get('paycenter_api_url') ?>?ctl=Info&met=pay&uorder=<?=($data['payment_number'])?>" class="ncbtn-mini ncbtn-bittersweet bbc_btns"><i></i><?=_('支付订单')?></a><?=_('以确保商家及时发货。')?></li>
                            <li><?=_('2. 如果您不想购买此订单的商品，请选择 ')?><a onclick="cancelOrder('<?=$data['order_id']?>')" class="ncbtn-mini bbc_btns"><?=_('取消订单')?></a><?=_('操作。')?></li>
                            <li><?=_('3. 如果您未对该笔订单进行支付操作，系统将于')?><time><?=($data['cancel_time'])?></time><?=_('自动关闭该订单')?>。</li>
                        <?php else: ?>
                            <li><?=_('1. 如果您不想购买此订单的商品，请选择 ')?><a onclick="cancelOrder('<?=$data['order_id']?>')" class="ncbtn-mini bbc_btns"><?=_('取消订单')?></a><?=_('操作。')?></li>
                            <li><?=_('2. 如果您未对该笔订单进行支付操作，系统将于')?><time><?=($data['cancel_time'])?></time><?=_('自动关闭该订单')?>。</li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif;?>
            <?php if($data['order_status'] == Order_StateModel::ORDER_PAYED):?>
                <div class="ncm-order-condition">
                    <dl>
                        <dt><i class="icon-ok-circle green"></i><?=_('订单状态：')?></dt>
                        <dd><?=_('待发货')?></dd>
                    </dl>
                    <ul>
                        <li><?=_('1. 您已成功对订单进行支付。')?></li>
                        <li><?=_('2. 订单已提交商家进行备货发货准备。 ')?></li>
                        <li>
                            <?=_('3. 如果您想取消购买，请与商家沟通后对订单进行')?>
                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=add&oid=<?=($data['order_id'])?>" class="ncbtn-mini bbc_btns">
                                <?=_('申请退款')?>
                            </a>
                            <?=_('操作。')?>
                        </li>
                    </ul>
                </div>
            <?php endif;?>
            <?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS):?>
                <div class="ncm-order-condition">
                    <dl>
                        <dt><i class="icon-ok-circle green"></i><?=_('订单状态：')?></dt>
                        <dd><?=_('商家已发货')?></dd>
                    </dl>
                    <ul>
                        <li><?=_('1. 商品已发出。')?></li>
                        <li><?=_('2. 如果您已收到货，且对商品满意，您可以 ')?><a onclick="confirmOrder('<?=$data['order_id']?>')" class="ncbtn-mini bbc_btns"><?=_('确认收货')?></a><?=_('完成交易。 ')?></li>
                        <li>
                            <?=_('3. 系统将于')?>
                            <time><?=($data['order_receiver_date'])?></time>
                            <?=_('自动完成“确认收货”，完成交易。')?>
                        </li>
                    </ul>
                </div>
            <?php endif;?>
            <?php if($data['order_status'] == Order_StateModel::ORDER_FINISH):?>
                <div class="ncm-order-condition">
                    <dl>
                        <dt><i class="icon-ok-circle green"></i><?=_('订单状态：')?></dt>
                        <dd><?=_('已经收货')?></dd>
                    </dl>
                    <ul>
                        <li><?=_('1. 如果收到货后出现问题，您可以联系商家协商解决。')?></li>
                        <li><?=_('2. 如果商家没有履行应尽的承诺，您可以在交易完成后的')?><?=($data['complain_day'])?><?=_('天内进行“交易投诉”。 ')?></li>
                        <li><?=_('3. 交易已完成，你可以对购买的商品进行评价。')?></li>
                    </ul>
                </div>
            <?php endif;?>
            <?php if($data['order_status'] == Order_StateModel::ORDER_CANCEL ):?>
                <div class="ncm-order-condition">
                    <dl>
                        <dt><i class="icon-ok-circle green"></i><?=_('订单状态：')?></dt>
                        <dd><?=_('交易关闭')?></dd>
                    </dl>
                    <ul>
                        <li><?=($data['cancel_identity'])?><?=_('于')?><time><?=($data['order_cancel_date'])?></time><?=_('取消了订单（')?><?=($data['order_cancel_reason'])?><?=_('）')?></li>
                    </ul>
                </div>
            <?php endif;?>

            <?php /*if($arr['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_NO && $data['order_refund_status'] == Order_StateModel::ORDER_REFUND_NO):*/?><!--
                <?php /*if($data['order_status'] == Order_StateModel::ORDER_WAIT_PAY ):*/?>
                    <div class="ncm-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i><?/*=_('订单状态：')*/?></dt>
                            <dd><?/*=_('订单已经提交，等待买家付款')*/?></dd>
                        </dl>
                        <ul>
                            <?php /*if($data['payment_id'] != PaymentChannlModel::PAY_CONFIRM ): */?>
                                <li><?/*=_('1. 您尚未对该订单进行支付，请')*/?><a href="<?/*= YLB_Registry::get('paycenter_api_url') */?>?ctl=Info&met=pay&uorder=<?/*=($data['payment_number'])*/?>" class="ncbtn-mini ncbtn-bittersweet bbc_btns"><i></i><?/*=_('支付订单')*/?></a><?/*=_('以确保商家及时发货。')*/?></li>
                                <li><?/*=_('2. 如果您不想购买此订单的商品，请选择 ')*/?><a onclick="cancelOrder('<?/*=$data['order_id']*/?>')" class="ncbtn-mini bbc_btns"><?/*=_('取消订单')*/?></a><?/*=_('操作。')*/?></li>
                                <li><?/*=_('3. 如果您未对该笔订单进行支付操作，系统将于')*/?><time><?/*=($data['cancel_time'])*/?></time><?/*=_('自动关闭该订单')*/?>。</li>
                            <?php /*else: */?>
                                <li><?/*=_('1. 如果您不想购买此订单的商品，请选择 ')*/?><a onclick="cancelOrder('<?/*=$data['order_id']*/?>')" class="ncbtn-mini bbc_btns"><?/*=_('取消订单')*/?></a><?/*=_('操作。')*/?></li>
                                <li><?/*=_('2. 如果您未对该笔订单进行支付操作，系统将于')*/?><time><?/*=($data['cancel_time'])*/?></time><?/*=_('自动关闭该订单')*/?>。</li>
                            <?php /*endif; */?>
                        </ul>
                    </div>
                <?php /*endif;*/?>
                <?php /*if($data['order_status'] == Order_StateModel::ORDER_PAYED):*/?>
                    <div class="ncm-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i><?/*=_('订单状态：')*/?></dt>
                            <dd><?/*=_('待发货')*/?></dd>
                        </dl>
                        <ul>
                            <li><?/*=_('1. 您已成功对订单进行支付。')*/?></li>
                            <li><?/*=_('2. 订单已提交商家进行备货发货准备。 ')*/?></li>
                            <li>
                                <?/*=_('3. 如果您想取消购买，请与商家沟通后对订单进行')*/?>
                                <a href="<?/*= YLB_Registry::get('url') */?>?ctl=Buyer_Service_Return&met=index&act=add&oid=<?/*=($data['order_id'])*/?>" class="ncbtn-mini bbc_btns">
                                    <?/*=_('申请退款')*/?>
                                </a>
                                <?/*=_('操作。')*/?>
                            </li>
                        </ul>
                    </div>
                <?php /*endif;*/?>
                <?php /*if($data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS):*/?>
                    <div class="ncm-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i><?/*=_('订单状态：')*/?></dt>
                            <dd><?/*=_('商家已发货')*/?></dd>
                        </dl>
                        <ul>
                            <li><?/*=_('1. 商品已发出。')*/?></li>
                            <li><?/*=_('2. 如果您已收到货，且对商品满意，您可以 ')*/?><a onclick="confirmOrder('<?/*=$data['order_id']*/?>')" class="ncbtn-mini bbc_btns"><?/*=_('确认收货')*/?></a><?/*=_('完成交易。 ')*/?></li>
                            <li>
                                <?/*=_('3. 系统将于')*/?>
                                <time><?/*=($data['order_receiver_date'])*/?></time>
                                <?/*=_('自动完成“确认收货”，完成交易。')*/?>
                            </li>
                        </ul>
                    </div>
                <?php /*endif;*/?>
                <?php /*if($data['order_status'] == Order_StateModel::ORDER_FINISH):*/?>
                    <div class="ncm-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i><?/*=_('订单状态：')*/?></dt>
                            <dd><?/*=_('已经收货')*/?></dd>
                        </dl>
                        <ul>
                            <li><?/*=_('1. 如果收到货后出现问题，您可以联系商家协商解决。')*/?></li>
                            <li><?/*=_('2. 如果商家没有履行应尽的承诺，您可以在交易完成后的')*/?><?/*=($data['complain_day'])*/?><?/*=_('天内进行“交易投诉”。 ')*/?></li>
                            <li><?/*=_('3. 交易已完成，你可以对购买的商品进行评价。')*/?></li>
                        </ul>
                    </div>
                <?php /*endif;*/?>
                <?php /*if($data['order_status'] == Order_StateModel::ORDER_CANCEL ):*/?>
                    <div class="ncm-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i><?/*=_('订单状态：')*/?></dt>
                            <dd><?/*=_('交易关闭')*/?></dd>
                        </dl>
                        <ul>
                            <li><?/*=($data['cancel_identity'])*/?><?/*=_('于')*/?><time><?/*=($data['order_cancel_date'])*/?></time><?/*=_('取消了订单（')*/?><?/*=($data['order_cancel_reason'])*/?><?/*=_('）')*/?></li>
                        </ul>
                    </div>
                <?php /*endif;*/?>
            <?php /*else: */?>
                <?php /*if($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_IN ): */?>
                    <div class="ncm-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i><?/*=_('退款中：')*/?></dt>
                            <dd><?/*=_('等待商家处理中！')*/?></dd>
                        </dl>
                        <ul>
                            <li><a onclick="canOrder('<?/*=$data['order_id']*/?>')" class="ncbtn-mini ncbtn-bittersweet bbc_btns"><i ></i><?/*=_('取消退款')*/?></a></li>
                        </ul>
                    </div>
                <?php /*endif; */?>
                <?php /*if($data['order_return_status'] == Order_StateModel::ORDER_REFUND_END  ): */?>
                    <div class="ncm-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i><?/*=_('退款完成：')*/?></dt>
                            <dd><?/*=_('请买家等待查收！')*/?></dd>
                        </dl>
                        <ul>
                        </ul>
                    </div>
                <?php /*endif; */?>
                <?php /*if($arr['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_IN  ): */?>
                    <div class="ncm-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i><?/*=_('退货中：')*/?></dt>
                            <dd><?/*=_('等待商家处理中！')*/?></dd>
                        </dl>
                        <ul>
                        </ul>
                    </div>
                <?php /*endif; */?>
                <?php /*if($arr['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_END  ): */?>
                    <div class="ncm-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i><?/*=_('退货完成：')*/?></dt>
                            <dd><?/*=_('商家已收到退货！')*/?></dd>
                        </dl>
                        <ul>
                        </ul>
                    </div>
                <?php /*endif; */?>
                <?php /*if($data['order_return_status'] == Order_StateModel::ORDER_GOODS_RETURN_IN  ): */?>
                    <div class="ncm-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i><?/*=_('退货中：')*/?></dt>
                            <dd><?/*=_('订单已经提交，等待买家付款')*/?></dd>
                        </dl>
                        <ul>
                        </ul>
                    </div>
                <?php /*endif; */?>
                <?php /*if($data['order_return_status'] == Order_StateModel::ORDER_GOODS_RETURN_END  ): */?>
                    <div class="ncm-order-condition">
                        <dl>
                            <dt><i class="icon-ok-circle green"></i><?/*=_('退货完成：')*/?></dt>
                            <dd><?/*=_('订单已经提交，等待买家付款')*/?></dd>
                        </dl>
                        <ul>

                        </ul>
                    </div>
                <?php /*endif; */?>
            --><?php /*endif;*/?>
            <div class="mall-msg">有疑问可咨询<a href="javascript:void(0);"><i class="iconfont icon-kefu"></i>平台客服</a></div>
        </div>
        <div class="ncm-order-step">
            <?php if($data['order_status'] != Order_StateModel::ORDER_CANCEL):?>
                <dl class="step-first current">
                    <dt><?=_('生成订单')?></dt>
                    <dd class="bg"></dd>
                    <dd class="date" title="订单生成时间"><?=($data['order_create_time'])?></dd>
                </dl>
                <?php if($data['payment_id'] != PaymentChannlModel::PAY_CONFIRM ){ ?>
                    <dl class="<?php if($data['order_status'] == Order_StateModel::ORDER_PAYED || $data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS || $data['order_status'] == Order_StateModel::ORDER_FINISH ){ ?>current<?php }?>">
                        <dt><?=_('完成付款')?></dt>
                        <dd class="bg"> </dd>
                        <dd class="date" title="付款时间"><?=($data['payment_time'])?></dd>
                    </dl>
                <?php } ?>
                <?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS || $data['order_status'] == Order_StateModel::ORDER_FINISH):?>
                    <dl class="<?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS || $data['order_status'] == Order_StateModel::ORDER_FINISH):?>current<?php endif;?>">
                        <dt><?=_('商家发货')?></dt>
                        <dd class="bg"> </dd>
                        <dd class="date" title="商家发货"><?=($data['order_shipping_time'])?></dd>
                    </dl>
                <?php endif; ?>
                <dl class="<?php if($data['order_status'] == Order_StateModel::ORDER_FINISH ):?>current<?php endif;?>">
                    <dt><?=_('确认收货')?></dt>
                    <dd class="bg"> </dd>
                    <dd class="date" title="确认收货"><?=($data['order_finished_time'])?></dd>
                </dl>
                <dl class="long <?php if($data['order_status'] == Order_StateModel::ORDER_FINISH && $data['order_buyer_evaluation_status']):?>current<?php endif;?>">
                    <dt><?=_('评价')?></dt>
                    <dd class="bg"> </dd>
                    <dd class="date" title="订单完成"></dd>
                </dl>
            <?php endif;?>
            <?php /*if($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_END || $data['order_refund_status'] == Order_StateModel::ORDER_REFUND_IN ): */?><!--
                <input type="hidden" name="order_id" value="<?php /*echo $data['order_id'];*/?>" id="order">
                <br />
                <dl class="step-first current">
                    <dt><?/*=_('退款申请')*/?></dt>
                    <dd class="bg"> </dd>
                    <dd class="date" title="退款申请时间"><?/*=($data['return_add_time'])*/?></dd>
                </dl>
                <dl class="<?php /*if($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_IN || $data['order_refund_status'] == Order_StateModel::ORDER_REFUND_END):*/?>current<?php /*endif; */?>">
                    <dt><?/*=_('退款中')*/?></dt>
                    <dd class="bg"> </dd>
                    <dd class="date" title="退款申请时间"><?/*=($data['return_add_time'])*/?></dd>
                </dl>
                <dl class="<?php /*if($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_END){*/?>current<?php /*} */?>">
                    <dt><?/*=_('退款完成')*/?></dt>
                    <dd class="bg"> </dd>
                    <dd class="date" title="退款完成时间"><?/*=($data['return_finish_time'])*/?></dd>
                </dl>
            <?php /*endif;*/?>
            <?php /*if($arr['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_END || $arr['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_IN ): */?>
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
        <?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS ){ ?>
            <div class="prompt-01 prompt-02" id="showExpress" data-order="<?=($data['order_id'])?>" data-shipping="<?=($data['order_shipping_code'])?>" data-express="<?=($data['order_shipping_express_id'])?>"></div>
        <?php } ?>
        <table>
            <tbody class="tbpad">
            <tr class="order_tit">
                <th class="order_goods"><?=_('商品')?></th>
                <th class="widt1"><?=_('单价')?></th>
                <th class="widt2"><?=_('数量')?></th>
                <th class="widt4"><?=_('售后维权')?></th>
                <th class="widt5"><?=_('订单金额')?></th>
                <th class="widt6"><?=_('交易状态')?></th>
                <th class="widt7"><?=_('操作')?></th>
            </tr>
            </tbody>
            <tbody>
            <tr>
                <th class="tr_margin" style="height:16px;background:#fff;" colspan="8"></th>
            </tr>
            </tbody>

            <tbody class="tboy">
            <tr>
                <td colspan="4"  class="td_rborder">
                    <!--S  循环订单中的商品  -->
                    <table>
                        <?php foreach($data['goods_list'] as $ogkey=> $ogval):?>
                            <tr class="tr_con">
                                <td class="order_goods">
                                    <img src="<?=image_thumb($ogval['goods_image'],50,50)?>"/>
                                    <a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($ogval['goods_id'])?>"><?=($ogval['goods_name'])?></a>
                                    <div class="specification">
                                        <em><?=implode(' ',$ogval['order_spec_info']) ?></em>
                                    </div>
                                    <?php if($ogval['order_goods_benefit']){?><em class="td_sale bbc_btns small_details"><?=($ogval['order_goods_benefit'])?></em><?php }?>
                                </td>
                                <td class="td_color widt1"><?=format_money($ogval['goods_price'])?></td>
                                <td class="td_color widt2"><?=_('x')?> <?=($ogval['order_goods_num'])?></td>
                                <td class="td_color widt4">
                                    <?php if($data['order_status'] != Order_StateModel::ORDER_WAIT_PAY && $data['order_status'] != Order_StateModel::ORDER_PAYED  && $data['order_status'] != Order_StateModel::ORDER_CANCEL){?>
                                        <?php if($data['order_refund_status']== Order_StateModel::ORDER_REFUND_IN ):?>
                                            <a target="_blank" onclick="canOrders()"><?=_('退货')?></a>
                                        <?php elseif( $data['order_refund_status']== Order_StateModel::ORDER_REFUND_END): ?>
                                            <a target="_blank" onclick="canOrderz()"><?=_('退货')?></a>
                                        <?php else: ?>
                                            <?php if($ogval['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_NO ){?>
                                                <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=add&gid=<?=($ogval['order_goods_id'])?>"><?=_('退货')?></a>
                                            <?php }?>
                                        <?php endif; ?>
                                        <?php if($ogval['goods_refund_status'] != Order_StateModel::ORDER_GOODS_RETURN_NO ){?>
                                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=detail&oid=<?=$data['order_id']?>&ogid=<?=($ogval['order_goods_id'])?>"><?=_('退货进度')?></a>
                                        <?php }?>
                                    <?php }?>

                                    <p>
                                        <?php if(($data['order_status'] == Order_StateModel::ORDER_FINISH && $data['complain_status']) || $data['order_status'] != Order_StateModel::ORDER_CANCEL){?>
                                            <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Complain&met=index&act=add&gid=<?=($ogval['order_goods_id'])?>">
                                                <?=_('交易投诉')?>
                                            </a>
                                        <?php }?>
                                    </p>
                                    <?php if($data['order_status'] < Order_StateModel::ORDER_FINISH && $ogval['order_goods_source_ship']){ ?>
                                        <?php $arr = explode('-',$ogval['order_goods_source_ship']);?>
                                        <a style="position:relative;" onmouseover="show_logistic('<?=($ogval['order_goods_source_id'])?>','<?=($arr[1])?>','<?=($arr[0])?>')" onmouseout="hide_logistic('<?=($ogval['order_goods_source_id'])?>')">
                                            <i class="iconfont icon-icowaitproduct rel_top2"></i><?=_('跟踪')?>
                                            <div style="display: none;" id="info_<?=($ogval['order_goods_source_id'])?>" class="prompt-01"> </div>
                                        </a>
                                    <?php }?>

                                </td>

                            </tr>
                        <?php endforeach;?>
                    </table>
                    <!--E  循环订单中的商品   -->
                </td>

                <!--S  订单金额 -->
                <td class="td_rborder widt5">
				     <span class="fls">
				        <em class="type-name"><?=_('总额：')?></em><strong><?=format_money($data['order_goods_amount'])?></strong><!--<br/>--><?/*=($data['payment_name'])*/?>
				     </span>
                    <br/>
                    <span class="fls">
				       <em class="type-name"><?=_('运费：')?></em><?php if($data['order_shipping_fee'] > 0):?><?=format_money($data['order_shipping_fee'])?><?php else:?><?=_('免运费')?><?php endif;?>
				     </span>
                    <br/>
                    <span class="fls">
				        <em class="type-name"><?=_('应付：')?></em><strong><?=format_money($data['order_payment_amount'])?></strong>
				     </span>
                    <?php if($data['order_shop_benefit']){?><span class="td_sale bbc_btns"><?=($data['order_shop_benefit'])?></span><?php }?>
                </td>
                <!--E 订单金额 -->

                <td class="td_rborder">
                    <p class="getit"><?=($data['order_state_con'])?></p>
                    <?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_PAY  && $data['payment_id'] == PaymentChannlModel::PAY_CONFIRM ){?>
                        <p class="getit"><?=_('货到付款')?></p>
                    <?php }?>

                    <p>
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&act=details&order_id=<?=($data['order_id'])?>"><?=_('订单详情')?>
                        </a>
                    </p>

                    <!-- S 订单详情  -->
                    <!-- 订单退款状态：当订单不为取消状态和待付款状态时显示订单退款状态 -->
                    <?php if($data['order_status'] != Order_StateModel::ORDER_CANCEL && $data['order_status'] != Order_StateModel::ORDER_WAIT_PAY ){?>
                        <p>
                            <?php if($data['order_refund_status'] != Order_StateModel::ORDER_REFUND_NO ){?>
                                <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=detail&oid=<?=($data['order_id'])?>"><?=_('退款进度')?></a>
                            <?php }?>
                        </p>
                    <?php }?>
                    <!--E  订单详情  -->
                </td>


                <!--S 订单操作  -->
                <td class="td_rborder td_rborder_reset">
                    <?php if(($data['order_status'] == Order_StateModel::ORDER_CANCEL || $data['order_status'] == Order_StateModel::ORDER_FINISH) ):?>
                        <p>
                            <a onclick="hideOrder('<?=$data['order_id']?>')"><i class="iconfont icon-lajitong icon_size22"></i><?=_('删除订单')?></a>
                        </p>
                    <?php endif; ?>

                    <!--S  未付款订单 -->
                    <?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_PAY):?>
                        <p class="rest">
                            <span class="iconfont icon-shijian2"></span>
                            <span class="fnTimeCountDown" data-end="<?=$data['cancel_time']?>">
							    <span><?=_("剩余")?></span>
                                <span class="hour">00</span><span><?=_('时')?></span>
                                <span class="mini">00</span><span><?=_('分')?></span>
                            </span>
                        </p>

                        <?php if($data['payment_id'] != PaymentChannlModel::PAY_CONFIRM ): ?>
                            <p>
                                <a target="_blank" onclick="payOrder('<?=$data['payment_number']?>','<?=$data['order_id']?>')"  class="to_views "><i class="iconfont icon-icoaccountbalance pay-botton"></i><?=_('订单支付')?></a>
                            </p>
                        <?php endif; ?>
                        <p><a onclick="cancelOrder('<?=$data['order_id']?>')" class="to_views"><i class="iconfont icon-quxiaodingdan"></i><?=_('取消订单')?></a></p>
                    <?php endif; ?>
                    <!--E  未付款订单 -->
                    <?php if($arr['goods_refund_status']== Order_StateModel::ORDER_GOODS_RETURN_IN):?>
                        <p><a target="_blank"onclick="canOrderh()" class="to_views"><i class="iconfont icon-dingdanwancheng icon_size22"></i><?=_('申请退款')?></a></p>
                    <?php elseif($arr['goods_refund_status']== Order_StateModel::ORDER_GOODS_RETURN_END): ?>
                        <p><a target="_blank"onclick="canOrdert()" class="to_views"><i class="iconfont icon-dingdanwancheng icon_size22"></i><?=_('申请退款')?></a></p>
                    <?php else: ?>
                        <?php if($data['order_status'] != Order_StateModel::ORDER_WAIT_PAY && $data['order_status'] != Order_StateModel::ORDER_CANCEL){?>
                            <?php if($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_NO ){?>
                                <p><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=add&oid=<?=($data['order_id'])?>" class="to_views"><i class="iconfont icon-dingdanwancheng icon_size22"></i><?=_('申请退款')?></a></p>
                            <?php }?>
                        <?php }?>
                    <?php endif; ?>
                    <?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS ): ?>
                        <p class="rest">
                            <span class="iconfont icon-shijian2"></span>
                            <span class="fnTimeCountDown" data-end="<?=$data['order_receiver_date']?>">
							    <span><?=_("剩余")?></span>
                                <span class="day" >00</span><span><?=_('天')?></span>
                                <span class="hour">00</span><span><?=_('时')?></span>
                            </span>
                        </p>
                        <p><a onclick="confirmOrder('<?=$data['order_id']?>')" class="to_views "><i class="iconfont icon-duigou1"></i><?=_('确认收货')?></a></p>
                    <?php endif;?>

                    <?php if($data['order_status'] == Order_StateModel::ORDER_FINISH ): ?>
                        <?php if(!$data['order_buyer_evaluation_status']): ?>
                            <p> <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=evaluation&act=add&order_id=<?=($data['order_id'])?>" class="to_views"><i class="iconfont icon-woyaopingjia icon_size22"></i><?=_('我要评价')?></a></p>
                        <?php endif;?>
                        <?php if($data['order_buyer_evaluation_status']): ?>
                            <p><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=evaluation&act=add&order_id=<?=($data['order_id'])?>" class="to_views"><i class="iconfont icon-woyaopingjia icon_size22"></i><?=_('追加评价')?></a>
                        <?php endif;?></p>
                    <?php endif;?>

                </td>
                <!--E 订单操作   -->
            </tr>
            </tbody>

        </table>
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <script type="text/javascript" src="<?= $this->view->js_com ?>/jquery.nicescroll.js"></script>
    <script>

        $(function(){
            var order_id=$('#showExpress').data('order');
            var express_id = $('#showExpress').data('express');
            var shipping_code = $('#showExpress').data('shipping');
            $.post(BASE_URL + "/shop/api/logistic.php",{"order_id":order_id,"express_id":express_id,"shipping_code":shipping_code} ,function(da) {
                if(da){
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

        window.hide_logistic = function (order_id)
        {
            $("#info_"+order_id).hide();
            $("#info_"+order_id).html("");
        };
    </script>

<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
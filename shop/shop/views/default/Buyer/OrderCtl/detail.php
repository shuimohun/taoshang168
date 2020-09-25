<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>

</div>

<div class="order_content">
    <div class="ncm-order-info">
        <div class="ncm-order-details">
            <div class="title"><?=_('虚拟订单信息')?></div>
            <div class="content">
                <dl>
                    <dt><?=_('接收手机：')?></dt>
                    <dd><?=($data['order_receiver_contact'])?></dd>
                </dl>
                <dl class="line line2">
                    <dt><?=_('虚拟单号：')?></dt>
                    <dd><?=($data['order_id'])?>
                        <a href="#" class="ncbtn"><?=_('更多')?><i class="iconfont icon-iconjiantouxia"></i>
                            <div class="more" style="background: #fff; z-index: 99999;">
                                <span class="arrow"></span>
                                <ul >
                                    <li><?=_('支付时间：')?><span><?=($data['payment_time'])?></span> </li>
                                    <li><?=_('下单时间：')?><span><?=($data['order_create_time'])?></span></li>
                                </ul>
                            </div>
                        </a>
                    </dd>
                </dl>
                <dl class="line line2">
                <dt><?=_('买家留言：')?></dt>
                <dd><?=($data['order_message'])?></dd>
                </dl>
                <dl class="line line2">
                <dt><?=_('商　　家：')?></dt>
                <dd><?=($data['shop_name'])?><a href="#" class="ncbtn"><?=_('更多')?><i class="iconfont icon-iconjiantouxia"></i>
                <div class="more" style="background: #fff; z-index: 99999;"><span class="arrow"></span>
                <ul >
                <li><?=_('所在地区：')?><span><?=($data['order_seller_address'])?></span></li>
                <li><?=_('联系电话：')?><span><?=($data['shop_phone'])?></span></li>
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
        <dd><?=_('订单已经生成，待付款')?></dd>
        </dl>
        <ul>
        <li><?=_('1. 您尚未对该订单进行支付，请')?><a href="<?= YLB_Registry::get('paycenter_api_url') ?>?ctl=Info&met=pay&uorder=<?=($data['order_id'])?>" class="ncbtn-mini ncbtn-bittersweet bbc_btns"><i></i><?=_('支付订单')?></a><?=_('以确保及时获取电子兑换码。')?></li>
        <li><?=_('2. 如果您不想购买此订单，请选择 ')?><a onclick="cancelOrder('<?=$data['order_id']?>')" class="ncbtn-mini bbc_btns"><?=_('取消订单')?></a><?=_('操作。')?></li>
        <li><?=_('3. 系统将于')?><time><?=($data['cancel_time'])?></time><?=_('自动关闭该订单，请您及时付款。')?></li>
        </ul>
        </div>
        <?php endif;?>
        <?php if($data['order_status'] == Order_StateModel::ORDER_PAYED  ):?>
        <div class="ncm-order-condition">
        <dl>
        <dt><i class="icon-ok-circle green"></i><?=_('订单状态：')?></dt>
        <dd><?=_('已付款，电子兑换码未发放')?></dd>
        </dl>
        <ul>
        <li><?=_('1. 本次电子兑换码商家还未发出，请及时联系商家发送兑换码。')?></li>
        <li><?=_('2.如您想放弃本次交易，可申请退款。')?></li>
        </div>
        <?php endif;?>
        <?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS  || $data['order_status'] == Order_StateModel::ORDER_WAIT_PREPARE_GOODS ):?>
        <div class="ncm-order-condition">
        <dl>
        <dt><i class="icon-ok-circle green"></i><?=_('订单状态：')?></dt>
        <dd><?=_('已付款，电子兑换码已发放')?></dd>
        </dl>
        <ul>
        <li><?=_('1. 本次电子兑换码已由系统自动发出，请查看您的接收手机短信或该页下方“电子兑换码”。')?></li>
        <li><?=_('2. 您尚有')?><?=($data['new_code'])?><?=_('组电子兑换码未被使用；有效期为')?><time><?=($data['common_virtual_date'])?></time><?=_('，逾期自动失效，请及时使用。 ')?></li>
        </div>
        <?php endif;?>
        <?php if($data['order_status'] == Order_StateModel::ORDER_FINISH ):?>
        <div class="ncm-order-condition">
        <dl>
        <dt><i class="icon-ok-circle green"></i><?=_('订单状态：')?></dt>
        <dd><?=_('订单交易已完成')?></dd>
        </dl>
        <ul>
        <li><?=_('1. 如果出现问题，您可以联系商家协商解决。')?></li>
        <!--<li>2. 如果商家没有履行应尽的承诺，您可以进行“交易投诉”。 </li>-->
        <li><?=_('2. 交易已完成，你可以对购买的商品进行评价。')?></li>
        </ul>
        </div>
        <?php endif;?>
        <?php if($data['order_status'] == Order_StateModel::ORDER_CANCEL):?>
        <div class="ncm-order-condition">
        <dl>
        <dt><i class="icon-ok-circle green"></i><?=_('订单状态：')?></dt>
        <dd><?=_('交易关闭')?></dd>
        </dl>
        <ul>
        <li><?=($data['cancel_identity'])?>于<time><?=($data['order_cancel_date'])?></time><?=_('关闭交易，原因')?><?=($data['order_cancel_reason'])?></li>
        </ul>
        </div>
        <?php endif;?>
        <!--<div class="mall-msg">有疑问可咨询<a href="javascript:void(0);"><i class="iconfont icon-kefu"></i>平台客服</a></div>-->
    </div>
    <div class="ncm-order-step">
    <?php if($data['order_status'] != Order_StateModel::ORDER_CANCEL):?>
    <dl class="step-first current">
    <dt><?=_('生成订单')?></dt>
    <dd class="bg"></dd>
    <dd class="date" title="订单生成时间"><?=($data['order_create_time'])?></dd>
    </dl>
    <dl class="<?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_PREPARE_GOODS || $data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS || $data['order_status'] == Order_StateModel::ORDER_FINISH || $data['order_status'] == Order_StateModel::ORDER_PAYED ){?>current<?php }?>">
    <dt><?=_('完成付款')?></dt>
    <dd class="bg"> </dd>
    <dd class="date" title="付款时间"><?=($data['payment_time'])?></dd>
    </dl>
    <dl class="<?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS || $data['order_status'] == Order_StateModel::ORDER_FINISH){?>current<?php }?>">
    <dt><?=_('发放兑换码')?></dt>
    <dd class="bg" <?php if($data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS || $data['order_status'] == Order_StateModel::ORDER_FINISH){?>onmousemove="$('.dd_aciv').show()" <?php }?>> </dd>
    <dd class="date"><?=($data['order_shipping_time'])?></dd>
    <?php if(isset($data['code_list']) && $data['code_list']): ?>
    <dd class="dd_aciv" style="display: none;">
    <div style="float:right;cursor: pointer;" onclick="$(this).parent().hide()"><i class="iconfont icon-cuowu "></i></div>
    <h4> &nbsp;<?=_('电子兑换码')?></h4>
    <?php foreach($data['code_list']  as $codekey => $codeval):?>

    <p>
    <em class="vir_code" <?php if($codeval['virtual_code_status'] == Order_GoodsVirtualCodeModel::VIRTUAL_CODE_USED):?> class="cgreenl" <?php endif; ?>> &nbsp;<?=($codeval['virtual_code_id'])?></em>
    &nbsp;&nbsp;
    <em <?php if($codeval['virtual_code_status'] != Order_GoodsVirtualCodeModel::VIRTUAL_CODE_USED):?> class="cyellowl" <?php endif; ?>>
    <?php if($codeval['virtual_code_status'] == Order_GoodsVirtualCodeModel::VIRTUAL_CODE_NEW ):?>
    <?=_('未使用，有效期至')?><?=($codeval['common_virtual_date'])?>
    <!--S 判断该商品是否支持过期退款，若支持则在过期后出现退款按钮 -->
    <?php if($codeval['common_virtual_refund'] && get_date_time() > $codeval['common_virtual_date']){?>
    <a target="_blank" style="padding: 0 3px;margin-left: 230px;" class="bbc_btns" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=add&gid=<?=($data['goods_list'][0]['order_goods_id'])?>"><?=_('过期退款')?></a>
    <?php }?>
    <!--E 判断该商品是否支持过期退款，若支持则在过期后出现退款按钮 -->
    <?php else:?>
    <time><?=_('已使用，使用时间')?><?=($codeval['virtual_code_usetime'])?></time>
    <?php endif;?>
    </em>
    </p>

    <?php endforeach; ?>
    </dd>
    <?php endif; ?>
    </dl>
    <dl class="<?php if($data['order_status'] == Order_StateModel::ORDER_FINISH):?>current<?php endif;?>">
    <dt><?=_('订单完成')?></dt>
    <dd class="bg"> </dd>
    <dd class="date" title="订单完成"><?=($data['order_finished_time'])?></dd>
    </dl>
    <?php endif;?>
    </div>
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

    <?php if($ogval['order_goods_benefit']){?><em class="td_sale bbc_btns small_details"><?=($ogval['order_goods_benefit'])?></em><?php }?>
    </td>
    <td class="td_color widt1"><?=format_money($ogval['goods_price'])?></td>
    <td class="td_color widt2"><?=_('x')?> <?=($ogval['order_goods_num'])?></td>
    <td class="td_color widt4">
    <?php if($data['order_status'] != Order_StateModel::ORDER_WAIT_PAY && $data['order_status'] != Order_StateModel::ORDER_PAYED  && $data['order_status'] != Order_StateModel::ORDER_CANCEL){?>
    <?php if($ogval['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_NO ){?>
    <p><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=add&gid=<?=($ogval['order_goods_id'])?>"><?=_('退货')?></a></p>
    <?php }?>
    <?php if($ogval['goods_refund_status'] != Order_StateModel::ORDER_GOODS_RETURN_NO ){?>
    <p><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=detail&oid=<?=$data['order_id']?>&ogid=<?=($ogval['order_goods_id'])?>"><?=_('退货进度')?></a></p>
    <?php }?>
    <?php }?>

    </td>

    </tr>
    <?php endforeach;?>
    </table>
    <!--E  循环订单中的商品   -->
    </td>

    <!--S  订单金额 -->
    <td class="td_rborder widt5 pad0">
    <span class="fls">
    <em class="type-name"><?=_('总额：')?></em><strong><?=format_money($data['order_goods_amount'])?></strong><!--<br/>--><?/*=($data['payment_name'])*/?>
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
    <!--<span class="day" >00</span><strong><?/*=_('天')*/?></strong>-->
    <span class="hour">00</span><span><?=_('时')?></span>
    <span class="mini">00</span><span><?=_('分')?></span>
    <!--<span class="sec" >00</span><strong><?/*=_('秒')*/?></strong>-->
    </span>
    </p>
    <p>
    <a target="_blank" onclick="payOrder('<?=$data['payment_number']?>','<?=$data['order_id']?>')" class="to_views "><i class="iconfont icon-icoaccountbalance pay-botton"></i><?=_('订单支付')?></a>
    </p>
    <p> <a onclick="cancelOrder('<?=$data['order_id']?>')" class="to_views"><i class="iconfont icon-quxiaodingdan"></i><?=_('取消订单')?></a></p>
    <?php endif;?>
    <!--E  未付款订单 -->
    <?php if($data['order_status'] != Order_StateModel::ORDER_WAIT_PAY && $data['order_status'] != Order_StateModel::ORDER_CANCEL){?>
    <?php if($data['order_refund_status'] == Order_StateModel::ORDER_REFUND_NO ){?>
    <p><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=add&oid=<?=($data['order_id'])?>" class="to_views"><i class="iconfont icon-dingdanwancheng icon_size22"></i><?=_('申请退款')?></a></p>
    <?php }?>
    <?php }?>

    <?php if($data['order_status'] == Order_StateModel::ORDER_FINISH ): ?>
    <?php if(!$data['order_buyer_evaluation_status']): ?>
    <p> <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=evaluation&act=add&order_id=<?=($data['order_id'])?>" class="to_views"><i class="iconfont icon-woyaopingjia icon_size22"></i><?=_('我要评价')?></a></p>
    <?php endif;?>
    <?php if($data['order_buyer_evaluation_status']): ?>
    <p> <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=evaluation&act=add&order_id=<?=($data['order_id'])?>" class="to_views"><i class="iconfont icon-woyaopingjia icon_size22"></i><?=_('追加评价')?></a></p>
    <?php endif;?>
    <?php endif;?>

    </td>
    <!--E 订单操作   -->
    </tr>
    </tbody>






    </table>
    <div class="flip page clearfix">
    <p><!--<a href="#" class="page_first">首页</a><a href="#" class="page_prev">上一页</a><a href="#" class="numla cred">1</a><a href="#" class="page_next">下一页</a><a href="#" class="page_last">末页</a>--></p>
    </div>
</div>


</div>
</div>
</div>
</div>
</div>
</div>
  
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
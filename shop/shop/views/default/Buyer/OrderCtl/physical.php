<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
    <style>
        .logistic_css{line-height:25px;text-align:left;}
        div.zoomDiv{z-index:999;position:absolute;top:0px;left:0px;width:200px;height:200px;background:#ffffff;border:1px solid #CCCCCC;display:none;text-align:center;overflow:hidden;}
        div.zoomMask{position:absolute;background:url("<?=$this->view->img?>/mask.png") repeat scroll 0 0 transparent;cursor:move;z-index:1;}
    </style>
</div>
    <div class="order_content">
        <div class="order_content_title clearfix">
            <form method="get" id="search_form" action="index.php" >
                <input type="hidden" name="ctl" value="<?=$_GET['ctl']?>">
                <input type="hidden" name="met" value="<?=$_GET['met']?>">
                <p class="order_types">
                    <a <?php if($status == '' &&  !$recycle):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical"><?=_('全部订单')?></a>
                    <a <?php if($status == 'wait_pay'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&status=wait_pay"><?=_('待付款')?></a>
                    <a <?php if($status == 'order_payed'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&status=order_payed"><?=_('待发货')?></a>
                    <a <?php if($status == 'wait_confirm_goods'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&status=wait_confirm_goods"><?=_('待收货')?></a>
                    <a <?php if($status == 'finish'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&status=finish"><?=_('待评价')?></a>
                </p>
                <p class="order_time">
                    <span><?=_('下单时间')?></span>
                    <input type="text" autocomplete="off" placeholder="开始时间" name="start_date" id="start_date" class="text w70" value="<?=@$_GET['start_date']?>">
                    <label class="add-on"><i class="iconfont icon-rili"></i></label>
                    <em style="margin-top: 3px;">&nbsp;– &nbsp;</em>
                    <input type="text" placeholder="结束时间" autocomplete="off" name="end_date" id="end_date" class="text w70" value="<?=@$_GET['end_date']?>">
                    <label class="add-on"><i class="iconfont icon-rili"></i></label>
                </p>
                <p class="ser_p" style="margin-left: 10px;">
                    <input type="text" name="orderkey" placeholder="<?=_('订单号')?>" value="<?=@$_GET['orderkey']?>">
                    <a class="btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-icosearch icon_size18"></i><?=_('搜索')?></a>
                </p>
                <p class="order_types serc_p">
                    <a <?php if($recycle):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&recycle=1"><i class="iconfont icon-lajitong icon_size20"></i><?=_('订单回收站')?></a>
                </p>
                <script type="text/javascript">
                    $("a.btn_search_goods").on("click",function(){
                        $("#search_form").submit();
                    });
                </script>
            </form>
        </div>
        <table>
            <tbody class="tbpad">
                <tr class="order_tit">
                    <th class="order_goods"><?=_('商品')?></th>
                    <th class="widt1"><?=_('单价')?></th>
                    <th class="widt1"><?=_('分享立减')?></th>
                    <th class="widt2"><?=_('数量')?></th>
                    <th class="widt4"><?=_('售后维权')?></th>
                    <th class="widt5"><?=_('订单金额')?></th>
                    <th class="widt6"><?=_('交易状态')?></th>
                    <th class="widt7"><?=_('操作')?></th>
                </tr>
            </tbody>

            <?php if($data['items']){?>
                <?php foreach($data['items'] as $key => $value){ $split_order = array();?>
                    <tbody>
                        <tr>
                            <th class="tr_margin" style="height:16px;background:#fff;" colspan="8"></th>
                        </tr>
                    </tbody>
                    <?php if($value['split_order']){ $split_order = $value['split_order']; ?>
                        <tbody class="tboy">
                            <tr class="tr_title">
                                <th colspan="8" class="order_mess clearfix">
                                    <p class="order_mess_one">
                                        <time><?=($value['order_create_time'])?></time>
                                        <span><?=_('订单号：')?><strong><?=($value['order_id'])?></strong></span>

                                        <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&id=<?=($value['shop_id'])?>">
                                            <i class="iconfont icon-icoshop"></i><?=($value['shop_name'])?>
                                        </a>
                                        <?php if($value['order_status'] == Order_StateModel::ORDER_WAIT_PAY || $value['order_status'] == Order_StateModel::ORDER_CANCEL){ ?>
                                            <?php if($value['service']['pre']){?>
                                                <b c_name="<?=$value['service']['pre'][0]['name']?>" member_id="9"><?=$value['service']['pre'][0]['tool']?></b>
                                            <?php }else{ ?>
                                                <a href="javascript:;" class="chat-enter" data="1" rel="<?=$value['seller_user_id']?>"><img src="<?=$this->view->img?>/icon-im.gif" alt=""></a>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <?php if(!empty($value['service']['after'])){?>
                                                <b c_name="<?=$value['service']['after'][0]['name']?>" member_id="9"><?=$value['service']['after'][0]['tool']?></b>
                                            <?php }else{ ?>
                                                <a href="javascript:;" class="chat-enter" data="1" rel="<?=$value['seller_user_id']?>"><img src="<?=$this->view->img?>/icon-im.gif" alt=""></a>
                                            <?php }?>
                                        <?php } ?>
                                    </p>
                                </th>
                            </tr>
                            <tr class="tr_title">
                                <th colspan="8" class="order_mess clearfix">
                                    <p class="order_mess_one">
                                        <time><?=_('应付：')?><?=format_money($value['order_payment_amount'])?></time>
                                        <span><?=_('含运费：')?><?=format_money($value['order_shipping_fee'])?></span>
                                        <span>您订单中的商品在不同库房，故拆分为以下订单分开配送，给您带来的不便敬请谅解。</span>
                                    </p>
                                </th>
                            </tr>
                        </tbody>
                    <?php }else{ $split_order[] = $value;} ?>

                    <?php foreach($split_order as $k => $val){?>
                        <tbody class="tboy">
                        <tr <?php if(!$value['split_order']){echo 'class="tr_title"';}?>>
                            <th colspan="8" class="order_mess clearfix">
                                <p class="order_mess_one">
                                    <time><?=($val['order_create_time'])?></time>
                                    <span><?=_('订单号：')?><strong><?=($val['order_id'])?></strong></span>
                                    <?php if(!$value['split_order']){?>
                                        <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&id=<?=($val['shop_id'])?>">
                                            <i class="iconfont icon-icoshop"></i><?=($val['shop_name'])?>
                                        </a>
                                        <?php if($val['order_status'] == Order_StateModel::ORDER_WAIT_PAY || $val['order_status'] == Order_StateModel::ORDER_CANCEL){ ?>
                                            <?php if($val['service']['pre']){?>
                                                <b c_name="<?=$val['service']['pre'][0]['name']?>" member_id="9"><?=$val['service']['pre'][0]['tool']?></b>
                                            <?php }else{ ?>
                                                <a href="javascript:;" class="chat-enter" data="1" rel="<?=$val['seller_user_id']?>"><img src="<?=$this->view->img?>/icon-im.gif" alt=""></a>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <?php if(!empty($val['service']['after'])){?>
                                                <b c_name="<?=$val['service']['after'][0]['name']?>" member_id="9"><?=$val['service']['after'][0]['tool']?></b>
                                            <?php }else{ ?>
                                                <a href="javascript:;" class="chat-enter" data="1" rel="<?=$val['seller_user_id']?>"><img src="<?=$this->view->img?>/icon-im.gif" alt=""></a>
                                            <?php }?>
                                        <?php } ?>
                                    <?php } ?>
                                </p>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="5"  class="td_rborder">
                                <!--S  循环订单中的商品  -->
                                <table>
                                    <?php foreach($val['goods_list'] as $ogkey=> $ogval):?>
                                        <tr class="tr_con">
                                            <td class="order_goods">
                                                <img src="<?=image_thumb($ogval['goods_image'],50,50)?>"/>
                                                <a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($ogval['goods_id'])?>"><?=($ogval['goods_name'])?></a>
                                                <?php if($ogval['order_goods_benefit']){?>
                                                    <em class="td_sale bbc_btns small_details"> <?=($ogval['order_goods_benefit'])?></em>
                                                <?php }?>
                                                <?php if(isset($ogval['order_spec_info']) && $ogval['order_spec_info']){ ?>
                                                    <div class="specification">
                                                        <strong>规格：</strong><em><?=$ogval['order_spec_info']; ?></em>
                                                    </div>
                                                <?php } ?>
                                                <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=snapshot&order_id=<?=$ogval['order_id']?>&goods_id=<?=$ogval['goods_id']?>" target="_blank">
                                                    [交易快照]
                                                </a>
                                            </td>
                                            <td class="td_color widt1">
                                                <?=format_money($ogval['order_goods_payment_amount'])?>
                                            </td>
                                            <td class="td_color widt1">
                                                <?php if(!$ogval['bundling_id'] && $ogval['share_price']){?>
                                                    <?=format_money($ogval['share_price'])?>
                                                <?php }?>
                                            </td>
                                            <td class="td_color widt2"><i class="iconfont icon-cuowu" style="position:relative;font-size: 12px;"></i> <?=($ogval['order_goods_num'])?></td>
                                            <td class="td_color widt4">
                                                <?php if($val['order_status'] == Order_StateModel::ORDER_FINISH && $val['order_type'] != Order_BaseModel::ORDER_SP && $ogval['order_goods_payment_amount'] > 0){?>
                                                    <?php if($ogval['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_IN ){?>
                                                        <span class="bbc_color"><?=_('退货中')?></span>
                                                    <?php }else if($ogval['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_END ){?>
                                                        <?=_('退货完成')?>
                                                    <?php }?>
                                                    <br>
                                                    <?php if($val['order_refund_status']== Order_StateModel::ORDER_REFUND_IN ):?>
                                                        <a target="_blank" onclick="canOrders()"><?=_('退货')?></a>
                                                    <?php elseif( $val['order_refund_status']== Order_StateModel::ORDER_REFUND_END): ?>
                                                        <a target="_blank" onclick="canOrderz()"><?=_('退货')?></a>
                                                    <?php else: ?>
                                                        <?php if($ogval['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_NO){?>
                                                            <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=add&gid=<?=($ogval['order_goods_id'])?>"><?=_('退货')?></a>
                                                        <?php }?>
                                                        <?php if($ogval['goods_refund_status'] != Order_StateModel::ORDER_GOODS_RETURN_NO ){?>
                                                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=detail&oid=<?=($val['order_id'])?>&ogid=<?=($ogval['order_goods_id'])?>"><?=_('退货进度')?></a>
                                                        <?php }?>
                                                    <?php endif; ?>
                                                <?php }?>
                                                <p>
                                                    <?php if(($val['order_status'] == Order_StateModel::ORDER_FINISH && $val['complain_status']) || ($val['order_status'] != Order_StateModel::ORDER_CANCEL && $val['order_status'] != Order_StateModel::ORDER_WAIT_PAY)){?>
                                                        <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Complain&met=index&act=add&gid=<?=($ogval['order_goods_id'])?>">
                                                            <?=_('交易投诉')?>
                                                        </a>
                                                    <?php }?>
                                                </p>
                                                <?php if(!empty($ogval['order_goods_source_ship'])){ $arr = explode('-',$ogval['order_goods_source_ship']);} ?>
                                                <?php if($ogval['order_goods_source_id'] && $ogval['order_goods_source_ship']){ ?>
                                                    <a style="position:relative;" onmouseover="show_logistic('<?=($ogval['order_goods_source_id'])?>','<?=($arr[1])?>','<?=($arr[0])?>')" onmouseout="hide_logistic('<?=($ogval['order_goods_source_id'])?>')">
                                                        <i class="iconfont icon-icowaitproduct rel_top2"></i><?=_('跟踪')?>
                                                        <div style="display: none;" id="info_<?=($ogval['order_goods_source_id'])?>" class="prompt-01"> </div>
                                                    </a>
                                                <?php }elseif($ogval['order_goods_source_id'] == '' && $ogval['order_goods_source_ship']){?>
                                                    <a style="position:relative;" onmouseover="show_logistic('<?=($ogval['order_id'])?>','<?=($arr[1])?>','<?=($arr[0])?>')" onmouseout="hide_logistic('<?=($ogval['order_id'])?>')">
                                                        <i class="iconfont icon-icowaitproduct rel_top2"></i><?=_('跟踪')?>
                                                        <div style="display: none;" id="info_<?=($ogval['order_id'])?>" class="prompt-01"> </div>
                                                    </a>
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
                                    <em class="type-name"><?=_('应付：')?></em>
                                    <strong><?=format_money($val['order_payment_amount'])?></strong>
                                </span>
                                <span class="fls">
                                    <em class="type-name"><?=_('含运费：')?></em>
                                    <strong>
                                        <?=format_money($val['order_shipping_fee'])?>
                                    </strong>
                                </span>
                                <?php if($val['order_shop_benefit'] && !$value['split_order']){?>
                                    <span class="td_sale bbc_btns"><?=($val['order_shop_benefit'])?></span>
                                <?php }?>
                            </td>
                            <!--E 订单金额 -->
                            <td class="td_rborder">

                                <!-- S 订单状态  -->
                                <?php if($val['order_refund_status']== Order_StateModel::ORDER_REFUND_IN):?>
                                    <p class="getit  <?php if($val['order_refund_status']== Order_StateModel::ORDER_REFUND_IN){?>bbc_color<?php }?>"><?=($val['order_refund_status_con'])?></p>
                                <?php elseif($val['order_refund_status']== Order_StateModel::ORDER_REFUND_END): ?>
                                    <p class="getit  <?php if($val['order_refund_status']== Order_StateModel::ORDER_REFUND_END){?>bbc_color<?php }?>"><?=($val['order_refund_status_con'])?></p>
                                <?php else: ?>
                                    <p class="getit <?php if($val['order_status'] == Order_StateModel::ORDER_WAIT_PAY ){?>bbc_color<?php }?>"><?=($val['order_state_con'])?></p>
                                <?php endif; ?>
                                <?php if($val['order_status'] == Order_StateModel::ORDER_WAIT_PREPARE_GOODS  && $val['payment_id'] == PaymentChannlModel::PAY_CONFIRM ){?>
                                    <p class="getit bbc_color"><?=_('货到付款')?></p>
                                <?php }?>
                                <!-- E 订单状态  -->

                                <!-- 订单退款状态：当订单不为取消状态和待付款状态时显示订单退款状态 -->
                                <?php if($val['order_refund_status'] != Order_StateModel::ORDER_REFUND_NO && $val['order_status'] != Order_StateModel::ORDER_CANCEL && $val['order_status'] != Order_StateModel::ORDER_WAIT_PAY ){?>
                                    <p><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=detail&oid=<?=($val['order_id'])?>"><?=_('退款进度')?></a></p>
                                <?php }?>

                                <!-- 如果是待收货的订单就显示物流信息 -->
                                <?php if($val['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS ){ ?>
                                    <a style="position:relative;" onmouseover="show_logistic('<?=($val['order_id'])?>','<?=($val['order_shipping_express_id'])?>','<?=($val['order_shipping_code'])?>')" onmouseout="hide_logistic('<?=($val['order_id'])?>')">
                                        <i class="iconfont icon-icowaitproduct rel_top2"></i><?=_('跟踪')?>
                                        <div style="display: none;" id="info_<?=($val['order_id'])?>" class="prompt-01"> </div>
                                    </a>
                                <?php }?>

                                <!-- S 订单详情  -->
                                <p><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&act=details&order_id=<?=($val['order_id'])?>"><?=_('订单详情')?></a></p>
                                <!--E  订单详情  -->

                            </td>
                            <!--S 订单操作  -->
                            <td class="td_rborder td_rborder_reset">
                                <?php if($val['order_type'] != Order_BaseModel::ORDER_SP){?>
                                    <?php if(($val['order_status'] == Order_StateModel::ORDER_CANCEL || $val['order_status'] == Order_StateModel::ORDER_FINISH) && $recycle != 1):?>
                                        <p><a onclick="hideOrder('<?=$val['order_id']?>')"><i class="iconfont icon-lajitong icon_size22"></i><?=_('删除订单')?></a></p>
                                    <?php endif; ?>

                                    <!--S  未付款订单 -->
                                    <?php if($val['order_status'] == Order_StateModel::ORDER_WAIT_PAY):?>
                                        <p class="rest">
                                            <span class="iconfont icon-shijian2"></span>
                                            <span class="fnTimeCountDown" data-end="<?=$val['cancel_time']?>">
                                                <span><?=_("剩余")?></span>
                                                <span class="hour">00</span><span><?=_('时')?></span>
                                                <span class="mini">00</span><span><?=_('分')?></span>
                                            </span>
                                        </p>
                                        <?php if($val['payment_id'] != PaymentChannlModel::PAY_CONFIRM): ?>
                                            <p>
                                                <a target="_blank" onclick="payOrder('<?=$val['payment_number']?>','<?=$val['order_id']?>')" class="to_views "><i class="iconfont icon-icoaccountbalance pay-botton" ></i><?=_('订单支付')?></a>
                                            </p>
                                        <?php endif; ?>
                                        <?php if(!Perm::$shopId || Perm::$shopId != $val['shop_id']){?>
                                            <p><a onclick="cancelOrder('<?=$val['order_id']?>')" class="to_views"><i class="iconfont icon-quxiaodingdan"></i><?=_('取消订单')?></a></p>
                                        <?php }?>
                                    <?php endif;?>
                                    <!--E  未付款订单 -->

                                    <!--S  退款 -->
                                    <?php if($val['order_refund_status'] == Order_StateModel::ORDER_REFUND_NO && $val['order_payment_amount'] > 0 ){?>
                                        <?php if($val['payment_id'] == PaymentChannlModel::PAY_ONLINE){?>
                                            <?php if($val['order_status'] != Order_StateModel::ORDER_WAIT_PAY && $val['order_status'] != Order_StateModel::ORDER_CANCEL){?>
                                                <p><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=add&oid=<?=($val['order_id'])?>" class="to_views"><i class="iconfont icon-dingdanwancheng icon_size22"></i><?=_('申请退款')?></a></p>
                                            <?php }?>
                                        <?php }else if($val['payment_id'] == PaymentChannlModel::PAY_CONFIRM){ ?>
                                            <?php if( $val['order_status'] == Order_StateModel::ORDER_RECEIVED || $val['order_status'] == Order_StateModel::ORDER_FINISH ){?>
                                                <p><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=add&oid=<?=($val['order_id'])?>" class="to_views"><i class="iconfont icon-dingdanwancheng icon_size22"></i><?=_('申请退款')?></a></p>
                                            <?php }?>
                                        <?php }?>
                                    <?php }?>
                                    <!--E  退款 -->

                                    <?php if($val['order_refund_status'] !== Order_StateModel::ORDER_REFUND_IN && $val['order_return_status'] !== Order_StateModel::ORDER_GOODS_RETURN_IN  &&  $val['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS ): ?>
                                        <p class="rest">
                                            <span class="iconfont icon-shijian2"></span>
                                            <span class="fnTimeCountDown" data-end="<?=$val['order_receiver_date']?>">
                                                <span><?=_("剩余")?></span>
                                                <span class="day" >00</span><span><?=_('天')?></span>
                                                <span class="hour">00</span><span><?=_('时')?></span>
                                            </span>
                                        </p>
                                        <p><a onclick="confirmOrder('<?=$val['order_id']?>')" class="to_views "><i class="iconfont icon-duigou1 icon_size22"></i><?=_('确认收货')?></a></p>
                                    <?php endif;?>

                                    <?php if($val['order_status'] == Order_StateModel::ORDER_FINISH ): ?>
                                        <?php if(!$val['order_buyer_evaluation_status']): ?>
                                            <p> <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=evaluation&act=add&order_id=<?=($val['order_id'])?>" class="to_views"><i class="iconfont icon-woyaopingjia icon_size22"></i><?=_('我要评价')?></a></p>
                                        <?php endif;?>
                                        <?php if($val['order_buyer_evaluation_status']): ?>
                                            <p><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=evaluation" class="to_views"><i class="iconfont icon-woyaopingjia icon_size22"></i><?=_('追加评价')?></a></p>
                                        <?php endif;?>
                                    <?php endif;?>

                                    <?php if($recycle): ?>
                                        <p><a onclick="restoreOrder('<?=$val['order_id']?>')"><i class="iconfont icon-huanyipi"></i><?=_('还原订单')?></a></p>
                                        <p><a onclick="delOrder('<?=$val['order_id']?>')" class="to_views"><i class="iconfont icon-lajitong icon_size22"></i><?=_('彻底删除')?></a></p>
                                    <?php endif;?>
                                <?php }?>
                            </td>
                            <!--E 订单操作   -->
                        </tr>
                        </tbody>
                    <?php } ?>

                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="99">
                        <div class="no_account">
                            <img src="<?= $this->view->img ?>/ico_none.png"/>
                            <p><?= _('暂无符合条件的数据记录') ?></p>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <div class="flip page clearfix">
            <p>
                <?=$page_nav?>
            </p>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
    <script>
        $(document).ready(function(){
            $('#start_date').datetimepicker({
                controlType: 'select',
                timepicker: false,
                format: 'Y-m-d'
            });

            $('#end_date').datetimepicker({
                controlType: 'select',
                timepicker: false,
                format: 'Y-m-d'
            });

            window.hide_logistic = function(order_id) {
                $("#info_" + order_id).hide();
                $("#info_" + order_id).html("");
            };

            window.show_logistic = function(order_id, express_id, shipping_code) {
                $("#info_" + order_id).show();
                $.post(BASE_URL + "/shop/api/logistic.php", {
                    "order_id": order_id,
                    "express_id": express_id,
                    "shipping_code": shipping_code
                }, function(da) {

                    if (da) {
                        $("#info_" + order_id).html(da);
                    } else {
                        $("#info_" + order_id).html('<div class="error_msg"><?=_('接口出现异常')?></div>');
                    }

                })
            }
        });
    </script>

    <?php if(Web_ConfigModel::value('im_statu')==1 && isset($_COOKIE['user_account']) && $_COOKIE['user_account']  ){ ?>
        <script>
            $(document).ready(function(){
                var click_in = false;
                $.get("<?php echo YLB_Registry::get('base_url');?>"+'/index.php?ctl=Api_IM_Im&met=index',function(h){
                    $('#im_ajax_load1').html(h);
                    im_builder_ch();
                    iconbtncomment();
                });
                function iconbtncomment(){

                    $('.chat-enter').click(function(){
                        var ch_u = $(this).attr('rel');
                        var order = $(this).attr('data-order');

                        if(ch_u == getCookie('user_account')){
                            alert('不能跟自己聊天');
                            return ;
                        }
                        var inner = $('#imbuiler')[0].contentWindow;
                        $('#imbuiler').show();
                        //查看聊天右侧的用户列表有没有，没有就点一下最下面的就出来了。
                        var dis = $('#imbuiler').contents().find('.chat-list').css('display');

                        if(dis!='block'){
                            $('#imbuiler').contents().find('.bottom-bar a').click();
                        }

                        if(order){
                            //传值消息到IM
                            inner.chat(ch_u,order);
                        }

                        return false;
                    });
                }
                function im_builder_ch(){
                    var onl = $(".tbar-tab-online-contact");
                    var i = 1;
                    onl.show().click(function(){
                        $('#imbuiler').show();
                        $('#imbuiler').contents().find('.bottom-bar a').click();
                        return;

                    });
                }
            });
        </script>
    <?php }?>

<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>



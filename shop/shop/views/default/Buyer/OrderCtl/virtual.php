<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
<script src="<?=$this->view->js_com?>/plugins/jquery.timeCountDown.js" ></script>
<script>
    $(function(){
        var _TimeCountDown = $(".fnTimeCountDown");
        _TimeCountDown.fnTimeCountDown();
    })
</script>
    </div>
      <div class="order_content">
          <div class="order_content_title clearfix">
          <form method="get" id="search_form" action="index.php" >
            <input type="hidden" name="ctl" value="<?=$_GET['ctl']?>">
            <input type="hidden" name="met" value="<?=$_GET['met']?>">
            <p class="order_types">
				<a <?php if($status == '' &&  !$recycle):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=virtual"><?=_('全部订单')?></a>
				<a <?php if($status == 'wait_pay'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=virtual&status=wait_pay"><?=_('待付款')?></a>
				<a <?php if($status == 'wait_confirm_goods'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=virtual&status=wait_confirm_goods"><?=_('待收货')?></a>
				<a <?php if($status == 'finish'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=virtual&status=finish"><?=_('已完成')?></a>
			</p>

            <p class="order_time">
                <span><?=_('下单时间')?></span>
                <input type="text" autocomplete="off" placeholder="开始时间" name="start_date" id="start_date" class="text w70" value="<?=@$_GET['start_date']?>">
                 <label class="add-on">
                    <i class="iconfont icon-rili"></i>
                </label>
                <em style="margin-top: 3px;">&nbsp;– &nbsp;</em>
                <input type="text" autocomplete="off" placeholder="结束时间" name="end_date" id="end_date" class="text w70" value="<?=@$_GET['end_date']?>">
                 <label class="add-on">
                    <i class="iconfont icon-rili"></i>
                </label>

            </p>
            <p class="ser_p" style="margin-left: 10px;">
                <input type="text" name="orderkey" placeholder="<?=_('订单号')?>" value="<?=@$_GET['orderkey']?>">
                <a class="btn_search_goods" href="javascript:void(0);" style="padding-left: 2px;"><i class="iconfont icon-icosearch icon_size18" style="margin-right: -2px;"></i><?=_('搜索')?></a>
            </p>

            <p class="order_types serc_p">
                <a <?php if($recycle):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=virtual&recycle=1"><i class="iconfont icon-lajitong icon_size20"></i><?=_('订单回收站')?></a>
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
              <?php if($data['items']){?>
              <?php foreach($data['items'] as $key => $val):?>
              <tbody class="tboy">

              <!-- 下单时间，订单号，店铺名称    -->
                <tr class="tr_title">
                  <th colspan="8" class="order_mess clearfix">
                      <p class="order_mess_one">
                        <time><?=($val['order_create_time'])?></time>
                        <span><?=_('订单号：')?><strong><?=($val['order_id'])?></strong></span>
                        <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&id=<?=($val['shop_id'])?>"><i class="iconfont icon-icoshop"></i><?=($val['shop_name'])?></a>
                      </p>
                  </th>
                </tr>

				<tr>
				    <td colspan="4"  class="td_rborder">
				        <!--S  循环订单中的商品  -->
                        <table>
                        <?php foreach($val['goods_list'] as $ogkey=> $ogval):?>
                            <tr class="tr_con">
                                <td class="order_goods">
                                    <img src="<?=image_thumb($ogval['goods_image'],50,50)?>"/>
                                    <a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($ogval['goods_id'])?>"><?=($ogval['goods_name'])?></a>

                                    <?php if($ogval['order_goods_benefit']){?><em class="td_sale bbc_btns small_details"><?=($ogval['order_goods_benefit'])?></em><?php }?>
                                </td>
                                <td class="td_color widt1"><?=format_money($ogval['goods_price'])?></td>
                                <td class="td_color widt2"><i class="iconfont icon-cuowu" style="position:relative;font-size: 12px;"></i> <?=($ogval['order_goods_num'])?></td>
                                <td class="td_color widt4">
                                    <?php if($val['order_status'] != Order_StateModel::ORDER_WAIT_PAY  && $val['order_status'] != Order_StateModel::ORDER_CANCEL){?>
                                        <?php if($ogval['goods_refund_status'] == Order_StateModel::ORDER_GOODS_RETURN_NO ){?>
                                            <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=add&gid=<?=($ogval['order_goods_id'])?>"><?=_('退款')?></a>
                                        <?php }?>
                                        <?php if($ogval['goods_refund_status'] != Order_StateModel::ORDER_GOODS_RETURN_NO ){?>
                                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=detail&oid=<?=($ogval['order_id'])?>"><?=_('退款进度')?></a>
                                        <?php }?>
                                     <?php }?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </table>
                        <!--E  循环订单中的商品   -->
                </td>

                <!--S  订单金额 -->
                <td class="td_rborder widt5 pad0" >
				     <span class="fls">
				        <em class="type-name"><?=_('订单总额：')?></em><strong><?=format_money($val['order_goods_amount'])?><!--<br/>--><?/*=($val['payment_name'])*/?>
				     </span>

				     <span class="fls">
				        <em class="type-name"><?=_('应付：')?></em><strong><?=format_money($val['order_payment_amount'])?></strong>
				     </span>
				     <?php if($val['order_shop_benefit']){?><span class="td_sale bbc_btns"><?=($val['order_shop_benefit'])?></span><?php }?>
                </td>
                <!--E 订单金额 -->

				<td class="td_rborder">
                   <p class="getit"><?=($val['order_state_con'])?></p>
                   <p>
                      <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=virtual&act=detail&order_id=<?=($val['order_id'])?>"><?=_('订单详情')?>
                      </a>
                    </p>

                    <!-- S 订单详情  -->
                    <!-- 订单退款状态：当订单不为取消状态和待付款状态时显示订单退款状态 -->
				    <?php if($val['order_status'] != Order_StateModel::ORDER_CANCEL && $val['order_status'] != Order_StateModel::ORDER_WAIT_PAY ){?>
                    <p>
                        <?php if($val['order_refund_status'] != Order_StateModel::ORDER_REFUND_NO ){?>
                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=detail&oid=<?=($val['order_id'])?>"><?=_('退款进度')?></a>
                        <?php }?>
                    </p>
                    <?php }?>
                    <!--E  订单详情  -->
                </td>


                <!--S 订单操作  -->
				<td class="td_rborder">
				    <?php if(($val['order_status'] == Order_StateModel::ORDER_CANCEL || $val['order_status'] == Order_StateModel::ORDER_FINISH) && $recycle != 1):?>
                      
                        <a onclick="hideOrder('<?=$val['order_id']?>')"><i class="iconfont icon-lajitong icon_size20"></i><?=_('删除订单')?></a>
                      
                  <?php endif; ?>

				<!--S  未付款订单 -->
				    <?php if($val['order_status'] == Order_StateModel::ORDER_WAIT_PAY):?>
				        <p class="rest">
							<span class="iconfont icon-shijian2"></span>
							<span class="fnTimeCountDown" data-end="<?=$val['cancel_time']?>">
							    <span><?=_("剩余")?></span>
                                <!--<span class="day" >00</span><strong><?/*=_('天')*/?></strong>-->
                                <span class="hour">00</span><span><?=_('时')?></span>
                                <span class="mini">00</span><span><?=_('分')?></span>
                                <!--<span class="sec" >00</span><strong><?/*=_('秒')*/?></strong>-->
                            </span>
						</p>
                        <p>
                            <a target="_blank" onclick="payOrder('<?=$val['payment_number']?>','<?=$val['order_id']?>')"  class="to_views "><i class="iconfont icon-icoaccountbalance pay-botton"></i><?=_('订单支付')?></a>
                          </p>
                          <p><a onclick="cancelOrder('<?=$val['order_id']?>')" class="to_views"><i class="iconfont icon-quxiaodingdan"></i><?=_('取消订单')?></a></p>
                    <?php endif;?>
                <!--E  未付款订单 -->
                <?php if(($val['order_status'] != Order_StateModel::ORDER_WAIT_PAY && $val['order_status'] != Order_StateModel::ORDER_CANCEL )){?>
                    <?php if($val['order_refund_status'] == Order_StateModel::ORDER_REFUND_NO ){?>
                         <p><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&act=add&oid=<?=($val['order_id'])?>" class="to_views"><i class="iconfont icon-dingdanwancheng icon_size22"></i><?=_('申请退款')?></a></p>
                    <?php }?>
                <?php }?>


                    <?php if($val['order_status'] == Order_StateModel::ORDER_FINISH ): ?>
                            <?php if(!$val['order_buyer_evaluation_status']): ?>
                                    <p><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=evaluation&act=add&order_id=<?=($val['order_id'])?>" class="to_views"><i class="iconfont icon-woyaopingjia icon_size22"></i><?=_('我要评价')?></a></p>
                            <?php endif;?>
                        <?php if($val['order_buyer_evaluation_status']): ?>
                           <p> <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=evaluation" class="to_views"><i class="iconfont icon-woyaopingjia icon_size22"></i><?=_('追加评价')?></a></p>
                        <?php endif;?>
                    <?php endif;?>

                    <?php if($recycle): ?>

                        <a onclick="restoreOrder('<?=$val['order_id']?>')"><i class="iconfont icon-huanyipi"></i><?=_('还原订单')?></a>

                        <a onclick="delOrder('<?=$val['order_id']?>')" class="to_views"><i class="iconfont icon-lajitong icon_size22"></i><?=_('彻底删除')?></a>

                    <?php endif;?>
                </td>
                <!--E 订单操作   -->
		    </tr>
            </tbody>

              <tbody>
                <tr>
                  <th class="tr_margin" style="height:16px;background:#fff;" colspan="8"></th>
                </tr>
              </tbody>
              <?php endforeach;?>
              <?php }
            else
            {
                ?>
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
            <p><!--<a href="#" class="page_first">首页</a><a href="#" class="page_prev">上一页</a><a href="#" class="numla cred">1</a><a href="#" class="page_next">下一页</a><a href="#" class="page_last">末页</a>-->
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
</div>
<script>
$(document).ready(function(){
    $('#start_date').datetimepicker({
        controlType: 'select',
        timepicker:false,
        format:'Y-m-d'
    });

    $('#end_date').datetimepicker({
    controlType: 'select',
    timepicker:false,
    format:'Y-m-d'
    });
});
</script>

 <!-- 尾部 -->
 <?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
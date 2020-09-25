<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
 
	<div class="aright">
	<div class="member_infor_content">
		<div class="div_head tabmenu clearfix">
			<ul class="tab clearfix">
				<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=index&typ=e"><?=_('淘金申请')?></a></li>
				<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Goods&met=index"><?=_('商品列表')?></a></li>
				<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerList"><?=_('我的推广')?></a></li>
				<li class="active"><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder"><?=_('我的业绩')?></a></li>
				<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerCommission"><?=_('佣金记录')?></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerMarket"><?=_('淘金市场')?></a></li>
            </ul>
		</div>
        <div class="order_content">
			<div class="order_content_title clearfix">
				<form method="get" id="search_form" action="index.php" >
					<input type="hidden" name="ctl" value="<?=request_string('ctl')?>">
					<input type="hidden" name="met" value="<?=request_string('met')?>">
                    <p class="order_types">
                        <a <?php if($direct == ''):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder<?php if(request_string('status')){echo '&status='.request_string('status');}?>"><?=_('本店')?></a>
                        <a <?php if($direct == 'second'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder&direct=second<?php if(request_string('status')){echo '&status='.request_string('status');}?>"><?=_('下级分销商')?></a>
                        <a <?php if($direct == 'third'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder&direct=third<?php if(request_string('status')){echo '&status='.request_string('status');}?>"><?=_('下级的下级分销商')?></a>
                    </p>
					<p class="order_types" style="clear: left;">
						<a <?php if($status == ''):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder<?php if(request_string('direct')){echo '&direct='.request_string('direct');}?>"><?=_('全部订单')?></a>
						<a <?php if($status == 'wait_pay'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder&status=wait_pay<?php if(request_string('direct')){echo '&direct='.request_string('direct');}?>"><?=_('待付款')?></a>
						<a <?php if($status == 'wait_confirm_goods'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder&status=wait_confirm_goods<?php if(request_string('direct')){echo '&direct='.request_string('direct');}?>"><?=_('待收货')?></a>
						<a <?php if($status == 'finish'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder&status=finish<?php if(request_string('direct')){echo '&direct='.request_string('direct');}?>"><?=_('已完成')?></a>
						<a <?php if($status == 'cancel'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder&status=cancel<?php if(request_string('direct')){echo '&direct='.request_string('direct');}?>"><?=_('已取消')?></a>
					</p>

					<p class="ser_p" style="margin-left: 10px;float:right;">
						<input type="text" name="orderkey" placeholder="<?=_('订单号')?>" value="<?=request_string('orderkey')?>">
						<a class="btn_search_goods" href="javascript:void(0);" style="padding-left: 2px;"><i class="iconfont icon-icosearch icon_size18" style="margin-right:-2px; "></i><?=_('搜索')?></a>
					</p>
					<p class="order_time" style="float:right;">
						<span><?=_('下单时间')?></span>
						<input type="text" autocomplete="off" placeholder="开始时间" name="start_date" id="start_date" class="text w70" value="<?=request_string('start_date')?>">
						 <label class="add-on">
							<i class="iconfont icon-rili"></i>
						</label>
						<em style="margin-top: 3px;">&nbsp;– &nbsp;</em>
						<input type="text" placeholder="结束时间" autocomplete="off" name="end_date" id="end_date" class="text w70" value="<?=request_string('end_date')?>">
						 <label class="add-on">
							<i class="iconfont icon-rili"></i>
						</label>

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
						<th class="widt4"><?=_('总额')?></th>
						<th class="widt5"><?=_('佣金')?></th>
						<th class="widt6"><?=_('交易状态')?></th>
					</tr>
				</tbody>
              
				<tbody>
					<tr><th class="tr_margin" style="height:16px;background:#fff;" colspan="7"></th></tr>
				</tbody>
              <?php if($data['items']){?>
              <?php foreach($data['items'] as $key => $val):?>
				<tbody class="tboy">
				<!-- 下单时间，订单号，店铺名称    -->
					<tr class="tr_title">
						<th colspan="7" class="order_mess clearfix">
							<p class="order_mess_one">
								<time><?=($val['order_create_time'])?></time>
								<span><?=_('订单号：')?><strong><?=($val['order_id'])?></strong></span>
								<a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&id=<?=($val['shop_id'])?>"><i class="iconfont icon-icoshop"></i><?=($val['shop_name'])?></a>
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

										<?php if($ogval['order_goods_benefit']){?><em class="td_sale bbc_btns small_details"><?=($ogval['order_goods_benefit'])?></em><?php }?>
									</td>
									<td class="td_color widt1"><?=format_money($ogval['goods_price'])?></td>
									<td class="td_color widt2"><i class="iconfont icon-cuowu" style="position:relative;font-size: 12px;"></i> <?=($ogval['order_goods_num'])?></td>
									<td class="td_color widt4"><?=number_format(($ogval['order_goods_num']*$ogval['goods_price']), 2, '.', '')?></td>
									<td class="td_color widt5">
                                        <?php $index = 0; if(request_string('direct') == 'second'){$index=1;}else if(request_string('direct') == 'third'){$index=2;}?>
										<?=number_format($ogval['directseller_commission_'.$index], 2, '.', '')?>
									</td>									 
								</tr>
							<?php endforeach;?>
							</table>
							<!--E  循环订单中的商品   -->
						</td>
						
						<td class="td_rborder">
							<p class="getit <?php if($val['order_status'] == Order_StateModel::ORDER_WAIT_PAY ){?>bbc_color<?php }?>"><?=($val['order_state_con'])?></p>
						    <?php if($val['order_status'] == Order_StateModel::ORDER_WAIT_PAY  && $val['payment_id'] == PaymentChannlModel::PAY_CONFIRM ){?>
								<p class="getit bbc_color"><?=_('货到付款')?></p>
						    <?php }?>
						</td>
						
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
          <div class="flip page clearfix"><p><?=$page_nav?></p></div>
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
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
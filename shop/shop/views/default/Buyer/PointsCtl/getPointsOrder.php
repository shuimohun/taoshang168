<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
<div class="aright">
	<div class="member_infor_content">
        <div class="order_content">
          <div class="div_head tabmenu clearfix">
            <ul class="tab clearfix">
              <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Points&met=points"><?=_('金蛋明细')?></a></li>
              <li  class="active"> <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Points&met=points&op=getPointsOrder"><?=_('兑换记录')?></a></li>
            </ul>
          </div>
          <ul>
            <li> 
              <div>
			  <div class="order_content_title clearfix">
				<div style="margin-top: 10px;" class="clearfix">
					<form id="search_form" method="get">
						<input type="hidden" name="ctl" value="Buyer_Points"/>
						<input type="hidden" name="met" value="points"/>
						<input type="hidden" name="op" value="getPointsOrder"/>
						<p class="pright">
							<select name="state">
								<option value="" <?php if($state==''){echo "selected";}?>><?=_('选择状态')?></option>
								<option value="1" <?php if($state==1){echo "selected";}?>><?=_('等待发货')?></option>
								<option value="2" <?php if($state==2){echo "selected";}?>><?=_('等待收货')?></option>
								<option value="3" <?php if($state==3){echo "selected";}?>><?=_('确认收货')?></option>
								<option value="4" <?php if($state==4){echo "selected";}?>><?=_('取消')?></option>
							</select>
							 <a class="btn_search_goods sous" href="javascript:void(0);">
							<i class="iconfont icon-btnsearch  icon_size18"></i><?=_('搜索')?></a></p>
					</form>
				</div>
			</div>
			<script type="text/javascript">
				$(".sous").on("click", function ()
				{
					$("#search_form").submit();
				});
				</script>
                <table  class="ncm-default-table annoc_con">
				<thead>
                  <tr class="bortop">
					  <th> <?=_('订单编号')?> </th>
                      <th  style="width:400px"> <?=_('礼品信息')?> </th>
					  <th> <?=_('金蛋')?> </th>
					  <th> <?=_('数量')?> </th>
					  <th> <?=_('合计（金蛋）')?> </th>
					  <th> <?=_('交易状态')?> </th>
					  <th style="width:200px"> <?=_('操作')?> </th>
                  </tr>
				 </thead>
				  <?php if(!empty($data['items'])){ ?>
				  <?php foreach($data['items'] as $key=>$val){?>
				  <?php foreach($val['points_ordergoods_list'] as $k=>$v){?>
                  <tr>
                    <td><?=$val['points_order_id']?></td>
                    <td><a href="<?= YLB_Registry::get('url') ?>?ctl=Points&met=detail&id=<?=$v['points_goodsid']?>" target="_blank"><?=$v['points_goodsname']?></a></td>
					<td><?=$v['points_goodspoints']?></td>
                    <td><?=$v['points_goodsnum']?></td>
                    <td><?=$val['points_allpoints']?></td>
                    <td><?php if($val['points_orderstate'] == '1'){?><?=_('已下单')?><?php }elseif($val['points_orderstate'] == '2'){?><?=_('已发货')?><?php }elseif($val['points_orderstate'] == '3'){?><?=_('完成')?><?php }elseif($val['points_orderstate'] == '4'){?><?=_('取消')?><?php }?></td>
					
                    <td><?php if($val['points_orderstate'] == '2'){?><a onclick="confirmPointsOrder('<?=$val['points_order_id']?>')" class="to_views bbc_btns "><i class="iconfont icon-duigou1"></i><?=_('确认收货')?></a><?php }else{?> <a data-dis="1"  class="to_views cgray"><i class="iconfont icon-duigou1"></i><?=_('确认收货')?></a><?php }?></td>
					
                  </tr>
                  <?php }?>
                  <?php }?>
				  <?php }else{ ?>
					<tr id="list_norecord">
						<td colspan="20" class="norecord">
							 <div class="no_account">
								<img src="<?= $this->view->img ?>/ico_none.png"/>
								<p><?=_('暂无符合条件的数据记录')?></p>
							</div>    	
						</td>
					</tr>
				 <?php } ?>
                </table>
				<?php if($page_nav){ ?>
					 <div class="page page_front"><?=$page_nav?></div>
				 <?php } ?>
              </div>
            </li>
          </ul>
        </div>
      </div>
      </div>
    </div>
  </div>
<script>
 //确认收货
       window.confirmPointsOrder = function (e)
       {
            url = SITE_URL + '?ctl=Buyer_Points&met=confirmOrder&typ=';

			$.dialog({
				title: "<?=_('确认收货')?>",
				content: 'url: ' + url + 'e&user=buyer',
				data: { order_id: e},
				height: 200,
				width: 400,
				lock: true,
				drag: false,
				ok: function () {

					var form_ser = $(this.content.order_confirm_form).serialize();

					$.post(url + 'json', form_ser, function (data) {
						if ( data.status == 200 ) {
							$.dialog.alert("<?=_('确认收货成功')?>"), window.location.reload();
							return true;
						} else {
							$.dialog.alert("<?=_('确认订单失败')?>");
							return false;
						}
					})
				}
			})
       }
</script>

<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
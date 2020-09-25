<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
 
	<div class="aright">
        <div class="member_infor_content">
			<div class="div_head tabmenu clearfix">
				<ul class="tab clearfix">
					<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=index&typ=e"><?=_('淘金申请')?></a></li>
					<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Goods&met=index"><?=_('商品列表')?></a></li>
					<li  class="active"><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerList"><?=_('我的推广')?></a></li>
					<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder"><?=_('我的业绩')?></a></li>
					<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerCommission"><?=_('佣金记录')?></a></li>
                    <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerMarket"><?=_('淘金市场')?></a></li>
                </ul>
			</div>
			
			<div class="order_content_title clearfix">
				<div style="margin-top: 10px;" class="clearfix">
					<form id="search_form" method="get">
						<input name="ctl" value="Distribution_Buyer_Directseller" type="hidden">
						<input name="met" value="directsellerList" type="hidden">
						<p class="pright">
							<span style="line-height: 25px;margin-left: 8px;"></span><input name="userName" class="A" style=" margin-left: 2px;width: 150px;" value="<?=request_string('userName')?>" placeholder="请输入会员名称" type="text"> <a href="javascript:void(0);" class="sous" style="margin-right: 0;"><i class="iconfont icon-btnsearch"></i>搜索</a>
						</p>
						<div style="clear:both;"></div><p></p>
					</form>
				</div>
			</div>
			
			<table class="ncm-default-table annoc_con">
				<thead>
					<tr class="bortop">
						<th class="w150"><?=_('用户名称')?></th>
						<th class="w110"><?=_('性别')?></th>
						<th class="w110"><?=_('手机号码')?></th>
						<th class="w120"><?=_('推广会员数')?></th>
						<th class="w120"><?=_('消费总额')?></th>
						<th class="w110"><?=_('带来佣金')?></th>
						<th class="w150"><?=_('注册时间')?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($data['items'])){ ?>
					<?php foreach($data['items'] as $key=>$val){?>
					<tr class="bd-line">
						<td style="text-align:left;">
							<img style="width:60px;height:60px;padding:0px 10px;" src="<?=$val['user_logo']?>">
							<?=($val['user_name'])?>
						</td>
						<td><?=$val['user_sex']?></td>
						<td><?=$val['user_mobile']?></td>
						<td><?=$val['invitors']?></td>
						<td><?=format_money($val['expends'])?></td>
						<td><?=format_money($val['commission'])?></td>
						<td class="ncm-table-handle"><?=$val['user_regtime']?></td>				   
					</tr>
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
				</tbody>
			</table>
			<div class="flip page clearfix"><p><?=$page_nav?></p></div>
		</div>
    </div>
	<script>
		$(".sous").on("click", function ()
        {
           $("#search_form").submit();
        });
	</script>
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
	<div class="aright">
        <div class="member_infor_content">
			<div class="div_head tabmenu clearfix">
				<ul class="tab clearfix">
					<li  class="active"><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=index&typ=e"><?=_('淘金申请')?></a></li>
					<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Goods&met=index"><?=_('商品列表')?></a></li>
					<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerList"><?=_('我的推广')?></a></li>
					<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder"><?=_('我的业绩')?></a></li>
					<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerCommission"><?=_('佣金记录')?></a></li>
					<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerMarket"><?=_('淘金市场')?></a></li>
				</ul>
			</div>
			
			<ul>
				<li>
					<div class="operation">
						<p class="p_title"><?=_('淘金中心说明：')?></p>
						<div style="margin-top:10px; margin-left:10px;">
							<p class="p_content"><?=_('1、成为淘金员：在店铺消费并且满足店铺设定的金额，可申请成为淘金员。')?></p>
							<p class="p_content"><?=_('2、发展下级：淘金员A分享链接给B，B通过分享链接注册成功，B既成为A的下级。B分享链接给C，C通过分享链接注册成功后，C即成为B的下级。')?></p>
							<p class="p_content"><?=_('3、获得佣金：当B推广的下级C成功消费一笔订单时，B可以获得佣金奖励（我们将这笔奖励称之为“一级佣金”），A可以获得推荐奖励（我们将这笔奖励称之为“二级佣金”）。')?></p>
							<p class="p_content"><?=_('4、佣金结算：下级用户下单成功，确认收货7天以后，佣金结算到网站支付账户余额中。')?></p>
						</div>
					</div>
				</li>
			</ul>
            <?php if($data['class']){?>
            <div id="fenlei">
                <ul>
                    <li <?php if(!$cid){echo 'class="current"';}?>><a href="<?=YLB_Registry::get('url')?>?ctl=Distribution_Buyer_Directseller&met=index" target="_self">全部分类</a></li>
                    <?php foreach($data['class'] as $key => $val ) {?>
                        <li <?php if($val['shop_class_id'] == $cid){echo 'class="current"';}?>>
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Distribution_Buyer_Directseller&met=index&cid=<?=$val['shop_class_id']?>" target="_self">
                                <?=$val['shop_class_name'] ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
			<table class="ncm-default-table annoc_con">
				<thead>
					<tr class="bortop">
						<th class="w150">店铺名称</th>
						<th class="tl opti">申请条件</th>
						<th class="w150">消费金额</th>
						<th class="w150">状态</th>
						<th class="w150">创建时间</th>
						<th class="w150">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($data['items'])){ ?>
                        <?php foreach($data['items'] as $key=>$val){?>
                            <tr class="bd-line">
                                <td><a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=index&id=<?=$val['shop_id']?>" target="_blank"><?=($val['shop_name'])?></a></td>
                                <td class="tl opti">
                                    <?php if($val['expenditure']){ ?>
                                        <?=_('消费满')?>&nbsp;<?=format_money($val['expenditure'])?>&nbsp;<?=_('可申请')?>
                                    <?php }else{ ?>
                                        <?=_('成功消费任意金额')?>
                                    <?php } ?>
                                </td>
                                <td><?=format_money($val['expends'])?></td>
                                <td>
                                    <?php if(isset($val['status'])){ if($val['status'] == 0){?>
                                        <span><?=_('待审核')?></span>
                                    <?php }elseif($val['status']==1){?>
                                        <span><?=_('审核通过')?></span>
                                    <?php }	}else{?>
                                        <span><?=_('未申请')?></span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?=@$val['directseller_create_time']?>
                                </td>
                                <td class="ncm-table-handle">
                                    <?php if(isset($val['status'])) { ?>
                                        <a data-dis="1"  class="to_views cgray"><i class="iconfont icon-duigou1"></i><?=_('已经申请')?></a>
                                    <?php }elseif($val['apply_enable']) {?>
                                        <a onclick="apply('<?=$val['shop_id']?>')" class="to_views bbc_btns ">
                                            <i class="iconfont icon-duigou1"></i><?=_('申请淘金')?>
                                        </a>
                                    <?php }?>
                                </td>
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
			<?php if($page_nav){ ?>
				<div class="page page_front"><?=$page_nav?></div>
			<?php } ?>
			<div style="clear:both"></div>
		</div>
    </div>

    <script>
        function apply(id) {
            $.dialog.confirm('您确定要申请吗?', function() {
                $.post(SITE_URL + '?ctl=Distribution_Buyer_Directseller&met=addDirectseller&typ=json', {
                    shop_id: id
                }, function(d) {
                    if (d.status == 200) {
                        Public.tips.success('申请成功!');
                        location.href = SITE_URL + '?ctl=Distribution_Buyer_Directseller&met=index'
                    } else {
                        Public.tips.error('申请失败！');
                        location.href = SITE_URL + '?ctl=Distribution_Buyer_Directseller&met=index'
                    }
                })
            })
        };
    </script>
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
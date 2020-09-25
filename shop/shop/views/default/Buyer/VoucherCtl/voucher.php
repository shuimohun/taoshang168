<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
 
</div>
	<div class="order_content_title clearfix">
        <div style="margin-top: 10px;" class="clearfix">
            <form id="search_form" method="get">
                <input type="hidden" name="ctl" value="Buyer_Voucher"/>
                <input type="hidden" name="met" value="voucher"/>
                <p class="pright">
                    <select name="state">
                        <option value="" <?php if($state==''){echo "selected";}?>><?=_('选择状态')?></option>
                        <option value="1" <?php if($state==1){echo "selected";}?>><?=_('未用')?></option>
                        <option value="2" <?php if($state==2){echo "selected";}?>><?=_('已用')?></option>
                        <option value="3" <?php if($state==3){echo "selected";}?>><?=_('过期')?></option>
                        <option value="4" <?php if($state==4){echo "selected";}?>><?=_('收回')?></option>
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
<table class="ncm-default-table annoc_con">
    <thead>
    <tr class="bortop">

        <th class="w150"><?=_('面额')?></th>
        <th class="tl opti"><?=_('有效期')?></th>
        <th class="tl opti"><?=_('使用条件')?></th>
        <th class="w120"><?=_('状态')?></th>
        <th class="w110"><?=_('操作')?></th>
    </tr>
    </thead>
    <tbody>
	<?php if(!empty($data['items'])){ ?>
    <?php foreach($data['items'] as $key=>$val){?>
    <tr class="bd-line">

        <td><?=format_money($val['voucher_price'])?></td>
        <td class="tl opti"><?=$val['voucher_start_date']?>--<?=$val['voucher_end_date']?></td>
        <td class="tl opti"><?=_('满')?>&nbsp;<?=format_money($val['voucher_limit'])?>&nbsp;<?=_('可用')?></td>
        <td><?=$val['voucher_state_label']?></td>
		<td class="ncm-table-handle">
		<?php if($val['voucher_state_label'] == '未用'){?><span><a class="btn-grapefruit"  href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&id=<?=$val['voucher_shop_id']?>"><?=_('去使用')?></a></span><?php }else{?><span class="del"><a class="btn-grapefruit" data-param="{'ctl':'Buyer_Voucher','met':'delVoucher','id':'<?=$val['voucher_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=('删除')?></a></span><?php }?>
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
	<div style="clear:both"></div><div class="page page_front"><?=$page_nav?></div><div style="clear:both"></div>
<?php } ?>
</div>
</div>
</div>
</div>

<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
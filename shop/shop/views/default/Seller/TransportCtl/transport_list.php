<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
</head>
<body>

<div class="freight">
	<div class="tabmenu">
		<ul>
        	<li class="active bbc_seller_bg"><a><?=_('运费设置')?></a></li>

        </ul>
        <a class="button add bbc_seller_btns" href="<?=YLB_Registry::get('url')?>?ctl=Seller_Transport&met=transport&act=add"><i class="iconfont icon-jia bbc_seller_btns"></i><?=_('添加运费模版')?></a>

    </div>

    <form id="form" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Transport&met=delTransport" method="post">
    <table class="table-list-style" id="table_list" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <th class="tl" width="80"><label class="checkbox"><input class="checkall" type="checkbox" /></label>模板名称</th>
        <th><?=_('配送区域')?></th>
        <th width="70"><?=_('首重重量')?></th>
        <th width="70"><?=_('首重费用')?></th>
        <th width="70"><?=_('续重重量')?></th>
        <th width="70"><?=_('续重费用')?></th>
        <th width="100"><?=_('操作')?></th>
    </tr>
    <?php if($data['items']) {
                    foreach ($data['items'] as $key => $value){ ?>
    <tr class="row_line">
		<?php if(mb_strwidth($value['transport_item']['district_name'], 'utf8')>75)
			 {
				$str = mb_strimwidth($value['transport_item']['district_name'], 0, 75, '...', 'utf8');
			 }else
			 {
				$str = $value['transport_item']['district_name'];
			 }
		?>
        <td class="tl"><label class="checkbox"><input <?php if($value['transport_item']['transport_item_city'] === 'default'){?>disabled="disabled" <?php }?> class="checkitem" type="checkbox" name="chk[]" value="<?=($value['transport_type_id'])?>" /></label><?=($value['transport_type_name'])?></td>
        <td><?=('default' === $value['transport_item']['transport_item_city'])? '全国' : $str ?></td>
        <td><span class="number"><?=($value['transport_item']['transport_item_default_num'])?></span><?=_('Kg')?></td>
        <td><span class="number"><?=format_money($value['transport_item']['transport_item_default_price'])?></span></td>
        <td><span class="number"><?=($value['transport_item']['transport_item_add_num'])?></span><?=_('Kg')?></td>
        <td><span class="number"><?=format_money($value['transport_item']['transport_item_add_price'])?></span></td>
        <td>
            <span class="edit"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Transport&met=transport&act=edit&transport_type_id=<?=($value['transport_type_id'])?>"><i class="iconfont icon-zhifutijiao"></i><?=_('编辑')?></a></span>
            <?php if('default' != $value['transport_item']['transport_item_city']){?>
            <span class="del"><a data-param="{'ctl':'Seller_Transport','met':'delTransport','id':'<?=$value['transport_type_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>
            <?php }else{?>
            <span class="unclick del_line"><a><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>
            <?php }?>
        </td>
    </tr>
    <?php }}else{?>
    <tr>
        <td colspan="99">
            <div class="no_account">
                <img src="<?= $this->view->img ?>/ico_none.png"/>
                <p><?=_('暂无符合条件的数据记录')?></p>
            </div>
        </td>
    </tr>
    <?php }?>
    <tr>
        <td class="toolBar" colspan="99">
        <input type="hidden" name="act" value="del" />
        <label class="checkbox"><input class="checkall" type="checkbox" /></label><?=_('全选')?>
        <span>|</span>
        <label class="del" data-param="{'ctl':'Seller_Transport','met':'delTransportRow'}" ><i class="icon-lajitong iconfont"></i>删除</label>
        </td>
    </tr>
    </table>
    </form>
</div>
<script>
$('.checkitem').click(function(){
		var _self = this;
		if (!this.disabled){
			$(this).prop('checked', _self.checked);

			if(_self.checked)
			{
				//判断是否所有商品都已选择，如果所有商品都选择了就勾选全选
				if($(".checkitem").not("input:checked").length == 0)
				{
					$('.checkall').prop('checked', true);
				}
			}
			else
			{
				//判断全选是否勾选，如果勾选就去除
				if($(".checkitem").not("input:checked").length != 0)
				{
					$('.checkall').prop('checked', false);
				}
			}
		}
	});

</script>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.dialog.js" charset="utf-8"></script>

<div class="exchange">
	<div class="alert">
        <h4><?=_('活动规则') ?></h4>
        <ul>
            <li><?=_('1、早晚市活动只能参加唯一一个')?></li>
            <li><?=_('2、每次活动最多添加五件商品')?></li>
            <li><?=_('3、若商品添加不足五件，则该活动不能再次增加商品，只能删除')?></li>

        </ul>

	</div>

	<table class="table-list-style table-promotion-list" id="table_list" width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<th class="tl" width="200"><?=_('活动名称')?></th>
            <th width="50"><?=_('活动类型')?></th>
			<th width="120"><?=_('活动状态')?></th>
			<th width="120"><?=_('添加时间')?></th>
			<th width="120"><?=_('操作')?></th>
		</tr>
        <?php
        if($data)
        {
            ?>
        <tr class="row_line">
            <td class="tl"><?=$data['monlater_name']?></td>
            <td><?=$data['type_name']?></td>
            <td><?=$data['state_name'] ?></td>
            <td><?=$data['monlater_add_time']?></td>
            <td class="nscs-table-handle">
                <span class="edit"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_MonLater&met=index&op=edit&typ=e&id=<?=$data['monlater_id']?>"><i class="iconfont icon-zhifutijiao"></i><?=_('编辑')?></a></span>
                <span class="edit del_line"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_MonLater&met=index&op=manage&typ=e&id=<?=$data['monlater_id']?>"><i class="iconfont icon-setting"></i><?=_('管理')?></a></span>
                <span class="del"><a data-param="{'ctl':'Seller_Promotion_MonLater','met':'removeMonLater','id':'<?=$data['monlater_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>

            </td>
        </tr>
        <?php
        }
        else
        {
        ?>
        <tr class="row_line">
            <td colspan="99">
                <div class="no_account">
                    <img src="<?=$this->view->img?>/ico_none.png">
                    <p>暂无符合条件的数据记录</p>
                </div>
            </td>
        </tr>
        <?php } ?>
	</table>
</div>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>




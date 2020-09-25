<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<div class="exchange">
<!--提示 start-->
    <div class="alert">
            <ul>
                <li><?=_('1、点击新增按钮可以添加电子面单账号')?></li>
                <li><?=_('2、请确保自己输入的用户名和密码的准确性')?></li>
                <li><?=_('3、若账号或密码错误则下单打印会失败，若下单失败请及时修改')?></li>
            </ul>
    </div>
<!--提示 end-->
<!--数据显示  start-->
    <table class="table-list-style table-promotion-list" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th class="tl" width="100"><?=_('快递名称')?></th>
            <th width="120"><?=_('添加时间')?></th>
            <th width="120"><?=_('商户账号')?></th>
            <th width="300"><?=_('打印机名称')?></th>
            <th width="140"><?=_('操作')?></th>
        </tr>
        <?php
        if($data['items'])
        {
            foreach($data['items'] as $key=>$value)
            {
                ?>
                <tr>
                    <td class="tl"><?=$value['wex_name'] ?></td>
                    <td><?=$value['addtime'] ?></td>
                    <td><?=$value['waybill_number'] ?></td>
                    <td><?=$value['printer'] ?></td>
                    <td>
                        <span class="edit">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Trade_PrintWaybill&met=waybillIndex&op=edit&waybill_id=<?=$value['waybill_id']?>&typ=e"><i class="iconfont icon-zhifutijiao"></i><?=_('编辑')?></a>
                        </span>
                        <span class="del">
                            <a data-param="{'ctl':'Seller_Trade_PrintWaybill','met':'removeWaybill','id':'<?=$value['waybill_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a>
                        </span>
                    </td>
                </tr>
            <?php } }else{ ?>
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
<!--数据显示  end-->
</div>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
    <link href="<?= $this->view->css ?>/seller_center.css?ver=<?=VER?>" rel="stylesheet">

    <div class="tabmenu">
        <ul>
            <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=category"><?=_('经营类目')?></a></li>
            <?php if($shop['shop_self_support']=="false"){ ?>
                <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=info"><?=_('店铺信息')?></a></li>
                <li class="active bbc_seller_bg"><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=record"><?=_('续签记录')?></a></li>
                <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=renew"><?=_('申请续签')?></a></li>
            <?php } ?>
        </ul>
    </div>

    <div class="alert">
        <ul>
            <li><?=_('1、店铺到期前 30 天可以申请店铺续签。')?></li>
            <li><?=_('1、店铺到期')?> <?=$shop["shop_end_time"]?> <?=_('可以在')?> <?=$frontmonth?> <?=_('开始申请店铺续签')?>。</li>
        </ul>
    </div>

<div>
    <table class="table-list-style" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th ><?=_('申请时间')?></th>
            <th ><?=_('收费标准（元/年）')?></th>
            <th ><?=_('续签时长（年）')?></th>
            <th ><?=_('付款金额 （元）')?></th>
            <th ><?=_('截止有效期')?></th>
            <th ><?=_('状态')?></th>
            <th><?=_('操作')?></th>
        </tr>
        <?php if($data['items'] ){foreach ($data['items'] as $key => $value) {?>
            <tr class="row_line">
                <td><?=$value['create_time']?></td>
                <td><?=$value['shop_grade_fee']?></td>
                <td><?=$value['renew_time']?></td>
                <td><?=$value['renew_cost']?></td>
                <td><?=$value['end_time']?></td>
                <td><?=$value['renewal_status_cha']?></td>
                <td class="nscs-table-handle">
                <?php if($value['status'] != 2){?>
                    <span class="del"><a data-param="{'ctl':'Seller_Shop_Info','met':'delRenew','id':'<?=$value['id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>
                <?php }?>
                </td>
            </tr>
        <?php }}else{ ?>
            <tr class="row_line">
                <td colspan="99">
                    <div class="no_account" style="margin:60px 0">
                        <img src="<?=$this->view->img?>/ico_none.png">
                        <p style="width:unset">暂无符合条件的数据记录</p>
                    </div>
                </td>
            </tr>
        <?php }?>
    </table>
</div>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>


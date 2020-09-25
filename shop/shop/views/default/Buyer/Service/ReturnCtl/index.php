<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
<div class="aright">
    <div class="member_infor_content">
    <div class="order_content">
        <div class="div_head  tabmenu clearfix">
            <ul class="tab pngFix clearfix">
                <li <?php if ($state == 1){echo 'class="active"';} ?>>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&state=1"><?= _('退款申请') ?></a>
                </li>
                <li <?php if ($state == 2){echo 'class="active"';} ?>>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&state=2"><?= _('退货申请') ?></a>
                </li>
                <li <?php if ($state == 3){echo 'class="active"';} ?>>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Service_Return&met=index&state=3"><?= _('虚拟兑码退款') ?></a>
                </li>
            </ul>
        </div>

        <div class="order_content_title clearfix">
            <div style="margin-top: 10px;" class="clearfix">
                <form id="search_form" method="get">
                    <input type="hidden" name="ctl" value="Buyer_Service_Return"/>
                    <input type="hidden" name="met" value="index"/>
                    <p class="pright">
                        <span style="line-height: 25px;"><?= _('申请时间') ?></span>
                        <input type="text" name="start_time" id="start_time" class="A" value="<?= $start_time ?>" placeholder="开始时间">
                        <em class="add-on2"><i style="font-size: 22px;position: relative;left: 2px;" class="iconfont icon-rili"></i></em>
                        <em style="line-height: 25px;">&nbsp;–&nbsp;</em>
                        <input type="text" name="end_time" id="end_time" class="A" value="<?= $end_time ?>" placeholder="结束时间">
                        <em class="add-on2"><i style="font-size: 22px;position: relative;left: 2px;" class="iconfont icon-rili"></i></em>
                        <span style="line-height: 25px;margin-left: 8px;"><?= _('订单编号') ?></span>
                        <input type="text" name="return_code" class="A" style=" margin-left: 2px;width: 150px;" value="<?= $order_id ?>" placeholder="订单编号">
                        <a href="javascript:void(0);" class="sous" ><i class="iconfont icon-btnsearch"></i><?= _('搜索') ?></a>
                    </p>
                </form>
            </div>
        </div>

        <table style="width: 100%;" class="icos">
            <tbody class="tbpad">
                <tr class="order_tit">
                    <?php if ($state == 2){echo '<th colspan="2" width="411">' . _('商品') . '</th>';} ?>
                    <th width="<?php if ($state == 2){echo 221;}else{echo 455;} ?>"><?= _('退款金额') ?></th>
                    <th width="<?php if ($state == 2){echo 311;}else{echo 431;} ?>"><?= _('审核状态') ?></th>
                    <th width="<?php if ($state == 2){echo 89;}else{echo 146;} ?>"><?= _('操作') ?></th>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th class="tr_margin" style="height:16px;background:#fff;" colspan="8"></th>
                </tr>
            </tbody>
            <?php
            if (!empty($data['items'])){ ?>
                <?php foreach ($data['items'] as $key => $value){ ?>
                    <tbody class="tboy">
                        <tr class="tr_title">
                            <th colspan="5" class="order_mess clearfix">
                                <p class="order_mess_one">
                                    <time><?= $value['return_add_time'] ?></time>
                                    <span><?= _('退款编号：') ?><strong><?= $value['return_code'] ?></strong></span>
                                </p>
                            </th>
                        </tr>
                        <tr class="tr_con">
                            <?php if ($state == 2){ echo '<td width="65" style="padding-right: 9px;"><img width="60" src="' . $value['order_goods_pic'] . '"></td><td width="345" style="text-align: left;">' . $value['order_goods_name'] . '</td>';} ?>
                            <td class="td_color"><?= format_money($value['return_cash']) ?></td>
                            <td class="td_color"><?= $value['return_state_con'] ?></td>
                            <td><span><a href="./index.php?ctl=Buyer_Service_Return&met=index&act=detail&id=<?= $value['order_return_id'] ?>"><i class="iconfont icon-chakan"></i>查看</a></span></td>
                        </tr>
                    </tbody>
                <?php } ?>
            <?php } else { ?>
                <tbody>
                    <tr>
                        <td colspan="99">
                            <div class="no_account">
                                <img src="<?= $this->view->img ?>/ico_none.png"/>
                                <p><?= _('暂无符合条件的数据记录') ?></p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>

        <?php if ($page_nav){ ?>
            <div class="page"><?= $page_nav ?></div>
        <?php } ?>
    </div>
</div>
</div>

<script type="text/javascript">
    $(".sous").on("click",function(){$("#search_form").submit()});
    $(function () {
        $('#start_time').datetimepicker({controlType:'select',format:"Y-m-d",timepicker:false});
        $('#end_time').datetimepicker({controlType:'select',format:"Y-m-d",timepicker:false});
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>






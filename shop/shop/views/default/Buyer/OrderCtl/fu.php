<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>

    <style>
        .time_down{padding-right:2% !important;float: right;}
        .time_down span{padding-right:4px; }
        .time_down span,strong{color:#e02222;}
        .share_d p{display: inline-block;}
    </style>
</div>

    <div class="order_content">
        <div class="order_content_title clearfix">
            <div style="margin-top: 10px;" class="clearfix">
                <form id="search_form" method="get">
                    <input type="hidden" name="ctl" value="Buyer_Order"/>
                    <input type="hidden" name="met" value="fu"/>
                    <p class="pright">
                        <span style="line-height: 25px;"><?= _('分享时间') ?></span>
                        <input type="text" name="query_start_date" id="query_start_date" class="A" value="<?= $query_start_date ?>" placeholder="开始时间">
                        <em class="add-on2"><i style="font-size: 22px;position: relative;left: 2px;" class="iconfont icon-rili"></i></em>
                        <em style="line-height: 25px;">&nbsp;–&nbsp;</em>
                        <input type="text" name="query_end_date" id="query_end_date" class="A" value="<?= $query_end_date ?>" placeholder="结束时间">
                        <em class="add-on2"><i style="font-size: 22px;position: relative;left: 2px;" class="iconfont icon-rili"></i></em>
                        <span style="line-height: 25px;"><?= _('状态') ?></span>
                        <select id="fu_status" name="fu_status" class="w120 vt valid">
                            <option value="0"><?=_('请选择')?></option>
                            <?php  foreach(Fu_RecordModel::$status_array_map as $key=>$value){ ?>
                                <option value="<?=$key?>" <?php if(isset($fu_status) && $fu_status == $key){echo 'selected';}?>><?=$value?></option>
                            <?php } ?>
                        </select>
                        <a href="javascript:void(0);" class="sous btn-search" ><i class="iconfont icon-btnsearch"></i><?= _('搜索') ?></a>
                    </p>
                </form>
            </div>
        </div>
        <table>
            <tbody class="tbpad">
            <tr class="order_tit">
                <th class="widt1"><?=_('商品')?></th>
                <th class="widt1"><?=_('商品价格')?></th>
                <th class="widt2"><?=_('购买价格')?></th>
                <th class="widt2"><?=_('状态')?></th>
                <th class="widt6"><?=_('分享数据')?></th>
            </tr>
            </tbody>
            <tbody>
            <tr>
                <th class="tr_margin" style="height:16px;background:#fff;" colspan="8"></th>
            </tr>
            </tbody>
            <?php if($data['items']){?>
                <?php foreach($data['items'] as $key => $val):?>
                    <tbody class="tboy">
                        <tr class="tr_title">
                            <th colspan="8" class="order_mess clearfix">
                                <p class="order_mess_one">
                                    <time><?=($val['fu_record_time'])?></time>
                                    <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&id=<?=($val['shop_id'])?>"><i class="iconfont icon-icoshop"></i><?=($val['shop_name'])?></a>
                                    <span class="time_down bbc_color">
                                        <?php if($val['status'] < Fu_RecordModel::USED && $val['fu_end_time'] > get_date_time()){?>
                                        <strong class="fnTimeCountDown" data-end="<?= ($val['fu_end_time']) ?>">
                                            <span class="hour">00</span><strong>:</strong>
                                            <span class="mini">00</span><strong>:</strong>
                                            <span class="sec">00</span>
                                        </strong>
                                        <span>后失效</span>
                                        <?php }else if($val['status'] == Fu_RecordModel::OVER){?>
                                            <?php if($val['delete'] || $val['fu_end_time'] >= get_date_time()){?>
                                                <span>已失效</span>
                                            <?php }else{?>
                                                <span>已于 <?= ($val['fu_end_time']) ?> 失效</span>
                                            <?php }?>
                                        <?php }?>
                                    </span>
                                </p>
                            </th>
                        </tr>
                        <tr>
                            <td class="share_goods td_rborder">
                                <img src="<?=image_thumb($val['goods_image'],50,50)?>"/>
                                <a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($val['goods_id'])?>"><?=($val['goods_name'])?></a>
                            </td>
                            <td class="td_rborder ">
                                <?=format_money($val['goods_price']); ?>
                            </td>
                            <td class="td_rborder ">
                                <?php if($val['order_goods_amount'] != null){ echo format_money($val['order_goods_amount']);}?>
                            </td>
                            <td class="td_rborder ">
                                <p><?=($val['status_con'])?></p>
                                <?php if($val['order_id']){?>
                                <p><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&act=details&order_id=<?=($val['order_id'])?>"><?=_('订单详情')?></a></p>
                                <?php }?>
                            </td>
                            <td class="td_rborder share_list">
                                <div class="share">

                                    <div class="share_d">
                                        <p><?php if($val['fu_base']['weixin']){echo $val['fu_base']['weixin'];}?></p>
                                        <span class="share_s wx_single<?php if($val['fu_base']['weixin'] >= $val['base']['weixin']){echo '_liang';}?>"></span>
                                        <p><?php if($val['base']['weixin']){echo $val['base']['weixin'];}?></p>
                                    </div>
                                    <div class="share_d">
                                        <p><?php if($val['fu_base']['weixin_timeline']){echo $val['fu_base']['weixin_timeline'];}?></p>
                                        <span class="share_s wx_timeline<?php if($val['fu_base']['weixin_timeline'] >= $val['base']['weixin_timeline']){echo '_liang';}?>"></span>
                                        <p><?php if($val['base']['weixin_timeline']){echo $val['base']['weixin_timeline'];}?></p>
                                    </div>
                                    <div class="share_d">
                                        <p><?php if($val['fu_base']['sqq']){echo $val['fu_base']['sqq'];}?></p>
                                        <span class="share_s sqq<?php if($val['fu_base']['sqq'] >= $val['base']['sqq']){echo '_liang';}?>"></span>
                                        <p><?php if($val['base']['sqq']){echo $val['base']['sqq'];}?></p>
                                    </div>
                                    <div class="share_d">
                                        <p><?php if($val['fu_base']['qzone']){echo $val['fu_base']['qzone'];}?></p>
                                        <span class="share_s qzone<?php if($val['fu_base']['qzone'] >= $val['base']['qzone']){echo '_liang';}?>"></span>
                                        <p><?php if($val['base']['qzone']){echo $val['base']['qzone'];}?></p>
                                    </div>
                                    <div class="share_d">
                                        <p><?php if($val['fu_base']['tsina']){echo $val['fu_base']['tsina'];}?></p>
                                        <span class="share_s weibo<?php if($val['fu_base']['tsina'] >= $val['base']['tsina']){echo '_liang';}?>"></span>
                                        <p><?php if($val['base']['tsina']){echo $val['base']['tsina'];}?></p>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th class="tr_margin" style="height:16px;background:#fff;" colspan="8"></th>
                        </tr>
                    </tbody>
                <?php endforeach;?>
            <?php } else { ?>
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
        <div class="flip page clearfix">
            <p>
                <?=$page_nav?>
            </p>
        </div>
    </div>

</div>
</div>
</div>
</div>
</div>
</div>

<script>
    $(function () {
        var _TimeCountDown = $(".fnTimeCountDown");
        _TimeCountDown.fnTimeCountDown();
        $('#query_start_date').datetimepicker({
            controlType: 'select',
            timepicker:false,
            format:'Y-m-d'
        });

        $('#query_end_date').datetimepicker({
            controlType: 'select',
            timepicker:false,
            format:'Y-m-d'
        });

        $("a.btn-search").on("click",function(){
            $("#search_form").submit();
        });
    })

</script>
  
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
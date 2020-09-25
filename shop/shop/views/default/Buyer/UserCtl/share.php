<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
    <div class="aright">
        <div class="member_infor_content">
            <div class="tabmenu">
                <ul class="tab">
                    <li class="active"><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Share&met=index"><?=_('我的分享')?></a></li>
                </ul>
            </div>
            <div class="order_content">
                <div class="order_content_title clearfix">
                    <form method="get" id="search_form" action="index.php" >
                        <input type="hidden" name="ctl" value="<?=$_GET['ctl']?>">
                        <input type="hidden" name="met" value="<?=$_GET['met']?>">
                        <p class="order_types">
                            <a <?php if($status == ''):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_User&met=share"><?=_('全部分享')?></a>
                            <a <?php if($status == 'wait_pay'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_User&met=share&status=wait_pay"><?=_('待付款')?></a>
                            <a <?php if($status == 'wait_confirm_goods'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_User&met=share&status=wait_confirm_goods"><?=_('待收货')?></a>
                            <a <?php if($status == 'finish'):?>class="currect"<?php endif;?> href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_User&met=share&status=finish"><?=_('已完成')?></a>
                        </p>

                        <p class="order_time">
                            <span><?=_('分享时间')?></span>
                            <input type="text" autocomplete="off" placeholder="开始时间" name="start_date" id="start_date" class="text w70" value="<?=@$_GET['start_date']?>">
                            <label class="add-on">
                                <i class="iconfont icon-rili"></i>
                            </label>
                            <em style="margin-top: 3px;">&nbsp;– &nbsp;</em>
                            <input type="text" placeholder="结束时间" autocomplete="off" name="end_date" id="end_date" class="text w70" value="<?=@$_GET['end_date']?>">
                            <label class="add-on">
                                <i class="iconfont icon-rili"></i>
                            </label>

                        </p>
                        <p class="ser_p" style="margin-left: 10px;">
                            <input type="text" name="orderkey" placeholder="<?=_('分享号')?>" value="<?=@$_GET['orderkey']?>">
                            <a class="btn_search_goods" href="javascript:void(0);" style="padding-left: 2px;"><i class="iconfont icon-icosearch icon_size18" style="margin-right:-2px; "></i><?=_('搜索')?></a>
                        </p>

                        <script type="text/javascript">
                            $("a.btn_search_goods").on("click",function(){
                                $("#search_form").submit();
                            });
                        </script>
                    </form>
                </div>
                <table>
                    <tbody class="tbpad">
                    <tr class="order_tit">
                        <th class="widt1"><?=_('商品')?></th>
                        <th class="widt1"><?=_('立减价')?></th>
                        <th class="widt2"><?=_('交易状态')?></th>
                        <th class="widt2"><?=_('分享金/次点击')?></th>
                        <th class="widt2"><?=_('分享金小计')?></th>
                        <th class="widt2"><?=_('分享立减')?></th>
                        <th class="widt6"><?=_('分享')?></th>
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
                                        <time><?=($val['share_date_str'])?></time>
                                        <span><?=_('分享号：')?><strong><?=($val['share_num'])?></strong></span>
                                        <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&id=<?=($val['shop_id'])?>"><i class="iconfont icon-icoshop"></i><?=($val['shop_name'])?></a>
                                    </p>
                                </th>
                            </tr>

                            <tr>
                                <td class="share_goods td_rborder">
                                    <img src="<?=image_thumb($val['goods_image'],50,50)?>"/>

                                    <a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($val['goods_id'])?>"><?=($val['goods_name'])?></a>
                                </td>
                                <td class="td_rborder ">
                                    <del><?=format_money($val['goods_price']); ?></del>
                                    <p><?=format_money($val['promotion_price']); ?></p>
                                </td>
                                <td class="td_rborder ">
                                    <p><?=($val['order_status'])?></p>
                                    <p><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&act=details&order_id=<?=($val['share_order_id'])?>"><?=_('订单详情')?></a></p>
                                </td>

                                <td class="td_rborder ">
                                    <?=format_money($val['promotion_unit_price'])?>
                                </td>

                                <td class="td_rborder">
                                    <?=format_money($val['share_click_price'])?>
                                </td>
                                <td class="td_rborder">
                                    <?=format_money($val['price'])?>
                                </td>
                                <td class="td_rborder share_list">
                                    <div class="share">
                                        <div class="share_d">
                                            <?php if($val['click_data']['weixin']){ ?>
                                                <span class="share_s wx_single_liang"></span>
                                                <p><?=($val['click_data']['weixin']) ?></p>
                                            <?php }else{ ?>
                                                <span class="share_s wx_single"></span>
                                                <p><a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($val['goods_id'])?>">去分享</a></p>
                                            <?php } ?>
                                        </div>
                                        <div class="share_d">
                                            <?php if($val['click_data']['weixin_timeline']){ ?>
                                                <span class="share_s wx_timeline_liang"></span>
                                                <p><?=($val['click_data']['weixin_timeline']) ?></p>
                                            <?php }else{ ?>
                                                <span class="share_s wx_timeline"></span>
                                                <p><a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($val['goods_id'])?>">去分享</a></p>
                                            <?php } ?>
                                        </div>
                                        <div class="share_d">
                                            <?php if($val['click_data']['sqq']){ ?>
                                                <span class="share_s sqq_liang"></span>
                                                <p><?=($val['click_data']['sqq']) ?></p>
                                            <?php }else{ ?>
                                                <span class="share_s sqq"></span>
                                                <p><a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($val['goods_id'])?>">去分享</a></p>
                                            <?php } ?>
                                        </div>
                                        <div class="share_d">
                                            <?php if($val['click_data']['qzone']){ ?>
                                                <span class="share_s qzone_liang"></span>
                                                <p><?=($val['click_data']['qzone']) ?></p>
                                            <?php }else{ ?>
                                                <span class="share_s qzone"></span>
                                                <p><a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($val['goods_id'])?>">去分享</a></p>
                                            <?php } ?>
                                        </div>
                                        <div class="share_d">
                                            <?php if($val['click_data']['tsina']){ ?>
                                                <span class="share_s weibo_liang"></span>
                                                <p><?=($val['click_data']['tsina']) ?></p>
                                            <?php }else{ ?>
                                                <span class="share_s weibo"></span>
                                                <p><a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($val['goods_id'])?>">去分享</a></p>
                                            <?php } ?>
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
                    <?php }
                    else
                    {
                        ?>
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
                    <p><?=$page_nav?>
                    </p>
                </div>
            </div>
        </div>

        </div>
    </div>


    </div>
    </div>


    <script>
        $(document).ready(function(){
            $('#start_date').datetimepicker({
                controlType: 'select',
                timepicker:false,
                format:'Y-m-d'
            });

            $('#end_date').datetimepicker({
                controlType: 'select',
                timepicker:false,
                format:'Y-m-d'
            });

        });
    </script>

<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
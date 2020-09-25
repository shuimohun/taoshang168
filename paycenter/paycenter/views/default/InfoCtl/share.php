<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<style>
    .w60,.w60 span,.w100,w100 span,.w200,w200 span{text-align: center; margin: 0;padding: 0;}
    .order span {
        line-height: 20px !important;
    }
    .p_head,.pc_trans_det_time{font-size: 0px;}
    .p_head span{font-size: 12px;}
    .pc_trans_det_time span{line-height: 20px;
        display: block;
        font-size: 12px;}
    .pc_trans_time{width: 15%;}
    .pc_trans_other{width: 83%;}
</style>

<div class="bg_pcenter">
    <div class="recharge-content-top content-public clearfix">
        <div class="left">
            <span><?=_('我的分享')?></span>
        </div>
        <div class="right">
            <div class="mg clearfix">
                <p class="splitLine-mg"><?=_('今日到账分享金')?>
                    <a>  <?=format_money($today_total)?></a></a><?=_('元')?>
                    <span class="splitLine">丨</span>
                </p>
                <p class="splitLine-mg"><?=_('冻结分享金')?>
                    <a>  <?=format_money($user_resource['user_share_money_frozen'])?></a></a><?=_('元')?>
                </p>
            </div>
        </div>
    </div>
    <div class="recharge-content-center content-public clearfix">
        <div class="first clearfix">
            <div class="time">
                <a class="acb"><?=_('时间：')?></a>
                <div class="trade_class">
                    <form action="" method="get"  id="search_form" >
                        <input type="hidden" name="ctl" value="Info"/>
                        <input type="hidden" name="met" value="share"/>
                        <input type="hidden" name="time" value="<?php if($time){?>&time=<?=$time?><?php }?>" />
                        <p class="order_time" style="float:left;">
                            <span></span>
                            <input type="text" value="<?=$start_date?>" class="text w70" id="start_date" name="start_date" placeholder="开始时间" autocomplete="off">
                            <label class="add-on">
                                <i class="iconfont icon-rili"></i>
                            </label>
                            <em style="margin-top: 3px;">&nbsp;&ndash; &nbsp;</em>
                            <input type="text" value="<?=$end_date?>" class="text w70" id="end_date" name="end_date" autocomplete="off" placeholder="结束时间">
                            <label class="add-on">
                                <i class="iconfont icon-rili"></i>
                            </label>
                        </p>
                        <a class="button btn_search_goods sous btn btn_active" href="javascript:void(0);">
                            <i class="iconfont icon-btnsearch  icon_size18"></i><?=_('搜索')?></a>
                        <link href="<?= $this->view->css ?>/dateTimePicker.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
                        <script type="text/javascript" src="<?=$this->view->js?>/jquery.datetimepicker.js" charset="utf-8"></script>
                        <script type="text/javascript">
                            $(".sous").on("click", function ()
                            {
                                $("#search_form").submit();
                            });
                            $('#start_date').datetimepicker({
                                controlType: 'select',
                                format: "Y-m-d",
                                timepicker: false
                            });

                            $('#end_date').datetimepicker({
                                controlType: 'select',
                                format: "Y-m-d",
                                timepicker: false
                            });
                            jQuery(function(){
                                jQuery('#start_date').datetimepicker({
                                    format:'Y-m-d',
                                    onShow:function( ct ){
                                        this.setOptions({
                                            maxDate:jQuery('#end_date').val()?jQuery('#end_date').val():false
                                        })
                                    },
                                    timepicker:false
                                });
                                jQuery('#end_date').datetimepicker({
                                    format:'Y-m-d',
                                    onShow:function( ct ){
                                        this.setOptions({
                                            minDate:jQuery('#start_date').val()?jQuery('#start_date').val():false
                                        })
                                    },
                                    timepicker:false
                                });
                            });
                        </script>
                    </form>
                    <div class="day">
                        <a class="splitLine">丨</a> <?=_('最近：')?>
                        <span class="<?php if(empty($time)){?>btn btn_active<?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Info&met=share"><?=_('全部')?></a></span>
                        <span class="<?php if($time==date("Y-m-d",strtotime("-1 month"))){?>btn btn_active<?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Info&met=share&time=<?=date("Y-m-d",strtotime("-1 month"))?>"><?=_('1个月')?></a></span>
                        <span class="<?php if($time==date("Y-m-d",strtotime("-3 month"))){?>btn btn_active<?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Info&met=share&time=<?=date("Y-m-d",strtotime("-3 month"))?>"><?=_('3个月')?></a></span>
                        <span class="<?php if($time==date("Y-m-d",strtotime("-1 year"))){?>btn btn_active<?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Info&met=share&time=<?=date("Y-m-d",strtotime("-1 year"))?>"><?=_('1年')?></a></span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="pc_transaction wrap">

	<div class="pc_table_head clearfix">
		<p class="pc_trans_time"><span><?=_('分享时间')?>&nbsp;|&nbsp;<?=_('分享号')?></span></p>
		<p class="pc_trans_other p_head">
            <span class="w60"><?=_('微信好友')?></span>
            <span class="w60"><?=_('微信朋友圈')?></span>
            <span class="w60"><?=_('QQ好友')?></span>
            <span class="w60"><?=_('QQ空间')?></span>
            <span class="w60"><?=_('新浪微博')?></span>
            <span class="w100"><?=_('分享金/点击')?></span>
            <span class="w100"><?=_('分享金小计')?></span>
            <span class="w200"><?=_('状态')?>&nbsp;|&nbsp;<?=_('交易号')?></span>
            <span class="w200"><?=_('完成时间')?>&nbsp;|&nbsp;<?=_('到账时间')?></span>
            <span class="w60"><?=_('操作')?></span>
		</p>
	</div>
	<?php foreach($data['items'] as $key => $val){ ?>
        <div class="pc_trans_lists clearfix">
            <div class="pc_trans_time pc_trans_det_time">
                <span><?=($val['share_date_str'])?></span>
                <span><?=($val['share_num'])?></span>
            </div>
            <div class="pc_trans_det pc_trans_other">
                <p class="w60">
                    <span>
                        <?php if(isset($val['click_data']['weixin'])) {?>
                            <?=($val['click_data']['weixin'].'次')?>
                        <?php }else{ ?>
                            <?=('0次')?>
                        <?php } ?>
                    </span>
                </p>
                <p class="w60">
                    <span>
                        <?php if(isset($val['click_data']['weixin_timeline'])) {?>
                            <?=($val['click_data']['weixin_timeline'].'次')?>
                        <?php }else{ ?>
                            <?=('0次')?>
                        <?php } ?>
                    </span>
                </p>
                <p class="w60">
                    <span>
                        <?php if(isset($val['click_data']['sqq'])) {?>
                            <?=($val['click_data']['sqq'].'次')?>
                        <?php }else{ ?>
                            <?=('0次')?>
                        <?php } ?>
                    </span>
                </p>
                <p class="w60">
                    <span>
                        <?php if(isset($val['click_data']['qzone'])) {?>
                            <?=($val['click_data']['qzone'].'次')?>
                        <?php }else{ ?>
                            <?=('0次')?>
                        <?php } ?>
                    </span>
                </p>
                <p class="w60">
                    <span>
                        <?php if(isset($val['click_data']['tsina'])) {?>
                            <?=($val['click_data']['tsina'].'次')?>
                        <?php }else{ ?>
                            <?=('0次')?>
                        <?php } ?>
                    </span>
                </p>
                <p class="w100">
                    <span class="textcolor">
                        <?=format_money($val['promotion_unit_price'])?>
                    </span>
                </p>
                <p class="w100">
                    <span class="textcolor">
                        <?=format_money($val['share_click_price'])?>
                    </span>
                </p>
                <p class="w200 order">
                    <span><?=($val['order_status'])?></span>
                    <span>
                        <?php if($val['share_order_id'] != '0') {?>
                            <?=($val['share_order_id'])?>
                        <?php } ?>
                    </span>
                </p>
                <p class="w200 order">
                     <span>
                        <?=($val['order_finished_time'])?>
                    </span>
                    <span>
                        <?=($val['dz_date'])?>
                    </span>
                </p>
                <p class="w60">
                    <a href="" class="cb"><?=_('详情')?></a>
                </p>
            </div>
        </div>
	<?php }?>

    <div style="clear:both"></div>
    <div style="text-align:center;"><div class="page clearfix"><?=$page_nav?></div></div>
    <div style="clear:both"></div>
</div>
</div>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
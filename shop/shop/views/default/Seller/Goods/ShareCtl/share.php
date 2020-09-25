<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<link href="<?= $this->view->css ?>/seller_center.css?ver=<?= VER ?>" rel="stylesheet">
<link href="<?= $this->view->css ?>/base.css?ver=<?= VER ?>" rel="stylesheet">
<link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css?ver=<?=VER?>" rel="stylesheet">
<script src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js" charset="utf-8"></script>
	<style>
        .search-form{color:#999;width:100%;margin-top:10px;border-bottom:solid 1px #E6E6E6}
        .search-form td{text-align:left;padding:8px 0}
        .w240{width:240px}
        .w100{width:100px!important}
        .w160{width:160px}
        .search-form td{text-align:left;padding:8px 0}
        .search-form input[type=text],input.password,input.text,input[type=password]{font:12px/20px Arial;color:#777;background-color:#FFF;vertical-align:top;display:inline-block;height:20px;padding:4px;border:solid 1px #E6E9EE;outline:0 none}
        #skip_off{vertical-align:middle}
        a.ncbtn{height:20px;padding:5px 10px;border-radius:3px}
        a.ncbtn-grapefruit{background-color:#ED5564}
        .tabmenu a.ncbtn{position:absolute;z-index:1;top:-2px;right:0;background-color:#FB6E52}
        .add-on{height:28px}
        a.ncbtn,a.ncbtn-mini{cursor:pointer;line-height:16px;height:16px;padding:3px 7px;border-radius:2px;margin-left:0}
        .search-form input.text{height:20px!important}
        .ncsc-default-table td .goods-name dt .dis_flag{display:inline-block;width:40px;background:red;color:#FFF;font-size:12px;text-align:center}
        .order tbody tr td{vertical-align:middle}
        .order tbody tr .goods_name{vertical-align:top}
        .share p{width:100%;height:20px}
    </style>
</head>
<body>
<form method="get" id="search_form1" action="index.php" >
    <input type="hidden" name="ctl" value="<?=$_GET['ctl']?>">
    <input type="hidden" name="met" value="<?=$_GET['met']?>">
	<table class="search-form">
		<tbody>
		<tr>
			<th>分享时间</th>
			<td class="w240">
				<input type="text" class="text w70 hasDatepicker heigh" placeholder="起始时间" name="query_start_date" id="query_start_date" value="<?=@$_GET['query_start_date']?>" readonly="readonly"><label class="add-on"><i class="iconfont icon-rili"></i></label><span class="rili_ge">–</span>
				<input id="query_end_date" class="text w70 hasDatepicker heigh" placeholder="结束时间" type="text" name="query_end_date" value="<?=@$_GET['query_end_date']?>" readonly="readonly"><label class="add-on"><i class="iconfont icon-rili"></i></label>
			</td>
			<th>订单编号</th>
			<td class="w160">
				<input type="text" class="text w150 heigh" placeholder="请输入订单编号" id="order_sn" name="order_sn" value="<?=@$_GET['order_sn']?>"></td>
			<td class="w70 tc"><a onclick="javascript:void(0);" class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i>搜索</a>

			</td>
			<td class="mar"><a class="button refresh" onclick="location.reload()"><i class="iconfont icon-huanyipi"></i></a><td>
            <script type="text/javascript">
                $("a.btn_search_goods").on("click",function(){
                    $("#search_form1").submit();
                });
            </script>
		</tr>
		</tbody>
	</table>
</form>

<table class="ncsc-default-table order ncsc-default-table2">
	<thead>
	<tr>
		<th class="w10"></th>
		<th colspan="2">商品</th>
		<th class="w100">立减价</th>
		<th class="w100">交易状态</th>
		<th class="w100">分享金/次点击</th>
		<th class="w100">分享金小计</th>
		<th class="w300">分享点击(次)</th>
	</tr>
	</thead>

	<?php if ( !empty($data['items']) ) { ?>
        <?php foreach ( $data['items'] as $key => $val ) { ?>
            <tbody>
                <tr>
                    <td colspan="20" class="sep-row"></td>
                </tr>
                <tr>
                    <th colspan="20">
                        <span class="ml10">分享编号：<em><?= $val['share_num']; ?></em></span>
                        <span>分享时间：<em class="goods-time"><?= date('Y-m-d H:i:s',$val['share_date']) ?></em></span>
                        <span>分享人：<em class="goods-time"><?= $val['user_name'] ?></em></span>
                    </th>
                </tr>

                <tr>
                    <td class="bdl"></td>
                    <td class="w70">
                        <div class="ncsc-goods-thumb">
                            <?php if($val['common_id']){?>
                            <a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&cid=<?=($val['common_id'])?>">
                            <?php }else if($val['b_id']){?>
                            <a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=bundling&bid=<?=($val['b_id'])?>">
                            <?php }?>
                            <img src="<?=image_thumb($val['goods_image'],50,50)?>"/>
                            </a>
                        </div>
                    </td>
                    <td class="tl goods_name">
                        <dl class="goods-name">
                            <dt>
                                <?php if($val['common_id']){?>
                                    <a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&cid=<?=($val['common_id'])?>">
                                <?php }else if($val['b_id']){?>
                                    <a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=bundling&bid=<?=($val['b_id'])?>">
                                <?php }?>
                                    <?=($val['goods_name'])?>
                                </a>
                            </dt>
                        </dl>
                    </td>
                    <td class="bdl">
                        <del><?=format_money($val['goods_price']); ?></del>
                        <p><?=format_money($val['goods_price']-$val['price']); ?></p>
                    </td>
                    <td class="bdl bdr">
                        <!-- 订单查看 -->
                        <p><?= $val['order_status_str']; ?></p>
                        <?php if($val['order_status'] >= 1){?>
                            <p><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Trade_Order&met=physicalInfo&o&typ=e&order_id=<?=($val['share_order_id'])?>"><?=_('订单详情')?></a></p>
                        <?php }?>
                    </td>
                    <td class="bdl">
                        <?=format_money($val['promotion_unit_price'])?>
                    </td>
                    <td class="bdl">
                        <?=format_money($val['promotion_unit_price']*$val['promotion_click_count'])?>
                    </td>

                    <td class="bdl bdr share_list">
                        <div class="share">
                            <div class="share_d">
                                <p><?php if($val['share_base']['weixin']){echo $val['share_base']['weixin'];}?></p>
                                <span class="share_s wx_single<?php if($val['click_data']['weixin']){echo '_liang';}?>"></span>
                                <p><?php if($val['click_data']['weixin']){echo $val['click_data']['weixin'];}?></p>
                            </div>
                            <div class="share_d">
                                <p><?php if($val['share_base']['weixin_timeline']){echo $val['share_base']['weixin_timeline'];}?></p>
                                <span class="share_s wx_timeline<?php if($val['click_data']['weixin_timeline']){echo '_liang';}?>"></span>
                                <p><?php if($val['click_data']['weixin_timeline']){echo $val['click_data']['weixin_timeline'];}?></p>
                            </div>
                            <div class="share_d">
                                <p><?php if($val['share_base']['sqq']){echo $val['share_base']['sqq'];}?></p>
                                <span class="share_s sqq<?php if($val['click_data']['sqq']){echo '_liang';}?>"></span>
                                <p><?php if($val['click_data']['sqq']){echo $val['click_data']['sqq'];}?></p>
                            </div>
                            <div class="share_d">
                                <p><?php if($val['share_base']['qzone']){echo $val['share_base']['qzone'];}?></p>
                                <span class="share_s qzone<?php if($val['click_data']['qzone']){echo '_liang';}?>"></span>
                                <p><?php if($val['click_data']['qzone']){echo $val['click_data']['qzone'];}?></p>
                            </div>
                            <div class="share_d">
                                <p><?php if($val['share_base']['tsina']){echo $val['share_base']['tsina'];}?></p>
                                <span class="share_s weibo<?php if($val['click_data']['tsina']){echo '_liang';}?>"></span>
                                <p><?php if($val['click_data']['tsina']){echo $val['click_data']['tsina'];}?></p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </td>

                </tr>
            </tbody>
        <?php } ?>
	<?php } ?>
</table>

<?php if ( empty($data['items']) ) { ?>
<div class="no_account">
	<img src="<?=$this->view->img?>/ico_none.png">
	<p>暂无符合条件的数据记录</p>
</div>
<?php } ?>
<div class="page">
	<?= $page_nav ?>
</div>

<script>
    $(document).ready(function(){
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

    });
</script>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

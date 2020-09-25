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
			<th>状态</th>
			<td class="w160">
                <select id="fu_status" name="fu_status" class="w120 vt valid">
                    <option value="0"><?=_('请选择')?></option>
                    <?php  foreach(Fu_RecordModel::$status_array_map as $key=>$value){ ?>
                        <option value="<?=$key?>" <?php if(isset($fu_status) && $fu_status == $key){echo 'selected';}?>><?=$value?></option>
                    <?php } ?>
                </select>
            </td>
			<td class="w70 tc">
                <a onclick="javascript:void(0);" class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i>搜索</a>
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

<?php if ( !empty($data['items']) ) { ?>
    <table class="ncsc-default-table order ncsc-default-table2">
        <thead>
        <tr>
            <th class="w10"></th>
            <th colspan="2">商品</th>
            <th class="w100">商品价格</th>
            <th class="w100">购买价格</th>
            <th class="w100">状态</th>
            <th class="w300">分享数据</th>
        </tr>
        </thead>
        <?php foreach ( $data['items'] as $key => $val ) { ?>
            <tbody>
                <tr>
                    <td colspan="20" class="sep-row"></td>
                </tr>
                <tr>
                    <th colspan="20">
                        <span><em class="goods-time"><?= $val['fu_record_time']?></em></span>
                        <span>用户名：<em class="goods-time"><?= $val['user_name'] ?></em></span>
                    </th>
                </tr>

                <tr>
                    <td class="bdl"></td>
                    <td class="w70">
                        <div class="ncsc-goods-thumb">
                            <a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?=($val['goods_id'])?>">
                            <img src="<?=image_thumb($val['goods_image'],50,50)?>"/>
                            </a>
                        </div>
                    </td>
                    <td class="tl goods_name">
                        <dl class="goods-name">
                            <dt>
                                <a target="_blank"  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?=($val['goods_id'])?>"><?=($val['goods_name'])?></a>
                                <p><?=$val['goods_spec']?></p>
                            </dt>
                        </dl>
                    </td>
                    <td class="bdl">
                        <?=format_money($val['goods_price']); ?>
                    </td>
                    <td class="bdl">
                        <?php if($val['order_goods_amount'] != null){ echo format_money($val['order_goods_amount']);}?>
                    </td>
                    <td class="bdl bdr">
                        <p><?= $val['status_con']; ?></p>
                        <?php if($val['order_id']){?>
                            <p><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Trade_Order&met=physicalInfo&order_id=<?=$val['order_id']?>"><?=_('订单详情')?></a></p>
                        <?php }?>
                    </td>

                    <td class="bdl bdr share_list">
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
        <?php } ?>
    </table>
    <div class="page">
        <?= $page_nav ?>
    </div>
<?php }else{ ?>
    <div class="no_account">
        <img src="<?=$this->view->img?>/ico_none.png">
        <p>暂无符合条件的数据记录</p>
    </div>
<?php } ?>

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

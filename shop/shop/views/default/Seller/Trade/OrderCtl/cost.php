<html>
<head>
	<title>修改订单金额</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?= $this->view->css ?>/resetAddr.css">
	<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js" charset="utf-8"></script>
    <script>
        var SITE_URL = "<?php YLB_Registry::get('url')?>";
    </script>
	<link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
	<script  type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.dialog.js"></script>
	<script type="text/javascript" src="<?=$this->view->js?>/district.js"></script>
	<link type="text/css" rel="stylesheet" href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css">
	<link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
	<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
	<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>


</head>
<style>
    .resAdd-inp div.hidden{display: none;}
    .ncsc-default-table tbody tr{border-bottom: solid 1px #DDD !important;}
    .ncsc-default-table tbody td{padding:10px !important;}
    .ncsc-default-table td a{width: 160px !important;color: #333;text-decoration: none;cursor: pointer; }
    a:hover {color: #e45050;}
    .save_foot{text-align: center;margin-top: 20px;}
    .save_foot .save{margin: 0 auto;}
</style>
<body>
	<div class="reset-address" >
		<form id="form" action="#" method="post" >
            <div class="res-cont">
                <table class="ncsc-default-table order">
                    <thead>
                    <tr>
                        <th colspan="2">商品</th>
                        <th class="w120">单价</th>
                        <th class="w60">数量</th>
                        <th class="w100">重设单价</th>
                    </tr>
                    </thead>
                    <tbody>
                    <input type="hidden" name="order_id" value="<?=$order_id?>">
                    <?php if ( !empty($data) ) { ?>
                        <?php foreach ( $data as $key => $val ) { ?>
                            <tr class="bd-line resAdd-inp">
                                <td class="w50">
                                    <div class="pic-thumb">
                                        <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=snapshot&goods_id=<?= $val['goods_id']?>&order_id=<?= $val['order_id']; ?>">
                                            <img src="<?= $val['goods_image']; ?>">
                                        </a>
                                    </div>
                                </td>
                                <td class="tl">
                                    <dl class="goods-name">
                                        <dt>
                                            <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=snapshot&goods_id=<?= $val['goods_id']?>&order_id=<?= $val['order_id']; ?>"><?= $val['goods_name']; ?></a>
                                        </dt>
                                    </dl>
                                </td>
                                <td>
                                    <p><?= format_money($val['order_goods_payment_amount'])?></p>
                                </td>
                                <td><?= $val['order_goods_num']; ?></td>
                                <td>
                                    <input name="product_id[<?=$val['goods_id']?>]" type="text" value="<?=$val['order_goods_payment_amount']?>" onKeyUp="amount(this)">
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    <!-- S 运费 -->
                    <tr class="bd-line resAdd-inp">
                        <td>&nbsp;</td>
                        <td class="tl">
                            <dl class="goods-name">
                                <dt>
                                    运费
                                </dt>
                            </dl>
                        </td>
                        <td><?= format_money($order_base['order_shipping_fee'])?></p>
                        </td>
                        <td>&nbsp;</td>
                        <td><input name="shipping" type="text" value="<?=$order_base['order_shipping_fee']?>" onKeyUp="amount(this)"></td>
                    </tr>
                    <!-- E 运费 -->

                    </tbody>
                </table>
                <div class="save_foot">
                    <input type="submit" class="save" value="<?=('提交')?>" />
                </div>
            </div>
		</form>
	</div>
</body>
</html>
<script>
	api = frameElement.api;

	function amount(th){
		var regStrs = [
			['^0(\\d+)$', '$1'], //禁止录入整数部分两位以上，但首位为0
			['[^\\d\\.]+$', ''], //禁止录入任何非数字和点
			['\\.(\\d?)\\.+', '.$1'], //禁止录入两个以上的点
			['^(\\d+\\.\\d{2}).+', '$1'] //禁止录入小数点后两位以上
		];
		for(i=0; i<regStrs.length; i++){
			var reg = new RegExp(regStrs[i][0]);
			th.value = th.value.replace(reg, regStrs[i][1]);
		}
	}

	var SITE_URL = "<?php YLB_Registry::get('url')?>";

	var url = SITE_URL+"?ctl=Seller_Trade_Order&met=editCost&typ=json";

	//表单提交
	$('#form').validator({
		ignore: ':hidden',
		theme: 'yellow_right',
		timely: 1,
		stopOnError: false,
		fields: {
			'product_id': 'required;range[0~] ',
			'shipping': 'required;range[0~]',
		},
		valid:function(form){

			var me = this;
			// 提交表单之前，hold住表单，防止重复提交
			me.holdSubmit();

			//表单验证通过，提交表单
			$.ajax({
				url: url,
				data:$("#form").serialize(),
				success:function(a){
					console.info(a);
					if(a.status == 200)
					{
						//添加数据成功，关闭弹出窗之前，刷新列表页面的数据
						parent.location.reload();
						api.close();
					}
					else
					{
						api.close();
						Public.tips.error('<?=('操作失败！')?>');
					}
					// 提交表单成功后，释放hold，如果不释放hold，就变成了只能提交一次的表单
					me.holdSubmit(false);
				},
				error:function ()
				{
					me.holdSubmit(false);
				}

			});
		}

	});
</script>
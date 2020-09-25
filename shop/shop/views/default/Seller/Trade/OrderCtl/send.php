<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<link href="<?= $this->view->css ?>/seller_center.css?ver=<?= VER ?>" rel="stylesheet">
<link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css?ver=<?=VER?>" rel="stylesheet">

<style>
    a.ncbtn-mini {
        line-height: 16px;
        height: 16px;
        padding: 3px 7px;
        border-radius: 2px;
    }

    .tabmenu .tab li {
        vertical-align: top;
        letter-spacing: normal;
        word-spacing: normal;
        display: inline-block;
        margin-right: -1px;
    }

    .tabmenu .tab .active a, .tabmenu .tab .active a:hover {
        padding-bottom: 0px;
        padding-top: 0px;
    }

    a.ncbtn {
        margin: 0px;
    }

</style>
</head>
</body>

<div id="mainContent">
    <style type="text/css">
        .sticky .tabmenu {
            padding: 0;
            position: relative;
        }
    </style>
    <span class="fr mr5"><a href="<?= $print_tpl_url; ?>" class="ncbtn-mini bbc_seller_btns" target="_blank" title="打印运单">打印运单</a></span>
    <div class="">
        <div class="step-title"><em>第一步</em>确认收货信息及交易详情</div>
        <form name="deliver_form" method="POST" id="deliver_form">
            <input type="hidden" value="<?= $data['order_id']; ?>" name="order_id" id="order_id" >
            <table class="ncsc-default-table order deliver">
                <tbody>
                    <tr>
                        <th colspan="20">
                            <a href="index.php?act=store_order&amp;op=order_print&amp;order_id=189" target="_blank" class="fr" title="打印发货单">
                                <i class="print-order"></i>
                            </a>
                            <span class="fr mr30"></span>
                            <span class="ml10 fl ml10">订单编号：<?= $data['order_id']; ?></span>
                            <span class="ml20 fl">下单时间：<em class="goods-time"><?= $data['order_create_time']; ?></em></span>
                        </th>
                    </tr>

                    <!-- S商品列表 -->
                    <?php foreach ($data['goods_list'] as $key => $val) { ?>
                        <tr>
                            <td class="bdl w10"></td>
                            <td class="w50">
                                <div class="pic-thumb">
                                    <a href="<?= $val['goods_link'] ?>" target="_blank"><img src="<?= $val['goods_image']; ?>"></a>
                                </div>
                            </td>
                            <td class="tl">
                                <dl class="goods-name">
                                    <dt>
                                        <a target="_blank" href="<?= $val['goods_link']; ?>"><?= $val['goods_name']; ?></a>
                                    </dt>
                                    <dd><strong>￥<?= $val['order_goods_amount']; ?></strong>&nbsp;x&nbsp;<em><?= $val['order_goods_num']; ?></em>件</dd>
                                    <?php if(isset($val['order_spec_info']) && $val['order_spec_info']){ ?>
                                        <dd><strong>规格：</strong>&nbsp;&nbsp;<em><?= $val['order_spec_info']; ?></em></dd>
                                    <?php }?>
                                </dl>
                            </td>
                            <?php if ( $key == 0 ) { ?>
                            <td class="bdl bdr order-info w500" rowspan="<?= $data['goods_cat_num']; ?>" style="border-bottom:none;">
                                <dl>
                                    <dt>运费：</dt>
                                    <dd><?= $data['shipping_info']; ?></dd>
                                </dl>
                                <dl>
                                    <dt>发货备忘：</dt>
                                    <dd>
                                        <textarea name="deliver_explain" cols="100" rows="2" class="w320 tip-t" title="您可以输入一些发货备忘信息（仅卖家自己可见）"></textarea>
                                    </dd>
                                </dl>
                                 <dl>
                                    <dt>给买家留言：</dt>
                                    <dd>
                                        <textarea name="order_seller_message" cols="100" rows="2" class="w320 tip-t" title="您可以输入一些给买家的留言信息"></textarea>
                                    </dd>
                                </dl>
                            </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <!-- E商品列表 -->

                    <tr>
                        <td colspan="20" class="tl bdl bdr" style="padding:8px" id="address">
                            <strong class="fl">收货人信息：</strong><span id="buyer_address_span"><?= $data['receiver_info']; ?></span>
                            <a href="javascript:void(0)" dialog_id="edit_buyer_address" data-order_receiver_name="<?= $data['order_receiver_name']; ?>" data-order_receiver_address="<?= $data['order_receiver_address']; ?>" data-order_receiver_contact="<?= $data['order_receiver_contact']; ?>" data-order_id="<?= $data['order_id']; ?>" class="ncbtn-mini fr bbc_seller_btns"><i class="icon-edit"></i>编辑</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="step-title mt30"><em>第二步</em>确认发货信息</div>
            <div class="deliver-sell-info">
                <strong class="fl">我的发货信息：</strong>
                <a href="javascript:void(0);" dialog_id="edit_seller_address" data-shop_id="<?= $data['shop_id']; ?>" class="ncbtn-mini fr bbc_seller_btns"><i class="icon-edit"></i>编辑</a>
                <span id="seller_address_span" data-shipper="<?= $data['shipper']; ?>">
                    <?= $data['shipper_info']; ?>
                </span>
            </div>
            <input type="hidden" name="daddress_id" id="daddress_id" value="">
            <div class="step-title mt30"><em>第三步</em>选择物流服务</div>
            <div class="alert alert-success">您可以通过"发货设置-&gt;<a href="<?= $default_express_url; ?>" target="_parent">默认物流公司</a>"添加或修改常用货运物流。免运可切换下方<span class="red">[无需物流运输服务]</span>选项卡并操作。</div>
            <div class="tabmenu">
                <ul class="tab pngFix">
                    <li id="eli1" class="active bbc_seller_bg"><a href="javascript:void(0);" onclick="etab(1)">自行联系物流公司</a></li>
                    <!--<li id="eli2" class="normal"><a href="javascript:void(0);" onclick="etab(2)">无需物流运输服务</a></li>-->
                </ul>
            </div>
            <table class="ncsc-default-table order" id="texpress1">
                <tbody>
                    <tr>
                        <td class="bdl w150">公司名称</td>
                        <td class="w250">物流单号</td>
                        <td class="tc">备忘</td>
                        <td class="bdr w90 tc">操作</td>
                    </tr>
                    <?php foreach ( $express_list as $key => $val) { ?>
                        <tr>
                            <td class="bdl" style="width: 151px;"><?= $val['express_name']; ?></td>
                            <td class="bdl" style="width: 249px;"><input name="shipping_code" type="text" class="text w200 tip-r" title="正确填写物流单号，确保快递跟踪查询信息正确" maxlength="20"></td>
                            <td class="bdl gray"></td>
                            <td class="bdl bdr tc"><a nc_value="<?= $val['express_id']; ?>" href="javascript:void(0);" class="ncbtn bbc_seller_btns">确认</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <table class="ncsc-default-table order" id="texpress2" style="display:none">
                <tbody>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="bdl tr">如果订单中的商品无需物流运送，您可以直接点击确认</td>
                        <td class="bdr tl w400"> <a nc_type="eb" nc_value="e1000" href="javascript:void(0);" class="ncbtn bbc_seller_btns">确认</a></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

<script>

    function etab(t){
        if (t==1){
            $('#eli1').removeClass('normal').addClass('active bbc_seller_bg');
            $('#eli2').removeClass('active bbc_seller_bg').addClass('normal');
            $('#texpress1').css('display','');
            $('#texpress2').css('display','none');
        }else{
            $('#eli1').removeClass('active bbc_seller_bg').addClass('normal');
            $('#eli2').removeClass('normal').addClass('active bbc_seller_bg');
            $('#texpress1').css('display','none');
            $('#texpress2').css('display','');
        }
    }

    $(function () {

        //$('.tabmenu > ul').find('li:lt(8)').remove();

        //选择发货地址
        $('a[dialog_id="edit_seller_address"]').on('click', function () {
            var order_id = $('#order_id').val(),
                shop_id = $(this).data('shop_id'),
                url = SITE_URL + '?ctl=Seller_Trade_Order&met=chooseSendAddress&typ=';

            $.dialog({
                title: '选择发货地址',
                content: 'url: ' + url + 'e&shop_id=' + shop_id,
                height: 400,
                width: 640,
                lock: true,
                drag: false,
                data: { callback: function ( send_address, win ) {

                        $.post(url + 'json&order_id=' + order_id, { send_address: send_address }, function (data) {
                            if ( data.status == 200 ) {
                                $('#seller_address_span').html(send_address.seller_address_span);
                                $("#seller_address_span").data('shipper','1');
                                Public.tips( { content: '设置成功', type: 3 } );
                                win.api.close();
                            } else {
                                Public.tips( { content: '设置失败', type: 1 } );
                            }
                        })
                    }
                }
            })
        });

        //修改收货人信息
        $('a[dialog_id="edit_buyer_address"]').on('click', function () {
            var _this = $(this),
                buyer_address = $('#buyer_address_span').html();
                address_data = _this.data(),
                address_data.order_id = $('#order_id').val();

            $.dialog({
                title: '选择收货地址',
                content: 'url: ' + SITE_URL + '?ctl=Seller_Trade_Order&met=editBuyerAddress&typ=e',
                height: 200,
                width: 550,
                lock: true,
                drag: false,
                data: { address_data: address_data,
                    callback: function ( data ) {
                        $('#buyer_address_span').html(data.receiver_info);
                        _this.data('order_receiver_name', data.order_receiver_name);
                        _this.data('order_receiver_address', data.order_receiver_address);
                        _this.data('order_receiver_contact', data.order_receiver_contact);
                    }
                }
            })
        });

        //提交表单
        $('a[nc_value]').on('click', function () {

            if($("#seller_address_span").data('shipper') != 1){
                Public.tips( {content: '请设置发货地址', type: 1} );
                return;
            }

            var $this = $(this);
            if($this.parents('tr').find('input[name="shipping_code"]').val()==''){
                Public.tips( {content: '请填写物流单号', type: 1} );
            }else {
                send_data = {
                    order_id: $('#order_id').val(),
                    order_shipping_code: $.trim($this.parents('tr').find('input[name="shipping_code"]').val()),
                    order_shipping_express_id: $this.attr('nc_value'),
                    order_shipping_message: $('textarea[name="deliver_explain"]').val(),
                    order_seller_message: $('textarea[name="order_seller_message"]').val()
                };

                $.post(SITE_URL + '?ctl=Seller_Trade_Order&met=send&typ=json', send_data, function (data) {
                    if (data.status == 200) {
                        Public.tips({content: '发货成功', type: 3});
                        window.location.href = SITE_URL + '?ctl=Seller_Trade_Order&met=physical&typ=e';
                    } else {
                        Public.tips({content: '发货失败', type: 1});
                    }
                })
            }
        });

        <?php if ( $data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS ) { ?>
            /* 如果订单已经发货 初始化单据号 */
            var $a = $('a.ncbtn[nc_value="<?= $data['order_shipping_express_id']; ?>"]');
            $a.parents('tr').find('input[name="shipping_code"]').val("<?= $data['order_shipping_code'] ?>");
        <?php } ?>

    })
</script>
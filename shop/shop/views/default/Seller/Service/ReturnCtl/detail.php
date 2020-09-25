<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/seller_center.css" />
    <div class="tabmenu">
        <ul>
            <li class="active bbc_seller_bg">
                <a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Service_Return&met=<?php if ($data['order_goods_id']){echo "goodsReturn\">"._('退货管理');} else{echo "orderReturn\">"._('退款管理');} ?></a>
            </li>
        </ul>
    </div>

    <div class="ncsc-flow-layout" >
        <div class="ncsc-flow-container">
            <div class="title">
                <h3><?=$data['text']?><?=_('服务')?></h3>
            </div>
            <div id="saleRefundReturn">
                <div class="ncsc-flow-step">
                    <dl class="step-first current">
                        <dt><?=_('买家申请')?><?=$data['text']?></dt>
                        <dd class="bg"></dd>
                    </dl>
                    <?php if($data['return_shop_state'] == 1){?>
                        <dl>
                            <dt>
                                <?=('等待商家处理')?><?=$data['text']?>
                            </dt>
                            <dd class="bg"></dd>
                        </dl>
                    <?php }else if($data['return_shop_state'] == 3){?>
                        <dl class="current">
                            <dt>
                                <?=('商家不同意')?><?=$data['text']?>
                            </dt>
                            <dd class="bg"></dd>
                        </dl>
                    <?php }else if($data['return_shop_state'] == 4){?>
                        <dl class="current">
                            <dt>
                                <?=('已完成')?><?=$data['text']?>
                            </dt>
                            <dd class="bg"></dd>
                        </dl>
                    <?php } ?>

                    <?php if($data['return_goods_return']){?>
                        <?php if($data['return_shop_state'] == 2 || $data['return_shop_state'] > 3){?>
                            <dl class="current">
                                <dt><?=('商家同意退货')?></dt>
                                <dd class="bg"></dd>
                            </dl>
                            <dl <?php if ($data['return_shipping_code'] || $data['return_shop_state'] >= 4){echo 'class="current"';} ?>>
                                <dt><?=_('买家')?><?=$data['text']?><?=_('给商家')?></dt>
                                <dd class="bg"></dd>
                            </dl>
                        <?php } ?>
                    <?php } ?>
                    <?php if($data['return_platform_state']){?>
                        <dl class="current">
                            <dt><?=$data['return_platform_state_con']?></dt>
                            <dd class="bg"></dd>
                        </dl>
                    <?php } ?>

                    <?php if($data['return_collect_state']){?>
                        <dl class="current">
                            <dt><?=$data['return_collect_state_con']?></dt>
                            <dd class="bg"></dd>
                        </dl>
                    <?php } ?>

                    <?php if($data['return_recheck_state']){?>
                        <dl class="current">
                            <dt><?=$data['return_recheck_state_con']?></dt>
                            <dd class="bg"></dd>
                        </dl>
                    <?php } ?>
                </div>
                <div class="ncsc-form-default">
                    <h3><?=_('买家')?><?=$data['text']?><?=_('申请')?></h3>
                    <dl>
                        <dt><?=$data['text']?><?=_('编号：')?></dt>
                        <dd><?= $data['return_code'] ?></dd>
                    </dl>
                    <dl>
                        <dt><?=_('申请时间：')?></dt>
                        <dd><?= $data['return_add_time'] ?></dd>
                    </dl>
                    <dl>
                        <dt><?=_('申请人（买家）：')?></dt>
                        <dd><?= $data['buyer_user_account'] ?></dd>
                    </dl>
                    <dl>
                        <dt><?=$data['text']?><?=_('原因：')?></dt>
                        <dd><?= $data['return_reason'] ?></dd>
                    </dl>
                    <dl>
                        <dt><?=$data['text']?><?=_('说明：')?></dt>
                        <dd><?= $data['return_message'] ?></dd>
                    </dl>
                    <?php if ($data['order_goods_id']){ ?>
                        <dl>
                            <dt><?=$data['text']?><?=_('数量：')?></dt>
                            <dd><?= $data['order_goods_num'] ?></dd>
                        </dl>
                    <?php } ?>
                    <dl>
                        <dt><?=$data['text']?><?=_('金额：')?></dt>
                        <dd><?= format_money($data['return_cash']) ?></dd>
                    </dl>
                    <dl>
                        <dt><?=$data['text']?><?=_('佣金金额：')?></dt>
                        <dd><?= format_money($data['return_commision_fee']) ?></dd>
                    </dl>

                    <?php if ($data['return_shop_state']){ ?>
                        <h3><?=_('商家处理结果')?></h3>
                        <dl>
                            <dt><?=_('处理状态：')?></dt>
                            <dd><?=$data['return_shop_state_con']?></dd>
                        </dl>
                        <?php if($data['return_shop_state'] > 1){?>
                            <dl>
                                <dt><?=_('处理时间：')?></dt>
                                <dd><?=$data['return_shop_time']?></dd>
                            </dl>
                            <dl>
                                <dt><?=_('商家备注：')?></dt>
                                <dd><?= $data['return_shop_message'] ?></dd>
                            </dl>
                        <?php } ?>
                    <?php } ?>

                    <?php if($data['return_platform_state']){?>
                        <h3><?=_('平台处理结果')?></h3>
                        <dl class="return_dl">
                            <dt><?=_('处理状态：')?></dt>
                            <dd><?=$data['return_platform_state_con']?></dd>
                        </dl>
                        <dl class="return_dl">
                            <dt><?=_('申诉时间：')?></dt>
                            <dd><?=$data['return_platform_add_time']?></dd>
                        </dl>
                        <?php if($data['return_platform_state'] > 1){?>
                            <dl class="return_dl">
                                <dt><?=_('处理时间：')?></dt>
                                <dd><?=$data['return_platform_time']?></dd>
                            </dl>
                            <dl class="return_dl">
                                <dt><?=_('平台备注：')?></dt>
                                <dd><?= $data['return_platform_message'] ?></dd>
                            </dl>
                        <?php } ?>
                    <?php } ?>

                    <?php if($data['return_collect_state']){?>
                        <h3><?=_('商家收货处理结果')?></h3>
                        <dl class="return_dl">
                            <dt><?=_('物流公司：')?></dt>
                            <dd><?=$data['express_name']?></dd>
                        </dl>
                        <dl class="return_dl">
                            <dt><?=_('物流单号：')?></dt>
                            <dd><?=$data['return_shipping_code']?></dd>
                        </dl>
                        <dl class="return_dl">
                            <dt><?=_('处理状态：')?></dt>
                            <dd><?=$data['return_collect_state_con']?></dd>
                        </dl>
                        <?php if($data['return_collect_state'] != 2){?>
                        <dl class="return_dl">
                            <dt><?=_('不同意原因：')?></dt>
                            <dd><?=$data['collect_disagree_reason']?></dd>
                        </dl>
                        <?php } ?>
                    <?php } ?>

                    <?php if($data['return_recheck_state']){?>
                        <h3><?=_('平台审核处理结果')?></h3>
                        <dl class="return_dl">
                            <dt><?=_('处理状态：')?></dt>
                            <dd><?=$data['return_recheck_state_con']?></dd>
                        </dl>
                        <dl class="return_dl">
                            <dt><?=_('申请时间：')?></dt>
                            <dd><?=$data['return_recheck_add_time']?></dd>
                        </dl>
                        <?php if($data['return_recheck_state'] > 1 && $data['return_recheck_state'] != 4){?>
                            <dl class="return_dl">
                                <dt><?=_('处理时间：')?></dt>
                                <dd><?=$data['return_recheck_time']?></dd>
                            </dl>
                            <dl class="return_dl">
                                <dt><?=_('平台备注：')?></dt>
                                <dd><?= $data['return_recheck_message'] ?></dd>
                            </dl>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($data['return_wait_pass']){ ?>
                        <dl>
                            <form id="form" action="#" method="post">
                                <input type="hidden" name="order_return_id" id="order_return_id" value="<?= $data['order_return_id'] ?>">
                                <dl>
                                    <dt><?=_('处理：')?></dt>
                                    <dd>
                                        <textarea name="return_shop_message" id="return_shop_message" class="textarea_text"></textarea>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt></dt>
                                    <dd>
                                        <input id="handle_submit" type="button" class="button bbc_seller_submit_btns mr10" value="<?=_('同意')?>">
                                        <input id="handle_close" type="button" class="button bbc_seller_submit_btns" value="<?=_('不同意')?>"/>
                                    </dd>
                                </dl>
                            </form>0
                        </dl>
                        <script>
                            $(function () {
                                var ajax_url;
                                $('#form').validator({
                                    ignore: ':hidden',
                                    theme: 'yellow_right',
                                    timely: 1,
                                    stopOnError: false,
                                    fields: {return_shop_message: "required"},
                                    valid: function (form){
                                        $.ajax({
                                            url: ajax_url,
                                            data: $("#form").serialize(),
                                            success: function (a){
                                                if (a.status == 200){
                                                    location.href = SITE_URL + "?ctl=Seller_Service_Return&met=<?php if ($data['order_goods_id']){echo "goodsReturn";}else{echo "orderReturn";}?>";
                                                }else{
                                                    if(a.msg == 'failure'){
                                                        Public.tips.error('<?=_('操作失败！')?>');
                                                    }else{
                                                        Public.tips.error(a.msg);
                                                    }
                                                }
                                            }
                                        });
                                    }
                                }).on("click", "#handle_submit", function (e){
                                    ajax_url = SITE_URL + '?ctl=Seller_Service_Return&met=agreeReturn&typ=json';
                                    $(e.delegateTarget).trigger("validate");
                                }).on("click", "#handle_close", function (e){
                                    ajax_url = SITE_URL + '?ctl=Seller_Service_Return&met=disagreeReturn&typ=json';
                                    $(e.delegateTarget).trigger("validate");
                                });
                            });
                        </script>
                    <?php } ?>

                    <?php if ($data['return_express']){ ?>
                        <h3><?=_('确认收货')?></h3>
                        <?php if ($data['return_shipping_express_id'] && $data['return_shipping_code']){ ?>
                            <dl>
                                <dt><?=_('物流信息：')?></dt>
                                <dd>
                                    <div class="prompt-01 prompt-02"></div>
                                </dd>
                            </dl>
                            <script type="text/javascript" src="<?= $this->view->js_com ?>/jquery.nicescroll.js"></script>
                            <script>
                                $(document).ready(function( ){
                                    $.post(BASE_URL + "/shop/api/logistic.php",{"shipping_code":<?php echo $data['return_shipping_code']?>,"express_id":<?php echo $data['return_shipping_express_id']?>} ,function(da) {
                                        if(da){
                                            $(".prompt-01").html(da);

                                            $(".prompt-01").niceScroll({
                                                cursorcolor: "#666",
                                                cursoropacitymax: 1,
                                                touchbehavior: false,
                                                cursorwidth: "3px",
                                                cursorborder: "0",
                                                cursorborderradius: "3px",
                                                autohidemode: false,
                                                nativeparentscrolling: true
                                            });
                                        }
                                    })
                                });
                            </script>
                        <?php }else{ ?>
                        <dl>
                            <dt><?=_('物流信息：')?></dt>
                            <dd>
                                <?=_('暂无')?>
                            </dd>
                        </dl>
                        <?php } ?>
                        <?php if($data['seller_status']){?>
                            <dl>
                                <form id="form2" action="#" method="post">
                                    <input type="hidden" name="order_return_id" id="order_return_id" value="<?= $data['order_return_id'] ?>">
                                    <input type="hidden" name="collect_disagree_reason" id="collect_disagree_reason" value="">
                                    <dl>
                                        <dt><?=_('处理：')?></dt>
                                        <dd>
                                            <ul>
                                                <li>
                                                    <label class="radio"><input type="radio" name="is_agree_return" value="1" checked="checked">已收到货,并同意退款</label>
                                                </li>
                                                <li>
                                                    <label class="radio"><input type="radio" name="is_agree_return" value="0">不同意退款</label>
                                                </li>
                                            </ul>
                                        </dd>
                                    </dl>
                                    <dl class="collect_disagree_reason" style="display: none;">
                                        <dt><?=_('不同意理由：')?></dt>
                                        <dd>
                                            <select id="express_id">
                                                <option value="1"><?=('未收到货')?></option>
                                                <option value="2"><?=('商品不完整或破损')?></option>
                                                <option value="3"><?=('其他')?></option>
                                            </select>
                                        </dd>
                                    </dl>
                                    <dl class="other_reason" style="display: none;">
                                        <dt><?=_('其他原因：')?></dt>
                                        <dd>
                                            <textarea id="other_reason" class="textarea_text"></textarea>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt></dt>
                                        <dd>
                                            <input id="handle_goods" type="button" class="button button_blue bbc_seller_submit_btns" value="提交">
                                        </dd>
                                    </dl>
                                </form>
                            </dl>
                            <script>
                                $(function () {
                                    var is_agree_return = 1;
                                    $('input[name=is_agree_return]').change(function () {
                                        is_agree_return = $("input[name='is_agree_return']:checked").val();
                                        if(is_agree_return == 0){
                                            $('.collect_disagree_reason').show();
                                        }else{
                                            $('.collect_disagree_reason').hide();
                                        }
                                    });

                                    $('#express_id').change(function () {
                                        if($('#express_id').val() == 3){
                                            $('.other_reason').show();
                                        }else{
                                            $('.other_reason').hide();
                                        }
                                    });

                                    $('#form2').validator({
                                        ignore: ':hidden',
                                        theme: 'yellow_right',
                                        timely: 1,
                                        stopOnError: false,
                                        fields: {},
                                        valid: function (form){
                                            //表单验证通过，提交表单
                                            $.ajax({
                                                url: SITE_URL + '?ctl=Seller_Service_Return&met=agreeGoods&typ=json',
                                                data: $("#form2").serialize(),
                                                success: function (a){
                                                    if (a.status == 200){
                                                        location.href = "./index.php?ctl=Seller_Service_Return&met=<?php if ($data['order_goods_id']){echo "goodsReturn";}else{echo "orderReturn";}?>";
                                                    }else{
                                                        if(a.msg == 'failure'){
                                                            Public.tips.error('<?=_('操作失败！')?>');
                                                        }else{
                                                            Public.tips.error(a.msg);
                                                        }
                                                    }
                                                }
                                            });
                                        }
                                    }).on("click", "#handle_goods", function (e){
                                        if(is_agree_return == 0){
                                            var collect_disagree_reason = '';
                                            if($('#express_id').val() == 3){
                                                collect_disagree_reason = $('#other_reason').val();
                                            }else{
                                                collect_disagree_reason = $('#express_id').find('option:selected').text();
                                            }
                                            if(!collect_disagree_reason){
                                                Public.tips.warning('请输入其他原因！');
                                                return false;
                                            }
                                            $('#collect_disagree_reason').val(collect_disagree_reason);

                                        }

                                        $(e.delegateTarget).trigger("validate");
                                    });
                                })
                            </script>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="ncsc-flow-item">
            <div class="title"><?=_('相关商品交易信息')?></div>
            <?php if ($data['order_goods_id']){ ?>
                <div class="item-goods">
                    <dl>
                        <dt>
                        <div class="ncsc-goods-thumb-mini"><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?= $data['goods']['goods_id'] ?>"> <img
                                    src="<?= $data['order_goods_pic'] ?>"></a></div>
                        </dt>
                        <dd>
                            <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?= $data['goods']['goods_id'] ?>"><?= $data['order_goods_name'] ?></a>
                            <?= format_money($data['order_goods_price']) ?> * <?= $data['order_goods_num'] ?> <font color="#AAA">(<?=_('数量')?>)</font> <span></span>
                        </dd>
                    </dl>
                </div>
            <?php } ?>
            <div class="item-order">
                <dl class="line">
                    <dt><?=_('订单总额：')?></dt>
                    <dd><strong><?= format_money($data['order_amount']) ?></strong></dd>
                </dl>
                <dl class="line">
                    <dt><?=_('订单编号：')?></dt>
                    <dd><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&act=details&order_id=<?= $data['order_number'] ?>"><?= $data['order_number'] ?></a>
                        <a href="javascript:void(0);" class="a"><?=_('更多')?><i class="iconfont icon-iconjiantouxia"></i>
                            <div class="more"><span class="arrow"></span>
                                <ul>
                                    <li><?=_('付款单号：')?><span><?= $data['order']['payment_number'] ?></span></li>
                                    <li><?=_('支付方式：')?><span><?= $data['order']['payment_name'] ?></span></li>
                                    <li><?=_('下单时间：')?><span><?= $data['order']['order_create_time'] ?></span></li>
                                    <li><?=_('付款时间：')?><span><?= $data['order']['payment_time'] ?></span></li>
                                </ul>
                            </div>
                        </a>
                    </dd>
                </dl>

                <dl class="line">
                    <dt><?=_('收货人：')?></dt>
                    <dd><?= $data['order']['order_receiver_name'] ?><a href="javascript:void(0);" class="a"><?=_('更多')?><i class="iconfont icon-iconjiantouxia"></i>
                        <div class="more"><span class="arrow"></span>
                            <ul>
                                <li><?=_('收货地址：')?><span><?= $data['order']['order_receiver_address'] ?></span></li>
                                <li><?=_('联系电话：')?><span><?= $data['order']['order_receiver_contact'] ?></span></li>
                            </ul>
                        </div>
                        </a>
                    </dd>
                </dl>
            </div>
        </div>
    </div>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
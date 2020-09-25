<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>

<?php
include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
<div class="aright">
    <div class="member_infor_content">
        <div class="div_head  tabmenu clearfix">
            <ul class="tab pngFix clearfix">
                <li class="active">
                    <a><?=$data['text']?><?=_('管理')?></a>
                </li>
            </ul>
        </div>
        <div class="ncm-flow-layout" id="ncmComplainFlow">
            <div class="ncm-flow-container">
                <div class="ncm-flow-step" style="text-align: center;">
                    <dl class="step-first current1">
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
                        <dl class="current1">
                            <dt>
                                <?=('商家不同意')?><?=$data['text']?>
                            </dt>
                            <dd class="bg"></dd>
                        </dl>
                    <?php }else if($data['return_shop_state'] == 4){?>
                        <dl class="current1">
                            <dt>
                                <?=('已完成')?><?=$data['text']?>
                            </dt>
                            <dd class="bg"></dd>
                        </dl>
                    <?php } ?>

                    <?php if($data['return_goods_return']){?>
                        <?php if($data['return_shop_state'] == 2 || $data['return_shop_state'] > 3){?>
                            <dl class="current1">
                                <dt><?=('商家同意退货')?></dt>
                                <dd class="bg"></dd>
                            </dl>
                            <dl <?php if ($data['return_shipping_code']){echo 'class="current1"';} ?>>
                                <dt><?=_('买家')?><?=$data['text']?><?=_('给商家')?></dt>
                                <dd class="bg"></dd>
                            </dl>
                        <?php } ?>
                    <?php } ?>

                    <?php if($data['return_platform_state']){?>
                        <dl class="current1">
                            <dt><?=$data['return_platform_state_con']?></dt>
                            <dd class="bg"></dd>
                        </dl>
                    <?php } ?>

                    <?php if($data['return_collect_state']){?>
                        <dl class="current1">
                            <dt><?=$data['return_collect_state_con']?></dt>
                            <dd class="bg"></dd>
                        </dl>
                    <?php } ?>

                    <?php if($data['return_recheck_state']){?>
                        <dl class="current1">
                            <dt><?=$data['return_recheck_state_con']?></dt>
                            <dd class="bg"></dd>
                        </dl>
                    <?php } ?>

                </div>
                <div class="ncm-default-form">
                    <h3><?=_('买家')?><?=$data['text']?><?=_('申请')?></h3>
                    <dl class="return_dl">
                        <dt><?=$data['text']?><?=_('编号：')?></dt>
                        <dd><?= $data['return_code'] ?></dd>
                    </dl>
                    <dl class="return_dl">
                        <dt><?=_('申请时间：')?></dt>
                        <dd><?= $data['return_add_time'] ?></dd>
                    </dl>
                    <dl class="return_dl">
                        <dt><?=$data['text']?><?=_('原因：')?></dt>
                        <dd><?= $data['return_reason'] ?></dd>
                    </dl>
                    <dl class="return_dl">
                        <dt><?=$data['text']?><?=_('备注：')?></dt>
                        <dd><?= $data['return_message'] ?></dd>
                    </dl>
                    <?php if ($data['order_goods_id']){ ?>
                    <dl class="return_dl">
                        <dt><?=$data['text']?><?=_('数量：')?></dt>
                        <dd><?= $data['order_goods_num'] ?></dd>
                    </dl>
                    <?php } ?>
                    <dl class="return_dl">
                        <dt><?=$data['text']?><?=_('金额：')?></dt>
                        <dd><?= format_money($data['return_cash']) ?></dd>
                    </dl>

                    <h3><?=_('商家处理结果')?></h3>
                    <?php if ($data['return_shop_state']){ ?>
                        <dl class="return_dl">
                            <dt><?=_('处理状态：')?></dt>
                            <dd><?=$data['return_shop_state_con']?></dd>
                        </dl>
                        <?php if ($data['return_shop_state'] > 1){ ?>
                            <dl class="return_dl">
                                <dt><?=_('处理时间：')?></dt>
                                <dd><?=$data['return_shop_time']?></dd>
                            </dl>
                            <dl class="return_dl">
                                <dt><?=_('商家备注：')?></dt>
                                <dd><?= $data['return_shop_message'] ?></dd>
                            </dl>
                        <?php }?>
                    <?php }?>

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
                                <dd><?=@$data['return_platform_time']?></dd>
                            </dl>
                            <dl class="return_dl">
                                <dt><?=_('平台备注：')?></dt>
                                <dd><?= $data['return_platform_message'] ?></dd>
                            </dl>
                        <?php } ?>
                    <?php } ?>

                    <?php if($data['return_express']){?>
                        <h3><?=_('退货给商家')?></h3>
                        <?php if($data['return_shipping_code']){ ?>
                            <dl class="return_dl">
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
                        <?php }else{?>
                            <dl>
                                <form id="form" action="#" method="post">
                                    <dl>
                                        <dt><?=_('物流公司：')?></dt>
                                        <dd>
                                            <select id="express_id">
                                                <?php foreach ($data['express'] as $key=>$value){?>
                                                    <option value="<?=$value['express_id']?>"><?=$value['express_name']?></option>
                                                <?php }?>
                                            </select>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><?=_('物流单号：')?></dt>
                                        <dd>
                                            <input name="return_shipping_code" id="return_shipping_code" class="text w200" value="<?= $data['return_shipping_code'] ?>" />
                                        </dd>
                                    </dl>
                                    <dl class="foot">
                                        <dt></dt>
                                        <dd>
                                            <input id="handle_submit" type="button" class="button bbc_seller_submit_btns mr10" value="<?=_('提交')?>">
                                        </dd>
                                    </dl>
                                </form>
                            </dl>
                            <script>
                                $(document).ready(function (){
                                    $('#form').validator({
                                        ignore: ':hidden',
                                        theme: 'yellow_right',
                                        timely: 1,
                                        stopOnError: false,
                                        fields: {return_shipping_code: "required"},
                                        valid: function (form){
                                            //表单验证通过，提交表单
                                            var return_shipping_code = $('#return_shipping_code').val();
                                            var express_id = $('#express_id').val();
                                            $.ajax({
                                                url: SITE_URL + '?ctl=Buyer_Service_Return&met=addReturnShippingCode&typ=json',
                                                data: {'id':<?php echo $data['id'];?>,'return_shipping_code':return_shipping_code,'express_id':express_id},
                                                success: function (a){
                                                    if (a.status == 200){
                                                        history.go(0);
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
                                        $(e.delegateTarget).trigger("validate");
                                    });
                                });
                            </script>
                        <?php }?>
                    <?php } ?>

                    <?php if($data['return_collect_state']){?>
                        <h3><?=_('商家收货处理结果')?></h3>
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

                    <?php if($data['return_plat']){?>
                        <dl>
                            <dt></dt>
                            <dd>
                                <label id="handle_submit" class="submit-border bbc_btns">
                                    <input type="button" value="<?=_('平台申诉')?>" class="submit bbc_btns">
                                </label>
                                <script>
                                    $(function () {
                                        $('#handle_submit').click(function () {
                                            $.ajax({
                                                url:SITE_URL+'?ctl=Buyer_Service_Return&met=addPlat&typ=json',
                                                data:{'id':<?php echo $data['id'];?>},
                                                success:function (data) {
                                                    if(data.status == 200){
                                                        window.location.reload();
                                                    }
                                                }
                                            })
                                        });
                                    })
                                </script>
                            </dd>
                        </dl>
                    <?php }?>

                </div>
            </div>
            <div class="ncm-flow-item">
                <div class="title"><?=_('相关商品交易')?></div>
                <?php if ($data['order_goods_id']){ ?>
                    <div class="item-goods">
                        <dl>
                            <dt>
                                <div class="ncm-goods-thumb-mini">
                                    <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?= $data['goods']['goods_id'] ?>">
                                        <img src="<?= $data['order_goods_pic'] ?>">
                                    </a>
                                </div>
                            </dt>
                            <dd>
                                <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?= $data['goods']['goods_id'] ?>"><?= $data['order_goods_name'] ?></a>
                                <?= format_money($data['order_goods_price']) ?> * <?= $data['goods']['order_goods_num'] ?> <font color="#AAA">(<?=_('数量')?>)</font> <span></span>
                            </dd>
                        </dl>
                    </div>
                <?php } ?>
                <div class="item-order">
                    <dl>
                        <dt><?=_('订单总额：')?></dt>
                        <dd><strong><?= format_money($data['order_amount']) ?></strong></dd>
                    </dl>
                    <dl class="line">
                        <dt><?=_('订单编号：')?></dt>
                        <dd>
                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&act=details&order_id=<?= $data['order_number'] ?>" target="_blank"><?= $data['order_number'] ?> </a><a href="javascript:void(0);" class="a"><?=_('更多')?><i class="iconfont icon-iconjiantouxia"></i>
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
    </div>
</div>


<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
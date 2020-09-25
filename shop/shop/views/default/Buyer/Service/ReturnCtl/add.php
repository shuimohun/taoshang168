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
                        <a><?=$data['text']?></a>
                    </li>
                </ul>
            </div>
            <div class="ncm-flow-layout" id="ncmComplainFlow">
                <div class="ncm-flow-container">
                    <div class="ncm-flow-step" style="text-align: center;">
                        <dl id="state_new" class="step-first current1">
                            <dt><?=_('买家申请')?><?=$data['text']?></dt>
                            <dd class="bg"></dd>
                        </dl>
                        <dl id="state_appeal">
                            <dt><?=_('商家处理')?><?=$data['text']?><?=_('申请')?></dt>
                            <dd class="bg"></dd>
                        </dl>
                        <?php if($data['return_goods']){?>
                            <dl id="state_talk">
                                <dt><?=_('买家')?><?=$data['text']?><?=_('给商家')?></dt>
                                <dd class="bg"></dd>
                            </dl>
                            <dl>
                                <dt><?php if($data['return_goods']){echo _("商家确认收货");}?></dt>
                                <dd class="bg"></dd>
                            </dl>
                        <?php } ?>
                    </div>
                    <div class="ncm-default-form">
                        <h3><?=_('买家')?><?=$data['text']?><?=_('申请')?></h3>
                        <form id="form" action="#" method="post">
                            <dl>
                                <input type="hidden" name="order_id" value="<?= $data['order_id'] ?>">
                                <input type="hidden" name="goods_id" value="<?= $data['goods_id'] ?>">
                                <input type="hidden" name="return_reason" id="return_reason" value="">
                                <dt><?=$data['text']?><?=_('原因：')?></dt>
                                <dd>
                                    <select name="return_reason_id">
                                        <?php foreach($data['reason'] as $v){?>
                                            <option value="<?=$v['order_return_reason_id']?>"><?=$v['order_return_reason_content']?></option>
                                        <?php } ?>
                                    </select>
                                </dd>
                                <?php if ($data['goods_id']){ ?>
                                    <dt><?=_('退货数量：')?></dt>
                                    <dd class="num" style="position: relative;">
                                        <input type="hidden" id="price" value="<?= $data['goods'][0]['order_goods_payment_amount'] ?>">
                                        <a class="<?php if($data['goods'][0]['order_goods_num']==1){echo "no_";}?>reduce numsclick" style="border-right: none;left: 0px;">-</a>
                                        <input id="nums" data-max="<?=($data['goods'][0]['order_goods_num'])?>" name="nums" value="<?=($data['goods'][0]['order_goods_num'])?>" style="text-align:center;border: 1px solid #ccc;width: 30px;height:17px; position: absolute;left: 22px;top: 16px;">
                                        <a class="no_add numsclick" style="border-left: none;left: 54px;">+</a>
                                    </dd>
                                    <dt><?=_('退款金额：')?></dt>
                                    <dd id="return_cash"><?='¥'.number_format($data['return_cash'],2) ?></dd>
                                    <input type="hidden" name="return_cash" id="cash" value="<?= $data['return_cash'] ?>">
                                <?php }else{ ?>
                                    <dt><?=$data['text']?><?=_('金额：')?></dt>
                                    <dd id="return_cash">
                                        <em><?=Web_ConfigModel::value("monetary_unit")?></em>
                                        <input type="text" id="return_cash" class="return_cash" name="return_cash" value="<?=number_format($data['return_cash'],2,'.','')?>">
                                    </dd>
                                <?php } ?>
                                <dt><?=$data['text']?><?=_('说明：')?></dt>
                                <dd><textarea id="return_message" name="return_message" class="w400 textarea_text"></textarea></dd>
                            </dl>
                            <dl class="foot">
                                <dt>&nbsp;</dt>
                                <dd>
                                    <label id="handle_submit" class="submit-border bbc_btns">
                                        <input type="button" value="<?=_('确认提交')?>" class="submit bbc_btns">
                                    </label>
                                </dd>
                            </dl>
                        </form>
                    </div>
                </div>
                <div class="ncm-flow-item">
                    <div class="title"><?=_('相关商品交易')?></div>
                    <div class="item-goods">
                        <?php foreach ($data['goods'] as $v){ ?>
                            <dl>
                                <dt>
                                <div class="ncm-goods-thumb-mini">
                                    <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?= $v['goods_id'] ?>">
                                        <img src="<?= $v['goods_image'] ?>">
                                    </a>
                                </div>
                                </dt>
                                <dd>
                                    <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?= $v['goods_id'] ?>"><?= $v['goods_name'] ?></a>
                                    <?= format_money($v['order_goods_payment_amount']) ?> * <?= $v['order_goods_num'] ?>
                                    <span></span>
                                </dd>
                            </dl>
                        <?php } ?>
                    </div>
                    <div class="item-order">
                        <dl class="line">
                            <dt><?=_('运费：')?></dt>
                            <dd><strong><?= format_money($data['order']['order_shipping_fee']) ?></strong></dd>
                        </dl>
                        <dl class="line">
                            <dt><?=_('付款总额：')?></dt>
                            <dd><strong><?= format_money($data['order']['order_payment_amount']) ?></strong></dd>
                        </dl>
                        <?php if($data['refunding_price']){?>
                            <dl class="line">
                                <dt><?=_('退款中：')?></dt>
                                <dd><strong><?= format_money($data['refunding_price']) ?></strong></dd>
                            </dl>
                        <?php }?>
                        <?php if($data['order']['order_refund_amount'] && $data['order']['order_refund_amount'] > 0){?>
                            <dl class="line">
                                <dt><?=_('已退金额：')?></dt>
                                <dd><strong><?= format_money($data['order']['order_refund_amount']) ?></strong></dd>
                            </dl>
                        <?php }?>
                        <dl class="line">
                            <dt><?=_('订单编号：')?></dt>
                            <dd>
                                <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical&act=details&order_id=<?= $data['order']['order_id'] ?>" target="_blank">
                                    <?= $data['order']['order_id'] ?>
                                <a href="javascript:void(0);" class="a"><?=_('更多')?><i class="iconfont icon-iconjiantouxia"></i>
                                    <div class="more"><span class="arrow"></span>
                                        <ul>
                                            <li><?=_('支付方式：')?><span><?= $data['order']['payment_name'] ?></li>
                                            <li><?=_('下单时间：')?><span><?= $data['order']['order_create_time'] ?></span></li>
                                            <li><?=_('支付时间：')?><span><?= $data['order']['payment_time'] ?></span></li>
                                        </ul>
                                    </div>
                                </a>
                            </dd>
                        </dl>
                        <dl class="line">
                            <dt><?=_('商家：')?></dt>
                            <dd><a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=index&id=<?=$data['order']['shop_id']?>" target="_blank"><?= $data['order']['shop_name'] ?></a></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function (){
                <?php if($data['goods_id']){?>
                    var return_url = SITE_URL + "?ctl=Buyer_Service_Return&met=index&state=2";
                <?php }else{ ?>
                    <?php if($data['order']['order_is_virtual']){?>
                        var return_url = SITE_URL + "?ctl=Buyer_Service_Return&met=index&state=3";
                    <?php }else{ ?>
                        var return_url = SITE_URL + "?ctl=Buyer_Service_Return&met=index";
                    <?php }?>
                <?php }?>

                <?php if($data['goods_id']){?>
                //退货数量+-
                $(".num a").click(function(){
                    var h=$("#nums");
                    if(!$(this).hasClass("no_reduce") && !$(this).hasClass("no_add")){
                        var j=parseInt(h.val(),10)||1;
                        var f=h.attr("data-max");
                        var i=1;
                        if($(this).hasClass("add")&&!$(this).hasClass("no_add")){
                            $(this).prev().prev().removeClass("no_reduce");
                            $(this).prev().prev().addClass("reduce");
                            if(f>i&&j>=f){
                                $(this).removeClass("add");
                                $(this).addClass("no_add");
                            }else{
                                j++;
                            }
                        }else if($(this).hasClass("reduce")&&!$(this).hasClass("no_reduce")){
                            j--;
                            $(this).next().next().removeClass("no_add");
                            $(this).next().next().addClass("add");
                            if(j<=i){
                                $(this).removeClass("reduce");
                                $(this).addClass("no_reduce");
                            }
                        }
                        h.val(j);
                        var price = $("#price").val();
                        var sum = (Math.floor((j*price) * 100) / 100).toFixed(2);
                        if(j == '<?=$data['nums']?>'){
                            sum='<?=number_format($data['return_cash'],2)?>';
                        }
                        $("#return_cash").html('¥'+ sum);
                        $("#cash").val(sum);
                    }
                });

                //退货数量值改变
                $("#nums").change(function (){
                    var h=$(this);
                    var j=this;
                    var k=$(j).val();
                    var f=h.attr("data-max");
                    var i=1;
                    var l=Math.max(Math.min(f,k.replace(/\D/gi,"").replace(/(^0*)/,"")||1),i);
                    $(j).val(l);
                    var g=$(".num a");
                    if(l==f){
                        g.eq(1).removeClass("add");
                        g.eq(1).addClass("no_add");
                        if(l==i)
                        {
                            g.eq(0).removeClass("reduce");
                            g.eq(0).addClass("no_reduce");
                        }else
                        {
                            g.eq(0).removeClass("no_reduce");
                            g.eq(0).addClass("reduce");
                        }
                    }else{
                        if(l<=i){
                            g.eq(0).removeClass("reduce");
                            g.eq(0).addClass("no_reduce");
                            g.eq(1).removeClass("no_add");
                            g.eq(1).addClass("add");
                        }else{
                            g.eq(0).removeClass("no_reduce");
                            g.eq(0).addClass("reduce");
                            g.eq(1).removeClass("no_add");
                            g.eq(1).addClass("add");
                        }
                    }
                    var price = $("#price").val();
                    var sum = (Math.floor((l*price) * 100) / 100).toFixed(2);

                    if(l == '<?=$data['nums']?>'){
                        sum='<?=number_format($data['return_cash'],2)?>';
                    }

                    $("#return_cash").html('¥'+ sum);
                    $("#cash").val(sum);
                });
                <?php }?>

                $('#form').validator({
                    ignore: ':hidden',
                    theme: 'yellow_right',
                    timely: 1,
                    stopOnError: false,
                    rules: {
                        cash: function(element, params){
                            var cash = parseFloat(element.value);
                            if(cash<0 || cash><?=$data['return_cash']?>){
                                return false;
                            }else{
                                return true;
                            }
                        },
                        money: [/^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(.[0-9]{1,2})?$/, '<?=_('请输入金额')?>']
                    },
                    messages: {
                        cash: "<?=_('退款金额不得大于订单金额')?>"
                    },
                    fields: {
                        return_message: 'required',
                        return_cash:'required;cash;money;'
                    },
                    valid: function (form){
                        //表单验证通过，提交表单
                        $.ajax({
                            url: SITE_URL + '?ctl=Buyer_Service_Return&met=addReturn&typ=json',
                            data: $("#form").serialize(),
                            success: function (a){
                                if (a.status == 200){
                                    location.href = return_url;
                                }else{
                                    Public.tips.error('<?=_('操作失败！')?>');
                                }
                            }
                        });
                    }
                }).on("click", "#handle_submit", function (e) {
                    var return_reason = $('select[name=return_reason_id]').find('option:selected').text();
                    $('#return_reason').val(return_reason);
                    $(e.delegateTarget).trigger("validate");
                });
            });
        </script>
    </div>
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>
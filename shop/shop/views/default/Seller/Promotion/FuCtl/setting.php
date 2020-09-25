<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<form id="form" method="post" name="form">
    <div class="form-style">
        <dl>
            <dt><i>*</i><?=_('限制会员免单商品')?>：</dt>
            <dd>
                <input type="text" class="text w50"  name="goods_count" value="<?=$data['goods_count']?>" />
                <span>数量</span>
                <p class="hint"><?=_('限制会员免单商品数量(1-10) 不包含注册活动')?></p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('设定单品送福免单')?>：</dt>
            <dd>
                <input type="text" class="text w50" name="goods_unit_count" value="<?=$data['goods_unit_count']?>"/>
                <span>次数</span>
                <p class="hint"><?=_('0为不限制 不包含注册活动')?></p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('购物满')?>：</dt>
            <dd>
                <input type="text" class="text w50"  name="goods_order_amount" value="<?=$data['goods_order_amount']?>"/>
                <span>元可继续送福免单</span>
                <input type="text" class="text w50"  name="goods_add_count" value="<?=$data['goods_add_count']?>"/>
                <span>商品数量</span>
                <p class="hint"><?=_('不包含注册活动')?></p>
            </dd>
        </dl>
        <dl>
            <dt></dt>
            <dd>
                <input type="hidden" name="act" value="save" />
                <input type="hidden" name="callback" id="callback" value="<?=request_string('callback')?>" />
                <input type="submit" class="button button_red bbc_seller_submit_btns" value="提交" />
            </dd>
        </dl>
    </div>
</form>

<script>
    $(function(){
        $('#form').validator({
            debug:true,
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: true,
            stopOnError: false,
            messages: {
                required: "请填写"
            },
            fields: {
                'goods_count': 'required;integer[+];range[1~10]',
                'goods_unit_count': 'required;integer[+0]',
                'goods_order_amount': 'required;float[+]',
                'goods_add_count': 'required;integer[+];range[1~10]'
            },
            valid: function(form){
                var me = this;
                // 提交表单之前，hold住表单，并且在以后每次hold住时执行回调
                me.holdSubmit(function(){
                    Public.tips.error('正在处理中...');
                });
                $.ajax({
                    url: "index.php?ctl=Seller_Promotion_Fu&met=setting&typ=json",
                    data: $(form).serialize(),
                    type: "POST",
                    success:function(e){
                        if(e.status == 200) {
                            Public.tips.success('操作成功!');
                            if ($('#callback').val()){
                                window.location.href = "index.php?ctl=Seller_Promotion_Fu&met=add";
                            }
                        } else {
                            Public.tips.error('操作失败！');
                        }
                        me.holdSubmit(false);
                    }
                });
            }
        });
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<div class="form-style">
    <form method="post" id="form">
        <dl>
            <dt><?=_('选择快递公司')?>：</dt>
            <dd>
                <select id="code_id" name="waybill_code_id" class="w300"></select>
                <span></span>
                <p class="hint"><?=_('请选择想要添加的快递公司')?></p>
            </dd>
        </dl>
        <dl id="temp">
            <dt><?=_('选择面单模板')?>：</dt>
            <dd>
                <select id="temp_id" name="waybill_temp_id" class="w300"></select>
                <span></span>
                <p class="hint"><?=_('若快递公司未跟您明确说明请勿修改此项，统一默认为第一项')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('电子面单客户号')?>：</dt>
            <dd>
                <input type="text" name="waybill_number" class="text w300"
                value="<?=$data['userBase']['waybill_number'] ?>"/>
                <p class="hint"><?=_('顺丰、EMS(只支持广东省内)、快捷、宅急送、邮政快递包裹、中铁快运、邮政国内标快, 无需申请电子面单客户号即可正常下发订单')?></p>
                <p class="hint"><?=_('请输入正确的账号，否则会影响下单')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('电子面单密码/密钥')?>：</dt>
            <dd>
                <input type="text" name="waybill_passwd" class="text w300" />
                <p class="hint"><?=_('顺丰、EMS(只支持广东省内)、快捷、宅急送、邮政快递包裹、中铁快运、邮政国内标快, 无需申请电子面单客户号即可正常下发订单')?></p>
                <p class="hint"><?=_('修改面单账号密码请从新输入，请输入正确的密码，否则会影响下单')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('月结账号')?>：</dt>
            <dd>
                <input type="text" name="month_code" class="text w300" value="<?=$data['userBase']['month_code'] ?>"/>
                <p class="hint"><?=_('请保证月结号可用，若填写月结号默认下单方式月结')?></p>
                <p class="hint"><?=_('请输入正确的月结号，否则会影响下单')?></p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('打印机名称')?>：</dt>
            <dd>
                <input type="text"  id="printer" name="printer_name" class="text w300" value="<?=$data['userBase']['printer']?>"/>
                <p class="hint"><?=_('必填项，很重要，否则无法下单')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('代收货款卡号')?>：</dt>
            <dd>
                <input type="text" name="customerid" class="text w300" value="<?=$data['userBase']['customerid']?>"/>
                <p class="hint"><?=_('支持代收货款的公司:顺丰、龙邦、速腾、京广、韵达、圆通')?></p>
                <p class="hint"><?=_('若所用快递公司不在上述名单内可不填')?></p>
            </dd>
        </dl>
        <dl>
            <dt></dt>
            <dd>
                <input type="submit" class="button button_blue bbc_seller_submit_btns" value="提交"  />
                <input type="hidden" name="act" value="save" />
                <input type="hidden" name="waybill_id" value="<?=$data['userBase']['waybill_id'] ?>">
            </dd>
        </dl>
    </form>
</div>

<script>
    $(document).ready(function(){
        $("#temp").hide();
        (function(data) {
            var s = '';
            if (data) {
                $.each(data, function(k, v) {
                    s += '<option value="'+v['wex_id']+'">'+v['wex_name']+'</option>';
                });
                if (data[0]['wex_temp'])
                {
                    var xx = '';
                    $.each(data[0]['template'],function(m,n){
                        xx += '<option value="'+m+'">'+n+'</option>'
                    });
                    $('#temp_id').html(xx);
                    $("#temp").show();
                }
            }
            $('#code_id').html(s).change(function() {
                var ss = '';
                var v = this.value;
                if(parseInt(v) != 20){
                    $.each(data, function(kk, vv) {
                        if(parseInt(vv['wex_id']) == parseInt(v)){
                            $.each(vv['template'],function(kkk,vvv){
                                ss += '<option value="'+kkk+'">'+vvv+'</option>';
                            });
                        }
                    });
                    $("#temp").show();
                }else{
                    $("#temp").hide();
                }

                $('#temp_id').html(ss);
            });
        })($.parseJSON('<?=$data['express_cat']?>'));

        $('#form').validator({
            debug:true,
            //ignore: ':hidden',
            theme: 'yellow_right',
            timely: true,
            stopOnError: true,
            rules:{
                noGreaterCodeId:function(element) {
                    var code = $("#code_id").val();
                    if(code == '0'){
                        return '请选择要添加的快递公司！';
                    }
                },
            },
            fields: {
                'waybill_code_id':'required;noGreaterCodeId;',
                'printer_name': 'required;'
            },
            valid: function(form){
                var me = this;
                // 提交表单之前，hold住表单，并且在以后每次hold住时执行回调
                me.holdSubmit(function(){
                    Public.tips.error('正在处理中...');
                });
                $.ajax({
                    url: "index.php?ctl=Seller_Trade_PrintWaybill&met=editWaybillCont&typ=json",
                    data: $(form).serialize(),
                    type: "POST",
                    success:function(e){
                        if(e.status == 200){
                            var data = e.data;
                            Public.tips.success('操作成功!');
                            setTimeout(window.location.href='index.php?ctl=Seller_Trade_PrintWaybill&met=waybillIndex&typ=e',5000);
                            //成功后跳转
                        }else{
                            if(e.msg){
                                Public.tips.error(e.msg);
                            }else {
                                Public.tips.error('操作失败！');
                            }
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

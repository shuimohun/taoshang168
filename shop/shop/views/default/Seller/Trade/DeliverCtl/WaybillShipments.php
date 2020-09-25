<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<div class="form-style">
    <form method="post" id="form">
        <dl>
            <dt><?=_('选择发货的快递')?>：</dt>
            <dd>
                <select id="code_id" name="waybill_code_id" class="w300">
                    <option value="0"><?=_('未选择')?></option>
                </select>
                <span></span>
                <p class="hint"><?=_('请选择发货的快递')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('选择支付方式')?>：</dt>
            <dd>
                <select id="pay_type" name="pay_type" class="w300">
                    <option value="1">现付</option>
                    <option value="2">到付</option>
                    <option value="3">月结</option>
                    <option value="4">三方支付</option>
                </select>
                <span></span>
                <p class="hint"><?=_('请选择支付方式，月结支付请确保已填写月结号')?></p>
            </dd>
        </dl>
        <dl>
            <dt></dt>
            <dd>
                <input type="submit" class="button button_blue bbc_seller_submit_btns" value="提交打印"  />
                <input type="hidden" name="act" value="save" />
            </dd>
        </dl>
    </form>
</div>
<script>
    $(document).ready(function(){
        (function(data) {
            var s = '<option value="0">未选择</option>';
            if (data) {
                $.each(data, function(k, v) {
                    s += '<option value="'+v['waybill_id']+'">'+v['wex_name']+'</option>';
                });
            }
            $('#code_id').html(s);
        })($.parseJSON('<?=$data['waybill_select']?>'));

        var ip = '';
        $.ajaxPrefilter(function (options) {
            if (options.crossDomain && jQuery.support.cors) {
                var http = (window.location.protocol === 'http:' ? 'http:' : 'https:');
                options.url = http + '//cors-anywhere.herokuapp.com/' + options.url;
            }
        });
        $.get('http://www.kdniao.com/External/GetIp.aspx', function (response) {
            ip = response.toString().substring(0,15);
        });

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
                        return '请选择要使用的快递公司！';
                    }
                },
            },
            fields: {
                'waybill_code_id':'required;noGreaterCodeId;'
            },
            valid: function(form){
                var me = this;
                // 提交表单之前，hold住表单，并且在以后每次hold住时执行回调
                me.holdSubmit(function(){
                    Public.tips.error('正在处理中...');
                });
                $.ajax({
                    url: "index.php?ctl=Seller_Trade_PrintWaybill&met=disposeWaybill&typ=json",
                    data: $(form).serialize(),
                    type: "POST",
                    success:function(e){
                        if(e.status == 200){
                            var data = e.data;
                            Public.tips.success('下单成功，打印成功后请关闭打印页面!');

                            if (data.printer_key)
                            {
                                setTimeout(function(){
                                    window.location.href = SITE_URL + '?ctl=Seller_Trade_PrintWaybill&met=build_form&typ=e&printer_key='+data.printer_key + '&ip=' + ip;
                                },2000);

                                /*var form = document.createElement('form');
                                form.action = SITE_URL + '?ctl=Seller_Trade_PrintWaybill&met=build_form&typ=e&printer_key='+data.printer_key + '&ip=' + ip;
                                form.target = '_blank';
                                form.method = 'POST';
                                document.body.appendChild(form);
                                form.submit();

                                setTimeout(function(){
                                    window.location.href = SITE_URL + '?ctl=Seller_Trade_Deliver&met=deliver';
                                },1000);*/
                            }
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


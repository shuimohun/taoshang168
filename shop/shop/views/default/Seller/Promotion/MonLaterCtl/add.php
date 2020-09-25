<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<div class="form-style">
    <form method="post" id="form" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Increase&met=add&typ=e">
        <dl>
            <dt><i>*</i><?=_('活动名称')?>：</dt>
            <dd>
                <input type="text" name="monlater_name" class="text w450"/>
                <p class="hint"><?=_('活动名称将显示在早晚市活动列表中，方便商家管理使用')?>。</p>
            </dd>
        </dl>


        <dl>
            <dt><i>*</i><?=_('早/晚市选择')?>：</dt>
            <dd>
            <ul class="ncsc-form-radio-list">
                <li>
                    <label for="monlater_type_1">
                        <input type="radio" name="monlater_type" value="1" id="monlater_status_1" checked="checked"/><?=_('早市')?>
                        <span class="hint"><?=_('时间10:00-17:00')?>。</span>
                    </label>
                </li>
                <li>
                    <label for="monlater_type_0">
                        <input type="radio" name="monlater_type" value="2" id="monlater_status_2" /><?=_('晚市')?>
                        <span class="hint"><?=_('时间17:00-次日')?>。</span>
                    </label>
                </li>
            </ul>
            </dd>
        </dl>

        <dl>
            <dt></dt>
            <dd>
                <input type="submit" class="button button_blue bbc_seller_submit_btns" value="提交"  />
                <input type="hidden" name="act" value="add" />
            </dd>
        </dl>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $('#form').validator({
            debug:true,
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
            fields: {
                'increase_name': 'required;length[~30]',
            },
            valid: function(form){
                var me = this;
                // 提交表单之前，hold住表单，并且在以后每次hold住时执行回调
                me.holdSubmit(function(){
                    Public.tips.error('正在处理中...');
                });
                $.ajax({
                    url: "index.php?ctl=Seller_Promotion_MonLater&met=addMonLater&typ=json",
                    data: $(form).serialize(),
                    type: "POST",
                    success:function(e){
                        if(e.status == 200)
                        {
                            var data = e.data;
                            Public.tips.success('操作成功!');

                            var dest_url = "index.php?ctl=Seller_Promotion_MonLater&met=index&typ=e&op=manage&id=" + data.monlater_id;//成功后跳转
                            setTimeout(window.location.href = dest_url,5000);

                        }
                        else
                        {
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


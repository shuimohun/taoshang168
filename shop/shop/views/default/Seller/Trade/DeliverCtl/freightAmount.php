<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
</head>
<body>
	
	<!---  BEGIN 免运费额度 --->
	<form id="form" method="post" name="form">
        <div class="form-style">
            <dl>
                <dt><i>*</i><?=_('免运费额度：')?></dt>
                <dd>
                    <input class="text w50" maxlength="5" value="<?=$data['shop_free_shipping']?>" name="free_shipping" type="text">
                    <p class="hint"><?=_('默认为 0，表示不设置免运费额度，大于0表示购买金额超出该值后将免运费。')?></p>
                </dd>
            </dl>
            <dl>
                <dt></dt>
                <dd>
                    <input name="act" value="quota" type="hidden">
                    <input class="button button_red bbc_seller_submit_btns" value="<?=_('保存')?>" type="submit">
                </dd>
            </dl>
        </div>
    </form>

    <!--- 表单验证 --->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#form').validator({
                debug:true,
                ignore: ':hidden',
                theme: 'yellow_right',
                timely: 1,
                stopOnError: false,

                fields: {
                    'free_shipping': 'required;integer[+0]'
                },
				valid: function(form){
					var me = this;
					// 提交表单之前，hold住表单，并且在以后每次hold住时执行回调
					me.holdSubmit(function(){
						Public.tips.error('正在处理中...');
					});
					$.ajax({
						url: "index.php?ctl=Seller_Trade_Deliver&met=freightAmount&op=save&typ=json",
						data: $(form).serialize(),
						type: "POST",
						success:function(e){
							if(e.status == 200)
							{
								Public.tips.success('操作成功!');
								setTimeout('location.href="index.php?ctl=Seller_Trade_Deliver&met=freightAmount&typ=e"',3000);//成功后跳转
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
    <!--- END 表单验证 --->
	<!---  END 免运费额度 --->

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
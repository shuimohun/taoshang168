<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
</head>
<body>

<div>

        <form id="add_form" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Goods_Evaluation&met=addEvaluationExplain&typ=json"  method="post" onsubmit="return submitBtn();">
            <input type="hidden" name="evaluation_goods_id" value="<?=($data['evaluation_goods_id'])?>" id="evaluation_goods_id" />
            <div class="form-style">
                <dl>
                    <dt><i>*</i><?=_('评价内容：')?></dt>
                    <?php Text_Filter::filterWords($data['content']);?>
                    <dd style="width:50%;" id="content"><?=($data['content'])?></dd>
                </dl>
				<?php if(!empty($data['image'])){?>
				<dl>
                    <dt><i><?=_('*')?></i><?=_('评价图片：')?></dt>
                    <dd>
						<?php foreach($data['image_row'] as $imgkey => $imgval){?>
                        <?php if($imgval){?><img src="<?=image_thumb($imgval,60,60)?>"><?php }?>
						<?php }?>
                    </dd>
                </dl>
				<?php }?>
                <dl>
                    <dt><i><?=_('*')?></i><?=_('解释内容：')?></dt>
                    <dd>
                        <?php Text_Filter::filterWords($data['explain_content']);?>
                        <textarea name="con" class="text" style="width:60%;height:100px;" ><?=($data['explain_content'])?></textarea>
                    </dd>
                </dl>
				<?php if($type != 'again'){?>
                <dl>
                    <dt><i><?=_('*')?></i><?=_('状态：')?></dt>
                    <dd>
                        <label ><input type="radio" checked="checked" name="status" value="1" /><?=_('显示')?></label>
                        <label ><input type="radio" <?=( '2' == $data['status']? 'checked="checked"' : '')?> name="status" value="2" /><?=_('置顶')?></label>
                    </dd>
                </dl>
				<?php }?>
                <dl>
                    <dt></dt>
                    <dd><input type="submit" class="button button_red bbc_seller_btns" value="确认提交" /></dd>
                </dl>
            </div>
    </form>
    </div>

<script src="http://malsup.github.io/jquery.form.js"></script>
<script>
    function submitBtn()
    {
        $("#add_form").ajaxSubmit(function(message){
            if(message.status == 200)
            {
                location.href="<?=YLB_Registry::get('url')?>?ctl=Seller_Goods_Evaluation&met=evaluation";
            }
            else
            {
				Public.tips.error('<?=_('操作失败！')?>');
                //alert('操作失败！');
            }
        });
        return false;
    }
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
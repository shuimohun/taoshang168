<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
</head>
<body>
	
	<!---  BEGIN 默认物流公司 --->
	<form method="post" id="form" action="#">		<!-- 这里改为使用ajax传递数据，2016.11.4，hp-->
		
		<input type="hidden" name="act" value="save">
		<table class="table-list-style" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				
				<tr><th colspan="4"><?=_('物流公司')?></th></tr>

                <tr>
				<?php foreach($data['items'] as $key=>$val){ ?>

					<td class="tl">
						<label class="checkbox"><input type="checkbox" <?php if($val['checked']==1) echo "checked"; ?> name="id[]" value="<?=$val['express_id']?>"></label><?=_($val['express_name'])?>
					</td>
				    <?php if(($key+1)%4==0){ ?></tr><tr><?php } ?>

				<?php } ?>

				<tr>
					<td colspan="4"><input class="button button_red bbc_seller_submit_btns" value="<?=_('保存')?>" type="submit"></td>
				</tr>
			
			</tbody>
		</table>
 
    </form>
	<!---  END 默认物流公司 --->
<script type="text/javascript">
	$(document).ready(function(){
		$('#form').validator({
			debug:true,
			ignore: ':hidden',
			theme: 'yellow_right',
			timely: 1,
			stopOnError: false,

			fields: {
				'id[]': 'checked',
			},
			valid: function(form){
				var me = this;
				// 提交表单之前，hold住表单，并且在以后每次hold住时执行回调
				me.holdSubmit(function(){
					Public.tips.error('正在处理中...');
				});
				$.ajax({
					url: "index.php?ctl=Seller_Trade_Deliver&met=express&typ=json&op=save",
					data: $(form).serialize(),
					type: "POST",
					success:function(e){
						if(e.status == 200)
						{
							Public.tips.success('操作成功!');
							setTimeout('location.href="index.php?ctl=Seller_Trade_Deliver&met=express&typ=e"',1000);//成功后跳转
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
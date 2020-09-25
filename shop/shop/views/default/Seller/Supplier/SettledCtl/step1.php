
<?php
include $this->view->getTplPath() . '/' . 'supplier_join_header.php';
?>
<div class="header_line"><span></span></div>
<div class="breadcrumb">
	<span class="icon-home iconfont icon-tabhome"></span>
	<span><a href="index.php"><?=_('首页')?></a></span>
	<span class="arrow iconfont icon-btnrightarrow"></span> <span><?=_('供应商入驻申请')?></span> 
</div>

<div class="main">
	<div class="sidebar">
		<div class="title">
			<h3><?=_('供应商入驻申请')?></h3>
		</div>
		
		<div class="content">
            <dl show_id="99">
				<dt onclick="show_list('99');" style="cursor: pointer;"> <i class="hide"></i><?=_('入驻流程')?></dt>
				<dd style="display: none;">
					<ul>
                        <li><i></i><a href="" target="_blank"><?=_('签署入驻协议')?></a></li>
                        <li><i></i><a href="" target="_blank"><?=_('商家信息提交')?></a></li>
                        <li><i></i><a href="" target="_blank"><?=_('平台审核资质')?></a></li>
                        <li> <i></i><a href="" target="_blank"><?=_('商家缴纳费用')?></a></li>
                        <li> <i></i><a href="" target="_blank"><?=_('店铺开通')?></a></li>
                    </ul>
				</dd>
			</dl>
            
			<dl>
				<dt class="bbc_bg_col"> <i class="hide"></i><?=_('签订入驻协议')?></dt>
			</dl>
			<dl show_id="0">
				<dt onclick="show_list('0');" style="cursor: pointer;"> <i class="show"></i><?=_('提交申请')?></dt>
				<dd style="display: block;">
					<ul>
						<li class=""><i></i><?=_('公司资质信息')?></li>
						<li class=""><i></i><?=_('财务资质信息')?></li>
						<li class=""><i></i><?=_('店铺经营信息')?></li>
					</ul>
				</dd>
			</dl>
			<dl>
				<dt class=""> <i class="hide"></i><?=_('合同签订及缴费')?></dt>
			</dl>
			<dl>
				<dt> <i class="hide"></i><?=_('店铺开通')?></dt>
			</dl>
		</div>
		<div class="title">
			<h3><?=_('平台联系方式')?></h3>
		</div>
		<div class="content">
			<ul>
				<?php 
					$phone = explode(',',Web_ConfigModel::value('setting_phone')); 
					if($phone){
						foreach($phone as $k=>$v)
						{
				?>
                <li><?=_('电话')?><?=($k+1)?>：<?=$v?></li>
					<?php }} ?>
                <li><?=_('邮箱：')?><?=Web_ConfigModel::value('setting_email')?></li>
			</ul>
		</div>
	</div>
	
	<div class="right-layout">
		<div class="joinin-step">
			<ul>
				<li class="step1 current"><span><?=_('签订入驻协议')?></span></li>
				<li class=""><span><?=_('公司资质信息')?></span></li>
				<li class=""><span><?=_('财务资质信息')?></span></li>
				<li class=""><span><?=_('店铺经营信息')?></span></li>
				<li class=""><span><?=_('合同签订及缴费')?></span></li>
				<li class="step6"><span><?=_('店铺开通')?></span></li>
			</ul>
		</div>
		<div class="joinin-concrete">    
			<!-- 协议 -->
			<div id="apply_agreement" class="apply-agreement">
				<div class="title"><h3><?=_('入驻协议')?></h3></div>
				<div class="apply-agreement-content">
					<?php foreach ($shop_help as $key => $value) {?>
					<?=$value['help_info']?>
					<?php }?>
				</div>
				<div class="apple-agreement">
					<input id="input_apply_agreement" name="input_apply_agreement" checked="checked" type="checkbox">
					<label for="input_apply_agreement"><?=_('我已阅读并同意以上协议')?></label>
				</div>
				<div class="bottom"><a id="btn_apply_agreement_next" href="javascript:;" class="btn bbc_btns"><?=_('下一步，填写企业资质信息')?></a></div>
			</div>
			<script type="text/javascript">
				$(document).ready(function(){
					$('#btn_apply_agreement_next').on('click', function() {
						if($('#input_apply_agreement').prop('checked')) {
							window.location.href = "index.php?ctl=Seller_Supplier_Settled&met=index&op=step2";
						} else {
							alert('请阅读并同意协议');
						}
					});
				});
			</script>    
		</div>
	</div>
</div>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
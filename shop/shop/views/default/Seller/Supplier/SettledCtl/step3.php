
<?php
include $this->view->getTplPath() . '/' . 'supplier_join_header.php';
?>
<style>#select_2.hidden,#select_3.hidden{display:none;} .webuploader-pick{line-height:25px;}</style>

<div class="breadcrumb">
	<span class="icon-home iconfont icon-tabhome"></span>
	<span><a href="index.php?ctl=index">首页</a></span> 
	<span class="arrow iconfont icon-btnrightarrow"></span> 
	<span>供应商入驻申请</span> 
</div>
<div class="main">
	<div class="sidebar">
		<div class="title">
			<h3>供应商入驻申请</h3>
		</div>
    <div class="content">
      <dl show_id="99">
        <dt onclick="show_list('99');" style="cursor: pointer;"> <i class="hide"></i>入驻流程</dt>
        <dd style="display:none;">
          <ul>
            <li> <i></i> <a href="" target="_blank">签署入驻协议</a> </li>
            <li> <i></i> <a href="" target="_blank">商家信息提交</a> </li>
            <li> <i></i> <a href="" target="_blank">平台审核资质</a> </li>
            <li> <i></i> <a href="" target="_blank">商家缴纳费用</a> </li>
            <li> <i></i> <a href="" target="_blank">店铺开通</a> </li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt class=""> <i class="hide"></i>签订入驻协议</dt>
      </dl>
      <dl show_id="0">
        <dt onclick="show_list('0');" style="cursor: pointer;"> <i class="show"></i>提交申请</dt>
        <dd>
          <ul>
            <li class=""><i></i>公司资质信息</li>
            <li class="bbc_bg_col"><i></i>财务资质信息</li>
            <li class=""><i></i>店铺经营信息</li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt class=""> <i class="hide"></i>合同签订及缴费</dt>
      </dl>
      <dl>
        <dt> <i class="hide"></i>店铺开通</dt>
      </dl>
    </div>
    <div class="title">
      <h3>平台联系方式</h3>
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
        <li class="step1 current"><span>签订入驻协议</span></li>
        <li class="current"><span>公司资质信息</span></li>
        <li class="current"><span>财务资质信息</span></li>
        <li class=""><span>店铺经营信息</span></li>
        <li class=""><span>合同签订及缴费</span></li>
        <li class="step6"><span>店铺开通</span></li>
      </ul>
    </div>
  
    <div class="joinin-concrete form-style">
<form id="form_company_info" method="post">
    <input name="shop_id" value="<?=$shop_company['shop_id']?>" type="hidden">
    <fieldset>
        <h4><em><i>*</i>表示该项必填</em>开户银行信息</h4>
        <dl>
            <dt><i>*</i>银行开户名：</dt>
            <dd><input class="text w250" name="bank_account_name" type="text" value="<?=@$shop_company['bank_account_name'] ?>"></dd>
        </dl>
        <dl>
            <dt><i>*</i>公司银行账号：</dt>
            <dd><input class="text w250" name="bank_account_number" type="text" value="<?=@$shop_company['bank_account_number'] ?>"></dd>
        </dl>
        <dl>
            <dt><i>*</i>开户银行支行名称：</dt>
            <dd><input class="text w250" name="bank_name" type="text" value="<?=@$shop_company['bank_name'] ?>"></dd>
        </dl>
        <dl>
            <dt>开户银行支行联行号：</dt>
            <dd><input class="text w250" name="bank_code" type="text" value="<?=@$shop_company['bank_code'] ?>"></dd>
        </dl>
        <dl>
            <dt><i>*</i>开户银行支行所在地：</dt>
            <dd>
				<input id="t" name="bank_address" type="hidden" value="<?=@$shop_company['bank_address'] ?>">
				
				<?php if(@$shop_company['bank_address']){ ?>
					<div id="d_1" class="shop_company_address"><?=@$shop_company['bank_address'] ?>&nbsp;&nbsp;<span onclick="sd();" style="cursor:pointer;"><?=_('编辑')?></span></div>
				<?php } ?>
				
            	<div id="d_2"  class="<?php if(@$shop_company['bank_address']) echo 'hidden';?>">
					<select id="select_1" name="select_1" onChange="district(this);">
						<option value="">--请选择--</option>
						<?php foreach($district['items'] as $key=>$val){ ?>
						<option value="<?=$val['district_id']?>|1"><?=$val['district_name']?></option>
						<?php } ?>
					</select>
					<select id="select_2" name="select_2" onChange="district(this);" class="hidden"></select>
					<select id="select_3" name="select_3" onChange="district(this);" class="hidden"></select>
				</div>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i>开户银行许可证电子版：</dt>
            <dd>
                <input class="text w250 mr10" style="float: left;" readonly="readonly" id="bank_licence_electronic" name="bank_licence_electronic" type="text" value="<?=@$shop_company['bank_licence_electronic'] ?>">
                <p  style="float:left; width:70px" id="bank_licence_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>
                <p  style="clear:both" class="hint">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
            </dd>
        </dl>
    </fieldset>
    
    <fieldset>
        <h4><em><i>*</i>表示该项必填</em>税务登记证</h4>
        <dl>
            <dt><i>*</i>税务登记证号：</dt>
            <dd><input class="text w250" name="tax_registration_certificate" type="text" value="<?=@$shop_company['tax_registration_certificate'] ?>"></dd>
        </dl>
        <dl>
            <dt><i>*</i>纳税人识别号：</dt>
            <dd><input class="text w250" name="taxpayer_id" type="text" value="<?=@$shop_company['taxpayer_id'] ?>"></dd>
        </dl>
        <dl>
            <dt><i>*</i>税务登记证号电子版：</dt>
            <dd>
            
            <input class="text w250 mr10" style="float: left;" id="tax_registration_certificate_electronic" name="tax_registration_certificate_electronic" readonly="readonly" type="text" value="<?=@$shop_company['tax_registration_certificate_electronic'] ?>">
            <p style="float:left; width:70px"  id="tax_registration_certificate_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>
            <p  style="clear:both" class="hint">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
            </dd>
        </dl>
    </fieldset>
    <div class="next"><?php if(@$shop_company['shop_status'] == 4){ ?><a href="?ctl=Seller_Supplier_Settled&met=index&op=step2" class="button bbc_btns" href="javascript:void(0);">上一步,填写公司资质信息</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?><a class="button bbc_btns" id="btn_apply_company_next" href="javascript:;">下一步，填写入驻预经营信息</a></div>
</form>    
</div>
  </div>
</div>
<script type="text/javascript" src="<?=$this->view->js_com?>/webuploader.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/upload/upload_image.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<!---  END 新增地址 --->
<script type="text/javascript" src="<?=$this->view->js?>/district.js"></script>
<script type="text/javascript">
$(document).ready(function(){
         var ajax_url = './index.php?ctl=Seller_Supplier_Settled&met=editShopCompany&typ=json';
        $('#form_company_info').validator({
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
            rules: {
              yh:[/^(\d{16}|\d{19})$/,"请填写正确的银行账号"],
            },

            fields: {
                'bank_account_name': 'required;',
                'bank_account_number':'required;integer;',
                'bank_name':'required;',
                'bank_code':'integer;',
                'bank_address':'required;',
                'bank_licence_electronic':'required;',
                'tax_registration_certificate':'required;', 
                'taxpayer_id':'required;', 
                'tax_registration_certificate_electronic':'required;', 
                'select_1':'required;', 
                'select_2':'required;', 
                'select_3':'required;', 

            },
           valid:function(form){
               
                //表单验证通过，提交表单
                $.ajax({
                    url: ajax_url,
                    data:$("#form_company_info").serialize(),
                    success:function(a){
                        if(a.status == 200)
                        {
                           location.href="./index.php?ctl=Seller_Supplier_Settled&met=index&op=step4";
                        }
                        else
                        {
                            alert('操作失败！');
                        }
                    }
                });
            }

        });
})
$('#btn_apply_company_next').click(function() {
		$("#form_company_info").submit();
});
</script> 

 <script>
    //图片上传
    $(function(){


       bank_licence_uploads= new UploadImage({
            thumbnailWidth: 500,
            thumbnailHeight: 500,
            uploadButton: '#bank_licence_upload',
            inputHidden: '#bank_licence_electronic'
        });


        tax_registration_upload = new UploadImage({
            thumbnailWidth: 500,
            thumbnailHeight: 500,
            uploadButton: '#tax_registration_certificate_upload',
            inputHidden: '#tax_registration_certificate_electronic'
        });

    
    })
</script>
    <link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?= VER ?>" rel="stylesheet"
          type="text/css">
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js"
            charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js"
            charset="utf-8"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>

<?php
include $this->view->getTplPath() . '/' . 'supplier_join_header.php';
?>
<style>.select_2.hidden,.select_3.hidden{display: none;}</style>
<div class="breadcrumb">
	<span class="icon-home iconfont icon-tabhome"></span>
	<span><a href="index.php">首页</a></span> 
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
                        <li><i></i><a href="" target="_blank">签署入驻协议</a></li>
                        <li><i></i><a href="" target="_blank">商家信息提交</a></li>
                        <li> <i></i><a href="" target="_blank">平台审核资质</a></li>
                        <li> <i></i><a href="" target="_blank">商家缴纳费用</a></li>
                        <li> <i></i><a href="" target="_blank">店铺开通</a></li>
                    </ul>
				</dd>
			</dl>
                  
			<dl><dt class=""> <i class="hide"></i>签订入驻协议</dt></dl>
			<dl show_id="0">
				<dt onclick="show_list('0');" style="cursor: pointer;"> <i class="show"></i>提交申请</dt>
				<dd>
					<ul>
						<li class="bbc_bg_col"><i></i>公司资质信息</li>
						<li class=""><i></i>财务资质信息</li>
						<li class=""><i></i>店铺经营信息</li>
					</ul>
				</dd>
			</dl>
			<dl><dt class=""> <i class="hide"></i>合同签订及缴费</dt></dl>
			<dl><dt> <i class="hide"></i>店铺开通</dt></dl>
		</div>
		
		<div class="title"><h3>平台联系方式</h3></div>
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
				<li class=""><span>财务资质信息</span></li>
				<li class=""><span>店铺经营信息</span></li>
				<li class=""><span>合同签订及缴费</span></li>
				<li class="step6"><span>店铺开通</span></li>
			</ul>
		</div>
		
		<div class="joinin-concrete">
			<!-- 公司信息 -->
			<div id="apply_company_info" class="apply-company-info">
				<div class="alert">
					<h4>注意事项：</h4>以下所需要上传的电子版资质文件仅支持JPG\GIF\PNG格式图片，大小请控制在1M之内。
				</div>
				<form id="form_company_info"  method="post">
					<table class="all" border="0" cellpadding="0" cellspacing="0">
						<thead>
							<tr><th colspan="2">公司及联系人信息</th></tr>
						</thead>
						<tbody>
							<tr>
								<th><i>*</i>公司名称：</th>
								<td><input name="shop_company_name" class="text w200" type="text" value="<?=@$shop_company['shop_company_name']?>"><span></span></td>
							</tr>
							<tr>
								<th><i>*</i>公司所在地：</th>
								<td>          
									<input type="hidden" name="shop_company_address" id="shop_company_address" class="t" value="<?=@$shop_company['shop_company_address']?>" />	
									<input type="hidden" name="province_id" class="id_1" value="" />
									<input type="hidden" name="city_id" class="id_2" value="" />
									<input type="hidden" name="area_id" class="id_3" value="" />
									
									<?php if(@$shop_company['shop_company_address']){ ?>
										<div id="d_1" class="shop_company_address"><?=@$shop_company['shop_company_address'] ?>&nbsp;&nbsp;<span onclick="show_d('shop_company_address');"><?=_('编辑')?></span></div>
									<?php } ?>
									
									<div id="d_2" class=" <?php if(@$shop_company['shop_company_address']) echo 'hidden';?>">
										<select class="select_1" name="company_1" onChange="district(this);">
											<option value="">--请选择--</option>
											<?php foreach($district['items'] as $key=>$val){ ?>
											<option value="<?=$val['district_id']?>|1"><?=$val['district_name']?></option>
											<?php } ?>
										</select>
										<select class="select_2 hidden" name="company_2" onChange="district(this);" ></select>
										<select class="select_3 hidden" name="company_3" onChange="district(this);" ></select>
									</div>
									<span></span>
								</td>
							</tr>
							
							<tr>
								<th><i>*</i>公司详细地址：</th>
								<td><input name="company_address_detail" value="<?=@$shop_company['company_address_detail']?>" class="text w200" type="text">
								<span></span></td>
							</tr>
							<tr>
								<th><i>*</i>公司电话：</th>
								<td><input name="company_phone" class="text w200" type="text"  value="<?=@$shop_company['company_phone']?>" >
								<span></span></td>
							</tr>
							<tr>
								<th><i>*</i>员工总数：</th>
								<td><input name="company_employee_count" class="text w100" type="text" value="<?=@$shop_company['company_employee_count']?>">
								&nbsp;人 <span></span></td>
							</tr>
							<tr>
								<th><i>*</i>注册资金：</th>
								<td><input name="company_registered_capital" class="text w100" type="text" value="<?=@$shop_company['company_registered_capital']?>">
								&nbsp;万元<span></span></td>
							</tr>
							<tr>
								<th><i>*</i>联系人姓名：</th>
								<td><input name="contacts_name" class="text w200" type="text" value="<?=@$shop_company['contacts_name']?>">
								<span></span></td>
							</tr>
							<tr>
								<th><i>*</i>联系人号码：</th>
								<td><input name="contacts_phone" class="text w200" type="text" value="<?=@$shop_company['contacts_phone']?>">
								<span></span></td>
							</tr>
							<tr>
								<th><i>*</i>联系人邮箱：</th>
								<td><input name="contacts_email" class="text w200" type="text" value="<?=@$shop_company['contacts_email']?>">
								<span></span></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="20">&nbsp;</td>
							</tr>
						</tfoot>
					</table>
					<table class="all" border="0" cellpadding="0" cellspacing="0">
					  <thead>
						<tr>
						  <th colspan="20">营业执照信息（副本）</th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <th><i>*</i>营业执照号：</th>
						  <td><input name="business_id" class="text w200" type="text" value="<?=@$shop_company['business_id']?>">
							<span></span></td>
						</tr>
						<tr>
						  <th><i>*</i>营业执照所在地：</th>
						  <td>
							   <input type="hidden" name="business_license_location" id="business_license_location" class="t" value="<?=@$shop_company['business_license_location']?>" />	
								<input type="hidden" name="province_id" class="id_1" value="" />
								<input type="hidden" name="city_id" class="id_2" value="" />
								<input type="hidden" name="area_id" class="id_3" value="" />
								
								<?php if(@$shop_company['business_license_location']){ ?>
									<div id="d_1" class="business_license_location"><?=@$shop_company['business_license_location'] ?>&nbsp;&nbsp;<span onclick="show_d('business_license_location')"><?=_('编辑')?></span></div>
								<?php } ?>
								
								<div id="d_3"  class="<?php if(@$shop_company['business_license_location']) echo 'hidden';?>">
									<select class="select_1" name="yinye_1" onChange="district(this);">
									<option value="">--请选择--</option>
									<?php foreach($district['items'] as $key=>$val){ ?>
									<option value="<?=$val['district_id']?>|1"><?=$val['district_name']?></option>
									<?php } ?>
									</select>
											<select class="select_2 hidden" name="yinye_2" onChange="district(this);" ></select>
									<select class="select_3 hidden" name="yinye_3" onChange="district(this);" ></select>
								</div>
								<span></span>
							</td>
						</tr>
						<tr>
						  <th><i>*</i>营业执照有效期：</th>
						  <td><input readonly="readonly"  id="start_time"  name="business_licence_start"  class="text w90 hasDatepicker" type="text" value="<?=@$shop_company['business_licence_start']?>"><em><i class="iconfont icon-rili"></i></em>
							<span></span>-
							<input readonly="readonly" id="end_time" name="business_licence_end"    class="text w90 hasDatepicker" type="text" value="<?=@$shop_company['business_licence_end']?>"><em><i class="iconfont icon-rili"></i></em>
							 <span class="block">结束时间不填代表永久。</span></td>
						</tr>
						<tr>
						  <th><i>*</i>营业执照电子版：</th>
						  <td><input  style="float:left;"id="business_logo" readonly="readonly"  name="business_license_electronic" type="text" class="text mr10" value="<?=@$shop_company['business_license_electronic']?>">   <p style="float:left; width:70px" id="business_upload" >上传图片</p>
							<span class="block">请确保图片清晰，文字可辨并有清晰的红色公章。</span>
							</td>
						</tr>
					  </tbody>
					  <tfoot>
						<tr>
						  <td colspan="20">&nbsp;</td>
						</tr>
					  </tfoot>
					</table>
					<table class="all" border="0" cellpadding="0" cellspacing="0">
					  <thead>
						<tr>
						  <th colspan="20">组织机构代码证</th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <th><i>*</i>组织机构代码：</th>
						  <td><input name="organization_code" class="text w200" type="text" value="<?=@$shop_company['organization_code']?>">
							<span></span></td>
						</tr>
						<tr>
						  <th><i>*</i>组织机构代码证电子版：</th>
						  

							  <td><input  style="float:left;"id="organization_logo" readonly="readonly" name="organization_code_electronic" type="text" class="text mr10" value="<?=@$shop_company['organization_code_electronic']?>">   <p style="float:left; width:70px" id="organization_upload" >上传图片</p>
							<span class="block">请确保图片清晰，文字可辨并有清晰的红色公章。</span>
							</td>
						</tr>
					  </tbody>
					  <tfoot>
						<tr>
						  <td colspan="20">&nbsp;</td>
						</tr>
					  </tfoot>
					</table>
					<table class="all" border="0" cellpadding="0" cellspacing="0">
					  <thead>
						<tr>
						  <th colspan="20">一般纳税人证明<em>注：所属企业具有一般纳税人证明时，此项为必填。</em></th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <th class="w150"><i>*</i>一般纳税人证明：</th>
						 
							<td><input  style="float:left;"id="general_logo" readonly="readonly" name="general_taxpayer" type="text" class="text mr10" value="<?=@$shop_company['general_taxpayer']?>" >   <p style="float:left; width:70px" id="general_upload" >上传图片</p>
							<span class="block">请确保图片清晰，文字可辨并有清晰的红色公章。</span>
							</td>
						</tr>
					  </tbody>
					  <tfoot>
						<tr>
						  <td colspan="20">&nbsp;</td>
						</tr>
					  </tfoot>
					</table>
					<table class="all" border="0" cellpadding="0" cellspacing="0">
					  <thead>
						<tr>
						  <th colspan="20">其他证明<em>注：食品安全证等，此项为非必填。</em></th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <th class="w150">其他证明1：</th>
							<?php @$other_image = explode(',',$shop_company['company_apply_image']); ?>
							<td><input  style="float:left;"id="other_image1" readonly="readonly" name="other_image[]" type="text" class="text mr10" value="<?=@$other_image[0]?>">   <p style="float:left; width:70px;height:30px !important;" id="other_upload1" >上传图片</p>
							<span class="block">请确保图片清晰，文字可辨并有清晰的红色公章。</span>
							</td>
						</tr>
						<tr>
						  <th class="w150">其他证明2：</th>
						 
							<td><input  style="float:left;"id="other_image2" readonly="readonly" name="other_image[]" type="text" class="text mr10" value="<?=@$other_image[1]?>">   <p style="float:left; width:70px;height:30px !important;" id="other_upload2" >上传图片</p>
							<span class="block">请确保图片清晰，文字可辨并有清晰的红色公章。</span>
							</td>
						</tr>
						<tr>
						  <th class="w150">其他证明3：</th>
						 
							<td><input  style="float:left;"id="other_image3" readonly="readonly" name="other_image[]" type="text" class="text mr10" value="<?=@$other_image[2]?>">   <p style="float:left; width:70px;height:30px !important;" id="other_upload3" >上传图片</p>
							<span class="block">请确保图片清晰，文字可辨并有清晰的红色公章。</span>
							</td>
						</tr>
					  </tbody>
					  <tfoot>
						<tr>
						  <td colspan="20">&nbsp;</td>
						</tr>
					  </tfoot>
					</table>
				</form>
    
				<div class="bottom"><a id="btn_apply_company_next" href="javascript:;" class="btn bbc_btns">下一步，提交财务资质信息</a></div>
			</div>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css?ver=<?= VER ?>" rel="stylesheet"
          type="text/css">
<script type="text/javascript" src="<?=$this->view->js?>/districtTow.js"></script>
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.datetimepicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
         $('#start_time').datetimepicker({
            controlType: 'select',
            format:"Y-m-d",
            timepicker:false,
            
		});

        $('#end_time').datetimepicker({
            controlType: 'select',
             format:"Y-m-d",
             timepicker:false,
             onShow:function( ct ){
			this.setOptions({
				minDate:($('#start_time').val())
				})
			}
        });
 
    
         var ajax_url = './index.php?ctl=Seller_Supplier_Settled&met=addShopCompany&typ=json';
        $('#form_company_info').validator({
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
            rules: {
               tel:[/^[1][0-9]{10}$/,'<?=_('请输入正确的手机号码')?>'],
               zjtel:[/(^0\d{2,3}[-]?\d{5,9}$)|(^[1][0-9]{10}$)/,'<?=_('请输入正确的电话号码')?>'],
               daima:[/^[a-zA-Z0-9]{8}-[a-zA-Z0-9]$/,'<?=_('请输入正确的组织机构代码')?>'],
               times:function(element, params){
                     var start_time = $('#start_time').val();
                     var end_time = $('#end_time').val();
                   if(start_time>end_time && end_time){
                       return '<?=_('不能小于起始时间')?>';
                   }
               }
            },

            fields: {
                'shop_company_name': 'required;',
                'shop_company_address':'required;length[1~40]',
                'company_address_detail':'required;',
                'company_phone':'required;zjtel',
                'company_employee_count':'required;integer[+0]',
                'company_registered_capital':'required;range[10~]',
                'contacts_name':'required;', 
                'contacts_phone':'required;tel', 
                'contacts_email':'required;email', 
                'business_id':'required;', 
                'business_license_location':'required;',
                'business_licence_start':'required;', 
                'business_licence_end':'times;', 
                 'business_license_electronic':'required;', 
                'organization_code':'required;', 
                'organization_code_electronic':'required;',
                'general_taxpayer':'required;', 
            },
           valid:function(form){
                //表单验证通过，提交表单
                $.ajax({
                    url: ajax_url,
                    data:$("#form_company_info").serialize(),
                    success:function(a){
                        if(a.status == 200)
                        {
                           location.href="./index.php?ctl=Seller_Supplier_Settled&met=index&op=step3"; 
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
 <script type="text/javascript" src="<?=$this->view->js_com?>/webuploader.js" charset="utf-8"></script>
 <script type="text/javascript" src="<?=$this->view->js_com?>/upload/upload_image.js" charset="utf-8"></script>
    <link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?= VER ?>" rel="stylesheet"
          type="text/css">
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js"
            charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js"
            charset="utf-8"></script>
 <script>
	function show_d(type)
	{
		if(type == 'shop_company_address')
		{
			$('.shop_company_address').attr('class','hidden');
			$('#d_2').removeClass('hidden');
			$('#shop_company_address').val('');
		}else{
			$('.business_license_location').attr('class','hidden');
			$('#d_3').removeClass('hidden');
			$('#business_license_location').val('');
		}
	}
    //图片上传
    $(function(){

        business_uploads = new UploadImage({
            uploadButton: '#business_upload',
            inputHidden: '#business_logo'
        });

        organization_upload = new UploadImage({
            uploadButton: '#organization_upload',
            inputHidden: '#organization_logo'
        });
        
        general_upload = new UploadImage({
            uploadButton: '#general_upload',
            inputHidden: '#general_logo'
        });
		
		other_upload1 = new UploadImage({
            uploadButton: '#other_upload1',
            inputHidden: '#other_image1'
        });
		other_upload2 = new UploadImage({
            uploadButton: '#other_upload2',
            inputHidden: '#other_image2'
        });
		other_upload3 = new UploadImage({
            uploadButton: '#other_upload3',
            inputHidden: '#other_image3'
        });
    })
</script>
    </div>
  </div>
</div>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
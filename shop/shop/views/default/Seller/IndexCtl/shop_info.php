<!DOCTYPE html>
<html>
<head>
    <title>修改店铺信息</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="renderer" content="webkit|ie-stand|ie-comp" />
    <link href="<?= $this->view->css ?>/joinin.css" rel="stylesheet" type="text/css">
    <link href="<?= $this->view->css ?>/swiper.css" rel="stylesheet" type="text/css">
    <link href="<?= $this->view->css ?>/iconfont/iconfont.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/base.css" />
    <script type="text/javascript" src="<?= $this->view->js_com ?>/jquery.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/nav.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/swiper.min.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/base.js"></script>

    <script type="text/javascript">
        var BASE_URL = "<?=YLB_Registry::get('base_url')?>";
        var SITE_URL = "<?=YLB_Registry::get('url')?>";
        var INDEX_PAGE = "<?=YLB_Registry::get('index_page')?>";
        var STATIC_URL = "<?=YLB_Registry::get('static_url')?>";

        var DOMAIN = document.domain;
        var WDURL = "";
        var SCHEME = "default";
        try
        {
            //document.domain = 'ttt.com';
        } catch (e)
        {
        }

        var SYSTEM = SYSTEM || {};
        SYSTEM.skin = 'green';
        SYSTEM.isAdmin = true;
        SYSTEM.siExpired = false;
    </script>

</head>
<body>
<div class="bgheadr">
    <div class="header">
        <h2 class="header_logo"> <a href="index.php" class="logo"><img src="<?= $web['web_logo']  ?>"></a> </h2>
        <p class="header_p"> <span style="margin-right:10px;">|</span><a href="#"> 修改店铺信息</a></p>
        <ul class="header_menu">
<!--            <li class="current" style="float:right;"> <a href="" class="joinin"> <i></i> 商家入驻申请 </a> </li>-->
            <!--    <li class=""> <a href="" class="faq"> <i></i> 商家帮助指南 </a> </li>-->
        </ul>
    </div>
</div>

<style>.select_2.hidden,.select_3.hidden,.select_4.hidden{display: none;}</style>
<div class="breadcrumb"><span class="icon-home iconfont icon-tabhome"></span><span><a href="index.php">首页</a></span> <span class="arrow iconfont icon-btnrightarrow"></span> <span>修改店铺信息</span> </div>
<div class="main">
  <div class="right-layout" style="width: 998px;">
    <div class="joinin-step">
      <ul>
        <li class="step1 current"><span>公司资质信息</span></li>
        <li class=""><span>财务资质信息</span></li>
        <li class=""><span>店铺经营信息</span></li>
        <li class="step6"><span>提交审核</span></li>
      </ul>
    </div>
    <div class="joinin-concrete">

<!-- 公司信息 -->

<div id="apply_company_info" class="apply-company-info">
  <div class="alert">
    <h4>注意事项：</h4>
    以下所需要上传的电子版资质文件仅支持JPG\GIF\PNG格式图片，大小请控制在1M之内。</div>
  <form id="form_company_info"  method="post">
    <table class="all" border="0" cellpadding="0" cellspacing="0">
      <thead>
        <tr>
          <th colspan="2">公司及联系人信息</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th><i>*</i>公司名称：</th>
          <td><input name="shop_company_name" class="w200" type="text" value="">
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>公司所在地：</th>
          <td>
              
                <input type="hidden" name="shop_company_address" class="t" value="" />	
                <input type="hidden" name="province_id" class="id_1" value="" />
		<input type="hidden" name="city_id" class="id_2" value="" />
		<input type="hidden" name="area_id" class="id_3" value="" />
        <input type="hidden" name="street_id" class="id_4" value="" />
		<div id="d_2">
		    <select class="select_1" name="company_1" onChange="district(this);">
			<option value="">--请选择--</option>
			<?php foreach($district['items'] as $key=>$val){ ?>
			<option value="<?=$val['district_id']?>|1"><?=$val['district_name']?></option>
			<?php } ?>
		    </select>
            <select class="select_2 hidden" name="company_2" onChange="district(this);" ></select>
		    <select class="select_3 hidden" name="company_3" onChange="district(this);" ></select>
            <select class="select_4 hidden" name="company_4" onChange="district(this);" ></select>
		</div>
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>公司详细地址：</th>
          <td><input name="company_address_detail" class="w200" type="text">
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>公司电话：</th>
          <td><input name="company_phone" class="w100" type="text">
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>员工总数：</th>
          <td><input name="company_employee_count" class="w50" type="text">
            &nbsp;人 <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>注册资金：</th>
          <td><input name="company_registered_capital" class="w50" type="text">
            &nbsp;万元<span></span></td>
        </tr>
        <tr>
          <th><i>*</i>联系人姓名：</th>
          <td><input name="contacts_name" class="w100" type="text">
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>联系人号码：</th>
          <td><input name="contacts_phone" class="w100" type="text">
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>联系人邮箱：</th>
          <td><input name="contacts_email" class="w200" type="text">
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
          <td><input name="business_id" class="w200" type="text">
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>营业执照所在地：</th>
          <td>
               <input type="hidden" name="business_license_location" class="t" value="" />	
<!--		<input type="hidden" name="province_id" class="id_1" value="" />
		<input type="hidden" name="city_id" class="id_2" value="" />
		<input type="hidden" name="area_id" class="id_3" value="" />-->
              <div id="d_2">
		    <select class="select_1" name="yingye_1" onChange="district_yingye(this);">
			<option value="">--请选择--</option>
			<?php foreach($district['items'] as $key=>$val){ ?>
			<option value="<?=$val['district_id']?>|1"><?=$val['district_name']?></option>
			<?php } ?>
		    </select>
            <select class="select_2 hidden" name="yingye_2" onChange="district_yingye(this);" ></select>
		    <select class="select_3 hidden" name="yingye_3" onChange="district_yingye(this);" ></select>
		</div>
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>营业执照有效期：</th>
          <td><input readonly="readonly"  id="start_time"  name="business_licence_start"  class="w90 hasDatepicker" type="text" ><em><i class="iconfont icon-rili"></i></em>
            <span></span>-
            <input readonly="readonly" id="end_time" name="business_licence_end"    class="w90 hasDatepicker" type="text" ><em><i class="iconfont icon-rili"></i></em>
             <span class="block">结束时间不填代表永久。</span></td>
        </tr>
        <tr>
          <th><i>*</i>营业执照电子版：</th>
          <td><input  style="float:left;"id="business_logo" readonly="readonly"  name="business_license_electronic" type="text" class="mr10">   <p style="float:left; width:70px" id="business_upload" >上传图片</p>
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
          <td><input name="organization_code" class="w200" type="text">
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>组织机构代码证电子版：</th>
          

              <td><input  style="float:left;"id="organization_logo" readonly="readonly" name="organization_code_electronic" type="text" class="mr10">   <p style="float:left; width:70px" id="organization_upload" >上传图片</p>
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
         
            <td><input  style="float:left;"id="general_logo" readonly="readonly" name="general_taxpayer" type="text" class="mr10">   <p style="float:left; width:70px" id="general_upload" >上传图片</p>
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
    
  <div class="bottom"><a id="btn_apply_company_next" href="javascript:;" class="btn bbc_btns">保存</a><a id="btn_apply_company_next" href="javascript:;" class="btn bbc_btns">提交</a></div>
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
 
    
         var ajax_url = './index.php?ctl=Seller_Shop_Settled&met=addShopCompany&typ=json';
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
                'yingye_1':'required;',
                'yingye_2':'required;',
                'yingye_3':'required;',
                'company_1':'required;',
                'company_2':'required;',
                'company_3':'required;',
                'company_4':'required;'
            },
           valid:function(form){
                //表单验证通过，提交表单
                $.ajax({
                    url: ajax_url,
                    data:$("#form_company_info").serialize(),
                    success:function(a){
                        if(a.status == 200)
                        {
                           location.href="./index.php?ctl=Seller_Shop_Settled&met=index&op=step3"; 
                        }
                        else
                        {
                            if(a.msg){
                                alert(a.msg);
                            }else{
                                alert('操作失败！');
                            }
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
    
    })
</script>
    </div>
  </div>
</div>







<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>

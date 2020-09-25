<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
    <link href="<?= $this->view->css ?>/edinfo.css" rel="stylesheet" type="text/css">
    <link href="<?= $this->view->css ?>/swiper.css" rel="stylesheet" type="text/css">
    <link href="<?= $this->view->css ?>/iconfont/iconfont.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/base.css" />
    <script type="text/javascript" src="<?= $this->view->js_com ?>/jquery.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/nav.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/swiper.min.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/base.js"></script>
    <link href="<?= $this->view->css ?>/seller_center.css?ver=<?=VER?>" rel="stylesheet">
    <style>
        /*.search-input-text{*/
            /*background-color:#2B251F;*/
            /*border:0px;*/
        /*}*/
        body{
            font-size:12px;
        }
    </style>
    <div class="tabmenu">
        <ul>
            <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=category"><?=_('经营类目')?></a></li>
            <?php if($shop['shop_self_support']=="false"){ ?>
                <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=info"><?=_('店铺信息')?></a></li>
                <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=renew"><?=_('续签申请')?></a></li>
                <li class="active bbc_seller_bg"><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=edinfo"><?=_('修改店铺信息')?></a></li>
            <?php } ?>
        </ul>

    </div>
    <div class="main"></div>

    <div class="right-layout">
          <div class="joinin-step">
              <ul>
                  <li class="step1 current"><span>公司资质信息</span></li>
                  <li class="current"><span>财务资质信息</span></li>
                  <li class=""><span>店铺经营信息</span></li>
                  <li class=""><span>合同签订及缴费</span></li>
                  <li class="step6"><span>提交审核</span></li>
              </ul>
          </div>
        <div class="joinin-concrete form-style">
        <form id="form_company_info" method="post">
<!--        <input name="shop_id" value="--><?//=$shop_company['shop_id']?><!--" type="hidden">-->
        <fieldset>
            <h4><em><i>*</i>表示该项必填</em>开户银行信息</h4>
            <dl>
                <dt><i>*</i>银行开户名：</dt>
                <dd><input class="text w250" name="bank_account_name" type="text" value="<?=$shop_company1['bank_account_name']?>"></dd>
            </dl>
            <dl>
                <dt><i>*</i>公司银行账号：</dt>
                <dd><input class="text w250" name="bank_account_number" type="text" value="<?=$shop_company1['bank_account_number']?>"></dd>
            </dl>
            <dl>
                <dt><i>*</i>开户银行支行名称：</dt>
                <dd><input class="text w250" name="bank_name" type="text" value="<?=$shop_company1['bank_name']?>"></dd>
            </dl>
            <dl>
                <dt>开户银行支行联行号：</dt>
                <dd><input class="text w250" name="bank_code" type="text" value="<?=$shop_company1['bank_code']?>"></dd>
            </dl>
            <dl>
                <dt><i>*</i>开户银行支行所在地：</dt>
                <dd><input id="t" name="bank_address" type="hidden">
                    <?php if(@$shop_company1['bank_address']){ ?>
                        <div id="d_1"><span class="dress_box"><?=@$shop_company1['bank_address'] ?></span>&nbsp;&nbsp;<a href="javascript:sd();"><?=('编辑')?></a></div>
                        <input type="hidden" name="bank_address"  value="<?=$shop_company1['bank_address'] ?>"/>
                    <?php } ?>
                    <div id="d_2" class="<?php if(@$shop_company1['bank_address']) echo 'hidden';?>">
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
                    <input class="text w250 mr10" style="float: left;" readonly="readonly" id="bank_licence_electronic" name="bank_licence_electronic" type="text" value="<?=$shop_company1['bank_licence_electronic']?>">
                    <p  style="float:left; width:70px" id="bank_licence_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>
                    <p  style="clear:both" class="hint">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                </dd>
            </dl>
        </fieldset>

        <fieldset>
            <h4><em><i>*</i>表示该项必填</em>税务登记证</h4>
            <dl>
                <dt><i>*</i>税务登记证号：</dt>
                <dd><input class="text w250" name="tax_registration_certificate" type="text" value="<?=$shop_company1['tax_registration_certificate']?>"></dd>
            </dl>
            <dl>
                <dt><i>*</i>纳税人识别号：</dt>
                <dd><input class="text w250" name="taxpayer_id" type="text" value="<?=$shop_company1['taxpayer_id']?>"></dd>
            </dl>
            <dl>
                <dt><i>*</i>税务登记证号电子版：</dt>
                <dd>

                <input class="text w250 mr10" style="float: left;" id="tax_registration_certificate_electronic" name="tax_registration_certificate_electronic" readonly="readonly" type="text" value="<?=$shop_company1['tax_registration_certificate_electronic']?>">
                <p style="float:left; width:70px"  id="tax_registration_certificate_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>
                <p  style="clear:both" class="hint">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                </dd>
            </dl>
        </fieldset>
        <div class="next"><a class="button bbc_btns" id="btn_apply_company_last" href="javascript:;" >上一步</a><a class="button bbc_btns" id="btn_apply_company_next" href="javascript:;">下一步，填写入驻预经营信息</a></div>
    </form>
        </div>
    </div>

<script type="text/javascript" src="<?=$this->view->js_com?>/webuploader.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/upload/upload_image.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<!---  END 新增地址 --->
<script type="text/javascript" src="<?=$this->view->js?>/district.js"></script>
<script type="text/javascript">
$(document).ready(function(){
         var ajax_url = './index.php?ctl=Seller_Shop_Settled&met=editShopCompany&typ=json&shop_id='+<?=$shop['shop_id']?>;
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
                            location.href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=edinfo&op=edinfo";
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
$('#btn_apply_company_last').click(function () {
    location.href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=edinfo&op=edinfo_back";
})
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
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
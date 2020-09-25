
<?php
include $this->view->getTplPath() . '/' . 'join_header.php';
?>

<style>#select_2.hidden,#select_3.hidden{display:none;} .webuploader-pick{line-height:25px;}</style>
<div class="breadcrumb"><span class="icon-home iconfont icon-tabhome"></span><span><a href="index.php?ctl=index"><?=_('首页')?></a></span> <span class="arrow iconfont icon-btnrightarrow"></span> <span><?=_('商家入驻申请')?></span> </div>
<div class="main">
    <div class="sidebar">
        <div class="title">
            <h3><?=_('商家入驻申请')?></h3>
        </div>
        <div class="content">
            <dl show_id="99">
                <dt onclick="show_list('99');" style="cursor: pointer;"> <i class="hide"></i><?=_('入驻流程')?></dt>
                <dd style="display:none;">
                    <ul>
                        <li> <i></i> <a href="" target="_blank"><?=_('签署入驻协议')?></a> </li>
                        <li> <i></i> <a href="" target="_blank"><?=_('商家信息提交')?></a> </li>
                        <li> <i></i> <a href="" target="_blank"><?=_('平台审核资质')?></a> </li>
                        <li> <i></i> <a href="" target="_blank"><?=_('商家缴纳费用')?></a> </li>
                        <li> <i></i> <a href="" target="_blank"><?=_('店铺开通')?></a> </li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt class=""> <i class="hide"></i><?=_('签订入驻协议')?></dt>
            </dl>
            <dl show_id="0">
                <dt onclick="show_list('0');" style="cursor: pointer;"> <i class="show"></i><?=_('提交申请')?></dt>
                <dd>
                    <ul>
                        <li class=""><i></i><?=_('公司资质信息')?></li>
                        <li class="bbc_bg_col"><i></i><?=_('财务资质信息')?></li>
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
                <?php $phone = Web_ConfigModel::value("setting_phone"); if ($phone) { $phone = explode(',', $phone); } ?>
                <?php foreach($phone as $k=>$v){?>
                    <li><?=_('电话')?>：<?=$v;?></li>
                <?php }?>
                <li><?=_('邮箱')?>：<?=Web_ConfigModel::value('setting_email')?></li>
            </ul>
        </div>
    </div>
    <div class="right-layout">
        <div class="joinin-step">
            <ul>
                <li class="step1 current"><span><?=_('签订入驻协议')?></span></li>
                <li class="current"><span><?=_('公司资质信息')?></span></li>
                <li class="current"><span><?=_('财务资质信息')?></span></li>
                <li class=""><span><?=_('店铺经营信息')?></span></li>
                <li class=""><span><?=_('合同签订及缴费')?></span></li>
                <li class="step6"><span><?=_('店铺开通')?></span></li>
            </ul>
        </div>
        <div class="joinin-concrete form-style">
            <div class="alert">
                <h4><?=_('注意事项')?>：</h4>
                <?=_('以下所需要上传的电子版资质文件仅支持JPG\GIF\PNG格式图片，大小请控制在1M之内。')?>
                <br/>
                <span style="color:red;"><?php echo isset($shop_company['shop_verify_reason']) && $shop_company['shop_status'] == 5 ? $shop_company['shop_verify_reason'] : '';?></span>
            </div>
            <form id="form_company_info" method="post">
                <input name="shop_id" value="<?=$shop_company['shop_id']?>" type="hidden">
                <fieldset>
                    <h4><em><i>*</i><?=_('表示该项必填')?></em><?=_('开户银行信息')?></h4>
                    <dl>
                        <dt><i>*</i><?=_('银行开户名')?>：</dt>
                        <dd><input class="text w250" name="bank_account_name" type="text" value="<?php echo isset($shop_company['bank_account_name']) ? $shop_company['bank_account_name'] : '';?>"></dd>
                    </dl>
                    <dl>
                        <dt><i>*</i><?=_('公司银行账号')?>：</dt>
                        <dd><input class="text w250" name="bank_account_number" type="text" value="<?php echo isset($shop_company['bank_account_number']) ? $shop_company['bank_account_number'] : '';?>"></dd>
                    </dl>
                    <dl>
                        <dt><i>*</i><?=_('开户银行支行名称')?>：</dt>
                        <dd><input class="text w250" name="bank_name" type="text" value="<?php echo isset($shop_company['bank_name']) ? $shop_company['bank_name'] : '';?>"></dd>
                    </dl>
                    <dl>
                        <dt><?=_('开户银行支行联行号')?>：</dt>
                        <dd><input class="text w250" name="bank_code" type="text" value="<?php echo isset($shop_company['bank_code']) ? $shop_company['bank_code'] : '';?>"></dd>
                    </dl>
                    <dl>
                        <dt><i>*</i><?=_('开户银行支行所在地')?>：</dt>
                        <dd><input id="t" name="bank_address" type="hidden" value="<?php echo isset($shop_company['bank_address']) ? $shop_company['bank_address'] : '';?>">
                            <div id="d_2"  class="">
                                <select id="select_1" name="select_1" onChange="district(this);">
                                <option value="">--<?=_('请选择')?>--</option>
                                <?php foreach($district['items'] as $key=>$val){ ?>
                                <option value="<?=$val['district_id']?>|1" <?php if(isset($bank_district_info['district_info'][0]['district_id']) && $val['district_id'] == $bank_district_info['district_info'][0]['district_id']){echo 'selected="selected"';} ?> ><?=$val['district_name']?></option>
                                <?php } ?>
                                </select>
                                <?php if(isset($bank_district_info['district_list'][2])){?>
                                <select class="select_2" name="select_2" onChange="district(this);" >
                                <?php foreach($bank_district_info['district_list'][2] as $key=>$val){ ?>
                                <option value="<?php echo $val['district_id'];?>|2" <?php if(isset($bank_district_info['district_info'][1]['district_id']) && $val['district_id'] == $bank_district_info['district_info'][1]['district_id']){echo 'selected="selected"';} ?> > <?=$val['district_name']?></option>
                                <?php } ?>
                                </select>
                                <?php }else{ ?>
                                <select id="select_2" name="select_2" onChange="district(this);" class="hidden"></select>
                                <?php } ?>
                                <?php if(isset($bank_district_info['district_list'][3])){?>
                                <select class="select_2" name="select_3" onChange="district(this);" >
                                <?php foreach($bank_district_info['district_list'][3] as $key=>$val){ ?>
                                <option value="<?php echo $val['district_id'];?>|2" <?php if(isset($bank_district_info['district_info'][2]['district_id']) && $val['district_id'] == $bank_district_info['district_info'][2]['district_id']){echo 'selected="selected"';} ?> > <?=$val['district_name']?></option>
                                <?php } ?>
                                </select>
                                <?php }else{ ?>
                                <select id="select_3" name="select_3" onChange="district(this);" class="hidden"></select>
                                <?php } ?>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i>*</i><?=_('开户银行许可证电子版')?>：</dt>
                        <dd>
                            <input class="text w250 mr10" style="float: left;" readonly="readonly" id="bank_licence_electronic" name="bank_licence_electronic" type="text" value="<?php echo isset($shop_company['bank_licence_electronic']) ? $shop_company['bank_licence_electronic'] : '';?>">
                            <p  style="float:left; width:70px" id="bank_licence_upload" ><i class="iconfont icon-upload-alt"></i><?=_('图片上传')?></p>
                            <p  style="clear:both" class="hint"><?=_('请确保图片清晰，文字可辨并有清晰的红色公章。')?></p>
                        </dd>
                    </dl>
                </fieldset>
                <fieldset>
                    <h4><em><i>*</i>表示该项必填</em>税务登记证</h4>
                    <dl>
                        <dt><i>*</i>纳税人类型：</dt>
                        <dd>
                            <select name="taxpayer_type">
                                <option value="1" <?php if($shop_company['taxpayer_type'] == 1){echo 'selected';}?>>一般纳税人</option>
                                <option value="2" <?php if($shop_company['taxpayer_type'] == 2){echo 'selected';}?>>小规模纳税人</option>
                                <option value="3" <?php if($shop_company['taxpayer_type'] == 3){echo 'selected';}?>>非增值税纳税人</option>
                            </select>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i>*</i>税务登记证号：</dt>
                        <dd><input class="text w250" name="tax_registration_certificate" type="text" value="<?php echo isset($shop_company['tax_registration_certificate']) ? $shop_company['tax_registration_certificate'] : '';?>"></dd>
                    </dl>
                    <dl>
                        <dt><i>*</i>纳税人识别号：</dt>
                        <dd><input class="text w250" name="taxpayer_id" type="text" value="<?php echo isset($shop_company['taxpayer_id']) ? $shop_company['taxpayer_id'] : '';?>"></dd>
                    </dl>
                    <dl>
                        <dt><i>*</i>纳税类型税码：</dt>
                        <dd>
                            <select name="tax_code">
                                <option value="1" <?php if($shop_company['tax_code'] == 1){echo 'selected';}?>>0%</option>
                                <option value="2" <?php if($shop_company['tax_code'] == 2){echo 'selected';}?>>11%</option>
                                <option value="3" <?php if($shop_company['tax_code'] == 3){echo 'selected';}?>>图书11%免税</option>
                                <option value="4" <?php if($shop_company['tax_code'] == 4){echo 'selected';}?>>17%</option>
                                <option value="5" <?php if($shop_company['tax_code'] == 5){echo 'selected';}?>>3%</option>
                                <option value="6" <?php if($shop_company['tax_code'] == 6){echo 'selected';}?>>6%</option>
                                <option value="7" <?php if($shop_company['tax_code'] == 7){echo 'selected';}?>>7%</option>
                            </select>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i>*</i>税务登记证号电子版：</dt>
                        <dd>
                            <input class="text w250 mr10" style="float: left;" id="tax_registration_certificate_electronic" name="tax_registration_certificate_electronic" readonly="readonly" type="text" value="<?php echo isset($shop_company['tax_registration_certificate_electronic']) ? $shop_company['tax_registration_certificate_electronic'] : '';?>">
                            <p style="float:left; width:70px"  id="tax_registration_certificate_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>
                            <p  style="clear:both" class="hint">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                        </dd>
                    </dl>
                </fieldset>
                <div class="next"><a href="<?= YLB_Registry::get('base_url')?>/index.php?ctl=Seller_Shop_Settled&met=index&op=step2&rp=step2&apply=2" class="btn bbc_btns"><?=_('上一步')?></a>&nbsp;&nbsp;&nbsp;<a class="btn bbc_btns" id="btn_apply_company_next" href="javascript:;"><?=_('下一步，填写入驻预经营信息')?></a></div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=$this->view->js?>/district.js"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?= VER ?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>

<script type="text/javascript">
    //图片上传
    $(function(){
        bank_licence_uploads= new UploadImage({
            thumbnailWidth: 500,
            thumbnailHeight: 500,
            uploadButton: '#bank_licence_upload',
            inputHidden: '#bank_licence_electronic',
            callback: function () {
                $('#bank_licence_electronic').trigger("validate");
            }
        });
        tax_registration_upload = new UploadImage({
            thumbnailWidth: 500,
            thumbnailHeight: 500,
            uploadButton: '#tax_registration_certificate_upload',
            inputHidden: '#tax_registration_certificate_electronic'
        });
    });

    $(document).ready(function(){
        var ajax_url = './index.php?ctl=Seller_Shop_Settled&met=editShopCompany&typ=json';
        $('#form_company_info').validator({
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
            rules: {
                yh:[/^(\d{16}|\d{19})$/,"<?=_('请填写正确的银行账号')?>"],
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
                            location.href="./index.php?ctl=Seller_Shop_Settled&met=index&op=step4";
                        }
                        else
                        {
                            alert("<?=_('操作失败！')?>");
                        }
                    }
                });
            }

        });
    });

    $('#btn_apply_company_next').click(function() {
        $("#form_company_info").submit();
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
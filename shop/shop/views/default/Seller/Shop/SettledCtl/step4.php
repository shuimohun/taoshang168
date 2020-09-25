
<?php
include $this->view->getTplPath() . '/' . 'join_header.php';
?>

<style>
    .select_cat{cursor:pointer;padding:6px 5px}
    .tanchuang{width:630px;height:350px;background-color:#fff;position:fixed;top:25%;left:37%;border:1px solid #ccc;display:none}
    .tanchuang .tanchuang_top{width:100%;height:50px;background-color:#fff;line-height:50px;border-bottom:1px solid #ccc}
    .tanchuang .tanchuang_top span{font-size:14px;color:#464c5b;font-weight:700;line-height:50px;margin-left:10px}
    .tanchuang .tanchuang_top b{float:right;margin-right:10px;cursor:pointer}
    .tanchuang ul{display:inline-block;width:180px;height:200px;border:1px solid #ccc;margin-top:20px;margin-left:20px;overflow:auto}
    .tanchuang ul li{width:100%;height:24px;line-height:24px;cursor:pointer}
    .tanchuang ul li.curr{background-color:#e45050;color:#fff}
    .tanchuang .tanchuang_bottom{border-top:1px solid #e3e8ee;padding:12px 18px 12px 18px;text-align:right}
    .tanchuang .tanchuang_bottom span{display:inline-block;padding:6px 15px 7px;cursor:pointer;margin-left:10px}
    .tanchuang .tanchuang_bottom span.confirm{background-color:#e45050;color:#fff}
    .two_column {padding: 0 15%;}
    .two_column dt{padding:5px 0 !important;width:14% !important;}
    .two_column dd{padding:5px 0 !important;width:30% !important;}
    .two_column .text{width:140px;}
    .no_border{border:none !important;}
    .category_div{max-height:300px;overflow-y: scroll;}

    <?php if($shop_company['band_type'] && $shop_company['band_type'] == '2'){?>
        .dl-brand{display: block;}
        .zy-brand{display: none;}
    <?php }else{?>
        .dl-brand{display: none;}
        .zy-brand{display: block;}
    <?php }?>
    <?php if($shop_company['band_pro_type'] && $shop_company['band_pro_type'] == '1'){?>
        .dl-brand-pro-agreement{display: block;}
    <?php }else{?>
        .dl-brand-pro-agreement{display: none;}
    <?php }?>

</style>

<div class="header_line"><span></span></div>
<div class="breadcrumb">
    <span class="icon-home iconfont icon-tabhome"></span>
    <span><a href=""><?=_('首页')?></a></span>
    <span class="arrow iconfont icon-btnrightarrow"></span>
    <span><?=_($apply_tips['0'])?></span>
</div>
<div class="main">
    <div class="sidebar">
        <div class="title">
            <h3><?=_($apply_tips['0'])?></h3>
        </div>
        <div class="content">
            <dl show_id="99">
                <dt onclick="show_list('99');" style="cursor: pointer;"> <i class="hide"></i><?=_('入驻流程')?></dt>
                <dd style="display:none;">
                    <ul>
                        <li> <i></i> <a href="" target="_blank"><?=_('签署入驻协议')?></a> </li>
                        <li> <i></i> <a href="" target="_blank"><?=_($apply_tips['1'])?></a> </li>
                        <li> <i></i> <a href="" target="_blank"><?=_('平台审核资质')?></a> </li>
                        <li> <i></i> <a href="" target="_blank"><?=_($apply_tips['2'])?></a> </li>
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
                        <li class=""><i></i><?=_($apply_tips['3'])?></li>
                        <li class=""><i></i><?=_('财务资质信息')?></li>
                        <li class="bbc_bg_col"><i></i><?=_('店铺经营信息')?></li>
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
    </div>
    <div class="right-layout">
        <div class="w fn-clear">
            <div class="joinin-step">
                <ul>
                    <li class="step1 current"><span><?=_('签订入驻协议')?></span></li>
                    <li class="current"><span><?=_($apply_tips['3'])?></span></li>
                    <li class="current"><span><?=_('财务资质信息')?></span></li>
                    <li class="current"><span><?=_('店铺经营信息')?></span></li>
                    <li class=""><span><?=_('合同签订及缴费')?></span></li>
                    <li class="step6"><span><?=_('店铺开通')?></span></li>
                </ul>
            </div>
            <div class="joinin-concrete form-style">
                <div class="alert">
                    <h4><?=_('注意事项')?>：</h4>
                    <?=_('以下所需要上传的电子版资质文件仅支持JPG\GIF\PNG格式图片，大小请控制在1M之内。')?>
                    <br/>
                    <span style="color:red;"><?php echo isset($shop_company['shop_verify_reason']) && $shop_company['shop_status'] == 6 ? $shop_company['shop_verify_reason'] : '';?></span>
                </div>
                <form id="form_company_info" method="post">
                    <input name="shop_id" value="<?=$shop_company['shop_id']?>" type="hidden">
                    <fieldset>
                        <h4><em><i>*</i><?=_('表示该项必填')?></em><?=_('店铺经营信息')?></h4>
                        <dl>
                            <dt><i>*</i><?=_('店铺等级')?>：</dt>
                            <dd>
                                <select name="shop_grade_id">
                                    <option selected="selected" value=""><?=_('请选择')?></option>
                                    <?php if(!empty($shop_grade)){ foreach ($shop_grade as $key => $value) {?>
                                        <option value="<?php echo $value['shop_grade_id'];?>"  <?php if(isset($shop_company['shop_grade_id'])  && $value['shop_grade_id'] == $shop_company['shop_grade_id']){echo 'selected="selected"';}?> ><?=$value['shop_grade_name']?> (<?=_('收费标准')?>：<?=$value['shop_grade_fee']?> <?=_('元')?>)</option>
                                    <?php }}?>
                                </select>
                            </dd>
                        </dl>
                        <dl>
                            <dt><i>*</i><?=_('店铺名称')?>：</dt>
                            <dd>
                                <input class="text w250" name="shop_name" type="text" value="<?php echo isset($shop_company['shop_name']) ? $shop_company['shop_name'] : '';?>">
                                <p class="hint red"><?=_('店铺名称注册后不可修改，请认真填写。')?></p>
                            </dd>
                        </dl>
                        <dl>
                            <dt><i>*</i><?=_('开店时长')?>：</dt>
                            <dd>
                                <select name="joinin_year">
                                    <option value="1" <?php if(isset($shop_company['joinin_year'])  && $shop_company['joinin_year'] == 1){echo 'selected="selected"';}?> ><?=_('1年')?></option>
                                    <option value="2" <?php if(isset($shop_company['joinin_year'])  && $shop_company['joinin_year'] == 2){echo 'selected="selected"';}?>  ><?=_('2年')?></option>
                                    <option value="5" <?php if(isset($shop_company['joinin_year'])  && $shop_company['joinin_year'] == 5){echo 'selected="selected"';}?>  ><?=_('5年')?></option>
                                    <option value="10" <?php if(isset($shop_company['joinin_year'])  && $shop_company['joinin_year'] == 10){echo 'selected="selected"';}?>  ><?=_('10年')?></option>
                                </select>
                            </dd>
                        </dl>

                        <h4><em><i>*</i>表示该项必填</em>店铺管理人员资料填写</h4>
                        <?php if($shop_info['shop_business'] == 1){ $map = Shop_CompanyModel::$shop_manage_title_map;}else{$map = Shop_CompanyModel::$shop_manage_title_mapII;}?>
                        <?php foreach ($map as $key=>$value){?>
                            <dl class="no_border">
                                <dt><i>*</i><?=$value?></dt>
                            </dl>
                            <dl class="two_column">
                                <?php foreach (Shop_CompanyModel::$shop_manage_content_map as $k => $v){?>
                                    <dt><?php if($k != 'tel'){?><i>*</i><?php }?><?=$v?>：</dt>
                                    <dd>
                                        <input class="text" name="<?=$key?>[<?=$k?>]" type="text" value="<?=isset($shop_company)&&isset($shop_company['shop_manage'])&&isset($shop_company['shop_manage'][$key])&&isset($shop_company['shop_manage'][$key][$k])?$shop_company['shop_manage'][$key][$k]:''?>">
                                    </dd>
                                <?php }?>
                            </dl>
                        <?php }?>

                        <dl>
                            <dt><i>*</i><?=_('店铺分类')?>：</dt>
                            <dd>
                                <select name="shop_class_id" >
                                    <option value=""><?=_('请选择')?></option>
                                    <?php if(!empty($shop_class)){ foreach ($shop_class as $key => $value) { ?>
                                        <option data-cat-id="<?=$value['goods_cat_id']?>" value="<?=$value['shop_class_id']?>" <?php if(isset($shop_info['shop_class_id'])  && $value['shop_class_id'] == $shop_info['shop_class_id']){echo 'selected="selected"';}?> ><?=$value['shop_class_name']?> (<?=_('保证金')?>：<?=$value['shop_class_deposit']?><?=_('元')?>)</option>
                                    <?php }}?>
                                </select>
                                <p class="hint red"><?=_('请根据您所经营的内容认真选择店铺分类，注册后商家不可自行修改。')?></p>
                            </dd>
                        </dl>

                        <dl>
                            <dt><i>*</i>是否进口：</dt>
                            <dd>
                                <select name="certificate_type">
                                    <option value="0" <?php if($shop_company['certificate_type'] && $shop_company['certificate_type'] == '0'){echo 'selected';}?>>否</option>
                                    <option value="1" <?php if($shop_company['certificate_type'] && $shop_company['certificate_type'] == '1'){echo 'selected';}?>>是</option>
                                </select>
                            </dd>
                        </dl>

                        <dl>
                            <dt><?=_('经营类目')?>：</dt>
                            <dd>
                                <div class="select_category" style="display:inline-block">
                                    <input class="text w200" name="select_category" type="text" value="" readonly="readonly" style="background: none rgb(231, 231, 231);">
                                    <a class="bbc_seller_btns ncbtn select_cat" href="javascript:;" style="display: none;">添加类目</a>
                                </div>
                                <div class="category_div">
                                    <table class="table_category" border="0" cellpadding="0" cellspacing="0" >
                                        <tbody>
                                        <tr>
                                            <th><?=_('一级类目')?></th>
                                            <th><?=_('二级类目')?></th>
                                            <th><?=_('三级类目')?></th>
                                            <th><?=_('四级类目')?></th>
                                            <th><?=_('操作')?></th>
                                        </tr>
                                        <?php if($cat_data){ foreach ($cat_data as $key=>$value){?>
                                            <tr class="shop-item shop-item-<?=$value['current_cat']['cat_id']?>">
                                                <?php if($value['items']){ foreach ($value['items'] as $k=>$v){?>
                                                    <td><?=$v['cat_name']?></td>
                                                <?php }}?>
                                                <?php if($value['current_cat']){?>
                                                    <td><?=$value['current_cat']['cat_name']?>(分佣比例：<?=$value['current_cat']['cat_commission']?>%)</td>
                                                <?php }?>
                                                <?php if(count($value['items']) < 3){ for ($i=0;$i<3-count($value['items']);$i++){?>
                                                    <td></td>
                                                <?php }}?>
                                                <td>
                                                    <a data-type="delete" href="javascript:void(0);">删除</a>
                                                    <input type="hidden" name="product_class_id[]" value="<?=$value['current_cat']['cat_id']?>">
                                                    <input type="hidden" name="commission_rate[]" value="<?=$value['current_cat']['cat_commission']?>">
                                                </td>
                                            </tr>
                                        <?php }}?>
                                        </tbody>
                                    </table>
                                </div>
                            </dd>
                        </dl>

                        <?php if($shop_info['shop_business'] == 1){?>

                        <h4><em><i>*</i>表示该项必填</em>授权书上传</h4>
                        <dl>
                            <dt><i>*</i>品牌类型：</dt>
                            <dd>
                                <select name="band_type">
                                    <option value="1" <?php if($shop_company['band_type'] && $shop_company['band_type'] == '1'){echo 'selected';}?>>自营品牌</option>
                                    <option value="2" <?php if($shop_company['band_type'] && $shop_company['band_type'] == '2'){echo 'selected';}?>>代理品牌</option>
                                </select>
                            </dd>
                        </dl>
                        <dl class="zy-brand">
                            <dt><i>*</i>自营品牌名称：</dt>
                            <dd>
                                <input class="text w200" name="self_owned" type="text" value="<?php echo isset($shop_company['self_owned']) ? $shop_company['self_owned'] : '';?>" >
                                <span></span>
                            </dd>
                        </dl>
                        <dl class="zy-brand">
                            <dt><i>*</i>品牌商标电子版：</dt>
                            <dd>
                                <input class="text w200 mr10" style="float: left;" id="self_owned_band" name="self_owned_band" readonly="readonly" type="text" value="<?php echo isset($shop_company['self_owned_band']) ? $shop_company['self_owned_band'] : '';?>">
                                <p style="float:left; width:70px"  id="self_owned_band_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>
                                <p style="clear:both" class="hint">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                            </dd>
                        </dl>

                        <dl class="dl-brand">
                            <dt><i>*</i>代理品牌授权书：</dt>
                            <dd>
                                <input class="text w200" name="agency_brand_licensing" id="agency_brand_licensing" type="text" value="<?php echo isset($shop_company['agency_brand_licensing']) ? $shop_company['agency_brand_licensing'] : '';?>" ><span></span>
                            </dd>
                        </dl>
                        <dl class="dl-brand">
                            <dt><i>*</i>品牌授权书电子版：</dt>
                            <dd>
                                <input class="text w200 mr10" style="float: left;" id="self_owned_authorization" name="self_owned_authorization" readonly="readonly" type="text" value="<?php echo isset($shop_company['self_owned_authorization']) ? $shop_company['self_owned_authorization'] : '';?>">
                                <p style="float:left; width:70px"  id="self_owned_authorization_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>
                                <p style="clear:both" class="hint">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                            </dd>
                        </dl>
                        <dl class="dl-brand">
                            <dt><i>*</i>公司所在地：</dt>
                            <dd>
                                <input type="hidden" name="agency_bank_address" class="t" value="<?php echo isset($shop_company['agency_bank_address']) ? $shop_company['agency_bank_address'] : '';?>" />
                                <input type="hidden" name="province_id" class="id_1" value="<?php echo isset($agency_district_info['district_info'][0]['district_id']) ? $agency_district_info['district_info'][0]['district_id'] : '';?>" />
                                <input type="hidden" name="city_id" class="id_2" value="<?php echo isset($agency_district_info['district_info'][1]['district_id']) ? $agency_district_info['district_info'][1]['district_id'] : '';?>" />
                                <input type="hidden" name="area_id" class="id_3" value="<?php echo isset($agency_district_info['district_info'][2]['district_id']) ? $agency_district_info['district_info'][2]['district_id'] : '';?>" />
                                <input type="hidden" name="street_id" class="id_4" value="<?php echo isset($agency_district_info['district_info'][3]['district_id']) ? $agency_district_info['district_info'][3]['district_id'] : '';?>" />
                                <div id="d_2">
                                    <select class="select_1" name="agency_1" onChange="district(this);">
                                        <option value="">--请选择--</option>
                                        <?php foreach($district['items'] as $key=>$val){ ?>
                                            <option value="<?php echo $val['district_id'];?>|1" <?php if(isset($agency_district_info['district_info'][0]['district_id']) && $val['district_id'] == $agency_district_info['district_info'][0]['district_id']){echo 'selected="selected"';} ?> > <?=$val['district_name']?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if(isset($agency_district_info['district_list'][2])){?>
                                        <select class="select_2" name="agency_2" onChange="district(this);" >
                                            <?php foreach($agency_district_info['district_list'][2] as $key=>$val){ ?>
                                                <option value="<?php echo $val['district_id'];?>|2" <?php if(isset($agency_district_info['district_info'][1]['district_id']) && $val['district_id'] == $agency_district_info['district_info'][1]['district_id']){echo 'selected="selected"';} ?> > <?=$val['district_name']?></option>
                                            <?php } ?>
                                        </select>
                                    <?php }else{ ?>
                                        <select class="select_2 hidden" name="agency_2" onChange="district(this);" ></select>
                                    <?php } ?>
                                    <?php if(isset($agency_district_info['district_list'][3])){?>
                                        <select class="select_3" name="agency_3" onChange="district(this);" >
                                            <?php foreach($agency_district_info['district_list'][3] as $key=>$val){ ?>
                                                <option value="<?php echo $val['district_id'];?>|3" <?php if(isset($agency_district_info['district_info'][2]['district_id']) && $val['district_id'] == $agency_district_info['district_info'][2]['district_id']){echo 'selected="selected"';} ?> > <?=$val['district_name']?></option>
                                            <?php } ?>
                                        </select>
                                    <?php }else{ ?>
                                        <select class="select_3 hidden" name="agency_3" onChange="district(this);" ></select>
                                    <?php } ?>
                                    <?php if(isset($agency_district_info['district_list'][4])){?>
                                        <select class="select_4" name="agency_4" onChange="district(this);" >
                                            <?php foreach($agency_district_info['district_list'][4] as $key=>$val){ ?>
                                                <option value="<?php echo $val['district_id'];?>|4" <?php if(isset($agency_district_info['district_info'][3]['district_id']) && $val['district_id'] == $agency_district_info['district_info'][3]['district_id']){echo 'selected="selected"';} ?> > <?=$val['district_name']?></option>
                                            <?php } ?>
                                        </select>
                                    <?php }else{ ?>
                                        <select class="select_4 hidden" name="agency_4" onChange="district(this);" ></select>
                                    <?php } ?>
                                </div>
                                <span></span>
                            </dd>
                        </dl>
                        <dl class="dl-brand">
                            <dt><i>*</i>公司详细地址：</dt>
                            <dd>
                                <input class="text w200" name="agency_band_address_detail" id="agency_band_address_detail" type="text" value="<?php echo isset($shop_company['agency_band_address_detail']) ? $shop_company['agency_band_address_detail'] : '';?>"><span></span>
                            </dd>
                        </dl>
                        <dl class="dl-brand">
                            <dt><i>*</i>公司电话：</dt>
                            <dd>
                                <input class="text w200" name="band_company_tel" id="band_company_tel" type="text" value="<?php echo isset($shop_company['band_company_tel']) ? $shop_company['band_company_tel'] : '';?>" ><span></span>
                            </dd>
                        </dl>
                        <dl class="dl-brand">
                            <dt><i>*</i>代理品牌授权书效期：</dt>
                            <dd>
                                <input readonly="readonly" id="band_start_time"  name="band_start_time"  class="text w90 hasDatepicker" type="text" value="<?php echo isset($shop_company['band_start_time']) ? $shop_company['band_start_time'] : '';?>"><em><i class="iconfont icon-rili"></i></em>
                                <span></span>-
                                <input readonly="readonly" id="band_end_time" name="band_end_time" class="text w90 hasDatepicker" type="text" value="<?php echo isset($shop_company['band_end_time']) && ($shop_company['band_end_time'] > $shop_company['band_start_time']) ? $shop_company['band_end_time'] : '';?>"><em><i class="iconfont icon-rili"></i></em>
                                <p style="clear:both" class="hint">结束时间提前30天通知上传新的授权书。如不上传新的授权书商品全部删除。</p>
                            </dd>
                        </dl>

                        <dl class="zy-brand">
                            <dt><i>*</i>品牌系委托他人生产：</dt>
                            <dd>
                                <select name="band_pro_type">
                                    <option value="0" <?php if($shop_company['band_pro_type'] && $shop_company['band_pro_type'] == '0'){echo 'selected';}?>>否</option>
                                    <option value="1" <?php if($shop_company['band_pro_type'] && $shop_company['band_pro_type'] == '1'){echo 'selected';}?>>是</option>
                                </select>
                            </dd>
                        </dl>
                        <dl class="zy-brand dl-brand-pro-agreement">
                            <dt><i>*</i>委托加工协议：</dt>
                            <dd>
                                <input class="text w200 mr10 fl" id="band_pro_agreement" name="band_pro_agreement" readonly="readonly" type="text" value="<?php echo isset($shop_company['band_pro_agreement']) ? $shop_company['band_pro_agreement'] : '';?>">
                                <p class="fl" id="band_pro_agreement_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>
                                <p class="clear">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                            </dd>
                        </dl>

                        <div class="cer">
                            <?php if($shop_cer_rows){ foreach ($shop_cer_rows as $key=>$val){?>
                                <dl class="cer_dl_<?=$val['type']?> <?php if($val['type'] == '1' && $shop_company['certificate_type'] == '0'){echo 'hidden';}?>">
                                    <dt><i>*</i><?=$val['name']?>：</dt>
                                    <dd>
                                        <input class="text w200 mr10 fl" id="cer_<?=$val['id']?>" name="cer_<?=$val['id']?>" readonly="readonly" type="text" value="<?=$val['image']?>">
                                        <p class="fl" id="cer_<?=$val['id']?>_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>
                                        <p class="clear">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                    </dd>
                                </dl>
                            <?php }}?>
                        </div>

                        <?php }?>

                    </fieldset>
                    <div class="next"><a href="<?= YLB_Registry::get('base_url')?>/index.php?ctl=Seller_Shop_Settled&met=index&op=step3&rp=step3&apply=<?=$apply?>" class="btn bbc_btns"><?=_('上一步')?></a>&nbsp;&nbsp;&nbsp;<a id="btn_apply_company_next" class="btn bbc_btns" href="javascript:void(0);"><?=_('提交申请')?></a></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="tanchuang">
    <div class="tanchuang_top">
        <span>请选择类目</span>
        <b>X</b>
    </div>
    <ul class="cat1"></ul>
    <ul class="cat cat2"></ul>
    <ul class="cat cat3"></ul>
    <div class="tanchuang_bottom">
        <span class="cancel">取消</span>
        <span class="confirm">确定</span>
    </div>
</div>

<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css?ver=<?= VER ?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/districtTow.js"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?= VER ?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<script type="text/javascript">

    new UploadImage({
        uploadButton: '#self_owned_band_upload',
        inputHidden: '#self_owned_band'
    });
    new UploadImage({
        uploadButton: '#self_owned_authorization_upload',
        inputHidden: '#self_owned_authorization'
    });
    new UploadImage({
        uploadButton: '#self_owned_authorization_upload',
        inputHidden: '#self_owned_authorization'
    });
    new UploadImage({
        uploadButton: '#band_pro_agreement_upload',
        inputHidden: '#band_pro_agreement'
    });

    var cer_array = [];
    <?php if($shop_cer_rows){ foreach ($shop_cer_rows as $key=>$val){?>
        new UploadImage({
            uploadButton: '#cer_<?=$val['id']?>_upload',
            inputHidden: '#cer_<?=$val['id']?>'
        });
    cer_array.push(<?=$val['id']?>+'');
    <?php }}?>
    $(document).ready(function(){

        $('#band_start_time').datetimepicker({
            controlType: 'select',
            format:"Y-m-d",
            timepicker:false,
        });
        $('#band_end_time').datetimepicker({
            controlType: 'select',
            format:"Y-m-d",
            timepicker:false,
            onShow:function( ct ){
                this.setOptions({
                    minDate:($('#band_start_time').val())
                })
            }
        });

        //移除以选择的类目
        $('.table_category').on('click', '[data-type="delete"]', function() {
            $(this).parent('td').parent('tr').remove();
        });

        //设置店铺分类 经营类目联动
        function setShopClass() {
            var goods_cat_id = $('select[name=shop_class_id]').find("option:selected").data('cat-id');
            if(goods_cat_id){
                $.ajax({
                    url: SITE_URL+'?ctl=Goods_Cat&met=getCat&typ=json',
                    data: "goods_cat_id=" + goods_cat_id,
                    success: function(e) {
                        if(e.status == 200){
                            $('input[name=select_category]').val(e.data.cat_name);
                            $('.tanchuang').removeClass('loaded');
                            $('.select_cat').show();
                        }
                    }
                });
            }
        }

        //店铺分类改变时
        $('select[name=shop_class_id]').change(function () {
            setShopClass();
            $('.shop-item').remove();
        });

        <?php if(isset($shop_info['shop_class_id']) && $shop_info['shop_class_id']){?>
            setShopClass();
        <?php }?>

        //设定类目
        function setShopCatBind(i,checked) {
            var d = $('.table_category').find('.shop-item-'+i);
            if(checked == 'checked'){
                if(d.length == 0){
                    var ajax_url = SITE_URL + "?ctl=Seller_Shop_Settled&met=shopCatBind&typ=json";
                    $.ajax({
                        url: ajax_url,
                        data: "cat_id=" + i,
                        success: function(a) {
                            if (a.status == 200) {
                                var tr = '<tr class="shop-item shop-item-'+i+'">';
                                var catid = catname = commission = '';
                                var data = a.data;
                                var len = data.length;

                                $.each(data, function(i, cat_row) {
                                    if (i == len - 1) {
                                        tr += '<td>' + cat_row.cat_name + '(分佣比例：' + cat_row.cat_commission + '%)</td>';
                                    } else {
                                        tr += '<td>' + cat_row.cat_name + '</td>';
                                    }

                                    catid = cat_row.cat_id;
                                    commission = cat_row.cat_commission;

                                });

                                //等级不足时
                                for (i = 0; i < 4 - len; i++) {
                                    tr += '<td></td>';
                                }

                                tr += '<td><a data-type="delete" href="javascript:void(0);">删除</a>';
                                tr += '<input type="hidden" name="product_class_id[]" value="' + catid + '" />';
                                tr += '<input type="hidden" name="commission_rate[]" value="' + commission + '" />';
                                tr += '</td></tr>';

                                $('.table_category').append(tr);
                            } else {
                                alert("操作失败！");
                            }
                        }
                    });
                }
            }else{
                if(d.length > 0){
                    d.remove();
                }
            }
        }

        var current_cat = [];
        <?php if(isset($shop_class_bind) && $shop_class_bind['items']){?>
            current_cat = <?=json_encode(array_column($shop_class_bind['items'],'product_class_id'))?>;
        <?php }?>

        var all_cat = <?=json_encode(array_values($all_cat_ids))?>;

        //分类选择
        function getCatNew(goods_cat_id,step,checked) {
            $.ajax({
                url: SITE_URL+'?ctl=Goods_Cat&met=getCatNew&typ=json',
                data: "cat_id=" + goods_cat_id,
                success: function(e) {
                    if(e.status == 200){
                        if(e.data && e.data.length > 0){//如果有子分类

                            var str_li = '';
                            $.each(e.data,function (i) {
                                if(step == 0){
                                    str_li+='<li data-step="'+(step*1+1)+'" data-cat-id="'+e.data[i].cat_id+'">'+e.data[i].cat_name+'</li>';
                                }else{
                                    if($.inArray(e.data[i].cat_id, current_cat) >= 0 || $.inArray(e.data[i].cat_id, all_cat) >= 0){
                                        if(step == 1){
                                            str_li+='<li data-step="'+(step*1+1)+'" data-cat-id="'+e.data[i].cat_id+'"><input class="check_box" type="checkbox" checked >'+e.data[i].cat_name+'</li>';
                                        }else{
                                            if(checked != 'checked' ){
                                                current_cat.splice($.inArray(e.data[i].cat_id, current_cat),1);
                                            }
                                            str_li+='<li data-step="'+(step*1+1)+'" data-cat-id="'+e.data[i].cat_id+'"><input class="check_box" type="checkbox" '+checked+'>'+e.data[i].cat_name+'</li>';
                                        }
                                    }else{
                                        if(checked == 'checked'){//选择
                                            current_cat.push(e.data[i].cat_id);
                                        }else{
                                            checked = '';
                                        }
                                        str_li+='<li data-step="'+(step*1+1)+'" data-cat-id="'+e.data[i].cat_id+'"><input class="check_box" type="checkbox" '+checked+' >'+e.data[i].cat_name+'</li>';
                                    }
                                }
                            });
                            $('.cat'+(step*1+1)).html(str_li);

                        }else{//没有子分类
                            if($.inArray(goods_cat_id+'', current_cat) >= 0){//已选中
                                if(checked != 'checked'){//移除
                                    current_cat.splice($.inArray(goods_cat_id+'', current_cat),1);
                                }
                            }else{//没选
                                if(checked == 'checked'){//选择
                                    current_cat.push(goods_cat_id +'');
                                }
                            }
                        }
                    }
                }
            });
        }

        //添加类目 选中
        $('.select_cat').on('click', function() {
            $('.cat').html('');
            <?php if(isset($shop_class_bind) && $shop_class_bind['items']){?>
                current_cat = <?=json_encode(array_column($shop_class_bind['items'],'product_class_id'))?>;
            <?php }else{?>
                current_cat = [];
            <?php }?>

            if (!$('.tanchuang').hasClass('loaded')) {
                var goods_cat_id = $('select[name=shop_class_id]').find("option:selected").data('cat-id');
                if (goods_cat_id) {
                    getCatNew(goods_cat_id, 0);
                    $('.tanchuang').addClass('loaded');
                } else {
                    alert('请先选择店铺分类!')
                }
            }else{
                $('.cat1').find('.curr').removeClass('curr');
            }

            $('.tanchuang').show();
        });

        //关闭弹框
        $('.tanchuang .tanchuang_top b').on('click', function() {
            $('.tanchuang').hide();
        });

        //分类列表选中
        $('.tanchuang ul').delegate('li', 'click', function() {
            var goods_cat_id = $(this).data('cat-id');
            var step = $(this).data('step');
            var checked = '';
            if ($(this).find('.check_box').is(':checked')) {
                checked = 'checked';
            }
            getCatNew(goods_cat_id, step, checked);
            $(this).addClass('curr').siblings().removeClass('curr');
            $('.cat' + (step * 1 + 1)).html('');
            $('.cat' + (step * 1 + 2)).html('');
            $('.cat' + (step * 1 + 1)).children().show();
        });

        $('.confirm').on('click', function() {
            $('.tanchuang').hide();

            $.post('./index.php?ctl=Seller_Shop_Settled&met=shopCatBindII&typ=json',{'cat_id':current_cat},function(result){
                if(result.status == 200){
                    $('.shop-item').remove();
                    $.each(result.data['cat'], function(ii, data) {
                        var tr = '<tr class="shop-item shop-item-'+ii+'">';
                        var catid = catname = commission = '';
                        var len = data.length;

                        $.each(data, function(i, cat_row) {
                            if (i == len - 1) {
                                tr += '<td>' + cat_row.cat_name + '(分佣比例：' + cat_row.cat_commission + '%)</td>';
                            } else {
                                tr += '<td>' + cat_row.cat_name + '</td>';
                            }
                            catid = cat_row.cat_id;
                            commission = cat_row.cat_commission;
                        });

                        //等级不足时
                        for (j = 0; j < 4 - len; j++) {
                            tr += '<td></td>';
                        }

                        tr += '<td><a data-type="delete" href="javascript:void(0);">删除</a>';
                        tr += '<input type="hidden" name="product_class_id[]" value="' + catid + '" />';
                        tr += '<input type="hidden" name="commission_rate[]" value="' + commission + '" />';
                        tr += '</td></tr>';

                        $('.table_category').append(tr);
                    });

                    if(result.data['cer']){
                        var cer_type = $('select[name="certificate_type"]').val();
                        $.each(result.data['cer'], function(i, cer) {
                            if($.inArray(cer['id'],cer_array) < 0){
                                var cla = '';
                                if(cer_type == '0' && cer['type'] == 1){
                                    cla = 'class="hidden"';
                                }
                                var dl = '<dl data-cer-type="'+cer['type']+'" '+cla+'><dt><i>*</i>' + cer['name'] + '：</dt><dd>';
                                dl += '<input class="text w200 mr10 fl" id="cer_'+cer['id']+'" name="cer['+cer['id']+']" readonly="readonly" type="text" value="">';
                                dl += '<p class="fl" id="cer_'+cer['id']+'_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>';
                                dl += '<p class="clear">请确保图片清晰，文字可辨并有清晰的红色公章。</p></dd></dl>';

                                $('.cer').append(dl);

                                new UploadImage({
                                    uploadButton: '#cer_' + cer['id'] + '_upload',
                                    inputHidden: '#cer_' + cer['id']
                                });
                            }else{
                                if(cer_type == '0' && !$('.cer .cer_dl_1').hasClass('hidden')){
                                    $('.cer .cer_dl_1').addClass('hidden');
                                }
                            }

                        });

                    }
                }else if(result.data.msg){
                    alert(result.data.msg);
                }else{
                    alert("<?=_('操作失败！')?>");
                }
            });
        });
        
        function setCer() {
            
        }

        $('.cancel').on('click', function() {
            $('.tanchuang').hide();
        });

        //品牌类型 选择
        $('select[name=band_type]').on('change',function(){
            if($(this).val() == '1'){
                $('.dl-brand').hide();
                $('.zy-brand').show();
            }else if($(this).val() == '2'){
                $('.zy-brand').hide();
                $('.dl-brand').show();
            }
        });

        //品牌系委托他人生产 选择
        $('select[name=band_pro_type]').on('change',function(){
            if($(this).val() == '0'){
                $('.dl-brand-pro-agreement').hide();
            }else if($(this).val() == '1'){
                $('.dl-brand-pro-agreement').show();
            }
        });

        //是否进口 选择
        $('select[name=certificate_type]').on('change',function(){
            if($(this).val() == '1'){
                $('.cer_dl_1').removeClass('hidden');
            }else{
                $('.cer_dl_1').addClass('hidden');
            }
        });

        var ajax_url = "./index.php?ctl=Seller_Shop_Settled&met=editShopBase&typ=json&apply=<?=$apply?>";
        $('#form_company_info').validator({
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
            rules: {

            },
            fields: {
                'shop_name': 'required;',
                'shop_grade_id':'required;',
                'joinin_year':'required;',
                'shop_class_id':'required;',
                'shop_class_bind_id':'required;',
                'company[name]':'required;',
                'company[phone]':'required;mobile;',
                'company[email]':'required;email;',
                'company[qq]':'required;integer[+0];',
                'shop[name]':'required;',
                'shop[phone]':'required;mobile;',
                'shop[email]':'required;email;',
                'shop[qq]':'required;integer[+0];',
                'operate[name]':'required;',
                'operate[phone]':'required;mobile;',
                'operate[email]':'required;email;',
                'operate[qq]':'required;integer[+0];',
                'service[name]':'required;',
                'service[phone]':'required;mobile;',
                'service[email]':'required;email;',
                'service[qq]':'required;integer[+0];',
            },
            valid:function(form){
                //表单验证通过，提交表单
                $.post(ajax_url,$("#form_company_info").serialize(),function(result){
                    if(result.status == 200){
                        location.href="./index.php?ctl=Seller_Shop_Settled&met=index&op=step5&apply=<?=$apply?>";
                    }else if(result.data.msg){
                        alert(result.data.msg);
                    }else{
                        alert("<?=_('操作失败！')?>");
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
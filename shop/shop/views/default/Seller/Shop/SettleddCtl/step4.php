
<?php
include $this->view->getTplPath() . '/' . 'join_header.php';

?>
<style>
    .select_category .ui-tree-wrap{
        margin: 0px;
    }
    .webuploader-pick {
        position: relative;
        display: inline-block;
        cursor: pointer;
        /* background: #00b7ee; */
        /* padding: 0 10px; */
        background: #ddd;
        /* color: #fff; */
        text-align: center;
        border-radius: 3px;
        overflow: hidden;
        line-height: 28px;
        width: 80px;
        height: 28px;
    }
    .dl-brand{display: none;}
    select{min-width: 120px;}
    .w120{width: 120px;}
    .w80{width:80px;}
    .webuploader-pick{position: relative;margin-left: 10px;}
    input[type=file]{position: absolute;top:0;left: 0;width:100%;height: 100%;opacity: 0;filter:alpha(opacity=0);-moz-opacity:0;-khtml-opacity:0;}
    .form-style h5 {
        padding: 8px 30px 10px;
        height: 20px;
        font: 600 14px/20px microsoft yahei;
    }
    .form-style dl dt {
        /*width: 26%;*/
    }
    .form-style dl dd {
        /*width: 69%;*/
    }
    .form-style dl dd em{
        padding: 0 4px;
        height: 24px;
    }
    .iconfont{font-size: 20px;}
    .select_cat{cursor: pointer;padding: 6px 5px;}
    .tanchuang{
        width: 630px;
        height: 350px;
        background-color: #fff;
        position: fixed;
        top:25%;
        left: 37%;
        border:1px solid #ccc;
        display: none;
    }
    .tanchuang .tanchuang_top{
        width: 100%;
        height: 50px;
        background-color: #fff;
        line-height: 50px;
        border-bottom: 1px solid #ccc;
    }
    .tanchuang .tanchuang_top span{
        font-size: 14px;
        color: #464c5b;
        font-weight: 700;
        line-height: 50px;
        margin-left: 10px;
    }
    .tanchuang .tanchuang_top b{
        float: right;
        margin-right: 10px;
        cursor: pointer;
    }
    .tanchuang ul{
        display: inline-block;
        width: 180px;
        height: 200px;
        border: 1px solid #ccc;
        margin-top: 20px;
        margin-left: 20px;
        overflow:auto;
    }
    .tanchuang ul li{
        width: 100%;
        height: 24px;
        line-height: 24px;
        cursor: pointer;
    }
    .tanchuang ul li.curr{
        background-color: #e45050;
        color: #fff;
    }
    .tanchuang .tanchuang_bottom {
        border-top: 1px solid #e3e8ee;
        padding: 12px 18px 12px 18px;
        text-align: right;
    }
    .tanchuang .tanchuang_bottom span{
        display: inline-block;
        padding:6px 15px 7px;
        cursor: pointer;
        margin-left: 10px;
    }
    .tanchuang .tanchuang_bottom span.confirm{
        background-color: #e45050;
        color: #fff;
    }
    .form-style dl dt {
        padding: 10px 1% 10px 0;
        width: 23%;
        text-align: right;
    }

</style>

<div class="header_line"><span></span></div>
<div class="breadcrumb"><span class="icon-home iconfont icon-tabhome"></span><span><a href="">首页</a></span> <span class="arrow iconfont icon-btnrightarrow"></span> <span><?=_($apply_tips['0'])?></span> </div>
<div class="main">
    <div class="sidebar">
        <div class="title">
            <h3><?=_($apply_tips['0'])?></h3>
        </div>
        <div class="content">
            <dl show_id="99">
                <dt onclick="show_list('99');" style="cursor: pointer;"> <i class="hide"></i>入驻流程</dt>
                <dd style="display:none;">
                    <ul>
                        <li> <i></i> <a href="" target="_blank">签署入驻协议</a> </li>
                        <li> <i></i> <a href="" target="_blank"><?=_($apply_tips['1'])?></a> </li>
                        <li> <i></i> <a href="" target="_blank">平台审核资质</a> </li>
                        <li> <i></i> <a href="" target="_blank"><?=_($apply_tips['2'])?></a> </li>
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
                        <li class=""><i></i><?=_($apply_tips['3'])?></li>
                        <li class=""><i></i>财务资质信息</li>
                        <li class="bbc_bg_col"><i></i>店铺经营信息</li>
                        <li class=""><i></i>店铺经营类目信息</li>
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
    </div>
    <div class="right-layout">
        <div class="w fn-clear">
            <div class="joinin-step">
                <ul>
                    <li class="step1 current"><span>签订入驻协议</span></li>
                    <li class="current"><span><?=_($apply_tips['3'])?></span></li>
                    <li class="current"><span>财务资质信息</span></li>
                    <li class="current"><span>店铺经营信息</span></li>
                    <li class=""><span>店铺经营类目信息</span></li>
                    <li class=""><span>合同签订及缴费</span></li>
                    <li class="step6"><span>店铺开通</span></li>
                </ul>
            </div>


            <div class="joinin-concrete form-style">
                <div class="alert">
                    <h4>注意事项：</h4>
                    以下所需要上传的电子版资质文件仅支持JPG\GIF\PNG格式图片，大小请控制在1M之内。
                    <br/>
                    <span style="color:red;"><?php echo isset($shop_company['shop_verify_reason']) && $shop_company['shop_status'] == 6 ? $shop_company['shop_verify_reason'] : '';?></span>
                </div>
                <form id="form_company_info" method="post">
                    <input name="shop_id" value="<?=$shop_company['shop_id']?>" type="hidden">
                    <fieldset>
                        <h4><em><i>*</i>表示该项必填</em>店铺经营信息</h4>
                        <dl>
                            <dt><i>*</i>店铺名称：</dt>
                            <dd>
                                <input class="text w250" name="shop_name" type="text" value="<?php echo isset($shop_company['shop_name']) ? $shop_company['shop_name'] : '';?>">
                                <p class="hint red">店铺名称注册后不可修改，请认真填写。</p>
                            </dd>
                        </dl>
                        <dl>
                            <dt><i>*</i>店铺等级：</dt>
                            <dd>
                                <select name="shop_grade_id">
                                    <option selected="selected" value="">请选择</option>
                                    <?php if(!empty($shop_grade)){
                                        foreach ($shop_grade as $key => $value) {?>

                                            <option value="<?php echo $value['shop_grade_id'];?>"  <?php if(isset($shop_company['shop_grade_id'])  && $value['shop_grade_id'] == $shop_company['shop_grade_id']){echo 'selected="selected"';}?> ><?=$value['shop_grade_name']?> (收费标准：<?=$value['shop_grade_fee']?> 元)</option>

                                        <?php }}?>
                                </select>
                            </dd>
                        </dl>
                        <dl>
                            <dt><i>*</i>开店时长：</dt>
                            <dd>
                                <select name="joinin_year">
                                    <option selected="selected" value="1" <?php if(isset($shop_company['joinin_year'])  && $shop_company['joinin_year'] == 1){echo 'selected="selected"';}?> >1年</option>
                                    <option value="2" <?php if(isset($shop_company['joinin_year'])  && $shop_company['joinin_year'] == 2){echo 'selected="selected"';}?>  >2年</option>
                                    <option value="5" <?php if(isset($shop_company['joinin_year'])  && $shop_company['joinin_year'] == 5){echo 'selected="selected"';}?>  >5年</option>
                                    <option value="10" <?php if(isset($shop_company['joinin_year'])  && $shop_company['joinin_year'] == 10){echo 'selected="selected"';}?>  >10年</option>
                                </select>
                            </dd>
                        </dl>
                        <h4><em><i>*</i>表示该项必填</em>店铺管理人员资料填写</h4>
                        <dl style="border-bottom:0px">
                            <dt><i>*</i>公司负责人：</dt>
                        </dl>
                        <dl style="border-bottom:0px">
                            <dt><i>*</i>姓名：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="company_uname" type="text" value="<?php echo $shop_company['company_uname']? $shop_company['company_uname']:'' ?>">
                            </dd>
                            <dt><i>*</i>手机：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="company_uphone" type="text" value="<?=$shop_company['company_uphone']?>">
                            </dd>
                            <dt><i>*</i>邮箱：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="company_uemail" type="text" value="<?=$shop_company['company_uemail']?>">
                            </dd>
                            <dt><i>*</i>QQ：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="company_uqq" type="text" value="<?=$shop_company['company_uqq']?>">
                            </dd>
                            <dt><i>*</i>电话：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="company_ucall" type="text" value="<?=$shop_company['company_ucall']?>">
                            </dd>
                        </dl>
                        <dl style="border-bottom:0px">
                            <dt><i>*</i>店铺负责人：</dt>
                        </dl>
                        <dl style="border-bottom:0px">
                            <dt><i>*</i>姓名：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="shop_uname" type="text" value="<?=$shop_company['shop_uname']?>">
                            </dd>
                            <dt><i>*</i>手机：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="shop_uphone" type="text" value="<?=$shop_company['shop_uphone']?>">
                            </dd>
                            <dt><i>*</i>邮箱：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="shop_uemail" type="text" value="<?=$shop_company['shop_uemail']?>">
                            </dd>
                            <dt><i>*</i>QQ：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="shop_uqq" type="text" value="<?=$shop_company['shop_uqq']?>">
                            </dd>
                            <dt>电话：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="shop_ucall" type="text" value="<?=$shop_company['shop_ucall']?>">
                            </dd>
                        </dl>
                        <dl style="border-bottom:0px">
                            <dt><i>*</i>运营联系人：</dt>
                        </dl>
                        <dl style="border-bottom:0px">
                            <dt><i>*</i>姓名：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="run_uname" type="text" value="<?=$shop_company['run_uname']?>">
                            <dt><i>*</i>手机：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="run_uphone" type="text" value="<?=$shop_company['run_uphone']?>">
                            </dd>
                            <dt><i>*</i>邮箱：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="run_uemail" type="text" value="<?=$shop_company['run_uemail']?>">
                            </dd>
                            <dt><i>*</i>QQ：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="run_uqq" type="text" value="<?=$shop_company['run_uqq']?>">
                            </dd>
                            <dt>电话：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="run_ucall" type="text" value="<?=$shop_company['run_ucall']?>">
                            </dd>
                        </dl>
                        <dl style="border-bottom:0px">
                            <dt><i>*</i>售后联系人：</dt>
                        </dl>
                        <dl >
                            <dt><i>*</i>姓名：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="after_uname" type="text" value="<?=$shop_company['after_uname']?>">
                            </dd>
                            <dt><i>*</i>手机：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="after_uphone" type="text" value="<?=$shop_company['after_uphone']?>">
                            </dd>
                            <dt><i>*</i>邮箱：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="after_uemail" type="text" value="<?=$shop_company['after_uemail']?>">
                            </dd>
                            <dt><i>*</i>QQ：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="after_uqq" type="text" value="<?=$shop_company['after_uqq']?>">
                            </dd>
                            <dt>电话：</dt>
                            <dd style="width: 20%">
                                <input class="text w200" name="after_ucall" type="text" value="<?=$shop_company['after_ucall']?>">
                            </dd>
                        </dl>

                        <dl>
                            <dt><i>*</i>店铺分类：</dt>
                            <dd>
                            <select name="shop_class_id">
                                <option selected="selected" value="">请选择</option>
                                <?php foreach ($shop_class as $key => $value) { ?>
                                    <option value="<?=$value['shop_class_id']?>" data-cat-id="<?=$value['goods_cat_id']?>" <?php if(isset($shop_company['shop_class_id'])  && $value['shop_class_id'] == $shop_company['shop_class_id']){echo 'selected="selected"';}?> ><?=$value['shop_class_name']?> (保证金：<?=$value['shop_class_deposit']?>元)</option>
                                <?php }?>
                            </select>
                            <p class="hint red">请根据您所经营的内容认真选择店铺分类，注册后商家不可自行修改。</p>
                            </dd>
                        </dl>
                        <dl>
                            <dt>经营类目：</dt>
                            <dd>
                                <div class="select_category" style="display:inline-block">
                                    <input class="text w200" name="select_category" type="text" value="" readonly="readonly" style="background: none rgb(231, 231, 231);">
                                    <a class="bbc_seller_btns ncbtn select_cat" href="javascript:;" style="display: none;">添加分类</a>
                                </div>
                                <table class="table_category" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                        <th>一级类目</th>
                                        <th>二级类目</th>
                                        <th>三级类目</th>
                                        <th>四级类目</th>
                                        <th>操作</th>
                                     </tr>
                                </tbody>

                                </table>
                            </dd>
                        </dl>
                        <h4><em><i>*</i>表示该项必填</em>授权书上传</h4>
                        <dl style="border-bottom:none;" class="brand-type">
                            <dt><i>*</i>品牌类型：</dt>
                            <dd>
                                <select name="band_type" aria-required="" aria-invalid="" class="" data-inputstatus="">
                                    <option value="1">自营品牌</option>
                                    <option value="2">代理品牌</option>
                                </select>

                            </dd>
                        </dl>
                        <dl class="zy-brand" style="border-bottom:none;">
                            <dt><i>*</i>自营品牌：</dt>
                            <dd>
                                <input class="text w200" name="self_owned" id="self_owned" type="text" value="" aria-required="true"><span id="self_owned"></span>
                            </dd>
                        </dl>
                        <dl class="zy-brand" style="border-bottom:none;">
                            <dt><i>*</i>品牌商标电子版：</dt>
                            <dd>
                                <input class="text w120" name="self_owned_band" id="self_owned_band" type="text" value="" aria-required="true"><div class="webuploader-pick" id="self_owned_band_upload">上传图片 <input type="file" name=""></div>
                                <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                            </dd>
                        </dl>
                        <dl class="zy-brand">
                            <dt><i>*</i>品牌授权书电子版：</dt>
                            <dd>
                                <input class="text w120" name="self_owned_authorization" id="self_owned_authorization" type="text" value="" aria-required="true"><div class="webuploader-pick" id="self_owned_authorization_upload">上传图片 <input type="file" name=""></div>
                                <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                            </dd>
                        </dl>
                        <dl class="dl-brand" style="border-bottom:none;">
                            <dt><i>*</i>代理品牌授权书：</dt>
                            <dd>
                                <input class="text w200" name="agency_brand_licensing" id="agency_brand_licensing" type="text" value="" aria-required="true"><span></span>
                            </dd>
                        </dl>
                        <dl  class="dl-brand" style="border-bottom:none;">
                            <dt><i>*</i>公司所在地：</dt>
                            <dd>
                                <input type="hidden" name="agency_bank_address" id="agency_bank_address" class="t" value="" />
                                <input type="hidden" name="province_id" class="id_1" value="" />
                                <input type="hidden" name="city_id" class="id_2" value="" />
                                <input type="hidden" name="area_id" class="id_3" value="" />
                                <input type="hidden" name="street_id" class="id_4" value="" />
                                <div id="d_2">
                                    <select class="select_1" name="yingye_1" onChange="district(this);">
                                        <option value="">--请选择--</option>
                                        <?php foreach($district['items'] as $key=>$val){ ?>
                                            <option value="<?=$val['district_id']?>|1"><?=$val['district_name']?></option>
                                        <?php } ?>
                                    </select>
                                    <select class="select_2 hidden" name="yingye_2" onChange="district(this);" ></select>
                                    <select class="select_3 hidden" name="yingye_3" onChange="district(this);" ></select>
                                </div>
                                <span></span>
                            </dd>
                        </dl>
                        <dl class="dl-brand" style="border-bottom:none;">
                            <dt><i>*</i>公司详细地址：</dt>
                            <dd>
                                <input class="text w200" name="agency_band_address_detail" id="agency_band_address_detail" type="text" value="" aria-required="true"><span id="band_address_detail"></span>
                            </dd>
                        </dl>
                        <dl class="dl-brand" style="border-bottom:none;">
                            <dt><i>*</i>公司电话：</dt>
                            <dd>
                                <input class="text w200" name="band_company_call" id="band_company_call" type="text" value="" aria-required="true"><span></span>
                            </dd>
                        </dl>
                        <dl class="dl-brand">
                            <dt><i>*</i>代理品牌授权书效期：</dt>
                            <dd>
                                <input id="start_time" readonly="readonly" class="datePicer text w80" name="band_start_time" type="text" value="" aria-required="true"><em><i class="iconfont icon-rili"></i></em> - <input id="end_time" readonly="readonly" class="datePicer text w80" name="band_end_time" type="text" value="" aria-required="true"><em><i class="iconfont icon-rili"></i></em>
                                <p class="hint red">结束时间提前30天通知上传新的授权书。如不上传新的授权书商品全部删除</p>

                            </dd>
                        </dl>
                        <input type="hidden" name="shop_company_class" id="company_class" value="">

                        <div class="spl" style="display: none">
                            <h4><em><i>*</i>表示该项必填</em>食品类</h4>
                            <h5>食品生产许可证</h5>
                            <dl style="border-bottom:none;">
                                <dt><i>*</i>食品生产许可证编号：</dt>
                                <dd>
                                    <input class="text w200" name="manufacture_food_id" type="text" value="" aria-required="true"><span id="shop_type"></span>
                                </dd>
                            </dl>
                            <dl style="border-bottom:none;">
                                <dt><i>*</i>食品生产许可证电子版：</dt>
                                <dd>
                                    <input class="text w120" name="food_licence_img" id="food_licence_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="food_licence_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                            </dl>
                            <dl style="border-bottom:none;">
                                <dt><i>*</i>全国工业生产许可证电子版：</dt>
                                <dd>
                                    <input class="text w120" name="nationwide_food_licence_img"  id="nationwide_food_licence_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="nationwide_food_licence_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                            <dl>
                                <dt><i>*</i>生产企业营业执照书电子版：</dt>
                                <dd>
                                    <input class="text w120" name="manufacture_licence_img" id="manufacture_licence_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="manufacture_licence_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                            <h5>食品经营许可证注：所属企业具有食品经营许可证时，此项为必填。</h5>
                            <dl style="border-bottom:none;">
                                <dt><i>*</i>食品经营许可证编号：</dt>
                                <dd>
                                    <input class="text w200" name="food_run_id" type="text" value="" aria-required="true"><span id="shop_type"></span>
                                </dd>
                            </dl>
                            <dl>
                                <dt><i>*</i>食品经营许可证电子版：</dt>
                                <dd>
                                    <input class="text w120" name="food_run_licence_img" id="food_run_licence_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="food_run_licence_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                        </div>
                        <div class="c3" style="display: none">
                            <h4><em><i>*</i>表示该项必填</em>家电电脑3C电子类</h4>
                                <input type="hidden" name="shop_company_class" value="2">
                            <h5>全国工业产品生产许可证</h5>
                            <dl style="border-bottom: none;">
                                <dt><i>*</i>全国工业产品生产许可证编号：</dt>
                                <dd>
                                    <input class="text w200" name="nationwide_appliances_licence_id" type="text" value="" aria-required="true"><span id="shop_type"></span>
                                </dd>
                            </dl>
                            <dl>
                                <dt><i>*</i>全国工业产品生产许可证电子版：</dt>
                                <dd>
                                    <input class="text w120" name="nationwide_appliances_img"  id="nationwide_appliances_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="nationwide_appliances_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                            <h5>3C电子经营许可证注：所属企业具有3C电子经营许可证时，此项为必填。</h5>
                            <dl style="border-bottom: none;">
                                <dt><i>*</i>3C电子经营许可证编号：</dt>
                                <dd>
                                    <input class="text w200" name="c3_business_license_id" type="text" value="" aria-required="true"><span id="shop_type"></span>
                                </dd>
                            </dl>
                            <dl>
                                <dt><i>*</i>3C电子经营许可证电子版：</dt>
                                <dd>
                                    <input class="text w120" name="c3_business_license_img" id="c3_business_license_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="c3_business_license_img_upload" >上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                        </div>
                        <div class="hzp" style="display: none">
                            <h4><em><i>*</i>表示该项必填</em>化妆品类</h4>
                                <input type="hidden" name="shop_company_class" value="3">
                            <h5>化妆品生产许可证注：所属企业具有化妆品生产许可证，此项为必填。</h5>
                            <dl style="border-bottom: none;">
                                <dt><i>*</i>化妆品生产许可证编号：</dt>
                                <dd>
                                    <input class="text w200" name="cosmetics_licence_id" type="text" value="" aria-required="true"><span id="shop_type"></span>
                                </dd>
                            </dl>
                            <dl>
                                <dt><i>*</i>化妆品生产许可证电子版：</dt>
                                <dd>
                                    <input class="text w120" name="cosmetics_licence_img" id="cosmetics_licence_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="cosmetics_licence_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                            <h5>非特殊化妆品备案表注：所属企业具有非特殊化妆品备案表时，此项为必填。</h5>
                            <dl style="border-bottom: none;">
                                <dt><i>*</i>非特殊化妆品备案号：</dt>
                                <dd>
                                    <input class="text w200" name="not_cosmetics_record" type="text" value="" aria-required="true"><span id="shop_type"></span>
                                </dd>
                            </dl>
                            <dl>
                                <dt><i>*</i>非特殊化妆品备案电子版：</dt>
                                <dd>
                                    <input class="text w120" name="not_cosmetics_record_img" id="not_cosmetics_record_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="not_cosmetics_record_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                        </div>
                        <div class="myl" style="display: none">
                            <h4><em><i>*</i>表示该项必填</em>母婴类</h4>
                                <input type="hidden" name="shop_company_class" value="4">
                            <h5>食品生产许可证</h5>
                            <dl style="border-bottom: none;">
                                <dt><i>*</i>食品生产许可证编号：</dt>
                                <dd>
                                    <input class="text w200" name="mon_child_food_id" type="text" value="" aria-required="true"><span id="shop_type"></span>
                                </dd>
                            </dl>
                            <dl>
                                <dt><i>*</i>食品生产许可证电子版：</dt>
                                <dd>
                                    <input class="text w120" name="mon_child_food_img" id="mon_child_food_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="mon_child_food_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                        </div>
                        <div class="jksp" style="display: none">
                            <h4><em><i>*</i>表示该项必填</em>进口商品</h4>
                                <input type="hidden" name="shop_company_class" value="5">
                            <h5>报关单</h5>
                            <dl style="border-bottom: none;">
                                <dt><i>*</i>报关单编号：</dt>
                                <dd>
                                    <input class="text w200" name="import_food_id" type="text" value="" aria-required="true"><span id="shop_type"></span>
                                </dd>
                            </dl>
                            <dl>
                                <dt><i>*</i>报关单电子版：</dt>
                                <dd>
                                    <input class="text w120" name="import_food_img" id="import_food_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="import_food_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                            <h5>卫生检疫检验证明此项为必填。</h5>
                            <dl>
                                <dt><i>*</i>报关单电子版：</dt>
                                <dd>
                                    <input class="text w120" name="disease_inspection_img" id="disease_inspection_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="disease_inspection_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                        </div>
                        <div class="jsl" style="display: none">
                            <h4><em><i>*</i>表示该项必填</em>酒水类</h4>
                               <input type="hidden" name="shop_company_class" value="6">
                            <h5>酒水流通备案登记证</h5>
                            <dl style="border-bottom: none;">
                                <dt><i>*</i>酒水流通备案登记证编号：</dt>
                                <dd>
                                    <input class="text w200" name="drinks_registration_id" type="text" value="" aria-required="true"><span id="shop_type"></span>
                                </dd>
                            </dl>
                            <dl>
                                <dt><i>*</i>酒水流通备案登记证电子版：</dt>
                                <dd>
                                    <input class="text w120" name="drinks_registration_img" id="drinks_registration_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="drinks_registration_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                        </div>
                        <div class="xdl" style="display: none">
                            <h4><em><i>*</i>表示该项必填</em>消毒类</h4>
                               <input type="hidden" name="shop_company_class" value="7">
                            <h5>消毒企业生产许可证注：所属企业具有消毒企业生产许可证，此项为必填。</h5>
                            <dl style="border-bottom: none;">
                                <dt><i>*</i>消毒企业生产许可证编号：</dt>
                                <dd>
                                    <input class="text w200" name="disinfect_licence_id" type="text" value="" aria-required="true"><span id="shop_type"></span>
                                </dd>
                            </dl>
                            <dl>
                                <dt><i>*</i>消毒企业生产许可证电子版：</dt>
                                <dd>
                                    <input class="text w120" name="disinfect_licence_img" id="disinfect_licence_img" type="text" value="" aria-required="true"><div class="webuploader-pick" id="disinfect_licence_img_upload">上传图片 <input type="file" name=""></div>
                                    <p class="hint red">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
                                </dd>
                            </dl>
                        </div>

                    </fieldset>
                    <div class="next"><a href="<?= YLB_Registry::get('base_url')?>/index.php?ctl=Seller_Shop_Settled&met=index&op=step3&rp=step3&apply=<?=$apply?>" class="btn bbc_btns">上一步</a>&nbsp;&nbsp;&nbsp;<a id="btn_apply_company_next" class="btn bbc_btns" href="javascript:void(0);">下一步</a></div>
                </form>
                <script type="text/javascript" src="<?=$this->view->js?>/districtTow.js"></script>
                <script type="text/javascript" src="<?=$this->view->js_com?>/webuploader.js" charset="utf-8"></script>
                <script type="text/javascript" src="<?=$this->view->js_com?>/upload/upload_image.js" charset="utf-8"></script>
                <link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
                <!---  END 新增地址 --->
                <script type="text/javascript" src="<?=$this->view->js?>/district.js"></script>
                <link href="<?= $this->view->css_com ?>/ztree.css" rel="stylesheet" type="text/css">
                <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
                <link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
                <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.combo.js"></script>
                <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.ztree.all.js"></script>
                <script type="text/javascript" src="<?=$this->view->js?>/common.js" charset="utf-8"></script>
                <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js"></script>

                <script type="text/javascript">
                    $(function() {
                        $(".brand-type select").change(function() {
                            var val = $(".brand-type select option:selected").val();

                            switch (val) {
                                case '1':
                                    $(".dl-brand").hide();
                                    $(".zy-brand").show();
                                    $("#agency_brand_licensing").val('');
                                    $("#agency_bank_address").val('');
                                    $("#agency_band_address_detail").val('');
                                    $("#band_company_call").val('');
                                    $(".select_1").val('');
                                    $(".select_2").val('');
                                    $(".select_3").val('');
                                    $("#start_time").val('');
                                    $("#end_time").val('');
                                    break;
                                case '2':
                                    $(".zy-brand").hide();
                                    $(".dl-brand").show();

                                    $("#self_owned").val('');
                                    $("#self_owned_band").val('');
                                    $("#self_owned_authorization").val('');
                                    break;
                            }
                        })

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

                    })
                </script>
                <script>
                    $(function() {

                        //商品类别
                        var opts = {
                            width : 160,
                            //inputWidth : (SYSTEM.enableStorage ? 145 : 208),
                            inputWidth : 180,
                            defaultSelectValue : '-1',
                            //defaultSelectValue : rowData.categoryId || '',
                            showRoot : true,
                            rootTxt: '添加经营类目',
                        }

                        categoryTree = Public.categoryTree($('#select'), opts);

                        $('#select').change(function(){
                            var i = $(this).data("id");
                            if(i != -1){
                                var ajax_url = "./index.php?ctl=Seller_Shop_Settled&met=shopCatBind&typ=json";
                                $.ajax({
                                    url: ajax_url,
                                    data: "cat_id=" + i,
                                    success: function(a) {
                                        if (a.status == 200) {
                                            var tr = '<tr class="shop-item">';
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
                            }else{
                                alert("请选择类目！");
                            }
                        });

                        $('.table_category').on('click', '[data-type="delete"]', function() {
                            $(this).parent('td').parent('tr').remove();
                        });

                        $('select[name=shop_class_id]').change(function () {
                            var goods_cat_id = $('select[name=shop_class_id]').find("option:selected").data('cat-id');
                            if(goods_cat_id){
                                $.ajax({
                                    url: SITE_URL+'?ctl=Goods_Cat&met=getCat&typ=json',
                                    data: "goods_cat_id=" + goods_cat_id,
                                    success: function(e) {
                                        if(e.status == 200){
                                            $('input[name=select_category]').val(e.data.cat_name);
                                            $('.select_cat').show();
                                        }
                                    }
                                });
                            }
                        });
                    });
                </script>
                <script type="text/javascript">
                    $(document).ready(function(){
                        var ajax_url = "./index.php?ctl=Seller_Shop_Settled&met=editShoping&typ=json&apply=<?=$apply?>";
                        $('#form_company_info').validator({
                            ignore: ':hidden',
                            theme: 'yellow_right',
                            timely: 1,
                            stopOnError: false,
                            rules: {
                                tel: [/^[1][0-9]{10}$/, '<?=_('请输入正确的手机号码')?>'],
                                zjtel: [/(^0\d{2,3}[-]?\d{5,9}$)|(^[1][0-9]{10}$)/, '<?=_('请输入正确的电话号码')?>'],
                                shop_name: function(element, params, field) {
                                    var type = $('[name="shop_grade_id"]').find("option:selected").data('type')
                                    if (type) {
                                        if (element.value.indexOf(type) >= 0) {
                                            return '店铺名称不能包含"' + type + '"';
                                        }
                                    }
                                }
                            },

                            fields: {
                                'shop_name': 'required;',
                                'shop_grade_id': 'required;',
                                'joinin_year': 'required;',
                                'shop_class_id': 'required;',
                                'shop_class_bind_id': 'required;',
                                'company_uname': 'required',
                                'company_uphone': 'required;tel',
                                'company_uemail': 'required;email',
                                'company_uqq': 'required',
                                'shop_uname': 'required',
                                'shop_uphone': 'required;tel',
                                'shop_uemail': 'required;email',
                                'shop_uqq': 'required',
                                'run_uname': 'required',
                                'run_uphone': 'required;tel',
                                'run_uemail': 'required;email',
                                'run_uqq': 'required',
                                'after_uname': 'required',
                                'after_uphone': 'required;tel',
                                'after_uemail': 'required;email',
                                'after_uqq': 'required',
                                'company_ucall': 'required;zjtel',
                            },
                            valid: function(form) {
                                //表单验证通过，提交表单
                                $.ajax({
                                    url: ajax_url,
                                    data: $("#form_company_info").serialize(),
                                    success: function(a) {
                                        if (a.status == 200) {
                                            location.href = "./index.php?ctl=Seller_Shop_Settled&met=index&op=step7&res=new&apply=<?=$apply?>";
                                        } else {
                                            alert("操作失败！");
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
                <script>
                    //图片上传
                    $(function(){
                        self_owned_band_uploads = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#self_owned_band_upload',
                            inputHidden: '#self_owned_band'
                        });
                        self_owned_authorization_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#self_owned_authorization_upload',
                            inputHidden: '#self_owned_authorization'
                        });
                        food_licence_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#food_licence_img_upload',
                            inputHidden: '#food_licence_img'
                        });
                        nationwide_food_licence_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#nationwide_food_licence_img_upload',
                            inputHidden: '#nationwide_food_licence_img'
                        });
                        manufacture_licence_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#manufacture_licence_img_upload',
                            inputHidden: '#manufacture_licence_img'
                        });
                        food_run_licence_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#food_run_licence_img_upload',
                            inputHidden: '#food_run_licence_img'
                        });
                        nationwide_appliances_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#nationwide_appliances_img_upload',
                            inputHidden: '#nationwide_appliances_img'
                        });
                        c3_business_license_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#c3_business_license_img_upload',
                            inputHidden: '#c3_business_license_img'
                        });
                        cosmetics_licence_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#cosmetics_licence_img_upload',
                            inputHidden: '#cosmetics_licence_img'
                        });
                        not_cosmetics_record_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#not_cosmetics_record_img_upload',
                            inputHidden: '#not_cosmetics_record_img'
                        });
                        mon_child_food_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#mon_child_food_img_upload',
                            inputHidden: '#mon_child_food_img'
                        });
                        import_food_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#import_food_img_upload',
                            inputHidden: '#import_food_img'
                        });
                        disease_inspection_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#disease_inspection_img_upload',
                            inputHidden: '#disease_inspection_img'
                        });
                        drinks_registration_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#drinks_registration_img_upload',
                            inputHidden: '#disinfect_licence_img'
                        });
                        disinfect_licence_img_upload = new UploadImage({
                            thumbnailWidth: 500,
                            thumbnailHeight: 500,
                            uploadButton: '#disinfect_licence_img_upload',
                            inputHidden: '#disinfect_licence_img'
                        });

                    })
                </script>
                <script>
                    $(function(){

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
                                                var str1 = $('.shop-item-'+catid).children().eq(1).html();
                                                var str2 = $('.shop-item-'+catid).children().eq(2).html();
                                                var str3 = $('.shop-item-'+catid).children().eq(3).html();

                                                if(str1 && str2 && str3){

                                                    var sp = new RegExp("食品");
                                                    var sp1 = str1.match(sp);
                                                    var sp2 = str2.match(sp);
                                                    var sp3 = str3.match(sp);
                                                    if(sp1 || sp2 || sp3){
                                                        $('#company_class').val('1');
                                                        $('.spl').css("display","block");
                                                    }

                                                    var c3 = new RegExp("3C");
                                                    var c31 = str1.match(c3);
                                                    var c32 = str2.match(c3);
                                                    var c33 = str3.match(c3);
                                                    if(c31 || c32 || c33){
                                                        $('#company_class').val('2');
                                                        $('.c3').css("display","block");
                                                    }

                                                    var mz = new RegExp("美妆");
                                                    var mz1 = str1.match(mz);
                                                    var mz2 = str2.match(mz);
                                                    var mz3 = str3.match(mz);
                                                    if(mz1 || mz2 || mz3){
                                                        $('#company_class').val('3');
                                                        $('.hzp').css("display","block");
                                                    }


                                                    var my = new RegExp("婴");
                                                    var my1 = str1.match(my);
                                                    var my2 = str2.match(my);
                                                    var my3 = str3.match(my);
                                                    if(my1 || my2 || my3){
                                                        $('#company_class').val('4');
                                                        $('.myl').css("display","block");
                                                    }


                                                    var jk = new RegExp("进口");
                                                    var jk1 = str1.match(jk);
                                                    var jk2 = str2.match(jk);
                                                    var jk3 = str3.match(jk);
                                                    if(jk1 || jk2 || jk3){
                                                        $('#company_class').val('5');
                                                        $('.jksp').css("display","block");
                                                    }

                                                    var jsl = new RegExp("酒水");
                                                    var jsl1 = str1.match(jsl);
                                                    var jsl2 = str2.match(jsl);
                                                    var jsl3 = str3.match(jsl);
                                                    if(jsl1 || jsl2 || jsl3){
                                                        $('#company_class').val('6');
                                                        $('.jsl').css("display","block");
                                                    }

                                                    var xd = new RegExp("消毒");
                                                    var xd1 = str1.match(xd);
                                                    var xd2 = str2.match(xd);
                                                    var xd3 = str3.match(xd);
                                                    if(xd1 || xd2 || xd3){
                                                        $('#company_class').val('7');
                                                        $('.xdl').css("display","block");
                                                    }
                                                }
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

                        function getCatNew(goods_cat_id,step,checked) {
                            $.ajax({
                                url: SITE_URL+'?ctl=Goods_Cat&met=getCatNew&typ=json',
                                data: "cat_id=" + goods_cat_id,
                                success: function(e) {
                                    if(e.status == 200){
                                        if(e.data && e.data.length > 0){
                                            var str_li = '';
                                            $.each(e.data,function (i) {
                                                if(step == 0){
                                                    str_li+='<li data-step="'+(step*1+1)+'" data-cat-id="'+e.data[i].cat_id+'">'+e.data[i].cat_name+'</li>';
                                                }else{
                                                    str_li+='<li data-step="'+(step*1+1)+'" data-cat-id="'+e.data[i].cat_id+'"><input class="check_box" type="checkbox" '+checked+' >'+e.data[i].cat_name+'</li>';
                                                    setShopCatBind(e.data[i].cat_id,checked);
                                                }
                                            });
                                            $('.cat'+(step*1+1)).html(str_li);
                                        }else{
                                            setShopCatBind(goods_cat_id,checked);
                                        }
                                    }
                                }
                            });
                        }

                        $('.select_cat').on('click', function() {
                            if (!$('.tanchuang').hasClass('loaded')) {
                                var goods_cat_id = $('select[name=shop_class_id]').find("option:selected").data('cat-id');
                                if (goods_cat_id) {
                                    getCatNew(goods_cat_id, 0);
                                    $('.tanchuang').addClass('loaded');
                                } else {
                                    alert('请先选择店铺分类!')
                                }
                            }

                            $('.tanchuang').show();
                        });
                        $('.tanchuang .tanchuang_top b').on('click', function() {
                            $('.tanchuang').hide();
                        });

                        $('.tanchuang ul').delegate('li', 'click', function() {

                            var goods_cat_id = $(this).data('cat-id');
                            var step = $(this).data('step');

                            var checked = '';
                            if ($(this).find('.check_box').is(':checked')) {
                                checked = 'checked';
                            }
                            getCatNew(goods_cat_id, step, checked);

                            $(this).addClass('curr').siblings().removeClass('curr');
                            $('.cat' + (step * 1 + 1)).children().show();
                        });

                        $('.confirm').on('click', function() {
                            $('.tanchuang').hide();
                        });
                        $('.cancel').on('click', function() {
                            $('.tanchuang').hide();
                        });
                    })
                </script>
                <link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?= VER ?>" rel="stylesheet" type="text/css">
                <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
                <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
            </div>
        </div>
        <!--弹窗-->
        <div class="tanchuang">
            <div class="tanchuang_top">
                <span>请选择类目</span>
                <b>X</b>
            </div>
            <ul class="cat1">
            </ul>
            <ul class="cat2">
            </ul>
            <ul class="cat3">
            </ul>
            <div class="tanchuang_bottom">
                <span class="cancel">取消</span>
                <span class="confirm">确定</span>
            </div>
        </div>
        <!--弹窗-->
    </div>
</div>


<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
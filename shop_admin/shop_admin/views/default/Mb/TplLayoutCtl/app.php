<?php if (!defined('ROOT_PATH')) {
    exit('No Permission');
} ?>

<?php
include TPL_PATH . '/' . 'header.php';
// 当前管理员权限
$admin_rights = $this->getAdminRights();
// 当前页父级菜单 同级菜单 当前菜单
$menus = $this->getThisMenus();
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<div class="wrapper page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3><?=$menus['father_menu']['menu_name']?></h3>
                <h5><?=$menus['father_menu']['menu_url_note']?></h5>
            </div>
            <ul class="tab-base nc-row">
                <?php 
                foreach($menus['brother_menu'] as $key=>$val){ 
                    if(in_array($val['rights_id'],$admin_rights)||$val['rights_id']==0){
                ?>
                <li><a <?php if(!array_diff($menus['this_menu'], $val)){?> class="current"<?php }?> href="<?= YLB_Registry::get('url') ?>?ctl=<?=$val['menu_url_ctl']?>&met=<?=$val['menu_url_met']?><?php if($val['menu_url_parem']){?>&<?=$val['menu_url_parem']?><?php }?>"><span><?=$val['menu_name']?></span></a></li>
                <?php 
                    }
                }
                ?>
                
            </ul>
        </div>
    </div>
    <!-- 操作说明 -->
    <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span id="explanationZoom" title="收起提示"></span><em class="close_warn iconfont icon-guanbifuzhi"></em></div>
        <ul>
            <?=$menus['this_menu']['menu_url_note']?>
        </ul>
    </div>

    <form method="post" id="app-setting-form" name="settingForm" class="nice-validator n-yellow" novalidate="novalidate">
        <input type="hidden" name="config_type[]" value="mobile">

        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="site_name">iOS版</label>
                </dt>
                <dd class="opt">
                    <input id="mobile_ios" name="mobile[mobile_ios]" value="" class="ui-input w400" type="text" aria-required="true">
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="site_name">android_code</label>
                </dt>
                <dd class="opt">
                    <input id="mobile_apk_version" name="mobile[mobile_apk_version]" value="" class="w400 ui-input " type="text">
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="site_name">android_name</label>
                </dt>
                <dd class="opt">
                    <input id="mobile_apk_name" name="mobile[mobile_apk_name]" value="" class="w400 ui-input " type="text">
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="site_name">android版更新方式</label>
                </dt>
                <dd class="opt">
                    <span id="source"></span>
                    <!--<input id="mobile_apk_mode" name="mobile[mobile_apk_mode]" value="" class="w400 ui-input " type="text">-->
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="site_name">android版更新日期</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="" class="ui-input ui-datepicker-input" name="mobile[mobile_apk_date]" id="mobile_apk_date">
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="mobile_apk">android下载地址</label>
                </dt>
                <dd class="opt">
                    <input id="mobile_apk" name="mobile[mobile_apk]" value="" class="w400 ui-input " type="text" aria-required="true">
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="site_name">android版描述</label>
                </dt>
                <dd class="opt">
                    <input id="mobile_apk_desc" name="mobile[mobile_apk_desc]" value="" class="w400 ui-input " type="text">
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="site_name">标题1</label>
                </dt>
                <dd class="opt">
                    <input id="mobile_title1" name="mobile[mobile_title1]" value="" class="w400 ui-input " type="text">
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="site_name">标题2</label>
                </dt>
                <dd class="opt">
                    <input id="mobile_title2" name="mobile[mobile_title2]" value="" class="w400 ui-input " type="text">
                </dd>
            </dl>

            <div class="bot"><a href="javascript:void(0);" class="ui-btn ui-btn-sp submit-btn">确认提交</a></div>
        </div>
    </form>
</div>

<?php
include TPL_PATH . '/' . 'footer.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<script src="<?= $this->view->js_com ?>/plugins/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/controllers/config.js" charset="utf-8"></script>

<script>
    $(function(){
        $('#mobile_apk_date').datetimepicker({lang:'ch'}).prop('readonly', 'readonly');
        $(function(){
            $source = $("#source").combo({
                data: [{
                    id: "0",
                    name: "弹窗更新"
                }, {
                    id: "1",
                    name: "静默下载"
                }, {
                    id: "2",
                    name: "强制更新"
                }],
                value: "id",
                text: "name",
                width: 110
            }).getCombo();
        });
        Public.ajaxGet(SITE_URL + '?ctl=Config&met=shop&config_type%5B%5D=mobile&typ=json', {}, function (data){
            if (data.status == 200) {
                var rowData = data.data;
                $('#mobile_ios').val(rowData.mobile_ios.config_value);
                $('#mobile_apk').val(rowData.mobile_apk.config_value);
                $('#mobile_apk_name').val(rowData.mobile_apk_name.config_value);
                $('#mobile_apk_desc').val(rowData.mobile_apk_desc.config_value);
                $('#mobile_apk_version').val(rowData.mobile_apk_version.config_value);
                $('#mobile_apk_date').val(rowData.mobile_apk_date.config_value);
                $('#mobile_title1').val(rowData.mobile_title1.config_value);
                $('#mobile_title2').val(rowData.mobile_title2.config_value);
                $source.selectByIndex(rowData.mobile_apk_mode.config_value)
            } else {
                Public.tips({type:1, content:data.msg});
            }
        })

        $('#app-setting-form').on("click", "a.submit-btn", function(e) {
            parent.$.dialog.confirm('修改立马生效,是否继续？', function() {
                source = $source.getValue();
                Public.ajaxPost(SITE_URL + '?ctl=Config&met=edit&typ=json', $.param({'mobile[mobile_apk_mode]':source})+'&'+$('#app-setting-form').serialize(), function(data) {
                    if (data.status == 200) {
                        parent.Public.tips({
                            content: '修改操作成功！'
                        });
                    } else {
                        parent.Public.tips({
                            type: 1,
                            content: data.msg || '操作无法成功，请稍后重试！'
                        });
                    }
                });
            })
        });
    })
</script>
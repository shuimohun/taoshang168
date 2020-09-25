<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<link href="<?= $this->view->css ?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css">
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/webuploader.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/models/upload_image.js" charset="utf-8"></script>
<style>
    body{background: #fff;}
    .mod-form-rows .label-wrap{font-size:12px;}
    .mod-form-rows .row-item {padding-bottom: 15px;margin-bottom: 0;}/*兼容IE7 ，重写common的演示*/
    .manage-wrapper{margin:20px auto 10px;width:600px;}
    .manage-wrap .ui-input{width: 198px;}
    .base-form{*zoom: 1;}
    .base-form:after{content: '.';display: block;clear: both;height: 0;overflow: hidden;}
    .base-form li{float: left;width: 290px;}
    .base-form li.odd{padding-right:20px;}
    .base-form li.last{width:350px}
    .manage-wrap textarea.ui-input{width: 588px;height: 32px;overflow:hidden;}
    .contacters{margin-bottom: 10px;}
    .contacters h3{margin-bottom: 10px;font-weight: normal;}
    .remark .row-item{padding-bottom:0;}
    .mod-form-rows .ctn-wrap{overflow: visible;}
    .grid-wrap .ui-jqgrid{border-width:1px 0 0 1px;}
    .labels{margin-left:10px;}
    .laydate-icon{padding: 5px;width: 198px;height: 18px;line-height: 18px;border: 1px solid #e2e2e2;color: #555;outline: 0;}
</style>
</head>
<body>
<div class="manage-wrapper">
    <div id="manage-wrap" class="manage-wrap">
        <form id="manage-form" action="">
            <div class="ncap-form-default">
                <dl class="row">
                    <dt class="tit">
                        <label for="opening_name">模块名称</label>
                    </dt>
                    <dd class="opt">
                        <input id="opening_name" name="opening_name" class="ui-input w200" type="text" value=""/>
                    </dd>
                </dl>

                <dl class="row">
                    <dt class="tit">
                        <label for="opening_tit_image">wap图片上传</label>
                    </dt>
                    <dd class="opt">
                        <img id="opening_tit_image" name="opening_tit_image" alt="选择图片" src="./shop_admin/static/common/images/image.png" class="image-line"/>
                        <div class="image-line"  id="opening_upload">上传图片<i class="iconfont icon-tupianshangchuan"></i></div>
                        <input id="opening_tit_logo" name="opening_tit_image" class="ui-input w400" type="hidden"/>
                        <div>上传图片规格750*188</div>
                    </dd>

                </dl>

            </div>
        </form>
    </div>
</div>
<script>
    //图片上传
    $(function () {
        buyer_logo_upload = new UploadImage({
            thumbnailWidth:750,
            thumbnailHeight:190,
            imageContainer: '#opening_tit_image',
            uploadButton: '#opening_upload',
            inputHidden: '#opening_tit_logo'
        });
    })
</script>
<script type="text/javascript" src="<?= $this->view->js ?>/controllers/operation/settingTier.js" charset="utf-8"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>

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
<script type="text/javascript" src="<?= $this->view->js ?>/controllers/adv/laydate/laydate.js" charset="utf-8"></script>
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
    		<ul class="mod-form-rows base-form cf" id="base-form">
    			<li class="row-item odd">
    				<div class="label-wrap"><label for="brand_name">广告位名称</label></div>
    				<div class="ctn-wrap"><input type="text" value="" class="ui-input" name="type_name" id="type_name"></div>
    			</li>

                <li class="row-item">
    				<div class="label-wrap"><label for="shop_name">广告位类型</label></div>
    				<div class="ctn-wrap"><input type="text" value="" class="ui-input" name="adv_type" id="adv_type"></div>
    			</li>

                <li class="row-item odd">
    				<div class="label-wrap"><label for="brand_name">广告位价格</label></div>
    				<div class="ctn-wrap"><input type="text" value="" class="ui-input" name="price" id="price"></div>
    			</li>

                <li class="row-item ">
    				<div class="label-wrap"><label for="brand_displayorder">广告位单位</label></div>
    				<div class="ctn-wrap">
                        <input placeholder="请输入月/周/日"  type="text" value="" class="ui-input" name="unit" id="unit">
                    </div>
    			</li>

    			<li class="row-item odd">
    				<div class="label-wrap"><label for="brand_name">数量</label></div>
    				<div class="ctn-wrap"><input type="text" value="" class="ui-input" name="total" id="total" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/"></div>
    			</li>

                <li class="row-item ">
                    <div class="label-wrap"><label for="brand_displayorder">图片宽度</label></div>
                    <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="width" id="width" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/"></div>
                </li>

                <li class="row-item odd">
                    <div class="label-wrap"><label for="brand_name">图片高度</label></div>
                    <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="height" id="height" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/"></div>
                </li>
    		</ul>
    	</form>
    </div>
</div>

<script type="text/javascript" src="<?= $this->view->js_com ?>/webuploader.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/models/upload_image.js" charset="utf-8"></script>
<!--<script type="text/javascript" src="<?/*= $this->view->js */?>/controllers/adv/ListTypNav.js" charset="utf-8"></script>-->
<script type="text/javascript" src="<?= $this->view->js ?>/controllers/adv/Typ_advmanage.js" charset="utf-8"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
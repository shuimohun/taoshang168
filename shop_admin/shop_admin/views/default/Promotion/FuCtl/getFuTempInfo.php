<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link href="<?=$this->view->css?>/complain.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="manage-wrap">
    <div class="ncap-form-default" style="padding-top:50px;">
    <form id="fu_t_info" action="" method="post">
    <input type="hidden" name="fu_id" id="fu_id" value="<?=($data['fu_id'])?>">
        <dl class="row">
            <dt class="tit">微信好友：</dt>
            <dd class="opt"><input type="text" class="weixin" name="weixin" value="<?=$data['fu_base']['weixin']?>"/></dd>
        </dl>
        <dl class="row">
            <dt class="tit">微信朋友圈：</dt>
            <dd class="opt"><input type="text" class="weixin_timeline" name="weixin_timeline" value="<?=$data['fu_base']['weixin_timeline']?>"/></dd>
        </dl>
        <dl class="row">
            <dt class="tit">QQ好友：</dt>
            <dd class="opt"><input type="text" class="sqq" name="sqq" value="<?=$data['fu_base']['sqq']?>"/></dd>
        </dl>
        <dl class="row">
            <dt class="tit">QQ空间：</dt>
            <dd class="opt"><input type="text" class="qzone" name="qzone" value="<?=$data['fu_base']['qzone']?>"/></dd>
        </dl>
        <dl class="row">
            <dt class="tit">新浪微博：</dt>
            <dd class="opt"><input type="text" class="tsina" name="tsina" value="<?=$data['fu_base']['tsina']?>"/></dd>
        </dl>
        <dl class="row">
            <dt class="tit">排序：</dt>
            <dd class="opt"><input type="text" class="fu_sort" name="fu_sort" value="<?=$data['fu_sort']?>"/></dd>
        </dl>
        <div class="bot"><a href="javascript:void(0);" class="ui-btn ui-btn-sp submit-btn" id="submitBtn">确认提交</a></div>
    </form>
    </div>
</div>

<script type="text/javascript" src="<?=$this->view->js?>/controllers/promotion/fu/fu_temp_info.js" charset="utf-8"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
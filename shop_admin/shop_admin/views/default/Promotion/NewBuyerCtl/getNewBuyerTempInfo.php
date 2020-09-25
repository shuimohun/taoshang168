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
    <form id="newbuyer_t_info" action="" method="post">
    <input type="hidden" name="newbuyer_id" id="newbuyer_id" value="<?=($data['newbuyer_id'])?>">
        <dl class="row">
            <dt class="tit">状态：</dt>
            <dd class="opt">
                <label for="ttype_1"><input type="radio" value="1" class="v_t_type" name="newbuyer_type"  <?=($data['newbuyer_type']==1 ? 'checked' : '')?>>1分</label>
                <label for="ttype_2"><input type="radio" value="2" class="v_t_type" name="newbuyer_type"  <?=($data['newbuyer_type']==2 ? 'checked' : '')?>>1毛</label>
                <label for="ttype_3"><input type="radio" value="3" class="v_t_type" name="newbuyer_type"  <?=($data['newbuyer_type']==3 ? 'checked' : '')?>>1元</label>
                <label for="ttype_4"><input type="radio" value="4" class="v_t_type" name="newbuyer_type"  <?=($data['newbuyer_type']==4 ? 'checked' : '')?>>顶部广告</label>
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">排序：</dt>
            <dd class="opt"><input type="text" class="newbuyer_sort" name="newbuyer_sort" value="<?=$data['newbuyer_sort']?>"/></dd>
        </dl>
        <div class="bot"><a href="javascript:void(0);" class="ui-btn ui-btn-sp submit-btn" id="submitBtn">确认提交</a></div>
    </form>
    </div>
</div>

<script type="text/javascript" src="<?=$this->view->js?>/controllers/promotion/newbuyer/newbuyer_temp_info.js" charset="utf-8"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
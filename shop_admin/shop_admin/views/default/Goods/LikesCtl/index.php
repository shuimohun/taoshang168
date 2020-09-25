<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
// 当前管理员权限
$admin_rights = $this->getAdminRights();
// 当前页父级菜单 同级菜单 当前菜单
$menus = $this->getThisMenus();


?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<style>
    .ui-jqgrid tr.jqgrow .img_flied{padding: 1px; line-height: 0px;}
    .img_flied img{width: 60px; height: 60px;}

    .unlike {
        left:50px;position:relative;
    }

</style>
</head>
<body>
<div class="wrapper page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>猜你喜欢</h3>
                <h5>猜你喜欢商品管理</h5>
            </div>
            <ul class="tab-base nc-row">
                  <li><a  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=common" <?=((-1 == request_int('common_state', '-1') && -1 == request_int('common_verify', '-1')) ? 'class="current"' : '')?>><span>猜你喜欢</span></a></li>
            </ul>
        </div>
    </div>


    <div class="mod-search cf">
        <div class="fr">
            <a href="#" class="ui-btn ui-btn-sp mrb" id="btn-add">
                新增<i class="iconfont icon-btn03"></i>
            </a>
        </div>
    </div>

    <div class="cf">
        <div class="grid-wrap">
            <table id="grid"></table>
            <div id="page"></div>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?=$this->view->js?>/controllers/goods/common_like_list.js" charset="utf-8"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>

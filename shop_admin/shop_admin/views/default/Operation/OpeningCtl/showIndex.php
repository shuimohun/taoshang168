<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
</head>
<body>
<div class="wrapper page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>商城开业数据</h3>
                <h5>商城开业数据变更修改</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a class="current"  href="<?= YLB_Registry::get('url') ?>?ctl=Operation_Opening&met=showIndex"><span>开业数据</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Operation_Opening&met=headImage"><span>头部图片</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Operation_Opening&met=floorData"><span>楼层数据</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Config&met=opening"><span>开业设置</span></a></li>
            </ul>
        </div>
    </div>
    <div class="mod-toolbar-top cf">
        <div class="left" style="float: left;"></div>
        <div class="fr">
            <a class="ui-btn" id="btn-refresh">刷新<i class="iconfont icon-btn01"></i></a>
        </div>
    </div>

    <div class="grid-wrap">
        <table id="grid"></table>
        <div id="page"></div>
    </div>
</div>


<script type="text/javascript" src="<?=$this->view->js?>/controllers/operation/opening_index.js" charset="utf-8"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
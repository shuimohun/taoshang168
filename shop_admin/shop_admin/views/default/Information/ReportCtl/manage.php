<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
    include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>

</head>
<body>

<div class="wrapper page" >
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>举报记录</h3>
                <h5>举报记录</h5>
            </div>
        </div>
    </div>

    <div class="mod-toolbar-top cf">
        <div class="left" style="float: left;">
        </div>
        <div class="fr">
            <a class="ui-btn" id="btn-refresh">刷新<i class="iconfont icon-btn01"></i></a>
        </div>
    </div>
    <div class="grid-wrap">
        <input type="hidden" id="information_id" value="<?=request_int('information_id')?>">
        <table id="grid">
        </table>
        <div id="page"></div>
    </div>
</div>

<script type="text/javascript" src="<?= $this->view->js ?>/controllers/information/report_manage.js" charset="utf-8"></script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
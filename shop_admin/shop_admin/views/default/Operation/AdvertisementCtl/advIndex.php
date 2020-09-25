<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<style>

    .ui-jqgrid tr.jqgrow .img_flied{padding: 1px; line-height: 0px;}
    .img_flied img{width: 60px; height: 60px;}

</style>
</head>
<body style="background-color: #FFF; overflow: auto;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>

<div class="wrapper page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>广告管理</h3>
                <h5>广告管理及广告审核</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="index.php?ctl=Operation_Advertisement&met=type"  >广告位管理</a></li>
                <li><a href="index.php?ctl=Operation_Advertisement&met=advIndex" class="current" >广告管理</a></li>
<!--                <li><a href="index.php?ctl=Operation_Advertisement&met=check" >待审核</a></li>-->
            </ul>
        </div>
    </div>


    <div class="mod-search cf">
        <div class="fl">
            <ul class="ul-inline">
                <li>
                    <input type="text" id="matchCon" class="ui-input ui-input-ph matchCon" placeholder="按广告名称" value="">
                </li>
                <li>
                    <span id="group"></span>
                </li>
                <li><a class="ui-btn mrb" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
            </ul>
        </div>
        <div class="fr">
            <!--            <a href="#" class="ui-btn mrb" id="btn-batchDel">删除<i class="iconfont icon-btn02"></i></a>-->
            <a href="#" class="ui-btn ui-btn-sp mrb" id="btn-add">新增<i class="iconfont icon-btn03"></i></a>
            <!--<a href="#" class="ui-btn mrb" id="btn-print">打印</a>-->
            <a href="javascript:void(0)" class="ui-btn mrb" id="export">导出<i class="iconfont icon-btn04"></i></a>
        </div>
    </div>
    <div class="grid-wrap">
        <table id="grid">
        </table>
        <div id="page"></div>
        <div></div>
    </div>
</div>
<script type="text/javascript" src="<?=$this->view->js?>/controllers/adv/Adv.js" charset="utf-8"></script>
<script>
      var group_row = <?= encode_json(array_values($data['group'])) ?>;
</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>

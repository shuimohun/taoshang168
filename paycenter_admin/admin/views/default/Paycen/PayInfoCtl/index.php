<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<?php
include TPL_PATH . '/'  . 'header.php';
?>
    <style>
        div.zoomDiv{z-index:999;position:absolute;top:0px;left:0px;width:400px!important;height:254px!important;background:#ffffff;display:none;text-align:center;overflow:hidden;}
        div.zoomMask{position:absolute;background:url("http://demo.lanrenzhijia.com/2015/jqzoom0225/images/mask.png") repeat scroll 0 0 transparent;cursor:move;z-index:1;}
        div.zoomDiv img{width:400px!important;height:254px!important;}
    </style>
    </head>
    <div class="wrapper page">
        <p class="warn_xiaoma"><span></span><em></em></p>
        <div class="explanation" id="explanation">
            <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
                <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
                <span id="explanationZoom" title="收起提示"></span><em class="close_warn">X</em>
            </div>
            <ul>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="fixed-bar">
            <div class="item-title">
                <div class="subject">
                    <h3>实名认证</h3>
                    <h5>相关实名认证信息总览</h5>
                </div>
                <ul class="tab-base nc-row">
                    <li><a class="current"><span>实名认证</span></a></li>
                </ul>
            </div>
        </div>
        <div class="ncap-form-default">
            <div class="mod-search cf">
                <div class="fl">
                    <ul class="ul-inline">
                        <li><input type="text" id="userName" class="ui-input ui-input-ph con" value="请输入会员昵称"></li>
                        <li><a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                    </ul>
                </div>
                <div class="fr">
                </div>
            </div>
            <div class="grid-wrap">
                <table id="grid"></table>
                <div id="page"></div>
            </div>
        </div>
    </div>
    <script src="./admin/static/default/js/controllers/payinfo/jquery.imagezoom.small.js"></script>
    <script src="./admin/static/default/js/controllers/payinfo/payinfo_list.js"></script>
<?php
include TPL_PATH . '/'  . 'footer.php';
?>
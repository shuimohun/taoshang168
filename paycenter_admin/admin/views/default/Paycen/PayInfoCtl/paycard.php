<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<?php
include TPL_PATH . '/'  . 'header.php';
?>
</head>
    <div class="wrapper page">

        <div class="fixed-bar">
            <div class="item-title">
                <div class="subject">
                    <h3>银行卡认证</h3>
                    <h5>相关银行卡认证信息总览</h5>
                </div>
                <ul class="tab-base nc-row">
                    <li><a class="current"><span>银行卡认证</span></a></li>
                </ul>
            </div>
        </div>
        <div class="ncap-form-default">

            <div class="mod-search cf">
                <div class="fl">
                    <ul class="ul-inline">
                        <li>
                            <input type="text" id="userName" class="ui-input ui-input-ph con" value="请输入会员昵称">
                        </li>
                        <li><a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                    </ul>
                </div>

            </div>
            <div class="grid-wrap">
                <table id="grid">
                </table>
                <div id="page"></div>
            </div>
        </div>

    </div>
    <script src="./admin/static/default/js/controllers/payinfo/paycard_list.js"></script>
<?php
include TPL_PATH . '/'  . 'footer.php';
?>
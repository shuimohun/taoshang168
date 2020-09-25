<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/404.css" media="screen" />
<div id="da-wrapper" class="fluid">
    <div id="da-content">
        <div class="da-container clearfix">
            <div id="da-error-wrapper">
                <div id="da-error-pin"></div>
                <div id="da-error-code">
                    <span><?=_('错误')?></span> </div>
                <h1 class="da-error-heading"><?=isset($_REQUEST['msg']) ? $_REQUEST['msg'] : _('抱歉，只能在卖家发货后才能进行退货！')?></h1>
                <p> <a onclick="history.go(-1);"><?=_('点击返回')?></a></p>
            </div>
        </div>
    </div>
</div>
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>

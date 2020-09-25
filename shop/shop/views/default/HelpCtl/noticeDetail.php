<?php include $this->view->getTplPath() . '/' . 'rule_header.php'; ?>
	<link type="text/css" rel="stylesheet" href="<?= $this->view->css ?>/rule_base.css"/>
    <link type="text/css" rel="stylesheet" href="<?= $this->view->css ?>/pop_rulers.css" source="widget"/>
    <script type="text/javascript" src="<?= $this->view->js ?>/rule_base.js"></script>

    <style>
        #shengtaiquan-top:hover,#shengtaiquan-bottom:hover{
            position: absolute;
            height: 130px;
            width: 130px;
            margin-left: -130px;
        }
    </style>

    <div class="l-nav">
        <div class="w">
            <ul class="b-nav-list">
                <li class="li-item">
                    <a href="<?= YLB_Registry::get('url') . '?ctl=Rule&met=index'?>" clstag="pageclick|keycount|rule_home|2" class="link-dlk">首页</a>
                </li>
                <li class="li-item">
                    <a href="<?= YLB_Registry::get('url') . '?ctl=Rule&met=ruleOverview'?>" clstag="pageclick|keycount|rule_home|3" class="link-dlk">规则总览</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="l-wrap">
        <div class="l-main">
            <div class="breadcrumb">
                <a href="<?= YLB_Registry::get('url') . '?ctl=Rule&met=index'?>">首页</a>
                &nbsp;&gt;&nbsp;
                <span class="i-txt">最新公告</span>
            </div>
            <div class="l-menu-wrap">
                <div class="l-menu-box">
                    <ul class="sub-menu-list">
                        <?php
                        foreach ($notice['items'] as $k => $data):
                        ?>
                        <li class="menu-item" ><a href="<?= YLB_Registry::get('url') ?>?ctl=News&met=detail&id=<?= $data['help_id'] ?>" class="link-dlk"><?= ($data['help_title'])?><i class="menu-icon-tria"></i></a></li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>
            </div>
            <?php

                foreach ($notice['items'] as $key => $detail):
            ?>
            <div class="l-content" style="display: none">
                <div class="o-mt">
                    <h2 class="h-title"><?= ($detail['help_title'])?></h2>
                </div>
                <?= ($detail['help_desc'])?>
            </div>
            <?php
            endforeach;
            ?>
        </div>
        <script>
            $('.menu-item').eq(0).addClass('menu-item-current');
            $('.l-content').eq(0).attr('style','display:block');
            $('.sub-menu-list').find('li').click(function () {
                $('.menu-item').removeClass('menu-item-current');
                $(this).addClass('menu-item-current');
                $('.l-content').attr('style','display:none');
                $('.l-content').eq($(this).index()).removeAttr('style');
                return false;
            })
        </script>

    <?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>
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
                <span class="i-txt">
                    <a href="<?= YLB_Registry::get('url') . '?ctl=Rule&met=index' ?>">首页</a>
                </span>
                &nbsp;&gt;&nbsp;
                <a href="<?= YLB_Registry::get('url') . '?ctl=Rule&met=ruleOverview&id=' ?><?= ($group_id)?>"> <span class="i-txt"><?= $group_title?></span></a>
                &nbsp;&gt;&nbsp;
                <span class="i-txt"><?= ($detail['help_title'])?></span>
            </div>

            <div class="l-main-inner">
                <div class="o-mt">
                    <h2 class="h-title"><?= ($detail['help_title'])?></h2>
                </div>
                <div class="b-content" id="floorcontent">
                    <?= ($detail['help_desc'])?>
                </div>
                <div class="b-inner-fd">
<!--                    <a href="//jimi.jd.com?id=zyMrYb" class="link-underline"> <i class="icon-ques"></i>-->
<!--                        我有疑问，我要在线咨询-->
<!--                    </a>-->
                    <a href="<?= YLB_Registry::get('url') . '?ctl=Rule&met=index'?>" class="link-underline"> <i class="icon-more"></i>
                        我还想看更多相关规则
                    </a>
                </div>
            </div>
        </div>

    </div>
    

<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>
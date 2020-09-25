
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
﻿<link rel="stylesheet" type="text/css" href="<?= $this->view->js_com ?>/ueditor/third-party/video-js/video-js.min.css"/>

<div class="Colr">
    <div class="wrapper ">
        <div class="nch-container clearfix">
            <div class="left">
                <div class="nch-module nch-module-style01">
                    <div class="title">
                        <h3>帮助分类</h3>
                    </div>
                    <div class="content">
                        <div class="nch-sidebar-article-class">
                            <ul>
                                <?php foreach($data_all_group as $k1=>$v1): ?>
                                <li><a href="index.php?ctl=Help_Base&met=index&help_group_id=<?=$k1 ?>"><?=$v1['help_group_title']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="nch-article-con">
                    <?php if(!empty($data_help)){ ?>
                    <h1><?=$data_help['help_title'] ?></h1>
                    <h2><?=$data_help['help_add_time'] ?></h2>
                    <div class="default">
                        <p><?=$data_help['help_desc'] ?></p>
                    </div>
                    <?php }elseif(!empty($data_help_list)){ ?>
                        <h3><?=$data_help_list['group_name']?></h3>
                        <ul class="nch-article-list">
                            <?php if(!empty($data_help_list['help'])): foreach($data_help_list['help'] as $k3=>$v3): ?>
                            <li><i></i><a href="index.php?ctl=Help_Base&met=index&help_id=<?=$v3['help_id'] ?>"><?=$v3['help_title']?></a><time><?=$v3['help_add_time']?></time></li>
                            <?php endforeach; endif;?>
                        </ul>
                    <?php }?>
                    <div class="more_article">
                        <span class="fl">上一篇：
                            <?php if(!empty($data_near_help['front'])){ ?>
                            <a href="index.php?ctl=Help_Base&met=index&help_id=<?=$data_near_help['front']['help_id'] ?>"><?=$data_near_help['front']['help_title']?></a> <time><?=$data_near_help['front']['help_add_time']?></time>
                            <?php }else{ ?>
                                <a>没有了</a>
                            <?php } ?>
                        </span>
                        <span class="fr">下一篇：
                            <?php if(!empty($data_near_help['behind'])){ ?>
                                <a href="index.php?ctl=Help_Base&met=index&help_id=<?=$data_near_help['behind']['help_id'] ?>"><?=$data_near_help['behind']['help_title']?></a> <time><?=$data_near_help['behind']['help_add_time']?></time>
                            <?php }else{ ?>
                                <a>没有了</a>
                            <?php } ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
</div>


<script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/third-party/video-js/video.js"></script>


<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
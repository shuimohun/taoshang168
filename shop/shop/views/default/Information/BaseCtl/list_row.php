<?php
$user_id = Perm::$userId;
$user_id = (isset($user_id) && $user_id) ? $user_id : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head>
    <meta charset="utf-8">
    <title>
        <?php if(isset($data_information['information_title'])){
            print_r($data_information['information_title']);
        }
        elseif(isset($data_information_list['group_name'])){
            print_r($data_information_list['group_name']);
        }?>
    </title>
    <style>
        .heart {
            width: 100px;
            height: 100px;
            background: url("<?=$this->view->img?>/heart.png") no-repeat;
            background-position: 0 0;
            cursor: pointer;
            -webkit-transition: background-position 1s steps(28);
            transition: background-position 1s steps(28);
            -webkit-transition-duration: 0s;
            transition-duration: 0s;
        }

        .heart.is-active {
            -webkit-transition-duration: 1s;
            transition-duration: 1s;
            background-position: -2800px 0;
        }

        .stage {
            width: 65px;
            height: 49px;
            margin-bottom: 12px;
            float:right;
            position: relative;
        }
        .pc_img{
            width: 500px;
            height: 300px;
            border: 1px #9a9a9a solid;
            margin: 0 auto;
        }
        .pc_img > img{
            width:500px;
            height:300px;
        }
        .nch-article-list li{
            height: auto !important;
        }
        .nch-article-list li i{
            width: 80px !important;
            height: 80px !important;
        }
        .nch-article-list li i img{
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body style="background:#fff;">
<?php
/*@liuguilong 20170606 : 头部单独用一个*/
include $this->view->getTplPath() . '/' . 'information_header.php';
?>
<div class="hr">
</div>
<div class="Colr">
    <div class="wrapper ">
        <div class="nch-container clearfix">
            <div class="left">
<!--最新资讯 start-->
                <div class="nch-module nch-module-style03">
                    <div class="title">
                        <h3>最新资讯</h3>
                    </div>
                    <div class="content">
                        <ul class="nch-sidebar-article-list">
                            <?php foreach($data_recent_information as $k2=>$v2): ?>
                            <li>
                                <i></i>
                                <a href="index.php?ctl=Information_Base&met=index&information_id=<?=$k2 ?>">
                                    <?=$v2['information_title'] ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
<!--最新资讯 end-->

            </div>
            <div class="right">
                <div class="nch-article-con">
               <?php if(!empty($data_information_list)){ ?>

                        <h3><?=$data_information_list['group_name']?></h3>
                        <ul class="nch-article-list">
                            <?php if(!empty($data_information_list['information'])): foreach($data_information_list['information'] as $k3=>$v3): ?>
                            <li>
                                <i>
                                    <img src="<?=$v3['information_pic']?>">
                                </i>
                                <a href="index.php?ctl=Information_Base&met=index&information_id=<?=$v3['information_id'] ?>">
                                    <?=$v3['information_title']?>
                                </a>
                                <time><?=$v3['information_add_time']?></time>
                            </li>
                            <?php endforeach; endif;?>
                        </ul>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
</div>

</body>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
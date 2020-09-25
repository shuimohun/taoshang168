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
                    <!-- 点赞 start-->
                    <div class="stage">
                        <div class="heart <?php echo $isLike==1 ? 'is-active' : '';?>"></div>
                    </div>
                    <!-- 点赞 end-->

                    <?php if(!empty($data_information)){ ?>

                    <h1><?=$data_information['information_title'] ?></h1>
                    <h2>
                        <?=$data_information['information_add_time'] ?>
                        &nbsp;&nbsp;
                        <?php if($data_information['information_read_count']!=0 || $data_information['information_read_count']!=''){ ?>
                             <?='阅读次数: <span style="color:orangered">'.($data_information['information_fake_read_count'] + $data_information['information_read_count']).'</span>'?>
                        <?php }else{ ?>
                             <?='阅读次数: <span style="color:orangered">'.$data_information['information_fake_read_count'].'</span>'?>
                        <?php } ?>
                    </h2>
                    <div class="pc_img"><img src="<?=$data_information['information_pic']?>" alt=""></div>
                    <div class="default">

                        <p><?=$data_information['information_desc'] ?></p>
                    </div>

                    <?php }elseif(!empty($data_information_list)){ ?>

                        <h3><?=$data_information_list['group_name']?></h3>
                        <ul class="nch-article-list">
                            <?php if(!empty($data_information_list['information'])): foreach($data_information_list['information'] as $k3=>$v3): ?>
                            <li>
                                <i>
                                    <img src="<?=$this->view->img?>/heart.png"> 
                                </i>
                                <a href="index.php?ctl=Information_Base&met=index&information_id=<?=$v3['information_id'] ?>">
                                    <?=$v3['information_title']?>
                                </a>
                                <time><?=$v3['information_add_time']?></time>
                            </li>
                            <?php endforeach; endif;?>
                        </ul>
                    <?php }?>

                    <!--百度分享 start-->
                    <div class="bdsharebuttonbox" style="float:right;margin-top:-20px;width:150px;">
                        <a href="#" class="bds_more" data-cmd="more"></a>
                        <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                        <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                        <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                        <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                        <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                    </div>
                    <!--百度分享 end-->

                    <div class="more_article">
                        <span class="fl">上一篇：
                            <?php if(!empty($data_near_information['front'])){ ?>
                            <a href="index.php?ctl=Information_Base&met=index&information_id=<?=$data_near_information['front']['information_id'] ?>">
                                <?=mb_substr($data_near_information['front']['information_title'],0,15,'utf-8')?>
                            </a>
                                <time><?=$data_near_information['front']['information_add_time']?></time>
                            <?php }else{ ?>
                                <a>没有了</a>
                            <?php } ?>
                        </span>
                        <span class="fr">下一篇：
                            <?php if(!empty($data_near_information['behind'])){ ?>
                                <a href="index.php?ctl=Information_Base&met=index&information_id=<?=$data_near_information['behind']['information_id'] ?>">
                                    <?=mb_substr($data_near_information['behind']['information_title'],0,15,'utf-8')?>
                                </a>
                                <time><?=$data_near_information['behind']['information_add_time']?></time>
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

<!--百度分享js start-->
<script>
    var url = location.href;
    window._bd_share_config = {
        "common":
        {
            "bdSnsKey":{},
            "bdText":"<?=$data_information['information_tile']?>",
            "bdMini":"2",
            "bdMiniList":false,
            "bdPic":"",
            "bdStyle":"0",
            "bdSize":"16",
            "dbUrl":url +"&uid=" + <?php echo $user_id;?>,
        },
        "share":{}
    };

    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
</script>
<!--百度分享js end-->
</body>

<script>
    $(function() {
        var isLike = <?php echo $isLike==1 ? 1 : 0;?>; //是否点赞
        var information_id = <?php echo $data_information['information_id'];?>;
        var user_id = <?php echo $user_id;?>;
        var like_url = SITE_URL + "?ctl=Information_Like&met=like&typ=json";
        var unlike_url = SITE_URL + "?ctl=Information_Like&met=unLike&type=json";
        $(".heart").on("click", function() {
            if(!isLike){
                isLike = 1;
                data = {information_id:information_id,user_id:user_id};
                heartDom = $(this);
                $.post(like_url,data,function(msg){
                    if(msg.status == 200){
                        heartDom.addClass("is-active");
                    }else{
                        alert('点赞失败');
                    }
                });
            }else{
                isLike = 0;
                data1 = {information_id:information_id,user_id:user_id};
                heartDom = $(this);
                $.post(unlike_url,data1,function(msg){
                    heartDom.removeClass("is-active");
                });
            }
        });

    });
</script>


<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
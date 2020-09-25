<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-touch-fullscreen" content="yes" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="msapplication-tap-highlight" content="no" />
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
	<title>个人注册</title>
	<link rel="stylesheet" href="<?=$this->view->css?>/register.css">
	<link rel="stylesheet" href="<?=$this->view->css?>/base.css">
	<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/headfoot.css" />
	<link rel="stylesheet" href="<?= $this->view->css ?>/iconfont/iconfont.css">
	<script src="<?=$this->view->js?>/jquery-1.9.1.js"></script>
	<script src="<?=$this->view->js?>/respond.js"></script>
</head>

<?php
    $from = request_string('from');
    $callback = YLB_Registry::get('re_url');
    extract($_GET);

    $qq_url = sprintf('%s?ctl=Connect_Qq&met=login&fu=1&callback=%s', YLB_Registry::get('url'), urlencode($callback));
    $wx_url = sprintf('%s?ctl=Connect_Weixin&met=login&fu=1&callback=%s', YLB_Registry::get('url'), urlencode($callback));
    $wb_url = sprintf('%s?ctl=Connect_Weibo&met=login&fu=1&callback=%s', YLB_Registry::get('url'), urlencode($callback));

    $connect_rows = YLB_Registry::get('connect_rows');

    $qq = $connect_rows['qq']['status'];
    $wx = $connect_rows['weixin']['status'];
    $wb = $connect_rows['weibo']['status'];

    if ($wx && YLB_Utils_Device::isMobile() && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false)
    {
        $wx = 0;
    }
?>

<body>
<div class="container w">
    <div id="header"><a href="javascript:history.go(-1)" class="back-pre"></a>账户注册<a href="<?=sprintf('%s?ctl=Login&met=index&t=%s&from=%s&callback=%s', YLB_Registry::get('url'), request_string('t'), request_string('from'), urlencode(request_string('callback')))?>" class="back-to-login">登录</a></div>
    <div class="main clearfix" id="form-main">
        <div class="reg-form reg_form_relation">
            <div class="reg_share_style">
                <?php if($wx && 'wx' == $from){?>
                <a href="<?=$wx_url?>">
                    <i class="iconfont icon_wx">&#xe678;</i><!--微信-->
                    <p class="fx_text">请关联微信注册</p>
                </a>
                <?php }else if($qq && 'qq' == $from){?>
                    <a href="<?=$qq_url?>">
                        <i class="iconfont icon_qq">&#xe655;</i><!--qq-->
                        <p class="fx_text">请关联qq注册</p>
                    </a>
                <?php }else if($wb && 'wb' == $from){?>
                    <a href="<?=$wb_url?>">
                        <i class="iconfont icon_wb">&#xe677;</i><!--微博-->
                        <p class="fx_text">请关联微博注册</p>
                    </a>
                <?php }?>
            </div>
        </div>
    </div>
    <?php
    include $this->view->getTplPath() . '/' . 'footer.php';
    ?>
</div>
<script>
    var body_height = $(window).height();
    var top_head = $("#header").height();
    var foot_ = $(".wrapper").height();
    $(".reg_share_style").css("height",(body_height-top_head-foot_-100)+"px")
</script>
</body>
</html>
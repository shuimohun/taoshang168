<?php
 error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>聊天界面</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
    <?php   $d = include 'api_token.php';?>
    <script>
        window.appID = "<?php echo $d['appid']; ?>";
        window.appToken = "<?php echo $d['apptoken']; ?>";
        var SiteUrl = "<?php echo $d['SiteUrl'];?>";
        var ApiUrl = "<?php echo $d['ApiUrl'];?>";
        var SnsUrl = "<?php echo $d['SnsUrl'];?>";       //为了登录成功，先将/tmpl/去掉
        var UCenterApiUrl = "<?php echo $d['UCenterApiUrl'];?>";
        var pagesize = <?php echo $d['pagesize'];?>;
        if ( window.console ) {
            window.console = {
                info: function () {},
                log: function () {}
            };
        }
    </script>
    <!--<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>-->
    <script type="text/javascript" src="js/common.js"></script>
    <!-- sdk -->
    <script src="https://app.cloopen.com/im50/ytx-web-im-min-new.js" type="text/javascript" charset="utf-8"></script>
    <!--<script type="text/javascript" src="js/ytx-web-im-min-new.js"></script>-->
    <!-- demo业务、表情包、录音 -->
    <script type="text/javascript" src="js/emoji.js"></script>
    <link href="css/perfect-scrollbar.min.css" rel="stylesheet">
    <script type="text/javascript" src='js/perfect-scrollbar.jquery.min.js'></script>
    <link href="css/emoji.css" rel="stylesheet">
    <link href="templates/default/css/chat.css" rel="stylesheet" type="text/css">
    <link href="templates/default/css/home_login.css" rel="stylesheet" type="text/css">
    <link href="templates/default/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/user.js" charset="utf-8"></script>
    <style type="text/css">
        .chat-box{right:0}
        .msg-dialog .dialog-body{margin-right:-11px}
        .dialog_chat_log{margin-left:11px}
        .dialog_chat_log .chat_log_list{overflow-y:auto}
        .dialog_chat_log dd.to-msg-text{max-width:123px}
        .dialog_chat_log .to_msg dl dd.to-msg-text{max-width:128px}
        #emoji_div{display:block;margin-left:-10px;top:211px;border:1px solid #d5e5f5;height:94px;padding:6px;position:absolute;width:224px;z-index:999999;width:229px;height:96px;background:#fff}
    </style>
</head>
 
<body>

    <script>
        var user       = {};
        user['u_id']   = "<?php echo $_COOKIE['id'];?>";
        user['u_name'] = "<?php echo $_COOKIE['user_account'];?>";
        user['s_id']   = "";
        user['s_name'] = "";
        user['avatar'] = "image/default/avatar.png";
        var ucenter_url = UCenterApiUrl;
        var imbuilder_url = ApiUrl;
        if(!user['u_id']){
            user['u_id'] = $.cookie('id');
        }
        if(!user['u_id']){
            user['u_id'] = 0;
        }
        DO_login(user['u_id']);

        <?php if($_GET['contact_you']){?>
            setTimeout(function(){
                chat("<?php  echo $_GET['contact_you'];?>");
            },1000);
        <?php }?>
    </script>
    <div id="navbar" class="navbar navbar-inverse navbar-fixed-top" style="display:none;">
        <div class="navbar-inner">
            <div class="container">
                <span style="float: left;display: block;font-size: 20px;font-weight: 200;  padding-top: 10px;padding-right: 0px;padding-bottom: 10px;padding-left: 0px;text-shadow: 0px 0px 0px;color:#eee"></span>
                <div id="navbar_login" class="nav-collapse in collapse" style="height: auto;" align="right">
                    <div name="loginType" class="navbar-form pull-right" id="1">
                        <input id='navbar_user_account' style="width:140px;margin-right: 5px;" type="text" value="<?=$user_name?>">
                        <input type="password" id='navbar_user_password' style="width:95px;margin-right: 5px;" type="text">
                        <input class="btns" type="button"  value="登录" style="line-height:20px;" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div id="web_chat_dialog"  style="display: none;float:right;">
    </div>
</body>

</html>
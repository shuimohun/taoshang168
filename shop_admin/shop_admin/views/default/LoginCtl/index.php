<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
} ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-stand|ie-comp">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>商城系统管理后台登录</title>
	<link href="<?= $this->view->css ?>/login.css" media="screen" rel="stylesheet" type="text/css">
	<script src="<?= $this->view->js_com ?>/jquery-1.10.2.min.js"></script>
</head>

<body>
	<div class="index">
		<div class="index-head"><p></p></div>
	</div>
	<div class="center-content">
		<div class="slogan"></div>
		<div class="login-area">
			<div class="top">
				<h2 class="shadow">商城系统</h2>
			</div>
			<div class="box">
				<form method="post" id="form" action="<?= YLB_Registry::get('index_page') ?>?ctl=Login&met=login">
                    <span>
                        <label for="user_name">帐号</label>
                        <input type="text" name="user_account" autocomplete="off" class="input-text text" tabindex="1" value="">
                    </span>
                    <span>
                        <label for="password">密码</label>
                        <input type="password" autocomplete="off" name="user_password" class="input-password text" tabindex="2">
                    </span>
                    <span class="cf">
                        <input type="text" name="yzm" class="input-code text3" autocomplete="off" title="验证码为4个字符" maxlength="4" placeholder="输入验证码" id="captcha-input" tabindex="3">
                        <div class="code">
                            <div id="captcha" class="code-img">
                                <img id="captcha_img" style="cursor:pointer;" data-src="./libraries/rand_func.php" src='./libraries/rand_func.php'/>
                            </div>
                        </div>
                    </span>
                    <span>
                        <input type="submit" value="登录" class="input-button" name="">
                    </span>
				</form>
			</div>
		</div>
	</div>
	<div class="back">
		<div class="items">
			<div class="item item1"></div>
			<div class="item item2"></div>
			<div class="item item3"></div>
		</div>
	</div>

    <script>
        $(document).ready(function(){
            if (window.parent != window) {
                window.parent.location.reload();
            }
            var n=0;
            var lgBan=$(".items .item").length;
            function time_flex(){
                if(n>=lgBan-1){
                    n=-1;
                }
                n++;
                $(".items .item").css("opacity","0");
                $(".items .item").eq(n).css("opacity","1");
            }
            setInterval(time_flex,3000);

            $('#captcha_img').click(function () {
                var sj = new Date();
                $(this).attr('src',$(this).data("src") + '?' + sj.getTime());
            });
        })
    </script>
</body>
</html>


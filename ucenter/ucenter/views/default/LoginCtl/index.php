<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
$re_url = '';
$re_url = YLB_Registry::get('re_url');

$from = '';
$callback = $re_url;
$t = '';
$type = '';
$act= '';
$code = '';

extract($_GET);

$qq_url = sprintf('%s?ctl=Connect_Qq&met=login&callback=%s&from=%s', YLB_Registry::get('url'), urlencode($callback) ,$from);
$wx_url = sprintf('%s?ctl=Connect_Weixin&met=login&callback=%s&from=%s', YLB_Registry::get('url'), urlencode($callback) ,$from);
$wb_url = sprintf('%s?ctl=Connect_Weibo&met=login&callback=%s&from=%s', YLB_Registry::get('url'), urlencode($callback) ,$from);

$connect_rows = YLB_Registry::get('connect_rows');

$qq = $connect_rows['qq']['status'];
$wx = $connect_rows['weixin']['status'];
$wb = $connect_rows['weibo']['status'];

if ($wx && YLB_Utils_Device::isMobile() && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false)
{
    $wx = 0;
}
?>

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
	<title>登录</title>
	<link rel="stylesheet" href="<?=$this->view->css?>/index_login.css">
	<link rel="stylesheet" href="<?=$this->view->css?>/base.css">
	<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/headfoot.css" />
	<script src="<?=$this->view->js?>/jquery-1.9.1.js"></script>
	<script src="<?=$this->view->js?>/respond.js"></script>
</head>

<body>
	<div class="login-wrap header clearfix">
        <div id="logo">
            <a href="<?=$shop_url?>" style="float:left;">
				<img src="<?= $web['site_logo'] ?>" height="60"/>
            </a>
            <b>欢迎登录</b>
        </div>
        <div class="head-regist"><a href="<?=sprintf('%s?ctl=Login&act=reg&t=%s&from=%s&callback=%s', YLB_Registry::get('url'), request_string('t'), request_string('from'), urlencode(request_string('callback')))?>" target="_blank">立即注册</a></div>
    </div>
	<div id="content">
		<div class="login-cont" style="background:<?=Web_ConfigModel::value('login_backcolor')?>">
			<div class="login-wrap login-wrap-content" style="background: url(<?=Web_ConfigModel::value('login_logo')?>) no-repeat -1px;">
                <a class="login_img" href="<?=Web_ConfigModel::value('login_logo_url')?>" target="_blank"></a>
				<div class="login-form">
					<div class="login-tab login-tab-r">
					<a href="javascript:history.go(-1)" class="back-pre"></a>
						<a href="javascript:void(0)" class="checked">
                            账户登录
                        </a>
                        <a href="<?=sprintf('%s?ctl=Login&act=reg&t=%s&from=%s&callback=%s', YLB_Registry::get('url'), request_string('t'), request_string('from'), urlencode(request_string('callback')))?>" class="back-to-regist">注册</a>
					</div>
					<div class="login-box" style="visibility: visible;">
						<div class="mt tab-h">
						</div>
						<div class="msg-wrap" style="display:none;">
							<div class="msg-error"></div>
						</div>
						<div class="mc">
							<div class="form">
								<form id="formlogin" method="post" onsubmit="return false;">
									<input type="hidden" name="from" class="from" value="<?php echo $from;?>">
									<input type="hidden" name="callback" class="callback" value="<?php echo urlencode($callback);?>">
									<input type="hidden" name="t" class="t" value="<?php echo $t;?>">
									<input type="hidden" name="type" class="type" value="<?php echo $type;?>">
									<input type="hidden" name="act" class="act" value="<?php echo $act;?>">
									<input type="hidden" name="code" class="code" value="<?php echo $code;?>">
									<input type="hidden" name="re_url" class="re_url" value="<?php echo $re_url;?>">

									<div class="item item-fore1">
										<label for="loginname" class="login-label name-label"></label>
										<input id="loginname" type="text" class="itxt lo_user_account" name="user_account" tabindex="1" autocomplete="off" placeholder="邮箱/用户名/已验证手机">
										<span class="clear-btn"></span>
									</div>
									<div id="entry" class="item item-fore2" style="visibility: visible;">
										<label class="login-label pwd-label" for="nloginpwd"></label>
										<input type="password" id="nloginpwd" name="user_password" class="itxt itxt-error lo_user_password" tabindex="2" autocomplete="off" placeholder="密码">
										<span class="clear-btn"></span>
									</div>
									<div id="entry" class="item item-fore2 clearfix disp  " style="visibility: visible;">
										<label class="login-label pwd-label" for="nloginpwd"></label>
										<input type="text" id="nlogincode" name="nlogincode" class="itxt itxt-error yzm" tabindex="2" autocomplete="off" placeholder="验证码">
										<span class="contM">
											<img onClick="get_randfunc(this);" title="换一换" class="img-code" style="cursor:pointer;" src='./libraries/rand_func.php'/>
										</span>
									</div>
									<div class="item item-fore3">
										<div class="safe">
											<span>
                                                <input id="autoLogin" name="auto_login" type="checkbox" class="yfcheckbox" tabindex="3" >
                                                <label for="">自动登录</label>
                                            </span>
											<span class="forget-pw-safe">
                                                <a href="<?=sprintf('%s?ctl=Login&act=reset&t=%s&from=%s&callback=%s', YLB_Registry::get('url'), request_string('t'), request_string('from'), urlencode(request_string('callback')))?>" class="" target="_self" >忘记密码</a>
                                            </span>
										</div>
									</div>

									<input type="submit" style="display: none;" >

									<div class="item item-fore5">
										<div class="login-btn">
											<a href="javascript:;" onclick="loginSubmit()" class="btn-img btn-entry" id="loginsubmit" tabindex="6">登&nbsp;&nbsp;&nbsp;&nbsp;录</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="coagent" style="display: block; visibility: visible;">
						<div class="titlea">——————— 其他方式登录 ———————</div>
						<ul>

							<?php if($qq == 1) {?> <!-- 1-开启 2-关闭 -->
							<li class="bg-1 qq"><a href="<?=$qq_url;?>">QQ</a></li>
							<?php }?>

							<?php if($wx == 1){?>
								<li class="bg-1 wx"><a href="<?=$wx_url;?>">微信</a></li>
							<?php }
							if($wb == 1){
								?>
								<li class="bg-1 wb"><a href="<?=$wb_url;?>">微博</a></li>
							<?php }?>
							<li class="extra-r">
								<div>
									<div class="regist-link pa"><a href="<?=sprintf('%s?ctl=Login&act=reg&t=%s&from=%s&callback=%s', YLB_Registry::get('url'), request_string('t'), request_string('from'), urlencode(request_string('callback')))?>" target="_blank"><b></b>立即注册</a></div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="login-banner" style="background-color: #ca1933 ">
				<div class="w">
					<div id="banner-bg" class="i-inner" style=""></div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include $this->view->getTplPath() . '/' . 'footer.php';
	?>

<script>
	$(document).ready(function() {

		$from = $(".from").val();
		$callback = $(".callback").val();
		$t = $(".t").val();
		$type = $(".type").val();
		$act = $(".act").val();
		$re_url = $(".re_url").val();

		$(".bg-1").each(function(){
			if($(this).prev().length>0){
				$(this).prev().append("<span>|</span>");
			}
		});

	});



	function codeCallback()
	{
		var result = false;
		if($("#nlogincode").val())
		{
			var ajaxurl = './index.php?ctl=Login&met=checkCode&typ=json&yzm='+$("#nlogincode").val();
			$.ajax({
				type: "POST",
				url: ajaxurl,
				dataType: "json",
				async: false,
				success: function (respone)
				{
					if(respone.status == 250)
					{
						$("#nlogincode").val("");
						$(".img-code").click();

						$(".msg-wrap").show();
						$(".msg-error").show();

						$(".msg-error").html('<b></b>'+'验证不正确或已过期');
						result = false;
					}
					else
					{
						result = true;
					}
				}
			});
		}
		else
		{
			$(".msg-wrap").show();
			$(".msg-erroe").show();
			$(".msg-error").html('<b></b>'+'请输入图片验证码');
			result = false;
		}

		return result;
	}


	$("#formlogin").keydown(function(e){
		var e = e || event,
			keycode = e.which || e.keyCode;

		if(keycode == 13)
		{
			loginSubmit();
		}
	});

	//检验验证码是否正确

	//登录按钮
	function loginSubmit()
	{

		//判断验证码是否显示。如果显示需要进行验证
		if($(".disp").css("display")=='block')
		{
			if(!codeCallback())
			{
				return;
			}

		}

		var user_account = $('.lo_user_account').val();
		var user_password = $('.lo_user_password').val();
		var auto_login = $('#autoLogin').is(':checked');

		$("#loginsubmit").html('正在登录...');

		$.post("./index.php?ctl=Login&met=login&typ=json",{"user_account":user_account,"user_password":user_password,"t":$t,"type":$type,"auto_login":auto_login} ,function(data) {
//			console.info(data);
			if(data.status == 200)
			{
				k = data.data.k;
				u = data.data.user_id;
				if($callback)
				{
					window.location.href = decodeURIComponent($callback) + '&us=' + encodeURIComponent(u) + '&ks=' + encodeURIComponent(k);

				}
				else
				{
					window.location.href = decodeURIComponent($re_url);
				}
			}else{
				$(".msg-warn").hide();
				$(".msg-error").html('<b></b>'+data.msg);
				$(".msg-wrap").show();
				$(".msg-error").show();
				$("#loginsubmit").html('登&nbsp;&nbsp;&nbsp;&nbsp;录');
			}
		});

	}

	function get_randfunc(obj)
	{
		var sj = new Date();
		url = obj.src;
		obj.src = url + '?' + sj;
	}
</script>

</body>

</html>
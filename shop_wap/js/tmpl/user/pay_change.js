$(function(){
	//原支付密码
	$('#pwd_primary').focusin(function(){
		if ($('#pwd_primary').val() == ' 请输入原始支付密码') {
			$('#pwd_primary').val('');
		}
	});
	$('#pwd_primary').focusout(function(){
		var pwd_primary_val = $('#pwd_primary').val();
		if (pwd_primary_val == '') {
			$('#pwd_primary').val(' 请输入原始支付密码');
		}
	});
	//新支付密码
	$('#pwd_new').focusin(function(){
		if ($('#pwd_new').val() == ' 请输入6位数字') {
			$('#pwd_new').val('');
		}
	});
	$('#pwd_new').focusout(function(){
		var pwd_new_val = $.trim($('#pwd_new').val());
		if (pwd_new_val == '') {
			$('#pwd_new').val(' 请输入6位数字');
		}
	});
	//重复新密码
	$('#pwd_repeat').focusin(function(){
		if ($('#pwd_repeat').val() == ' 请再次输入新的密码') {
			$('#pwd_repeat').val('');
		}
	});
	$('#pwd_repeat').focusout(function(){
		var pwd_repeat_val = $.trim($('#pwd_repeat').val());
		if (pwd_repeat_val == '') {
			$('#pwd_repeat').val(' 请再次输入新的密码');
		}
	});
	//验证码
	$('#verificationcode').focusin(function(){
		if ($('#verificationcode').val() == ' 请输入短信验证码') {
			$('#verificationcode').val('');
		}
	});
	$('#verificationcode').focusout(function(){
		var verificationcode_val = $.trim($('#verificationcode').val());
		if (verificationcode_val == '') {
			$('#verificationcode').val(' 请输入短信验证码');
		}
	});
});


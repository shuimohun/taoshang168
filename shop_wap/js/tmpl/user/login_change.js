$(function(){
	//登录密码
	$('#password').focusin(function(){
		if ($('#password').val() == ' 请输入当前使用的密码') {
			$('#password').val('');
		}
	});
	$('#password').focusout(function(){
		var password_val = $('#password').val();
		if (password_val == '') {
			$('#password').val(' 请输入当前使用的密码');
		}
	});
	//新密码
	$('#character').focusin(function(){
		if ($('#character').val() == '6-20个大小写英文字母、符号或数字') {
			$('#character').val('');
		}
	});
	$('#character').focusout(function(){
		var character_val = $.trim($('#character').val());
		if (character_val == '') {
			$('#character').val('6-20个大小写英文字母、符号或数字');
		}
	});
	//新手机号
	$('#repeat').focusin(function(){
		if ($('#repeat').val() == ' 请重复输入新密码') {
			$('#repeat').val('');
		}
	});
	$('#repeat').focusout(function(){
		var repeat_val = $.trim($('#repeat').val());
		if (repeat_val == '') {
			$('#repeat').val(' 请重复输入新密码');
		}
	});

	//正则表达式
	// $('.login_change').submit(function(){
	// 	//判断登陆密码是否填写
	// 	var password = $('#password').val();
	// 	if ( password == ' 请输入当前使用的密码'){
	// 		alert('请填写正确的原登陆密码');
	// 		return false;
	// 	}
	// 	//判断新支付密码格式是否正确
	// 	var character = $('#character').val();
	//   	if( !(/^(?!\D+$)(?![^a-zA-Z]+$)\S{6,20}$/.test(character)) ){
  	// 		alert("新密码必须是6-20位且包含数字和字母");
  	// 		return false;
	//   	}
	//   	//判断 重复新密码 与 新支付密码是否一致
	//   	var repeat = $('#repeat').val();
	//   	if (character != repeat){
	//   		alert('新密码和重复新密码不一致,请正确填写');
	//   		return false;
	//   	}
	// })

});
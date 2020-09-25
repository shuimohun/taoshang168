$(function(){
	//原手机号
	$('#number_primary').focusin(function(){
		if ($('#number_primary').val() == ' 请输入已绑定的手机号码') {
			$('#number_primary').val('');
		}
	});
	$('#number_primary').focusout(function(){
		var number_primary_val = $.trim($('#number_primary').val());
		if (number_primary_val == '') {
			$('#number_primary').val(' 请输入已绑定的手机号码');
		}
	});
	//就验证码
	$('#check1').focusin(function(){
        if ($('#check1').val() == '请输入短信验证码') {
            $('#check1').val('');
        }
    });
    $('#check1').focusout(function(){
        var password_val = $.trim($('#check1').val());
        if (password_val == '') {
            $('#check1').val('请输入短信验证码');
        }
    });
    //新验证码
    $('#check2').focusin(function(){
        if ($('#check2').val() == '请输入短信验证码') {
            $('#check2').val('');
        }
    });
    $('#check2').focusout(function(){
        var password_val = $.trim($('#check2').val());
        if (password_val == '') {
            $('#check2').val('请输入短信验证码');
        }
    });
	//新手机号
	$('#number_new').focusin(function(){
		if ($('#number_new').val() == ' 请输入新的手机号码') {
			$('#number_new').val('');
		}
	});
	$('#number_new').focusout(function(){
		var number_new_val = $.trim($('#number_new').val());
		if (number_new_val == '') {
			$('#number_new').val(' 请输入新的手机号码');
		}
	});

});


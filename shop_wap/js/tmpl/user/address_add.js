$(function(){
	//收货人姓名
	$('#name').focusin(function(){
		if ($('#name').val() == '收货人姓名') {
			$('#name').val('');
		}
	});
	$('#name').focusout(function(){
		var name_val = $.trim($('#name').val());
		if (name_val == '') {
			$('#name').val('收货人姓名');
		}
	});
	//手机号码
	$('#number').focusin(function(){
		if ($('#number').val() == '手机号码') {
			$('#number').val('');
		}
	});
	$('#number').focusout(function(){
		var name_val = $.trim($('#number').val());
		if (name_val == '') {
			$('#number').val('手机号码');
		}
	});
	//街道
	$('#street').focusin(function(){
		if ($('#street').val() == '街道') {
			$('#street').val('');
		}
	});
	$('#street').focusout(function(){
		var street_val = $.trim($('#street').val());
		if (street_val == '') {
			$('#street').val('街道');
		}
	});
	//邮政密码
	$('#postal').focusin(function(){
		if ($('#postal').val() == '邮政编码') {
			$('#postal').val('');
		}
	});
	$('#postal').focusout(function(){
		var postal_val = $.trim($('#postal').val());
		if (postal_val == '') {
			$('#postal').val('邮政编码');
		}
	});
	//详细地址
	$('#detail').focusin(function(){
		if ($('#detail').val() == '详细地址') {
			$('#detail').val('');
		}
	});
	$('#detail').focusout(function(){
		var detail_val = $.trim($('#detail').val());
		if (detail_val == '') {
			$('#detail').val('详细地址');
		}
	});

	//提交验证
	$('.info_add').submit(function(){
		//收货人名字不能为空或者有特殊字符
        var name = $('#name').val();
        if( name == '收货人姓名'){ 
            alert("请填写收货人姓名"); 
            return false;
        }
        else if( !(/^[\u4e00-\u9fa50-9a-zA-Z_\-]{1,20}$/.test(name)) ){ 
            alert("收货人名字不能有特殊字符"); 
            return false;
        }
        //手机号是否符合格式
        var phone = $('#number').val();
        if( !(/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone)) ){ 
            alert("请填写正确的手机号码格式"); 
            return false;
        }
        //邮编是否符合格式
        var postal = $('#postal').val();
        if ( !(/^\d{6}$/.test(postal)) ){
            alert("请输入正确的邮编格式");
            return false;
        }
        //街道不能为空
        var street = $('#street').val();
        if( street == '街道'){
        	alert('请填写所在街道')
        	return false;
        }
        //详细地址不能为空
        var detail = $('#detail').val();
        if( detail == '详细地址'){
        	alert('请填写详细地址')
        	return false;
        }
	})
})
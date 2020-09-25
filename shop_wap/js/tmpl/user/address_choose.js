	
	$('.check1').click(function(){
		if($('.check1').attr('src')=='img/icon_address_select.png'){
			$(this).attr('src','img/icon_address.png');
		}
		else{
			$(this).attr('src','img/icon_address_select.png');
			$('.check2,.check3,.check4').attr('src','img/icon_address.png')
		}
	});
	
		$('.check2').click(function(){
		if($('.check2').attr('src')=='img/icon_address_select.png'){
			$(this).attr('src','img/icon_address.png');
		}
		else{
			$(this).attr('src','img/icon_address_select.png');
			$('.check1,.check3,.check4').attr('src','img/icon_address.png')
		}
	});

		$('.check3').click(function(){
		if($('.check3').attr('src')=='img/icon_address_select.png'){
			$(this).attr('src','img/icon_address.png');
		}
		else{
			$(this).attr('src','img/icon_address_select.png');
			$('.check1,.check2,.check4').attr('src','img/icon_address.png')
		}
	});

	$('.check4').click(function(){
		if($('.check4').attr('src')=='img/icon_address_select.png'){
			$(this).attr('src','img/icon_address.png');
		}
		else{
			$(this).attr('src','img/icon_address_select.png');
			$('.check1,.check2,.check3').attr('src','img/icon_address.png')
		}
	});

/*$(function(){
	$('.address .address_button img').each(function(index,el){
		$(this).click(function(){
			if($(this).attr('src')=='img/icon_address_select.png'){
				$(this).attr('src','img/icon_address.png');
				$(this).siblings().attr('src','img/icon_address_select.png');
			}
			else{
				$(this).attr('src','img/icon_address_select.png');
				$(this).siblings().attr('src','img/icon_address.png');
				
			}
		})
	})
})*/

/**************提现点击变颜色*************/
$(function(){
	$('.operate div').click(function(){
		$(this).addClass('cur').siblings().removeClass('cur');
	});


	$('.account li').click(function(){
		$(this).addClass('cur').siblings().removeClass('cur');
	});
});



$(function(){
	$('.list a').click(function(){
		$(this).addClass('cur').siblings().removeClass('cur');
	})
})

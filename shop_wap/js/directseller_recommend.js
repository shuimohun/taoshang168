$(function(){
	$('.nav ul li').click(function(){
		$(this).addClass('cur').siblings().removeClass('cur');
	})
})
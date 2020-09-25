$(function(){
	$('.all li').click(function(){
		$(this).addClass('cur').siblings().removeClass('cur');
	})
})
$(function(){
	$('.refer li').click(function(){
		$(this).addClass('cur').siblings().removeClass('cur');
	})
})
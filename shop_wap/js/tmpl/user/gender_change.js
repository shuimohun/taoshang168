$(function(){
	$('.gender ul li').click(function(){
		$(this).addClass('cur').siblings().removeClass('cur');
		$(this).find('img').show();
		$(this).siblings().find('img').hide();
	})
})
/*<img src="img/icon_check.png" alt="">*/
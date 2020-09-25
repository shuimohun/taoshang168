$(function(){
	$('.nav ul li').click(function(){
		$(this).attr('class','cur');
		$(this).children().css('color','#fff');
		$(this).siblings().attr('class','');
		$(this).siblings().children().css('color','#3D3430');
	})
})
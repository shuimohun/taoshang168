$(function(){
	$('.nav li').click(function(){
		$(this).children().attr('class','borderbottom');
		$(this).siblings().children().attr('class','');
	});

	$('.collection').click(function(){
		if($('.collection').text() =='收藏'){
			$(this).text('已收藏');
			$(this).css('color','#9f9f9f');
			$(this).css('borderColor','#9f9f9f');
		}
		else{
			$(this).text('收藏');
			$(this).css('color','#e45050');
			$(this).css('borderColor','#e45050');
		}
	});
});
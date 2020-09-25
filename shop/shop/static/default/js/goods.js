$(function(){
	$('.cr_xie li').mouseenter(function(){
		$(this).css('border','1px solid #c51e1e');	
	})
	$('.cr_xie li').mouseleave(function(){
		$(this).css('border','1px solid #fff');
	})

	$('.cr_xie li img.book_s').click(function(){
		if ( $(this).attr('src') == 'book_n.png' ){
			$(this).attr('src','book_s.png');
		}
		else if( $(this).attr('src') == 'book_s.png' ){
			$(this).attr('src','book_n.png');
		}
	})

	$('.cr_xie li').find('.goodslist_img').mouseenter(function(){
        var img = $(this).parent().find('.erweima');
        img.attr('src',img.data('src'));
		$(this).parent().find('.pop').slideDown();
	})
	$('.cr_xie li').mouseleave(function(){
		$(this).find('.pop').slideUp();
	})
})




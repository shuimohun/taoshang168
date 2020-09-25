$(function(){
	$('.book_n').click(function(){
		if ( $(this).attr('src') == 'img/book_n.png' ){
			$(this).attr('src','img/book_s.png');
		}
		else if( $(this).attr('src') == 'img/book_s.png' ){
			$(this).attr('src','img/book_n.png');
		}
	})
})

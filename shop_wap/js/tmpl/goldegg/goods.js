$(function(){
	$('.sub').click(function(){
		var n = $('.number').val();
		var num = parseInt(n);
		num--;
		$('.number').val(num);
		if ( n == 1 ){
			$('.number').val(1);
		}
	});
	$('.add').click(function(){
		var n = $('.number').val();
		var num = parseInt(n);
		num++;
		$('.number').val(num);
	});
});

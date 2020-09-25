
$(function(){
	$('#collection1').click(function(){
		if ($('#collection1').attr('src') == 'img/shopindex_img/collection.png') {
			$(this).attr('src','img/shopindex_img/collection_red.png');
		}
		else{
			$(this).attr('src','img/shopindex_img/collection.png');
		}
	});
	/***********************************/
		$('#collection_good').click(function(){
		if ($('#collection_good').attr('src') == 'img/shopindex_img/collection.png') {
			$(this).attr('src','img/shopindex_img/collection_red.png');
		}
		else{
			$(this).attr('src','img/shopindex_img/collection.png');
		}
	});
})
/********************************************/

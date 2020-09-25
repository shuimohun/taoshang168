/*********点击按钮清空文本框内容***************/
/*$('#delete').click(function(){
	$('#name').text('');
});*/
$(function(){
    $('#delete').click(function(){
        $('.win-top').fadeIn();
        $('.win-bottom').fadeTo(300,0.5);
    });
    $('#cache_cancel').click(function(){
        $('.win-top,.win-bottom').fadeOut();
    });
    $('#cache_confirm').click(function(){
    	$('#name').val('');
    	$('.win-top,.win-bottom').fadeOut();
    })

    //判断名字里有没有特殊字符
    $('#refer').click(function(){
        var name = $('#name').val();
        if( name == ''){ 
            alert("昵称不能为空"); 
            return false;
        }
        else if( !(/^[\u4e00-\u9fa50-9a-zA-Z_\-]{1,20}$/.test(name)) ){ 
            alert("昵称不能含有特殊字符"); 
            return false;
        }
    })
})
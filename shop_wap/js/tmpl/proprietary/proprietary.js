/*********************顶部轮播图************************************/
$(function(){


/************nav*************/
$('.nav ul li').click(function(){
    $(this).addClass('cur').siblings().removeClass('cur');
});
/************nav*************/

/*******弹窗*********/
        
      $(".addtocart,.button").click(function(){
            $(".win-top").show().delay(1000).hide(300);
            $('.win-bottom').show().delay(1000).hide(300);
        });
/*******弹窗*********/
});


$(function(){
    $('.book_n').click(function(){
        if ( $(this).attr('src') == 'img/proprietary_img/book_n.png' ){
            $(this).attr('src','img/proprietary_img/book_s.png');
        }
        else if( $(this).attr('src') == 'img/proprietary_img/book_s.png' ){
            $(this).attr('src','img/proprietary_img/book_n.png');
        }
    })
})



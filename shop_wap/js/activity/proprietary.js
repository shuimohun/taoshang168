/*********************顶部轮播图************************************/
$(function(){
    $('.slider_list').each(function() {
/**********轮播图部分***************/
        if ($(this).find('.item').length < 2) {
            return;
        }
    Swipe(this, {
        startSlide: 2,
        speed: 400,
        auto: 3000,
        continuous: true,
        disableScroll: false,
        stopPropagation: false,
        callback: function(index, elem) {},
        transitionEnd: function(index, elem) {}
         });
    });
/**********轮播图部分***************/

/************nav*************/
$('.nav ul li').click(function(){
    $(this).addClass('cur').siblings().removeClass('cur');
})
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



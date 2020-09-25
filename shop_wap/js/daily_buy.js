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
});
/**********轮播图部分***************/

/****************弹窗部分*************************************/
        $(function(){
            $('.info').click(function(){
                $('.win-top').fadeIn();
                $('.win-bottom').fadeTo(300,0.3);
            });
            $('.bottom').click(function(){
                $('.win-top,.win-bottom').fadeOut();
            })
        })
/****************弹窗部分*************************************/

/************滚动导航栏展开*************/
        $(function(){
            $('.an').click(function(){
                $('.head-top').slideToggle();
            });
        });
/************滚动导航栏展开*************/

/*************************/

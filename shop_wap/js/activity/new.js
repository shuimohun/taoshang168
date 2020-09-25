/***********轮播图**********/
$(function(){
    $('.slider_list').each(function() {
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

/***********轮播图**********/
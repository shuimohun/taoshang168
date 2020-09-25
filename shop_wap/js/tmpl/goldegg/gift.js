/*************************/
$(function(){
    /*****默认排序点击下拉菜单********/
    $('.redbag_item1_div').hide();
    $('.redbag_top li').eq(0).click(function(){
       $('.redbag_item1_div').slideToggle();
    });
    $('.redbag_item1_div li').click(function(){
        $(this).addClass('cur').siblings().removeClass('cur');
        $(this).find('img').show();
        $(this).siblings().find('img').hide();
        $('.redbag_item1_div').hide();
        $('.redbag_top li').eq(0).text($(this).text())/*.css('color','#e34c4c')*/;
    });
    /*****默认排序点击下拉菜单********/

    /********会员等级下拉菜单*******/
    $('.redbag_item2_div').hide();
    $('.redbag_top li').eq(1).click(function(){
       $('.redbag_item2_div').slideToggle();
    });
    $('.redbag_item2_div li').click(function(){
        $(this).addClass('cur').siblings().removeClass('cur');
        $(this).find('img').show();
        $(this).siblings().find('img').hide();
        $('.redbag_item2_div').hide();
        $('.redbag_top li').eq(1).text($(this).text())//后面可以改颜色;
    });
    /********会员等级下拉菜单*******/

    

    /***********筛选右侧菜单***********/
    $('.redbag_top li').eq(2).click(function(){
        $('.shaixuan-bottom').show();
        $('.shaixuan-contain').animate({left:'50%'}, 500);
    });
    $('.shaixuan-number span').click(function(){
        $(this).addClass('cur').siblings().removeClass('cur');
        $(this).find('img').show();
        $(this).siblings().find('img').hide();
    });
    $('.shaixuan-contain .reset').click(function(){
        $('.shaixuan-bottom').hide();
        $('.shaixuan-contain').animate({left:'100%'}, 500);
    });
    $('.shaixuan-contain .ensure').click(function(){
        $('.shaixuan-bottom').hide();
        $('.shaixuan-contain').animate({left:'100%'}, 500);
    });
    /***********筛选右侧菜单***********/


});

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

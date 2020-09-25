/*************************/
$(function(){
    $('.shaixuan ul li').on('click',function(){
        $(this).addClass('cur').siblings().removeClass('cur');
    });
})
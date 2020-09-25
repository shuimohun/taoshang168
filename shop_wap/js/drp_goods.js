$(function(){
    $('.income_title li').click(function(){
        $(this).addClass('cur').siblings().removeClass('cur');
    });
    $('.other button').click(function(){
        $(this).addClass('cur').siblings().removeClass('cur');
    })
})
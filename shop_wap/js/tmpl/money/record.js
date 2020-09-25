$(function(){
    $('.zuijin li').click(function(){
        $(this).addClass('cur').siblings().removeClass('cur');
    })
})


$(function(){
    $('.item li').click(function(){
        $('.tanchuang').css('display','block');
        $('.bg_tanchuang').show();
    })
    $('.ensure,.delete').click(function(){
         $('.bg_tanchuang').hide();
         $('.tanchuang').hide();
    })
})



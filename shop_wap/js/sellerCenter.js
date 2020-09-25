$(function(){
    //
    $('.dialogbox').click(function(){
        if ($('.info_alert').css('display') == 'none'){
            $('.info_alert').css({'display': 'block'});
        }
        else{
           $('.info_alert').css({'display': 'none'}); 
        }
    })
    //昨日数据显示和隐藏
    $(".yesterday_data .shop_order_title span").click(function(){
        if($(this).hasClass("active")){
            $(this).removeClass("active");
            $(".yesterday_data .datamain").css("height","auto");
        }else{
            $(this).addClass("active");
            $(".yesterday_data .datamain").css("height",0);
        }
    });
});
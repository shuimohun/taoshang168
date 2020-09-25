
$(document).ready(function(){

    $(".tg_locatp").click(function(){
        var tgP=$(this).find("p").css("display");
        if(tgP=="none"){
            $(this).find("p").show();
        }else{
            $(this).find("p").hide()
        }
    });

    $(".classic").mouseover(function(){
        var tleft=$(this).find(".tleft").css("display");
        $(this).find(".tleft").show();
    });

    $(".classic").mouseout(function(){
        var tleft=$(this).find(".tleft").css("display");
        $(this).find(".tleft").hide();
    });

    $('.bbc-store-info').hover(function(){
        $(this).find(".sub").show();
    },function(){
        $(this).find(".sub").hide();
    });

    $(".bFt-list li").hover(function(){
        $(this).addClass("bFlil-expand");
    },function(){
        $(this).removeClass("bFlil-expand");
    });

    $('#site_search').click(function (e){
        $("#form_search").submit();
    });

});





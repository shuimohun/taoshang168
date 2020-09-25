$(function(){
    $('.circle1').click(function(){
        if ( $(this).attr('src')=='img/circle_n@2x.png' ){
            $(this).attr('src','img/circle_s@2x.png');
            $(this).siblings().attr('src','img/circle_n@2x.png');
        }
    })
})
$(function(){
     function displayTime(){
        var timeh = document.getElementById("timeh");
        var timei = document.getElementById("timei");
        var times = document.getElementById("times");

        if(leftTime<0){
            timeh.innerHTML = "Over";
            timei.innerHTML = "Over";
            times.innerHTML = "Over";
        }
        else{
            var endTime = new Date("2017/07/15 16:45:00");
            var now = new Date();
            var leftTime = endTime.getTime() -now.getTime();
            var ms = parseInt(leftTime%1000).toString();
            leftTime = parseInt(leftTime/1000);
            var o = Math.floor(leftTime / 3600);
            var d = Math.floor(o/24);
            var m = Math.floor(leftTime/60%60);
            var s = leftTime%60;
           /* elt.innerHTML = ('0'+o).substr(-2,2) + ":" + ('0'+m).substr(-2,2) + ":" + ('0'+s).substr(-2,2);*/

           timeh.innerHTML = ('0'+o).substr(-2,2);
           timei.innerHTML = ('0'+m).substr(-2,2);
           times.innerHTML = ('0'+s).substr(-2,2);

            if(s<0){
                timeh.innerHTML='00';
                timei.innerHTML='00';
                times.innerHTML='00';
                return;
            }
            setTimeout(displayTime,100);
        }
    }
    displayTime();
})

$(function(){
    $('.goods .goods_title span').click(function(){
        $(this).addClass('cur').siblings().removeClass('cur');
    })
})

/*$(function(){
    $(window).scroll(function(){
        $('.scroll_fixed').css({'display':'block','position':'fixed','top':'0'});
        if ($(window).scrollTop() == 0){
            $('scroll_fixed').hide();
        }
    })
})*/



$(function(){
    $(window).scroll(function(){
        if($(window).scrollTop()>=100){
             $('.scroll_fixed').fadeIn(500);
        }else{
            $('.scroll_fixed').fadeOut(500);
        }
     });

    $('.scroll_fixed a').click(function(){
        $(this).addClass('cur').siblings().removeClass('cur');
    })


    $('.info').click(function(){
        if ($('.info_alert').css('display') == 'none'){
            $('.info_alert').css({'display': 'block'});
        }
        else{
           $('.info_alert').css({'display': 'none'}); 
        }
    })
})
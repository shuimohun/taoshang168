/*************************/
$(function(){
    $(".find_nav_list").css("left",sessionStorage.left+"rem");
    $(".find_nav_list li").each(function(){
        if($(this).find("a").text()==sessionStorage.pagecount){
            $(".sideline").css({left:$(this).position().left});
            $(".sideline").css({width:$(this).outerWidth()});
            $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
            navName(sessionStorage.pagecount);
            return false
        }
        else{
            $(".sideline").css({left:0});
            $(".find_nav_list li").eq(0).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
        }
    });
    var nav_w=$(".find_nav_list li").first().width();
    $(".sideline").width(nav_w);
    $(".find_nav_list li").on('click', function(){
        nav_w=$(this).width();
        $(".sideline").stop(true);
        $(".sideline").animate({left:$(this).position().left},300);
        $(".sideline").animate({width:nav_w});
        $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
        var fn_w = ($(".find_nav").width() - nav_w) / 2;
        var fnl_l;
        var fnl_x = parseInt($(this).position().left);
        if (fnl_x <= fn_w) {
            fnl_l = 0;
        } else if (fn_w - fnl_x <= flb_w - fl_w) {
            fnl_l = flb_w - fl_w;
        } else {
            fnl_l = fn_w - fnl_x;
        }
        $(".find_nav_list").animate({
            "left" : fnl_l
        }, 300);
        sessionStorage.left=fnl_l;
        var c_nav=$(this).find("a").text();
        navName(c_nav);
    });
    var fl_w=$(".find_nav_list").width();
    var flb_w=$(".find_nav_left").width();
    $(".find_nav_list").on('touchstart', function (e) {
        var touch1 = e.originalEvent.targetTouches[0];
        x1 = touch1.pageX;
        y1 = touch1.pageY;
        ty_left = parseInt($(this).css("left"));
    });
    $(".find_nav_list").on('touchmove', function (e) {
        var touch2 = e.originalEvent.targetTouches[0];
        var x2 = touch2.pageX;
        var y2 = touch2.pageY;
        if(ty_left + x2 - x1>=0){
            $(this).css("left", 0);
        }else if(ty_left + x2 - x1<=flb_w-fl_w){
            $(this).css("left", flb_w-fl_w);
        }else{
            $(this).css("left", ty_left + x2 - x1);
        }
        if(Math.abs(y2-y1)>0){
            e.preventDefault();
        }
    });
});
function navName(c_nav) {
    switch (c_nav) {
        case "精选":
            sessionStorage.pagecount = "精选";
            break;
        case "服饰内衣":
            sessionStorage.pagecount = "服饰内衣";
            break;
        case "电子数码":
            sessionStorage.pagecount = "电子数码";
            break;
        case "美妆饰品":
            sessionStorage.pagecount = "美妆饰品";
            break;
        case "鞋靴箱包":
            sessionStorage.pagecount = "鞋靴箱包";
            break;
        case "家电办公":
            sessionStorage.pagecount = "家电办公";
            break;
        case "食品茶酒":
            sessionStorage.pagecount = "食品茶酒";
            break;
        case "生鲜水果":
            sessionStorage.pagecount = "生鲜水果";
            break;
        case "运动户外":
            sessionStorage.pagecount = "运动户外";
            break;
        case "母婴玩具":
            sessionStorage.pagecount = "母婴玩具";
            break;
        case "日用百货":
            sessionStorage.pagecount = "日用百货";
            break;
        case "家具建材":
            sessionStorage.pagecount = "家具建材";
            break;
        case "汽车汽配":
            sessionStorage.pagecount = "汽车汽配";
            break;
    }
}
/***********************************************/

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
/***********倒计时***************/

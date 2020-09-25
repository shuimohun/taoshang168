$(function () {
    //新人优惠，惠抢购，限时折扣，好物包邮切换效果
    $(".more_nav ul li").click(function(){
        var _this = $(this).index();
        $(this).addClass("on").siblings().removeClass("on");
        $(".more_wrap ul li").eq(_this).show().siblings().hide();
    })
    //弹框福袋
    /*var pop_H = $(".pop_bless_con").height();
    console.log(pop_img_H)
    $(".pop_bless_con img").css({"margin-top":(pop_img_H/2)})*/

})
/**
 * Created by Zhenzh on 2017/7/17.
 */

var pagesize = 24;
var curpage = 0;
var firstRow = 0;
var hasmore = true;


$(function(){

    $.getJSON(ApiUrl + "?ctl=ScareBuy&met=dailySnapUp&typ=json", function (e) {
        if (e.status == 200) {
            var banner = template.render("banner", e.data);
            $(".slider_list").append(banner);

            var time_over = template.render("time_over", e.data);
            $(".sale_title").append(time_over);

            var goods_list = template.render("goods_list", e.data);
            $(".goods_list").append(goods_list);

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


            var _TimeCountDown = $(".fnTimeCountDown");
            _TimeCountDown.fnTimeCountDown();
        }
    });

    get_hot_goods();

    $(window).scroll(function (){
        if(hasmore) {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
                get_hot_goods();
            }
        }
    });
});

function  get_hot_goods() {
    param = {};
    param.firstRow = firstRow;
    $.getJSON(ApiUrl + "?ctl=Goods_Goods&met=getHotGoods&typ=json",param,function (e) {
        if (e.status == 200) {

            var hot_goods = template.render("hot_goods", e.data);
            $(".guess-like").append(hot_goods);

            curpage++;
            if(e.data.page < e.data.total){
                firstRow = curpage * pagesize;
                hasmore = true;
            }else{
                hasmore = false;
            }
        }
    });
}

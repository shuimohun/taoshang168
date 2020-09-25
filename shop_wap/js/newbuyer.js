/**
 * Created by Zhenzh on 2017/7/17.
 */

var pagesize = 12;
var curpage = 0;
var firstRow = 0;
var type_id = 0;
var hasmore = true;


$(function(){
    var gid = getQueryString('goods_id');
    if(gid > 0){
        $.getJSON(ApiUrl + "?ctl=NewBuyer&met=getNewBuyerGoods&typ=json",{gid:gid},function (e) {
            if(e.status == 200){
                if(e.data.items.length > 0){
                    var item = template.render("content_item", e.data);
                    $(".main_content").append(item);
                }
            }
        });
    }


    init_main();

    $(window).scroll(function (){
        if(hasmore) {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
                init_main();
            }
        }

        stayTop($('.three'));
    });

    $('.three .newbuyer_type').on('click',function () {
        type_id = $(this).data('type');
        firstRow = 0;
        init_main();
    })

    $('.footer .li_2').click(function(){
        $('.footer_div').slideToggle();
        $('.bg_page').toggle();
    });

    $('.bg_page').click(function(){
        $(this).hide();
        $('.footer_div').hide();
    })

    $(".more_newer_shop").click(function(){
        $(".more_shop_wrap").css("top","0.8rem");
        init_shop();
    });



});

function init_main() {
    param = {};
    param.firstRow = firstRow;
    param.type_id = type_id;
    $.getJSON(ApiUrl + "?ctl=NewBuyer&met=index&typ=json",param,function (e) {
        if (e.status == 200) {

            if(type_id == 0){
                var guanggao = template.render("main", e.data);
                $(".main").append(guanggao);

                var yifen = template.render("content_item", e.data.yifen);
                $(".main_content").append(yifen);

                var yimao = template.render("content_item", e.data.yimao);
                $(".main_content").append(yimao);

                var yiyuan = template.render("content_item", e.data.yiyuan);
                $(".main_content").append(yiyuan);
                hasmore = false;
            }else{
                if(curpage == 0){
                    $(".main_content").empty();
                }
                var goods = template.render("content_item", e.data.list);
                $(".main_content").append(goods);

                curpage++;
                if(e.data.list.page < e.data.list.total){
                    firstRow = curpage * pagesize;
                    hasmore = true;
                }else{
                    hasmore = false;
                }
            }
        }
    });
}

function init_shop() {
    $.getJSON(ApiUrl + "?ctl=NewBuyer&met=getNewBuyerShop&typ=json",param,function (e) {
        if (e.status == 200) {
            var shop_list = template.render("shop_list", e);
            $(".shop_list_ul").html(shop_list);
            $(".shop_slide").toggle(function(){
                $(this).html("关闭");
                $(this).parents("li").find(".shop_list").css("max-height","none");
            },function(){
                $(this).html("展开");
                $(this).parents("li").find(".shop_list").css("max-height","1.88rem");
            });
        }
    });
}

function stayTop(tab){
    if($(window).scrollTop() >= 400){
       tab.css({'position':'fixed','top':'0.8rem','z-index':'101'});
    }
    else{
        tab.css({'position':'static'});
    }
}


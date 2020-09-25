/**
 * Created by Zhenzh on 2017/7/17.
 */

var pagesize = 12;
var curpage = 0;
var firstRow = 0;
var type_id = 0;
var hasmore = true;
var shop_id = getQueryString('shop_id');


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
    });

    $('.three .newbuyer_type').on('click',function () {
        type_id = $(this).data('type');
        firstRow = 0;
        init_main();
    })
});

function  init_main() {
    param = {};
    param.firstRow = firstRow;
    if(shop_id){
        param.sid = shop_id;
        $.getJSON(ApiUrl+"?ctl=NewBuyer&met=getShopNewBuyerGoods&typ=json",param,function(e){
            if(e.status == 200){
                var goods = template.render("content_item", e.data);
                $(".main_content").append(goods);
                curpage++;
                if(e.data.page < e.data.total){
                    firstRow = curpage * pagesize;
                    hasmore = true;
                }else{
                    hasmore = false;
                }
            }
        })
    }else{
        window.location.href = WapSiteUrl;
        return false;
    }

}


function stayTop(tab){
    if($(window).scrollTop() >= 400){
        tab.css({'position':'fixed','top':'0','z-index':'101'});
    }
    else{
        tab.css({'position':'static'});
    }
}
$(window).on('scroll',function(){
    stayTop($('.three'));
});


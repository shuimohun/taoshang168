$(function () {
    var o = getQueryString("goods_id");
    $.ajax({
        url: ApiUrl + "?ctl=Goods_Goods&met=getCommonDetail&typ=json",
        data: {goods_id: o},
        type: "get",
        success: function (o) {
            $(".fixed-tab-pannel").html(o.data.common_body);
            imageChangeHeight();
            function imageChangeHeight(){//页面中的图片进行等比缩放2018-04-02-j
                var src_div = jQuery(".fixed-tab-pannel").find(".ssd-module");
                src_div.each(function(){
                  var src_w =jQuery(this) .css("width");
                  var src_h = jQuery(this).css("height");
                  var size =  parseInt(src_w)/750;
                  var src_h_after = parseInt(src_h)*size;
                  jQuery(this).css("height",src_h_after+"px");
                })
            }


        }
    });


    $("#goodsDetail").click(function () {
        window.location.href = WapSiteUrl + "/tmpl/product_detail.html?goods_id=" + o
    });
    $("#goodsBody").click(function () {
        window.location.href = WapSiteUrl + "/tmpl/product_info.html?goods_id=" + o
    });
    $("#goodsEvaluation").click(function () {
        window.location.href = WapSiteUrl + "/tmpl/product_eval_list.html?goods_id=" + o
    })

});
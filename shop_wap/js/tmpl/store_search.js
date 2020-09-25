$(function () {
    var t = getQueryString("shop_id");
    $("#goods_search_all").attr("href", WapSiteUrl + "/tmpl/store_goods.html?shop_id=" + t);
    $("#search_btn").click(function () {
        var e = $("#search_keyword").val();
        if (e != "") {
            window.location.href = WapSiteUrl + "/tmpl/store_goods.html?shop_id=" + t + "&keyword=" + encodeURIComponent(e)
        }
    });
    $.ajax({
        type: "post",
        url: ApiUrl + "?ctl=Goods_Goods&met=getShopCat&shop_id=1&typ=json",
        data: {shop_id: t},
        dataType: "json",
        success: function (t) {
            var e = t.data;
            var o = e.shop_name + " - 店内搜索";
            document.title = o;
            var r = template.render("store_category_tpl", e);
            $("#store_category").html(r);

            $('.click_category').click(function(){
                
                if( $(this).text() == '展开' ){
                    $(this).text('收缩');
                    $(this).parent().parent().find('.category_contain ul').css({'height':'auto'});
                }
                else if($(this).text() == '收缩'){
                    $(this).text('展开');
                    $(this).parent().parent().find('.category_contain ul').css({'height':'3.35rem'});

                }
            })

            $('.click_category').click(function(){
                
                if( $(this).text() == '展开' ){
                    $(this).text('收缩');
                    $(this).parent().parent().find('.category_contain ul').css({'height':'auto'});
                    $(this).parent().siblings('.category_contain').css('height','auto');
                }
                else if($(this).text() == '收缩'){
                    $(this).text('展开');
                    $(this).parent().parent().find('.category_contain ul').css({'height':'3.35rem'});

                }
            })
        }
    })
});
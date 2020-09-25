var page = 1;
var hasmore = true;
var footer = false;

var order_by = getQueryString("order_by");
var order_sort = getQueryString("order_sort");
var keyword = decodeURIComponent(getQueryString("keyword"));

var price_from = getQueryString("price_from");
var price_to = getQueryString("price_to");
var own_shop = getQueryString("own_shop");
var promotion = getQueryString("promotion");


var myDate = new Date;
var searchTimes = myDate.getTime();
if (!getCookie('sub_site_id')) {
    addCookie('sub_site_id', 0, 0);
}
var sub_site_id = getCookie('sub_site_id');

$(function() {
    $.animationLeft({
        valve: "#search_adv",
        wrapper: ".nctouch-full-mask",
        scroll: "#list-items-scroll"
    });
    $("#header").on("click", ".header-inp", function() {
        location.href = WapSiteUrl + "/tmpl/search.html?keyword=" + keyword
    });
    if (keyword != "") {
        $("#keyword").html(keyword)
    }

    $("#show_style").click(function() {
        if ($("#product_list").hasClass("grid")) {
            $(this).find("span").removeClass("browse-grid").addClass("browse-list");
            $("#product_list").removeClass("grid").addClass("list")
        } else {
            $(this).find("span").addClass("browse-grid").removeClass("browse-list");
            $("#product_list").addClass("grid").removeClass("list")
        }
    });

    $("#sort_default").click(function() {
        if ($("#sort_inner").hasClass("hide")) {
            $("#sort_inner").removeClass("hide")
        } else {
            $("#sort_inner").addClass("hide")
        }
    });
    $("#nav_ul").find("a").click(function() {
        $(this).addClass("current").parent().siblings().find("a").removeClass("current");
        if (!$("#sort_inner").hasClass("hide") && $(this).parent().index() > 0) {
            $("#sort_inner").addClass("hide")
        }
    });
    $("#sort_inner").find("a").click(function() {
        $("#sort_inner").addClass("hide").find("a").removeClass("cur");
        var e = $(this).addClass("cur").text();
        $("#sort_default").html(e + "<i></i>")
    });
    $("#product_list").on("click", ".goods-store a", function() {
        var e = $(this);
        var r = $(this).attr("data-id");
        var i = $(this).text();
        $.getJSON(ApiUrl + "?act=store&op=store_credit", {
            shop_id: r
        }, function(t) {
            var a = "<dl>" + '<dt><a href="store.html?shop_id=' + r + '">' + i + '<span class="arrow-r"></span></a></dt>' + '<dd class="' + t.datas.store_credit.store_desccredit.percent_class + '">描述相符：<em>' + t.datas.store_credit.store_desccredit.credit + "</em><i></i></dd>" + '<dd class="' + t.datas.store_credit.store_servicecredit.percent_class + '">服务态度：<em>' + t.datas.store_credit.store_servicecredit.credit + "</em><i></i></dd>" + '<dd class="' + t.datas.store_credit.store_deliverycredit.percent_class + '">发货速度：<em>' + t.datas.store_credit.store_deliverycredit.credit + "</em><i></i></dd>" + "</dl>";
            e.next().html(a).show()
        })
    }).on("click", ".sotre-creidt-layout", function() {
        $(this).hide()
    });

    search_adv();
    get_list();

    $(window).scroll(function() {
        if (hasmore && ($(window).scrollTop() + $(window).height() > $(document).height() - 1)) {
            get_list();
        }
    });
});

function get_list() {
    $(".loading").remove();
    if (!hasmore) {
        return false
    }
    hasmore = false;
    param = {};
    param.page = page;

    if (order_by != "") {
        param.order_by = order_by
    }
    if (order_sort != "") {
        param.order_sort = order_sort
    }
    if (price_from != "") {
        param.price_from = price_from
    }
    if (price_to != "") {
        param.price_to = price_to
    }
    if (own_shop != "") {
        param.own_shop = 'own_shop'
    }
    if (promotion != '') {
        param.promotion = 'promotion'
    }

    $.getJSON(ApiUrl + "?ctl=Goods_Goods&met=getGoodsFree&typ=json", param, function(e) {

        $(".loading").remove();
        var r = template.render("home_body", e);
        $("#product_list .goods-secrch-list").append(r);

        var slider = template.render("slider", e);
        $(".swipe-wrap").append(slider);

        $('.slider_list').each(function() {
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

        if (e.data.page < e.data.total) {
            page++;
            hasmore = true;
        } else {
            hasmore = false;
        }
    })
}

function init_get_list(by,sort) {
    order_by = by;
    order_sort = sort;
    page = 1;
    hasmore = true;
    $("#product_list .goods-secrch-list").html("");
    $("#footer").removeClass("posa");
    get_list();
}

function search_adv() {
    $.getJSON(ApiUrl + "?ctl=Index&met=getSearchAdv&typ=json", function(e) {
        $("#list-items-scroll").html(template.render("search_items", e));
        if (price_from) {
            $("#price_from").val(price_from)
        }
        if (price_to) {
            $("#price_to").val(price_to)
        }
        if (own_shop) {
            $("#own_shop").addClass("current")
        }
        if (promotion) {
            $("#promotion").addClass("current")
        }

        $("#search_submit").click(function() {
            var e = "?keyword=" + keyword,
                r = "";

            if ($("#price_from").val() != "") {
                e += "&price_from=" + $("#price_from").val();
            }
            if ($("#price_to").val() != "") {
                e += "&price_to=" + $("#price_to").val();
            }
            if ($("#promotion").hasClass('current')) {
                e += "&promotion=1";
            }

            window.location.href = WapSiteUrl + "/tmpl/goods_free_post.html" + e;
        });

        $('a[nctype="items"]').click(function() {
            var e = new Date;
            if (e.getTime() - searchTimes > 300) {
                $(this).toggleClass("current");
                searchTimes = e.getTime()
            }
        });

        $('input[nctype="price"]').on("blur", function() {
            if ($(this).val() != "" && !/^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test($(this).val())) {
                $(this).val("")
            }
        });

        $("#reset").click(function() {
            $('a[nctype="items"]').removeClass("current");
            $('input[nctype="price"]').val("");
            $("#area_id").val("");
        })
    })
}

$('#list-items-scroll').on('click', '#area_info', function() {
    $.areaSelected({
        success: function(a) {
            $("#area_info").val(a.area_info).attr({
                "data-areaid1": a.area_id_1,
                "data-areaid2": a.area_id_2,
                "data-areaid3": a.area_id_3,
                "data-areaid": a.area_id,
                "data-areaid2": a.area_id_2 == 0 ? a.area_id_1 : a.area_id_2
            })
        }
    });
});
var page = pagesize;
var curpage = 1;
var firstRow = 0;
var hasmore = true;
var footer = false;
var keyword = decodeURIComponent(getQueryString("keyword"));
var key = getQueryString("key");
var order = getQueryString("order");
var actgoods = getQueryString("actgoods");
var virtual = getQueryString("virtual");
var myDate = new Date;
var reset = true;
var searchTimes = myDate.getTime();
$(function() {
    var e = getCookie("key");
    if (!e) {
        window.location.href = WapSiteUrl + "/tmpl/member/login.html"
    }

    $("#search_btn").click(function() {
        reset = true;
        get_list();
    });

    //排序下拉事件
    $("#sort_default").click(function() {
        if ($("#sort_inner").hasClass("hide")) {
            $("#sort_inner").removeClass("hide")
        } else {
            $("#sort_inner").addClass("hide")
        }
    });

    //排序按钮
    $("#nav_ul").find("a").click(function() {
        $(this).addClass("current").parent().siblings().find("a").removeClass("current");
        if (!$("#sort_inner").hasClass("hide") && $(this).parent().index() > 0) {
            $("#sort_inner").addClass("hide")
        }
    });

    //排序下拉框内容
    $("#sort_inner").find("a").click(function() {
        $("#sort_inner").addClass("hide").find("a").removeClass("cur");
        var e = $(this).addClass("cur").text();
        $("#sort_default").html(e + "<i></i>")
    });

    get_list();

    $(window).scroll(function() {
        if(hasmore){
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
                get_list()
            }
        }
    });
});

function get_list() {

    $(".loading").remove();
    if (reset) {
        curpage = 1;
        hasMore = true
    }
    $(".loading").remove();
    if (!hasMore) {
        return false
    }
    hasMore = false;

    param = {};
    param.rows = page;
    param.page = curpage;
    param.k = getCookie('key');
    param.u = getCookie('id');

    keyword = $('#goodskey').val();
    if (keyword != "") {
        param.keywords = keyword
    }

    if (key != "") {
        param.actorder = key
    }

    if (order != "") {
        param.act = order
    }

    if (actgoods != '') {
        param.op2 = 'active'
    }
    if (virtual != '') {
        param.isvirtual = virtual
    }

    $.getJSON(ApiUrl + "?ctl=Distribution_Buyer_Goods&met=index&typ=json" + window.location.search.replace("?", "&"), param, function(e) {
        if (!e) {
            e = [];
            e.datas = [];
            e.data.goods_list = []
        }
        $(".loading").remove();
        curpage++;
        var r = template.render("home_body", e);
        $("#product_list .goods-secrch-list").append(r);

        if (e.data.page < e.data.total) {
            hasmore = true;
        } else {
            hasmore = false;
            reset = false;
        }
    })
}

function init_get_list(e, r) {
    order = e;
    key = r;
    curpage = 1;
    firstRow = 0;
    hasmore = true;
    $("#product_list .goods-secrch-list").html("");
    $("#footer").removeClass("posa");
    get_list()
}
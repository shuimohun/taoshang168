var page = pagesize;
var curpage = 1;
var hasMore = true;
var footer = false;
var reset = true;
var orderKey = "";
var firstRow = 0;
$(function () {
    var e = getCookie("key");
    if (!e) {
        window.location.href = WapSiteUrl + "/tmpl/member/login.html"
    }
    if (getQueryString("data-state") != "") {
        $("#filtrate_ul").find("li").has('a[data-state="' + getQueryString("data-state") + '"]').addClass("selected").siblings().removeClass("selected")
    }
    $("#search_btn").click(function () {
        reset = true;
        t()
    });
    $("#fixed_nav").waypoint(function () {
        $("#fixed_nav").toggleClass("fixed")
    }, {offset: "50"});
    function t() {
        if (reset) {
            curpage = 1;
            hasMore = true
        }
        $(".loading").remove();
        if (!hasMore) {
            return false
        }
        hasMore = false;
        var status = $("#filtrate_ul").find(".selected").find("a").attr("data-state");
		if(getQueryString('status')){
			status = getQueryString('status');
		}
        var r = $("#order_key").val();
        $.ajax({
            type: "post",
            url: ApiUrl + "?ctl=Distribution_Buyer_Directseller&met=directsellerOrder&typ=json&page=" + curpage,
            data: {k: e, u: getCookie('id'), status: status, orderkey: r},
            dataType: "json",
            success: function (e) {
                checkLogin(e.login);
                //hasMore = e.hasmore;
                if (!hasMore) {
                    get_footer()
                }
                if (e.data.items.length <= 0) {
                    $("#footer").addClass("posa")
                } else {
                    $("#footer").removeClass("posa")
                }
                var t = e;
                t.WapSiteUrl = WapSiteUrl;
                t.ApiUrl = ApiUrl;
                t.key = getCookie("key");
                template.helper("p2f", function (e) {
                    return (parseFloat(e) || 0).toFixed(2)
                });
                template.helper("parseInt", function (e) {
                    return parseInt(e)
                });
                var r = template.render("directseller-order-list-tmpl", t);
                if (reset) {
                    reset = false;
                    $("#directseller-order-list").html(r)
                } else {
                    $("#directseller-order-list").append(r)
                }
				
				if(e.data.page < e.data.total)
				{
                    curpage++;
                    hasMore = true;
				}
				else
				{
				   hasMore = false;
				}
            }
        })
    }
 
    $("#filtrate_ul").find("a").click(function () {
        $("#filtrate_ul").find("li").removeClass("selected");
        $(this).parent().addClass("selected").siblings().removeClass("selected");
        reset = true;
        window.scrollTo(0, 0);
        t()
    });
    t();
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
            t()
        }
    })
});

function get_footer() {
    if (!footer) {
        footer = true;
        $.ajax({url: "../../js/tmpl/footer.js", dataType: "script"})
    }
}
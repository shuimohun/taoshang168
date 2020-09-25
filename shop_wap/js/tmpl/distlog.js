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
    $.ajax({
            type: "post",
            url: ApiUrl + "?ctl=Seller_Supplier_DistLog&met=index&typ=json&page=" + page + "&curpage=" + curpage+'&rows = '+page+'&firstRow='+firstRow,
            data: {k: e, u: getCookie('id')},
            dataType: "json",
            success: function (e) {
            	var r = template.render("distlog", e);
            	
            	if (reset) {
                    reset = false;
                    $("#distlog_list").html(r)
                } else {
                    $("#distlog_list").append(r)
                }
            }
    })        
})   
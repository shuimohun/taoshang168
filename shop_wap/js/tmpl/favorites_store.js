

$(function ()
{
    var t = getCookie("key");
    if (!t)
    {
        location.href = "login.html"
    }
    var e = new ncScrollLoad;
    e.loadInit({
        url: ApiUrl + "?ctl=Buyer_Favorites&met=favoritesShop&typ=json",
        getparam: {k:t,u:getCookie('id')},
        tmplid: "sfavorites_list",
        containerobj: $("#favorites_list"),
        iIntervalId: true,
        data: {WapSiteUrl: WapSiteUrl}
    });
    $("#favorites_list").on("click", "[nc_type='fav_del']", function ()
    {
        var t = $(this).attr("data_id");
        if (t <= 0)
        {
            $.sDialog({skin: "red", content: "删除失败", okBtn: false, cancelBtn: false})
        }
        if (dropFavoriteStore(t))
        {
            $("#favitem_" + t).remove();
            if (!$.trim($("#favorites_list").html()))
            {
                location.href = WapSiteUrl + "/tmpl/member/favorites_store.html"
            }
        }
    })
});
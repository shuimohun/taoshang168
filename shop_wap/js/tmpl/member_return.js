$(function () {
    var e = getCookie("key");
    var u = getCookie("id");
    var r = new ncScrollLoad;
    r.loadInit({
        url: ApiUrl + "?ctl=Buyer_Service_Return&met=index&typ=json&state=2",
        getparam: {k: e,u:u},
        tmplid: "return-list-tmpl",
        containerobj: $("#return-list"),
        iIntervalId: true,
        data: {WapSiteUrl: WapSiteUrl},
        callback: function () {
            $(".delay-btn").click(function () {
                return_id = $(this).attr("return_id");
                $.getJSON(ApiUrl + "?act=member_return&op=delay_form", {
                    key: e,
                    return_id: return_id
                }, function (r) {
                    checkLogin(r.login);
                    $.sDialog({
                        skin: "red",
                        content: '发货 <span id="delayDay">' + r.datas.return_delay + '</span> 天后，当商家选择未收到则要进行延迟时间操作；<br> 如果超过 <span id="confirmDay">' + r.datas.return_confirm + "</span> 天不处理按弃货处理，直接由管理员确认退款。",
                        okFn: function () {
                            $.ajax({
                                type: "post",
                                url: ApiUrl + "?act=member_return&op=delay_post",
                                data: {key: e, return_id: return_id},
                                dataType: "json",
                                success: function (e) {
                                    checkLogin(e.login);
                                    if (e.datas.error) {
                                        $.sDialog({
                                            skin: "red",
                                            content: e.datas.error,
                                            okBtn: false,
                                            cancelBtn: false
                                        });
                                        return false
                                    }
                                    window.location.href = WapSiteUrl + "/tmpl/member/member_return.html"
                                }
                            })
                        },
                        cancelFn: function () {
                            window.location.href = WapSiteUrl + "/tmpl/member/member_return.html"
                        }
                    });
                    return false
                })
            })
        }
    })
});
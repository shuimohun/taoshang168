var order_id;
var order_goods_id;
$(function() {
    var e = getCookie("key");
    var u = getCookie("id");
    if (!e) {
        window.location.href = WapSiteUrl + "/tmpl/member/login.html"
    }
    $.getJSON(ApiUrl + "?ctl=Buyer_Service_Return&met=index&act=add&typ=json", {
        k: e,
        u: u,
        oid: getQueryString("order_id"),
        gid: getQueryString("order_goods_id")
    }, function(a) {
        a.data.WapSiteUrl = WapSiteUrl;
        $("#order-info-container").html(template.render("order-info-tmpl", a.data));
        order_id = a.data.order_id;
        allow_refund_amount = a.data.goods[0].order_goods_payment_amount;
        var num = a.data.goods[0].order_goods_num;
        var html = '';
        $.each(a.data.reason, function(k, v) {
            html += '<option value="' + v.id + '">' + v.order_return_reason_content + '</option>'
        });
        $('#res_content').append(html);
        $("#allow_refund_amount").html("￥" + allow_refund_amount);

        $('input[name="refund_pic"]').ajaxUploadImage({
            url: ApiUrl + "?act=member_refund&op=upload_pic",
            data: {
                key: e
            },
            start: function(e) {
                e.parent().after('<div class="upload-loading"><i></i></div>');
                e.parent().siblings(".pic-thumb").remove()
            },
            success: function(e, a) {
                checkLogin(a.login);
                if (a.status == 250) {
                    e.parent().siblings(".upload-loading").remove();
                    $.sDialog({
                        skin: "red",
                        content: "图片尺寸过大！",
                        okBtn: false,
                        cancelBtn: false
                    });
                    return false
                }
                e.parent().after('<div class="pic-thumb"><img src="' + a.datas.pic + '"/></div>');
                e.parent().siblings(".upload-loading").remove();
                e.parents("a").next().val(a.datas.file_name)
            }
        });

        $(".btn-l").click(function() {
            var a = $("form").serializeArray();
            var r = {};
            r.k = e;
            r.u = u;
            r.goods_id = getQueryString("order_goods_id");
            r.return_cash = allow_refund_amount;
            r.nums = num;
            r.return_reason_id = $('#res_content').val();

            for (var n = 0; n < a.length; n++) {
                r[a[n].name] = a[n].value
            }
            if (r.return_message.length == 0) {
                $.sDialog({
                    skin: "red",
                    content: "请填写退货说明",
                    okBtn: false,
                    cancelBtn: false
                });
                return false
            }
            $.ajax({
                type: "post",
                url: ApiUrl + "?ctl=Buyer_Service_Return&met=addReturn&typ=json",
                data: r,
                dataType: "json",
                async: false,
                success: function(e) {

                    if (e.status == 250) {
                        $.sDialog({
                            skin: "red",
                            content: "申请退货失败",
                            okBtn: false,
                            cancelBtn: false
                        });
                        return false
                    }
                    window.location.href = WapSiteUrl + "/tmpl/member/member_return.html"
                }
            })
        })
    })
});
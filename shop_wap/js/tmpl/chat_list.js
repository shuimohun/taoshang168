$(function ()
{
    var e = getCookie("key");
    if (!e)
    {
        location.href = "login.html"
    }
    template.helper("isEmpty", function (e)
    {
        for (var t in e)
        {
            return false
        }
        return true
    });
    $.ajax({
        type: "post", url: ApiUrl + "?ctl=Buyer_Message&met=message&typ=json", data: {k: e, u: getCookie('id'), recent: 1, op:'get_user_list', from:'wap'}, dataType: "json", success: function (t)
        {
            checkLogin(t.login);
            var a = t.data;
            $("#messageList").html(template.render("messageListScript", a));
            $(".msg-list-del").click(function ()
            {
                var t = $(this).attr("t_id");
                $.ajax({
                    type: "post", url: ApiUrl + "?ctl=Buyer_Message&met=delUserMessage&typ=json", data: {k: e, u: getCookie('id'), t_id: t}, dataType: "json", success: function (e)
                    {
                        if (e.status == 200)
                        {
                            location.reload()
                        }
                        else
                        {
                            $.sDialog({skin: "red", content: e.data.error, okBtn: false, cancelBtn: false});
                            return false
                        }
                    }
                })
            })
        }
    })
});
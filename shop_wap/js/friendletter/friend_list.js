


$(function(){

    $(".my").click(function () {

        var uid = getCookie("id");
        window.location.href='../fans_user_face.html?uid='+uid;
    })

});

function getUserMsg() {
    $.ajax({
        url: ApiUrl + '?ctl=Buyer_Message&met=wapMessage&typ=json',
        type: 'POST',
        data:{},
        dataType: 'json',
        async: false,
        success: function(e) {
            if( e.status == 200 )
            {
                var msgList = template.render("msgList",e);
                $(".msgList").html(msgList);
            }
        }
    })
}
getUserMsg();

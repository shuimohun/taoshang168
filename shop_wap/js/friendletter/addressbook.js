

var share_data = getQueryString("share_data");
if( share_data )
{
    share_data = JSON.parse(decodeURIComponent(share_data));
}
$(function () {

    var uid = getCookie('id'); //登录标记
    if(!uid){
        checkLogin(0);
        return false;
    }
    $('.back').click(function () {
        history.go(-1);
    })
    /*头部添加好友弹框*/
    $(".addicon").click(function () {
        if($(".add_tips").hasClass("show")){
            $(".add_tips").removeClass("show");
        }else{
            $(".add_tips").addClass("show");
        }
    });

    function getFriend() {
        /*取消点赞*/
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Buyer_User&met=addressBook&typ=json',
            dataType: 'json',
            async: false,
            success: function(result) {
                if(result.status == 200)
                {
                    var friend_List = template.render("friend_List",result);
                    $(".friend_List").html(friend_List);
                    //好友列表  选择和取消  2018-09-04 添加
                    $(".choose_friends .namewrap .namelist").click(function(){
                        var now_btn = $(this).find(".choose_friends_btn");
                        if(now_btn.hasClass("on")){
                            now_btn.removeClass("on")
                        }else{
                            now_btn.addClass("on")
                        }
                    })
                }
            }
        });
    }
    getFriend();
    if( share_data  )
    {
        $(".btn_qr").click(function () {
            sendMsg(share_data);
        });
        $('.btn_qx').click(function () {
            callback(share_data);
        })
    }
    //发送消息
    function sendMsg(e){
        var onList      = [];
        var onUserName  =[];
        $('.choose_friends ul').find("li").each(function () {
            var btn = $(this).find('.choose_friends_btn');
            if( btn.hasClass("on") )
            {
                onList.push($(this).index());
                onUserName.push( $(this).find(".user_name").text() );
            }
        });
        if( onList.length == 0 )
        {
            $.sDialog({"content": "请选择分享好友","cancelBtn": false,'okFn':function () {} })
        }
        else
        {
            var msgData={};
            var content=e.title+'%_%'+e.img_src+'%_%'+e.desc+'%_%'+e.callback;
            msgData.user_message_content =content;
            msgData.user_message_receive = onUserName.join(',');
            // console.log(content.split("%&_"));
            // return false;
            //发送消息
            $.ajax({
                type: "post",
                url: ApiUrl + "?ctl=Buyer_Message&met=addMessageDetail&typ=json",
                data: msgData,
                dataType: "json",
                async:false,
                success: function (e)
                {
                    if(e.status ==200 )
                    {
                        $.sDialog({
                            "content": "分享成功",
                            "cancelBtn": false,
                            'okFn':function () {
                                console.log(share_data.callback);
                                window.location.href =share_data.callback;
                            }
                        })
                    }
                    else
                    {
                        $.sDialog({"content": "分享失败",
                            "cancelBtn": false,
                            'okFn':function () {
                                window.location.href =share_data.callback;
                            }
                        })
                    }
                }
            })

        }
    }
    //回调地址
    function callback(e){
        var callback = decodeURIComponent( e.callback );
        window.location.href = callback;
    }
    /*关注按钮*/
    $(".fllow_btn").click(function() {
        var user_friend_id = $(this).data("id");
        var _this = $(this);
        /*单向取关*/
        $.ajax({
            type: 'POST',
            url: ApiUrl + '?ctl=Buyer_User&met=cancelFriendDetail&typ=json',
            data:{id:user_friend_id},
            dataType: 'json',
            async: false,
            success: function(e) {

                if(e.status ==200)
                {
                    console.log();
                    if(_this.parent().parent().parent().children("li").length ==1){
                        _this.parent().parent().parent().parent().remove();
                    }else{
                        _this.parents(".namelist").remove();
                    }


                }
            }
        });

    });


});
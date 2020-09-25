$(function () {

    $(".back").click(function ()
    {
        location.href='./addressbook.html';
    })
    /*获取好友列表*/
    function getFriendChat()
    {
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Buyer_User&met=addressBook&typ=json',
            dataType: 'json',
            async: false,
            success: function(result) {

                if(result.status == 200)
                {
                    var friend_list = template.render("friend_list",result);
                    $(".friend_list").html(friend_list);
                    //页面滚动式添加好友位置固定
                    $(window).scroll(function(){
                        var box_top = $(".group_imgbox").height();
                        var win_scroll_top = $(this).scrollTop();
                        //console.log(win_scroll_top+"/////"+box_top)
                        $(".group_imgbox").addClass("fixed_top");
                        if(win_scroll_top<=box_top){
                            $(".group_imgbox").removeClass("fixed_top");
                        }
                    })
                }
            }
        })
    }
    getFriendChat();

    /*关注按钮*/
    $(".fllow_btn").click(function()
    {
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
                        if(_this.parent().parent().parent().children("li").length ==1)
                        {
                          _this.parent().parent().parent().parent().remove();
                        }else{
                            _this.parents(".namelist").remove();
                        }
                    }
                }
            });
        })
    })


    function chatGroup(i,user_id)
    {
        var _this       = $(i);
        var user_name   = _this.text();
        var img_src     = _this.prev().attr("src");
        var content     ="<img src="+img_src+" data-id="+user_id+" onclick='moveChat(this)'>";
        $(".group_imgbox img").each(function()
        {
            if($(this).attr("data-id") == user_id)
            {
                alert("已经添加好友,请勿重复添加")
                $(this).remove();
                return false;
            }
        })
        $(".group_imgbox").append(content);
        var num     = $(".group_imgbox img").length;
        var text    = "<a>确定 <i>("+num+")</i></a>";
        $(".sure_btn").html(text);
    }

    function moveChat(i)
    {
        var _this = $(i);
        if(confirm("确定移除?"))
        {
            _this.remove();
            var num     = $(".group_imgbox img").length;
            var text    = "<a>确定 <i>("+num+")</i></a>";
            $(".sure_btn").html(text);
        }

    }

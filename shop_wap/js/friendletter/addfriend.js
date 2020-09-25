
var tag_id = getQueryString("tag_id");

var refer = document.referrer;
$(function () {

    /*搜索好友*/
    $(".search_btn").click(function(){
        var userName = $("input[id='searchName']").val();
        if(!userName){
            alert("搜索内容不能为空");
            return false;
        }
        window.location.href = "./searchlist.html?searchName="+userName;
    })


})

function addFriend(){

    $.ajax({
        type: 'post',
        dataType: 'json',
        async: false,
        url: ApiUrl+'?ctl=Buyer_User&met=addFriend&typ=json',
        success:function(e){
            if(e.status ==200){

                var interestNav =template.render("interestNav",e);
                $(".interestNav ul").html(interestNav);

                var users = template.render("users",e);
                $(".users").html(users);

                var often_visited = template.render("often_visited",e);
                $(".often_visited ul").html(often_visited);

                /*导航切换s*/
                $(".navside ul li").each(function () {
                    var tId = $(this).data("id");
                    if (tId == tag_id) {

                        $(".navside ul li").eq($(this).index()).addClass("on");
                        $(".rightmain .itemwrap").eq($(this).index()).show();

                        // var sUrl = 'addfriend.html';
                        // history.pushState('','',sUrl);
                    }

                });

                $(".navside ul li").click(function(){
                    var $thisnum = $(this).index();
                    $(this).addClass("on").siblings("li").removeClass("on");
                    $(".rightmain .itemwrap").eq($thisnum).show().siblings(".rightmain .itemwrap").hide();
                })
            }
        }
    });
}
addFriend();
function friend(i,user_id,user_friend_id){
    var tag
    var _this = $(i);
    /*关注按钮*/
    if(_this.hasClass("on")){
        /*已关注 发送取消请求*/
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Buyer_User&met=cancelFriendDetail&typ=json',
            data: {id: user_friend_id},
            dataType: 'json',
            async: false,
            success: function(result) {
                if(200 == result.status){

                    _this.removeClass("on");
                    _this.text("未关注");
                    $(".navside ul li").each(function () {
                         if($(this).hasClass("on")){
                              tag = $(this).attr("data-id");
                         }
                    });
                    var url = location.href;
                    var arr = url.split("?");
                    var newUrl = arr[0]+'?tag_id='+tag;
                    console.log(newUrl);
                    location.href=newUrl;

                }

            }
        })
    }else{
        /*未关注 发送关注请求*/
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Buyer_User&met=addFriendDetail&typ=json',
            data: {id: user_id},
            dataType: 'json',
            async: false,
            success: function(result) {
                if(200 == result.status){
                    _this.addClass("on");
                    _this.text("已关注");
                    $(".navside ul li").each(function () {
                        if($(this).hasClass("on")){
                            tag = $(this).attr("data-id");
                        }
                    });
                    var url = location.href;
                    var arr = url.split("?");
                    var newUrl = arr[0]+'?tag_id='+tag;
                    console.log(newUrl);
                    location.href=newUrl;
                }

            }
        })

    }

}


//有新朋友  关注按钮
$(".new_f_main .r_gz").click(function(){
    if($(this).hasClass("on")){
        $(this).removeClass("on");
    }else{
        $(this).addClass("on");
    }
})
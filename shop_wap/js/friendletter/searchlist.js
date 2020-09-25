
var searchName = getQueryString("searchName");
/*关注按钮*/
$(function () {

/*url地址栏编码
    var a = location.href;
    var b=encodeURIComponent(a);
    console.log(encodeURIComponent(a));
    console.log(decodeURIComponent(b));
    */

    $("input[id='searchName']").val(searchName);
    $(".back").click(function () {
       window.location.href='./addfriend.html';
    })


    var page=1;
    var rows=10;
    var hasMore=true;
    function searchUser(more)
    {

        var search;
        if($("input[id='searchName']").val()){

            search = $("input[id='searchName']").val();
        }else{

            search = searchName;
        }


        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Buyer_User&met=searchUser&typ=json',
            data: {searchname: search,page:page,rows:rows},
            dataType: 'json',
            async: false,
            success: function(result) {

                if(result.status==200)
                {
                    if(result.data.user_list.items.length==0){
                        var msg  = '<div class="msg">暂无数据...</div>'
                        $(".userList").html(msg);
                    }else{
                        if(more){
                            var userListMore = template.render("userListMore",result);
                            $(".userList").append(userListMore);
                        }else{
                            var userList = template.render("userList",result);
                            $(".userList").html(userList);
                        }


                        if(page<result.data.user_list.total){
                            hasMore=true;

                        }else{
                            hasMore=false;
                        }
                        page++;

                    }

                }
            }
        })
    }

    searchUser();

    $(".search_btn").click(function(){
       var cont = $("input[id='searchName']").val();
       if(cont.length ==0){
           alert("搜索内容不能为空");
           return false;
       }
        page=1;
        searchUser();
    })

    /*下拉加载*/
    $(window).scroll(function(e) {
        if($(window).scrollTop() + $(window).height()== $(document).height()) {
            if(hasMore){
                searchUser(true);
            }
        }
    });
})

function friend(i,user_id){
    var _this = $(i);

    if(_this.hasClass("on")){
        /*已关注,发送取关请求*/
        var user_friend_id = _this.attr("data-id");
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Buyer_User&met=cancelFriendDetail&typ=json',
            data: {id: user_friend_id},
            dataType: 'json',
            async: false,
            success: function(result) {

                if(200 == result.status)
                {
                    _this.removeClass("on");
                    _this.text("未关注");
                }
            }
        })

    }else{
        /*未关注,发送关注请求*/
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Buyer_User&met=addFriendDetail&typ=json',
            data: {id: user_id},
            dataType: 'json',
            async: false,
            success: function(result) {

                if(200 == result.status)
                {
                    _this.attr("data-id",result.data.user_friend_id);
                    _this.addClass("on");
                    _this.text("已关注");
                }

            }
        })
    }
}











$(function(){
    page =1;
    hasMore = true;
    act="";
    function userinfo() {
        $.post(ApiUrl + "?ctl=Distribution_Buyer_Index&met=orderfinish&typ=json&page="+page,{act:act},function (e) {
            if(e.status == 200) {
                var r = template.render("goods_list", e.data);
                $('#gold_list').append(r);
                if (e.data.page < e.data.total) {
                    hasMore = true;
                    page++;
                }else {
                    hasMore = false;
                }

            }
        });
    }

    userinfo();

    $('.nav ul li').click(function(){
        page = 1;
        $(this).addClass('cur').siblings().removeClass('cur');
        act = $(this).attr('data-id');
        $('#gold_list').html("");
        userinfo();
    })

    $(window).scroll(function() {
        if(hasMore){
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
                userinfo();
            }
        }
    });
})
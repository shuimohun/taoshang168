$(function(){


    var page = 1;
    var rows = 15;
    var hasMore = true;
    /*获取送福免单活动商品*/
    function getFuGoods(more){
        $.ajax({
            type: 'POST',
            url: ApiUrl + '?ctl=Goods_GoodsFu&met=getFuGoods&typ=json',
            dataType: 'json',
            data:{page:page,rows:rows},
            async: false,
            success: function(e) {

                if(more){
                    var fuGoodsMore = template.render("fuGoodsMore",e);
                    $(".fuGoods ul").append(fuGoodsMore);

                }else{
                    var fuGoods = template.render("fuGoods",e);
                    $(".fuGoods").html(fuGoods);
                }
                if(page*rows > e.data.totalsize)
                {
                    hasMore =false;
                    $(".loading").hide();
                }
                page++;
            }
        })
    }
    getFuGoods();
    $(window).scroll(function(e) {
        if( !($(".pop-up").hasClass("block")) && !($(".ui-mask").hasClass("block")) )
        {
            if($(window).scrollTop() + $(window).height()== $(document).height())
            {
                if(hasMore)
                {
                    getFuGoods(true)
                }

            }
        }
    });

})

/*

function check(i,goods_id) {
    var _this = $(i);
    var key = getCookie("key");
    if(key)
    {
        location.href = WapSiteUrl+"/tmpl/sendbless_register.html?gid="+goods_id;
    }else{
        checkLogin(0)
    }
}*/

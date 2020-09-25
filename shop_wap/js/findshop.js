var sci = getQueryString('nav');
var shop_id = getQueryString('shop_id');
var pagesize = 8;
var curpage = 0;
var firstRow = 0;
var hasmore = true;

$(function(){
    if(!sci)
    {
        sci = 0;
    }
    $.ajax({
        url:ApiUrl+'/index.php?ctl=Api_App_FindShop&met=getNav&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                var navHtml = template.render('nav',data);
                $('.find_nav_list').html(navHtml);
                var sliderHtml = template.render('slider',data);
                $('.slider_list').html(sliderHtml);

                $('.slider_list').each(function() {
                    if ($(this).find('.item').length < 2) {
                        return;
                    }
                    Swipe(this, {
                        startSlide: 2,
                        speed: 400,
                        auto: 3000,
                        continuous: true,
                        disableScroll: false,
                        stopPropagation: false,
                        callback: function(index, elem) {},
                        transitionEnd: function(index, elem) {}
                    });
                });

                slider();
            }
        }
    });

    shop_and_good();

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Api_App_FindShop&met=niceShop&typ=json',
        data:{sci:sci},
        type:'post',
        dataType:'json',
        success:function (resule)
        {
            if(resule.status == 200)
            {
                var data = resule.data;
                console.log(data);
                var niceHtml = template.render('nice',data);
                $('.nice_contain').html(niceHtml);
            }
        }
    });


    get_ding_goods(sci);

    $(window).scroll(function (){
        if(hasmore) {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
                get_ding_goods(sci);
            }
        }
    });
});

function  get_ding_goods(sci)
{
    param = {};
    param.sci = sci;
    param.firstRow = firstRow;

    $.getJSON(ApiUrl + "?ctl=Api_App_FindShop&met=sureShop&typ=json",param,function (e)
    {
        if (e.status == 200)
        {
            console.log(e.data);
            var goodShopHtml = template.render('goodShop',e.data);
            $('.good_shop').append(goodShopHtml);

            curpage++;
            if(e.data.page < e.data.total){
                firstRow = curpage * pagesize;
                hasmore = true;
            }else{
                hasmore = false;
            }

        }
    });
}


function shop_and_good()
{
    if(!shop_id)
    {
        shop_id = 0;
    }

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Api_App_FindShop&met=shopGood&typ=json',
        data:{shop_id:shop_id},
        type:'post',
        dataType:'json',
        success:function (result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                console.log(data);
                var andHtml = template.render('shop_and_good',data);
                $('.shop_and_good').html(andHtml);
            }
        }
    });

}

function slider()
{
    $(".find_nav_list").css("left",sessionStorage.left+"px");
    $(".find_nav_list li").each(function(){
        if($(this).find("a").text()==sessionStorage.pagecount){
            $(".sideline").css({left:$(this).position().left});
            $(".sideline").css({width:$(this).outerWidth()});
            $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
            navName(sessionStorage.pagecount);
            return false
        }
        else{
            $(".sideline").css({left:0});
            $(".find_nav_list li").eq(0).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
        }
    });
    var nav_w=$(".find_nav_list li").first().width();
    $(".sideline").width(nav_w);
    $(".find_nav_list li").on('click', function(){
        nav_w=$(this).width();
        $(".sideline").stop(true);
        $(".sideline").animate({left:$(this).position().left},300);
        $(".sideline").animate({width:nav_w});
        $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
        var fn_w = ($(".find_nav").width() - nav_w) / 2;
        var fnl_l;
        var fnl_x = parseInt($(this).position().left);
        if (fnl_x <= fn_w) {
            fnl_l = 0;
        } else if (fn_w - fnl_x <= flb_w - fl_w) {
            fnl_l = flb_w - fl_w;
        } else {
            fnl_l = fn_w - fnl_x;
        }
        $(".find_nav_list").animate({
            "left" : fnl_l
        }, 300);
        sessionStorage.left=fnl_l;
        var c_nav=$(this).find("a").text();
        navName(c_nav);
    });
    var fl_w=$(".find_nav_list").width();
    var flb_w=$(".find_nav_left").width();
    $(".find_nav_list").on('touchstart', function (e) {
        var touch1 = e.originalEvent.targetTouches[0];
        x1 = touch1.pageX;
        y1 = touch1.pageY;
        ty_left = parseInt($(this).css("left"));
    });
    $(".find_nav_list").on('touchmove', function (e) {
        var touch2 = e.originalEvent.targetTouches[0];
        var x2 = touch2.pageX;
        var y2 = touch2.pageY;
        if(ty_left + x2 - x1>=0){
            $(this).css("left", 0);
        }else if(ty_left + x2 - x1<=flb_w-fl_w){
            $(this).css("left", flb_w-fl_w);
        }else{
            $(this).css("left", ty_left + x2 - x1);
        }
        if(Math.abs(y2-y1)>0){
            e.preventDefault();
        }
    });
}

function navName(c_nav) {
    switch (c_nav) {
        case "精选":
            sessionStorage.pagecount = "精选";
            break;
        case "潮流服饰":
            sessionStorage.pagecount = "潮流服饰";
            break;
        case "鞋靴箱包":
            sessionStorage.pagecount = "鞋靴箱包";
            break;
        case "美妆珠宝":
            sessionStorage.pagecount = "美妆珠宝";
            break;
        case "电脑办公":
            sessionStorage.pagecount = "电脑办公";
            break;
        case "食品茶酒":
            sessionStorage.pagecount = "食品茶酒";
            break;
        case "生鲜特产":
            sessionStorage.pagecount = "生鲜特产";
            break;
        case "运动器材":
            sessionStorage.pagecount = "运动器材";
            break;
        case "母婴玩具":
            sessionStorage.pagecount = "母婴玩具";
            break;
        case "日用百货":
            sessionStorage.pagecount = "日用百货";
            break;
        case "家具建材":
            sessionStorage.pagecount = "家具建材";
            break;
        case "电子数码":
            sessionStorage.pagecount = "电子数码";
            break;
        case "汽车汽配":
            sessionStorage.pagecount = "汽车汽配";
            break;
    }
}

$('.find_nav_list').on('click',"li[class='find_nav_cur']",function(){
    window.location.href = WapSiteUrl+'/tmpl/findgoodshop.html?nav='+$(this).data('id');
    return;
});

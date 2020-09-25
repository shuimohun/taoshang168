/**
 * Created by Administrator on 2017/7/10.
 */
var nav = getQueryString('nav');
var is_not = getQueryString('type');
$(function(){
    if(is_not){
        $('.self_support').attr('src','../images/activity/icon_address_select.png');
    }else{
        is_not = 2;
    }
    $.ajax({
        url:ApiUrl+'/index.php?ctl=Api_App_Discount&met=getNav&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {

                console.log(result.data);
                var data = result.data;
                var navHtml = template.render('nav',data);
                $('.find_nav_list').html(navHtml);
                var sliderHtml = template.render('slider',data);
                $('.slider_list').html(sliderHtml);
                nav_cat();
                slider();
            }
        }
    });

    if(!nav)
    {
        nav = 0;
    }
   $.post(ApiUrl+'/index.php?ctl=Api_App_Discount&met=getContentByTab&typ=json',{'nav':nav,'is_not':is_not},function(result){
       console.log(result.data);
       if(result.status == 200)
       {
           var data = result.data;
           var goods_excellent = template.render('excellent',data);
           $('.swiper-container.n').html(goods_excellent);

           var swiper = new Swiper('.lb .swiper-container', {
               pagination: '.lb .swiper-pagination',
               slidesPerView: 5,
               paginationClickable: true,
               spaceBetween: 12,
               freeMode: true
           });

           var swiper = new Swiper('.lb2 .swiper-container', {
               pagination: '.lb2 .swiper-pagination',
               slidesPerView: 3,
               paginationClickable: true,
               spaceBetween: 30,
               freeMode: true
           });

           $.post(ApiUrl+'/index.php?ctl=Api_App_Discount&met=UserAddress&typ=json',function(result){
               var da = result.data;
               if(result.status == 200)
               {
                   console.log(da);
                   $('#adr>span').html((da.items[0].user_address_area).trim().replace(/\s/g,""));
               }
               else if(result.status == 210)
               {
                    $('#adr').attr('href','./member/member.html');
                    $('#adr>span').html(da.msg);
               }
               else if(result.status == 220)
               {
                   $('#adr').attr('href','./member/address.html');
                   $('#adr>span').html(da.msg);
               }
           });

            var goodsHtml = template.render('goods',data);
            $('.goods_add').html(goodsHtml);


       }
   });
});


function nav_cat()
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
        case "美妆饰品":
            sessionStorage.pagecount = "美妆饰品";
            break;
        case "鞋靴箱包":
            sessionStorage.pagecount = "鞋靴箱包";
            break;
        case "食品茶酒":
            sessionStorage.pagecount = "食品茶酒";
            break;
        case "家电办公":
            sessionStorage.pagecount = "家电办公";
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
        case "家居建材":
            sessionStorage.pagecount = "家居建材";
            break;
        case "电子数码":
            sessionStorage.pagecount = "电子数码";
            break;
        case "汽车汽配":
            sessionStorage.pagecount = "汽车汽配";
            break;
        case "生活服务":
            sessionStorage.pagecount = "生活服务";
            break;
    }
}

function slider()
{
    $('.slider_list').each(function() {
        /**********轮播图部分***************/
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
}

$('.peisong .select').click(function(){
    if ($(this).attr('src') == '../images/activity/icon_address.png' ) {
        $(this).attr('src','../images/activity/icon_address_select.png');
        $(this).siblings().attr('src','../images/activity/icon_address.png');
        var is_not = $(this).data('id');
        var nav = $('.find_nav_cur').data('id');
        var rule = $('.cur').data('type');
        if(rule == 'select'){rule = $('#se_s').val(); if(rule == 'null'){rule = '';}}
        $.post(ApiUrl+'/index.php?ctl=Api_App_Discount&met=getContentByTab&typ=json',{'rule':rule,'nav':nav,'is_not':is_not},function(result){
            if(result.status == 200)
            {
                var data = result.data;
                var goodsHtml = template.render('goods',data);
                $('.goods_add').html(goodsHtml);
            }
        });

    }

});

function zhek(th)
{
    var discount = $(th).data('id');
    if($('.select').attr('src') == '../images/activity/icon_address_select.png'){var is_not = $('.select').data('id');}else{var is_not = $('.select.n').data('id');};
    var nav = $('.find_nav_cur').data('id');
    var rule = $('.cur').data('type');
    if(rule == 'select'){rule = $('#se_s').val(); if(rule == 'null'){rule = '';}}

    $.post(ApiUrl+'/index.php?ctl=Api_App_Discount&met=getContentByTab&typ=json',{'rule':rule,'nav':nav,'is_not':is_not,'discount':discount},function(result){
        if(result.status == 200)
        {
            var data = result.data;
            var goodsHtml = template.render('goods',data);
            $('.goods_add').html(goodsHtml);
        }
    })
    $('.lb .swiper-container .swiper-slide a').click(function(){
            $(this).addClass('cur').parent().siblings().find('a').removeClass('cur');
        })
}

function rule(th)
{
    if($('.select').attr('src') == '../images/activity/icon_address_select.png'){
        var is_not = $('.select').data('id');
    }else{
        var is_not = 2;
    }
    var nav = $('.find_nav_cur').data('id');
    var rule = $(th).data('type');
    $.post(ApiUrl+'/index.php?ctl=Api_App_Discount&met=getContentByTab&typ=json',{'rule':rule,'nav':nav,'is_not':is_not},function(result){
        if(result.status == 200)
        {
            var data = result.data;
            var goodsHtml = template.render('goods',data);
            $('.goods_add').html(goodsHtml);
        }
    });
}

function se_rule(th)
{
    if($('.select').attr('src') == '../images/activity/icon_address_select.png'){var is_not = $('.select').data('id');}else{var is_not = 2;};
    var nav = $('.find_nav_cur').data('id');
    var rule = $(th).val();
    $.post(ApiUrl+'/index.php?ctl=Api_App_Discount&met=getContentByTab&typ=json',{'rule':rule,'nav':nav,'is_not':is_not},function(result){
        if(result.status == 200)
        {
            var data = result.data;
            var goodsHtml = template.render('goods',data);
            $('.goods_add').html(goodsHtml);
        }
    });
}

$('.zonghe').on('click',"li[class='cur']",function(){
    if($(this).data('type') != 'select')
    {
        $('#se').attr("selected",true);
    }
});

$('.find_nav_list').on('click',"li[class='find_nav_cur']",function(){
    var cat_id = $(this).data('id');
   window.location.href="discount.html?nav="+cat_id;
   return;
});

    $(function(){
        $('.fix_footer').load('./common_footer.html');
    });
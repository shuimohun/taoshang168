$(function(){
    var e = getCookie("key");

    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }
    var hash = location.hash;

    var fid  = hash.substr(1);
    $.ajax({
        url:ApiUrl + "?ctl=Points&met=pList&typ=json",
        type:'get',
        dataType:'json',
        success: function(result)
        {
            var data = result.data;
            var navHtml = template.render('nav',data);
            $('.find_nav_list').append(navHtml);

            $(".redbag_head>span").html(data.user_info.user_name);
            $(".redbag_head>img").attr("src",data.user_info.user_logo);
            $("#red").html(data.redPacket);
            $("#ticket").html(data.ava_voucher_num);
            $("#egg").html(data.user_resource.user_points);
            $("#gift").html(data.points_order_num);
            if(hash == '')
            {
                $.post(ApiUrl + "?ctl=Points&met=index&typ=json",function(result){
                    var data = result.data;
                    var giftHtml = template.render('gifts',data);
                    $('.gift').append(giftHtml);
                    var picHtml = template.render('pic',data);
                    $('.slider_list').append(picHtml);
                    lunbo();
                });
            }
            else
            {
                $.post(ApiUrl + "?ctl=Points&met=sort&typ=json",{fid:fid},function(result){
                    var data = result.data;
                    var giftHtml = template.render('gifts',data);
                    $('.gift').append(giftHtml);
                    var picHtml = template.render('pic',data);
                    $('.slider_list').append(picHtml);
                    lunbo();
                });
            }
            slide();
        }
    });

});

$('.redbag_item1_div').on('click',"li[class='cur']",function(){
   var points  = $(this).attr('nctype');
   var fid  = $('.find_nav_cur>a').attr('id');
   var grade = $('.redbag_item2_div>.cur').attr('nctype');
   $.ajax({
       url:ApiUrl+"/index.php?ctl=Points&met=sort&typ=json",
       data:{points:points,fid:fid,grade:grade},
       type:'post',
       dataType:'json',
       success:function(result)
       {
           console.log(result);
           if(result.status == 200)
           {
               var data = result.data;
               var giftHtml = template.render('gifts',data);
               $('.gift').html(giftHtml);
           }

       }
   });
});

$('.redbag_item2_div').on('click',"li[class='cur']",function(){
    var grade = $(this).attr('nctype');
    var fid  = $('.find_nav_cur>a').attr('id');
    var points = $('.redbag_item1_div >.cur').attr('nctype');
    $.ajax({
        url:ApiUrl+"/index.php?ctl=Points&met=sort&typ=json",
        data:{points:points,fid:fid,grade:grade},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            console.log(result);
            if(result.status == 200)
            {
                var data = result.data;
                var giftHtml = template.render('gifts',data);
                $('.gift').html(giftHtml);
            }
        }

    });

});

$('.find_nav_list').on('click',"li[class='find_nav_cur']",function(){
    var fid  = $('.find_nav_cur>a').attr('id');
    var grade = $('.redbag_item2_div>.cur').attr('nctype');
    var points = $('.redbag_item1_div >.cur').attr('nctype');
    location.href=WapSiteUrl+'/tmpl/gift.html#'+fid;
   $.ajax({
      url:ApiUrl+'/index.php?ctl=Points&met=sort&typ=json',
       data:{points:points,fid:fid,grade:grade},
       type:'post',
       dataType:'json',
       success:function(result)
       {
           console.log(result);
           if(result.status == 200)
           {
               var data = result.data;
               var giftHtml = template.render('gifts',data);
               $('.gift').html(giftHtml);
           }
       }
   });
});

$('.ensure').click(function(){
    var low = $('#lows').val();
    var tall = $('#talls').val();
    var cond = $('.shaixuan-exchange.cur').attr('nctype');
    var fid  = $('.find_nav_cur>a').attr('id');
    var grade = $('.redbag_item2_div>.cur').attr('nctype');
    var points = $('.redbag_item1_div >.cur').attr('nctype');
    $.ajax({
         url:ApiUrl+'/index.php?ctl=Points&met=sort&typ=json',
        data:{low:low,tall:tall,cond:cond,fid:fid,grade:grade,points:points},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            console.log(result);
            if(result.status == 200)
            {
                var data = result.data;
                var giftHtml = template.render('gifts',data);
                $('.gift').html(giftHtml);
            }
        }
    });
});

$('.reset').click(function(){
   $('input').attr('value','');
});

//轮播图
function lunbo()
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

function slide()
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
        case "电脑办公":
            sessionStorage.pagecount = "电脑办公";
            break;
    }
}


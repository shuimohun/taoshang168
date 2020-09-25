
$(function(){
    var url = window.location.search;
    if(url!=''){
        var infor_row =  url.substr(1);
        var infor_i = infor_row.split('=');
        var infor_id = infor_i[1];

        $.getJSON(ApiUrl + "?ctl=Information_Group&met=informationGroupList&typ=json",function (e) {
            var data = e.data;
            var scHtml = template.render('list_l', data);
            $('.find_nav_left').html(scHtml);
            biaoti();
            cell();
        })
        $.getJSON(ApiUrl + "?ctl=Information_Base&met=informationBaseList&typ=json",{'information_group':infor_id},function (e) {
            var data = e.data;
            var scHtml = template.render('item_m', data);
            $('.item_i').html(scHtml);
        });
    }else{
        $.getJSON(ApiUrl + "?ctl=Information_Group&met=informationGroupList&typ=json",function (e) {
            var data = e.data;
            var scHtml = template.render('list_l', data);
            $('.find_nav_left').html(scHtml);
            biaoti();
            cell();
        });
        $.getJSON(ApiUrl + "?ctl=Information_Base&met=informationBaseList&typ=json",function (e) {
            var data = e.data;
            var scHtml = template.render('item_m', data);
            $('.item_i').html(scHtml);
        });
    }
})
function common_alert(){

    if ($('.info_alert').css('display') == 'none'){
        $('.info_alert').css({'display': 'block'});


        var $el = '<img src="../images/user_img/choose_gray@3x.png" alt=""> <a href="../index.html"><span><img src="../images/user_img/more_home@2x.png" alt=""><u>商城首页</u></span></a><a href="cart_list.html"><span><img src="../images/user_img/more_cart@2x.png" alt=""><u>购物车</u></span></a><a href="../tmpl/member/order_list.html"><span><img src="../images/user_img/more_form@2x.png" alt=""><u>我的订单</u></span></a><a href="../tmpl/member/chat_list.html"><span><img src="../images/bbc-bg36.png" alt=""><u>消息</u></span></a>'

        $('.info_alert').html($el);
    }
    else{
        $('.info_alert').css({'display': 'none'});
    }
}

function  biaoti() {
    $('.li_cat').click(function () {
        if(!$(this).hasClass('cur')){
            $('.li_cat.cur').removeClass('cur');
            $(this).addClass('cur')
        }

        var id = $(this).data('id');
        $.getJSON(ApiUrl + "?ctl=Api_Information_Base&met=informationBaseList&typ=json",{'information_group':id},function (e) {
            var data = e.data;
            var scHtml = template.render('item_m', data);
            $('.item_i').html(scHtml);
        });
    })
}
function  cell() {
    $(".find_nav_list").css("left",sessionStorage.left+"px");
    $(".find_nav_list li").each(function(){
        if($(this).find("a").text()==sessionStorage.pagecount){
            $(".sideline").css({left:$(this).position().left});
            $(".sideline").css({width:$(this).outerWidth()});
            // $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
            /* navName(sessionStorage.pagecount);*/
            return false
        }
        else{
            $(".sideline").css({left:0});
            // $(".find_nav_list li").eq(0).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
        }
    });
    var nav_w=$(".find_nav_list li").first().width();
    $(".sideline").width(nav_w);
    $(".find_nav_list li").on('click', function(){
        nav_w=$(this).width();
        $(".sideline").stop(true);
        $(".sideline").animate({left:$(this).position().left},300);
        $(".sideline").animate({width:nav_w});
        $(this).addClass("  find_nav_cur").siblings().removeClass("find_nav_cur");
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
        /*navName(c_nav);*/
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
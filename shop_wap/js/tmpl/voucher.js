var page = pagesize;
var curpage = 1;
var firstRow = 0;
var hasmore = true;
var footer = false;
var keyword = decodeURIComponent(getQueryString("keyword"));
var myDate = new Date;
var order = getQueryString("orderby");
var grade = getQueryString("level");
var only_self = getQueryString("is_self");
var points_min = getQueryString("points_min");
var points_max = getQueryString("points_max");
var price = getQueryString("price");
var require_once = true;

$(function(){
    var e = getCookie("key");
    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Points&met=pList&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
            var np  ='';
            var exp = '';

            var data = result.data;
            var navHtml = template.render('nav',data);
            $('.find_nav_list').append(navHtml);
            $(".redbag_head>span").html(data.user_info.user_name);
            $(".redbag_head>img").attr("src",data.user_info.user_logo);
            $("#red").html(data.redPacket);
            $("#ticket").html(data.ava_voucher_num);
            $("#egg").html(data.user_resource.user_points);
            $("#gift").html(data.points_order_num);
            $.each(data.user_grade,function(k,v){
                if(v.id ==  parseInt(parseInt(data.user_info.user_grade)+parseInt(1)))
                {
                    np  = v.id;
                    exp = v.user_grade_demand;
                }
            });
            $('.div_v').html('V'+data.user_info.user_grade);
            $('.div_v.n').html('V'+np);
            $('.progress>img').attr('width',parseInt((data.user_resource.user_growth/exp)*100)+'%');
            $('.div_right>i').html(parseInt((exp - data.user_resource.user_growth)));
            $.post(ApiUrl+'/index.php?ctl=Points&met=index&typ=json',function(result){
                var data = result.data;
                var picHtml = template.render('pic',data);
                $('.slider_list').append(picHtml);
                lunbo();
            });
            get_list();
            slide();

        }
    });
});

//搜索条件
function init_get_list(type, value)
{
    if ( type == "order" ) {
        this.order = value;
    } else if ( type == "grade" ) {
        this.grade = value;
    } else if ( type == "price" ) {
        this.price = value;
    }

    curpage = 1;
    firstRow = 0;
    hasmore = true;
    $(".chit").html("");
    $("#footer").removeClass("posa");
    get_list()
}

//立即兑换
$('.chit').on('click',"a[nctype='immed']",function(){
        var v_id = $(this).data('vid');
        $.ajax({
        url: ApiUrl + "?ctl=Voucher&met=getVoucherById&typ=json",
        data: {vid: v_id},
        type: 'post',
        dataType: 'json',
        success: function(data){
            if(data.status == 200)
            {
                var data = data.data, voucher_t_eachlimit = data.voucher_t_eachlimit;
                var params = {
                    vid: v_id,
                    k: getCookie("key"),
                    u: getCookie("id")
                };
                if(data.voucher_t_eachlimit == 0)
                {
                    $.ajax({
                        url:ApiUrl+"/index.php?ctl=Voucher&met=receiveVoucher&typ=json",
                        data: params,
                        type: 'post',
                        dataType:'json',
                        success:function(data)
                        {
                            var msg = data.msg;
                            $('.tanchuang_top').html(msg);
                            $('.tanchuang').css('display','block');
                            $('.bg_tanchuang').show();
                        }
                    });
                }
                else
                {
                    $.ajax({
                        url:ApiUrl+"/index.php?ctl=Voucher&met=receiveVoucher&typ=json",
                        data: params,
                        type: 'post',
                        dataType:'json',
                        success:function(data)
                        {
                            var msg = data.msg;
                            $('.tanchuang_top').html(msg);
                            $('.tanchuang').css('display','block');
                            $('.bg_tanchuang').show();
                        }
                    });
                }
            }else{
                $('.tanchuang_top').html('网络异常');
                $('.tanchuang').css('display','block');
                $('.bg_tanchuang').show();
            }
        }
    });
});

//导航栏点击
$('.find_nav_list').on('click',"li[class='find_nav_cur']",function(){
    var fid = $('.find_nav_cur>a').attr('id');
    location.href = WapSiteUrl+'/tmpl/voucher.html?vc_id='+fid;
});

//获取数据
function get_list()
{
    $(".loading").remove();
    if (!hasmore)
    {
        return false
    }
    hasmore = false;
    var param = {};
    param.rows = page;
    param.page = curpage;
    param.firstRow = firstRow;

    param.orderby = order;
    param.level = grade;
    param.price = price;

    $.getJSON(ApiUrl + "?ctl=Voucher&met=vList&typ=json" + window.location.search.replace("?", "&"), param, function (result) {
        $(".loading").remove();
        if (result.status == 200) {
            var data = result.data;
            console.log(data);
            var html = template.render("chits", data);
            $(".chit").append(html);
            if ( require_once ) {
                require_once = false;
                var searchHtml = template.render("option", data);
                $(".redbag_item2_div").append(searchHtml);
            }
            if(data.voucher.page < data.voucher.total)
            {
                firstRow = data.records;
                hasmore = true;
            }
            else
            {
                hasmore = false;
            }
        }
    });
}

//点击确定按钮
$('.ensure').click(function(){
    location.reload();
});

//点击取消按钮
$('.delete').click(function(){
    $('.bg_tanchuang').hide();
    $('.tanchuang').hide();
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

//条件筛选
//重置
$('.reset').click(function(){
    $('.shaixuan-bottom').hide();
    $('input[nctype="points"]').val("");
    $('.shaixuan-contain').animate({left:'100%'}, 500);
});
//输入框加限制
$('input[nctype="points"]').on("blur", function ()
{
    if ($(this).val() != "" && !/^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test($(this).val()))
    {
        $(this).val("")
    }
});
//提交
$('.ensure').click(function(){
    var param = "?";
    if ($("#points_min").val() >= 0) {
        var min_val = $("#points_min").val();
        param += "points_min=" + min_val + "&", points_min = min_val;
    } else {
        points_min = -1;
    }
    if ($("#points_max").val() >= 0) {
        var max_val = $("#points_max").val();
        param += "points_max=" + max_val, points_max = max_val;
    } else {
        points_max = -1;
    }
    window.location.href = WapSiteUrl + "/tmpl/voucher.html" + param
});


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
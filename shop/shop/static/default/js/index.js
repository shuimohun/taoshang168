$(function() {
    ucenterLogin(UCENTER_URL, SITE_URL, false);

    //顶部导航栏鼠标移入效果
    $(".floor_head nav li").bind("mouseover", function() {
        $(".floor_head nav li").find("a").removeClass("selected");
        $(this).find("a").addClass("selected");
        var aW = $(this).find("a").width();
        var pad = parseInt($(this).find("a").css("paddingLeft"));
        var liW = aW + pad * 2 + 1;
        $(this).css("width", liW);

    });
    //左侧菜单栏鼠标移入效果
    $(".tleft ul li").hover(function() {
        $(this).addClass("hover_leave");
        $(this).find("h3 a").css("color", "red");
        $(this).find(".hover_content").show();
    }, function() {
        $(this).removeClass("hover_leave");
        $(this).find("h3 a").css("color", "#fff");
        $(this).find(".hover_content").hide();
    });
    //导航栏移入显示下拉单
    $(".head_right dl").hover(function() {
        $(this).addClass("navactive");
        $(this).find("dd").show();
        $(this).prev().find("p").css("right", "-2px");
    }, function() {
        $(".head_right dl").removeClass("navactive");
        $(".head_right dd").hide();
        $(this).prev().find("p").css("right", "-1px");
    });
    //按类型搜索
    $(".search-types li").click(function() {
        $(".search-types li").removeClass("active");
        $(this).addClass("active");
        var type = $(this).find("a").attr('data-param');

        if (type == 'shop') {
            $("#search_ctl").val('Shop_Index');
            $("#search_met").val('index');
        } else {
            $("#search_ctl").val('Goods_Goods');
            $("#search_met").val('goodslist');
        }
    });

    //遍历楼层图标背景
    $(".m .mt .title span").each(function(i) {
        var str = "url(" + STATIC_URL + "/images/flad" + (i + 1) + ".png)";
        $(this).css("background", str);
    });

    //地点定位
    $(".header_select_province").hover(function() {
        $(this).find("dt").css("background", "#fff");
        $(this).find("dd").show();
    }, function() {
        $(this).find("dt").css("background", "#f2f2f2");
        $(this).find("dd").hide();
    });

    $(".code_screen").click(function() {
        $(".code_cont").css("display", "block");
    }, function() {
        $(".code_cont").css("display", "none");
    });

    if (is_open_city === '0' || typeof(is_open_city) === 'undefined') {
        $.post(SITE_URL + '?ctl=Base_District&met=district&pid=0&typ=json', function(data) {
            if(data.status == 200){
                $.each(data.data.items,function (i,a) {
                    $(".header_select_province dd").append("<div class='dd'><a onclick='setcook(  " + '"' + data.data.items[i]['district_name'] + '", ' + data.data.items[i]['district_id'] + " )' >" + data.data.items[i]['district_name'] + "</a></li>");
                });
            }
        });

        window.setcook = function(district_name, e) {
            $.cookie("areaId", e);
            $.cookie('area', district_name);
            location.reload();
        };
        $.cookie('sub_site_id', null);
        $.cookie('sub_site_name', null);
    } else {
        if ($.cookie('sub_site_name')) {
            $("#area").html($.cookie('sub_site_name'));
        }
        $.post(SITE_URL + '?ctl=Base_District&met=subSite&pid=0&typ=json', function(data) {
            $(".header_select_province dd").append("<div class='dd' id='sub_site_div_0'><a onclick='setsubSitecook(\"全部\",0 )' > 全部</a></li>");
            if(data.status == 200){
                for (i = 0; i < data.data.items.length; i++) {
                    $(".header_select_province dd").append("<div class='dd' id='sub_site_div_" + data.data.items[i]['subsite_id'] + "' data-logo='" + data.data.items[i]['sub_site_logo'] + "'  data-copyright='" + data.data.items[i]['sub_site_copyright'] + "' ><a onclick='setsubSitecook(  " + '"' + data.data.items[i]['sub_site_name'] + '", ' + data.data.items[i]['subsite_id'] + " )' >" + data.data.items[i]['sub_site_name'] + "</a></li>");
                }
            }
        });
        window.setsubSitecook = function(e, sub_site_id) {
            $.cookie("sub_site_id", sub_site_id);
            $.cookie('sub_site_name', e);
            $.cookie('sub_site_logo', $('#sub_site_div_' + sub_site_id).data('logo'));
            $.cookie('sub_site_copyright', $('#sub_site_div_' + sub_site_id).data('copyright'));
            location.reload();
        }
    }

    var shop_id = $('#shop_id').val();
    url = SITE_URL + '?ctl=Index&met=toolbar';
    $(".J-global-toolbar").load(url, {shop_id: shop_id}, function() {});

    if ($.isFunction($.fn.blueberry)) {
        $(".blueberry").blueberry();
    }
    /*页面滚动 搜索框置顶 2018-07-10 */
    $(window).scroll(function(){
        var head_cont_scroll = $(".head_cont").offset().top;
        var win_top = $(this).scrollTop();
        if(win_top > head_cont_scroll){
            $(".head_cont").addClass("head_cont_fixed");
        }else{
            $(".head_cont").removeClass("head_cont_fixed");
        }

    })

});
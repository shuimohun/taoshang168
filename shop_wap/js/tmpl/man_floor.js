var cat_id = getQueryString("cat_id");
$(function(){
//   footer  高亮   start1
    $(".nav-fixed li.side-icon").click(function(){
        if($(".pop-up").hasClass("animated") || $(".more-activties-wrap").hasClass("animated")){
            /*activityStop();
             popUpStop();*/
            return;
        }else{
            if(!($(this).hasClass("curr"))){
                $(this).addClass("curr");
                $(this).siblings("li").removeClass("curr");
            }
        }
    });



//   添加   我喜欢   start
    $(".goods-ul .goods .goods-detail .goods-like .like").click(function(){
        if($(this).hasClass("curr")){
            $(this).removeClass("curr");
        }else{
            $(this).addClass("curr");
        }
    });
//   添加   我喜欢    end


    /*初始化  swiper end*/

    var hasmore = true;
    var pagesize = 24;
    var curpage = 0;
    var firstRow = 0;

    var type = getQueryString("type");
    var cat_sid = getQueryString("cat_sid");
    if(!getCookie('sub_site_id')){
        addCookie('sub_site_id',0,0);
    }
    var sub_site_id = getCookie('sub_site_id');


    //头部一级分类
    function get_goods_cat() {
        $.getJSON(ApiUrl + "?ctl=Activity&met=manFloor&typ=json"+"&type="+type, function (e) {
            if(e.status == 200){
                var data = e.data;
                var nav = template.render("nav", data);
                $('.nav .nav-scroll-wrap ul').html(nav);

                var man_nav = template.render("man_nav",data);
                $('.nav-fixed').html(man_nav);
                if(type){
                    var pitch = parseInt(type)-parseInt(1);
                    $('footer li .curr').removeClass('curr');
                    $('footer li').eq(pitch).children('div').addClass('curr');
                }

                var page_html = '<div class="swiper-slide"><div class="main"></div></div>';
                $.each(data.goods_cat,function (k,v) {
                    page_html += '<div class="swiper-slide"><div class="main"></div></div>';
                });
                $('.page .swiper-wrapper').append(page_html);


                //导航处   start
                var navli_w=$(".nav-scroll-wrap li").first().children("a").innerWidth();
                $(".sideline").width(navli_w);
                var marginStr = $(".nav-scroll-wrap a").css("margin");
                var marginL = parseFloat(marginStr.split(" ")[1]);
                $(".sideline").css({"left":marginL + "px"});
                $(".nav-scroll-wrap li").on('click', function(){
                    if($(".more-activties-wrap").hasClass("animated") || $(".pop-up").hasClass("animated")){
                        return;
                    }else{
                        navli_w=$(this).children("a").outerWidth();
                        $(".sideline").css({"width":$('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).children("a").outerWidth()});
                        $(".sideline").css({"left":$('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).position().left + marginL});
                        $(this).addClass("curr").siblings().removeClass("curr");
                        var nav_w = ($(".nav").width() - navli_w) / 2;
                        var fnl_l;
                        var fnl_x = parseInt($(this).position().left);
                        if (fnl_x <= nav_w) {
                            fnl_l = 0;
                        } else if (nav_w - fnl_x <= nb_w - nsw_w) {
                            fnl_l = nb_w - nsw_w;
                        } else {
                            fnl_l = nav_w - fnl_x;
                        }
                        $(".nav-bar").animate({
                            "scrollLeft" : -fnl_l
                        }, 0);
                        mySwiper_page.slideTo($(this).index(), 300);
                    }
                });

                var nsw_w=$(".nav-scroll-wrap").width();
                var nb_w=$(".nav-bar").width();
                //导航处   end

                /*初始化  swiper*/
                var mySwiper_page = new Swiper ('.page.swiper-container', {
                    direction: 'horizontal',
                    loop: false,
                    followFinger:false,
                    onTransitionStart:function(swiper){
                        var nav_w = ($(".nav").width() - navli_w) / 2;
                        var fnl_l;
                        var fnl_x = parseInt($('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).position().left);
                        if (fnl_x <= nav_w) {
                            fnl_l = 0;
                        } else if (nav_w - fnl_x <= nb_w - nsw_w) {
                            fnl_l = nb_w - nsw_w;
                        } else {
                            fnl_l = nav_w - fnl_x;
                        }
                        $(".nav-bar").animate({
                            "scrollLeft" : -fnl_l
                        }, 0);
                        $(window).scrollTop(0);
                        $(".sideline").css({"width":$('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).children("a").outerWidth()});
                        $(".sideline").css({"left":$('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).position().left + marginL})
                        $('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).addClass('curr').siblings("li").removeClass('curr');

                        cat_id = $('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).data('id');
                        firstRow = 0;
                        init_main();
                    }

                });


            }
        })
    }

    function init_main(more) {
        param = {};
        param.firstRow = firstRow;

        if (type != ""){
            param.type = type
        }
        if (cat_id != ""){
            param.cat_id = cat_id
        }

        $.getJSON(ApiUrl + "?ctl=Activity&met=manFloor&typ=json", param, function (e) {
            if(e.status == 200){
                if(more){
                    var main = template.render("more_goods", e.data);
                    $('.page .swiper-wrapper .swiper-slide-active .main ul').append(main);
                }else{
                    var main = template.render("main", e.data);
                    $('.page .swiper-wrapper .swiper-slide-active .main').html(main);
                }
                curpage++;
                if(e.data['data_goods'].page < e.data['data_goods'].total){
                    firstRow = curpage * pagesize;
                    hasmore = true;
                    $('.no-data').hide();
                    $('.loading').show();
                }else{
                    hasmore = false;
                    $('.no-data').show();
                    $('.loading').hide();
                }

                var mySwiper_banner = new Swiper ('.banner.swiper-container', {
                    direction: 'horizontal',
                    loop: true,
                    pagination: '.swiper-pagination',
                    autoplayDisableOnInteraction : false,
                    autoplay: 3500
                });

                var H = $(".page .swiper-wrapper .swiper-slide-active .main").height();
                $(".swiper-container.page").css('height', H + 'px');
            }
        });
    }

    get_goods_cat();
    init_main();

    $(window).scroll(function(e) {
        if( !($(".pop-up").hasClass("block")) && !($(".ui-mask").hasClass("block")) ){
            if($(window).scrollTop() + $(window).height() == $(document).height()) {
                if(hasmore){
                    init_main(true);
                }
            }
        }
    });


});

function man_navSlider(th){
    var type = parseInt($(th).data('id'))+parseInt(1);
    window.location.href =  WapSiteUrl+'/tmpl/man_floor.html?type='+type;
}

function favorite(my,fav,goods_id)
{
    var i = $(my);
    var key = getCookie('key');

    if (!key) {
        checkLogin(0);
        return;
    }

    if (goods_id <= 0) {
        alert('参数错误');
        return false;
    }

    if(fav == '0')
    {
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Goods_Goods&met=collectGoods&typ=json',
            data:{k:key,u:getCookie('id'),goods_id:goods_id},
            dataType: 'json',
            async: false,
            success: function(result) {
                if (result.status == 200) {
                    i.parent().attr('class','like curr');
                } else {
                    console.log(result);
                    alert(result.data.error);
                    return false;
                }
            }
        });
    }
    else
    {
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Goods_Goods&met=canleCollectGoods&typ=json',
            data: {k: key,u:getCookie('id'), goods_id: goods_id},
            dataType: 'json',
            async: false,
            success: function(result) {
                if (result.status == 200) {
                    i.parent().attr('class','like lf');
                } else {
                    alert(result.data.error);
                    return false;
                }
            }
        });
    }
}







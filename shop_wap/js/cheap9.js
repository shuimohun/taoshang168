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

    $('.nav-fixed .home-icon').on('click',function () {
        cat_id='';
        firstRow = 0;
        type = 1;
        init_main(false);
    });
    $('.nav-fixed .icon-9').on('click',function () {
        type = 1;
        firstRow = 0;
        init_main(false);
    });
    $('.nav-fixed .icon-20').on('click',function () {
        type = 2;
        firstRow = 0;
        init_main(false);
    });
    $('.nav-fixed .icon-50').on('click',function () {
        type = 3;
        firstRow = 0;
        init_main(false);
    });
//   footer  高亮   end

//     点击其它地方    ------start
    $(document).click(function(e){
        if( ($(e.targe) !== $(".nav-right-icon") && $(".pop-up").hasClass("animated")) ||  ($(e.targe) !== $(".more-icon") && $(".more-activties-wrap").hasClass("animated"))){
            /*$("body").css({"position":"static"});
            $("body").scrollTop( -parseFloat($("body").css("top")) );*/
            popUpStop();
            activityStop();
        }
    });

    $(".pop-up").click(function(e){
        e.stopPropagation();
    });
    $(".more-activties-wrap").click(function(e){
        e.stopPropagation();
    });
//     点击其它地方    ------end

//   添加   我喜欢   start
    $(".goods-ul .goods .goods-detail .goods-like .like").click(function(){
        if($(this).hasClass("curr")){
            $(this).removeClass("curr");
        }else{
            $(this).addClass("curr");
        }
    });
//   添加   我喜欢    end

//  点击右侧 弹框     start
    $(".nav-right-icon").click(function(e){
        e.stopPropagation();
        if(!($(".pop-up").hasClass("ed"))){
            $(".pop-up").addClass("ed");
            if(!($(".pop-up").hasClass("animated"))){
                $(".pop-up").addClass("block");
                /*var levelwH = $(".pop-up .level-1-wrap").outerHeight();
                 $(".pop-up .pop-up-content").css({"top":poppaH + searchH + levelwH});    //动态获取    pop-up-content  的  top值*/
                $(".pop-up").addClass("animated");
                $(".pop-up").animate({"marginLeft":"-5rem"},500,function(){
                    // $("body").css({"position":"fixed","top":-$(window).scrollTop() + "px","left":0});
                    $(".pop-up").removeClass("ed");
                });
            }else{
               /* $("body").css({"position":"static"});
                $("body").scrollTop( -parseFloat($("body").css("top")) );*/
                popUpStop();
            }
        }else{
            return false;
        }
    });

    $(".pop-up .search input").click(function(){
        $(".search .keyW span").remove();
    });
    // 点击 右侧 弹框       end


//   点击  更多活动        start
    $(".more-icon").click(function(e){
        e.stopPropagation();
        if($(".pop-up").hasClass("animated")){
//			popUpStop();
            return;
        }else{
            if(!($(".more-activties-wrap").hasClass("ed"))){
                $(".more-activties-wrap").addClass("ed");
                if(!($(".more-activties-wrap").hasClass("animated"))){
                    $(".ui-mask").addClass("block");
                    $(".ui-mask").animate({"opacity":0.6},320);
                    $(".more-activties-wrap").animate({"bottom":"1.5625rem"},320,function(){
                        // $("body").css({"position":"fixed","top":-$(window).scrollTop() + "px","left":0});
                        $(".more-activties-wrap").addClass("animated");
                        $(".more-activties-wrap").removeClass("ed");
                    });
                }else{
                    /*$("body").css({"position":"static"});
                    $("body").scrollTop( -parseFloat($("body").css("top")) );*/
                    activityStop();
                }
            }else{
                return false;
            }
        }
    });
//   点击  更多活动    end	d


    //收起  更多活动  start
    function activityStop() {
        $(".more-activties-wrap").animate({"bottom":"-3.078125rem"},320,function(){
            $(".more-activties-wrap").removeClass("animated");
            $(".more-activties-wrap").removeClass("ed");
        });
        $(".ui-mask").animate({"opacity":0},320,function(){
            $(".ui-mask").removeClass("block");
        });
    }
    //收起  更多活动  end


    //  收起 右侧弹窗  function  start
    function popUpStop(){
        $(".pop-up").removeClass("animated");
        $(".pop-up").animate({"marginLeft":"5rem"},500,function(){
            $(".pop-up").removeClass("block");
            $(".pop-up").removeClass("ed");
        });
    }
    //  收起 右侧弹窗  function end

    /*初始化  swiper end*/

    var hasmore = true;
    var pagesize = 24;
    var curpage = 0;
    var firstRow = 0;

    var type = getQueryString("type");
    var cat_id = getQueryString("cat_id");
    var cat_sid = getQueryString("cat_sid");
    if(!getCookie('sub_site_id')){
        addCookie('sub_site_id',0,0);
    }
    var sub_site_id = getCookie('sub_site_id');


    //头部一级分类
    function get_goods_cat() {
        $.getJSON(ApiUrl + "?ctl=Goods_Cat&met=getOneCat&typ=json", function (data) {
            if(data.status == 200){

                /*var html = '<li data-id="0"><a href="javascript:;">全部</a></li>';
                var page_html = '<div class="swiper-slide"><div class="main"></div></div>';
                $.each(data.data,function (k,v) {
                    html += '<li data-id="'+v['cat_id']+'"><a  href="javascript:;">'+v['nav_name']+'</a></li>';
                    page_html += '<div class="swiper-slide"><div class="main"></div></div>';
                });

                $('.nav .nav-scroll-wrap ul').append(html);
                $('.page .swiper-wrapper').append(page_html);*/

                var nav = template.render("nav", data);
                $('.nav .nav-scroll-wrap ul').append(nav);

                var page_html = '<div class="swiper-slide"><div class="main"></div></div>';
                $.each(data.data,function (k,v) {
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
                        $(".sideline").css({"left":$('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).position().left + marginL})
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
        }else{
            param.type = 1
        }
        if (cat_id != ""){
            param.cat_id = cat_id
        }else {
            param.cat_id = 0
        }
        if (cat_sid != ""){
            param.cat_sid = cat_sid
        }


        $.getJSON(ApiUrl + "?ctl=Goods_Cheap&met=index&typ=json&sub_site_id="+sub_site_id + window.location.search.replace("?", "&"), param, function (e) {
            if(e.status == 200){
                if(more){
                    var main = template.render("more_goods", e.data);
                    $('.page .swiper-wrapper .swiper-slide-active .main ul').append(main);
                }else{
                    $('.page .swiper-wrapper .swiper-slide-active .main').empty();
                    console.log(e.data);
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
        alert(goods_id);
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
        alert(goods_id);
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







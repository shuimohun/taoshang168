var pagesize = 24;
var curpage = 0;
var firstRow = 0;
var hasmore = true;
var footer = false;
var state = getQueryString("state");
var cat_id = getQueryString("cat_id");
var scat_id = getQueryString("scat_id");
if(!getCookie('sub_site_id')){
    addCookie('sub_site_id',0,0);
}
var sub_site_id = getCookie('sub_site_id');

function get_goods_list(clear){
    param = {};
    console.log(firstRow)
    param.firstRow = firstRow;
    if (state != ""){
        param.state = state
    }
    if (cat_id != ""){
        param.cat_id = cat_id
    }
    if (scat_id != ""){
        param.scat_id = scat_id
    }
    $.getJSON(ApiUrl + "?ctl=ScareBuy&met=index&typ=json&sub_site_id="+sub_site_id + window.location.search.replace("?", "&"), param,function (e) {
        if(e.status == 200){
            if(curpage == 0){
                var nav = template.render("nav", e.data['cat']);
                $("#topNav .swiper-wrapper").append(nav);

                var mySwiper = new Swiper('#topNav', {
                    freeMode: true,
                    freeModeMomentumRatio: 0.5,
                    slidesPerView: 'auto',
                });

                /* Swiper 动态加载
                $.each(e.data['cat']['physical'],function (k,v) {
                    html += '<div class="swiper-slide" data-id="'+v['scarebuy_cat_id']+'"><span>'+v['scarebuy_cat_name']+'</span></div>';
                });
                mySwiper.appendSlide(html);*/

                swiperWidth = mySwiper.container[0].clientWidth;
                maxTranslate = mySwiper.maxTranslate();
                maxWidth = -maxTranslate + swiperWidth / 2;
                $(".swiper-container").on('touchstart', function(e) {
                    e.preventDefault();
                })
                mySwiper.on('tap', function(swiper, e) {
                    e.preventDefault();
                    slide = swiper.slides[swiper.clickedIndex];
                    slideLeft = slide.offsetLeft;
                    slideWidth = slide.clientWidth;
                    slideCenter = slideLeft + slideWidth / 2;
                    // 被点击slide的中心点
                    mySwiper.setWrapperTransition(300);
                    if (slideCenter < swiperWidth / 2) {
                        mySwiper.setWrapperTranslate(0);
                    } else if (slideCenter > maxWidth) {
                        mySwiper.setWrapperTranslate(maxTranslate)
                    } else {
                        nowTlanslate = slideCenter - swiperWidth / 2;
                        mySwiper.setWrapperTranslate(-nowTlanslate)
                    }

                    $('.nav-bar .curr').removeClass('curr');

                    $("#topNav .active").removeClass('active');
                    $("#topNav .swiper-slide").eq(swiper.clickedIndex).addClass('active');


                    cat_id = $("#topNav .swiper-slide").eq(swiper.clickedIndex).data('id');

                    //console.log(cat_id);
                    firstRow = 0;
                    get_goods_list(true);
                });

                var banner = template.render("banner", e.data);
                $(".slider_list .swipe-wrap").append(banner);
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

                if(e.data['recommend']){
                    var recommend_list = template.render("recommend", e.data['recommend']);
                    $(".recommend").html(recommend_list);
                }

                var swiper = new Swiper('.lb2 .swiper-container', {
                    pagination: '.lb2 .swiper-pagination',
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 18,
                    freeMode: true
                });

            }

            var goods_list = template.render("goods_list", e.data['goods']);

            if(clear){
                $(".goods_list").empty();
            }
            $(".goods_list").append(goods_list);


            $(".loading").remove();
            curpage++;

            if(e.data['goods'].page < e.data['goods'].total)
            {
                firstRow = curpage * pagesize;
                hasmore = true;
            }
            else
            {
                hasmore = false;
            }


            var _TimeCountDown = $(".fnTimeCountDown");
            _TimeCountDown.fnTimeCountDown();
        }
    });
}


$(function(){
    get_goods_list();

    $(window).scroll(function ()
    {
        if(hasmore) {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
                get_goods_list(false);
            }
        }
    });

    $('.footer li').eq(0).on('click',function () {
        state = '';
        firstRow = 0;
        get_goods_list(true);
    })
    $('.footer li').eq(1).on('click',function () {
        state = 'underway';
        firstRow = 0;
        get_goods_list(true);
    })
    $('.footer li').eq(2).on('click',function () {
        state = 'history';
        firstRow = 0;
        get_goods_list(true);
    })




});

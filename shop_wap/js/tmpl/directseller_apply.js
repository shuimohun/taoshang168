var page = 1;
var hasMore = true;
var footer = false;
var reset = true;
var orderKey = "";

$(function() {
    var e = getCookie("key");
    if (!e) {
        window.location.href = WapSiteUrl + "/tmpl/member/login.html"
    }

    function t() {
        if (reset) {
            page = 1;
            hasMore = true
        }

        if (!hasMore) {
            return false
        }

        $.ajax({
            type: "post",
            url: ApiUrl + "?ctl=Distribution_Buyer_Directseller&met=index&typ=json&page=" + page,
            data: {
                k: e,
                u: getCookie('id')
            },
            dataType: "json",
            success: function(e) {
                var t = e;
                t.WapSiteUrl = WapSiteUrl;
                t.ApiUrl = ApiUrl;
                t.key = getCookie("key");

                template.helper("p2f", function(e) {
                    return (parseFloat(e) || 0).toFixed(2)
                });
                template.helper("parseInt", function(e) {
                    return parseInt(e)
                });

                var r = template.render("apply-list-tmpl", t);
                var s = template.render("apply1-list-tmpl", t);

                if (reset) {
                    reset = false;
                    $(".swiper-wrapper").html(r);
                    $("#info").html(s);

                    var mySwiper = new Swiper('#topNav', {
                        freeMode: true,
                        freeModeMomentumRatio: 0.5,
                        slidesPerView: 'auto',
                    });
                    swiperWidth = mySwiper.container[0].clientWidth;
                    maxTranslate = mySwiper.maxTranslate();
                    maxWidth = -maxTranslate + swiperWidth / 2;
                    $(".swiper-container").on('touchstart', function(e) {
                        e.preventDefault();
                    })
                    mySwiper.on('tap', function(swiper, e) {
                        slide = swiper.slides[swiper.clickedIndex];
                        slideLeft = slide.offsetLeft;
                        slideWidth = slide.clientWidth;
                        slideCenter = slideLeft + slideWidth / 2;
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
                        // writeObj($("#topNav .swiper-slide").eq(swiper.clickedIndex));

                        var shop_class_id = $("#topNav .swiper-slide").eq(swiper.clickedIndex).attr('data-id');
                        $.ajax({
                            type: "post",
                            url: ApiUrl + "?ctl=Distribution_Buyer_Directseller&met=index&cid=" + shop_class_id + "&typ=json",
                            data: {

                            },
                            dataType: "json",
                            success: function(e) {
                                // alert(e);
                                var t = e;
                                var r = template.render("apply1-list-tmpl", t);
                                $("#info").html(r);
                            }
                        });
                    });

                } else {
                    $(".swiper-wrapper").append(r);
                    $("#info").append(s);
                }

                if (e.data.page < e.data.total) {
                    hasMore = true;
                    page++;
                } else {
                    hasMore = false;
                    get_footer();
                    if (e.data.items.length <= 0) {
                        $("#footer").addClass("posa")
                    } else {
                        $("#footer").removeClass("posa")
                    }
                }
                $('.tanchu').click(function () {
                    console.log(11)
                    $.sDialog({
                        skin: "red",
                        content: "未满足条件",
                        okBtn: false,
                        cancelBtn: false
                    });
                    var tc_height = $(".s-dialog-wrapper").height();
                  $(".s-dialog-wrapper").css("top","50%");
                  $(".s-dialog-wrapper").css("margin-top",-tc_height/2+"px");
                });

            }
        })
    }
    t();

    $(window).scroll(function() {
        if(hasMore){
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
                t();
            }
        }
    });

});


function get_footer() {
    if (!footer) {
        footer = true;
        $.ajax({
            url: "../../js/tmpl/footer.js",
            dataType: "script"
        })
    }
}

function apply(shop_id) {
    var e = getCookie("key");
    $.ajax({
        type: "post",
        url: ApiUrl + "?ctl=Distribution_Buyer_Directseller&met=addDirectseller&typ=json&shop_id=" + shop_id,
        data: {
            k: e,
            u: getCookie('id')
        },
        dataType: "json",
        success: function(e) {
            window.location.href = WapSiteUrl + "/tmpl/member/directseller_apply.html"
        }
    })
}


/*******轮播图************/
$(function(){
    if(!getCookie('sub_site_id')){
        addCookie('sub_site_id',0,0);
    }
    var sub_site_id = getCookie('sub_site_id');
    $.ajax({
        url: ApiUrl + "?ctl=Index&met=getWapIndexByKey&typ=json&key=1",
        type: 'get',
        dataType: 'json',
        success:function(result){
            var data = result.data;
            var html = '';
            $.each(data, function(k, v) {
                $.each(v, function(kk, vv) {
                    if(kk != 'key'){
                        html += template.render(kk, vv);
                    }
                });
            });

            $("#main_content1").html(html);
            slider();
        }
    });


    $.ajax({
        url: ApiUrl + "?ctl=Index&met=getWapIndexByKey&typ=json",
        type: 'get',
        dataType: 'json',
        success: function(result) {
            var data = result.data;
            var html = '';
            $.each(data, function(k, v) {

                $.each(v, function(kk, vv) {

                    switch (kk) {
                        case 'slider_list':
                        case 'home3','goods':
                            $.each(vv.item, function(k3, v3) {
                                vv.item[k3].url = buildUrl(v3.type, v3.data);
                            });
                            break;

                        case 'home1':
                            vv.url = buildUrl(vv.type, vv.data);
                            break;

                        case 'home2':
                        case 'home4':
                            vv.square_url = buildUrl(vv.square_type, vv.square_data);
                            vv.rectangle1_url = buildUrl(vv.rectangle1_type, vv.rectangle1_data);
                            vv.rectangle2_url = buildUrl(vv.rectangle2_type, vv.rectangle2_data);
                            break;
                    }

                    if(kk != 'key'){
                        html += template.render(kk, vv);
                        //return false;
                    }
                });


            });

            $("#main_content2").html(html);
            slider();
            var swiper = new Swiper('.swiper-container', {
                    pagination: '.swiper-pagination',
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 30,
                    freeMode: true
                });

            information();
        }
    });

    if(!getCookie('pop')) {
        $.ajax({
            url: ApiUrl + "?ctl=Adv_Adv&met=index&type=app_start&typ=json",
            type: 'get',
            dataType: 'json',
            success: function (result) {
                if (result.status == 200) {
                    $.each(result.data, function (i) {
                        $('.pop-ad-wrap .pop-ad a').attr('href', result.data[i].url);
                        $('.pop-ad-wrap .pop-ad img').attr('src', result.data[i].pic_url);
                    })

                    // 广告弹框 start
                    if (!getCookie('pop')) {
                        setTimeout(function () {
                            popAdd();
                        }, 300)
                        addCookie('pop', 1, 1);
                    }
                }
            }
        });
    }

    function popAdd(){
        $(".pop-ad-wrap").fadeIn(500,function(){
            $('.pop-ad-wrap').click(function () {
                $(".pop-ad-wrap").hide();
            })

            $('.img-wrap-con .icon').click(function () {
                $(".pop-ad-wrap").hide();
            })
        });
    }
// 广告弹框 end

});

function slider() {
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
}

function timer(opj){
    $(opj).find('ul').animate({
        marginTop : "-.2rem"
    },300,function(){
        $(this).css({marginTop : "0rem"}).find("li:first").appendTo(this);
    })
}

function information() {
    var num = $('.notice_active').find('li').length;
    if(num > 1){
        var time=setInterval('timer(".notice_active")',3000);
        $('.gg_more a').mousemove(function(){
            clearInterval(time);
        }).mouseout(function(){
            time = setInterval('timer(".notice_active")',3000);
        });
    }
    /*$(".news_ck").click(function(){
     location.href = $(".notice_active .notice_active_ch").children(":input").val();
     })*/
}
function open_show(){
    $('.open').show();
    $('.open_close').on('click',function(){
        $(this).parents("section").css({'display':'none'});
        $('body').css({'margin-top':'1rem'});
        $('.nav').css({
            'position':'fixed',
            'top':'0'
        });
        addCookie('openshow',1,1);
    });
    if (getCookie('openshow')){
        $('.open').css({'display':'none'});
        $('body').css({'margin-top':'1rem'});
        $('.nav').css({
            'position':'fixed',
            'top':'0'
        });
    } else {
        $(this).parent().css({'display':'block'});
        $('body').css({'margin-top':'1.8rem'});
    }
};
open_show();

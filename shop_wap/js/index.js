$(function() {
    // //克隆头部
    // var headerClone = $('#header').clone();
    // //窗口滚动事件
    // $(window).scroll(function(){
    //     //判断顶部是否偏移
    //     if ($(window).scrollTop() <= $('#main-container1').height()) {
    //         headerClone = $('#header').clone();
    //         $('#header').remove();
    //         headerClone.addClass('transparent').removeClass('');
    //         headerClone.prependTo('.nctouch-home-top');
    //     } else {
    //         headerClone = $('#header').clone();
    //         $('#header').remove();
    //         headerClone.addClass('').removeClass('transparent');
    //         headerClone.prependTo('body');
    //     }
    // });

    if(!getCookie('sub_site_id')){
        addCookie('sub_site_id',0,0);
    }
    var sub_site_id = getCookie('sub_site_id');

    $.ajax({
        url: ApiUrl + "?ctl=Index&met=getWapIndexByKey&typ=json&key=1",
        type: 'get',
        dataType: 'json',
        success: function(result) {
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
                    console.log(vv);
                    if (kk === 'slider_list' || kk === 'home3', 'goods') {
                        $.each(vv.item, function (k3, v3) {
                            vv.item[k3].url = buildUrl(v3.type, v3.data);
                        });
                    } else if (kk === 'home1') {
                        vv.url = buildUrl(vv.type, vv.data);
                    } else if (kk === 'home2' || kk === 'home4') {
                        vv.square_url = buildUrl(vv.square_type, vv.square_data);
                        vv.rectangle1_url = buildUrl(vv.rectangle1_type, vv.rectangle1_data);
                        vv.rectangle2_url = buildUrl(vv.rectangle2_type, vv.rectangle2_data);
                    }

                    if(kk != 'key'){
                        html += template.render(kk, vv);

                        //return false;
                    }
                });


            });

            $("#main_content2").html(html);


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
    });

});


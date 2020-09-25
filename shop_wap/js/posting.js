$(function () {
    var key = getCookie('key');//登录标记
    if (!key) {
        var callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' ;
        var login_url = UCenterApiUrl + '?ctl=Login&met=index&typ=e' + '&from=wap&callback=' + encodeURIComponent(callback);
        window.location.href = login_url;
    } else {
        $.getJSON(ApiUrl + "?ctl=Buyer_Say&met=postJson&typ=json", {}, function (e) {
            if (e.status == 200){
                if (e.data.user_punish == '1'){
                    $.sDialog({
                        autoTime: "0",
                        skin: "red",
                        content: e.data.user_punish_con,
                        "okFn": function() {window.history.go(-1)},
                        "cancelFn": function() {window.history.go(-1)}
                    });
                    return false;
                }else{

                    $('.main').removeClass('hide');
                    $('.foot').removeClass('hide');

                    var page = 1;
                    var hasmore = true;
                    var reset = false;
                    var goods_group_id = 0;
                    var goods_recommend = [];
                    var goods_recommend_price = [];

                    if (e.data.nav){
                        goods_group_id = e.data.nav[0].id;
                    }

                    var nav = template.render("nav", e.data);
                    $('#topNav .swiper-wrapper').append(nav);

                    var group = template.render("group", e.data);
                    $('.add_type_list').append(group);

                    var mySwiper = new Swiper('#topNav', {
                        freeMode: true,
                        slidesPerView: 'auto',
                    });
                    swiperWidth = mySwiper.width;
                    maxTranslate = mySwiper.getWrapperTranslate();
                    maxWidth = -maxTranslate + swiperWidth / 2;
                    mySwiper.on('tap', function(swiper, e) {
                        //e.preventDefault();
                        slide = swiper.slides[swiper.clickedIndex]
                        slideLeft = slide.offsetLeft;//当前元素距左侧的距离
                        slideWidth = slide.clientWidth;//当前元素的宽度
                        slideCenter = slideLeft //+ slideWidth / 2;// 被点击slide的中心点
                        mySwiper.setWrapperTransition(300)
                        if (slideCenter < slideWidth) {
                            mySwiper.setWrapperTranslate(0);
                        } else if (slideCenter > maxWidth) {
                            mySwiper.setWrapperTranslate(maxTranslate);
                        } else {
                            nowTlanslate = slideCenter;//- swiperWidth / 2
                            mySwiper.setWrapperTranslate(-nowTlanslate)
                        }

                        $("#topNav .active").removeClass('active')
                        $("#topNav .swiper-slide").eq(swiper.clickedIndex).addClass('active');
                    });
                    $(".swiper-container").on('touchend', function(e) {
                        e.preventDefault();
                        var screen_width = $(".find_nav").width();
                        var translate_py = mySwiper.getWrapperTranslate();
                        var slide_length =  mySwiper.slides.length;
                        var last_slideLeft =  mySwiper.slides[slide_length-1].offsetLeft;
                        var  slideWidth = mySwiper.slides[slide_length-1].clientWidth;//当前元素的宽度
                        if(translate_py >0){
                            mySwiper.setWrapperTranslate(0)
                        }if(translate_py<= -(last_slideLeft-screen_width+slideWidth)){
                            mySwiper.setWrapperTranslate(-(last_slideLeft-screen_width+slideWidth))
                        }

                        goods_group_id = $(".swiper-wrapper .swiper-slide").eq(mySwiper.clickedIndex).data('id');
                        page = 0;
                        reset = true;
                        $('.search_input').val('');
                        getGoodsList(goods_group_id,'');
                    });

                    //实例化编辑器
                    var ue = UE.getEditor('container', {
                        toolbars: [[
                            'bold', 'italic', 'underline','justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', 'simpleupload'/*,'insertvideo'*/
                        ]],
                        autoClearinitialContent: true,
                        //关闭字数统计
                        wordCount: false,
                        //关闭elementPath
                        elementPathEnabled: false,
                    });

                    //上传主图
                    $('input[name="upfile"]').click(function () {
                        var $e = $(this);
                        uploadImg($e);
                    });
                    $('.post_main_img').delegate('.upload_img','click',function () {
                        $('input[name="upfile"]').click();
                    });
                    function uploadImg(e) {
                        e.ajaxUploadImage({
                            url: ApiUrl + "?ctl=Upload&action=uploadImage",
                            data: {},
                            start: function (e) {
                                e.parent().siblings(".pic-thumb").remove()
                            },
                            success: function (e, a) {
                                $('.pic-thumb').remove();
                                if (a.state != 'SUCCESS') {
                                    e.parent().siblings(".upload-loading").remove();
                                    e.parent().show();
                                    $.sDialog({skin: "red", content: "图片尺寸过大！", okBtn: false, cancelBtn: false});
                                    return false
                                }
                                e.parent().after('<div class="pic-thumb"><img class="upload_img" src="' + a.url + '"/></div>');
                                e.parents("a").next().val(a.url);
                                e.parent().hide();
                            }
                        });
                    }

                    //推荐商品
                    $.animationLeft({
                        valve: ".upload_file_img",
                        wrapper: ".nctouch-full-mask",
                        scroll: ""
                    });
                    $(".pop_head .back").click(function(){
                        $(this).parents(".nctouch-full-mask.pop_search").addClass("right");
                        $('body').removeClass('ovfHiden');
                    });
                    $('.surebtn').click(function () {
                        $(".nctouch-full-mask.pop_search").addClass("right");
                        $('body').removeClass('ovfHiden');
                    });

                    $('#goods-ul').delegate('.goods-item-li','click',function () {
                        var goods_id = $(this).data('id');
                        $('.goods-item-' + goods_id).remove();
                        $('.cbtn-' + goods_id).removeClass('on');
                    });

                    function getGoodsList(goods_group_id,goods_name) {
                        param = {};
                        param.page = page;
                        if (goods_group_id >= 0){
                            param.goods_group_id = goods_group_id
                        }
                        if (goods_name){
                            param.goods_name = goods_name
                        }
                        $.getJSON(ApiUrl + "?ctl=Information_Base&met=goods_recommend&typ=json", param, function (e) {
                            if (e.status == 200){
                                if (reset){
                                    $('.goods-secrch-list').html('');
                                }

                                var selected_data = [];
                                $('#goods-ul .goods-item-li').each(function (e) {
                                    var goods_id = $(this).data('id');
                                    selected_data.push(goods_id*1);
                                });

                                for (var i=0;i<e.data.items.length;i++) {
                                    var goods_id = e.data.items[i].goods_id;
                                    var index = $.inArray(goods_id*1, selected_data);
                                    if(index >= 0){
                                        e.data.items[i].on = 'on';
                                    }else{
                                        e.data.items[i].on = '';
                                    }
                                }

                                var goods_list = template.render("goods_list", e.data);
                                $('.goods-secrch-list').append(goods_list);

                                if (e.data.items.length <= 0) {
                                    $('.more').html('暂无数据...');
                                }

                                if(e.data.items.length > 0 && e.data.page < e.data.total) {
                                    page++;
                                    $('.more').html('更多内容加载中...');
                                    hasmore = true;
                                } else {
                                    if (e.data.items.length > 0 && e.data.total > 0){
                                        $('.more').html('没有更多了...');
                                    }
                                    hasmore = false;
                                }

                                reset = false;
                                //点击勾选商品
                                $(".goods-item .goods-pic").click(function(){
                                    var choose_btn = $(this).parents(".goods-item").find(".choosebtn");
                                    var goods_id = choose_btn.data('id');
                                    if(choose_btn.hasClass("on")){
                                        choose_btn.removeClass("on");
                                        $('.goods-item-' + goods_id).remove();
                                    }else{
                                        if ($('#goods-ul .goods-item-li').length >= 4){
                                            $.sDialog({
                                                skin: "red",
                                                content: "最多选4个",
                                                okBtn: false,
                                                cancelBtn: false
                                            });
                                            return false
                                        }else if($('#goods-ul .goods-item-' + goods_id).length >= 1){
                                            $.sDialog({
                                                skin: "red",
                                                content: "已选择该商品",
                                                okBtn: false,
                                                cancelBtn: false
                                            });
                                            return false
                                        }else{
                                            choose_btn.addClass("on");
                                            var image = choose_btn.data('image');
                                            var price = choose_btn.data('price');
                                            var d = {"id":goods_id,"type":goods_group_id,'src':image,'price':price};
                                            var tpl = $('#goods-item-tpl').html();
                                            tpl = tpl.replace(/__([a-zA-Z]+)/g, function(r, $1) {
                                                return d[$1]
                                            });

                                            $('.upload').before(tpl);
                                            $('#goods-ul').append(tpl);
                                        }
                                    }
                                });
                            }
                        });
                    }
                    getGoodsList(goods_group_id,'');

                    $(".ft_main").scroll(function(){
                        if (hasmore){
                            var divHeight = $(this).height();
                            var nScrollHeight = $(this)[0].scrollHeight;
                            var nScrollTop = $(this)[0].scrollTop;
                            if(nScrollTop + divHeight >= nScrollHeight) {
                                getGoodsList(goods_group_id);
                            }
                        }
                    });

                    //添加到模板
                    $(".add_type_list li").click(function(){
                        if($(this).hasClass("on")){
                            $(this).removeClass("on")
                        }else{
                            $(".add_type_list .on").removeClass('on');
                            $(this).addClass("on")
                        }
                    });

                    $('.releasebtn').click(function () {

                        var p = {};

                        var information_title = $.trim($('.title_detail').val());
                        if (information_title == ""){
                            $.sDialog({
                                autoTime: "1000",
                                skin: "red",
                                content: "请填写标题",
                                okBtn: false,
                                cancelBtn: false
                            });
                            return false;
                        }else{
                            p.information_title = information_title;
                        }

                        var information_pic = $(".pic-thumb .upload_img").attr("src");
                        if(information_pic){
                            p.information_pic = information_pic;
                        }else{
                            $.sDialog({
                                autoTime: "1000",
                                skin: "red",
                                content: "请上传主图",
                                okBtn: false,
                                cancelBtn: false
                            });
                            return false;
                        }

                        var con = ue.getContent();
                        if(con){
                            p.content = con;
                            p.keyword = con.substr(0,120);
                        }else{
                            $.sDialog({
                                autoTime: "1000",
                                skin: "red",
                                content: "请填写内容",
                                okBtn: false,
                                cancelBtn: false
                            });
                            return false;
                        }

                        var goods_recommend = [];
                        var goods_recommend_price = [];

                        $(".img_wrapper .goods-item-li").each(function (e) {
                            var goods_id = $(this).data("id");
                            var goods_price = $(this).data("price");

                            goods_recommend.push(goods_id);
                            goods_recommend_price.push(goods_price);
                        });
                        if (goods_recommend.length > 0){
                            p.information_goods_recommend = goods_recommend;
                            p.information_goods_recommend_type = goods_recommend_price;
                        }else{
                            $.sDialog({
                                autoTime: "1000",
                                skin: "red",
                                content: "请选择推荐商品",
                                okBtn: false,
                                cancelBtn: false
                            });
                            return false;
                        }

                        var information_group_id = $(".add_type_list .on").data("id");
                        if (information_group_id){
                            p.information_group_id = information_group_id;
                        }else{
                            $.sDialog({
                                autoTime: "1000",
                                skin: "red",
                                content: "请选择模版",
                                okBtn: false,
                                cancelBtn: false
                            });
                            return false;
                        }

                        var type = $('.share_wrap').data('selected');
                        if (type == ''){
                            $.sDialog({
                                autoTime: "1000",
                                skin: "red",
                                content: "请选择分享渠道",
                                okBtn: false,
                                cancelBtn: false
                            });
                            return false;
                        }

                        var shareData = {
                            title: information_title,
                            desc: '关注说说，发文章、发视频、阅读、转发、点赞，赚金蛋换大奖',
                            link: ApiUrl + '?ctl=News&met=detail&id=',
                            icon: information_pic,
                            success: function() {

                            },
                            fail: function() {

                            }
                        };
                        var nativeShare = new NativeShare();
                        function call(command) {
                            try {
                                nativeShare.call(command)
                            } catch (err) {
                                // 如果不支持，你可以在这里做降级处理
                                if (err.message) {
                                    alert(err.message)
                                } else {
                                    alert('当前浏览器不支持此功能。')
                                }
                            }
                        }

                        $.getJSON(ApiUrl + "?ctl=Information_Base&met=addInformationBase&typ=json", p, function (e) {
                            if (e.status == 200){
                                if (type) {
                                    shareData.link = shareData.link + e.data.information_id;
                                    nativeShare.setShareData(shareData);
                                    call(type);
                                }
                            }else{
                                $.sDialog({
                                    autoTime: "1000",
                                    skin: "red",
                                    content: "发布失败",
                                    okBtn: false,
                                    cancelBtn: false
                                });
                                return false;
                            }
                        });

                    });

                    $('.share_wrap li').click(function () {
                        $('.share_wrap .curr').removeClass('curr');
                        $(this).addClass('curr');
                        $('.share_wrap').data('selected',$(this).data('type'));
                    });

                    $('.search_btn').click(function () {
                        reset = true;
                        getGoodsList(goods_group_id,$.trim($('.search_input').val()));
                    })

                }
            }
        });
    }

});
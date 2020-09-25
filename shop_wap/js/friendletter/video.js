

var id        = getQueryString("info_id");
var types     = getQueryString("type");
var from      = getQueryString("from");
var src       = getQueryString("src");
var video_src = '';
$(function(){

    $('#foot').load('foot_.html');
    $('.pull_in_pl').load('pl_main.html');
    setTimeout(function(){
        $(".footer").append("<div class='foot_bg'></div>");
        var foot_alt = $(".footer").height();//获取脚部高度
        $(".foot_bg").css({"height":foot_alt+"px"});

        //底部导航点击start
        $(".index").click(function () {
            window.location.href = WapSiteUrl+'/tmpl/fans-circle.html';
        })
        var key 	     = getCookie("key");

        if( !key )
        {
            var callback    = window.location.href;
            var url         = UCenterApiUrl+'?ctl=Login&act=reg&t=&from=wap&callback='+ callback+'?';
            $(".fabu").click(function () {
                if( id && types && from )
                {

                    $.sDialog({
                        'content':'关注说说，发文章、发视频、阅读、转发、点赞，赚金蛋换大奖下载app',
                        'okBtnText':'去下载',
                        okFn:function () {
                            window.location.replace("http://www.taos168.com/app.php");
                        }
                    });
                }
                else
                {
                    window.location.href =url;
                }

            });
            $(".message").click(function () {
                if( id && types && from )
                {
                    $.sDialog({
                        'content':'关注说说，发文章、发视频、阅读、转发、点赞，赚金蛋换大奖下载app',
                        'okBtnText':'去下载',
                        okFn:function () {
                            window.location.replace("http://www.taos168.com/app.php");
                        }
                    });
                }
                else
                {
                    window.location.href = url;
                }

            })
            $(".more").click(function () {
                if( id && types && from )
                {
                    $.sDialog({
                        'content':'关注说说，发文章、发视频、阅读、转发、点赞，赚金蛋换大奖下载app',
                        'okBtnText':'去下载',
                        okFn:function () {
                            window.location.replace("http://www.taos168.com/app.php");
                        }
                    });
                }
                else
                {
                    window.location.href = url;
                }

            })
        }
        else
        {
            $(".fabu").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/information_message.html';
            });
            $(".message").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/friend_list.html';
            });
            $("#foot .more").click(function(){
                $(".more_win").css({"bottom":(foot_alt)+"px"});
                $(".mask").css({"display":"block","opacity":"0.4"})
            });
            
            $(".icon_interest").click(function () {
                window.location.href = WapSiteUrl + '/tmpl/friendletter/interestlabel.html';
            })
            $(".icon_addressbook").click(function () {
                window.location.href = WapSiteUrl + '/tmpl/friendletter/addressbook.html';
            });
            $(".icon_my_on").click(function () {
                window.location.href = WapSiteUrl + '/tmpl/friendletter/systeminfor.html';
            })
        }
        //底部导航点击end

        $("#foot .foot_item .hot_tv").parents(".foot_item").addClass("on");//对应位置标红
        $(".mask").click(function(){
            $(".more_win").css({"bottom":"-5rem"});
            $(this).css({"display":"none","opacity":"0"})
        })
        $(".more_win .close_btn").click(function(){
            $(".more_win").css({"bottom":"-5rem"});
            $(".mask").css({"display":"none","opacity":"0"})
        })
    },200)
    //引入底部


    //分享增加金蛋
    function share_point(infor_id){
        $.ajax({
            type: 'POST',
            url: ApiUrl + '?ctl=News&met=share_point&typ=json',
            data:{information_id:infor_id},
            dataType: 'json',
            async: false,
            success: function(result) {
                // console.log(result)
            }
        })
    }


    var video_page    = 1;
    var video_rows    = 2;
    //获取视频
    function getVideo() {

        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Information_Base&met=getVideo&typ=json',
            data:{page:video_page,rows:video_rows},
            dataType: 'json',
            async: false,
            success: function(e) {
                if( e.status == 200 )
                {

                    var video = template.render("video", e);
                    $(".video").html(video);

                    if( e.data.items == null )
                    {
                        $(".player_btn").hide();
                    }
                    //视频播放
                    var share_id = '';
                    var link;
                    if( !link )
                    {
                        share_id = $(".video .video_wrapper ").eq(0).find("video").attr("data-info");

                        link = WapSiteUrl + '/tmpl/friendletter/videoplay.html?info_id=' + share_id + '&type=app&from=';
                    }
                    if( !video_src )
                    {
                        video_src ='&src='+$(".video .video_wrapper ").eq(0).find("video").attr("src");
                    }
                    var mySwiper = new Swiper('.swiper-container', {
                        direction: 'vertical',
                        onSlideChangeEnd:function(mySwiper){

                            share_id = $(".swiper-slide-active").find("video").attr("data-info");

                            link = WapSiteUrl + '/tmpl/friendletter/videoplay.html?info_id=' + share_id + '&type=app&from=';
                            console.log(mySwiper.activeIndex+"---"+mySwiper.previousIndex)

                            $(".swiper-container .is_video")[mySwiper.previousIndex].pause();//上一个停止
                            $(".swiper-container .is_video")[mySwiper.activeIndex].play();//当前播放

                            $(".player_btn").addClass("hidden");

                            video_src ='&src='+$(".swiper-slide-active .video_box").find("video").attr("src");

                            var end = mySwiper.isEnd;
                            if( end )
                            {
                                videoMore(mySwiper)
                            }
                        },
                    });

                    video_page++;
                    pl_btn(mySwiper);
                    //分享底部弹框start
                    share_click()
                    //分享底部弹框end
                    //安卓手机视频播放不置顶播放
                    //在andriod手机上，添加video的一些属性
                    atrVideo();

                    //分享
                    var desc = "";
                    var share_img = '';
                    var title = '淘尚168商城';

                    if (e.data.wxConfig) {

                         //微信内分享
                        wx.config({
                            debug: false,
                            appId: e.data.wxConfig.appId,
                            timestamp: e.data.wxConfig.timestamp,
                            nonceStr: e.data.wxConfig.nonceStr,
                            signature: e.data.wxConfig.signature,
                            jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareQZone']
                        });

                        //微信加载
                        wx.ready(function() {
                            $('.share_img').on('click', function() {
                                var key = getCookie("key");
                                if( !key )
                                {
                                    var callback = window.location.href;
                                    var regUrl = UCenterApiUrl + '?ctl=Login&act=reg&t=';
                                    var reg_url = regUrl + '&from=wap&callback=' + callback+'?';
                                    window.location.href = reg_url;
                                    return false;
                                }
                            });
                             //朋友圈
                            wx.onMenuShareTimeline({
                                title: title,
                                // 分享标题
                                desc: desc,
                                link: link + 'weixin_timeline'+video_src,
                                // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                                imgUrl: share_img,
                                // 分享图标
                                success: function() {
                                    var infor_id = $(".swiper-slide-active").find(".share").attr("data-infoId");
                                    var id = getCookie("id");
                                    if( id )
                                    {
                                        share_point(infor_id);
                                    }
                                    alert('分享成功');

                                },
                                cancel: function() {
                                    alert('分享失败');
                                }
                            });
                            //微信朋友
                            wx.onMenuShareAppMessage({
                                title: title,
                                // 分享标题
                                desc: desc,
                                // 分享描述
                                link: link + 'weixin'+video_src,
                                // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                                imgUrl: share_img,
                                // 分享图标
                                success: function() {
                                    var infor_id = $(".swiper-slide-active").find(".share").attr("data-infoId");
                                    var id = getCookie("id");
                                    if( id )
                                    {
                                        share_point(infor_id);
                                    }
                                    alert('分享成功');
                                },
                                cancel: function() {
                                    alert('分享失败');
                                }
                            });
                            //qq好友
                            wx.onMenuShareQQ({
                                title: title,
                                // 分享标题
                                desc: desc,
                                // 分享描述
                                link: link + 'sqq'+video_src,
                                // 分享链接
                                imgUrl: share_img,
                                // 分享图标
                                success: function() {
                                    var infor_id = $(".swiper-slide-active").find(".share").attr("data-infoId");
                                    var id = getCookie("id");
                                    if( id )
                                    {
                                        share_point(infor_id);
                                    }
                                    alert('分享成功');

                                },
                                cancel: function() {

                                    alert('分享失败');
                                }
                            });
                            //qq空间
                            wx.onMenuShareQZone({
                                title: title,
                                // 分享标题
                                desc: desc,
                                // 分享描述
                                link: link + 'qzone'+video_src,
                                // 分享链接
                                imgUrl: share_img,
                                // 分享图标
                                success: function() {
                                    var infor_id = $(".swiper-slide-active").find(".share").attr("data-infoId");
                                    var id = getCookie("id");
                                    if( id )
                                    {
                                        share_point(infor_id);
                                    }
                                    alert('分享成功');
                                },
                                cancel: function() {
                                    alert('分享失败');
                                }
                            });
                        });
                    }
                    else
                    {
                        var nativeShare = new NativeShare();
                        var shareData = {
                            title: title,
                            desc: desc,
                            // 如果是微信该link的域名必须要在微信后台配置的安全域名之内的。
                            link: link,
                            icon: share_img,
                            // 不要过于依赖以下两个回调，很多浏览器是不支持的
                            success: function() {
                                alert('success')
                            },
                            fail: function() {
                                alert('fail')
                            }
                        };
                        function call(command) {
                            try {
                                nativeShare.call(command)
                            } catch (err) {
                                // 如果不支持，你可以在这里做降级处理
                                if (err.message)
                                {
                                    alert(err.message)
                                }
                                else
                                {
                                    alert('当前浏览器不支持此功能。')
                                }
                            }
                        }
                        $('.share_img').on('click', function() {

                            var infor_id = $(".swiper-slide-active").find(".share").attr("data-infoId");
                            var type = $(this).data('type');
                            var id = getCookie("id");
                            if( id )
                            {
                                share_point(infor_id);
                            }


                            if (type)
                            {
                                //&type=app&from=
                                stype = '';
                                if (type == 'qZone') {
                                    stype = 'qzone';
                                } else if (type == 'qqFriend') {
                                    stype = 'sqq';
                                } else if (type == 'wechatFriend') {
                                    stype = 'weixin';
                                } else if (type == 'wechatTimeline') {
                                    stype = 'weixin_timeline';
                                } else if (type == 'weibo') {
                                    stype = 'tsina';
                                }else if( type == "youxin") {

                                    share_friend();
                                    return false;
                                }
                                shareData.link=link;
                                shareData.link = shareData.link + stype+video_src;
                                nativeShare.setShareData(shareData);
                                console.log(shareData.link);
                                // return false;
                                call(type);
                            }
                        })

                    }
                    //分享end
                }
            }
        });
    }

    if( id && types && from && src )
    {
        link_html(id,src);
    }
    else
    {
        getVideo();
    }
    //视频加载
    function videoMore(mySwiper){
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Information_Base&met=getVideo&typ=json',
            data:{page:video_page,rows:video_rows},
            dataType: 'json',
            async: false,
            success: function(res) {
                if( res.status == 200 )
                {
                    var append = template.render("videoAppend",res);
                    mySwiper.appendSlide(append)
                    video_page++;
                    share_click();
                    atrVideo();
                    pl_btn(mySwiper);

                }
            }
        })
    }
    function link_html(id,src){

        $(".video").empty();
        $.ajax({
            type: 'POST',
            url: ApiUrl + '?ctl=Information_Base&met=getVideo&typ=json',
            data:{information_id:id,type:types,from:from,src:src,info_id:id},
            dataType: 'json',
            async: false,
            success: function(e) {
                if( e.status == 200 )
                {
                    var video_html='';
                    var data = e.data;
                    for( var i in data.items )
                    {
                         video_html +=
                            '<div class="video_wrapper swiper-slide ">' +
                                '<div class="video_box">' +
                                    '<video  class="is_video" data-info='+data.items[i].information_id+' src='+src+' x-webkit-airplay="true" webkit-playsinline="true" playsinline="true"></video> ' +
                                '</div>' +
                                '<div class="video_mask">' +
                                    '<div class="right_icon">' +
                                        '<ul>' +
                                            '<li class="r_v_item">' +
                                                '<div class="icon_box">' +
                                                    '<a href="javascript:;">' +
                                                        '<img class="icon_gift" onclick="gift(this)" data-id='+data.items[i].user_id+' src="../img/fans-circle/gift.png" alt="">' +
                                                    '</a>' +
                                                '</div>' +
                                            '</li>' +
                                            '<li class="r_v_item">' +
                                                '<div class="icon_box">' +
                                                    '<a href="javascript:;">' +
                                                        '<img class="icon_tx" onclick="userLogo(this)" data-id ='+data.items[i].user_id+' src='+data.items[i].user_logo+' onerror="this.src=\'../img/robot-ss.png\'" alt="">' +
                                                    '</a>' +
                                                '</div>' +
                                            '</li>' +
                                            '<li class="r_v_item">' +
                                                '<div class="icon_box">' +
                                                    '<a href="javascript:;">' ;
                                                     if( data.items[i].is_Like == 0 ){
                                                        video_html +='<img class="icon_p gz" onclick="like(this)" data-inforId='+data.items[i].information_id+' data-id='+data.items[i].user_id+'  src="../img/fans-circle/gz.png" alt="">';
                                                     }else{
                                                        video_html +='<img class="icon_p gz" onclick="like(this)" data-inforId='+data.items[i].information_id+' data-id='+data.items[i].user_id+' src="../img/fans-circle/gz2.png" alt="">';
                                                     }
                                                    video_html +='</a>' +
                                                '</div>' +
                                                '<div class="icon_text countLike">'+data.items[i].countLike+'</div>' +
                                            '</li>' +
                                            '<li class="r_v_item">' +
                                                '<div class="icon_box">' +
                                                    '<a href="javascript:;">' +
                                                        '<img  class="icon_p pl" onclick="pl(this)" data-inforId='+data.items[i].information_id+' src="../img/fans-circle/pl.png" alt="">' +
                                                    '</a>' +
                                                '</div>' +
                                                '<div class="icon_text">'+data.items[i].countReply+'</div>' +
                                            '</li>' +
                                            '<li class="r_v_item">' +
                                                '<div class="icon_box">' +
                                                    '<a href="javascript:;">' +
                                                        '<img  class="icon_p share " data-infoId='+data.items[i].information_id+' src="../img/fans-circle/share.png" alt="">' +
                                                    '</a>' +
                                                '</div>' +
                                                '<!--<div class="icon_text">9999</div>-->' +
                                            '</li>' +
                                        '</ul>' +
                                    '</div>' +
                                    '<div class="video_text">'+
                                         '<p class="video_text_title">' +
                                             data.items[i].user_name;
                                                if( data.items[i].is_friend ==1 ){
                                    video_html+='<span class="gz_friend active" data-uid='+data.items[i].user_id+' data-id='+data.items[i].friend_id+' onclick="friendTig(this)">已关注</span>';
                                                }
                                                else
                                                {
                                    video_html+='<span class="gz_friend" data-uid='+data.items[i].user_id+' onclick="friendTig(this)">关注</span>';
                                                }
                                    video_html+='</p>'+
                                         '<p class="video_text_con">'+data.items[i].information_title+'</p>'+
                                     '</div>'+
                                '</div>' +
                            '</div>';
                    }
                    $(".video").html( video_html);
                    var link='';
                    if( !link )
                    {
                        link = WapSiteUrl + '/tmpl/friendletter/videoplay.html?info_id=' + id + '&type=app&from=';
                    }
                    var mySwiper = new Swiper('.swiper-container', {
                        direction: 'vertical',
                        onSlideChangeEnd:function(mySwiper){

                            share_id = $(".swiper-slide-active").find("video").attr("data-info");

                            link = WapSiteUrl + '/tmpl/friendletter/videoplay.html?info_id=' + share_id + '&type=app&from=';
                            console.log(mySwiper.activeIndex+"---"+mySwiper.previousIndex)

                            $(".swiper-container .is_video")[mySwiper.previousIndex].pause();//上一个停止
                            $(".swiper-container .is_video")[mySwiper.activeIndex].play();//当前播放

                            $(".player_btn").addClass("hidden");

                            video_src ='&src='+$(".swiper-slide-active .video_box").find("video").attr("src");

                            var end = mySwiper.isEnd;
                            if( end )
                            {
                                videoMore(mySwiper)
                            }
                        },
                    });
                    atrVideo();
                    share_click();
                    pl_btn(mySwiper);
                    //分享
                    var desc = "";
                    var share_img = '';
                    var title = '淘尚168商城';

                    if (e.data.wxConfig) {

                        //微信内分享
                        wx.config({
                            debug: false,
                            appId: e.data.wxConfig.appId,
                            timestamp: e.data.wxConfig.timestamp,
                            nonceStr: e.data.wxConfig.nonceStr,
                            signature: e.data.wxConfig.signature,
                            jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareQZone']
                        });

                        //微信加载
                        wx.ready(function() {
                            $('.share_img').on('click', function() {
                                var key = getCookie("key");
                                if( !key )
                                {
                                    var callback = window.location.href;
                                    var regUrl = UCenterApiUrl + '?ctl=Login&act=reg&t=';
                                    var reg_url = regUrl + '&from=wap&callback='+callback+'?';
                                    window.location.href = reg_url;
                                    return false;
                                }
                            });
                            //朋友圈
                            wx.onMenuShareTimeline({
                                title: title,
                                // 分享标题
                                desc: desc,
                                link: link + 'weixin_timeline'+video_src,
                                // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                                imgUrl: share_img,
                                // 分享图标
                                success: function() {
                                    var infor_id = $(".swiper-slide-active").find(".share").attr("data-infoId");
                                    var id = getCookie("id");
                                    if( id )
                                    {
                                        share_point(infor_id);
                                    }
                                    alert('分享成功');

                                },
                                cancel: function() {
                                    alert('分享失败');
                                }
                            });
                            //微信朋友
                            wx.onMenuShareAppMessage({
                                title: title,
                                // 分享标题
                                desc: desc,
                                // 分享描述
                                link: link + 'weixin'+video_src,
                                // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                                imgUrl: share_img,
                                // 分享图标
                                success: function() {
                                    var infor_id = $(".swiper-slide-active").find(".share").attr("data-infoId");
                                    var id = getCookie("id");
                                    if( id )
                                    {
                                        share_point(infor_id);
                                    }
                                    alert('分享成功');
                                },
                                cancel: function() {
                                    alert('分享失败');
                                }
                            });
                            //qq好友
                            wx.onMenuShareQQ({
                                title: title,
                                // 分享标题
                                desc: desc,
                                // 分享描述
                                link: link + 'sqq'+video_src,
                                // 分享链接
                                imgUrl: share_img,
                                // 分享图标
                                success: function() {
                                    var infor_id = $(".swiper-slide-active").find(".share").attr("data-infoId");
                                    var id = getCookie("id");
                                    if( id )
                                    {
                                        share_point(infor_id);
                                    }
                                    alert('分享成功');

                                },
                                cancel: function() {

                                    alert('分享失败');
                                }
                            });
                            //qq空间
                            wx.onMenuShareQZone({
                                title: title,
                                // 分享标题
                                desc: desc,
                                // 分享描述
                                link: link + 'qzone'+video_src,
                                // 分享链接
                                imgUrl: share_img,
                                // 分享图标
                                success: function() {
                                    var infor_id = $(".swiper-slide-active").find(".share").attr("data-infoId");
                                    var id = getCookie("id");
                                    if( id )
                                    {
                                        share_point(infor_id);
                                    }
                                    alert('分享成功');
                                },
                                cancel: function() {
                                    alert('分享失败');
                                }
                            });
                        });
                    }
                    else
                    {
                        var nativeShare = new NativeShare();
                        var shareData = {
                            title: title,
                            desc: desc,
                            // 如果是微信该link的域名必须要在微信后台配置的安全域名之内的。
                            link: link,
                            icon: share_img,
                            // 不要过于依赖以下两个回调，很多浏览器是不支持的
                            success: function() {
                                alert('success')
                            },
                            fail: function() {
                                alert('fail')
                            }
                        };
                        function call(command) {
                            try {
                                nativeShare.call(command)
                            } catch (err) {
                                // 如果不支持，你可以在这里做降级处理
                                if (err.message)
                                {
                                    alert(err.message)
                                }
                                else
                                {
                                    alert('当前浏览器不支持此功能。')
                                }
                            }
                        }
                        $('.share_img').on('click', function() {

                            var infor_id = $(".swiper-slide-active").find(".share").attr("data-infoId");
                            var id = getCookie("id");
                            if( id )
                            {
                                share_point(infor_id);
                            }
                            var type = $(this).data('type');

                            if (type)
                            {
                                //&type=app&from=
                                stype = '';
                                if (type == 'qZone') {
                                    stype = 'qzone';
                                } else if (type == 'qqFriend') {
                                    stype = 'sqq';
                                } else if (type == 'wechatFriend') {
                                    stype = 'weixin';
                                } else if (type == 'wechatTimeline') {
                                    stype = 'weixin_timeline';
                                } else if (type == 'weibo') {
                                    stype = 'tsina';
                                } else if( type == "youxin") {
                                    share_friend();
                                    return false;
                                }
                                shareData.link=link;
                                shareData.link = shareData.link + stype+video_src;
                                nativeShare.setShareData(shareData);
                                console.log(shareData.link);
                                // return false;
                                call(type);
                            }
                        })

                    }
                    //分享end
                }
            }
        })

    }

    //@好友
    function share_friend()
    {
        var share_data = {};
        //分享好友图片
        var shareImg_src    = $(".swiper-slide-active").find(".user_shared_img").attr("src");
        share_data.img_src  =shareImg_src;
        //分享好友标题
        var shareTitle      = $(".swiper-slide-active").find(".video_text_con").text();
        share_data.title    =shareTitle;
        //分享描述
        share_data.desc     ='关注说说，发文章、发视频、阅读、转发、点赞，赚金蛋换大奖下载ap';
        //回调地址
        share_data.callback = encodeURIComponent(window.location.href);
        share_data = encodeURIComponent(JSON.stringify(share_data));
        window.location.href = WapSiteUrl + '/tmpl/friendletter/choosefriend.html?share_data='+share_data;
    }
});

//video添加属性
function atrVideo()
{
    // $('video').attr('x5-video-player-type', 'h5');
    $('video').attr('x-webkit-airplay', true);
    $('video').attr('x5-video-player-fullscreen', true);
    $('video').attr('x5-video-ignore-metadata', true);
    $('video').attr('object-fit', 'fill');
    $('video').attr('object-position', 'center center');
    $('video').attr('x5-video-orientation', 'portraint');

}
//分享点击
function share_click()
{

    //分享底部弹框start
    $(".icon_p.share").click(function(){
        $(".share_box").css("bottom","0")
    });
    $(".close_share_box").click(function(){
        $(".share_box").css("bottom","-5rem")
    });
    $(".qx_share").click(function(){
        $(".share_box").css("bottom","-5rem")
    });
}

//点赞
function like(i)
{
    var key = getCookie("key");
    var _this = $(i);
    var zanUser_id = _this.attr("data-id");
    var inforId = _this.attr("data-inforId");
    if( key )
    {
        var this_a = _this;
        if(_this.attr("src") == "../img/fans-circle/zan_white.png")
        { //点赞发起点赞请求
            $.ajax({
                type: 'post',
                url: ApiUrl + '?ctl=News&met=getLike&typ=json',
                data:{id:inforId,from:'point'},
                dataType: 'json',
                async: false,
                success: function(e) {
                    if(e.status ==200)
                    {
                        this_a.attr("src","../img/fans-circle/zan_red.png");

                        $(".countLike").each(function () {
                            if( $(this).attr("data-inforId") == this_a.attr("data-inforid") )
                            {
                                var likeNum = $(this).text();
                                likeNum++;
                                $(this).text(likeNum);
                            }
                        })

                        $(".gz").each(function () {
                            if( this_a.attr("data-inforid")== $(this).attr("data-inforid") )
                            {
                                $(this).attr("src","../img/fans-circle/zan_red.png");
                            }

                        });
                    }
                }
            })
        }
        else
        {
            $.ajax({
                type: 'post',
                url: ApiUrl + '?ctl=Information_Like&met=unLike&typ=json',
                data:{information_id:inforId},
                dataType: 'json',
                async: false,
                success: function(e) {

                    if(e.status ==200)
                    {
                        this_a.attr("src","../img/fans-circle/zan_white.png");

                        $(".countLike").each(function () {
                            if( $(this).attr("data-inforId") == this_a.attr("data-inforid") )
                            {
                                var likeNum = $(this).text();
                                likeNum--;
                                if( likeNum <0 )
                                {
                                    $(this).text(0);
                                }else{
                                    $(this).text(likeNum);
                                }
                            }
                        })

                        $(".gz").each(function () {
                            if( this_a.attr("data-inforid")== $(this).attr("data-inforid") )
                            {
                                $(this).attr("src","../img/fans-circle/zan_white.png");
                            }
                        });
                    }
                }
            })
        }
    }
    else
    {
        $.sDialog({
            'content':'关注说说，发文章、发视频、阅读、转发、点赞，赚金蛋换大奖下载app',
            'okBtnText':'去下载',
            okFn:function () {
                window.location.href = 'http://imtt.dd.qq.com/16891/9763DF5EEF112628260DD9BC55C193DE.apk?fsname=com.taoshang168.apk';
            }
        });
    }
}
//礼物点击
function  gift(i)
{
    var key = getCookie("key");
    var _this = $(i);
    if( !key )
    {
        $.sDialog({
            'content':'关注说说，发文章、发视频、阅读、转发、点赞，赚金蛋换大奖下载app',
            'okBtnText':'去下载',
            okFn:function () {
                window.location.href = 'http://imtt.dd.qq.com/16891/9763DF5EEF112628260DD9BC55C193DE.apk?fsname=com.taoshang168.apk';
            }
        });
    }
    else
    {
        var userGift_id = _this.attr("data-id");
        window.location.href = WapSiteUrl+'/tmpl/friendletter/video_to_goods.html?user_id='+userGift_id;
    }

}

//头像点击
function userLogo(i)
{
    var _this= $(i);
    var key = getCookie("key");
    if( !key )
    {
        $.sDialog({
            'content':'关注说说，发文章、发视频、阅读、转发、点赞，赚金蛋换大奖下载app',
            'okBtnText':'去下载',
            okFn:function () {
                window.location.href = 'http://imtt.dd.qq.com/16891/9763DF5EEF112628260DD9BC55C193DE.apk?fsname=com.taoshang168.apk';
            }
        });
    }
    else
    {
        var user_id = _this.attr("data-id");
        window.location.href = WapSiteUrl+'/tmpl/fans_user_face.html?uid='+user_id;
    }

}

function pl_btn(mySwiper)
{
    //首屏视频播放
    $(".player_btn").on("touchstart",function () {
        $(".swiper-container .is_video")[mySwiper.activeIndex].play();
        $(".player_btn").addClass("hidden");
    });
    $(".video_mask").on("touchstart",function () {
        $(".player_btn").removeClass("hidden");
        $(".swiper-container .is_video")[mySwiper.activeIndex].pause();
    });
}


//关注 or 取关
function friendTig(i)
{
    var key = getCookie("key");
    var _this = $(i);
    var user_id = _this.attr("data-uid");

    if( !key )
    {
        $.sDialog({
            'content':'关注说说，发文章、发视频、阅读、转发、点赞，赚金蛋换大奖下载app',
            'okBtnText':'去下载',
            okFn:function () {
                window.location.href = 'http://imtt.dd.qq.com/16891/9763DF5EEF112628260DD9BC55C193DE.apk?fsname=com.taoshang168.apk';
            }
        });
    }
    else
    {
        if( _this.hasClass("active") )
        {
            //已经关注,发送取关请求
            var user_friend_id = _this.attr("data-id");
            $.ajax({
                type: 'POST',
                url: ApiUrl + '?ctl=Buyer_User&met=cancelFriendDetail&typ=json',
                data:{id:user_friend_id},
                dataType: 'json',
                async: false,
                success: function(e) {
                    if(e.status ==200)
                    {
                        _this.removeClass("active");
                        _this.text("关注");
                        $(".video_text").find(".gz_friend").each(function(){
                            if( $(this).attr("data-uid") == user_id  )
                            {
                                $(this).text("关注");
                                $(this).removeClass("active");
                            }

                        });
                    }

                }
            })

        }
        else
        {
            //未关注,发送关注请求
            $.ajax({
                type: 'POST',
                url: ApiUrl + '?ctl=Buyer_User&met=addFriendDetail&typ=json',
                data:{id:user_id},
                dataType: 'json',
                async: false,
                success: function(e) {
                    if( e.status ==200 )
                    {
                        _this.addClass("active");
                        _this.attr("data-id",e.data.user_friend_id);
                        _this.text("已关注");
                        $(".video_text").find(".gz_friend").each(function(){
                            if( $(this).attr("data-uid")==user_id )
                            {
                                $(this).addClass("active");
                                $(this).attr("data-id",e.data.user_friend_id);
                                $(this).text("已关注");

                            }
                        })
                    }
                }
            })
        }
    }

}


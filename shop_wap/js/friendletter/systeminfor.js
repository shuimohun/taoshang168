
var refer = document.referrer;
var key   = getCookie("key");
var id    = getCookie("id");
$(function(){
    //我的关注，我的粉丝，送福免单按钮切换样式
    $(".user_gz_wrap ul li").click(function () {
        if($(this).hasClass("on")){
            $(this).removeClass("on");
        }else{
            $(this).addClass("on");
        }
    });

    function foot(){
        $('#foot').load('foot_.html');
        setTimeout(function(){
            $("#foot .foot_item").has(".more").addClass("on");//对应位置标红

            //导航跳转
            $("#foot .foot_item .index").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/fans-circle.html';
            });
            $("#foot .foot_item .hot_tv").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/videoplay.html';
            });
            $("#foot .foot_item .fabu").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/information_message.html';
            });
            $("#foot .foot_item .message").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/friend_list.html';
            });
            $("#foot .icon_interest").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/interestlabel.html';
            });
            $("#foot .icon_addressbook").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/addressbook.html';
            });
            $("#foot .icon_system_infor").click(function () {
                // window.location.href = WapSiteUrl+'/tmpl/friendletter/addressbook.html';
            });
            $("#foot .icon_my_on").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/systeminfor.html';
            });
            //end


            var  foot_alt = $(".footer").height();//获取脚部高度
            $("#foot .more").click(function(){
                $(".more_win").css({"bottom":(foot_alt)+"px"});
                $(".mask").css({"display":"block","opacity":"0.4"})
            });
            $(".mask").click(function(){
                $(".more_win").css({"bottom":"-5rem"});
                $(this).css({"display":"none","opacity":"0"})
            })
            $(".more_win .close_btn").click(function(){
                $(".more_win").css({"bottom":"-5rem"});
                $(".mask").css({"display":"none","opacity":"0"})
            })
        },100)
    }
    foot();
    function getData() {
        if( !key || !id )
        {
            $.sDialog({
                content: "未登录",
                "okBtnText": "登录",
                "cancelBtnText":'返回',
                okFn:function () {
                    var callback  = window.location.href+'?';
                    window.location.href = UCenterApiUrl+'?ctl=Login&met=index&typ=e&from=wap&callback='+encodeURIComponent( callback );
                },
                cancelFn:function () {
                    if( refer )
                    {
                        window.location.href = refer;
                    }
                    else{
                        window.location.href = WapSiteUrl;
                    }
                }
            })
        }
        else
        {
            $.ajax({
                url:ApiUrl+'?ctl=Buyer_User&met=systemInfo&typ=json',
                data:{},
                type:'POST',
                dataType:'json',
                success:function(e)
                {
                    if( e.status == 200 )
                    {

                        $(".user_name").html(e.data.user_Base.user_account);
                        var main_top_wrap = template.render("main_top_wrap",e);
                        $(".main_top_wrap").html(main_top_wrap);

                        var user_gz_wrap = template.render("user_gz_wrap",e);
                        $(".user_gz_wrap").html(user_gz_wrap);

                        var main_jump = template.render("main_jump",e);
                        $(".main_jump").html(main_jump);

                        $(".userimg").click(function () {
                            window.location.href = "../../tmpl/fans_user_face.html?uid="+e.data.user_Info.user_id;
                        })
                    }

                }
            })

        }
    }

    getData()
    function  loginOut() {
        var username = getCookie('username');
        var key = getCookie('key');
        var client = 'wap';

        login_url   = UCenterApiUrl + '?ctl=Login&met=logout&typ=e';


        callback = WapSiteUrl + '?redirect=' + encodeURIComponent(WapSiteUrl);


        login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);

        window.location.href = login_url;

        delCookie('username');
        delCookie('user_account');
        delCookie('id');
        delCookie('key');
    }
    
    $(".head_infor .loginOut").click( function () {

        if( key ){
            $.sDialog({
                content: "确定要退出登录吗?",
                "okBtnText": "确定",
                "cancelBtnText":'取消',
                okFn:function () {
                    loginOut()
                }
            })
        }
    })


})

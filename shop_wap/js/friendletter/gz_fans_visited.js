
var tag = getQueryString("tag");
var user_id = getQueryString("user_id");
$(function(){

    function foot(){
        $('#foot').load('foot_.html');
        setTimeout(function(){


            $(".index").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/fans-circle.html';
            });
            $('.hot_tv').click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/videoplay.html'
            });
            $('.fabu').click(function () {
                window.location.href = WapSiteUrl+'/tmpl/information_message.html';
            });
            $('.message').click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/friend_list.html';
            });
            $('.icon_interest').click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/interestlabel.html';
            });
            $('.icon_addressbook').click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/addressbook.html';
            });
            $('.icon_my_on').click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/systeminfor.html';
            });

            

            $("#foot .foot_item").has('.more').addClass("on");//对应位置标红
            foot_alt = $(".footer").height();//获取脚部高度
            $("#foot .more").click(function(){
                $(".more_win").css({"bottom":(foot_alt)+"px"});
                $(".mask").css({"display":"block","opacity":"0.4"});
                $(".more_main ul li").eq(3).find("span").css("color","red");
            });
            $(".mask").click(function(){
                $(".more_win").css({"bottom":"-5rem"});
                $(this).css({"display":"none","opacity":"0"})
            });
            $(".more_win .close_btn").click(function(){
                $(".more_win").css({"bottom":"-5rem"});
                $(".mask").css({"display":"none","opacity":"0"})
            })
        },100)
    }

    foot();

    if( tag == "Gz" || !tag )
    {
        $(".top_tab_title li").eq(0).addClass("on").siblings().removeClass("on");
        $(".gz_fans_visited").hide().eq(0).show();
    }
    else if( tag == "Fs" )
    {
        $(".top_tab_title li").eq(1).addClass("on").siblings().removeClass("on");
        $(".gz_fans_visited").hide().eq(1).show();
    }
    //头部导航切换
    $(".top_tab_title li").click(function(){
        var li_num = $(this).index();
        $(this).addClass("on").siblings().removeClass("on");
        $(".gz_fans_visited").hide().eq(li_num).show();
    })

    var page    = 1;
    var rows    = 12;
    var hasMore = true;
    function getData( more ) {
        $.ajax({
            url: ApiUrl + '?ctl=Buyer_User&met=gz_fans_visited&typ=json',
            type: 'POST',
            data:{page:page,rows:rows,user_id:user_id},
            dataType: 'json',
            async: false,
            success: function(e) {

                if( e.status == 200 )
                {
                    if( more  )
                    {
                        var GzMore = template.render("GzMore",e);
                        $(".Gz").append(GzMore);

                        var FsMore = template.render("FsMore",e);
                        $(".Fs").append(FsMore);
                    }
                    else
                    {
                        var Gz = template.render("Gz",e);
                        $(".Gz").html(Gz);

                        var Fs = template.render("Fs",e);
                        $(".Fs").html(Fs);

                        var Fk = template.render("Fk",e);
                        $(".Fk").html(Fk)
                    }

                    if( page*rows < e.data.F_data.totalsize || page*rows < e.data.G_data.totalsize )
                    {
                        hasMore = true;
                    }
                    else
                    {
                        hasMore = false;
                    }
                    page++;
                }
            }
        });
    }

    getData();

    /*滚动条触底*/
    $(window).scroll(function(e) {
        if( !($(".pop-up").hasClass("block")) && !($(".ui-mask").hasClass("block")) )
        {
            if($(window).scrollTop() + $(window).height()== $(document).height())
            {
                if( hasMore )
                {
                    getData( true );
                }

            }
        }
    });

});

//关注 or  取关
function friendOn (i) {
    var key = getCookie("key");
    var _this = $(i);
    var qg_id = _this.attr("data-id");
    var uid = _this.attr("data-uid");
    if( _this.hasClass("on") )
    {
        if( !key )
        {
            alert("未登录");
            return false;
        }
        if( !qg_id )
        {
            alert("出了点问题,请刷新重新关注(#^.^#)");
            return false;
        }
        //已经关注 发送取关
        $.ajax({
            url: ApiUrl+'?ctl=Buyer_User&met=cancelFriendDetail&typ=json',
            type: 'POST',
            dataType: 'json',
            async:false,
            data:{id:qg_id},
            success:function(e){

                if( e.status == 200 )
                {
                    _this.removeClass("on");
                }
            }
        });
    }
    else
    {
        var key = getCookie("key");
        if( !key )
        {
           alert("未登录");
            return false;
        }
        if( !uid )
        {
            alert("出了点小问题,请刷新重(#^.^#)");
            return false;
        }
        //没有关注, 发送关注
        $.ajax({
            url: ApiUrl+'?ctl=Buyer_User&met=addFriendDetail&typ=json',
            type: 'POST',
            dataType: 'json',
            async:false,
            data:{id:uid},
            success:function(e){
                if( e.status == 200 )
                {
                    _this.addClass("on");
                    _this.attr("data-id",e.data.user_friend_id);
                }
            }
        });
    }
}
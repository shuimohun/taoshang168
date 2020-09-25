/*
*    2018-07-19   jzh  粉丝用户界面
* */

var user_id = getQueryString('uid');
$(function(){


    function foot(){
        $('#foot').load('friendletter/foot_.html');
        setTimeout(function(){
            var foot_alt = $('.footer').height();
            $(".foot_bg").css({"height":foot_alt+"px"});
            $("#foot .foot_item .index").parents(".foot_item").addClass("on");//对应位置标红
            //导航跳转
            $("#foot .foot_item .index").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/fans-circle.html';
            })
            $("#foot .foot_item .hot_tv").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/videoplay.html';
            })
            $("#foot .foot_item .fabu").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/information_message.html';
            })
            $("#foot .foot_item .message").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/friend_list.html';
            })
            $("#foot .icon_interest").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/interestlabel.html';
            })
            $("#foot .icon_addressbook").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/addressbook.html';
            })
            $("#foot .icon_system_infor").click(function () {
                // window.location.href = WapSiteUrl+'/tmpl/friendletter/addressbook.html';
            })
            $("#foot .icon_my_on").click(function () {
                window.location.href = WapSiteUrl+'/tmpl/friendletter/systeminfor.html';
            })
            //end
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
        },200)
    }
    foot();
    var articleMore = true;
    var page        = 1;
    var rows        = 5;
    function fansUserFace(more) {
        $.ajax({
            url:ApiUrl+'?ctl=News&met=fansUserFace&typ=json',
            data:{uid:user_id,page:page,rows:rows},
            Type:'POST',
            dataType:'json',
            success:function(e) {
                if( e.status == 200 )
                {
                    var user_title = e.data.user_info.user_name+'用户';
                    $(".user-title").html( user_title);
                    if( e.data.information.length ==0 )
                    {
                        $(".loading").hide();
                    }
                    if(more)
                    {
                        //追加渲染
                        var fans_face_more = template.render("fans_face_more",e);
                        $(".fans_face").append( fans_face_more );
                        //2018--08--08   推荐商品高度
                        var s_m_img_w = $(".saymain .user_goods_list li img").width();
                        $(".saymain .user_goods_list li img").css("height",s_m_img_w+"px");
                    }
                    else
                    {
                        //主内容渲染
                        var fans_face = template.render( "fans_face",e );
                        $(".fans_face").html( fans_face );
                        //2018--08--08   推荐商品高度
                        var s_m_img_w = $(".saymain .user_goods_list li img").width();
                        $(".saymain .user_goods_list li img").css("height",s_m_img_w+"px");
                    }
                    if( page*rows < e.data.information_totalsize)
                    {
                        articleMore = true;
                    }
                    else
                    {
                        articleMore = false;
                        $(".loading").hide();
                    }
                    page ++;
                    //用户信息渲染
                    var user_info = template.render("user_info",e);
                    $(".user_info").html(user_info);
                    //用户内容列表-右侧 更多弹框，显示和隐藏
                    $(".more_icon").click(function(){
                        $(this).parents(".fl_item_con").find(".more_pop").css({"display":"block"})
                    })
                    $(".more_pop ul li").click(function(){
                        $(this).parents(".more_pop").css({"display":"none"})
                    })


                       if( e.data.is_shop == 1 )
                       {
                           var shop_url =  WapSiteUrl+'/tmpl/store.html?shop_id='+e.data.shop_id;
                           var a = '<a href='+shop_url+' class="fans-comment-main">商品</a>';
                           $(".fans-comment-tab").append(a);

                       }

                }
                else
                {
                    $(".loading").hide();
                    // alerst("出现问题啦,请重新进入这里");
                    $.sDialog({
                        content: "无用户信息",
                        cancelBtn:false,
                    })
                }
            },

        })
    }

    fansUserFace();
    $(".fans-comment-main").click(function () {

        if( $(this).index() == 0 )
        {
            $(".fans_face .itemwrap").each(function () {
               $(this).show()
            })
        }
        else if( $(this).index() == 1 )
        {
            $(".fans_face .itemwrap").each(function () {
                if( $(this).find("video").length >0 )
                {
                    $(this).show()
                }else
                {
                    $(this).hide()
                }
            });
            $(".loading").hide();
        }
        else if( $(this).index() == 2 )
        {
            $(".fans_face .itemwrap").each(function () {
                if( $(this).find("video").length >0 )
                {
                    $(this).hide()
                }else
                {
                    $(this).show()
                }
            })
        }
        $(this).addClass("cur").siblings().removeClass("cur");

    })

    $(window).scroll(function(e) {
        if( !($(".pop-up").hasClass("block")) && !($(".ui-mask").hasClass("block")) )
        {
            if($(window).scrollTop() + $(window).height()== $(document).height())
            {
                if(articleMore)
                {
                    fansUserFace(true);
                }
            }
        }
    });
})

/*关注 or 取关*/
function check(i)
{
    var key = getCookie("key");
    if( !key )
    {
        checkLogin(0);
        return false;
    }

    var _this = $(i);
    var uid   = user_id;
    var ufid  = $(".gz_btn img").attr("data-fid");
    if( _this.attr("src") == 'img/gz_icon.png' )
    {
        //未关注,发起关注请求
        $.ajax({
           url:ApiUrl+'?ctl=Buyer_User&met=addFriendDetail&typ=json',
            data:{id:uid},
            Type:'POST',
            dataType:'json',
            success:function(e) {
               if( e.status == 200 )
               {
                   var ufid  = $(".gz_btn img").attr("data-fid",e.data.user_friend_id);
                   _this.attr("src","img/gz_icon_on.png");
               }
            },
            error:function () {}
        })


    }
    else
    {
        //已关注,发起取关请求
        $.ajax({
            url:ApiUrl+'?ctl=Buyer_User&met=cancelFriendDetail&typ=json',
            data:{id:ufid},
            Type:'POST',
            dataType:'json',
            success:function(e) {
                if( e.status == 200 )
                {
                    _this.attr("src","img/gz_icon.png");
                }
            },
            error:function () {}
        })
    }
}

/*点赞 or 取消点赞*/

function article_like(i,information_id)
{

    var key = getCookie("key");
    if( !key )
    {
        checkLogin(0);
        return false;
    }
    var _this = $(i);
    var id = information_id;

    if( _this.attr("src") == "img/fans-circle/fansicon1.png" )
    {
        //没有点赞,添加点赞
        $.ajax({
           url:ApiUrl+'?ctl=Information_Like&met=like&typ=json',
            data:{information_id:id},
            Type:'POST',
            dataType:'json',
            success:function(e) {

                var likeNum= $(".u_a_icon3 span").val();
                likeNum ++;
                $(".u_a_icon3 span").text(likeNum)
                _this.attr( "src","img/fans-circle/fansicon1-2.png" );
            },
            error:function () {}
        })


    }
    else
    {
        //已经点赞,取消点赞
        $.ajax({
            url:ApiUrl+'?ctl=Information_Like&met=unLike&typ=json',
            data:{information_id:id},
            Type:'POST',
            dataType:'json',
            success:function(e) {
                var likeNum= $(".u_a_icon3 span").val();
                if( likeNum == 0)
                {
                    likeNum = 0;
                }
                else
                {
                    likeNum --;
                }
                $(".u_a_icon3 span").text(likeNum)
                _this.attr( "src","img/fans-circle/fansicon1.png" );
            },
            error:function () {}
        })

    }


}
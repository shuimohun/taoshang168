
var user_id = getQueryString("user_id") ;
var key     = getCookie("key");
$(function () {

    function foot(){
        $('#foot').load('foot_.html');
        setTimeout(function(){
            $("#foot .foot_item").has('.hot_tv').addClass("on");//对应位置标红
            foot_alt = $(".footer").height();//获取脚部高度
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
            });

            if( !key || !user_id)
            {
                $(".index").on('click',function () {
                    Dialog()
                });
                $(".hot_tv").on('click',function () {
                    Dialog()
                });
                $('.fabu').on('click',function () {
                    Dialog()
                });
                $('.message').on('click',function () {
                    Dialog()
                });
                $('.icon_interest').on('click',function () {
                    Dialog()
                });
                $('.icon_addressbook').on('click',function () {
                    Dialog()
                });
                $('.icon_my_on').on('click',function () {
                    Dialog()
                })
            }
            else
            {
                $(".index").on('click',function () {
                    window.location.href = WapSiteUrl+'/tmpl/fans-circle.html';
                });
                $(".hot_tv").on('click',function () {
                    window.location.href = WapSiteUrl+'/tmpl/friendletter/videoplay.html';
                });
                $('.fabu').on('click',function () {
                    window.location.href = WapSiteUrl+'/tmpl/information_message.html';
                });
                $('.message').on('click',function () {
                    window.location.href = WapSiteUrl+'/tmpl/friendletter/friend_list.html';
                });
                $('.icon_interest').on('click',function () {
                    window.location.href = WapSiteUrl+'/tmpl/friendletter/interestlabel.html';
                });
                $('.icon_addressbook').on('click',function () {
                    window.location.href = WapSiteUrl+'/tmpl/friendletter/addressbook.html';
                });
                $('.icon_my_on').on('click',function () {
                    window.location.href = WapSiteUrl+'/tmpl/friendletter/systeminfor.html';
                })

            }
        },100)
    }
    foot();

})
var page    =1;
var rows    =10;
var hasMore =true;
function getRemGoods(more) {

    $.ajax({
        type: 'post',
        url: ApiUrl + '?ctl=Information_Base&met=videoGoods&typ=json',
        data:{user_id:user_id,page:page,rows:rows},
        dataType: 'json',
        async: false,
        success: function(e) {
            if( e.status == 200 )
            {
                //用户信息渲染
                var user_info = template.render( "user_info",e );
                $(".user_info").html(user_info);
                if( more )
                {
                    //推荐商品列表渲染
                    var goods_list_append  = template.render("goods_list_append",e.data);
                    $(".goods_list").append( goods_list_append );
                }
                else
                {
                    //推荐商品列表渲染
                    var goods_list  = template.render("goods_list",e.data);
                    $(".goods_list").html(goods_list);
                }
                page++;
                if( page*rows > e.data.totalsize )
                {
                    hasMore = false;

                }

            }
        }
    });
}

if( !key || !user_id )
{
    Dialog()
}
else
{
    getRemGoods();
}
function Dialog()
{
    $.sDialog({
        "content": "未登录或无用户信息", //弹出框里面的内容
        "cancelBtn": false, //是否显示确定按钮
        okFn:function () {
            history.go(-1);
        }
    });
}

$(window).scroll(function(e) {
    if( !($(".pop-up").hasClass("block")) && !($(".ui-mask").hasClass("block")) )
    {
        if($(window).scrollTop() + $(window).height()== $(document).height())
        {
            if( hasMore )
            {
                getRemGoods(true);
            }
            else
            {
                $.sDialog({
                    'content':'没有更多商品了',
                    'cancelBtn':false,
                })
            }
        }
    }
});
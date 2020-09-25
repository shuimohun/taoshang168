$(function ()
{
    if (getQueryString('key') != '')
    {
        var key = getQueryString('key');
        var username = getQueryString('username');
        addCookie('key', key);
        addCookie('username', username);
    }
    else
    {
        var key = getCookie('key');
    }
    var html = '<div class="nctouch-footer-wrap posr">'
        + '<div class="nav-text">';
    if (key)
    {
        html += '<a href="' + WapSiteUrl + '/tmpl/member/member.html">我的商城</a>'
            + '<a id="logoutbtn" href="javascript:void(0);">注销</a>'
            + '<a href="' + WapSiteUrl + '/tmpl/member/member_feedback.html">反馈</a>';

    }
    else
    {
        html += '<a class="logbtn"  href="javascript:void(0);">登录</a>'
            + '<a id="regbtn" href="javascript:void(0);">注册</a>'
            + '<a href="' + WapSiteUrl + '/tmpl/member/login.html">反馈</a>';
    }

    if (typeof copyright == 'undefined')
    {
        copyright = '';
    }
    html += '<a href="javascript:void(0);" class="gotop">返回顶部</a>'
        + '</div>'
        + '<div class="nav-pic">'
        //+ '<a href="' + SiteUrl + '" class="app"><span><i></i></span><p>客户端</p></a>'
        //+ '<a href="javascript:void(0);" class="touch"><span><i></i></span><p>触屏版</p></a>'
        //+ '<a href="' + SiteUrl + '" class="pc"><span><i></i></span><p>电脑版</p></a>'
        + '</div>'
        + '<div class="copyright">'
        + copyright
        + '</div>';
    $("#footer").html(html);
    var key = getCookie('key');

    $("#regbtn").click(function(){
        callback = WapSiteUrl + '/tmpl/member/member.html';

        login_url   = UCenterApiUrl + '?ctl=Login&met=regist&typ=e';


        callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);


        login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);

        window.location.href = login_url;
    });

    $(".logbtn").click(function(){

        callback = WapSiteUrl + '/tmpl/member/member.html';

         login_url   = UCenterApiUrl + '?ctl=Login&met=index&typ=e';


         callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);


         login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);

         window.location.href = login_url;
    });

    $("#logout").click(function(){
        $("#logoutbtn").click()
    });

    $('#logoutbtn').click(function ()
    {
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

    });
});
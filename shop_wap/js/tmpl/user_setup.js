$(function(){
   var e = getCookie("key");
   //防止未登陆进入
   if(!e)
   {
       window.location.href = WapSiteUrl+"/tmpl/member/login.html";
       return;
   }
    $('#cache_clear').click(function(){
        $('.win-top').fadeIn();
        $('.win-bottom').fadeTo(300,0.5);
    });
    $('#cache_cancel,#cache_confirm').click(function(){
        $('.win-top,.win-bottom').fadeOut();
    });
    $('#login').click(function(){
        $('.login-top').fadeIn();
        $('.login-bottom').fadeTo(300,0.5);
    });
    $('#login_cancel,#login_confirm').click(function(){
        $('.login-top,.login-bottom').fadeOut();
    });
    $('#head').click(function(){
        window.location.href = UCenterApiUrl+"?ctl=User&met=getUserImg";
    });
    $('#myCont').click(function(){
        window.location.href = UCenterApiUrl+"?ctl=User&met=getUserInfo";
    });
    $('#phone').click(function(){
        window.location.href = UCenterApiUrl+"?ctl=User&met=security&op=mobiles";
    });
    $('#passwd').click(function(){
        window.location.href = UCenterApiUrl+"?ctl=User&met=passwd";
    });
    $('#payPasswd').click(function(){
        window.location.href = PayCenterApiUrl+"?ctl=Info&met=passwd";
    });
    $('#login_confirm').click(function ()
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
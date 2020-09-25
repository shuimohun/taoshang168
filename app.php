
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset="utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="user-scalable=no,minimum-scale=1,maximum-scale=1 width=device-width" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>手机APP下载</title>
    <script src="app/jquery-1.7.1.min.js"></script>
    <link href="app/index.min.css" rel="stylesheet">
</head>

<body>
<div id="download">
    <div class="top_banner">
        <img src="app/mpb2.png" class="banner_img">
    </div>
    <div class="bottom_baner" id="downloadBtns" style="background: url(app/598428b8N78f3d75f.png) 0% 0% / cover no-repeat;">
        <div class="slogn">淘尚168，实惠轻松</div>
        <div class="new_user_gift">新人一分钱狂抢 手机专享</div>

        <div class="btns">
            <div class="download_btn android" data-url="http://a.app.qq.com/o/simple.jsp?pkgname=com.taoshang168.shop">Android版本下载</div>
            <div class="download_btn" data-url="https://itunes.apple.com/app/id1280271411">IOS版本下载</div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //应用宝地址
    //window.location.href ="http://a.app.qq.com/o/simple.jsp?pkgname=com.taoshang168.shop";
    //应用包地址
    //window.location.href = "http://imtt.dd.qq.com/16891/D1A941FBCD9C60B3E5F24E83683BC884.apk?fsname=taoshang168.apk";
    //ios地址
    //https://itunes.apple.com/app/id1280271411
    var u = navigator.userAgent;
    var browser = {
        versions: function () {
            return {
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
                iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
                iPad: u.indexOf('iPad') > -1//是否iPad
            };
        }()
    };

    if (browser.versions.iPhone || browser.versions.iPad || browser.versions.ios) {
        window.location.href ="https://itunes.apple.com/app/id1280271411";
    }else if(browser.versions.android){
        /*if(u.toLowerCase().match(/MicroMessenger/i) == "micromessenger"){

        }else{

        }*/

        $.ajax({
            url: 'http://www.taos168.com/shop/index.php?ctl=Api&met=version&typ=json',
            type:'post',
            success:function(a){
                if(a.status == 200){
                    $('.android').data('url',a.data.downloadUrl);
                    window.location.href = a.data.downloadUrl;
                }else{
                    window.location.href = "http://a.app.qq.com/o/simple.jsp?pkgname=com.taoshang168.shop";
                }
            }
        });
    }

    $('.download_btn').click(function () {
        window.location.href = $(this).data('url');
    })
</script>
</body>
</html>
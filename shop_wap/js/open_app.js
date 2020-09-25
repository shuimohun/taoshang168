(function(){
    var ua = navigator.userAgent.toLowerCase();
    var t;
    var config = {
        scheme_IOS: 'taoshang168shop://',
        scheme_Adr: 'taos168com://',
        download_url: 'http://www.taos168.com/app.php',
        timeout: 1000
    };
    //window.location = ua.indexOf('os') > 0 ? config.scheme_IOS : config.scheme_Adr;


    //download_url_IOS=https://itunes.apple.com/app/id1280271411
    //download_url_IOS=http://app.qq.com/#id=detail&appid=1105683187
    //download_url_Adr=http://app.qq.com/#id=detail&appid=1106407071
    //http://a.app.qq.com/o/simple.jsp?pkgname=com.taoshang168.shop
    //var isAndroid = ua.indexOf('Android') > -1 || ua.indexOf('Adr') > -1; //android终端
    //var isiOS = !!ua.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    //if(u.toLowerCase().match(/MicroMessenger/i)=="micromessenger")
    function openclient(url) {
        var startTime = Date.now();
        var ifr = document.createElement('iframe');
        ifr.src = ua.indexOf('os') > 0 ? config.scheme_IOS + url : config.scheme_Adr + url;
        ifr.style.display = 'none';
        document.body.appendChild(ifr);
        t = setTimeout(function() {
            var endTime = Date.now();
            if (!startTime || endTime - startTime < config.timeout + 200) {
                window.location = config.download_url;
            }
        }, config.timeout);
        window.onblur = function() {
            clearTimeout(t);
        }
    }

    $('#call-app').on('click',function () {
        var type = $(this).data('type');
        var url = '';
        if(type == 1){
            var id = getQueryString("goods_id");
            url = 'taos168.com/scheme?name=gid&id='+id;
        }else if(type == 2){
            var id = getQueryString("b_id");
            url = 'taos168.com/scheme?name=bid&id='+id;
        }else if(type == 3){
            var id = getQueryString("id");
            url = 'taos168.com/scheme?name=news_id&id='+id;
        }
        // openclient(url);

        startApp(url,config.download_url);
        
    });
    
    function callback(opened) {
        if(!opened){
            if(ua.toLowerCase().match(/MicroMessenger/i)=="micromessenger"){
                alert(1)
            }else{
                window.location = config.download_url;
            }
        }
    }

    //启动app方法
    function startApp(url, url2) {
        //url2是应用下载地址,要分清ios和android的不一样
        //将下载地址保存到全局变量
        downloadUrl = url2;
        if(ua.match(/ipad|iphone|ipod|ios/i)) {
            //外部一个定时器,专门盯着启动app的定时器loop;就叫它killer吧
            //计时6秒,之后干掉loop.
            window.setTimeout(function() {
                $('#message').html('');
                $('.result-message').eq(0).css("display", "none");
                clearTimeout(loop);
                time = parseInt('6000') / 1000;
            }, 6000);
            //尝试启动应用
            location.href = config.scheme_IOS + url;
            //同时开始应用启动倒计时
            countDown();

        } else {
            //安卓的就是用iframe来测试是否安装和启动应用了
            window.setTimeout(function() {
                clearTimeout(loop);
                time = parseInt('6000') / 1000;
            }, 6000);
            //创建iframe并启动应用入口
            openApp(config.scheme_Adr + url);
        }
    }

    function openApp(src) {
        // 通过iframe的方式试图打开APP，如果能正常打开，会直接切换到APP
        var ifr = document.createElement('iframe');
        ifr.src = src;
        ifr.style.display = 'none';
        document.body.appendChild(ifr);
        //切换到iframe时
        //此时,会有个问题,如后切换到应用时间小于killer所需要杀死loop的时间,loop就会跳到下载提示,killer`就失去作用了
        countDown();
        window.setTimeout(function() {
            document.body.removeChild(ifr);
        }, 5000);
        //倒计时

    }

    function countDown() {
        //每秒调用一次
        loop = window.setTimeout('countDown()', 1000);
        if(time > 0) {
            time--;
            if(time == 0) {
                /*if(ua.match(/ipad|iphone|ipod|ios/i)){
                 console.log(downloadUrl);
                 location.href = downloadUrl;
                 }*/
                //如果计时到0,loop任然没被干掉,就说明应用没有启动,此时,跳到下载提示界面
                //定时器的局限性还是很大,不能响应式反应,所以只能做到这一步了

                clearTimeout(loop);
                time = parseInt('6000') / 1000;
                var btnArray = ['否', '是'];
                mui.confirm('您没有安装该应用,是否下载安装包?', '应用下载', btnArray, function(e) {
                    if(e.index == 1) {
                        location.replace(downloadUrl);
                    } else {
                        return;
                    }
                });
            }
        }
    }

})();




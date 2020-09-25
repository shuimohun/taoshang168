function ncScrollLoad() {
    var curpage,hasmore,footer,isloading,firstRow;

        ncScrollLoad.prototype.loadInit = function(options) {
        var defaults = {
                data:{},
                callback :function(){},
                resulthandle:''
            };
        var options = $.extend({}, defaults, options);

        if (options.iIntervalId) {
            curpage = 0;
            firstRow = 0;
            hasmore = true;
            footer = false;
            isloading = false;
        }

        ncScrollLoad.prototype.getList(options);

        $(window).scroll(function(){

            if (isloading) {//防止scroll重复执行
                return false;
            }
            if(($(window).scrollTop() + $(window).height() > $(document).height()-1)){
                isloading = true;
                options.iIntervalId = false;
                console.log(options);
                console.log(isloading);
                console.log(options.iIntervalId);
                ncScrollLoad.prototype.getList(options);
            }
        });
    };

    ncScrollLoad.prototype.getList = function(options){
        if (!hasmore) {
            $('.loading').remove();
            ncScrollLoad.prototype.getLoadEnding();
            return false;
        }
        param = {};
        //参数
        if(options.getparam){
            param = options.getparam;
        }
        //初始化时延时分页为1
        if(options.iIntervalId){
            param.curpage = 1;
        }

        param.curpage = curpage;
        param.firstRow = firstRow;

        $.getJSON(options.url, param, function(result){
            checkLogin(result.login);
            $('.loading').remove();

            var data = result.data;
            console.log(data);
            //处理返回数据
            if(options.resulthandle){
                eval('data = '+options.resulthandle+'(data);');
            }

            if (!$.isEmptyObject(options.data)) {
                data = $.extend({}, options.data, data);
            }
            var html = template.render(options.tmplid, data);

            if(options.iIntervalId === false){

                $(options.containerobj).append(html);

            }else{

                $(options.containerobj).html(html);
            }

            hasmore = result.data.hasmore;

            curpage++;

            if(hasmore)
            {
                firstRow = curpage*result.data.pagesize;
            }

            if (!hasmore) {
                $('.loading').remove();
                //加载底部
                if ($('#footer').length > 0) {
                    ncScrollLoad.prototype.getLoadEnding();
                    if (result.page_total == 0) {
                        $('#footer').addClass('posa');
                    }else{
                        $('#footer').removeClass('posa');
                    }
                }
            }
            if (options.callback) {
                options.callback.call('callback');
            }
            isloading = false;
        });
    };

    ncScrollLoad.prototype.getLoadEnding = function() {
            if (!footer) {
                footer = true;
                $.ajax({
                    url: WapSiteUrl+'/js/tmpl/footer.js',
                    dataType: "script"
                });
            }
        }
}
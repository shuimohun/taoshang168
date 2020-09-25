var own_shop = getQueryString('own_shop');
$(function ()
{
    Array.prototype.unique = function ()
    {
        var e = [];
        for (var t = 0; t < this.length; t++)
        {
            if (e.indexOf(this[t]) == -1)
            {
                e.push(this[t])
            }
        }
        return e
    };
    var e = decodeURIComponent(getQueryString("keyword"));
    if (e)
    {
        $("#keyword").val(e);
        writeClear($("#keyword"));

        if(window.localStorage){

            if (('undefined' != typeof window.localStorage['his_list']))
            {
                var td = window.localStorage['his_list'].split(',');
            }
            else
            {
                var td = [];
            }


            if (-1 == $.inArray(e, td))
            {
                td.push(e);
            }

            window.localStorage['his_list'] = td;
        }else{
        }

    }
//    $("#keyword").on("input", function ()
//    {
//        var e = $.trim($("#keyword").val());
//        if (e == "")
//        {
//            $("#search_tip_list_container").hide()
//        }
//        else
//        {
//            $.getJSON(ApiUrl + "?act=goods&op=auto_complete", {term: $("#keyword").val()}, function (e)
//            {
//                if (!e.data.error)
//                {
//                    var t = e.data;
//                    t.WapSiteUrl = WapSiteUrl;
//                    if (t.list.length > 0)
//                    {
//                        $("#search_tip_list_container").html(template.render("search_tip_list_script", t)).show()
//                    }
//                    else
//                    {
//                        $("#search_tip_list_container").hide()
//                    }
//                }
//            })
//        }
//    } );
    $(".input-del").click(function ()
    {
        $(this).parent().removeClass("write").find("input").val("")
    });
    template.helper("$buildUrl", buildUrl);
    $.getJSON(ApiUrl + "?ctl=Index&met=newGetSearchKeyList&typ=json", function (e)
    {
        var hot_list = e.data.list;
        if(typeof(hot_list) !== 'undefined'  && hot_list!==''){
          
            for (var i = 0; i < hot_list.length; i++) {
//                $('#hot_kw_url').append('<li><a class="hot_kw_url_click">' + hot_list[i] + '</a></li>');
                if(own_shop)
                {
                    $('#hot_kw_url').append('<li><a  href="' + buildUrl("self_keyword", hot_list[i]) + '">' + hot_list[i] + '</a></li>');
                }
                else
                {
                    $('#hot_kw_url').append('<li><a  href="' + buildUrl("keyword", hot_list[i]) + '">' + hot_list[i] + '</a></li>');
                }
            }
        }

//        $("#hot_list_container").html(template.render("hot_list", t));
//        $("#search_his_list_container").html(template.render("search_his_list", t))
    });
    
    $("#header-nav").click(function ()
    {
	//判断cookie是否存在
        var kw = $("#keyword").val();
        add_keyword_cookie(kw);
        if(own_shop)
        {
            window.location.href = buildUrl("self_keyword", kw);
        }
        else
        {
            window.location.href = buildUrl("keyword", kw);
        }


    });
    $('#clear-history').click(function(){
        delCookie('hisSearch');
        $('#history_kw_url li').remove();
    });
    // 初始化搜索记录
    initlist();
    function initlist() {
        var history_wd = getCookie('hisSearch');
        $('#history_kw_url li').remove();
        if (history_wd) {
            history_wds = history_wd.split(',');
            for (var i = 0; i < history_wds.length; i++) {
                if(own_shop)
                {
                    $('#history_kw_url').append('<li><a href="' + buildUrl("self_keyword", history_wds[i]) + '">' + history_wds[i] + '</a></li>');
                }
                else
                {
                    $('#history_kw_url').append('<li><a href="' + buildUrl("keyword", history_wds[i]) + '">' + history_wds[i] + '</a></li>');
                }
            }
        }
        return ;
    };
//    function go_keyword_url(keyword){
//        //添加搜索记录
//        add_keyword_cookie(keyword);
//        window.location.href = buildUrl("keyword", keyword);
//    } 
    
    function add_keyword_cookie(kw){
        var history_wd = getCookie('hisSearch');
        if (history_wd) {
            history_wds = history_wd.split(',');
            var wk_flag = 0;
            for (var i = 0; i < history_wds.length; i++) {
                if(history_wds[i] === kw){
                    //存在就跳出
                    wk_flag = 1;
                    break;
                }
            }
            if(wk_flag === 0){
                //添加
                addCookie('hisSearch',kw + ',' + history_wd);
            }
        }else{
            //添加
            addCookie('hisSearch', kw);
        }
        return ;
    }

});
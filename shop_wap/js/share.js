var pagesize = 10;
var curpage = 0;
var firstRow = 0;
var hasmore = false;
var key  = getCookie('key');
var type = getQueryString('type');
var time = getQueryString('time');
var date = new Date();
$(function()
{
    if(!key)
    {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }

    switch (type)
    {
        case 'oneMonth':
            $(".share_info>ul>li[data-time='oneMonth']").attr('class','cur');
            break;
        case 'thereMonth':
            $(".share_info>ul>li[data-time='thereMonth']").attr('class','cur');
            break;
        case 'oneYear':
            $(".share_info>ul>li[data-time='oneYear']").attr('class','cur');
            break;
        default:
            $(".share_info>ul>li[data-time=' ']").attr('class','cur');
    }

    get_hot_goods();

    $(window).scroll(function (){
        if(hasmore) {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
                get_hot_goods();
            }
        }
    });


});

function  get_hot_goods()
{
    param = {};

    param.firstRow = firstRow;
    param.type = 'goods';
    if(time)
    {
        param.time = time;
    }

    $.getJSON(PayCenterApiUrl + "?ctl=Info&met=share&typ=json",param,function (e)
    {
        if (e.status == 200)
        {
            var data = e.data;
            var tHtml = '￥'+data.user_share_price_total;
            $('#share_total_money').html(tHtml);

            var sHtml = '￥'+data.today_total;
            $('#share_money').html(sHtml);

            var rHtml = '￥'+data.user_resource.user_share_money_frozen;
            $('#share_freeze').html(rHtml);

            var goodHtml = template.render('goods',data);
            $('.goods').append(goodHtml);

            var _TimeCountDown = $(".time");
            _TimeCountDown.fnTimeCountDown();

            curpage++;
            if(e.data.page < e.data.total){
                firstRow = curpage * pagesize;
                hasmore = true;
            }else{
                hasmore = false;
            }
        }
    });
}

$('.share_info').on('click',"li[class='cur']",function()
{
   var type = $(this).data('time');
   var time = nowDate(type);
   window.location.href = WapSiteUrl+'/tmpl/member/share.html?type='+type+'&time='+time;
   return;
});

//对当前时间的处理
function nowDate(time)
{
    switch (time)
    {
        case 'oneMonth':
            var str = date.toLocaleDateString();
            var arr = str.split('/');
            if(arr[1] >=2)
            {
                arr[1]  = arr[1]-1;
            }
            else
            {
                arr[0] = arr[0]-1;
                arr[1] = '12';
            }

            var newStr = arr.join('-');
            return newStr;
            break;
        case 'thereMonth':
            var str = date.toLocaleDateString();
            var arr = str.split('/');
            if(arr[1] > 3)
            {
                arr[1]  = arr[1]-3;
            }
            else
            {
                arr[0] = arr[0]-1;
                if(arr[1] == 3)
                {
                    arr[1] = 12;
                }
                else if(arr[1] == 2)
                {
                    arr[1] == 11;
                }
                else if(arr[1] == 1)
                {
                    arr[1] == 10;
                }
            }

            var newStr = arr.join('-');
            return newStr;
            break;
        case 'oneYear':
            var str = date.toLocaleDateString();
            var arr = str.split('/');
            arr[0] = arr[0]-1;
            var newStr = arr.join('-');
            return newStr;
            break;
        case ' ':
            var newStr = ' ';
            return newStr;
            break;

    }
}
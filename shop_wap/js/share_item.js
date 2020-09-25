/**
 * Created by Administrator on 2017/8/12.
 */
var key = getCookie('key');
var share_num = getQueryString('share_num');
$(function(){
    if(!key)
    {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return false;
    }

    if(!share_num)
    {
        window.location.href = WapSiteUrl;
        return false;
    }

    $.ajax({
        url:ApiUrl+'?ctl=Api_App_Share&met=getShareBySn&typ=json',
        data:{share_num:share_num},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            var data = result.data;
            var contHtml = template.render('content',data);
            $('.content').html(contHtml);
            var _TimeCountDown = $(".time");
            _TimeCountDown.fnTimeCountDown();
        }
    });

});

function buy(th)
{
    window.location.href = WapSiteUrl+'/tmpl/product_detail.html?goods_id='+$(th).data('id');
    return false;
}
var pagesize = 10;
var curpage = 0;
var firstRow = 0;
var hasmore = true;
var key = getCookie('key');

$(function()
{
   if(!key)
   {
       window.location.href = WapSiteUrl+'/tmpl/member/login.html';
       return false;
   }

    get_points_goods();

    $(window).scroll(function (){
        if(hasmore) {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
                get_points_goods();
            }
        }
    });
});


function  get_points_goods()
{
    param = {};

    param.firstRow = firstRow;

    $.getJSON(ApiUrl+'/index.php?ctl=Buyer_Points&met=points&op=getPointsOrder&typ=json',param,function (e)
    {
        if (e.status == 200)
        {
            console.log(e.data);
            var pointHtml = template.render('point_goods',e.data);
            $('.point_goods').append(pointHtml);

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


function huo(th)
{
    $.post(ApiUrl+'/index.php?ctl=Buyer_Points&met=confirmOrder&typ=json',{order_id:$(th).data('id')},function(e){
        if(e.status == 200)
        {
            alert('收货成功');
            window.location.href = WapSiteUrl+'/tmpl/gold_goods_exchange.html';
        }
        else
        {
            alert('收货失败');
            window.location.href = WapSiteUrl+'/tmpl/gold_goods_exchange.html';
        }
    });
}

function wu(th)
{
    var shipping_code = $(th).attr('shipping_code');
    var express_name  = $(th).attr('express_name');
    var express_id    = $(th).attr('express_id');
    var order_id      = $(th).attr('order_id');

    window.location.href = WapSiteUrl+'/tmpl/member/order_delivery.html?shipping_code='+shipping_code+'&express_name='+express_name+'&express_id='+express_id+'&order_id='+order_id;
}

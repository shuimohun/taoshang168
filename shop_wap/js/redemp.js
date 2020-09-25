var rule = getQueryString('rule');
var price = getQueryString('price');

$(function(){
    if(!rule)
    {
        window.location.href=WapSiteUrl+'/tmpl/andone.html';
        return;
    }

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Api_App_AndOne&met=getRedempGoods&typ=json',
        data:{rule:rule,price:price},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                console.log(data);
                var redempHtml = template.render('redemp_goods',data);
                $('.goods').html(redempHtml);
            }
        }
    });
});
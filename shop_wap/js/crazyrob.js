var shop_id = getQueryString('shop_id');


$(function(){
    if(!shop_id)
    {
        window.location.href = WapSiteUrl+'/index.html';
        return;
    }

    goods();

    $('.footer li').eq(0).on('click',function(){
        goods('rush');
    });

    $('.footer li').eq(1).on('click',function(){
        goods('will');
    });

    $('.footer li').eq(2).on('click',function(){
        goods('sell_out');
    });

});


function goods(type)
{
    $.ajax({
        url:ApiUrl+'/index.php?ctl=Shop&met=getShopPromotionRush&typ=json',
        data:{shop_id:shop_id,type:type},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                console.log(data);
                var goodHtml = template.render('good_list',data);
                $('.good_list').html(goodHtml);

                var _TimeCountDown = $(".fnTimeCountDown");
                _TimeCountDown.fnTimeCountDown();
            }
        }
    });


}
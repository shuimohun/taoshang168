/*

$(function(){
    $('.shoucang').click(function(){
        if ($(this).attr('src') == 'img/like@2x.png'){
            $(this).attr('src','img/liked@2x.png');
        }
        else if($(this).attr('src') == 'img/liked@2x.png'){
           $(this).attr('src','img/like@2x.png');
        }
    })

     $('.shoucang2').click(function(){
        if ($(this).attr('src') == 'img/like@2x.png'){
            $(this).attr('src','img/liked@2x.png');
        }
        else if($(this).attr('src') == 'img/liked@2x.png'){
           $(this).attr('src','img/like@2x.png');
        }
    })
})*/
var shop_id = getQueryString('shop_id');
$(function () {

    if(!shop_id)
    {
        window.location.href = WapSiteUrl;
        return;
    }

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Shop&met=getShopPromotionDiscount&typ=json',
        data:{shop_id:shop_id},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                console.log(data);
                var goodHtml = template.render('goods_d',data);
                $('.all_goods').html(goodHtml);
                // var ruleHtml = template.render('rule',data);
                // $('.plus_good').html(ruleHtml);
            }
        }
    });
})
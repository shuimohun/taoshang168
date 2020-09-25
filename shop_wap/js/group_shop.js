var shop_id = getQueryString('shop_id');

$(function(){
    if(!shop_id)
    {
        window.location.href=WapSiteUrl;
        return;
    }

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Shop&met=getShopPromotionBundling&typ=json',
        data:{shop_id:shop_id},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                console.log(data);
                var goodsHtml = template.render('goods',data);
                $('.good_list').html(goodsHtml);
                var swiper = new Swiper('.swiper-container', {
                    pagination: '.swiper-pagination',
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 30,
                    freeMode: true
                });
            }
        }
    });
});
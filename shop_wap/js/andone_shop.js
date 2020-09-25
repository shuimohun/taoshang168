var shop_id = getQueryString('shop_id');
$(function(){
    if(!shop_id)
    {
        window.location.href = WapSiteUrl;
        return;
    }


    get_goods_cat();

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Shop&met=getShopPromotionAddGood&typ=json',
        data:{shop_id:shop_id},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                console.log(data);
                var goodHtml = template.render('goods',data);
                $('.good_list').html(goodHtml);
                var ruleHtml = template.render('rule',data);
                $('.plus_good').html(ruleHtml);
            }
        }
    });
});


function get_goods_cat() {
    $.getJSON(ApiUrl + "?ctl=Shop&met=getShopPromotionAddGood&typ=json",{type:'nav',shop_id:shop_id},function (data) {
        if(data.status == 200){

            var mySwiper = new Swiper('#topNav', {
                freeMode: true,
                freeModeMomentumRatio: 0.5,
                slidesPerView: 'auto',
            });

            var html = '';
            $.each(data.data,function (k,v) {
                html += '<div class="swiper-slide" data-id="'+v['increase_id']+'"><span>'+v['increase_name']+'</span></div>';
            });

            mySwiper.appendSlide(html);

            swiperWidth = mySwiper.container[0].clientWidth;
            maxTranslate = mySwiper.maxTranslate();
            maxWidth = -maxTranslate + swiperWidth / 2;
            $(".swiper-container").on('touchstart', function(e) {
                e.preventDefault();
            });
            mySwiper.on('tap', function(swiper, e) {
                /*e.preventDefault();*/
                slide = swiper.slides[swiper.clickedIndex];
                slideLeft = slide.offsetLeft;
                slideWidth = slide.clientWidth;
                slideCenter = slideLeft + slideWidth / 2;
                // 被点击slide的中心点
                mySwiper.setWrapperTransition(300);
                if (slideCenter < swiperWidth / 2) {
                    mySwiper.setWrapperTranslate(0);
                } else if (slideCenter > maxWidth) {
                    mySwiper.setWrapperTranslate(maxTranslate)
                } else {
                    nowTlanslate = slideCenter - swiperWidth / 2;
                    mySwiper.setWrapperTranslate(-nowTlanslate)
                }

                $("#topNav .active").removeClass('active');
                $("#topNav .swiper-slide").eq(swiper.clickedIndex).addClass('active');

                cat_id = $("#topNav .swiper-slide").eq(swiper.clickedIndex).data('id');
                getGoods(cat_id);
            });
        }
    })
}

function getGoods(id)
{
    $.ajax({
        url:ApiUrl+'/index.php?ctl=Shop&met=getShopPromotionAddGood&typ=json',
        data:{increase_id:id,shop_id:shop_id},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                console.log(data);
                var goodHtml = template.render('goods',data);
                $('.good_list').html(goodHtml);
                var ruleHtml = template.render('rule',data);
                $('.plus_good').html(ruleHtml);
            }
        }
    });
}

function favor(th)
{
    if ($(th).attr('src') == '../images/like@2x.png')
    {
        favoriteGoods($(th).data('id'));
        $(th).attr('src','../images/liked@2x.png');
    }
    else if($(th).attr('src') == '../images/liked@2x.png')
    {
        dropFavoriteGoods($(th).data('id'));
        $(th).attr('src','../images/like@2x.png');
    }

}



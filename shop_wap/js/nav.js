
//头部一级分类
function get_goods_cat() {
    $.getJSON(ApiUrl + "?ctl=Goods_Cat&met=getOneCat&typ=json", function (data) {
        if(data.status == 200){

            console.log(data)
            var mySwiper = new Swiper('#topNav', {
                freeMode: true,
                freeModeMomentumRatio: 0.5,
                slidesPerView: 'auto',
            });

            var html = '';
            $.each(data.data,function (k,v) {
                html += '<div class="swiper-slide" data-id="'+v['cat_id']+'"><span>'+v['nav_name']+'</span></div>';
            });

            mySwiper.appendSlide(html);

            swiperWidth = mySwiper.container[0].clientWidth;
            maxTranslate = mySwiper.maxTranslate();
            maxWidth = -maxTranslate + swiperWidth / 2;
            $(".swiper-container").on('touchstart', function(e) {
                e.preventDefault();
            })
            mySwiper.on('tap', function(swiper, e) {
                e.preventDefault();
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
                //console.log(cat_id);
                firstRow = 0;
                //get_goods_list(true);

                cat_callback(cat_id);
            });
        }
    })
}


$(function(){
    get_goods_cat();
});







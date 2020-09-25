var addr = getQueryString('addr');
$(function(){

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Api_App_Fresh&met=getSliderGoods&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
           if(result.status == 200)
           {
               var data = result.data;
               var sliderHtml = template.render('slider',data);
               $('.slider_list').html(sliderHtml);
               var giftHtml = template.render('gifts',data);
               $('.gifts').html(giftHtml);
               var catHtml = template.render('cat',data);
               $('.species').html(catHtml);
                var gunHtml = template.render('gun',data);
                $('.gundong_show').html(gunHtml);
               $('.gundong_show').css('display','none');
               slider();
               $(window).scroll(function(){
                   if($(window).scrollTop()>=650){
                       $('.gundong_show').fadeIn(500);
                   }else{
                       $('.gundong_show').fadeOut(500);
                   }
               });
               var swiper = new Swiper('.gundong_show .swiper-container', {
                   pagination: '.gundong_show .swiper-pagination',
                   paginationClickable: true,
                   spaceBetween: 30,
               });
           }
        }
    });

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Api_App_Fresh&met=floorGoods&typ=json',
        data:{'addr':addr},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                var floorHtml = template.render('floor',data);
                $('.floor').html(floorHtml);
            }

            $.ajax({
                url:ApiUrl+'/index.php?ctl=Api_App_Fresh&met=saleNumGood&typ=json',
                data:{'addr':addr},
                type:'post',
                dataType:'json',
                success:function(result)
                {
                    if(result.status == 200)
                    {
                        var data = result.data;
                        console.log(data);
                        var allHtml = template.render('all',data);
                        $('.all').html(allHtml);
                    }
                }
            });
        }
    });
});


function slider()
{
    $('.slider_list').each(function() {
        if ($(this).find('.item').length < 2) {
            return;
        }
        Swipe(this, {
            startSlide: 2,
            speed: 400,
            auto: 3000,
            continuous: true,
            disableScroll: false,
            stopPropagation: false,
            callback: function(index, elem) {},
            transitionEnd: function(index, elem) {}
        });
    });
}

$('.find_nav_list').on('click',"li[class='find_nav_cur']",function(){
   window.location.href = WapSiteUrl+'/tmpl/fresh.html?addr='+$(this).data('type');
   return;
});
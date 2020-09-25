$(function(){

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Api_Shop_Supermarket&met=getNav&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {

            if(result.status == 200)
            {
                var data = result.data;
                console.log(data);
                var sliderHtml = template.render('sliderPic',data);
                $('.slider_list').html(sliderHtml);
                var iconHtml = template.render('iconPic',data);
                $('.lb1').html(iconHtml);
                var gunHtml = template.render('gunIcon',data);
                $('.gundong_show').html(gunHtml);
                var swiper = new Swiper('.lb1 .swiper-container', {
                    pagination: '.lb1 .swiper-pagination',
                    nextButton: '.swiper-button-next',
                    prevButton: '.swiper-button-prev',
                    observer: true,
                    observerParents: true,
                    slidesPerView: 1,
                    paginationClickable: true,
                    spaceBetween: 16,
                    loop: true
                });
                var swiper = new Swiper('.lb2 .swiper-container', {
                    pagination: '.lb2 .swiper-pagination',
                    observer: true,
                    observerParents: true,
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 16,
                    freeMode: true
                });
                var swiper = new Swiper('.newlb1 .swiper-container', {
                    pagination: '.newlb1 .swiper-pagination',
                    observer: true,
                    observerParents: true,
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 16,
                    freeMode: true
                });
                var swiper = new Swiper('.newlb2 .swiper-container', {
                    pagination: '.newlb2 .swiper-pagination',
                    observer: true,
                    observerParents: true,
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 16,
                    freeMode: true
                });

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
                var swiper = new Swiper('.gundong_show .swiper-container', {
                    pagination: '.gundong_show .swiper-pagination',
                    observer: true,
                    observerParents: true,
                    paginationClickable: true,
                    spaceBetween: 16,
                });
           }
        }
    });

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Api_Shop_Supermarket&met=getEssential&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {

            if(result.status == 200)
            {
                var data = result.data;
                var missHtml = template.render('notM',data);
                $('.notmiss').html(missHtml);
            }
        }
    });

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Api_Shop_Supermarket&met=getLife&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {

            if(result.status == 200)
            {
                var data = result.data;
                var taoHtml = template.render('taoLife',data);
                $("#taoshang").html(taoHtml);

                var swiper = new Swiper('.lb2 .swiper-container', {
                    pagination: '.lb2 .swiper-pagination',
                    observer: true,
                    observerParents: true,
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 16,
                    freeMode: true
                });
                var swiper = new Swiper('.newlb1 .swiper-container', {
                    pagination: '.newlb1 .swiper-pagination',
                    observer: true,
                    observerParents: true,
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 16,
                    freeMode: true
                });
                var swiper = new Swiper('.newlb2 .swiper-container', {
                    pagination: '.newlb2 .swiper-pagination',
                    observer: true,
                    observerParents: true,
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 16,
                    freeMode: true
                });
            }

        }
    });
    $.ajax({
        url:ApiUrl+"?ctl=Self_Index&met=getSuperMarkGoods&typ=json",
        type:'post',
        dataType:'json',
        success:function(result){
            if(result.status == 200){
                var data = result.data;
                var new_goods_html = template.render('new_goods',data);
                $('.new_goods').html(new_goods_html);
                var lifeHtml = template.render('rush',data);
                $('.life_home').html(lifeHtml);
                if(data.goods_today.length>0 && data.goods_tomorrow.length>0){
                    $('.newlb1 .tomorrow').addClass("visibility")
                }else if(data.goods_today.length>0 && data.goods_tomorrow.length == 0){
                    $('#tomorrow').html(' ');
                    $('.newlb1 .tomorrow').addClass("visibility")
                }else if(data.goods_today.length == 0 && data.goods_tomorrow.length>0){
                    $('.lifehome_title_item1').html('明日预告');
                    $('#tomorrow').html(' ');
                    $('.newlb1 .today').addClass("visibility")
                    $('.newlb1 .tomorrow').removeClass("visibility")
                }

                $('#tomorrow').on('click',function(){
                    if($(this).attr('data-type') == 'tomorrow'){
                        if($(this).html()){
                            $('.lifehome_title_item1').html('明日预告');
                            $('#tomorrow').html('今日疯抢');
                            $('.newlb1 .today').addClass("visibility")
                            $('.newlb1 .tomorrow').removeClass("visibility")
                            $(this).attr('data-type','today');
                        }
                    }else if($(this).attr('data-type') == 'today'){
                        $('.lifehome_title_item1').html('今日疯抢');
                        $('#tomorrow').html('明日预告');
                        $('.newlb1 .today').removeClass("visibility")
                        $('.newlb1 .tomorrow').addClass("visibility")
                        $(this).attr('data-type','tomorrow');
                    }
                });

                $('#newgoods').on('click',function(){
                  $(".tab1").removeClass("visibility");
                  $('.tab2').addClass("visibility");
                });
                $('#settime').on('click',function(){
                    $(".tab2").removeClass("visibility");
                    $('.tab1').addClass("visibility");
                });
                var _TimeCountDown = $(".fnTimeCountDown");
                _TimeCountDown.fnTimeCountDown();
            }
        }
    });




    $.ajax({
        url:ApiUrl+'/index.php?ctl=Api_Shop_Supermarket&met=getClickContent&typ=json&type=salenum',
        type:'post',
        dataType:'json',
        success:function(result)
        {

            if(result.status == 200)
            {
                var data = result.data;
                var clickHtml = template.render('cliCon',data);
                $('.proprietary_goods').html(clickHtml);
            }
        }
    });
});
$('.nav').on('click',"li[class='cur']",function(){
    var type = $(this).data('type');
   $.post(ApiUrl+'/index.php?ctl=Api_Shop_Supermarket&met=getClickContent&typ=json',{type:type},function(result){
        if(result.status == 200)
        {
            var data = result.data;
            var clickHtml = template.render('cliCon',data);
            $('.proprietary_goods').html(clickHtml);
        }
   });
});
function sheng(th)
{
    var goods_id = $(th).attr('goods_id');
    window.location.href=WapSiteUrl+'/tmpl/product_detail.html?goods_id='+goods_id;
    return;
}
function clle(th)
{
    var path = $(th).attr('src');
    var goods_id = $(th).attr('goods_id');
   if(path == '../images/proprietary_img/book_n.png')
   {
       favoriteGoods(goods_id);
       $(th).attr('src','../images/proprietary_img/book_s.png');
   }
   else if(path == '../images/proprietary_img/book_s.png')
   {
       dropFavoriteGoods(goods_id);
       $(th).attr('src','../images/proprietary_img/book_n.png');
   }

}

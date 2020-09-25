var shop_id = getQueryString('shop_id');

$(function(){

   if(!shop_id)
   {
       window.location.href = WapSiteUrl;
       return;
   }

   $.ajax({
       url:ApiUrl+'/index.php?ctl=Shop&met=getShopPromotionMan&typ=json',
       data:{shop_id:shop_id},
       type:'post',
       dataType:'json',
       success:function(result)
       {
           if(result.status == 200)
           {
               var data = result.data;
               console.log(data);
               var manHtml = template.render('man',data);
               $('.man').html(manHtml);
               var tuiHtml = template.render('recommend',data);
               $('.tui').html(tuiHtml);
           }
       }
   });


});


function favor(th)
{
    if($(th).attr('src') == '../images/activity/like@2x.png')
    {
        favoriteGoods($(th).data('id'));
        $(th).attr('src','../images/activity/liked@2x.png');
    }
    else if($(th).attr('src') == '../images/activity/liked@2x.png')
    {
        dropFavoriteGoods($(th).data('id'));
        $(th).attr('src','../images/activity/like@2x.png');
    }
}
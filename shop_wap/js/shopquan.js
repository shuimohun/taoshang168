var shop_id = getQueryString('shop_id');

$(function()
{
   if(!shop_id)
   {
       window.location.href = WapSiteUrl+'/index.html';
       return;
   }

   $.ajax({
       url:ApiUrl+'/index.php?ctl=Voucher&met=vList&typ=json',
       data:{store_id:shop_id},
       type:'post',
       dataType:'json',
       success:function(result)
       {
           if(result.status == 200)
           {
               var data = result.data;
               console.log(data);
               var chitHtml = template.render('chit',data);
               $('.chit').html(chitHtml);
           }
       }
   });

});


function convert(th)
{
    var key = getCookie('key');
    var v_id = $(th).data('id');
    if(!key)
    {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }

    $.ajax({
        url:ApiUrl + "?ctl=Voucher&met=receiveVoucher&typ=json",
        data:{vid:v_id,k:key,u:getCookie('id')},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                alert(result.msg);
                window.location.href = WapSiteUrl+'/tmpl/shopquan.html?shop_id='+shop_id;
                return;
            }
            else
            {
                alert(result.msg);
                window.location.href = WapSiteUrl+'/tmpl/shopquan.html?shop_id='+shop_id;
                return;
            }
        }
    });
}
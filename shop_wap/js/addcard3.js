var data;
$(function(){
    var e = getCookie("key");
    var cont = JSON.parse(getCookie("bankCont"));
    if(!e)
    {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }
    if(!cont)
    {
        window.location.href = WapSiteUrl+'/tmpl/member/addcard1.html';
        return;
    }

    $('#name').val(cont.realname);
    $('#bank_number').val(cont.bank_account_number);
    $('#bank_name').val(cont.bank_name);
    if(cont.card_img)
    {
        $('#win_L').attr('src',cont.card_img);
    }

    data = cont;
});

$('.remove').click(function(){
   $.post(PayCenterApiUrl+'?ctl=Info&met=delUserCard&typ=json',{card_id:data.card_id},function(result){
       if(result.status == 200)
       {
           alert('删除成功');
           delCookie("bankCont");
           window.location.href=WapSiteUrl+'/tmpl/member/addcard1.html';
           return;
       }

   });
});

$('.next').click(function(){
    delCookie("bankCont");
   window.location.href=WapSiteUrl+'/tmpl/member/money_index.html';
   return;
});


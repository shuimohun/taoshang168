$(function(){
    var e = getCookie("key");

    if(!e)
    {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }

    $.ajax({
        url:PayCenterApiUrl+'?ctl=Info&met=getUserInfo&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
            console.log(result.data);
            if(result.status == 200)
            {
                var data = result.data;
                var listHtml = template.render('list',data);
                $('.info_add').html(listHtml);
            }
        }
    });
});
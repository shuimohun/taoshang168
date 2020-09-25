$(function () {
    var e = getCookie("key");

    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }
    $.ajax({
        url:ApiUrl + "?ctl=Points&met=pList&typ=json",
        type:'post',
        dataType:'json',
        success:function(result)
        {
            console.log(result);
            var data = result.data;
            $('.egg_bg_img>span').html(data.user_info.user_name);
            $('.egg_bg_img>img').attr('src',data.user_info.user_logo);
            $('.eggs>b').html(data.user_resource.user_points);

        }
    });
    get_detail();
});

//签到页面
$('.sign').click(function(){
   location.href=WapSiteUrl+'/tmpl/member/signin.html';return;
});

//税换商品页面
$('.exchange').click(function(){
   location.href=WapSiteUrl+'/tmpl/gift.html';return;
});

function get_detail()
{
    $.ajax({
        url:ApiUrl+'/index.php?ctl=Buyer_Points&met=points&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
             if(result.status == 200)
             {
                 var data = result.data;
                 var runHtml = template.render('runwater',data);
                 $('.water').append(runHtml);
             }
        }
    });
}
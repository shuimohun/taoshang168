$(function()
{
    var k = getCookie('key');

    if(!k)
    {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }

    $.ajax({
        url:ApiUrl+'/index.php?ctl=Buyer_Message&met=wapSettingMessage&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                console.log(data);
                var setHtml = template.render('on-off',data);
                $('.on-off').html(setHtml);
            }
        }
    });
});

function click_rate(th)
{
    if ($(th).attr('src') == '../../images/info/on@3x.png'){
        $.post(ApiUrl+'/index.php?ctl=Buyer_Message&met=editWapSettingMessage&typ=json',{id:$(th).data('id'),type:'del'},function(result){
            if(result.status == 200)
            {
                $(th).attr('src','../../images/info/off@3x.png');
                return;
            }
            else
            {
                alert('设置失败');
                window.location.href = WapSiteUrl+'/tmpl/member/set.html';
            }
        });

    }
    else
    {
        $.post(ApiUrl+'/index.php?ctl=Buyer_Message&met=editWapSettingMessage&typ=json',{id:$(th).data('id'),type:'add'},function(result){
            if(result.status == 200)
            {
                $(th).attr('src','../../images/info/on@3x.png');
                return;
            }
            else
            {
                alert('设置失败');
                window.location.href = WapSiteUrl+'/tmpl/member/set.html';
            }
        });

    }

}
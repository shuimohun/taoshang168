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
            if(result.status == 200)
            {
                var data = result.data;
                console.log(data);
                //判断是否实名，未实名先实名
                if(!data.user_info.user_realname)
                {
                    alert('请先实名认证');
                    window.location.href = WapSiteUrl+'/tmpl/member/realname.html';
                    return;
                }
                //防跳墙操作
                if(data.user_info.user_alipay)
                {
                    alert('错误操作');
                    window.location.href = WapSiteUrl+'/tmpl/member/login.html';
                    return;
                }
                if(data.user_info.user_mobile)
                {
                    $('#mobile').val(data.user_info.user_mobile);
                }

            }
        }
    });

});

function checkwechat()
{
    var account = $('#account').val();
    var rgu = /^[a-zA-Z\d_]{5,}$/;
    var re = new RegExp(rgu);
    if(re.test(account))
    {
        return account;
    }
    else
    {
        alert('请输入正确的账号');
        return;
    }
}

function checkyzm()
{
    var str = $('#verificationcode').val();
    var reg = /^[0-9]{4}$/;
    var re = new RegExp(reg);
    if(re.test(str))
    {
        return str;
    }
    else
    {
        alert('验证码错误');
        $('#verificationcode').val("");
        return;
    }
}


$('.gain').click(function(){
    var type = $(this).attr('data-type');
    if( type == 'mobile')
    {
        var val = $('#mobile').val();

    }
    msg = "获取手机验证码";
    $(".gain").attr("disabled", "disabled");
    $(".gain").attr("readonly", "readonly");
    $(".gain").css({'background-color':'#ccc'});
    t=setTimeout(countDown,1000);
    var url = PayCenterWapUrl+'/index.php?ctl=Info&met=getYzm&typ=json';
    var sj = new Date();
    var pars = 'shuiji=' + sj +'&type='+type +'&val='+val;
    $.post(url, pars, function (data){})
});


var delayTime = 120;
function countDown()
{
    delayTime--;
    $(".gain").val(delayTime + '秒后重新获取');
    if (delayTime == 0) {
        delayTime = 120;
        $(".gain").val(msg);
        $(".gain").removeAttr("disabled");
        $(".gain").removeAttr("readonly");
        $(".gain").css({'background-color':'#e45050'});
        clearTimeout(t);
    }
    else
    {
        t=setTimeout(countDown,1000);
    }
}

$('.next').click(function(){

    if(checkwechat())
    {
        var account = checkwechat();
    }else{return;}

    if(checkyzm())
    {
        var yzm = checkyzm();
    }else{return;}
    $.ajax({
        url:PayCenterApiUrl+'?ctl=Info&met=addUserCard&typ=json&type=wechat_add',
        data:{yzm:yzm,user_account:account},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 240)
            {
                alert('验证码错误请重新输入');
                $('#verificationcode').val("");
                return;
            }

            if(result.status == 200)
            {
                alert('设置成功');
                window.location.href = WapSiteUrl+'/tmpl/member/money_index.html';
                return;
            }
        }
    });
});
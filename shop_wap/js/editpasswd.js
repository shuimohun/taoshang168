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

                if(data.user_info.user_mobile)
                {
                    $('#mobile').val(data.user_info.user_mobile);
                }

            }
        }
    });

});

function checkpasswd()
{
    var one = $('#set_password').val();
    var rgu = /^[a-zA-Z\d_]{6,20}$/;
    var re = new RegExp(rgu);
    if(re.test(one))
    {
        return one;
    }
    else
    {
        alert('密码必须是6-20位的数字字母_');
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

    if(checkpasswd())
    {
        var set_password = checkpasswd();

    }else{return;}

    if(checkyzm())
    {
        var yzm = checkyzm();

    }else{return;}

    var old_password = $('#old_password').val();

    $.ajax({
        url:PayCenterApiUrl+'?ctl=Info&met=editUserPayPassword&typ=json&type=edit',
        data:{yzm:yzm,set_password:set_password,old_password:old_password},
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
                alert('修改成功');
                window.location.href = WapSiteUrl+'/tmpl/member/money_index.html';
                return;
            }
            else
            {
                alert('原密码输入错误');
                return;
            }
        }
    });
});
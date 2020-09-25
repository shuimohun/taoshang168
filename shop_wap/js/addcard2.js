var data;
$(function(){
   var e = getCookie("key");
   var bankCardData= JSON.parse(getCookie("bankCardData"));
   if(!e)
   {
       window.location.href=WapSiteUrl+'/tmpl/member/login.html';
       return;
   }

   if(!bankCardData)
   {
       window.location.href=WapSiteUrl+'/tmpl/member/addcard1.html';
       return;
   }

   data = bankCardData;

});

$('.gain').click(function(){
    var type = $(this).attr('data-type');
    if( type == 'mobile')
    {
        if(checkphone())
        {
            var val = checkphone();
        }
        else
        {
            return;
        }

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

function checkphone()
{
    var mobile = $('#phone').val();
    var rgu = /^1[3|5|7|8]{1}[0-9]{9}$/;
    var re = new RegExp(rgu);
    if(re.test(mobile))
     {
         return mobile;
     }
     else
    {
        alert('请输入正确的手机号');
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

$('.next').click(function(){
    if(checkphone())
    {
        var phone = checkphone();
    }else{return;}

    if(checkyzm())
    {
        var yzm = checkyzm();
    }else{return;}

    $.ajax({
        url:PayCenterApiUrl+'?ctl=Info&met=addUserCard&typ=json&type=card_add',
        type:'post',
        data:{bank_account_number:data.bank_account_number,bank_id:data.bank_id,card_img:data.card_img,yzm:yzm,bank_bind_phone:phone},
        dataType:'json',
        success:function(result)
        {
            if(result.status == 240)
            {
                alert('验证码输入有误');
                return;
            }
            if(result.status == 200)
            {
                alert('添加成功');
                var content = {bank_account_number:data.bank_account_number,bank_id:data.bank_id,bank_name:data.bank_name,card_img:data.card_img,realname:data.realname,card_id:result.data.card_id};
                addCookie("bankCont",JSON.stringify(content),1);
                delCookie("bankCardData");
                window.location.href = WapSiteUrl+'/tmpl/member/addcard3.html';
                return;
            }
            else
            {
                delCookie("bankCardData");
                window.location.href = WapSiteUrl+'/tmpl/member/addcard1.html';
                return;
            }
        }

    });

});



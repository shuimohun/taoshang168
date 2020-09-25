$(function(){
   var e = getCookie("key");
   //防跳墙
    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }
    $.ajax({
        type:'get',
        url :ApiUrl+'/index.php?ctl=User_User&met=checkPhone&typ=json',
        dataType:'json',
        success:function(e)
        {
            if(e.status == '200')
            {
                if(e.data.phone)
                {
                    $('#number_primary').val(e.data.phone);
                }
                else
                {
                    alert('禁止翻墙');
                    window.location.href = WapSiteUrl+"/tmpl/member/login.html";
                    return;
                }

            }
        }
    });

    $('#yzmone').click(function(){
        var my = this;
        var mobile = $('#number_primary').val();

       $.get(ApiUrl+'/index.php?ctl=User_User&met=setYzm&typ=json',{mobile:mobile},function(e){
           console.log(e);
           if(e.status == '200')
           {
               settime(my);

           }
       });
    });

    $('#yzmtwo').click(function(){
        var i = this;
        var data = $('#number_new').val();
        if(data == " 请输入新的手机号码")
        {
           alert('新手机号不能为空');
           return;
        }
        else if(!/^1[3|5|7|8]{1}[0-9]{9}$/.test(data))
        {
            alert('手机格式错误');
            $('#number_new').val(" ");
            return;
        }

        $.get(ApiUrl+'/index.php?ctl=User_User&met=setYzm&typ=json',{mobile:data},function(e){
            console.log(e);
            if(e.status == '200')
            {
                timeset(i);

            }

        });
    });


});



var countdown=60;
function settime(obj) {
    if (countdown == 0) {
        obj.removeAttribute("disabled");
        obj.value="点击获取";
        countdown = 60;

    } else {
        obj.setAttribute("disabled", true);
        obj.value="重新发送(" + countdown + ")";
        countdown--;
        setTimeout(function() {settime(obj) },1000);
    }

}

var nums=60;
function timeset(obj) {
    if (nums == 0) {
        obj.removeAttribute("disabled");
        obj.value="点击获取";
        nums = 60;

    } else {
        obj.setAttribute("disabled", true);
        obj.value="重新发送(" + nums + ")";
        nums--;
        setTimeout(function(){timeset(obj) },1000);
    }

}

$('.complete').click(function(){
    var one = $('#check1').val();
    var two = $('#check2').val();
    var newMobile = $('#number_new').val();
    var oldMobile = $('#number_primary').val();

    if(!newMobile)
    {
        alert('新手机号不能为空');
        return;
    }
    else if(!one)
    {
        alert('原手机验证码不能为空');
        return;
    }
    else if(!two)
    {
        alert('新手机验证码不能为空');
        return;
    }
    else if(one)
    {
        $.post(ApiUrl+'/index.php?ctl=User_User&met=checkYzm&typ=json',{yzm:one,type:'mobile',val:oldMobile},function(result){
            if(result.status == 250)
            {
                alert('原手机验证码错误');
                return;
            }
        });
    }
    else if(two)
    {
        $.post(ApiUrl+'/index.php?ctl=User_User&met=checkYzm&typ=json',{yzm:two,type:'mobile',val:newMobile},function(result){
            if(result.status == 250)
            {
                alert('新手机验证码错误');
                return;
            }
        });
    }


    // $.post(UCenterApiUrl+'?ctl=User&met=editMobileInfo&typ=json',{user_mobile:newMobile,yzm:two},function(e){
    //     console.log(e);
    //     if(e.status == '200')
    //     {
    //         window.location.href = WapSiteUrl+"/tmpl/member/user_setup.html";
    //         return;
    //     }
    //     else if(e.status == '240')
    //     {
    //         alert('验证码错误');
    //         return;
    //     }
    //     else
    //     {
    //         alert('手机号已被绑定，或操作错误');
    //         return;
    //
    //     }
    // });

    $.post(ApiUrl+'/index.php?ctl=User_User&met=editPhone&typ=json',{mobile:newMobile},function(e){
        console.log(e);
        if(e.status == '200')
        {
            window.location.href = WapSiteUrl+"/tmpl/member/user_setup.html";
            return;
        }
        else if(e.status == '250')
        {
            alert(e.data.msg);
            return;
        }
    });

});


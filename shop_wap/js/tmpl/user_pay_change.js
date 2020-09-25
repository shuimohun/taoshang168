$(function(){
    var e = getCookie("key");
    //防止为登陆进入
    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }
    // $.ajax({
    //     type:'post',
    //     url :ApiUrl+'/index.php?ctl=User_User&met=checkPayPassword&typ=json',
    //     dataType:'json',
    //     success:function(e)
    //     {
    //         if(e.status == '250')
    //         {
    //             window.location.href = WapSiteUrl+"/tmpl/member/login.html";
    //             return;
    //         }
    //     }
    // });
    var code = '';
    $('.complete').click(function(){
      var a = $('#pwd_primary');
      var b = $('#pwd_new');
      var c = $('#pwd_repeat');
      var d = $('#verificationcode');
      if(a.val() == " 请输入原始支付密码")
      {
          alert('原支付密码不能为空');
          return;
      }
      if(!(/^[0-9]{6}$/.test(a.val())))
      {
          alert('您输入的原密码格式不正确');
          return;
      }
      if(b.val() == " 请输入6位数字")
      {
          alert('新支付密码不能为空');
          return;
      }
      if(!(/^[0-9]{6}$/.test(b.val())))
      {
            alert('您输入的新密码格式不正确');
            return;
      }
      if(c.val() == " 请再次输入新的密码")
      {
          alert('密码不能为空');
          return;
      }
      if(c.val() != b.val())
      {
          alert('两次输入密码不一致');
          return;
      }
      if(d.val() == " 请输入短信验证码")
      {
          alert('短信验证码不能为空');
          return;
      }
      if(d.val() != code)
      {
          alert('验证码不正确');
          return;
      }
      $.post(ApiUrl+'/index.php?ctl=User_User&met=verifyPayPassword&typ=json',{payPasswd:a.val()},function(e){
            if(e.status == '200')
            {
                $.post(ApiUrl+'/index.php?ctl=User_User&met=editPayPassword&typ=json',{password:b.val()},function(c){
                   if(c.status == '200')
                   {
                       alert('支付密码修改成功');
                       window.location.href = WapSiteUrl+"/tmpl/member/user_setup.html";
                       return;
                   }
                });
            }
            else if(e.status == '250')
            {
                alert('原密码输入错误');
                return;
            }
      });
    });

    $('#getyzm').click(function(){
        var i = this;
      $.post(ApiUrl+'/index.php?ctl=User_User&met=payCheckYzm&typ=json',function(e){
            if(e.status == '200')
            {
                settime(i);
                code = e.data.code;
            }
            else if(e.status == '220')
            {
                alert('您为绑定手机号');
                window.location.href = WapSiteUrl+"/tmpl/member/login.html";
                return;
            }
            else if(e.status == '250')
            {
                settime(i);
                alert('发送失败请稍后重试');
                return;
            }
      });
    });
});

var countdown=60;
function settime(val) {
    if (countdown == 0) {
        val.removeAttribute("disabled");
        val.value="点击获取";
        countdown = 60;
    } else {
        val.setAttribute("disabled", true);
        val.value="重新发送(" + countdown + ")";
        countdown--;
        setTimeout(function() {settime(val)},1000)
    }

}
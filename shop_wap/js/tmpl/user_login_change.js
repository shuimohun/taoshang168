$(function(){
    var e = getCookie("key");
    //防止为登陆进入
    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }
    $('#btn').click(function(){
        var a = $('#password');
        var b = $('#character');
        var c = $('#repeat');
        if(a.val() == " 请输入当前使用的密码")
        {
            alert('当前使用密码不能为空');
            return;
        }
        if(b.val() == "6-20个大小写英文字母、符号或数字")
        {
            alert('新密码不能为空');
            return;
        }
        if(!(/^(?!\D+$)(?![^a-zA-Z]+$)\S{6,20}$/.test(b.val())))
        {
            alert('密码格式有误');
            return;
        }
        if(c.val() == " 请重复输入新密码")
        {
           alert("重复密码不能为空");
            return;
        }
        if(c.val() != b.val())
        {
            alert("二次输入密码不一样");
            return;
        }
        $.post(ApiUrl+'/index.php?ctl=User_User&met=checkLoginPassword&typ=json',{password:a.val()},function(e){

            if(e.status == '250')
            {
                alert('原密码错误');
                return;

            }else if(e.status == '200')
            {
                $.post(ApiUrl+'/index.php?ctl=User_User&met=editLoginPassword&typ=json',{newPassword:b.val()},function(e){
                    if(e.status == '200')
                    {
                        alert('修改成功');
                        window.location.href = WapSiteUrl+"/tmpl/member/user_setup.html";
                    }
                });
            }
        });

    });
});

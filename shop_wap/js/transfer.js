var mobile;
$(function(){
    var e = getCookie("key");

    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }

    $.ajax({
        url:PayCenterWapUrl+'/index.php?ctl=Info&met=App_transfer&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
            console.log(result.data);
            if(result.status == 200)
            {
                var data = result.data;
                $('.nmb').html(data.user_mobile);
                num(data.user_money);
                mobile = data.user_mobile;
            }
        }
    });
});


//实时强制更改用户输出内容
function amount(th){
    var regStrs = [
        ['^0(\\d+)$', '$1'], //禁止录入整数部分两位以上，但首位为0
        ['[^\\d\\.]+$', ''], //禁止录入任何非数字和点
        ['\\.(\\d?)\\.+', '.$1'], //禁止录入两个以上的点
        ['^(\\d+\\.\\d{2}).+', '$1'] //禁止录入小数点后两位以上
    ];
    for(var i=0; i<regStrs.length; i++){
        var reg = new RegExp(regStrs[i][0]);
        th.value = th.value.replace(reg, regStrs[i][1]);
    }
}

//验证提现金额是否大于当前账户的余额
function checkMoney(e)
{
    $.post(PayCenterWapUrl+'/index.php?ctl=Info&met=getUserResourceInfo&typ=json',function(result){
        if(result.status == 200)
        {
            user_resource = result.data.user_money;

            if(Number(user_resource) < Number($(e).val()))
            {
                str = '您的余额只有' + user_resource + '元。';
                $('#trans_money').val("");
                $('#m_tip').attr('style','display:block;');
                $('#m_tip').html(str);
                $('#trans_money').attr('style',' border:.01rem solid red;');
            }
            else
            {
                var s = $('#trans_money').attr('style');
                var h = $('#m_tip').html();
                if(s)
                {
                    $('#trans_money').removeAttr('style');
                }
                if(h)
                {
                    $('#m_tip').html('');
                    $('#m_tip').attr('style','display:none;');
                }
            }
        }
    });
}

//验证转账用户是否存在
function checkUser(e)
{
    var f = $("#user_nickname").val();

    if(f)
    {
        $.post(PayCenterWapUrl + "/index.php?ctl=Info&met=getUserBase&typ=json&user_name="+f,
            function(data){

                if(data.status == 250)
                {
                    $(e).val("");
                   $('#u_tip').html('用户不存在');
                   $('#u_tip').attr('style','display:block;');
                    $(e).attr('style',' border:.01rem solid red;');
                }
                else
                {
                    var s = $(e).attr('style');
                    var h = $('#u_tip').html();
                    if(s)
                    {
                        $(e).removeAttr('style');

                    }
                    if(e)
                    {
                        $('#u_tip').html('');
                        $('#u_tip').attr('style','display:none;');
                    }
                }
            });
    }
}

function num(str){

    var btn = document.getElementById('btn');
    var h1 = document.getElementsByTagName('h1')[0];

    var strArr = str.split('');
    var arr = [];
    strArr.forEach(function(item,index){
        arr.push('*');
    });
    var a = arr.join('');
    h1.innerHTML = a;
    btn.onclick = function(){
        /*h1.innerHTML = str;*/
        if (h1.innerHTML == a){
            h1.innerHTML = str;
        }
        else{
            h1.innerHTML = a;
        }
    }
};

//验证说明
function checkState(th)
{
    var con = $(th).val();

    if(con)
    {
        var s  = $('#content').html();
        var h  = $(th).attr('style');
        if(s)
        {
            $('#content').html("");
            $('#content').attr('style','display:none;');
        }
        if(h)
        {
            $(th).removeAttr('style');
        }
    }
    else
    {
        $('#content').html('付款说明不能为空');
        $('#content').attr('style','display:block;');
        $(th).attr('style',' border:.01rem solid red;');

    }
}

$('.yanzhengma').click(function(){
    var type = $(this).attr('data-type');
    if( type == 'mobile')
    {
        var val = mobile;
    }
    msg = "获取手机验证码";
    $(".yanzhengma").attr("disabled", "disabled");
    $(".yanzhengma").attr("readonly", "readonly");
    $(".yanzhengma").css({'background-color':'#ccc'});
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
    $(".yanzhengma").val(delayTime + '秒后重新获取');
    if (delayTime == 0) {
        delayTime = 120;
        $(".yanzhengma").val(msg);
        $(".yanzhengma").removeAttr("disabled");
        $(".yanzhengma").removeAttr("readonly");
        $(".yanzhengma").css({'background-color':'#e45050'});
        clearTimeout(t);
    }
    else
    {
        t=setTimeout(countDown,1000);
    }
}


//验证码验证
flag = false;
function checkyzm()
{
    var yzm = $.trim($('#yzmval').val());
    var type = $('.yanzhengma').attr('data-type');
    var val = '';
    if(type == 'mobile')
    {
        val = mobile;
    }

    if(yzm == '')
    {
        $('#yzmval').attr('style','border:.01rem solid red;');
        $('#yzm').attr('style','display:block;');
        $('#yzm').html('验证码不能为空');
        return false;
    }
    var url = PayCenterWapUrl+'/index.php?ctl=Info&met=checkYzm&typ=json';
    var pars = 'yzm=' + yzm +'&type='+type +'&val='+val;
    $.post(url,pars,function(a){
        flag = false;
        if(a.status == 200)
        {
            flag = true;
            checkY = 1;
            var x = $('#yzmval').attr('style');
            var y = $('#yzm').attr('style');
            if(x)
            {
                $('#yzmval').removeAttr('style');
            }
            if(y == 'display:block;')
            {
                $('#yzm').attr('style','display:none;');
            }
        }
        else
        {
            $('#yzmval').attr('style','border:.01rem solid red;');
            $('#yzm').attr('style','display:block;');
            $('#yzm').html('输入验证码错误');
            checkY = 0;
            return flag;
        }
    });
    return flag;
}

$('#form').validator({
    ignore: ':hidden',
    theme: 'yellow_right',
    timely: 1,
    stopOnError: false,
    fields:{
        'user_nickname': 'required;',
        'record_money': 'required;phone',
        'record_desc': 'required;',
        'password':'required',
    },
    valid:function(form)
    {
        var me = this;
        // 提交表单之前，hold住表单，防止重复提交
        me.holdSubmit();
        var user_nickname = $("#user_nickname").val();
        var record_money = $("#trans_money").val();
        var record_desc = $('#state').val();
        var yzm = $("#yzmval").val();
        var password = $("#password").val();
        var ajax_url = PayCenterWapUrl+'/index.php?ctl=Info&met=addTransfer&typ=json';
        $.ajax({
            url:ajax_url,
            data:{user_nickname:user_nickname,record_money:record_money,record_desc:record_desc,mobile:mobile,yzm:yzm,password:password},
            success:function(a)
            {
                if(a.status == 200)
                {
                    alert('操作成功');
                    window.location.href=WapSiteUrl+'/tmpl/member/record.html?type=2';
                    return;
                }else if(a.status == 260){
                    alert('验证码错误');
                }else if(a.status == 230){
                    alert('支付密码错误');
                }else if(a.status == 240){
                    alert('用户不存在');
                }else if(a.status == 210){
                    alert('余额不足');
                }
                else
                {
                    alert('操作失败');
                }

                // 提交表单成功后，释放hold，如果不释放hold，就变成了只能提交一次的表单
                me.holdSubmit(false);
            }
        });
    }
});

$('.operate').on('click',"div[class='cur']",function(){
    var type = $(this).data('type');

    if(type == 1)
    {
        window.location.href = WapSiteUrl+'/tmpl/member/transfer.html';
        return;
    }
    else if(type == 2)
    {
        $.post(PayCenterWapUrl+'/index.php?ctl=Info&met=App_withdraw&typ=json',function(result){
            var data = result.data;
            if(result.status == 200)
            {
                if(data.user_card)
                {
                    if(!data.user_info.user_alipay)
                    {
                        window.location.href = WapSiteUrl+'/tmpl/member/alipay.html';
                        return;
                    }
                    else if(!data.user_info.user_wechat)
                    {
                        window.location.href = WapSiteUrl+'/tmpl/member/wechat.html';
                        return;
                    }
                    else
                    {
                        window.location.href = WapSiteUrl+'/tmpl/member/bankcard.html';
                    }
                }
                else if(data.shop_company)
                {
                    window.location.href = WapSiteUrl+'/tmpl/member/merchant.html';
                    return;
                }
                else
                {
                    window.location.href = WapSiteUrl+'/tmpl/member/addcard1.html';
                    return;
                }
            }
        });
    }
});
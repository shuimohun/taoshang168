var mobile;
var total;
var checkY = 0;
$(function(){
    var e = getCookie("key");

    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }
    $.ajax({
        url:PayCenterWapUrl+'/index.php?ctl=Info&met=App_withdraw&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                if(!data.user_info.user_mobile)
                {
                    window.location.href = WapSiteUrl+"/tmpl/member/login.html";
                    return;
                }
                else if(!data.user_card && !data.shop_company)
                {
                    window.location.href = WapSiteUrl+'/tmpl/member/addcard1.html';
                    return;
                }
                else if(!data.user_card)
                {
                    window.location.href = WapSiteUrl+'/tmpl/member/merchant.html';
                    return;
                }
                else if(!data.user_info.user_wechat)
                {
                    alert('4444');
                    // window.location.href =  WapSiteUrl+"/tmpl/member/realname.html";
                    // return;
                }

                num(data.user_info.user_money);
                var feeHtml = template.render('fee',data);
                $('.account').append(feeHtml);
                $('.nmb').html(data.user_info.user_mobile);
                $('.num').html(data.user_info.user_alipay);
                mobile = data.user_info.user_mobile;
                $('.operate div').click(function(){
                    $(this).addClass('cur').siblings().removeClass('cur');
                });
                $('.account li').click(function(){
                    $(this).addClass('cur').siblings().removeClass('cur');
                });
            }
            else if(result.status == 220)
            {
                window.location.href = WapSiteUrl+"/tmpl/member/realname.html";
                return;
            }

        }
    });
});

$('.account').on('click',"li[class='cur']",function(){
    count();
});

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

//提交表单
$('#form').validator({
    ignore:'hidden',
    theme:'yellow_right',
    timely:1,
    stopOnError:false,
    fields:{
        'account':'required;',
        'withdraw_money': 'required;',
        'password':'required',
    },
    valid:function (form) {
        var id = $('.cur').find('.service_fee_id').val();
        var user_wechat =$('.num').html();
        var withdraw_money = $('#with_money').val();
        var con = $('#con').val();
        var paypasswd = $('#password').val();
        var mobile = mobile;
        var val = checkY;
        var yzm =$('#yzmval').val();
        var me =this;
        //提交前锁住表单
        me.holdSubmit();
        var ajax_url = PayCenterWapUrl+'/index.php?ctl=Info&met=addMoveWithdraw&typ=json';
        $.ajax({
            url:ajax_url,
            data:{id:id,user_alipay:user_wechat,withdraw_money:withdraw_money,con:con,paypasswd:paypasswd,yzm:yzm,mobile:mobile,val:val},
            success:function(a)
            {
                console.info(a);
                if(a.status == 200)
                {
                    alert("操作成功");
                    window.location.href=WapSiteUrl+'/tmpl/member/record.html?type=4';
                    return;
                }else if(a.status == 260){

                    alert("验证码错误");

                }else if(a.status == 230){

                    alert("支付密码错误");

                }else if(a.status == 240){

                    alert("余额不足");
                }
                else
                {
                    if(a.data)
                    {
                        alert(a.data[0]);
                    }
                    else
                    {
                        alert("操作失败");
                    }

                }
                // 提交表单成功后，释放hold，如果不释放hold，就变成了只能提交一次的表单
                me.holdSubmit(false);
            }
        });
    }
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

//计算费用
function count()
{
    var money = $('#with_money').val();
    if(!money)
    {
        money = 0;
    }
    var seriver_fee = Number(money * ($(".cur").find(".service_fee_rates").val()*1/100)).toFixed(2);
    var fee_min = $(".cur").find(".fee_min").val();
    var fee_max = $(".cur").find(".fee_max").val();

    if(seriver_fee*1 > fee_max*1){
        seriver_fee = fee_max;
    }else if(seriver_fee*1 < fee_min*1){
        seriver_fee = fee_min;
    }else{
        seriver_fee = seriver_fee;
    }

    var	acount_total = Number(seriver_fee*1+money*1).toFixed(2);
    $('#service_money').html(seriver_fee);
    total = acount_total;
}

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
                $('#with_money').val("");
                $('#service_money').parent().hide();
                $('#hint').attr('style','display:block;');
                $('#hint').html(str);
                $('#with_money').attr('style',' border:.01rem solid red;');
            }
            else
            {
                var s = $('#with_money').attr('style');
                var h = $('#hint').html();
                if(s)
                {
                    $('#with_money').removeAttr('style');
                }
                if(h)
                {
                    $('#hint').html('');
                    $('#hint').attr('style','display:none;');
                    $('#service_money').parent().show();
                }
            }

            count();
        }
    });
}


$('.operate').on('click',"div[class='cur']",function(){
    var str = $(this).html();
    window.location.href = WapSiteUrl+'/tmpl/member/transfer.html';
    return;
});
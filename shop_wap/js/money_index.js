var yue;
var ka;
var dongjie;
var fenxiang;
var sum_money;
$(function(){
    var e = getCookie("key");
    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }

   $.ajax({
       url:PayCenterWapUrl+'/index.php?ctl=Info&met=App_index&typ=json',
       type:'post',
       dataType:'json',
       success:function(result)
       {
           console.log(result);
           if(result.status == 200)
           {
                var data = result.data;
                $('.head>img').attr('src',data.user_info.user_avatar);
                $('.welcome>span').html(data.user_base.user_account);
                $('#phone').html(data.user_info.user_mobile);
                $('#times').html(data.user_base.user_login_time);
                $('.yue>m').html(data.user_resource.user_money);
                $('.ka>m').html(data.user_resource.user_recharge_card);
                $('.dongjie>m').html(data.user_resource.user_money_frozen);
                $('.fenxiang>m').html(data.user_resource.user_share_money_frozen);
                $('#today_total').html(data.user_today_total);
                $('#share_money').html(data.user_share_price);
                sum_money = data.user_money_total;
                yue = data.user_resource.user_money;
                ka = data.user_resource.user_recharge_card;
                dongjie = data.user_resource.user_money_frozen;
                fenxiang = data.user_resource.user_share_money_frozen;
                pic();
                num();

           }
       }
   });

});

function pic()
{
    drawCircle =  function(canvas,percentage,number){
        var  clientWidth = document.documentElement.clientWidth;
        var canvasWidth = Math.floor(clientWidth*200/720);
        var innerR = canvasWidth * 0.7*0.5;
        //var canvas = mainDom.J_telphone.find('.canvas').get(0),
        var ctx;
        canvas.setAttribute('width',canvasWidth+'px');
        canvas.setAttribute('height',canvasWidth+'px');

        if (canvas.getContext) {
            ctx = canvas.getContext('2d');
        }
        ctx.translate(canvasWidth/2,canvasWidth/2);
        //var percentage = 3/5;
        ctx.beginPath();
        ctx.arc(0, 0, innerR, 0, Math.PI*2,false);
        ctx.lineWidth = 10;
        ctx.strokeStyle = "#f7f7f7";
        ctx.stroke();

        // ��������

        ctx.font = "24px";
        // ���ö��뷽ʽ
        ctx.textAlign = "center";
        // ���������ɫ
        ctx.fillStyle = "#ff744d";
        // �����������ݣ��Լ��ڻ����ϵ�λ��
        ctx.fillText(number, 0, 2);

        var start = 0,
            end = 0;
        ctx.beginPath();
        ctx.arc(0, 0, innerR, Math.PI*3/2,Math.PI*(2*percentage-1/4),false);
        ctx.lineWidth = 10;
        ctx.strokeStyle = "#ff744d";
        ctx.stroke();
    };

    drawCircle(document.getElementById('canvas'),3/5,45);

    var doughnutData = [
        {
            value: parseInt(yue),
            color:"#4dceff"
        },
        {
            value : parseInt(ka),
            color : "#ffc24d"
        },
        {
            value : parseInt(dongjie),
            color : "#e45252"
        },
        {
            value : parseInt(fenxiang),
            color : "#e87c25"
        }

    ];

    var myDoughnut = new Chart(document.getElementById("canvas").getContext("2d")).Doughnut(doughnutData);
}

function num()
{
    var btn = document.getElementById('btn');
    var h1 = document.getElementsByTagName('h1')[0];
    var M_yue = document.getElementById('M_yue');
    var M_ka = document.getElementById('M_ka');
    var M_dongjie = document.getElementById('M_dongjie');
    var M_fenxiang = document.getElementById('M_fenxiang');
    /*var M_taojin = document.getElementById('M_taojin');*/
    var str = sum_money;
    var a = '*******';
    h1.innerHTML = a;
    M_yue.innerHTML = a;
    M_ka.innerHTML = a;
    M_dongjie.innerHTML = a;
    M_fenxiang.innerHTML = a;
    /*M_taojin.innerHTML = a;*/

    btn.onclick = function(){
        /*h1.innerHTML = str;*/
        if (h1.innerHTML == a){
            h1.innerHTML = str;
        }
        else{
            h1.innerHTML = a;
        }
        if(M_yue.innerHTML == a){
            M_yue.innerHTML = yue;
        }
        else{
            M_yue.innerHTML = a;
        }
        if(M_ka.innerHTML == a){
            M_ka.innerHTML = ka;
        }
        else{
            M_ka.innerHTML = a;
        }
        if(M_dongjie.innerHTML == a){
            M_dongjie.innerHTML = dongjie;
        }
        else{
            M_dongjie.innerHTML = a;
        }
        if(M_fenxiang.innerHTML == a){
            M_fenxiang.innerHTML = fenxiang;
        }
        else{
            M_fenxiang.innerHTML = a;
        }
        /*if(M_taojin.innerHTML == a){
            M_taojin.innerHTML = taojin;
        }
        else{
            M_taojin.innerHTML = a;
        }*/
    }
    //�˻����
    
}

//���ֵ��
$('#withdraw').click(function(){
    window.location.href = WapSiteUrl+'/tmpl/sendbless_detail.html';
    // is_withdraw(1);
});

//ת�˵��
$('#transfer').click(function(){
    is_withdraw(2);
});

function is_withdraw(type)
{
    $.post(PayCenterWapUrl+'/index.php?ctl=Info&met=App_withdraw&typ=json',function(result){
        console.log(result.data);
        var data = result.data;
        if(!data.user_card)
        {
            if(data.shop_company)
            {
                window.location.href=WapSiteUrl+'/tmpl/member/merchant.html';
                return;
            }
            window.location.href=WapSiteUrl+'/tmpl/member/addcard1.html';
            return;
        }
        else
        {
            if(type == 1)
            {
                if(data.user_info.user_alipay)
                {
                    window.location.href=WapSiteUrl+'/tmpl/member/alipay.html';
                    return;
                }
                else if(data.user_info.user_wechat)
                {
                    window.location.href=WapSiteUrl+'/tmpl/member/wechat.html';
                    return;
                }
                else
                {
                    window.location.href=WapSiteUrl+'/tmpl/member/bankcard.html';
                    return;
                }
            }
            else
            {
                window.location.href=WapSiteUrl+'/tmpl/member/transfer.html';
                return;
            }

        }
    });
}





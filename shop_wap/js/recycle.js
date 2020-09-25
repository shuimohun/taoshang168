var type = getQueryString('type');
var status = getQueryString('status');
var start_date = getQueryString('start_date');
var end_date = getQueryString('end_date');
var time = getQueryString('time');
var nowTime = getQueryString('nowTime');
var date = new Date();
var li;
$(function(){
   var e = getCookie("key");

   if(!e)
   {
       window.location.href = WapSiteUrl+"/tmpl/member/login.html";
       return;
   }
   if(start_date && end_date)
   {
       $('#start_date').val(start_date);
       $('#end_date').val(end_date);
   }
    switch (type)
    {
        case '1':
            $(".leixing>li[data-type='1']").attr('class','cur');
            break;
        case '2':
            $(".leixing>li[data-type='2']").attr('class','cur');
            break;
        case '3':
            $(".leixing>li[data-type='3']").attr('class','cur');
            break;
        case '4':
            $(".leixing>li[data-type='4']").attr('class','cur');
            break;
        case '10':
            $(".leixing>li[data-type='10']").attr('class','cur');
            break;
        default:
            $(".leixing>li[data-type=' ']").attr('class','cur');
            break;
    }
    switch (status)
    {
        case 'doing':
            $(".zhuangtai>li[data-status='doing']").attr('class','cur');
            break;
        case 'waitpay':
            $(".zhuangtai>li[data-status='waitpay']").attr('class','cur');
            break;
        case 'waitsend':
            $(".zhuangtai>li[data-status='waitsend']").attr('class','cur');
            break;
        case 'retund':
            $(".zhuangtai>li[data-status='retund']").attr('class','cur');
            break;
        case 'waitconfirm':
            $(".zhuangtai>li[data-status='waitconfirm']").attr('class','cur');
            break;
        case 'success':
            $(".zhuangtai>li[data-status='success']").attr('class','cur');
            break;
        case 'cancel':
            $(".zhuangtai>li[data-status='cancel']").attr('class','cur');
            break;
        default:
            $(".zhuangtai>li[data-status=' ']").attr('class','cur');
            break;
    }
    switch (nowTime)
    {
        case 'oneMonth':
            $(".shijian>li[data-time='oneMonth']").attr('class','cur');
            break;
        case 'thereMonth':
            $(".shijian>li[data-time='thereMonth']").attr('class','cur');
            break;
        case 'oneYear':
            $(".shijian>li[data-time='oneYear']").attr('class','cur');
            break;
        default:
            $(".shijian>li[data-time=' ']").attr('class','cur');
    }
   $.ajax({
       url:PayCenterWapUrl+'/index.php?ctl=Info&met=App_recordlist&typ=json&record_delete=1&type='+type+'&time='+time+'&status='+status+'&start_date='+start_date+'&end_date='+end_date,
       type:'post',
       dataType:'json',
       success:function(result)
       {
           console.log(result.data);
           if(result.status == 200)
           {
                var data = result.data;
                var listHtml = template.render('list',data);
                $('.item').html(listHtml);
           }

           $('.item li').click(function(){
               $('.tanchuang').css('display','block');
               $('.bg_tanchuang').show();
               li = $(this);
           });

       }
   });
});

$('.leixing').on('click',"li[class='cur']",function(){
    var type = $(this).data('type');
    var status = $('.zhuangtai>.cur').data('status');
    var time = $('.shijian>.cur').data('time');
    var data = nowDate(time);
    window.location.href = WapSiteUrl+'/tmpl/member/recycle.html?type='+type+'&status='+status+'&time='+data;
    return;
});

$('.zhuangtai').on('click',"li[class='cur']",function(){
    var status = $(this).data('status');
    var type = $('.leixing>.cur').data('type');
    var time = $('.shijian>.cur').data('time');
    var data = nowDate(time);
    window.location.href = WapSiteUrl+'/tmpl/member/recycle.html?type='+type+'&status='+status+'&time='+data;
    return;
});

$('.shijian').on('click',"li[class='cur']",function(){
    var type = $('.leixing>.cur').data('type');
    var status = $('.zhuangtai>.cur').data('status');
    var time = $(this).data('time');
    var data = nowDate(time);
    window.location.href = WapSiteUrl+'/tmpl/member/recycle.html?type='+type+'&status='+status+'&time='+data+'&nowTime='+time;
    return;
});

$('#seek').click(function(){
    var start = $('#start_date').val();
    var end = $('#end_date').val();
    if(!start)
    {
        alert('开始时间不能为空');
        return;
    }
    else if(!end)
    {
        alert('结束时间不能为空');
        return;
    }
    window.location.href = WapSiteUrl+'/tmpl/member/recycle.html?start_date='+start+'&end_date='+end;
    return;
});

$('.ensure').click(function(){
    var id = li.data('order');
    $.post(PayCenterWapUrl+'/index.php?ctl=Info&met=delRecordlist&typ=json',{record_delete:1,id:id},function(data){
        if(data.status == 200)
        {
            alert('还原成功!');
            window.location.href = WapSiteUrl+'/tmpl/member/recycle.html';
            return;
        }
        else
        {
            alert('还原失败!');
            window.location.href = WapSiteUrl+'/tmpl/member/recycle.html';
            return;
        }
    });
});

$('.delete').click(function(){
    $('.bg_tanchuang').hide();
    $('.tanchuang').hide();
});

//对当前时间的处理
function nowDate(time)
{
    switch (time)
    {
        case 'oneMonth':
            var str = date.toLocaleDateString();
            var arr = str.split('/');
            if(arr[1] >=2)
            {
                arr[1]  = arr[1]-1;
            }
            else
            {
                arr[0] = arr[0]-1;
                arr[1] = '12';
            }

            var newStr = arr.join('-');
            return newStr;
            break;
        case 'thereMonth':
            var str = date.toLocaleDateString();
            var arr = str.split('/');
            if(arr[1] > 3)
            {
                arr[1]  = arr[1]-3;
            }
            else
            {
                arr[0] = arr[0]-1;
                if(arr[1] == 3)
                {
                    arr[1] = 12;
                }
                else if(arr[1] == 2)
                {
                    arr[1] == 11;
                }
                else if(arr[1] == 1)
                {
                    arr[1] == 10;
                }
            }

            var newStr = arr.join('-');
            return newStr;
            break;
        case 'oneYear':
            var str = date.toLocaleDateString();
            var arr = str.split('/');
            arr[0] = arr[0]-1;
            var newStr = arr.join('-');
            return newStr;
            break;
        case ' ':
            var newStr = ' ';
            return newStr;
            break;

    }
}
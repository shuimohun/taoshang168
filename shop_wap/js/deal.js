var type = getQueryString('type');
var status = getQueryString('status');
var start_date = getQueryString('start_date');
var end_date = getQueryString('end_date');
var time = getQueryString('time');
var nowTime = getQueryString('nowTime');
var date = new Date();
var firstRow = 0;
var totalRows = 0;
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
        url:PayCenterWapUrl+'/index.php?ctl=Info&met=App_recordlist&typ=json&type='+type+'&time='+time+'&status='+status+'&start_date='+start_date+'&end_date='+end_date,
        type:'post',
        dataType:'json',
        async:false,
        success:function(result)
        {
            console.log(result.data);
            if(result.status == 200)
            {
                var data = result.data;
                var listHtml = template.render('list',data);
                $('.item').html(listHtml);
                $('#thelist>li>div').attr('style',"background:url("+data.user_info.user_avatar+") no-repeat top left;background-size: 100% 100%;");
                if(data.consume_record_list.totalsize <= 10)
                {
                    totalRows = data.consume_record_list.totalsize;
                }
                else
                {
                    totalRows = data.consume_record_list.totalsize;
                    firstRow = data.consume_record_list.records;
                }
            }

            $('.item li').click(function(){
                $('.tanchuang').css('display','block');
                $('.bg_tanchuang').show();
                li = $(this);
            });



        }
    });
});

var myScroll,
    pullDownEl,
    pullDownOffset,
    pullUpEl,
    pullUpOffset;

/**
 * 下拉刷新 （自定义实现此方法）
 * myScroll.refresh();    // 数据加载完成后，调用界面更新方法
 */
function pullDownAction () {
    setTimeout(function () {  // <-- Simulate network congestion, remove setTimeout from production!
        window.location.href= WapSiteUrl+'/tmpl/member/deal.html?type='+type+'&time='+time+'&status='+status+'&start_date='+start_date+'&end_date='+end_date;
        myScroll.refresh();   //数据加载完成后，调用界面更新方法   Remember to refresh when contents are loaded (ie: on ajax completion)
    }, 1000); // <-- Simulate network congestion, remove setTimeout from production!
}

/**
 * 滚动翻页 （自定义实现此方法）
 * myScroll.refresh();    // 数据加载完成后，调用界面更新方法
 */
function pullUpAction () {
    setTimeout(function () {  // <-- Simulate network congestion, remove setTimeout from production!
        if(firstRow !== 0)
        {
            $.ajax({
                url:PayCenterWapUrl+'/index.php?ctl=Info&met=App_recordlist&typ=json&type='+type+'&time='+time+'&status='+status+'&start_date='+start_date+'&end_date='+end_date+'&firstRow='+firstRow+'&totalRows='+totalRows,
                type:'post',
                dataType:'json',
                async:false,
                success:function(result)
                {
                    console.log(result.data);
                    if(result.status == 200)
                    {
                        var data = result.data;
                        var items = data.consume_record_list.items;
                        var el, li, i, span, del, em, div,u,b;
                        el = document.getElementById('thelist');
                        for (i=0; i<items.length; i++) {
                            li = document.createElement('li');
                            span = document.createElement('span');
                            del = document.createElement('del');
                            em = document.createElement('em');
                            div = document.createElement('div');
                            u = document.createElement('u');
                            b = document.createElement('b');


                            li.appendChild(b,li.childNodes[0]);
                            b.innerText = items[i].record_time.substr(11);

                            li.appendChild(u,li.childNodes[0]);
                            u.innerText = items[i].record_date;

                            el.appendChild(li, el.childNodes[0]);

                            li.appendChild(div,li.childNodes[0]);

                            li.appendChild(span, li.childNodes[0]);
                            span.innerText = '￥'+items[i].record_money;

                            li.appendChild(del,li.childNodes[0]);
                            del.innerText = '来自订单'+items[i].order_id;

                            li.appendChild(em,li.childNodes[0]);
                            em.innerText = items[i].record_title+items[i].record_status_con;


                        }
                        $('#thelist>li>div').attr('style',"background:url("+data.user_info.user_avatar+") no-repeat top left;background-size: 100% 100%;");
                    }
                    firstRow += data.consume_record_list.records;
                }
            });
        }
        myScroll.refresh();   // 数据加载完成后，调用界面更新方法 Remember to refresh when contents are loaded (ie: on ajax completion)
    }, 1000); // <-- Simulate network congestion, remove setTimeout from production!
}


/**
 * 初始化iScroll控件
 */
function loaded() {
    pullDownEl = document.getElementById('pullDown');
    pullDownOffset = pullDownEl.offsetHeight;

    pullUpEl = document.getElementById('pullUp');
    pullUpOffset = pullUpEl.offsetHeight;

    myScroll = new iScroll('wrapper', {
        scrollbarClass: 'myScrollbar', /* 重要样式 */
        useTransition: false, /* 此属性不知用意，本人从true改为false */
        topOffset: pullDownOffset,
        onRefresh: function () {
            if (pullDownEl.className.match('loading')) {
                pullDownEl.className = '';
                pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新页面';
            } else if (pullUpEl.className.match('loading')) {
                pullUpEl.className = '';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多';
            }
        },
        onScrollMove: function () {
            if (this.y > 5 && !pullDownEl.className.match('flip')) {
                pullDownEl.className = 'flip';
                pullDownEl.querySelector('.pullDownLabel').innerHTML = '松手开始更新';
                this.minScrollY = 0;
            } else if (this.y < 5 && pullDownEl.className.match('flip')) {
                pullDownEl.className = '';
                pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新页面';
                this.minScrollY = -pullDownOffset;
            } else if (this.y < (this.maxScrollY - 5) && !pullUpEl.className.match('flip')) {
                pullUpEl.className = 'flip';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '松手开始更新';
                this.maxScrollY = this.maxScrollY;
            } else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
                pullUpEl.className = '';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多';
                this.maxScrollY = pullUpOffset;
            }
        },
        onScrollEnd: function () {
            if (pullDownEl.className.match('flip')) {
                pullDownEl.className = 'loading';
                pullDownEl.querySelector('.pullDownLabel').innerHTML = '加载中...';
                pullDownAction();	// Execute custom function (ajax call?)
            } else if (pullUpEl.className.match('flip')) {
                pullUpEl.className = 'loading';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';
                pullUpAction();	// Execute custom function (ajax call?)
            }
        }
    });

    setTimeout(function () { document.getElementById('wrapper').style.left = '0'; }, 800);
}

//初始化绑定iScroll控件
document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
document.addEventListener('DOMContentLoaded', loaded, false);

$('.leixing').on('click',"li[class='cur']",function(){
    var type = $(this).data('type');
    var status = $('.zhuangtai>.cur').data('status');
    var time = $('.shijian>.cur').data('time');
    var data = nowDate(time);
    window.location.href = WapSiteUrl+'/tmpl/member/deal.html?type='+type+'&status='+status+'&time='+data;
    return;
});

$('.zhuangtai').on('click',"li[class='cur']",function(){
    var status = $(this).data('status');
    var type = $('.leixing>.cur').data('type');
    var time = $('.shijian>.cur').data('time');
    var data = nowDate(time);
    window.location.href = WapSiteUrl+'/tmpl/member/deal.html?type='+type+'&status='+status+'&time='+data;
    return;
});

$('.shijian').on('click',"li[class='cur']",function(){
    var type = $('.leixing>.cur').data('type');
    var status = $('.zhuangtai>.cur').data('status');
    var time = $(this).data('time');
    var data = nowDate(time);
    window.location.href = WapSiteUrl+'/tmpl/member/deal.html?type='+type+'&status='+status+'&time='+data+'&nowTime='+time;
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
    window.location.href = WapSiteUrl+'/tmpl/member/deal.html?start_date='+start+'&end_date='+end;
    return;
});

$('.ensure').click(function(){
    var id = li.data('order');
    $.post(PayCenterWapUrl+'/index.php?ctl=Info&met=delRecordlist&typ=json',{id:id},function(data){
        if(data.status == 200)
        {
            alert('删除成功!');
            window.location.href = WapSiteUrl+'/tmpl/member/recycle.html';
            return;
        }
        else
        {
            alert('删除失败!');
            window.location.href = WapSiteUrl+'/tmpl/member/record.html';
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



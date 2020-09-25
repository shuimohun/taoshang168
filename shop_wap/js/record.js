var firstRow = 0;
var totalRows = 0;
var type = getQueryString('type');
$(function(){
    var e = getCookie("key");
    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }
    switch (type){
        case '3':
            $('.zuijin>.cur').attr('class',' ');
            $(".zuijin>li[data-type='3']").attr('class','cur');
            break;
        case '2':
            $('.zuijin>.cur').attr('class',' ');
            $(".zuijin>li[data-type='2']").attr('class','cur');
            break;
        case '4':
            $('.zuijin>.cur').attr('class',' ');
            $(".zuijin>li[data-type='4']").attr('class','cur');
            break;
    }

    $.ajax({
        url:PayCenterWapUrl+'/index.php?ctl=Info&met=App_recordlist&typ=json&type='+type,
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
                $('#thelist').html(listHtml);
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
        }
    });
});

$('.zuijin').on('click',"li[class='cur']",function(){
     type = $(this).data('type');
    window.location.href = WapSiteUrl+'/tmpl/member/record.html?type='+type;
    return;
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
        window.location.href= WapSiteUrl+'/tmpl/member/record.html?type='+type;
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
                url:PayCenterWapUrl+'/index.php?ctl=Info&met=App_recordlist&typ=json&type='+type+'&firstRow='+firstRow+'&totalRows='+totalRows,
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
document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);



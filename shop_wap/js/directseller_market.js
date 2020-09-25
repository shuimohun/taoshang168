var page = 1;
var hasMore = true;
function top_list() {
    $.getJSON(ApiUrl + "?ctl=Distribution_Buyer_Goods&met=directsellerclass&typ=json",function (e) {
        if(e.status == 200) {
            var r = template.render("one", e);
            $(".find_nav_list").html(r);
            cat_id = e.data[0].cat_id;
            act = '';
            list();
            $('.find_nav_list ul li').eq(0).addClass('find_nav_cur');
            $('.find_nav_list ul li').on('click',function(){
                cat_id = $(this).attr('data-id');
                $('.item').remove();
                page = 1;
                list();
                $(this).addClass('find_nav_cur').siblings().removeClass('find_nav_cur');
                $li_no = $('.goodlist').index(this) -1;
                if($li_no == 0){
                    $(this).parent().attr('style','left: 0px');
                }
                $li_w = $(this).width();
                $left = -parseInt($li_no * $li_w);
                if($left<0 || $left>  parseInt($no*$li_w)) {
                    $(this).parent().attr('style', 'left:' + $left + 'px');
                }
            });
        }
    });
}

top_list();

function list() {
    $.post(ApiUrl + "?ctl=Distribution_Buyer_Goods&met=newdirectsellerGoods&typ=json&page="+page,{cat_pid:cat_id,act:act},function (e) {
        if(e.status == 200) {
            var r = template.render("two", e.data);
            if (e.data.page < e.data.total) {
                hasMore = true;
                page++;
                $('#goodslist').append(r);
            }

        }
    })
}


$(window).scroll(function() {
    if(hasMore){
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
            list()
        }
    }
});
$('.shaixuan li').click(function () {
    page = 1;
    $('.item').remove();
    text = $(this).text();
    if(text == '销量'){
        act = 'sales';
        list();
    }
    if(text == '佣金'){
        act = 'commission';
        list();
    }
    if(text == '上新'){
        act = 'uptime';
        list();
    }
});

$('.shaixuan ul li').on('click',function(){
    $(this).addClass('cur').siblings().removeClass('cur');
});


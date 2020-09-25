$(document).ready(function(){

    $('#bundling_add_goods').click(function(){
        $('.search-goods-list-bd').load('?ctl=Seller_Promotion_Bundling&met=getShopGoods&typ=e');
        $(this).hide();
        $('.search-goods-list').show();
    });

    $('#btn_hide_goods_select').click(function(){
        $('#bundling_add_goods').show();
        $('.search-goods-list').hide();
    });

    $('.btn_search_goods').click(function(){
        var url = SITE_URL + '?ctl=Seller_Promotion_Bundling&met=getShopGoods&typ=e';
        var key = $('#search_goods_name').val();
        $('.search-goods-list-bd').load(url,"&goods_name=" + key);
    });

    $('.search-goods-list-bd').on('click', '.page a', function() {
        $('.search-goods-list-bd').load($(this).attr('href'));
        return false;
    });

    $('.search-goods-list-bd').on('click', 'a.demo', function() {
        $('.search-goods-list-bd').load($(this).attr('href'));
        return false;
    });

    // 退拽效果
    $('tbody[nctype="bundling_data"]').sortable({ items: 'tr' });
    $('#goods_images').sortable({ items: 'li' });

});

function check_bundling_data_length(){
    if ($('tbody[nctype="bundling_data"] tr').length == 1) {
        $('tbody[nctype="bundling_data"]').children(':first').show();
    }
}

$('input[name="bundling_freight_choose"]').click(function(){
    if($(this).val() == '0'){
        $('#whops_buyer_box').show();
    }else{
        $('#whops_buyer_box').hide();
    }
});

$('input[name="is_limit"]').click(function(){
    if($(this).val() == '1'){
        $('#buy_limit').show();
    }else{
        $('#buy_limit').hide();
    }
});

$('tbody[nctype="bundling_data"]').on('change', 'input[nctype="price"]', function(){
    if(Number($(this).val()) > 0){
        share_sum_price = $(this).parent().siblings('.share_sum_price').html();
        //shared_price = $(this).parent().siblings('.shared_price').html();

        if(Number($(this).val()) <= Number(share_sum_price)){
            Public.tips.warning('套餐商品价格必须大于其分享优惠价')
        }else{
            count_price_sum();
        }
    }else{
        $('#bundling_price').val('');
    }
});


/* 计算商品原价 */
function count_cost_price_sum(){
    data_price = $('td[nctype="bundling_data_price"]');
    if(typeof(data_price) != 'undefined'){
        var S_price = 0;
        data_price.each(function(){
            S_price += parseFloat($(this).html());
        });
        $('span[nctype="cost_price"]').html(S_price.toFixed(2));
    }else{
        $('span[nctype="cost_price"]').html('');
    }
}

/* 计算商品售价 */
function count_price_sum(){
    $('#bundling_price').val('');
    data_price = $('input[nctype="price"]');
    if(typeof(data_price) != 'undefined'){
        var S_price = 0;
        data_price.each(function(){
            S_price += parseFloat($(this).val());
        });
        $('#bundling_price').val(S_price.toFixed(2));
    }
}

/* 删除商品 */
function bundling_operate_delete(o, id){
    o.remove();
    check_bundling_data_length();
    $('li[nctype="'+id+'"]').children(':last').html('<div class="button button_green" onclick="bundling_goods_add($(this))" > <i class="iconfont icon-jia"></i>选择商品</div>');
    count_cost_price_sum();
}

check_bundling_data_length();
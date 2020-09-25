var key = getCookie('key');
var id = getQueryString('id');
var storagenum = '';
var limitnum   = '';
var addr  = '';
$(function()
{
    if(!key)
    {
        window.locaiton.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }

    if(!id)
    {
        window.location.href = WapSiteUrl;
        return;
    }

    $.ajax({
        url:ApiUrl+'?ctl=Points&met=detail&typ=json',
        data:{id:id},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                console.log(data);
                $('.goods_img>img').attr('src',data.goods_detail.points_goods_image);
                $('.goods_txt').html(data.goods_detail.points_goods_name);
                $('.goods_eggs>span').html(data.goods_detail.points_goods_points+'&nbsp;金蛋');
                $('.goods_eggs>del').html('￥&nbsp;'+data.goods_detail.points_goods_price);
                $('.wrap').html(data.goods_detail.points_goods_body);

                storagenum = data.goods_detail.points_goods_storage;
                limitnum  = data.goods_detail.points_goods_limitnum;

                $.post(ApiUrl+'?ctl=Buyer_User&met=address&typ=json',function(da){
                    var dat = da.data;
                    console.log(dat);
                    var addHtml = template.render('address',dat);
                    $('.input_wrap').html(addHtml);
                    addr = $('.input_wrap').val();
                })
            }
        }
    });
});

$('.input_wrap').change(function()
{
  addr = $(this).val();
});



function add_cart()
{
    var points_goods_id = id;
    var quantity = parseInt($(".number").val());//兑换数量
    //验证数量是否合法
    var checkresult = true;
    var msg = '';
    if(!quantity >=1 ){//如果兑换数量小于1则重新设置兑换数量为1
        quantity = 1;
    }
    if(limitnum > 0 && quantity > limitnum){
        checkresult = false;
        msg = '兑换数量不能大于限兑数量';
    }
    if(storagenum > 0 && quantity > storagenum){
        checkresult = false;
        msg = '兑换数量不能大于剩余数量';
    }
    if(checkresult == false)
    {
        alert(msg);
        return false;
    }
    else
    {
        var param = {};
        param.points_goods_id = points_goods_id;
        param.quantity = quantity;

        $.ajax({
            url: ApiUrl+"?ctl=Points&met=addPointsCart&typ=json",
            data:param,
            type: "POST",
            success:function(e){
                if(e.status == 200)
                {
                    add_order(e.data.points_cart_id);
                }
                else
                {
                    alert(e.msg);
                    return false;
                }
            }
        });
    }
}


function add_order(points_cart_id)
{
    //1.获取收货地址
    var ad = addr.split(',');
    address_contact = ad[0];
    address_address = ad[1];
    address_phone   = ad[2];


    var point_cart_id =[points_cart_id];//定义一个数组

    $.ajax({
        type:'POST',
        url: ApiUrl+'?ctl=Points&met=addPointsOrder&typ=json',
        data:{receiver_name:address_contact,receiver_address:address_address,receiver_phone:address_phone,point_cart_id:point_cart_id},
        dataType: "json",
        contentType: "application/json;charset=utf-8",
        async:false,
        success:function(a){
            if(a.status == 200)
            {
               alert('订单提交成功');
                window.location.href = WapSiteUrl+'/tmpl/gold_good_exchange.html';
            }
            else if(a.status == 260)
            {
                alert('金蛋不足');
            }
            else
            {
                alert('订单提交失败');

            }
        },
        failure:function(a)
        {
            alert('操作失败');
        }
    });

}

$('.duihuan').click(function()
{
    add_cart();
});
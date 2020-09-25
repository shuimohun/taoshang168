function initField()
{
    $.get('./index.php?ctl=Main&met=getMainInfo&typ=json',function(a){
        if(a.status==200)
        {
            var b= a.data;
			$('#statistics_member').html(b.member_count);
            $('#statistics_day_add_member').html(b.day_member);
			$('#statistics_week_add_member').html(b.week_member);
			$('#statistics_month_add_member').html(b.month_member);

			//商品
			$('#statistics_goods').html(b.goods_num);
            $('#statistics_goods_sta').html(b.goods_num_sta);
			$('#statistics_week_add_product').html(b.week_goods_num);
            $('#statistics_week_add_products').html(b.week_goods_nums);
			$('#statistics_product_verify').html(b.verify_goods_num);
			$('#statistics_inform_list').html(b.report_num);
			$('#statistics_brand_apply').html(b.goods_brands_num);
			
			//店铺
			$('#statistics_store').html(b.shop_nums);
            $('#statistics_store_joinin_shop').html(b.week_member_shop);
			$('#statistics_store_joinin').html(b.verify_shop_nums);
			$('#statistics_store_bind_class_applay').html(b.shop_class_nums);
			$('#statistics_store_reopen_applay').html(b.renewal_nums);
			$('#statistics_store_expired').html(b.shop_expired_nums);
			$('#statistics_store_expire').html(b.shop_expire_nums);
			
			//交易
			$('#statistics_order').html(b.order_nums);
			$('#statistics_refund').html(b.physical_return_nums);
			$('#statistics_return').html(b.physical_return_goods_nums);
            $('#statistics_vr_order').html(b.order_status_count);
			$('#statistics_refund_recheck').html(b.physical_return_recheck_nums);
			$('#statistics_return_recheck').html(b.physical_return_goods_recheck_nums);
			$('#statistics_complain_new_list').html(b.complain_nums);
			$('#statistics_complain_handle_list').html(b.handle_nums);

			//运营
			$('#statistics_points_order').html(b.settlement_count);
			$('#statistics_pay_billno').html(b.custom_count);
			$('#statistics_delivery_point').html(b.contractLog_count);
        }
    });
}

initField();
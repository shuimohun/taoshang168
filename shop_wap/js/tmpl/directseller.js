$(function(){
   var e = getCookie("key");
    if (!e) {
        window.location.href = WapSiteUrl + "/tmpl/member/login.html"
    }
 
    $.ajax({
        type:'post',
        url:ApiUrl+"/?ctl=Distribution_Buyer_Directseller&met=wapIndex&typ=json",
        data:{k:e,u:getCookie('id')},
        dataType:'json',
        success:function(result){
            checkLogin(result.login);
			if(result.data.user_directseller_shop){
				var shop_name = result.data.user_directseller_shop;
				if(!result.data.directseller)
					var shop_url = 'directseller_apply.html';
				else
					var shop_url = 'directseller_store.html?uid='+result.data.user_id;				
			}else{
				var shop_name = '尚未设置';
				var shop_url = 'directseller_shop.html';
			}
            var html = '<div class="member-info">'
                    + '<div class="user-avatar"> <img src="' + result.data.user_logo + '"/> </div>'
                    + '<div class="user-name"> <span>'+result.data.user_name+'<sup>V' + result.data.user_grade + '</sup></span> </div>'
                    + '</div>'+'<div class="member-collect"><span><a href="'+shop_url+'"><em>' +shop_name+ '</em>'
               // + '<p>确认收货7天以后到账</p>'
                + '</a> </span></div>';
            //渲染页面
            
            $(".member-top").html(html);
            
            var html = '<li><a class="br" href="directseller_order.html">'+'<p class="number">'+result.data.promotion_order_nums+'</p><p>推广订单</p></a></li>'
				+ '<li><a href="directseller_order.html?status=finish">'+'<p class="number">'+result.data.finish_nums+'</p><p>完成订单</p></a></li>'
                + '<li><a class="br" href="directseller_invitelist.html">'+ '<p class="number">'+result.data.invitors+'</p><p>累计邀请</p></a></li>'
                + '<li><a href="directseller_invitelist.html?act=month">'+ '<p class="number">'+result.data.month_invitors+'</p><p>本月新增邀请</p></a></li>'
				+ '<li><a class="br" href="directseller_goods.html">'+'<p class="number">'+result.data.goods_num+'</p><p>推广商品</p></a></li>'
                + '<li><a href="directseller_commission.html">'+ '<p class="number">'+result.data.user_directseller_commission+'</p><p>结算佣金</p></a></li>';
            //渲染页面
            
            $("#order_ul").html(html);
            

            return false;
        }
    });
	
	//滚动header固定到顶部
	$.scrollTransparent();
 
});
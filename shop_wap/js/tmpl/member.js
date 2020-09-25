$(function(){
    ucenterLogin();
});
$(function(){
    if (getQueryString('key') != '') {
        var key = getQueryString('key');
        var username = getQueryString('username');
        addCookie('key', key);
        addCookie('username', username);
        updateCookieCart(key);
    } else {
        var key = getCookie('key');
    }

	if(key){
        $.ajax({
            type:'post',
            url:ApiUrl+"/index.php?ctl=Buyer_User&met=getUserInfo&typ=json",
            data:{k:key,u:getCookie('id')},
            dataType:'json',
            //jsonp:'callback',
            success:function(result){
                checkLogin(result.login);

                var html = '<div class="member-info">'
                    + '<div class="user-avatar"> <img src="' + result.data.user_logo + '"/> </div>'
                    + '<div class="user-name"> <span>'+result.data.user_name+'<sup>V' + result.data.user_grade + '</sup></span> </div>'
                    + '</div>'
                    + '<div class="member-collect"><span><a href="favorites.html"><em>' + result.data.favorites_goods_num + '</em>'
                    + '<p>商品收藏</p>'
                    + '</a> </span><span><a href="favorites_store.html"><em>' +result.data.favorites_shop_num + '</em>'
                    + '<p>店铺收藏</p>'
                    + '</a> </span><span><a href="views_list.html"><i class="goods-browse"></i>'
                    + '<p>我的足迹</p>'
                    + '</a> </span><span><a href="signin.html"><i class="goods-sign"></i>'
                    + '<p>签到</p>'
                    + '</a> </span></div>';
                //渲染页面
                
                $(".member-top").html(html);
                
                var html = '<li><a href="order_list.html?data-state=wait_pay">'+ (result.data.order_nopay_count > 0 ? '<em></em>' : '') +'<i class="cc-01"></i><p>待付款</p></a></li>'
                    + '<li><a href="order_list.html?data-state=order_payed">' + (result.data.order_notakes_count > 0 ? '<em></em>' : '') + '<i class="cc-02"></i><p>已付款</p></a></li>'
                    + '<li><a href="order_list.html?data-state=wait_confirm_goods">' + (result.data.order_noreceipt_count > 0 ? '<em></em>' : '') + '<i class="cc-03"></i><p>待收货</p></a></li>'
                    + '<li><a href="order_list.html?data-state=finish">' + (result.data.order_noeval_count > 0 ? '<em></em>' : '') + '<i class="cc-04"></i><p>待评价</p></a></li>'
                    + '<li><a href="member_refund.html">' + (result.data.return > 0 ? '<em></em>' : '') + '<i class="cc-05"></i><p>退款/退货</p></a></li>';
                //渲染页面
                
                $("#order_ul").html(html);


				
				if(result.data.directseller_is_open)
				{
					var html = '<dl class="mt5">'+
								'<dt>'+
									'<a id="distribution" href="directseller.html">'+
										'<h3><i class="mc-dis"></i>淘金中心</h3>'+
										'<h5><i class="arrow-r"></i></h5>'+
									'</a>'+
								'</dt>'+
					'</dl>';
					$(".member-center").append(html);
				}
				
				if(result.data.shop_type == 1)
				{
					var html = '<dl class="mt5">'+
								'<dt>'+
									'<a id="distribution" href="distlog.html">'+
										'<h3><i class="mc-distlog"></i>淘金明细</h3>'+
										'<h5><i class="arrow-r"></i></h5>'+
									'</a>'+
								'</dt>'+
					'</dl>';
					$(".member-center").append(html);
				}
				
                return false;
            }
        });
	} else {
	    var html = '<div class="member-info">'
	        + '<a class="default-avatar logbtn" href="javascript:void(0);" style="display:block;"></a>'
	        + '<a class="to-login logbtn" href="javascript:void(0);">点击登录</a>'
	        + '</div>'
	        + '<div class="member-collect"><span><a class="logbtn" href="javascript:void(0);"><em>0</em>'
	        + '<p>商品收藏</p>'
	        + '</a> </span><span><a class="logbtn" href="javascript:void(0);"><em>0</em>'
	        + '<p>店铺收藏</p>'
	        + '</a> </span><span><a class="logbtn" href="javascript:void(0);"><i class="goods-browse"></i>'
	        + '<p>我的足迹</p>'
            + '</a> </span><span><a class="logbtn" href="javascript:void(0);"><i class="goods-sign"></i>'
            + '<p>签到</p>'
	        + '</a> </span></div>';
	    //渲染页面
	    $(".member-top").html(html);
	    
        var html = '<li><a class="logbtn"><i class="cc-01"></i><p>待付款</p></a></li>'
        + '<li><a class="logbtn"><i class="cc-02"></i><p>待收货</p></a></li>'
        + '<li><a class="logbtn"><i class="cc-03"></i><p>待自提</p></a></li>'
        + '<li><a class="logbtn"><i class="cc-04"></i><p>待评价</p></a></li>'
        + '<li><a class="logbtn"><i class="cc-05"></i><p>退款/退货</p></a></li>';
        //渲染页面
        $("#order_ul").html(html);
        return false;
	}

	  //滚动header固定到顶部
	  $.scrollTransparent();


      $("#paycenter").click(function(){
          $.post(PayCenterApiUrl+'?ctl=Info&met=App_index&typ=json',function(result){
              if(result.status == 250)
              {
                  $.post(UCenterApiUrl+'?ctl=login&met=mobilePaycenterLogin&typ=json',function(data){
                      if(data.status == 200)
                      {
                          var cb = encodeURIComponent(WapSiteUrl+'/tmpl/member/money_index.html');
                          window.location.href = data.data.url + cb;
                          return;
                      }
                  });
              }
              else if(result.status == 200)
              {
                  window.location.href = WapSiteUrl+'/tmpl/member/money_index.html';
                  return;
              }
          });
      });
});
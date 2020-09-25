var shop_owner;
var isBuyHave;
$(function(){
	$.get(ApiUrl+'?ctl=Activity&met=opening&typ=json',function(r){
		if(r.status == 200){
			var data = r.data;
			var cont = template.render('content_item',data);
			$('.content_item').html(cont);

			if(r.data.opening_title){
                $('title').html(title + '-' +r.data.opening_title)
            }

			if(data.start_xianshi == 'xianshi1')
			{
                $('.tab').eq(0).show();
			}
			else if(data.start_xianshi == 'xianshi2')
			{
                $('.timeFrame').children().siblings().removeClass('cur');
				$('.timeFrame').children().eq(1).addClass('cur');
				$('.tab').eq(1).show();
			}
			else if(data.start_xianshi == 'xianshi3')
			{
                $('.timeFrame').children().siblings().removeClass('cur');
                $('.timeFrame').children().eq(1).addClass('cur');
				$('.tab').eq(2).show();
			}
			else
			{
				$('.tab').eq(0).show();
			}
            $('.timeFrame li').on('click',function(){
                Toggle($(this));
                var index = $(this).index();
                $('.tab').hide();
                $('.tab').eq(index).show();
            });

			swiper();

            $('.addCard').on('click',function(){
                var goods_id = $(this).data('id');
                addCard(goods_id);
            });
            if(data.opening.dizhi.wap_tit_image){
                $('.cheap9-9Main').css('background',"url("+data.opening.dizhi.wap_tit_image+")");
                $('.cheap9-9Main').css('background-size',"100% 100%");
            }
            if(data.opening.banjia.wap_tit_image){
                $('.halfFare .halfFareTitle').css('background',"url("+data.opening.banjia.wap_tit_image+")");
                $('.halfFare .halfFareTitle').css('background-size',"100% 100%");
            }
            if(data.opening.remai.wap_tit_image){
                $('.hotSale .hotSaleTitle').css('background',"url("+data.opening.remai.wap_tit_image+")");
                $('.hotSale .hotSaleTitle').css('background-size',"100% 100%");
            }
            if(data.opening.jinxi.wap_tit_image){
                $('.specialSale .specialSaleMain').css('background',"url("+data.opening.jinxi.wap_tit_image+")");
                $('.specialSale .specialSaleMain').css('background-size',"100% 100%");
            }
            if(data.opening.fengkuang.wap_tit_image){
                $('.sweepGoods .sweepGoodsTitle').css('background',"url("+data.opening.fengkuang.wap_tit_image+")");
                $('.sweepGoods .sweepGoodsTitle').css('background-size',"100% 100%");
            }
            if(data.opening.shiyong.wap_tit_image){
                $('.practicalGoods .practicalGoodsTitle').css('background',"url("+data.opening.shiyong.wap_tit_image+")");
                $('.practicalGoods .practicalGoodsTitle').css('background-size',"100% 100%");
            }
            if(data.opening.manjian.wap_tit_image){
                $('.moneyOff .moneyOffTitle').css('background',"url("+data.opening.manjian.wap_tit_image+")");
                $('.moneyOff .moneyOffTitle').css('background-size',"100% 100%");
            }
        }
	});



	function Toggle(item){
		item.addClass('cur').siblings().removeClass('cur');
	}

	function swiper(){
		var swiper = new Swiper('.swiper-container');
	}

	function addCard(e){
        //设置key
        var key = getCookie('key');//登录标记
		$.ajax({
			url:ApiUrl+"?ctl=Goods_Goods&met=goods&typ=json",
            type:"get",
            data:{goods_id:e,k:key,u:getCookie('id')},
            dataType:"json",
			success:function(r){
				if(r.status == 200){
					var data = r.data;
                    isBuyHave         = data.isBuyHave;
                    shop_owner        = data.shop_owner;
                    //固定数量1
                    var quantity = 1;
                    if(!key){
                        var goods_info = decodeURIComponent(getCookie('goods_cart'));
                        if (goods_info == null) {
                            goods_info = '';
                        }
                        if(e<1){
                            alert('参数错误');
                            return false;
                        }
                        var cart_count = 0;
                        if(!goods_info){
                            goods_info = e+','+quantity;
                            cart_count = 1;
                        }else{
                            var goodsarr = goods_info.split('|');
                            for (var i=0; i<goodsarr.length; i++) {
                                var arr = goodsarr[i].split(',');
                                if(contains(arr,e)){
                                    alert('参数错误');
                                    return false;
                                }
                            }
                            goods_info+='|'+e+','+quantity;
                            cart_count = goodsarr.length;
                        }
                        // 加入cookie
                        addCookie('goods_cart',goods_info);
                        // 更新cookie中商品数量
                        addCookie('cart_count',cart_count);
                        getCartCount();
                        alert('添加成功');
                        return false;
					}else{
                        if(shop_owner)
                        {
                            alert('不能购买自己商店的商品！');
                            return;
                        }
                        if(isBuyHave)
                        {
                            alert('您已达购买上限！');
                            return;
                        }

                        $.ajax({
                            url:ApiUrl+"?ctl=Buyer_Cart&met=addCart&typ=json",
                            data:{k:key,u:getCookie('id'),goods_id:e,goods_num:quantity},
                            type:"post",
                            success:function (result){
                                if(checkLogin(result.login)){
                                    if(result.status == 200){
                                        // 更新购物车中商品数量
                                        delCookie('cart_count');
                                        getCartCount();
                                        alert('添加成功');
                                    }else{
                                        alert('添加失败');
                                    }
                                }
                            }
                        })
                    }
				}
			}
		});
	}

});
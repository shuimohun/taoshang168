/**
 * @author     Str
 */
$(document).ready(function(){

	//隐藏订单
	window.hideOrder = function (e)
	{
		$.dialog({
			title: '删除订单',
			content: '您确定要删除吗？删除后的订单可在回收站找回，或彻底删除! ',
			height: 100,
			width: 405,
			lock: true,
			drag: false,
			ok: function () {
				$.post(SITE_URL  + '?ctl=Seller_Trade_Order&met=hideOrder&typ=json',{order_id:e,user:'seller'},function(data)
				{
					if(data && 200 == data.status) {
						Public.tips.success('删除成功！');
						//window.location.reload();
                        $('#'+e).hide('slow');
					} else {
						Public.tips.error('删除失败！');
						//window.location.reload();
					}
				})
			}
		})

	}

    //取消退款
    window.canOrder = function (e)
    {
        $.dialog({
            title: '取消退款',
            content: '您确定要取消退款吗？！ ',
            height: 100,
            width: 405,
            lock: true,
            drag: false,
            ok: function () {

                $.post(SITE_URL  + '?ctl=Buyer_Order&met=cancel&typ=json',{order_id:e},function(data)
                {
                    if(data && 200 == data.status) {
                        Public.tips.success('删除成功！');
                        // window.location.reload();
                    } else {
                        Public.tips.error('删除失败！');
                        // window.location.reload();
                    }
                })
            }
        })

    }


    //退款不能退货提示
    window.canOrders = function (e)
    {
        $.dialog({
            title: '退货',
            content: '您正在退款中，不能进行退货 ',
            height: 100,
            width: 405,
            lock: true,
            drag: false,
            ok: function () {
            }
        })

    }

    //退款不能退货提示
    window.canOrderz = function (e)
    {
        $.dialog({
            title: '退货',
            content: '您已退款，不能进行退货 ',
            height: 100,
            width: 405,
            lock: true,
            drag: false,
            ok: function () {
            }
        })

    }

    //退h货不能退款提示
    window.canOrderh = function (e)
    {
        $.dialog({
            title: '退款',
            content: '您正在退货中，不能进行退款',
            height: 100,
            width: 405,
            lock: true,
            drag: false,
            ok: function () {
            }
        })

    }


    //退h货不能退款提示
    window.canOrdert = function (e)
    {
        $.dialog({
            title: '退款',
            content: '您已退货，不能进行退款',
            height: 100,
            width: 405,
            lock: true,
            drag: false,
            ok: function () {
            }
        })

    }

    //永久删除订单
	window.delOrder = function (e)
	{
		$.dialog({
			title: '删除订单',
			content: '您确定要永久删除吗？永久删除后您将无法再查看该订单，也无法进行投诉维权，请谨慎操作！',
			height: 100,
			width: 610,
			lock: true,
			drag: false,
			ok: function () {
				$.post(SITE_URL  + '?ctl=Seller_Trade_Order&met=hideOrder&typ=json',{order_id:e,user:'seller',op:'del'},function(data)
					{
						if(data && 200 == data.status) {
							Public.tips.success('删除成功！');
							//window.location.reload();
                            $('#'+e).hide('slow');
						} else {
							Public.tips.error('删除失败！');
							//window.location.reload();
						}
					}
				);
			}
		})
	}
	//还原订单
	window.restoreOrder = function (e)
	{
		$.dialog({
			title: '还原删除订单',
			content: '您确定要还原吗？',
			height: 100,
			width: 400,
			lock: true,
			drag: false,
			ok: function () {
				$.post(SITE_URL  + '?ctl=Seller_Trade_Order&met=restoreOrder&typ=json',{order_id:e,user:'seller'},function(data)
					{
						if(data && 200 == data.status) {
							Public.tips.success('还原成功！');
							//window.location.reload();
                            $('#'+e).hide('slow');
						} else {
							Public.tips.error('还原失败！');
							//window.location.reload();
						}
					}
				);
			}
		})
	}

})
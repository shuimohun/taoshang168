$(function () {

    /**获取用户参加活动商品*/
    function getSendBlessDetail() {
        var key = getCookie("key");
        if( !key )
        {

            var callback = window.location.href;
            console.log( callback);
            var loginUrl = UCenterApiUrl + '?ctl=Login&met=index&typ=e';
            var login_url = loginUrl + '&from=wap&callback=' + encodeURIComponent(callback)+"?";
            window.location.href = login_url;
            return false;
        }
        $.ajax({
            type: 'POST',
            url: ApiUrl + '?ctl=Goods_GoodsFu&met=getSendBlessDetail&typ=json',
            dataType: 'json',
            data:{},
            async: false,
            success: function(e) {

                if( e.status ==200 )
                {
                    for( var i in e.data )
                    {
                        if( e.data[i].status == 3 || e.data[i].status == 1 )
                        {
                            e.data[i].HjPrice = e.data[i].unit_price * e.data[i].click_count;
                            e.data[i].HjPrice = e.data[i].HjPrice.toFixed(2);
                        }
                        e.data[i].unitSqq               = e.data[i].fu.fu_price * e.data[i].fu_base.sqq;
                        e.data[i].unitWeiXin            = e.data[i].fu.fu_price * e.data[i].fu_base.weixin;
                        e.data[i].unitweiXin_timeLine   = e.data[i].fu.fu_price * e.data[i].fu_base.weixin_timeline;
                        e.data[i].unitQzone             = e.data[i].fu.fu_price * e.data[i].fu_base.qzone;
                        e.data[i].unitTsina             = e.data[i].fu.fu_price * e.data[i].fu_base.tsina;
                        // console.log( typeof e.data[i].unitSqq)
                        e.data[i].unitSqq               = e.data[i].unitSqq.toFixed(2)
                        e.data[i].unitWeiXin            = e.data[i].unitWeiXin.toFixed(2)
                        e.data[i].unitweiXin_timeLine   = e.data[i].unitweiXin_timeLine.toFixed(2)
                        e.data[i].unitQzone             = e.data[i].unitQzone.toFixed(2)
                        e.data[i].unitTsina             = e.data[i].unitTsina.toFixed(2)
                    }

                    var sendBless_detail  = template.render("sendBless_detail",e);
                    $(".sendBless_detail").html(sendBless_detail);
                }

                //时间倒计时
                var _TimeCountDown = $(".fnTimeCountDown");
                _TimeCountDown.fnTimeCountDown();

            }
        })
    }
    getSendBlessDetail()
})
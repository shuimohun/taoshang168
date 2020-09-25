$(function() {

    //热门礼品兑换
    // $.ajax({
    //     url: ApiUrl + "?ctl=Points&met=pList&typ=json",
    //     type: 'get',
    //     dataType: 'json',
    //     success: function(data) {
    //         if ( data.status == 200 ) {
    //             var data = data.data;
    //             for (var i in data['points_goods']['items']) {
    //                 data['points_goods']['items'][i].detailUrl = SiteUrl + "/index.php?ctl=Points&met=detail&id=" + data['points_goods']['items'][i].id;
    //             }
    //             var goodsHtml = template.render("goods", data);
    //             $(".item-goods").append(goodsHtml);
    //         } else {
    //             $.sDialog({skin: "red", content: "网络异常", okBtn: false, cancelBtn: false});
    //         }
    //     }
    // });

    //热门金蛋兑换
    // $.ajax({
    //     url: ApiUrl + "?ctl=Voucher&met=vList&typ=json",
    //     type: 'get',
    //     dataType: 'json',
    //     success: function(data) {
    //         if ( data.status == 200 ) {
    //             var data = data.data;
    //             var integralHtml = template.render("integral", data);
    //             $(".integral-area").append(integralHtml);
    //         } else {
    //             $.sDialog({skin: "red", content: "网络异常", okBtn: false, cancelBtn: false});
    //         }
    //     }
    // });

    var param = {
        k: getCookie("key"),
        u: getCookie("id")
    };

    $.ajax({
        url: ApiUrl + "?ctl=Points&met=index&typ=json",
        type: 'get',
        dataType: 'json',
        data: param,
        success: function(data) {
            if ( data.status == 200 ) {console.info(data);
                var data = data.data;

                for (var i in data['points_goods']['items']) {
                    data['points_goods']['items'][i].detailUrl = SiteUrl + "/index.php?ctl=Points&met=detail&id=" + data['points_goods']['items'][i].id;
                }

                var goodsHtml = template.render("goods", data);
                $(".item-goods").append(goodsHtml);

                var integralHtml = template.render("integral", data);
                $(".integral-area").append(integralHtml);

                if (data.user_info) {
                    $(".integral-types").remove();
                    var userHtml = template.render("user", data);
                    $(".integral-ban").after(userHtml);
                }

                if(data.promotiom_img)
                {
                    $("#promotiom_img").attr('src',data.promotiom_img);
                }else
                {
                    $("#promotiom_img").attr('src','../images/ban.png');
                }
            } else {
                $.sDialog({skin: "red", content: "网络异常", okBtn: false, cancelBtn: false});
            }
        }
    });

    $(".integral-area").on('click', "a[nctype='exchange_integrate']", function() {

        var v_id = $(this).data("vid");
        $.ajax({
            url: ApiUrl + "?ctl=Voucher&met=getVoucherById&typ=json",
            data: {vid: v_id},
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if ( data.status == 200 ) {
                    var data = data.data, voucher_t_eachlimit = data.voucher_t_eachlimit;
                    var params = {
                        vid: v_id,
                        k: getCookie("key"),
                        u: getCookie("id")
                    };
                    $.sDialog({ skin: "red",
                                content: "每个ID限领" + voucher_t_eachlimit + "张",
                                okBtn: true,
                                cancelBtn: true,
                                okFn: function () {
                                    $.ajax({
                                        url: ApiUrl + "?ctl=Voucher&met=receiveVoucher&typ=json",
                                        data: params,
                                        type: 'post',
                                        dataType: 'json',
                                        success: function (data) {
                                            $.sDialog({
                                                skin: "red",
                                                content: data.msg,
                                                okBtn: false,
                                                cancelBtn: false
                                            });

                                        }
                                    })
                                }
                    });
                    var integralHtml = template.render("integral", data);
                    $(".integral-area").append(integralHtml);
                } else {
                    $.sDialog({skin: "red", content: "网络异常", okBtn: false, cancelBtn: false});
                }
            }
        });
    });

    $(".integral-login").click(function(){

        callback = WapSiteUrl + '/tmpl/member/member.html';

        login_url   = UCenterApiUrl + '?ctl=Login&met=index&typ=e';


        callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);


        login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);

        window.location.href = login_url;
    });

});


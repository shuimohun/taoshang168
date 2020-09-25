$(function () {
    var k = getCookie("key");
    var u = getCookie("id");

    var oid = getQueryString("oid");
    var ogid = getQueryString("ogid");
    var r = getQueryString("refund_id");
    
    template.helper("isEmpty", function (e) {
        for (var r in e) {
            return false
        }
        return true
    });
    $.getJSON(ApiUrl + "?ctl=Buyer_Service_Return&met=index&act=detail&typ=json", {k: k,u:u, oid: oid,ogid:ogid,id:r}, function (data) {
        $("#refund-info-div").html(template.render("refund-info-script", data.data));

        $('#return_plat').click(function () {
            $.getJSON(ApiUrl + "?ctl=Buyer_Service_Return&met=addPlat&typ=json", {k: k,u:u, id: r}, function (d) {
                if(d.status == 200){
                    window.history.go(0);
                }
            });
        });

        $('#return_shipping').click(function () {
            var express_id = $('#express_id').val();
            var return_shipping_code = $('#return_shipping_code').val();

            if (!express_id) {
                $.sDialog({
                    skin: "red",
                    content: "请选择物流公司",
                    okBtn: false,
                    cancelBtn: false
                });
                return false
            }
            if (!return_shipping_code) {
                $.sDialog({
                    skin: "red",
                    content: "请填写物流单号",
                    okBtn: false,
                    cancelBtn: false
                });
                return false
            }

            $.getJSON(ApiUrl + "?ctl=Buyer_Service_Return&met=addReturnShippingCode&typ=json", {id:r,express_id:express_id,return_shipping_code:return_shipping_code}, function (d) {
                if(d.status == 200){
                    window.history.go(0);
                }else{
                    $.sDialog({
                        skin: "red",
                        content: '提交失败',
                        okBtn: false,
                        cancelBtn: false
                    });
                }
            });
        });
    });




});
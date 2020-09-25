//平台审核
$(function() {
    urlParam = Public.urlParam();

    var type = 1;

    $('#handle_finish').validator({
        ignore: ':hidden',
        theme: 'yellow_bottom',
        timely: 1,
        stopOnError: true,
        fields: {
            return_platform_message: "required"
        },
        valid: function(form) {
            var me = this;
            // 提交表单之前，hold住表单，防止重复提交
            me.holdSubmit();

            var confirm_name = '确认同意此退单？';
            var url = SITE_URL + '?ctl=Trade_Return&met=agree&typ=json';
            if(type == 2){
                confirm_name = '确认不同意此退单？';
                url = SITE_URL + '?ctl=Trade_Return&met=disagree&typ=json';
            }

            parent.$.dialog.confirm(confirm_name, function() {
                Public.ajaxPost(url, $('#handle_finish').serialize(), function(data) {
                    if (data.status == 200) {
                        parent.Public.tips({
                            content: '审核成功！'
                        });
                        window.location.href = SITE_URL + "?ctl=Trade_Return&met=detail&id=" + urlParam.id;
                    } else {
                        parent.Public.tips({
                            type: 1,
                            content: data.msg || '操作无法成功，请稍后重试！'
                        });
                    }

                    // 提交表单成功后，释放hold，如果不释放hold，就变成了只能提交一次的表单
                    me.holdSubmit(false);
                });
            }, function() {
                me.holdSubmit(false);
            });
        },
    }).on("click", "a#btn_handle_submit", function(e) {
        type = 1;
        $(e.delegateTarget).trigger("validate");
    }).on("click", "a#btn_handle_submit1", function(e) {
        type = 2;
        $(e.delegateTarget).trigger("validate");
    });


});
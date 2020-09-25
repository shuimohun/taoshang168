/**
 * Created by Zhenzh.
 */
//表单提交
$(function ()
{
    var t = "edit";
    if ($('#fu_t_info').length > 0)
    {
        $('#fu_t_info').validator({
           ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: true,
            fields: {
                'sqq':'required;integer;range[0~9999]',
                'qzone':'required;integer;range[0~9999]',
                'weixin':'required;integer;range[0~9999]',
                'weixin_timeline':'required;integer;range[0~9999]',
                'tsina':'required;integer;range[0~9999]',
                'fu_sort':'required;integer;range[0~9999]',
            },
            valid: function (form) {
                parent.$.dialog.confirm('确认修改？', function () {
                    var param = {};
                        param.fu_id = $("#fu_id").val();
                        param.fu_sort = $(".fu_sort").val();
                        param.sqq = $(".sqq").val();
                        param.qzone = $(".qzone").val();
                        param.weixin = $(".weixin").val();
                        param.weixin_timeline = $(".weixin_timeline").val();
                        param.tsina = $(".tsina").val();
                    Public.ajaxPost(SITE_URL + '?ctl=Promotion_Fu&met=editFuSort&typ=json', param, function (data) {
                        if (data.status == 200) {
                            parent.Public.tips({content: '修改成功!'});
                            callback && "function" == typeof callback && callback(data.data, t, window)
                        } else {
                            parent.Public.tips({type: 1, content: data.msg || '操作无法成功，请稍后重试！'});
                        }
                    });
                },
                function ()
                {
                });
            }
        }).on("click", "a#submitBtn", function (e)
        {
            $(e.delegateTarget).trigger("validate");
        });
    }
});

var curRow, curCol, curArrears, $grid = $("#grid"),  $_form = $("#fu_t_info"), api = frameElement.api, oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;

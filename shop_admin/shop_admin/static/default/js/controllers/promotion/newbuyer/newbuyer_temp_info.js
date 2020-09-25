/**
 * Created by Zhenzh.
 */
//表单提交
$(function ()
{
    var t = "edit";
    if ($('#newbuyer_t_info').length > 0)
    {
        $('#newbuyer_t_info').validator({
           ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: true,
            fields: {
               'newbuyer_sort':'required;integer;range[0~9999]',
            },
            valid: function (form)
            {
                parent.$.dialog.confirm('确认修改？', function ()
                {
                    Public.ajaxPost(SITE_URL + '?ctl=Promotion_NewBuyer&met=editNewBuyerType&typ=json', {newbuyer_id:$("#newbuyer_id").val(),newbuyer_type:$("input[name='newbuyer_type']:checked").val(),newbuyer_sort:$("input[name='newbuyer_sort']").val()}, function (data)
                    {
                        if (data.status == 200)
                        {
                            parent.Public.tips({content: '修改成功!'});
                            callback && "function" == typeof callback && callback(data.data, t, window)
                        }
                        else
                        {
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

var curRow, curCol, curArrears, $grid = $("#grid"),  $_form = $("#newbuyer_t_info"), api = frameElement.api, oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;

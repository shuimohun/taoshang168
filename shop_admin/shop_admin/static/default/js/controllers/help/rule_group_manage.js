function initField()
{
    if(api.data.parent_id)
    {
        $.get(SITE_URL + '?ctl=Help_Group&met=getGroupName&typ=json&id=' + api.data.parent_id, function(a){
            if(a.status==200)
            {
                $("#parent_name").val(a.data.parent_name);
                $("#parent_id").val(a.data.parent_id);
            }
        });
    }
    if (rowData.help_group_id)
    {
        $("#help_group_sort").val(rowData.help_group_sort);
        $("#help_group_title").val(rowData.help_group_title);
        if(rowData.help_group_parent_id)
        {
            $.get(SITE_URL + '?ctl=Help_Group&met=getGroupName&typ=json&id=' + rowData.help_group_parent_id, function(a){
                if(a.status==200)
                {
                    $("#parent_name").val(a.data.parent_name);
                    $("#parent_id").val(a.data.parent_id);
                }
            });
        }
    }
}
function initPopBtns()
{
    var t = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
    api.button({
        id: "confirm", name: t[0], focus: !0, callback: function ()
        {
            postData(oper, rowData.help_group_id);
            return cancleGridEdit(),$("#manage-form").trigger("validate"), !1;
        }
    }, {id: "cancel", name: t[1]})
}
function postData(t, e)
{
    var help_group_sort = $.trim($("#help_group_sort").val()),
        help_group_title = $.trim($("#help_group_title").val()),
        help_group_parent_id = $.trim($("#parent_id").val()),
        n = "add" == t ? "新增类型" : "修改类型";

    params = rowData.help_group_id ? {
        help_group_id: e,
        help_group_sort: help_group_sort,
        help_group_title: help_group_title,
        help_group_parent_id: help_group_parent_id
    } : {
        help_group_sort: help_group_sort,
        help_group_title: help_group_title,
        help_group_parent_id: help_group_parent_id
    };
    Public.ajaxPost(SITE_URL + "?ctl=Help_Group&typ=json&type=rule&met=" + ("add" == t ? "addGroup" : "editGroup"), params, function (e)
    {
        if (200 == e.status)
        {
            parent.parent.Public.tips({content: n + "成功！"});
            callback && "function" == typeof callback && callback(e.data, t, window)
        }
        else
        {
            parent.parent.Public.tips({type: 1, content: n + "失败！" + e.msg})
        }
    })
}
function cancleGridEdit()
{
    null !== curRow && null !== curCol && ($grid.jqGrid("saveCell", curRow, curCol), curRow = null, curCol = null)
}
function resetForm(t)
{
    $("#manage-form").validate().resetForm();
    $("#help_group_sort").val("");
    $("#help_group_title").val("");
}
var curRow, curCol, curArrears, $grid = $("#grid"),  $_form = $("#manage-form"), api = frameElement.api, oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;
initPopBtns();
initField();